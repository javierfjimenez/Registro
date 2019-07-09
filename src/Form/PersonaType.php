<?php

namespace App\Form;

use App\Entity\Persona;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonaType extends AbstractType
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
            ->add('mesa_electoral', NumberType::class, array(
                'label' => 'Mesa Electoral',
                'attr' => ['class' => 'form-control']
            ))
            ->add('direccion', TextType::class, array(
                'label' => 'Dirección',
                'attr' => ['class' => 'form-control']
            ))
            ->add('telefono', NumberType::class, array(
                'label' => 'Telefono',
                'attr' => ['class' => 'form-control']
            ))
            ->add('cedula', TextType::class, array(
                'label' => 'Cédula',
                'attr' => ['class' => 'form-control']
            ))
            ->add('correo', TextType::class, array(
                'label' => 'Correo',
                'attr' => ['class' => 'form-control']
            ))
            ->add('submit', ButtonType::class, array(
                'attr' => ['class' => 'btn btn-primary mt-3']
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Persona::class,
        ]);
    }
}
