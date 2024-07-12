<?php

namespace App\Form;

use App\Entity\Actionnaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ActionnaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom',TextType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => 'Nom de l\'actionnaire',
                ],
            ])

        ->add('alt',TextType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => 'Description ',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Actionnaire::class,
        ]);
    }
}
