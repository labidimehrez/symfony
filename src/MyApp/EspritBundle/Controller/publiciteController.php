<?php

namespace MyApp\EspritBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class publiciteController extends Controller {

    public function addAction() {

        $publicite = new \MyApp\EspritBundle\Entity\publicite();
        $form = $this->createForm(new \MyApp\EspritBundle\Form\publiciteType, $publicite);
        $request = $this->getRequest();
        if ($request->isMethod('Post')) {

            $form->bind($request);

            if ($form->isValid()) {
                $publicite = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($publicite);
                $em->flush();



                return $this->redirect($this->generateUrl('my_app_esprit_publicite_manage'));
            }
        }

        return $this->render('MyAppEspritBundle:publicite:manage.html.twig', array('form' => $form->createView()));
    }

    /**
     * Show a Actualite entry
     */
    public function showAction() {
           
        $em = $this->getDoctrine()->getManager();
        
        /**********************************************************************/        
       $user = $em->getRepository('MyAppUserBundle:user')->findAll(); 
     if (!$user) {     
         
         $sql = 'TRUNCATE TABLE user;';
          $connection = $em->getConnection();
          $stmt = $connection->prepare($sql);
          $stmt->execute();
          $stmt->closeCursor();
          
        $user = new \MyApp\UserBundle\Entity\User();      
        $user->setUsername("root");    
        $user->setSexe("m");
        $user->setEmail("mehrez.labidi@esprit.tn");
        $user->setPlainPassword("root");
        $user->setVille("ville");
        $user->setSurmoi("surmoi");
        $user->setNumeroportable(25112990);
        $user->setEnabled(true);
        $user->setNomprenom("nomprenom");
        $user->setDatedeCreationUser(new \DateTime());
        $user->setDatenaissance(new \DateTime());
        $user->setAddresse("ici");
        $user->setRoles(array('ROLE_SUPER_ADMIN' => 'Superadmin'));
 
        $em1 = $this->getDoctrine()->getManager();
        $em1->persist($user);
        $em1->flush(); 
         }
           /**********************************************************************/
     

           

        $publicite = $em->getRepository('MyAppEspritBundle:publicite')      
               ->findBy(array(), array('position' => 'asc'),100, 0);           
       
        //var_dump($publicite);die();
        return $this->render('MyAppEspritBundle:publicite:show.html.twig', array(
                    'publicite2' => $publicite,
        ));
    }

    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $publicite = $em->getRepository('MyAppEspritBundle:publicite')->find($id);

        if (!$publicite) {
            throw $this->createNotFoundException('No publicite found for id ' . $id);
        }

        $em->remove($publicite);
        $em->flush();

        return $this->redirect($this->generateUrl('my_app_esprit_publicite_manage'));
    }

    public function editAction($id) {

        $em = $this->getDoctrine()->getManager();
        $publicite = $em->getRepository('MyAppEspritBundle:publicite')->find($id);
        if (!$publicite) {
            throw $this->createNotFoundException(
                    'No publicite found for id ' . $id
            );
        }

        $form = $this->createFormBuilder($publicite)
                ->add('position', 'text')
                ->add('image', 'text')
                ->getForm();

        $form->handleRequest();

        if ($form->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('my_app_esprit_publicite_manage'));
        }

        return $this->render('MyAppEspritBundle:publicite:manage.html.twig', array('form' => $form->createView()));
    }

    /////////////////////////////////////////////////////////////////////////////////////////

    public function manageAction() {
        $em = $this->getDoctrine()->getManager();

        $publicite2 = $em->getRepository('MyAppEspritBundle:publicite')
                      
                ->findBy(array(), array('position' => 'asc'),100, 0);
                               




        $publicite = new \MyApp\EspritBundle\Entity\publicite();
        $form = $this->createForm(new \MyApp\EspritBundle\Form\publiciteType, $publicite);
        $request = $this->getRequest();
        if ($request->isMethod('Post')) {

            $form->bind($request);

            if ($form->isValid()) {
                $publicite = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($publicite);
                $em->flush();



                return $this->redirect($this->generateUrl('my_app_esprit_publicite_manage'));
            }
        }

        return $this->render('MyAppEspritBundle:publicite:manage.html.twig', array('form' => $form->createView(), 'publicite2' => $publicite2));
    }

    /////////////////////////////////////////////////////////////////////////////////////////

    public function deleteallAction() {
        $em = $this->getDoctrine()->getManager();
        $sql = 'TRUNCATE TABLE publicite;';
        $connection = $em->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $stmt->closeCursor();

        return $this->redirect($this->generateUrl('my_app_esprit_publicite_manage'));
    }

}
