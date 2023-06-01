<?php

namespace App\Form;
use App\Entity\Note;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class NotesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $classeId = $options['classe_id'];

        $builder
            ->add('note', TextType::class, [
                'label' => 'Note de l`élève',
            ])
            ->add('eleve', EntityType::class, [
                // looks for choices from this entity
                'class' => User::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => function (User $user) {
                    return $user->getLastName() . ' ' . $user->getFirstName();
                },
            
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'query_builder' => function (EntityRepository $er) use ($classeId) {
                    return $er->createQueryBuilder('u')
                        ->join('u.classe', 'c') // Assuming a many-to-many relation between User and Classe
                        ->where('c.id = :classeId')
                        ->setParameter('classeId', $classeId); // Your specific Classe ID
                },
                'expanded' => false,
            ]);     
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Note::class,
            'classe_id' => null,
        ]);
    }
}
