<?php

namespace MyApp\EspritBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class signeController extends Controller {
 
    public function showAction() {
   
         return $this->render('MyAppEspritBundle:signe:show.html.twig');
                 
    }

}
