<?php

namespace AlbaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gast
 *
 * @ORM\Table(name="gast")
 * @ORM\Entity(repositoryClass="AlbaBundle\Repository\GastRepository")
 */
class Gast
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
     * @ORM\Column(name="Voornaam", type="string", length=255)
     */
    private $voornaam;

    /**
     * @var string
     *
     * @ORM\Column(name="Achternaam", type="string", length=255)
     */
    private $achternaam;

    /**
     * @ORM\ManyToMany(targetEntity="Reservering")
     * @ORM\JoinTable(name="Gast_reservering",
     *      joinColumns={@ORM\JoinColumn(name="gast_nummer", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="reserveringsnummer", referencedColumnName="id", unique=true)})
     */
    private $reservering;
    /**
     * @ORM\ManyToOne(targetEntity="Klant", inversedBy="Gast")
     * @ORM\JoinColumn(name="Klantnummer", referencedColumnName="id")
     */
    private $klant;

    /**
     * @var string
     *
     * @ORM\Column(name="Tussenvoegsel", type="string", length=255, nullable=true)
     */
    private $tussenvoegsel;

    /**
     * @var string
     *
     * @ORM\Column(name="Woonplaats", type="string", length=255)
     */
    private $woonplaats;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Geboortedatum", type="date")
     */
    private $geboortedatum;

    /**
     * @var string
     *
     * @ORM\Column(name="Taal", type="string", length=255)
     */
    private $taal;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reservering = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set voornaam
     *
     * @param string $voornaam
     *
     * @return Gast
     */
    public function setVoornaam($voornaam)
    {
        $this->voornaam = $voornaam;

        return $this;
    }

    /**
     * Get voornaam
     *
     * @return string
     */
    public function getVoornaam()
    {
        return $this->voornaam;
    }

    /**
     * Set achternaam
     *
     * @param string $achternaam
     *
     * @return Gast
     */
    public function setAchternaam($achternaam)
    {
        $this->achternaam = $achternaam;

        return $this;
    }

    /**
     * Get achternaam
     *
     * @return string
     */
    public function getAchternaam()
    {
        return $this->achternaam;
    }

    /**
     * Set tussenvoegsel
     *
     * @param string $tussenvoegsel
     *
     * @return Gast
     */
    public function setTussenvoegsel($tussenvoegsel)
    {
        $this->tussenvoegsel = $tussenvoegsel;

        return $this;
    }

    /**
     * Get tussenvoegsel
     *
     * @return string
     */
    public function getTussenvoegsel()
    {
        return $this->tussenvoegsel;
    }

    /**
     * Set woonplaats
     *
     * @param string $woonplaats
     *
     * @return Gast
     */
    public function setWoonplaats($woonplaats)
    {
        $this->woonplaats = $woonplaats;

        return $this;
    }

    /**
     * Get woonplaats
     *
     * @return string
     */
    public function getWoonplaats()
    {
        return $this->woonplaats;
    }

    /**
     * Set geboortedatum
     *
     * @param \DateTime $geboortedatum
     *
     * @return Gast
     */
    public function setGeboortedatum($geboortedatum)
    {
        $this->geboortedatum = $geboortedatum;

        return $this;
    }

    /**
     * Get geboortedatum
     *
     * @return \DateTime
     */
    public function getGeboortedatum()
    {
        return $this->geboortedatum;
    }

    /**
     * Set taal
     *
     * @param string $taal
     *
     * @return Gast
     */
    public function setTaal($taal)
    {
        $this->taal = $taal;

        return $this;
    }

    /**
     * Get taal
     *
     * @return string
     */
    public function getTaal()
    {
        return $this->taal;
    }

    /**
     * Add reservering
     *
     * @param \AlbaBundle\Entity\Reservering $reservering
     *
     * @return Gast
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
     * Set klant
     *
     * @param \AlbaBundle\Entity\Klant $klant
     *
     * @return Gast
     */
    public function setKlant(\AlbaBundle\Entity\Klant $klant = null)
    {
        $this->klant = $klant;

        return $this;
    }

    /**
     * Get klant
     *
     * @return \AlbaBundle\Entity\Klant
     */
    public function getKlant()
    {
        return $this->klant;
    }
}
