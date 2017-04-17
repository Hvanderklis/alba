<?php

namespace AlbaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kaart
 *
 * @ORM\Table(name="kaart")
 * @ORM\Entity(repositoryClass="AlbaBundle\Repository\KaartRepository")
 */
class Kaart
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
     * @ORM\Column(name="Creditcard_gegevens", type="string", length=255)
     */
    private $creditcardGegevens;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Vervaldatum", type="date")
     */
    private $vervaldatum;

    /**
     * @ORM\ManyToOne(targetEntity="Klant", inversedBy="kaart")
     * @ORM\JoinColumn(name="KlantNummer", referencedColumnName="id")
     */
    private $klant;

    /**
     * @ORM\OneToMany(targetEntity="Bank", mappedBy="kaart")
     */
    private $bank;

    /**
     * @ORM\OneToMany(targetEntity="Betaling", mappedBy="kaart")
     */
    private $betaling;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bank = new \Doctrine\Common\Collections\ArrayCollection();
        $this->betaling = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set creditcardGegevens
     *
     * @param string $creditcardGegevens
     *
     * @return Kaart
     */
    public function setCreditcardGegevens($creditcardGegevens)
    {
        $this->creditcardGegevens = $creditcardGegevens;

        return $this;
    }

    /**
     * Get creditcardGegevens
     *
     * @return string
     */
    public function getCreditcardGegevens()
    {
        return $this->creditcardGegevens;
    }

    /**
     * Set vervaldatum
     *
     * @param \DateTime $vervaldatum
     *
     * @return Kaart
     */
    public function setVervaldatum($vervaldatum)
    {
        $this->vervaldatum = $vervaldatum;

        return $this;
    }

    /**
     * Get vervaldatum
     *
     * @return \DateTime
     */
    public function getVervaldatum()
    {
        return $this->vervaldatum;
    }

    /**
     * Set klant
     *
     * @param \AlbaBundle\Entity\Klant $klant
     *
     * @return Kaart
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
     * Add bank
     *
     * @param \AlbaBundle\Entity\Bank $bank
     *
     * @return Kaart
     */
    public function addBank(\AlbaBundle\Entity\Bank $bank)
    {
        $this->bank[] = $bank;

        return $this;
    }

    /**
     * Remove bank
     *
     * @param \AlbaBundle\Entity\Bank $bank
     */
    public function removeBank(\AlbaBundle\Entity\Bank $bank)
    {
        $this->bank->removeElement($bank);
    }

    /**
     * Get bank
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * Add betaling
     *
     * @param \AlbaBundle\Entity\Betaling $betaling
     *
     * @return Kaart
     */
    public function addBetaling(\AlbaBundle\Entity\Betaling $betaling)
    {
        $this->betaling[] = $betaling;

        return $this;
    }

    /**
     * Remove betaling
     *
     * @param \AlbaBundle\Entity\Betaling $betaling
     */
    public function removeBetaling(\AlbaBundle\Entity\Betaling $betaling)
    {
        $this->betaling->removeElement($betaling);
    }

    /**
     * Get betaling
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBetaling()
    {
        return $this->betaling;
    }
}
