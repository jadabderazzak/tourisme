<?php

namespace App\Controller;

use App\Repository\BlogRepository;
use App\Repository\CategorieRepository;
use App\Repository\ListingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CategorieRepository $repoCat, ListingRepository $repoList, BlogRepository $repoBlog): Response
    {
        $categories = $repoCat->findAll();
        $listings = $repoList->getActiveListings(8);
        $blogs = $repoBlog->findBy([],['id' => 'DESC'],4);
        return $this->render('home/index.html.twig', [
            'categories' => $categories,
            'listings' => $listings,
            'blogs'=> $blogs
        ]);
    }
}
