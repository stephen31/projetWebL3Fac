-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 31 Mars 2014 à 16:34
-- Version du serveur :  5.6.16
-- Version de PHP :  5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `sondagax`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `com_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ut_id` int(10) unsigned NOT NULL,
  `sondage_id` int(10) unsigned NOT NULL,
  `soutien` int(11) NOT NULL DEFAULT '0',
  `texte` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`com_id`,`ut_id`,`sondage_id`),
  KEY `ut_id` (`ut_id`),
  KEY `sondage_id` (`sondage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  `groupe_visibilite` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`groupe_id`),
  KEY `ut_id` (`ut_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`groupe_id`, `groupe_nom`, `groupe_date_creation`, `groupe_droit`, `ut_id`, `groupe_visibilite`) VALUES
(1, 'LEZY', '2014-03-29 13:47:31', 0, 44, 0),
(2, 'LEZY2', '2014-03-29 20:28:33', 0, 42, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Contenu de la table `option`
--

INSERT INTO `option` (`option_id`, `sondage_id`, `titre`) VALUES
(1, 2, 'Sauceman'),
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
(21, 31, 'u');

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
(44, 11, 2, 29);

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
  PRIMARY KEY (`sondage_id`),
  KEY `ut_id` (`ut_id`),
  KEY `groupe_id` (`groupe_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Contenu de la table `sondage`
--

INSERT INTO `sondage` (`sondage_id`, `ut_id`, `titre`, `texte_desc`, `sondage_droit`, `date_fin`, `type_methode`, `visibilite`, `groupe_id`) VALUES
(1, 1, 'Sondage Exeprimental', 'Possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard. De nombreuses suites logicielles de mise en place par mr le pro', 0, '2014-04-02', 1, 0, NULL),
(2, 1, 'Sondage Exeprimental', 'Possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard. De nombreuses suites logicielles de mise en place par mr le pro', 0, '2014-04-03', 1, 0, NULL),
(27, 42, 'n,vndndnf;', 'nbfsbfskfjskjehejkh', 0, '2093-12-22', 0, 0, 1),
(28, 42, 'la sauce mamane', 'oioiuzeiorueijkjejkf', 2, '2093-12-22', 0, 0, NULL),
(29, 42, 'Poomzlaoi', 'hkjehzelmkzjemlezlj', 1, '2093-12-22', 0, 0, NULL),
(30, 43, 'sarco ou holande', 'petit sondage', 2, '2014-11-01', 1, 1, NULL),
(31, 43, 'lool', 'dool', 1, '2015-04-15', 1, 1, NULL),
(32, 42, 'sondage_groupe', 'yeah', 0, '2014-03-31', 0, 0, 2),
(33, 44, 'cree', 'eueu', 0, '0000-00-00', 0, 0, NULL),
(34, 44, 'cree', 'jejeje', 0, '2014-04-01', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ss_commentaire`
--

CREATE TABLE IF NOT EXISTS `ss_commentaire` (
  `ss_com_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `com_id` int(10) unsigned NOT NULL,
  `ut_id` int(10) unsigned NOT NULL,
  `texte` text COLLATE utf8_unicode_ci NOT NULL,
  `soutien` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ss_com_id`,`com_id`,`ut_id`),
  KEY `ss_commentaire_ibfk_1` (`com_id`),
  KEY `ss_commentaire_ibfk_2` (`ut_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=45 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ut_id`, `ut_nom`, `ut_prenom`, `ut_pseudo`, `ut_mail`, `ut_mdp`, `ut_date_inscription`, `ut_hash_validation`, `ut_compte_valide`) VALUES
(1, 'basto', 'prenom', 'lasauce', 'b-smz@hotmail.com', '12345', '2014-03-19 23:26:04', 'é"é"é"', 1),
(42, 'azes', 'zeez', 'mario', 'saz@gmail.com', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '2014-03-23 18:11:47', '4f876d9e42832237f15ec10e252eff9c', 1),
(43, 'lezy', 'lezy', 'asy', 'abdoulsy95@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2014-03-29 15:51:39', '546372109508087a94969e63b450235f', 1),
(44, 'lezy', 'lezy', 'asyz', 'lezybeatz@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2014-03-29 15:53:30', 'ec36af7b6c139e605f1b8a3835a49d54', 0);

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
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`ut_id`) REFERENCES `utilisateur` (`ut_id`),
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`sondage_id`) REFERENCES `sondage` (`sondage_id`);

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
  ADD CONSTRAINT `reponse_ibfk_3` FOREIGN KEY (`sondage_id`) REFERENCES `sondage` (`sondage_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`ut_id`) REFERENCES `utilisateur` (`ut_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `reponse_ibfk_2` FOREIGN KEY (`option_id`) REFERENCES `option` (`option_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `sondage`
--
ALTER TABLE `sondage`
  ADD CONSTRAINT `sondage_ibfk_1` FOREIGN KEY (`ut_id`) REFERENCES `utilisateur` (`ut_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `sondage_ibfk_2` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`groupe_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ss_commentaire`
--
ALTER TABLE `ss_commentaire`
  ADD CONSTRAINT `ss_commentaire_ibfk_1` FOREIGN KEY (`com_id`) REFERENCES `commentaire` (`com_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `ss_commentaire_ibfk_2` FOREIGN KEY (`ut_id`) REFERENCES `utilisateur` (`ut_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
