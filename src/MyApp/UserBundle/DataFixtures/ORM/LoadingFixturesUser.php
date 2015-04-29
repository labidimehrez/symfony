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
            $user->setEmail("root.labidi@esprit.tn");
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
      //      $user1->setImage("http://i-cms.journaldunet.com/image_cms/original/1852005-jean-baptiste-rudelle-l-homme-discret-a-l-origine-de-criteo.jpg");
            $user1->setRoles(array('ROLE_SUPER_ADMIN' => 'Superadmin'));
            $manager->persist($user1); 
            
            
            $user2 = new User();
            $user2->setUsername("editor");
            $user2->setSexe("m");
            $user2->setEmail("editor.labidi@esprit.tn");
            $user2->setPlainPassword("editor");
            $user2->setVille("ville");
            $user2->setSurmoi("surmoi");
            $user2->setNumeroportable(25112990);
            $user2->setEnabled(true);
            $user2->setNomprenom("editor");
            $user2->setDatedeCreationUser(new \DateTime());
            $user2->setDatenaissance(new \DateTime());
            $user2->setAddresse("ici");
        //    $user2->setImage("http://coiffure-esthetique.blogs-entreprises.com/files/2010/07/coiffure-homme-07.jpg");
            $user2->setRoles(array('ROLE_EDITOR' => 'Editor'));
            $manager->persist($user2);
            
            
            $user3 = new User();
            $user3->setUsername("supersol");
            $user3->setSexe("f");
            $user3->setEmail("supersol.labidi@esprit.tn");
            $user3->setPlainPassword("supersol");
            $user3->setVille("ville");
            $user3->setSurmoi("surmoi");
            $user3->setNumeroportable(25112990);
            $user3->setEnabled(true);
            $user3->setNomprenom("supersol");
            $user3->setDatedeCreationUser(new \DateTime());
            $user3->setDatenaissance(new \DateTime());
            $user3->setAddresse("ici");
    //       $user3->setImage("http://img.over-blog-kiwi.com/0/53/50/02/201307/ob_076fee_florence-colgate-plus-belle-femme-au-monde-2012.jpg");
            $user3->setRoles(array('ROLE_SUPERSOL' => 'Supersol'));
            $manager->persist($user3);
            
            
 
            $manager->flush();
  }
}
