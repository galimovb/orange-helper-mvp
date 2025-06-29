<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateUserDto
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 10, max: 20)]
    public string $phoneNumber;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 50)]
    public string $firstName;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 50)]
    public string $lastName;

    #[Assert\Length(min: 2, max: 50)]
    public string $secondName;

    #[Assert\NotNull]
    #[Assert\Range(min: 1, max: 120)]
    public int $age;

    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;

    public ?string $childrenFullName = null;

    #[Assert\Range(
        min: 0,
        max: 120,
    )]
    public ?int $childrenAge = null;
}
