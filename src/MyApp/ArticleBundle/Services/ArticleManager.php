<?php

namespace MyApp\ArticleBundle\Services;

use Doctrine\ORM\EntityManager;

class ArticleManager {

    private $em;
    private $repository;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->repository = $em->getRepository('MyAppArticleBundle:article');
    }

    public function shiftNofixedPosition() {
        $ArticleNOFixedPosition = $this->repository->getArticleNOFixedPosition();
        foreach ($ArticleNOFixedPosition as $anfp) {
            $this->incrementposition($anfp);
        }
    }

    public function incrementposition($article) {
        $pos = $article->getPosition();
        $pos = $pos + 1;
        $article->setPosition($pos);
        $this->persist($article);
    }

    public function getAll() {
        return $this->repository->findAll();
    }

    public function persist($article) {
        $this->doFlush($article);
    }

    public function doFlush($article) {
        $this->em->persist($article);
        $this->em->flush();

        return $article;
    }

}
