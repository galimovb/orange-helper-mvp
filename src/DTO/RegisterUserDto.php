<?php

namespace App\DTO;


use Symfony\Component\Validator\Constraints as Assert;

class RegisterUserDto
{
    #[Assert\NotBlank]
    public string $phoneNumber;

    #[Assert\NotBlank]
    #[Assert\Length(min: 6)]
    public string $password;

    #[Assert\NotBlank]
    public string $firstName;

    #[Assert\NotNull]
    #[Assert\Range(min: 1, max: 120)]
    public int $age;

    #[Assert\NotBlank]
    public string $lastName;

    #[Assert\NotBlank]
    public string $secondName;
}
