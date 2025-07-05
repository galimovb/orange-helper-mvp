<?php

namespace App\Service;

use App\Enum\EmployeeSphera;
use App\Repository\EmployeeRepository;

class EmployeeService
{
    public function __construct(
        private EmployeeRepository $employeeRepository
    ) {}

    public function getAllEmployeesGroupedBySphere(): array
    {
        $employees = $this->employeeRepository->findAll();
        $result = [
            'teachers' => [],    // Для PEDAGOGY
            'psychologists' => [] // Для PSYCHOLOGY
        ];

        foreach ($employees as $employee) {
            $employeeData = [
                'fullName' => sprintf('%s %s %s',
                    $employee->getLastName(),
                    $employee->getFirstName(),
                    $employee->getSecondName()),
                'age' => $employee->getAge(),
                'experience' => $employee->getExperience(),
                'education' => $employee->getEducation(),
                'specialization' => $employee->getCualification(),
                'rating' => '5,0',
                'avatar' => '/img/none-photo.png'
            ];

            // Используем строгое сравнение с enum-значениями
            if ($employee->getEmployeeSphera() === EmployeeSphera::PEDAGOGY) {
                $result['teachers'][] = $employeeData;
            } elseif ($employee->getEmployeeSphera() === EmployeeSphera::PSYCHOLOGY) {
                $result['psychologists'][] = $employeeData;
            }
        }

        return $result;
    }

}