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

    #[Assert\NotBlank]
    #[Assert\Type(type: 'digit')]
    public string $age;


    #[Assert\NotBlank]
    public string $lastName;

    #[Assert\NotBlank]
    public string $secondName;
}
