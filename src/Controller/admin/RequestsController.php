<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RequestsController extends AbstractController
{
    #[Route('/admin/requests', name: 'admin_requests', methods: 'GET')]
    public function index(): Response
    {
        return $this->render('requests.html.twig');
    }
}

