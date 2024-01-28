<?php

namespace App\Form;

use App\Entity\Personnages;
use App\Entity\Saisons;
use App\Entity\Stand;
use App\Entity\Statut;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use App\Enum\PersonnagesEtat;

class PersonnagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('name', TextType::class, [
                'label'=>'Nom du personnage',
            ])
            ->add('image', TextType::class, [
                'label'=>'Image du personnage',
            ])
                ->add('stand', EntityType::class, [
                'class' => Stand::class,
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('saisons', EntityType::class, [
                'class' => Saisons::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('statut', EntityType::class, [
                'class' => Statut::class,
                'choice_label' => 'name',
            ])
            ->add('enum_type', EnumType::class, [
                'class' => PersonnagesEtat::class,
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personnages::class,
        ]);
    }
}
