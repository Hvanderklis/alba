<?php

namespace AlbaBundle\DataFixtures\ORM;

use AlbaBundle\Entity\Extra;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadExtraData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $extra = new Extra();

        $extra->setOmschrijving('dit is een omschrijving');
        $extra->setPrijs(5);
        $extra->setType('een type');

        $manager->persist($extra);
        $manager->flush();
    }

    public function getOrder()
    {
        return 9;
    }
}