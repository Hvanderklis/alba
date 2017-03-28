<?php

namespace AlbaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bank
 *
 * @ORM\Table(name="bank")
 * @ORM\Entity(repositoryClass="AlbaBundle\Repository\BankRepository")
 */
class Bank
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
     * @ORM\ManyToOne(targetEntity="Kaart", inversedBy="Bank")
     * @ORM\JoinColumn(name="Kaart_nummer", referencedColumnName="id")
     */
    private $kaart;

    /**
     * @var string
     *
     * @ORM\Column(name="Bank", type="string", length=255)
     */
    private $bank;



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
     * Set bank
     *
     * @param string $bank
     *
     * @return Bank
     */
    public function setBank($bank)
    {
        $this->bank = $bank;

        return $this;
    }

    /**
     * Get bank
     *
     * @return string
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * Set kaart
     *
     * @param \AlbaBundle\Entity\Kaart $kaart
     *
     * @return Bank
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
