<?php

namespace App\Controller;

use App\Form\FiltreType;
use App\Form\SearchType;
use App\Entity\Categorie;
use App\Model\FiltreDonnee;
use App\Model\RechercheDonnee;
use App\Repository\BlogRepository;
use App\Repository\ListingRepository;
use App\Repository\CategorieRepository;
use App\Repository\PartenaireRepository;
use App\Repository\ActionnaireRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CategorieRepository $repoCat, ListingRepository $repoListing, PaginatorInterface $paginator, Request $request,ActionnaireRepository $repoAct, ListingRepository $repoList, BlogRepository $repoBlog, PartenaireRepository $repoPart): Response
    {
        $api_maps = $this->getParameter('API_MAPS');
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
        $filtreDonnees = new FiltreDonnee();
     
        $amnitiesForm = $this->createForm(FiltreType::class,$filtreDonnees);
        $form->handleRequest($request);
        $amnitiesForm->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
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

     #[Route('/change/locales/{locale}', name: 'change_locales')]
    public function change_locales($locale, Request $request): Response
    {
      
        $session = $request->getSession();
        $session->set('_locale', $locale);

      $request->setLocale($session->get('_locale'));
      

       

        return $this->redirect($request->headers->get('referer') ?: $this->generateUrl('app_home'));    }

   
}
