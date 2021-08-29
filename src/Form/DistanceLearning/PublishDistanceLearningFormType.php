<?php

namespace App\Form\DistanceLearning;

use App\Entity\DistanceLearning;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublishDistanceLearningFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('slug', TextType::class, [
                'label' => 'slug'
            ])
            ->add('published', CheckboxType::class, [
                'label' => 'publié',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data-class' => DistanceLearning::class
        ]);
    }
}
