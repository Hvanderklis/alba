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
     * @ORM\ManyToOne(targetEntity="Kaart", inversedBy="betaling")
     * @ORM\JoinColumn(name="Kaartnummer", referencedColumnName="id")
     */
    private $kaart;

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
     * Set kaart
     *
     * @param \AlbaBundle\Entity\Kaart $kaart
     *
     * @return Betaling
     */
    public function setKaart(\AlbaBundle\Entity\Kaart $kaart = null)
    {
        $this->kaart = $kaart;

        return $this;
    }

    /**
     * Get kaart
     *
     * @return \AlbaBundle\Entity\Kaart
     */
    public function getKaart()
    {
        return $this->kaart;
    }
}
