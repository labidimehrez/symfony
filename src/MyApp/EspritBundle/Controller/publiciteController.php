<?php


namespace MyApp\EspritBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\EspritBundle\Form\publiciteType;
use MyApp\EspritBundle\Entity\publicite;
use MyApp\UserBundle\Entity\User;
use MyApp\EspritBundle\Entity\menu;
 use Symfony\Component\HttpFoundation\Request;
class publiciteController extends Controller {

    public function addAction() {
        /*         * ******* ajout de nouveau publicite  ****** */
        $em = $this->getDoctrine()->getManager();
          
        $user = $this->container->get('security.context')->getToken()->getUser();  
         
        $publicite = new publicite();
        $form = $this->createForm(new publiciteType(), $publicite);
        $request = $this->getRequest();
        if ($request->isMethod('Post')) {

            $form->bind($request);

            if ($form->isValid()) {
                $publicite = $form->getData();
                 $pub =$form["image"]->getData();
                 $publicite->setUser($user);
//                 var_dump($pub);exit;
                     if( (strpos($pub, '</script>') == false)&& (strpos($pub, '.png') == false)&& (strpos($pub, '.jpeg') == false)){
                       $this->get('session')->getFlashBag()->set('message', 'Publicité lien invalide !!');                
                     }
                     else{
                       $em->persist($publicite);
                       $em->flush();                    
                     }
                $this->get('session')->getFlashBag()->set('message', 'Publicité ajouté');  
                return $this->redirect($this->generateUrl('my_app_esprit_publicite_add'));
            }
            if (!$form->isValid()) {

                $this->get('session')->getFlashBag()->set('message', 'Cette position est déja occupée !!');
            }
        }
        return $this->render('MyAppEspritBundle:publicite:add.html.twig', array('form' => $form->createView()));
    }

 

    public function showAction() {

        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository('MyAppEspritBundle:menu')->getAllMenu();                                               
        /*         * ********************  tous les pub de la base *************************** */
        $publicite = $em->getRepository('MyAppEspritBundle:publicite')->findAll();
        return $this->render('MyAppEspritBundle:publicite:show.html.twig', array(
                    'publicite' => $publicite , 'menu' => $menu
                   
        ));
    }

    public function deleteAction($id) {
        /*         * ******************** delete d'une pub si il existe deja *** */
        $em = $this->getDoctrine()->getManager();
        $publicite = $em->getRepository('MyAppEspritBundle:publicite')->find($id);
        if (!$publicite) {
            throw $this->createNotFoundException('no publicite found for id ' . $id);
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

        return $this->render('MyAppEspritBundle:publicite:manage.html.twig',
                array('form' => $form->createView(),'publicite2' => $publicite2, 'publicite' => $publicite));
                    
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

    
        public function showextpubAction() {
            
        $em = $this->getDoctrine()->getManager();      
        $menu = $em->getRepository('MyAppEspritBundle:menu')->getAllMenu();
        /*         * ********************   les pub externe  *************************** */
        $publicite = $em->getRepository('MyAppEspritBundle:publicite')->getextPub();

        return $this->render('MyAppEspritBundle:publicite:showextpub.html.twig', array(
        'publicite' => $publicite, 'menu' => $menu)); 
        
        }
        
       public function deletemoreAction(Request $request) {
        $ids = $this->getRequest()->get('mesIds');
        $em = $this->getDoctrine()->getManager();
        $publicited = $em->getRepository('MyAppEspritBundle:publicite')->findBy(array('id' => $ids));
        $manager = $this->get('collectify_publicite_manager');/** equivalent de em manager * */
        $manager->removemore($publicited);
        $publicite = $em->getRepository('MyAppEspritBundle:publicite')->findAll();
        $form = $this->createFormBuilder($publicite)->add('publicite')->getForm();
        return $this->render('MyAppEspritBundle:publicite:manage.html.twig', array(
                    'form' => $form->createView(), 'publicite2' => $publicite
        ));
    }
    
    
       public function showpubfooterAction() {
            
        $em = $this->getDoctrine()->getManager();      
        
        /*         * ********************   les pub externe  *************************** */
        $publicite = $em->getRepository('MyAppEspritBundle:publicite')->findBy(array('position' => 7));

        return $this->render('MyAppEspritBundle:publicite:pubfooter.html.twig', array(  'publicite' => $publicite)); 
      
        
        }
        
        
}
