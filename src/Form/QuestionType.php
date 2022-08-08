<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        // QUESTION
            ->add('content', TextareaType::class, [
                'label' => '* Posez votre question',
                'constraints' => new NotBlank(),
                'required' => true,
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
            'data_class' => Question::class,
        ]);
    }
}