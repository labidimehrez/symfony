<?php

namespace MyApp\ForumBundle\Repository;

use Doctrine\ORM\EntityRepository;

class sujetRepository extends EntityRepository {

    public function getAllsujet() {
        return $this->getEntityManager()
                        ->createQuery('SELECT p FROM MyAppForumBundle:sujet p  ORDER BY  p.datecreation DESC  ')
                        ->getResult();
    }

    public function getAllsujetrecent() {
        return $this->getEntityManager()
                        ->createQuery('SELECT p    FROM MyAppForumBundle:sujet p   ORDER BY  p.datecreation DESC   ')
                          ->setMaxResults(5)
                          ->getResult();
    }

    public function getmostreadsujet() {
        return $this->getEntityManager()
                        ->createQuery('SELECT p    FROM MyAppForumBundle:sujet p  ORDER BY  p.nblect DESC   ')
                        ->getResult();
    }

    public function getSujetByUser($id) {
        return $this->getEntityManager()
                        ->createQuery('  SELECT t   FROM MyAppForumBundle:sujet t   WHERE t.user=:id ')
                        ->setParameter('id', $id)
                        ->getResult();
    }
    
       public function getCommentCountBySujet($id)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT COUNT(p)  FROM MyAppForumBundle:commentaire p    WHERE p.sujet=:id ')
                ->setParameter('id', $id)
            ->getSingleScalarResult();// return integer
            
    }
}
?>