<?php

namespace MyApp\EspritBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * notification
 *
 * @ORM\Table(name="notif")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="MyApp\EspritBundle\Repository\notificationRepository")
 */
class notification {

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
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id",nullable=true, onDelete="CASCADE")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="MyApp\ForumBundle\Entity\sujet")
     * @ORM\JoinColumn(name="sujet_id", referencedColumnName="id",nullable=true, onDelete="CASCADE")
     */
    protected $sujet;

    /**
     * @ORM\ManyToOne(targetEntity="MyApp\ForumBundle\Entity\commentaire")
     * @ORM\JoinColumn(name="commentaire_id", referencedColumnName="id",nullable=true, onDelete="CASCADE")
     */
    protected $commentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=20000,nullable=true)
     */
    private $lien;

    /**
     * @var boolean
     *
     * @ORM\Column(name="lu",nullable=true)
     */
    private $lu;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=255)
     */
    private $contenu;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="date_creation",type="datetime",nullable=true)
     */
    private $datecreation;

    
    /**
     * @var integer
     *
     * @ORM\Column(name="userConcerned", type="integer",nullable=false)
     */
    private $userConcerned;
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    public function getLu() {
        return $this->lu;
    }

    public function setLu($lu) {
        $this->lu = $lu;
        return $this;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getLien() {
        return $this->lien;
    }

    public function getContenu() {
        return $this->contenu;
    }

    public function setLien($lien) {
        $this->lien = $lien;
        return $this;
    }

    public function setContenu($contenu) {
        $this->contenu = $contenu;
        return $this;
    }

    public function getSujet() {
        return $this->sujet;
    }

    public function setSujet($sujet) {
        $this->sujet = $sujet;
        return $this;
    }

    public function getCommentaire() {
        return $this->commentaire;
    }

    public function setCommentaire($commentaire) {
        $this->commentaire = $commentaire;
        return $this;
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
    public function getUserConcerned() {
        return $this->userConcerned;
    }

    public function setUserConcerned($userConcerned) {
        $this->userConcerned = $userConcerned;
        return $this;
    }

        public function __construct() {

        $this->datecreation = new \DateTime();
    }

}
