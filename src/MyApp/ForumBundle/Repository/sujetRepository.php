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
                        ->createQuery('SELECT p    FROM MyAppForumBundle:sujet p   WHERE p.id < 7 ORDER BY  p.datecreation DESC   ')
                        ->getResult();
    }

     public function getmostreadsujet() {
        return $this->getEntityManager()
                        ->createQuery('SELECT p    FROM MyAppForumBundle:sujet p  ORDER BY  p.nblect DESC   ')
                        ->getResult();
    }
    
    
}

?>