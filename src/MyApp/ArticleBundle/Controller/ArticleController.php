<?php

namespace MyApp\ArticleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\ArticleBundle\Form\ArticleType;
use MyApp\ArticleBundle\Entity\Article;

class ArticleController extends Controller {

    public function addAction() {

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
                $positiondelarticleenajout = $form["position"]->getData(); /* INTEGER la position du nouveau article ajouté */
                $fixedpositionChecked = $form["fixedposition"]->getData(); /*  Boolean TRUE si Fixed Position is Checked */
                /* $lapositionchoisie contient 'vide' si position vide sinon 'contenufixe' ou 'contenuNONfixe' */
                $lapositionchoisie = $manager->Disponiblitedelapositionchoisie($positiondelarticleenajout);


                if (($positiondelarticleenajout === 1) && ($fixedpositionChecked === TRUE)) {
                    /*                     * * j 'affecte l a'rticle a la premiere position libre * */
                    if ($lapositionchoisie != 'contenufixe') {
                        $article->setPosition($positiondelarticleenajout);
                        $manager->ShiftToLeftNofixedPosition();
                        $manager->persist($article);
                    }
                    if ($lapositionchoisie == 'contenufixe') {
                        throw $this->createNotFoundException('STOP. The chosen position is fixed. Please unfix this position first.');
                    }
                }



                if (($positiondelarticleenajout === 1) && ($fixedpositionChecked === FALSE)) {
                    /*                     * * j 'affecte l a'rticle a la premiere position libre * */
                    $article->setPosition($premierepositionlibre);
                    $manager->persist($article);
                }



                if (($positiondelarticleenajout != 1) && ($fixedpositionChecked === TRUE)) {
                    if ($lapositionchoisie != 'contenufixe') {

                        $article->setPosition($positiondelarticleenajout);
                        $manager->ShiftToLeftNofixedPosition();
                        $manager->persist($article);
                    }
                    if ($lapositionchoisie == 'contenufixe') {
                        throw $this->createNotFoundException('STOP. The chosen position is fixed. Please unfix this position first.');
                    }
                }



                if (($positiondelarticleenajout != 1) && ($fixedpositionChecked === FALSE)) {
                    if ($lapositionchoisie != 'contenufixe') {
                        $article->setPosition($positiondelarticleenajout);
                        $manager->persist($article);
                    }
                    if ($lapositionchoisie != 'contenufixe') {
                        throw $this->createNotFoundException('STOP. The chosen position is fixed. Please unfix this position first.');
                    }
                }





                return $this->redirect($this->generateUrl('my_app_article_article_add'));
            }
        }

        return $this->render('MyAppArticleBundle:article:add.html.twig', array('form' => $form->createView()));
    }

    public function showAction() {
        $em = $this->getDoctrine()->getManager();
        /*         * *******************    recuperation de tout les article s    ************ */
        $article = $em->getRepository('MyAppArticleBundle:article')->getAllArticle();
        $publicite = $em->getRepository('MyAppEspritBundle:publicite')->getintPub();
        $sujet = $em->getRepository('MyAppForumBundle:sujet')->getAllsujetrecent();
        return $this->render('MyAppArticleBundle:article:show.html.twig', array(
                    'article' => $article, 'publicite' => $publicite, 'sujet' => $sujet
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

        /* delete more  checked */
        $ids = $this->getRequest()->get('mesIds');
        if (count($ids) > 1) {
            $articled = $em->getRepository('MyAppArticleBundle:article')->findBy(array('id' => $ids));
             $manager->removemore($articled);
            $done = 1;
            while ($done <= $ids) {
              $manager->ShiftToRightNofixedPosition();
               $done++;
            }
           
            return $this->render('MyAppArticleBundle:article:manage.html.twig', array(
                        'form' => $form->createView(), 'article' => $article));
        }
        /* delete more  checked */
        /* delete one checked */
        
        if (count($ids) === 1) {
            $articled = $em->getRepository('MyAppArticleBundle:article')->findBy(array('id' => $ids));
            $manager->ShiftToRightNofixedPosition();
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
