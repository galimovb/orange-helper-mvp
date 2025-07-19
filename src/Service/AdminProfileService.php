<?php

namespace App\Service;

use App\DTO\Request\ChangePasswordDto;
use App\DTO\Request\UpdateEmployeeDto;
use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Util\Exception;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminProfileService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private EmployeeRepository $employeeRepository,
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function updateEmployee(Employee $employee, UpdateEmployeeDto $dto): Employee
    {
        if ($dto->firstName !== null) {
            $employee->setFirstName($dto->firstName);
        }

        if ($dto->lastName !== null) {
            $employee->setLastName($dto->lastName);
        }

        if ($dto->secondName !== null) {
            $employee->setSecondName($dto->secondName);
        }

        if ($dto->email !== null) {
            $employee->setEmail($dto->email);
        }

        if ($dto->phoneNumber !== null) {
            $employee->setPhoneNumber($dto->phoneNumber);
        }

        if ($dto->age !== null) {
            $employee->setAge($dto->age);
        }

        if ($dto->education !== null) {
            $employee->setEducation($dto->education);
        }

        if ($dto->cualification !== null) {
            $employee->setCualification($dto->cualification);
        }

        if ($dto->experience !== null) {
            $employee->setExperience($dto->experience);
        }

        $this->employeeRepository->save($employee, true);

        return $employee;
    }

    public function changePassword(Employee $employee, ChangePasswordDto $dto): void
    {
        if (!$this->passwordHasher->isPasswordValid($employee, $dto->currentPassword)) {
            throw new Exception('Неверный текущий пароль', 403);
        }

        if ($dto->newPassword !== $dto->confirmPassword) {
            throw new Exception('Новый пароль и подтверждение не совпадают', 400);
        }

        $employee->setPassword(
            $this->passwordHasher->hashPassword($employee, $dto->newPassword)
        );

        $this->entityManager->persist($employee);
        $this->entityManager->flush();
    }
}