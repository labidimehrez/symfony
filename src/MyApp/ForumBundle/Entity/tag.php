<?php

namespace MyApp\ForumBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="MyApp\ForumBundle\Repository\tagRepository")
 * @UniqueEntity(fields="title", message=" ")
 */
class tag {

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
     * @ORM\Column(name="title", type="string", length=255,unique=true,nullable=false)
     */
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity="MyApp\ArticleBundle\Entity\Article", mappedBy="tags")
     */
    private $articles;

    public function __construct() {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sujets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @ORM\ManyToMany(targetEntity="MyApp\ForumBundle\Entity\sujet", mappedBy="tags")
     */
    private $sujets;

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
     * @return tag
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

    public function getArticles() {
        return $this->articles;
    }

    public function setArticles($articles) {
        $this->articles = $articles;
        return $this;
    }

    public function getSujets() {
        return $this->sujets;
    }

    public function setSujets($sujets) {
        $this->sujets = $sujets;
        return $this;
    }

    public function __toString() {
        return $this->title . '';
    }

}
