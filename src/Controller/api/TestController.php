<?php

namespace App\Controller\api;

use App\Service\TestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/tests')]
class TestController extends AbstractController
{
    public function __construct(private TestService $testService) {}

    #[Route('', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $tests = $this->testService->getAll();
        return $this->json($tests);
    }

    #[Route('/express', methods: ['GET'])]
    public function express(): JsonResponse
    {
        $tests = $this->testService->getExpress();
        return $this->json($tests);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $test = $this->testService->getOne($id);

        return $this->json($test);
    }

    #[Route('', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $test = $this->testService->create($data);
        return $this->json($test, 201);
    }
}
