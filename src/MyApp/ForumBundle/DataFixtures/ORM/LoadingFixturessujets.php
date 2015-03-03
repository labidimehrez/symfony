<?php

namespace MyApp\ForumBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MyApp\ForumBundle\Entity\sujet;
 use MyApp\UserBundle\Entity\User;

class LoadingFixturessujets implements FixtureInterface {

    public function load(ObjectManager $manager) {



        $sql = 'TRUNCATE TABLE sujet;';
        $connection = $manager->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $stmt->closeCursor();







    /*    $sujet1 = new sujet(); 
        $sujet1->setSujet("Symfony 2");
        $sujet1->setUser($user1);
        $sujet1->setContenu("Le site du framework symfony a été lancé en octobre 2005. À l'origine du projet, 
          on trouve une agence web française, Sensio, qui a développé ce qui s'appelait à 
          l'époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager 
          le code avec la communauté des développeurs PHP.");
         $manager->persist($sujet1);
         
        $sujet2 = new sujet();
        $sujet2->setSujet("ASP .net");
        $sujet2->setContenu("Le site du framework symfony a été lancé en octobre 2005. À l'origine du projet, 
          on trouve une agence web française, Sensio, qui a développé ce qui s'appelait à 
          l'époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager 
          le code avec la communauté des développeurs PHP.");
         $manager->persist($sujet2);

        $sujet3 = new sujet();
        $sujet3->setSujet("Framework Nouveau");
        $sujet3->setContenu("Le site du framework symfony a été lancé en octobre 2005. À l'origine du projet, 
          on trouve une agence web française, Sensio, qui a développé ce qui s'appelait à 
          l'époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager 
          le code avec la communauté des développeurs PHP.");
         $manager->persist($sujet3);
         
        $sujet4 = new sujet();
        $sujet4->setSujet("Php5");
        $sujet4->setContenu("Le site du framework symfony a été lancé en octobre 2005. À l'origine du projet, 
          on trouve une agence web française, Sensio, qui a développé ce qui s'appelait à 
          l'époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager 
          le code avec la communauté des développeurs PHP.");
         $manager->persist($sujet4);
         
         
        $sujet5 = new sujet();
        $sujet5->setSujet("Symfony 2");
        $sujet5->setContenu("Le site du framework symfony a été lancé en octobre 2005. À l'origine du projet, 
          on trouve une agence web française, Sensio, qui a développé ce qui s'appelait à 
          l'époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager 
          le code avec la communauté des développeurs PHP.");
         $manager->persist($sujet5);
         
        $sujet6 = new sujet();
        $sujet6->setSujet("ASP .net");
        $sujet6->setContenu("Le site du framework symfony a été lancé en octobre 2005. À l'origine du projet, 
          on trouve une agence web française, Sensio, qui a développé ce qui s'appelait à 
          l'époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager 
          le code avec la communauté des développeurs PHP.");
         $manager->persist($sujet6);

        $sujet7 = new sujet();
        $sujet7->setSujet("Framework Nouveau");
        $sujet7->setContenu("Le site du framework symfony a été lancé en octobre 2005. À l'origine du projet, 
          on trouve une agence web française, Sensio, qui a développé ce qui s'appelait à 
          l'époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager 
          le code avec la communauté des développeurs PHP.");
         $manager->persist($sujet7);
         
        $sujet8 = new sujet();
        $sujet8->setSujet("Php5");
        $sujet8->setContenu("Le site du framework symfony a été lancé en octobre 2005. À l'origine du projet, 
          on trouve une agence web française, Sensio, qui a développé ce qui s'appelait à 
          l'époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager 
          le code avec la communauté des développeurs PHP.");
         $manager->persist($sujet8);
                           
        $sujet9= new sujet();
        $sujet9->setSujet("Framework Nouveau");
        $sujet9->setContenu("Le site du framework symfony a été lancé en octobre 2005. À l'origine du projet, 
          on trouve une agence web française, Sensio, qui a développé ce qui s'appelait à 
          l'époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager 
          le code avec la communauté des développeurs PHP.");
         $manager->persist($sujet9);
         
        $sujet10 = new sujet();
        $sujet10->setSujet("Php5");
        $sujet10->setContenu("Le site du framework symfony a été lancé en octobre 2005. À l'origine du projet, 
          on trouve une agence web française, Sensio, qui a développé ce qui s'appelait à 
          l'époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager 
          le code avec la communauté des développeurs PHP.");
         $manager->persist($sujet10);
         
         
        $sujet11= new sujet();
        $sujet11->setSujet("Framework Nouveau");
        $sujet11->setContenu("Le site du framework symfony a été lancé en octobre 2005. À l'origine du projet, 
          on trouve une agence web française, Sensio, qui a développé ce qui s'appelait à 
          l'époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager 
          le code avec la communauté des développeurs PHP.");
         $manager->persist($sujet11);
         
        $sujet12 = new sujet();
        $sujet12->setSujet("Php5");
        $sujet12->setContenu("Le site du framework symfony a été lancé en octobre 2005. À l'origine du projet, 
          on trouve une agence web française, Sensio, qui a développé ce qui s'appelait à 
          l'époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager 
          le code avec la communauté des développeurs PHP.");
         $manager->persist($sujet12);
                  
         
         
        $manager->flush();*/
    }

}

//       
//                                                            
//                                                             
//                                                            
//                                                            