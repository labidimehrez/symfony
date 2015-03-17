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
class commentaire
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
     * @ORM\ManyToOne(targetEntity="MyApp\ForumBundle\Entity\Sujet")
     * @ORM\JoinColumn(name="sujet_id", referencedColumnName="id",nullable=false)
     */
 
    protected $sujet;
 
    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="string", length=2550,nullable=false)
     */
    private $texte;

    /**
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\User", cascade={"all"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id",nullable=false, onDelete="CASCADE")
     */
    protected $user;

    /**
     * @var integer
     *
     * @ORM\Column(name="like", type="integer",nullable=true)
     */
    private $like;
    /**
     * @var string
     *
     * @ORM\Column(name="commentaire_Parent", type="string", length=255,unique=true,nullable=true)
     */
    private $commentaireParent;

    /**
     * @var boolean
     *
     * @ORM\Column(name="notification")
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set texte
     *
     * @param string $texte
     * @return commentaire
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;
    
        return $this;
    }

    /**
     * Get texte
     *
     * @return string 
     */
    public function getTexte()
    {
        return $this->texte;
    }
 

    /**
     * Set commentaireParent
     *
     * @param string $commentaireParent
     * @return commentaire
     */
    public function setCommentaireParent($commentaireParent)
    {
        $this->commentaireParent = $commentaireParent;
    
        return $this;
    }

    /**
     * Get commentaireParent
     *
     * @return string 
     */
    public function getCommentaireParent()
    {
        return $this->commentaireParent;
    }

    /**
     * Set notification
     *
     * @param boolean $notification
     * @return commentaire
     */
    public function setNotification($notification)
    {
        $this->notification = $notification;
    
        return $this;
    }

    /**
     * Get notification
     *
     * @return boolean 
     */
    public function getNotification()
    {
        return $this->notification;
    }
    
    public function getSujet() {
        return $this->sujet;
    }

    public function setSujet($sujet) {
        $this->sujet = $sujet;
    }
    public function getCommentaire() {
        return $this->commentaire;
    }

    public function setCommentaire($commentaire) {
        $this->commentaire = $commentaire;
        return $this;
    }

    public function getUser() {
        return $this->user;
    }

   

    public function setUser($user) {
        $this->user = $user;
        return $this;
    }

   

    public function getLike() {
        return $this->like;
    }

    public function setLike($like) {
        $this->like = $like;
        return $this;
    }

    public function getDatecreation() {
        return $this->datecreation;
    }

    public function setDatecreation(\DateTime $datecreation) {
        $this->datecreation = $datecreation;
        return $this;
    }



}
