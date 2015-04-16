<?php

namespace MyApp\ArticleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\ArticleBundle\Form\ArticleType;
use MyApp\ArticleBundle\Entity\Article;

class ArticleController extends Controller {

    public function addAction() {
        $em = $this->getDoctrine()->getManager();
        $tags = $em->getRepository('MyAppForumBundle:tag')->findAll();
        $manager = $this->get('collectify_article_manager');/** equivalent de em manager * */
        $articleWithfixedposition = $manager->getArticleWithFixedPosition(); /* array des objetcs a positions FIXéS */
        $articleNOfixedposition = $manager->getArticleNOFixedPosition(); /* array  des objetcs a  positions non fixés */
        $lespositionsoccupés = $manager->getPositionOccuped(); /* array des positions occupés */
        $premierepositionlibre = $manager->getFirstPositionFree($lespositionsoccupés); /* int la premiere position libre sinon return boolean false */
        $article = new Article();
        $form = $this->createForm(new ArticleType, $article);
        $request = $this->getRequest();
        if ($request->isMethod('Post')) {
            $form->bind($request);
            if ($form->isValid()) {
                $article = $form->getData();

                /* traitement special pour le choix des tags */
                $managertag = $this->get('collectify_tag_manager'); /* em pour TAG !! */
                $inputtag = $this->getRequest()->get('inputtag');
                $alltags = $managertag->getAll(); /* array de tous les objets tags  */
                $tagaajouté = array(); // tableau vide
                foreach ($alltags as $tag) {
                    $tagtitle = $tag->getTitle(); /* get title of objects :D */
                    if ($inputtag == $tagtitle) {
                        $selectedtag = $managertag->getByTitle($tagtitle); /* get objet tag by title */
                        array_push($tagaajouté, $selectedtag);
                        $sujet->setTags($tagaajouté);
                    }
                }







                $positiondelarticleenajout = $form["position"]->getData(); /* INTEGER la position du nouveau article ajouté */
                $fixedpositionChecked = $form["fixedposition"]->getData(); /*  Boolean TRUE si Fixed Position is Checked */
                /* $lapositionchoisie contient 'vide' si position vide sinon 'contenufixe' ou 'contenuNONfixe' */
                $lapositionchoisie = $manager->Disponiblitedelapositionchoisie($positiondelarticleenajout);
                if (($positiondelarticleenajout === 1) && ($fixedpositionChecked === TRUE)) {
                    /*                     * *     j 'affecte l a'rticle a la premiere position libre       ** */
                    if ($lapositionchoisie != 'contenufixe') {
                        $article->setPosition($positiondelarticleenajout);
                        if (!empty($articleNOfixedposition)) {
                            $manager->ShiftToLeftNofixedPosition();
                        }
                        $manager->persist($article);
                    } elseif ($lapositionchoisie === 'contenufixe') {
                        throw $this->createNotFoundException('STOP. The chosen position is fixed. Please unfix this position first.');
                    }
                }
                if (($positiondelarticleenajout === 1) && ($fixedpositionChecked === FALSE)) {
                    /*                     * **    j 'affecte l a'rticle a la premiere position libre      *** */
                    $article->setPosition($premierepositionlibre);
                    $manager->persist($article);
                }
                if (($positiondelarticleenajout != 1) && ($fixedpositionChecked === TRUE)) {
                    if ($lapositionchoisie != 'contenufixe') {
                        if (!empty($articleNOfixedposition)) {
                            $manager->ShiftToLeftNofixedPosition();
                        }
                        $article->setPosition($positiondelarticleenajout);
                        $manager->persist($article);
                    } elseif ($lapositionchoisie === 'contenufixe') {
                        throw $this->createNotFoundException('STOP. The chosen position is fixed. Please unfix this position first.');
                    }
                }
                if (($positiondelarticleenajout != 1) && ($fixedpositionChecked === FALSE)) {
                    if ($lapositionchoisie != 'contenufixe') {
                        $article->setPosition($positiondelarticleenajout);
                        $manager->persist($article);
                    } elseif ($lapositionchoisie === 'contenufixe') {
                        throw $this->createNotFoundException('STOP. The chosen position is fixed. Please unfix this position first.');
                    }
                }
                // $url = $this->getRequest()->headers->get("referer"); // renvoie previous url :D
                return $this->redirect($this->generateUrl('my_app_article_article_add'));
            }
        }
        return $this->render('MyAppArticleBundle:article:add.html.twig', array('form' => $form->createView(), 'tags' => $tags));
    }

