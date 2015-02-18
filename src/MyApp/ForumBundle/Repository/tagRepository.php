<?php

namespace MyApp\ForumBundle\Repository;

use Doctrine\ORM\EntityRepository;

class tagRepository extends EntityRepository {

    public function getAlltag() {
        return $this->getEntityManager()
                        ->createQuery('SELECT DISTINCT p FROM MyAppForumBundle:tag p WHERE p.id < 10000 ORDER BY  p.id ASC ')
                        ->getResult();
    }

    public function getmostusedtag() {
        return $this->getEntityManager()
                        ->createQuery('  SELECT DISTINCT t   FROM MyAppForumBundle:Tag t JOIN t.sujets s ')
                       ->setMaxResults(5)
                        ->getResult();
    }

    public function getBySujet($id) {
        return $this->getEntityManager()
                        ->createQuery('  SELECT t   FROM MyAppForumBundle:Tag t JOIN t.sujets s  WHERE s.id=:id ')
                        ->setParameter('id',$id)
                        ->getResult();
    }

    
}

?>