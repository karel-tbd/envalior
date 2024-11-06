<?php

namespace App\Form;

use App\Entity\Company;
use App\Entity\User;
use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => false,
            ])
            ->add('isAgreed', CheckboxType::class, [
                'required' => false,
                'label' => 'Agree terms'

            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => 'Wachtwoord',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password'
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('repeatPlainPassword', PasswordType::class, [
                'label' => 'Herhaal wachtwoord',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password'
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new Callback(function ($object, ExecutionContextInterface $context) {
                        $form = $context->getRoot();
                        $plainPassword = $form->get('plainPassword')->getData();
                        $repeatPlainPassword = $form->get('repeatPlainPassword')->getData();

                        if ($plainPassword !== $repeatPlainPassword) {
                            $context->buildViolation('Passwords do not match')
                                ->atPath('repeatPlainPassword')
                                ->addViolation();
                        }
                    }),
                ],
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Voornaam',
                'required' => false,
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Achternaam',
                'required' => false,

            ])
            ->add('phoneNumber', PhoneNumberType::class, [
                'widget' => PhoneNumberType::WIDGET_COUNTRY_CHOICE,
                'country_display_emoji_flag' => true,
                'country_display_type' => 'display_country_short',
                'default_region' => 'BE',
                'country_options' => [

                ],
                'number_options' => [
                    'required' => false,
                ],

            ])
            ->add('company', EntityType::class, [
                'placeholder' => '',
                'autocomplete' => true,
                'label' => 'Bedrijfnaam',
                'class' => Company::class,
                'required' => false,

            ])
            ->add('envaliorContact', TextType::class, [
                'label' => 'Envalior contact',
                'required' => false,
            ]);
        /* ->add('contracts', EntityType::class, [
             'class' => 'App\Entity\Contract',
         ]);*/
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
