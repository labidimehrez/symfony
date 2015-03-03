<?php
// src/Sdz/BlogBundle/DataFixtures/ORM/Categories.php

namespace MyApp\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MyApp\UserBundle\Entity\User;

class LoadingFixturesUser implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
      
        $sql = 'TRUNCATE TABLE user;';
        $connection = $manager->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $stmt->closeCursor();  
      
      
            $user = new User();
            $user->setUsername("root");
            $user->setSexe("m");
            $user->setEmail("mehrez.labidi@esprit.tn");
            $user->setPlainPassword("root");
            $user->setVille("ville");
            $user->setSurmoi("surmoi");
            $user->setNumeroportable(25112990);
            $user->setEnabled(true);
            $user->setNomprenom("Anonymous");
            $user->setDatedeCreationUser(new \DateTime());
            $user->setDatenaissance(new \DateTime());
            $user->setAddresse("ici");
            $user->setRoles(array('ROLE_SUPER_ADMIN' => 'Superadmin'));
            $manager->persist($user); 
            
            $user1 = new User();
            $user1->setUsername("mehrez");
            $user1->setSexe("m");
            $user1->setEmail("mehrez.labidi@esprit.tn");
            $user1->setPlainPassword("mehrez");
            $user1->setVille("ville");
            $user1->setSurmoi("surmoi");
            $user1->setNumeroportable(25112990);
            $user1->setEnabled(true);
            $user1->setNomprenom("nomprenom");
            $user1->setDatedeCreationUser(new \DateTime());
            $user1->setDatenaissance(new \DateTime());
            $user1->setAddresse("ici");
            $user1->setImage("http://i-cms.journaldunet.com/image_cms/original/1852005-jean-baptiste-rudelle-l-homme-discret-a-l-origine-de-criteo.jpg");
            $user1->setRoles(array('ROLE_SUPER_ADMIN' => 'Superadmin'));
            $manager->persist($user1); 
            
            
            
            
            
            $manager->flush();
  }
}
