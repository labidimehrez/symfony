<?php

namespace MyApp\ArticleBundle\Services;

use Doctrine\ORM\EntityManager;

class StyleManager
{
    private $em;
    private $repository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository('MyAppArticleBundle:style');
    }

    public function getAll()
    {
        return $this->repository->findAll();
    }
    public function removemore($style)
    {        foreach ($style as $s){
        $this->em->remove($s);
    $this->em->flush();}

        return $style;
    }
 

    public function persist($style )
    {
        $this->doFlush($style);
    }

        
    public function remove($style)
    {
        $this->em->remove($style);
        $this->em->flush();

        return $style;
    }
    
    
    public function doFlush($style)
    {
        $this->em->persist($style);
        $this->em->flush();

        return $style;
    }
}