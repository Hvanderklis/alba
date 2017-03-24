<?php

namespace AlbaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kamer
 *
 * @ORM\Table(name="kamer")
 * @ORM\Entity(repositoryClass="AlbaBundle\Repository\KamerRepository")
 */
class Kamer
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
     * @var string
     *
     * @ORM\Column(name="Kamer_naam", type="string", length=255)
     */
    private $kamerNaam;

    /**
     * @var int
     *
     * @ORM\Column(name="Prijs", type="integer")
     */
    private $prijs;

    /**
     * @var string
     *
     * @ORM\Column(name="Omschrijving", type="string", length=255)
     */
    private $omschrijving;


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
     * Set kamerNaam
     *
     * @param string $kamerNaam
     *
     * @return Kamer
     */
    public function setKamerNaam($kamerNaam)
    {
        $this->kamerNaam = $kamerNaam;

        return $this;
    }

    /**
     * Get kamerNaam
     *
     * @return string
     */
    public function getKamerNaam()
    {
        return $this->kamerNaam;
    }

    /**
     * Set prijs
     *
     * @param integer $prijs
     *
     * @return Kamer
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

    /**
     * Set omschrijving
     *
     * @param string $omschrijving
     *
     * @return Kamer
     */
    public function setOmschrijving($omschrijving)
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    /**
     * Get omschrijving
     *
     * @return string
     */
    public function getOmschrijving()
    {
        return $this->omschrijving;
    }
}

