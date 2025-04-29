-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 29, 2025 at 05:09 AM
-- Server version: 10.11.10-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u941873099_rentap`
--

-- --------------------------------------------------------

--
-- Table structure for table `agreement_duration`
--

CREATE TABLE `agreement_duration` (
  `unit` varchar(3) NOT NULL,
  `rentee_id` int(11) NOT NULL,
  `move_in_date` date DEFAULT NULL,
  `remaining_days` int(11) DEFAULT 60,
  `last_updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agreement_duration`
--

INSERT INTO `agreement_duration` (`unit`, `rentee_id`, `move_in_date`, `remaining_days`, `last_updated`) VALUES
('F-1', 1, '2024-11-10', 0, '2025-04-04'),
('F-2', 2, '2024-12-18', 0, '2025-04-04'),
('F-3', 3, '2025-03-30', 57, '2025-04-04'),
('G-3', 9, '2025-03-07', 34, '2025-04-04'),
('G-4', 8, '2025-02-26', 25, '2025-04-04'),
('K-1', 4, '2025-02-25', 24, '2025-04-04'),
('K-2', 5, '2024-12-20', 0, '2025-04-04'),
('K-3', 6, '2025-01-15', 0, '2025-04-04'),
('K-4', 7, '2024-12-04', 0, '2025-04-04');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_request`
--

