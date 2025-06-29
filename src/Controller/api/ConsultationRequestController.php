<?php

namespace App\Controller\api;

use App\DTO\ConsultationRequestDto;
use App\DTO\CreateConsultationRequestDto;
use App\DTO\UpdateConsultationRequestDto;
use App\Service\ConsultationRequestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/api/consultation-requests')]
class ConsultationRequestController extends AbstractController
{
    public function __construct(
        private ConsultationRequestService $service
    )
    {
    }

    #[Route('', name: 'get_requests', methods: ['GET'])]
    public function list(
        /*#[MapRequestPayload] FilterConsultationRequestDto $filters,*/
    ): JsonResponse
    {
        $requests = $this->service->getAll();
        $mapped_requests = array_map(
            fn($request) => new ConsultationRequestDto($request),
            $requests
        );

        return $this->json($mapped_requests);
    }

    #[Route('', name: 'create_request', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] CreateConsultationRequestDto $dto,
    ): JsonResponse
    {
        $request = $this->service->createConsultationRequest($dto);
        return $this->json(new ConsultationRequestDto($request), Response::HTTP_CREATED);

    }

    #[Route('/{id}', name: 'update_request', methods: ['PATCH'])]
    public function update(
        int                                               $id,
        #[MapRequestPayload] UpdateConsultationRequestDto $dto,
    ): JsonResponse
    {
        $request = $this->service->updateRequest($id, $dto);
        return $this->json(new ConsultationRequestDto($request));

    }

    #[Route('/{id}', name: 'delete_request', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $this->service->deleteRequest($id);
        return $this->json(true, Response::HTTP_NO_CONTENT);
    }

}