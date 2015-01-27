<?php

namespace MyApp\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
      public function addAction()
    {
        
        $article = new \MyApp\ArticleBundle\Entity\article();
        $form = $this->createForm(new \MyApp\ArticleBundle\Form\ArticleType ,$article);
        $request = $this->getRequest();
        if( $request->isMethod('Post')  ){
            
           $form->bind($request);
           
           if($form->isValid())
               
               {
               $article = $form->getData();
               $em = $this->getDoctrine()->getManager();
               $em->persist($article);
               $em->flush();
               
               
               
               return $this->redirect($this->generateUrl('my_app_article_article_add'));
               }
        }
        
       return $this->render('MyAppArticleBundle:article:add.html.twig',array('form'=>$form->createView())); 
    }
}
