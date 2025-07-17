<?php

namespace App\DTO\Request;

use App\Enum\EmployeeSphera;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterEmployeeDto
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    public string $firstName;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    public string $lastName;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    public string $secondName;

    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;

    #[Assert\NotBlank]
    #[Assert\Regex(pattern: '/^\+?[0-9]{10,15}$/')]
    public string $phoneNumber;

    #[Assert\NotBlank]
    #[Assert\Range(min: 18, max: 100)]
    public int $age;

    #[Assert\NotBlank]
    #[Assert\Length(min: 6)]
    public string $password;

    #[Assert\Choice(callback: [EmployeeSphera::class, 'values'])]
    public string $employeeSphera;
}