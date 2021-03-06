<?php

namespace MyApp\ArticleBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MyApp\ArticleBundle\Entity\Style;
use MyApp\ArticleBundle\Entity\Article;

class LoadingFixturesstyle implements FixtureInterface {

    public function load(ObjectManager $manager) {

        /*
        $sql = 'TRUNCATE TABLE style;';
        $connection = $manager->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $stmt->closeCursor();
*/

        $style1 = new Style();
        $style1->setName("Style1");
        $style1->setTitle("Gris & Red");
        $style1->setCodecouleurfront("#FF0000"); //rouge  
        $style1->setCodecouleurback("#E6E6E6"); //gris clair       
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
        
        
        $style7 = new Style();
        $style7->setName("Style6");
        $style7->setTitle("Blanc & Noir  ");
        $style7->setCodecouleurback("#000000");  //noir
        $style7->setCodecouleurfront("#190707"); // VERT 
        $manager->persist($style7);

        /***** les articles  **/
/*       
        $sql1 = 'TRUNCATE TABLE article;';
        $connection1 = $manager->getConnection();
        $stmt1 = $connection1->prepare($sql1);
        $stmt1->execute();
        $stmt1->closeCursor();
*/


        $article1 = new Article();
        $article1->setPosition(1);
        $article1->setStyle($style6);
        $article1->setCopyrights("article1");
        $article1->setFixedposition(1);
        //  $article1->setUrlimg("zz");
        $article1->setHeadline("Danemark père trois nouveaux Michelin - restaurants - mais perdre ...");
        $article1->setLien("article1");
        $manager->persist($article1);

      
        $article2 = new Article();
        $article2->setPosition(2);
        $article2->setStyle($style6);
        $article2->setCopyrights("article2");
        $article2->setFixedposition(1);
        //  $article1->setUrlimg("zz");
        $article2->setHeadline("Champagne garçon Fang a fait quatre semaines parce qu'il ...");
        $article2->setLien("article2");
        $manager->persist($article2);
        
       
        $article3 = new Article();
        $article3->setPosition(3);
        $article3->setStyle($style6);
        $article3->setCopyrights("article3");
        $article3->setFixedposition(0);
        //  $article1->setUrlimg("zz");
        $article3->setHeadline("Femme couteau-killer colle à nouveau");
        $article3->setLien("article3");
        $manager->persist($article3);
        
        
        $article4 = new Article();
        $article4->setPosition(4);
        $article4->setStyle($style6);
        $article4->setCopyrights("article4");
        $article4->setFixedposition(0);
        //  $article1->setUrlimg("zz");
        $article4->setHeadline("Stunt parmi passe vigueur de vol");
        $article4->setLien("article4");
        $manager->persist($article4);
        
               
 
        $article5 = new Article();
        $article5->setPosition(5);
        $article5->setStyle($style5);
        $article5->setCopyrights("article5");
        $article5->setFixedposition(1);
        //  $article1->setUrlimg("zz");
        $article5->setHeadline("Derfor est  inquiet de Branby tran-eren Chelsea");
        $article5->setLien("article5");
        $manager->persist($article5);
       
        
        $article6 = new Article();
        $article6->setPosition(6);
        $article6->setStyle($style5);
        $article6->setCopyrights("article6");
        $article6->setFixedposition(1);
        //  $article1->setUrlimg("zz");
        $article6->setHeadline("Chaussure-kade danoise papa meilleur résultat");
        $article6->setLien("article6");
        $manager->persist($article6);
        
        
        
        
        $article7 = new Article();
        $article7->setPosition(7);
        $article7->setStyle($style5);
        $article7->setCopyrights("article7");
        $article7->setFixedposition(1);
        //  $article1->setUrlimg("zz");
        $article7->setHeadline("Ici, vous obtenez le pire service client au Danemark");
        $article7->setLien("article7");
        $manager->persist($article7);
        
        
        
        
        $article8 = new Article();
        $article8->setPosition(8);
        $article8->setStyle($style5);
        $article8->setCopyrights("article8");
        $article8->setFixedposition(0);
        //  $article1->setUrlimg("zz");
        $article8->setHeadline("Rumeur: Rolling Stones à la gestion Roskilde Festival ne rejette pas ...");
        $article8->setLien("article8");
        $manager->persist($article8);
        
        
       
        $article9 = new Article();
        $article9->setPosition(9);
        $article9->setStyle($style5);
        $article9->setCopyrights("article9");
        $article9->setFixedposition(1);
        //  $article1->setUrlimg("zz");
        $article9->setHeadline("Les bits inscrits certains syndicats fait rage sur l'uniforme coquine");
        $article9->setLien("article9");
        $manager->persist($article9);
        
        
        
        $article10 = new Article();
        $article10->setPosition(10);
        $article10->setStyle($style5);
        $article10->setCopyrights("article10");
        $article10->setFixedposition(1);
        //  $article1->setUrlimg("zz");
        $article10->setHeadline("Convaincant VIDEO 3 Arig veulent petits gâteaux jusqu'au dîner");
        $article10->setLien("article10");
        
        $manager->persist($article10);
        
        
        
        
        $article11 = new Article();
        $article11->setPosition(11);
        $article11->setStyle($style5);
        $article11->setCopyrights("article11");
        $article11->setFixedposition(1);
        //  $article1->setUrlimg("zz");
        $article11->setHeadline("Qu'advient-il lorsque vous demandez 20 étrangers sur les baisers?");
        $article11->setLien("article11");
        $manager->persist($article11);
        
      
        
        $article12 = new Article();
        $article12->setPosition(12);
        $article12->setStyle($style5);
        $article12->setCopyrights("article12");
        $article12->setFixedposition(0);
        //  $article1->setUrlimg("zz");
        $article12->setHeadline("35.000 passeport danois a disparu");
        $article12->setLien("article12");
        $manager->persist($article12);
        
        
        $article13 = new Article();
        $article13->setPosition(13);
        $article13->setStyle($style5);
        $article13->setCopyrights("article13");
        $article13->setFixedposition(1);
        //  $article1->setUrlimg("zz");
        $article13->setHeadline("Shock commutateur sur le chemin de la Formule 1: Champion du Monde sera loin");
        $article13->setLien("article13");
        $manager->persist($article13);
        
        
        
        
        
        
        $article14 = new Article();
        $article14->setPosition(14);
        $article14->setStyle($style5);
        $article14->setCopyrights("article14");
        $article14->setFixedposition(1);
        //  $article1->setUrlimg("zz");
        $article14->setHeadline("Solide avance au bloc bleu:  Maser Thorning totale");
        $article14->setLien("article14");
        $manager->persist($article14);
        
        
        $article15 = new Article();
        $article15->setPosition(15);
        $article15->setStyle($style5);
        $article15->setCopyrights("article15");
        $article15->setFixedposition(1);
        //  $article1->setUrlimg("zz");
        $article15->setHeadline("Voici les nouvelles règles pour les coureurs de Formule 1");
        $article15->setLien("article15");
        $manager->persist($article15);
         
        
    
        
        
        
        
        
        $manager->flush();
    }

}
