<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

class UserAlreadyExistsException extends HttpException
{
    public function __construct(string $message = 'Такой пользователь есть', int $statusCode = 409)
    {
        parent::__construct($statusCode, $message);
    }
}
