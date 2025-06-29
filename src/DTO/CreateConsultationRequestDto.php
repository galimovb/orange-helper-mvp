<?php

namespace App\DTO;


use App\Enum\ConsultationType;
use Symfony\Component\Validator\Constraints as Assert;

class CreateConsultationRequestDto
{
    #[Assert\NotBlank]
    #[Assert\Choice(callback: [ConsultationType::class, 'cases'])]
    public ConsultationType $consultationType;

    #[Assert\NotBlank]
    #[Assert\Positive]
    public int $consultantId;

    #[Assert\NotBlank]
    #[Assert\Positive]
    public int $userId;

    #[Assert\NotBlank]
    #[Assert\DateTime(format: 'Y-m-d')]
    public string $requestDate;

    #[Assert\NotBlank]
    #[Assert\DateTime(format: 'H:i')]
    public string $requestTime;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    public string $childrenFullName;
}