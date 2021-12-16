ALTER TABLE `prescriptions`
  ADD `patient_id` BIGINT(20) UNSIGNED NOT NULL AFTER `doctor_id`,
  ADD CONSTRAINT `prescriptions_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);