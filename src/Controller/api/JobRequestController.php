<?php

namespace App\Controller\api;

use App\DTO\CreateJobRequestDto;
use App\Service\JobRequestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/api/job/request')]
class JobRequestController extends AbstractController
{

    public function __construct(
        private JobRequestService $service,
    )
    {
    }

    #[Route('', name: 'create_job_request', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] CreateJobRequestDto $dto
    ):JsonResponse
    {
        $request = $this->service->createJobRequest($dto);

        return $this->json($request);
    }
}