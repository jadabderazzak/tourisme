<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\ProvinceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'app_menu')]
    public function index(CategorieRepository $repoCat, ProvinceRepository $repoProvince): Response
    {
        $categories = $repoCat->findAll();
        $provinces = $repoProvince->findAll();
        return $this->render('components/_menu1.html.twig', [
            'categories' => $categories,
            'provinces' => $provinces
        ]);
    }
    #[Route('/menu_admin', name: 'app_menu_admin')]
    public function admin(): Response
    {
        return $this->render('components/_menu_admin.html.twig', []);
    }
}
