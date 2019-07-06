<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array(
                'label' => 'Nombre',
                'attr' => ['class' => 'form-control']
            ))
            ->add('apellido', TextType::class, array(
                'label' => 'Apellido',
                'attr' => ['class' => 'form-control']
            ))
            ->add('password', TextType::class, array(
                'label' => 'Contraseña',
                'attr' => ['class' => 'form-control']
            ))
            ->add('direccion', TextType::class, array(
                'label' => 'Dirección',
                'attr' => ['class' => 'form-control']
            ))
            ->add('telefono', TextType::class, array(
                'label' => 'Telefono',
                'attr' => ['class' => 'form-control']
            ))
            ->add('cedula', TextType::class, array(
                'label' => 'Cédula',
                'attr' => ['class' => 'form-control']
            ))
            ->add('role', TextType::class, array(
                'label' => 'Role',
                'attr' => ['class' => 'form-control']

            ))->add('submit', SubmitType::class, array(
                'label' => 'Guardar',
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
