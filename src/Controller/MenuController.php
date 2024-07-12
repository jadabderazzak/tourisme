<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'app_menu')]
    public function index(): Response
    {
        return $this->render('components/_menu.html.twig', []);
    }
    #[Route('/menu_admin', name: 'app_menu_admin')]
    public function admin(): Response
    {
        return $this->render('components/_menu_admin.html.twig', []);
    }
}
