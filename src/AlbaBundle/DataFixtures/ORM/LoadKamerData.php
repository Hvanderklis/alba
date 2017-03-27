<?php

namespace AlbaBundle\DataFixtures\ORM;

use AlbaBundle\Entity\Kamer;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadKamerData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $kamer = new Kamer();
        $kamer->setPrijs(5);
        $kamer->setOmschrijving('dit is een omschrijving');
        $kamer->setKamerNaam('kamer');

        $manager->persist($kamer);
        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}