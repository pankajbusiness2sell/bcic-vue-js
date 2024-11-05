-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 07, 2024 at 03:19 PM
-- Server version: 5.7.44
-- PHP Version: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bciccom_beta_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `quote_new_info`
--

CREATE TABLE `quote_new_info` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `createdOn` varchar(100) DEFAULT NULL,
  `postcode` varchar(50) NOT NULL,
  `no_of_room` varchar(10) NOT NULL,
  `job_type` varchar(100) NOT NULL,
  `bath` varchar(20) NOT NULL,
  `booking_date` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quote_new_info`
--

INSERT INTO `quote_new_info` (`id`, `name`, `email`, `phone`, `comment`, `createdOn`, `postcode`, `no_of_room`, `job_type`, `bath`, `booking_date`) VALUES
(1, 'pankaj', NULL, NULL, NULL, '2024-10-04 05:23:10', '', '', '', '', ''),
(2, 'Amber Kimberley', 'a-k-mclean94@hotmail.com', '+61401756639', 'BCIC Perth_26092024_Lifetime_Scheduled', '2024-09-30T00:52:46+0000', '', '', '', '', ''),
(3, 'Pravinaa Dpravinaa', 'pravinaa1309@hotmail.com', '+61421632818', 'BCIC Perth_13092024', '2024-09-17T14:59:24+0000', '', '', '', '', ''),
(4, 'Pa\'ilagi Le-Mamea', 'Pailagi.lemamea@gmail.com', '+61498520981', 'BCIC Perth_26092024_Lifetime_Scheduled', '2024-10-03T10:21:31+0000', '', '', '', '', ''),
(5, 'Titet Gomez Schulz', 'lisetschulz@gmail.com', '+56998247728', 'BCIC Perth_26092024_Lifetime_Scheduled', '2024-10-05T10:10:26+0000', '', '', '', '', ''),
(6, 'Sandeep Singh', 'sandeep1s@yahoo.com', '+61420374302', 'BCIC Perth_26092024_Lifetime_Scheduled', '2024-10-06T21:39:13+0000', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `quote_new_info`
--
ALTER TABLE `quote_new_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quote_new_info`
--
ALTER TABLE `quote_new_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
