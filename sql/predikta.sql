-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 10, 2010 at 12:11 AM
-- Server version: 5.1.30
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `predikta`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE IF NOT EXISTS `games` (
  `game_id` int(10) NOT NULL AUTO_INCREMENT,
  `game_1` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `game_2` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `actual_1` int(10) NOT NULL,
  `actual_2` int(10) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `type` varchar(10) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`game_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC AUTO_INCREMENT=49 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=485 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=66 ;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `player_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(100) COLLATE latin1_general_ci NOT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=58 ;
