-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 04 jan. 2020 à 15:42
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
-- Base de données :  `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
  `Email` varchar(250) NOT NULL,
  `MotDePasse` text NOT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`Email`, `MotDePasse`) VALUES
('Jonathan@Test.fr', '$2y$10$.CanssDc9kwva.JVdjWuKO9i.FBjWDXn7scHuyM0oZCBHnxq9xqfS'),
('Test@Test.fr', '$2y$10$6Sw6VBir6HmscnbpnVpGwudYwktryBSzoFiuayuyDIhnhyLl75hLS'),
('Yannic@Test.fr', '$2y$10$eXwujER6GoO0JSC4pcvTfOKFActWUqx8p7ts7WXHvaOIdvIm6E5vi');

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

DROP TABLE IF EXISTS `emprunt`;
CREATE TABLE IF NOT EXISTS `emprunt` (
  `numpersonne` int(11) NOT NULL,
  `numlivre` int(11) NOT NULL,
  `dateSortie` date NOT NULL,
  `dateRetour` date DEFAULT NULL,
  PRIMARY KEY (`numpersonne`,`numlivre`,`dateSortie`),
  KEY `numlivre` (`numlivre`),
  KEY `numpersonne` (`numpersonne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `emprunt`
--

INSERT INTO `emprunt` (`numpersonne`, `numlivre`, `dateSortie`, `dateRetour`) VALUES
(1, 1, '2020-01-04', NULL),
(2, 2, '2020-01-04', NULL),
(3, 3, '2020-01-04', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `numlivre` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(200) NOT NULL,
  `auteur` varchar(200) NOT NULL,
  `genre` enum('Roman','Poesie','Nouvelle','Bd') NOT NULL,
  `prix` int(11) NOT NULL,
  PRIMARY KEY (`numlivre`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`numlivre`, `titre`, `auteur`, `genre`, `prix`) VALUES
(1, 'Les chouans', 'Balzac', 'Roman', 80),
(2, 'Germinal', 'Zola', 'Roman', 80),
(3, 'L\'assommoir', 'Zola', 'Roman', 95),
(4, 'La bête humaine', 'Zola', 'Roman', 70),
(5, 'Les misérables', 'Hugo', 'Roman', 105),
(6, 'La peste', 'Camus', 'Roman', 112),
(7, 'Les lettres persanes', 'Maupassant', 'Roman', 140),
(8, 'Bel ami', 'Maupassant', 'Roman', 76),
(9, 'Les lettres de mon moulin', 'Daudet', 'Roman', 100),
(10, 'César', 'Pagnol', 'Roman', 100),
(11, 'Marius', 'Pagnol', 'Roman', 65),
(12, 'Fanny', 'Pagnol', 'Roman', 72),
(13, 'Les fleurs du mal', 'Baudelaire', 'Poesie', 130),
(14, 'Paroles', 'Prévert', 'Poesie', 120),
(15, 'Les raisins de la col&egrave;re', 'Steinbeck', 'Roman', 135);

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

DROP TABLE IF EXISTS `personne`;
CREATE TABLE IF NOT EXISTS `personne` (
  `numpersonne` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) NOT NULL,
  `prenom` varchar(200) NOT NULL,
  `ville` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  PRIMARY KEY (`numpersonne`),
  KEY `email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`numpersonne`, `nom`, `prenom`, `ville`, `Email`) VALUES
(1, 'Pascucci', 'Yannick', 'Nice', 'Yannic@Test.fr'),
(2, 'Di Martino', 'Jonathan', 'Nice', 'Jonathan@Test.fr'),
(3, 'Test', 'Test', 'Nice', 'Test@Test.fr');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
