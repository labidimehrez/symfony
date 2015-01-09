<?php

namespace MyApp\ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ARstyle
 *
 * @ORM\Table(name="style")
 * @ORM\Entity
 */
class ARstyle
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
   protected $articles;
   /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255,unique=true)
     */
    private $title;
   /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255,unique=true)
     */
    private $name;

   /**
     * @var string
     *
     * @ORM\Column(name="codecouleur", type="string", length=255,unique=true)
     */
    private $codecouleur;


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
     * Set title
     *
     * @param string $title
     * @return ARstyle
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ARstyle
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
     * Set codecouleur
     *
     * @param string $codecouleur
     * @return ARstyle
     */
    public function setCodecouleur($codecouleur)
    {
        $this->codecouleur = $codecouleur;
    
        return $this;
    }

    /**
     * Get codecouleur
     *
     * @return string 
     */
    public function getCodecouleur()
    {
        return $this->codecouleur;
    }
    
    
    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getArticles() {
        return $this->articles;
    }

    public function setArticles($articles) {
        $this->articles = $articles;
        return $this;
    }


}
