CREATE DATABASE IF NOT EXISTS `portfolio`
CHARACTER SET utf8mb4
COLLATE utf8mb4_0900_ai_ci;

USE `portfolio`;

DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `idproject` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `github_link` varchar(200) DEFAULT NULL,
  `project_link` varchar(200) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `tech_stack` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idproject`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `skills`;
CREATE TABLE `skills` (
  `idskills` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idskills`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;