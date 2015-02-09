<?php
namespace MyApp\ArticleBundle\Repository;

use Doctrine\ORM\EntityRepository;

class StyleRepository extends EntityRepository
{
   public function getAllStyle()
    {
//        return $this->getEntityManager()
//            ->createQuery('SELECT p FROM MyAppEspritBundle:publicite p  ')
//            ->getResult();
            
    }
}

?>