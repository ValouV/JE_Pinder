<?php

namespace EPFProjets\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use \Datetime;
use EPFProjets\ProfileBundle\Entity\Profile;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="EPFProjets\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
    * @ORM\Column(name="sexe", type="string", length=255, nullable=false)
    */
    private $sexe;

    /**
    * @ORM\Column(name="name", type="string", length=255, nullable=false)
    */
    private $name;

    /**
    * @ORM\Column(name="surname", type="string", length=255, nullable=false)
    */
    private $surname;

    /**
    * @ORM\Column(name="birthdate", type="date")
    */
    private $birthdate;

    public function __construct()
        {
            parent::__construct();
            // your own logic
        }


    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return User
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
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
     * Set surname
     *
     * @param string $surname
     *
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }



    /**
     * Set birthdate
     *
     * @param \Date $birthdate
     *
     * @return User
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \Date
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function getAge()
    {
      $from = $this->birthdate;
      $to   = new DateTime('today');
      return $from->diff($to)->y;
    }


}
