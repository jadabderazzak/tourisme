<?php

namespace App\Form;

use App\Entity\Amnities;
use App\Entity\Localite;
use App\Entity\Categorie;
use App\Model\RechercheDonnee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('query',TextType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => 'Ex: Best place ... ',
                ],
            ])
        ->add('categorie',EntityType::class,[
            'required' => false,
            'placeholder' => 'Catégorie',
            'class' => Categorie::class,
            'choice_label' => 'nom', 
           
        ])
        ->add('ville',EntityType::class,[
            'required' => false,
            'placeholder' => 'Localité',
            'class' => Localite::class,
            'choice_label' => 'nom', 
           
        ])
      
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RechercheDonnee::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }
}
