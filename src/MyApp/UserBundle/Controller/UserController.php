<?php

namespace MyApp\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller {

    public function showAction( Request $request) {
        
        $em = $this->getDoctrine()->getManager();         
        /*
        $sql = 'TRUNCATE TABLE user;';
        $connection = $em->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $stmt->closeCursor();  
         */
 
        $user = $em->getRepository('MyAppUserBundle:user')->findAll();

        return $this->render('MyAppUserBundle:User:show.html.twig', array(
                    'user' => $user                     
        ));
    }

    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('MyAppUserBundle:user')->find($id);

        if (!$user) {
            throw $this->createNotFoundException('No user found for id ' . $id);
        }
        $em->remove($user);
        $em->flush();
        $this->get('session')->getFlashBag()->set('message', 'Ce user disparait !!');

        return $this->redirect($this->generateUrl('my_app_user_show'));
    }

    public function editAction($id, Request $request) {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('MyAppUserBundle:user')->find($id);
        if (!$user) {
            throw $this->createNotFoundException(
                    'no Utilisateur found for id ' . $id
            );
        }

        $form = $this->createFormBuilder($user)


                ->add('username', 'text')
                
                ->add('enabled','checkbox', array('required' => false))
                
                
                ->add('roles', 'collection', array(
                    'type' => 'choice',
                    'options' => array(
                        'label' => false, /* Ajoutez cette ligne */
                        'choices' => array(
                            'ROLE_ADMIN' => 'Admin',
                            'ROLE_SUPER_ADMIN' => 'Superadmin',
                            'ROLE_SUPERSOL' => 'Supersol',
                            'ROLE_EDITOR' => 'Editor',
                            'ROLE_USER' => 'User',
                ))))
                ->getForm();

        $form->handleRequest($request);


        if ($form->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('my_app_user_show'));
        }

        return $this->render('MyAppUserBundle:user:edit.html.twig', array(
            'form' => $form->createView(),
             'user' => $user,     
                ));
    }

}
