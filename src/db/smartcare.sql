-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2022 at 08:25 AM
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
  `Time` varchar(15) NOT NULL,
  `IsFinished` tinyint(1) DEFAULT NULL,
  `IsCancelled` tinyint(1) DEFAULT NULL,
  `Canceller` enum('doctor','patient') DEFAULT NULL,
  `IsDiscarded` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`ID`, `DoctorID`, `PatientID`, `Type`, `Day`, `Month`, `Year`, `Time`, `IsFinished`, `IsCancelled`, `Canceller`, `IsDiscarded`) VALUES
(57, 2, 5, 'online', 6, 2, 2022, '07:00-08:00', 1, 0, '', b'0'),
(64, 2, 4, 'online', 6, 2, 2022, '07:00-08:00', 0, 1, 'patient', b'1'),
(65, 2, 6, 'online', 6, 2, 2022, '07:00-08:00', 0, 0, NULL, b'0'),
(69, 2, 5, 'f2f', 30, 1, 2022, '07:00-08:00', 0, 1, 'doctor', b'1');

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
(6, 11, 'Pediatrician', '', ''),
(7, 18, 'Pediatrician', '', ''),
(8, 19, 'Cardiologist', '', '');

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
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `time_start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_end` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` enum('sun','mon','tue','wed','thu','fri','sat') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors_schedules`
--

INSERT INTO `doctors_schedules` (`id`, `doctor_id`, `time_start`, `time_end`, `day`) VALUES
(19, 2, '07:00', '08:00', 'sun'),
(20, 6, '06:50', '07:10', 'sun'),
(21, 6, '07:10', '07:30', 'sun'),
(22, 7, '07:00', '08:00', 'sun'),
(23, 8, '06:00', '09:00', 'sun'),
(24, 6, '07:50', '08:10', 'sun'),
(25, 2, '08:00', '09:00', 'sun'),
(26, 2, '09:00', '10:00', 'sun'),
(27, 2, '10:00', '11:00', 'sun'),
(35, 2, '07:00', '08:00', 'tue'),
(39, 2, '07:00', '08:00', 'wed');

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
-- Table structure for table `lab_tests`
--

CREATE TABLE `lab_tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `lab_test_img_filepath` varchar(191) NOT NULL,
  `lab_test_desc` varchar(255) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(4, 15, '', '', '', '', NULL, NULL),
(5, 14, '', '', '', '', NULL, NULL),
(6, 16, '', '', '', '', NULL, NULL),
(7, 17, '', '', '', '', NULL, NULL);

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
  `confirm_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_initial` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('doctor','patient') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'patient',
  `year` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `day` smallint(6) DEFAULT NULL,
  `ssn_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `health_record` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `confirm_password`, `contact`, `firstname`, `lastname`, `middle_initial`, `role`, `year`, `month`, `day`, `ssn_image`, `health_record`, `image_profile`) VALUES
(11, '20102650@usc.edu.ph', '$2y$10$tX5fjIidYK1qh5nxkgnkT.sfi13E2oi/n8GlMSEUB7dB3fcTi1LUq', '', '920516409', 'Anthony', 'Fanopy', 'M', 'doctor', 1990, 12, 5, NULL, NULL, 'grim.png'),
(12, 'jose@gmail.com', '$2y$10$DHKyYSvWEuTXne5/LfGGNOqXHn/g78MkZI2N5xexZRnSiKV1yfddm', '', '092131211231', 'Jose Glenn', 'Samson', 'G.', 'patient', 2021, 12, 5, NULL, NULL, NULL),
(13, 'doc1@gmail.com', '$2y$10$Qm/7B35Wl1sRE4JIwnx2zebbCs9.4JRgnIPyBANcar7t8V9CtnIlm', '', '9821840284', 'Robert', 'Malone', 'W', 'doctor', 1959, 12, 8, NULL, NULL, '13.jpg'),
(14, 'pat1@gmail.com', '$2y$10$1QaGFsOe3Um9E8ojcvD8huR.vggG7/iOu37C3pucr3CFakjbCzhhS', '', '9842741938', 'Anthony ', 'Edwards', 'B', 'patient', 2001, 8, 5, NULL, NULL, '14.png'),
(15, 'pat2@gmail.com', '$2y$10$56V8EVUsQ4.apaq3HsPIaOrQPRIFqKwhgM6CABKooEstTqrBnCwPm', '', '9381832950', 'Nikola', 'Jokic', 'J', 'patient', 1995, 2, 19, NULL, NULL, '15.png'),
(16, 'pat3@gmail.com', '$2y$10$HzF0QpWFHGjWHmjqLFD3p.4AYZ08yqg.t6X4W1Vo2/eq6mMrE6juS', 'pat3', '9321824958', 'Lamelo', 'Ball', 'D', 'patient', 2001, 8, 22, 'midterm practice exercise 2 -2.png', 'signature.png', '16.png'),
(17, 'pat4@gmail.com', '$2y$10$5mAvom6Jv13FFQBcMxDRA.vZD3RiKRkogO8s1AZZSx6V/M2IktcNK', 'pat4', '123423423', 'pat4', 'pat4', 'p4', 'patient', 2009, 2, 9, 'parent_s signature.jpg', 'parent_s signature.jpg', NULL),
(18, 'doc2@gmail.com', '$2y$10$Qm/7B35Wl1sRE4JIwnx2zebbCs9.4JRgnIPyBANcar7t8V9CtnIlm', '', '9284829194', 'Anna', 'Rose', 'D', 'doctor', 1980, 12, 8, NULL, NULL, '18.jpg'),
(19, 'doc3@gmail.com', '$2y$10$Qm/7B35Wl1sRE4JIwnx2zebbCs9.4JRgnIPyBANcar7t8V9CtnIlm', '', '9123829142', 'Chris', 'Bose', 'J', 'doctor', 2021, 1985, 8, NULL, NULL, '19.jpg');

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
-- Indexes for table `doctors_lab_tests`
--
ALTER TABLE `doctors_lab_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctors_lab_tests_prescriptionid_foreign` (`prescriptionID`);

--
-- Indexes for table `doctors_schedules`
--
ALTER TABLE `doctors_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctors_schedules_id_foreign` (`doctor_id`);

--
-- Indexes for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_tests`
--
ALTER TABLE `lab_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patients_userid_foreign` (`userID`);

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
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `doctors_lab_tests`
--
ALTER TABLE `doctors_lab_tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctors_schedules`
--
ALTER TABLE `doctors_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lab_tests`
--
ALTER TABLE `lab_tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_userid_foreign` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors_lab_tests`
--
ALTER TABLE `doctors_lab_tests`
  ADD CONSTRAINT `doctors_lab_tests_prescriptionid_foreign` FOREIGN KEY (`prescriptionID`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors_schedules`
--
ALTER TABLE `doctors_schedules`
  ADD CONSTRAINT `doctors_schedules_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`);

--
-- Constraints for table `lab_tests`
--
ALTER TABLE `lab_tests`
  ADD CONSTRAINT `lab_tests_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`),
  ADD CONSTRAINT `lab_tests_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_userid_foreign` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
