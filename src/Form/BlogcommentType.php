<?php

namespace App\Form;

use App\Entity\Commentsblog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BlogcommentType extends AbstractType
{
    private $translator;
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' => $this->translator->trans('Votre nom'),
                    ],
                ])
            ->add('email',TextType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' => $this->translator->trans('Votre email'),
                    ],
                ])
            ->add('website',TextType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' =>  $this->translator->trans('votresiteweb.com'),
                    ],
                ])
            ->add('commentaire',TextareaType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' => $this->translator->trans('Commentaire'),
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
