<?php

namespace MyApp\EspritBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class DefaultController extends Controller
{
    public function indexAction()
    {     
        $em = $this->getDoctrine()->getManager();
         /*********** **    recuperation de tout les menus  *********** */
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
      public function administrationAction()
    {
        return $this->render('MyAppEspritBundle:BackOffice:administration.html.twig');
    }
    

}
