<?php

namespace MyApp\ArticleBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticleManager {

    private $em;
    private $repository;
    private $repositorydebat;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->repository = $em->getRepository('MyAppArticleBundle:article');
        $this->repositorydebat = $em->getRepository('MyAppForumBundle:sujet');
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

    public function traitementenajout($positiondelarticleenajout, $fixedpositionChecked, $lapositionchoisie, $articleNOfixedposition, $premierepositionlibre, $article) {

        if (($positiondelarticleenajout === 1) && ($fixedpositionChecked === TRUE)) {
            /*             * * j 'affecte l a'rticle a la premiere position libre       ** */
            if ($lapositionchoisie != 'contenufixe') {
                $article->setPosition($positiondelarticleenajout);
               /* if (!empty($articleNOfixedposition)) {
                    $this->ShiftToLeftNofixedPosition($positiondelarticleenajout);
                }*/
                $this->persist($article);
            } elseif ($lapositionchoisie === 'contenufixe') {
                throw new NotFoundHttpException("STOP. The chosen position is fixed. Please unfix this position first.");
            }
        }
        if (($positiondelarticleenajout === 1) && ($fixedpositionChecked === FALSE)) {
            /*             * **    j 'affecte l a'rticle a la premiere position libre      *** */
            $article->setPosition($premierepositionlibre);
            $this->persist($article);
        }
        if (($positiondelarticleenajout != 1) && ($fixedpositionChecked === TRUE)) {
            if ($lapositionchoisie != 'contenufixe') {
                /*if (!empty($articleNOfixedposition)) {
                    $this->ShiftToLeftNofixedPosition($positiondelarticleenajout);
                }*/
                $article->setPosition($positiondelarticleenajout);
                $this->persist($article);
            } elseif ($lapositionchoisie === 'contenufixe') {
                throw new NotFoundHttpException("STOP. The chosen position is fixed. Please unfix this position first.");
            }
        }
        if (($positiondelarticleenajout != 1) && ($fixedpositionChecked === FALSE)) {
            if ($lapositionchoisie != 'contenufixe') {
                $article->setPosition($positiondelarticleenajout);
                $this->persist($article);
            } elseif ($lapositionchoisie === 'contenufixe') {
                throw new NotFoundHttpException("STOP. The chosen position is fixed. Please unfix this position first.");
            }
        }
    }

    public function ShiftToLeftNofixedPosition($position) {
        $ArticleNOFixedPosition = $this->repository->getArticleNOFixedPosition();
        $totalnumberofar = intval($this->repository->getARnumber()); /* nombre ancien des AR je vais l incrementer +1 */

        $index = $totalnumberofar - $position; /* la translation concerne la position en ajout et ses successeurs */
        do {

            if ($ArticleNOFixedPosition[$index - 1]->getPosition() > $position) {
                $ArticleNOFixedPosition[$index]->setPosition($ArticleNOFixedPosition[$index - 1]->getPosition());
                $this->persist($ArticleNOFixedPosition[$index]);
            }
            $index--;
        } while (($index >= 1)); /* tant que c vrai on repete */
        $ArticleNOFixedPosition[0]->setPosition($totalnumberofar + 1);
        $this->persist($ArticleNOFixedPosition[0]);
    }

    public function ShiftToRightNofixedPosition() {
        $ArticleNOFixedPosition = $this->repository->getArticleNOFixedPosition();
        /*  $ArticleNOFixedPosition[0]->setPosition(3);  $this->persist($ArticleNOFixedPosition[0]);
          $ArticleNOFixedPosition[1]->setPosition(2);  $this->persist($ArticleNOFixedPosition[1]);
          $ArticleNOFixedPosition[2]->setPosition(1);  $this->persist($ArticleNOFixedPosition[2]); */
        for ($index = 0; $index < count($ArticleNOFixedPosition); $index++) {
            $ArticleNOFixedPosition[$index]->setPosition(count($ArticleNOFixedPosition) - $index);
            $this->persist($ArticleNOFixedPosition[$index]);
        }
    }

    public function debatsortedmostcommented() {

        $sujet = $this->repositorydebat->getAllsujetrecent();
        /*  sortedtopic by comment */
        $commentarray = array(); // tableau vide
        $sortedtopic = array(); // tableau vide
        foreach ($sujet as $s) {
            $commentCount = $this->repositorydebat->getCommentCountBySujet($s->getId());
            if ($commentCount > 0) {
                array_push($commentarray, $commentCount);
            }/* inserer la valeur dans l array vide */
        }
        rsort($commentarray); /* tri du tableau selon value */


        for ($index = 0; $index < count($commentarray); $index++) {
            for ($jndex = 0; $jndex < count($sujet); $jndex++) {
                if ($this->repositorydebat->getCommentCountBySujet($sujet[$jndex]->getId()) == $commentarray[$index]) {

                    if (!in_array($sujet[$jndex], $sortedtopic)) {
                        array_push($sortedtopic, $sujet[$jndex]);
                    } /* inserer la valeur si elle n'existe pas deja dans l array vide */
                }
            }
        }
        return $sortedtopic;
    }

    public function makeFIXormakeUNFIX($fixedornotvalue) {
        $article = $this->repository->findAll();
        if ($fixedornotvalue != NULL) {
            foreach ($article as $a) {
                if (in_array($a->getId(), array_values($fixedornotvalue))) {
                    $this->makeFIX($a);
                } else {
                    $this->makeUNFIX($a);
                }
            }
        }
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
