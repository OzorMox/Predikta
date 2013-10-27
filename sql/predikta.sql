-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: magma.dns-systems.net
-- Generation Time: Oct 27, 2013 at 09:20 PM
-- Server version: 5.1.69
-- PHP Version: 5.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jkhemming_prd`
--

-- --------------------------------------------------------

--
-- Table structure for table `bruciesays`
--

CREATE TABLE IF NOT EXISTS `bruciesays` (
  `bruciesays_id` int(10) NOT NULL AUTO_INCREMENT,
  `bruciesays` varchar(5000) COLLATE latin1_general_ci NOT NULL,
  `user` int(100) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`bruciesays_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE IF NOT EXISTS `games` (
  `game_id` int(10) NOT NULL AUTO_INCREMENT,
  `team_1` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `team_2` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `actual_1` int(10) NOT NULL DEFAULT '0',
  `actual_2` int(10) NOT NULL DEFAULT '0',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `type` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`game_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `halloffame`
--

CREATE TABLE IF NOT EXISTS `halloffame` (
  `entry_id` int(10) NOT NULL AUTO_INCREMENT,
  `entry` varchar(5000) COLLATE latin1_general_ci NOT NULL,
  `awardedto` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `awardedby` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`entry_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `log_id` int(10) NOT NULL AUTO_INCREMENT,
  `action` text COLLATE latin1_general_ci NOT NULL,
  `user` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(10) NOT NULL AUTO_INCREMENT,
  `message` text COLLATE latin1_general_ci NOT NULL,
  `user` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `player_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `password` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `email` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `send_reminder_email` tinyint(1) DEFAULT '0',
  `avatar` text COLLATE latin1_general_ci NOT NULL,
  `admin` int(10) NOT NULL DEFAULT '0',
  `brucies` int(10) NOT NULL DEFAULT '0',
  `july` int(10) NOT NULL DEFAULT '0',
  `august` int(10) NOT NULL DEFAULT '0',
  `september` int(10) NOT NULL DEFAULT '0',
  `october` int(10) NOT NULL DEFAULT '0',
  `november` int(10) NOT NULL DEFAULT '0',
  `december` int(10) NOT NULL DEFAULT '0',
  `january` int(10) NOT NULL DEFAULT '0',
  `february` int(10) NOT NULL DEFAULT '0',
  `march` int(10) NOT NULL DEFAULT '0',
  `april` int(10) NOT NULL DEFAULT '0',
  `may` int(10) NOT NULL DEFAULT '0',
  `june` int(10) NOT NULL DEFAULT '0',
  `bonus` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`player_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `result_id` int(10) NOT NULL AUTO_INCREMENT,
  `score_1` int(10) NOT NULL DEFAULT '0',
  `score_2` int(10) NOT NULL DEFAULT '0',
  `brucie` int(10) NOT NULL DEFAULT '0',
  `game_id` int(10) NOT NULL DEFAULT '0',
  `player_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`result_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
