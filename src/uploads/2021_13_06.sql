ALTER TABLE `patients` 
ADD `image_profile` VARCHAR(255) NULL
AFTER `heart_rate`;

ALTER TABLE `doctors`
ADD `image_profile` VARCHAR(255) NULL
AFTER `degree`;