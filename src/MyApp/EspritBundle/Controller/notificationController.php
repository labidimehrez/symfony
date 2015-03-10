<?php

namespace MyApp\EspritBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class notificationController extends Controller {
       
    public function shownumberAction() {
         
          
          
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $user = $this->getUser();
         //var_dump($user);die();
        if(!$user){$id=0;}else{$id = $user->getId();}
        
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
        $numberNotif = $em->getRepository('MyAppEspritBundle:notification')->find(1)->getId();
        $array = array();  // declaration tableau vide a utiliser apres
        $array["1"] = $numberNotif; // inserer l entier dans le tableau

        return $this->render('MyAppEspritBundle:notification:testnotif.html.twig', array('numberNotif' => $array)); // j 'envoie un tableau a une valeur converti dans twig avec join );
    }

}
