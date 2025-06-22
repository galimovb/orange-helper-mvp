<?php

namespace App\Listener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;

class CustomAuthenticationFailureHandler implements AuthenticationFailureHandlerInterface
{
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): JsonResponse
    {
        $data = [
            'error' => 'Authentication failed',
            'message' => $exception->getMessage(),
        ];

        if ($exception instanceof UserNotFoundException) {
            $data['message'] = 'Пользователь не найден';
        }

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }
}