<?php

namespace AlbaBundle\DataFixtures\ORM;

use AlbaBundle\Entity\KamerPrijs;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadKamerPrijsData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $kamerPrijs = new KamerPrijs();
        $kamer = $manager->getRepository("AlbaBundle:Kamer")->findOneBy(["kamerNaam" => "kamer"]);
        $seizoen = $manager->getRepository("AlbaBundle:Seizoen")->findOneBy(["naam" => "winter"]);

        $kamerPrijs->setKamer($kamer);
        $kamerPrijs->setSeizoen($seizoen);
        $kamerPrijs->setPrijs(9);

        $manager->persist($kamerPrijs);
        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
}