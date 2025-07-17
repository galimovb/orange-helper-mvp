<?php
namespace App\Service;

use App\DTO\Request\ChangePasswordDto;
use App\DTO\Request\UpdateUserDto;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProfileService
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $passwordHasher,
        private ValidatorInterface $validator
    ) {}

    /**
     * @throws ValidatorException if validation fails
     */
    public function updateUser(User $user, UpdateUserDto $dto): User
    {
        $violations = $this->validator->validate($dto);
        if (count($violations) > 0) {
            $errors = [];

            foreach ($violations as $violation) {
                $errors[$violation->getPropertyPath()][] = $violation->getMessage();
            }

            throw new ValidatorException($errors);
        }

        $user->setFirstName($dto->firstName);
        $user->setLastName($dto->lastName);
        $user->setSecondName($dto->secondName);
        $user->setPhoneNumber($dto->phoneNumber);
        $user->setAge($dto->age);
        $user->setEmail($dto->email);
        $user->setChildrenFullName($dto->childrenFullName);
        $user->setChildrenAge($dto->childrenAge);

        $this->em->flush();

        return $user;
    }

    /**
     * @throws ValidatorException if validation fails
     * @throws \InvalidArgumentException if current password invalid
     */
    public function changePassword(User $user, ChangePasswordDto $dto): void
    {
        $errors = $this->validator->validate($dto);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[$error->getPropertyPath()] = $error->getMessage();
            }
            throw new ValidatorException(json_encode($errorMessages));
        }

        if (!$this->passwordHasher->isPasswordValid($user, $dto->currentPassword)) {
            throw new \InvalidArgumentException('Неверный текущий пароль');
        }

        $user->setPassword($this->passwordHasher->hashPassword($user, $dto->newPassword));
        $this->em->flush();
    }
}
