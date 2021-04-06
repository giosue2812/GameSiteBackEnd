<?php


namespace App\Form;


use App\Models\Forms\UserEditForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserEditFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class,["required"=>false])
            ->add('name',TextType::class,["required"=>false])
            ->add('prenom',TextType::class,["required"=>false])
            ->add('password',PasswordType::class,["required"=>false]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>UserEditForm::class,
            'csrf_protection'=>false
        ]);
    }
}