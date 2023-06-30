<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Car;
use App\Entity\Equipment;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nom',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])
            ->add('price', NumberType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Prix',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Description',
                'label_attr' => ['class' => 'form-label mt-4'],      
            ])
            ->add('year', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'min' => 2010,
                    'max' => date('Y'),
                    'step' => 1,
                ],
                'label' => 'Année',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])
            ->add('mileage', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Kilometre',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])
            ->add('color', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Couleur',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])
            ->add('topping', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Garniture intrieur',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])
            ->add('brand', EntityType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Marque',
                'class' => Brand::class,
                'mapped' => false,
            ])
            ->add('equipment', EntityType::class, [
                'attr' => [
                    'class' => 'form-control form-equipment'
                ],
                'label' => 'Équipement',
                'class' => Equipment::class,
                'choice_label' => 'name',
                'multiple' => true, // Permettre la sélection de plusieurs options si nécessaire
                'expanded' => true, // Afficher les options sous forme de cases à cocher si nécessaire
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn button-car mt-4'
                ],
                'label' => 'Enregistrer l\'offre'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
