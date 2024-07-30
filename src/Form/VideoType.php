<?php

namespace App\Form;

use App\Entity\Video;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre',TextType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' => 'Veuillez introduire un titre de la vidéo',
                    ],
            ])
            ->add('lien',TextType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' => 'Veuillez introduire le lien',
                    ],
            ])
            ->add('categorie',EntityType::class,[
                'required' => false,
                'placeholder' => 'Veuillez choisir la catégorie',
              
                
                'class' => Categorie::class,
                'choice_label' => 'nom', 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
