<?php

namespace MyApp\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TagController extends Controller {

    public function addAction() {
        
                     
        $em = $this->getDoctrine()->getManager();
        
     /**********************************************************************/
        $tag = $em->getRepository('MyAppForumBundle:tag')->findAll(); 
     if (!$tag) {   
         
         
        $tag1 = new \MyApp\ForumBundle\Entity\tag();      
        $tag1->setTitle("tag1");    
        $tag2 = new \MyApp\ForumBundle\Entity\tag();      
        $tag2->setTitle("tag2");
 
        $em1 = $this->getDoctrine()->getManager();
        
        
        $em1->persist($tag1);
        $em1->persist($tag2);
        
        
        
        $em1->flush(); 
         }
        
          /**********************************************************************/ 
        

        $tag = new \MyApp\ForumBundle\Entity\tag();
        $form = $this->createForm(new \MyApp\ForumBundle\Form\TagType, $tag);
        $request = $this->getRequest();
        if ($request->isMethod('Post')) {

            $form->bind($request);

            if ($form->isValid()) {
                $tag = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($tag);
                $em->flush();



                return $this->redirect($this->generateUrl('my_app_forum_tag_add'));
            }
        }

        return $this->render('MyAppForumBundle:tag:add.html.twig', array('form' => $form->createView()));
    }

    
        
        public function showAction( ) {
        
        $em = $this->getDoctrine()->getManager();              
        $tag = $em->getRepository('MyAppForumBundle:tag')
                
                ->findAll();

        return $this->render('MyAppForumBundle:tag:show.html.twig', array(
                    'tag' => $tag                    
        ));
    }
    
}
