<?php

// src/Service/ConsultationRequestService.php
namespace App\Service;

use App\DTO\CreateConsultationRequestDto;
use App\DTO\UpdateConsultationRequestDto;
use App\Entity\ConsultationRequest;
use App\Exception\NotFoundException;
use App\Repository\ConsultationRequestRepository;
use App\Repository\EmployeeRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ConsultationRequestService
{
    public function __construct(
        private EntityManagerInterface $em,
        private ConsultationRequestRepository $consultationRequestRepo,
        private UserRepository $userRepo,
        private EmployeeRepository $employeeRepo,
        private ValidatorInterface $validator
    ) {}

    /**
     * @throws \Exception
     */
    public function createConsultationRequest(CreateConsultationRequestDto $dto): ConsultationRequest
    {
        $user = $this->userRepo->find($dto->userId);
        if (!$user) {
            throw new NotFoundException('Такого пользователя нет');
        }

        $consultant = $this->employeeRepo->find($dto->consultantId);
        if (!$consultant) {
            throw new NotFoundException('Такого консультанта нет');
        }

        $violations = $this->validator->validate($dto);
        if (count($violations) > 0) {
            $errors = [];

            foreach ($violations as $violation) {
                $errors[$violation->getPropertyPath()][] = $violation->getMessage();
            }

            throw new ValidatorException($errors);
        }

        $request = new ConsultationRequest();
        $request->setConsultationType($dto->consultationType);
        $request->setConsultant($consultant);
        $request->setRequestDate(new \DateTime($dto->requestDate));
        $request->setRequestTime(new \DateTime($dto->requestTime));
        $request->setChildrenFullName($dto->childrenFullName);
        $request->setUser($user);

        $this->em->persist($request);
        $this->em->flush();

        return $request;
    }

    public function updateRequest(int $id, UpdateConsultationRequestDto $dto): ConsultationRequest
    {
        $request = $this->consultationRequestRepo->find($id);
        if (!$request) {
            throw new NotFoundException('Такой записи на консультацию нет');
        }

        if ($dto->status) {
            $request->setStatus($dto->status);
        }

        if ($dto->consultationType) {
            $request->setConsultationType($dto->consultationType);
        }

        if ($dto->requestDate) {
            $request->setRequestDate(new \DateTime($dto->requestDate));
        }

        if ($dto->requestTime) {
            $request->setRequestTime(new \DateTime($dto->requestTime));
        }

        $this->em->flush();

        return $request;
    }

    public function deleteRequest(int $id): void
    {
        $request = $this->consultationRequestRepo->find($id);
        if (!$request) {
            throw new NotFoundException('Такой записи на консультацию нет');
        }

        $this->em->remove($request);
        $this->em->flush();
    }

    public function getAll(): array
    {
        return $this->consultationRequestRepo->findAll();
    }

}