<?php

namespace AlbaBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KamerPrijsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('prijs', TextType::class, array(
                'label' => 'Price'
                ))
            ->add('kamer', TextType::class, array(
                'label' => 'Room'
            ))
            ->add('seizoen', TextType::class, array(
                'label' => 'Season'
            ));
        $builder->add('kamer', EntityType::class, array(
            'class' => 'AlbaBundle\Entity\Kamer',
            'label' => 'Room',
            'choice_label' => function ($kamer){
                return $kamer->getKamerNaam();
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
