<?php

namespace AlbaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
<<<<<<< HEAD
=======
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
>>>>>>> fb2e722c37dc7607dafb49f8df1eda6f9516d573

class KlantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('voornaam')->add('tussenvoegsel')->add('achternaam')->add('geboortedatum')->add('geslacht')->add('plaats')->add('taal')->add('email')->add('telefoon');
<<<<<<< HEAD
=======

        $builder->add('geslacht', ChoiceType::class, array(
            'choices'  => array(
                'Man' => "Man",
                'Vrouw' => "Vrouw",
            ),
        ));
>>>>>>> fb2e722c37dc7607dafb49f8df1eda6f9516d573
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
