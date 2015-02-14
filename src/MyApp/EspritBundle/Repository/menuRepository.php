<?php
namespace MyApp\EspritBundle\Repository;

use Doctrine\ORM\EntityRepository;

class menuRepository extends EntityRepository
{
   public function getAllMenu()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT DISTINCT p FROM MyAppEspritBundle:menu p  ORDER by p.position ASC ')
            ->getResult();
            
    }
}

?>