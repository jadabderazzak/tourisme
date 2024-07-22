<?php

namespace App\Form;

use App\Entity\Amnities;
use App\Entity\Localite;
use App\Entity\Categorie;
use App\Model\FiltreDonnee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class FiltreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('query',TextType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => 'Ex: Best place ... ',
                'class'=> 'text-gray-900 text-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-700 focus:ring-opacity-0 block w-full p-2.5'
                ],
            ])
        ->add('categorie',EntityType::class,[
            'required' => false,
            'placeholder' => 'Catégorie',
            'class' => Categorie::class,
            'choice_label' => 'nom', 
            'data' => $options['data']->getCategorie(),
            'attr' => [
                'class'=> 'text-gray-900 text-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-700 focus:ring-opacity-0 block w-full p-2.5'
                ],
           
        ])
        ->add('ville',EntityType::class,[
            'required' => false,
            'placeholder' => 'Localité',
            'class' => Localite::class,
            'choice_label' => 'nom', 
            'attr' => [
                'class'=> 'text-gray-900 text-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-700 focus:ring-opacity-0 block w-full p-2.5'
                ],
           
        ])
        ->add('amnities',EntityType::class,[
            'required' => false,
            'expanded'=> true,
       
            'class' => Amnities::class,
            'choice_label' => 'nom',
            'multiple' => true 
           
        ])
     
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FiltreDonnee::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }
}
