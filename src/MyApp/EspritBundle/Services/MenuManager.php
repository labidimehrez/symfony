<?php

namespace MyApp\EspritBundle\Services;

use Doctrine\ORM\EntityManager;

class MenuManager
{
    private $em;
    private $repository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository('MyAppEspritBundle:menu');
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

    public function persist($menu )
    {
        $this->doFlush($menu);
    }

    public function doFlush($menu)
    {
        $this->em->persist($menu);
        $this->em->flush();

        return $menu;
    }
}