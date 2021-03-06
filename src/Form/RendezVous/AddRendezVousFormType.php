<?php

namespace App\Form\RendezVous;

use App\Entity\RendezVous;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AddRendezVousFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nom',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer un nom pour ce rendez-vous'
                    ])
                ]
            ])
            ->add('dateAndSchedule', TextType::class, [
                'label' => 'Date et heure',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer une date pour ce rendez-vous'
                    ])
                ]
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image mise en avant',
                'constraints' => [
                    new Image([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            "image/jpeg",
                            "image/jpeg",
                            "image/png"
                        ],
                        'mimeTypesMessage' => 'Merci de choisir un fichier de type image',
                    ]),
                    new NotNull([
                        'message' => 'Merci d\'ajouter une image de mise en avant',
                    ])
                ]
            ])
            ->add('featuredImageAlt', TextType::class, [
                'label' => 'Texte alternatif ?? l\'image mise en avant',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer un texte alternatif pour l\'image',
                    ])
                ]
            ])
            ->add('totalPlacesNb', IntegerType::class, [
                'label' => 'Nombre de places disponibles (au total)',
                'invalid_message' => 'Merci d\'entrer un nombre'
            ])
            ->add('keyWordsString', TextType::class, [
                'label' => 'Mots cl??s',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer au moins un mot cl??',
                    ])
                ]
            ])
            ->add('content', CKEditorType::class, [
                'label' =>'Contenu',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'ajouter du contenu ?? ce rendez-vous',
                    ])
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-inverted'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data-class' => RendezVous::class
        ]);
    }
}
