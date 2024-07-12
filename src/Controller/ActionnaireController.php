<?php

namespace App\Controller;

use App\Entity\Actionnaire;
use App\Form\ActionnaireType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ActionnaireRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
class ActionnaireController extends AbstractController
{
    #[Route('/actionnaire', name: 'app_actionnaire')]
    public function index(ActionnaireRepository $repoAct): Response
    {
        $actionnaires = $repoAct->findAll();
        return $this->render('actionnaire/index.html.twig', [
            'actionnaires' => $actionnaires,
        ]);
    }

    #[Route('/actionnaire/ajouter', name: 'app_actionnaire_add')]
    public function add(Request $request, EntityManagerInterface $manager): Response
    {
        $extentions = ['jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG'];
        $actionnaire = new Actionnaire();
        $form = $this->createForm(ActionnaireType::class, $actionnaire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
          
           $actionnaire = $form->getData();
          
           $image = $request->files->get('imageFile');
           if ($image) 
           {
            $uploads_directory = $this->getParameter(
                'uploads_directory_logo'
            );
               if (
                   filesize($image) < 20000000 &&
                   in_array($image->guessExtension(), $extentions)
               ) {
                 
                
                   $filename =
                       md5(\uniqid()) . '.' . $image->guessExtension();
                  
                   $image->move($uploads_directory, $filename);
                   $actionnaire->SetImage($filename);
                  
               } else {
                  $error = "Le format de l'image est invalide. (Extentions acceptées : ['jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG']).";
                     
               }
           } 
           $manager->persist($actionnaire);
           $manager->flush();
           $this->addFlash('success','Actionnaire ajouté avec succès.');
           return $this->redirectToRoute('app_actionnaire_add');

        }



      
        return $this->render('actionnaire/add.html.twig', [
            'form' => $form->createView(),
            'action' => 1
        ]);
    }

    #[Route('/actionnaire/modifier/{slug}', name: 'app_actionnaire_update')]
    public function update(Actionnaire $actionnaire,Request $request, EntityManagerInterface $manager): Response
    {
        $extentions = ['jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG'];
      
        $form = $this->createForm(ActionnaireType::class, $actionnaire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
          
           $actionnaire = $form->getData();
          
           $image = $request->files->get('imageFile');
           if ($image) 
           {
            $uploads_directory = $this->getParameter(
                'uploads_directory_logo'
            );
               if (
                   filesize($image) < 20000000 &&
                   in_array($image->guessExtension(), $extentions)
               ) {
                if ($actionnaire->getImage()) {
                    $fs = new Filesystem();
                    $fs->remove(
                        $uploads_directory . '/' . $actionnaire->getImage()
                    );
                    $actionnaire->setImage('');
                }
                 
                   $filename =
                       md5(\uniqid()) . '.' . $image->guessExtension();
                 
                   $image->move($uploads_directory, $filename);
                   $actionnaire->SetImage($filename);
                  
               } else {
                  $error = "Le format de l'image est invalide. (Extentions acceptées : ['jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG']).";
                     
               }
           } 
           $manager->persist($actionnaire);
           $manager->flush();
           $this->addFlash('success','Actionnaire Modifié avec succès.');
           return $this->redirectToRoute('app_actionnaire');

        }



      
        return $this->render('actionnaire/add.html.twig', [
            'form' => $form->createView(),
            'actionnaire' => $actionnaire,
            'action' => 2
        ]);
    }

    #[Route('/actionnaire/supprimer/{slug}', name: 'app_actionnaire_delete')]
    public function delete(Actionnaire $actionnaire, EntityManagerInterface $manager): Response
    {
       $manager->remove($actionnaire);
       $manager->flush();
       $this->addFlash('success','Actionnaire supprimé avec succès.');
       return $this->redirectToRoute('app_actionnaire');
    }
}
