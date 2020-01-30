<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class CalculateDistanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('postal_address', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Empty postal address field']),
                    new Regex([
                        'pattern'   => '/\d{1,3}.?\d{0,3}\s[a-zA-Z]{2,30}\s[a-zA-Z]{2,15}/',
                        'match'     => true,
                        'message'   => 'Postal address is not correct.'
                    ])
                ],
            ])
            ->add('ip_address', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Empty IP address field']),
                    new Regex([
                        'pattern'   => '/^(?=.*[^\.]$)((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.?){4}$/',
                        'match'     => true,
                        'message'   => 'IP address is not correct.'
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
