<?php

namespace MyApp\EspritBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class publiciteController extends Controller
{
      
    
    public function addAction()
    {
        
        $publicite = new \MyApp\EspritBundle\Entity\publicite();
        $form = $this->createForm(new \MyApp\EspritBundle\Form\publiciteType ,$publicite);
        $request = $this->getRequest();
        if( $request->isMethod('Post')  ){
            
           $form->bind($request);
           
           if($form->isValid())
               
               {
               $publicite = $form->getData();
               $em = $this->getDoctrine()->getManager();
               $em->persist($publicite);
               $em->flush();
               
               
               
               return $this->redirect($this->generateUrl('my_app_esprit_publicite_show'));
               }
        }
        
       return $this->render('MyAppEspritBundle:publicite:add.html.twig',array('form'=>$form->createView())); 
    }
    
    
    /**
     * Show a Actualite entry
     */
    public function showAction()
    {
         $em = $this->getDoctrine()->getManager();

        $publicite = $em->getRepository('MyAppEspritBundle:publicite')->findAll();

        return $this->render('MyAppEspritBundle:publicite:show.html.twig', array(
            'publicite' => $publicite,
        ));
    }
    
        public function manageAction()
    {
         $em = $this->getDoctrine()->getManager();

        $publicite = $em->getRepository('MyAppEspritBundle:publicite')->findAll();

        return $this->render('MyAppEspritBundle:publicite:manage.html.twig', array(
            'publicite' => $publicite,
        ));
    }
    
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $publicite = $em->getRepository('MyAppEspritBundle:publicite')->find($id);

        if (!$publicite) {
            throw $this->createNotFoundException('No publicite found for id '.$id);
        }

        $em->remove($publicite);
        $em->flush();

        return $this->redirect($this->generateUrl('my_app_esprit_publicite_show'));
    }
    
    
    
    
    
    
    
    public function editAction($id) {

    $em = $this->getDoctrine()->getManager();
    $publicite = $em->getRepository('MyAppEspritBundle:publicite')->find($id);
    if (!$publicite) {
      throw $this->createNotFoundException(
              'No publicite found for id ' . $id
      );
    }
    
    $form = $this->createFormBuilder($publicite)
            
        ->add('position', 'text')
       
        ->add('image', 'text')
           
            
        ->add('utilisateur','entity',array('class'=>'MyApp\UserBundle\Entity\User','property'=>'nom'))
        
        ->getForm();

    $form->handleRequest();
 
    if ($form->isValid()) {
        $em->flush();
       return $this->redirect($this->generateUrl('my_app_esprit_publicite_show'));
    }
                            
       return $this->render('MyAppEspritBundle:publicite:edit.html.twig',array('form'=>$form->createView())); 
    }
     
 
}
