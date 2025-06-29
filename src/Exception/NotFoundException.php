<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

class NotFoundException extends HttpException
{
    public function __construct(string $message = 'Сущности с таким id нет', int $statusCode = 404)
    {
        parent::__construct($statusCode, $message);
    }
}
