<?php

namespace App\Controller\admin;

use App\DTO\Request\ChangePasswordDto;
use App\DTO\Request\UpdateEmployeeDto;
use App\DTO\Response\EmployeeResponseDto;
use App\Service\AdminProfileService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/profile')]
class ProfileController extends AbstractController
{
    public function __construct(
        private Security $security,
        private AdminProfileService $profileService,
    ) {}

    #[Route('', name: 'admin_get_profile', methods: ['GET'])]
    public function getProfile(): JsonResponse
    {
        $employee = $this->security->getUser();
        return $this->json(new EmployeeResponseDto($employee));
    }

    #[Route('', name: 'admin_update_profile', methods: ['PUT'])]
    public function updateProfile(
        #[MapRequestPayload] UpdateEmployeeDto $dto,
    ): JsonResponse {
        $employee = $this->security->getUser();
        $updatedEmployee = $this->profileService->updateEmployee($employee, $dto);
        return $this->json(new EmployeeResponseDto($updatedEmployee));
    }

    #[Route('/change-password', name: 'admin_change_password', methods: ['PUT'])]
    public function changePassword(
        #[MapRequestPayload] ChangePasswordDto $dto,
    ): JsonResponse {
        $employee = $this->security->getUser();
        $this->profileService->changePassword($employee, $dto);
        return $this->json(['message' => 'Пароль успешно изменен']);
    }
}