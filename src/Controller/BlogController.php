<?php

namespace App\Controller;

use DateTime;
use App\Entity\Blog;
use App\Form\BlogType;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
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
        $extentions = ['jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG'];
        $blog = new Blog();
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

           $blog = $form->getData();

            $blog->setCreatedAt(new DateTime())
                 ->setUser($this->getUser());

          
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
                         $blog->SetImage($filename);
                        
                     } else {
                        $error = "Le format de l'image est invalide. (Extentions acceptées : ['jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG']).";
                           
                     }
                 } 
      

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
        $extentions = ['jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG'];
       
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

           $blog = $form->getData();

  

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
                   $blog->SetImage($filename);
                  
               } else {
                  $error = "Le format de l'image est invalide. (Extentions acceptées : ['jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG']).";
                     
               }
           } 
         

        
           $manager->flush();
           $this->addFlash('success','Blog modifié avec succès.');
           return $this->redirectToRoute('app_blog');

        }



      
        return $this->render('blog/add.html.twig', [
            'form' => $form->createView(),
            'action' => 2,
            'blog' => $blog
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

    #[Route('/blog/image/delete/{id}', name: 'app_blog_image_delete')]
    public function delete_image(Blog $blog,Request $request, EntityManagerInterface $manager): Response
    {
        $id = $request->get('id');
        $uploads_directory = $this->getParameter(
            'uploads_all_directory'
        );
      
  
     
            if ($blog->getImage()) {
                $fs = new Filesystem();
                $fs->remove(
                    $uploads_directory . '/' . $blog->getImage()
                );
                $blog->setImage('');
            }

           
            $manager->flush();
            return $this->json($id, 200);
       

    }
}
