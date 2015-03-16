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
    public function removemore($article)
    {        foreach ($article as $s){
        $this->em->remove($s);
    $this->em->flush();}

        return $article;
    }
 
    public function getAll() {
        return $this->repository->findAll();
    }

        public function getFirstPositionFree($lespositionsoccupés) {
                $pos = array(); // tableau vide
        $positionlibre = array(); // tableau vide
        foreach ($lespositionsoccupés as $s) {
            $a = $s->getPosition(); // recupere les positions des artciles ajoutés
            array_push($pos, $a);  // ajouter la position au tableau vide
        }
        if (!in_array("1", $pos)) {
            array_push($positionlibre, 1);
        }
        if (!in_array("2", $pos)) {
            array_push($positionlibre, 2);
        }
        if (!in_array("3", $pos)) {
            array_push($positionlibre, 3);
        }
        if (!in_array("4", $pos)) {
            array_push($positionlibre, 4);
        }
        if (!in_array("5", $pos)) {
            array_push($positionlibre, 5);
        }
        if (!in_array("6", $pos)) {
            array_push($positionlibre, 6);
        }
        if (!in_array("7", $pos)) {
            array_push($positionlibre, 7);
        }
        if (!in_array("8", $pos)) {
            array_push($positionlibre, 8);
        }
        if (!in_array("9", $pos)) {
            array_push($positionlibre, 9);
        }
        if (!in_array("10", $pos)) {
            array_push($positionlibre, 10);
        }
        if (!in_array("11", $pos)) {
            array_push($positionlibre, 11);
        }
        if (!in_array("12", $pos)) {
            array_push($positionlibre, 12);
        }
        if (!in_array("13", $pos)) {
            array_push($positionlibre, 13);
        }
        if (!in_array("14", $pos)) {
            array_push($positionlibre, 14);
        }
        if (!in_array("15", $pos)) {
            array_push($positionlibre, 15);
        }



        // var_dump($positionlibre);die();
        //  $positionlibre  tableau qui contient les position vides



        $premierepositionlibre = reset($positionlibre); // integer => premiere position libre     
            
            
            
            
        return $premierepositionlibre;
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
