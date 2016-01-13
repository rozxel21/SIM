-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2016 at 03:57 AM
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
  `college_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `college_name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `colleges_college_guid_unique` (`college_guid`),
  UNIQUE KEY `colleges_college_code_unique` (`college_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Truncate table before insert `colleges`
--

TRUNCATE TABLE `colleges`;
--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `college_guid`, `college_code`, `college_name`, `created_at`, `updated_at`, `status`) VALUES
(1, '3bb59654-d565-3a2a-877f-1a50738294b3', 'cag', 'College of Agriculture', '2016-01-12 18:33:26', '2016-01-12 18:33:26', 1),
(2, 'c787bbe2-d9a8-3e7b-943a-a50fa50e86ab', 'cas', 'College of Arts and Sciences', '2016-01-12 18:35:51', '2016-01-12 18:35:51', 1),
(3, 'db9c7c58-3cc8-3498-a18b-d1cc73bd0f29', 'cbaa', 'College of Business Administration and Accountancy', '2016-01-12 18:36:15', '2016-01-12 18:36:15', 1),
(4, 'c75cae6b-0cf4-3330-a8bd-99a551ead5f9', 'ced', 'College of Education', '2016-01-12 18:36:32', '2016-01-12 18:36:32', 1),
(5, '6f147eb9-4a1f-3d30-b65a-99d5f82492a5', 'cen', 'College of Engineering', '2016-01-12 18:36:45', '2016-01-12 18:36:45', 1),
(6, '3f002411-12e4-33a7-88bb-b872e9e58dfe', 'cf', 'College of Fisheries', '2016-01-12 18:37:00', '2016-01-12 18:37:00', 1),
(7, '1aef9f23-f7d7-3ec4-9957-7c7b5ffb5716', 'chsi', 'College of Home Science and Industry', '2016-01-12 18:37:27', '2016-01-12 18:37:27', 1),
(8, '552c5f75-d8f6-3878-bfa1-10ffca74c8c0', 'cvsm', 'College of Veterinary Science and Medicine', '2016-01-12 18:37:54', '2016-01-12 18:37:54', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
