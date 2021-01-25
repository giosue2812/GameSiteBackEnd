<?php

namespace App\Form;

use App\Entity\Game;
use App\Models\Forms\GameNewForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameNewFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,["required" => true])
            ->add('description',TextType::class,["required" => true])
            ->add('prix', NumberType::class,["required"=>false])
            ->add('dateAchat',DateType::class,[
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'html5' => false
            ])
            ->add('dateSortie',DateType::class,[
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'html5' => false
            ])
            ->add('editeur',TextType::class,["required" => true])
            ->add('genre',TextType::class,["required" => true])
            ->add('platform', TextType::class,["required" => true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GameNewForm::class,
            'csrf_protection' => false
        ]);
    }
}
