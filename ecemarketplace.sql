-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 27 mai 2021 à 14:15
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
-- Base de données : `ece-marketplace`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id_article` int(11) NOT NULL AUTO_INCREMENT,
  `id_vendeur` int(10) NOT NULL,
  `type_article` int(10) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `prix` int(10) NOT NULL,
  `photo1` varchar(255) NOT NULL,
  `photo2` varchar(255) NOT NULL,
  `photo3` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  PRIMARY KEY (`id_article`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id_article`, `id_vendeur`, `type_article`, `Nom`, `prix`, `photo1`, `photo2`, `photo3`, `video`, `description`) VALUES
(1, 8, 1, 'Une Calculatrice', 50, '', '', '', '', 'Calculatrice Casio type collège en bonne état'),
(2, 8, 1, 'Montre', 200, '', '', '', '', 'Montre cartier avec un bracelet en cuir. ');

-- --------------------------------------------------------

--
-- Structure de la table `carte`
--

DROP TABLE IF EXISTS `carte`;
CREATE TABLE IF NOT EXISTS `carte` (
  `id_carte` int(11) NOT NULL AUTO_INCREMENT,
  `titulaire` varchar(255) NOT NULL,
  `numero` int(11) NOT NULL,
  `date` date NOT NULL,
  `pictogramme` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id_carte`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

DROP TABLE IF EXISTS `enchere`;
CREATE TABLE IF NOT EXISTS `enchere` (
  `id_enchere` int(11) NOT NULL AUTO_INCREMENT,
  `id_articles` int(10) NOT NULL,
  `id_clientmax` int(10) NOT NULL,
  `prix_max` int(10) NOT NULL,
  `prix_inf` int(10) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  PRIMARY KEY (`id_enchere`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

DROP TABLE IF EXISTS `historique`;
CREATE TABLE IF NOT EXISTS `historique` (
  `id_historique` int(11) NOT NULL AUTO_INCREMENT,
  `id_articles` int(11) NOT NULL,
  `Nom_articles` varchar(250) NOT NULL,
  `dates de vents` date NOT NULL,
  `prix de ventes` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `Nom_client` varchar(250) NOT NULL,
  `id_vendeur` int(11) NOT NULL,
  `Nom_vendeur` varchar(250) NOT NULL,
  PRIMARY KEY (`id_historique`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `historique`
--

INSERT INTO `historique` (`id_historique`, `id_articles`, `Nom_articles`, `dates de vents`, `prix de ventes`, `id_client`, `Nom_client`, `id_vendeur`, `Nom_vendeur`) VALUES
(1, 1, 'Calculatrice', '2021-05-25', 50, 7, 'Client', 8, 'Vendeur'),
(2, 2, 'montre', '2021-05-12', 200, 7, 'Client', 8, 'Vendeur');

-- --------------------------------------------------------

--
-- Structure de la table `negociation`
--

DROP TABLE IF EXISTS `negociation`;
CREATE TABLE IF NOT EXISTS `negociation` (
  `id_negociation` int(11) NOT NULL AUTO_INCREMENT,
  `id_articles` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `dernier_prix_client` int(11) NOT NULL,
  `dernier_prix_vendeur` int(11) NOT NULL,
  `compteur` int(11) NOT NULL,
  PRIMARY KEY (`id_negociation`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `photo` varchar(510) NOT NULL,
  `id_adresse` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `mail`, `numero`, `mdp`, `type`, `photo`, `id_adresse`) VALUES
(1, 'Baptista', 'Alexandre', 'alexandre.deoliveirabaptista@edu.ece.fr', '0662466383', 'motdepasse', 3, '', '0'),
(6, 'Alexandre DE OLIVEIRA BAPTISTA', 'Alexandre', 'alex.baptista92@gmail.com', '56468284', 'mdp', 1, '0', '0'),
(7, 'client', 'client', 'client.client', '01', 'client', 1, '', 'rue client'),
(8, 'vendeur', 'vendeur', 'vendeur.vendeur', '02', 'vendeur', 2, '', ''),
(9, 'admin', 'admin', 'admin.admin', '03', 'admin', 3, '', '0'),
(10, '', '', '', '0', '', 1, '0', '0'),
(11, '', '', '', '0', '', 1, '0', '0'),
(12, 'tt', 'tt', 'tt', '1', 'tt', 1, '0', 'tt'),
(13, 'ttt', 'ttt', 'ttt', '1', 'ttt', 1, '0', 'ttt');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
