-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 27 sep. 2020 à 13:53
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ludotheque`
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
  `description` text,
  `editeur` varchar(60) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_support` (`id_support`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `jeux`
--

INSERT INTO `jeux` (`id`, `nom`, `id_support`, `pochette`, `description`, `editeur`, `type`) VALUES
(1, 'League of Legends', 1, '555980763lol.jpg', 'Inspiré du mod DotA (Defense of the Ancients) de Warcraft III, League of Legends est un MOBA, une arène de bataille en ligne multijoueur. Dans le mode classique, deux équipes de cinq joueurs s\'affrontent dans des parties qui durent en moyenne entre 40 minutes et dont l\'objectif est de détruire la base ennemie. Évoluant dans un univers heroic-fantasy, chaque joueur incarne un champion différent, aux capacités uniques, qu\'il choisit à chaque début de partie. Des modes aléatoires sont également présents, ainsi que des événements saisonniers qui apportent un souffle de nouveauté.', 'Riot Games ', 'Stratégie,MOBA '),
(2, 'Red Dead Redemption 2', 2, '1330131746red.jpg', 'Suite du précédent volet multi récompensé, Red Dead Redemption II nous permet de nous replonger sur PS4 dans une ambiance western synonyme de vastes espaces sauvages et de villes malfamées. L\'histoire se déroule en 1899, avant le premier Red Dead Redemption, au moment où Arthur Morgan doit fuir avec sa bande à la suite d\'un braquage raté.', 'Rockstar Games ', 'Action,TPS,Aventure '),
(3, 'Tekken 7', 1, '507388125t7.jpg', 'Tekken 7 est le septième épisode de la série de jeux de combat éponyme. Cet épisode comprend d\'anciens personnages de la série, mais également de nouvelles têtes telles que Katarina, Claudio et d\'autres encore...', 'Bandai Namco ', 'Combat '),
(4, 'Valorant', 1, '1310990893val.jpg', 'Valorant, anciennement Project A, est un FPS tactique dans la veine de Counter Strike et de Team Fortress. Le jeu développé et édité par Riot Games proposera de nombreux personnages aux capacités uniques, différents modes de jeu et promet déjà des serveurs sans failles et un système anti-triche à la pointe de la technologie.', 'Riot Games ', 'FPS Tactique '),
(5, 'Legends of Runeterra', 1, '1654947872rune.jpg', 'Legends of Runeterra (LoR) est un jeu de cartes de stratégie gratuit se déroulant dans le monde de LoL. LoR inclut des cartes inspirées de champions mythiques de LoL, ainsi que de nouveaux alliés et personnages issus des régions de Runeterra, possédant chacun leur propre style et atouts stratégiques.', 'Riot Games', 'Cartes'),
(6, 'Space Engineers', 1, '820725739space.jpg', 'La survie dans l\'espace ou sur des planètes étrangères est au cœur de Space Engineers qui vous propose une large gamme de ressources à récolter et d\'objets à construire, tout ça dans le but de survivre le plus longtemps possible au milieu du grand vide intersidéral.', 'Keen Software ', 'Gestion Création Simulation Survie '),
(16, 'Final Fantasy XIV', 1, '247872558images.jpg', 'Final Fantasy XIV : A Realm Reborn est un jeu de rôle en ligne massivement multijoueur sur PC dont l\'univers heroïc fantasy prend place dans la région d\'Eorzéa. Le joueur a le choix entre 5 races disponibles pour créer son personnage. La progression est basée sur un système d\'armement offrant une grande flexibilité au niveau des 4 disciplines du jeu : guerre, magie, terre et main, qu\'il est possible de faire évoluer à sa convenance.', 'Square Enix', 'MMO RPG '),
(18, 'Lethal League', 1, '435249096lethal-league-blaze.jpg', 'Lethal League Blaze est la suite de Lethal League sorti en 2014 et développé par le studio Team Reptile. Il s\'agit de se renvoyer un projectile à coup de battes de baseball jusqu\'au moment ou l\'adversaire rate son coup et se fait expulser du terrain.', 'Team Reptile', 'combat'),
(19, 'For Honor', 1, '448501420images.jpg', 'For Honor est un TPS à l\'ère médiévale, où les joueurs peuvent incarner un chevalier, un viking ou un samouraï et affronter leurs adversaires dans un mode solo ou un multijoueur compétitif. Chaque faction possède ses propres particularités et avantages.', 'Ubisoft Montreal Ubisoft ', ' Action ');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `login`, `password`, `email`) VALUES
(1, 'admin', '$2y$10$u.s5AfJoVdiLDQpZYF0wtuogIR4u.mWPl17kVC8KqXOHtO2afpZQ6', 'alaneraerts@live.be'),
(2, 'test', 'test', '');

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
