<?php

namespace App\Service;

use App\DTO\RegisterUserDto;
use App\DTO\Response\UserResponseDto;
use App\Entity\User;
use App\Exception\RegistrationValidationFailedException;
use App\Exception\UserAlreadyExistsException;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationService
{
    private UserPasswordHasherInterface $passwordHasher;
    private UserRepository $userRepository;
    private EntityManagerInterface $entityManager;

    private ValidatorInterface $validator;

    private TranslatorInterface $translator;


    public function __construct(
        UserPasswordHasherInterface $passwordHasher,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator,
    ) {
        $this->passwordHasher = $passwordHasher;
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    public function register(RegisterUserDto $dto): UserResponseDto
    {
        // Проверка существования пользователя
        if ($this->userRepository->existsByPhone($dto->phoneNumber)) {
            throw new UserAlreadyExistsException();
        }

        // Валидация DTO
        $violations = $this->validator->validate($dto);
        if (count($violations) > 0) {
            $errors = [];

            foreach ($violations as $violation) {
                $errors[$violation->getPropertyPath()][] = $violation->getMessage();
            }

            throw new RegistrationValidationFailedException($errors);
        }

        try {
            $user = new User();
            $user->setPhoneNumber($user->normalizePhone($dto->phoneNumber));
            $user->setPassword($this->passwordHasher->hashPassword($user, $dto->password));
            $user->setAge($dto->age);
            $user->setFirstName($dto->firstName);
            $user->setLastName($dto->lastName);
            $user->setSecondName($dto->secondName);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return new UserResponseDto($user);
        } catch (\Exception $e) {
            throw new \RuntimeException('Registration failed: '.$e->getMessage(), 500, $e);
        }
    }

}