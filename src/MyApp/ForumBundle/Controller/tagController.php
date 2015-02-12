<?php

namespace MyApp\ForumBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\ForumBundle\Form\TagType;
use MyApp\ForumBundle\Entity\tag;

class TagController extends Controller {

    public function showAction() {

             /********* ajout de nouveau tag *******/
        $em = $this->getDoctrine()->getManager();
        $tag = new tag();
        $form = $this->createForm(new TagType, $tag);
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
                 /*************  recuperation de tout les tags  *********/
        $tag1 = $em->getRepository('MyAppForumBundle:tag')->getAlltag();

        return $this->render('MyAppForumBundle:tag:show.html.twig', array(
                    'tag' => $tag1, 'form' => $form->createView(),
        ));
    }

    public function mostusedAction() {
        /********  les tag de la table association ********/
        $em = $this->getDoctrine()->getManager();
        $tag = $em->getRepository('MyAppForumBundle:tag')->getmostusedtag();
        // var_dump($tag);die();
        return $this->render('MyAppForumBundle:tag:mostused.html.twig', array(
                    'tag' => $tag
        ));
    }

    public function deleteAction($id) {
        /************  simple delete action  ***********/
        $em = $this->getDoctrine()->getManager();
        $tag = $em->getRepository('MyAppForumBundle:tag')->find($id);

        if (!$tag) {
            throw $this->createNotFoundException('no  tag found for id ' . $id);
        }

        $em->remove($tag);
        $em->flush();

        return $this->redirect($this->generateUrl('my_app_forum_tag_show'));
    }

    public function editAction($id) {
            /**** simple edit action ****/
        $em = $this->getDoctrine()->getManager();
        $tag = $em->getRepository('MyAppForumBundle:tag')->find($id);

        $form = $this->createForm(new tagType(), $tag);
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em->flush();
                return $this->redirect($this->generateUrl('my_app_forum_tag_show'));
            }

        }
            /*********** **    recuperation de tout les tags  *********** */
            $tag2 = $em->getRepository('MyAppForumBundle:tag')->findAll();
            return $this->render('MyAppForumBundle:tag:edit.html.twig', array(
                        'form' => $form->createView(),
                        'tag' => $tag, 'tag2' => $tag2
            ));
    }

        

         public function addAction() {
            /*******         simple add action  ********* */
            $em = $this->getDoctrine()->getManager();
            $tag = new tag();
            $form = $this->createForm(new TagType, $tag);
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
    