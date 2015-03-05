<?php

namespace MyApp\ArticleBundle\Entity;
  
use Doctrine\ORM\Mapping as ORM;

/**
 * style
 *
 * @ORM\Table(name="style")
 * @ORM\Entity(repositoryClass="MyApp\ArticleBundle\Repository\StyleRepository")
 */
 
class Style {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    protected $articles;

    /**
     * @var string
     *  
     * @ORM\Column(name="title", type="string", length=255,nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *  
     * @ORM\Column(name="codecouleurfront", type="string", length=255,nullable=false)
     * 
     */
    private $codecouleurfront;

    /**
     * @var string
     * 
     * @ORM\Column(name="codecouleurback", type="string", length=255,nullable=false)
     * 
     */
    private $codecouleurback;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return ARstyle
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ARstyle
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
     * Set codecouleur
     *
     * @param string $codecouleur
     * @return ARstyle
     */
    public function getCodecouleurfront() {
        return $this->codecouleurfront;
    }

    public function getCodecouleurback() {
        return $this->codecouleurback;
    }

    public function setCodecouleurfront($codecouleurfront) {
        $this->codecouleurfront = $codecouleurfront;
        return $this;
    }

    public function setCodecouleurback($codecouleurback) {
        $this->codecouleurback = $codecouleurback;
        return $this;
    }

    public function getArticles() {
        return $this->articles;
    }

    public function setArticles($articles) {
        $this->articles = $articles;
        return $this;
    }

    public function __toString() {
        return $this->title . '';
    }

}
