<?php

namespace App\Server\RequestConfiguration;

class Headers
{
    private array $headers;

    public function __construct(array $headers)
    {
        $this->setDefaultHeaders();

        $this->headers = $headers;
    }

    private function setDefaultHeaders(): void
    {
        $this->headers[] = [
            'Content-Type' => 'application/json',
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE',
            'Access-Control-Allow-Headers' => 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With',
            'Access-Control-Max-Age' => '3600',
            'Access-Control-Allow-Credentials' => 'true',
            'Date' => date('D, d M Y H:i:s T'),
            'Server' => 'Apache/2.2.22 (Debian)',
        ];
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

}