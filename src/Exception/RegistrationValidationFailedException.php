<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

class RegistrationValidationFailedException extends HttpException
{
    private array $errors;

    public function __construct(array $errors, string $message = 'Validation failed', int $statusCode = 422)
    {
        parent::__construct($statusCode, $message);
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}

