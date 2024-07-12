<?php

namespace App\Controller;

use DateTime;
use App\Entity\Province;
use App\Form\ProvinceType;
use App\Repository\ProvinceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
class ProvinceController extends AbstractController
{
    #[Route('/province', name: 'app_province')]
    public function index(ProvinceRepository $repoProv): Response
    {
        $provinces = $repoProv->findBy([],['id' => 'DESC']);
        return $this->render('province/index.html.twig', [
            'provinces' => $provinces,
        ]);
    }

    #[Route('/province/ajouter', name: 'app_province_add')]
    public function add(Request $request, EntityManagerInterface $manager): Response
    {
        $province = new Province();
        $form = $this->createForm(ProvinceType::class, $province);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

           $province = $form->getData();
            $province->setNbVilles(0);
           $manager->persist($province);
           $manager->flush();
           $this->addFlash('success','Province ajouté avec succès.');
           return $this->redirectToRoute('app_province_add');

        }



      
        return $this->render('province/add.html.twig', [
            'form' => $form->createView(),
            'action' => 1
        ]);
    }

    #[Route('/province/update/{slug}', name: 'app_province_update')]
    public function update(Province $province, Request $request, EntityManagerInterface $manager): Response
    {
      
        $form = $this->createForm(ProvinceType::class, $province);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

           $province = $form->getData();
            
          
           $manager->flush();
           $this->addFlash('success','Province modifiée avec succès.');
           return $this->redirectToRoute('app_province');

        }



      
        return $this->render('province/add.html.twig', [
            'form' => $form->createView(),
            'action' => 2
        ]);
    }

    #[Route('/province/supprimer/{slug}', name: 'app_province_delete')]
    public function delete(Province $province, EntityManagerInterface $manager): Response
    {
       $manager->remove($province);
       $manager->flush();
       $this->addFlash('success','Province supprimée avec succès.');
       return $this->redirectToRoute('app_province');
    }
}
