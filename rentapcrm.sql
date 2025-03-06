-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2025 at 01:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentapcrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `maintenancerequests`
--

CREATE TABLE `maintenancerequests` (
  `request_id` int(11) NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `rentee_id` int(11) DEFAULT NULL,
  `request_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Pending','In Progress','Completed') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `rentee_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `notification_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `rentee_id` int(11) DEFAULT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `due_date` date NOT NULL,
  `e_receipt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `peakrentalperiods`
-- (See below for the actual view)
--
CREATE TABLE `peakrentalperiods` (
`month` int(2)
,`total_payments` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `rentalreport`
-- (See below for the actual view)
--
CREATE TABLE `rentalreport` (
`unit_number` varchar(10)
,`full_name` varchar(100)
,`amount_paid` decimal(10,2)
,`payment_date` date
,`due_date` date
);

-- --------------------------------------------------------

--
-- Table structure for table `rentees`
--

CREATE TABLE `rentees` (
  `rentee_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` int(11) NOT NULL,
  `unit_number` varchar(10) NOT NULL,
  `status` enum('Available','Occupied','Under Maintenance') NOT NULL,
  `monthly_rent` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure for view `peakrentalperiods`
--
DROP TABLE IF EXISTS `peakrentalperiods`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `peakrentalperiods`  AS SELECT month(`payments`.`payment_date`) AS `month`, count(`payments`.`payment_id`) AS `total_payments` FROM `payments` GROUP BY month(`payments`.`payment_date`) ORDER BY count(`payments`.`payment_id`) DESC ;

-- --------------------------------------------------------

--
-- Structure for view `rentalreport`
--
DROP TABLE IF EXISTS `rentalreport`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rentalreport`  AS SELECT `u`.`unit_number` AS `unit_number`, `r`.`full_name` AS `full_name`, `p`.`amount_paid` AS `amount_paid`, `p`.`payment_date` AS `payment_date`, `p`.`due_date` AS `due_date` FROM ((`payments` `p` join `rentees` `r` on(`p`.`rentee_id` = `r`.`rentee_id`)) join `units` `u` on(`r`.`unit_id` = `u`.`unit_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `maintenancerequests`
--
ALTER TABLE `maintenancerequests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `rentee_id` (`rentee_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `rentee_id` (`rentee_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `rentee_id` (`rentee_id`);

--
-- Indexes for table `rentees`
--
ALTER TABLE `rentees`
  ADD PRIMARY KEY (`rentee_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `maintenancerequests`
--
ALTER TABLE `maintenancerequests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rentees`
--
ALTER TABLE `rentees`
  MODIFY `rentee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `maintenancerequests`
--
ALTER TABLE `maintenancerequests`
  ADD CONSTRAINT `maintenancerequests_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`),
  ADD CONSTRAINT `maintenancerequests_ibfk_2` FOREIGN KEY (`rentee_id`) REFERENCES `rentees` (`rentee_id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`rentee_id`) REFERENCES `rentees` (`rentee_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`rentee_id`) REFERENCES `rentees` (`rentee_id`);

--
-- Constraints for table `rentees`
--
ALTER TABLE `rentees`
  ADD CONSTRAINT `rentees_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
