<?php

namespace App\Controller\admin;

use App\Service\JobRequestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/job-requests')]
class JobRequestsController extends AbstractController
{
    public function __construct(
        private JobRequestService $jobRequestService
    ) {
    }


    #[Route('', name: 'admin_job_requests_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $requests = $this->jobRequestService->getAllJobRequests();
        return $this->json($requests);
    }

    #[Route('/{id}/accept', name: 'admin_job_requests_accept', methods: ['POST'])]
    public function accept(int $id): JsonResponse
    {
        $result = $this->jobRequestService->changeStatus($id, 'ACCEPTED');
        return $this->json($result);
    }

    #[Route('/{id}/reject', name: 'admin_job_requests_reject', methods: ['POST'])]
    public function reject(int $id): JsonResponse
    {
        $result = $this->jobRequestService->changeStatus($id, 'REJECTED');
        return $this->json($result);
    }

    #[Route('/{id}', name: 'admin_job_requests_delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $result = $this->jobRequestService->deleteJobRequest($id);
        return $this->json($result);
    }
}