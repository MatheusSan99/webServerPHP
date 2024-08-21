<?php

namespace App\Server\Logs;

use App\Server\Request;

class ErrorLog extends Log implements LogsInterface
{
    private string $logDirectory;
    private string $logFile;

    public function __construct()
    {
        $this->logDirectory = $GLOBALS['ROOT_DIR'] . '/Logs';

        $this->logFile = $this->logDirectory . '/server_error.log';

        $this->ensureLogDirectoryExists();
    }

    public function insertLog(?Request $request, $message = ''): void
    {
        $date = date('Y-m-d H:i:s');

        if (is_null($request)) {
            $formattedMessage = "Server error [$date]: $message";
        } else {
            $formattedMessage = "Request from {$request->getRemoteAddress()} [$date]: {$request->getMethodString()} {$request->getUriString()} - $message";
        }

        file_put_contents($this->logFile, $formattedMessage, FILE_APPEND);
    }
}
