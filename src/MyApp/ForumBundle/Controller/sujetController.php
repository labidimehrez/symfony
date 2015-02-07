<?php

namespace MyApp\ForumBundle\Controller;

use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class sujetController extends Controller {

    public function addAction() {

//      if(!$this->get('security.context' )->isGranted('ROLE_USER'))
//          {
//           return $this->redirect($this->generateUrl('fos_user_security_login'));
//          }

        /*         * ** je recuperer l id de user connecté * */
        $user = $this->container->get('security.context')->getToken()->getUser();
        $user->getId();
        /*         * ** je recuperer l id de user connecté * */
        $sujet = new \MyApp\ForumBundle\Entity\sujet();

        $form = $this->createForm(new \MyApp\ForumBundle\Form\sujetType, $sujet);
        $request = $this->getRequest();
        if ($request->isMethod('Post')) {

            $form->bind($request);

            if ($form->isValid()) {

                $sujet = $form->getData();

                /*                 * ** je recuperer l id de user connecté * */
                $sujet->setUser($user);
                /*                 * ** je recuperer l id de user connecté * */

                $em = $this->getDoctrine()->getManager();
                $em->persist($sujet);
                $em->flush();



                return $this->redirect($this->generateUrl('my_app_forum_sujet_add'));
            }
               if (!$form->isValid()) {   
                   $this->get('session')->getFlashBag()->set('message', ' ( Des Champs invalides!! )'); 

              return $this->render('MyAppForumBundle:sujet:add.html.twig', array(
                    'form' => $form->createView()));
               }
            
            
            
             /*if (!$form->isValid()) {
                var_dump($form);
                die(); }*/
           
        }


        return $this->render('MyAppForumBundle:sujet:add.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function showAction() {

        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository('MyAppForumBundle:sujet')
                ->findBy(
                array(), array('datecreation' => 'desc'), 6, 0
        );

        return $this->render('MyAppForumBundle:sujet:show.html.twig', array(
                    'sujet' => $sujet
        ));
    }

    public function manageAction() {

        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository('MyAppForumBundle:sujet')
                ->findBy(array(), array('datecreation' => 'desc'),1000, 0);

        return $this->render('MyAppForumBundle:sujet:manage.html.twig', array(
                    'sujet' => $sujet
        ));
    }

    public function sujetrecentAction() {
        $em = $this->getDoctrine()->getManager();

        $sujet = $em->getRepository('MyAppForumBundle:sujet')
                ->findBy(
                array(), array('datecreation' => 'desc'), 6, 0
        );

        return $this->render('MyAppForumBundle:sujet:sujetrecent.html.twig', array(
                    'sujet' => $sujet
        ));
    }

    public function deleteAction($id) {

        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository('MyAppForumBundle:sujet')->find($id);

        if (!$sujet) {
            throw $this->createNotFoundException('No  sujet found for id ' . $id);
        }

        $em->remove($sujet);
        $em->flush();

        return $this->redirect($this->generateUrl('my_app_forum_sujet_manage'));
    }

    public function editAction($id) {

        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository('MyAppForumBundle:sujet')->find($id);
        if (!$sujet) {
            throw $this->createNotFoundException(
                    'No  sujet found for id ' . $id
            );
        }

        $form = $this->createFormBuilder($sujet)
                ->add('contenu', 'text')
                ->add('sujet', 'text')
                ->getForm();

        $form->handleRequest();

        if ($form->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('my_app_forum_sujet_manage'));
        }

        return $this->render('MyAppForumBundle:sujet:manage.html.twig', array('form' => $form->createView()));
    }

}
