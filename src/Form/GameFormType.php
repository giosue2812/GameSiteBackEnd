<?php

namespace App\Form;

use App\Entity\Game;
use App\Models\Forms\GameEditForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
            ->add('nom',TextType::class,["required"=>true])
            ->add('description',TextType::class,["required"=>true])
            ->add('video',CollectionType::class,array(
                "entry_type"=>TextType::class,
                "allow_add"=>true,
                "allow_delete"=>true,
                "label"=>"Videos Youtube"
            ))
            ->add('idEditeur',NumberType::class,["required"=>false])
            ->add('idGenre',NumberType::class,["required"=>false])
            ->add('idPlatform',NumberType::class,["required"=>false])
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
