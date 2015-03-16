<?php

namespace MyApp\ArticleBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\ArticleBundle\Form\ArticleType;
use MyApp\ArticleBundle\Entity\Article;

class ArticleController extends Controller {

    public function addAction() {

        $manager = $this->get('collectify_article_manager');/** equivalent de em manager * */
        $em = $this->getDoctrine()->getManager();
        /** article fixed position * */
        $articlefixedposition = $em->getRepository('MyAppArticleBundle:article')->getArticleWithFixedPosition();
        /** article NO fixedposition * */
        $articleNOfixedposition = $em->getRepository('MyAppArticleBundle:article')->getArticleNOFixedPosition();
        //var_dump($articleNOfixedposition);die();
        $lespositionsoccupés = $em->getRepository('MyAppArticleBundle:article')->getPositionOccuped();
        // var_dump($lespositionsoccupés);die();

        $premierepositionlibre = $manager->getFirstPositionFree($lespositionsoccupés);

        $article = new Article();
        $form = $this->createForm(new ArticleType, $article);
        $request = $this->getRequest();
        if ($request->isMethod('Post')) {

            $form->bind($request);

            if ($form->isValid()) {
                $article = $form->getData();
                $positiondelarticleenajout = $form["position"]->getData(); /* si position du nouveau article ajouté */
                $fixedpositionChecked = $form["fixedposition"]->getData(); /* si Fixed Position is Checked */



                // si la position choisis diff de 1 on ajute l article ou on veux
                if ($positiondelarticleenajout === 1) {
                    /*                     * * j 'affecte l a'rticle a la premiere position libre * */
                    $article->setPosition($premierepositionlibre);
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();

                return $this->redirect($this->generateUrl('my_app_article_article_add'));
            }
        }
        /* $manager = $this->get('collectify_article_manager');
          $manager->shiftNofixedPosition(); */

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
        $this->get('session')->getFlashBag()->set('message', 'Ce article  disparait !!');
        return $this->redirect($this->generateUrl('my_app_article_article_show', array(
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
