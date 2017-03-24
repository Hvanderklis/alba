<?php

namespace AlbaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kamer_Prijs
 *
 * @ORM\Table(name="kamer__prijs")
 * @ORM\Entity(repositoryClass="AlbaBundle\Repository\Kamer_PrijsRepository")
 */
class Kamer_Prijs
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="Prijs", type="integer")
     */
    private $prijs;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set prijs
     *
     * @param integer $prijs
     *
     * @return Kamer_Prijs
     */
    public function setPrijs($prijs)
    {
        $this->prijs = $prijs;

        return $this;
    }

    /**
     * Get prijs
     *
     * @return int
     */
    public function getPrijs()
    {
        return $this->prijs;
    }
}

