<?php

namespace MyApp\EspritBundle\Repository;

use Doctrine\ORM\EntityRepository;

class publiciteRepository extends EntityRepository {

    public function getAllPub() {
        return $this->getEntityManager()
                        ->createQuery('SELECT  p FROM MyAppEspritBundle:publicite p  ')
                        ->getResult();
    }

    public function getextPub() {
        return $this->getEntityManager()
                        ->createQuery('SELECT  p FROM MyAppEspritBundle:publicite p WHERE  p.position in (0,1,6,7) ')
                        ->getResult();
    }

    public function getintPub() {
        return $this->getEntityManager()
 ->createQuery('SELECT  p FROM MyAppEspritBundle:publicite p WHERE '
         . ' p.position  in (8,9,10,11,12,13,14,15,16,17,18,19,20,21)  ')
  ->getResult();
    }

}

?>