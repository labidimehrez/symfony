<?php
namespace MyApp\EspritBundle\Services;

use Doctrine\ORM\EntityManager;

class NotificationManager
{
    private $em;
    private $repository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository('MyAppEspritBundle:notification');
    }

    public function getAll()
    {
        return $this->repository->findAll();
    }

   /* public function getSheetByUser($user)
    {
        return $this->repository->getAll($user);
    }

    public function getSheet($id)
    {
        return $this->repository->find($id);
    }

    public function validate($sheet)
    {
        $sheet->setValidated(true);

        $this->doFlush($sheet);
    }*/

    public function persist($notif )
    {
        $this->doFlush($notif);
    }

    public function doFlush($notif)
    {
        $this->em->persist($notif);
        $this->em->flush();

        return $notif;
    }
}