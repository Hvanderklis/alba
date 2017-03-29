<?php

namespace AlbaBundle\DataFixtures\ORM;

use AlbaBundle\Entity\Kaart;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadKaartData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $klant = $manager->getRepository("AlbaBundle:Klant")->findOneBy(['voornaam' => 'piet']);

        $kaart = new Kaart();
        $kaart->setCreditcardGegevens('random kaart');
        $kaart->setVervaldatum(new \DateTime());
        $kaart->setKlant($klant);

        $manager->persist($kaart);
        $manager->flush();
    }

    public function getOrder()
    {
        return 7;
    }
}