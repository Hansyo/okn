-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema OKN
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema OKN
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `OKN` ;
USE `OKN` ;

-- -----------------------------------------------------
-- Table `OKN`.`Store`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `OKN`.`Store` (
  `idStore` INT NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  `attribute` VARCHAR(45) NULL,
  `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idStore`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `OKN`.`Genre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `OKN`.`Genre` (
  `idGenre` INT NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  `attribute` VARCHAR(45) NULL,
  `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idGenre`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `OKN`.`PaymentGenre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `OKN`.`PaymentGenre` (
  `idPaymentGenre` INT NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  `attribute` VARCHAR(45) NULL,
  `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idPaymentGenre`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `OKN`.`Payment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `OKN`.`Payment` (
  `idPayment` INT NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  `Genre` INT NOT NULL,
  `attribute` VARCHAR(45) NULL,
  `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idPayment`),
  INDEX `paymentGenre_idx` (`Genre` ASC) ,
  CONSTRAINT `paymentGenre`
    FOREIGN KEY (`Genre`)
    REFERENCES `OKN`.`PaymentGenre` (`idPaymentGenre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `OKN`.`Receipt`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `OKN`.`Receipt` (
  `idReceipt` INT NOT NULL,
  `purchase` DATE NOT NULL,
  `purchase price` INT NOT NULL,
  `attribute` VARCHAR(45) NULL,
  `Genre` INT NOT NULL,
  `Store` INT NULL,
  `Payment` INT NULL,
  `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idReceipt`),
  INDEX `idGenre_idx` (`Genre` ASC) ,
  INDEX `idStore_idx` (`Store` ASC) ,
  INDEX `idPayment_idx` (`Payment` ASC) ,
  CONSTRAINT `idStore`
    FOREIGN KEY (`Store`)
    REFERENCES `OKN`.`Store` (`idStore`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idGenre`
    FOREIGN KEY (`Genre`)
    REFERENCES `OKN`.`Genre` (`idGenre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idPayment`
    FOREIGN KEY (`Payment`)
    REFERENCES `OKN`.`Payment` (`idPayment`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `OKN`.`GenreClassification`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `OKN`.`GenreClassification` (
  `Parent` INT NOT NULL,
  `Child` INT NOT NULL,
  `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX `parentGenre_idx` (`Parent` ASC, `Child` ASC) ,
  CONSTRAINT `Genre`
    FOREIGN KEY (`Parent` , `Child`)
    REFERENCES `OKN`.`Genre` (`idGenre` , `idGenre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `OKN`.`StoreClassification`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `OKN`.`StoreClassification` (
  `Parent` INT NOT NULL,
  `Child` INT NOT NULL,
  `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX `parentStore_idx` (`Parent` ASC, `Child` ASC) ,
  CONSTRAINT `Store`
    FOREIGN KEY (`Parent` , `Child`)
    REFERENCES `OKN`.`Store` (`idStore` , `idStore`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `OKN`.`PaymentGenreClassification`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `OKN`.`PaymentGenreClassification` (
  `Parent` INT NOT NULL,
  `Child` INT NOT NULL,
  `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX `ParentGenre_idx` (`Parent` ASC, `Child` ASC) ,
  CONSTRAINT `Genre`
    FOREIGN KEY (`Parent` , `Child`)
    REFERENCES `OKN`.`PaymentGenre` (`idPaymentGenre` , `idPaymentGenre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `OKN`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `OKN`.`User` (
  `idUser` INT NOT NULL,
  `username` VARCHAR(16) NOT NULL,
  `email` VARCHAR(255) NULL,
  `password` VARCHAR(32) NOT NULL,
  `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idUser`));


-- -----------------------------------------------------
-- Table `OKN`.`Credit`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `OKN`.`Credit` (
  `Payment` INT NOT NULL,
  `Credit` INT NOT NULL,
  `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idPayment_idx` (`Payment` ASC) ,
  CONSTRAINT `idPayment`
    FOREIGN KEY (`Payment`)
    REFERENCES `OKN`.`Payment` (`idPayment`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `OKN`.`UserReceiptRelation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `OKN`.`UserReceiptRelation` (
  `User` INT NOT NULL,
  `Receipt` INT NOT NULL,
  INDEX `idReceipt_idx` (`Receipt` ASC) ,
  INDEX `idUser_idx` (`User` ASC) ,
  CONSTRAINT `idUser`
    FOREIGN KEY (`User`)
    REFERENCES `OKN`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idReceipt`
    FOREIGN KEY (`Receipt`)
    REFERENCES `OKN`.`Receipt` (`idReceipt`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `OKN`.`UserGenreRelation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `OKN`.`UserGenreRelation` (
  `User` INT NOT NULL,
  `Genre` INT NOT NULL,
  INDEX `idGenre_idx` (`Genre` ASC) ,
  INDEX `idUser_idx` (`User` ASC) ,
  CONSTRAINT `idUser`
    FOREIGN KEY (`User`)
    REFERENCES `OKN`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idGenre`
    FOREIGN KEY (`Genre`)
    REFERENCES `OKN`.`Genre` (`idGenre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `OKN`.`UserStoreRelation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `OKN`.`UserStoreRelation` (
  `User` INT NOT NULL,
  `Store` INT NOT NULL,
  INDEX `idStore_idx` (`Store` ASC) ,
  CONSTRAINT `idUser`
    FOREIGN KEY (`User`)
    REFERENCES `OKN`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idStore`
    FOREIGN KEY (`Store`)
    REFERENCES `OKN`.`Store` (`idStore`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `OKN`.`UserPaymentRelation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `OKN`.`UserPaymentRelation` (
  `User` INT NOT NULL,
  `Payment` INT NOT NULL,
  INDEX `idPayment_idx` (`Payment` ASC) ,
  INDEX `idUser_idx` (`User` ASC) ,
  CONSTRAINT `idUser`
    FOREIGN KEY (`User`)
    REFERENCES `OKN`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idPayment`
    FOREIGN KEY (`Payment`)
    REFERENCES `OKN`.`Payment` (`idPayment`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `OKN`.`Preset`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `OKN`.`Preset` (
  `idPreset` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `price` INT NOT NULL,
  `genre` INT NOT NULL,
  `store` INT NULL,
  `payment` INT NULL,
  `attribute` VARCHAR(45) NULL,
  `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idPreset`),
  INDEX `idGenre_idx` (`genre` ASC) ,
  INDEX `idStore_idx` (`store` ASC) ,
  INDEX `idPayment_idx` (`payment` ASC) ,
  CONSTRAINT `idGenre`
    FOREIGN KEY (`genre`)
    REFERENCES `OKN`.`Genre` (`idGenre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idStore`
    FOREIGN KEY (`store`)
    REFERENCES `OKN`.`Store` (`idStore`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idPayment`
    FOREIGN KEY (`payment`)
    REFERENCES `OKN`.`Payment` (`idPayment`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `OKN`.`IncomeGenre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `OKN`.`IncomeGenre` (
  `idIncomeGenre` INT NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  `attribute` VARCHAR(45) NULL,
  `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idIncomeGenre`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `OKN`.`Income`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `OKN`.`Income` (
  `User` INT NOT NULL,
  `price` INT NOT NULL,
  `date` DATE NOT NULL,
  `Genre` INT NOT NULL,
  `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idUser_idx` (`User` ASC) ,
  INDEX `idGenre_idx` (`Genre` ASC) ,
  CONSTRAINT `idUser`
    FOREIGN KEY (`User`)
    REFERENCES `OKN`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idGenre`
    FOREIGN KEY (`Genre`)
    REFERENCES `OKN`.`IncomeGenre` (`idIncomeGenre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `OKN`.`IncomeGenreClassification`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `OKN`.`IncomeGenreClassification` (
  `Parent` INT NOT NULL,
  `Child` INT NOT NULL,
  `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX `ParentGenre_idx` (`Parent` ASC, `Child` ASC) ,
  CONSTRAINT `Genre`
    FOREIGN KEY (`Parent` , `Child`)
    REFERENCES `OKN`.`IncomeGenre` (`idIncomeGenre` , `idIncomeGenre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `OKN`.`Target`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `OKN`.`Target` (
  `User` INT NOT NULL,
  `price` INT NOT NULL,
  `start` DATE NOT NULL,
  `goal` DATE NOT NULL,
  `attribute` VARCHAR(45) NULL,
  `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idUser_idx` (`User` ASC) ,
  CONSTRAINT `idUser`
    FOREIGN KEY (`User`)
    REFERENCES `OKN`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `OKN`.`UserPaymentGenreRelation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `OKN`.`UserPaymentGenreRelation` (
  `User` INT NOT NULL,
  `PaymentGenre` INT NOT NULL,
  INDEX `idUser_idx` (`User` ASC) ,
  INDEX `idPaymentGenre_idx` (`PaymentGenre` ASC) ,
  CONSTRAINT `idUser`
    FOREIGN KEY (`User`)
    REFERENCES `OKN`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idPaymentGenre`
    FOREIGN KEY (`PaymentGenre`)
    REFERENCES `OKN`.`PaymentGenre` (`idPaymentGenre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
