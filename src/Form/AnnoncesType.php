<?php

namespace App\Form;

use App\Entity\Users;
use App\Entity\Medias;
use App\Entity\Annonces;
use App\Entity\Propertys;
use App\Form\PropertysType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AnnoncesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('reference')
            ->add('image', FileType::class, [
                'label' => 'Image (formats JPG/PNG)',
                'mapped' => false, // Pas lié directement à l'entité
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Veuillez uploader une image valide (JPG ou PNG).',
                    ]),
                ],
            ])
            ->add('property', PropertysType::class,[
                'label' => false,
                'required' => false,
                'attr' => ['style' => 'display:none'],
            ])
            
            ->add('user', EntityType::class, [
                'class' => Users::class,
                'label' => false,
                'required' => false,
                'attr' => ['style' => 'display:none'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
        ]);
    }
}
