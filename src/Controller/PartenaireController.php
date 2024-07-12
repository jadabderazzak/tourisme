<?php

namespace App\Controller;

use App\Entity\Partenaire;
use App\Form\PartenaireType;
use App\Repository\PartenaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
class PartenaireController extends AbstractController
{
    #[Route('/partenaire', name: 'app_partenaire')]
    public function index(PartenaireRepository $repoPart): Response
    {
        $partenaires = $repoPart->findAll();
        return $this->render('partenaire/index.html.twig', [
            'partenaires' => $partenaires
        ]);
    }

    #[Route('/partenaire/ajouter', name: 'app_partenaire_add')]
    public function add(Request $request, EntityManagerInterface $manager): Response
    {
        $extentions = ['jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG'];
        $partenaire = new Partenaire();
        $form = $this->createForm(PartenaireType::class, $partenaire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
          
           $partenaire = $form->getData();
          
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
                   $partenaire->SetImage($filename);
                  
               } else {
                  $error = "Le format de l'image est invalide. (Extentions acceptées : ['jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG']).";
                     
               }
           } 
           $manager->persist($partenaire);
           $manager->flush();
           $this->addFlash('success','Partenaire ajouté avec succès.');
           return $this->redirectToRoute('app_partenaire_add');

        }



      
        return $this->render('partenaire/add.html.twig', [
            'form' => $form->createView(),
            'action' => 1
        ]);
    }

    #[Route('/partenaire/modifier/{slug}', name: 'app_partenaire_update')]
    public function update(Partenaire $partenaire,Request $request, EntityManagerInterface $manager): Response
    {
        $extentions = ['jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG'];
      
        $form = $this->createForm(PartenaireType::class, $partenaire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
          
           $partenaire = $form->getData();
          
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
                if ($partenaire->getImage()) {
                    $fs = new Filesystem();
                    $fs->remove(
                        $uploads_directory . '/' . $partenaire->getImage()
                    );
                    $partenaire->setImage('');
                }
                 
                   $filename =
                       md5(\uniqid()) . '.' . $image->guessExtension();
                 
                   $image->move($uploads_directory, $filename);
                   $partenaire->SetImage($filename);
                  
               } else {
                  $error = "Le format de l'image est invalide. (Extentions acceptées : ['jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG']).";
                     
               }
           } 
           $manager->persist($partenaire);
           $manager->flush();
           $this->addFlash('success','Partenaire modifié avec succès.');
           return $this->redirectToRoute('app_partenaire');

        }



      
        return $this->render('partenaire/add.html.twig', [
            'form' => $form->createView(),
            'partenaire' => $partenaire,
            'action' => 2
        ]);
    }

    #[Route('/partenaire/supprimer/{slug}', name: 'app_partenaire_delete')]
    public function delete(Partenaire $partenaire, EntityManagerInterface $manager): Response
    {
       $manager->remove($partenaire);
       $manager->flush();
       $this->addFlash('success','Partenaire supprimé avec succès.');
       return $this->redirectToRoute('app_partenaire');
    }
}
