<?php

namespace MyApp\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MyApp\ForumBundle\Form\sujetType;
use MyApp\ForumBundle\Entity\sujet;
use MyApp\EspritBundle\Entity\notification;

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
                $notifboolean = $sujet->getNotification();
                $sujet->setThread(4);      /* default thread */
                $em = $this->getDoctrine()->getManager();
                $em->persist($sujet);
                $em->flush();
                /*                 * **                       ajout de notification                        ** */
                $manager = $this->get('collectify_notification_manager');/** equivalent de em manager * */
                $notif = new notification();
                $notif1 = $manager->addNotif($user, $sujet, $notif, $notifboolean);
                $manager->persist($notif1);

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

        $manager = $this->get('collectify_sujet_manager');/** equivalent de em manager * */
        $sujet = $manager->getAll();
        return $this->render('MyAppForumBundle:sujet:show.html.twig', array(
                    'sujet' => $sujet
        ));
    }

    public function manageAction() {

        $em = $this->getDoctrine()->getManager();
        /*         * **************  recuperation de tout les sujets  *********** */
        $sujet = $em->getRepository('MyAppForumBundle:sujet')->getAllsujet();
        //var_dump($sujet);die();
        $form = $this->createFormBuilder($sujet)->add('sujet')->getForm();
        return $this->render('MyAppForumBundle:sujet:manage.html.twig', array(
                    'sujet' => $sujet, 'form' => $form->createView()
        ));
    }

    public function sujetrecentAction() {

        /*         * ******   pagination de tout les sujets  *********** */
        $em1 = $this->get('doctrine.orm.entity_manager');
        $dql = "SELECT a FROM MyAppForumBundle:sujet a ORDER BY a.datecreation DESC ";
        $query = $em1->createQuery($dql);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */
        );
        // parameters to template  




        $em = $this->getDoctrine()->getManager();
        /*         * *****  select all sujet from table ** */
        $sujet = $em->getRepository('MyAppForumBundle:sujet')->getAllsujet();
        if ($sujet != NULL) {
            foreach ($sujet as $s) {
                $ids = $s->getId(); /*                 * *    * recuperer les tag associé dans un array multi dimension * */
                $tag[$ids] = $em->getRepository('MyAppForumBundle:tag')->getBySujet($ids);
            }
        } else {
            $tag[0] = 0;
        } /* pour mettre quelque chose dans array tag * */


        $publicite = $em->getRepository('MyAppEspritBundle:publicite')->getintPub();

        $notif = $em->getRepository('MyAppEspritBundle:notification')->findAll();
        $mostusedtag = $em->getRepository('MyAppForumBundle:tag')->getmostusedtag();
        return $this->render('MyAppForumBundle:sujet:sujetrecent.html.twig', array(
                    'sujet' => $sujet, 'publicite' => $publicite, 'tag' => $tag,
                    'mostusedtag' => $mostusedtag, 'pagination' => $pagination, 'notif' => $notif
        ));
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

    public function voirAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $managersujet = $this->get('collectify_sujet_manager');/** equivalent de em manager * */
        $sujet = $managersujet->getOne($id);
        $form = $this->createForm(new sujetType(), $sujet);

        $managertag = $this->get('collectify_tag_manager');


        $inputtext = $this->getRequest()->get('i'); /* valeur array de String dans l input texte */
        /* text input de type string *///$inputtext[0]; 
        $alltags = $managertag->getAll(); /* array de tous les objets tags  */
        foreach ($alltags as $tag) {
            $tagtitle = $tag->getTitle(); /* get title of objects :D */
            if (strpos($inputtext[0], $tagtitle) !== false) {
                $selectedtag = $managertag->getByTitle($tagtitle);/* get objet tag by title */
                echo "inclu";
               
            }
        }
        die();

        /* $title="Politique";
          $selectedtag = $managertag->getByTitle($title); */


        if (!$sujet) {
            throw $this->createNotFoundException('no  sujet found for id ' . $id);
        }

        $managersujet->IncrementandSetNewDateLus($sujet); /* increment NBlect sujet et update DateLus */
        $em = $this->getDoctrine()->getManager();
        $notif = $em->getRepository('MyAppEspritBundle:notification')->findOneBy(array('sujet' => $id)); //** get the associated notif to remove ***/

        $managernotif = $this->get('collectify_notification_manager');/** equivalent de em manager * */
        $managernotif->remove($notif);

        $mostusedtag = $em->getRepository('MyAppForumBundle:tag')->getmostusedtag();
        $tag = $em->getRepository('MyAppForumBundle:tag')->getBySujet($id);
        $commentassociated = $em->getRepository('MyAppForumBundle:commentaire')->getCommentaireBySujet($id);

        $Subcommentassociated = $em->getRepository('MyAppForumBundle:commentaire')->getSubCommentaireBySujet($id);

        $commentCount = $em->getRepository('MyAppForumBundle:sujet')->getCommentCountBySujet($id);
        //var_dump($commentCount);die();
        return $this->render('MyAppForumBundle:sujet:voir.html.twig', array(
                    'sujet' => $sujet, 'mostusedtag' => $mostusedtag,
                    'tag' => $tag, 'commentaire' => $commentassociated, 'souscommentaire' => $Subcommentassociated,
                    'commentCount' => $commentCount, 'form' => $form->createView()
        ));
    }

    public function mostreadsujetAction() {
        /*         * * ***********    recuperer les sujets les plus lus dans les 12h passés *************** */
        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository('MyAppForumBundle:sujet')->getmostreadsujet();
        $now = new \Datetime();
        $mostreadsujet = 0;
        foreach ($sujet as $sujet) {
            $datelusdesujet = $sujet->getDatelus();
            $interval = $datelusdesujet->diff($now);
            $seconds = $interval->days * 86400 + $interval->h * 3600 + $interval->i * 60 + $interval->s;
                    /// 12h = 43200 s
            if ($seconds < 43200) {
                $mostreadsujet = $sujet;
            }
                    // var_dump($mostreadsujet);die();
        }
        return $this->render('MyAppForumBundle:sujet:mostreadsujet.html.twig');
    }

    public function specialeditAction($id) {

        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository('MyAppForumBundle:sujet')->find($id);

        $s = $sujet->getSujet(); // get the current sujet pour le renvooyer aprés :)
        $c = $sujet->getContenu(); // get the current Contenu pour le renvooyer aprés :)


        if (!$sujet) {
            throw $this->createNotFoundException('No  sujet found for id ' . $id);
        }
        $form = $this->createForm(new sujetType(), $sujet);
        $request = $this->getRequest();
        $form->bind($request);
        $sujet = $form->getData(); // les données de la form 

        $sujet->setSujet($s);  // j a'joute le sujet recuperé avant a la requete update
        $sujet->setContenu($c); // j a'joute le Contenu recuperé avant a la requete update
        $em->flush();
        return $this->render('MyAppForumBundle:sujet:specialedit.html.twig', array('form' => $form->createView()));
    }

    public function changethreadAction(Request $request) {

        $manager = $this->get('collectify_sujet_manager');
        $sujet = $manager->getAll();/** liste debats a partir de la bd ordrer by datecreation DESC * */
        $sujetarray = $sujet;  /* nouveau tableau pour traiter les debats */
        $sujetid = $this->getRequest()->get('i');/** array des val thread * */
        for ($index = 0; $index < count($sujetid); $index++) {

            if ($sujetarray[$index]->getThread() != $sujetid[$index]) {
                $sujetarray[$index]->setThread($sujetid[$index]);
                $manager->persist($sujetarray[$index]);
            }
        }
        $form = $this->createFormBuilder($sujet)->add('sujet')->getForm();
        return $this->render('MyAppForumBundle:sujet:manage.html.twig', array(
                    'sujet' => $sujet, 'form' => $form->createView()
        ));
    }

}
