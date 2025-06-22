<?php

namespace App\Controller\api\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AuthController extends AbstractController
{
    #[Route('/login/check', name: 'login', methods: ['POST', 'OPTIONS'])]
    public function login(): Response
    {
       return new JsonResponse(['message' => 'Успешно']);
    }
}
