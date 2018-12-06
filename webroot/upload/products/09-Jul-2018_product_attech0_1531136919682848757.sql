-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 27, 2018 at 09:08 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crmsense`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_opportunities_process`
--

CREATE TABLE `tbl_opportunities_process` (
  `opportunities_process_id` int(11) NOT NULL,
  `opportunities_id` int(11) NOT NULL,
  `opportunities_process_date` date NOT NULL,
  `opportunities_process_type` varchar(255) NOT NULL,
  `opportunities_process_status` tinyint(4) NOT NULL DEFAULT '1',
  `opportunities_process_created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_opportunities_process`
--

INSERT INTO `tbl_opportunities_process` (`opportunities_process_id`, `opportunities_id`, `opportunities_process_date`, `opportunities_process_type`, `opportunities_process_status`, `opportunities_process_created_date`) VALUES
(2, 1, '2017-06-12', 'initial-discussion', 1, '2017-06-12'),
(3, 1, '2017-06-13', 'initial-discussion', 1, '2017-06-12'),
(4, 4, '2017-06-13', 'initial-discussion', 1, '2017-06-12'),
(5, 4, '2017-06-12', 'initial-discussion', 1, '2017-06-12'),
(6, 4, '2017-06-12', 'initial-discussion', 1, '2017-06-12'),
(7, 5, '2017-06-13', 'initial-discussion', 1, '2017-06-12'),
(8, 6, '2017-06-13', 'presentation', 1, '2017-06-12'),
(9, 5, '2017-06-13', 'initial-discussion', 1, '2017-06-12'),
(10, 5, '2017-06-13', 'sales-done', 1, '2017-06-12'),
(11, 4, '2017-06-13', 'initial-discussion', 1, '2017-06-13'),
(12, 7, '2017-06-13', 'initial-discussion', 1, '2017-06-13'),
(13, 6, '2017-06-13', 'initial-discussion', 1, '2017-06-13'),
(14, 6, '2017-06-13', 'initial-discussion', 1, '2017-06-13'),
(15, 6, '2017-06-14', 'presentation', 1, '2017-06-13'),
(16, 5, '2017-06-15', 'presentation', 1, '2017-06-13'),
(17, 11, '2017-07-06', 'presentation', 1, '2017-07-06'),
(18, 11, '2017-07-06', 'presentation', 1, '2017-07-06'),
(19, 6, '2017-07-06', 'presentation', 1, '2017-07-06'),
(20, 6, '2017-07-07', 'presentation', 1, '2017-07-06'),
(21, 12, '2017-07-07', 'initial-discussion', 1, '2017-07-07'),
(22, 12, '2017-07-15', 'sales-done', 1, '2017-07-07'),
(23, 8, '2017-09-19', 'initial-discussion', 1, '2017-09-19'),
(24, 8, '2017-09-12', 'initial-discussion', 1, '2017-09-19'),
(25, 13, '2017-09-19', 'initial-discussion', 1, '2017-09-19'),
(26, 13, '2017-09-26', 'sales-done', 1, '2017-09-19'),
(27, 14, '2017-09-19', 'initial-discussion', 1, '2017-09-19'),
(28, 14, '2017-09-20', 'initial-discussion', 1, '2017-09-19'),
(29, 15, '2017-09-19', 'initial-discussion', 1, '2017-09-19'),
(30, 15, '2017-09-20', 'initial-discussion', 1, '2017-09-19'),
(31, 9, '0000-00-00', 'initial-discussion', 1, '2018-06-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_opportunities_process`
--
ALTER TABLE `tbl_opportunities_process`
  ADD PRIMARY KEY (`opportunities_process_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_opportunities_process`
--
ALTER TABLE `tbl_opportunities_process`
  MODIFY `opportunities_process_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
