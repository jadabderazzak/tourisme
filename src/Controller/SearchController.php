<?php

namespace App\Controller;

use App\Form\FiltreType;
use App\Form\SearchType;
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

         if (  $amnitiesForm->isSubmitted() && $amnitiesForm->isValid() )
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

   
    // #[Route('/search', name: 'app_search')]
    // public function index(CategorieRepository $repoCat, ListingRepository $repoListing, Request $request, PaginatorInterface $paginator): Response
    // {
    //     $api_maps = $this->getParameter('API_MAPS');
    //     $categories = $repoCat->findAll();
    
    //     // Créer les objets de données
    //     $donnees = new RechercheDonnee();
    //     $filtreDonnees = new FiltreDonnee();
    
    //     // Créer les formulaires
    //     $form = $this->createForm(SearchType::class, $donnees);
    //     $amnitiesForm = $this->createForm(FiltreType::class, $filtreDonnees);
    
    //     // Manipuler les requêtes des formulaires
    //     $form->handleRequest($request);
    //     $amnitiesForm->handleRequest($request);
    
    //     // Préparer les données pour les formulaires
    //     $queryParams = $request->query->all();
    
    //     // Charger les données du premier formulaire (recherche)
    //     if (isset($queryParams['search'])) {
    //         $searchParams = $queryParams['search'];
    //         if (isset($searchParams['mot'])) {
    //             $donnees->mot = $searchParams['mot'];
    //         }
    //         if (isset($searchParams['categorie'])) {
    //             $categorie = $repoCat->find($searchParams['categorie']);
    //             $donnees->categorie = $categorie;
    //         }
    //         if (isset($searchParams['ville'])) {
    //             $ville = $repoListing->find($searchParams['ville']);
    //             $donnees->ville = $ville;
    //         }
    
    //         // Copier les données du premier formulaire au deuxième
    //         $filtreDonnees->mot = $donnees->mot;
    //         $filtreDonnees->categorie = $donnees->categorie;
    //         $filtreDonnees->ville = $donnees->ville;
            
    //     }
    
    //     // Charger les données depuis la requête pour les filtres
    //     if (isset($queryParams['filtre']['amnities']) && is_array($queryParams['filtre']['amnities'])) {
    //         $amnities = $repoListing->findBy([
    //             'id' => $queryParams['filtre']['amnities']
    //         ]);
    //         $filtreDonnees->amnities = $amnities;
    //     }
    
    //     // Traiter les données combinées dans findBySearch
    //     $resultats = $repoListing->findBySearch($donnees, $filtreDonnees);
    
    //     $listings = $paginator->paginate(
    //         $resultats,
    //         $request->query->getInt('page', 1),
    //         4 // Nombre d'éléments par page
    //     );
    
    //     // Passer les données au template
    //     return $this->render('search/index.html.twig', [
    //         'listings' => $listings,
    //         'form' => $form->createView(),
    //         'amnitiesForm' => $amnitiesForm->createView(),
    //         'categories' => $categories,
    //         'api_maps' => $api_maps,
    //     ]);
    // }
    


  

   
}
