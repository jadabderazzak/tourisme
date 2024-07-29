<?php

namespace App\Controller;

use App\Entity\Images;
use App\Entity\Listing;
use App\Entity\Listingamnities;
use App\Form\ListingType;
use App\Repository\AmnitiesRepository;
use App\Repository\ImagesRepository;
use App\Repository\ListingamnitiesRepository;
use App\Repository\ListingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
class ListingController extends AbstractController
{
    #[Route('/listing', name: 'app_listing')]
    public function index(ListingRepository $repoListing): Response
    {
        $listings = $repoListing->getAll();
        return $this->render('listing/index.html.twig', [
            'listings' => $listings,
        ]);
    }

    #[Route('/listing/ajouter', name: 'app_listing_add')]
    public function add(Request $request, EntityManagerInterface $manager, AmnitiesRepository $repoAmnities): Response
    {
        $extentions = ['jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG'];

        $listing = new Listing();
        $form = $this->createForm(ListingType::class, $listing);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
          
            $listing = $form->getData();
            $formData = $request->request->all();

          
            if (isset($formData['listing']['amnities'])) {
                $amnities = $formData['listing']['amnities'];
              
            } 
           
          /************************** Ajouter ces amnities dans la base  */
          foreach ($amnities as $amnityId) {
            $amnity = $repoAmnities->findOneBy(['id' => $amnityId]);
            $listingAmnity = new ListingAmnities();
            $listingAmnity->setListing($listing);
            $listingAmnity->setAmnities($amnity);

            $manager->persist($listingAmnity);
          }

          /*************************************************************** */
            $manager->persist($listing);
            /************ Traitement des nombres */
            $listing->setNbCouverts((trim($listing->getNbCouverts()) !== "" and $listing->getNbCouverts() !== null) ? $listing->getNbCouverts() : 0);
            $listing->setNbChambre((trim($listing->getNbChambre()) !== "" and $listing->getNbChambre() !== null) ? $listing->getNbChambre() : 0);
            $listing->setNbLit((trim($listing->getNbLit()) !== "" and $listing->getNbLit() !== null) ? $listing->getNbLit() : 0);
            /****************** traitement des images  */
            $listing->setNote(0);
            $images = $request->files->get('file');

            if (count($images) > 0) {

                foreach ($images as $img) {
                    if (
                        filesize($img) < 50000000 &&
                        in_array($img->guessExtension(), $extentions)
                    ) {

                        $filename =
                            md5(\uniqid()) . '.' . $img->guessExtension();
                        $uploads_directory = $this->getParameter(
                            'uploads_directory'
                        );





                        $img->move($uploads_directory, $filename);
                        $imagesentity = new Images();
                        $imagesentity->setChemin($filename)
                            ->setListing($listing);
                        $manager->persist($imagesentity);
                        

                    }



                }

            }


            $manager->flush();

            /******************************************* */



            $this->addFlash('success', 'Le listing a bien été ajouté.');
            return $this->redirectToRoute('app_listing_add');

        }




