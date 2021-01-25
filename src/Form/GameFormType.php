<?php

namespace App\Form;

use App\Entity\Game;
use App\Models\Forms\GameEditForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class GameFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id',NumberType::class,["required"=>true])
            ->add('nom',TextType::class,["required"=>true])
            ->add('description',TextType::class,["required"=>true])
            ->add('prix',NumberType::class)
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
            ->add('video',TextType::class,["required"=>false])
            ->add('editeur',TextType::class,["required"=>false])
            ->add('genre',TextType::class,["required"=>false])
            ->add('platform',TextType::class,["required"=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GameEditForm::class,
            'csrf_protection'=>false
        ]);
    }
}
