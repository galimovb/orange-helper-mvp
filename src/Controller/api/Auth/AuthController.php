<?php

namespace App\Controller\api\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class AuthController extends AbstractController
{
    #[Route('/api/login/check', name: 'login', methods: ['POST', 'OPTIONS'])]
    public function login(): Response
    {
       return new JsonResponse(['message' => 'Успешно']);
    }

    #[Route('/api/auth/check', name: 'api_auth_check', methods: ['GET'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function me(UserInterface $user): JsonResponse
    {
        return $this->json([
            true
        ]);
    }
}
