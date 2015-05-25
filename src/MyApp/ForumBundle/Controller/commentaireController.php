<?php

namespace MyApp\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MyApp\ForumBundle\Form\commentaireType;
use MyApp\ForumBundle\Entity\commentaire;
use MyApp\EspritBundle\Entity\notification;
use MyApp\EspritBundle\Entity\publicite;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class commentaireController extends Controller {

    public function addAction(Request $request) {
        $uri = $this->get('request')->server->get('HTTP_REFERER'); /* get current url */
        $idsujet = filter_var($uri, FILTER_SANITIZE_NUMBER_INT); /* get current debat id */
//        var_dump($int);exit;
//        $idsujet = substr($uri, 45, -5); /* get current debat id */
        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository('MyAppForumBundle:sujet')->find($idsujet);
        /*         * ** je recuperer l id de user connecté * */
        $user = $this->container->get('security.context')->getToken()->getUser();
        $user->getId();
        /*         * ** je recuperer l id de user connecté * */
        $commentaire = new commentaire();
        $form = $this->createForm(new commentaireType, $commentaire);
        $request = $this->getRequest();


        $commentaires = array();
        $com = $em->getRepository('MyAppForumBundle:commentaire')->findBy(array('sujet' => $idsujet));
        foreach ($com as $c) {
            if ($c->getCommentaire() == NULL) {
                array_push($commentaires, $c);
            }
        }



        if ($request->isXmlHttpRequest()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $commentaire = $form->getData();
                $commentaire->setUser($user);
                $commentaire->setSujet($sujet);
                $em->persist($commentaire);
                $em->flush();
                $userConcerned = $sujet->getUser()->getId(); /// id int du user qui a ecrit le sujet
                $notif = new notification();
                $manager = $this->get('collectify_notification_manager'); /*  ajout de notif si sujet notif est deja coché */
                $manager->AddNotifFromComment($user, $commentaire, $notif, $sujet->getNotification(), $userConcerned, $sujet);
                /* il faut ajouter le user concerné par la notif */

                array_push($commentaires, $commentaire);
                //             $commentaires = array_unique($commentaires);
//                $commentaires = $em->getRepository('MyAppForumBundle:commentaire')->getCommentaireBySujet($idsujet);
                return $this->container->get('templating')->renderResponse('MyAppForumBundle:sujet/Commentaire:affichercommentaireajax.html.twig', array(
                            'commentaire' => $commentaires
                ));
            } /* else {
              return $this->render('MyAppForumBundle:sujet:voir.html.twig', array('form' => $form->createView(), 'id' => $idsujet, 'commentaire' => $commentaires));
              } */
        }
        if ($request->isMethod('Post')) {
            $form->bind($request);
            if ($form->isValid()) {
                $commentaire = $form->getData();
                /*                 * * je recuperer l id de user connecté * */
                $commentaire->setUser($user);
                /*                 * ** je recuperer l id de user connecté * */
                $commentaire->setSujet($sujet);
                $em->persist($commentaire);
                $em->flush();
                $userConcerned = $sujet->getUser()->getId(); /// id int du user qui a ecrit le sujet 
                $notif = new notification();
                $manager = $this->get('collectify_notification_manager'); /*  ajout de notif si sujet notif est deja coché */
                $manager->AddNotifFromComment($user, $commentaire, $notif, $sujet->getNotification(), $userConcerned, $sujet);
                /* il faut ajouter le user concerné par la notif */
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
        $idsujet = filter_var($uri, FILTER_SANITIZE_NUMBER_INT); /* get current debat id */
        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository('MyAppForumBundle:sujet')->find($idsujet);
        $user = $this->container->get('security.context')->getToken()->getUser();
        $user->getId();
        $commentaire = new commentaire();
        $form = $this->createForm(new commentaireType, $commentaire);
        $request = $this->getRequest();
        /*         * *** */

        $souscommentaire = array();
        $comm = $em->getRepository('MyAppForumBundle:commentaire')->findBy(array('sujet' => $idsujet));
        foreach ($comm as $c) {
            if ($c->getCommentaire() != NULL) {
                array_push($souscommentaire, $c);
            }
        }
        $commentaires = array();
        foreach ($comm as $c) {
            if ($c->getCommentaire() == NULL) {
                array_push($commentaires, $c);
            }
        }

        if ($request->isXmlHttpRequest()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $commentaire = $form->getData();
                $commentaire->setUser($user);
                $commentaire->setSujet($sujet);
                $commentaireparent = $em->getRepository('MyAppForumBundle:commentaire')->find($id);
                $commentaire->setCommentaire($commentaireparent);
                $em->persist($commentaire);
                $em->flush();
                $userConcerned = $sujet->getUser()->getId();
                $notif = new notification();
                $manager = $this->get('collectify_notification_manager');
                $manager->AddNotifFromSubComment($user, $commentaire, $notif, $commentaireparent->getNotification(), $userConcerned);

                array_push($souscommentaire, $commentaire);


                return $this->container->get('templating')->renderResponse('MyAppForumBundle:sujet/Commentaire:affichercommentaireajax.html.twig'
                                , array('souscommentaire' => $souscommentaire, 'commentaire' => $commentaires));
            }
        }

        /*         * ** */
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
                $userConcerned = $sujet->getUser()->getId(); /// id int du user qui a ecrit le sujet         
                $notif = new notification();
                $manager = $this->get('collectify_notification_manager'); /*  ajout de notif si sujet notif est deja coché */
                $manager->AddNotifFromSubComment($user, $commentaire, $notif, $commentaireparent->getNotification(), $userConcerned);
                /* il faut ajouter le user concerné par la notif */
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
        $idsujet = filter_var($uri, FILTER_SANITIZE_NUMBER_INT); /* get current debat id */
        $em = $this->getDoctrine()->getManager();
        $commentaire = $em->getRepository('MyAppForumBundle:commentaire')->find($id);
        if (!$commentaire) {
            throw $this->createNotFoundException('No  commentaire found for id ' . $id);
        }
        if ($request->isXmlHttpRequest()) {
            $commentaire = $em->getRepository('MyAppForumBundle:commentaire')->find($id);
            $souscommentaire = $em->getRepository('MyAppForumBundle:commentaire')->findBy(array('commentaire' => $id));
            if ($souscommentaire != NULL) {
                foreach ($souscommentaire as $s) {
                    $em->remove($s);
                    $em->flush();
                }
            }
            $em->remove($commentaire);
            $em->flush();
            return $this->container->get('templating')->renderResponse('MyAppForumBundle:sujet:deletecomment.html.twig');
        } else {
            $commentaire = $em->getRepository('MyAppForumBundle:commentaire')->find($id);
            $em->remove($commentaire);
            $em->flush();
            return $this->redirect($this->generateUrl('my_app_forum_sujet_voir', array('id' => $idsujet)));
        }
    }

    public function editAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $co = $em->getRepository('MyAppForumBundle:commentaire')->find($id);
        if (!$co) {
            throw $this->createNotFoundException('no commentaire found for id ' . $id);
        }


        $uri = $this->get('request')->server->get('HTTP_REFERER'); /* get current url */
        $idsujet = filter_var($uri, FILTER_SANITIZE_NUMBER_INT); /* get current debat id */
        $comm = $em->getRepository('MyAppForumBundle:commentaire')->findBy(array('sujet' => $idsujet));

        $form = $this->createFormBuilder($co)->add('texte', 'textarea', array('required' => true))->getForm();
                        
//        $request = $this->getRequest();
//         $form->handleRequest($request);

        $commentaire = array();
        foreach ($comm as $c) {
            if ($c->getCommentaire() == NULL) {
                array_push($commentaire, $c);
            }
        }


        $souscommentaire = array();
        foreach ($comm as $c) {
            if ($c->getCommentaire() != NULL) {
                array_push($souscommentaire, $c);
            }
        }


        /*         * ****** */
        if ($request->isXmlHttpRequest()) {
            $form->bind($request);
            if ($form->isValid()) {
                $em->flush();
                return $this->container->get('templating')->renderResponse('MyAppForumBundle:sujet/Commentaire:affichercommentaireajax.html.twig', array('souscommentaire' => $souscommentaire, 'commentaire' => $commentaire));
            }
        }


        /* if ($request->getMethod() == 'POST') {
          $form->bind($request);

          if ($form->isValid()) {
          $em->flush();
          return $this->redirect($this->generateUrl('my_app_forum_sujet_voir', array('id' => $idsujet)));
          }
          } */
        return $this->render('MyAppForumBundle:commentaire:edit.html.twig', array('form' => $form->createView(), 'id' => $id));
    }

    public function editsouscommentAction($id, Request $request) {

        $em = $this->getDoctrine()->getManager();
        $uri = $this->get('request')->server->get('HTTP_REFERER'); /* get current url */
        $idsujet = filter_var($uri, FILTER_SANITIZE_NUMBER_INT); /* get current debat id */


        $souscommentaireCourant = $em->getRepository('MyAppForumBundle:commentaire')->find($id);
        if (!$souscommentaireCourant) {
            throw $this->createNotFoundException('no souscommentaire found for id ' . $id);
        }
        $form = $this->createFormBuilder($souscommentaireCourant)->add('texte', 'textarea', array('required' => true))->getForm();



        $comm = $em->getRepository('MyAppForumBundle:commentaire')->findBy(array('sujet' => $idsujet));

        $commentaire = array();
        foreach ($comm as $c) {
            if ($c->getCommentaire() == NULL) {
                array_push($commentaire, $c);
            }
        }

        $souscommentaire = array();
        foreach ($comm as $c) {
            if ($c->getCommentaire() != NULL) {
                array_push($souscommentaire, $c);
            }
        }
      //  array_push($souscommentaire, $souscommentaireCourant); /* ajouter subcomment-courant aux autres pour affichage */

        if ($request->isXmlHttpRequest()) {
            $form->bind($request);
            if ($form->isValid()) {
                $em->flush();
                return $this->container->get('templating')->renderResponse('MyAppForumBundle:sujet/Commentaire:affichercommentaireajax.html.twig',
                        array('souscommentaire' => $souscommentaire, 'commentaire' => $commentaire));
            }
        }



        /*if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em->flush();
                return $this->redirect($this->generateUrl('my_app_forum_sujet_voir', array('id' => $idsujet)));
            }
        }*/


        return $this->render('MyAppForumBundle:commentaire:editsouscomment.html.twig', array('id' => $id, 'souscommentaire' => $souscommentaire, 'form' => $form->createView()));
    }

}
