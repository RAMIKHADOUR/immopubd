<?php

namespace App\Form;

use App\Entity\InfoPerso;
use App\Entity\Propertys;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class InfoPersoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           ->add('civilite', ChoiceType::class, [
                'choices' => [
                    'Monsieur' => 'M',
                    'Madame' => 'Mme',
                    'Autre' => 'O',
                ],
                'placeholder' => 'Choisissez une option', // Ajoute une valeur vide par défaut
                'required' => true,
                'label' => 'Civilité', // Optionnel : personnalise le label
            ])
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('tele_fixe')
            ->add('tele_mobile')
            ->add('propertys', EntityType::class, [
                'class' => Propertys::class,
                'label'=>false,
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InfoPerso::class,
        ]);
    }
}
