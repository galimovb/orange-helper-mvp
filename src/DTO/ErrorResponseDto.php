<?php

namespace App\DTO;

class ErrorResponseDto
{
    public function __construct(
        public string $message,
        public int $statusCode,
        public array $errors = []
    ) {
    }
}