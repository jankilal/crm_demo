-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 03, 2018 at 12:51 PM
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
-- Database: `new_crmsense`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leads`
--

CREATE TABLE `tbl_leads` (
  `id` int(11) NOT NULL,
  `lead_id` varchar(255) DEFAULT NULL,
  `lead_name` varchar(255) NOT NULL DEFAULT '',
  `organization` varchar(255) NOT NULL DEFAULT '',
  `lead_status_id` int(11) DEFAULT '0',
  `lead_source_id` int(11) DEFAULT '0',
  `industry` varchar(255) NOT NULL DEFAULT '',
  `salutation` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text,
  `country` varchar(255) NOT NULL DEFAULT '',
  `state` varchar(255) NOT NULL DEFAULT '',
  `zip_code` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `designation` varchar(255) NOT NULL DEFAULT '',
  `email_opt_out` int(11) NOT NULL DEFAULT '0',
  `mobile_number` varchar(255) NOT NULL DEFAULT '',
  `phone_number` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `notes` text,
  `skype` varchar(255) NOT NULL DEFAULT '',
  `twitter` varchar(255) NOT NULL DEFAULT '',
  `annual_revenue` float NOT NULL DEFAULT '0',
  `secondary_email` varchar(255) DEFAULT NULL,
  `stages` varchar(255) NOT NULL DEFAULT '',
  `website` varchar(255) DEFAULT NULL,
  `current_status` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '1 = "Lead" , 2 = "Opportunity" , 3 = "Client"',
  `lead_assign_status` enum('0','1') NOT NULL DEFAULT '0',
  `lead_status` int(11) NOT NULL DEFAULT '0',
  `create_by` varchar(255) DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `sync_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `opportunity_status` int(11) NOT NULL,
  `opportunities_state_reason_id` int(11) NOT NULL,
  `close_date` date NOT NULL,
  `expected_revenue` varchar(255) NOT NULL DEFAULT '',
  `new_link` varchar(255) NOT NULL DEFAULT '',
  `contact_name` varchar(255) NOT NULL,
  `permission` text NOT NULL,
  `probability` int(11) NOT NULL,
  `next_action` varchar(255) NOT NULL DEFAULT '',
  `next_action_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_leads`
--

INSERT INTO `tbl_leads` (`id`, `lead_id`, `lead_name`, `organization`, `lead_status_id`, `lead_source_id`, `industry`, `salutation`, `name`, `address`, `country`, `state`, `zip_code`, `city`, `title`, `email`, `designation`, `email_opt_out`, `mobile_number`, `phone_number`, `facebook`, `notes`, `skype`, `twitter`, `annual_revenue`, `secondary_email`, `stages`, `website`, `current_status`, `lead_assign_status`, `lead_status`, `create_by`, `update_by`, `create_date`, `update_date`, `sync_date_time`, `opportunity_status`, `opportunities_state_reason_id`, `close_date`, `expected_revenue`, `new_link`, `contact_name`, `permission`, `probability`, `next_action`, `next_action_date`) VALUES
(1, '1530515502312', 'lead1', 'lead1', 7, 0, '', 'Select', 'radha', 'hgjkgh hgu ', '99', '', '123654', 'bihar', '', 'rs@gmail.com', 'asdfghjk xcvbnm,', 1, '1236547898', '2321654987', 'rs@gmail.com', NULL, '123', 'rg@twitter', 500, 'rsg@gmail.com', 'new', '', '2', '0', 1, '0', '1', '2018-07-02', '2018-07-02', '2018-07-02 07:11:42', 1, 0, '2018-07-02', 'khgjlk', 'jhk', '', '', 0, '', '0000-00-00'),
(2, '1530522555829', 'lead2', 'lead2', 3, 1, 'ASP (Application Service Provider)', 'Mr', 'jay', 'asffb huguyh hgijb jhkhb ', '99', '1481', '123654', 'bihar', '', 'jay@gmail.com', 'mjnlkh9 kuhjib kghkjh b,kghjikhb kjkb ', 1, '1478523698', '1234567894', 'abc@gmail.com', NULL, '123', 'abc@twitter', 700, 'bca@gmail.com', 'new', 'https://mail.google.com/', '2', '0', 1, '1', '0', '2018-07-02', NULL, '2018-07-02 09:09:15', 1, 0, '2018-07-02', 'oihi', 'kjhkj', '', '', 0, '', '0000-00-00'),
(3, '1530523916718', 'lead3', 'lead3', 4, 0, '', 'Select', 'aman', 'bihar bihar ', '99', '', '123654', 'bihar', '', 'aman@gmail.com', 'qwertyu jnbj', 1, '9874563212', '1236547895', 'aman@gmail.com', NULL, '2654', 'aman@twitter', 555, 'gangrade1@gmail.com', '', '', '1', '0', 1, '0', '1', '2018-07-02', '2018-07-02', '2018-07-02 09:31:56', 0, 0, '0000-00-00', '', '', '', '', 20, '', '0000-00-00'),
(4, '1530524116430', 'lead4', 'lead4', 4, 1, 'ASP (Application Service Provider)', 'Mr', 'radha', 'mnbv vghj yg', '99', '1475', '123654', 'indore', '', 'radha@gmail.com', 'qwerfghjm, tryujk,lijuhb', 1, '3571598523', '6547893615', 'radha@gmail.com', NULL, '2654', 'radh.twitter', 777, 'rg@gmail.com', '', 'http//vfg@.com', '1', '0', 1, '1', '0', '2018-07-02', NULL, '2018-07-02 09:35:16', 0, 0, '0000-00-00', '', '', '', '', 1, '', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_leads`
--
ALTER TABLE `tbl_leads`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_leads`
--
ALTER TABLE `tbl_leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
