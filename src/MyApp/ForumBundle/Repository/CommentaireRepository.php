<?php

namespace MyApp\ForumBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CommentaireRepository extends EntityRepository {

    public function getCommentaireBySujet($id) {
        return $this->getEntityManager()
                        ->createQuery('  SELECT t   FROM MyAppForumBundle:commentaire t   WHERE (t.sujet=:id ) and ( t.commentaire IS NULL)  ORDER BY  t.datecreation DESC ')
                        ->setParameter('id', $id)
                        ->getResult();
    }

    public function getSubCommentaireBySujet($id) {
        return $this->getEntityManager()
                        ->createQuery('  SELECT t   FROM MyAppForumBundle:commentaire t   WHERE ( t.sujet=:id ) and ( t.commentaire>0 ) '
                                . 'ORDER BY  t.datecreation DESC ')
                        ->setParameter('id', $id)
                        ->getResult();
    }

}

?>