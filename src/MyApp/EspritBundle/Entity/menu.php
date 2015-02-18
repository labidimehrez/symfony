<?php

namespace MyApp\EspritBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table(name="menu")
 * @ORM\Entity(repositoryClass="MyApp\EspritBundle\Repository\menuRepository")
 * @UniqueEntity(fields="position", message="")
 */
class menu {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255,unique=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer",unique=true)
     */
    private $position;
    
    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=20000)
     */
    private $lien;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Menu
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Menu
     */
    public function setPosition($position) {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition() {
        return $this->position;
    }
    public function getLien() {
        return $this->lien;
    }

    public function setLien($lien) {
        $this->lien = $lien;
        return $this;
    }


}
