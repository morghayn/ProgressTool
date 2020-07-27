DROP TABLE IF EXISTS `#__progresstool`;

CREATE TABLE `#__progresstool` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`greeting` VARCHAR(25) NOT NULL,
	`published` tinyint(4) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
)
	ENGINE=InnoDB 
	AUTO_INCREMENT =0
	DEFAULT CHARSET=utf8mb4 
	DEFAULT COLLATE=utf8mb4_unicode_ci;

INSERT INTO `#__progresstool` (`greeting`) VALUES
('Hello World!'),
('Good Bye World!');