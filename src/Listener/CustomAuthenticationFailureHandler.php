<?php

namespace App\Listener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class CustomAuthenticationFailureHandler implements AuthenticationFailureHandlerInterface
{
    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
    {
        $errorMessage = $this->translator->trans($exception->getMessageKey(), domain: 'security');

        return new JsonResponse([
            'error' => [
                'code' => 401,
                'message' => $errorMessage,
            ]
        ], Response::HTTP_UNAUTHORIZED);
    }

}