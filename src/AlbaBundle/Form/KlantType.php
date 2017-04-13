<?php

namespace AlbaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class KlantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('voornaam')
            ->add('tussenvoegsel')
            ->add('achternaam')
            ->add('geboortedatum', BirthdayType::class, array(
                'placeholder' => 'Select a value'))
            ->add('geslacht', ChoiceType::class, array(
                'choices'  => array(
                    'Man' => "Man",
                    'Vrouw' => "Vrouw",
                ),
            ))
            ->add('plaats')
            ->add('taal')
            ->add('email')
            ->add('telefoon')
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AlbaBundle\Entity\Klant'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'albabundle_klant';
    }
}
