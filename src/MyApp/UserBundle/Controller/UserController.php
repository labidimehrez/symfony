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

    public function deleteAction(user $user) {
        $em = $this->getDoctrine()->getManager();
        $selectuser = $em->getRepository('MyAppForumBundle:sujet')->findBySujet($user->getId());
        /**   je selectionne les sujets associé au user deja choisi  * */
//        $ids = $user->getId();
//        $sujet = $em->getRepository('MyAppForumBundle:sujet')->getSujetByUser($ids);
//        
//        foreach ($sujet as $s) /** update pour plusieurs sujets * */
//        /*         * *   les sujets reuperé auront un nouveau id_user = 1  ** */ {
//            $p = $em->createQueryBuilder()
//                    ->update('MyAppForumBundle:sujet', 'd')
//                    ->set('d.user', '1')
//                    ->where('d.user = :v')
//                    ->setParameter('v', $s)
//                    ->getQuery()
//                    ->execute();
//        }
//        
//        
//       $publicite= $em->getRepository('MyAppEspritBundle:publicite')->findBy(array('user' => $ids));
//               foreach ($publicite as $p) /** update pour plusieurs sujets * */
//        /*         * *   les sujets reuperé auront un nouveau id_user = 1  ** */ {
//            $p = $em->createQueryBuilder()
//                    ->update('MyAppEspritBundle:publicite', 'd')
//                    ->set('d.user', '1')
//                    ->where('d.user = :v')
//                    ->setParameter('v', $p)
//                    ->getQuery()
//                    ->execute();
//        }
       
       
       
        /*         * *** je supprime le user choisi au debut  ** */
        $em->remove($user);
        $em->flush();
        $this->get('session')->getFlashBag()->set('message', 'Ce user disparait !!');
        return $this->redirect($this->generateUrl('my_app_user_show', array(
                            'selectuser' => $selectuser
        )));
    }

    public function editAction($id) {
        /** simplde eddit action ** */
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

    public function manageAction(Request $request) {
        $manager = $this->get('collectify_user_manager');/** equivalent de em manager * */
        $User = $this->getRequest()->get('User');
        $usersUserId = $manager->getUserId($User);
        if ($usersUserId != NULL) {
            foreach ($usersUserId as $id) {
                $manager->makeUser($manager->getOne($id));
            }
        }


        $Editor = $this->getRequest()->get('Editor');
        $usersEditorId = $manager->getEditorId($Editor);
        if ($usersEditorId != NULL) {
            foreach ($usersEditorId as $id) {
                $manager->makeEditor($manager->getOne($id));
            }
        }


        $SuperSol = $this->getRequest()->get('SuperSol');
        $usersSuperSolId = $manager->getSuperSolId($SuperSol);
        if ($usersSuperSolId != NULL) {
            foreach ($usersSuperSolId as $id) {
                $manager->makeSuperSol($manager->getOne($id));
            }
        }


        $Admin = $this->getRequest()->get('Admin');
        $usersAdminId = $manager->getAdminId($Admin);
        if ($usersAdminId != NULL) {
            foreach ($usersAdminId as $id) {
                $manager->makeAdmin($manager->getOne($id));
            }
        }

        $SuperAdmin = $this->getRequest()->get('SuperAdmin');
        $usersSuperAdminId = $manager->getSuperAdminId($SuperAdmin); //var_dump($usersSuperAdminId); 
        if ($usersSuperAdminId != NULL) {
            foreach ($usersSuperAdminId as $id) {
                $manager->makeSuperadmin($manager->getOne($id));
            }
        }

        $users = $manager->getAll();
        $form = $this->createFormBuilder($users)->add('users')->getForm();

        $enablesusers = $this->getRequest()->get('enable');
        $enablesusersId = $manager->getenablesusersId($enablesusers); /* array contient string  "id"  des cochés :D */
       
        $allusersId = $manager->getALLusersId($users); /* array contient tout les objets USER */

        
        if ( ($allusersId != NULL)&&($enablesusersId != NULL)  ) {
            foreach ($allusersId as $id) {
                          $x=$id->getId();/* get Id de objet user en cours*/
                          if(in_array($x, array_values($enablesusersId))) /* si id de user en cour existe dans les enableuersid */
                          {$manager->makeEnable($manager->getOne($id));}
                          else{$manager->makeDisable($manager->getOne($id));}
                 
                
            }
        }
        
        
        return $this->render('MyAppUserBundle:Security:manage.html.twig', array('users' => $users, 'form' => $form->createView()));
    }
}
