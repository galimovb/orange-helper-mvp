<?php

namespace App\Controller\api;

use App\Service\ConsultationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/api/consultations')]
class ConsultationController extends AbstractController
{

    public function __construct(
        private ConsultationService $service,
        private Security $security,
    )
    {
    }

    #[Route('', name: 'get_consultations', methods: ['GET'])]
    public function consultations():JsonResponse
    {
        $user = $this->security->getUser();
        $consultations = $this->service->getAllForUser($user);

        return $this->json($consultations);
    }
}