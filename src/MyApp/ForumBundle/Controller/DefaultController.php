<?php

namespace MyApp\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    public function testAction()
    {           
        return $this->render('MyAppForumBundle:commentaire:test.html.twig' );                
    }
 
}
