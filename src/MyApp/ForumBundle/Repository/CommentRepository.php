<?php
namespace MyApp\ForumBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository
{
   public function getAllComment()
    {
//        return $this->getEntityManager()
//            ->createQuery('SELECT p FROM MyAppEspritBundle:publicite p  ')
//            ->getResult();
            
    }
}

?>