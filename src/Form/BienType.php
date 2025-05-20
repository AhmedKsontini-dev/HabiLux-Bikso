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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;



class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomBien', null, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Ex : Appartement S+2',
                ],
            ])
            ->add('adresseBien', null, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Adresse complète du bien',
                ],
            ])
            ->add('prixBien', null, [
                'required' => true,
            ])
            ->add('typeOffre', ChoiceType::class, [
                'choices' => [
                    'À Louer' => 'A Louer',
                    'À Vendre' => 'A Vendre',
                ],
                'placeholder' => 'Choisissez le type d\'offre', // <-- ajout ici
                'label' => 'Type de l\'offre',
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
            
            ->add('description', TextareaType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Décrivez le bien en quelques mots',
                    'rows' => 5, // Optionnel : nombre de lignes visibles
                    'class' => 'form-control', // si tu veux un style Bootstrap par exemple
                ],
            ])
            ->add('AfficherPrix', CheckboxType::class, [
                'label' => 'Afficher le Prix',
                'required' => false,
                'attr' => ['class' => 'form-check-input'],
            ])
            ->add('BienAfficher', CheckboxType::class, [
                'label' => 'Afficher le Bien',
                'required' => false,
                'attr' => ['class' => 'form-check-input'],
            ])
            ->add('gouvernorat', EntityType::class, [
                'class' => Gouvernorat::class,
                'choice_label' => 'nomGouvernorat',
                'required' => true,
                'placeholder' => 'Choisissez un gouvernorat',
            ])
            ->add('ville', EntityType::class, [
                'class' => Ville::class,
                'choice_label' => 'nomVille',
                'required' => true,
                'placeholder' => 'Choisissez une ville',
            ])
            ->add('type', EntityType::class, [
                'class' => typeBien::class,
                'choice_label' => 'nomType',
                'label' => 'Type de bien',
                'attr' => ['class' => 'form-control'],
                'required' => true,
                'placeholder' => 'Choisissez un type de bien', // <-- ligne ajoutée
            ])            
            ->add('positionMap', null, [
                'label' => 'Position sur la carte',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Cliquez sur la carte pour obtenir les coordonnées',
                ],
                'required' => true,
            ])
            ->add('nomProprietaire', TextType::class, [
                'label' => 'Nom de propriétaire',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Ex : Mohamed Ben Ali',
                ],
            ])
            ->add('telProprietaire1', TelType::class, [
                'label' => 'Téléphone de propriétaire',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Ex : +216 20 123 456',
                ],
            ])
            ->add('telProprietaire2', TelType::class, [
                'label' => 'Téléphone secondaire de propriétaire',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ex : +216 29 456 789 (facultatif)',
                ],
            ])
            ->add('adresseProprietaire', TextType::class, [
                'label' => 'Adresse de propriétaire',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Adresse complète du propriétaire',
                ],
            ])
            
            
            ->add('imageBien', FileType::class, [
                'label' => 'Ajouter des images',
                'mapped' => false,
                'required' => false,
                'multiple' => true,
                'attr' => ['class' => 'form-control'],
            ])
            
            ->add('youtubeId', TextType::class, [
                'label' => 'ID de la vidéo YouTube',
                'required' => false,
                'help' => 'Exemple : pour https://www.youtube.com/watch?v=abc12345, saisir uniquement abc12345'
            ])

            ->add('disponibilite', ChoiceType::class, [
                'label' => 'Disponibilité',
                'choices' => [
                    'Disponible' => 'Disponible',
                    'Louée' => 'Louee',
                    'Non disponible' => 'Non_disponible',
                ],
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