<?php

namespace AlbaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReserveringType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('aankomst')->add('vertek')->add('opmerking')->add('klant');

        $builder->add('klant', EntityType::class, array(
            'class' => 'AlbaBundle\Entity\klant',
            'label' => 'Klant',
            'choice_label' => function ($klant){
                return $klant->getGeslacht();
            }
        ) );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AlbaBundle\Entity\Reservering'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'albabundle_reservering';
    }


}
