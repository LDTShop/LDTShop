<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            // ->add('roles')
            ->add('password',RepeatedType::class,[
                'type'=> PasswordType::class,
                'invalid_message'=> 'Not match',
                'options'=>['attr'=>['class'=>'password-field']],
                'required'=>true,
                'first_options'=>['label'=>'Password'],
                'second_options'=>['label'=>'Confirm Password']
            ])
            ->add('cusName', TextType::class)
            ->add('gender', ChoiceType::class,[
                'choices'=>[
                    'Male'=>'0',
                    'Female'=>'1'
                ],
                'expanded'=>true
            ])
            ->add('address', TextType::class)
            ->add('telephone', TextType::class)
            ->add('email', EmailType::class)
            ->add('date')
            ->add('status', ChoiceType::class,[
                'choices'=>[
                    'Active'=>'1',
                    'Inactive'=>'0'
                ],
                'expanded'=>true
            ])
            ->add('save',SubmitType::class,[
                'label'=>'Save'
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
