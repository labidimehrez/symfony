<?php
namespace MyApp\EspritBundle\Repository;

use Doctrine\ORM\EntityRepository;

class notificationRepository extends EntityRepository
{
   public function getAllNotif()
    {
//        return $this->getEntityManager()
//            ->createQuery('SELECT p FROM MyAppEspritBundle:publicite p  ')
//            ->getResult();
            
    }
}

?>