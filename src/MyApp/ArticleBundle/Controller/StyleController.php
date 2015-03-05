<?php

namespace MyApp\ArticleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\ArticleBundle\Entity\style;

class StyleController extends Controller {

    public function addAction() {

        $em = $this->getDoctrine()->getManager();
        $style = $em->getRepository('MyAppArticleBundle:style')->findAll();
        $form = $this->createFormBuilder($style)
                ->add('name', 'text')
                ->add('rechercher', 'submit')
                ->getForm();

        return $this->render('MyAppArticleBundle:style:add.html.twig', array('form' => $form->createView()));
    }

    public function saveAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $style2 = $em->getRepository('MyAppArticleBundle:style')->findAll();
        /*** form a afficher dans la vue **/
        $form = $this->createFormBuilder($style2)
                ->add('name', 'text')
                ->add('rechercher', 'submit')
                ->getForm();
         /*** recuperation des valeurs **/
        $ColorForFont = $this->getRequest()->get('color1');
        $BackgroundColor = $this->getRequest()->get('color2');
        $name = $this->getRequest()->get('name');
        $title = $this->getRequest()->get('title');
        /* var_dump($ColorForFont);var_dump($BackgroundColor);var_dump($name);var_dump($title);die(); */
          
        /*** test de validation title must be not blank **/
        /*  if ($title == null) {
            return $this->render('MyAppArticleBundle:style:add.html.twig', array('form' => $form->createView()));
        }*/
        /** ajout de style validé avec les input de la request ***/
        $style = new style();
        $style->setCodecouleurback($BackgroundColor);
        $style->setCodecouleurfront($ColorForFont);
        $style->setName($name);
        $style->setTitle($title);

        $em1 = $this->getDoctrine()->getManager();
        $em1->persist($style);
        $em1->flush();
 
        return $this->render('MyAppArticleBundle:style:add.html.twig', array('form' => $form->createView()));
    }

    public function showAction() {
        $em = $this->getDoctrine()->getManager();
        /*         * *******************    recuperation de tout les styles    ************ */
        $style = $em->getRepository('MyAppArticleBundle:style')->getAllStyle();
        //var_dump($style);die();
        return $this->render('MyAppArticleBundle:style:show.html.twig', array(
                    'style' => $style
        ));
    }

    public function deleteAction(style $style) {
        $em = $this->getDoctrine()->getManager();
        $selectstyle = $em->getRepository('MyAppArticleBundle:style')->find($style->getId());

        $em->remove($style);
        $em->flush();
        $this->get('session')->getFlashBag()->set('message', 'Ce style disparait !!');
        return $this->redirect($this->generateUrl('my_app_article_style_show', array(
                            'selectstyle' => $selectstyle
        )));
    }

}
