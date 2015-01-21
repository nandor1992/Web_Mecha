-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2015 at 12:01 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=99 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`a_id`, `q_id`, `w_id`, `var_id`, `skip`, `answer`) VALUES
(63, 1, 11, 1, 0, '2'),
(64, 2, 11, 2, 0, 'asda'),
(65, 3, 11, 3, 0, 'MyIndustry'),
(66, 23, 11, 50, 0, '2013'),
(67, 23, 11, 51, 0, '12'),
(68, 23, 11, 52, 0, '23'),
(69, 23, 11, 53, 0, '24'),
(70, 23, 11, 54, 0, '12'),
(71, 23, 11, 55, 0, '42'),
(72, 24, 11, 56, 0, 'My arse'),
(82, 1, 13, 1, 0, '1'),
(83, 2, 13, 2, 0, '23'),
(84, 3, 13, 3, 0, '323'),
(85, 1, 9, 1, 0, '2'),
(86, 25, 11, 57, 0, '2014'),
(87, 25, 11, 58, 0, '1'),
(88, 25, 11, 59, 0, '2'),
(89, 25, 11, 60, 0, '4'),
(90, 25, 11, 61, 0, '6'),
(91, 25, 11, 62, 0, '8'),
(93, 26, 11, 63, 0, 'My sources Daah'),
(98, 29, 13, 71, 0, 'yes');

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
-- Table structure for table `generated_reports`
--

