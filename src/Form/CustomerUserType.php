<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('username')
        ->add('cusName', TextType::class)
        ->add('gender', ChoiceType::class,[
            'choices'=>[
                'Male'=>'0',
                'Female'=>'1'
            ],
        ])
        ->add('address', TextType::class)
        ->add('telephone', TextType::class)
        ->add('email', EmailType::class)
        ->add('date', DateType::class,[
            'widget'=>'single_text'
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
