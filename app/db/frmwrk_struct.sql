/* CREATE CORE DATABASE */

CREATE DATABASE IF NOT EXISTS `core` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `core`;


/* CREATE CORE TABLES */

CREATE TABLE IF NOT EXISTS `core_modules` (
  `name` VARCHAR(255) NOT NULL,
  `namespace` VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS `core_cache` (
  `filename` VARCHAR(255) NOT NULL,
  `date` VARCHAR(255) NOT NULL,
  `cache_index` TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS `core_admin` (
  `uid` INT(11) NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(255) NOT NULL,
  `a` INT(11) NOT NULL,
  `m` INT(11) NOT NULL,
  CONSTRAINT uc_pwd UNIQUE (a,m),
  CONSTRAINT pk_admin PRIMARY KEY (uid)
);

CREATE TABLE IF NOT EXISTS `a` (
  `aid` INT(11) NOT NULL AUTO_INCREMENT,
  `b` TEXT NOT NULL,
  CONSTRAINT pk_a PRIMARY KEY (aid)
);

CREATE TABLE IF NOT EXISTS `m` (
  `mid` INT(11) NOT NULL AUTO_INCREMENT,
  `n` TEXT NOT NULL,
  `s` INT(11) NOT NULL,
  CONSTRAINT pk_m PRIMARY KEY (mid)
);


/* INSERT INTO CORE TABLES */

INSERT INTO `core_admin` (`uid`, `login`, `a`, `m`) VALUES
(5, 'jean', 8, 5),
(9, 'admin', 12, 9);

INSERT INTO `a` (`aid`, `b`) VALUES
(8, '4AMpFBc3AfRZ8OzSTkJG/Q=='),
(12, 'GPr5aphiiqzjAQC2CE/tfg==');

INSERT INTO `m` (`mid`, `n`, `s`) VALUES
(5, '6jZzk+HKi/0xqlvzp4Ofbw==', 8),
(9, 'KHtVlE2LSDc0UHoNybaZoQ==', 8);
