<?php

namespace MyApp\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StyleController extends Controller
{
    
    
      public function addAction()
    {
        
        $style = new \MyApp\ArticleBundle\Entity\style();
        $form = $this->createForm(new \MyApp\ArticleBundle\Form\StyleType ,$style);
        $request = $this->getRequest();
        if( $request->isMethod('Post')  ){
            
           $form->bind($request);
           
           if($form->isValid())
               
               {
               $style = $form->getData();
               $em = $this->getDoctrine()->getManager();
               $em->persist($style);
               $em->flush();
               
               
               
               return $this->redirect($this->generateUrl('my_app_article_style_add'));
               }
        }
        
       return $this->render('MyAppArticleBundle:style:add.html.twig',array('form'=>$form->createView())); 
    }
    
}
