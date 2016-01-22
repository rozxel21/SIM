-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2016 at 08:56 AM
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
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_guid` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `abrr` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `college` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `courses_course_guid_unique` (`course_guid`),
  UNIQUE KEY `courses_abrr_unique` (`abrr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Truncate table before insert `courses`
--

TRUNCATE TABLE `courses`;
--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_guid`, `abrr`, `name`, `college`, `created_at`, `updated_at`, `status`) VALUES
(1, 'D22EB6F0-7F8B-3D45-949B-3F03A77EA04B', 'bsa', 'Bachelor of Science in Agriculture', 'cag', '2016-01-21 23:24:38', '2016-01-21 23:24:38', 1),
(2, '6D686286-7C2B-3618-8FB7-887EC8CC9663', 'abdc', 'Bachelor of Arts in Development Communication', 'cas', '2016-01-21 23:34:58', '2016-01-21 23:35:47', 1),
(3, '27FC6228-233B-3679-8DE5-3001CF7368C6', 'abll', 'Bachelor of Arts in  Language and Literature', 'cas', '2016-01-21 23:37:26', '2016-01-21 23:37:26', 1),
(4, '0CF4F6B9-56CF-3270-A65D-2FF98106E057', 'abpsych', 'Bachelor of Arts in Psychology', 'cas', '2016-01-21 23:38:49', '2016-01-21 23:38:49', 1),
(5, '6729BD52-9FBC-3899-AA7A-E79B72B6E9D3', 'abss', 'Bachelor of Arts in Social Science', 'cas', '2016-01-21 23:40:21', '2016-01-21 23:40:21', 1),
(6, '42BFBCC5-BA6B-3F57-BDBE-255EDD92A4B5', 'bsbio', 'Bachelor of Science in Biology', 'cas', '2016-01-21 23:41:33', '2016-01-21 23:41:33', 1),
(7, 'B0638E19-402A-3161-89FB-82A370F4D746', 'bsba', 'Bachelor of Science in Business Administration', 'cbaa', '2016-01-21 23:51:51', '2016-01-21 23:51:51', 1),
(8, '1C0386F2-1272-3B69-9598-F54661D14AF8', 'beed', 'Bachelor of Elementary Education', 'ced', '2016-01-21 23:53:26', '2016-01-21 23:53:26', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
