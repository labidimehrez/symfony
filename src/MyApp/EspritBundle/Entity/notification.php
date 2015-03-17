<?php

namespace MyApp\EspritBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * notification
 *
 * @ORM\Table(name="Notif")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="MyApp\EspritBundle\Repository\notificationRepository")
 */
class notification
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
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id",nullable=true, onDelete="CASCADE")
     */
 
   protected $user;
 
    /**
     * @ORM\ManyToOne(targetEntity="MyApp\ForumBundle\Entity\sujet")
     * @ORM\JoinColumn(name="sujet_id", referencedColumnName="id",nullable=true, onDelete="CASCADE")
     */
 
   protected $sujet;
   
    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=20000)
     */
    private $lien;
    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=255)
     */
    private $contenu;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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


}
