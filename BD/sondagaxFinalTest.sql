-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Lun 28 Avril 2014 à 00:01
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
  `com_parent_id` int(10) unsigned DEFAULT NULL,
  `ut_id` int(10) unsigned NOT NULL,
  `sondage_id` int(10) unsigned NOT NULL,
  `soutien` int(10) NOT NULL DEFAULT '0',
  `texte` text COLLATE utf8_unicode_ci NOT NULL,
  `commentaire_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`com_id`),
  KEY `ut_id` (`ut_id`),
  KEY `sondage_id` (`sondage_id`),
  KEY `com_parent_id` (`com_parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=67 ;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`com_id`, `com_parent_id`, `ut_id`, `sondage_id`, `soutien`, `texte`, `commentaire_date`) VALUES
(60, NULL, 48, 46, 3, 'Moi j''aime bien les PC et je suis un Pokemon legendaire', '2014-04-27 19:36:49'),
(62, 60, 48, 46, 1, 'J''ai mis un j''aime a mon propre commentaire HAHA', '2014-04-27 19:38:09'),
(63, 60, 47, 46, 0, 'Tu n''est pas marrant', '2014-04-27 19:40:28'),
(64, NULL, 47, 46, 0, 'Je peux supprimer les commentaires c''est moi le patron ici', '2014-04-27 19:41:01');

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
  `parent_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`groupe_id`),
  KEY `ut_id` (`ut_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`groupe_id`, `groupe_nom`, `groupe_date_creation`, `groupe_droit`, `ut_id`, `groupe_desc`, `parent_id`) VALUES
