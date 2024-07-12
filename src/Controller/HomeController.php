<?php

namespace App\Controller;

use App\Repository\ActionnaireRepository;
use App\Repository\BlogRepository;
use App\Repository\CategorieRepository;
use App\Repository\ListingRepository;
use App\Repository\PartenaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CategorieRepository $repoCat, ActionnaireRepository $repoAct, ListingRepository $repoList, BlogRepository $repoBlog, PartenaireRepository $repoPart): Response
    {
        $categories = $repoCat->findAll();
        $listings = $repoList->getActiveListings(8);
        $partenaires = $repoPart->findAll();
        $actionnaires = $repoAct->findAll();
        $blogs = $repoBlog->findBy([],['id' => 'DESC'],4);
        return $this->render('home/index.html.twig', [
            'categories' => $categories,
            'listings' => $listings,
            'blogs'=> $blogs,
            'partenaires' => $partenaires,
            'actionnaires' => $actionnaires
        ]);
    }
}
