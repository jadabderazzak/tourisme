<?php

namespace App\Form;

use App\Entity\Reviews;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           
            ->add('titre',TextType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' => 'Example : it was an awesome experience to be there',
                    ],
                ])
            ->add('description',TextareaType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' => 'Tip: A great review covers food, service, and ambiance. Got recommendations for your favorite dishes and drinks, or something everyone should try here? Include that too!',
                    ],
                ])
            ->add('nom',TextType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' => 'Your name',
                    ],
                ])
            ->add('email',TextType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' => 'Your adress Email',
                    ],
                ])
                    
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reviews::class,
        ]);
    }
}
