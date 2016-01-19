-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2016 at 09:32 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sim_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE IF NOT EXISTS `colleges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `college_guid` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `abrr` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `colleges_college_guid_unique` (`college_guid`),
  UNIQUE KEY `colleges_abrr_unique` (`abrr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Truncate table before insert `colleges`
--

TRUNCATE TABLE `colleges`;
--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `college_guid`, `abrr`, `name`, `created_at`, `updated_at`, `status`) VALUES
(1, '65883B91-D1FD-30B9-84DA-8F6895AA3A25', 'cag', 'College of Agriculture', '2016-01-17 17:27:23', '2016-01-17 17:27:23', 1),
(2, '161C5AE3-1E90-3923-8992-6567B9D16D1D', 'cas', 'College of Arts and Sciences', '2016-01-17 17:29:22', '2016-01-17 17:29:22', 1),
(3, '9FFA07A4-7E07-3C44-833D-78C8D3B2365C', 'cbaa', 'College of Business Administration and Accountancy', '2016-01-17 17:29:41', '2016-01-17 17:29:41', 1),
(4, '474AD594-1461-3589-9BF3-FB0891ACF9C4', 'ced', 'College of Education', '2016-01-17 17:29:54', '2016-01-17 17:29:54', 1),
(5, '820A3C48-9CF1-3FFE-9572-7B5BCECBFA03', 'cen', 'College of Engineering', '2016-01-17 17:30:04', '2016-01-17 17:30:04', 1),
(6, '90584E42-177B-3FE8-96B5-E1D2C3D62873', 'cf', 'College of Fisheries', '2016-01-17 17:30:14', '2016-01-17 17:30:14', 1),
(7, '30239BA0-1024-3B2B-8429-30C9662DF2D5', 'chsi', 'College of Home Science and Industry', '2016-01-17 17:30:26', '2016-01-17 17:30:26', 1),
(8, 'EA915ADF-2AE5-3F9B-B5AC-43EB3E6ED62B', 'cvsm', 'College of Veterinary Science and Medicine', '2016-01-17 17:30:41', '2016-01-17 17:30:41', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
