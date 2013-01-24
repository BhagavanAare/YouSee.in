-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 04, 2013 at 07:13 AM
-- Server version: 5.5.29
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test_uc`
--

-- --------------------------------------------------------

--
-- Table structure for table `fulfill`
--

CREATE TABLE IF NOT EXISTS `fulfill` (
  `fulfill_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  PRIMARY KEY (`fulfill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620 COLLATE=tis620_bin;

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE IF NOT EXISTS `offer` (
  `offer_id` int(11) NOT NULL,
  `offer_date` date NOT NULL,
  `donor_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `offer_quantity` int(11) NOT NULL,
  `remaining_quantity` int(11) NOT NULL,
  `expiry_date` date NOT NULL,
  PRIMARY KEY (`offer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620 COLLATE=tis620_bin;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`offer_id`, `offer_date`, `donor_id`, `item_id`, `unit_id`, `offer_quantity`, `remaining_quantity`, `expiry_date`) VALUES
(1, '2013-01-01', 1, 1, 1, 10, 10, '2013-01-31'),
(2, '2013-01-01', 2, 2, 1, 4, 4, '2013-01-31'),
(3, '2013-01-01', 1, 1, 1, 10, 10, '2013-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `request_id` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `partner_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `requested_quantity` int(11) NOT NULL,
  `remaining_quantity` int(11) NOT NULL,
  `expiry_date` date NOT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620 COLLATE=tis620_bin;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
