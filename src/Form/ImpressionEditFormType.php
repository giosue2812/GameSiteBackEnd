<?php

namespace App\Form;

use App\Entity\Impression;
use App\Models\Forms\ImpressionForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImpressionEditFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description',TextType::class,["required" => false])
            ->add('howEnd',TextType::class,["required" => false])
            ->add('tauxDeCompletion',TextType::class,["required" => false])
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
