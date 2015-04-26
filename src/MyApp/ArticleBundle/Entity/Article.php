<?php

namespace MyApp\ArticleBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 * 
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="MyApp\ArticleBundle\Repository\ArticleRepository")
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\Column(name="position", type="integer", length=255)
     */
    private $position;

    /**
     * @ORM\ManyToMany(targetEntity="MyApp\ForumBundle\Entity\tag", inversedBy="articles")
     * @ORM\JoinTable(name="article_tags")
     */
    private $tags;

    /**
     * @var string
     *
     * @ORM\Column(name="headline", type="string", length=255,unique=true)
     */
    private $headline;


 

    /**
     * @var string
     *
     * @ORM\Column(name="copyrights", type="string", length=255,nullable=true)
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
     * @ORM\Column(name="lien", type="string", length=255)
     */
    private $lien;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="date_creation",type="datetime",nullable=true)
     */
    private $datecreation;

    /**
     * @var \DateTime
     * 
     * @ORM\COlumn(name="updated_at",type="datetime", nullable=true) 
     */
    private $updateAt;

    /**
     * @ORM\PostLoad()
     */
    public function postLoad() {
        $this->updateAt = new \DateTime();
    }

    /**
     * @ORM\Column(type="string",length=255, nullable=true) 
     */
    private $path;
    public $file;

    public function getUploadRootDir() {
        return __dir__ . '/../../../../web/uploads';
    }

    public function getAbsolutePath() {
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getAssetPath() {
        return 'uploads/' . $this->path;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate() 
     */
    public function preUpload() {
        $this->tempFile = $this->getAbsolutePath();
        $this->oldFile = $this->getPath();
        $this->updateAt = new \DateTime();

        if (null !== $this->file)
        { $this->path = sha1(uniqid(mt_rand(), true)) . '.' . $this->file->guessExtension();}
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate() 
     */
    public function upload() {
        if (null !== $this->file) {
            $this->file->move($this->getUploadRootDir(), $this->path);
            unset($this->file);

            if ($this->oldFile != null) {
                unlink($this->tempFile);
            }
        }
    }

    /**
     * @ORM\PreRemove() 
     */
    public function preRemoveUpload() {
        $this->tempFile = $this->getAbsolutePath();
    }

    /**
     * @ORM\PostRemove() 
     */
    public function removeUpload() {
        if (file_exists($this->tempFile)) {
            unlink($this->tempFile);
        }
    }

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

    public function getPosition() {
        return $this->position;
    }

    public function setPosition($position) {
        $this->position = $position;
        return $this;
    }

    public function getDatecreation() {
        return $this->datecreation;
    }

    public function setDatecreation(\DateTime $datecreation) {
        $this->datecreation = $datecreation;
        return $this;
    }

    public function getPath() {
        return $this->path;
    }

    public function __construct() {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->datecreation = new \DateTime();
    }

}
