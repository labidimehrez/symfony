<?php

namespace MyApp\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
        /*         * **************  recuperation de tout les sujets  *********** */
        $sujet = $em->getRepository('MyAppForumBundle:sujet')->getAllsujet();
//var_dump($sujet);die();
        return $this->render('MyAppForumBundle:sujet:manage.html.twig', array(
                    'sujet' => $sujet
        ));
    }

    public function sujetrecentAction() {

        /*         * ******   pagination de tout les sujets  *********** */
        $em1 = $this->get('doctrine.orm.entity_manager');
        $dql = "SELECT a FROM MyAppForumBundle:sujet a";
        $query = $em1->createQuery($dql);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */
        );
        // parameters to template  




        $em = $this->getDoctrine()->getManager();
        /*         * *****  select all sujet from table ** */
        $sujet = $em->getRepository('MyAppForumBundle:sujet')->getAllsujet();

        foreach ($sujet as $s) {
            $ids = $s->getId(); /*             * * recuperer les tag associé dans un array multi dimension * */
            $tag[$ids] = $em->getRepository('MyAppForumBundle:tag')->getBySujet($ids);
        }




        $publicite = $em->getRepository('MyAppEspritBundle:publicite')->getintPub();
        // var_dump($publicite);die();
        $notif = $em->getRepository('MyAppEspritBundle:notification')->findAll();
        $mostusedtag = $em->getRepository('MyAppForumBundle:tag')->getmostusedtag();
        return $this->render('MyAppForumBundle:sujet:sujetrecent.html.twig', array(
                    'sujet' => $sujet, 'publicite' => $publicite, 'tag' => $tag,
                    'mostusedtag' => $mostusedtag, 'pagination' => $pagination,'notif'=>$notif
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
        $sujet = $em->getRepository('MyAppForumBundle:sujet')->find($id);
        if (!$sujet) {
            throw $this->createNotFoundException('No  sujet found for id ' . $id);
        }
        /*         * *** le debat que je lis aura la date_lus updated => new date() ***** */
        $sujet->setDatelus(new \DateTime());
        /*         * **** le nombre de lecture s'incremente de plus un   **** */
        $nblect = $sujet->getNblect();
        $nblect = $nblect + 1;
        $sujet->setNblect($nblect);
        $em->persist($sujet);
        
            //** get the associated notif to remove ***/
        $notif =$em->getRepository('MyAppEspritBundle:notification')->findOneBy(array('idsource' => $id));
      //  var_dump($notif);die();
        $em->remove($notif); 
        $em->flush();

        $mostusedtag = $em->getRepository('MyAppForumBundle:tag')->getmostusedtag();
        $tag = $em->getRepository('MyAppForumBundle:tag')->getBySujet($id);
        $commentassociated = $em->getRepository('MyAppForumBundle:comment')->getCommentBySujet($id);

        return $this->render('MyAppForumBundle:sujet:voir.html.twig', array(
                    'sujet' => $sujet, 'mostusedtag' => $mostusedtag,
                    'tag' => $tag, 'commentaire' => $commentassociated
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
       /*         * ************ simple edit action *************** */
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
                $sujet->setContenu($c);// j a'joute le Contenu recuperé avant a la requete update
                $em->flush();

        return $this->render('MyAppForumBundle:sujet:specialedit.html.twig', array('form' => $form->createView()));
           
        }


}
