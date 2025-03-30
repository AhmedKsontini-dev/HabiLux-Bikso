<?php

namespace App\Form;

use App\Entity\bien;
use App\Entity\Gouvernorat;
use App\Entity\TypeBien;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;



class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomBien')
            ->add('adresseBien')
            ->add('prixBien')
            ->add('typeOffre', ChoiceType::class, [
                'choices' => [
                    'À Louer' => 'A Louer',
                    'À Vendre' => 'A Vendre',
                ],
                'label' => 'Type de l\'offre',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('description')
            ->add('AfficherPrix', CheckboxType::class, [
                'label' => 'Afficher le Prix',
                'required' => false,
                'attr' => ['class' => 'form-check-input'],
            ])
            ->add('gouvernorat', EntityType::class, [
                'class' => Gouvernorat::class,
                'choice_label' => 'nomGouvernorat',
            ])
            ->add('ville', EntityType::class, [
                'class' => Ville::class,
                'choice_label' => 'nomVille',
            ])
            ->add('type', EntityType::class, [
                'class' => typeBien::class,
                'choice_label' => 'nomType',
                'label' => 'Type de bien',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('positionMap', null, [
                'label' => 'Position sur la carte',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Cliquez sur la carte pour obtenir les coordonnées'],
            ])
            ->add('nomClient', TextType::class, [
                'label' => 'Nom du client',
                'required' => true,
            ])
            ->add('telClient', TelType::class, [
                'label' => 'Téléphone du client',
                'required' => true,
            ])
            ->add('telClient2', TelType::class, [
                'label' => 'Téléphone secondaire du client',
                'required' => false,
            ])
            ->add('adresseClient', TextType::class, [
                'label' => 'Adresse du client',
                'required' => true,
            ])
            
            ->add('imageBien', FileType::class, [
                'label' => 'Ajouter des images',
                'mapped' => false,
                'required' => false,
                'multiple' => true,
                'attr' => ['class' => 'form-control'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bien::class,
        ]);
    }
}
