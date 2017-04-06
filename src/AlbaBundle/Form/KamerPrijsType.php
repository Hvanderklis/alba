<?php

namespace AlbaBundle\Form;

use function Sodium\add;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KamerPrijsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('prijs')->add('kamer')->add('seizoen');
        $builder->add('kamer', EntityType::class, array(
            'class' => 'AlbaBundle\Entity\Kamer',
            'label' => 'Room',
            'choice_label' => function ($kamer){
                return $kamer->getKamerNaam();
    }
        ) );
        $builder->add('seizoen', EntityType::class, array(
            'class' => 'AlbaBundle\Entity\Seizoen',
            'label' => 'Season',
            'choice_label' => function ($seizoen){
                return $seizoen->getNaam();
            }
        ) );

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AlbaBundle\Entity\KamerPrijs'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'albabundle_kamerprijs';
    }


}