<?php

namespace App\Controller;

use App\Entity\Reviews;
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

    #[Route('/reviews/supprimer/{id}', name: 'app_reviews_delete')]
    public function delete(Reviews $reviews, EntityManagerInterface $manager): Response
    {
       $manager->remove($reviews);
       $manager->flush();
       $this->addFlash('success','Review supprimé avec succès.');
       return $this->redirectToRoute('app_reviews');
    }

    #[Route('/reviews/valider/{id}', name: 'app_reviews_valider')]
    public function valider(Reviews $reviews, EntityManagerInterface $manager): Response
    {
        $reviews->setCalculer(true);
        /*************** Recalculer la note  */
        $listing = $reviews->getListing();

        $note = $listing->getNote();

        $notefinal = $note != 0 ? number_format(($note + $reviews->getNote()) / 2, 2) : $reviews->getNote();

        $listing->setNote($notefinal);
      
       $manager->flush();
       $this->addFlash('success','Review validé avec succès.');
       return $this->redirectToRoute('app_reviews');
    }
}
