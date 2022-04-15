-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 15, 2022 at 04:26 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue`
--

INSERT INTO `issue` (`issueId`, `userId`, `title`, `description`, `status`, `timestamp`) VALUES
(42, 12, 'Stop too much data usage in the background', 'One thing I immediately noticed after upgrade to Windows 10 was the unknown increase in data usage. I was using mobile data over the hotspot so Windows suddenly chugging on the limited data was very noticeable.', 0, '2022-04-15 04:13:19'),
(43, 12, 'Minimize notifications', 'Using the default notification settings, Windows 10 always has 2-3 new notifications for you whenever you open up the PC (at least it was like that for me). And most of these notifications arenâ€™t useful, and even annoying if you are not using the app/service it is notifying about.', 1, '2022-04-15 04:13:31'),
(44, 13, 'Access Safe mode', 'Going into safe mode is necessary to solve many problems like driver issues, file corruption, and virus infections, etc. However, the previous go-to methods of accessing Safe mode wonâ€™t work in Windows 10.', 1, '2022-04-15 04:13:57'),
(45, 13, 'Disable Delivery Optimization', 'Windows 10 uses Windows Update Delivery Optimization (WUDO) system to deliver updates to PCs. Itâ€™s a peer-to-peer delivery system where Windows may upload updates already downloaded on your PC to another PC on the internet or on the same network. Microsoft added this to save bandwidth by using your network for delivery instead of their own server.', 0, '2022-04-15 04:14:08'),
(46, 13, 'Hide the search bar', 'In the previous Windows version, the search bar was in the Start menu or Start screen. However, in Windows 10 the search bar (a big one too) is on the taskbar instead. This can be quite problematic for many people, especially if you like having app icons pinned on the taskbar.', 1, '2022-04-15 04:14:38'),
(47, 13, 'Disable background apps', 'Windows 10 has way too many native apps that run in the background and keep hogging resources even if you donâ€™t use them. Disabling them is a great way to get a boost in system performance.', 0, '2022-04-15 04:14:55'),
(48, 13, 'Hibernate option not available in power menu', 'In favor of the Fast Startup feature, Windows 10 has completely removed Hibernate from the Start menu power options. You have to re-enable this feature to be able to hibernate your PC in Windows 10.', 0, '2022-04-15 04:15:08'),
(49, 14, 'Activate Windows 10 with Windows 7, 8, 8.1 key', 'On the release of Windows 10, Microsoft allowed Windows 7 and 8 users to upgrade to Windows 10 for free. This offer was supposed to last for only two years. Many people think that this offer has ended as Microsoft didnâ€™t make any official comments on this matter.', 0, '2022-04-15 04:16:01'),
(50, 14, 'Having enough space to install Windows 10', 'If you\'re planning to move to Windows 10, actually installing the OS is the first area you could potentially run into problems with. Installing a new operating system requires a certain amount of free space on your drive so that it can be downloaded and certain elements can be run successfully.', 0, '2022-04-15 04:16:34'),
(51, 6, 'Checking you have a powerful enough PC', 'Just as with space requirements, your PC will also have to be capable of running Windows 10. This means that it must reach certain minimum system requirements.\r\n\r\nThe requirements for running Windows 10 are relatively low: A processor of 1GHz or faster; 1GB (32-bit) or 2GB (64-bit) of RAM; 16GB of free drive space; Microsoft DirectX 9 graphic device; and a Microsoft account combined with internet access.', 1, '2022-04-15 04:17:20'),
(52, 6, 'Activating Windows 10', 'Some users have reported issues with activating their copies of Windows 10, which could have been down to a number of different reasons. In some cases, the easiest way to get around the problem is to purchase a legitimate copy of Windows 10.', 1, '2022-04-15 04:17:32'),
(53, 6, 'Avoiding inconvenient software update reboots', 'Windows 10 is, in many ways, a truly internet-based operating system. Mostly, this is a bonus but there are times when it isn\'t â€“ and Microsoft\'s attitude towards operating system updates is one such time.', 0, '2022-04-15 04:17:42'),
(54, 6, 'Updating old software to work with Windows 10', 'Each version of a new operating system comes with its own set of backwards compatibility issues and Windows 10 is no exception.\r\n\r\nThe transition from Windows 8.1 to 10 is far less jarring than the move from Windows 7 to 8 was, but there are still certain applications that can become broken and, in some cases, cease to work at all.', 0, '2022-04-15 04:17:56');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `userName`, `userEmail`, `userPhone`, `userPwd`) VALUES
(6, 'ucsc', 'ucsc@techsup.com', '011-1234567', '$2y$10$SEULGQv6sX81wFtxoNiQ9eq3kuy1DvNIFqSpjeBo7ii5HeKSr7XI.'),
(12, 'Lahiru', 'lahirudissanayake15@gmail.com', '076-5424752', '$2y$10$tud8sBMcY0R7ELVIPc/DfOkidmPbalDhew0JIG19iYl/CY.HHB5hC'),
(13, 'Kavishka', 'kavishkafernando123@gmail.com', '077-5689425', '$2y$10$Tj.Rt5TF.oM1DWhwkkRkdOOnwtWlpbBdXt9cTHUJU0nTLcxhfDigi'),
(14, 'Munzira', 'munsiramansoor123@gmail.com', '077-4578236', '$2y$10$W43luqTJQ4XnZZgnQyOt7eX6ZmPMX64jEhhphyJAt5MPs6x680BoC');

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
