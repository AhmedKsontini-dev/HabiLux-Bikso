<?php

namespace App\Form;

use App\Entity\Propriete;
use App\Entity\TypeBien;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProprieteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomPropriete')
            ->add('type', EntityType::class, [
                'class' => typeBien::class,
                'choice_label' => 'nomType',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Propriete::class,
        ]);
    }
}
