<?php

namespace MyApp\ArticleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\ArticleBundle\Entity\style;

class StyleController extends Controller {

 /*   public function addAction() {

        $em = $this->getDoctrine()->getManager();
        $style = $em->getRepository('MyAppArticleBundle:style')->findAll();
        $form = $this->createFormBuilder($style)
                ->add('name', 'text')
                ->add('rechercher', 'submit')
                ->getForm();

        return $this->render('MyAppArticleBundle:style:add.html.twig', array('form' => $form->createView()));
    }
*/
    public function addAction(Request $request) {
         $em = $this->getDoctrine()->getManager();
        $manager = $this->get('collectify_style_manager');/** equivalent de em manager * */
        $style2 = $manager->getAll();
//        var_dump($style2);exit;
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
        

        /*         * * test de validation title must be not blank * */
          if(($ColorForFont == null)||($BackgroundColor == null) ||($title == null)){
//            $this->get('session')->getFlashBag()->set('messagestylefail', 'Style non ajouté ,  certains champs sont invalides  ');     
          return $this->render('MyAppArticleBundle:style:add.html.twig', array('form' => $form->createView()));
          }  
        /** ajout de style validé avec les input de la request ** */
        $style = new style();
        $style->setCodecouleurback($BackgroundColor);
        $style->setCodecouleurfront($ColorForFont);
        $style->setName($name);
        $style->setTitle($title);
 
         $exist= FALSE; 
        foreach ($style2 as $s) {
            if(  $s->getTitle()==$style->getTitle() ){
            $exist= TRUE;  /* c 'est vrai ca existe !! donc pas de persist */
           $this->get('session')->getFlashBag()->set('messagestylefailtitre', 'Style non ajouté ,changez de titre svp  '); 
         
            }
        }
        
        $manager->persist($style,$exist); /* si existe est vrai donc pas de persist dans manager */
        
        
        $this->get('session')->getFlashBag()->set('messagestylesuccess', 'Style ajouté avec Succés  '); 

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
        $style = $em->getRepository('MyAppArticleBundle:style')->findAll();

        $form = $this->createFormBuilder($style)->add('style')->getForm();


        return $this->render('MyAppArticleBundle:style:manage.html.twig', array(
                    'form' => $form->createView(), 'style' => $style));
    }

    public function manageAction() {
        $em = $this->getDoctrine()->getManager();
        /*         * *******************    recuperation de tout les style s    ************ */
        $style = $em->getRepository('MyAppArticleBundle:style')->findAll();

        $form = $this->createFormBuilder($style)->add('style')->getForm();


        return $this->render('MyAppArticleBundle:style:manage.html.twig', array(
                    'form' => $form->createView(), 'style' => $style));
    }

    public function deletemoreAction(Request $request) {
        $ids = $this->getRequest()->get('mesIds');
        $em = $this->getDoctrine()->getManager();
        $styled = $em->getRepository('MyAppArticleBundle:style')->findBy(array('id' => $ids));
        $manager = $this->get('collectify_style_manager');/** equivalent de em manager * */
        $manager->removemore($styled);
        $style = $em->getRepository('MyAppArticleBundle:style')->findAll();
        $form = $this->createFormBuilder($style)->add('style')->getForm();
        return $this->render('MyAppArticleBundle:style:manage.html.twig', array(
                    'form' => $form->createView(), 'style' => $style
        ));
    }

}
