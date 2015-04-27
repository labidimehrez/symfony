<?php

namespace MyApp\UserBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
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
class User extends BaseUser {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

     

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

    public function __construct() {
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

 
    protected $notifications;
    protected $sujets;
    protected $commentaires;
 
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

 
    public function getCommentaires() {
        return $this->commentaires;
    }

    public function setCommentaires($commentaires) {
        $this->commentaires = $commentaires;
        return $this;
    }

 
 
     /**
     * @var \DateTime
     * 
     * @ORM\Column(name="updated_at",type="datetime", nullable=true) 
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
        return __dir__ . '/../../../../web/upload';
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
   public function getPath() {
        return $this->path;
    }
}
