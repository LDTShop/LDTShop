<?php

namespace App\Form;

use App\Entity\Orders;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrdersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('orderDate', DateType::class,[
            //     'widget'=>'single_text'
            // ])
            // ->add('deliveryDate')
            ->add('address')
            // ->add('payment')
            ->add('status', ChoiceType::class,[
                'choices'=>[
                    'Packing'=>'Packing',
                    'Delivered'=>'Delivered'
                ],
                // 'expanded'=>true
            ])
            // ->add('username')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Orders::class,
        ]);
    }
}
