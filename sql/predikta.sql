-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 27, 2013 at 10:02 PM
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

--
-- Dumping data for table `bruciesays`
--

INSERT INTO `bruciesays` (`bruciesays_id`, `bruciesays`, `user`, `datetime`) VALUES
(1, 'Hello I am Brucie', 'Player1', '2013-10-27 20:47:23');

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

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`game_id`, `team_1`, `team_2`, `actual_1`, `actual_2`, `date`, `status`, `type`) VALUES
(78, 'Arsenal', 'Crystal Palace', 0, 0, '2013-10-27', 'set', 'weekend'),
(81, 'Aston Villa', 'Newcastle', 0, 0, '2013-10-27', 'set', 'weekend'),
(79, 'Hull', 'Southampton', 0, 0, '2013-10-27', 'set', 'weekend'),
(80, 'Man City', 'Norwich', 0, 0, '2013-10-27', 'set', 'weekend'),
(82, 'Hull', 'Newcastle', 0, 0, '2013-10-27', 'set', 'weekend'),
(83, 'Norwich', 'Swansea', 0, 0, '2013-10-27', 'set', 'weekend'),
(87, 'Arsenal', 'Crystal Palace', 0, 0, '2013-10-27', 'set', 'weekend'),
(84, 'Newcastle', 'Norwich', 0, 0, '2013-10-27', 'set', 'weekend'),
(85, 'Man Utd', 'Chelsea', 0, 0, '2013-10-27', 'set', 'weekend'),
(86, 'Stoke', 'Everton', 0, 0, '2013-10-27', 'set', 'weekend'),
(88, 'Cardiff', 'Norwich', 0, 0, '2013-10-27', 'set', 'weekend'),
(89, 'Chelsea', 'Southampton', 0, 0, '2013-10-27', 'set', 'weekend'),
(90, 'Cardiff', 'Man City', 0, 0, '2013-10-27', 'set', 'weekend'),
(91, 'Swansea', 'West Ham', 0, 0, '2013-10-27', 'set', 'weekend'),
(92, 'Chelsea', 'Stoke', 0, 0, '2013-10-27', 'set', 'weekend'),
(93, 'West Brom', 'Tottenham', 0, 0, '2013-10-27', 'set', 'weekend'),
(94, 'Hull', 'Man Utd', 0, 0, '2013-10-27', 'set', 'weekend'),
(95, 'Arsenal', 'Arsenal', 0, 0, '2013-10-28', 'open', 'weekend'),
(96, 'Arsenal', 'Arsenal', 0, 0, '2013-10-28', 'open', 'weekend'),
(97, 'Aston Villa', 'Man Utd', 0, 0, '2013-10-27', 'locked', 'weekend'),
(98, 'Everton', 'Newcastle', 0, 0, '2013-11-27', 'open', 'weekend');

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

--
-- Dumping data for table `halloffame`
--

INSERT INTO `halloffame` (`entry_id`, `entry`, `awardedto`, `awardedby`, `datetime`) VALUES
(2, 'Something good', 'Player1', 'Player1', '2013-10-27 21:42:46'),
(3, 'Something very good', 'PLayer2', 'Player1', '2013-10-27 21:42:57');

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

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`log_id`, `action`, `user`, `datetime`) VALUES
(853, 'Added Hall Of Fame entry', 'Player1', '2013-10-27 21:41:38'),
(854, 'Deleted hall of fame entry: 1', 'Player1', '2013-10-27 21:42:38'),
(855, 'Added Hall Of Fame entry', 'Player1', '2013-10-27 21:42:46'),
(856, 'Added Hall Of Fame entry', 'Player1', '2013-10-27 21:42:57'),
(857, 'Logged in', 'Player2', '2013-10-27 21:44:14'),
(858, 'Logged in', 'Player2', '2013-10-27 21:44:57'),
(859, 'Logged in', 'Player2', '2013-10-27 21:45:39');

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

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `message`, `user`, `datetime`) VALUES
(66, 'A message.', 'Player1', '2013-10-27 20:51:24'),
(67, ';', 'Player1', '2013-10-27 20:51:33');

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

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`player_id`, `name`, `password`, `email`, `send_reminder_email`, `avatar`, `admin`, `brucies`, `july`, `august`, `september`, `october`, `november`, `december`, `january`, `february`, `march`, `april`, `may`, `june`, `bonus`) VALUES
(14, 'Admin', 'admin', NULL, 0, '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 'Player1', 'player1', NULL, 0, '', 1, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 'Player2', 'default', NULL, 0, '', 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(34, 'Brucie', 'default', NULL, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`result_id`, `score_1`, `score_2`, `brucie`, `game_id`, `player_id`) VALUES
(87, 5, 0, 1, 78, 34),
(88, 0, 0, 0, 79, 34),
(89, 3, 0, 1, 80, 34),
(90, 0, 0, 0, 81, 34),
(91, 0, 0, 0, 82, 34),
(92, 0, 1, 0, 83, 34),
(93, 1, 0, 0, 85, 34),
(94, 0, 1, 0, 84, 34),
(95, 1, 2, 0, 86, 34),
(96, 5, 0, 0, 87, 34),
(97, 1, 2, 0, 88, 34),
(98, 1, 4, 1, 90, 34),
(99, 4, 0, 1, 89, 34),
(100, 0, 0, 0, 91, 34),
(101, 3, 0, 1, 92, 34),
(102, 0, 5, 1, 94, 34),
(103, 1, 1, 0, 93, 34),
(104, 0, 0, 0, 95, 34),
(108, 1, 2, 0, 95, 16),
(106, 1, 0, 0, 96, 34),
(109, 0, 3, 0, 97, 34),
(110, 3, 0, 0, 98, 34);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
