<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Infoday;
use App\Repository\InfodayRepository;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $infodays = $options['infodays'];
        $builder
            ->add('email', EmailType::class)
            ->add('username')
            ->add('firstname')
            ->add('lastname')
            ->add('birthday', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('infoday', EntityType::class, [
                'class' => Infoday::class,
                'choice_label' => function(Infoday $infoday) {
                    return $infoday->getDate()->format('d/m/Y');
                },
            ])

                    /*
                    new Infoday(DateTime::createFromFormat('d/m/Y', '25/05/2023')),
                    new Infoday(DateTime::createFromFormat('d/m/Y', '24/06/2023')),
                    new Infoday(DateTime::createFromFormat('d/m/Y', '02/09/2023')),
                    */

            ->add('agreeTerms', CheckboxType::class, [
                // how to add a link to terms and conditions


                'label' => 'I agree to the terms and conditions',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
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
            'data_class' => User::class,
            'infodays' => null,
        ]);
        $resolver->setAllowedTypes('infodays', 'object[]');
    }


}
