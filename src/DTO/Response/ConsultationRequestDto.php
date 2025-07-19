<?php

namespace App\DTO\Response;

use App\Entity\ConsultationRequest;

class ConsultationRequestDto
{
    public ?int $id;

    public ?int $userId;

    public ?int $consultantId;

    public ?string $childrenFullName;

    public ?string $status;

    public ?string $consultationType;

    public ?string $requestDate;

    public ?string $requestTime;

    public function __construct(ConsultationRequest $request)
    {
        $this->id = $request->getId();

        $this->userId = $request->getUser() ? $request->getUser()->getId() : null;

        $this->consultantId = $request->getConsultant() ? $request->getConsultant()->getId() : null;

        $this->childrenFullName = $request->getChildrenFullName();

        $this->status = $request->getStatus()->name ?? null;

        $this->consultationType = $request->getConsultationType()->name ?? null;

        $this->requestDate = $request->getRequestDate() ? $request->getRequestDate()->format('Y-m-d') : null;

        $this->requestTime = $request->getRequestTime() ? $request->getRequestTime()->format('H:i:s') : null;
    }
}
