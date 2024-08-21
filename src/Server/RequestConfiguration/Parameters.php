<?php

namespace App\Server\RequestConfiguration;

class Parameters
{
    private array $parameters;

    public function __construct(array $parameters)
    {
        if (!empty($parameters)) {
            foreach ($parameters as $key => $value) {
                if (!is_string($key) || !is_string($value)) {
                    throw new \Exception('Invalid parameters');
                }
            }
        }

        $this->parameters = $parameters;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

}