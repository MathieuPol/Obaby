<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class UserUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('pseudo')
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent correspondre.',
                'label' => 'Entrez un mot de passe',
                'first_options'  => [
                        'label' => '* Mot de passe',
                        'constraints' => new NotBlank(),
                        'constraints' => new NotNull(),
                        'attr' => array(
                                'type' => 'password',
                                'placeholder' => 'Password'
                        ),
                ],
                'second_options' => [
                        'label' => '* Confirmez le mot de passe',
                        'constraints' => new NotBlank(),
                        'constraints' => new NotNull(),
                        'attr' => array(
                                'type' => 'password',
                                'placeholder' => 'Password'
                        ),
                ],
        ]);


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}