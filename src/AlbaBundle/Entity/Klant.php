<?php

namespace AlbaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Klant
 *
 * @ORM\Table(name="klant")
 * @ORM\Entity(repositoryClass="AlbaBundle\Repository\KlantRepository")
 */
class Klant
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
     * @ORM\Column(name="Achternaam", type="string", length=255)
     */
    private $achternaam;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Geboortedatum", type="date")
     */
    private $geboortedatum;

    /**
     * @var string
     *
     * @ORM\Column(name="Geslacht", type="string", length=255)
     */
    private $geslacht;

    /**
     * @var string
     *
     * @ORM\Column(name="Plaats", type="string", length=255)
     */
    private $plaats;

    /**
     * @var string
     *
     * @ORM\Column(name="Taal", type="string", length=255)
     */
    private $taal;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=255)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="Telefoon", type="integer")
     */
    private $telefoon;


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
     * @return Klant
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
     * @return Klant
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
     * Set achternaam
     *
     * @param string $achternaam
     *
     * @return Klant
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
     * Set geboortedatum
     *
     * @param \DateTime $geboortedatum
     *
     * @return Klant
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
     * Set geslacht
     *
     * @param string $geslacht
     *
     * @return Klant
     */
    public function setGeslacht($geslacht)
    {
        $this->geslacht = $geslacht;

        return $this;
    }

    /**
     * Get geslacht
     *
     * @return string
     */
    public function getGeslacht()
    {
        return $this->geslacht;
    }

    /**
     * Set plaats
     *
     * @param string $plaats
     *
     * @return Klant
     */
    public function setPlaats($plaats)
    {
        $this->plaats = $plaats;

        return $this;
    }

    /**
     * Get plaats
     *
     * @return string
     */
    public function getPlaats()
    {
        return $this->plaats;
    }

    /**
     * Set taal
     *
     * @param string $taal
     *
     * @return Klant
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
     * Set email
     *
     * @param string $email
     *
     * @return Klant
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telefoon
     *
     * @param integer $telefoon
     *
     * @return Klant
     */
    public function setTelefoon($telefoon)
    {
        $this->telefoon = $telefoon;

        return $this;
    }

    /**
     * Get telefoon
     *
     * @return int
     */
    public function getTelefoon()
    {
        return $this->telefoon;
    }
}

