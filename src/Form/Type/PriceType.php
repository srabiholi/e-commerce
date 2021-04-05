<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use App\Form\DataTransformer\CentimesTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Test\FormBuilderInterface as TestFormBuilderInterface;

class PriceType extends AbstractType
{
    public function FunctionName(TestFormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new CentimesTransformer);
    }
    
    public function getParent()
    {
        return NumberType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'divide' => true
        ]);       
    }


}