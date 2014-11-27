-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2014 at 07:18 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `q_id` int(11) NOT NULL,
  `w_id` int(11) NOT NULL,
  `var_id` int(11) NOT NULL,
  `skip` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-unskipped 1-skipped',
  `answer` text NOT NULL,
  PRIMARY KEY (`a_id`),
  UNIQUE KEY `a_id` (`a_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`a_id`, `q_id`, `w_id`, `var_id`, `skip`, `answer`) VALUES
(53, 1, 10, 1, 0, '23'),
(54, 2, 10, 2, 0, 'Moldova'),
(55, 3, 10, 3, 0, 'Sef la bani'),
(56, 27, 10, 64, 0, '2014'),
(57, 27, 10, 65, 0, '1.23'),
(58, 27, 10, 66, 0, '1.25'),
(59, 27, 10, 67, 0, '1.27'),
(60, 27, 10, 68, 0, '1.45'),
(61, 27, 10, 69, 0, '1.69'),
(62, 28, 10, 70, 0, 'Da pa net');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
