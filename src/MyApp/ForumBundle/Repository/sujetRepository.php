<?php
namespace MyApp\ForumBundle\Repository;

use Doctrine\ORM\EntityRepository;

class sujetRepository extends EntityRepository
{
    public function getAllsujet()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM MyAppForumBundle:sujet p  ORDER BY  p.datecreation DESC  ')
            ->getResult();
            
    }
}

?>