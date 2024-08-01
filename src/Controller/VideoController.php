<?php

namespace App\Controller;

use DateTime;
use App\Entity\Video;
use App\Form\VideoType;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
class VideoController extends AbstractController
{
    #[Route('/video', name: 'app_video')]
    public function index(VideoRepository $repoVIdeo): Response
    {
        $videos = $repoVIdeo->findAll();
        return $this->render('video/index.html.twig', [
            'videos' => $videos,
        ]);
    }

    #[Route('/video/ajouter', name: 'app_video_add')]
    public function add(Request $request, EntityManagerInterface $manager): Response
    {
        $video = new Video();
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

           $video = $form->getData();
        $video->setCreatedAt(new DateTime());
       
         

           $manager->persist($video);
           $manager->flush();
           $this->addFlash('success','Vidéo ajoutée avec succès.');
           return $this->redirectToRoute('app_video_add');

        }



      
        return $this->render('video/add.html.twig', [
            'form' => $form->createView(),
            'action' => 1
        ]);
    }

    #[Route('/video/modifier/{id}', name: 'app_video_update')]
    public function modifier(Video $video,Request $request, EntityManagerInterface $manager): Response
    {
      
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

           $video = $form->getData();

         

          
           $manager->flush();
           $this->addFlash('success','Vidéo modifié avec succès.');
           return $this->redirectToRoute('app_video');

        }



      
        return $this->render('video/add.html.twig', [
            'form' => $form->createView(),
            'action' => 2
        ]);
    }

    #[Route('/video/supprimer/{id}', name: 'app_video_delete')]
    public function delete(Video $video, EntityManagerInterface $manager): Response
    {
       $manager->remove($video);
       $manager->flush();
       $this->addFlash('success','Vidéo supprimée avec succès.');
       return $this->redirectToRoute('app_video');
    }
}
