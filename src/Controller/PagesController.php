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
use Knp\Component\Pager\PaginatorInterface;
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
    public function videos(VideoRepository $repoVideo, CategorieRepository $repoCat, PaginatorInterface $paginator, Request $request): Response
    {
        $categories = $repoCat->findAll();
     
        $videos1 = $repoVideo->getVideos(0);
        $videos = $paginator->paginate($videos1, $request->query->getInt('page', 1), 12);
        return $this->render('pages/videos.html.twig', [
            'videos' => $videos,
            'categories' => $categories
        ]);
    }

    #[Route('/section/videos/categorie/{slug}', name: 'page_videos_categorie')]
    public function videos_categorie(Categorie $categorie, VideoRepository $repoVideo, CategorieRepository $repoCat, PaginatorInterface $paginator, Request $request): Response
    {
        $categories = $repoCat->findAll();
        $videos1 = $repoVideo->getVideosByCategorie($categorie);
       
        $videos = $paginator->paginate($videos1, $request->query->getInt('page', 1), 12);
       
        return $this->render('pages/videos.html.twig', [
            'videos' => $videos,
            'categories' => $categories
        ]);
    }

    #[Route('/section/videos/search', name: 'page_videos_search')]
    public function search(VideoRepository $repoVideo, CategorieRepository $repoCat, PaginatorInterface $paginator, Request $request): Response
    {
        $query = trim($request->get('search'));
        $query = preg_replace('/[^a-zA-Z0-9_\-\s]/', '', $query);
        $query = htmlspecialchars($query, ENT_QUOTES, 'UTF-8');
      
        $categories = $repoCat->findAll();
     
        $videos1 = $repoVideo->getVideosSearch($query);
        $videos = $paginator->paginate($videos1, $request->query->getInt('page', 1), 12);
        return $this->render('pages/videos.html.twig', [
            'videos' => $videos,
            'categories' => $categories
        ]);
    }
}
