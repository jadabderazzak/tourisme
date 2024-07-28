<?php

namespace App\Controller;


use App\Repository\ReviewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
class ReviewsController extends AbstractController
{
    #[Route('/reviews', name: 'app_reviews')]
    public function index(ReviewsRepository $repoRev): Response
    {
        $reviews = $repoRev->findAll();
        return $this->render('reviews/index.html.twig', [
            'reviews' => $reviews,
        ]);
    }

    #[Route('/reviews/calculate/{id}', name: 'app_reviews_calculate')]
    public function calculate(Request $request, ReviewsRepository $repoRev, EntityManagerInterface $manager): Response
    {
        $id = $request->get('id');
       
        $review = $repoRev->findOneBy([
            'id' => $id
        ]);
  
        if ($review) {
           
           
            $review->setCalculer(true);
            $manager->flush();
            return $this->json(true, 200);
        } else {
            return $this->json("Une erreur s'est produite. Image introuvable", 400);
        }

    }
}
