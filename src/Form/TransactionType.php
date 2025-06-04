<?php

namespace App\Form;

use App\Entity\Transaction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; 
use App\Entity\Bien;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Email;




class TransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomAcheteur', TextType::class, [
                'label' => 'Nom de l\'acheteur',
                'required' => true,
            ])
            ->add('cinAcheteur', NumberType::class, [
                'label' => 'CIN de l\'acheteur',
                'required' => true,
                'attr' => [
                    'min' => 0,
                    'oninput' => "this.value = this.value.replace(/[^0-9]/g, '')",
                ],
            ])

            ->add('nomVendeur', TextType::class, [
                'label' => 'Nom de vendeur',
                'required' => true,
            ])
            ->add('telAcheteur', TextType::class, [
                'label' => 'Numéro de téléphone de l\'acheteur',
                'required' => true,
                'attr' => [
                    'oninput' => "this.value = this.value.replace(/[^0-9]/g, '')",
                    'maxlength' => 15, // optionnel, pour limiter la longueur
                ],
            ])
            ->add('telVendeur', TextType::class, [
                'label' => 'Numéro de téléphone de vendeur',
                'required' => true,
                'attr' => [
                    'oninput' => "this.value = this.value.replace(/[^0-9]/g, '')",
                    'maxlength' => 15, // optionnel aussi
                ],
            ])

            ->add('typeTransaction', ChoiceType::class, [
                'choices' => [
                    'Vente' => 'Vente',
                    'Location' => 'Location',
                ],
                'expanded' => false,
                'multiple' => false,
            ])
            
           ->add('prixVente', TextType::class, [
                'label' => 'Prix de vente',
                'required' => true, // ← Obligatoire
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Exemple: Le prix de location/vente du bien est de 20 000 000 DT',
                    'oninput' => "this.value = this.value.replace(/[^0-9]/g, '')", // ← Uniquement chiffres
                ],
            ])

            ->add('commission', TextType::class, [
                'label' => 'Commission',
                'required' => true, // ← Obligatoire
                'attr' => [
                    'oninput' => "this.value = this.value.replace(/[^0-9]/g, '')", // ← Uniquement chiffres
                ],
            ])

            ->add('dateTransaction', DateType::class, [
                'label' => 'Date de la transaction',
                'widget' => 'single_text',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'min' => (new \DateTime())->format('Y-m-d'), // 🔒 Empêche la sélection de dates passées
                    'onblur' => 'validateFutureDate(this)',      // 🔍 Vérifie à la sortie du champ
                ],
            ])
            ->add('declaration1', CheckboxType::class, [
                'label'    => 'Je certifie que les informations fournies sont exactes.',
                'required' => true, // ← Était false
                'attr'     => ['class' => 'form-check-input'],
            ])

            ->add('declaration2', CheckboxType::class, [
                'label'    => 'J’accepte de respecter toutes les conditions du contrat et de fournir des informations supplémentaires si nécessaire.',
                'required' => true, // ← Était false
                'attr'     => ['class' => 'form-check-input'],
            ])
            
            ->add('modePaiement', TextareaType::class, [
                'label' => 'Mode de paiement',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Exemple: Le paiement sera effectué selon le calendrier suivant : 10% à la signature, 90% à la livraison du bien. Tous les paiements seront effectués par virement bancaire.',
                ],
            ])
            
            ->add('payer', ChoiceType::class, [
                'label' => 'Payer',
                'choices' => [
                    'Payé' => 'paye',
                    'En attente' => 'en_attente',
                ],
                'required' => true,
                'expanded' => false, // Set to false for a dropdown, true for radio buttons
                'multiple' => false, // Don't allow multiple selections
            ])
            ->add('statutTransaction', ChoiceType::class, [
                'label' => 'Statut de la transaction',
                'choices' => [
                    'En cours' => 'en_cours',
                    'Terminé' => 'termine',
                    'Annulé' => 'annule',
                ],
                'required' => true,
            ])
            ->add('adresseAcheteur', TextType::class, [
                'label' => 'Adresse de l\'acheteur',
                'required' => true,
            ])
            ->add('objetContrat', TextareaType::class, [
                'label' => 'Objet du contrat',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Exemple: Ce contrat établit les termes de la location, vente d\'un bien immobilier. Le vendeur s\'engage à céder la propriété à l\'acheteur après le paiement du prix ferme et définitif.',
                ],
            ])
            ->add('descriptionBien', TextareaType::class, [
                'label' => 'Description du bien',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'La description sera automatiquement remplie selon le bien sélectionné...',
                    'readonly' => true, // ← AJOUT DE L'ATTRIBUT READONLY
                    'rows' => 8, // Optionnel : définir la hauteur du textarea
                ],
            ])
            
            ->add('obligationVendeur', TextareaType::class, [
                'label' => 'Obligations du vendeur',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Exemple: Le vendeur s\'engage à fournir toutes les informations nécessaires sur le bien, ainsi qu\'à effectuer les réparations nécessaires avant la signature du contrat.'
                ],
            ])
            
            ->add('obligationAcheteur', TextareaType::class, [
                'label' => 'Obligations de l\'acheteur',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Exemple: L\'acheteur s\'engage à respecter les conditions de paiement et à prendre possession du bien à la date convenue.'
                ],
            ])
            
            ->add('conditionsResiliation', TextareaType::class, [
                'label' => 'Conditions de résiliation',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Exemple: Le contrat peut être résilié par l\'une des parties en cas de non-respect des conditions convenues, avec une notification écrite de 30 jours.'
                ],
            ])
            
            ->add('confidentialite', TextareaType::class, [
                'label' => 'Confidentialité',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Exemple: Les parties s\'engagent à garder confidentielles toutes les informations échangées dans le cadre de ce contrat, sauf si la divulgation est exigée par la loi.'
                ],
            ])
            
            ->add('posteVendeur', TextType::class, [
                'label' => 'Poste du vendeur',
                'required' => true,
            ])
          
            ->add('mailVendeur', EmailType::class, [
                'label' => 'Email du vendeur',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir un email.']),
                    new Email(['message' => 'Veuillez saisir un email valide.']),
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'exemple@domaine.com',
                    'onblur' => 'validateEmailField(this)',
                ],
            ])
          
            ->add('signatureVendeur', TextType::class, [
                'label' => 'Signature du vendeur',
                'required' => false,
            ])
            ->add('bien', EntityType::class, [
                'class' => Bien::class,
                'choice_label' => function (Bien $bien) {
                    return $bien->getId() . ' - ' . $bien->getNomBien(); // ou autre champ descriptif
                },
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('b')
                        ->where('b.disponibilite = :disponibilite')
                        ->setParameter('disponibilite', 'Disponible');
                },
                'placeholder' => 'Sélectionnez un bien',
                'required' => false,
            ])
        
            ->add('signatureAcheteur', TextType::class, [
                'label' => 'Signature de l\'acheteur',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}
