-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2021 at 02:44 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

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
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `ID` bigint(20) NOT NULL,
  `DoctorID` bigint(20) NOT NULL,
  `PatientID` bigint(20) NOT NULL,
  `Type` enum('f2f','online') NOT NULL,
  `Day` smallint(6) NOT NULL,
  `Month` int(11) NOT NULL,
  `Year` int(11) NOT NULL,
  `Time` varchar(5) NOT NULL,
  `IsFinished` tinyint(1) DEFAULT NULL,
  `IsCancelled` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`ID`, `DoctorID`, `PatientID`, `Type`, `Day`, `Month`, `Year`, `Time`, `IsFinished`, `IsCancelled`) VALUES
(1, 2, 1, 'f2f', 6, 11, 2021, '21:33', 0, 0),
(2, 2, 2, 'online', 11, 11, 2021, '21:37', 1, 0),
(3, 2, 3, 'online', 15, 11, 2021, '19:37', 1, 0),
(4, 2, 1, 'f2f', 9, 11, 2021, '21:48', 0, 0),
(5, 6, 1, 'f2f', 9, 12, 2021, '08:12', 0, 0),
(6, 3, 1, 'online', 18, 12, 2021, '08:14', 0, 0),
(7, 3, 1, 'f2f', 10, 12, 2021, '22:15', 0, 0),
(8, 2, 1, 'f2f', 10, 12, 2021, '20:15', 0, 0),
(9, 2, 5, 'f2f', 9, 12, 2021, '20:32', 1, 0),
(10, 6, 5, 'online', 11, 12, 2021, '20:32', 1, 0),
(11, 3, 5, 'f2f', 10, 12, 2021, '20:29', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `specialization` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `degree` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `userID`, `specialization`, `license_number`, `degree`) VALUES
(2, 13, 'Cardiologist', '', ''),
(3, 4, 'Pediatrician', '', ''),
(4, 5, 'Pediatrician', '', ''),
(6, 11, 'Pediatrician', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `doctors_fees`
--

CREATE TABLE `doctors_fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `amount` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors_lab_tests`
--

CREATE TABLE `doctors_lab_tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prescriptionID` bigint(20) UNSIGNED NOT NULL,
  `test_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `report` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors_schedules`
--

CREATE TABLE `doctors_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contacts`
--

CREATE TABLE `emergency_contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relationship` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `insurances`
--

CREATE TABLE `insurances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `feeID` bigint(20) UNSIGNED NOT NULL,
  `insurance_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `policy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_policy_holder` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `height` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blood_pressure` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heart_rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `userID`, `height`, `weight`, `blood_pressure`, `heart_rate`, `created_at`, `updated_at`) VALUES
(1, 6, '', '', '', '', NULL, NULL),
(2, 7, '', '', '', '', NULL, NULL),
(3, 8, '', '', '', '', NULL, NULL),
(4, 15, '', '', '', '', NULL, NULL),
(5, 14, '', '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patients_table`
--

CREATE TABLE `patients_table` (
  `user_id` int(11) NOT NULL,
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
  `ssn` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients_table`
--

INSERT INTO `patients_table` (`user_id`, `first_name`, `last_name`, `email`, `password`, `confirm_password`, `birthdate`, `street_address`, `province`, `city`, `postal_code`, `ssn`) VALUES
(1, 'Jomar', 'Leano', '20102650@usc.edu.ph', '$2y$10$83eIHvb5YNev2PrsIF1h2ONshogEZPsPULgeHseBdFmMZgmEtdkhi', '$2y$10$5Tu54DI0Nuf7PW0RXyzWKeq2av1XEIN0YuZ9x/jRLeytSTNMq.xme', '2021-11-10', 'Blasab', 'Toledo', 'Cebu', '6038', '1234'),
(2, 'Jomar', 'Leano', '20102650@usc.edu.ph', '$2y$10$3PXE30QjlTlmSOYqxKRrEOV4vpYuLROcKY2KucJvulJIrG8iVREei', '$2y$10$AUW/VT/X6ioj1BFsF.ZUs.N6X5VnZh885.j78oMqIfxkquTJaHhT6', '2021-11-11', 'Blasab', 'Toledo', 'Cebu', '6038', '`123');

-- --------------------------------------------------------

--
-- Table structure for table `payer_for_patients`
--

CREATE TABLE `payer_for_patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feeID` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relationship` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` tinyint(4) NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ssn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_initial` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('doctor','patient') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'patient',
  `year` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `day` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `ssn`, `contact`, `firstname`, `lastname`, `middle_initial`, `role`, `year`, `month`, `day`) VALUES
(3, 'user1@gmail.com', '', '', '09123426921', 'User1', 'User1', 'U1', 'doctor', NULL, NULL, NULL),
(4, 'user2@gmail.com', '', '', '09123422121', 'User2', 'User2', 'U2', 'doctor', NULL, NULL, NULL),
(5, 'user3@gmail.com', '', '', '09132126921', 'User3', 'User3', 'U3', 'doctor', NULL, NULL, NULL),
(6, 'user4@gmail.com', '', '', '09123431242', 'User4', 'User4', 'U4', 'patient', NULL, NULL, NULL),
(7, 'user5@gmail.com', '', '', '09178431242', 'User5', 'User5', 'U5', 'patient', NULL, NULL, NULL),
(8, 'user6@gmail.com', '', '', '09122861242', 'User6', 'User6', 'U6', 'patient', NULL, NULL, NULL),
(11, '20102650@usc.edu.ph', '$2y$10$tX5fjIidYK1qh5nxkgnkT.sfi13E2oi/n8GlMSEUB7dB3fcTi1LUq', '1234', '920516409', 'Jomar', 'Leano', 'M', 'doctor', 2021, 12, 5),
(12, 'jose@gmail.com', '$2y$10$DHKyYSvWEuTXne5/LfGGNOqXHn/g78MkZI2N5xexZRnSiKV1yfddm', '12312', '092131211231', 'Jose Glenn', 'Samson', 'G.', 'patient', 2021, 12, 5),
(13, 'doc1@gmail.com', '$2y$10$Qm/7B35Wl1sRE4JIwnx2zebbCs9.4JRgnIPyBANcar7t8V9CtnIlm', '1343214', '12341243', 'doc1', 'doc1', 'd1', 'doctor', 2021, 12, 8),
(14, 'pat1@gmail.com', '$2y$10$1QaGFsOe3Um9E8ojcvD8huR.vggG7/iOu37C3pucr3CFakjbCzhhS', '123423asdfas', '12343214234', 'pat1', 'pat1', 'P1', 'patient', 2021, 12, 8),
(15, 'pat2@gmail.com', '$2y$10$56V8EVUsQ4.apaq3HsPIaOrQPRIFqKwhgM6CABKooEstTqrBnCwPm', 'sdfasdfsf3', '2341243432', 'pat2', 'pat2', 'p2', 'patient', 2021, 11, 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctors_userid_foreign` (`userID`);

--
-- Indexes for table `doctors_fees`
--
ALTER TABLE `doctors_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctors_fees_userid_foreign` (`userID`);

--
-- Indexes for table `doctors_lab_tests`
--
ALTER TABLE `doctors_lab_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctors_lab_tests_prescriptionid_foreign` (`prescriptionID`);

--
-- Indexes for table `doctors_schedules`
--
ALTER TABLE `doctors_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insurances`
--
ALTER TABLE `insurances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `insurances_userid_foreign` (`userID`),
  ADD KEY `insurances_feeid_foreign` (`feeID`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patients_userid_foreign` (`userID`);

--
-- Indexes for table `patients_table`
--
ALTER TABLE `patients_table`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `payer_for_patients`
--
ALTER TABLE `payer_for_patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payer_for_patients_feeid_foreign` (`feeID`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescriptions_doctor_id_foreign` (`doctor_id`),
  ADD KEY `prescriptions_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `doctors_fees`
--
ALTER TABLE `doctors_fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctors_lab_tests`
--
ALTER TABLE `doctors_lab_tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctors_schedules`
--
ALTER TABLE `doctors_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `insurances`
--
ALTER TABLE `insurances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patients_table`
--
ALTER TABLE `patients_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payer_for_patients`
--
ALTER TABLE `payer_for_patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_userid_foreign` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors_fees`
--
ALTER TABLE `doctors_fees`
  ADD CONSTRAINT `doctors_fees_userid_foreign` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors_lab_tests`
--
ALTER TABLE `doctors_lab_tests`
  ADD CONSTRAINT `doctors_lab_tests_prescriptionid_foreign` FOREIGN KEY (`prescriptionID`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `insurances`
--
ALTER TABLE `insurances`
  ADD CONSTRAINT `insurances_feeid_foreign` FOREIGN KEY (`feeID`) REFERENCES `doctors_fees` (`id`),
  ADD CONSTRAINT `insurances_userid_foreign` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_userid_foreign` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payer_for_patients`
--
ALTER TABLE `payer_for_patients`
  ADD CONSTRAINT `payer_for_patients_feeid_foreign` FOREIGN KEY (`feeID`) REFERENCES `doctors_fees` (`id`);

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`),
  ADD CONSTRAINT `prescriptions_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
