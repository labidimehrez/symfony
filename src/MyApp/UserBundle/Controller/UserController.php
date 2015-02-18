<?php

namespace MyApp\UserBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
 
use MyApp\UserBundle\Form\userType;
use MyApp\UserBundle\Entity\user;

class UserController extends Controller {

    public function showAction() {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('MyAppUserBundle:user')
                ->findBy(array(), array('id' => 'asc'), 100, 0);
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
                    'no utilisateur found for id ' . $id
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

    public function updateuserAction() {

        $em = $this->getDoctrine()->getManager();


        $sujet = $em->getRepository('MyAppForumBundle:sujet')->findAll();
        $form = $this->createFormBuilder($sujet)
                ->add('sujet')
                ->getForm();
        return $this->render('MyAppUserBundle:user:updateuser.html.twig', array(
                    'form' => $form->createView(), 'sujet' => $sujet));
    }

    public function updateuser2Action(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('MyAppUserBundle:user')->find(1);

        $ids = $this->getRequest()->get('mesIds');
        $array_values = array_values($ids);
        $rol = $array_values[0];
        $rolenstring = '' . $rol;
        // var_dump($rolenstring); die();
        $Superadmin = "Superadmin";
        $Admin = "Admin";
        $Supersol = "Supersol";
        $Editor = "Editor";
        $User = "User";




        if (strcmp($rolenstring, $User) == 0) {
            //   echo "User";  
            $user->setRoles(array('ROLE_USER' => 'User'));
            $em->persist($user);
            $em->flush();
        }
        if (strcmp($rolenstring, $Editor) == 0) {
            //echo "Editor";
            $user->setRoles(array('ROLE_EDITOR' => 'Editor'));
            $em->persist($user);
            $em->flush();
        }
        if (strcmp($rolenstring, $Supersol) == 0) {
            //echo "Supersol";
            $user->setRoles(array('ROLE_SUPERSOL' => 'Supersol'));
            $em->persist($user);
            $em->flush();
        }
        if (strcmp($rolenstring, $Admin) == 0) {
            // echo "Admin";
            $user->setRoles(array('ROLE_ADMIN' => 'Admin'));
            $em->persist($user);
            $em->flush();
        }
        if (strcmp($rolenstring, $Superadmin) == 0) {
            // echo "Superadmin";
            $user->setRoles(array('ROLE_SUPER_ADMIN' => 'Superadmin'));
            $em->persist($user);
            $em->flush();
        }
        return $this->render('MyAppUserBundle:user:updateuser2.html.twig', array('ids' => $ids));
    }

}
