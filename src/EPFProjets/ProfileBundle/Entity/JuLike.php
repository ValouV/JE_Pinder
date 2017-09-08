<?php

namespace EPFProjets\ProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JuLike
 *
 * @ORM\Table(name="ju_like")
 * @ORM\Entity(repositoryClass="EPFProjets\ProfileBundle\Repository\JuLikeRepository")
 */
class JuLike
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
     * @ORM\Column(name="idLiker", type="integer")
     */
    private $idLiker;

    /**
     * @var int
     *
     * @ORM\Column(name="idLiked", type="integer")
     */
    private $idLiked;

    /**
     * @var bool
     *
     * @ORM\Column(name="mutual", type="boolean")
     */
    private $mutual;

    /**
     * @var string
     *
     * @ORM\Column(name="notified", type="boolean")
     */
    private $notified;


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
     * Set idLiker
     *
     * @param integer $idLiker
     *
     * @return JuLike
     */
    public function setIdLiker($idLiker)
    {
        $this->idLiker = $idLiker;

        return $this;
    }

    /**
     * Get idLiker
     *
     * @return int
     */
    public function getIdLiker()
    {
        return $this->idLiker;
    }

    /**
     * Set idLiked
     *
     * @param integer $idLiked
     *
     * @return JuLike
     */
    public function setIdLiked($idLiked)
    {
        $this->idLiked = $idLiked;

        return $this;
    }

    /**
     * Get idLiked
     *
     * @return int
     */
    public function getIdLiked()
    {
        return $this->idLiked;
    }

    /**
     * Set mutual
     *
     * @param boolean $mutual
     *
     * @return JuLike
     */
    public function setMutual($mutual)
    {
        $this->mutual = $mutual;

        return $this;
    }

    /**
     * Get mutual
     *
     * @return bool
     */
    public function getMutual()
    {
        return $this->mutual;
    }

    /**
     * Set notified
     *
     * @param boolean $notified
     *
     * @return JuLike
     */
    public function setNotified($notified)
    {
        $this->notified = $notified;

        return $this;
    }

    /**
     * Get notified
     *
     * @return boolean
     */
    public function getNotified()
    {
        return $this->notified;
    }
}