(25, 'Groupe A L3 info', '2014-04-27 19:28:58', 0, 47, 'Le groupe A de la l3 informatique de montpellier', NULL),
(26, 'Groupe Footballeur', '2014-04-27 21:10:02', 0, 49, 'Ce groupe est un groupe de footeux', NULL),
(27, 'Groupe Professeurs', '2014-04-27 21:10:33', 2, 49, 'Groupe de professeurs de l''um2', NULL),
(28, 'Groupe de fetard', '2014-04-27 21:11:37', 1, 49, 'on aime faire la fête , fais une demande pour nous rejoindre', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `inscrit`
--

CREATE TABLE IF NOT EXISTS `inscrit` (
  `ut_id` int(10) unsigned NOT NULL,
  `groupe_id` int(10) unsigned NOT NULL,
  `date_inscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `inscrit_valide` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ut_id`,`groupe_id`),
  KEY `groupe_id` (`groupe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `inscrit`
--

INSERT INTO `inscrit` (`ut_id`, `groupe_id`, `date_inscription`, `inscrit_valide`) VALUES
(47, 25, '2014-04-27 19:28:58', 1),
(47, 27, '2014-04-27 21:48:54', 1),
(49, 25, '2014-04-27 21:22:26', 1),
(49, 26, '2014-04-27 21:10:02', 1),
(49, 27, '2014-04-27 21:10:33', 1),
(49, 28, '2014-04-27 21:11:37', 1),
(50, 25, '2014-04-27 21:36:21', 1),
(50, 26, '2014-04-27 21:35:49', 1),
(50, 27, '2014-04-27 21:28:07', 1),
(50, 28, '2014-04-27 21:35:36', 0);

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

--
-- Contenu de la table `moderateur_groupe`
--

INSERT INTO `moderateur_groupe` (`ut_id`, `groupe_id`) VALUES
(47, 27);

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
(49, 46),
(49, 47),
(47, 48),
(48, 48),
(50, 48),
(49, 49);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=77 ;

--
-- Contenu de la table `option`
--

INSERT INTO `option` (`option_id`, `sondage_id`, `titre`) VALUES
(57, 45, 'Montpellier'),
(58, 45, 'Marseille'),
(59, 45, 'Nice'),
(60, 45, 'Toulouse'),
(61, 45, 'Nimes'),
(62, 46, 'PC'),
(63, 46, 'Mac'),
(64, 47, 'Etudiant 1'),
(65, 47, 'Etudiant 2'),
(66, 47, 'Etudiant 3'),
(67, 47, 'Etudiant 4'),
(68, 47, 'Etudiant 5'),
(69, 47, 'Etudiant 6'),
(70, 47, 'Etudiant 7'),
(71, 48, 'C++'),
(72, 48, 'C'),
(73, 49, 'Mediocre'),
(74, 49, 'Passable'),
(75, 49, 'Il y a mieux'),
(76, 49, 'le top du top');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE IF NOT EXISTS `reponse` (
  `ut_id` int(10) unsigned NOT NULL,
  `option_id` int(10) unsigned NOT NULL,
  `rang` int(15) NOT NULL,
  `sondage_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ut_id`,`option_id`,`sondage_id`),
  KEY `reponse_ibfk_2` (`option_id`),
  KEY `sondage_id` (`sondage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `reponse`
--

INSERT INTO `reponse` (`ut_id`, `option_id`, `rang`, `sondage_id`) VALUES
(48, 62, 2, 46),
(48, 63, 1, 46),
(49, 62, 2, 46),
(49, 63, 1, 46);

-- --------------------------------------------------------

--
-- Structure de la table `reponseanonyme`
--

CREATE TABLE IF NOT EXISTS `reponseanonyme` (
  `sondage_id` int(10) unsigned NOT NULL,
  `option_id` int(10) unsigned NOT NULL,
  `rang` int(15) NOT NULL,
  `vote_id` int(10) unsigned NOT NULL,
  KEY `sondage_id` (`sondage_id`,`option_id`),
  KEY `option_id` (`option_id`),
  KEY `vote_id` (`vote_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `reponseanonyme`
--

INSERT INTO `reponseanonyme` (`sondage_id`, `option_id`, `rang`, `vote_id`) VALUES
(45, 57, 1, 1),
(45, 58, 2, 1),
(45, 59, 3, 1),
(45, 60, 4, 1),
(45, 61, 5, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=50 ;

--
-- Contenu de la table `sondage`
--

INSERT INTO `sondage` (`sondage_id`, `ut_id`, `titre`, `texte_desc`, `sondage_droit`, `date_fin`, `type_methode`, `visibilite`, `groupe_id`, `sondage_date_create`) VALUES
(45, 47, 'Belle Ville', 'Classez les plus belles villes du sud de la france', 0, '2015-06-21', 0, 0, NULL, '2014-04-27 19:12:49'),
(46, 47, 'Apple vs PC', 'la guerre entre PC et Mac , quel est votre préférence ?', 1, '2014-05-10', 2, 2, NULL, '2014-04-27 19:14:23'),
(47, 47, 'Délegué', 'choix de délégué du groupe A L3 info 2013-2014', 3, '2014-05-31', 0, 0, 25, '2014-04-27 19:32:37'),
(48, 49, 'C++ ou C', 'Quelle est votre préférence', 0, '2014-04-29', 1, 1, NULL, '2014-04-27 20:00:40'),
(49, 47, 'Avis sur la fac um2', 'Votre avis sur la fac um2', 2, '2014-10-04', 0, 0, NULL, '2014-04-27 20:50:06');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=65 ;

--
-- Contenu de la table `soutien`
--

INSERT INTO `soutien` (`soutien_id`, `utilisateur_id`, `commentaire_id`) VALUES
(60, 48, 60),
(61, 47, 60),
(62, 47, 62),
(64, 49, 60);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=51 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ut_id`, `ut_nom`, `ut_prenom`, `ut_pseudo`, `ut_mail`, `ut_mdp`, `ut_date_inscription`, `ut_hash_validation`, `ut_compte_valide`) VALUES
(47, 'Baroan', 'Stephen Marc', 'Mario', 'test1@gmail.com', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '2014-04-27 19:07:12', '3d68034245d11c6087f6541194bae8e2', 1),
(48, 'Pokemon', 'Legende', 'pokemon', 'po@gmail.com', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '2014-04-27 19:17:20', 'fdf825869bc6c5f9744afe998ee723e0', 1),
(49, 'Le Roi', 'Arthur', 'King', 'king@gmail.com', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '2014-04-27 19:48:31', '160603599f0352f08f708fd9fee14489', 1),
(50, 'Pirateur', 'Martial', 'Pirate', 'kingstroyer@gmail.com', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '2014-04-27 20:47:30', 'd7808a6a80ebdf8c8c87f4ebd59752fa', 1);

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
(47, 49),
(49, 49);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`ut_id`) REFERENCES `utilisateur` (`ut_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`sondage_id`) REFERENCES `sondage` (`sondage_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commentaire_ibfk_3` FOREIGN KEY (`com_parent_id`) REFERENCES `commentaire` (`com_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `groupe_ibfk_1` FOREIGN KEY (`ut_id`) REFERENCES `utilisateur` (`ut_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `groupe_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `groupe` (`groupe_id`) ON DELETE CASCADE;

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
-- Contraintes pour la table `votant`
--
ALTER TABLE `votant`
  ADD CONSTRAINT `votant_ibfk_1` FOREIGN KEY (`ut_id`) REFERENCES `utilisateur` (`ut_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `votant_ibfk_2` FOREIGN KEY (`sondage_id`) REFERENCES `sondage` (`sondage_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
