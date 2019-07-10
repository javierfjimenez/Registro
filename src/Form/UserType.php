<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Nombre',
                'attr' => ['class' => 'form-control']
            ))
            ->add('lastname', TextType::class, array(
                'label' => 'Apellido',
                'attr' => ['class' => 'form-control']
            ))
            ->add('telefono', NumberType::class, array(
                'label' => 'Telefono',
                'attr' => ['class' => 'form-control']
            ))
            ->add('cedula', NumberType::class, array(
                'label' => 'Cédula',
                'attr' => ['class' => 'form-control']
            ))
            ->add('email', TextType::class, array(
                'label' => 'Correo',
                'attr' => ['class' => 'form-control']
            ))
            ->add('password', PasswordType::class, array(
                'label' => 'Contraseña',
                'attr' => ['class' => 'form-control']
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Registrar',
                'attr' => ['class' => 'btn btn-primary mt-3']
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
