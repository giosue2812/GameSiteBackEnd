<?php

namespace App\Form;

use App\Entity\User;
use App\Models\Forms\UserNewForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserNewFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('email',EmailType::class,["required"=>true])
            ->add('name',TextType::class,["required"=>true])
            ->add('prenom',TextType::class,["required"=>true])
            ->add('password',PasswordType::class,["required"=>true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserNewForm::class,
            'csrf_protection'=>false
        ]);
    }
}
