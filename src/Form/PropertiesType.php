<?php

namespace App\Form;

use App\Entity\Options;
use App\Entity\Properties;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PropertiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre du bien',
                'required' => true,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => true,
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image du bien',
                'required' => false,
            ])
            ->add('surface', IntegerType::class, [
                'label' => 'Surface',
                'required' => true,
            ])
            ->add('rooms', IntegerType::class, [
                'label' => 'Nombre de pièces',
                'required' => true,
            ])
            ->add('bedrooms', IntegerType::class, [
                'label' => 'Nombre de chambres',
                'required' => true,
            ])
            ->add('ceil', IntegerType::class, [
                'label' => '',
                'required' => true,
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix',
                'required' => true,
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'required' => true,
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse',
                'required' => true,
            ])
            ->add('postal_code', TextType::class,[
                'label' => 'Code postal',
                'required' => true,
            ])
            ->add('sold', options: [
                'label' => 'Vendu ?',
            ])
            ->add('options', EntityType::class, [
                'class' => Options::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Properties::class,
        ]);
    }
}
