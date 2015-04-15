-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 03 Mars 2015 à 17:35
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
  `style_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `headline` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `urlimg` varchar(2500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `copyrights` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fixedposition` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lien` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_23A0E66462CE4F5` (`position`),
  UNIQUE KEY `UNIQ_23A0E66E0E861BD` (`headline`),
  UNIQUE KEY `UNIQ_23A0E663F82EDB8` (`copyrights`),
  UNIQUE KEY `UNIQ_23A0E66A532B4B5` (`lien`),
  KEY `IDX_23A0E66BACD6074` (`style_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `style_id`, `position`, `headline`, `urlimg`, `copyrights`, `fixedposition`, `lien`) VALUES
(1, 5, 1, 'Danmark far tre nye Michelin - restauranter - men mister...', 'http://s1.e-monsite.com/2009/03/14/03/78972373publicite-1-jpg.jpg', '1', '11', '111'),
(2, 6, 2, 'Champagnedreng fangslet fire uger til fordi han...', 'http://www.llllitl.fr/wp-content/uploads/2013/04/llllitl-evian-baby-me-live-young-publicit%C3%A9-ad-marketing-campagne-publicitaire-advertising-yuksek-we-are-from-la-12.jpg', '2', '22', '222'),
(3, 5, 3, 'Kvindelig kniv-morder stikker igen', 'http://www.publiz.net/wp-content/uploads/2010/07/ikea-chaussure-meuble-publicit%C3%A9-print-02.jpg', '3', '33', '333'),
(4, 6, 4, 'Stunt blandt forse flypas', 'http://www.letribunaldunet.fr/wp-content/uploads/2012/05/une-publicite-contre-les-ogm_89708_w460.jpg', '4', '44', '444'),
(5, 5, 5, 'Derfor besogte Brandby tran-eren Chelsea', 'http://www.danstapub.com/wp-content/uploads/2013/06/dans-ta-pub-musique-publicit%C3%A9-les-meilleures-f%C3%AAte-de-la-musique-21-juin.jpg', '5', '55', '555'),
(6, 5, 6, 'Dansk  sko-kade far bedste resultat nogensinde', 'http://www.danstapub.com/wp-content/uploads/2013/07/dans-ta-pub-cigarette-publicit%C3%A9-op%C3%A9ration-marketing-loi-evin-tabac-contre-hausse-france-5.jpg', '6', '66', '666'),
(7, 6, 7, 'Her far man den varste kundservice i Danmark', 'http://img.e-marketing.fr/Img/BREVE/2013/4/52620/Lego-remporte-28e-Grand-Prix-Publicite-Presse-Magazine-F.jpg', '7', '77', '777'),
(8, 6, 8, 'Rygte: Rolling Stones til Roskilde Festival-ledelsen afviser ikke...', 'http://img.e-marketing.fr/Img/BREVE/2013/9/182241/Snickers-sort-publicite-decalee-Chantal-Goya-F.jpg', '8', '88', '888'),
(9, 5, 9, 'Den stumper vist lidt Fagforening raser over fraek uniform', 'http://sjbm.files.wordpress.com/2009/10/pub-et-information.jpg', '9', '99', '999'),
(10, 5, 10, 'VIDEO Overbevisende 3 arig vil have cupcakes till aftensmad', 'http://sjbm.files.wordpress.com/2009/10/pub-et-information.jpg', '10', '1010', '101010'),
(11, 5, 11, 'Hvad sker der nar man beder 20 fremmede om at kysse ?', 'http://sjbm.files.wordpress.com/2009/10/pub-et-information.jpg', '11', '1111', '111111'),
(12, 6, 12, '35.000 danske pas er forsvun-det', NULL, '12', '1212', '121212'),
(13, 6, 13, 'Chokskifte på vej i Formel 1:Verdensmester vil væk', NULL, '13', '1313', '131313'),
(14, 6, 14, 'Massiv føring til blå blok: Maser Thorning totalt', NULL, '14', '1414', '141414'),
(15, 6, 15, 'Her er de nye regler for Formel 1-raceme', NULL, '15', '1515', '151515');

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
  `author_id` int(11) DEFAULT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5BC96BF0E2904019` (`thread_id`),
  KEY `IDX_5BC96BF0F675F31B` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `thread_id`, `body`, `ancestors`, `depth`, `created_at`, `state`, `author_id`, `score`) VALUES