    public function showAction() {
        $em = $this->getDoctrine()->getManager();
        /*         * *****************    recuperation de tout les article s    ************ */
        $article = $em->getRepository('MyAppArticleBundle:article')->getAllArticle();
        $publicite = $em->getRepository('MyAppEspritBundle:publicite')->getintPub();
        $sujet = $em->getRepository('MyAppForumBundle:sujet')->getAllsujetrecent();
        /*  sortedtopic by comment */
        $commentarray = array(); // tableau vide
        $sortedtopic = array(); // tableau vide
        foreach ($sujet as $s) {
            $commentCount = $em->getRepository('MyAppForumBundle:sujet')->getCommentCountBySujet($s->getId());
            array_push($commentarray, $commentCount); /* inserer la valeur dans l array vide */
        }
        rsort($commentarray); /* tri du tableau selon value */
        for ($index = 0; $index < count($commentarray); $index++) {
            for ($jndex = 0; $jndex < count($sujet); $jndex++) {
                if ($em->getRepository('MyAppForumBundle:sujet')->getCommentCountBySujet($sujet[$jndex]->getId()) == $commentarray[$index]) {
                    array_push($sortedtopic, $sujet[$jndex]); /* inserer la valeur dans l array vide */
                }
            }
        }
        /*  sortedtopic by comment */
        $sujetneverarticlebeforearray = array();
        foreach ($article as $ar) {
            if ($ar->getPosition() < 16) {
                $s = $ar->getHeadline();
                $qb1 = $em->createQueryBuilder();
                $qb1->select('a')
                        ->from('MyAppForumBundle:sujet', 'a')
                        ->where('a.sujet != :v')
                        ->setParameter('v', $s);
                $query1 = $qb1->getQuery();
                $sujetneverarticlebefore = $query1->getResult();
                array_push($sujetneverarticlebeforearray, $sujetneverarticlebefore);
            } else {
                foreach ($sujet as $s) {
                    array_push($sujetneverarticlebeforearray, $s);
                }
            }
        }


        $sujetnotarticle = $sujetneverarticlebeforearray[0];

        return $this->render('MyAppArticleBundle:article:show.html.twig', array(
                    'article' => $article, 'publicite' => $publicite, 'sujet' => $sujet
                    , 'mostcommenteddebat' => $sortedtopic, 'sujetnotarticle' => $sujetnotarticle
        ));
    }

    public function deleteAction(article $article) {
        $em = $this->getDoctrine()->getManager();
        $selectarticle = $em->getRepository('MyAppArticleBundle:article')->find($article->getId());
        $em->remove($article);
        $em->flush();
        $manager = $this->get('collectify_article_manager');
        $this->get('session')->getFlashBag()->set('message', 'Ce article  disparait !!');
        return $this->redirect($this->generateUrl('my_app_article_article_deletemore', array(
                            'selectarticle' => $selectarticle
        )));
    }

    public function manageAction() {
        $em = $this->getDoctrine()->getManager();
        /*         * *******************    recuperation de tout les article s    ************ */
        $article = $em->getRepository('MyAppArticleBundle:article')->getAllArticle();
        $form = $this->createFormBuilder($article)->add('article')->getForm();
        return $this->render('MyAppArticleBundle:article:manage.html.twig', array(
                    'form' => $form->createView(), 'article' => $article
        ));
    }

    public function deletemoreAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $manager = $this->get('collectify_article_manager');/** equivalent de em manager * */
        $article = $em->getRepository('MyAppArticleBundle:article')->findAll();
        $form = $this->createFormBuilder($article)->add('article')->getForm();
        $totalnumberofar = intval($em->getRepository('MyAppArticleBundle:article')->getARnumber());
        /* delete more  checked */
        $ids = $this->getRequest()->get('mesIds');
        if ($totalnumberofar <= 15) {
            $this->get('session')->getFlashBag()->set('message', 'At least  15 AR  !');
        }
        if ((count($ids) > 1) && ( $totalnumberofar > 15)) {
            $articled = $em->getRepository('MyAppArticleBundle:article')->findBy(array('id' => $ids));
            $manager->removemore($articled);
            $done = 1;
            while ($done <= $ids) {
                if (!empty($articleNOfixedposition)) {
                    $manager->ShiftToRightNofixedPosition();
                }
                $done++;
            }
            return $this->render('MyAppArticleBundle:article:manage.html.twig', array(
                        'form' => $form->createView(), 'article' => $article));
        }
        /* delete more  checked */
        /* delete one checked */
        if ((count($ids) === 1) && ( $totalnumberofar > 15)) {
            $articled = $em->getRepository('MyAppArticleBundle:article')->findBy(array('id' => $ids));
            if ($articleNOfixedposition != NULL) {
                $manager->ShiftToRightNofixedPosition();
            }
            $manager->removemore($articled);
            return $this->render('MyAppArticleBundle:article:manage.html.twig', array(
                        'form' => $form->createView(), 'article' => $article));
        }
        /* delete one  checked */
        $positions = $this->getRequest()->get('i'); /* tableau de string position text input deja   :D */
        /* test pour la duplication des valeurs positions AR */
        if (($positions != array_unique($positions)) && ($positions != NULL)) {
            $this->get('session')->getFlashBag()->set('message', 'More than one AR per position  !!');
            return $this->render('MyAppArticleBundle:article:manage.html.twig', array(
                        'form' => $form->createView(), 'article' => $article
            ));
        }
        /* fin de la validation des valeurs positions AR */
        /* debut mise a jour des positions AR selon les input text */
        if ($positions != NULL) {
            for ($index = 0; $index < count($positions); $index++) {
                if ($article[$index]->getPosition() != $positions[$index]) {
                    $article[$index]->setPosition($positions[$index]);
                    $manager->persist($article[$index]);
                }
            }
        } /*  fin  mise a jour des positions AR selon les input text */
        /*  gestion des FIXED and UNFIXED */
        $fixedornotvalue = $this->getRequest()->get('fixedposition'); /* tableau de string id deja coché :D */
        if ($fixedornotvalue != NULL) {
            foreach ($article as $a) {
                if (in_array($a->getId(), array_values($fixedornotvalue))) {
                    $manager->makeFIX($a);
                } else {
                    $manager->makeUNFIX($a);
                }
            }
        }
        /*  gestion des FIXED and UNFIXED */
        return $this->render('MyAppArticleBundle:article:manage.html.twig', array(
                    'form' => $form->createView(), 'article' => $article
        ));
    }

}
