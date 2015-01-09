<?php

namespace MyApp\ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity
 */
 
class Article
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
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id",nullable=false, onDelete="CASCADE")
     */
 
    protected $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="MyApp\ArticleBundle\Entity\ARstyle")
     * @ORM\JoinColumn(name="style_id", referencedColumnName="id",nullable=false, onDelete="CASCADE")
     */
 
    protected $arstyle;
    
    /**
     * @ORM\ManyToMany(targetEntity="MyApp\ForumBundle\Entity\tag", inversedBy="articles")
     * @ORM\JoinTable(name="article_tags")
     */
 
     private $tags;
     public function __construct() {
     $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
     }

   /**
     * @var string
     *
     * @ORM\Column(name="headline", type="string", length=255,unique=true)
     */
    private $headline;

   /**
     * @var string
     *
     * @ORM\Column(name="urlimg", type="string", length=255,unique=true)
     */
    private $urlimg;

   /**
     * @var string
     *
     * @ORM\Column(name="copyrights", type="string", length=255,unique=true)
     */
    private $copyrights;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fixedposition")
     */
    private $fixedposition;

   /**
     * @var string
     *
     * @ORM\Column(name="style", type="string", length=255,unique=true)
     */
    private $style;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer",unique=true)
     */
    private $position;

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
     * Set headline
     *
     * @param string $headline
     * @return Article
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;
    
        return $this;
    }

    /**
     * Get headline
     *
     * @return string 
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * Set urlimg
     *
     * @param string $urlimg
     * @return Article
     */
    public function setUrlimg($urlimg)
    {
        $this->urlimg = $urlimg;
    
        return $this;
    }

    /**
     * Get urlimg
     *
     * @return string 
     */
    public function getUrlimg()
    {
        return $this->urlimg;
    }

    /**
     * Set copyrights
     *
     * @param string $copyrights
     * @return Article
     */
    public function setCopyrights($copyrights)
    {
        $this->copyrights = $copyrights;
    
        return $this;
    }

    /**
     * Get copyrights
     *
     * @return string 
     */
    public function getCopyrights()
    {
        return $this->copyrights;
    }

    /**
     * Set fixedposition
     *
     * @param boolean $fixedposition
     * @return Article
     */
    public function setFixedposition($fixedposition)
    {
        $this->fixedposition = $fixedposition;
    
        return $this;
    }

    /**
     * Get fixedposition
     *
     * @return boolean 
     */
    public function getFixedposition()
    {
        return $this->fixedposition;
    }

    /**
     * Set stle
     *
     * @param string $stle
     * @return Article
     */
    public function setStyle($style)
    {
        $this->style = $style;
    
        return $this;
    }

    /**
     * Get stle
     *
     * @return string 
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Article
     */
    public function setPosition($position)
    {
        $this->position = $position;
    
        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set lien
     *
     * @param string $lien
     * @return Article
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

    public function getArstyle() {
        return $this->arstyle;
    }

    public function setArstyle($arstyle) {
        $this->arstyle = $arstyle;
        return $this;
    }

    public function getTags() {
        return $this->tags;
    }

    public function setTags($tags) {
        $this->tags = $tags;
        return $this;
    }


}
