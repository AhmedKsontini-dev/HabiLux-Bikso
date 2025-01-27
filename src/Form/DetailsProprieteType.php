<?php

namespace App\Form;

use App\Entity\bien;
use App\Entity\DetailsPropriete;
use App\Entity\propriete;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailsProprieteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('valeurPropriete')
            ->add('propriete', EntityType::class, [
                'class' => propriete::class,
                'choice_label' => 'nomPropriete',
            ])
            ->add('bien', EntityType::class, [
                'class' => bien::class,
                'choice_label' => 'nomBien',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DetailsPropriete::class,
        ]);
    }
}
