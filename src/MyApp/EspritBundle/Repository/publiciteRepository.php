<?php
namespace MyApp\EspritBundle\Repository;

use Doctrine\ORM\EntityRepository;

class publiciteRepository extends EntityRepository
{
   public function getAllPub()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM MyAppEspritBundle:publicite p  ')
            ->getResult();
            
    }
}

?>