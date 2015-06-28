<?php

namespace MyApp\EspritBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MyApp\EspritBundle\Entity\Menu;

class LoadingFixturesmenu implements FixtureInterface {

    public function load(ObjectManager $manager) {

        
        
        $sql = 'TRUNCATE TABLE menu;';
        $connection = $manager->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $stmt->closeCursor();  
        
        
        
        
        
        
        
        $menu1 = new Menu();
        $menu1->setPosition(1);
        $menu1->setName('SPORT');
        $menu1->setLien('my_app_article_article_show');
        $manager->persist($menu1);
        
        $menu2 = new Menu();
        $menu2->setPosition(2);
        $menu2->setName('DÉBAT');
        $menu2->setLien('my_app_forum_sujet_sujetrecent');
        $manager->persist($menu2);
        
        $menu3 = new Menu();
        $menu3->setPosition(3);
        $menu3->setName('STYLE');
        $menu3->setLien('my_app_article_style_add');
        $manager->persist($menu3);
        
        $menu4 = new Menu();
        $menu4->setPosition(4);
        $menu4->setName('ARTICLE');
        $menu4->setLien('my_app_forum_sujet_sujetrecent');
        $manager->persist($menu4);
        
        $menu5 = new Menu();
        $menu5->setPosition(5);
        $menu5->setName('ACTUALITÉ');
        $menu5->setLien('my_app_forum_sujet_sujetrecent');
        $manager->persist($menu5);
        
        $menu6 = new Menu();
        $menu6->setPosition(6);
        $menu6->setName('SANTÉ');
        $menu6->setLien('my_app_forum_sujet_sujetrecent');
        $manager->persist($menu6);
        
        $menu7 = new Menu();
        $menu7->setPosition(7);
        $menu7->setName('LOISIRS');
        $menu7->setLien('my_app_forum_sujet_sujetrecent');
        $manager->persist($menu7);
        
        $menu8 = new Menu();
        $menu8->setPosition(8);
        $menu8->setName('HUMOUR');
        $menu8->setLien('my_app_forum_sujet_sujetrecent');
        $manager->persist($menu8);
        
        $menu9 = new Menu();
        $menu9->setPosition(9);
        $menu9->setName('HOROSCOPE');
        $menu9->setLien('my_app_esprit_horoscope_show');
        $manager->persist($menu9);
        
        $menu10 = new Menu();
        $menu10->setPosition(10);
        $menu10->setName('TV-GUIDE');
        $menu10->setLien('my_app_forum_sujet_sujetrecent');
        $manager->persist($menu10);
        
        $menu11 = new Menu();
        $menu11->setPosition(11);
        $menu11->setName('RECENT');
        $menu11->setLien('my_app_forum_sujet_sujetrecent');
        $manager->persist($menu11);





        $manager->flush();
    }

}

//       
//                                                            
//                                                             
//                                                            
//                                                            