        return $this->render('listing/add.html.twig', [
            'form' => $form->createView(),
            'action' => 1,
            'images' => null
        ]);
    }

    #[Route('/listing/image/delete/{id}', name: 'app_listing_image_delete')]
    public function delete_image(Request $request, ImagesRepository $repoImage, EntityManagerInterface $manager): Response
    {
        $id = $request->get('id');
        $uploads_directory = $this->getParameter(
            'uploads_directory'
        );
        $image = $repoImage->findOneBy([
            'id' => $id
        ]);
  
        if ($image) {
            if ($image->getChemin()) {
                $fs = new Filesystem();
                $fs->remove(
                    $uploads_directory . '/' . $image->getChemin()
                );
            }

            $manager->remove($image);
            $manager->flush();
            return $this->json($id, 200);
        } else {
            return $this->json("Une erreur s'est produite. Image introuvable", 400);
        }

    }

    #[Route('/listing/modifier/{slug}', name: 'app_listing_update')]
    public function update(Listing $listing, Request $request, ListingamnitiesRepository $repoListAmni, EntityManagerInterface $manager, AmnitiesRepository $repoAmnities, ImagesRepository $repoImage): Response
    {
       
        $listingAmnities = $listing->getListingamnities();
        $allAmnities = $repoAmnities->findAll();

     
        $extentions = ['jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG'];
        $form = $this->createForm(ListingType::class, $listing, [
            'amnities' => $allAmnities,
            'listingAmnities' => $listingAmnities,
        ]);
        $allimages = $repoImage->findBy([
            'listing' => $listing
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $listing = $form->getData();

            /************ Traitement des nombres */
            $listing->setNbCouverts((trim($listing->getNbCouverts()) !== "" and $listing->getNbCouverts() !== null) ? $listing->getNbCouverts() : 0);
            $listing->setNbChambre((trim($listing->getNbChambre()) !== "" and $listing->getNbChambre() !== null) ? $listing->getNbChambre() : 0);
            $listing->setNbLit((trim($listing->getNbLit()) !== "" and $listing->getNbLit() !== null) ? $listing->getNbLit() : 0);
            /****************** traitement des images  */

            $images = $request->files->get('file');

            if (count($images) > 0) {

                foreach ($images as $img) {
                    if (
                        filesize($img) < 50000000 &&
                        in_array($img->guessExtension(), $extentions)
                    ) {

                        $filename =
                            md5(\uniqid()) . '.' . $img->guessExtension();
                        $uploads_directory = $this->getParameter(
                            'uploads_directory'
                        );





                        $img->move($uploads_directory, $filename);
                        $imagesentity = new Images();
                        $imagesentity->setChemin($filename)
                            ->setListing($listing);
                        $manager->persist($imagesentity);
                        // $listing->addImage($imagesentity);


                    }



                }

            }

               /************************** Ajouter ces amnities dans la base  */
               $formData = $request->request->all();

               $amnities = null;
          
               if (isset($formData['listing']['amnities'])) {
                   $amnities = $formData['listing']['amnities'];
                 
                     
                   
                    $existingListingAmnities = $repoListAmni->findBy(['listing' => $listing]);

                    foreach ($existingListingAmnities as $existingAmnity) {
                        $manager->remove($existingAmnity);
                    }
                    foreach ($amnities as $amnityId) {
                        $amnity = $repoAmnities->findOneBy(['id' => $amnityId]);
                      
                        $listingAmnity = new ListingAmnities();
                        $listingAmnity->setListing($listing);
                        $listingAmnity->setAmnities($amnity);
                        $manager->persist($listingAmnity);
                        
                       
                    } 
                       
                    }

            $manager->flush();
            $this->addFlash('success', 'Le listing a bien été modifié.');
            return $this->redirectToRoute('app_listing');

        }

        return $this->render('listing/add.html.twig', [
            'form' => $form->createView(),
            'action' => 2,
            'images' => $allimages
        ]);
    }



    #[Route('/listing/afficher/{slug}', name: 'app_listing_afficher')]
    public function show(Listing $listing, ImagesRepository $repoImage): Response
    {

        $allimages = $repoImage->findBy([
            'listing' => $listing
        ]);
       

        return $this->render('listing/show.html.twig', [
           
            'listing' => $listing,
            'images' => $allimages
        ]);
    }


    #[Route('/listing/display/{id}', name: 'app_listing_display')]
    public function display(Request $request, ListingRepository $repoListing, EntityManagerInterface $manager): Response
    {
        $id = $request->get('id');
       
        $listing = $repoListing->findOneBy([
            'id' => $id
        ]);
  
        if ($listing) {
           
           
            $listing->setAfficher(!$listing->isAfficher());
            $manager->flush();
            return $this->json($listing->isAfficher(), 200);
        } else {
            return $this->json("Une erreur s'est produite. Image introuvable", 400);
        }

    }
    
}
