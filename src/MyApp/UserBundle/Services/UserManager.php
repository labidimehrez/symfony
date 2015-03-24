<?php

namespace MyApp\UserBundle\Services;

use Doctrine\ORM\EntityManager;

class UserManager {

    private $em;
    private $repository;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->repository = $em->getRepository('MyAppUserBundle:user');
    }

    public function getAll() {
        return $this->repository->findAll();
    }

    public function getOne($id) {
        return $this->repository->find($id);
    }
    public function makeEnable($user) {
        $user->setEnabled(true);
        $this->persist($user);
        return $user;
    }
   public function makeDisable($user) {
        $user->setEnabled(false);
        $this->persist($user);
        return $user;
    }
    
    
    public function makeSuperadmin($user) {
        $user->setRoles(array('ROLE_SUPER_ADMIN' => 'Superadmin'));
        $this->persist($user);
        return $user;
    }

    public function makeAdmin($user) {
        $user->setRoles(array('ROLE_ADMIN' => 'Admin'));
        $this->persist($user);
        return $user;
    }

    public function makeSuperSol($user) {
        $user->setRoles(array('ROLE_SUPERSOL' => 'SuperSol'));
        $this->persist($user);
        return $user;
    }

    public function makeEditor($user) {
        $user->setRoles(array('ROLE_EDITOR' => 'Editor'));
        $this->persist($user);
        return $user;
    }

    public function makeUser($user) {
        $user->setRoles(array('ROLE_USER' => 'User'));
        $this->persist($user);
        return $user;
    }   
    public function getALLusersId($users) {
        if ($users != NULL) {
            return array_values($users);
        }
    }
    public function getenablesusersId($enablesusers) {
        if ($enablesusers != NULL) {
            return (int)($enablesusers);
        }
    }
    public function getdisablesusersId($disablesusers) {
        if ($disablesusers != NULL) {
            return  (int)($disablesusers);
        }
    }
    public function getSuperAdminId($SuperAdmin) {
        if ($SuperAdmin != NULL) {
            return array_values($SuperAdmin);
        }
    }

    public function getAdminId($Admin) {
        if ($Admin != NULL) {
            return array_values($Admin);
        }
    }

    public function getSuperSolId($SuperSol) {
        if ($SuperSol != NULL) {
            return array_values($SuperSol);
        }
    }

    public function getEditorId($Editor) {
        if ($Editor != NULL) {
            return array_values($Editor);
        }
    }

    public function getUserId($User) {
        if ($User != NULL) {
            return array_values($User);
        }
    }

    public function persist($user) {
        $this->doFlush($user);
    }

    public function doFlush($user) {
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

}
