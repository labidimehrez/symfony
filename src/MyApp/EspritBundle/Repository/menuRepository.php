<?php
namespace MyApp\EspritBundle\Repository;

use Doctrine\ORM\EntityRepository;

class menuRepository extends EntityRepository
{
   public function getAllMenu()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM MyAppEspritBundle:menu p  ')
            ->getResult();
            
    }
}

?>