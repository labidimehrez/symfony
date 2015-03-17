<?php

namespace MyApp\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MyApp\ForumBundle\Form\commentaireType;
use MyApp\ForumBundle\Entity\commentaire;
use MyApp\EspritBundle\Entity\notification;

class commentaireController extends Controller {

    public function addAction() {

        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository('MyAppForumBundle:sujet')->find(7);
        /*         * ** je recuperer l id de user connecté * */
        $user = $this->container->get('security.context')->getToken()->getUser();
        $user->getId();
        /*         * ** je recuperer l id de user connecté * */
        $commentaire = new commentaire();

        $form = $this->createForm(new commentaireType, $commentaire);
        $request = $this->getRequest();
        if ($request->isMethod('Post')) {

            $form->bind($request);

            if ($form->isValid()) {

                $commentaire = $form->getData();
                /*                 * ** je recuperer l id de user connecté * */
                $commentaire->setUser($user);
                /*                 * ** je recuperer l id de user connecté * */
                $commentaire->setSujet($sujet);
            
            
               
                $em->persist($commentaire);
                $em->flush();


                return $this->redirect($this->generateUrl('my_app_forum_commentaire_add'));
            }
            if (!$form->isValid()) {
                $this->get('session')->getFlashBag()->set('message', ' ( Des Champs invalides ou existe deja !! )');

                return $this->render('MyAppForumBundle:commentaire:add.html.twig', array(
                            'form' => $form->createView()));
            }
        }






        return $this->render('MyAppForumBundle:commentaire:add.html.twig', array(
                    'form' => $form->createView()
        ));
    }

}
