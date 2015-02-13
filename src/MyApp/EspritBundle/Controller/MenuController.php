<?php

namespace MyApp\EspritBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class menuController extends Controller
{
        public function showAction() {

        $em = $this->getDoctrine()->getManager();
        /******** * ****  tous les menus de la base *************************** */
        $menu = $em->getRepository('MyAppEspritBundle:menu')->getAllMenu();     
       // var_dump($menu);die();
        return $this->render('MyAppEspritBundle:menu:show.html.twig', array(
                    'menu' => $menu,
        ));
    }
}
