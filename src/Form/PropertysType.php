<?php

namespace App\Form;

use App\Entity\Adresses;
use App\Entity\Annonces;
use App\Entity\InfoPerso;
use App\Entity\Propertys;
use App\Entity\Typesbien;
use App\Form\AdressesType;
use App\Form\InfoPersoType;
use App\Entity\Categorysbien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertysType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('surface')
            ->add('prix')
            ->add('chambres')
            ->add('sallebains')
            ->add('etages')
            ->add('numero_etage')
            ->add('internet')
            ->add('garage')
            ->add('piscine')
            ->add('camera')
            ->add('categorysbien', null)
             ->add('typesbien', null)
            ->add('adresse', AdressesType::class,['label'=>false])
            ->add('infosperso', InfoPersoType::class,['label'=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Propertys::class,
        ]);
    }
}
