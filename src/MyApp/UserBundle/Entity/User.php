<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity
 */
class User
{
   /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;   
    protected $notifications;
   
    protected $sujets;
    protected $articles;
    protected $signes;
    protected $arstyles;
    protected $menus;
    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255,unique=true)
     */
    private $login;
   /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255,unique=true)
     */
    private $password;

   /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255,unique=true)
     */
    private $mail;

   /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255,unique=true)
     */
    private $nom;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sexe")
     */
    private $sexe;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="date_naissance")
     */
    private $datenaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="addresse", type="string", length=255,unique=true)
     */
    private $addresse;

    /**
     * @var string
     *
     * @ORM\Column(name="codepostal", type="string", length=255,unique=true)
     */
    private $codepostal;


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
     * Set login
     *
     * @param string $login
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;
    
        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return User
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    
        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set sexe
     *
     * @param boolean $sexe
     * @return User
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    
        return $this;
    }

    /**
     * Get sexe
     *
     * @return boolean 
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set datenaissance
     *
     * @param \DateTime $datenaissance
     * @return User
     */
    public function setDatenaissance($datenaissance)
    {
        $this->datenaissance = $datenaissance;
    
        return $this;
    }

    /**
     * Get datenaissance
     *
     * @return \DateTime 
     */
    public function getDatenaissance()
    {
        return $this->datenaissance;
    }

    /**
     * Set addresse
     *
     * @param string $addresse
     * @return User
     */
    public function setAddresse($addresse)
    {
        $this->addresse = $addresse;
    
        return $this;
    }

    /**
     * Get addresse
     *
     * @return string 
     */
    public function getAddresse()
    {
        return $this->addresse;
    }

    /**
     * Set codepostal
     *
     * @param string $codepostal
     * @return User
     */
    public function setCodepostal($codepostal)
    {
        $this->codepostal = $codepostal;
    
        return $this;
    }

    /**
     * Get codepostal
     *
     * @return string 
     */
    public function getCodepostal()
    {
        return $this->codepostal;
    }
    
    public function getNotifications() {
        return $this->notifications;
    }

    public function setNotifications($notifications) {
        $this->notifications = $notifications;
    }   

    public function getSujets() {
        return $this->sujets;
    }

  

    public function setSujets($sujets) {
        $this->sujets = $sujets;
    }
    public function getArticles() {
        return $this->articles;
    }

    public function setArticles($articles) {
        $this->articles = $articles;
    }

    public function getSignes() {
        return $this->signes;
    }

    public function setSignes($signes) {
        $this->signes = $signes;
    }

    public function getArstyles() {
        return $this->arstyles;
    }

    public function setArstyles($arstyles) {
        $this->arstyles = $arstyles;
    }

    public function getMenus() {
        return $this->menus;
    }

    public function setMenus($menus) {
        $this->menus = $menus;
    }

   public function __toString() {
        return $this->id .'';
    }

}
