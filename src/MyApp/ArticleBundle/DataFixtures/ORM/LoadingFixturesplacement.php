<?php

namespace MyApp\ArticleBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MyApp\ArticleBundle\Entity\Placement;

class LoadingFixturesplacement implements FixtureInterface {

    public function load(ObjectManager $manager) {
             
        $sql = 'TRUNCATE TABLE placement;';
        $connection = $manager->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $stmt->closeCursor();  
       
        
        $placement1 = new Placement();
        $placement1->setPosition(1);         
        $manager->persist($placement1);
               
        $placement2 = new Placement();
        $placement2->setPosition(2);         
        $manager->persist($placement2);    
               
        $placement3 = new Placement();
        $placement3->setPosition(3);         
        $manager->persist($placement3);
               
        $placement4 = new Placement();
        $placement4->setPosition(4);         
        $manager->persist($placement4);        
        
        $placement5 = new Placement();
        $placement5->setPosition(5);         
        $manager->persist($placement5); 
               
        $placement6 = new Placement();
        $placement6->setPosition(6);         
        $manager->persist($placement6); 
              
        $placement7 = new Placement();
        $placement7->setPosition(7);         
        $manager->persist($placement7);
                 
        $placement8 = new Placement();
        $placement8->setPosition(8);         
        $manager->persist($placement8); 
                
        $placement9 = new Placement();
        $placement9->setPosition(9);         
        $manager->persist($placement9);            
        
        $placement10 = new Placement();
        $placement10->setPosition(10);         
        $manager->persist($placement10);
          
        $placement11 = new Placement();
        $placement11->setPosition(11);         
        $manager->persist($placement11);
        
        
        $placement12 = new Placement();
        $placement12->setPosition(12);         
        $manager->persist($placement12);    
        
        
        $placement13 = new Placement();
        $placement13->setPosition(13);         
        $manager->persist($placement13);
        
        
        $placement14 = new Placement();
        $placement14->setPosition(14);         
        $manager->persist($placement14);
         
        
        $placement15 = new Placement();
        $placement15->setPosition(15);         
        $manager->persist($placement15);  
         
        $manager->flush();
    }

}
                                      