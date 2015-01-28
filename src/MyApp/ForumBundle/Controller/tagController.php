<?php

namespace MyApp\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TagController extends Controller {

    public function addAction() {

        $tag = new \MyApp\ForumBundle\Entity\tag();
        $form = $this->createForm(new \MyApp\ForumBundle\Form\TagType, $tag);
        $request = $this->getRequest();
        if ($request->isMethod('Post')) {

            $form->bind($request);

            if ($form->isValid()) {
                $tag = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($tag);
                $em->flush();



                return $this->redirect($this->generateUrl('my_app_forum_tag_add'));
            }
        }

        return $this->render('MyAppForumBundle:tag:add.html.twig', array('form' => $form->createView()));
    }

}
