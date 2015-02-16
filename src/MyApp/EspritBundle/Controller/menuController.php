<?php

namespace MyApp\EspritBundle\Controller;

use MyApp\EspritBundle\Form\menuType;
use MyApp\EspritBundle\Entity\menu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class menuController extends Controller {

    public function showAction() {

        /*         * ******* ajout de nouveau menu ****** */
        $em = $this->getDoctrine()->getManager();
        $menu = new menu();
        $form = $this->createForm(new menuType, $menu);
        $request = $this->getRequest();
        if ($request->isMethod('Post')) {
            $form->bind($request);
            if ($form->isValid()) {
                $menu = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($menu);
                $em->flush();
                return $this->redirect($this->generateUrl('my_app_esprit_menu_show'));
            }
            if (!$form->isValid()) {

                $this->get('session')->getFlashBag()->set('message', 'This title is used before !!');
            }
        }
        /*         * ***********  recuperation de tout les menus  ******** */
        $menu1 = $em->getRepository('MyAppEspritBundle:menu')->getAllMenu();

        return $this->render('MyAppEspritBundle:menu:show.html.twig', array(
                    'menu' => $menu1, 'form' => $form->createView(),
        ));
    }

    public function addAction() {
        /*         * *************     ajout de nouveau menu   ******** */
        $menu = new menu();
        $form = $this->createForm(new menuType(), $menu);
        $request = $this->getRequest();
        if ($request->isMethod('Post')) {

            $form->bind($request);
            /*             * *********  validation form ********************* */
            if ($form->isValid()) {
                $publicite = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($publicite);
                $em->flush();

                return $this->redirect($this->generateUrl('my_app_esprit_menu_show'));
            }
            if (!$form->isValid()) {

                $this->get('session')->getFlashBag()->set('message', 'This position is occuped !!');
            }
        }
        return $this->render('MyAppEspritBundle:menu:show.html.twig', array('form' => $form->createView()));
    }

    public function deleteAction($id) {
        /*         * **** delete d'une menu si il existe deja *** */
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository('MyAppEspritBundle:menu')->find($id);
        if (!$menu) {
            throw $this->createNotFoundException('No menu found for id ' . $id);
        }
        $em->remove($menu);
        $em->flush();

        return $this->redirect($this->generateUrl('my_app_esprit_menu_show'));
    }

    public function editAction($id) {
        /*         * ** simple edit action *** */
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository('MyAppEspritBundle:menu')->find($id);

        $form = $this->createForm(new menuType(), $menu);
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            /*             * *********  validation form ********************* */
            if ($form->isValid()) {
                $em->flush();
                return $this->redirect($this->generateUrl('my_app_esprit_menu_show'));
            }
            if (!$form->isValid()) {

                $this->get('session')->getFlashBag()->set('message', 'This position is occuped !!');
            }
        }
        /*         * ********* **    recuperation de tout les menus  *********** */
        $menu2 = $em->getRepository('MyAppEspritBundle:menu')->findAll();
        return $this->render('MyAppEspritBundle:menu:edit.html.twig', array(
                    'form' => $form->createView(),
                    'menu' => $menu, 'menu2' => $menu2
        ));
    }

    public function listAction() {
        /********   pagination de tout les menus  *********** */   
        $em = $this->get('doctrine.orm.entity_manager');
        $dql = "SELECT a FROM MyAppEspritBundle:menu a";
        $query = $em->createQuery($dql);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $this->get('request')->query->get('page', 1)/* page number */, 5/* limit per page */
        );
        // parameters to template
        return $this->render('MyAppEspritBundle:menu:list.html.twig', array('pagination' => $pagination));
    }

}
