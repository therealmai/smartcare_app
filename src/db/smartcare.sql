-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2021 at 05:11 PM
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `specialization` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `degree` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_11_04_154705_create_patients_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `testID` bigint(20) UNSIGNED NOT NULL,
  `prescriptionID` bigint(20) UNSIGNED NOT NULL,
  `height` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blood_pressure` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heart_rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
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
  `date` date NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `secretaries`
--

CREATE TABLE `secretaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `referral` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ssn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` tinyint(4) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `insurances`
--
ALTER TABLE `insurances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `insurances_userid_foreign` (`userID`),
  ADD KEY `insurances_feeid_foreign` (`feeID`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patients_userid_foreign` (`userID`),
  ADD KEY `patients_testid_foreign` (`testID`),
  ADD KEY `patients_prescriptionid_foreign` (`prescriptionID`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescriptions_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `secretaries`
--
ALTER TABLE `secretaries`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `insurances`
--
ALTER TABLE `insurances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `secretaries`
--
ALTER TABLE `secretaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `patients_prescriptionid_foreign` FOREIGN KEY (`prescriptionID`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patients_testid_foreign` FOREIGN KEY (`testID`) REFERENCES `doctors_lab_tests` (`id`) ON DELETE CASCADE,
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
  ADD CONSTRAINT `prescriptions_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
