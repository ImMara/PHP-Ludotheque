-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 21 sep. 2020 à 12:27
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ludotheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

DROP TABLE IF EXISTS `jeux`;
CREATE TABLE IF NOT EXISTS `jeux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(120) NOT NULL,
  `id_support` int(11) NOT NULL,
  `pochette` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `editeur` varchar(60) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_support` (`id_support`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `jeux`
--

INSERT INTO `jeux` (`id`, `nom`, `id_support`, `pochette`, `description`, `editeur`, `type`) VALUES
(1, 'League of Legends', 1, 'lol.jpg\r\n', 'Inspiré du mod DotA (Defense of the Ancients) de Warcraft III, League of Legends est un MOBA, une arène de bataille en ligne multijoueur. Dans le mode classique, deux équipes de cinq joueurs s\'affrontent dans des parties qui durent en moyenne entre 40 minutes et dont l\'objectif est de détruire la base ennemie. Évoluant dans un univers heroic-fantasy, chaque joueur incarne un champion différent, aux capacités uniques, qu\'il choisit à chaque début de partie. Des modes aléatoires sont également présents, ainsi que des événements saisonniers qui apportent un souffle de nouveauté.', 'Riot Games ', 'Stratégie,MOBA '),
(2, 'Red Dead Redemption', 2, 'red.jpg', 'Suite du précédent volet multi récompensé, Red Dead Redemption II nous permet de nous replonger sur PS4 dans une ambiance western synonyme de vastes espaces sauvages et de villes malfamées. L\'histoire se déroule en 1899, avant le premier Red Dead Redemption, au moment où Arthur Morgan doit fuir avec sa bande à la suite d\'un braquage raté.', 'Rockstar Games ', 'Action,TPS,Aventure ');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `id_membre` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(60) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  KEY `id_membre` (`id_membre`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `login`, `password`, `email`) VALUES
(1, 'admin', '$2y$10$u.s5AfJoVdiLDQpZYF0wtuogIR4u.mWPl17kVC8KqXOHtO2afpZQ6', 'alaneraerts@live.be');

-- --------------------------------------------------------

--
-- Structure de la table `support`
--

DROP TABLE IF EXISTS `support`;
CREATE TABLE IF NOT EXISTS `support` (
  `id_support` int(11) NOT NULL AUTO_INCREMENT,
  `support` varchar(60) NOT NULL,
  PRIMARY KEY (`id_support`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `support`
--

INSERT INTO `support` (`id_support`, `support`) VALUES
(1, 'pc'),
(2, 'ps4'),
(3, 'Xbox One'),
(4, 'Nintendo Switch');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `jeux`
--
ALTER TABLE `jeux`
  ADD CONSTRAINT `jeux_ibfk_1` FOREIGN KEY (`id_support`) REFERENCES `support` (`id_support`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
