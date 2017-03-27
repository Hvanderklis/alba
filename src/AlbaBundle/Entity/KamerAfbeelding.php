<?php

namespace AlbaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KamerAfbeelding
 *
 * @ORM\Table(name="kamer_afbeelding")
 * @ORM\Entity(repositoryClass="AlbaBundle\Repository\KamerAfbeeldingRepository")
 */
class KamerAfbeelding
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
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Kamer", inversedBy="kamerAfbeelding")
     * @ORM\JoinColumn(name="Kamer_id", referencedColumnName="id")
     */
    private $kamer;

    /**
     * @var string
     *
     * @ORM\Column(name="Size", type="string", length=255)
     */
    private $size;

    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="Path", type="string", length=255)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="kamer_nummer", type="string", length=255)
     */
    private $kamerNummer;

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
     * Set name
     *
     * @param string $name
     *
     * @return KamerAfbeelding
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set size
     *
     * @param string $size
     *
     * @return KamerAfbeelding
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return KamerAfbeelding
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
     * Set path
     *
     * @param string $path
     *
     * @return KamerAfbeelding
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set kamerNummer
     *
     * @param string $kamerNummer
     *
     * @return KamerAfbeelding
     */
    public function setKamerNummer($kamerNummer)
    {
        $this->kamerNummer = $kamerNummer;

        return $this;
    }

    /**
     * Get kamerNummer
     *
     * @return string
     */
    public function getKamerNummer()
    {
        return $this->kamerNummer;
    }

    /**
     * Set kamer
     *
     * @param \AlbaBundle\Entity\Kamer $kamer
     *
     * @return KamerAfbeelding
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
}
