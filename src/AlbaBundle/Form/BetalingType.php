<?php

namespace AlbaBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BetalingType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('betaald')
            ->add('datum')
            ->add('reservering', EntityType::class, [
                'class' => 'AlbaBundle\Entity\Reservering',
                'choice_label' => function($reserveren){
                    return $reserveren->getId();
                }
            ])
            ->add('klant', EntityType::class, [
                'class' => 'AlbaBundle\Entity\Klant',
                'choice_label' => function($customer){
                    return $customer->getVoornaam();
                }
            ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AlbaBundle\Entity\Betaling'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'albabundle_betaling';
    }


}
