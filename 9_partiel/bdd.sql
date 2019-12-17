CREATE TABLE `user` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(128) NOT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

CREATE TABLE `ticket` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`id_user` INT(10) UNSIGNED NOT NULL,
	`title` VARCHAR(128) NOT NULL,
	`content` TEXT NOT NULL,
	`priority` enum('low', 'important', 'critical') NOT NULL,
	`attached_file` VARCHAR(255) NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;


CREATE TABLE `response` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`id_user` INT(10) UNSIGNED NOT NULL,
	`id_ticket` INT(10) UNSIGNED NOT NULL,
	`content` TEXT NOT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

INSERT INTO `user` (`name`) VALUES ('Admin');
INSERT INTO `user` (`name`) VALUES ('Dev 1');
INSERT INTO `user` (`name`) VALUES ('Dev 2');
INSERT INTO `user` (`name`) VALUES ('Inté 1');
INSERT INTO `user` (`name`) VALUES ('Inté 2');

INSERT INTO `ticket` (`id_user`, `title`, `content`, `priority`) VALUES ('1', 'Ca marche pas!', 'On ne peut pas ajouter de ticket.', 'critical');

INSERT INTO `response` (`id_user`, `id_ticket`, `content`) VALUES ('4', '1', 'A priori c\'est pas un souci d\'inté.');
INSERT INTO `response` (`id_user`, `id_ticket`, `content`) VALUES ('3', '1', 'On va regarder ça.');