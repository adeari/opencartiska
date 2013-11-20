-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 20, 2013 at 11:18 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.9-4ubuntu2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `opencartiska`
--

-- --------------------------------------------------------

--
-- Table structure for table `oc_jne`
--

CREATE TABLE IF NOT EXISTS `oc_jne` (
  `noresi` varchar(100) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `kurir` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`noresi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
