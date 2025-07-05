<?php

namespace App\DTO\Response;

use App\Entity\User;

class UserResponseDto
{
    public int $id;

    public string $phoneNumber;

    public int $age;

    public string $firstName;

    public string $lastName;

    public string $secondName;

    public ?string $email;
    public ?string $childrenFullName;
    public ?int $childrenAge;

    public function __construct(User $user)
    {
        $this->id = $user->getId();
        $this->phoneNumber = $user->getPhoneNumber();
        $this->age = $user->getAge();
        $this->firstName = $user->getFirstName();
        $this->lastName = $user->getLastName();
        $this->secondName = $user->getSecondName();
        $this->email = $user->getEmail();
        $this->childrenFullName = $user->getChildrenFullName();
        $this->childrenAge = $user->getChildrenAge();
    }
}
