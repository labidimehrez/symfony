<?php
namespace MyApp\ForumBundle\Repository;

use Doctrine\ORM\EntityRepository;

class tagRepository extends EntityRepository
{
   public function getAlltag()
    {
//        return $this->getEntityManager()
//            ->createQuery('SELECT p FROM MyAppEspritBundle:publicite p  ')
//            ->getResult();
            
    }
}

?>