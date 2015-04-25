-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2015 at 12:54 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `baseball`
--

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE IF NOT EXISTS `player` (
  `playerId` int(11) NOT NULL AUTO_INCREMENT,
  `fname` text,
  `lname` text,
  `team` text,
  `position` text,
  `number` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`playerId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`playerId`, `fname`, `lname`, `team`, `position`, `number`) VALUES
(34, 'Hank', 'Aaron', 'Braves', 'Right Fielder', 44),
(35, 'Andrew', 'McCutchen', 'Pirates', 'Center Fielder', 23),
(37, 'Mike', 'Piazza', 'Mets', 'Catcher', 31),
(42, 'Yadier', 'Molina', 'Cardinals', 'Catcher', 4);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE IF NOT EXISTS `salary` (
  `salaryId` int(11) NOT NULL DEFAULT '0',
  `playerId` int(11) DEFAULT NULL,
  `salary` text,
  `year` int(11) DEFAULT NULL,
  PRIMARY KEY (`salaryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`salaryId`, `playerId`, `salary`, `year`) VALUES
(1, 1, '$10,571,429', 2002);

-- --------------------------------------------------------

--
-- Table structure for table `stat`
--

CREATE TABLE IF NOT EXISTS `stat` (
  `statId` int(11) NOT NULL DEFAULT '0',
  `playerId` int(11) DEFAULT NULL,
  `battingAverage` float DEFAULT NULL,
  `homeruns` int(11) DEFAULT NULL,
  `rbis` int(11) DEFAULT NULL,
  PRIMARY KEY (`statId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stat`
--

INSERT INTO `stat` (`statId`, `playerId`, `battingAverage`, `homeruns`, `rbis`) VALUES
(1, 1, 0.308, 427, 1335),
(2, 17, 0.5, 500, 1000);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
