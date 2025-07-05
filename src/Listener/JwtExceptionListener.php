<?php
//Этот класс вызывается если токен есть и с ним какие-то проблемы

namespace App\Listener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTFailureEventInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTInvalidEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTExpiredEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class JwtExceptionListener
{
    public function onJwtFailure(JWTFailureEventInterface $event): void
    {
        $response = new JsonResponse([
            'error' => [
                'code' => 401,
                'error_code' => $this->getErrorCode($event),
                'message' => $this->getErrorMessage($event),
            ]
        ], 401);

        $event->setResponse($response);
    }

    private function getErrorMessage(JWTFailureEventInterface $event): string
    {
        if ($event instanceof JWTInvalidEvent) {
            return 'Неверный токен авторизации';
        }
        if ($event instanceof JWTExpiredEvent) {
            return 'Срок действия токена истек';
        }
        if ($event instanceof JWTNotFoundEvent) {
            return 'Токен авторизации отсутствует';
        }

        return 'Ошибка аутентификации';
    }

    private function getErrorCode(JWTFailureEventInterface $event): string
    {
        if ($event instanceof JWTInvalidEvent) {
            return 'INVALID_TOKEN';
        }
        if ($event instanceof JWTExpiredEvent) {
            return 'TOKEN_EXPIRED';
        }
        if ($event instanceof JWTNotFoundEvent) {
            return 'TOKEN_NOT_FOUND';
        }

        return 'AUTHENTICATION_ERROR';
    }

}