<?php

namespace AlbaBundle\DataFixtures\ORM;

use AlbaBundle\Entity\Reservering;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadReserveringData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $klant = $manager->getRepository("AlbaBundle:Klant")->findOneBy(["voornaam" => "piet"]);
        $reservering = new Reservering();
        $reservering->setKlant($klant);
        $reservering->setAankomst(new \DateTime());
        $reservering->setVertek(new \DateTime());
        $reservering->setOpmerking("een opmerking");

        $manager->persist($reservering);
        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}