-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 01, 2025 at 12:38 AM
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

DELIMITER $$
--
-- Procedures
--
CREATE PROCEDURE `add_agreement_duration` (IN `p_unit` VARCHAR(3), IN `p_rentee_id` INT, IN `p_move_in_date` DATE, IN `p_remaining_days` INT)   BEGIN
    INSERT INTO Agreement_Duration (unit, rentee_id, move_in_date, remaining_days)
    VALUES (p_unit, p_rentee_id, p_move_in_date, p_remaining_days);
END$$

CREATE PROCEDURE `add_maintenance_request` (IN `p_unit` VARCHAR(3), IN `p_rentee_id` INT, IN `p_date` DATE, IN `p_category` VARCHAR(50), IN `p_issue` VARCHAR(100), IN `p_description` TEXT, IN `p_status` ENUM('Pending','Resolved'))   BEGIN
    INSERT INTO Maintenance_Request (unit, rentee_id, date, category, issue, description, status)
    VALUES (p_unit, p_rentee_id, p_date, p_category, p_issue, p_description, p_status);
END$$

CREATE PROCEDURE `add_payment` (IN `p_rentee_id` INT, IN `p_amount` DECIMAL(10,2))   BEGIN
    INSERT INTO Payment_History (rentee_id, date, amount, status)
    VALUES (p_rentee_id, CURDATE(), p_amount, 'Paid');
END$$

CREATE PROCEDURE `add_payment_record` (IN `p_rentee_id` INT, IN `p_date` DATE, IN `p_amount` DECIMAL(10,2), IN `p_status` ENUM('Paid','Overdue'))   BEGIN
    INSERT INTO Payment_History (rentee_id, date, amount, status)
    VALUES (p_rentee_id, p_date, p_amount, p_status);
END$$

CREATE PROCEDURE `add_rentee` (IN `p_unit` VARCHAR(3), IN `p_first_name` VARCHAR(50), IN `p_last_name` VARCHAR(50), IN `p_facebook_profile` VARCHAR(255), IN `p_email` VARCHAR(100), IN `p_phone_number` VARCHAR(20), IN `p_pin` INT(6))   BEGIN
    INSERT INTO Rentee (unit, first_name, last_name, facebook_profile, email, phone_number, pin)
    VALUES (p_unit, p_first_name, p_last_name, p_facebook_profile, p_email, p_phone_number, p_pin);
END$$

CREATE PROCEDURE `delete_agreement_duration` (IN `p_unit` VARCHAR(3), IN `p_rentee_id` INT)   BEGIN
    DELETE FROM Agreement_Duration
    WHERE unit = p_unit AND rentee_id = p_rentee_id;
END$$

CREATE PROCEDURE `delete_maintenance_request` (IN `p_request_id` INT)   BEGIN
    DELETE FROM Maintenance_Request
    WHERE request_id = p_request_id;
END$$

CREATE PROCEDURE `delete_payment_record` (IN `p_rentee_id` INT, IN `p_date` DATE)   BEGIN
    DELETE FROM Payment_History
    WHERE rentee_id = p_rentee_id AND date = p_date;
END$$

CREATE PROCEDURE `delete_rentee` (IN `p_rentee_id` INT)   BEGIN
    DELETE FROM Rentee
    WHERE rentee_id = p_rentee_id;
END$$

CREATE PROCEDURE `edit_payment_record` (IN `p_rentee_id` INT, IN `p_date` DATE, IN `p_amount` DECIMAL(10,2), IN `p_status` ENUM('Paid','Overdue'))   BEGIN
    UPDATE Payment_History
    SET date = p_date,
        amount = p_amount,
        status = p_status
    WHERE rentee_id = p_rentee_id AND date = p_date;
END$$

CREATE PROCEDURE `edit_rentee` (IN `p_rentee_id` INT, IN `p_unit` VARCHAR(3), IN `p_first_name` VARCHAR(50), IN `p_last_name` VARCHAR(50), IN `p_facebook_profile` VARCHAR(255), IN `p_email` VARCHAR(100), IN `p_phone_number` VARCHAR(20))   BEGIN
    UPDATE Rentee
    SET unit = p_unit,
        first_name = p_first_name,
        last_name = p_last_name,
        facebook_profile = p_facebook_profile,
        email = p_email,
        phone_number = p_phone_number
    WHERE rentee_id = p_rentee_id;
END$$

CREATE PROCEDURE `validate_manager_login` (IN `p_name` VARCHAR(50), IN `p_password` VARCHAR(255))   BEGIN
    SELECT m_name
    FROM Manager
    WHERE m_name = p_name AND password = p_password;
END$$

