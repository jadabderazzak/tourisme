<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Form\BlogType;
use App\Repository\BlogRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(BlogRepository $repoBlog): Response
    {
        $blogs = $repoBlog->findBy([],['id' => 'DESC']);
   
        return $this->render('blog/index.html.twig', [
            'blogs' => $blogs,
        ]);
    }

    #[Route('/blog/ajouter', name: 'app_blog_add')]
    public function add(Request $request, EntityManagerInterface $manager): Response
    {
        $blog = new Blog();
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

           $blog = $form->getData();

            $blog->setCreatedAt(new DateTime())
                 ->setUser($this->getUser());

          
         

           $manager->persist($blog);
           $manager->flush();
           $this->addFlash('success','Blog ajouté avec succès.');
           return $this->redirectToRoute('app_blog_add');

        }



      
        return $this->render('blog/add.html.twig', [
            'form' => $form->createView(),
            'action' => 1
        ]);
    }

    #[Route('/blog/modifier/{slug}', name: 'app_blog_update')]
    public function update(Blog $blog,Request $request, EntityManagerInterface $manager): Response
    {
       
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

           $blog = $form->getData();

  

          
         

        
           $manager->flush();
           $this->addFlash('success','Blog modifié avec succès.');
           return $this->redirectToRoute('app_blog');

        }



      
        return $this->render('blog/add.html.twig', [
            'form' => $form->createView(),
            'action' => 2
        ]);
    }

    #[Route('/blog/supprimer/{slug}', name: 'app_blog_delete')]
    public function delete(Blog $blog, EntityManagerInterface $manager): Response
    {
       $manager->remove($blog);
       $manager->flush();
       $this->addFlash('success','Blog supprimé avec succès.');
       return $this->redirectToRoute('app_blog');
    }
}
