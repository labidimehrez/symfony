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

    public function Disponiblitedelapositionchoisie($positiondelarticleenajout) {
        $contenudelapositionchoisie = $this->repository->getDisponiblite($positiondelarticleenajout);
        if (empty($contenudelapositionchoisie)) {
            $lapositionchoisie = 'vide';      /* position disponible */
        }
        if (!empty($contenudelapositionchoisie) && ($contenudelapositionchoisie[0]->getFixedposition() == 1)) {
            $lapositionchoisie = 'contenufixe';      /* position non disponible */
        }
        if (!empty($contenudelapositionchoisie) && ($contenudelapositionchoisie[0]->getFixedposition() == 0)) {
            $lapositionchoisie = 'contenuNONfixe';      /* position non disponible */
        }


        return $lapositionchoisie;
    }

    public function getOne($id) {
        return $this->repository->find($id);
    }

    public function getARnumber() {
        return intval($this->repository->getARnumber()); /* return int qui contient 'number de AR' */
    }

    public function ShiftToRightNofixedPosition() {
        $ArticleNOFixedPosition = $this->repository->getArticleNOFixedPosition();
         
           

          /*  $ArticleNOFixedPosition[0]->setPosition(3);  $this->persist($ArticleNOFixedPosition[0]);
            $ArticleNOFixedPosition[1]->setPosition(2);  $this->persist($ArticleNOFixedPosition[1]);
              $ArticleNOFixedPosition[2]->setPosition(1);  $this->persist($ArticleNOFixedPosition[2]);*/
             for ($index = 0; $index < count($ArticleNOFixedPosition); $index++) {
            $ArticleNOFixedPosition[$index]->setPosition( count($ArticleNOFixedPosition)-$index);
            $this->persist($ArticleNOFixedPosition[$index ]);
        }      
            
            
    }

    public function ShiftToLeftNofixedPosition() {
        $ArticleNOFixedPosition = $this->repository->getArticleNOFixedPosition();
        $totalnumberofar = intval($this->repository->getARnumber()); /* nombre ancien des AR je vais l incrementer +1 */

        $ArticleNOFixedPosition[0]->setPosition($totalnumberofar + 1);
        $this->persist($ArticleNOFixedPosition[0]);
        /* le dernier element des non fixed AR est envoyé a une nouvelle position =  number dancien +1 */
        for ($index = 0; $index < count($ArticleNOFixedPosition) - 1; $index++) {
            $ArticleNOFixedPosition[$index + 1]->setPosition(count($ArticleNOFixedPosition) + 1);
            $this->persist($ArticleNOFixedPosition[$index + 1]);
        }
        /* chaque ar non fixé aura position de son next */
    }

    public function incrementposition($article) {
//        $pos = $article->getPosition();
//        $pos = $pos + 1;
//        $articledetest = $this->repository->findOneBy(array('position' => $pos));
//        if (in_array(!$articledetest, $articleWithfixedposition) )
//        {$article->setPosition($pos);
//        $this->persist($article);}
    }

    public function decrementposition($article) {
//        $pos = $article->getPosition();
//        $pos = $pos - 1;
//        $articledetest = $this->repository->findOneBy(array('position' => $pos));
//        if (in_array(!$articledetest, $articleWithfixedposition) )
//        {$article->setPosition($pos);
//        $this->persist($article);}
    }

    public function getallarticleId($article) {
        if ($article != NULL) {
            return array_values($article);
        }
    }

    public function getfixedarticleId($fixedarticle) {
        if ($fixedarticle != NULL) {
            return array_values($fixedarticle);
        }
    }

    public function makeFIX($article) {
        $article->setFixedposition(1);
        $this->persist($article);
        return $article;
    }

    public function makeUNFIX($article) {
        $article->setFixedposition(0);
        $this->persist($article);
        return $article;
    }

    public function removemore($article) {
        foreach ($article as $s) {
            $this->em->remove($s);
            $this->em->flush();
        }
        return $article;
    }

    public function getAll() {
        return $this->repository->findAll();
    }

    public function getArticleWithFixedPosition() {
        return $this->repository->getArticleWithFixedPosition();
    }

    public function getArticleNOFixedPosition() {
        return $this->repository->getArticleNOFixedPosition();
    }

    public function getPositionOccuped() {
        return $this->repository->getPositionOccuped();
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
