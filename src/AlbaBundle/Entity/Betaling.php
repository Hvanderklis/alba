<?php

namespace AlbaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Betaling
 *
 * @ORM\Table(name="betaling")
 * @ORM\Entity(repositoryClass="AlbaBundle\Repository\BetalingRepository")
 */
class Betaling
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
     * @ORM\Column(name="Betaald", type="string", length=255)
     */
    private $betaald;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Datum", type="date")
     */
    private $datum;

    /**
     * @ORM\OneToOne(targetEntity="AlbaBundle\Entity\Reservering", inversedBy="betaling")
     * @ORM\JoinColumn(referencedColumnName="id", name="reservation_id")
     */
    private $reservering;

    /**
     * @ORM\OneToOne(targetEntity="AlbaBundle\Entity\Klant", inversedBy="betaling")
     * @ORM\JoinColumn(referencedColumnName="id", name="customer_id")
     */
    private $klant;

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
     * Set betaald
     *
     * @param string $betaald
     *
     * @return Betaling
     */
    public function setBetaald($betaald)
    {
        $this->betaald = $betaald;

        return $this;
    }

    /**
     * Get betaald
     *
     * @return string
     */
    public function getBetaald()
    {
        return $this->betaald;
    }

    /**
     * Set datum
     *
     * @param \DateTime $datum
     *
     * @return Betaling
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;

        return $this;
    }

    /**
     * Get datum
     *
     * @return \DateTime
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * Set reservering
     *
     * @param \AlbaBundle\Entity\Reservering $reservering
     *
     * @return Betaling
     */
    public function setReservering(\AlbaBundle\Entity\Reservering $reservering = null)
    {
        $this->reservering = $reservering;

        return $this;
    }

    /**
     * Get reservering
     *
     * @return \AlbaBundle\Entity\Reservering
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
     * @return Betaling
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
