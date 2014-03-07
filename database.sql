-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2014 at 06:54 PM
-- Server version: 5.5.36
-- PHP Version: 5.4.25

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
-- Table structure for table `answers_number`
--

CREATE TABLE IF NOT EXISTS `answers_number` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `q_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `w_id` int(11) NOT NULL,
  `var_id` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `answers_text`
--

CREATE TABLE IF NOT EXISTS `answers_text` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `q_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `w_id` int(11) NOT NULL,
  `var_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `answers_yn`
--

CREATE TABLE IF NOT EXISTS `answers_yn` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `q_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `w_id` int(11) NOT NULL,
  `var_id` int(11) NOT NULL,
  `answer` tinyint(1) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `q_id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(40) NOT NULL,
  PRIMARY KEY (`q_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hint`
--

CREATE TABLE IF NOT EXISTS `hint` (
  `h_id` int(11) NOT NULL AUTO_INCREMENT,
  `q_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `hint` varchar(2000) NOT NULL,
  PRIMARY KEY (`h_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `q_id` int(11) NOT NULL AUTO_INCREMENT,
  `w_type` int(11) NOT NULL,
  `question` varchar(1000) NOT NULL,
  PRIMARY KEY (`q_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`q_id`, `w_type`, `question`) VALUES
(1, 0, 'Which country are you from?'),
(2, 0, 'Please specify the industry you believe cartel is possible?'),
(3, 1, 'How many competitors  are there in the market ?'),
(4, 1, ' Is there high entry barriers? Please justify your response.'),
(5, 1, 'Is there frequent interaction between the firms? If yes, please specify.'),
(6, 1, 'Is the market transparent? If yes, please specify.'),
(7, 1, 'What is the market growth ? Please enter the market growth for the industry in the country in percentage , in the world and for average market growth in the country for all industries in percentage.'),
(8, 1, 'Is there significant fluctuations or business cycles? If yes, please specify.'),
(9, 1, 'Demand elasticity. Please provide data for demand current(First) and past(Second, Third, Fourth) in the industry in his country, in the industry in EU (Fifth, Sixth, Seventh, Eight).'),
(10, 1, 'What is the buying power concentration? Please give information about the buying power of the main consumers in the market in the specific country. Please justify your response.'),
(11, 1, 'Is there an absence of club and network effects?'),
(12, 1, 'Is the industry mature with stabilized technologies?'),
(13, 1, ' Are the cost of production for most businesses in the industry symmetric (nearly equal)?'),
(14, 1, 'Are the capacities of the most players involved symmetric ( nearly equal ) ? '),
(15, 1, 'Are the products on the market homogeny?'),
(16, 1, 'Do the companies involved have multi-market contact?'),
(17, 1, 'Are there structural links between the competitors in the market?'),
(18, 1, 'Are there cooperative and other contractual agreements between the competitors?'),
(19, 2, 'What is the supply in units of the industry for the current year?'),
(20, 2, 'Please state where you got your information from ?'),
(21, 2, 'What is the supply in units of the industry for the last 3 years?'),
(22, 2, ' Please state where you got your information from ?'),
(23, 2, 'What is the demand in units of the industry for the current year?'),
(24, 2, 'Please state where you got your information from ?'),
(25, 2, 'What is the demand in units of the industry for the last 3 years?'),
(26, 2, 'Please state where you got your information from ?'),
(27, 2, 'What is the rate of return of the industry class for the current year?'),
(28, 2, 'Please state where you got your information from ?'),
(29, 2, 'What is the rate of return of the industry class for the last 3 year?'),
(30, 2, 'Please state where you got your information from ?'),
(31, 2, 'What is the average rate of return in the country for the current year? '),
(32, 2, 'Please state where you got your information from ?'),
(33, 2, 'What is the average rate of return in the country for the last 3 year?'),
(34, 2, 'Please state where you got your information from ?'),
(35, 2, 'What is the market share of the first 6 biggest companies in the market ?'),
(36, 2, 'Please state where you got your information from ?'),
(37, 2, 'Please define new products in the industry:'),
(38, 2, 'What is the market share of new products in the industry in the country ?'),
(39, 2, 'Please state where you got your information from ?'),
(40, 2, 'What is the market share of new products in the industry in EU ?'),
(41, 2, 'Please state where you got your information from ?'),
(42, 2, 'What is the market share of new products in the industry in the world?'),
(43, 2, 'Please state where you got your information from ?'),
(44, 2, 'What is the labor productivity in the industry?'),
(45, 2, 'Please state where you got your information from?'),
(46, 2, 'What is the labor compensation in the industry? '),
(47, 2, 'Please state where you got your information from?'),
(48, 2, 'What is the labor productivity in the country?'),
(49, 2, 'Please state where you got your information from?'),
(50, 2, 'What is the labor compensation in the country?'),
(51, 2, 'Please state where you got your information from?');

-- --------------------------------------------------------

--
-- Table structure for table `report_text`
--

CREATE TABLE IF NOT EXISTS `report_text` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(2000) NOT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 for admin and 1 for regular users',
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_type`, `username`, `password`, `first_name`, `last_name`) VALUES
(1, 2, 'nandor1992', '6b1b36cbb04b41490bfc0ab2bfa26f86', 'Nandor', 'Verba'),
(2, 1, 'nandor', '6b1b36cbb04b41490bfc0ab2bfa26f86', 'Nandor', 'Verba'),
(3, 1, 'Zoltan21', 'ebbc3c26a34b609dc46f5c3378f96e08', 'Zoltan', 'Nagy');

-- --------------------------------------------------------

--
-- Table structure for table `variable`
--

CREATE TABLE IF NOT EXISTS `variable` (
  `var_id` int(11) NOT NULL AUTO_INCREMENT,
  `q_id` int(11) NOT NULL,
  `var_name` varchar(255) NOT NULL,
  `var_text` varchar(255) NOT NULL,
  `var_type` int(11) NOT NULL,
  PRIMARY KEY (`var_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `worksheet`
--

CREATE TABLE IF NOT EXISTS `worksheet` (
  `w_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `w_name` varchar(30) NOT NULL,
  `w_type` tinyint(1) NOT NULL COMMENT '0 for Structural 1 for CFD',
  `w_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`w_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
