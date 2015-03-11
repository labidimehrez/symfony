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

   /* public function getSheetByUser($user)
    {
        return $this->repository->getAll($user);
    }

    public function getSheet($id)
    {
        return $this->repository->find($id);
    }

    public function validate($sheet)
    {
        $sheet->setValidated(true);

        $this->doFlush($sheet);
    }*/

    public function persist($style )
    {
        $this->doFlush($style);
    }

    public function doFlush($style)
    {
        $this->em->persist($style);
        $this->em->flush();

        return $style;
    }
}