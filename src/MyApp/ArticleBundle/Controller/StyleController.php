<?php

namespace MyApp\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\ArticleBundle\Form\StyleType;
use MyApp\ArticleBundle\Entity\style;

class StyleController extends Controller {

    public function addAction() {

        $style = new style();
        $form = $this->createForm(new StyleType, $style);
        $request = $this->getRequest();
        if ($request->isMethod('Post')) {

            $form->bind($request);

            if ($form->isValid()) {
                $style = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($style);
                $em->flush();
                
                return $this->redirect($this->generateUrl('my_app_article_style_add'));
            }
        }

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
