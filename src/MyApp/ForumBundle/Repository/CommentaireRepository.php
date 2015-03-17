<?php
namespace MyApp\ForumBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CommentaireRepository extends EntityRepository
{
    public function getCommentaireBySujet($id) {
        return $this->getEntityManager()
                        ->createQuery('  SELECT t   FROM MyAppForumBundle:commentaire t   WHERE t.sujet=:id  ORDER BY  t.datecreation DESC ')
                        ->setParameter('id', $id)
                        ->getResult();
    }
}

?>