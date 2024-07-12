<?php

namespace App\Controller;

use DateTime;
use App\Entity\Blog;
use App\Entity\Commentsblog;
use App\Form\BlogcommentType;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PagesController extends AbstractController
{
    #[Route('/section/blog', name: 'page_blog')]
    public function blog(BlogRepository $repoBlog): Response
    {
        $blogs = $repoBlog->findBy([], ['id' => 'DESC']);
        return $this->render('pages/blog.html.twig', [
            'blogs' => $blogs,
        ]);
    }

    #[Route('/section/blog/{slug}', name: 'page_blog_read')]
    public function blog_read(Blog $blog, Request $request, BlogRepository $repoBlog, EntityManagerInterface $manager): Response
    {
        $blogs = $repoBlog->findBy([], ['id' => 'DESC'], 5);
        $comment = new Commentsblog();
        $form = $this->createForm(BlogcommentType::class, $comment);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $comment = $form->getData();

            $comment->setCommentedAt(new DateTime())
                    ->setBlog($blog)
                 ->setDisplay(false);

            $manager->persist($comment);
           $manager->flush();
           $this->addFlash('success','Commentaire ajouté avec succès.');
           return $this->redirectToRoute('page_blog_read',['slug' => $blog->getSlug()]);

        }
        
       
        return $this->render('pages/blog_read.html.twig', [
            'blog' => $blog,
            'blogs' => $blogs,
            'form' => $form->createView()
        ]);
    }
}
