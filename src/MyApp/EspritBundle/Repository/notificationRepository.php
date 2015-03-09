<?php
namespace MyApp\EspritBundle\Repository;

use Doctrine\ORM\EntityRepository;

class notificationRepository extends EntityRepository
{
   public function getNumberAllNotif()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT COUNT(p)  FROM MyAppEspritBundle:notification p ')
            ->getSingleScalarResult();// return integer
            
    }
}

?>