CREATE PROCEDURE `validate_rentee_login` (IN `p_unit` VARCHAR(3), IN `p_first_name` VARCHAR(50), IN `p_pin` INT(6))   BEGIN
    SELECT rentee_id
    FROM Rentee
    WHERE unit = p_unit AND first_name = p_first_name AND pin = p_pin;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `active_rentees`
-- (See below for the actual view)
--
CREATE TABLE `active_rentees` (
`rentee_id` int(11)
,`first_name` varchar(50)
,`last_name` varchar(50)
,`unit` varchar(3)
,`status` enum('Available','Occupied')
);

-- --------------------------------------------------------

--
-- Table structure for table `agreement_duration`
--

CREATE TABLE `agreement_duration` (
  `unit` varchar(3) NOT NULL,
  `rentee_id` int(11) NOT NULL,
  `move_in_date` date DEFAULT NULL,
  `remaining_days` int(11) DEFAULT 60
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agreement_duration`
--

INSERT INTO `agreement_duration` (`unit`, `rentee_id`, `move_in_date`, `remaining_days`) VALUES
('F-1', 1, '2024-11-10', 0),
('F-2', 2, '2024-12-18', 0),
('F-3', 3, '2025-03-30', 60),
('G-3', 9, '2025-03-07', 37),
('G-4', 8, '2025-02-26', 28),
('K-1', 4, '2025-02-25', 27),
('K-2', 5, '2024-12-20', 0),
('K-3', 6, '2025-01-15', 0),
('K-4', 7, '2024-12-04', 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `apartment_management`
-- (See below for the actual view)
--
CREATE TABLE `apartment_management` (
`status` enum('Available','Occupied')
,`rentee_full_name` varchar(101)
,`facebook_profile` varchar(255)
,`email` varchar(100)
,`phone_number` varchar(11)
,`move_in_date` date
);

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

-- --------------------------------------------------------

--
-- Table structure for table `pending_payments`
--

CREATE TABLE `pending_payments` (
  `rentee_id` int(11) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` enum('Pending','Paid') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pending_payments`
--

INSERT INTO `pending_payments` (`rentee_id`, `due_date`, `amount`, `status`) VALUES
(1, '2025-04-10', 12000.00, 'Pending'),
(2, '2025-04-18', 12000.00, 'Pending'),
(3, '2025-04-30', 12000.00, 'Pending'),
(9, '2025-04-07', 12000.00, 'Pending'),
(8, '2025-04-26', 12000.00, 'Pending'),
(4, '2025-04-25', 12000.00, 'Pending'),
(5, '2025-04-20', 12000.00, 'Pending'),
(6, '2025-04-15', 12000.00, 'Pending'),
(7, '2025-04-04', 12000.00, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `qr_code`
--

CREATE TABLE `qr_code` (
  `id` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'F-1', 'Merlyn', 'Cuanco', 'merlyn_cuanco', 'merlyncuanco@gmail.com', '09976481187', '000000'),
(2, 'F-2', 'Carmelita', 'Ronzales', 'carmelita_ronzales', 'carmelita_ronzales12@gmail.com', '09188078126', '101010'),
(3, 'F-3', 'Rosalyn', 'Gomez', 'rosalyn_gomez', 'rosalyn_gomez23@gmail.co', '09456338756', '222222'),
(4, 'K-1', 'Karen', 'Santos', 'k_santos', 'karen_santos@gmail.com', '09205482875', '218222'),
(5, 'K-2', 'Ruel', 'Rapio', 'ruel_rapio', 'ruel_rapio@gmail.com', '09270024012', '121212'),
(6, 'K-3', 'Elaine', 'Tan', 'elaine_tan', 'elaine_tan@gmail.com', '09399079313', '079313'),
(7, 'K-4', 'Bernadette', 'Gonzales', 'bern_gonzales', 'bern_gonzales@gmail.com', '09243567534', '222107'),
(8, 'G-4', 'Coleen', 'Navarra', 'coleen_navv', 'coleen_navara@gmail.com', '09216117794', '232323'),
(9, 'G-3', 'Gilbert', 'Katipunan', 'gilbert_katipunan', 'gilbert_katipunan@gmail.com', '09456672131', '555555');

--
-- Triggers `rentee`
--
DELIMITER $$
CREATE TRIGGER `ArchiveRentee` AFTER DELETE ON `rentee` FOR EACH ROW BEGIN
    INSERT INTO Rentee_Archive (rentee_id, first_name, last_name, unit, contact_number, email, move_out_date)
    VALUES (OLD.rentee_id, OLD.first_name, OLD.last_name, OLD.unit, OLD.phone_number, OLD.email, CURDATE());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_rentee_delete` AFTER DELETE ON `rentee` FOR EACH ROW BEGIN
    UPDATE unit_status
    SET status = 'Available'
    WHERE unit = OLD.unit;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_rentee_insert` AFTER INSERT ON `rentee` FOR EACH ROW BEGIN
    UPDATE unit_status
    SET status = 'Occupied'
    WHERE unit = NEW.unit;
END
$$
DELIMITER ;

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

-- --------------------------------------------------------

--
-- Structure for view `active_rentees`
--
DROP TABLE IF EXISTS `active_rentees`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `active_rentees`  AS SELECT `r`.`rentee_id` AS `rentee_id`, `r`.`first_name` AS `first_name`, `r`.`last_name` AS `last_name`, `r`.`unit` AS `unit`, `u`.`status` AS `status` FROM (`rentee` `r` join `unit_status` `u` on(`r`.`unit` = `u`.`unit`)) WHERE `u`.`status` = 'Occupied' ;

-- --------------------------------------------------------

--
-- Structure for view `apartment_management`
--
DROP TABLE IF EXISTS `apartment_management`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `apartment_management`  AS SELECT `ar`.`status` AS `status`, concat(`ar`.`first_name`,' ',`ar`.`last_name`) AS `rentee_full_name`, `r`.`facebook_profile` AS `facebook_profile`, `r`.`email` AS `email`, `r`.`phone_number` AS `phone_number`, `ad`.`move_in_date` AS `move_in_date` FROM ((`active_rentees` `ar` join `agreement_duration` `ad` on(`ar`.`rentee_id` = `ad`.`rentee_id`)) left join `rentee` `r` on(`ar`.`rentee_id` = `r`.`rentee_id`)) ;

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
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qr_code`
--
ALTER TABLE `qr_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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

DELIMITER $$
--
-- Events
--
CREATE EVENT `update_overdue_status` ON SCHEDULE EVERY 1 DAY STARTS '2025-03-30 14:40:54' ON COMPLETION PRESERVE ENABLE DO BEGIN
    UPDATE Payment_History
    SET status = 'Overdue'
    WHERE DATEDIFF(CURDATE(), date) > 7 AND status = 'Paid';
END$$

CREATE EVENT `update_remaining_days` ON SCHEDULE EVERY 1 MINUTE STARTS '2025-03-30 19:30:42' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE Agreement_Duration
    SET remaining_days = GREATEST(60 - DATEDIFF(CURDATE(), move_in_date), 0)
    WHERE move_in_date <= CURDATE();
END$$

CREATE EVENT `create_monthly_pending` ON SCHEDULE EVERY 1 MONTH STARTS '2025-03-30 19:53:52' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    INSERT INTO Pending_Payments (rentee_id, due_date, amount, status)
    SELECT 
        ad.rentee_id,
        IF(DAY(LAST_DAY(DATE_ADD(ad.move_in_date, INTERVAL TIMESTAMPDIFF(MONTH, ad.move_in_date, CURDATE()) + 1 MONTH))) >= DAY(ad.move_in_date),
            DATE_ADD(ad.move_in_date, INTERVAL TIMESTAMPDIFF(MONTH, ad.move_in_date, CURDATE()) + 1 MONTH),
            LAST_DAY(DATE_ADD(ad.move_in_date, INTERVAL TIMESTAMPDIFF(MONTH, ad.move_in_date, CURDATE()) + 1 MONTH))
        ) AS due_date,
        12000.00,
        'Pending'
    FROM Agreement_Duration ad
    WHERE ad.move_in_date <= CURDATE()
    AND NOT EXISTS (
        SELECT 1
        FROM Pending_Payments pp
        WHERE pp.rentee_id = ad.rentee_id
        AND MONTH(pp.due_date) = MONTH(
            IF(DAY(LAST_DAY(DATE_ADD(ad.move_in_date, INTERVAL TIMESTAMPDIFF(MONTH, ad.move_in_date, CURDATE()) + 1 MONTH))) >= DAY(ad.move_in_date),
                DATE_ADD(ad.move_in_date, INTERVAL TIMESTAMPDIFF(MONTH, ad.move_in_date, CURDATE()) + 1 MONTH),
                LAST_DAY(DATE_ADD(ad.move_in_date, INTERVAL TIMESTAMPDIFF(MONTH, ad.move_in_date, CURDATE()) + 1 MONTH))
            )
        )
        AND YEAR(pp.due_date) = YEAR(
            IF(DAY(LAST_DAY(DATE_ADD(ad.move_in_date, INTERVAL TIMESTAMPDIFF(MONTH, ad.move_in_date, CURDATE()) + 1 MONTH))) >= DAY(ad.move_in_date),
                DATE_ADD(ad.move_in_date, INTERVAL TIMESTAMPDIFF(MONTH, ad.move_in_date, CURDATE()) + 1 MONTH),
                LAST_DAY(DATE_ADD(ad.move_in_date, INTERVAL TIMESTAMPDIFF(MONTH, ad.move_in_date, CURDATE()) + 1 MONTH))
            )
        )
    );
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
