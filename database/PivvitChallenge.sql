-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 12, 2017 at 07:28 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `PivvitChallenge`
--

-- --------------------------------------------------------

--
-- Table structure for table `Offering`
--

CREATE TABLE IF NOT EXISTS `Offering` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Offering`
--

INSERT INTO `Offering` (`id`, `title`, `price`) VALUES
(1, 'Product 1', 10),
(2, 'Product 2', 20);

-- --------------------------------------------------------

--
-- Table structure for table `Purchase`
--

CREATE TABLE IF NOT EXISTS `Purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerName` varchar(255) NOT NULL,
  `offeringID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Purchase`
--

INSERT INTO `Purchase` (`id`, `customerName`, `offeringID`, `quantity`) VALUES
(1, 'Customer 1', 1, 20),
(2, 'Customer 2', 2, 10);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
