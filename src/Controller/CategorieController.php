<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(CategorieRepository $repoCat): Response
    {
        $categories = $repoCat->findAll();
        return $this->render('categorie/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    
    #[Route('/categorie/ajouter', name: 'app_categorie_add')]
    public function add(Request $request, EntityManagerInterface $manager): Response
    {
        $extentions = ['jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG'];
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
          
           $categorie = $form->getData();
          
           $image = $request->files->get('imageFile');
           if ($image) 
           {
               if (
                   filesize($image) < 20000000 &&
                   in_array($image->guessExtension(), $extentions)
               ) {
                 
                   $filename =
                       md5(\uniqid()) . '.' . $image->guessExtension();
                   $uploads_directory = $this->getParameter(
                       'uploads_all_directory'
                   );
                   $image->move($uploads_directory, $filename);
                   $categorie->SetImage($filename);
                  
               } else {
                  $error = "Le format de l'image est invalide. (Extentions acceptées : ['jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG']).";
                     
               }
           } 
           $manager->persist($categorie);
           $manager->flush();
           $this->addFlash('success','Catégorie ajoutée avec succès.');
           return $this->redirectToRoute('app_categorie_add');

        }



      
        return $this->render('categorie/add.html.twig', [
            'form' => $form->createView(),
            'action' => 1
        ]);
    }

    #[Route('/categorie/modifier/{slug}', name: 'app_categorie_update')]
    public function update(Categorie $categorie,Request $request, EntityManagerInterface $manager): Response
    {
        $extentions = ['jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG'];
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

           $categorie = $form->getData();
           $image = $request->files->get('imageFile');
           if ($image) 
           {
               if (
                   filesize($image) < 20000000 &&
                   in_array($image->guessExtension(), $extentions)
               ) {
                 
                   $filename =
                       md5(\uniqid()) . '.' . $image->guessExtension();
                   $uploads_directory = $this->getParameter(
                       'uploads_all_directory'
                   );
                   $image->move($uploads_directory, $filename);
                   $categorie->SetImage($filename);
                  
               } else {
                  $error = "Le format de l'image est invalide. (Extentions acceptées : ['jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG']).";
                     
               }
           } 

           
           $manager->flush();
           $this->addFlash('success','Catégorie modifiée avec succès.');
           return $this->redirectToRoute('app_categorie');

        }



      
        return $this->render('categorie/add.html.twig', [
            'form' => $form->createView(),
            'categorie' => $categorie,
            'action' => 2
        ]);
    }

    #[Route('/categorie/image/delete/{id}', name: 'app_categorie_image_delete')]
    public function delete_image(Categorie $categorie,Request $request, EntityManagerInterface $manager): Response
    {
        $id = $request->get('id');
        $uploads_directory = $this->getParameter(
            'uploads_all_directory'
        );
      
  
     
            if ($categorie->getImage()) {
                $fs = new Filesystem();
                $fs->remove(
                    $uploads_directory . '/' . $categorie->getImage()
                );
                $categorie->setImage('');
            }

           
            $manager->flush();
            return $this->json($id, 200);
       

    }
}
