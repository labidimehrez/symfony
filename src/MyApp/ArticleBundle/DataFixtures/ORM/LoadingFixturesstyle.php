<?php

namespace MyApp\ArticleBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MyApp\ArticleBundle\Entity\Style;

class LoadingFixturesstyle implements FixtureInterface {

    public function load(ObjectManager $manager) {
             
        $sql = 'TRUNCATE TABLE style;';
        $connection = $manager->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $stmt->closeCursor();  
       
        
        $style1 = new Style();
        $style1->setName("Style1");
        $style1->setTitle("Gris & Red");
        $style1->setCodecouleurback("#FF0000"); //rouge  
        $style1->setCodecouleurfront("#E6E6E6"); //gris clair       
        $manager->persist($style1);
               
        $style2 = new Style();
        $style2->setName("Style2");
        $style2->setTitle("Yellow & Blue");
        $style2->setCodecouleurback("#D7DF01"); // jaune  
        $style2->setCodecouleurfront("#0000FF"); //bleu foncé
        $manager->persist($style2);
  
        $style3 = new Style();
        $style3->setName("Style3");
        $style3->setTitle("Vert& Violet");
        $style3->setCodecouleurback("#38610B"); //vert  
        $style3->setCodecouleurfront("#E3CEF6"); //violet       
        $manager->persist($style3);
         
        $style4 = new Style();
        $style4->setName("Style4");
        $style4->setTitle("Blanc & Jaune");
        $style4->setCodecouleurback("#FFFFFF"); //blanc  
        $style4->setCodecouleurfront("#F2F5A9"); //jaune      
        $manager->persist($style4);
               
        $style5 = new Style();
        $style5->setName("Style5");
        $style5->setTitle("Noir & Blanc");
        $style5->setCodecouleurback("#190707"); // noir  
        $style5->setCodecouleurfront("#FFFFFF"); //blanc
        $manager->persist($style5);
         
        $style6 = new Style();
        $style6->setName("Style6");
        $style6->setTitle("Blanc & Noir  ");
        $style6->setCodecouleurback("#FFFFFF");  //blanc
        $style6->setCodecouleurfront("#190707"); // noir 
        $manager->persist($style6);
        
        
        $manager->flush();
    }

}
                                      