<?php

namespace App\Form;

use App\Entity\Saisons;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SaisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                    'label'=>'Nom de la saison',
            ])
            ->add('image', TextType::class, [
                'label'=>'Image de la saison',
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save'],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Saisons::class,
        ]);
    }
}
