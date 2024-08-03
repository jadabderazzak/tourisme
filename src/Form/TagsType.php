<?php

namespace App\Form;

use App\Entity\Tags;
use App\Entity\Categorytags;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TagsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' => 'Nom du tag',
                    ],
                ])
            ->add('ar',TextType::class,[
                    'required' => false,
                    'attr' => [
                        'placeholder' => 'Traduction arabe',
                        ],
                    ])
            ->add('en',TextType::class,[
                        'required' => false,
                        'attr' => [
                            'placeholder' => 'Traduction anglais',
                            ],
                        ])
            ->add('categorie',EntityType::class,[
                'required' => false,
                'placeholder' => 'Veuillez choisir la catégorie',
              
                
                'class' => Categorytags::class,
                'choice_label' => 'nom', 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tags::class,
        ]);
    }
}
