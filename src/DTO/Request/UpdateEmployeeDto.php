<?php

namespace App\DTO\Request;

use App\Enum\EmployeeSphera;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateEmployeeDto
{
    #[Assert\Length(min: 2, max: 255)]
    public ?string $firstName = null;

    #[Assert\Length(min: 2, max: 255)]
    public ?string $lastName = null;

    #[Assert\Length(min: 2, max: 255)]
    public ?string $secondName = null;

    #[Assert\Email]
    public ?string $email = null;

    #[Assert\Regex(pattern: '/^\+?[0-9]{10,15}$/')]
    public ?string $phoneNumber = null;

    #[Assert\Range(min: 18, max: 100)]
    public ?int $age = null;

    #[Assert\Length(min: 6)]
    public ?string $password = null;

    #[Assert\Choice(callback: [EmployeeSphera::class, 'cases'])]
    public ?string $employeeSphera = null;

    public ?string $education = null;
    public ?string $cualification = null;
    public ?int $experience = null;
    public ?bool $isActive = null;
}