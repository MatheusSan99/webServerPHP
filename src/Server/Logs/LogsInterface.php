<?php

namespace App\Server\Logs;

use App\Server\Request;

interface LogsInterface
{
    public function insertLog(Request $request, string $message = ''): void;

}