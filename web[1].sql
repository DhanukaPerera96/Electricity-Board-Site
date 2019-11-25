-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 22, 2019 at 09:23 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web`
--

-- --------------------------------------------------------

--
-- Table structure for table `usertbl`
--

DROP TABLE IF EXISTS `usertbl`;
CREATE TABLE IF NOT EXISTS `usertbl` (
  `fullname` varchar(500) NOT NULL,
  `nic` varchar(15) NOT NULL,
  `address` varchar(500) NOT NULL,
  `units` int(11) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  PRIMARY KEY (`nic`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertbl`
--

INSERT INTO `usertbl` (`fullname`, `nic`, `address`, `units`, `date`) VALUES
('Dhanuka Perera', '962060340V', '12/14,Uswatta', 0, '2019-08-21'),
('D Perera', '966020340V', 'Bo 12/14, uswatta, 1st lane, moratuwa', 140, '2019-07-23'),
('D Madhushan', '969696969V', 'Moratuwa', 100, '2019-08-22'),
('Dhanuka', '110101010V', 'Moratuwa', 70, '2019-08-22'),
('Perera Dhanuka', '123456789V', 'khgadkhgasdhdsga', 0, '2019-07-25'),
('Dhanuka M Perera', '111111111V', 'hgdshgdhgd', 0, '2019-08-22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
