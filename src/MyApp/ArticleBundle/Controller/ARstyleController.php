<?php

namespace MyApp\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ARstyleController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MyAppArticleBundle:Default:index.html.twig', array('name' => $name));
    }
}
