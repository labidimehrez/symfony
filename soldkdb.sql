-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 25 Janvier 2015 à 18:16
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
  `urlimg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `copyrights` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fixedposition` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `style` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `lien` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_23A0E66E0E861BD` (`headline`),
  UNIQUE KEY `UNIQ_23A0E665C4CD77B` (`urlimg`),
  UNIQUE KEY `UNIQ_23A0E663F82EDB8` (`copyrights`),
  UNIQUE KEY `UNIQ_23A0E6633BDB86A` (`style`),
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
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_7D053A935E237E06` (`name`),
  UNIQUE KEY `UNIQ_7D053A93462CE4F5` (`position`),
  UNIQUE KEY `UNIQ_7D053A93389B783` (`tag`),
  KEY `IDX_7D053A93A76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codecouleur` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_33BDB86A2B36786B` (`title`),
  UNIQUE KEY `UNIQ_33BDB86A5E237E06` (`name`),
  UNIQUE KEY `UNIQ_33BDB86ABAB838C4` (`codecouleur`),
  KEY `IDX_33BDB86AA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

CREATE TABLE IF NOT EXISTS `sujet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sujet` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_lus` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notification` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2E13599D2E13599D` (`sujet`),
  UNIQUE KEY `UNIQ_2E13599D89C2003F` (`contenu`),
  KEY `IDX_2E13599DA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_389B7832B36786B` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  `addresse` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codepostal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `nomprenom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emailCanonical` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numeroportable` int(11) DEFAULT NULL,
  `surmoi` text COLLATE utf8_unicode_ci,
  `date_cre_user` datetime DEFAULT NULL,
  `image` varchar(2500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `sexe`, `addresse`, `codepostal`, `date_naissance`, `nomprenom`, `email`, `emailCanonical`, `ville`, `numeroportable`, `surmoi`, `date_cre_user`, `image`) VALUES
(6, 'root', 'root', 1, 'a4pfjikrvfcc4cg4k8co8gg4s88cswk', 'o5Kr33nDbJsi0Nl0JFuZabC8RUesDCOJPP/ylXCJurnSiR1PacmVQFvQ5H3voGj/oEL8EiUc//9SHHj2MPizwA==', '2015-01-25 18:02:35', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'f', 'azerty', NULL, '2015-01-25', 'root', NULL, '', NULL, 25112990, NULL, '2015-01-25 12:25:57', NULL);

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
-- Contraintes pour la table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `FK_7D053A93A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

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
-- Contraintes pour la table `style`
--
ALTER TABLE `style`
  ADD CONSTRAINT `FK_33BDB86AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

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
