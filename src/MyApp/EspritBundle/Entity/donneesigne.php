<?php

namespace MyApp\EspritBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * donneesigne
 *
 * @ORM\Table(name="donnée_signe")
 * @ORM\Entity
 */
class donneesigne
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="MyApp\EspritBundle\Entity\signe")
     * @ORM\JoinColumn(name="signe_id", referencedColumnName="id",nullable=false)
     */
 
   protected $signe;

   /**
     * @var string
     *
     * @ORM\Column(name="periodetype", type="string", length=255,unique=true)
     */
    private $periodetype;

   /**
     * @var string
     *
     * @ORM\Column(name="contenue", type="string", length=255,unique=true)
     */
    private $contenue;


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
     * Set periodetype
     *
     * @param string $periodetype
     * @return donneesigne
     */
    public function setPeriodetype($periodetype)
    {
        $this->periodetype = $periodetype;
    
        return $this;
    }

    /**
     * Get periodetype
     *
     * @return string 
     */
    public function getPeriodetype()
    {
        return $this->periodetype;
    }

    /**
     * Set contenue
     *
     * @param string $contenue
     * @return donneesigne
     */
    public function setContenue($contenue)
    {
        $this->contenue = $contenue;
    
        return $this;
    }

    /**
     * Get contenue
     *
     * @return string 
     */
    public function getContenue()
    {
        return $this->contenue;
    }
    
    public function getSigne() {
        return $this->signe;
    }

    public function setSigne($signe) {
        $this->signe = $signe;
        return $this;
    }


}
