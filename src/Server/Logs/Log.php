<?php

namespace App\Server\Logs;

class Log
{
    protected function ensureLogDirectoryExists()
    {
        if (!file_exists($GLOBALS['ROOT_DIR'] . '/Logs')) {
            mkdir($GLOBALS['ROOT_DIR'] . '/Logs', 0777, true);
        }

    }

}