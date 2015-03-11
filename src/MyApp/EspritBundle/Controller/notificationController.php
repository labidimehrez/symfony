<?php

namespace MyApp\EspritBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class notificationController extends Controller {

    public function shownumberAction() {



        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $user = $this->getUser();
        //var_dump($user);die();
        if (!$user) {
            $id = 0;
        } else {
            $id = $user->getId();
        }

//        var_dump($id);die();
        /*         * *********************************** */

        $numberNotif = $em->getRepository('MyAppEspritBundle:notification')->getNumberAllNotif($id); // get a number of rows
        $array = array();  // declaration tableau vide a utiliser apres
        $array["1"] = $numberNotif; // inserer l entier dans le tableau

        return $this->render('MyAppEspritBundle:notification:notifnumber.html.twig', array(
                    'numberNotif' => $array)); // j 'envoie un tableau a une valeur converti dans twig avec join
    }

    public function testnotifAction() {

        $em = $this->getDoctrine()->getManager();
        $notif = $em->getRepository('MyAppEspritBundle:notification')->findAll();

        return $this->render('MyAppEspritBundle:notification:testnotif.html.twig', array('notif' => $notif)); // j 'envoie un tableau a une valeur converti dans twig avec join );
    }

    public function showallAction() {
                //**** affichage du contenu des notifications ***/
        $em = $this->getDoctrine()->getManager();
        $notif = $em->getRepository('MyAppEspritBundle:notification')->findAll();

        return $this->render('MyAppEspritBundle:notification:showall.html.twig', array('notif' => $notif)); // j 'envoie un tableau a une valeur converti dans twig avec join );
    }

    
        public function deleteAction($id) {
            
        $manager = $this->get('collectify_notification_manager');/** equivalent de em manager **/
        $notif = $manager->getNotification($id);             
        if (!$notif) {
            throw $this->createNotFoundException('no  notif found for id ' . $id);
        }
        $manager->remove($notif);

        
        return null;
    }

}
