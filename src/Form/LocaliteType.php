<?php

namespace App\Form;

use App\Entity\Localite;
use App\Entity\Province;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LocaliteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom',TextType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => 'Veuillez introduire une localite',
                ],
        ])
      
        
        ->add('province',EntityType::class,[
            'required' => false,
            'placeholder' => 'Veuillez choisir la province',
          
            
            'class' => Province::class,
            'choice_label' => 'nom', 
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Localite::class,
        ]);
    }
}
