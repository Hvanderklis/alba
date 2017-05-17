<?php

namespace AlbaBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GastType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('voornaam', TextType::class, array(
                'label' => 'First Name'
            ))
            ->add('tussenvoegsel', TextType::class, array(
                'label' => 'Prefix'
            ))
            ->add('achternaam', TextType::class, array(
                'label' => 'Last Name'
            ))
            ->add('woonplaats', TextType::class, array(
                'label' => 'place of residence'
            ))
            ->add('geboortedatum', BirthdayType::class, array(
                'placeholder' => array(
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
            ),
                'label' => 'Birthday'
            ))
            ->add('taal', TextType::class, array(
                'label' => 'Language'
            ))
            ->add('reservering', EntityType::class, [
                'class' => 'AlbaBundle\Entity\Reservering',
                'mapped' => false,
                'choice_label' => function($resevering){
                    return $resevering->getId();
                },
                'label' => 'Reservation'
            ])
            ->add('klant', EntityType::class, [
                'class' => 'AlbaBundle\Entity\Klant',
                'choice_label' => function($klant){
                    return $klant->getVoornaam();
                },
                'label' => 'Customer'
            ]);

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AlbaBundle\Entity\Gast'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'albabundle_gast';
    }

}
