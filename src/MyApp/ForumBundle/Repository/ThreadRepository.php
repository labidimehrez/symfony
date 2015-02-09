<?php
namespace MyApp\ForumBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ThreadRepository extends EntityRepository
{
   public function getAllThread()
    {
//        return $this->getEntityManager()
//            ->createQuery('SELECT p FROM MyAppEspritBundle:publicite p  ')
//            ->getResult();
            
    }
}

?>