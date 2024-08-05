<?php

namespace App\Controller;

use App\Repository\ListingRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
class BoardController extends AbstractController
{
    #[Route('/board', name: 'app_board')]
    public function index(ListingRepository $repoListing, CategorieRepository $repoCat): Response
    {
        $categories_number = null;
        $categories = $repoCat->findAll();
        $i = 0;
        foreach ($categories as $category) {
            $cat = $repoListing->count([
                'categorie' => $category
            ]);
            $categories_number[$category->getNom()] = $cat;

            $i++;
        }
     
        $newData = [];
        foreach ($categories_number as $key => $value) {
            $newData[] = [
                'name' => $key,
                'data' => [
                    [
                        'x' => $key, 
                        'y' => $value
                    ]
                ]
            ];
        }
        $jsonData = json_encode($newData);

        /******************** Gestion du nombre de lit chambre ... par detstination */
        $generale = $repoListing->getInfoGenerals();
        
        $newArray = [];

        foreach ($generale as $item) {
            $name = $item['nom'];
            $data = [
                'x' => $name, // Exemple : Prenez les trois premières lettres du nom comme x
                'y' => $item['nb_listing']
            ];

            $newArray[] = [
                'name' => $name,
                'data' => [$data]
            ];
        }

        $jsonArray = json_encode($newArray);
        /*********************** Gestion des infos génerale par ville par catégorie */
        $generalecategory = $repoListing->getInfoGeneralCategory();
        return $this->render('board/index.html.twig', [
            'categories_number' => $categories_number,
            'json' => $jsonData,
            'infogeneralejson' => $jsonArray,
            'infogenerale' => $generale,
            'infogeneralecategorie' => $generalecategory,
        ]);
    }
}
