<?php

namespace App\Controller\api;

use App\Service\EmployeeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/employees')]
class EmployeeController extends AbstractController
{
    public function __construct(
        private EmployeeService $service
    ) {}

    #[Route('', name: 'get_employees', methods: ['GET'])]
    public function getEmployees(): JsonResponse
    {
        $employees = $this->service->getAllEmployeesGroupedBySphere();

        return $this->json($employees);
    }
}