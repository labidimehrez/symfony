<?php

namespace MyApp\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
      public function indexAction()
    {
        return $this->render('MyAppEspritBundle::layout.html.twig');
    }
    
    
}
