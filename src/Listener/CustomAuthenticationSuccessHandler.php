<?php

namespace App\Listener;

use App\Entity\RefreshToken;
use Gesdinet\JWTRefreshTokenBundle\Model\RefreshTokenManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class CustomAuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private JWTTokenManagerInterface $jwtManager;
    private RefreshTokenManagerInterface $refreshTokenManager;

    public function __construct(
        JWTTokenManagerInterface $jwtManager,
        RefreshTokenManagerInterface $refreshTokenManager
    ) {
        $this->jwtManager = $jwtManager;
        $this->refreshTokenManager = $refreshTokenManager;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): JsonResponse
    {
        $user = $token->getUser();
        $jwt = $this->jwtManager->create($user);

        // Создаём refresh токен
        $refreshToken = new RefreshToken();
        $refreshToken->setRefreshToken(bin2hex(random_bytes(64)));
        $refreshToken->setUsername($user->getUserIdentifier()); // phoneNumber
        $refreshToken->setValid((new \DateTime())->modify('+30 days'));

        $response = new JsonResponse(['message' => 'success']);

        $response->headers->setCookie(
            Cookie::create('BEARER')
                ->withValue($jwt)
                ->withHttpOnly(true)
                ->withSecure(true)
                ->withSameSite('None')
                ->withDomain('.orangehelper.ru')
                ->withPath('/')
                ->withExpires(strtotime('+24 hours'))
        );

        $response->headers->setCookie(
            Cookie::create('gesdinet_jwt_refresh_token')
                ->withValue($refreshToken->getRefreshToken())
                ->withHttpOnly(true)
                ->withSecure(true)
                ->withSameSite('None')
                ->withDomain('.orangehelper.ru')
                ->withPath('/')
                ->withExpires(strtotime('+30 days'))
        );

        return $response;
    }
}
