<?php
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
namespace MyApp\ForumBundle\Entity;
use MyApp\ForumBundle\Validator\Constraints as CustomAssert;
use Doctrine\ORM\Mapping as ORM;

/**
 * sujet
 *
 * @ORM\Table(name="sujet")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="MyApp\ForumBundle\Repository\sujetRepository")
 *  
 */
class sujet {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    protected $commentaires;

    /**
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id",nullable=false, onDelete="CASCADE")
     */
    protected $user;

    /**
     * @ORM\ManyToMany(targetEntity="MyApp\ForumBundle\Entity\tag", inversedBy="sujets")
     * @ORM\JoinTable(name="sujet_tags")
     */
    private $tags;

    /**
     * @var string
     *
     * @ORM\Column(name="sujet", type="string", length=255,unique=true,nullable=false)
     */
    private $sujet;

    /**
     * @var string
     * @CustomAssert\constraintsCheck()
     * @ORM\Column(name="contenu", type="string", length=20000)
     */
    private $contenu;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="date_creation",type="datetime",nullable=true)
     */
    private $datecreation;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="date_lus", type="datetime",nullable=true)
     */
    private $datelus;

    /**
     * @var boolean
     *
     * @ORM\Column(name="notification",nullable=true)
     */
    private $notification;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set sujet
     *
     * @param string $sujet
     * @return sujet
     */
    public function setSujet($sujet) {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * Get sujet
     *
     * @return string 
     */
    public function getSujet() {
        return $this->sujet;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return sujet
     */
    public function setContenu($contenu) {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu() {
        return $this->contenu;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     * @return sujet
     */
    public function setDatecreation(\DateTime $datecreation) {
        $this->datecreation = $datecreation;

        return $this;
    }

    /**
     * Get datecreation
     *
     * @return \DateTime 
     */
    public function getDatecreation() {
        return $this->datecreation;
    }

    /**
     * Set datelus
     *
     * @param \DateTime $datelus
     * @return sujet
     */
    public function setDatelus($datelus) {
        $this->datelus = $datelus;

        return $this;
    }

    /**
     * Get datelus
     *
     * @return \DateTime 
     */
    public function getDatelus() {
        return $this->datelus;
    }

    /**
     * Set notification
     *
     * @param boolean $notification
     * @return sujet
     */
    public function setNotification($notification) {
        $this->notification = $notification;

        return $this;
    }

    /**
     * Get notification
     *
     * @return boolean 
     */
    public function getNotification() {
        return $this->notification;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getCommentaires() {
        return $this->commentaires;
    }

    public function setCommentaires($commentaires) {
        $this->commentaires = $commentaires;
    }

    public function getTags() {
        return $this->tags;
    }

    public function setTags($tags) {
        $this->tags = $tags;
        return $this;
    }

    public function __construct() {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->datecreation = new \DateTime();
    }

}
