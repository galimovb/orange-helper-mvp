<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TestResultRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestResultRepository::class)]
#[ApiResource]
class TestResult
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    private int $userId;

    #[ORM\Column(type: 'integer')]
    private int $testId;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $takenAt;

    #[ORM\Column(type: 'integer')]
    private int $totalScore;

    // Здесь храним массив ответов правильный/неправильный вида [0 => true, 1 => false, 2 => true, ...]
    #[ORM\Column(type: 'json')]
    private array $answers = [];


    public function __construct()
    {
        $this->takenAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }


    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getTestId(): int
    {
        return $this->testId;
    }

    public function setTestId(int $testId): void
    {
        $this->testId = $testId;
    }

    public function getTakenAt(): \DateTimeInterface
    {
        return $this->takenAt;
    }

    public function setTakenAt(\DateTimeInterface $takenAt): void
    {
        $this->takenAt = $takenAt;
    }

    public function getTotalScore(): int
    {
        return $this->totalScore;
    }

    public function setTotalScore(int $totalScore): void
    {
        $this->totalScore = $totalScore;
    }

    public function getAnswers(): array
    {
        return $this->answers;
    }

    public function setAnswers(array $answers): void
    {
        $this->answers = $answers;
    }


}
