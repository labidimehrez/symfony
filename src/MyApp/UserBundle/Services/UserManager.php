<?php

namespace MyApp\UserBundle\Services;

use Doctrine\ORM\EntityManager;

class UserManager
{
    private $em;
    private $repository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository('MyAppUserBundle:user');
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

    public function persist($user )
    {
        $this->doFlush($user);
    }

    public function doFlush($user)
    {
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}