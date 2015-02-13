<?php

namespace MyApp\EspritBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyAppEspritBundle::layout.html.twig');
    }
    
    
      public function administrationAction()
    {
        return $this->render('MyAppEspritBundle:BackOffice:administration.html.twig');
    }
}
