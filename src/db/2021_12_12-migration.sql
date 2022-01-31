CREATE TABLE IF NOT EXISTS `lab_tests`(
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `doctor_id` BIGINT(20) UNSIGNED NOT NULL,
  `patient_id` BIGINT(20) UNSIGNED NOT NULL,
  `lab_test_img_filepath` VARCHAR(191) NOT NULL,
  `lab_test_desc` VARCHAR(255) NULL DEFAULT NULL,
  `date` DATE NOT NULL,

  FOREIGN KEY (`doctor_id`)
    REFERENCES `doctors` (`id`),
  FOREIGN KEY (`patient_id`) 
    REFERENCES `patients` (`id`)
);