<?php

namespace AlbaBundle\DataFixtures\ORM;

use AlbaBundle\Entity\Klant;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadKlantData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $klant = new Klant();
        $klant->setVoornaam('piet');
        $klant->setTussenvoegsel('de');
        $klant->setAchternaam('hoog');
        $klant->setGeslacht("vrouw");
        $klant->setEmail('pietdehoog@gmail.com');
        $klant->setGeboortedatum(new \DateTime());
        $klant->setPlaats('Zoetermeer');
        $klant->setTaal('Netherlands');
        $klant->setTelefoon(0000);

        $manager->persist($klant);
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}