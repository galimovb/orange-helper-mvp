<?php

namespace App\DTO\Request;


use Symfony\Component\Validator\Constraints as Assert;

class ChangePasswordDto
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 6)]
    public string $currentPassword;

    #[Assert\NotBlank]
    #[Assert\Length(min: 6)]
    public string $newPassword;

    #[Assert\NotBlank]
    #[Assert\Length(min: 6)]
    public string $confirmPassword;
}
