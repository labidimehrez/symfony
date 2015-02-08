<?php

namespace MyApp\EspritBundle\Entity;

use Doctrine\ORM\EntityRepository;

class publiciteRepository extends EntityRepository{
    //put your code here
    public function findByPosition()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM MyAppEspritBundle:publicite p ORDER BY p.position ASC'
            )
            ->getResult();
    }
}
