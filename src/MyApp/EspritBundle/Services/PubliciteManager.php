<?php
namespace MyApp\EspritBundle\Services;

use Doctrine\ORM\EntityManager;

class PubliciteManager
{
    private $em;
    private $repository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository('MyAppEspritBundle:publicite');
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
    public function removemore($publicite)
    {        foreach ($publicite as $s){
        $this->em->remove($s);
    $this->em->flush();}

        return $publicite;
    }
    public function persist($publicite )
    {
        $this->doFlush($publicite);
    }

    public function doFlush($publicite)
    {
        $this->em->persist($publicite);
        $this->em->flush();

        return $publicite;
    }
}