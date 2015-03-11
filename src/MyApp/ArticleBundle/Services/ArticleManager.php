<?php

namespace MyApp\ArticleBundle\Services;

use Doctrine\ORM\EntityManager;

class ArticleManager
{
    private $em;
    private $repository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository('MyAppArticleBundle:article');
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

    public function persist($article )
    {
        $this->doFlush($article);
    }

    public function doFlush($article)
    {
        $this->em->persist($article);
        $this->em->flush();

        return $article;
    }
}