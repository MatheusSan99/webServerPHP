<?php

namespace App\Server\RequestConfiguration;

class Method
{
    private string $method;

    public function __construct(string $method)
    {
        if (!in_array($method, ['GET', 'POST', 'PUT', 'DELETE'])) {
            throw new \Exception('Invalid method');
        }

        $this->method = $method;
    }

    public function getMethod(): string
    {
        return $this->method;
    }
}