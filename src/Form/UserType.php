<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('lastName', TextType::class, [
            'label' => "Nom"
        ])
        ->add('firstName', TextType::class, [
            'label' => "Prénom"
        ])
        ->add('email', TextType::class, [
            'label' => "Email"
        ])
        ->add('roles', ChoiceType::class, [
            'required' => true,
            'multiple' => false,
            'expanded' => false,
            'choices'  => [
                'Administrateur' => 'ROLE_ADMIN',
                'Eleve' => 'ROLE_ELEVE',
                'Formateur' => 'ROLE_FORMATEUR',
                'Tuteur' => 'ROLE_TUTEUR'
            ],
            'label' => "Rôles"
        ])
        
        ->add('save', SubmitType::class, [
            'label' => "Enregistrer les modifications"
        ]);
    
        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesArray) {
                     // transform the array to a string
                     return count($rolesArray)? $rolesArray[0]: null;
                },
                function ($rolesString) {
                     // transform the string back to an array
                     return [$rolesString];
                }
        ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
