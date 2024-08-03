<?php

namespace App\Controller;

use App\Form\CattagsType;
use App\Entity\Categorytags;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CategorytagsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
class CategorytagsController extends AbstractController
{
    #[Route('/categorytags', name: 'app_categorytags')]
    public function index(CategorytagsRepository $repoCat): Response
    {
        $cattags = $repoCat->findAll();
        return $this->render('categorytags/index.html.twig', [
            'cattags' => $cattags,
        ]);
    }

    #[Route('/categorytags/ajouter', name: 'app_categorytags_add')]
    public function add(Request $request, EntityManagerInterface $manager): Response
    {
       
        $cattag = new Categorytags();
        $form = $this->createForm(CattagsType::class, $cattag);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
          
           $cattag = $form->getData();
          
          
           $manager->persist($cattag);
           $manager->flush();
           $this->addFlash('success','Catégorie tag ajoutée avec succès.');
           return $this->redirectToRoute('app_categorytags_add');

        }



      
        return $this->render('categorytags/add.html.twig', [
            'form' => $form->createView(),
            'action' => 1
        ]);
    }

    #[Route('/categorytags/modifier/{slug}', name: 'app_categorytags_update')]
    public function update(Categorytags $cattag, Request $request, EntityManagerInterface $manager): Response
    {
       
       
        $form = $this->createForm(CattagsType::class, $cattag);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
          
           $cattag = $form->getData();
          
          
           $manager->persist($cattag);
           $manager->flush();
           $this->addFlash('success','Catégorie tag modifiée avec succès.');
           return $this->redirectToRoute('app_categorytags');

        }



      
        return $this->render('categorytags/add.html.twig', [
            'form' => $form->createView(),
            'action' => 2
        ]);
    }
}
