<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\DependencyInjection\ParameterBag\EnvPlaceholderParameterBag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Config\Framework\Workflows\WorkflowsConfig\PlaceConfig;

class NewUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        // PSEUDO
                ->add('pseudo', TextType::class, [
                        'label' => 'Entrez un pseudonyme',
                        'attr' => array(
                        'placeholder' => 'Pseudonyme'),
                        'constraints' => new NotBlank()
                        ])
        // EMAIL        
                ->add('email', EmailType::class,[
                        'label' => 'Entrez une adresse Email valide',
                        'constraints' => new NotBlank(),
                        'attr' => array(
                            'placeholder' => 'Email'),
                        ])
                // REPEATED
                ->add('email', RepeatedType::class, [
                        'first_options'  => ['label' => 'Email'],
                        'second_options' => ['label' => 'Repeat Email'],
                        ])
        // PASSWORD                    
                ->add('password',PasswordType::class, [
                        'label' => 'Entrez un mot de passe',
                        'contraints' => new NotBlank(),
                        'constraints' => new NotNull(),
                        "always_empty" => true,
                        ])
                // REPEATED
                ->add('password', RepeatedType::class, [
                        'label' => 'Entrez un mot de passe',
                        'first_options'  => ['label' => 'Password'],
                        'second_options' => ['label' => 'Entrez de nouveau votre password'],
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
    //TODO make UserEntity and UserController
}