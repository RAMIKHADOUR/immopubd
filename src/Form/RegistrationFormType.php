<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,[
                'label' => false,
            'attr'=>['class'=>'form-control','minlength'=>'2','maxlength'=>'50', 'placeholder' => 'Nom'],
                 
            'constraints'=>[new NotBlank(),new Assert\Length(['min'=>2,'max'=> 50])]])

            ->add('prenom', TextType::class,[
                'label' => false,
            'attr'=>['class'=>'form-control','minlength'=>'2','maxlength'=>'50','placeholder' => 'prenom'],
            'constraints'=>[new NotBlank(),new Assert\Length(['min'=>2,'max'=> 50])]])

            ->add('tele_mobile',TextType::class,[
                'label' => false,
                'attr'=>['class'=>'form-control','placeholder' => 'Tel-Portable'],
                'label_attr'=>['class'=>'form-label'],
                'constraints'=>[new Assert\NotBlank()]])
            
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Email',
                ]])

            ->add('agreeTerms', CheckboxType::class, [
            'label' => 'Accepter les Conditions',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                          
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => [
                'label' => false,
                'attr' => [
                        'placeholder' => 'Mot de Passe',
                    ],
                ],
                'second_options' => [
                'label' => false,
                'attr' => [
                        'placeholder' => 'Confirmation Mot de Passe',
                    ],

                ],
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
