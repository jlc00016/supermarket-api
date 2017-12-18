<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    /** @inheritdoc */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', TextType::class)
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('price', TextType::class)
            ->add('image', TextType::class)
        ;
    }

    /** @inheritdoc */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Product::class,
                'csrf_protection' => false,
            ]
        );
    }

    /** @inheritdoc */
    public function getBlockPrefix()
    {
        return 'product';
    }


}