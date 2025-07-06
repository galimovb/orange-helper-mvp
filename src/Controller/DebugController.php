<?php

namespace App\Controller;

// src/Controller/DebugController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DebugController extends AbstractController
{
    #[Route('/api/debug/cookies', methods: ['GET'])]
    public function debugCookies(Request $request): JsonResponse
    {
        return new JsonResponse([
            'cookie_exists' => $request->cookies->has('BEARER'),
            'cookie_value' => $request->cookies->get('BEARER'),
            'headers' => $request->headers->all()
        ]);
    }
}