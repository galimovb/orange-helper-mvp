<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function existsByPhone(string $phoneNumber): bool
    {
        $user = $this->createQueryBuilder('u')
            ->andWhere('u.phoneNumber = :phone_number')
            ->setParameter('phone_number', $phoneNumber)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
        return $user !== null;
    }
}
