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
     * @var string
     *
     * @ORM\Column(name="Bank", type="string", length=255)
     */
    private $bank;

    /**
     * @var int
     *
     * @ORM\Column(name="Payment_nummer", type="integer")
     */
    private $paymentNummer;


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
     * Set paymentNummer
     *
     * @param integer $paymentNummer
     *
     * @return Bank
     */
    public function setPaymentNummer($paymentNummer)
    {
        $this->paymentNummer = $paymentNummer;

        return $this;
    }

    /**
     * Get paymentNummer
     *
     * @return int
     */
    public function getPaymentNummer()
    {
        return $this->paymentNummer;
    }
}

