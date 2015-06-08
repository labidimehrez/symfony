<?php

namespace MyApp\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="MyApp\ForumBundle\Repository\CommentaireRepository")
 */
class commentaire {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="MyApp\ForumBundle\Entity\sujet") 
     * @ORM\JoinColumn(name="sujet_id", referencedColumnName="id")
     */
    protected $sujet;
    protected $notifications;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="string", length=2550,nullable=false)
     */
    private $texte;

    /**
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="MyApp\ForumBundle\Entity\commentaire")
     * @ORM\JoinColumn(name="commentaire_id", referencedColumnName="id",nullable=true)
     */
    protected $commentaire;

    /**
     * @var integer
     *
     * @ORM\Column(name="vote", type="integer",nullable=true)
     */
    private $vote;
    /**
     * @var string
     *
     * @ORM\Column(name="idvoter", type="string", length=2550,nullable=true)
     */
    private $idvoter;
    /**
     * @var boolean
     *
     * @ORM\Column(name="notification",nullable=true)
     */
    private $notification;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="date_creation",type="datetime",nullable=true)
     */
    private $datecreation;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set texte
     *
     * @param string $texte
     * @return commentaire
     */
    public function setTexte($texte) {
        $texte = str_replace("<p>", '', $texte);
        $texte = str_replace("</p>", '', $texte);
        $this->texte = $texte;


        return $this;
    }

    /**
     * Get texte
     *
     * @return string 
     */
    public function getTexte() {
        return $this->texte;
    }

    /**
     * Set notification
     *
     * @param boolean $notification
     * @return commentaire
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

    public function getSujet() {
        return $this->sujet;
    }

    public function setSujet($sujet) {
        $this->sujet = $sujet;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
        return $this;
    }

    public function getVote() {
        return $this->vote;
    }

    public function setVote($vote) {
        $this->vote = $vote;
        return $this;
    }

    public function getDatecreation() {
        return $this->datecreation;
    }

    public function setDatecreation(\DateTime $datecreation) {
        $this->datecreation = $datecreation;
        return $this;
    }

    public function getCommentaire() {
        return $this->commentaire;
    }

    public function setCommentaire($commentaire) {
        $this->commentaire = $commentaire;
        return $this;
    }

    public function __construct() {

        $this->datecreation = new \DateTime();
    }

    public function getNotifications() {
        return $this->notifications;
    }

    public function setNotifications($notifications) {
        $this->notifications = $notifications;
        return $this;
    }
    public function getIdvoter() {
        return $this->idvoter;
    }

    public function setIdvoter($idvoter) {
        $this->idvoter = $idvoter;
        return $this;
    }


}
