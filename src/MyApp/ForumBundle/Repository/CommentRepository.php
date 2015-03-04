<?php
namespace MyApp\ForumBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository
{
    public function getCommentBySujet($id) {
        return $this->getEntityManager()
                        ->createQuery('  SELECT t   FROM MyAppForumBundle:comment t   WHERE t.sujet=:id ')
                        ->setParameter('id', $id)
                        ->getResult();
    }
}

?>