<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('tel')
            ->add('adresse')
            ->add('localisation')
            ->add('cin')
            ->add('poste', ChoiceType::class, [
                'choices' => [
                    'Administrateur de biens' => 'Administrateur de biens',
                    'Agent immobilier' => 'Agent immobilier',
                    'Conseiller en immobilier' => 'Conseiller en immobilier',
                    'Mandataire immobilier' => 'Mandataire immobilier',
                    'Chasseur immobilier' => 'Chasseur immobilier',
                    'Responsable d’agence' => 'Responsable d’agence',
                    'Expert immobilier' => 'Expert immobilier',
                ],
                'multiple' => true,  // Permet plusieurs choix
                'expanded' => false,  // Liste déroulante
                'label' => 'Poste',
                'required' => false, // Rend le champ non obligatoire
                'attr' => ['class' => 'form-control']
            ])
      
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Admin' => 'ROLE_ADMIN',
                    'Client' => 'ROLE_USER',    
                ],
                'expanded' => false,  // Permet d'afficher une liste "select" classique
                'multiple' => true,  // Un seul choix possible
                'label' => 'Rôle',
                'attr' => ['class' => 'form-control'],  // Ajout de la classe Bootstrap
            ])
            ->add('photoProfil', FileType::class, [
                'label' => 'Ajouter des images',
                'mapped' => false,
                'required' => false,
                'multiple' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('password')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
