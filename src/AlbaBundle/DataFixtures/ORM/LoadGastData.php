<?php

namespace AlbaBundle\DataFixtures\ORM;

use AlbaBundle\Entity\Gast;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadGastData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $gast = new Gast();
        $gast->setTaal('Netherlands');
        $gast->setGeboortedatum(new \DateTime());
        $gast->setTussenvoegsel('de');
        $gast->setVoornaam('klaas');
        $gast->setWoonplaats('Zoetermeer');
        $klant = $manager->getRepository("AlbaBundle:Klant")->findOneBy(['voornaam' => 'piet']);
        $gast->setKlant($klant);
        $gast->setAchternaam("hoog");

        $manager->persist($gast);
        $manager->flush();
    }

    public function getOrder()
    {
        return 8;
    }
}