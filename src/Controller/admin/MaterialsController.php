<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaterialsController extends AbstractController
{
    #[Route('/admin/materials', name: 'admin_materials', methods: 'GET')]
    public function index(): Response
    {
        return $this->render('materials.html.twig');
    }
}

