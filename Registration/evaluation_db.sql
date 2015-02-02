-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2014 at 08:09 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

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
`id` int(20) NOT NULL,
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
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `evaluation_data`
--

INSERT INTO `evaluation_data` (`id`, `student_no`, `Rating_Period_Start`, `Rating_Period_End`, `name_of_faculty`, `evaluators_type`, `a1`, `a2`, `a3`, `a4`, `a5`, `b1`, `b2`, `b3`, `b4`, `b5`, `c1`, `c2`, `c3`, `c4`, `c5`, `d1`, `d2`, `d3`, `d4`, `d5`, `totala`, `totalb`, `totalc`, `totald`, `Name_of_evaluator`, `Position_of_evaluator`, `date`) VALUES
(1, '116500', '0000-00-00', '0000-00-00', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `faclogin`
--

CREATE TABLE IF NOT EXISTS `faclogin` (
`login_id` int(200) NOT NULL,
  `instructorID` int(200) NOT NULL,
  `status` int(20) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `faclogin`
--

INSERT INTO `faclogin` (`login_id`, `instructorID`, `status`, `username`, `password`) VALUES
(1, 1, 1, 'santi', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE IF NOT EXISTS `instructor` (
`instructorID` int(11) NOT NULL,
  `FName` varchar(50) NOT NULL,
  `LName` varchar(50) NOT NULL,
  `MName` varchar(20) NOT NULL,
  `FullName` varchar(150) NOT NULL,
  `studentCount` int(20) NOT NULL,
  `peerCount` int(20) NOT NULL,
  `selfCount` int(20) NOT NULL,
  `supervCount` int(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`instructorID`, `FName`, `LName`, `MName`, `FullName`, `studentCount`, `peerCount`, `selfCount`, `supervCount`) VALUES
(1, 'Santiago', 'Santiago', 'S.', 'Santiago, Santiago S.', 0, 0, 0, 0),
(2, 'Marlon', 'Yutiga', 'G.', 'Yutiga, Marlon G.', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
`id` int(11) NOT NULL,
  `instructor` varchar(100) NOT NULL,
  `start` varchar(50) NOT NULL,
  `end` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `instructor`, `start`, `end`) VALUES
(1, 'Kristine E. Decano', 'June 16,2014', 'August 15,2014');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE IF NOT EXISTS `signup` (
`studentID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `confirmation` int(11) NOT NULL,
  `logged_in` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=9 ;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`studentID`, `username`, `password`, `type`, `confirmation`, `logged_in`) VALUES
(1, '603913', ' 12', ' Student', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
`studentID` int(11) NOT NULL,
  `StudentNo` varchar(50) NOT NULL,
  `FName` varchar(50) NOT NULL,
  `MName` varchar(50) NOT NULL,
  `LName` varchar(50) NOT NULL,
  `FullName` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `StudentNo`, `FName`, `MName`, `LName`, `FullName`) VALUES
(1, '603913', 'James Bryan', 'Borromeo', 'Grutas', 'Grutas, James Bryan B.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `evaluation_data`
--
ALTER TABLE `evaluation_data`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faclogin`
--
ALTER TABLE `faclogin`
 ADD PRIMARY KEY (`login_id`), ADD KEY `instructorID` (`instructorID`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
 ADD PRIMARY KEY (`instructorID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
 ADD PRIMARY KEY (`studentID`), ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`studentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `evaluation_data`
--
ALTER TABLE `evaluation_data`
MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `faclogin`
--
ALTER TABLE `faclogin`
MODIFY `login_id` int(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
MODIFY `instructorID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `faclogin`
--
ALTER TABLE `faclogin`
ADD CONSTRAINT `faclogin_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `instructor` (`instructorID`) ON UPDATE CASCADE,
ADD CONSTRAINT `faclogin_ibfk_2` FOREIGN KEY (`instructorID`) REFERENCES `instructor` (`instructorID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
