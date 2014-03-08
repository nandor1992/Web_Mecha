-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2014 at 10:53 PM
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
-- Table structure for table `answers_number`
--

CREATE TABLE IF NOT EXISTS `answers_number` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `q_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `w_id` int(11) NOT NULL,
  `var_id` int(11) NOT NULL,
  `skip` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-unskipped 1-skipped',
  `answer` bigint(20) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `answers_number`
--

INSERT INTO `answers_number` (`a_id`, `q_id`, `u_id`, `w_id`, `var_id`, `skip`, `answer`) VALUES
(1, 1, 1, 1, 1, 0, 23);

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
  `skip` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-unskipped 1-skipped',
  `answer` text NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `answers_text`
--

INSERT INTO `answers_text` (`a_id`, `q_id`, `u_id`, `w_id`, `var_id`, `skip`, `answer`) VALUES
(1, 2, 1, 1, 2, 0, 'It''s romania, it''s bound to have some of this!'),
(2, 4, 1, 1, 5, 0, 'High barrier stuff, of course we has thats!');

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
  `skip` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-unskipped 1-skipped',
  `answer` tinyint(1) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `answers_yn`
--

INSERT INTO `answers_yn` (`a_id`, `q_id`, `u_id`, `w_id`, `var_id`, `skip`, `answer`) VALUES
(1, 4, 1, 1, 4, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `q_id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(40) NOT NULL,
  PRIMARY KEY (`q_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`q_id`, `country`) VALUES
(1, 'Austria'),
(2, 'Belgium'),
(3, 'Bulgaria'),
(4, 'Croatia'),
(5, 'Cyprus'),
(6, 'Czech Republic'),
(7, 'Denmark'),
(8, 'Estonia'),
(9, 'Finland'),
(10, 'France'),
(11, 'Germany'),
(12, 'Greece'),
(13, 'Hungary'),
(14, 'Ireland'),
(15, 'Italy'),
(16, 'Latvia'),
(17, 'Lithuania'),
(18, 'Luxembourg '),
(19, 'Malta'),
(20, 'Netherlands'),
(21, 'Poland'),
(22, 'Portugal'),
(23, 'Romania'),
(24, 'Slovakia'),
(25, 'Slovenia'),
(26, 'Spain'),
(27, 'Sweden'),
(28, 'United Kingdom');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `hint`
--

INSERT INTO `hint` (`h_id`, `q_id`, `country_id`, `hint`) VALUES
(1, 3, 3, 'Hint Question 3 country Bulgaria'),
(2, 4, 3, 'Hint Question 4 country Bulgaria'),
(3, 5, 3, 'Hint Question 5 country Bulgaria'),
(4, 7, 3, 'Hint Question 6 country Bulgaria'),
(5, 7, 3, 'Hint Question 7 country Bulgaria'),
(6, 3, 23, 'Hint Question 3 country Romania'),
(7, 4, 23, 'Hint Question 4 country Romania'),
(8, 5, 23, 'Hint Question 5 country Romania'),
(9, 7, 23, 'Hint Question 6 country Romania'),
(10, 7, 23, 'Hint Question 7 country Romania');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `q_id` int(11) NOT NULL AUTO_INCREMENT,
  `w_type` int(11) NOT NULL,
  `question` varchar(1000) NOT NULL,
  PRIMARY KEY (`q_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `report_text`
--

INSERT INTO `report_text` (`t_id`, `text`) VALUES
(1, 'Text1'),
(2, 'Text2'),
(3, 'Text3'),
(4, 'Text4');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 for regular users 2 for admin',
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_type`, `username`, `password`, `first_name`, `last_name`) VALUES
(1, 2, 'nandor1992', '6b1b36cbb04b41490bfc0ab2bfa26f86', 'Nandor', 'Verba'),
(2, 1, 'nandor', '6b1b36cbb04b41490bfc0ab2bfa26f86', 'Nandor', 'Verba'),
(3, 2, 'Zoltan21', 'ebbc3c26a34b609dc46f5c3378f96e08', 'Zoltan', 'Nagy');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Dumping data for table `variable`
--

INSERT INTO `variable` (`var_id`, `q_id`, `var_name`, `var_text`, `var_type`) VALUES
(1, 1, 'A1', 'Select from list:', 1),
(2, 2, 'A2', 'Description:', 2),
(3, 3, 'B1', 'Number of Competitors:', 3),
(4, 4, 'B2', 'High entry barrier:', 4),
(5, 4, 'B3', 'Please justify your response:', 2),
(6, 5, 'B4', 'Frequent interraction:', 5),
(7, 5, 'B5', 'If yes specify:', 2),
(8, 6, 'B6', 'Transparent market:', 5),
(9, 6, 'B7', 'If yes specify:', 2),
(10, 7, 'B8', 'Market growth for the inustry in the country(percentage):', 3),
(11, 7, 'B9', 'Market growth for the inustry in the world(percentage):', 3),
(12, 7, 'B10', 'Average market growth in the country for all industries(percentage):', 3),
(13, 8, 'B11', 'Significant fluctuations or business cycles:', 5),
(14, 8, 'B12', 'If yes specify:', 2),
(15, 9, 'B13', 'The Industries Current demand elastisity in the country:', 3),
(16, 9, 'B14', 'The Industries Past demand elastisity in the country:', 3),
(17, 9, 'B15', 'The Industries Past demand elastisity in the country:', 3),
(18, 9, 'B16', 'The Industries Past demand elastisity in the country:', 3),
(19, 9, 'B17', 'The Industries Current demand elastisity in the EU:', 3),
(20, 9, 'B18', 'The Industries Past demand elastisity in the EU:', 3),
(21, 9, 'B19', 'The Industries Past demand elastisity in the EU:', 3),
(22, 9, 'B20', 'The Industries Past demand elastisity in the EU:', 3),
(23, 10, 'B21', 'Buying Power Concentration:', 6),
(24, 10, 'B22', 'Please justify your response:', 2),
(25, 11, 'B23', 'Absenceof club and ntwork effect:', 5),
(26, 11, 'B24', 'If yes specify:', 2),
(27, 12, 'B25', 'Mature industry with  stabilized  technologies:', 4),
(28, 12, 'B26', 'Please justify your response:', 2),
(29, 13, 'B27', 'Symmetric costs:', 4),
(30, 13, 'B28', 'Please justify your response:', 2),
(31, 14, 'B29', 'Player capacities symmetric:', 4),
(32, 14, 'B30', 'Please justify your response:', 2),
(33, 15, 'B31', 'Homegeneus products on the market:', 4),
(34, 15, 'B32', 'Please justify your response:', 2),
(35, 16, 'B33', 'Multi market companies involvement:', 4),
(36, 16, 'B34', 'Please justify your response:', 2),
(37, 17, 'B35', 'Structural links bettwene competitors', 4),
(38, 17, 'B36', 'Please justify your response:', 2),
(39, 18, 'B37', 'Cooperative and other contractual agreements between the competitors:', 4),
(40, 18, 'B38', 'Please justify your response:', 2),
(41, 19, 'C1', 'Supply in units in the current year:', 3),
(42, 21, 'C2', 'Supply in units in the past year:', 3),
(43, 21, 'C3', 'Supply in units 2 years ago:', 3),
(44, 21, 'C4', 'Supply in units 3 years ago:', 3),
(45, 23, 'C5', 'Demand in units in the current year:', 3),
(46, 25, 'C6', 'Demand in units in the past year:', 3),
(47, 25, 'C7', 'Demand in units 2 years ago:', 3),
(48, 25, 'C8', 'Demand in units 3 years ago:', 3),
(49, 27, 'C9', 'Rate of return for the industry in the current year:', 6),
(50, 29, 'C10', 'Rate of return for the industry in the past year:', 6),
(51, 29, 'C11', 'Rate of return for the industry 2 years ago:', 6),
(52, 29, 'C12', 'Rate of return for the industry 3 years ago:', 6),
(53, 31, 'C13', 'Avrage rate of return for the country in the current year:', 6),
(54, 33, 'C14', 'Avrage rate of return for the country in the past year:', 6),
(55, 33, 'C15', 'Avrage rate of return for the country 2 years ago:', 6),
(56, 33, 'C16', 'Avrage rate of return for the country 3 years ago', 6),
(57, 35, 'C17', 'First companies market share:', 7),
(58, 35, 'C18', 'Second companies market share:', 7),
(59, 35, 'C19', 'Third companies market share:', 7),
(60, 35, 'C20', 'Fourth companies market share:', 7),
(61, 35, 'C21', 'Fifth companies market share:', 7),
(62, 35, 'C22', 'Sixth companies market share:', 7),
(63, 38, 'C23', 'Market share of new products in the industry,in the country:', 6),
(64, 40, 'C24', 'Market share of new products in the industry,in the EU:', 6),
(65, 42, 'C25', 'Market share of new products in the industry,in the world:', 6),
(66, 44, 'C26', 'Labor productivity in the inustry:', 3),
(67, 46, 'C27', 'Labor compensation in the inustry:', 3),
(68, 48, 'C28', 'Labor productivity in the country:', 3),
(69, 50, 'C29', 'Labor compensation in the country:', 3),
(70, 20, 'D1', 'Please justify your response:', 2),
(71, 22, 'D2', 'Please justify your response:', 2),
(72, 24, 'D3', 'Please justify your response:', 2),
(73, 26, 'D4', 'Please justify your response:', 2),
(74, 28, 'D5', 'Please justify your response:', 2),
(75, 30, 'D6', 'Please justify your response:', 2),
(76, 32, 'D7', 'Please justify your response:', 2),
(77, 34, 'D8', 'Please justify your response:', 2),
(78, 36, 'D9', 'Please justify your response:', 2),
(79, 37, 'D10', 'Please define new products in the industry:', 2),
(80, 39, 'D11', 'Please explain your sources:', 2),
(81, 41, 'D12', 'Please explain your sources:', 2),
(82, 43, 'D13', 'Please explain your sources:', 2),
(83, 45, 'D14', 'Please explain your sources:', 2),
(84, 47, 'D15', 'Please explain your sources:', 2),
(85, 49, 'D16', 'Please explain your sources:', 2),
(86, 51, 'D17', 'Please explain your sources:', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `worksheet`
--

INSERT INTO `worksheet` (`w_id`, `u_id`, `w_name`, `w_type`, `w_date`) VALUES
(1, 1, 'Default_Structural', 1, '2014-03-07 20:16:57'),
(2, 1, 'Default_CFD', 2, '2014-03-07 20:16:57'),
(3, 1, 'Default_Both', 3, '2014-03-07 20:17:18'),
(4, 1, 'Worksheet test1', 2, '2014-03-08 21:46:43'),
(5, 1, 'Worksheet_lotsa', 1, '2014-03-08 23:23:48');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
