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
     * @ORM\Column(name="Opmerking", type="string", length=255)
     */
    private $opmerking;


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
}

