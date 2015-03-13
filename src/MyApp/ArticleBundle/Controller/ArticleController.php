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
        $pos=array();// tableau vide
        $positionlibre=array();// tableau vide
        foreach ($lespositionsoccupés as $s){
            $a = $s->getPosition(); // recupere les positions des artciles ajoutés
            array_push($pos, $a );  // ajouter la position au tableau vide
        }
        if (! in_array("1", $pos) ) {array_push($positionlibre, 1 );} 
        if (! in_array("2", $pos) ) {array_push($positionlibre, 2 );} 
        if (! in_array("3", $pos) ) {array_push($positionlibre, 3 );} 
        if (! in_array("4", $pos) ) {array_push($positionlibre, 4 );} 
        if (! in_array("5", $pos) ) {array_push($positionlibre, 5 );} 
        if (! in_array("6", $pos) ) {array_push($positionlibre, 6 );} 
        if (! in_array("7", $pos) ) {array_push($positionlibre, 7 );} 
        if (! in_array("8", $pos) ) {array_push($positionlibre, 8 );} 
        if (! in_array("9", $pos) ) {array_push($positionlibre, 9 );}        
        if (! in_array("10",$pos) ){array_push($positionlibre, 10 );} 
        if (! in_array("11",$pos) ){array_push($positionlibre, 11 );} 
        if (! in_array("12",$pos) ){array_push($positionlibre, 12 );} 
        if (! in_array("13",$pos) ){array_push($positionlibre, 13 );} 
        if (! in_array("14",$pos) ){array_push($positionlibre, 14 );} 
        if (! in_array("15",$pos) ){array_push($positionlibre, 15 );} 
   
      //  $positionlibre  tableau qui contient les position vides
        $premierepositionlibre =reset($positionlibre);// integer => premiere position libre 
    
        
 
        $article = new Article();
        $form = $this->createForm(new ArticleType, $article);
        $request = $this->getRequest();
        if ($request->isMethod('Post')) {

            $form->bind($request);

            if ($form->isValid()) {
                $article = $form->getData();
                /*** j 'affecte l a'rticle a la premiere position libre **/
                $article->setPosition($premierepositionlibre);
                /*** j 'affecte l a'rticle a la premiere position libre **/
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
        
    }

}
