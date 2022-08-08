<?php

namespace App\Form;

use App\Entity\Practice;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class PracticeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        // PRACTICE
            ->add('title', TextType::class, [
            'label' => '* Donnez un titre à votre bonne pratique',
            'constraints' => new NotBlank(),
            ])
        // CONTENT
            ->add('content', TextareaType::class, [
            'label' => '* Rédigez votre bonne pratique',
            'constraints' => new NotBlank(),
            ])
        // CHOICE CATEGORY
            ->add('category', EntityType::class, [
                'label' => '* Choisissez une catégorie associée',
                'help' => '* Champs obligatoires',
                'class' => 'App\Entity\Category',
                'choice_label' => 'name',
                'placeholder' => 'Choisissez une catégorie',
                'constraints' => new NotBlank(),
                'constraints' => new NotNull(),
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Practice::class,
        ]);
    }
}