CREATE TABLE IF NOT EXISTS `generated_reports` (
  `rep_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `rep_name` varchar(30) NOT NULL,
  `rep_link` varchar(2000) NOT NULL,
  `rep_comment` varchar(1000) NOT NULL,
  `r_type` int(11) NOT NULL,
  `w_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rep_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `generated_reports`
--

INSERT INTO `generated_reports` (`rep_id`, `u_id`, `rep_name`, `rep_link`, `rep_comment`, `r_type`, `w_date`) VALUES
(1, 1, 'Generated Report', '/reports/link1.php', 'This is my comment', 1, '2014-11-27 17:34:04');

-- --------------------------------------------------------

--
-- Table structure for table `hint`
--

CREATE TABLE IF NOT EXISTS `hint` (
  `h_id` int(11) NOT NULL AUTO_INCREMENT,
  `q_id` int(11) NOT NULL,
  `hint` varchar(2000) NOT NULL,
  `hint_link` varchar(100) NOT NULL,
  PRIMARY KEY (`h_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `hint`
--

INSERT INTO `hint` (`h_id`, `q_id`, `hint`, `hint_link`) VALUES
(2, 2, 'The collusion behavior of companies (cartels) can be present in any kind of market. You Dear User should decide which scale you should test with this approach. For detailed information on the subject please follow this link', 'help_market_types.php'),
(3, 3, '', ''),
(4, 20, 'You can compare producers or consumers prices. What you Dear Reader should rember is to always compare apples to apples, not to oranges. For further details Please see our guidelines ', 'help_price_index.php'),
(5, 21, 'You can compare producers or consumers prices. What you Dear Reader should rember is to always compare apples to apples, not to oranges. For further details Please see our guidelines', 'help_price_index.php'),
(6, 22, 'Dear User in the report TECol is going to generate this field will be the basis on which the reliability of the information provided will be considered, hence the reliability of the whole report. Specific and verifiable data will be appreciated. For more information please read the link', 'help_information_source.php'),
(7, 24, 'Dear User in the report TECol is going to generate this field will be the basis on which the reliability of the information provided will be considered, hence the reliability of the whole report. Specific and verifiable data will be appreciated. For more information please read the link', 'help_information_source.php'),
(8, 26, 'Dear User in the report TECol is going to generate this field will be the basis on which the reliability of the information provided will be considered, hence the reliability of the whole report. Specific and verifiable data will be appreciated. For more information please read the link', 'help_information_source.php'),
(9, 28, 'Dear User in the report TECol is going to generate this field will be the basis on which the reliability of the information provided will be considered, hence the reliability of the whole report. Specific and verifiable data will be appreciated. For more information please read the link', 'help_information_source.php'),
(10, 32, 'Dear User in the report TECol is going to generate this field will be the basis on which the reliability of the information provided will be considered, hence the reliability of the whole report. Specific and verifiable data will be appreciated. For more information please read the link', 'help_information_source.php'),
(11, 34, 'Dear User in the report TECol is going to generate this field will be the basis on which the reliability of the information provided will be considered, hence the reliability of the whole report. Specific and verifiable data will be appreciated. For more information please read the link', 'help_information_source.php'),
(12, 36, 'Dear User in the report TECol is going to generate this field will be the basis on which the reliability of the information provided will be considered, hence the reliability of the whole report. Specific and verifiable data will be appreciated. For more information please read the link', 'help_information_source.php'),
(13, 38, 'Dear User in the report TECol is going to generate this field will be the basis on which the reliability of the information provided will be considered, hence the reliability of the whole report. Specific and verifiable data will be appreciated. For more information please read the link', 'help_information_source.php');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `q_id` int(11) NOT NULL AUTO_INCREMENT,
  `w_type` int(11) NOT NULL,
  `question` varchar(1000) NOT NULL,
  PRIMARY KEY (`q_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`q_id`, `w_type`, `question`) VALUES
(1, 0, 'In which country the market you are testing is situated?'),
(2, 0, 'Are you testing a Local or Regional Market? If yes,please specify which.'),
(3, 0, 'What is the name of the industry/market you are testing ?'),
(4, 1, 'How many competitors  are there in the market ?'),
(5, 1, ' Is there high entry barriers? Please justify your response.'),
(6, 1, 'Is there frequent interaction between the firms? If yes, please specify.'),
(7, 1, 'Is the market transparent? If yes, please specify.'),
(8, 1, 'What is the market growth ? Please enter the market growth for the industry in the country in percentage , in the world and for average market growth in the country for all industries in percentage.'),
(9, 1, 'Is there significant fluctuations or business cycles? If yes, please specify.'),
(10, 1, 'Demand elasticity. Please provide data for demand current(First) and past(Second, Third, Fourth) in the industry in his country, in the industry in EU (Fifth, Sixth, Seventh, Eight).'),
(11, 1, 'What is the buying power concentration? Please give information about the buying power of the main consumers in the market in the specific country. Please justify your response.'),
(12, 1, 'Is there an absence of club and network effects?'),
(13, 1, 'Is the industry mature with stabilized technologies?'),
(14, 1, ' Are the cost of production for most businesses in the industry symmetric (nearly equal)?'),
(15, 1, 'Are the capacities of the most players involved symmetric ( nearly equal ) ? '),
(16, 1, 'Are the products on the market homogeny?'),
(17, 1, 'Do the companies involved have multi-market contact?'),
(18, 1, 'Are there structural links between the competitors in the market?'),
(19, 1, 'Are there cooperative and other contractual agreements between the competitors?'),
(20, 2, 'What is the price index you are comparing?'),
(21, 2, 'What is the price index for the last 5 years (starting with the oldest information)?'),
(22, 2, 'Where do you have your information from ?'),
(23, 3, 'What is the rate of return on capital in the industry in the last 5 years?'),
(24, 3, 'Where do you have your information from?'),
(25, 3, 'What is the rate of return on capital in the economy in the last 5 years?'),
(26, 3, 'Where do you have your information from?'),
(27, 4, 'What are the market share volatility index for the last 5 years?'),
(28, 4, 'Where do you have your information from?'),
(29, 5, 'Are there obvious innovation gaps in the market?'),
(30, 5, 'Please describe the innovation gaps'),
(31, 6, 'What is the labor productivity in the industry in the last 5 years (euro/hour)?'),
(32, 6, 'Where do you have your information from ?'),
(33, 6, 'What is the labor compensation in the industry in the last 5 years (euro/hour)?'),
(34, 6, 'Where do you have your information from ?'),
(35, 7, 'What is the total investment in the industry for the last 5 years?'),
(36, 7, 'Where do you have your information from?'),
(37, 7, 'What are the total sales in the market in the last 5 years?'),
(38, 7, 'Where do you have your information from?');

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
(3, 2, 'Zoltan21', 'ebbc3c26a34b609dc46f5c3378f96e08', 'Zoltan', 'Nagy'),
(5, 1, 'nandor', '6b1b36cbb04b41490bfc0ab2bfa26f86', 'Dorritos', 'Michael'),
(6, 1, 'abcdef', '81dc9bdb52d04dc20036dbd8313ed055', 'Nanor', 'Verba'),
(7, 2, 'dimo', '81dc9bdb52d04dc20036dbd8313ed055', 'Dimo', 'Kyosev');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `variable`
--

INSERT INTO `variable` (`var_id`, `q_id`, `var_name`, `var_text`, `var_type`) VALUES
(1, 1, 'A1', 'Select from list:', 1),
(2, 2, 'A2', 'Region/Location:', 2),
(3, 3, 'A2', 'Name:', 2),
(4, 4, 'B1', 'Number of Competitors:', 3),
(5, 5, 'B2', 'High entry barrier:', 4),
(6, 5, 'B3', 'Please justify your response:', 2),
(7, 6, 'B4', 'Frequent interraction:', 5),
(8, 6, 'B5', 'If yes specify:', 2),
(9, 7, 'B6', 'Transparent market:', 5),
(10, 7, 'B7', 'If yes specify:', 2),
(11, 8, 'B8', 'Market growth for the inustry in the country(percentage):', 3),
(12, 8, 'B9', 'Market growth for the inustry in the world(percentage):', 3),
(13, 8, 'B10', 'Average market growth in the country for all industries(percentage):', 3),
(14, 9, 'B11', 'Significant fluctuations or business cycles:', 5),
(15, 9, 'B12', 'If yes specify:', 2),
(16, 10, 'B13', 'The Industries Current demand elastisity in the country:', 3),
(17, 10, 'B14', 'The Industries Past demand elastisity in the country:', 3),
(18, 10, 'B15', 'The Industries Past demand elastisity in the country:', 3),
(19, 10, 'B16', 'The Industries Past demand elastisity in the country:', 3),
(20, 10, 'B17', 'The Industries Current demand elastisity in the EU:', 3),
(21, 10, 'B18', 'The Industries Past demand elastisity in the EU:', 3),
(22, 10, 'B19', 'The Industries Past demand elastisity in the EU:', 3),
(23, 10, 'B20', 'The Industries Past demand elastisity in the EU:', 3),
(24, 11, 'B21', 'Buying Power Concentration:', 6),
(25, 11, 'B22', 'Please justify your response:', 2),
(26, 12, 'B23', 'Absenceof club and ntwork effect:', 5),
(27, 12, 'B24', 'If yes specify:', 2),
(28, 13, 'B25', 'Mature industry with  stabilized  technologies:', 4),
(29, 13, 'B26', 'Please justify your response:', 2),
(30, 14, 'B27', 'Symmetric costs:', 4),
(31, 14, 'B28', 'Please justify your response:', 2),
(32, 15, 'B29', 'Player capacities symmetric:', 4),
(33, 15, 'B30', 'Please justify your response:', 2),
(34, 16, 'B31', 'Homegeneus products on the market:', 4),
(35, 16, 'B32', 'Please justify your response:', 2),
(36, 17, 'B33', 'Multi market companies involvement:', 4),
(37, 17, 'B34', 'Please justify your response:', 2),
(38, 18, 'B35', 'Structural links bettwene competitors', 4),
(39, 18, 'B36', 'Please justify your response:', 2),
(40, 19, 'B37', 'Cooperative and other contractual agreements between the competitors:', 4),
(41, 19, 'B38', 'Please justify your response:', 2),
(42, 20, 'CFD1a', 'Price Index:', 3),
(43, 21, 'CFD1y', 'The latest year you have information from:', 3),
(44, 21, 'CFD11', 'Price Index four years before the date:', 3),
(45, 21, 'CFD12', 'Price Index three years before the date:', 3),
(46, 21, 'CFD13', 'Price Index two years before the date:', 3),
(47, 21, 'CFD14', 'Price Index a years before the date:', 3),
(48, 21, 'CFD15', 'Price Index on the mentioned year:', 3),
(49, 22, 'CFD1Q', 'Information source:', 2),
(50, 23, 'CFD2y', 'The latest year you have information from:', 3),
(51, 23, 'CFD21', 'Rate of return four years before the date:', 3),
(52, 23, 'CFD22', 'Rate of return three years before the date:', 3),
(53, 23, 'CFD23', 'Rate of return two years before the date:', 3),
(54, 23, 'CFD24', 'Rate of return a years before the date:', 3),
(55, 23, 'CFD25', 'Rate of return on the mentioned year:', 3),
(56, 24, 'CFD2Q', 'Information source:', 2),
(57, 25, 'CFD2yb', 'The latest year you have information from:', 3),
(58, 25, 'CFD212', 'Rate of return four years before the date:', 3),
(59, 25, 'CFD222', 'Rate of return three years before the date:', 3),
(60, 25, 'CFD232', 'Rate of return two years before the date:', 3),
(61, 25, 'CFD242', 'Rate of return a years before the date:', 3),
(62, 25, 'CFD252', 'Rate of return on the mentioned year:', 3),
(63, 26, 'CFD2Q2', 'Information source:', 2),
(64, 27, 'CFD3y', 'The latest year you have information from:', 3),
(65, 27, 'CFD31', 'Market share volatility index four years before the date:', 3),
(66, 27, 'CFD32', 'Market share volatility index three years before the date:', 3),
(67, 27, 'CFD33', 'Market share volatility index two years before the date:', 3),
(68, 27, 'CFD34', 'Market share volatility index a years before the date:', 3),
(69, 27, 'CFD35', 'Market share volatility index on the mentioned year:', 3),
(70, 28, 'CFD3Q', 'Information source:', 2),
(71, 29, 'CFD4B', 'Obvious Inovation gaps:', 4),
(72, 30, 'CFD4R', 'Description:', 2),
(73, 31, 'CFD5y', 'The latest year you have information from:', 3),
(74, 31, 'CFD51', 'Labor productivity four years before the date:', 3),
(75, 31, 'CFD52', 'Labor productivity three years before the date:', 3),
(76, 31, 'CFD53', 'Labor productivity two years before the date:', 3),
(77, 31, 'CFD54', 'Labor productivity a years before the date:', 3),
(78, 31, 'CFD55', 'Labor productivity on the mentioned year:', 3),
(79, 32, 'CFD5Q', 'Information source:', 2),
(80, 33, 'CFD5yb', 'The latest year you have information from:', 3),
(81, 33, 'CFD512', 'Labor compensation four years before the date:', 3),
(82, 33, 'CFD522', 'Labor compensation three years before the date:', 3),
(83, 33, 'CFD532', 'Labor compensation two years before the date:', 3),
(84, 33, 'CFD542', 'Labor compensation a years before the date:', 3),
(85, 33, 'CFD552', 'Labor compensation on the mentioned year:', 3),
(86, 34, 'CFD5Q2', 'Information source:', 2),
(87, 35, 'CFD6y', 'The latest year you have information from:', 3),
(88, 35, 'CFD61', 'Labor productivity four years before the date:', 3),
(89, 35, 'CFD62', 'Labor productivity three years before the date:', 3),
(90, 35, 'CFD63', 'Labor productivity two years before the date:', 3),
(91, 35, 'CFD64', 'Labor productivity a years before the date:', 3),
(92, 35, 'CFD65', 'Labor productivity on the mentioned year:', 3),
(93, 36, 'CFD6Q', 'Information source:', 2),
(94, 37, 'CFD6yb', 'The latest year you have information from:', 3),
(95, 37, 'CFD612', 'Labor compensation four years before the date:', 3),
(96, 37, 'CFD622', 'Labor compensation three years before the date:', 3),
(97, 37, 'CFD632', 'Labor compensation two years before the date:', 3),
(98, 37, 'CFD642', 'Labor compensation a years before the date:', 3),
(99, 37, 'CFD652', 'Labor compensation on the mentioned year:', 3),
(100, 38, 'CFD6Q2', 'Information source:', 2);

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE IF NOT EXISTS `visitors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `ip`, `country`) VALUES
(1, '94.3.12.252', 'United Kingdom'),
(2, '94.3.12.253', 'United Kingdom'),
(3, '94.3.12.255', 'localhost'),
(4, '169.254.16.208', 'Unknown');

-- --------------------------------------------------------

--
-- Table structure for table `worksheet`
--

CREATE TABLE IF NOT EXISTS `worksheet` (
  `w_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `w_name` varchar(30) NOT NULL,
  `w_type` tinyint(1) NOT NULL COMMENT '0 foor base questions, 1 for structural, 2-7:CFD',
  `w_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`w_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `worksheet`
--

INSERT INTO `worksheet` (`w_id`, `u_id`, `w_name`, `w_type`, `w_date`) VALUES
(8, 1, 'Try1', 1, '2014-11-27 17:05:46'),
(9, 1, 'try2', 1, '2014-11-27 17:09:10'),
(11, 1, 'qdfsdf', 3, '2014-12-01 14:31:33'),
(13, 1, 'try2', 5, '2014-12-09 19:45:06'),
(15, 1, 'asda', 1, '2014-12-21 18:07:01');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
