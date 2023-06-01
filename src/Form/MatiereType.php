<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Classe;
use App\Entity\Matiere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MatiereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la matière',
            ])
            ->add('formateur', EntityType::class, [
                // looks for choices from this entity
                'class' => User::class,
                'label' => 'Formateur associé à la matière',
                // uses the User.username property as the visible option string
                'choice_label' => function (User $user) {
                    return $user->getLastName() . ' ' . $user->getFirstName();
                },
                'mapped' =>false,

                // used to render a select box, check boxes or radios
                'multiple' => true,
                'expanded' => false,
            ])
            ->add('classe', EntityType::class, [
                // looks for choices from this entity
                'class' => Classe::class,
                'label' => 'Classe associé à la matière',
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
            
                // used to render a select box, check boxes or radios
                'multiple' => true,
                'expanded' => false,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Matiere::class,
        ]);
    }
}
