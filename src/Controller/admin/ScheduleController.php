<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScheduleController extends AbstractController
{
    #[Route('/admin/schedule', name: 'admin_schedule', methods: 'GET')]
    public function index(): Response
    {
        return $this->render('schedule.html.twig');
    }
}

