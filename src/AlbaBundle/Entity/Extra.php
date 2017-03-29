<?php

namespace AlbaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Extra
 *
 * @ORM\Table(name="extra")
 * @ORM\Entity(repositoryClass="AlbaBundle\Repository\ExtraRepository")
 */
class Extra
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
     * @ORM\Column(name="Type", type="string", length=255)
     */
    private $type;

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
     * @ORM\JoinTable(name="Extra_reservering",
     *      joinColumns={@ORM\JoinColumn(name="extra_nummer", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="reserveringsnummer", referencedColumnName="id", unique=true)})
     */
    private $reserveringen;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reserveringen = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set type
     *
     * @param string $type
     *
     * @return Extra
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set prijs
     *
     * @param integer $prijs
     *
     * @return Extra
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
     * @return Extra
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
     * Add reserveringen
     *
     * @param \AlbaBundle\Entity\Reservering $reserveringen
     *
     * @return Extra
     */
    public function addReserveringen(\AlbaBundle\Entity\Reservering $reserveringen)
    {
        $this->reserveringen[] = $reserveringen;

        return $this;
    }

    /**
     * Remove reserveringen
     *
     * @param \AlbaBundle\Entity\Reservering $reserveringen
     */
    public function removeReserveringen(\AlbaBundle\Entity\Reservering $reserveringen)
    {
        $this->reserveringen->removeElement($reserveringen);
    }

    /**
     * Get reserveringen
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReserveringen()
    {
        return $this->reserveringen;
    }
}
