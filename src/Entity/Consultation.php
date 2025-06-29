<?php

namespace App\Entity;

use App\Enum\ConsultationStatus;
use App\Enum\ConsultationType;
use App\Repository\ConsultationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConsultationRepository::class)]
class Consultation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'string', enumType: ConsultationType::class)]
    private ConsultationType $consultationType;

    #[ORM\Column]
    private bool $isPaid = false;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\ManyToOne(targetEntity: Employee::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employee $consultant = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $client = null;

    #[ORM\Column(type: 'string', enumType: ConsultationStatus::class)]
    private ConsultationStatus $status = ConsultationStatus::SCHEDULED;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $consultationDate = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $consultationTime = null;

    #[ORM\Column(options: ["default" => "CURRENT_TIMESTAMP"])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\OneToOne(targetEntity: ConsultationRequest::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?ConsultationRequest $sourceRequest = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

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

    public function isPaid(): ?bool
    {
        return $this->isPaid;
    }

    public function setIsPaid(bool $isPaid): static
    {
        $this->isPaid = $isPaid;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getConsultationDate(): ?\DateTimeInterface
    {
        return $this->consultationDate;
    }

    public function setConsultationDate(?\DateTimeInterface $consultationDate): static
    {
        $this->consultationDate = $consultationDate;
        return $this;
    }

    public function getConsultationTime(): ?\DateTimeInterface
    {
        return $this->consultationTime;
    }

    public function setConsultationTime(?\DateTimeInterface $consultationTime): static
    {
        $this->consultationTime = $consultationTime;
        return $this;
    }

    public function getCombinedDateTime(): ?\DateTimeInterface
    {
        if (!$this->consultationDate || !$this->consultationTime) {
            return null;
        }

        return \DateTime::createFromFormat(
            'Y-m-d H:i:s',
            $this->consultationDate->format('Y-m-d') . ' ' . $this->consultationTime->format('H:i:s')
        );
    }

    public function getStatus(): ConsultationStatus
    {
        return $this->status;
    }

    public function setStatus(ConsultationStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

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

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): static
    {
        $this->client = $client;
        return $this;
    }

    public function getSourceRequest(): ?ConsultationRequest
    {
        return $this->sourceRequest;
    }

    public function setSourceRequest(?ConsultationRequest $sourceRequest): static
    {
        $this->sourceRequest = $sourceRequest;
        return $this;
    }

}
