<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    #[Route('/admin/users', name: 'admin_users', methods: 'GET')]
    public function index(): Response
    {
        return $this->render('users.html.twig');
    }
}

