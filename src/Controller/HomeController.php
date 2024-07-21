<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Model\RechercheDonnee;
use App\Repository\BlogRepository;
use App\Repository\ListingRepository;
use App\Repository\CategorieRepository;
use App\Repository\PartenaireRepository;
use App\Repository\ActionnaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CategorieRepository $repoCat, Request $request,ActionnaireRepository $repoAct, ListingRepository $repoList, BlogRepository $repoBlog, PartenaireRepository $repoPart): Response
    {
        $categories = $repoCat->findAll();
        $listings = $repoList->getActiveListings(8);
        $partenaires = $repoPart->findAll();
        $actionnaires = $repoAct->findAll();
        $categories_name = [];
        foreach($categories as $cat )
        {
            $categories_name[] = mb_strtoupper($cat->getNom(), 'UTF-8');
        }
        $categories_names = json_encode( $categories_name, JSON_UNESCAPED_UNICODE);
      
       
        $blogs = $repoBlog->findBy([],['id' => 'DESC'],4);

        /**************** Form  */
        $donnees = new RechercheDonnee();
        $form = $this->createForm(SearchType::class, $donnees);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            return $this->redirectToRoute('app_search');
        }
        return $this->render('home/index.html.twig', [
            'categories' => $categories,
            'listings' => $listings,
            'blogs'=> $blogs,
            'partenaires' => $partenaires,
            'actionnaires' => $actionnaires,
            'categories_name' => $categories_names,
            'form' => $form->createView()
        ]);
    }

    #[Route('/', name: 'app_home_1')]
    public function home1(CategorieRepository $repoCat, ActionnaireRepository $repoAct, ListingRepository $repoList, BlogRepository $repoBlog, PartenaireRepository $repoPart): Response
    {
        $categories = $repoCat->findAll();
        $listings = $repoList->getActiveListings(8);
        $partenaires = $repoPart->findAll();
        $actionnaires = $repoAct->findAll();
        $categories_name = [];
        foreach($categories as $cat )
        {
            $categories_name[] = mb_strtoupper($cat->getNom(), 'UTF-8');
        }
        $categories_names = json_encode( $categories_name, JSON_UNESCAPED_UNICODE);
      
       
        $blogs = $repoBlog->findBy([],['id' => 'DESC'],4);
        return $this->render('home/home1.html.twig', [
            'categories' => $categories,
            'listings' => $listings,
            'blogs'=> $blogs,
            'partenaires' => $partenaires,
            'actionnaires' => $actionnaires,
            'categories_name' => $categories_names
        ]);
    }

    #[Route('/', name: 'app_home_2')]
    public function home2(CategorieRepository $repoCat, ActionnaireRepository $repoAct, ListingRepository $repoList, BlogRepository $repoBlog, PartenaireRepository $repoPart): Response
    {
        $categories = $repoCat->findAll();
        $listings = $repoList->getActiveListings(8);
        $partenaires = $repoPart->findAll();
        $actionnaires = $repoAct->findAll();
        $categories_name = [];
        foreach($categories as $cat )
        {
            $categories_name[] = mb_strtoupper($cat->getNom(), 'UTF-8');
        }
        $categories_names = json_encode( $categories_name, JSON_UNESCAPED_UNICODE);
      
       
        $blogs = $repoBlog->findBy([],['id' => 'DESC'],4);
        return $this->render('home/home2.html.twig', [
            'categories' => $categories,
            'listings' => $listings,
            'blogs'=> $blogs,
            'partenaires' => $partenaires,
            'actionnaires' => $actionnaires,
            'categories_name' => $categories_names
        ]);
    }
}
