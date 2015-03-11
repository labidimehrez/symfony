<?php
namespace MyApp\EspritBundle\Repository;

use Doctrine\ORM\EntityRepository;

class notificationRepository extends EntityRepository
{
   public function getNumberAllNotif($id)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT COUNT(p)  FROM MyAppEspritBundle:notification p    WHERE p.user=:id ')
                ->setParameter('id', $id)
            ->getSingleScalarResult();// return integer
            
    }
    
     public function getAllNotif($id)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM MyAppEspritBundle:notification p    WHERE p.user=:id ')
                ->setParameter('id', $id)
            ->getSingleScalarResult();// return integer
            
    }
}

?>