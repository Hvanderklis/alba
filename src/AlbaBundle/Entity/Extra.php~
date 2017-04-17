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
     * Many Groups have Many Users.
     * @ORM\ManyToMany(targetEntity="AlbaBundle\Entity\Reservering", mappedBy="extra")
     */
    private $reservering;
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
     * Add reservering
     *
     * @param \AlbaBundle\Entity\Reservering $reservering
     *
     * @return Extra
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
}
