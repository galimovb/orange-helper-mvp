<?php

namespace App\Entity;

use App\Enum\ConsultationRequestStatus;
use App\Enum\ConsultationType;
use App\Repository\ConsultationRequestRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ORM\Entity(repositoryClass: ConsultationRequestRepository::class)]
class ConsultationRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[MaxDepth(1)]
    #[ORM\ManyToOne(inversedBy: 'consultationRequests')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[MaxDepth(1)]
    #[ORM\ManyToOne(inversedBy: 'consultationRequests')]
    private ?Employee $consultant = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $requestDate = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $requestTime = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $childrenFullName = null;

    #[ORM\Column(type: 'string', enumType: ConsultationRequestStatus::class)]
    private ConsultationRequestStatus $status = ConsultationRequestStatus::PENDING;

    #[ORM\Column(type: 'string', enumType: ConsultationType::class)]
    private ConsultationType $consultationType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;
        return $this;
    }

    public function getConsultant(): ?Employee
    {
        return $this->consultant;
    }

    public function setConsultant(?Employee $consultant): static
    {
        $this->consultant = $consultant;
        return $this;
    }

    public function getRequestDate(): ?\DateTimeInterface
    {
        return $this->requestDate;
    }

    public function setRequestDate(?\DateTimeInterface $requestDate): static
    {
        $this->requestDate = $requestDate;
        return $this;
    }

    public function getRequestTime(): ?\DateTimeInterface
    {
        return $this->requestTime;
    }

    public function setRequestTime(?\DateTimeInterface $requestTime): static
    {
        $this->requestTime = $requestTime;
        return $this;
    }

    public function getChildrenFullName(): ?string
    {
        return $this->childrenFullName;
    }

    public function setChildrenFullName(?string $childrenFullName): static
    {
        $this->childrenFullName = $childrenFullName;
        return $this;
    }

    public function getStatus(): ConsultationRequestStatus
    {
        return $this->status;
    }

    public function setStatus(ConsultationRequestStatus $status): static
    {
        $this->status = $status;
        return $this;
    }

    public function getConsultationType(): ConsultationType
    {
        return $this->consultationType;
    }

    public function setConsultationType(ConsultationType $consultationType): static
    {
        $this->consultationType = $consultationType;
        return $this;
    }

    // Дополнительный метод для удобства
    public function getCombinedDateTime(): ?\DateTimeInterface
    {
        if (!$this->requestDate || !$this->requestTime) {
            return null;
        }

        return \DateTime::createFromFormat(
            'Y-m-d H:i:s',
            $this->requestDate->format('Y-m-d') . ' ' . $this->requestTime->format('H:i:s')
        );
    }
}