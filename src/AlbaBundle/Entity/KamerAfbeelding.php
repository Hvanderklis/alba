<?php

namespace AlbaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\ManyToOne(targetEntity="Kamer", inversedBy="kamerAfbeelding")
     * @ORM\JoinColumn(name="Kamer_id", referencedColumnName="id")
     */
    private $kamer;

    /**
     * @Assert\File(maxSize="1000000")
     */
    private $file;

    public function setFile(UploadedFile $file = null){
        $this->file = $file;
    }

    public function getFile(){
        return $this->file;
    }

    public function upload(){
        if (null === $this->getFile()){return;}

        $filename = $this->getFile()->getClientOriginalName();
        $this->getFile()->move($this->getUploadAbsolutePath(),$filename);
        $this->setPath($filename);
        $this->setFile();

    }

    protected function getUploadPath(){
        return 'uploads';
    }

    protected function getUploadAbsolutePath(){
        return __DIR__. '/../../../web/' . $this->getUploadPath();
            }

    public function getCoverWeb(){
        return null === $this->getPath() ? null : $this->getUploadPath() . '/' . $this->getPath();
    }

    public function getCoverAbsolute(){
        return null === $this->getPath() ? null : $this->getUploadAbsolutePath() . '/' . $this->getPath();
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
