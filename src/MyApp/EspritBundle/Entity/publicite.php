<?php

namespace MyApp\EspritBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert; 
use Doctrine\ORM\Mapping as ORM;

/**
 * publicite
 
 * @ORM\Table(name="publicite")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class publicite
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
     * @var integer
     *
     * @ORM\Column(name="position", type="integer",unique=true,nullable=false)
     */
    private $position;

    /**
     * @var string $image
     * @ORM\Column(name="image", type="text", length=3000)
     */
    private $image;


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
     * Set position
     *
     * @param integer $position
     * @return publicite
     */
    public function setPosition($position)
    {
        $this->position = $position;
    
        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return publicite
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }
}
