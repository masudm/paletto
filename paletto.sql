-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2016 at 10:32 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paletto`
--
CREATE DATABASE IF NOT EXISTS `paletto` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `paletto`;

-- --------------------------------------------------------

--
-- Table structure for table `palletes`
--

DROP TABLE IF EXISTS `palletes`;
CREATE TABLE IF NOT EXISTS `palletes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `col1` varchar(11) NOT NULL,
  `col2` varchar(11) NOT NULL,
  `col3` varchar(11) NOT NULL,
  `col4` varchar(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
