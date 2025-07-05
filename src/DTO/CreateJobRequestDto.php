<?php

namespace App\DTO;

use App\Enum\EmployeeSphera;
use Symfony\Component\Validator\Constraints as Assert;

class CreateJobRequestDto
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public string $fullName;

    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    #[Assert\Range(min: 14, max: 100)]
    public int $age;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public string $education;

    #[Assert\Type('string')]
    public ?string $workPlace = null;

    #[Assert\Type('string')]
    public ?string $beenWorkingYears = null;

    #[Assert\NotNull]
    #[Assert\Type(EmployeeSphera::class)]
    public EmployeeSphera $employeeSphera;

    #[Assert\NotBlank]
    #[Assert\Regex(pattern: '/^\+?[0-9]{7,15}$/', message: 'Некорректный формат телефона')]
    public string $phone;
}
