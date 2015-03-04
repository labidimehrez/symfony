<?php
// src/MyProject/MyBundle/Entity/Comment.php

namespace MyApp\ForumBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use FOS\CommentBundle\Entity\Comment as BaseComment;
use FOS\CommentBundle\Model\SignedCommentInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\CommentBundle\Model\VotableCommentInterface;
 
/**
 * @ORM\Entity
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 * @ORM\Entity(repositoryClass="MyApp\ForumBundle\Repository\CommentRepository")
 */
class Comment extends BaseComment  implements SignedCommentInterface, VotableCommentInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
 
    /**
     * Thread of this comment
     *
     * @var Thread
     * @ORM\ManyToOne(targetEntity="MyApp\ForumBundle\Entity\Thread")
     */
    protected $thread;
     
    /**
     * Author of the comment
     *
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\User")
     * @var User
     */
    protected $author;
 
    public function setAuthor(UserInterface $author)
    {
        $this->author = $author;
    }
 
    public function getAuthor()
    {
        return $this->author;
    }
 
    public function getAuthorName()
    {
        if (null === $this->getAuthor()) {
            return 'Anonymous';
        }
 
        return $this->getAuthor()->getUsername();
    }
       public function getAuthorPicture()
    {
        if (null === $this->getAuthor()) {
            return 'Anonymous';
        }
 
        return $this->getAuthor()->getImage();
    } 
    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $score = 0;
 
    /**
     * Sets the score of the comment.
     *
     * @param integer $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }
 
    /**
     * Returns the current score of the comment.
     *
     * @return integer
     */
    public function getScore()
    {
        return $this->score;
    }
 
    /**
     * Increments the comment score by the provided
     * value.
     *
     * @param integer value
     *
     * @return integer The new comment score
     */
    public function incrementScore($by = 1)
    {
        $this->score += $by;
    }
     /**
     * @ORM\ManyToOne(targetEntity="MyApp\ForumBundle\Entity\Sujet")
     * @ORM\JoinColumn(name="sujet_id", referencedColumnName="id",nullable=true)
     */
 
    protected $sujet;
    public function getSujet() {
        return $this->sujet;
    }

    public function setSujet($sujet) {
        $this->sujet = $sujet;
        return $this;
    }


}