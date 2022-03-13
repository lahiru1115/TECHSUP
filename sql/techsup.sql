-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 13, 2022 at 03:05 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techsup`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `adminId` int(5) NOT NULL AUTO_INCREMENT,
  `adminName` varchar(20) NOT NULL,
  `adminEmail` varchar(50) NOT NULL,
  `adminPwd` varchar(100) NOT NULL,
  PRIMARY KEY (`adminId`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `adminName`, `adminEmail`, `adminPwd`) VALUES
(1, 'Lahiru', 'lahirudissanayake15@gmail.com', '$2y$10$0JzsN5sBYeLpQ7xW22NGLOkrrqPWwJmqkoR5A1iyOLnnQO1uGnUlW'),
(8, 'Kavishka', 'kavishka123@gmail.com', '$2y$10$CbF0WL6nmfaNCfkhmbYtPuVfbY.eb6o0dxd6Y6rqxybJvsCg2eTRm'),
(9, 'Admin', 'admin@techsup.com', '$2y$10$Qv5X.exqJs7sQ1h9bMBMPO7O1AvdbTfTE26Wn4gLTMOTykmM25lS6');

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

DROP TABLE IF EXISTS `issue`;
CREATE TABLE IF NOT EXISTS `issue` (
  `issueId` int(5) NOT NULL AUTO_INCREMENT,
  `userId` int(5) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `timestamp` timestamp NOT NULL,
  PRIMARY KEY (`issueId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue`
--

INSERT INTO `issue` (`issueId`, `userId`, `title`, `description`, `status`, `timestamp`) VALUES
(8, 1, 'fgdfgdfg', 'hghfghdfghfghdfghfghfgh', 1, '0000-00-00 00:00:00'),
(9, 1, 'fgdfgdfg', 'hghfghdfghfghdfghfghfgh', 1, '0000-00-00 00:00:00'),
(10, 1, 'fgdfgdfg', 'hghfghdfghfghdfghfghfgh', 1, '0000-00-00 00:00:00'),
(12, 1, 'fgdfgdfg', 'hghfghdfghfghdfghfghfgh', 1, '0000-00-00 00:00:00'),
(13, 1, 'fgdfgdfg', 'hghfghdfghfghdfghfghfgh', 1, '0000-00-00 00:00:00'),
(14, 1, 'fgdfgdfg', 'hghfghdfghfghdfghfghfgh', 0, '0000-00-00 00:00:00'),
(15, 1, 'fgdfgdfg', 'hghfghdfghfghdfghfghfgh', 0, '0000-00-00 00:00:00'),
(17, 1, 'fgdfgdfg', 'hghfghdfghfghdfghfghfgh', 0, '0000-00-00 00:00:00'),
(20, 1, 'fgdfgdfg', 'hghfghdfghfghdfghfghfgh', 0, '0000-00-00 00:00:00'),
(22, 1, 'fgdfgdfg', 'hghfghdfghfghdfghfghfgh', 0, '0000-00-00 00:00:00'),
(28, 6, 'weqweq', 'qweqweqwe', 0, '0000-00-00 00:00:00'),
(29, 6, 'piopiopi', 'opiopiop', 0, '0000-00-00 00:00:00'),
(30, 6, 'dasfsdfas', 'asdasdasda', 0, '0000-00-00 00:00:00'),
(31, 6, 'xcvzxcvcvz', 'zxcvzxvcvxcvxcv', 0, '0000-00-00 00:00:00'),
(32, 6, 'ljkhkljkl', 'kjhlhjkjkl', 0, '0000-00-00 00:00:00'),
(33, 6, 'nmvbnmbnm', 'bnmvnmbnm', 0, '0000-00-00 00:00:00'),
(36, 9, '567t', 'yrtyrty', 1, '2022-03-12 02:36:57'),
(37, 9, '234523', 'werwer3', 0, '2022-03-12 02:37:00'),
(38, 9, 'sd', 'sd', 0, '2022-03-12 02:42:49'),
(39, 9, 'asdasd', 'sdasd', 0, '2022-03-12 02:42:51'),
(40, 9, 'asdasd', 'sdasd', 0, '2022-03-12 02:42:54'),
(41, 9, 'asdasd', 'sadasd', 0, '2022-03-12 02:42:56'),
(42, 9, 'sdasd', 'sdasd', 0, '2022-03-12 02:42:58'),
(43, 9, 'asdsdas', 'sdasdad', 0, '2022-03-12 02:43:01'),
(44, 9, 'sdadasd', 'asdasd', 0, '2022-03-12 02:43:17');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userId` int(5) NOT NULL AUTO_INCREMENT,
  `userName` varchar(20) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userPhone` varchar(20) NOT NULL,
  `userPwd` varchar(100) NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userName` (`userName`),
  UNIQUE KEY `userEmail` (`userEmail`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `userName`, `userEmail`, `userPhone`, `userPwd`) VALUES
(1, 'lahiru', 'lahirudissanayake15@gmail.com', '765424752', '$2y$10$6VuPpqP8tg0oTWZRu5c/SegAqml3N558tl82.tAwgXfDvfKq1Q7xy'),
(3, 'fggdfgdg', 'lahirudissanayake1556456@gmail.com', '6456456', '1234'),
(5, 'asd', 'asd@gmail.com', '123', '1234'),
(6, 'ucsc', 'ucsc@techsup.com', '011-1234567', '$2y$10$SEULGQv6sX81wFtxoNiQ9eq3kuy1DvNIFqSpjeBo7ii5HeKSr7XI.'),
(9, 'Kavi', 'kavi@gmail.com', '456789', '$2y$10$V93/DTLlKiRdFrjDLMfAw.EE5DbalCTbBdzOeTJQwOmZ6m9D3SnLS');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `issue`
--
ALTER TABLE `issue`
  ADD CONSTRAINT `issue_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
