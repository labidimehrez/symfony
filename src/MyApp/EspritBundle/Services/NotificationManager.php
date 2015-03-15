<?php

namespace MyApp\EspritBundle\Services;

use Doctrine\ORM\EntityManager;

class NotificationManager {

    private $em;
    private $repository;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->repository = $em->getRepository('MyAppEspritBundle:notification');
    }

    public function getAll() {
        return $this->repository->findAll();
    }

     public function getByUser($id)
      {
     return $this->repository->findBy(array('user' => $id));
  
      }
     

    public function getNotification($id) {
        return $this->repository->find($id);
    }
 
    
    
    public function addNotif($user, $sujet, $notif,$notifboolean) { /** Seul les Topic avec Notif deja Coché :) */
        if($notifboolean==TRUE){
        $notif->setUser($user);
        $notif->setSujet($sujet);
        $notif->setContenu("You Topic is added !!");
        $notif->setLien("my_app_forum_sujet_voir");
        return $notif;}
        else{return null;}
    }

    public function persist($notif) {
        if($notif != NULL){ /* si la notif n'est pas decoché , notif  est Null => rien a flusher ;) */
        $this->doFlush($notif);}
    }

    public function remove($notif) {
         if($notif != NULL){ 
        $this->em->remove($notif);
        $this->em->flush();

         return $notif;}
    }

        public function removeall($notification) {
        foreach ($notification as $n)
        { $this->em->remove($n);
        $this->em->flush();
         return $notification;}
    }
    
    
    
    public function doFlush($notif) {
        $this->em->persist($notif);
        $this->em->flush();

        return $notif;
    }

}
