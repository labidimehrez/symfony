<?php

namespace MyApp\EspritBundle\Controller;

use MyApp\EspritBundle\Form\ActeurRechercheForm;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\EspritBundle\Form\menuType;
use MyApp\EspritBundle\Entity\menu;

class DefaultController extends Controller {

    public function indexAction() {
        $em = $this->get('doctrine.orm.entity_manager');
        /*         * ********* **    recuperation de tout les menus  *********** */
        $menu = $em->getRepository('MyAppEspritBundle:menu')->getAllMenu();


        return $this->render('MyAppEspritBundle::layout.html.twig', array(
                    'menu' => $menu
        ));
    }

    # KnpMenuBundle
//    public function indexAction() {
//        
//        $menu = $this->get("myapp_main.menu.main");
//        $menu->getChild("Home")->setCurrent(true);
//        return $this->render('MyAppEspritBundle::layout.html.twig');
//                  
//}

    public function administrationAction() {
        return $this->render('MyAppEspritBundle:BackOffice:administration.html.twig');
    }

    public function testAction() {
        $request = $this->getRequest();
        echo $request->getLocale();
        die();
        return $this->render('MyAppEspritBundle:Default:test.html.twig');
    }

    public function translationAction() {

        $this->getRequest()->setLocale('en_US');
        $this->getRequest()->setDefaultLocale('en');
        /* $x=$this->getRequest();
          var_dump($x);exit; */

        return $this->render('MyAppEspritBundle:Default:translation.html.twig');
    }

    public function routeAction() {
        $request = $this->container->get('request');
        $routeName = $request->get('_route');
        //   var_dump($routeName);die();
        return $this->render('MyAppEspritBundle:Default:sousmenu.html.twig', array(
                    'routeName' => $routeName
        ));
    }

    public function listerAction() {
        $menu = new Menu();
        $form = $this->createForm(new MenuType, $menu);
        $request = $this->getRequest();
//        if ($request->isMethod('Post')) {

        $form->bind($request);

        if ($form->isValid()) {
            $menu = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($menu);
            $em->flush();
            if ($request->isXmlHttpRequest()) {
                $em = $this->container->get('doctrine')->getEntityManager();
                $menu = $em->getRepository('MyAppEspritBundle:menu')->findAll();
                return $this->container->get('templating')->renderResponse('MyAppEspritBundle:Default:liste.html.twig', array(
                            'menu' => $menu
                ));
            } else {
                return $this->listerAction();
            }
//                return $this->redirect($this->generateUrl('my_app_esprit_menu_show'));
        }
//        }
//        if ($request->isXmlHttpRequest()) {
//            $em = $this->container->get('doctrine')->getEntityManager();
//            $menu = $em->getRepository('MyAppEspritBundle:menu')->findAll();
//            return $this->container->get('templating')->renderResponse('MyAppEspritBundle:Default:liste.html.twig', array(
//                        'menu' => $menu
//            ));
//        }
        else {
            return $this->container->get('templating')->renderResponse('MyAppEspritBundle:Default:lister.html.twig', array('form' => $form->createView()
            ));
        }
    }

    public function newFormAjaxAction() {
        $request = $this->getRequest();
        $newform = $this->get('form.factory')->create(new menuType(), new Menu());

        $x = "a";
        if ($request->isXmlHttpRequest()) {
            $newform->handleRequest($request);
            if ($newform->isValid()) {
                $menu = $newform->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($menu);
                $em->flush();
                $x = $em->getRepository('MyAppEspritBundle:menu')->findAll();
              return $this->container->get('templating')->renderResponse('MyAppEspritBundle:Default:liste.html.twig', array(
                            'menu' => $x
                ));
 
             } else {
                return $this->render('MyAppEspritBundle:Default:ajaxbouton.html.twig', array('form' => $newform->createView(), 'menu' => $x));
            }
 
        }

        else {
          return $this->render('MyAppEspritBundle:Default:ajaxbouton.html.twig', array('form' => $newform->createView()));
          } 
   
    }

}
