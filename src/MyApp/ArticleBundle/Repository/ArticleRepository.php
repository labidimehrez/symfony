<?php

namespace MyApp\ArticleBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository {

    public function getAllArticle() {
        return $this->getEntityManager()
                        ->createQuery('SELECT p FROM MyAppArticleBundle:article p order by p.datecreation DESC ')
                        ->getResult();
    }

    public function getArticleWithFixedPosition() {
        return $this->getEntityManager()
                        ->createQuery('SELECT p FROM MyAppArticleBundle:article p  WHERE p.fixedposition = 1 order by p.position DESC ')
                        ->getResult();
    }

    public function getArticleNOFixedPosition() {
        return $this->getEntityManager()
                        ->createQuery('SELECT p FROM MyAppArticleBundle:article p  WHERE p.fixedposition != 1 order by p.position DESC ')
                        ->getResult();
    }

    public function getPositionOccuped() {
        return $this->getEntityManager()
                        ->createQuery('SELECT p FROM MyAppArticleBundle:article p  ')
                        ->getResult();
    }
    public function getARnumber() {
        return $this->getEntityManager()
                        ->createQuery('SELECT COUNT(p) FROM MyAppArticleBundle:article p  ')
                        ->getSingleScalarResult();
    }
    
    
    public function getDisponiblite($positiondelarticleenajout) {
        return $this->getEntityManager()
                        ->createQuery('SELECT p FROM  MyAppArticleBundle:article p   WHERE  p.position=:pos  ')                           
                        ->setParameter('pos', $positiondelarticleenajout)
                        ->getResult();
    }

}

?>