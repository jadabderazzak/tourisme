<?php

namespace App\Controller;

use App\Form\PensionType;
use App\Entity\TypePension;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TypePensionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
class PensionController extends AbstractController
{
    #[Route('/pension', name: 'app_pension')]
    public function index(TypePensionRepository $repoPension): Response
    {
        $pensions = $repoPension->findAll();
        return $this->render('pension/index.html.twig', [
            'pensions' => $pensions,
        ]);
    }

    #[Route('/pension/ajouter', name: 'app_pension_add')]
    public function add(Request $request, EntityManagerInterface $manager): Response
    {
        $pension = new TypePension();
        $form = $this->createForm(PensionType::class, $pension);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

           $pension = $form->getData();

          
         

           $manager->persist($pension);
           $manager->flush();
           $this->addFlash('success','Type de pension ajouté avec succès.');
           return $this->redirectToRoute('app_pension_add');

        }



      
        return $this->render('pension/add.html.twig', [
            'form' => $form->createView(),
            'action' => 1
        ]);
    }

    #[Route('/pension/modifier/{slug}', name: 'app_pension_update')]
    public function update(TypePension $pension,Request $request, EntityManagerInterface $manager): Response
    {
      
        $form = $this->createForm(PensionType::class, $pension);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

           $pension = $form->getData();
      

           $manager->persist($pension);
           $manager->flush();
           $this->addFlash('success','Type de pension modifié avec succès.');
           return $this->redirectToRoute('app_pension');

        }



      
        return $this->render('pension/add.html.twig', [
            'form' => $form->createView(),
            'action' => 2
        ]);
    }

}
