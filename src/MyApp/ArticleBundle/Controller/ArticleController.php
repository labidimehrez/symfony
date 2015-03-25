<?php

namespace MyApp\ArticleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\ArticleBundle\Form\ArticleType;
use MyApp\ArticleBundle\Entity\Article;


class ArticleController extends Controller {

    public function addAction() {

        $manager = $this->get('collectify_article_manager');/** equivalent de em manager * */
        $articleWithfixedposition = $manager->getArticleWithFixedPosition(); /* array des positions FIXéS */
        $articleNOfixedposition = $manager->getArticleNOFixedPosition(); /* array des positions non fixés */
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

                $em = $this->getDoctrine()->getManager();
                $Etatdelapositionchoisie = $em->getRepository('MyAppArticleBundle:article')->getDisponiblite($positiondelarticleenajout);
                $Etat = 0;
                foreach ($Etatdelapositionchoisie as $e) {
                    $Etat = $e->getFixedposition(); // Etat de la position choisi par la form string cad "1" ou "0"
                }
                if (($positiondelarticleenajout === 1) && ($fixedpositionChecked === TRUE)) {
                    /*                     * * j 'affecte l a'rticle a la premiere position libre * */
                    if ($Etat != 1) {
                        $article->setPosition($premierepositionlibre);
                        $manager->ShiftToRightNofixedPosition();
                        $manager->persist($article);
                    } else {
                        throw $this->createNotFoundException('STOP. The chosen position is fixed. Please unfix this position first.');
                    }
                } elseif (($positiondelarticleenajout === 1) && ($fixedpositionChecked === FALSE)) {
                    /*                     * * j 'affecte l a'rticle a la premiere position libre * */
                    if ($Etat != 1) {
                        $article->setPosition($premierepositionlibre);
                        $manager->persist($article);
                    } else {
                        throw $this->createNotFoundException('STOP. The chosen position is fixed. Please unfix this position first.');
                    }
                } elseif (($positiondelarticleenajout != 1) && ($fixedpositionChecked === TRUE)) {
                    if ($Etat != 1) {
                        $manager->ShiftToRightNofixedPosition();
                        $manager->persist($article);
                    } else {
                        throw $this->createNotFoundException('STOP. The chosen position is fixed. Please unfix this position first.');
                    }
                } elseif (($positiondelarticleenajout != 1) && ($fixedpositionChecked === FALSE)) {
                    if ($Etat != 1) {
                        $manager->persist($article);
                    } else {
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
        $manager->ShiftToLeftNofixedPosition();
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
        $ids = $this->getRequest()->get('mesIds');
        $em = $this->getDoctrine()->getManager();
        $articled = $em->getRepository('MyAppArticleBundle:article')->findBy(array('id' => $ids));
        $manager = $this->get('collectify_article_manager');/** equivalent de em manager * */
        $manager->removemore($articled);
        $article = $em->getRepository('MyAppArticleBundle:article')->findAll();
        $form = $this->createFormBuilder($article)->add('article')->getForm();
        return $this->render('MyAppArticleBundle:article:manage.html.twig', array(
                    'form' => $form->createView(), 'article' => $article
        ));
    }

}
