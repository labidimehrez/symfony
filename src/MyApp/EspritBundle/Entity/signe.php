<?php

namespace MyApp\EspritBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * signe
 * @ORM\Table(name="signe")
 * 
 * @ORM\Entity
 */
class signe
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    protected $donneesignes;
    /**
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id",nullable=false, onDelete="CASCADE")
     */
 
   protected $user;

   /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255,unique=true)
     */
    private $image;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="periode")
     */
    private $periode;

   /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255,unique=true)
     */
    private $lien;


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
     * Set image
     *
     * @param string $image
     * @return signe
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set periode
     *
     * @param \DateTime $periode
     * @return signe
     */
    public function setPeriode($periode)
    {
        $this->periode = $periode;
    
        return $this;
    }

    /**
     * Get periode
     *
     * @return \DateTime 
     */
    public function getPeriode()
    {
        return $this->periode;
    }

    /**
     * Set lien
     *
     * @param string $lien
     * @return signe
     */
    public function setLien($lien)
    {
        $this->lien = $lien;
    
        return $this;
    }

    /**
     * Get lien
     *
     * @return string 
     */
    public function getLien()
    {
        return $this->lien;
    }
    
    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getDonneesignes() {
        return $this->donneesignes;
    }

    public function setDonneesignes($donneesignes) {
        $this->donneesignes = $donneesignes;
    }


}
