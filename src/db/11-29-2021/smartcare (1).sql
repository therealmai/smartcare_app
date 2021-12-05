-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2021 at 04:34 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `license_number` varchar(255) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `ssn` varchar(255) NOT NULL,
  `isDoctor` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `confirm_password`, `birthdate`, `street_address`, `province`, `city`, `postal_code`, `ssn`, `isDoctor`, `created_at`) VALUES
(1, 'Jomar', 'Leano', '20102650@usc.edu.ph', '$2y$10$f.36Lvo2SBFjBLs003BCbeNWk3lM1ryjl8Ca.matHCoC/JdYaW5eq', '$2y$10$QId0renE9RCoyjkmgNXC4eyNPehGTwkrjLxEf.9wIBWxlm/d6aKrO', '2021-11-16', 'Blasab', 'Toledo', 'Cebu', '6038', '1234', 0, '0000-00-00 00:00:00'),
(2, 'YD', 'Blank', 'yd@gmail.com', '$2y$10$T6H65OjHl2F2g1mj4b.bfu0il6pv3eQ8zwzi8zNafXNsgBAf9PGXy', '$2y$10$zPxHkFjdQYNy5MLtqESK9uiEkhH.pdzYSv2YQQjZ6YuswCZ/yvM9e', '2002-06-14', 'Gayuma', 'Siquijor', 'Bodega', '6038', '12312', 1, '2021-11-29 15:11:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
