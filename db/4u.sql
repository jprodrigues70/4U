-- MySQL Script generated by MySQL Workbench
-- 10/14/15 23:27:26
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema 4u
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `4u` ;

-- -----------------------------------------------------
-- Schema 4u
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `4u` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `4u` ;

-- -----------------------------------------------------
-- Table `4u`.`institutes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `4u`.`institutes` ;

CREATE TABLE IF NOT EXISTS `4u`.`institutes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `area` VARCHAR(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `4u`.`courses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `4u`.`courses` ;

CREATE TABLE IF NOT EXISTS `4u`.`courses` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(6) NOT NULL,
  `area` VARCHAR(4) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `institute` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `code_UNIQUE` (`code` ASC),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
  INDEX `fk_courses_institutes1_idx` (`institute` ASC),
  CONSTRAINT `fk_courses_institutes1`
    FOREIGN KEY (`institute`)
    REFERENCES `4u`.`institutes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `4u`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `4u`.`users` ;

CREATE TABLE IF NOT EXISTS `4u`.`users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `level` VARCHAR(1) NOT NULL,
  `course` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `fk_users_courses1_idx` (`course` ASC),
  CONSTRAINT `fk_users_courses1`
    FOREIGN KEY (`course`)
    REFERENCES `4u`.`courses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `4u`.`disciplines`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `4u`.`disciplines` ;

CREATE TABLE IF NOT EXISTS `4u`.`disciplines` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `code` VARCHAR(10) NOT NULL,
  `institute` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `code_UNIQUE` (`code` ASC),
  INDEX `fk_disciplines_institutes1_idx` (`institute` ASC),
  CONSTRAINT `fk_disciplines_institutes1`
    FOREIGN KEY (`institute`)
    REFERENCES `4u`.`institutes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `4u`.`users_has_disciplines`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `4u`.`users_has_disciplines` ;

CREATE TABLE IF NOT EXISTS `4u`.`users_has_disciplines` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` INT UNSIGNED NOT NULL,
  `discipline` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_has_disciplines_disciplines1_idx` (`discipline` ASC),
  INDEX `fk_users_has_disciplines_users_idx` (`user` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_users_has_disciplines_users`
    FOREIGN KEY (`user`)
    REFERENCES `4u`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_disciplines_disciplines1`
    FOREIGN KEY (`discipline`)
    REFERENCES `4u`.`disciplines` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `4u`.`files`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `4u`.`files` ;

CREATE TABLE IF NOT EXISTS `4u`.`files` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `file` VARCHAR(255) NOT NULL,
  `downloads` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `file_UNIQUE` (`file` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `4u`.`comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `4u`.`comments` ;

CREATE TABLE IF NOT EXISTS `4u`.`comments` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `text` VARCHAR(255) NOT NULL,
  `time` DATETIME NOT NULL,
  `status` VARCHAR(1) NOT NULL,
  `user` INT UNSIGNED NOT NULL,
  `file` INT UNSIGNED NOT NULL,
  `discipline` INT UNSIGNED NOT NULL,
  `post` INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_comments_users1_idx` (`user` ASC),
  INDEX `fk_comments_files1_idx` (`file` ASC),
  UNIQUE INDEX `file_UNIQUE` (`file` ASC),
  INDEX `fk_comments_disciplines1_idx` (`discipline` ASC),
  UNIQUE INDEX `discipline_UNIQUE` (`discipline` ASC),
  CONSTRAINT `fk_comments_users1`
    FOREIGN KEY (`user`)
    REFERENCES `4u`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_files1`
    FOREIGN KEY (`file`)
    REFERENCES `4u`.`files` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_disciplines1`
    FOREIGN KEY (`discipline`)
    REFERENCES `4u`.`disciplines` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `4u`.`slides`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `4u`.`slides` ;

CREATE TABLE IF NOT EXISTS `4u`.`slides` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `link` VARCHAR(255) NULL,
  `expire` DATE NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `4u`.`abuses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `4u`.`abuses` ;

CREATE TABLE IF NOT EXISTS `4u`.`abuses` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `users_id` INT UNSIGNED NOT NULL,
  `comments_id` INT UNSIGNED NOT NULL,
  INDEX `fk_users_has_comments_comments1_idx` (`comments_id` ASC),
  INDEX `fk_users_has_comments_users1_idx` (`users_id` ASC),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_users_has_comments_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `4u`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_comments_comments1`
    FOREIGN KEY (`comments_id`)
    REFERENCES `4u`.`comments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
