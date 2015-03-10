<?php

namespace Test\FrontBundle\Services;

use Doctrine\ORM\EntityManager;

class SheetManager
{
    private $em;
    private $repository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository('TestFrontBundle:Sheet');
    }

    public function getAll()
    {
        return $this->repository->findAll();
    }

    public function getSheetByUser($user)
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
    }

    public function persist($sheet, $user)
    {
        $sheet->setUser($user);

        $this->doFlush($sheet);
    }

    public function doFlush($sheet)
    {
        $this->em->persist($sheet);
        $this->em->flush();

        return $sheet;
    }
}