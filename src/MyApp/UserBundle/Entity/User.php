<?php
 

namespace MyApp\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="user")
*/
class User extends BaseUser
{
/**
* @ORM\Id
* @ORM\Column(type="integer")
* @ORM\GeneratedValue(strategy="AUTO")
*/
protected $id;


    /**
     * @var boolean
     *
     * @ORM\Column(name="sexe",nullable=true)
     */
    private $sexe;
    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="date_naissance",type="date",nullable=true)
     */
    private $datenaissance;
   
    /**
     * @var string
     *
     * @ORM\Column(name="addresse", type="string", length=255,nullable=true)
     */
    private $addresse;

    /**
     * @var string
     *
     * @ORM\Column(name="codepostal", type="string", length=255,nullable=true)
     */
    private $codepostal;

    protected $notifications;
    protected $sujets;
    
    public function getSexe() {
        return $this->sexe;
    }

    public function getDatenaissance() {
        return $this->datenaissance;
    }

    public function getAddresse() {
        return $this->addresse;
    }

    public function getCodepostal() {
        return $this->codepostal;
    }

    public function getNotifications() {
        return $this->notifications;
    }

    public function getSujets() {
        return $this->sujets;
    }

    public function setSexe($sexe) {
        $this->sexe = $sexe;
        return $this;
    }

    public function setDatenaissance(\DateTime $datenaissance) {
        $this->datenaissance = $datenaissance;
        return $this;
    }

    public function setAddresse($addresse) {
        $this->addresse = $addresse;
        return $this;
    }

    public function setCodepostal($codepostal) {
        $this->codepostal = $codepostal;
        return $this;
    }

    public function setNotifications($notifications) {
        $this->notifications = $notifications;
        return $this;
    }

    public function setSujets($sujets) {
        $this->sujets = $sujets;
        return $this;
    }




}