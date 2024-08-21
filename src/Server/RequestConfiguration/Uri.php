<?php

namespace App\Server\RequestConfiguration;

class Uri
{
    private string $uri;

    public function __construct(string $uri)
    {
        if (empty($uri)) {
            throw new \Exception('Invalid uri');
        }

        $this->uri = $uri;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

}