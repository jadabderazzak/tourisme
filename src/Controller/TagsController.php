<?php

namespace App\Controller;

use App\Entity\Tags;
use App\Form\TagsType;
use App\Repository\TagsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
class TagsController extends AbstractController
{
    #[Route('/tags', name: 'app_tags')]
    public function index(TagsRepository $repoTags): Response
    {
        $tags = $repoTags->findAll();
        return $this->render('tags/index.html.twig', [
            'tags' => $tags,
        ]);
    }

    #[Route('/tags/ajouter', name: 'app_tags_add')]
    public function add(Request $request, EntityManagerInterface $manager): Response
    {
       
        $tag = new Tags();
        $form = $this->createForm(TagsType::class, $tag);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
          
           $tag = $form->getData();
          
          
           $manager->persist($tag);
           $manager->flush();
           $this->addFlash('success','Tag ajouté avec succès.');
           return $this->redirectToRoute('app_tags_add');

        }



      
        return $this->render('tags/add.html.twig', [
            'form' => $form->createView(),
            'action' => 1
        ]);
    }
    #[Route('/tags/modifier/{slug}', name: 'app_tags_update')]
    public function update(Tags $tag, Request $request, EntityManagerInterface $manager): Response
    {
       
       
        $form = $this->createForm(TagsType::class, $tag);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
          
           $tag = $form->getData();
          
          
           
           $manager->flush();
           $this->addFlash('success','Tag modifié avec succès.');
           return $this->redirectToRoute('app_tags');

        }



      
        return $this->render('tags/add.html.twig', [
            'form' => $form->createView(),
            'action' => 2
        ]);
    }
}
