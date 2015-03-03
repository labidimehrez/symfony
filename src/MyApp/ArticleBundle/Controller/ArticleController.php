<?php

namespace MyApp\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\ArticleBundle\Form\ArticleType;
use MyApp\ArticleBundle\Entity\Article;

class ArticleController extends Controller {

    public function addAction() {

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
        
        return $this->render('MyAppArticleBundle:article:show.html.twig', array(
                    'article' => $article,'publicite'=>$publicite,'sujet'=>$sujet
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
