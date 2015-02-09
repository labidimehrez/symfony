<?php
namespace MyApp\EspritBundle\Repository;

use Doctrine\ORM\EntityRepository;

class donneesigneRepository extends EntityRepository
{
   public function getAllDonneesigne()
    {
//        return $this->getEntityManager()
//            ->createQuery('SELECT p FROM MyAppEspritBundle:publicite p  ')
//            ->getResult();
            
    }
}

?>