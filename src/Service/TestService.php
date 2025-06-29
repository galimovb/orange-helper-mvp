<?php

namespace App\Service;

use App\Entity\Test;
use App\Exception\NotFoundException;
use App\Repository\TestRepository;
use Doctrine\ORM\EntityManagerInterface;

class TestService
{
    public function __construct(
        private TestRepository $testRepository,
        private EntityManagerInterface $em,
    ) {}

    public function getAll(): array
    {
        return $this->testRepository->findAll();
    }

    public function getOne(int $id): ?Test
    {
        $test = $this->testRepository->find($id);

        if (!$test) {
            throw new NotFoundException('Такого теста нет');
        }
        return $test;
    }

    public function getExpress(): array
    {
        $test = $this->testRepository->findAllExpress();

        if (!$test) {
            throw new NotFoundException();
        }

        return $test;
    }

    public function create(array $data): Test
    {
        $test = new Test();
        $test->setTitle($data['title']);
        $test->setQuestions($data['questions']);
        $test->setIsExpress($data['isExpress'] ?? false);

        $this->em->persist($test);
        $this->em->flush();

        return $test;
    }
}
