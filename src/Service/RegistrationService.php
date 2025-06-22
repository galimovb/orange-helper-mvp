<?php

namespace App\Service;

// src/Service/Auth/RegistrationService.php
use App\DTO\RegisterUserDto;
use App\Entity\User;
use App\Exception\RegistrationValidationFailedException;
use App\Exception\UserAlreadyExistsException;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Exception\ValidationFailedException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationService
{
    private UserPasswordHasherInterface $passwordHasher;
    private UserRepository $userRepository;
    private EntityManagerInterface $entityManager;

    private ValidatorInterface $validator;


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

    public function register(RegisterUserDto $dto): User
    {
        // Проверка существования пользователя
        if ($this->userRepository->existsByPhone($dto->phoneNumber)) {
            throw new UserAlreadyExistsException();
        }

        try {
            $user = new User();
            $user->setPhoneNumber($dto->phoneNumber);
            $user->setPassword($this->passwordHasher->hashPassword($user, $dto->password));
            $user->setAge($dto->age);
            $user->setFirstName($dto->firstName);
            $user->setLastName($dto->lastName);
            $user->setSecondName($dto->secondName);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return $user;
        } catch (\Exception $e) {
            throw new \RuntimeException('Registration failed: '.$e->getMessage(), 500, $e);
        }
    }
}