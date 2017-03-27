<?php

namespace AlbaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AlbaBundle\Entity\Bank;

class LoadBankData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $kaart = $manager->getRepository("AlbaBundle:Kaart")->findOneBy(['creditcardGegevens' => 'random kaart']);

        $bank = new Bank();
        $bank->setBank('random bank');
        $bank->setKaart($kaart);

        $manager->persist($bank);
        $manager->flush();
    }

    public function getOrder()
    {
        return 10;
    }
}