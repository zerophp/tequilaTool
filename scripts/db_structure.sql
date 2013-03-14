SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `tequilaTool` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;

USE `tequilaTool`;

CREATE  TABLE IF NOT EXISTS `tequilaTool`.`users` (
  `idusers` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL DEFAULT NULL ,
  `email` VARCHAR(225) NOT NULL ,
  `dbirth` DATETIME NULL DEFAULT NULL ,
  `password` VARCHAR(45) NULL DEFAULT NULL ,
  `status_idstatus` INT(11) NOT NULL ,
  PRIMARY KEY (`idusers`) ,
  INDEX `fk_users_status_idx` (`status_idstatus` ASC) ,
  CONSTRAINT `fk_users_status`
    FOREIGN KEY (`status_idstatus` )
    REFERENCES `tequilaTool`.`status` (`idstatus` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `tequilaTool`.`status` (
  `idstatus` INT(11) NOT NULL AUTO_INCREMENT ,
  `status` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idstatus`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `tequilaTool`.`courses` (
  `idcourses` INT(11) NOT NULL AUTO_INCREMENT ,
  `course` VARCHAR(45) NOT NULL ,
  `dini` TIMESTAMP NULL DEFAULT NULL ,
  `dfini` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`idcourses`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `tequilaTool`.`users_has_courses` (
  `users_idusers` INT(11) NOT NULL ,
  `courses_idcourses` INT(11) NOT NULL ,
  PRIMARY KEY (`users_idusers`, `courses_idcourses`) ,
  INDEX `fk_users_has_courses_courses1_idx` (`courses_idcourses` ASC) ,
  INDEX `fk_users_has_courses_users1_idx` (`users_idusers` ASC) ,
  CONSTRAINT `fk_users_has_courses_users1`
    FOREIGN KEY (`users_idusers` )
    REFERENCES `tequilaTool`.`users` (`idusers` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_courses_courses1`
    FOREIGN KEY (`courses_idcourses` )
    REFERENCES `tequilaTool`.`courses` (`idcourses` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `tequilaTool`.`exams` (
  `idexams` INT(11) NOT NULL ,
  `name` VARCHAR(45) NULL DEFAULT NULL ,
  `date` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`idexams`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `tequilaTool`.`questions` (
  `idquestions` INT(11) NOT NULL AUTO_INCREMENT ,
  `question` TEXT NOT NULL ,
  `answer1` TEXT NULL DEFAULT NULL ,
  `answer2` TEXT NULL DEFAULT NULL ,
  `answer3` TEXT NULL DEFAULT NULL ,
  `answer4` TEXT NULL DEFAULT NULL ,
  `answer5` TEXT NULL DEFAULT NULL ,
  `solution` VARCHAR(255) NOT NULL ,
  `answers_types_idanswers_types` INT(11) NOT NULL ,
  `exams_idexams` INT(11) NOT NULL ,
  PRIMARY KEY (`idquestions`) ,
  INDEX `fk_questions_answers_types1_idx` (`answers_types_idanswers_types` ASC) ,
  INDEX `fk_questions_exams1_idx` (`exams_idexams` ASC) ,
  CONSTRAINT `fk_questions_answers_types1`
    FOREIGN KEY (`answers_types_idanswers_types` )
    REFERENCES `tequilaTool`.`answers_types` (`idanswers_types` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_questions_exams1`
    FOREIGN KEY (`exams_idexams` )
    REFERENCES `tequilaTool`.`exams` (`idexams` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `tequilaTool`.`answers_types` (
  `idanswers_types` INT(11) NOT NULL AUTO_INCREMENT ,
  `type` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idanswers_types`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `tequilaTool`.`examinations` (
  `idexaminations` INT(11) NOT NULL ,
  `date` TIMESTAMP NULL DEFAULT NULL ,
  `courses_idcourses` INT(11) NOT NULL ,
  `exams_idexams` INT(11) NOT NULL ,
  PRIMARY KEY (`idexaminations`) ,
  INDEX `fk_examinations_courses1_idx` (`courses_idcourses` ASC) ,
  INDEX `fk_examinations_exams1_idx` (`exams_idexams` ASC) ,
  CONSTRAINT `fk_examinations_courses1`
    FOREIGN KEY (`courses_idcourses` )
    REFERENCES `tequilaTool`.`courses` (`idcourses` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_examinations_exams1`
    FOREIGN KEY (`exams_idexams` )
    REFERENCES `tequilaTool`.`exams` (`idexams` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `tequilaTool`.`answers` (
  `idanswers` INT(11) NOT NULL ,
  `users_idusers` INT(11) NOT NULL ,
  `examinations_idexaminations` INT(11) NOT NULL ,
  `answer` VARCHAR(255) NULL DEFAULT NULL ,
  `questions_idquestions` INT(11) NOT NULL ,
  PRIMARY KEY (`idanswers`) ,
  INDEX `fk_answers_users1_idx` (`users_idusers` ASC) ,
  INDEX `fk_answers_examinations1_idx` (`examinations_idexaminations` ASC) ,
  INDEX `fk_answers_questions1_idx` (`questions_idquestions` ASC) ,
  CONSTRAINT `fk_answers_users1`
    FOREIGN KEY (`users_idusers` )
    REFERENCES `tequilaTool`.`users` (`idusers` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_answers_examinations1`
    FOREIGN KEY (`examinations_idexaminations` )
    REFERENCES `tequilaTool`.`examinations` (`idexaminations` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_answers_questions1`
    FOREIGN KEY (`questions_idquestions` )
    REFERENCES `tequilaTool`.`questions` (`idquestions` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
