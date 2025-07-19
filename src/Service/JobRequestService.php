<?php

namespace App\Service;

use App\Entity\JobRequest;
use App\Enum\JobRequestStatus;
use App\Exception\NotFoundException;
use App\Repository\JobRequestRepository;
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

    public function getAllJobRequests(): array
    {
        $requests = $this->jobRequestRepository->findBy([], ['id' => 'DESC']);

        return array_map(function(JobRequest $request) {
            return [
                'id' => $request->getId(),
                'fullName' => $request->getFullName(),
                'phone' => $request->getPhone(),
                'status' => $request->getStatus()->value,
                'statusLabel' => $request->getStatus()->getLabel(),
            ];
        }, $requests);
    }

    public function changeStatus(int $id, string $status): array
    {
        $jobRequest = $this->jobRequestRepository->find($id);
        if (!$jobRequest) {
            throw new NotFoundException('Такой заявки нет');
        }

        $jobRequest->setStatus(JobRequestStatus::from($status));
        $this->em->flush();

        return [
            'success' => true,
            'message' => $status === 'ACCEPTED' ? 'Заявка принята' : 'Заявка отклонена',
            'newStatus' => $jobRequest->getStatus()->value
        ];
    }

    public function deleteJobRequest(int $id): array
    {
        $jobRequest = $this->jobRequestRepository->find($id);
        if (!$jobRequest) {
            throw new NotFoundException('Такой заявки нет');
        }

        $this->em->remove($jobRequest);
        $this->em->flush();

        return [
            'success' => true,
            'message' => 'Заявка удалена'
        ];
    }

    public function createJobRequest(array $data): array
    {
        $jobRequest = new JobRequest();
        $jobRequest->setFullName($data['fullName']);
        $jobRequest->setAge($data['age']);
        $jobRequest->setEducation($data['education']);
        $jobRequest->setPhone($data['phone']);
        $jobRequest->setStatus(JobRequestStatus::NEW);

        if (isset($data['workPlace'])) {
            $jobRequest->setWorkPlace($data['workPlace']);
        }

        if (isset($data['beenWorkingYears'])) {
            $jobRequest->setBeenWorkingYears($data['beenWorkingYears']);
        }

        if (isset($data['employeeSphera'])) {
            $jobRequest->setEmployeeSphera($data['employeeSphera']);
        }

        $errors = $this->validator->validate($jobRequest);
        if (count($errors) > 0) {
            throw new ValidatorException((string) $errors);
        }

        $this->em->persist($jobRequest);
        $this->em->flush();

        return ['id' => $jobRequest->getId()];
    }
}