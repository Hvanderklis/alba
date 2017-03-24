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
     * Get id
     *
     * @return int
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
}

