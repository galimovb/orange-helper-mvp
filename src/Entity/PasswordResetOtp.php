<?php

namespace App\Entity;

use App\Repository\PasswordResetOtpRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PasswordResetOtpRepository::class)]
class PasswordResetOtp
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 6)]
    private ?string $code = null;

    #[ORM\Column(length: 180)]
    private ?string $phone = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $expiresAt = null;

    public function __construct(string $phone, string $code, int $expiresInMinutes = 5)
    {
        $this->phone = $phone;
        $this->code = $code;
        $this->expiresAt = new \DateTime("+{$expiresInMinutes} minutes");
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getExpiresAt(): ?\DateTimeImmutable
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(\DateTimeImmutable $expiresAt): static
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }
}
