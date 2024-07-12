<?php

namespace App\Form;

use App\Entity\Commentsblog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BlogcommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' => 'Votre nom',
                    ],
                ])
            ->add('email',TextType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' => 'Votre Email',
                    ],
                ])
            ->add('website',TextType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' => 'https://www.votresiteweb.com',
                    ],
                ])
            ->add('commentaire',TextareaType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' => 'Commentaire',
                    ],
            ])
         
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentsblog::class,
        ]);
    }
}
