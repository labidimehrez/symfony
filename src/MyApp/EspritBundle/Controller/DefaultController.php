<?php

namespace MyApp\EspritBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
       var_dump($x);exit;*/

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

 

}
