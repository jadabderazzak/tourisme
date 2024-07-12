<?php

namespace App\Form;

use App\Entity\Blog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' => 'Veuillez introduire un titre',
                    ],
                ])
            ->add('description',TextareaType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' => 'Veuillez introduire une description',
                    ],
            ])
            ->add('video',TextType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' => 'Veuillez introduire le lien de la vidéo',
                    ],
                ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Blog::class,
        ]);
    }
}
