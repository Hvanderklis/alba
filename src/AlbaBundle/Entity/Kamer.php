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
     * @ORM\ManyToMany(targetEntity="Reservering")
     * @ORM\JoinTable(name="Kamer_reservering",
     *      joinColumns={@ORM\JoinColumn(name="kamer_nummer", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="reserveringsnummer", referencedColumnName="id", unique=true)})
     */
    private $reservering;

    /**
     * @ORM\OneToMany(targetEntity="KamerAfbeelding", mappedBy="kamer")
     */
    private $kamerAfbeelding;

    /**
     * @ORM\OneToMany(targetEntity="KamerPrijs", mappedBy="kamer")
     */
    private $kamerPrijs;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reservering = new \Doctrine\Common\Collections\ArrayCollection();
        $this->kamerAfbeelding = new \Doctrine\Common\Collections\ArrayCollection();
        $this->kamerPrijs = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return integer
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

    /**
     * Add reservering
     *
     * @param \AlbaBundle\Entity\Reservering $reservering
     *
     * @return Kamer
     */
    public function addReservering(\AlbaBundle\Entity\Reservering $reservering)
    {
        $this->reservering[] = $reservering;

        return $this;
    }

    /**
     * Remove reservering
     *
     * @param \AlbaBundle\Entity\Reservering $reservering
     */
    public function removeReservering(\AlbaBundle\Entity\Reservering $reservering)
    {
        $this->reservering->removeElement($reservering);
    }

    /**
     * Get reservering
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservering()
    {
        return $this->reservering;
    }

    /**
     * Add kamerAfbeelding
     *
     * @param \AlbaBundle\Entity\KamerAfbeelding $kamerAfbeelding
     *
     * @return Kamer
     */
    public function addKamerAfbeelding(\AlbaBundle\Entity\KamerAfbeelding $kamerAfbeelding)
    {
        $this->kamerAfbeelding[] = $kamerAfbeelding;

        return $this;
    }

    /**
     * Remove kamerAfbeelding
     *
     * @param \AlbaBundle\Entity\KamerAfbeelding $kamerAfbeelding
     */
    public function removeKamerAfbeelding(\AlbaBundle\Entity\KamerAfbeelding $kamerAfbeelding)
    {
        $this->kamerAfbeelding->removeElement($kamerAfbeelding);
    }

    /**
     * Get kamerAfbeelding
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKamerAfbeelding()
    {
        return $this->kamerAfbeelding;
    }

    /**
     * Add kamerPrij
     *
     * @param \AlbaBundle\Entity\KamerPrijs $kamerPrij
     *
     * @return Kamer
     */
    public function addKamerPrij(\AlbaBundle\Entity\KamerPrijs $kamerPrij)
    {
        $this->kamerPrijs[] = $kamerPrij;

        return $this;
    }

    /**
     * Remove kamerPrij
     *
     * @param \AlbaBundle\Entity\KamerPrijs $kamerPrij
     */
    public function removeKamerPrij(\AlbaBundle\Entity\KamerPrijs $kamerPrij)
    {
        $this->kamerPrijs->removeElement($kamerPrij);
    }

    /**
     * Get kamerPrijs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKamerPrijs()
    {
        return $this->kamerPrijs;
    }
}
