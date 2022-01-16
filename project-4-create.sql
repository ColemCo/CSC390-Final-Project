CREATE TABLE `user` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(128) NOT NULL,
  `email` VARCHAR(128) NOT NULL,
  `password_hash` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`user_id`));

CREATE TABLE `list` (
  `list_id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `date_created` DATETIME NOT NULL,
  `title` VARCHAR(128) NOT NULL,
  PRIMARY KEY (`list_id`),
  INDEX `fk_list_user_idx` (`user_id` ASC),
  CONSTRAINT `fk_list_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
	
CREATE TABLE `task` (
  `task_id` INT NOT NULL AUTO_INCREMENT,
  `list_id` INT NOT NULL,
  `date_created` DATETIME NOT NULL,
  `date_completed` DATETIME NULL,
  `description` VARCHAR(128) NOT NULL,
  PRIMARY KEY (`task_id`),
  INDEX `fk_task_list_idx` (`list_id` ASC),
  CONSTRAINT `fk_task_list`
    FOREIGN KEY (`list_id`)
    REFERENCES `list` (`list_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);