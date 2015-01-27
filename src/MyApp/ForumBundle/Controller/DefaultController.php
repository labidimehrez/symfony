<?php

namespace MyApp\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($id)
    {
        return $this->render('MyAppForumBundle:Default:index.html.twig');
    }
}
