<?php

namespace App\Controller;

use DateTime;
use App\Entity\Listing;
use App\Entity\Reviews;
use App\Entity\Localite;
use App\Entity\Province;
use App\Form\FiltreType;
use App\Form\ReviewType;

use App\Form\SearchType;
use App\Entity\Categorie;
use App\Model\FiltreDonnee;
use App\Model\RechercheDonnee;
use App\Repository\TagsRepository;
use App\Repository\ListingRepository;
use App\Repository\ReviewsRepository;
use App\Repository\LocaliteRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    #[Route('/recherche', name: 'app_search')]
    public function index(CategorieRepository $repoCat,ListingRepository $repoListing, Request $request, PaginatorInterface $paginator): Response
    {

    
  
        $api_maps = $this->getParameter('API_MAPS');
        
        $listings1 = $repoListing->getActiveListings(0);
      
        $listings = $paginator->paginate($listings1, $request->query->getInt('page', 1), 20);  
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
            
            $listings = $paginator->paginate($resultats, $request->query->getInt('page', 1), 20); 
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
          
            $listings = $paginator->paginate($resultats, $request->query->getInt('page', 1), 20); 
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
        
        $listings = $paginator->paginate($resultats, $request->query->getInt('page', 1), 20); 
        if($form->isSubmitted() && $form->isValid())
        {
            $resultats = $repoListing->findBySearch($donnees,$filtreDonnees);
          
            $listings = $paginator->paginate($resultats, $request->query->getInt('page', 1), 20); 
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
         
           $listings = $paginator->paginate($resultats, $request->query->getInt('page', 1), 20); 
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
        
        $listings = $paginator->paginate($resultats, $request->query->getInt('page', 1), 20); 
        if($form->isSubmitted() && $form->isValid())
        {
            $resultats = $repoListing->findBySearch($donnees,$filtreDonnees);
          
            $listings = $paginator->paginate($resultats, $request->query->getInt('page', 1), 20); 
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
         
           $listings = $paginator->paginate($resultats, $request->query->getInt('page', 1), 20); 
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


    #[Route('/listing/{slug}', name: 'app_search_listing_show')]
    public function listingShow(Listing $listing, ReviewsRepository $repoRev, Request $request, CategorieRepository $repoCat,  EntityManagerInterface $manager, ListingRepository $repoListing, PaginatorInterface $paginator): Response
    {
       
        $api_maps = $this->getParameter('API_MAPS');
        $listings1 = $repoListing->getActiveListings(0);
        $listings = $paginator->paginate($listings1, $request->query->getInt('page', 1), 4);  
        $categories = $repoCat->findAll();
        $reviewslist = $repoRev->findBy(['listing' => $listing, 'calculer'=> 1],['id' => 'DESC'],5);
        $donnees = new RechercheDonnee();
        $filtreDonnees = new FiltreDonnee();
        $reviews = new Reviews();
        $form_review = $this->createForm(ReviewType::class, $reviews);
        $form = $this->createForm(SearchType::class, $donnees);
        $amnitiesForm = $this->createForm(FiltreType::class,$filtreDonnees);
        $form->handleRequest($request);
        $amnitiesForm->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() )
         {
            
            $resultats = $repoListing->findBySearch($donnees,$filtreDonnees);
          
            $listings = $paginator->paginate($resultats, $request->query->getInt('page', 1), 20); 
            $donnees->page = $request->query->getInt('page', 1);  
          
           
            return $this->render('search/index.html.twig', [
               
                'listings' => $listings,
                'donnees' => $donnees,
                'filtreDonnees' => $filtreDonnees,
                'form' => $form->createView(),
                'form_review' => $form_review->createView(),
                'amnitiesForm' => $amnitiesForm->createView(),
                'categories' => $categories,
                'api_maps' => $api_maps,
                'reviewslist' => $reviewslist
            ]);
         }

         if ( $amnitiesForm->isSubmitted() && $amnitiesForm->isValid() )
         {
         
            $resultats = $repoListing->findByFilter($filtreDonnees);
          
            $listings = $paginator->paginate($resultats, $request->query->getInt('page', 1), 20); 
            $donnees->page = $request->query->getInt('page', 1);  
          
            
            return $this->render('search/index.html.twig', [
               
                'listings' => $listings,
                'donnees' => $donnees,
                'filtreDonnees' => $filtreDonnees,
                'form' => $form->createView(),
                'amnitiesForm' => $amnitiesForm->createView(),
                'categories' => $categories,
                'form_review' => $form_review->createView(),
                'api_maps' => $api_maps,
                'reviewslist' => $reviewslist
            ]);
         }

         $form_review->handleRequest($request);
         if ($form_review->isSubmitted() && $form_review->isValid())
         {
            $stars = $request->get('stars') != ""  ? intval($request->get('stars')) : 0;
            $reviews = $form_review->getData();
            $reviews->setNote($stars);
            $reviews->setCreatedAt(new DateTime());
            $reviews->setCalculer(false);
            $reviews->setListing($listing);

            $manager->persist($reviews);
            $manager->flush();

            $this->addFlash('success', "Votre review a bien été pris en compte. Merci pour votre interaction.");
            return $this->redirectToRoute('app_search_listing_show',['slug' => $listing->getSlug()]);
           
         }
       
        return $this->render('search/show.html.twig', [
            'listing' => $listing,
            'api_maps' => $api_maps,
            'form_review' => $form_review->createView(),
            'form' => $form->createView(),
            'reviewslist' => $reviewslist
        ]);
    }
    

    #[Route('/search/query/{query}', name: 'home_search')]
    public function search(Request $request,  TagsRepository $repoTags, RequestStack $requestStack): Response
    {
        $locale = $requestStack->getCurrentRequest()->getLocale();
        $query = $request->get('query');

        $results = $repoTags->findResulByTags($query);  
        $formattedResults = [];

        $method = 'getNom'; // Valeur par défaut
        if ($locale === 'ar') {
            $method = 'getAr';
        } elseif ($locale === 'en') {
            $method = 'getEn';
        }

        foreach ($results as $result) {
            $name = $result->$method();
            $formattedResults[] = [
                'id' => $result->getId(),
                'name' => $name,
                
              
            ];
        }
        
        return $this->json(count($formattedResults) > 0 ? $formattedResults : null, 200);
    }



    #[Route('/recherche/province/{slug}', name: 'app_search_province')]
    public function province(Province $province, CategorieRepository $repoCat, ListingRepository $repoListing, PaginatorInterface $paginator, Request $request, ListingRepository $repoList): Response
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
        $donnees->ville = null;
        $form = $this->createForm(SearchType::class, $donnees);
        $filtreDonnees = new FiltreDonnee();
        $filtreDonnees->ville = null;

       
        $amnitiesForm = $this->createForm(FiltreType::class,$filtreDonnees);
        $form->handleRequest($request);
        $amnitiesForm->handleRequest($request);


        $resultats = $repoListing->findByProvince($donnees,$province,$filtreDonnees);
        
        $listings = $paginator->paginate($resultats, $request->query->getInt('page', 1), 20); 
        if($form->isSubmitted() && $form->isValid())
        {
            $resultats = $repoListing->findByProvince($donnees,$province,$filtreDonnees);
          
            $listings = $paginator->paginate($resultats, $request->query->getInt('page', 1), 20); 
            $donnees->page = $request->query->getInt('page', 1);  
          
            
            return $this->render('search/province.html.twig', [
               
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
         
           $listings = $paginator->paginate($resultats, $request->query->getInt('page', 1), 20); 
           $donnees->page = $request->query->getInt('page', 1);  
         
           
           return $this->render('search/province.html.twig', [
              
               'listings' => $listings,
               'donnees' => $donnees,
               'filtreDonnees' => $filtreDonnees,
               'form' => $form->createView(),
               'amnitiesForm' => $amnitiesForm->createView(),
               'categories' => $categories,
               'api_maps' => $api_maps
           ]);
        }

     
        return $this->render('search/province.html.twig', [
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
