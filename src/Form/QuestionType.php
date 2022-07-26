<?php
//Front form for questions

namespace App\Form;

use App\Entity\Question;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => '* Posez votre question',
                'help' => 'Ce champ ne doit pas être nul',
                'constraints' => new NotBlank(),
                'required' => true,
            ])
            ->add('category', EntityType::class, [
                'label' => 'Catégorie',
                'class' => 'App\Entity\Category',
                'choice_label' => 'name',
                'placeholder' => 'Choisissez une catégorie',
                'constraints' => new NotBlank(),
                'constraints' => new NotNull(),
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}