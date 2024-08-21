<?php

namespace App\Server;

use App\Server\Logs\ConnectionLog;
use App\Server\Logs\ErrorLog;
use App\Server\ServerConfiguration\Host;
use Exception;
use Socket;

class Server
{
    private Host $host;
    private int $port;
    private Socket $socket;

    /**
     * @throws Exception
     */
    public function __construct(string $host, int $port)
    {
        try {
        $this->host = new Host($host);
        $this->port = $port;
        } catch (Exception $e) {
            throw new Exception('Could not create server: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function run($callback): void
    {
        try {
            $this->createSocket();
            $this->bindSocket();
            $this->listenSocket($callback);
        } catch (Exception $e) {
            $this->logError('Server error: ' . $e->getMessage());
            throw $e; // Re-throw the exception after logging
        }
    }

    private function createSocket(): void
    {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    }

    private function bindSocket(): void
    {
        if (!socket_bind($this->socket, $this->host->getHostName(), $this->port)) {
            $this->logError('Could not bind socket');
            throw new Exception('Could not bind socket');
        }
    }

    private function listenSocket($callback): void
    {
        if (!is_callable($callback)) {
            $this->logError('Invalid callback');
            throw new Exception('Invalid callback');
        }

        if (!socket_listen($this->socket)) {
            $this->logError('Could not listen on socket');
            throw new Exception('Could not listen on socket');
        }

        while (true) {
            $client = socket_accept($this->socket);
            if ($client === false) {
                $this->logError('Could not accept connection');
                throw new Exception('Could not accept connection');
            }

            try {
                $Request = new Request($client);
                $response = $callback($Request);

                $this->connectionLog($Request, $response->getStatusString());

                $this->sendResponse($client, $response);
            } catch (Exception $e) {
                $this->logError('Error processing request: ' . $e->getMessage());
                socket_close($client);
            }
        }
    }

    private function sendResponse($client, Response $response): void
    {
        $headers = $response->getHeadersString();
        $body = $response->getBodyString();
        $status = $response->getStatusString();

        $responseString = "HTTP/1.1 $status\r\n$headers\r\n\r\n$body";
        socket_write($client, $responseString);
    }

    private function logError(string $message): void
    {
        $log = new ErrorLog();
        $log->insertLog(null, $message);
    }

    private function connectionLog(Request $request, string $message): void
    {
        $log = new ConnectionLog();
        $log->insertLog($request, $message);
    }
}
