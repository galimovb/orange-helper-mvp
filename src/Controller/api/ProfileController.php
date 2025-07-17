<?php
namespace App\Controller\api;

use App\DTO\Request\ChangePasswordDto;
use App\DTO\Request\UpdateUserDto;
use App\DTO\Response\UserResponseDto;
use App\Service\ProfileService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Exception\ValidatorException;

#[Route('/api/profile')]
class ProfileController extends AbstractController
{
    public function __construct(
        private Security $security,
        private ProfileService $profileService,
    ) {}

    #[Route('', name: 'get_profile', methods: ['GET'])]
    public function getProfile(): JsonResponse
    {
        $user = $this->security->getUser();
        return $this->json(new UserResponseDto($user));
    }

    #[Route('', name: 'update_profile', methods: ['PUT'])]
    public function updateProfile(
        #[MapRequestPayload] UpdateUserDto $dto,
    ): JsonResponse {
        $user = $this->security->getUser();

        try {
            $updatedUser = $this->profileService->updateUser($user, $dto);
        } catch (ValidatorException $e) {
            return $this->json(['errors' => json_decode($e->getMessage(), true)], 400);
        }

        return $this->json(new UserResponseDto($updatedUser));
    }

    #[Route('/change-password', name: 'change_password', methods: ['PUT'])]
    public function changePassword(
        #[MapRequestPayload] ChangePasswordDto $dto,
    ): JsonResponse {
        $user = $this->security->getUser();

        try {
            $this->profileService->changePassword($user, $dto);
        } catch (ValidatorException $e) {
            return $this->json(['errors' => json_decode($e->getMessage(), true)], 400);
        } catch (\InvalidArgumentException $e) {
            return $this->json(['error' => $e->getMessage()], 403);
        }

        return $this->json(['message' => 'Пароль изменён']);
    }
}
