<?php

namespace MyApp\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class commentaireController extends Controller
{
     public function showAction()
    {           
        return $this->render('MyAppForumBundle:commentaire:show.html.twig' );                
    }
}
