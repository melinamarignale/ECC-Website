-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 04 Octobre 2010 à 12:48
-- Version du serveur: 5.1.41
-- Version de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ez_designdo`
--

-- --------------------------------------------------------

--
-- Structure de la table `do_sitemap`
--

CREATE TABLE IF NOT EXISTS `do_sitemap` (
  `dosm_id` int(10) unsigned NOT NULL auto_increment COMMENT 'Primary key',
  `dosm_loc` text NOT NULL COMMENT 'Url',
  `dosm_lastmod` date NOT NULL default '0000-00-00' COMMENT 'Last modification',
  `dosm_changefreq` varchar(20) NOT NULL default 'weekly' COMMENT 'Change frequency',
  `dosm_priority` float NOT NULL default '0.5' COMMENT 'Priority',
  `dosm_insertedDate` timestamp NOT NULL default CURRENT_TIMESTAMP COMMENT 'Date of insert',
  `dosm_updatedDate` timestamp NOT NULL default '0000-00-00 00:00:00' COMMENT 'Date of last update',
  PRIMARY KEY  (`dosm_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
