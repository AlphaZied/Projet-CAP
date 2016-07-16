-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 16 Juillet 2016 à 22:03
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `extrageo`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL,
  `lvl` int(11) NOT NULL DEFAULT '1',
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `exp` int(11) NOT NULL DEFAULT '0',
  `pdp` varchar(255) DEFAULT NULL,
  `score` varchar(50) NOT NULL DEFAULT '0',
  `amis` text,
  `ip` varchar(255) NOT NULL,
  `inscription` varchar(255) NOT NULL,
  `last_connect` varchar(255) NOT NULL,
  `rank` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `lvl`, `email`, `mdp`, `exp`, `pdp`, `score`, `amis`, `ip`, `inscription`, `last_connect`, `rank`) VALUES
(2, 'Shamane', 1, 'yu@sk.fr', '123456', 0, NULL, '0', NULL, '::1', '1468706225', '1468706225', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
