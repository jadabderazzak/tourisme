<?php

namespace App\Controller;

use DateTime;
use App\Entity\Blog;
use App\Entity\Categorie;
use App\Entity\Commentsblog;
use App\Form\BlogcommentType;
use App\Repository\BlogRepository;
use App\Repository\VideoRepository;
use App\Repository\CategorieRepository;
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

    #[Route('/section/videos', name: 'page_videos')]
    public function videos(VideoRepository $repoVideo, CategorieRepository $repoCat): Response
    {
        $categories = $repoCat->findAll();
        $videos = $repoVideo->findBy([], ['id' => 'DESC']);
        return $this->render('pages/videos.html.twig', [
            'videos' => $videos,
            'categories' => $categories
        ]);
    }

    #[Route('/section/videos/{slug}', name: 'page_videos_categorie')]
    public function videos_categorie(Categorie $categorie, VideoRepository $repoVideo, CategorieRepository $repoCat): Response
    {
        $categories = $repoCat->findAll();
        $videos = $repoVideo->findBy([
            'categorie' => $categorie
        ],['id' => 'DESC']);
       
        return $this->render('pages/videos.html.twig', [
            'videos' => $videos,
            'categories' => $categories
        ]);
    }
}
