<?php

namespace AlbaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * kaart
 *
 * @ORM\Table(name="kaart")
 * @ORM\Entity(repositoryClass="AlbaBundle\Repository\kaartRepository")
 */
class kaart
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
     * Get id
     *
     * @return int
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
     * @return kaart
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
     * @return kaart
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
}

