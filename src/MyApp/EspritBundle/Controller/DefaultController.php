<?php

namespace MyApp\EspritBundle\Controller;
use MyApp\EspritBundle\Form\ActeurRechercheForm;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        $em = $this->get('doctrine.orm.entity_manager');
        /*         * ********* **    recuperation de tout les menus  *********** */
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

    public function administrationAction() {
        return $this->render('MyAppEspritBundle:BackOffice:administration.html.twig');
    }

    public function testAction() {
        $request = $this->getRequest();
        echo $request->getLocale();
        die();
        return $this->render('MyAppEspritBundle:Default:test.html.twig');
    }

    public function translationAction() {

        $this->getRequest()->setLocale('en_US');
        $this->getRequest()->setDefaultLocale('en');
        /* $x=$this->getRequest();
          var_dump($x);exit; */

        return $this->render('MyAppEspritBundle:Default:translation.html.twig');
    }

    public function routeAction() {
        $request = $this->container->get('request');
        $routeName = $request->get('_route');
        //   var_dump($routeName);die();
        return $this->render('MyAppEspritBundle:Default:sousmenu.html.twig', array(
                    'routeName' => $routeName
        ));
    }

    public function rechercherAction(Request $request) {
        $request = $this->container->get('request');

        if ($request->isXmlHttpRequest()) {

     
            
            $em = $this->container->get('doctrine')->getEntityManager();

                $menu = $em->getRepository('MyAppEspritBundle:menu')->findAll();
     

            return $this->container->get('templating')->renderResponse('MyAppEspritBundle:Default:liste.html.twig', array(
                        'menu' => $menu
            ));
        } else {
            return $this->listerAction();
        }
    }

    public function listerAction() {
//        $em = $this->container->get('doctrine')->getEntityManager();
//        $menu = $em->getRepository('MyAppEspritBundle:menu')->findAll();

        $form = $this->container->get('form.factory')->create(new ActeurRechercheForm());

        return $this->container->get('templating')->renderResponse('MyAppEspritBundle:Default:lister.html.twig', array(
//                    'menu' => $menu,
                    'form' => $form->createView()
        ));
    }

}
