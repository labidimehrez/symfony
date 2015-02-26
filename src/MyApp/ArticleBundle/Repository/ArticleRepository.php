<?php
namespace MyApp\ArticleBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
   public function getAllArticle()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM MyAppArticleBundle:article p  ')
            ->getResult();
            
    }
}

?>