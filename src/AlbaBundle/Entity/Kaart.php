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
}
