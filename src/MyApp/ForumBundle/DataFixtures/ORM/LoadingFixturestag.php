<?php

namespace MyApp\ForumBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MyApp\ForumBundle\Entity\tag;

class LoadingFixturetag implements FixtureInterface {

    public function load(ObjectManager $manager) {

        
     /*   
        $sql = 'TRUNCATE TABLE tag;';
        $connection = $manager->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $stmt->closeCursor();  
      */  
        
        
        
        
        
        
        $tag1 = new tag();
        $tag1->setTitle("Computer & Internet");         
        $manager->persist($tag1);
        
        $tag2 = new tag();
        $tag2->setTitle("Politique");         
        $manager->persist($tag2);     
     
         $tag3 = new tag();
        $tag3->setTitle("Framework php5");         
        $manager->persist($tag3);

         $tag4 = new tag();
        $tag4->setTitle("ASP VS PHP");         
        $manager->persist($tag4);
        
        $tag5 = new tag();
        $tag5->setTitle("JEE / JSP");         
        $manager->persist($tag5);

         $tag6 = new tag();
        $tag6->setTitle("Spring vs EJB");         
        $manager->persist($tag6);
        
   
        $manager->flush();
    }

}

//       
//                                                            
//                                                             
//                                                            
//                                                            