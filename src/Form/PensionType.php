<?php

namespace App\Form;

use App\Entity\TypePension;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PensionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom',TextType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => 'Ajouter un type de pension',
                ],
            ])
            ->add('description',TextareaType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' => 'Définissez les détails du type de pension',
                    ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TypePension::class,
        ]);
    }
}
