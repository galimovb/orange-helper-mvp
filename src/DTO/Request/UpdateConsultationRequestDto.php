<?php

namespace App\DTO\Request;

use App\Enum\ConsultationRequestStatus;
use App\Enum\ConsultationType;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateConsultationRequestDto
{
    #[Assert\Choice(callback: [ConsultationRequestStatus::class, 'cases'])]
    public ?ConsultationRequestStatus $status = null;

    #[Assert\Choice(callback: [ConsultationType::class, 'cases'])]
    public ?ConsultationType $consultationType = null;

    #[Assert\DateTime(format: 'Y-m-d')]
    public ?string $requestDate = null;

    #[Assert\DateTime(format: 'H:i')]
    public ?string $requestTime = null;
}