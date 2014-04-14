-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Mar 15 Avril 2014 à 00:31
-- Version du serveur: 5.6.14
-- Version de PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `sondagax`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `com_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `com_parent_id` int(10) DEFAULT NULL,
  `ut_id` int(10) unsigned NOT NULL,
  `sondage_id` int(10) unsigned NOT NULL,
  `soutien` int(11) NOT NULL DEFAULT '0',
  `texte` text COLLATE utf8_unicode_ci NOT NULL,
  `commentaire_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`com_id`,`ut_id`,`sondage_id`),
  KEY `ut_id` (`ut_id`),
  KEY `sondage_id` (`sondage_id`),
  KEY `com_parent_id` (`com_parent_id`),
  KEY `com_parent_id_2` (`com_parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=58 ;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`com_id`, `com_parent_id`, `ut_id`, `sondage_id`, `soutien`, `texte`, `commentaire_date`) VALUES
(55, NULL, 42, 36, 2, 'Poauzoz', '2014-04-14 16:41:31'),
(56, NULL, 42, 36, 2, 'jjyjujyuj', '2014-04-14 16:41:56'),
(57, 55, 42, 36, 2, 'tyhtyht', '2014-04-14 16:42:22');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE IF NOT EXISTS `groupe` (
  `groupe_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `groupe_nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `groupe_date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `groupe_droit` tinyint(4) NOT NULL DEFAULT '0',
  `ut_id` int(10) unsigned NOT NULL,
  `groupe_desc` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`groupe_id`),
  KEY `ut_id` (`ut_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`groupe_id`, `groupe_nom`, `groupe_date_creation`, `groupe_droit`, `ut_id`, `groupe_desc`) VALUES
(1, 'LEZY', '2014-03-29 13:47:31', 0, 44, ''),
(2, 'LEZY2', '2014-03-29 20:28:33', 0, 42, ''),
(3, 'GROUPETEST1', '2014-04-01 12:35:15', 1, 46, ''),
(17, 'Habon', '2014-04-14 22:21:31', 0, 42, 'zidzldjazlj'),
(18, 'Tieee', '2014-04-14 22:22:15', 1, 42, 'saalzaùzaz'),
(19, 'habon2', '2014-04-14 22:28:25', 0, 42, 'zdedzedze');

-- --------------------------------------------------------

--
-- Structure de la table `inscrit`
--

CREATE TABLE IF NOT EXISTS `inscrit` (
  `ut_id` int(10) unsigned NOT NULL,
  `groupe_id` int(10) unsigned NOT NULL,
  `date_inscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ut_id`,`groupe_id`),
  KEY `groupe_id` (`groupe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `inscrit`
--

INSERT INTO `inscrit` (`ut_id`, `groupe_id`, `date_inscription`) VALUES
(42, 17, '2014-04-14 22:21:31'),
(42, 18, '2014-04-14 22:22:15'),
(42, 19, '2014-04-14 22:28:25'),
(43, 2, '2014-03-29 20:33:07');

-- --------------------------------------------------------

--
-- Structure de la table `moderateur_groupe`
--

CREATE TABLE IF NOT EXISTS `moderateur_groupe` (
  `ut_id` int(10) unsigned NOT NULL,
  `groupe_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ut_id`,`groupe_id`),
  KEY `groupe_id` (`groupe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `moderateur_sondage`
--

CREATE TABLE IF NOT EXISTS `moderateur_sondage` (
  `ut_id` int(10) unsigned NOT NULL,
  `sondage_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ut_id`,`sondage_id`),
  KEY `moderateur_sondage_ibfk_2` (`sondage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `moderateur_sondage`
--

INSERT INTO `moderateur_sondage` (`ut_id`, `sondage_id`) VALUES
(43, 42);

-- --------------------------------------------------------

--
-- Structure de la table `option`
--

CREATE TABLE IF NOT EXISTS `option` (
  `option_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sondage_id` int(10) unsigned NOT NULL,
  `titre` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`option_id`),
  KEY `sondage_id` (`sondage_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=54 ;

--
-- Contenu de la table `option`
--

INSERT INTO `option` (`option_id`, `sondage_id`, `titre`) VALUES
(2, 27, 'Apoepz'),
(3, 27, 'ppoeozeoz'),
(4, 28, 'Optea1'),
(5, 28, 'Optoe2'),
(9, 29, 'po1'),
(10, 29, 'op2'),
(11, 29, 'Op3'),
(12, 29, 'OP4'),
(13, 29, 'po1'),
(14, 30, 'lezy'),
(15, 30, 'lezy'),
(16, 30, 'lezy'),
(17, 31, 'u'),
(18, 31, 'i'),
(19, 31, 'o'),
(20, 31, 'a'),
(22, 35, 'LasauceMan'),
(23, 35, 'LasauceMan2'),
(24, 35, 'LasauceMan3'),
(25, 35, 'LasauceMan4'),
(26, 35, 'LasauceMan'),
(31, 38, 'OZPOEIZOPEI'),
(32, 38, 'zjdzoidjzioj'),
(33, 38, 'izjdoeijzoejdzoe'),
(34, 38, 'OZPOEIZOPEI'),
(35, 39, 'OOPt'),
(36, 39, 'OOPt2'),
(37, 39, 'OOPt3'),
(38, 39, 'OOPt'),
(39, 40, 'Djoeiz'),
(40, 40, 'Loiedki'),
(41, 40, 'Paoie'),
(42, 40, 'Djoeiz'),
(43, 41, 'atye'),
(44, 41, 'atye2'),
(45, 41, 'Atye3'),
(46, 41, 'atye'),
(47, 42, 'haha1'),
(48, 42, 'haha2'),
(49, 42, 'haha3'),
(50, 43, 'op1'),
(51, 43, 'op2'),
(52, 43, 'op3'),
(53, 43, 'op4');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE IF NOT EXISTS `reponse` (
  `ut_id` int(10) unsigned NOT NULL,
  `option_id` int(10) unsigned NOT NULL,
  `rang` int(15) NOT NULL,
  `sondage_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ut_id`,`option_id`),
  KEY `reponse_ibfk_2` (`option_id`),
  KEY `sondage_id` (`sondage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `reponse`
--

INSERT INTO `reponse` (`ut_id`, `option_id`, `rang`, `sondage_id`) VALUES
(42, 50, 1, 43),
(42, 51, 2, 43),
(42, 52, 3, 43),
(42, 53, 4, 43),
(46, 17, 1, 31),
(46, 18, 1, 31),
(46, 19, 1, 31),
(46, 20, 1, 31),
(46, 44, 1, 41),
(46, 45, 1, 41),
(46, 46, 1, 41),
(46, 47, 1, 42),
(46, 48, 1, 42),
(46, 49, 1, 42);

-- --------------------------------------------------------

--
-- Structure de la table `reponseanonyme`
--

CREATE TABLE IF NOT EXISTS `reponseanonyme` (
  `sondage_id` int(10) unsigned NOT NULL,
  `option_id` int(10) unsigned NOT NULL,
  `rang` int(15) NOT NULL,
  KEY `sondage_id` (`sondage_id`,`option_id`),
  KEY `option_id` (`option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `reponseanonyme`
--

INSERT INTO `reponseanonyme` (`sondage_id`, `option_id`, `rang`) VALUES
(42, 47, 1),
(42, 48, 1),
(42, 49, 1),
(41, 46, 1),
(41, 44, 1),
(41, 45, 1),
(42, 47, 1),
(42, 48, 3),
(42, 49, 1),
(41, 46, 1),
(41, 44, 1),
(41, 45, 1),
(40, 42, 1),
(40, 40, 1),
(40, 41, 1),
(42, 47, 1),
(42, 48, 1),
(42, 49, 1),
(41, 46, 1),
(41, 44, 1),
(41, 45, 1),
(43, 50, 1),
(43, 51, 2),
(43, 52, 3),
(43, 53, 4),
(43, 50, 1),
(43, 51, 2),
(43, 52, 3),
(43, 53, 4),
(43, 50, 1),
(43, 51, 2),
(43, 52, 3),
(43, 53, 4),
(43, 50, 1),
(43, 51, 2),
(43, 52, 3),
(43, 53, 4),
(43, 50, 1),
(43, 51, 2),
(43, 52, 3),
(43, 53, 4),
(43, 50, 1),
(43, 51, 2),
(43, 52, 3),
(43, 53, 4),
(43, 50, 1),
(43, 51, 2),
(43, 52, 3),
(43, 53, 4),
(43, 50, 1),
(43, 51, 2),
(43, 52, 3),
(43, 53, 4),
(43, 50, 1),
(43, 51, 2),
(43, 52, 3),
(43, 53, 4),
(43, 50, 1),
(43, 51, 2),
(43, 52, 3),
(43, 53, 4),
(43, 50, 1),
(43, 51, 2),
(43, 52, 3),
(43, 53, 4),
(43, 50, 1),
(43, 51, 2),
(43, 52, 3),
(43, 53, 4),
(43, 50, 1),
(43, 51, 2),
(43, 52, 3),
(43, 53, 4),
(43, 50, 1),
(43, 51, 2),
(43, 52, 3),
(43, 53, 4),
(43, 50, 1),
(43, 51, 2),
(43, 52, 3),
(43, 53, 4),
(43, 50, 1),
(43, 51, 2),
(43, 52, 3),
(43, 53, 4),
(43, 50, 1),
(43, 51, 2),
(43, 52, 3),
(43, 53, 4),
(43, 50, 1),
(43, 51, 2),
(43, 52, 3),
(43, 53, 4),
(43, 50, 1),
(43, 51, 2),
(43, 52, 3),
(43, 53, 4),
(43, 50, 1),
(43, 51, 2),
(43, 52, 3),
(43, 53, 4),
(43, 50, 4),
(43, 51, 1),
(43, 52, 2),
(43, 53, 3),
(43, 50, 4),
(43, 51, 1),
(43, 52, 2),
(43, 53, 3),
(43, 50, 4),
(43, 51, 1),
(43, 52, 2),
(43, 53, 3),
(43, 50, 4),
(43, 51, 1),
(43, 52, 2),
(43, 53, 3),
(43, 50, 4),
(43, 51, 1),
(43, 52, 2),
(43, 53, 3),
(43, 50, 4),
(43, 51, 1),
(43, 52, 2),
(43, 53, 3),
(43, 50, 4),
(43, 51, 1),
(43, 52, 2),
(43, 53, 3),
(43, 50, 4),
(43, 51, 1),
(43, 52, 2),
(43, 53, 3),
(43, 50, 4),
(43, 51, 1),
(43, 52, 2),
(43, 53, 3),
(43, 50, 4),
(43, 51, 1),
(43, 52, 2),
(43, 53, 3),
(43, 50, 4),
(43, 51, 1),
(43, 52, 2),
(43, 53, 3),
(43, 50, 4),
(43, 51, 1),
(43, 52, 2),
(43, 53, 3),
(43, 50, 4),
(43, 51, 1),
(43, 52, 2),
(43, 53, 3),
(43, 50, 4),
(43, 51, 3),
(43, 52, 1),
(43, 53, 2),
(43, 50, 4),
(43, 51, 3),
(43, 52, 1),
(43, 53, 2),
(43, 50, 4),
(43, 51, 3),
(43, 52, 1),
(43, 53, 2),
(43, 50, 4),
(43, 51, 3),
(43, 52, 1),
(43, 53, 2),
(43, 50, 4),
(43, 51, 3),
(43, 52, 1),
(43, 53, 2),
(43, 50, 4),
(43, 51, 3),
(43, 52, 1),
(43, 53, 2),
(43, 50, 4),
(43, 51, 3),
(43, 52, 1),
(43, 53, 2),
(43, 50, 4),
(43, 51, 3),
(43, 52, 2),
(43, 53, 1),
(43, 50, 4),
(43, 51, 3),
(43, 52, 2),
(43, 53, 1),
(43, 50, 4),
(43, 51, 3),
(43, 52, 2),
(43, 53, 1),
(43, 50, 4),
(43, 51, 3),
(43, 52, 2),
(43, 53, 1),
(43, 50, 4),
(43, 51, 3),
(43, 52, 2),
(43, 53, 1),
(43, 50, 4),
(43, 51, 3),
(43, 52, 2),
(43, 53, 1),
(43, 50, 4),
(43, 51, 3),
(43, 52, 2),
(43, 53, 1),
(43, 50, 4),
(43, 51, 3),
(43, 52, 2),
(43, 53, 1);

-- --------------------------------------------------------

--
-- Structure de la table `sondage`
--

CREATE TABLE IF NOT EXISTS `sondage` (
  `sondage_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ut_id` int(10) unsigned NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `texte_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `sondage_droit` tinyint(1) NOT NULL DEFAULT '0',
  `date_fin` date NOT NULL,
  `type_methode` tinyint(1) NOT NULL DEFAULT '0',
  `visibilite` tinyint(1) NOT NULL DEFAULT '0',
  `groupe_id` int(10) unsigned DEFAULT NULL,
  `sondage_date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sondage_id`),
  KEY `ut_id` (`ut_id`),
  KEY `groupe_id` (`groupe_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=44 ;

--
-- Contenu de la table `sondage`
--

INSERT INTO `sondage` (`sondage_id`, `ut_id`, `titre`, `texte_desc`, `sondage_droit`, `date_fin`, `type_methode`, `visibilite`, `groupe_id`, `sondage_date_create`) VALUES
(27, 42, 'n,vndndnf;', 'nbfsbfskfjskjehejkh', 0, '2093-12-22', 0, 0, 1, '2013-08-23 12:11:43'),
(28, 42, 'ModifSondage', 'oioiuzeiorueijkjejkf', 2, '2093-12-22', 0, 0, NULL, '2013-03-19 13:11:43'),
(29, 44, 'Poomzlaoi', 'hkjehzelmkzjemlezlj', 1, '2093-12-22', 0, 0, NULL, '2013-08-29 00:11:43'),
(30, 43, 'sarco ou holande', 'petit sondage', 2, '2014-11-01', 1, 1, NULL, '2014-04-01 12:11:43'),
(31, 43, 'lool', 'dool', 1, '2015-04-15', 1, 1, NULL, '2014-02-01 13:11:43'),
(32, 42, 'sondage_groupe', 'yeah', 0, '2014-03-31', 0, 0, 2, '2012-07-16 12:11:43'),
(34, 44, 'cree', 'jejeje', 0, '2014-04-05', 0, 0, NULL, '2014-01-01 04:28:43'),
(35, 42, 'Makiaveliche', 'lzjediznjbdjehgfzejgze ejfezjhfgzjhb', 2, '2015-05-23', 1, 1, NULL, '2014-04-01 12:11:43'),
(36, 46, 'PKOAKZA', 'dajzdlakjdzke', 0, '2014-04-23', 0, 0, 2, '2014-04-01 13:01:51'),
(38, 46, 'ManoloSondage', 'Lapeoa ;ldzedezdzed', 3, '2015-06-30', 0, 0, 3, '2014-04-01 13:13:24'),
(39, 44, 'salut', 'ziduzodiuezo', 3, '2014-06-30', 0, 0, NULL, '2014-04-06 14:13:48'),
(40, 42, 'OOHHKILLEM', 'descrorotrotij kzek', 3, '2014-06-30', 1, 1, 2, '2014-04-06 14:15:27'),
(41, 42, 'djoblek23RRZZ', '111dzefefe dedzdzdezdede', 0, '2032-02-12', 0, 0, NULL, '2014-04-06 20:31:15'),
(42, 42, 'Titre22144', 'descjfehfe', 1, '2014-12-02', 0, 0, NULL, '2014-04-06 20:40:10'),
(43, 43, 'test borda', 'test test test', 0, '2014-04-12', 0, 0, NULL, '2014-04-13 16:51:39');

-- --------------------------------------------------------

--
-- Structure de la table `soutien`
--

CREATE TABLE IF NOT EXISTS `soutien` (
  `soutien_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(10) unsigned NOT NULL,
  `commentaire_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`soutien_id`),
  KEY `utilisateur_id` (`utilisateur_id`),
  KEY `commentaire_id` (`commentaire_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

--
-- Contenu de la table `soutien`
--

INSERT INTO `soutien` (`soutien_id`, `utilisateur_id`, `commentaire_id`) VALUES
(53, 42, 55),
(54, 42, 56),
(55, 42, 57),
(56, 46, 55),
(57, 46, 57),
(58, 46, 56);

-- --------------------------------------------------------

--
-- Structure de la table `ss_groupe`
--

CREATE TABLE IF NOT EXISTS `ss_groupe` (
  `ss_groupe_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `groupe_id` int(10) unsigned NOT NULL,
  `date_creation_ss_groupe` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nom_ss_groupe` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ss_groupe_droit` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ss_groupe_id`),
  KEY `groupe_id` (`groupe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ut_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ut_nom` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ut_prenom` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ut_pseudo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ut_mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ut_mdp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ut_date_inscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ut_hash_validation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ut_compte_valide` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ut_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=47 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ut_id`, `ut_nom`, `ut_prenom`, `ut_pseudo`, `ut_mail`, `ut_mdp`, `ut_date_inscription`, `ut_hash_validation`, `ut_compte_valide`) VALUES
(42, 'azes', 'zeez', 'mario', 'saz@gmail.com', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '2014-03-23 18:11:47', '4f876d9e42832237f15ec10e252eff9c', 1),
(43, 'lezy', 'lezy', 'asy', 'abdoulsy95@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2014-03-29 15:51:39', '546372109508087a94969e63b450235f', 1),
(44, 'lezy', 'lezy', 'asyz', 'lezybeatz@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2014-03-29 15:53:30', 'ec36af7b6c139e605f1b8a3835a49d54', 0),
(46, 'BabiereLa', 'AhBon', 'Babiere', 'kingstroyer@gmail.com', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '2014-04-01 12:30:45', 'f9067238f30100a50e137d110b886846', 1);

-- --------------------------------------------------------

--
-- Structure de la table `votant`
--

CREATE TABLE IF NOT EXISTS `votant` (
  `ut_id` int(10) unsigned NOT NULL,
  `sondage_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ut_id`,`sondage_id`),
  KEY `votant_ibfk_2` (`sondage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `votant`
--

INSERT INTO `votant` (`ut_id`, `sondage_id`) VALUES
(43, 28),
(44, 30);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`ut_id`) REFERENCES `utilisateur` (`ut_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`sondage_id`) REFERENCES `sondage` (`sondage_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `groupe_ibfk_1` FOREIGN KEY (`ut_id`) REFERENCES `utilisateur` (`ut_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `inscrit`
--
ALTER TABLE `inscrit`
  ADD CONSTRAINT `inscrit_ibfk_1` FOREIGN KEY (`ut_id`) REFERENCES `utilisateur` (`ut_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `inscrit_ibfk_2` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`groupe_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `moderateur_groupe`
--
ALTER TABLE `moderateur_groupe`
  ADD CONSTRAINT `moderateur_groupe_ibfk_1` FOREIGN KEY (`ut_id`) REFERENCES `utilisateur` (`ut_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `moderateur_groupe_ibfk_2` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`groupe_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `moderateur_sondage`
--
ALTER TABLE `moderateur_sondage`
  ADD CONSTRAINT `moderateur_sondage_ibfk_1` FOREIGN KEY (`ut_id`) REFERENCES `utilisateur` (`ut_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `moderateur_sondage_ibfk_2` FOREIGN KEY (`sondage_id`) REFERENCES `sondage` (`sondage_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `option`
--
ALTER TABLE `option`
  ADD CONSTRAINT `option_ibfk_1` FOREIGN KEY (`sondage_id`) REFERENCES `sondage` (`sondage_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`ut_id`) REFERENCES `utilisateur` (`ut_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `reponse_ibfk_2` FOREIGN KEY (`option_id`) REFERENCES `option` (`option_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `reponse_ibfk_3` FOREIGN KEY (`sondage_id`) REFERENCES `sondage` (`sondage_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `reponseanonyme`
--
ALTER TABLE `reponseanonyme`
  ADD CONSTRAINT `reponseanonyme_ibfk_1` FOREIGN KEY (`sondage_id`) REFERENCES `sondage` (`sondage_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `reponseanonyme_ibfk_2` FOREIGN KEY (`option_id`) REFERENCES `option` (`option_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `sondage`
--
ALTER TABLE `sondage`
  ADD CONSTRAINT `sondage_ibfk_1` FOREIGN KEY (`ut_id`) REFERENCES `utilisateur` (`ut_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `sondage_ibfk_2` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`groupe_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `soutien`
--
ALTER TABLE `soutien`
  ADD CONSTRAINT `soutien_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`ut_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `soutien_ibfk_2` FOREIGN KEY (`commentaire_id`) REFERENCES `commentaire` (`com_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ss_groupe`
--
ALTER TABLE `ss_groupe`
  ADD CONSTRAINT `ss_groupe_ibfk_1` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`groupe_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `votant`
--
ALTER TABLE `votant`
  ADD CONSTRAINT `votant_ibfk_1` FOREIGN KEY (`ut_id`) REFERENCES `utilisateur` (`ut_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `votant_ibfk_2` FOREIGN KEY (`sondage_id`) REFERENCES `sondage` (`sondage_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