(1, 'test', 'Symfony est un framework MVC libre écrit en PHP 5. En tant que framework, il facilite et accélère le développement de sites et d''applications Internet et Intranet.', '', 0, '2015-03-03 02:10:37', 0, NULL, 1),
(2, 'test', 'Symfony est un framework MVC libre écrit en PHP 5. En tant que framework, il facilite et accélère le développement de sites et d''applications Internet et Intranet.', '', 0, '2015-03-03 02:12:26', 0, NULL, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Contenu de la table `publicite`
--

INSERT INTO `publicite` (`id`, `position`, `image`) VALUES
(1, 0, 'http://img4.hostingpics.net/pics/532465StarTour.png'),
(2, 1, 'http://img15.hostingpics.net/pics/669014CopiedeSkyright.png'),
(3, 2, 'http://img15.hostingpics.net/pics/363331CopiedeSkyleft.png'),
(4, 3, 'http://img4.hostingpics.net/pics/532465StarTour.png'),
(5, 4, 'http://img15.hostingpics.net/pics/669014CopiedeSkyright.png'),
(6, 5, 'http://img15.hostingpics.net/pics/363331CopiedeSkyleft.png'),
(7, 6, 'http://img15.hostingpics.net/pics/363331CopiedeSkyleft.png'),
(8, 7, ' http://img11.hostingpics.net/pics/786142REKLAME3.png'),
(9, 8, ' http://img11.hostingpics.net/pics/786142REKLAME3.png'),
(10, 9, ' http://img11.hostingpics.net/pics/786142REKLAME3.png'),
(11, 10, 'http://img11.hostingpics.net/pics/786142REKLAME3.png'),
(12, 11, 'http://img4.hostingpics.net/pics/991865Layer47.png'),
(13, 12, 'http://img4.hostingpics.net/pics/991865Layer47.png'),
(14, 13, 'http://img4.hostingpics.net/pics/440813Layer49.png'),
(15, 14, 'http://img4.hostingpics.net/pics/604892REKLAME1.png'),
(16, 15, 'http://img11.hostingpics.net/pics/382466PROMO.png'),
(17, 16, 'http://img11.hostingpics.net/pics/786142REKLAME3.png'),
(18, 17, 'http://img15.hostingpics.net/pics/914270HOROSKOP.png'),
(19, 18, 'http://img15.hostingpics.net/pics/195477pizza.png'),
(20, 19, 'http://img4.hostingpics.net/pics/991865Layer47.png'),
(21, 20, 'http://img4.hostingpics.net/pics/564265REKLAME5.png'),
(22, 21, 'http://img15.hostingpics.net/pics/966204TVGUIDE.png');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `style`
--

INSERT INTO `style` (`id`, `title`, `name`, `codecouleurfront`, `codecouleurback`) VALUES
(1, 'Gris & Red', 'Style1', '#E6E6E6', '#FF0000'),
(2, 'Yellow & Blue', 'Style2', '#0000FF', '#D7DF01'),
(3, 'Vert& Violet', 'Style3', '#E3CEF6', '#38610B'),
(4, 'Blanc & Jaune', 'Style4', '#F2F5A9', '#FFFFFF'),
(5, 'Noir & Blanc', 'Style5', '#FFFFFF', '#190707'),
(6, 'Blanc & Noir  ', 'Style6', '#190707', '#FFFFFF');

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
(1, 'Symfony 2.36', '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Le site du framework symfony a &eacute;t&eacute; lanc&eacute; en octobre 2005. &Agrave; l&#39;origine du projet,&nbsp;<br />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; on trouve une agence web fran&ccedil;aise, Sensio, qui a d&eacute;velopp&eacute; ce qui s&#39;appelait &agrave;&nbsp;<br />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; l&#39;&eacute;poque Sensio Framework1 pour ses propres besoins et a ensuite souhait&eacute; en partager&nbsp;<br />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; le code avec la communaut&eacute; des d&eacute;veloppeurs PHP.', '2015-03-02 11:36:45', '2015-03-03 15:57:13', '1', 1, 2),
(2, 'Framework php5', '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Symfony est un framework MVC libre &eacute;crit en PHP 5. En tant que framework,<br />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; il facilite et acc&eacute;l&egrave;re le d&eacute;veloppement de sites et d&#39;applications Internet et Intranet.', '2015-03-02 11:53:52', NULL, '1', NULL, 1),
(3, 'Symfony', 'Framework php5', '2015-03-04 00:00:00', NULL, NULL, NULL, 1),
(4, 'SF2', '           Symfony est un framework MVC libre écrit en PHP 5. En tant que framework,\r\n          il facilite et accélère le développement de sites et d''applications Internet et Intranet.', '2015-03-01 00:00:00', NULL, NULL, NULL, 2),
(5, 'Dev', '          Symfony est un framework MVC libre écrit en PHP 5. En tant que framework,\r\n          il facilite et accélère le développement de sites et d''applications Internet et Intranet.', '2015-03-02 00:00:00', NULL, NULL, NULL, 2),
(6, 'POO', '          Symfony est un framework MVC libre écrit en PHP 5. En tant que framework,\r\n          il facilite et accélère le développement de sites et d''applications Internet et Intranet.', '2015-03-02 00:00:00', NULL, NULL, NULL, 2),
(7, 'POA', '          Symfony est un framework MVC libre écrit en PHP 5. En tant que framework,\r\n          il facilite et accélère le développement de sites et d''applications Internet et Intranet.', '2015-03-02 00:00:00', NULL, NULL, NULL, 2),
(8, 'SOA', '          Symfony est un framework MVC libre écrit en PHP 5. En tant que framework,\r\n          il facilite et accélère le développement de sites et d''applications Internet et Intranet.', '2015-03-02 00:00:00', NULL, NULL, NULL, 2),
(9, 'WebService', '          Symfony est un framework MVC libre écrit en PHP 5. En tant que framework,\r\n          il facilite et accélère le développement de sites et d''applications Internet et Intranet.', '2015-03-02 00:00:00', NULL, NULL, NULL, 2),
(10, 'Asp.Net', '          Symfony est un framework MVC libre écrit en PHP 5. En tant que framework,\r\n          il facilite et accélère le développement de sites et d''applications Internet et Intranet.', '2015-03-02 00:00:00', '2015-03-03 02:19:42', NULL, 2, 2),
(11, 'See Sharp', '          Symfony est un framework MVC libre écrit en PHP 5. En tant que framework,\r\n          il facilite et accélère le développement de sites et d''applications Internet et Intranet.', '2015-03-02 00:00:00', '2015-03-03 02:10:14', NULL, 1, 2);

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
(1, 3),
(1, 4),
(2, 1),
(2, 5);

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
('test', 'http://localhost/SolDK/web/app_dev.php/sujet/11/voir', 1, 2, '2015-03-03 02:12:26');

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
(1, 'root', 'root', 1, 'luc141otp8g088ssocs0g0s4k0cwk48', 'r8VKfmFdXcQdD8CusxF9j8f1wJBouYMukF8C74sHXzuJWvNK0EFWHLFP0lxWUYU6QZTZWnUJ9Fx7KnpJZVSlCQ==', '2015-03-02 11:35:47', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"SUPERADMIN";}', 0, NULL, 'm', 'ville', 25112990, 'surmoi', '2015-03-01', '2015-03-01 23:54:33', 'ici', 'Anonymous', NULL, NULL, 'mehrez.labidi@esprit.tn', 'mehrez.labidi@esprit.tn'),
(2, 'mehrez', 'mehrez', 1, 'de9u7gvlu28s084gos8s0s4wcoggogo', 'wJvnNkmfkCnEyRWMV3jhp9LmyPgPy+1F8z1WOBUbeCKeDTQCOwrt9C0b1yZG1PlRiTTxkKH1HSbjbIXBp1WX5g==', '2015-03-02 11:53:13', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"SUPERADMIN";}', 0, NULL, 'm', 'ville', 25112990, 'surmoi', '2015-03-01', '2015-03-01 23:54:34', 'ici', 'nomprenom', NULL, 'http://i-cms.journaldunet.com/image_cms/original/1852005-jean-baptiste-rudelle-l-homme-discret-a-l-origine-de-criteo.jpg', 'mehrez.labidi@esprit.tn', 'mehrez.labidi@esprit.tn');

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE IF NOT EXISTS `vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) DEFAULT NULL,
  `voter_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FA222A5AF8697D13` (`comment_id`),
  KEY `IDX_FA222A5AEBB4B8AD` (`voter_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `vote`
--

INSERT INTO `vote` (`id`, `comment_id`, `voter_id`, `created_at`, `value`) VALUES
(1, 1, NULL, '2015-03-03 02:10:49', 1),
(2, 2, NULL, '2015-03-03 16:00:07', 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
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
  ADD CONSTRAINT `FK_5BC96BF0E2904019` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`id`),
  ADD CONSTRAINT `FK_5BC96BF0F675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

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

--
-- Contraintes pour la table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `FK_FA222A5AEBB4B8AD` FOREIGN KEY (`voter_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_FA222A5AF8697D13` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
