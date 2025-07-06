<?php

namespace App\Listener;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class CustomAuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private JWTTokenManagerInterface $jwtManager;

    public function __construct(JWTTokenManagerInterface $jwtManager)
    {
        $this->jwtManager = $jwtManager;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): JsonResponse
    {
        $jwt = $this->jwtManager->create($token->getUser());

        $response = new JsonResponse(['message' => 'success']);
        $response->headers->setCookie(
            Cookie::create('BEARER')
                ->withValue($jwt)
                ->withHttpOnly(true)
                ->withSecure(true) // Только для HTTPS!
                ->withSameSite('None') // Для кросс-доменных запросов
                ->withDomain('.orangehelper.ru') // Ключевое изменение! Точка в начале
                ->withPath('/')
                ->withExpires(strtotime('+1 hour'))
        );
        return $response;
    }
}
