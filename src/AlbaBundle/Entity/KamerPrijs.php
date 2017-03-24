<?php

namespace AlbaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KamerPrijs
 *
 * @ORM\Table(name="kamer_prijs")
 * @ORM\Entity(repositoryClass="AlbaBundle\Repository\KamerPrijsRepository")
 */
class KamerPrijs
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
     * @return integer
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
     * @return KamerPrijs
     */
    public function setPrijs($prijs)
    {
        $this->prijs = $prijs;

        return $this;
    }

    /**
     * Get prijs
     *
     * @return integer
     */
    public function getPrijs()
    {
        return $this->prijs;
    }
}
