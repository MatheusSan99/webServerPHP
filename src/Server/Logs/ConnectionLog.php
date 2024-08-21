<?php

namespace App\Server\Logs;

use App\Server\Request;

class ConnectionLog extends Log Implements LogsInterface
{
    private string $logDirectory;
    private string $logFile;

    public function __construct()
    {
        $this->logDirectory = $GLOBALS['ROOT_DIR'] . '/Logs';

        $this->ensureLogDirectoryExists();

        $this->logFile = $this->logDirectory . '/connection.log';
        $this->ensureLogDirectoryExists();
    }

    public function insertLog(Request $request, $message = ''): void
    {
        $date = date('Y-m-d H:i:s');

        $formattedMessage = "Request from {$request->getRemoteAddress()} [$date]: {$request->getMethodString()} {$request->getUriString()} - $message\n";

        file_put_contents($this->logFile, $formattedMessage, FILE_APPEND);
    }
}
