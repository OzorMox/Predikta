-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 28, 2021 at 12:44 AM
-- Server version: 10.0.38-MariaDB-0+deb8u1
-- PHP Version: 7.3.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `predikta`
--

-- --------------------------------------------------------

--
-- Table structure for table `bruciesays`
--

CREATE TABLE `bruciesays` (
  `bruciesays_id` int(10) NOT NULL,
  `bruciesays` varchar(5000) COLLATE latin1_general_ci NOT NULL,
  `user` int(100) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `game_id` int(10) NOT NULL,
  `team_1` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `team_2` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `actual_1` int(10) NOT NULL DEFAULT '0',
  `actual_2` int(10) NOT NULL DEFAULT '0',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `type` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `halloffame`
--

CREATE TABLE `halloffame` (
  `entry_id` int(10) NOT NULL,
  `entry` varchar(5000) COLLATE latin1_general_ci NOT NULL,
  `awardedto` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `awardedby` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `log_id` int(10) NOT NULL,
  `action` text COLLATE latin1_general_ci NOT NULL,
  `user` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(10) NOT NULL,
  `message` text COLLATE latin1_general_ci NOT NULL,
  `user` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `player_id` int(10) NOT NULL,
  `name` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `password` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `email` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `send_reminder_email` tinyint(1) DEFAULT '0',
  `avatar` text COLLATE latin1_general_ci NOT NULL,
  `admin` int(10) NOT NULL DEFAULT '0',
  `competition` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT '',
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
  `groupstage` int(10) NOT NULL DEFAULT '0',
  `knockout` int(10) NOT NULL DEFAULT '0',
  `bonus` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `result_id` int(10) NOT NULL,
  `score_1` int(10) NOT NULL DEFAULT '0',
  `score_2` int(10) NOT NULL DEFAULT '0',
  `brucie` int(10) NOT NULL DEFAULT '0',
  `game_id` int(10) NOT NULL DEFAULT '0',
  `player_id` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bruciesays`
--
ALTER TABLE `bruciesays`
  ADD PRIMARY KEY (`bruciesays_id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `halloffame`
--
ALTER TABLE `halloffame`
  ADD PRIMARY KEY (`entry_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`player_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`result_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bruciesays`
--
ALTER TABLE `bruciesays`
  MODIFY `bruciesays_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `halloffame`
--
ALTER TABLE `halloffame`
  MODIFY `entry_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `player_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `result_id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
