ALTER TABLE `#__pt_project`
ADD `deactivated` TINYINT UNSIGNED NOT NULL DEFAULT '0',
ADD `deactivation_reason` VARCHAR(255);