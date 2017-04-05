<?php

namespace AlbaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KamerPrijs
 *
 * @ORM\Table(name="kamer_prijs")
 * @ORM\Entity(repositoryClass="AlbaBundle\Repository\KamerPrijsRepository")
 */
class KamerPrijs
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
     * @var int
     *
     * @ORM\Column(name="Prijs", type="integer")
     */
    private $prijs;

    /**
     * @ORM\ManyToOne(targetEntity="Kamer", inversedBy="kamerPrijs")
     * @ORM\JoinColumn(name="Kamer_nummer", referencedColumnName="id")
     *
     */
    private $kamer;

    /**
     * @ORM\ManyToOne(targetEntity="Seizoen", inversedBy="kamerPrijs")
     * @ORM\JoinColumn(name="Seizoen_nummer", referencedColumnName="id")
     */
    private $seizoen;

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
     * Set prijs
     *
     * @param integer $prijs
     *
     * @return KamerPrijs
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
     * Set kamer
     *
     * @param \AlbaBundle\Entity\Kamer $kamer
     *
     * @return KamerPrijs
     */
    public function setKamer(\AlbaBundle\Entity\Kamer $kamer = null)
    {
        $this->kamer = $kamer;

        return $this;
    }

    /**
     * Get kamer
     *
     * @return \AlbaBundle\Entity\Kamer
     */
    public function getKamer()
    {
        return $this->kamer;
    }

    /**
     * Set seizoen
     *
     * @param \AlbaBundle\Entity\Seizoen $seizoen
     *
     * @return KamerPrijs
     */
    public function setSeizoen(\AlbaBundle\Entity\Seizoen $seizoen = null)
    {
        $this->seizoen = $seizoen;

        return $this;
    }

    /**
     * Get seizoen
     *
     * @return \AlbaBundle\Entity\Seizoen
     */
    public function getSeizoen()
    {
        return $this->seizoen;
    }

    public function __toString(){
        // to show the name of the Category in the select
        return $this->kamer;
        // to show the id of the Category in the select
        // return $this->id;
    }

}
