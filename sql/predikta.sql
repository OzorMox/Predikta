-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 27, 2013 at 10:05 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `predikta`
--

-- --------------------------------------------------------

--
-- Table structure for table `bruciesays`
--

CREATE TABLE IF NOT EXISTS `bruciesays` (
  `bruciesays_id` int(10) NOT NULL AUTO_INCREMENT,
  `bruciesays` varchar(5000) COLLATE latin1_general_ci NOT NULL,
  `user` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`bruciesays_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE IF NOT EXISTS `games` (
  `game_id` int(10) NOT NULL AUTO_INCREMENT,
  `team_1` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `team_2` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `actual_1` int(10) NOT NULL,
  `actual_2` int(10) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `type` varchar(10) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`game_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC AUTO_INCREMENT=99 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `log_id` int(10) NOT NULL AUTO_INCREMENT,
  `action` varchar(500) COLLATE latin1_general_ci NOT NULL,
  `user` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=860 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(10) NOT NULL AUTO_INCREMENT,
  `message` varchar(5000) COLLATE latin1_general_ci NOT NULL,
  `user` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=68 ;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `player_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `send_reminder_email` tinyint(1) DEFAULT '0',
  `avatar` varchar(500) COLLATE latin1_general_ci NOT NULL,
  `admin` int(10) NOT NULL,
  `brucies` int(10) NOT NULL,
  `july` int(10) NOT NULL,
  `august` int(10) NOT NULL,
  `september` int(10) NOT NULL,
  `october` int(10) NOT NULL,
  `november` int(10) NOT NULL,
  `december` int(10) NOT NULL,
  `january` int(10) NOT NULL,
  `february` int(10) NOT NULL,
  `march` int(10) NOT NULL,
  `april` int(10) NOT NULL,
  `may` int(10) NOT NULL,
  `june` int(10) NOT NULL,
  `bonus` int(10) NOT NULL,
  PRIMARY KEY (`player_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=35 ;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `result_id` int(10) NOT NULL AUTO_INCREMENT,
  `score_1` int(10) NOT NULL,
  `score_2` int(10) NOT NULL,
  `brucie` int(10) NOT NULL,
  `game_id` int(10) NOT NULL,
  `player_id` int(10) NOT NULL,
  PRIMARY KEY (`result_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=114 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
