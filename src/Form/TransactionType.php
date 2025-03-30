<?php

namespace App\Form;

use App\Entity\Transaction;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Doctrine\ORM\EntityRepository;
use App\Repository\UserRepository;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\CallbackTransformer;
use App\Entity\bien;
use App\Repository\BienRepository;

class TransactionType extends AbstractType
{
    private $bienRepository;

    public function __construct(BienRepository $bienRepository)
    {
        $this->bienRepository = $bienRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomAcheteur')
            ->add('telAcheteur')
            ->add('cinAcheteur')

            // Sélecteur pour Type de Transaction (Vente ou Achat)
            ->add('typeTransaction', ChoiceType::class, [
                'choices' => [
                    'Vente' => 'Vente',
                    'Location' => 'Location',
                ],
                'expanded' => false, // Affichage sous forme de liste déroulante
                'multiple' => false,
                'placeholder' => 'Sélectionnez un type de transaction',
            ])

            ->add('prixInitial')
            ->add('prixFinal')
            ->add('commission')

            // Supprimer l'affichage de dateTransaction (sera rempli automatiquement)
            ->add('dateTransaction', HiddenType::class, [
                'mapped' => false,
                'data' => (new \DateTime())->format('Y-m-d'), // Valeur par défaut
            ])

            // Sélecteur pour Mode de Paiement (Virement ou Chèque)
            ->add('modePaiement', ChoiceType::class, [
                'choices' => [
                    'Virement' => 'Virement',
                    'Chèque' => 'Chèque',
                ],
                'expanded' => false,
                'multiple' => false,
                'placeholder' => 'Sélectionnez un mode de paiement',
            ])

            ->add('nbrMois')
            ->add('prixParMois')

            // Sélecteur pour Payer (En cours ou Payé)
            ->add('payer', ChoiceType::class, [
                'choices' => [
                    'En cours' => 'En cours',
                    'Payé' => 'Payé',
                ],
                'expanded' => false,
                'multiple' => false,
                'placeholder' => 'Sélectionnez un statut de paiement',
            ])

            // Sélecteur pour Statut de Transaction (Validée ou En attente)
            ->add('statutTransaction', ChoiceType::class, [
                'choices' => [
                    'Validée' => 'Validée',
                    'En attente' => 'En attente',
                ],
                'expanded' => false,
                'multiple' => false,
                'placeholder' => 'Sélectionnez le statut de la transaction',
            ])

            ->add('bien', EntityType::class, [
                'class' => bien::class,
                'choice_label' => 'id',
            ])

            ->add('agent', EntityType::class, [
                'class' => User::class,
                'choice_label' => function (User $user) {
                    return $user->getNom() . ' ' . $user->getPrenom();
                },
                'query_builder' => function (UserRepository $repository) {
                    return $repository->createQueryBuilder('u')
                        ->where('u.roles LIKE :role')
                        ->setParameter('role', '%"ROLE_ADMIN"%');
                },
            ])

            ->add('dateTransaction', null, [
                'widget' => 'single_text',
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}
