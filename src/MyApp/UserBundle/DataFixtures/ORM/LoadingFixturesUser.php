<?php

// src/Sdz/BlogBundle/DataFixtures/ORM/Categories.php

namespace MyApp\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MyApp\UserBundle\Entity\User;
use MyApp\ForumBundle\Entity\sujet;

class LoadingFixturesUser implements FixtureInterface {

    public function load(ObjectManager $manager) {

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
//            $user1->setImage("http://i-cms.journaldunet.com/image_cms/original/1852005-jean-baptiste-rudelle-l-homme-discret-a-l-origine-de-criteo.jpg");
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
//            $user2->setImage("http://coiffure-esthetique.blogs-entreprises.com/files/2010/07/coiffure-homme-07.jpg");
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
//            $user3->setImage("http://img.over-blog-kiwi.com/0/53/50/02/201307/ob_076fee_florence-colgate-plus-belle-femme-au-monde-2012.jpg");
        $user3->setRoles(array('ROLE_SUPERSOL' => 'Supersol'));
        $manager->persist($user3);



        $user4 = new User();
        $user4->setUsername("user");
        $user4->setSexe("f");
        $user4->setEmail("user.labidi@esprit.tn");
        $user4->setPlainPassword("user");
        $user4->setVille("ville");
        $user4->setSurmoi("surmoi");
        $user4->setNumeroportable(25112990);
        $user4->setEnabled(true);
        $user4->setNomprenom("user");
        $user4->setDatedeCreationUser(new \DateTime());
        $user4->setDatenaissance(new \DateTime());
        $user4->setAddresse("ici");
//            $user4->setImage("http://img.over-blog-kiwi.com/0/53/50/02/201307/ob_076fee_florence-colgate-plus-belle-femme-au-monde-2012.jpg");
        $user4->setRoles(array('ROLE_USER' => 'User'));
        $manager->persist($user4);


        $user5 = new User();
        $user5->setUsername("ali");
        $user5->setSexe("f");
        $user5->setEmail("ali.labidi@esprit.tn");
        $user5->setPlainPassword("ali");
        $user5->setVille("ville");
        $user5->setSurmoi("surmoi");
        $user5->setNumeroportable(25112990);
        $user5->setEnabled(true);
        $user5->setNomprenom("user");
        $user5->setDatedeCreationUser(new \DateTime());
        $user5->setDatenaissance(new \DateTime());
        $user5->setAddresse("ici");
//            $user5->setImage("http://img.over-blog-kiwi.com/0/53/50/02/201307/ob_076fee_florence-colgate-plus-belle-femme-au-monde-2012.jpg");
        $user5->setRoles(array('ROLE_USER' => 'User'));
        $manager->persist($user5);







        $sql1 = 'TRUNCATE TABLE sujet;';
        $connection1 = $manager->getConnection();
        $stmt1 = $connection1->prepare($sql1);
        $stmt1->execute();
        $stmt1->closeCursor();


        $sujet1 = new sujet();
        $sujet1->setSujet('La loi et la foi débat éternel');
        $sujet1->setThread(40);
        $sujet1->setContenu('Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années ');
        $sujet1->setUser($user5);
        $manager->persist($sujet1);


        $sujet2 = new sujet();
        $sujet2->setSujet('La politique n\'est plus un bonheur');
        $sujet2->setThread(40);
        $sujet2->setContenu('Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années ');
        $sujet2->setUser($user4);
        $manager->persist($sujet2);


        $sujet3 = new Sujet();
        $sujet3->setSujet('Réussir ou réussir');
        $sujet3->setThread(40);
        $sujet3->setContenu('Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années ');
        $sujet3->setUser($user3);
        $manager->persist($sujet3);


        $sujet4 = new sujet();
        $sujet4->setSujet('Réussir n\'est plus facile');
        $sujet4->setThread(40);
        $sujet4->setContenu('Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années ');
        $sujet4->setUser($user3);
        $manager->persist($sujet4);

        $sujet5 = new sujet();
        $sujet5->setSujet('Si c\'était facile');
        $sujet5->setThread(40);
        $sujet5->setContenu('Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années ');
        $sujet5->setUser($user3);
        $manager->persist($sujet5);





        $sujet6 = new sujet();
        $sujet6->setSujet('La politique n\'est plus un bonheur');
        $sujet6->setThread(40);
        $sujet6->setContenu('Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années ');
        $sujet6->setUser($user2);
        $manager->persist($sujet6);


        $sujet7 = new Sujet();
        $sujet7->setSujet('Réussir ou réussir');
        $sujet7->setThread(40);
        $sujet7->setContenu('Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années ');
        $sujet7->setUser($user5);
        $manager->persist($sujet7);


        $sujet8 = new sujet();
        $sujet8->setSujet('Réussir n\'est plus facile');
        $sujet8->setThread(40);
        $sujet8->setContenu('Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années ');
        $sujet8->setUser($user4);
        $manager->persist($sujet8);

        $sujet9 = new sujet();
        $sujet9->setSujet('Si c\'était facile');
        $sujet9->setThread(40);
        $sujet9->setContenu('Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années ');
        $sujet9->setUser($user3);
        $manager->persist($sujet9);

        $sujet10 = new sujet();
        $sujet10->setSujet('La politique n\'est plus un bonheur');
        $sujet10->setThread(40);
        $sujet10->setContenu('Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années ');
        $sujet10->setUser($user4);
        $manager->persist($sujet10);


        $sujet11 = new sujet();
        $sujet11->setSujet('Réussir ou réussir');
        $sujet11->setThread(40);
        $sujet11->setContenu('Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années ');
        $sujet11->setUser($user4);
        $manager->persist($sujet11);


        $sujet12 = new sujet();
        $sujet12->setSujet('La politique n\'est plus un bonheur');
        $sujet12->setThread(40);
        $sujet12->setContenu('Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années ');
        $sujet12->setUser($user3);
        $manager->persist($sujet12);


        $sujet13 = new sujet();
        $sujet13->setSujet('Si c\'était facile');
        $sujet13->setThread(40);
        $sujet13->setContenu('Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années ');
        $sujet13->setUser($user3);
        $manager->persist($sujet13);


        $manager->flush();
    }

}
