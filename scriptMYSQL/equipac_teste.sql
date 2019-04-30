-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
-- -----------------------------------------------------
-- Schema equipac_teste
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema equipac_teste
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `equipac_teste` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`status` (
  `id` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`));

USE `equipac_teste` ;

-- -----------------------------------------------------
-- Table `equipac_teste`.`admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipac_teste`.`admin` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(16) NOT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `password` VARCHAR(32) NOT NULL,
  `admin_password_resets` VARCHAR(32) NOT NULL,
  `create_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `Update_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `equipac_teste`.`bolsista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipac_teste`.`bolsista` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `cpf` VARCHAR(255) NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `nivel` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 15
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `equipac_teste`.`bolsista_has_chamado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipac_teste`.`bolsista_has_chamado` (
  `bolsista_id` INT(10) UNSIGNED NOT NULL,
  `chamado_id` INT(11) NOT NULL,
  `chamado_problema_id` INT(11) NOT NULL,
  `chamado_problema_usuario_id` INT(11) NOT NULL,
  PRIMARY KEY (`bolsista_id`, `chamado_id`, `chamado_problema_id`, `chamado_problema_usuario_id`),
  INDEX `fk_bolsista_has_chamado_chamado1_idx` (`chamado_id` ASC, `chamado_problema_id` ASC, `chamado_problema_usuario_id` ASC) VISIBLE,
  INDEX `fk_bolsista_has_chamado_bolsista1_idx` (`bolsista_id` ASC) VISIBLE,
  CONSTRAINT `fk_bolsista_has_chamado_bolsista1`
    FOREIGN KEY (`bolsista_id`)
    REFERENCES `equipac_teste`.`bolsista` (`id`),
  CONSTRAINT `fk_bolsista_has_chamado_chamado1`
    FOREIGN KEY (`chamado_id` , `chamado_problema_id` , `chamado_problema_usuario_id`)
    REFERENCES `mydb`.`chamado` (`id` , `problema_id` , `problema_usuario_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `equipac_teste`.`manutencao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipac_teste`.`manutencao` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `solucao` VARCHAR(200) NULL DEFAULT NULL,
  `dataAtribuida` DATE NULL DEFAULT NULL,
  `dataFinalidada` DATE NULL DEFAULT NULL,
  `status_id` INT NOT NULL,
  PRIMARY KEY (`id`, `status_id`),
  INDEX `fk_manutencao_status1_idx` (`status_id` ASC) VISIBLE,
  CONSTRAINT `fk_manutencao_status1`
    FOREIGN KEY (`status_id`)
    REFERENCES `mydb`.`status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 22
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `equipac_teste`.`bolsista_has_manutencao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipac_teste`.`bolsista_has_manutencao` (
  `bolsista_id` INT(10) UNSIGNED NOT NULL,
  `manutencao_id` INT(11) NOT NULL,
  PRIMARY KEY (`bolsista_id`, `manutencao_id`),
  INDEX `fk_bolsista_has_manutencao_manutencao1_idx` (`manutencao_id` ASC) VISIBLE,
  INDEX `fk_bolsista_has_manutencao_bolsista1_idx` (`bolsista_id` ASC) VISIBLE,
  CONSTRAINT `fk_bolsista_has_manutencao_bolsista1`
    FOREIGN KEY (`bolsista_id`)
    REFERENCES `equipac_teste`.`bolsista` (`id`),
  CONSTRAINT `fk_bolsista_has_manutencao_manutencao1`
    FOREIGN KEY (`manutencao_id`)
    REFERENCES `equipac_teste`.`manutencao` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `equipac_teste`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipac_teste`.`usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NULL DEFAULT NULL,
  `password` VARCHAR(5000) NULL DEFAULT NULL,
  `usuario_password_resets` VARCHAR(32) NULL DEFAULT NULL,
  `cargo` VARCHAR(45) NULL DEFAULT NULL,
  `cpf` VARCHAR(11) NULL DEFAULT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `nivel` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `equipac_teste`.`equipamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipac_teste`.`equipamento` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `patrimonio` INT(11) NULL DEFAULT NULL,
  `modelo` VARCHAR(45) NULL DEFAULT NULL,
  `criacao` DATETIME NOT NULL,
  `usuario_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `usuario_id`),
  INDEX `fk_equipamento_usuario_idx` (`usuario_id` ASC) VISIBLE,
  CONSTRAINT `fk_equipamento_usuario`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `equipac_teste`.`usuario` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 19
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `equipac_teste`.`equipamento_has_manutencao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipac_teste`.`equipamento_has_manutencao` (
  `equipamento_id` INT(11) NOT NULL,
  `equipamento_usuario_id` INT(11) NOT NULL,
  `manutencao_id` INT(11) NOT NULL,
  PRIMARY KEY (`equipamento_id`, `equipamento_usuario_id`, `manutencao_id`),
  INDEX `fk_equipamento_has_manutencao_manutencao1_idx` (`manutencao_id` ASC) VISIBLE,
  INDEX `fk_equipamento_has_manutencao_equipamento1_idx` (`equipamento_id` ASC, `equipamento_usuario_id` ASC) VISIBLE,
  CONSTRAINT `fk_equipamento_has_manutencao_equipamento1`
    FOREIGN KEY (`equipamento_id` , `equipamento_usuario_id`)
    REFERENCES `equipac_teste`.`equipamento` (`id` , `usuario_id`),
  CONSTRAINT `fk_equipamento_has_manutencao_manutencao1`
    FOREIGN KEY (`manutencao_id`)
    REFERENCES `equipac_teste`.`manutencao` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `equipac_teste`.`problema`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipac_teste`.`problema` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(300) NULL DEFAULT NULL,
  `criacao` DATETIME NOT NULL,
  `finalizacao` TIMESTAMP NULL DEFAULT NULL,
  `usuario_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `usuario_id`),
  INDEX `fk_problema_usuario1_idx` (`usuario_id` ASC) VISIBLE,
  CONSTRAINT `fk_problema_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `equipac_teste`.`usuario` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 15
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
