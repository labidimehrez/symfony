<?php

namespace MyApp\EspritBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function administrationAction()
    {
        return $this->render('MyAppEspritBundle:Default:administration.html.twig');
    }
}
