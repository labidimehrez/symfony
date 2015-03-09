<?php

namespace MyApp\EspritBundle\Controller;
 use Symfony\Component\HttpFoundation\Request;
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
   
    
         public function testnotifAction()
    {
          
        $em = $this->getDoctrine()->getManager();      
        $numberNotif = $em->getRepository('MyAppEspritBundle:notification')->getNumberAllNotif();// get a number of rows
        $array = array();  // declaration tableau vide a utiliser apres
        $array["1"] = $numberNotif; // inserer l entier dans le tableau
   
        return $this->render('MyAppEspritBundle:Default:testnotif.html.twig', array('numberNotif' => $array)); // j 'envoie un tableau a une valeur converti dans twig avec join );
    } 
   
     
    
     public function routeAction(){
        $request = $this->container->get('request');
        $routeName = $request->get('_route');
     //   var_dump($routeName);die();
                return $this->render('MyAppEspritBundle:Default:sousmenu.html.twig', array(
 
                'routeName'=>$routeName
        ));
    }
 
}
