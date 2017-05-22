<?php

namespace AlbaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservering
 *
 * @ORM\Table(name="reservering")
 * @ORM\Entity(repositoryClass="AlbaBundle\Repository\ReserveringRepository")
 */
class Reservering
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
     * @var \DateTime
     *
     * @ORM\Column(name="Aankomst", type="date")
     */
    private $aankomst;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Vertek", type="date")
     */
    private $vertek;

    /**
     * @var string
     *
     * @ORM\Column(name="Opmerking", type="string", length=255, nullable=true)
     */
    private $opmerking;

    /**
     * @ORM\ManyToOne(targetEntity="Klant", inversedBy="reservering")
     * @ORM\JoinColumn(name="Klantnummer", referencedColumnName="id")
     */
    private $klant;

    /**
     * @ORM\ManyToMany(targetEntity="AlbaBundle\Entity\Kamer", inversedBy="reservering")
     * @ORM\JoinTable(name="kamer_reservering")
     */
    private $kamer;

    /**
     * @ORM\ManyToMany(targetEntity="AlbaBundle\Entity\Gast", inversedBy="reservering")
     * @ORM\JoinTable(name="gast_reservering")
     */
    private $gast;

    /**
     * @ORM\ManyToMany(targetEntity="AlbaBundle\Entity\Extra", inversedBy="reservering")
     * @ORM\JoinTable(name="extra_reservering")
     */
    private $extra;

    /**
     * @ORM\OneToOne(targetEntity="AlbaBundle\Entity\Betaling", mappedBy="reservering")
     */
    private $betaling;

    /**
     * @ORM\Column(name="prijs", type="float", nullable=true)
     */
    private $prijs;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->kamer = new \Doctrine\Common\Collections\ArrayCollection();
        $this->gast = new \Doctrine\Common\Collections\ArrayCollection();
        $this->extra = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set aankomst
     *
     * @param \DateTime $aankomst
     *
     * @return Reservering
     */
    public function setAankomst($aankomst)
    {
        $this->aankomst = $aankomst;

        return $this;
    }

    /**
     * Get aankomst
     *
     * @return \DateTime
     */
    public function getAankomst()
    {
        return $this->aankomst;
    }

    /**
     * Set vertek
     *
     * @param \DateTime $vertek
     *
     * @return Reservering
     */
    public function setVertek($vertek)
    {
        $this->vertek = $vertek;

        return $this;
    }

    /**
     * Get vertek
     *
     * @return \DateTime
     */
    public function getVertek()
    {
        return $this->vertek;
    }

    /**
     * Set opmerking
     *
     * @param string $opmerking
     *
     * @return Reservering
     */
    public function setOpmerking($opmerking)
    {
        $this->opmerking = $opmerking;

        return $this;
    }

    /**
     * Get opmerking
     *
     * @return string
     */
    public function getOpmerking()
    {
        return $this->opmerking;
    }

    /**
     * Set prijs
     *
     * @param float $prijs
     *
     * @return Reservering
     */
    public function setPrijs($prijs)
    {
        $this->prijs = $prijs;

        return $this;
    }

    /**
     * Get prijs
     *
     * @return float
     */
    public function getPrijs()
    {
        return $this->prijs;
    }

    /**
     * Set klant
     *
     * @param \AlbaBundle\Entity\Klant $klant
     *
     * @return Reservering
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

    /**
     * Add kamer
     *
     * @param \AlbaBundle\Entity\Kamer $kamer
     *
     * @return Reservering
     */
    public function addKamer(\AlbaBundle\Entity\Kamer $kamer)
    {
        $this->kamer[] = $kamer;

        return $this;
    }

    /**
     * Remove kamer
     *
     * @param \AlbaBundle\Entity\Kamer $kamer
     */
    public function removeKamer(\AlbaBundle\Entity\Kamer $kamer)
    {
        $this->kamer->removeElement($kamer);
    }

    /**
     * Get kamer
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKamer()
    {
        return $this->kamer;
    }

    /**
     * Add gast
     *
     * @param \AlbaBundle\Entity\Gast $gast
     *
     * @return Reservering
     */
    public function addGast(\AlbaBundle\Entity\Gast $gast)
    {
        $this->gast[] = $gast;

        return $this;
    }

    /**
     * Remove gast
     *
     * @param \AlbaBundle\Entity\Gast $gast
     */
    public function removeGast(\AlbaBundle\Entity\Gast $gast)
    {
        $this->gast->removeElement($gast);
    }

    /**
     * Get gast
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGast()
    {
        return $this->gast;
    }

    /**
     * Add extra
     *
     * @param \AlbaBundle\Entity\Extra $extra
     *
     * @return Reservering
     */
    public function addExtra(\AlbaBundle\Entity\Extra $extra)
    {
        $this->extra[] = $extra;

        return $this;
    }

    /**
     * Remove extra
     *
     * @param \AlbaBundle\Entity\Extra $extra
     */
    public function removeExtra(\AlbaBundle\Entity\Extra $extra)
    {
        $this->extra->removeElement($extra);
    }

    /**
     * Get extra
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * Set betaling
     *
     * @param \AlbaBundle\Entity\Betaling $betaling
     *
     * @return Reservering
     */
    public function setBetaling(\AlbaBundle\Entity\Betaling $betaling = null)
    {
        $this->betaling = $betaling;

        return $this;
    }

    /**
     * Get betaling
     *
     * @return \AlbaBundle\Entity\Betaling
     */
    public function getBetaling()
    {
        return $this->betaling;
    }
}
