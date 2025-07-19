<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/admin/login', name: 'admin_login', methods: 'GET')]
    public function index(): Response
    {
        return $this->render('login.html.twig');
    }

    #[Route('/admin/login/check', name: 'admin_login_check', methods: 'POST')]
    public function loginCheck(): Response
    {
        return $this->render('login.html.twig');
    }
}