CREATE TABLE `maintenance_request` (
  `request_id` int(11) NOT NULL,
  `unit` varchar(3) DEFAULT NULL,
  `rentee_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `issue` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Pending','Resolved') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenance_request`
--

INSERT INTO `maintenance_request` (`request_id`, `unit`, `rentee_id`, `date`, `category`, `issue`, `description`, `status`) VALUES
(1, 'F-3', 3, '2025-03-30', 'Unit Maintenance', 'Plumbing', 'The bathroom sink has a leak.', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `m_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`m_name`, `password`) VALUES
('Manager', 'floridagalvan');

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `rentee_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` enum('Paid','Overdue') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_history`
--

INSERT INTO `payment_history` (`rentee_id`, `date`, `amount`, `status`) VALUES
(1, '2024-12-10', 12000.00, 'Paid'),
(1, '2025-01-10', 12000.00, 'Paid'),
(1, '2025-02-10', 12000.00, 'Paid'),
(1, '2025-03-10', 12000.00, 'Paid'),
(2, '2025-01-18', 12000.00, 'Paid'),
(2, '2025-02-18', 12000.00, 'Paid'),
(2, '2025-03-18', 12000.00, 'Paid'),
(3, '2025-03-30', 12000.00, 'Paid'),
(9, '2025-03-07', 12000.00, 'Paid'),
(8, '2025-02-26', 12000.00, 'Paid'),
(8, '2025-03-26', 12000.00, 'Paid'),
(4, '2025-02-25', 12000.00, 'Paid'),
(4, '2025-03-25', 12000.00, 'Paid'),
(5, '2025-01-20', 12000.00, 'Paid'),
(5, '2024-12-20', 12000.00, 'Paid'),
(5, '2025-02-20', 12000.00, 'Paid'),
(5, '2025-03-20', 12000.00, 'Paid'),
(6, '2024-12-15', 12000.00, 'Paid'),
(6, '2025-02-15', 12000.00, 'Paid'),
(6, '2025-03-15', 12000.00, 'Paid'),
(7, '2024-12-04', 12000.00, 'Paid'),
(7, '2025-01-04', 12000.00, 'Paid'),
(7, '2025-02-04', 12000.00, 'Paid'),
(7, '2025-03-04', 12000.00, 'Paid'),
(7, '2025-04-04', 12000.00, 'Paid'),
(9, '2025-04-07', 12000.00, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `pending_payments`
--

CREATE TABLE `pending_payments` (
  `rentee_id` int(11) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` enum('Pending','Paid','Overdue') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pending_payments`
--

INSERT INTO `pending_payments` (`rentee_id`, `due_date`, `amount`, `status`) VALUES
(1, '2025-04-10', 12000.00, 'Pending'),
(2, '2025-04-18', 12000.00, 'Pending'),
(3, '2025-04-30', 12000.00, 'Pending'),
(8, '2025-04-26', 12000.00, 'Pending'),
(4, '2025-04-25', 12000.00, 'Pending'),
(5, '2025-04-20', 12000.00, 'Pending'),
(6, '2025-04-15', 12000.00, 'Pending'),
(7, '2025-05-04', 12000.00, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `qr_code`
--

CREATE TABLE `qr_code` (
  `id` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qr_code`
--

INSERT INTO `qr_code` (`id`, `picture`) VALUES
(1, 'rentap_qrcode.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rentee`
--

CREATE TABLE `rentee` (
  `rentee_id` int(11) NOT NULL,
  `unit` varchar(3) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `facebook_profile` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(11) DEFAULT NULL,
  `pin` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentee`
--

INSERT INTO `rentee` (`rentee_id`, `unit`, `first_name`, `last_name`, `facebook_profile`, `email`, `phone_number`, `pin`) VALUES
(1, 'F-1', 'Merlyn', 'Santos', 'merlyn.santos', 'innocuouspot@gmail.com', '09167794168', '062804'),
(2, 'F-2', 'Carmelita', 'Ronzales', 'carmelita_ronzales', 'farachann06@gmail.com', '09188078126', '101010'),
(3, 'F-3', 'Rosalyn', 'Gomez', 'rosalyn_gomez', 'eduardgomez564@gmail.com', '09456338756', '222222'),
(4, 'K-1', 'Karen', 'Santos', 'k_santos', 'karen_santos@gmail.com', '09205482875', '218222'),
(5, 'K-2', 'Ruel', 'Rapio', 'ruel_rapio', 'ruel_rapio@gmail.com', '09270024012', '121212'),
(6, 'K-3', 'Elaine', 'Tan', 'elaine_tan', 'elaine_tan@gmail.com', '09399079313', '079313'),
(7, 'K-4', 'Bernadette', 'Gonzales', 'bern_gonzales', 'riananadura1@gmail.com', '09243567534', '222107'),
(8, 'G-4', 'Coleen', 'Navarra', 'coleen_navv', 'coleen_navara@gmail.com', '09216117794', '232323'),
(9, 'G-3', 'Gilbert', 'Katipunan', 'gilbert_katipunan', 'gilbert_katipunan@gmail.com', '09456672131', '555555');

-- --------------------------------------------------------

--
-- Table structure for table `rentee_archive`
--

CREATE TABLE `rentee_archive` (
  `rentee_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `unit` varchar(3) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `move_out_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rentee_payment`
--

CREATE TABLE `rentee_payment` (
  `rentee_id` int(11) DEFAULT NULL,
  `payment_picture` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentee_payment`
--

INSERT INTO `rentee_payment` (`rentee_id`, `payment_picture`, `date`) VALUES
(2, 'rentap_qrcode.jpg', '2025-04-01'),
(7, 'sample_gcash_receipt.jpg', '2025-04-01'),
(9, 'hartu.jpg', '2025-04-07'),
(9, 'hartu.jpg', '2025-04-07');

-- --------------------------------------------------------

--
-- Table structure for table `unit_status`
--

CREATE TABLE `unit_status` (
  `unit` varchar(3) NOT NULL,
  `status` enum('Available','Occupied') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_status`
--

INSERT INTO `unit_status` (`unit`, `status`) VALUES
('F-1', 'Occupied'),
('F-2', 'Occupied'),
('F-3', 'Occupied'),
('F-4', 'Available'),
('G-1', 'Available'),
('G-2', 'Available'),
('G-3', 'Occupied'),
('G-4', 'Occupied'),
('K-1', 'Occupied'),
('K-2', 'Occupied'),
('K-3', 'Occupied'),
('K-4', 'Occupied');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agreement_duration`
--
ALTER TABLE `agreement_duration`
  ADD PRIMARY KEY (`unit`,`rentee_id`),
  ADD KEY `rentee_id` (`rentee_id`);

--
-- Indexes for table `maintenance_request`
--
ALTER TABLE `maintenance_request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `unit` (`unit`),
  ADD KEY `rentee_id` (`rentee_id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`m_name`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD KEY `rentee_id` (`rentee_id`);

--
-- Indexes for table `pending_payments`
--
ALTER TABLE `pending_payments`
  ADD KEY `rentee_id` (`rentee_id`);

--
-- Indexes for table `qr_code`
--
ALTER TABLE `qr_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rentee`
--
ALTER TABLE `rentee`
  ADD PRIMARY KEY (`rentee_id`),
  ADD KEY `unit` (`unit`);

--
-- Indexes for table `rentee_payment`
--
ALTER TABLE `rentee_payment`
  ADD KEY `rentee_id` (`rentee_id`);

--
-- Indexes for table `unit_status`
--
ALTER TABLE `unit_status`
  ADD PRIMARY KEY (`unit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `maintenance_request`
--
ALTER TABLE `maintenance_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `qr_code`
--
ALTER TABLE `qr_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rentee`
--
ALTER TABLE `rentee`
  MODIFY `rentee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agreement_duration`
--
ALTER TABLE `agreement_duration`
  ADD CONSTRAINT `agreement_duration_ibfk_1` FOREIGN KEY (`unit`) REFERENCES `unit_status` (`unit`) ON DELETE CASCADE,
  ADD CONSTRAINT `agreement_duration_ibfk_2` FOREIGN KEY (`rentee_id`) REFERENCES `rentee` (`rentee_id`) ON DELETE CASCADE;

--
-- Constraints for table `maintenance_request`
--
ALTER TABLE `maintenance_request`
  ADD CONSTRAINT `maintenance_request_ibfk_1` FOREIGN KEY (`unit`) REFERENCES `unit_status` (`unit`) ON DELETE SET NULL,
  ADD CONSTRAINT `maintenance_request_ibfk_2` FOREIGN KEY (`rentee_id`) REFERENCES `rentee` (`rentee_id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD CONSTRAINT `payment_history_ibfk_1` FOREIGN KEY (`rentee_id`) REFERENCES `rentee` (`rentee_id`) ON DELETE CASCADE;

--
-- Constraints for table `pending_payments`
--
ALTER TABLE `pending_payments`
  ADD CONSTRAINT `pending_payments_ibfk_1` FOREIGN KEY (`rentee_id`) REFERENCES `rentee` (`rentee_id`) ON DELETE CASCADE;

--
-- Constraints for table `rentee`
--
ALTER TABLE `rentee`
  ADD CONSTRAINT `rentee_ibfk_1` FOREIGN KEY (`unit`) REFERENCES `unit_status` (`unit`) ON DELETE SET NULL;

--
-- Constraints for table `rentee_payment`
--
ALTER TABLE `rentee_payment`
  ADD CONSTRAINT `rentee_payment_ibfk_1` FOREIGN KEY (`rentee_id`) REFERENCES `rentee` (`rentee_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
