<?php

namespace MyApp\EspritBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\EspritBundle\Form\publiciteType;
use MyApp\EspritBundle\Entity\publicite;
use MyApp\UserBundle\Entity\User;
use MyApp\EspritBundle\Entity\menu;

class publiciteController extends Controller {

    public function addAction() {
        /*         * ******* ajout de nouveau publicite  ****** */
        $publicite = new publicite();
        $form = $this->createForm(new publiciteType(), $publicite);
        $request = $this->getRequest();
        if ($request->isMethod('Post')) {

            $form->bind($request);

            if ($form->isValid()) {
                $publicite = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($publicite);
                $em->flush();

                return $this->redirect($this->generateUrl('my_app_esprit_publicite_add'));
            }
            if (!$form->isValid()) {

                $this->get('session')->getFlashBag()->set('message', 'This position is occuped !!');
            }
        }
        return $this->render('MyAppEspritBundle:publicite:add.html.twig', array('form' => $form->createView()));
    }

    public function showminpubAction() {
        $em = $this->getDoctrine()->getManager();
        /*         * ****  recuperer les pub les plus importants *************************** */
        $publicite = $em->getRepository('MyAppEspritBundle:publicite')->getMinPub();
        /*         * ****  tous les menu de la base *************************** */
        $menu = $em->getRepository('MyAppEspritBundle:menu')->getAllMenu();
        return $this->render('MyAppEspritBundle:publicite:show.html.twig', array(
                    'publicite' => $publicite, 'menu' => $menu
        ));
    }

    public function showAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        /*  si aucun user dans la base on crée un par defaut  * */
        $user = $em->getRepository('MyAppUserBundle:user')->findAll();
        if (!$user) {
            /*             * ******************** clear de la table pour revenir à id=1 *** */
            $sql = 'TRUNCATE TABLE user;';
            $connection = $em->getConnection();
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            $stmt->closeCursor();
            /*             * ******************** default new user ** */
            $user = new User();
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
        /*         * ********************  tous les menus de la base *************************** */
        $menu = $em->getRepository('MyAppEspritBundle:menu')->getAllMenu();
        if (!$menu) {
            /*             * *********  requete native pour inserer plusieurs menus **** */
            $sql = 'INSERT INTO menu(position,name,lien) values(1,"NYHEDER","my_app_forum_sujet_sujetrecent"),
                                                               (2,"KENDTE","my_app_forum_sujet_sujetrecent") ,
                                                               (3,"UNDER","my_app_forum_sujet_sujetrecent"),
                                                               (4,"HOLDNING","my_app_forum_sujet_sujetrecent"),
                                                               (5,"REJSER","my_app_forum_sujet_sujetrecent"),
                                                               (6,"SUNDHED","my_app_forum_sujet_sujetrecent"),
                                                               (7,"FRITID","my_app_forum_sujet_sujetrecent"),
                                                               (8,"EROTIK","my_app_forum_sujet_sujetrecent"),          
                                                               (9,"HOROSKOPER","my_app_forum_sujet_sujetrecent"),
                                                               (10,"TV-GUIDE","my_app_forum_sujet_sujetrecent"),
                                                               (11,"DEBAT","my_app_forum_sujet_sujetrecent")';


            $connection = $em->getConnection();
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            $stmt->closeCursor();
        }
        /*         * ********************  tous les pub de la base *************************** */
        $publicite = $em->getRepository('MyAppEspritBundle:publicite')->getAllPub();
   
         /****************          la route coourante           ***************/
         //$currentRoute = $request->attributes->get('_route');
        return $this->render('MyAppEspritBundle:publicite:show.html.twig', array(
                    'publicite' => $publicite, 'menu' => $menu
                
                // ,'currentRoute'=>$currentRoute // la route coourante
                   
        ));
    }

    public function deleteAction($id) {
        /*         * ******************** delete d'une pub si il existe deja *** */
        $em = $this->getDoctrine()->getManager();
        $publicite = $em->getRepository('MyAppEspritBundle:publicite')->find($id);
        if (!$publicite) {
            throw $this->createNotFoundException('No publicite found for id ' . $id);
        }
        $em->remove($publicite);
        $em->flush();

        return $this->redirect($this->generateUrl('my_app_esprit_publicite_manage'));
    }

    public function manageAction() {
        /*         * ********************  ajout de nouveau pub  **** */
        $em = $this->getDoctrine()->getManager();
        $publicite = new publicite();
        $form = $this->createForm(new publiciteType, $publicite);
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
        /*         * ******************** recuperation des pub ordonnés  ******************* */
        $publicite2 = $em->getRepository('MyAppEspritBundle:publicite')->findBy(array(), array('position' => 'asc'), 100, 0);

        return $this->render('MyAppEspritBundle:publicite:manage.html.twig', array('form' => $form->createView(),
                    'publicite2' => $publicite2, 'publicite' => $publicite));
    }

    public function deleteallAction() {
        /*         * ********************  delete all Pubs **** */
        $em = $this->getDoctrine()->getManager();
        $sql = 'TRUNCATE TABLE publicite;';
        $connection = $em->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $stmt->closeCursor();
        return $this->redirect($this->generateUrl('my_app_esprit_publicite_manage'));
    }

}
