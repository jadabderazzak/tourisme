<?php

namespace App\Controller;

use App\Entity\Localite;
use App\Form\FiltreType;
use App\Form\SearchType;
use App\Entity\Categorie;
use App\Model\FiltreDonnee;
use App\Model\RechercheDonnee;
use App\Repository\ListingRepository;

use App\Repository\LocaliteRepository;
use App\Repository\CategorieRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(CategorieRepository $repoCat,ListingRepository $repoListing, Request $request, PaginatorInterface $paginator): Response
    {

    
  
        $api_maps = $this->getParameter('API_MAPS');
        
        $listings1 = $repoListing->getActiveListings(0);
        $listings = $paginator->paginate($listings1, $request->query->getInt('page', 1), 4);  
        $categories = $repoCat->findAll();
        $donnees = new RechercheDonnee();
        $filtreDonnees = new FiltreDonnee();
        $form = $this->createForm(SearchType::class, $donnees);
        $amnitiesForm = $this->createForm(FiltreType::class,$filtreDonnees);
        $form->handleRequest($request);
        $amnitiesForm->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() )
         {
            
            $resultats = $repoListing->findBySearch($donnees,$filtreDonnees);
          
            $listings = $paginator->paginate($resultats, $request->query->getInt('page', 1), 4); 
            $donnees->page = $request->query->getInt('page', 1);  
          
            
            return $this->render('search/index.html.twig', [
               
                'listings' => $listings,
                'donnees' => $donnees,
                'filtreDonnees' => $filtreDonnees,
                'form' => $form->createView(),
                'amnitiesForm' => $amnitiesForm->createView(),
                'categories' => $categories,
                'api_maps' => $api_maps
            ]);
         }

         if ( $amnitiesForm->isSubmitted() && $amnitiesForm->isValid() )
         {
           
            $resultats = $repoListing->findByFilter($filtreDonnees);
          
            $listings = $paginator->paginate($resultats, $request->query->getInt('page', 1), 4); 
            $donnees->page = $request->query->getInt('page', 1);  
          
            
            return $this->render('search/index.html.twig', [
               
                'listings' => $listings,
                'donnees' => $donnees,
                'filtreDonnees' => $filtreDonnees,
                'form' => $form->createView(),
                'amnitiesForm' => $amnitiesForm->createView(),
                'categories' => $categories,
                'api_maps' => $api_maps
            ]);
         }
       
         
       
        return $this->render('search/index.html.twig', [
            'form' => $form->createView(),
            'listings' => $listings,
            'filtreDonnees' => $filtreDonnees,
            'donnees' => $donnees,
            'amnitiesForm' =>$amnitiesForm->createView(),
            'categories' => $categories,
            'api_maps' => $api_maps
        ]);
    }

    #[Route('/recherche/categorie/{slug}', name: 'app_search_categorie')]
    public function hotels(Categorie $categorie, CategorieRepository $repoCat, ListingRepository $repoListing, PaginatorInterface $paginator, Request $request, ListingRepository $repoList): Response
    {

        $api_maps = $this->getParameter('API_MAPS');
        $categories = $repoCat->findAll();
        $listings = [];
      
        $categories_name = [];
        foreach($categories as $cat )
        {
            $categories_name[] = mb_strtoupper($cat->getNom(), 'UTF-8');
        }
        $categories_names = json_encode( $categories_name, JSON_UNESCAPED_UNICODE);
      
       
       

        /**************** Form  */
        $donnees = new RechercheDonnee();
        $donnees->categorie = $categorie;
        $form = $this->createForm(SearchType::class, $donnees);
        $filtreDonnees = new FiltreDonnee();
        $filtreDonnees->categorie = $categorie;

       
        $amnitiesForm = $this->createForm(FiltreType::class,$filtreDonnees);
        $form->handleRequest($request);
        $amnitiesForm->handleRequest($request);


        $resultats = $repoListing->findBySearch($donnees,$filtreDonnees);
        $listings = $paginator->paginate($resultats, $request->query->getInt('page', 1), 4); 
        if($form->isSubmitted() && $form->isValid())
        {
            $resultats = $repoListing->findBySearch($donnees,$filtreDonnees);
          
            $listings = $paginator->paginate($resultats, $request->query->getInt('page', 1), 4); 
            $donnees->page = $request->query->getInt('page', 1);  
          
            
            return $this->render('search/categorie.html.twig', [
               
                'listings' => $listings,
                'donnees' => $donnees,
                'filtreDonnees' => $filtreDonnees,
                'form' => $form->createView(),
                'amnitiesForm' => $amnitiesForm->createView(),
                'categories' => $categories,
                'api_maps' => $api_maps
            ]);
        }
        if (  $amnitiesForm->isSubmitted() && $amnitiesForm->isValid() )
        {
          
           $resultats = $repoListing->findByFilter($filtreDonnees);
         
           $listings = $paginator->paginate($resultats, $request->query->getInt('page', 1), 4); 
           $donnees->page = $request->query->getInt('page', 1);  
         
           
           return $this->render('search/categorie.html.twig', [
              
               'listings' => $listings,
               'donnees' => $donnees,
               'filtreDonnees' => $filtreDonnees,
               'form' => $form->createView(),
               'amnitiesForm' => $amnitiesForm->createView(),
               'categories' => $categories,
               'api_maps' => $api_maps
           ]);
        }

     
        return $this->render('search/categorie.html.twig', [
            'listings' => $listings,
               'donnees' => $donnees,
               'filtreDonnees' => $filtreDonnees,
               'form' => $form->createView(),
               'amnitiesForm' => $amnitiesForm->createView(),
               'categories' => $categories,
               'api_maps' => $api_maps
        ]);
    }
   

    #[Route('/recherche/localite/{slug}', name: 'app_search_localite')]
    public function localite(Localite $localite, CategorieRepository $repoCat, ListingRepository $repoListing, PaginatorInterface $paginator, Request $request, ListingRepository $repoList): Response
    {

        $api_maps = $this->getParameter('API_MAPS');
        $categories = $repoCat->findAll();
        $listings = [];
      
        $categories_name = [];
        foreach($categories as $cat )
        {
            $categories_name[] = mb_strtoupper($cat->getNom(), 'UTF-8');
        }
       
      
       
       

        /**************** Form  */
        $donnees = new RechercheDonnee();
        $donnees->ville = $localite;
        $form = $this->createForm(SearchType::class, $donnees);
        $filtreDonnees = new FiltreDonnee();
        $filtreDonnees->ville = $localite;

       
        $amnitiesForm = $this->createForm(FiltreType::class,$filtreDonnees);
        $form->handleRequest($request);
        $amnitiesForm->handleRequest($request);


        $resultats = $repoListing->findBySearch($donnees,$filtreDonnees);
        $listings = $paginator->paginate($resultats, $request->query->getInt('page', 1), 4); 
        if($form->isSubmitted() && $form->isValid())
        {
            $resultats = $repoListing->findBySearch($donnees,$filtreDonnees);
          
            $listings = $paginator->paginate($resultats, $request->query->getInt('page', 1), 4); 
            $donnees->page = $request->query->getInt('page', 1);  
          
            
            return $this->render('search/ville.html.twig', [
               
                'listings' => $listings,
                'donnees' => $donnees,
                'filtreDonnees' => $filtreDonnees,
                'form' => $form->createView(),
                'amnitiesForm' => $amnitiesForm->createView(),
                'categories' => $categories,
                'api_maps' => $api_maps
            ]);
        }
        if (  $amnitiesForm->isSubmitted() && $amnitiesForm->isValid() )
        {
          
           $resultats = $repoListing->findByFilter($filtreDonnees);
         
           $listings = $paginator->paginate($resultats, $request->query->getInt('page', 1), 4); 
           $donnees->page = $request->query->getInt('page', 1);  
         
           
           return $this->render('search/ville.html.twig', [
              
               'listings' => $listings,
               'donnees' => $donnees,
               'filtreDonnees' => $filtreDonnees,
               'form' => $form->createView(),
               'amnitiesForm' => $amnitiesForm->createView(),
               'categories' => $categories,
               'api_maps' => $api_maps
           ]);
        }

     
        return $this->render('search/ville.html.twig', [
            'listings' => $listings,
               'donnees' => $donnees,
               'filtreDonnees' => $filtreDonnees,
               'form' => $form->createView(),
               'amnitiesForm' => $amnitiesForm->createView(),
               'categories' => $categories,
               'api_maps' => $api_maps
        ]);
    }
    


  

   
}
