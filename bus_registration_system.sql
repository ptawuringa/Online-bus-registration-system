-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 09:40 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus_registration_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `passenger_id` int(11) DEFAULT NULL,
  `bus_number` varchar(50) NOT NULL,
  `departure_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE `buses` (
  `bus_id` int(11) NOT NULL,
  `bus_number` varchar(50) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bus_applications`
--

CREATE TABLE `bus_applications` (
  `id` int(11) NOT NULL,
  `learner_id` int(11) NOT NULL,
  `bus_route_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `status` enum('pending','approved','waiting','canceled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bus_registrations`
--

CREATE TABLE `bus_registrations` (
  `registration_id` int(11) NOT NULL,
  `learner_id` int(11) DEFAULT NULL,
  `bus_id` int(11) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `time_of_day` enum('morning','afternoon') DEFAULT NULL,
  `status` enum('waiting','confirmed') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bus_routes`
--

CREATE TABLE `bus_routes` (
  `id` int(11) NOT NULL,
  `route_name` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `available_seats` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bus_routes`
--

INSERT INTO `bus_routes` (`id`, `route_name`, `capacity`, `available_seats`, `created_at`) VALUES
(1, 'Bus 1', 35, 35, '2024-11-08 00:35:55'),
(2, 'Bus 2', 8, 8, '2024-11-08 00:35:55'),
(3, 'Bus 3', 15, 15, '2024-11-08 00:35:55'),
(4, 'Bus 1', 35, 35, '2024-11-08 00:43:57'),
(5, 'Bus 2', 8, 8, '2024-11-08 00:43:57'),
(6, 'Bus 3', 15, 15, '2024-11-08 00:43:57');

-- --------------------------------------------------------

--
-- Table structure for table `learners`
--

CREATE TABLE `learners` (
  `learner_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `learner_name` varchar(100) DEFAULT NULL,
  `grade_level` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `learners`
--

INSERT INTO `learners` (`learner_id`, `first_name`, `last_name`, `email`, `parent_id`, `address`, `phone_number`, `learner_name`, `grade_level`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, 'Tinashe', '1'),
(2, NULL, NULL, NULL, 4, NULL, NULL, 'Edwin', '2'),
(3, NULL, NULL, NULL, 4, NULL, NULL, 'Karen', '3'),
(4, NULL, NULL, NULL, 4, NULL, NULL, 'Marshall', '4'),
(5, NULL, NULL, NULL, 4, NULL, NULL, 'AUDREY', '5'),
(6, NULL, NULL, NULL, 4, NULL, NULL, 'Lee', '2'),
(8, NULL, NULL, NULL, 5, NULL, NULL, 'Andile', '5'),
(9, NULL, NULL, NULL, 5, NULL, NULL, 'Mark', '7'),
(10, NULL, NULL, NULL, 5, NULL, NULL, 'IAN', '3'),
(11, NULL, NULL, NULL, 6, NULL, NULL, 'Karen', '11'),
(12, NULL, NULL, NULL, 6, NULL, NULL, 'Calvin', '0'),
(13, NULL, NULL, NULL, 6, NULL, NULL, 'Patience', '2'),
(14, NULL, NULL, NULL, 6, NULL, NULL, 'MAGG', '7'),
(15, NULL, NULL, NULL, 8, NULL, NULL, 'Thomas', '6');

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `username`, `email`, `password`, `phone_number`) VALUES
(1, 'patience', 'ptaruwinga@yahoo.com', '$2y$10$XaT72u3liQqmIZf05rTYn.O/0ruV6L0V5Htl/CBfV76vTSpOumP/a', '0848490851'),
(4, 'patience', 'taruwinga@yahoo.com', '$2y$10$T5Ai/Eyh/66W8RtEWiIEeOC6cAB8V0v5/uYVkQAVFCRutSLK76biy', '0848490851'),
(5, 'lee', 'lee@yahoo.com', '$2y$10$HDr.G8w4xg7eQ3odlVyB..0FFUxEbzvz3qbn/qLB43dVeddIh6STC', '12345689'),
(6, 'moo', 'moo@yahoo.com', '$2y$10$ZdzJYZiTWNgdMYCWo7yvb.Yyvv35axsmjOtcMlNFeYefokYUz5GMG', '78512'),
(8, 'mavis', 'mavis@yahoo.com', '$2y$10$uw.PO.CiyqW4ljnINdUlYuVhhVH3KXg4iNPqxqc9tVjnNDnSlPAki', '456987');

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

CREATE TABLE `passengers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `passenger_id` (`passenger_id`);

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`bus_id`);

--
-- Indexes for table `bus_applications`
--
ALTER TABLE `bus_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bus_registrations`
--
ALTER TABLE `bus_registrations`
  ADD PRIMARY KEY (`registration_id`),
  ADD KEY `learner_id` (`learner_id`),
  ADD KEY `bus_id` (`bus_id`);

--
-- Indexes for table `bus_routes`
--
ALTER TABLE `bus_routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `learners`
--
ALTER TABLE `learners`
  ADD PRIMARY KEY (`learner_id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `passengers`
--
ALTER TABLE `passengers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `bus_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bus_applications`
--
ALTER TABLE `bus_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bus_registrations`
--
ALTER TABLE `bus_registrations`
  MODIFY `registration_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bus_routes`
--
ALTER TABLE `bus_routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `learners`
--
ALTER TABLE `learners`
  MODIFY `learner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `passengers`
--
ALTER TABLE `passengers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`passenger_id`) REFERENCES `passengers` (`id`);

--
-- Constraints for table `bus_registrations`
--
ALTER TABLE `bus_registrations`
  ADD CONSTRAINT `bus_registrations_ibfk_1` FOREIGN KEY (`learner_id`) REFERENCES `learners` (`learner_id`),
  ADD CONSTRAINT `bus_registrations_ibfk_2` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`bus_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
