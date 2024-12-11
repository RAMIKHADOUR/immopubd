<?php
namespace App\Form;

use App\Entity\Typesbien;
use App\Entity\Categorysbien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;



class RechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('category', EntityType::class, [
                'class' => Categorysbien::class,
                'choice_label' => 'categorie',
                'required' => false,
                'placeholder' => 'Toutes les catégories',
            ])
            ->add('type', EntityType::class, [
                'class' => Typesbien::class,
                'choice_label' => 'type_bien',
                'required' => false,
                'placeholder' => 'Tous les types',
            ])
            ->add('minSurface', NumberType::class, [
                'required' => false,
                'label' => 'Surface minimale',
            ])
            ->add('maxSurface', NumberType::class, [
                'required' => false,
                'label' => 'Surface maximale',
            ])
            ->add('minPrix', NumberType::class, [
                'required' => false,
                'label' => 'Prix minimum',
            ])
            ->add('maxPrix', NumberType::class, [
                'required' => false,
                'label' => 'Prix maximum',
            ])
            ->add('ville', TextType::class, [
                'required' => false,
                'label' => 'Ville',
            ]);
    }

   public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
