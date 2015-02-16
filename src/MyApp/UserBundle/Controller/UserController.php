<?php

namespace MyApp\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\UserBundle\Form\userType;
use MyApp\UserBundle\Entity\user;
class UserController extends Controller {

    public function showAction() {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('MyAppUserBundle:user') 
                ->findBy(array(), array('id' => 'asc'),100, 0);   
        return $this->render('MyAppUserBundle:User:show.html.twig', array(
                    'user' => $user
        ));
    }

    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('MyAppUserBundle:user')->find($id);

        if (!$user) {
            throw $this->createNotFoundException('No user found for id ' . $id);
        }
        $em->remove($user);
        $em->flush();
        $this->get('session')->getFlashBag()->set('message', 'Ce user disparait !!');
        return $this->redirect($this->generateUrl('my_app_user_show'));
    }

    public function editAction($id) {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('MyAppUserBundle:user')->find($id);
        if (!$user) {
            throw $this->createNotFoundException(
                    'no Utilisateur found for id ' . $id
            );
        }
              $form = $this->createForm(new userType(), $user);
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
        if ($form->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('my_app_user_show'));
        }
  }
        return $this->render('MyAppUserBundle:user:edit.html.twig', array(
                    'form' => $form->createView(),
                    'user' => $user,
        ));
  

}
}