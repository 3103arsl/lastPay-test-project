<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    protected array $context;

    public function __construct(string $message, array $context = [], int $code = 0, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->context = $context;
    }

    public function toArray(): array
    {
        return [
            'error' => true,
            'message' => $this->getMessage(),
            'context' => $this->context,
        ];
    }
}
