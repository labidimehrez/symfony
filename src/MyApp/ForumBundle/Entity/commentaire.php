<?php

namespace MyApp\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity
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
     * @ORM\ManyToOne(targetEntity="commentaire")
     */
     private $commentaire;
     
    /**
     * @var string
     */
    private $texte;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire_User", type="string", length=255,unique=true)
     */
    private $commentaireUser;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire_Parent", type="string", length=255,unique=true)
     */
    private $commentaireParent;

    /**
     * @var boolean
     *
     * @ORM\Column(name="notification")
     */
    private $notification;


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
     * Set commentaireUser
     *
     * @param string $commentaireUser
     * @return commentaire
     */
    public function setCommentaireUser($commentaireUser)
    {
        $this->commentaireUser = $commentaireUser;
    
        return $this;
    }

    /**
     * Get commentaireUser
     *
     * @return string 
     */
    public function getCommentaireUser()
    {
        return $this->commentaireUser;
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



}
