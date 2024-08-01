<?php

namespace App\Controller;

use App\Entity\Amnities;
use App\Form\AmnitiesType;
use App\Repository\AmnitiesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
class AmnitiesController extends AbstractController
{
    #[Route('/amnities', name: 'app_amnities')]
    public function index(AmnitiesRepository $repoAmni): Response
    {
        $amnities = $repoAmni->findAll();
        return $this->render('amnities/index.html.twig', [
            'amnities' => $amnities,
        ]);
    }

    #[Route('/amnities/ajouter', name: 'app_amnities_add')]
    public function add(Request $request, EntityManagerInterface $manager): Response
    {
       
        $amnitie = new Amnities();
        $form = $this->createForm(AmnitiesType::class, $amnitie);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
          
           $actionamnitienaire = $form->getData();
          
          
           $manager->persist($amnitie);
           $manager->flush();
           $this->addFlash('success','Equipement ajouté avec succès.');
           return $this->redirectToRoute('app_amnities_add');

        }



      
        return $this->render('amnities/add.html.twig', [
            'form' => $form->createView(),
            'action' => 1
        ]);
    }

    #[Route('/amnities/modifier/{slug}', name: 'app_amnities_update')]
    public function update(Amnities $amnitie, Request $request, EntityManagerInterface $manager): Response
    {
       
      
        $form = $this->createForm(AmnitiesType::class, $amnitie);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
          
           $actionamnitienaire = $form->getData();
          
          
           $manager->persist($amnitie);
           $manager->flush();
           $this->addFlash('success','Equipement modifié avec succès.');
           return $this->redirectToRoute('app_amnities');

        }



      
        return $this->render('amnities/add.html.twig', [
            'form' => $form->createView(),
            'action' => 2
        ]);
    }
}
