-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2014 at 02:29 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mis_irc`
--

-- --------------------------------------------------------

--
-- Table structure for table `sub_topic`
--

CREATE TABLE IF NOT EXISTS `sub_topic` (
  `subtopic_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subtopic_name` varchar(100) NOT NULL,
  `topic_id` bigint(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `flag` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`subtopic_id`),
  UNIQUE KEY `subtopic_id` (`subtopic_id`),
  KEY `subtopic_ibfk_1` (`user_id`),
  KEY `subtopic_ibfk_2` (`topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sub_topic`
--

INSERT INTO `sub_topic` (`subtopic_id`, `subtopic_name`, `topic_id`, `created`, `flag`, `user_id`) VALUES
(2, 'Mantapx', 1, '2014-09-30 07:17:04', 0, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sub_topic`
--
ALTER TABLE `sub_topic`
  ADD CONSTRAINT `sub_topic_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
