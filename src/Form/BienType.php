<?php

namespace App\Form;

use App\Entity\Bien;
use App\Entity\Gouvernorat;
use App\Entity\TypeBien;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
            ->add('localisationBien')
            ->add('AfficherPrix', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,  // Affiche "Oui" dans le formulaire, enregistre `true` en base de données.
                    'Non' => false, // Affiche "Non" dans le formulaire, enregistre `false` en base de données.
                ],
                'label' => 'Afficher le Prix',
                'expanded' => false,  // Change l'affichage en boutons radio
                'multiple' => false, // Uniquement une option peut être sélectionnée
                'attr' => ['class' => 'form-check'], // Ajoute une classe pour le style
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
