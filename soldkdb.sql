-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 24 Février 2015 à 15:24
-- Version du serveur :  5.1.71-community
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `soldkdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `style_id` int(11) NOT NULL,
  `headline` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `urlimg` varchar(2500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `copyrights` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fixedposition` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `lien` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_23A0E66E0E861BD` (`headline`),
  UNIQUE KEY `UNIQ_23A0E663F82EDB8` (`copyrights`),
  UNIQUE KEY `UNIQ_23A0E66462CE4F5` (`position`),
  UNIQUE KEY `UNIQ_23A0E66A532B4B5` (`lien`),
  KEY `IDX_23A0E66A76ED395` (`user_id`),
  KEY `IDX_23A0E66BACD6074` (`style_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `article_tags`
--

CREATE TABLE IF NOT EXISTS `article_tags` (
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`article_id`,`tag_id`),
  KEY `IDX_DFFE13277294869C` (`article_id`),
  KEY `IDX_DFFE1327BAD26311` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thread_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `ancestors` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `depth` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5BC96BF0E2904019` (`thread_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sujet_id` int(11) NOT NULL,
  `commentaire_id` int(11) DEFAULT NULL,
  `commentaire_User` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `commentaire_Parent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notification` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_67F068BCC459BD25` (`commentaire_User`),
  UNIQUE KEY `UNIQ_67F068BC2EA6B5FE` (`commentaire_Parent`),
  KEY `IDX_67F068BC7C4D497E` (`sujet_id`),
  KEY `IDX_67F068BCBA9CD190` (`commentaire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `donnée_signe`
--

CREATE TABLE IF NOT EXISTS `donnée_signe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `signe_id` int(11) NOT NULL,
  `periodetype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_3508BA49A1497DA0` (`periodetype`),
  UNIQUE KEY `UNIQ_3508BA4959359567` (`contenue`),
  KEY `IDX_3508BA49FFD8ADF1` (`signe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `lien` varchar(20000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_7D053A935E237E06` (`name`),
  UNIQUE KEY `UNIQ_7D053A93462CE4F5` (`position`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Contenu de la table `menu`
--

INSERT INTO `menu` (`id`, `name`, `position`, `lien`) VALUES
(1, 'NYHEDER', 1, 'my_app_forum_sujet_sujetrecent'),
(2, 'KENDTE', 2, 'my_app_forum_sujet_sujetrecent'),
(3, 'UNDER', 3, 'my_app_forum_sujet_sujetrecent'),
(4, 'HOLDNING', 4, 'my_app_forum_sujet_sujetrecent'),
(5, 'REJSER', 5, 'my_app_forum_sujet_sujetrecent'),
(6, 'SUNDHED', 6, 'my_app_forum_sujet_sujetrecent'),
(7, 'FRITID', 7, 'my_app_forum_sujet_sujetrecent'),
(8, 'EROTIK', 8, 'my_app_forum_sujet_sujetrecent'),
(9, 'HOROSKOPER', 9, 'my_app_forum_sujet_sujetrecent'),
(10, 'TV-GUIDE', 10, 'my_app_forum_sujet_sujetrecent'),
(11, 'DEBAT', 11, 'my_app_forum_sujet_sujetrecent');

-- --------------------------------------------------------

--
-- Structure de la table `notif`
--

CREATE TABLE IF NOT EXISTS `notif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `nombre` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1B2226F3A909126` (`nombre`),
  KEY `IDX_1B2226FA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `publicite`
--

CREATE TABLE IF NOT EXISTS `publicite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` int(11) NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1D394E39462CE4F5` (`position`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Contenu de la table `publicite`
--

INSERT INTO `publicite` (`id`, `position`, `image`) VALUES
(1, 0, 'http://img4.hostingpics.net/pics/532465StarTour.png'),
(2, 1, 'http://img15.hostingpics.net/pics/669014CopiedeSkyright.png'),
(3, 2, 'http://img15.hostingpics.net/pics/363331CopiedeSkyleft.png'),
(4, 3, 'http://img4.hostingpics.net/pics/532465StarTour.png'),
(5, 4, 'http://img15.hostingpics.net/pics/669014CopiedeSkyright.png'),
(6, 5, 'http://img4.hostingpics.net/pics/860893BannRight.png'),
(7, 6, 'http://img4.hostingpics.net/pics/677738Sanstitre2.png'),
(8, 7, ' http://img11.hostingpics.net/pics/786142REKLAME3.png'),
(9, 8, 'http://img4.hostingpics.net/pics/165997Sanstitre.png');

-- --------------------------------------------------------

--
-- Structure de la table `signe`
--

CREATE TABLE IF NOT EXISTS `signe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `periode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lien` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B540DBD0C53D045F` (`image`),
  UNIQUE KEY `UNIQ_B540DBD0A532B4B5` (`lien`),
  KEY `IDX_B540DBD0A76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `style`
--

CREATE TABLE IF NOT EXISTS `style` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codecouleurfront` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codecouleurback` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_33BDB86A2B36786B` (`title`),
  UNIQUE KEY `UNIQ_33BDB86A5E237E06` (`name`),
  UNIQUE KEY `UNIQ_33BDB86A2961539` (`codecouleurfront`),
  UNIQUE KEY `UNIQ_33BDB86AB931726C` (`codecouleurback`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

CREATE TABLE IF NOT EXISTS `sujet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sujet` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` varchar(20000) COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` datetime DEFAULT NULL,
  `date_lus` datetime DEFAULT NULL,
  `notification` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nblect` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2E13599D2E13599D` (`sujet`),
  KEY `IDX_2E13599DA76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Contenu de la table `sujet`
--

INSERT INTO `sujet` (`id`, `sujet`, `contenu`, `date_creation`, `date_lus`, `notification`, `nblect`, `user_id`) VALUES
(1, 'php', '\n          Le site du framework symfony a été lancé en octobre 2005. À l''origine du projet, \n          on trouve une agence web française, Sensio, qui a développé ce qui s''appelait à \n          l''époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager \n          le code avec la communauté des développeurs PHP.', '2015-02-05 00:00:00', '2015-02-23 23:02:58', NULL, 4, 1),
(2, 'Symfony 2', '\r\n          Le site du framework symfony a été lancé en octobre 2005. À l''origine du projet, \r\n          on trouve une agence web française, Sensio, qui a développé ce qui s''appelait à \r\n          l''époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager \r\n          le code avec la communauté des développeurs PHP.', '2015-02-04 00:00:00', NULL, NULL, NULL, 2),
(3, 'php1', '          Le site du framework symfony a été lancé en octobre 2005. À l''origine du projet, \r\n          on trouve une agence web française, Sensio, qui a développé ce qui s''appelait à \r\n          l''époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager \r\n          le code avec la communauté des développeurs PHP.', NULL, NULL, NULL, NULL, 1),
(4, 'php2', '          Le site du framework symfony a été lancé en octobre 2005. À l''origine du projet, \r\n          on trouve une agence web française, Sensio, qui a développé ce qui s''appelait à \r\n          l''époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager \r\n          le code avec la communauté des développeurs PHP.', NULL, NULL, NULL, NULL, 1),
(5, 'php5', '          Le site du framework symfony a été lancé en octobre 2005. À l''origine du projet, \r\n          on trouve une agence web française, Sensio, qui a développé ce qui s''appelait à \r\n          l''époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager \r\n          le code avec la communauté des développeurs PHP.', NULL, NULL, NULL, NULL, 1),
(6, 'php6', '          Le site du framework symfony a été lancé en octobre 2005. À l''origine du projet, \r\n          on trouve une agence web française, Sensio, qui a développé ce qui s''appelait à \r\n          l''époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager \r\n          le code avec la communauté des développeurs PHP.', NULL, NULL, NULL, NULL, 1),
(7, 'php7', '\r\n          Le site du framework symfony a été lancé en octobre 2005. À l''origine du projet, \r\n          on trouve une agence web française, Sensio, qui a développé ce qui s''appelait à \r\n          l''époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager \r\n          le code avec la communauté des développeurs PHP.', NULL, NULL, NULL, NULL, 1),
(8, 'php8', '\r\n          Le site du framework symfony a été lancé en octobre 2005. À l''origine du projet, \r\n          on trouve une agence web française, Sensio, qui a développé ce qui s''appelait à \r\n          l''époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager \r\n          le code avec la communauté des développeurs PHP.', NULL, NULL, NULL, NULL, 1),
(9, 'php9', '\r\n          Le site du framework symfony a été lancé en octobre 2005. À l''origine du projet, \r\n          on trouve une agence web française, Sensio, qui a développé ce qui s''appelait à \r\n          l''époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager \r\n          le code avec la communauté des développeurs PHP.', NULL, NULL, NULL, NULL, 1),
(10, 'php10', '\r\n          Le site du framework symfony a été lancé en octobre 2005. À l''origine du projet, \r\n          on trouve une agence web française, Sensio, qui a développé ce qui s''appelait à \r\n          l''époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager \r\n          le code avec la communauté des développeurs PHP.', NULL, NULL, NULL, NULL, 1),
(11, 'php11', '\r\n          Le site du framework symfony a été lancé en octobre 2005. À l''origine du projet, \r\n          on trouve une agence web française, Sensio, qui a développé ce qui s''appelait à \r\n          l''époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager \r\n          le code avec la communauté des développeurs PHP.', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `sujet_tags`
--

CREATE TABLE IF NOT EXISTS `sujet_tags` (
  `sujet_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`sujet_id`,`tag_id`),
  KEY `IDX_B86D53B17C4D497E` (`sujet_id`),
  KEY `IDX_B86D53B1BAD26311` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `sujet_tags`
--

INSERT INTO `sujet_tags` (`sujet_id`, `tag_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_389B7832B36786B` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `tag`
--

INSERT INTO `tag` (`id`, `title`) VALUES
(4, 'ASP VS PHP'),
(1, 'Computer & Internet'),
(3, 'Framework php5'),
(5, 'JEE / JSP'),
(2, 'Politique'),
(6, 'Spring vs EJB');

-- --------------------------------------------------------

--
-- Structure de la table `thread`
--

CREATE TABLE IF NOT EXISTS `thread` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permalink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_commentable` tinyint(1) NOT NULL,
  `num_comments` int(11) NOT NULL,
  `last_comment_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `thread`
--

INSERT INTO `thread` (`id`, `permalink`, `is_commentable`, `num_comments`, `last_comment_at`) VALUES
('test', 'http://localhost/SolDK/web/app_dev.php/sujet/1/voir', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `sexe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numeroportable` int(11) DEFAULT NULL,
  `surmoi` text COLLATE utf8_unicode_ci,
  `date_naissance` date DEFAULT NULL,
  `date_cre_user` datetime DEFAULT NULL,
  `addresse` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nomprenom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codepostal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(2500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emailCanonical` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `sexe`, `ville`, `numeroportable`, `surmoi`, `date_naissance`, `date_cre_user`, `addresse`, `nomprenom`, `codepostal`, `image`, `email`, `emailCanonical`) VALUES
(1, 'root', 'root', 1, 'ammqvcq9dp4ckco8oggw8gsgkg4ckgw', '2GyVAUzcVjh5ZeRq2UUKbrOqf8rUwmTrmjZ/uxRGOeQumPbzdHcnyavdRoNZPYmPEN5sU5ac+uiXIfTVLd100w==', '2015-02-24 00:26:09', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"SUPERADMIN";}', 0, NULL, 'm', 'ville', 25112990, 'surmoi', '2015-02-23', '2015-02-23 19:22:39', 'ici', 'Anonymous', NULL, NULL, 'mehrez.labidi@esprit.tn', 'mehrez.labidi@esprit.tn'),
(2, 'mehrez', 'mehrez', 1, 'f4826tdq0dkooc4wgkwkcc0ck40g8s8', 'KSz+eMeruEeIo6ucuy5cYjLnZfik0YZ4CdU0YwE7+5oRI2sgfnCvmYQ0ss15wIH4KxNq4AEm19pD+fr6Wswr+w==', '2015-02-23 22:15:09', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"SUPERADMIN";}', 0, NULL, 'm', 'ville', 25112990, 'surmoi', '2015-02-23', '2015-02-23 19:22:40', 'ici', 'nomprenom', NULL, NULL, 'mehrez.labidi@esprit.tn', 'mehrez.labidi@esprit.tn');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E66A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_23A0E66BACD6074` FOREIGN KEY (`style_id`) REFERENCES `style` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `article_tags`
--
ALTER TABLE `article_tags`
  ADD CONSTRAINT `FK_DFFE13277294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_DFFE1327BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_5BC96BF0E2904019` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`id`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_67F068BC7C4D497E` FOREIGN KEY (`sujet_id`) REFERENCES `sujet` (`id`),
  ADD CONSTRAINT `FK_67F068BCBA9CD190` FOREIGN KEY (`commentaire_id`) REFERENCES `commentaire` (`id`);

--
-- Contraintes pour la table `donnée_signe`
--
ALTER TABLE `donnée_signe`
  ADD CONSTRAINT `FK_3508BA49FFD8ADF1` FOREIGN KEY (`signe_id`) REFERENCES `signe` (`id`);

--
-- Contraintes pour la table `notif`
--
ALTER TABLE `notif`
  ADD CONSTRAINT `FK_1B2226FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `signe`
--
ALTER TABLE `signe`
  ADD CONSTRAINT `FK_B540DBD0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `sujet`
--
ALTER TABLE `sujet`
  ADD CONSTRAINT `FK_2E13599DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `sujet_tags`
--
ALTER TABLE `sujet_tags`
  ADD CONSTRAINT `FK_B86D53B17C4D497E` FOREIGN KEY (`sujet_id`) REFERENCES `sujet` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B86D53B1BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
