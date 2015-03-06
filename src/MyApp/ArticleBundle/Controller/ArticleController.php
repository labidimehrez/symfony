<?php

namespace MyApp\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\ArticleBundle\Form\ArticleType;
use MyApp\ArticleBundle\Entity\Article;

class ArticleController extends Controller {

    public function addAction() {

        $em = $this->getDoctrine()->getManager();
        /** article fixed position * */
        $articlefixedposition = $em->getRepository('MyAppArticleBundle:article')->getArticleWithFixedPosition();
        /** article NO fixedposition * */
        $articleNOfixedposition = $em->getRepository('MyAppArticleBundle:article')->getArticleNOFixedPosition();

        $lespositionsoccupés = $em->getRepository('MyAppArticleBundle:article')->getPositionOccuped();
 
        /*         * * les 15 positions * */
        $Totalpositions = array(
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
            6 => 6,
            7 => 7,
            8 => 8,
            9 => 9,
            10 => 10,
            11 => 11,
            12 => 12,
            13 => 13,
            14 => 14,
            15 => 15,
        );


        foreach ($articleNOfixedposition as $anfp) {
            $positionlibre = $anfp->getPosition();  //var_dump($positionlibre); die();      
        }


        foreach ($articlefixedposition as $afp) {
            $positionoccuped = $afp->getPosition();     //  var_dump($positionoccuped);   die();    
        }

        $article = new Article();
        $form = $this->createForm(new ArticleType, $article);
        $request = $this->getRequest();
        if ($request->isMethod('Post')) {

            $form->bind($request);

            if ($form->isValid()) {
                $article = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();



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
        /** article fixed position * */
        $articlefixedposition = $em->getRepository('MyAppArticleBundle:article')->getArticleWithFixedPosition();
        /** article NO fixedposition * */
        $articleNOfixedposition = $em->getRepository('MyAppArticleBundle:article')->getArticleNOFixedPosition();

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

}
