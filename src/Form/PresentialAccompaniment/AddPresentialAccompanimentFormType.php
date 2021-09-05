<?php

namespace App\Form\PresentialAccompaniment;

use App\Entity\PresentialAccompaniment;
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

class AddPresentialAccompanimentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nom',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci \'entrer un nom pour cet accompagnement en présentiel'
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
                'label' => 'Texte alternatif à l\'image mise en avant',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer un texte alternatif pour l\'image',
                    ])
                ]
            ])
            ->add('totalPlacesNb', IntegerType::class, [
                'label' => 'Nombre de places disponibles (au total)'
            ])
            ->add('keyWordsString', TextType::class, [
                'label' => 'Mots clés',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer au moins un mot clé',
                    ])
                ]
            ])
            ->add('content', CKEditorType::class, [
                'label' =>'Contenu',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'ajouter du contenu à cet accompagnement en présentiel',
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
            'data-class' => PresentialAccompaniment::class
        ]);
    }
}
