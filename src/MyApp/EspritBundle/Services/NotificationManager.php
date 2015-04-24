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

    public function getByUser($id) {
        return $this->repository->findBy(array('user' => $id));
    }

    public function getNotification($id) {
        return $this->repository->find($id);
    }

    public function AddNotifFromComment($user, $commentaire, $notif,$boolean,$userConcerned) {
        if (($user != NULL) && ($notif != NULL) && ($commentaire != NULL)&& ($boolean ==='1')&& ($userConcerned != NULL) ) {
            $notif->setContenu("has commented your topic");
            $notif->setLien("my_app_forum_sujet_voir");      
            $notif->setUser($user);
            $notif->setCommentaire($commentaire);
            $notif->setLu(FALSE);
             $notif->setUserConcerned($userConcerned);
           $this->doFlush($notif);
        } else {
            return NULL;
        }
    }

    public function persist($notif) {
        if ($notif != NULL) { /* si la notif n'est pas decoché , notif  est Null => rien a flusher ;) */
            $this->doFlush($notif);
        }
    }

    public function remove($notif) {
        if ($notif != NULL) {
            $this->em->remove($notif);
            $this->em->flush();

            return $notif;
        }
    }

    public function removeall($notification) {
        foreach ($notification as $n) {
            $this->em->remove($n);
            $this->em->flush();
            return $notification;
        }
    }

    public function doFlush($notif) {
        $this->em->persist($notif);
        $this->em->flush();

        return $notif;
    }

}
