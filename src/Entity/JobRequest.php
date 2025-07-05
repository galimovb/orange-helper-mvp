<?php

namespace App\Entity;

use App\Enum\EmployeeSphera;
use App\Enum\JobRequestStatus;
use App\Repository\JobRequestRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobRequestRepository::class)]
class JobRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $fullName = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(length: 255)]
    private ?string $education = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $workPlace = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $beenWorkingYears = null;

    #[ORM\Column(type: 'string', nullable: true, enumType: EmployeeSphera::class)]
    private EmployeeSphera $employeeSphera;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(type: 'string', enumType: JobRequestStatus::class)]
    private JobRequestStatus $status = JobRequestStatus::NEW;

    public function getStatus(): JobRequestStatus
    {
        return $this->status;
    }

    public function setStatus(JobRequestStatus $status): void
    {
        $this->status = $status;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function getEmployeeSphera(): EmployeeSphera
    {
        return $this->employeeSphera;
    }

    public function setEmployeeSphera(EmployeeSphera $employeeSphera): void
    {
        $this->employeeSphera = $employeeSphera;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): static
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getEducation(): ?string
    {
        return $this->education;
    }

    public function setEducation(string $education): static
    {
        $this->education = $education;

        return $this;
    }

    public function getWorkPlace(): ?string
    {
        return $this->workPlace;
    }

    public function setWorkPlace(?string $workPlace): static
    {
        $this->workPlace = $workPlace;

        return $this;
    }

    public function getBeenWorkingYears(): ?string
    {
        return $this->beenWorkingYears;
    }

    public function setBeenWorkingYears(?string $beenWorkingYears): static
    {
        $this->beenWorkingYears = $beenWorkingYears;

        return $this;
    }
}
