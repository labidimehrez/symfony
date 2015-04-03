<?php

namespace MyApp\EspritBundle\Controller;

 
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

    public function routeAction() {
        $request = $this->container->get('request');
        $routeName = $request->get('_route');
        //   var_dump($routeName);die();
        return $this->render('MyAppEspritBundle:Default:sousmenu.html.twig', array(
                    'routeName' => $routeName
        ));
    }

   

}
