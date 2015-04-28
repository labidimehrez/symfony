<?php

namespace MyApp\EspritBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MyApp\EspritBundle\Entity\publicite;

class LoadingFixturespub implements FixtureInterface {

    public function load(ObjectManager $manager) {



        $sql = 'TRUNCATE TABLE publicite;';
        $connection = $manager->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $stmt->closeCursor();







        $publicite1 = new publicite();
        $publicite1->setPosition(0);
        $publicite1->setImage('http://img4.hostingpics.net/pics/532465StarTour.png');

        $manager->persist($publicite1);

        $publicite2 = new publicite();
        $publicite2->setPosition(1);
        $publicite2->setImage('http://img15.hostingpics.net/pics/669014CopiedeSkyright.png');

        $manager->persist($publicite2);


        $publicite3 = new publicite();
        $publicite3->setPosition(2);
        $publicite3->setImage('http://img15.hostingpics.net/pics/363331CopiedeSkyleft.png');

        $manager->persist($publicite3);



        $publicite4 = new publicite();
        $publicite4->setPosition(3);
        $publicite4->setImage('http://img4.hostingpics.net/pics/532465StarTour.png');

        $manager->persist($publicite4);

        $publicite5 = new publicite();
        $publicite5->setPosition(4);
        $publicite5->setImage('http://img15.hostingpics.net/pics/669014CopiedeSkyright.png');

        $manager->persist($publicite5);


        $publicite6 = new publicite();
        $publicite6->setPosition(5);
        $publicite6->setImage('http://img15.hostingpics.net/pics/363331CopiedeSkyleft.png');

        $manager->persist($publicite6);

        $publicite7 = new publicite();
        $publicite7->setPosition(6);
        $publicite7->setImage('http://img15.hostingpics.net/pics/363331CopiedeSkyleft.png');

        $manager->persist($publicite7);



        $publicite8 = new publicite();
        $publicite8->setPosition(7);
        $publicite8->setImage(' http://img11.hostingpics.net/pics/786142REKLAME3.png');

        $manager->persist($publicite8);


        $publicite9 = new publicite();
        $publicite9->setPosition(8);
        $publicite9->setImage(' http://img11.hostingpics.net/pics/786142REKLAME3.png');

        $manager->persist($publicite9);

        $publicite10 = new publicite();
        $publicite10->setPosition(9);
        $publicite10->setImage(' http://img11.hostingpics.net/pics/786142REKLAME3.png');

        $manager->persist($publicite10);


        $publicite11 = new publicite();
        $publicite11->setPosition(10);
        $publicite11->setImage('http://img11.hostingpics.net/pics/786142REKLAME3.png');

        $manager->persist($publicite11);


        $publicite12 = new publicite();
        $publicite12->setPosition(11);
        $publicite12->setImage('http://img4.hostingpics.net/pics/991865Layer47.png');

        $manager->persist($publicite12);


        $publicite13 = new publicite();
        $publicite13->setPosition(12);
        $publicite13->setImage('http://img4.hostingpics.net/pics/991865Layer47.png');

        $manager->persist($publicite13);


        $publicite14 = new publicite();
        $publicite14->setPosition(13);
        $publicite14->setImage('http://img4.hostingpics.net/pics/440813Layer49.png');
        $manager->persist($publicite14);


        $publicite15 = new publicite();
        $publicite15->setPosition(14);
        $publicite15->setImage('http://img4.hostingpics.net/pics/604892REKLAME1.png');
        $manager->persist($publicite15);



        $publicite16 = new publicite();
        $publicite16->setPosition(15);
        $publicite16->setImage('http://img11.hostingpics.net/pics/382466PROMO.png');
        $manager->persist($publicite16);


        $publicite17 = new publicite();
        $publicite17->setPosition(16);
        $publicite17->setImage('http://img11.hostingpics.net/pics/786142REKLAME3.png');
        $manager->persist($publicite17);


        $publicite18 = new publicite();
        $publicite18->setPosition(17);
        $publicite18->setImage('http://img15.hostingpics.net/pics/914270HOROSKOP.png');
        $manager->persist($publicite18);



        $publicite19 = new publicite();
        $publicite19->setPosition(18);
        $publicite19->setImage('http://img15.hostingpics.net/pics/195477pizza.png');
        $manager->persist($publicite19);


        $publicite20 = new publicite();
        $publicite20->setPosition(19);
        $publicite20->setImage('http://img4.hostingpics.net/pics/991865Layer47.png');
        $manager->persist($publicite20);



        $publicite21 = new publicite();
        $publicite21->setPosition(20);
        $publicite21->setImage('http://img4.hostingpics.net/pics/564265REKLAME5.png');
        $manager->persist($publicite21);

        $publicite22 = new publicite();
        $publicite22->setPosition(21);
        $publicite22->setImage('http://img15.hostingpics.net/pics/966204TVGUIDE.png');
        $manager->persist($publicite22);



        $publicite23 = new publicite();
        $publicite23->setPosition(22);
        $publicite23->setImage('http://img11.hostingpics.net/pics/725694Layer40.png');
        $manager->persist($publicite23);






        $manager->flush();
    }

}

//       
//                                                            
//                                                             
//                                                            
//                                                            