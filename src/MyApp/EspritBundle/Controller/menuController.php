<?php

namespace MyApp\EspritBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use MyApp\EspritBundle\Form\menuType;
use MyApp\EspritBundle\Entity\menu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class menuController extends Controller {


    public function showAction() {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $routes = $this->get('router')->getRouteCollection()->all();
        foreach ($routes as $nom => $objet) {
            $mesRoutes[] = $nom;
        }
        $em = $this->getDoctrine()->getManager();
        $menu = new menu();
        $formBuilder = $this->get('form.factory')->createBuilder('form', $menu);
        $formBuilder
                ->add('name')
                ->add('position')
                ->add('lien', 'choice', array(
                   'choices' =>  $mesRoutes  ,                                     
                    'expanded' => false,
                    'multiple' => false
                ));    
        $form = $formBuilder->getForm();
        $request = $this->getRequest();
        if ($request->isMethod('Post')) {
            $form->bind($request);
            if ($form->isValid()) {
                $menu = $form->getData();
                $lien =  $form["lien"]->getData(); 
                $menu->setLien($mesRoutes[$lien]);
                $menu->setUser($user);
 
                $em = $this->getDoctrine()->getManager();
                $em->persist($menu);
                $em->flush();
                return $this->redirect($this->generateUrl('my_app_esprit_menu_show'));
            }
            if (!$form->isValid()) {

                $this->get('session')->getFlashBag()->set('message', 'Ce titre est déja utilisé !!');
            }
        }
        /*         * ***********  recuperation de tout les menus  ******** */
        $menu1 = $em->getRepository('MyAppEspritBundle:menu')->getAllMenu();
      
        return $this->render('MyAppEspritBundle:menu:show.html.twig', array(
                    'menu' => $menu1, 'form' => $form->createView(),
        ));
    }

    public function addAction() {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $routes = $this->get('router')->getRouteCollection()->all();
        foreach ($routes as $nom => $objet) {
            $mesRoutes[] = $nom;
        }
        $em = $this->getDoctrine()->getManager();
        $menu = new menu();
        $formBuilder = $this->get('form.factory')->createBuilder('form', $menu);
        $formBuilder
                ->add('name')
                ->add('position')
                ->add('lien', 'choice', array(
                   'choices' =>  $mesRoutes  ,                                   
                    'expanded' => false,
                    'multiple' => false
                ));      
        $form = $formBuilder->getForm();
        $request = $this->getRequest();
        if ($request->isMethod('Post')) {
            $form->bind($request);
            if ($form->isValid()) {
                $menu = $form->getData();
                $lien =  $form["lien"]->getData(); 
                $menu->setLien($mesRoutes[$lien]);
                $menu->setUser($user);
                $em = $this->getDoctrine()->getManager();
                $em->persist($menu);
                $em->flush();
                return $this->redirect($this->generateUrl('my_app_esprit_menu_show'));
            }
            if (!$form->isValid()) {
                $this->get('session')->getFlashBag()->set('message', 'Ce titre est déja utilisé  !!');
            }
        }
        /*         * ***********  recuperation de tout les menus  ******** */
        $menu1 = $em->getRepository('MyAppEspritBundle:menu')->getAllMenu();
        return $this->render('MyAppEspritBundle:menu:show.html.twig', array(
                    'menu' => $menu1, 'form' => $form->createView(),
        ));
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
}
//        public function listAction() {
//
//
//        /*         * ******   pagination de tout les menus  *********** */
//        $em = $this->get('doctrine.orm.entity_manager');
//        $dql = "SELECT a FROM MyAppEspritBundle:menu a";
//        $query = $em->createQuery($dql);
//
//        $paginator = $this->get('knp_paginator');
//        $pagination = $paginator->paginate(
//                $query, $this->get('request')->query->get('page', 1)/* page number */, 5/* limit per page */
//        );
//        // parameters to template
//        return $this->render('MyAppEspritBundle:menu:list.html.twig', array('pagination' => $pagination));
//    }

//    public function rechercheAction() {
//        $em = $this->getDoctrine()->getManager();
//        $menu = $em->getRepository('MyAppEspritBundle:menu')->findAll();
//        $form = $this->createFormBuilder($menu)
//                ->add('name', 'text')
//                ->add('rechercher', 'submit')
//                ->getForm();
//
//        return $this->render('MyAppEspritBundle:menu:recherche.html.twig', array( 'form' => $form->createView()));
//                   
//    }
//
//    function searchAction(Request $request) {
//
//        $ids = $this->getRequest()->get('mesIds'); // ids contient la valeurinput
//        $valeurinput = implode(",", $ids); // convertir sous forme de string             
//        $em = $this->getDoctrine()->getManager();
//        $menu = $em->getRepository('MyAppEspritBundle:menu')->findAll();
//        $menutrouve = "";
//        foreach ($menu as $menu) {
//            $toutlesnoms = $menu->getName();
//            if ($valeurinput == $toutlesnoms) {
//                $menutrouve = $em->getRepository('MyAppEspritBundle:menu')->findByName($toutlesnoms);
//            }
//        }
//        return $this->render('MyAppEspritBundle:menu:ShowByName.html.twig', array('menu' => $menutrouve));
//    }