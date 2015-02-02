-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2014 at 04:37 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `evaluation_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_data`
--

CREATE TABLE IF NOT EXISTS `evaluation_data` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `student_no` varchar(100) NOT NULL,
  `Rating_Period_Start` date NOT NULL,
  `Rating_Period_End` date NOT NULL,
  `name_of_faculty` varchar(100) NOT NULL,
  `evaluators_type` varchar(100) NOT NULL,
  `a1` int(20) NOT NULL,
  `a2` int(20) NOT NULL,
  `a3` int(20) NOT NULL,
  `a4` int(20) NOT NULL,
  `a5` int(20) NOT NULL,
  `b1` int(20) NOT NULL,
  `b2` int(20) NOT NULL,
  `b3` int(20) NOT NULL,
  `b4` int(20) NOT NULL,
  `b5` int(20) NOT NULL,
  `c1` int(20) NOT NULL,
  `c2` int(20) NOT NULL,
  `c3` int(20) NOT NULL,
  `c4` int(20) NOT NULL,
  `c5` int(20) NOT NULL,
  `d1` int(20) NOT NULL,
  `d2` int(20) NOT NULL,
  `d3` int(20) NOT NULL,
  `d4` int(20) NOT NULL,
  `d5` int(20) NOT NULL,
  `totala` int(20) NOT NULL,
  `totalb` int(20) NOT NULL,
  `totalc` int(20) NOT NULL,
  `totald` varchar(100) NOT NULL,
  `Name_of_evaluator` varchar(100) NOT NULL,
  `Position_of_evaluator` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE IF NOT EXISTS `instructor` (
  `instructorID` int(11) NOT NULL AUTO_INCREMENT,
  `FName` varchar(50) NOT NULL,
  `MName` varchar(50) NOT NULL,
  `LName` varchar(50) NOT NULL,
  `FullName` varchar(50) NOT NULL,
  `supervisorCount` int(11) NOT NULL,
  `peerCount` int(11) NOT NULL,
  `selfCount` int(11) NOT NULL,
  `studentsCount` int(11) NOT NULL,
  PRIMARY KEY (`instructorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` varchar(40) NOT NULL,
  `end` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE IF NOT EXISTS `signup` (
  `studentno` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `corfirmation` int(11) DEFAULT NULL,
  PRIMARY KEY (`studentno`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45746880 ;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `studentID` int(11) NOT NULL AUTO_INCREMENT,
  `FName` varchar(50) NOT NULL,
  `MName` varchar(50) NOT NULL,
  `LName` varchar(50) NOT NULL,
  `FullName` varchar(50) NOT NULL,
  `StudentNo` varchar(50) NOT NULL,
  PRIMARY KEY (`studentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
