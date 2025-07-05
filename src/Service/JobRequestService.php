<?php

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
use App\Repository\JobRequestRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class JobRequestService
{
    public function __construct(
        private EntityManagerInterface $em,
        private JobRequestRepository $jobRequestRepository,
        private ValidatorInterface $validator
    ) {}


    public function createJobRequest(CreateJobRequestDto $dto): array
    {
        $errors = $this->validator->validate($dto);
        if (count($errors) > 0) {
            throw new ValidatorException((string) $errors);
        }

        $jobRequest = new JobRequest();
        $jobRequest->setFullName($dto->fullName);
        $jobRequest->setAge($dto->age);
        $jobRequest->setEducation($dto->education);
        $jobRequest->setWorkPlace($dto->workPlace);
        $jobRequest->setBeenWorkingYears($dto->beenWorkingYears);
        $jobRequest->setPhone($dto->phone);
        $jobRequest->setEmployeeSphera($dto->employeeSphera);

        $this->em->persist($jobRequest);
        $this->em->flush();

        return ['id' => $jobRequest->getId()];
    }

}