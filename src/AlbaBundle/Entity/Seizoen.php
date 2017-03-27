<?php

namespace AlbaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seizoen
 *
 * @ORM\Table(name="seizoen")
 * @ORM\Entity(repositoryClass="AlbaBundle\Repository\SeizoenRepository")
 */
class Seizoen
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
     * @ORM\OneToMany(targetEntity="KamerPrijs", mappedBy="Seizoen")
     */
    private $kamer_prijs;


    /**
     * @var string
     *
     * @ORM\Column(name="Naam", type="string", length=255)
     */

    private $naam;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Begin_datum", type="date")
     */
    private $beginDatum;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Eind_datum", type="date")
     */
    private $eindDatum;


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
     * Set naam
     *
     * @param string $naam
     *
     * @return Seizoen
     */
    public function setNaam($naam)
    {
        $this->naam = $naam;

        return $this;
    }

    /**
     * Get naam
     *
     * @return string
     */
    public function getNaam()
    {
        return $this->naam;
    }

    /**
     * Set beginDatum
     *
     * @param \DateTime $beginDatum
     *
     * @return Seizoen
     */
    public function setBeginDatum($beginDatum)
    {
        $this->beginDatum = $beginDatum;

        return $this;
    }

    /**
     * Get beginDatum
     *
     * @return \DateTime
     */
    public function getBeginDatum()
    {
        return $this->beginDatum;
    }

    /**
     * Set eindDatum
     *
     * @param \DateTime $eindDatum
     *
     * @return Seizoen
     */
    public function setEindDatum($eindDatum)
    {
        $this->eindDatum = $eindDatum;

        return $this;
    }

    /**
     * Get eindDatum
     *
     * @return \DateTime
     */
    public function getEindDatum()
    {
        return $this->eindDatum;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->kamer_prijs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add kamerPrij
     *
     * @param \AlbaBundle\Entity\KamerPrijs $kamerPrij
     *
     * @return Seizoen
     */
    public function addKamerPrij(\AlbaBundle\Entity\KamerPrijs $kamerPrij)
    {
        $this->kamer_prijs[] = $kamerPrij;

        return $this;
    }

    /**
     * Remove kamerPrij
     *
     * @param \AlbaBundle\Entity\KamerPrijs $kamerPrij
     */
    public function removeKamerPrij(\AlbaBundle\Entity\KamerPrijs $kamerPrij)
    {
        $this->kamer_prijs->removeElement($kamerPrij);
    }

    /**
     * Get kamerPrijs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKamerPrijs()
    {
        return $this->kamer_prijs;
    }
}
