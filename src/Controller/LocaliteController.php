<?php

namespace App\Controller;

use App\Entity\Localite;
use App\Form\LocaliteType;
use App\Repository\LocaliteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[IsGranted('ROLE_ADMIN')]
class LocaliteController extends AbstractController
{
    #[Route('/localite', name: 'app_localite')]
    public function index(LocaliteRepository $repoLocalite): Response
    {
        
        $localites = $repoLocalite->findAll();
        return $this->render('localite/index.html.twig', [
            'localites' => $localites,
        ]);
    }

    #[Route('/localite/ajouter', name: 'app_localite_add')]
    public function add(Request $request, EntityManagerInterface $manager): Response
    {
        $localite = new Localite();
        $form = $this->createForm(LocaliteType::class, $localite);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

           $localite = $form->getData();

          
         

           $manager->persist($localite);
           $manager->flush();
           $this->addFlash('success','Localite ajoutée avec succès.');
           return $this->redirectToRoute('app_localite_add');

        }



      
        return $this->render('localite/add.html.twig', [
            'form' => $form->createView(),
            'action' => 1
        ]);
    }

    #[Route('/localite/modifier/{slug}', name: 'app_localite_update')]
    public function update(Localite $localite,Request $request, EntityManagerInterface $manager): Response
    {
      
        $form = $this->createForm(LocaliteType::class, $localite);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

           $localite = $form->getData();
      

           $manager->persist($localite);
           $manager->flush();
           $this->addFlash('success','Localite modifiée avec succès.');
           return $this->redirectToRoute('app_localite');

        }



      
        return $this->render('localite/add.html.twig', [
            'form' => $form->createView(),
            'action' => 2
        ]);
    }

    #[Route('/localite/supprimer/{slug}', name: 'app_localite_delete')]
    public function delete(Localite $localite, EntityManagerInterface $manager): Response
    {
       $manager->remove($localite);
       $manager->flush();
       $this->addFlash('success','Localité supprimée avec succès.');
       return $this->redirectToRoute('app_localite');
    }
}
