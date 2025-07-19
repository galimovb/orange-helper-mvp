<?php

namespace App\DTO\Response;

use App\Entity\Employee;
use App\Enum\EmployeeSphera;

class EmployeeResponseDto
{
    public int $id;
    public string $phoneNumber;
    public string $email;
    public string $login;
    public string $firstName;
    public string $lastName;
    public string $secondName;
    public string $createdAt;
    public array $roles;
    public ?string $updatedAt;
    public bool $isActive;
    public int $age;
    public string $education;
    public ?string $cualification;
    public ?int $experience;
    public ?string $employeeSphera = null;
    public ?string $employeeSpheraLabel = null;


    public function __construct(Employee $employee)
    {
        $this->id = $employee->getId();
        $this->phoneNumber = $employee->getPhoneNumber();
        $this->email = $employee->getEmail() ?? '';
        $this->login = $employee->getLogin() ?? '';
        $this->firstName = $employee->getFirstName();
        $this->lastName = $employee->getLastName();
        $this->secondName = $employee->getSecondName();
        $this->createdAt = $employee->getCreatedAt()->format('Y-m-d H:i:s');
        $this->roles = $employee->getRoles();
        $this->updatedAt = $employee->getUpdatedAt()?->format('Y-m-d H:i:s');
        $this->isActive = $employee->isActive() ?? true;
        $this->age = $employee->getAge();
        $this->education = $employee->getEducation() ?? '';
        $this->cualification = $employee->getCualification();
        $this->experience = $employee->getExperience();
        $employeeSphera = $employee->getEmployeeSphera();
        $this->employeeSphera = $employeeSphera?->value;
        $this->employeeSpheraLabel = $employeeSphera?->name;

    }
}