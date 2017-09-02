<?php

namespace EPFProjets\ProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profile
 *
 * @ORM\Table(name="profile")
 * @ORM\Entity(repositoryClass="EPFProjets\ProfileBundle\Repository\ProfileRepository")
 */
class Profile
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
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="nbreVues", type="integer")
     */
    private $nbreVues;

    /**
    * @ORM\OneToOne(targetEntity="EPFProjets\ProfileBundle\Entity\Image" , cascade={"persist"})
    */
    private $image;

    public function __construct()
      {
        $this->nbreVues = 0;
      }


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
     * Set description
     *
     * @param string $description
     *
     * @return Profile
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set nbreVues
     *
     * @param integer $nbreVues
     *
     * @return Profile
     */
    public function setNbreVues($nbreVues)
    {
        $this->nbreVues = $nbreVues;

        return $this;
    }

    /**
     * Get nbreVues
     *
     * @return int
     */
    public function getNbreVues()
    {
        return $this->nbreVues;
    }

    /**
     * Set image
     *
     * @param \EPFProjets\ProfileBundle\Entity\Image $image
     *
     * @return Profile
     */
    public function setImage(\EPFProjets\ProfileBundle\Entity\Image $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \EPFProjets\ProfileBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }
}
