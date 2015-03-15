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
        $manager = $this->get('collectify_style_manager');/** equivalent de em manager * */
        $style2 = $manager->getAll();
        /*         * * form a afficher dans la vue * */
        $form = $this->createFormBuilder($style2)
                ->add('name', 'text')
                ->add('rechercher', 'submit')
                ->getForm();
        /*         * * recuperation des valeurs * */
        $ColorForFont = $this->getRequest()->get('color1');
        $BackgroundColor = $this->getRequest()->get('color2');
        $name = $this->getRequest()->get('name');
        $title = $this->getRequest()->get('title');
        /* var_dump($ColorForFont);var_dump($BackgroundColor);var_dump($name);var_dump($title);die(); */

        /*         * * test de validation title must be not blank * */
        /*  if ($title == null) {
          return $this->render('MyAppArticleBundle:style:add.html.twig', array('form' => $form->createView()));
          } */
        /** ajout de style validé avec les input de la request ** */
        $style = new style();
        $style->setCodecouleurback($BackgroundColor);
        $style->setCodecouleurfront($ColorForFont);
        $style->setName($name);
        $style->setTitle($title);

        $manager->persist($style);


        return $this->render('MyAppArticleBundle:style:add.html.twig', array('form' => $form->createView()));
    }

    public function showAction() {

        $manager = $this->get('collectify_style_manager');/** equivalent de em manager * */
        $style = $manager->getAll();

        return $this->render('MyAppArticleBundle:style:show.html.twig', array(
                    'style' => $style
        ));
    }

    public function deleteAction(style $style) {
        $em = $this->getDoctrine()->getManager();
        $selectstyle = $em->getRepository('MyAppArticleBundle:style')->find($style->getId());
        //      $manager = $this->get('collectify_style_manager');/** equivalent de em manager **/
        //      $manager->remove($style);    

        $em->remove($style);
        $em->flush();
        $this->get('session')->getFlashBag()->set('message', 'Ce style disparait !!');
        return $this->redirect($this->generateUrl('my_app_article_style_show', array(
                            'selectstyle' => $selectstyle
        )));
    }

        public function manageAction() {
               $em = $this->getDoctrine()->getManager();
        /*         * *******************    recuperation de tout les style s    ************ */
        $style = $em->getRepository('MyAppArticleBundle:style')->findAll();
          
        return $this->render('MyAppArticleBundle:style:manage.html.twig', array(
                    'style' => $style 
        )); 
    }

}
