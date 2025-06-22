<?php

namespace App\Controller\api\Auth;

use App\DTO\RegisterUserDto;
use App\Service\RegistrationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_registration', methods: ['POST'])]
    public function register(
        #[MapRequestPayload] RegisterUserDto $dto,
        RegistrationService $registrationService
    ): JsonResponse {
        $user = $registrationService->register($dto);
        return $this->json($user, 201);
    }
}
