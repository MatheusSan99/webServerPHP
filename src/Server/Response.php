<?php

namespace App\Server;

use App\Server\RequestConfiguration\Headers;
use App\Server\ResponseConfiguration\Status;

class Response
{
    private Headers $headers;
    private string $body;
    private Status $status;

    public function __construct(array $headers, string $body, int $status = 200)
    {
        $this->headers = new Headers($headers);
        $this->body = $body;
        $this->status = new Status($status);

        return $this;
    }

    public function getBodyString(): string
    {
        return $this->body;
    }

    public function getHeadersString(): string
    {
        return implode("\r\n", $this->headers->getHeaders());
    }

    public function getStatusString(): string
    {
        return $this->status->getStatusDefinition();
    }

}