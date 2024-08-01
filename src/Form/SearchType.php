<?php

namespace App\Form;

use App\Entity\Amnities;
use App\Entity\Localite;
use App\Entity\Categorie;
use App\Model\RechercheDonnee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchType extends AbstractType
{
    private $translator;
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('query',TextType::class,[
            'required' => false,
            'attr' => [
                'placeholder' =>  $this->translator->trans('Ex: Meilleurs place ...'),
                ],
            ])
        ->add('categorie',EntityType::class,[
            'required' => false,
            'placeholder' =>  $this->translator->trans('Catégorie'),
            'class' => Categorie::class,
            'choice_attr' => function(Categorie $categorie) {
                return [
                    'data-label' => $categorie->getNom() // Utilisez une data attribute pour stocker le nom
                ];
            },
       'choice_translation_domain' => 'messages'
           
        ])
        ->add('ville',EntityType::class,[
            'required' => false,
            'placeholder' =>  $this->translator->trans('Localité'),
            'class' => Localite::class,
            'choice_attr' => function(Localite $localite) {
                    return [
                        'data-label' => $localite->getNom() // Utilisez une data attribute pour stocker le nom
                    ];
                },
           'choice_translation_domain' => 'messages'
        ])
      
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RechercheDonnee::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }
}
