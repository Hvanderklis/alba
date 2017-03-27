<?php

namespace AlbaBundle\DataFixtures\ORM;

use AlbaBundle\Entity\Seizoen;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSeizoenData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $seizoen = new Seizoen();
        $seizoen->setBeginDatum(new \DateTime());
        $seizoen->setEindDatum(new \DateTime());
        $seizoen->setNaam('winter');

        $manager->persist($seizoen);
        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}