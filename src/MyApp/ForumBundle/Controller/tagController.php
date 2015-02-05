<?php

namespace MyApp\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TagController extends Controller {

    public function addAction() {


        $em = $this->getDoctrine()->getManager();

        /*         * ******************************************************************* */
        $tag = $em->getRepository('MyAppForumBundle:tag')->findAll();
        if (!$tag) {


            $tag1 = new \MyApp\ForumBundle\Entity\tag();
            $tag1->setTitle("tag1");
            $tag2 = new \MyApp\ForumBundle\Entity\tag();
            $tag2->setTitle("tag2");

            $em1 = $this->getDoctrine()->getManager();


            $em1->persist($tag1);
            $em1->persist($tag2);



            $em1->flush();
        }

        /*         * ******************************************************************* */


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



                return $this->redirect($this->generateUrl('my_app_forum_tag_show'));
            }
        }

        return $this->render('MyAppForumBundle:tag:show.html.twig', array('form' => $form->createView()));
    }

    public function showAction() {
        
        
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

                 return $this->redirect($this->generateUrl('my_app_forum_tag_show'));
            }
        }
        /*************************************/
        $em = $this->getDoctrine()->getManager();
        $tag2 = $em->getRepository('MyAppForumBundle:tag')
                ->findAll();

        return $this->render('MyAppForumBundle:tag:show.html.twig', array(
                    'tag' => $tag2,'form' => $form->createView()
        ));
    }

    public function mostusedAction() {

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('
                        
         SELECT t , s  FROM MyAppForumBundle:Tag t JOIN t.sujets s
      
                ');

        $tag = $query->getResult();
        return $this->render('MyAppForumBundle:tag:mostused.html.twig', array(
                    'tag' => $tag
        ));
    }

    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $tag = $em->getRepository('MyAppForumBundle:tag')->find($id);

        if (!$tag) {
            throw $this->createNotFoundException('No  tag found for id ' . $id);
        }

        $em->remove($tag);
        $em->flush();

        return $this->redirect($this->generateUrl('my_app_forum_tag_show'));
    }

    public function editAction($id) {

        $em = $this->getDoctrine()->getManager();
        $tag = $em->getRepository('MyAppForumBundle:tag')->find($id);
        if (!$tag) {
            throw $this->createNotFoundException(
                    'No tag found for id ' . $id
            );
        }

        $form = $this->createFormBuilder($tag)
                #->add('position', 'text')
                ->add('title', 'text')
                ->getForm();

        $form->handleRequest();

        if ($form->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('my_app_forum_tag_show'));
        }

        return $this->render('MyAppForumBundle:tag:manage.html.twig', array('form' => $form->createView()));
    }

}
