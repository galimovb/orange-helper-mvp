<?php

namespace App\Controller\api;

class ApiResponse
{
    public static function error(int $code, string $message, array $details = []): array
    {
        return [
            'error' => [
                'code' => $code,
                'message' => $message,
            ]

        ];
    }

    public static function success($data = null): array
    {
        return [
            'result' => $data
        ];
    }
}