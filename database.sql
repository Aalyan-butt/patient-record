-- ============================================================
--  Patient Clinical Records — Database Schema
--  Import via: phpMyAdmin > Import, or run in MySQL CLI
-- ============================================================

CREATE DATABASE IF NOT EXISTS `patient_record`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `patient_record`;

-- ------------------------------------------------------------
--  Main table
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `patient_records` (
  `id`           INT              NOT NULL AUTO_INCREMENT,
  `unique_id`    VARCHAR(10)      NOT NULL               COMMENT 'Patient identifier, 4-digit e.g. 0001',
  `date`         DATE             NOT NULL,
  `time`         TIME             NOT NULL,
  `visit_number` INT              NOT NULL DEFAULT 1      COMMENT 'Auto-incremented per unique_id',
  `name`         VARCHAR(255)     NOT NULL,
  `parentage`    VARCHAR(255)     DEFAULT ''              COMMENT 'Father / guardian name',
  `age`          TINYINT UNSIGNED DEFAULT NULL,
  `gender`       ENUM('Male','Female','Other') DEFAULT NULL,
  `weight`       DECIMAL(5,2)     DEFAULT NULL            COMMENT 'Weight in kg',
  `phone`        VARCHAR(30)      DEFAULT '',
  `address`      TEXT             DEFAULT NULL,
  `allergy`      TEXT             DEFAULT NULL,
  `symptoms`     TEXT             DEFAULT NULL            COMMENT 'Symptoms / history / condition',
  `findings`     TEXT             DEFAULT NULL            COMMENT 'Clinical findings',
  `treatment`    TEXT             DEFAULT NULL,
  `created_at`   TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (`id`),
  INDEX `idx_unique_id` (`unique_id`),
  INDEX `idx_date`      (`date`),
  INDEX `idx_name`      (`name`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;
