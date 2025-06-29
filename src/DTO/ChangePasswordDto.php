<?php

namespace App\DTO;


use Symfony\Component\Validator\Constraints as Assert;

class ChangePasswordDto
{
    #[Assert\NotBlank]
    public string $currentPassword;

    #[Assert\NotBlank]
    #[Assert\Length(min: 6)]
    public string $newPassword;
}
