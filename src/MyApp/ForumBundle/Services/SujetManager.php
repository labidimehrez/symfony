<?php

namespace MyApp\ForumBundle\Services;

use Doctrine\ORM\EntityManager;

class SujetManager
{
    private $em;
    private $repository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository('MyAppForumBundle:sujet');
    }

    public function getAll()
    {
        return $this->repository->findBy(array(),array('datecreation' => 'DESC'));
    }
    public function getOne($id)
    {
        return $this->repository->find($id);
    }
       public function incrementNBlect($sujet)
    {
        $nblect = $sujet->getNblect();
        $nblect = $nblect + 1;
        $sujet->setNblect($nblect);
         $this->persist($sujet);
    }
    public function UpdateDate($sujet) {
        $sujet->setDatelus(new \DateTime());
        return $sujet;
    }
    public function IncrementandSetNewDateLus($sujet) {
        $this->UpdateDate($sujet);
         $this->incrementNBlect($sujet);
         return $sujet;
    }
    
    public function persist($sujet)
    {
        $this->doFlush($sujet);
    }

    public function doFlush($sujet)
    {
        $this->em->persist($sujet);
        $this->em->flush();

        return $sujet;
    }
}