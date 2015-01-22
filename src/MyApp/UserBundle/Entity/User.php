<?php
 

namespace MyApp\UserBundle\Entity;
 
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="user")
* @ORM\AttributeOverrides({
*      @ORM\AttributeOverride(name="email",
*          column=@ORM\Column(
*              name     = "email",
*              type     = "string",
*              length   = 255,
*              nullable = true,
*              unique=false
*          )
*      ),
*      @ORM\AttributeOverride(name="emailCanonical",
*          column=@ORM\Column(
*              name     = "emailCanonical",
*              type     = "string",
*              length   = 255,
*              nullable = true,
*              unique=false
*          )
*      ),
* })
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
     * @var string
     * 
     * @ORM\Column(name="ville", type="string", length=255,nullable=true)
     */
    private $ville;
    /**
     * @var string
     *  
     * @ORM\Column(name="numeroportable", type="integer", length=255,nullable=true)
     */
    private $numeroportable;
    /**
     * @var string
     *
     * @ORM\Column(name="surmoi", type="text", length=500,nullable=true)
     */
    private $surmoi;
    
   /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="date",nullable=true)
     */
    private $datenaissance;
    public function getDatedeCreationUser() {
        return $this->datedeCreationUser;
    }

    public function setDatedeCreationUser(\DateTime $datedeCreationUser) {
        $this->datedeCreationUser = $datedeCreationUser;
        return $this;
    }

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_cre_user", type="datetime",nullable=true)
     */
    private $datedeCreationUser;
       public function __construct()
    {
           parent::__construct();
        $this->datenaissance = new \DateTime();
        $this->datedeCreationUser = new \DateTime();
    }
    
    public function setDatenaissance(\DateTime $datenaissance) {
        $this->datenaissance = $datenaissance;
        return $this;
    }
    /**
     * Gets the datenaissance time.
     *
     * @return \DateTime
     */
    public function getDatenaissance() {
        return $this->datenaissance;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="addresse", type="string", length=500,nullable=true)
     */
    private $addresse;
    /**
     * @var string
     * 
     * @ORM\Column(name="nomprenom", type="string", length=255,nullable=true)
     */
    private $nomprenom;
    /**
     * @var string
     *
     * @ORM\Column(name="codepostal", type="string", length=255,nullable=true)
     */
    private $codepostal;
    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=500,nullable=true)
     */
    private $image;

    protected $notifications;
    protected $sujets;
    
    public function getSexe() {
        return $this->sexe;
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

    public function getNomprenom() {
        return $this->nomprenom;
    }

    public function setNomprenom($nomprenom) {
        $this->nomprenom = $nomprenom;
        return $this;
    }


    public function getVille() {
        return $this->ville;
    }

    public function getNumeroportable() {
        return $this->numeroportable;
    }

    public function getSurmoi() {
        return $this->surmoi;
    }

    public function setVille($ville) {
        $this->ville = $ville;
        return $this;
    }

    public function setNumeroportable($numeroportable) {
        $this->numeroportable = $numeroportable;
        return $this;
    }

    public function setSurmoi($surmoi) {
        $this->surmoi = $surmoi;
        return $this;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
        return $this;
    }


}