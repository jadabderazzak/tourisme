<?php

namespace App\Form;

use App\Entity\Amnities;
use App\Entity\Listing;
use App\Entity\Localite;
use App\Entity\Categorie;
use App\Entity\TypePension;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ListingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name',TextType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => 'Veuillez introduire un nom du listing',
                ],
        ])
        ->add('link',TextType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => 'Introduisez seulement le nom utilisé dans hotelrunner Exemple : palais-amani',
                ],
        ])
        ->add('adresse',TextType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => 'Veuillez introduire une adresse valide',
                ],
        ])
        ->add('latitude',TextType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => 'Veuillez introduire la latitude',
                ],
        ])
        ->add('longitude',TextType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => 'Veuillez introduire la longitude',
                ],
        ])
        ->add('prixStart',NumberType::class,[
            'required' => false,
            
            'attr' => [
                'placeholder' => 'Le prix bas',
                ],
        ])
        ->add('prixEnd',NumberType::class,[
            'required' => false,
            
            'attr' => [
                'placeholder' => 'Le prix haut ',
                ],
        ])
        ->add('nbCouverts',NumberType::class,[
            'required' => false,
            
            'attr' => [
                'placeholder' => 'Veuillez introduire un nombre entier',
                ],
        ])
        ->add('nbChambre',NumberType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => 'Veuillez introduire un nombre entier',
                ],
        ])
        ->add('nbLit',NumberType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => 'Veuillez introduire un nombre entier',
                ],
        ])
        ->add('siteweb',TextType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => 'Veuillez introduire votre site web',
                ],
        ])
        ->add('email',EmailType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => 'Veuillez introduire une adresse Email valide.',
                ],
        ])
        ->add('telephone',TextType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => 'Veuillez introduire un numéro de téléphone',
                ],
        ])
        ->add('facebook',TextType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => 'Veuillez introduire l\'adresse Facebook',
                ],
        ])
        ->add('instagram',TextType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => 'Veuillez introduire l\'adresse instagram',
                ],
        ])
        ->add('tiktok',TextType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => 'Veuillez introduire l\'adresse tiktok',
                ],
        ])
        ->add('youtube',TextType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => 'Veuillez introduire l\'adresse youtube',
                ],
        ])
        ->add('twitter',TextType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => 'Veuillez introduire l\'adresse twitter',
                ],
        ])
        ->add('description',TextareaType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => 'Veuillez introduire une description',
                ],
        ])
        ->add('ville',EntityType::class,[
            'required' => false,
            'placeholder' => 'Veuillez choisir la province',
          
            
            'class' => Localite::class,
            'choice_label' => 'nom', 
        ])
        ->add('categorie',EntityType::class,[
            'required' => false,
            'placeholder' => 'Veuillez choisir la province',
          
            
            'class' => Categorie::class,
            'choice_label' => 'nom', 
        ])
        ->add('pension',EntityType::class,[
            'required' => false,
            'placeholder' => 'Veuillez choisir le type de pension',
          
            
            'class' => TypePension::class,
            'choice_label' => 'nom', 
        ])
        ->add('afficher', CheckboxType::class, [
            'label'    => 'Afficher ce listing ?',
            
            'required' => false,
        ])
        ->add('amnities', EntityType::class, [
            'class' => Amnities::class,
            'mapped' => false,
            'required' => false,
            'choice_label' => 'nom',
            'expanded' => true,
            'multiple' => true,
            'choice_attr' => function ($choice, $key, $value) use ($options) {
                    // Vérifiez si cette amnity est déjà associée au Listing
                    foreach ($options['listingAmnities'] as $listingAmnity) {
                        if ($listingAmnity->getAmnities()->getId() === $choice->getId()) {
                            return ['checked' => 'checked'];
                        }
                    }
                    return [];
                },
                'choice_label' => function ($amnity, $key, $value) {
                    return $amnity->getNom(); // Supposons que votre entité Amnity a une méthode getName()
                },
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Listing::class,
         
            'amnities' => [],
            'listingAmnities' => [],
        ]);
    }
}
