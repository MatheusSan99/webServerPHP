<?php

namespace App\Server\ServerConfiguration;

class Host
{

    private string $host;

    public function __construct(string $host)
    {
        if (!filter_var($host, FILTER_VALIDATE_IP)) {
            throw new \Exception('Invalid host');
        }

        $this->host = $host;
    }

    public function getHostName(): string
    {
        return $this->host;
    }

}