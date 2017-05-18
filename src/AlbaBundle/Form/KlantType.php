<?php

namespace AlbaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('voornaam', TextType::class, array(
                'label' => 'First Name'
            ))
            ->add('tussenvoegsel', TextType::class, array(
                'label' => 'Prefix'
            ))
            ->add('achternaam', TextType::class, array(
                'label' => 'Last Name'
            ))
            ->add('geboortedatum', BirthdayType::class, array(
                'placeholder' => array(
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                ),
                'label' => 'Birthday'
            ))
            ->add('geslacht', ChoiceType::class, array(
                'choices'  => array(
                    'Male' => "Man",
                    'Female' => "Vrouw",
                ),
                'label' => 'Gender'
            ))
            ->add('plaats', TextType::class, array(
                'label' => 'City'
            ))
            ->add('taal', TextType::class, array(
                'label' => 'Language'
            ))
            ->add('email', TextType::class, array(
                'label' => 'Email'
            ))
            ->add('telefoon', TextType::class, array(
                'label' => 'Phone Number'
            ))
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
