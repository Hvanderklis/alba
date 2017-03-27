<?php

namespace AlbaBundle\DataFixtures\ORM;

use AlbaBundle\Entity\Betaling;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBetalingData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $kaart = $manager->getRepository('AlbaBundle:Kaart')->findOneBy(["creditcardGegevens" => "random kaart"]);

        $betaling = new Betaling();
        $betaling->setBetaald(1);
        $betaling->setDatum(new \DateTime());
        $betaling->setKaart($kaart);

        $manager->persist($betaling);
        $manager->flush();
    }

    public function getOrder()
    {
        return 11;
    }

}