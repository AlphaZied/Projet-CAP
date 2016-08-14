-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 15 Août 2016 à 01:46
-- Version du serveur :  5.6.17-log
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `extrageo`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` varchar(255) NOT NULL,
  `texte` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `auteur`, `description`, `date`, `texte`) VALUES
(1, 'Test', 'Anti', 'Une petite description :)', '14/08/2016', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

-- --------------------------------------------------------

--
-- Structure de la table `passrecover`
--

CREATE TABLE IF NOT EXISTS `passrecover` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `cle` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `timestamp` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `passrecover`
--

INSERT INTO `passrecover` (`id`, `email`, `cle`, `userid`, `timestamp`) VALUES
(12, 'officialwhabbu@gmail.com', 'ua2YsJPcBEizgpvliZ4d3Q4qlX7GxM', 2, '1471300527');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

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
  `grade` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `lvl`, `email`, `mdp`, `exp`, `pdp`, `score`, `amis`, `ip`, `inscription`, `last_connect`, `rank`, `grade`) VALUES
(2, 'Shamane', 1, 'officialwhabbu@gmail.com', '123456', 0, NULL, '0', NULL, '::1', '1468706225', '1471199480', 1, 1),
(3, 'Shamanedqs', 1, 'dff@jd.fr', '123456', 0, NULL, '0', NULL, '::1', '1471188373', '1471188373', 1, 0),
(4, 'Shamane2', 1, 'qddfq@js.fr', '123456', 0, NULL, '0', NULL, '::1', '1471188525', '1471188525', 1, 0),
(5, 'Shamane3', 1, 'fdf@js.fr', '123456', 0, NULL, '0', NULL, '::1', '1471189166', '1471189166', 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
