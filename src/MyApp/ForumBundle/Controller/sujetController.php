<?php

namespace MyApp\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Form;
 
use MyApp\ForumBundle\Form\sujetType;
use MyApp\ForumBundle\Entity\sujet;

class sujetController extends Controller {

    public function addAction() {


        /*         * ** je recuperer l id de user connecté * */
        $user = $this->container->get('security.context')->getToken()->getUser();
        $user->getId();
        /*         * ** je recuperer l id de user connecté * */
        $sujet = new sujet();

        $form = $this->createForm(new sujetType, $sujet);
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
                $this->get('session')->getFlashBag()->set('message', ' ( Des Champs invalides ou existe deja !! )');

                return $this->render('MyAppForumBundle:sujet:add.html.twig', array(
                            'form' => $form->createView()));
            }
        }

        return $this->render('MyAppForumBundle:sujet:add.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function showAction() {

        $em = $this->getDoctrine()->getEntityManager();
        /*         * *******************    recuperation de tout les sujets    ************ */
        $sujet = $em->getRepository('MyAppForumBundle:sujet')->getAllsujet();
        //var_dump($sujet);die();
        return $this->render('MyAppForumBundle:sujet:show.html.twig', array(
                    'sujet' => $sujet
        ));
    }

    public function manageAction() {

        $em = $this->getDoctrine()->getManager();
        /*         * ****************  recuperation de tout les sujets  *********** */
        $sujet = $em->getRepository('MyAppForumBundle:sujet')->getAllsujet();
        //var_dump($sujet);die();
        return $this->render('MyAppForumBundle:sujet:manage.html.twig', array(
                    'sujet' => $sujet
        ));
    }

    
    public function sujetrecentAction() {

        $em = $this->getDoctrine()->getManager();
        /*         * *****  select all sujet from table ** */
        $sujet = $em->getRepository('MyAppForumBundle:sujet')->getAllsujet();
        /*         * *****  select all tag from table association  ** */

        $tag1 = $em->getRepository('MyAppForumBundle:tag')->getBySujet(1);
        $tag2 = $em->getRepository('MyAppForumBundle:tag')->getBySujet(2);
//        var_dump($tag5);
//        die();
  
        
       
   
        return $this->render('MyAppForumBundle:sujet:sujetrecent.html.twig', array(
                    'sujet' => $sujet,
                    'tag2' => $tag2 ,  'tag1' => $tag1
                
                        )
        );
    }

    public function deleteAction($id) {
        /*         * ************ simple delete action *************** */
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
        /*         * ************ simple edit action *************** */
        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository('MyAppForumBundle:sujet')->find($id);
        if (!$sujet) {
            throw $this->createNotFoundException('No  sujet found for id ' . $id);
        }

        $form = $this->createForm(new sujetType(), $sujet);
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em->flush();
                return $this->redirect($this->generateUrl('my_app_forum_sujet_manage'));
            }
        }
        /*         * ********* **    recuperation de tout les sujets  *********** */
        $sujet2 = $em->getRepository('MyAppForumBundle:sujet')->findAll();
        return $this->render('MyAppForumBundle:sujet:edit.html.twig', array(
                    'form' => $form->createView(),
                    'sujet' => $sujet, 'sujet2' => $sujet2
        ));
    }

    public function voirAction($id) {
        
        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository('MyAppForumBundle:sujet')->find($id);
        if (!$sujet) {
            throw $this->createNotFoundException('No  sujet found for id ' . $id);
        }
        $tag = $em->getRepository('MyAppForumBundle:tag')->getBySujet($id);
        //var_dump($sujet);die();
        return $this->render('MyAppForumBundle:sujet:voir.html.twig', array(
                    'sujet' => $sujet
                    ,'tag'=>$tag
        ));
    }

}
