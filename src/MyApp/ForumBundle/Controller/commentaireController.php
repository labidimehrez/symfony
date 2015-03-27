<?php

namespace MyApp\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MyApp\ForumBundle\Form\commentaireType;
use MyApp\ForumBundle\Entity\commentaire;
use MyApp\EspritBundle\Entity\notification;

class commentaireController extends Controller {

    public function addAction(Request $request) {
        $uri = $this->get('request')->server->get('HTTP_REFERER'); /* get current url */
        $idsujet = substr($uri, 45, -5); /* get current debat id */

        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository('MyAppForumBundle:sujet')->find($idsujet);

        /*         * ** je recuperer l id de user connecté * */
        $user = $this->container->get('security.context')->getToken()->getUser();
        $user->getId();
        /*         * ** je recuperer l id de user connecté * */
        $commentaire = new commentaire();

        $form = $this->createForm(new commentaireType, $commentaire);
        $request = $this->getRequest();
        if ($request->isMethod('Post')) {

            $form->bind($request);

            if ($form->isValid()) {

                $commentaire = $form->getData();
                /*                 * ** je recuperer l id de user connecté * */
                $commentaire->setUser($user);
                /*                 * ** je recuperer l id de user connecté * */
                $commentaire->setSujet($sujet);



                $em->persist($commentaire);
                $em->flush();


                return $this->redirect($this->generateUrl('my_app_forum_sujet_voir', array('id' => $idsujet)));
            }
            if (!$form->isValid()) {
                $this->get('session')->getFlashBag()->set('message', ' ( Des Champs invalides ou existe deja !! )');

                return $this->render('MyAppForumBundle:sujet:sujetrecent.html.twig', array(
                            'form' => $form->createView()));
            }
        }
        return $this->render('MyAppForumBundle:commentaire:add.html.twig', array('form' => $form->createView()));
    }

    public function addsouscommentAction($id, Request $request) {
        $uri = $this->get('request')->server->get('HTTP_REFERER'); /* get current url */
        $idsujet = substr($uri, 45, -5); /* get current debat id */
        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository('MyAppForumBundle:sujet')->find($idsujet);
        $user = $this->container->get('security.context')->getToken()->getUser();
        $user->getId();
        $commentaire = new commentaire();
        $form = $this->createForm(new commentaireType, $commentaire);
        $request = $this->getRequest();
        if ($request->isMethod('Post')) {
            $form->bind($request);
            if ($form->isValid()) {
                $commentaire = $form->getData();
                $commentaire->setUser($user);
                $commentaire->setSujet($sujet);
                $commentaireparent = $em->getRepository('MyAppForumBundle:commentaire')->find($id);
                $commentaire->setCommentaire($commentaireparent);
                $em->persist($commentaire);
                $em->flush();
                return $this->redirect($this->generateUrl('my_app_forum_sujet_voir', array('id' => $idsujet)));
            }
            if (!$form->isValid()) {
                $this->get('session')->getFlashBag()->set('message', ' ( Des Champs invalides ou existe deja !! )');
                return $this->render('MyAppForumBundle:sujet:sujetrecent.html.twig', array(
                            'form' => $form->createView()));
            }
        }
        return $this->render('MyAppForumBundle:commentaire:addsouscomment.html.twig', array('form' => $form->createView(), 'id' => $id));
    }

    public function deleteAction($id, Request $request) {
        /*         * ************ simple delete action *************** */
        $uri = $this->get('request')->server->get('HTTP_REFERER'); /* get current url */
        $idsujet = substr($uri, 45, -5); /* get current debat id */


        $em = $this->getDoctrine()->getManager();
        $commentaire = $em->getRepository('MyAppForumBundle:commentaire')->find($id);

        if (!$commentaire) {
            throw $this->createNotFoundException('No  commentaire found for id ' . $id);
        }

        $em->remove($commentaire);
        $em->flush();
        return $this->redirect($this->generateUrl('my_app_forum_sujet_voir', array('id' => $idsujet)));
    }

    public function editAction($id , Request $request) {
        $id = 1;
        $em = $this->getDoctrine()->getManager();
        $commentaire = $em->getRepository('MyAppForumBundle:commentaire')->find($id);
        if (!$commentaire) {
            throw $this->createNotFoundException(
                    'No commentaire found for id ' . $id
            );
        }

        $form = $this->createFormBuilder($commentaire)
                        ->add('texte', 'textarea', array('required' => true))->getForm();
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            /*             * *********  validation form ********************* */
            if ($form->isValid()) {
                $em->flush();
                return $this->redirect($this->generateUrl('my_app_esprit_menu_show'));
            }
        }


        if ($form->isValid()) {
            $em->flush();
            return $this->render('MyAppForumBundle:commentaire:edit.html.twig', 
                    array('form' => $form->createView(), 'id' => $id));
        }

        return $this->render('MyAppForumBundle:commentaire:edit.html.twig',
                array('form' => $form->createView(), 'id' => $id));
    }

    public function editsouscommentAction() {

        $em = $this->getDoctrine()->getManager();
        $id = 2;
        $souscommentaire = $em->getRepository('MyAppForumBundle:commentaire')->find($id);
        if (!$souscommentaire) {
            throw $this->createNotFoundException(
                    'No souscommentaire found for id ' . $id
            );
        }

        $form = $this->createFormBuilder($souscommentaire)
                        ->add('texte', 'textarea', array('required' => true))->getForm();
        $request = $this->getRequest();




        if ($form->isValid()) {
            $em->flush();
            return $this->render('MyAppForumBundle:commentaire:editsouscomment.html.twig', array(
                        'form' => $form->createView()));
        }

        return $this->render('MyAppForumBundle:commentaire:editsouscomment.html.twig', array('form' => $form->createView()));
    }

}
