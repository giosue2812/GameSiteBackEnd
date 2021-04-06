<?php

namespace App\Form;

use App\Models\Forms\ImpressionForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImpressionNewFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idGame',TextType::class,["required" => true])
            ->add('description',TextType::class,["required" => true])
            ->add('howEnd',NumberType::class,["required" => false])
            ->add('tauxDeCompletion',NumberType::class,["required" => true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ImpressionForm::class,
            'csrf_protection' => false
        ]);
    }
}
