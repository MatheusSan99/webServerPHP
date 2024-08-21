<?php

namespace App\Server;

use App\Server\RequestConfiguration\Method;
use App\Server\RequestConfiguration\Parameters;
use App\Server\RequestConfiguration\Uri;
use App\Server\RequestConfiguration\Headers;
use Exception;
use Socket;

class Request
{
    private Headers $headers;
    private Method $method;
    private Uri $uri;
    private Parameters $parameters;
    private string $body;
    private string $remoteAddress;

    /**
     * @throws Exception
     */
    public function __construct(Socket $client)
    {
        try {
        $requestString = socket_read($client, 1024);
        $lines = explode("\r\n", $requestString);
        $requestLine = explode(' ', $lines[0]);

        $this->setRemoteAddress($client);

        $body = $lines[count($lines) - 1] ?? '';

        $method = $requestLine[0];
        $uri = $requestLine[1];
        $headers = array_slice($lines, 1, -2);
        $uriParts = parse_url($uri);
        $path = $uriParts['path'];
        $query = $uriParts['query'] ?? '';
        parse_str($query, $parameters);

        $this->headers = new Headers($headers);
        $this->method = new Method($method);
        $this->uri = new Uri($path);
        $this->parameters = new Parameters($parameters);
        $this->body = $body;
        } catch (Exception $e) {
            throw new Exception('Could not parse request: ' . $e->getMessage());
        }
    }

    public function setRemoteAddress(Socket $client): void
    {
        $remoteAddress = '';
        if (socket_getpeername($client, $remoteAddress)) {
            $this->remoteAddress = $remoteAddress;
            return;
        }
        $this->remoteAddress = 'Unknown';
    }

    public function getRemoteAddress(): string
    {
        return $this->remoteAddress;
    }

    public function getMethodString(): string
    {
        return $this->method->getMethod();
    }

    public function getUriString(): string
    {
        return $this->uri->getUri();
    }

    public function getParametersArray(): array
    {
        return $this->parameters->getParameters();
    }

    public function getBodyString(): string
    {
        return $this->body;
    }

}
