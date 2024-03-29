<?php

namespace AlbaBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReserveringType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('aankomst', TextType::class, array(
                'label' => 'Arrival'
            ))
            ->add('vertek', TextType::class, array(
                'label' => 'Departure'
            ))
            ->add('opmerking', TextType::class, array(
                'label' => 'Note'
            ))
            ->add('klant', EntityType::class, [
                'class' => 'AlbaBundle\Entity\Klant',
                'choice_label' => function($customer){
                    return $customer->getVoornaam();
                },
                'label' => 'Customer'
            ])

            ->add('kamer', EntityType::class, [
                'class' => 'AlbaBundle\Entity\Kamer',
                'choice_label'     => function($kamer){
                    return $kamer->getKamerNaam();
                },
                'by_reference' => true,
                'multiple' => true,
                'expanded' => true,
                'label' => 'Room'
            ])

            ->add('gast', EntityType::class, [
                'class' => 'AlbaBundle\Entity\Gast',
                'choice_label'     => function($gast){
                    return $gast->getVoorNaam();
                },
                'by_reference' => true,
                'multiple' => true,
                'expanded' => true,
                'label' => 'Guest'
            ])
            ->add('extra', EntityType::class, [
                'class' => 'AlbaBundle\Entity\Extra',
                'choice_label'     => function($extra){
                    return $extra->getType();
               },
                'by_reference' => true,
                'multiple' => true,
                'expanded' => true,
            ]);
        ;
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
