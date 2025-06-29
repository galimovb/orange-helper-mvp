<?php
//Этот класс вызывается как точка входа, если нет заголовка с токеном
namespace App\Listener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

class JwtAuthenticationEntryPoint implements AuthenticationEntryPointInterface
{
    public function start(Request $request, ?AuthenticationException $authException = null): Response
    {
        return new JsonResponse([
            'error' => [
                'code' => 401,
                'message' => 'Токен отсутствует, доступ запрещен.',
            ]
        ], Response::HTTP_UNAUTHORIZED);
    }

}
