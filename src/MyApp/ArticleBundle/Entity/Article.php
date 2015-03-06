<?php

namespace MyApp\ArticleBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="MyApp\ArticleBundle\Repository\ArticleRepository")
 */
class Article {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="MyApp\ArticleBundle\Entity\style")
     * @ORM\JoinColumn(name="style_id", referencedColumnName="id",nullable=false, onDelete="CASCADE")
     */
    protected $style;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", length=255,unique=true)
     */
    private $position;

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
     * @var string $urlimg
     * @Assert\File( maxSize = "1024k", mimeTypesMessage = "Please upload a valid Image")
     * @ORM\Column(name="urlimg", type="string", length=2500, nullable=true)
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
     * @ORM\Column(name="lien", type="string", length=255,unique=true)
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
     * Set headline
     *
     * @param string $headline
     * @return Article
     */
    public function setHeadline($headline) {
        $this->headline = $headline;

        return $this;
    }

    /**
     * Get headline
     *
     * @return string 
     */
    public function getHeadline() {
        return $this->headline;
    }

    /**
     * Set urlimg
     *
     * @param string $urlimg
     * @return Article
     */
    public function setUrlimg($urlimg) {
        $this->urlimg = $urlimg;

        return $this;
    }

    /**
     * Get urlimg
     *
     * @return string 
     */
    public function getUrlimg() {
        return $this->urlimg;
    }

    /**
     * Set copyrights
     *
     * @param string $copyrights
     * @return Article
     */
    public function setCopyrights($copyrights) {
        $this->copyrights = $copyrights;

        return $this;
    }

    /**
     * Get copyrights
     *
     * @return string 
     */
    public function getCopyrights() {
        return $this->copyrights;
    }

    /**
     * Set fixedposition
     *
     * @param boolean $fixedposition
     * @return Article
     */
    public function setFixedposition($fixedposition) {
        $this->fixedposition = $fixedposition;

        return $this;
    }

    /**
     * Get fixedposition
     *
     * @return boolean 
     */
    public function getFixedposition() {
        return $this->fixedposition;
    }
 

    /**
     * Set lien
     *
     * @param string $lien
     * @return Article
     */
    public function setLien($lien) {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string 
     */
    public function getLien() {
        return $this->lien;
    }

    public function getStyle() {
        return $this->style;
    }

    public function setStyle($style) {
        $this->style = $style;
        return $this;
    }

    public function getTags() {
        return $this->tags;
    }

    public function setTags($tags) {
        $this->tags = $tags;
        return $this;
    }

    public function getFullImagePath() {
        return null === $this->urlimg ? null : $this->getUploadRootDir() . $this->urlimg;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return $this->getTmpUploadRootDir() . $this->getId() . "/";
    }

    protected function getTmpUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../web/upload/';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function uploadImage() {
        // the file property can be empty if the field is not required
        if (null === $this->urlimg) {
            return;
        }
        if (!$this->id) {
            $this->urlimg->move($this->getTmpUploadRootDir(), $this->urlimg->getClientOriginalName());
        } else {
            $this->urlimg->move($this->getUploadRootDir(), $this->urlimg->getClientOriginalName());
        }
        $this->setUrlimg($this->urlimg->getClientOriginalName());
    }

    /**
     * @ORM\PostPersist()
     */
    public function moveImage() {
        if (null === $this->urlimg) {
            return;
        }
        if (!is_dir($this->getUploadRootDir())) {
            mkdir($this->getUploadRootDir());
        }
        copy($this->getTmpUploadRootDir() . $this->urlimg, $this->getFullImagePath());
        unlink($this->getTmpUploadRootDir() . $this->urlimg);
    }

    /**
     * @ORM\PreRemove()
     */
    public function removeImage() {
        unlink($this->getFullImagePath());
        rmdir($this->getUploadRootDir());
    }

    public function __toString() {
        return $this->title . '';
    }

    public function getPosition() {
        return $this->position;
    }

    public function setPosition($position) {
        $this->position = $position;
        return $this;
    }

}
