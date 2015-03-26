<?php

namespace MyApp\ForumBundle\Services;

use Doctrine\ORM\EntityManager;

class TagManager
{
    private $em;
    private $repository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository('MyAppForumBundle:tag');
    }

    public function getAll()
    {
        return $this->repository->findAll();
    }
    public function getOne($id)
    {
        return $this->repository->find($id);
    }
    
       public function getByTitle($title)
    {
        return $this->repository->findOneBy(array('title' => $title));
    }
    public function persist($tag)
    {
        $this->doFlush($tag);
    }

    public function doFlush($tag)
    {
        $this->em->persist($tag);
        $this->em->flush();

        return $tag;
    }
}