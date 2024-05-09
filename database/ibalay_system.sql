-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2024 at 10:06 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ibalay_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `bh_information`
--

CREATE TABLE `bh_information` (
  `bh_id` int(11) NOT NULL,
  `landlord_id` int(11) NOT NULL,
  `BH_name` varchar(100) NOT NULL,
  `BH_address` varchar(255) DEFAULT NULL,
  `Document1` varchar(255) DEFAULT NULL,
  `Document2` varchar(255) DEFAULT NULL,
  `monthly_payment_rate` varchar(50) DEFAULT NULL,
  `number_of_kitchen` int(11) DEFAULT NULL,
  `number_of_living_room` int(11) DEFAULT NULL,
  `number_of_students` int(11) DEFAULT NULL,
  `number_of_cr` int(11) DEFAULT NULL,
  `number_of_beds` int(11) DEFAULT NULL,
  `number_of_rooms` int(11) DEFAULT NULL,
  `bh_max_capacity` int(11) DEFAULT NULL,
  `gender_allowed` enum('male','female','all') NOT NULL,
  `Status` enum('0','1','2') DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `latitude` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bh_information`
--

INSERT INTO `bh_information` (`bh_id`, `landlord_id`, `BH_name`, `BH_address`, `Document1`, `Document2`, `monthly_payment_rate`, `number_of_kitchen`, `number_of_living_room`, `number_of_students`, `number_of_cr`, `number_of_beds`, `number_of_rooms`, `bh_max_capacity`, `gender_allowed`, `Status`, `longitude`, `latitude`) VALUES
(12, 1, 'cord', 'dad', '/opt/lampp/htdocs/iBalay/uploads/documents/landlord_1/663ae38bbe1b3_Letter-of-intent-ADAS.pdf', '/opt/lampp/htdocs/iBalay/uploads/documents/landlord_1/663ae38bbe3f2_Letter-of-intent-ADAS.pdf', '1000 - 3243', 2, 2, 2, 2, 2, 2, 2, 'all', '1', 125.01156818078637, 11.097570201927695);

-- --------------------------------------------------------

--
-- Table structure for table `landlord_acc`
--

CREATE TABLE `landlord_acc` (
  `landlord_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `landlord_acc`
--

INSERT INTO `landlord_acc` (`landlord_id`, `first_name`, `last_name`, `email`, `password`, `phone_number`, `address`) VALUES
(1, 'cord', 'moraleta', 'cordmorale101@gmail.com', '$2y$10$LPvuQzOxb/v/DC41/P9RyeQUkML8.EASXDR9jL6jXvttD0eo4BIzG', '234', 'wqe');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `landlord_id` int(11) DEFAULT NULL,
  `room_number` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `room_price` decimal(10,2) DEFAULT NULL,
  `room_photo1` varchar(255) DEFAULT NULL,
  `room_photo2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `landlord_id`, `room_number`, `description`, `capacity`, `room_price`, `room_photo1`, `room_photo2`) VALUES
(4, 1, 11, 'sdsadsdsad', 22, 232332.00, 'photo_663b321404fe4.jpg', 'photo_663b32140506a.png'),
(5, 1, 2, 'sdsadas', 23, 23213.00, 'photo_663afac174119.png', 'photo_663afac174136.png'),
(6, 1, 3, 'swewqqw', 2, 2.00, 'photo_663b0c811b581.jpg', 'photo_663b0c811b595.png');

-- --------------------------------------------------------

--
-- Table structure for table `saso`
--

CREATE TABLE `saso` (
  `saso_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saso`
--

INSERT INTO `saso` (`saso_id`, `username`, `password`) VALUES
(1, 'saso', '$2y$10$SASO_PASSWORD_HASH_HERE');

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `TenantID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `checked_out` tinyint(1) DEFAULT 0,
  `Evsu_student` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`TenantID`, `FirstName`, `LastName`, `Email`, `PhoneNumber`, `Password`, `student_id`, `address`, `gender`, `checked_out`, `Evsu_student`) VALUES
(1, 'cord', 'sadkasmdk', 'cordmorale101@gmail.com', '423432', '$2y$10$dQC6eDkXVkrYsJbPXkypHeAsSM5nKQOF252LAUGpuUXrRiQ2UUtca', '232321', 'dsadas', 'Male', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bh_information`
--
ALTER TABLE `bh_information`
  ADD PRIMARY KEY (`bh_id`),
  ADD KEY `landlord_id` (`landlord_id`);

--
-- Indexes for table `landlord_acc`
--
ALTER TABLE `landlord_acc`
  ADD PRIMARY KEY (`landlord_id`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `fk_landlord` (`landlord_id`);

--
-- Indexes for table `saso`
--
ALTER TABLE `saso`
  ADD PRIMARY KEY (`saso_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`TenantID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD UNIQUE KEY `idx_tenant_email` (`Email`),
  ADD UNIQUE KEY `idx_tenant_student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bh_information`
--
ALTER TABLE `bh_information`
  MODIFY `bh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `landlord_acc`
--
ALTER TABLE `landlord_acc`
  MODIFY `landlord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `saso`
--
ALTER TABLE `saso`
  MODIFY `saso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `TenantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bh_information`
--
ALTER TABLE `bh_information`
  ADD CONSTRAINT `bh_information_ibfk_1` FOREIGN KEY (`landlord_id`) REFERENCES `landlord_acc` (`landlord_id`) ON DELETE CASCADE;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `fk_landlord` FOREIGN KEY (`landlord_id`) REFERENCES `landlord_acc` (`landlord_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
