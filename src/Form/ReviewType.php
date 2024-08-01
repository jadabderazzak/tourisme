<?php

namespace App\Form;

use App\Entity\Reviews;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ReviewType extends AbstractType
{
    private $translator;
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           
            ->add('titre',TextType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' =>  $this->translator->trans('Exemple c\'était une expérience géniale d\'être là'),
                    ],
                ])
            ->add('description',TextareaType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' =>  $this->translator->trans('Astuce une bonne critique couvre la nourriture, le service et l\'ambiance. Vous avez des recommandations pour vos plats et boissons préférés, ou quelque chose que tout le monde devrait essayer ici ? Incluez-le aussi !'),
                    ],
                ])
            ->add('nom',TextType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' =>  $this->translator->trans('Votre nom'),
                    ],
                ])
            ->add('email',TextType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' =>  $this->translator->trans('Votre email'),
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
