<?php

// src/Service/ConsultationRequestService.php
namespace App\Service;

use App\DTO\CreateConsultationRequestDto;
use App\DTO\CreateJobRequestDto;
use App\DTO\UpdateConsultationRequestDto;
use App\Entity\ConsultationRequest;
use App\Entity\JobRequest;
use App\Exception\NotFoundException;
use App\Repository\ConsultationRepository;
use App\Repository\ConsultationRequestRepository;
use App\Repository\EmployeeRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ConsultationService
{
    public function __construct(
        private EntityManagerInterface $em,
        private ConsultationRepository $consultationRepo,
        private UserRepository $userRepo,
        private EmployeeRepository $employeeRepo,
        private ValidatorInterface $validator
    ) {}

    public function getAll(): array
    {
        return $this->consultationRepo->findAll();
    }

}