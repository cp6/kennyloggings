/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES = @@SQL_NOTES, SQL_NOTES = 0 */;

CREATE DATABASE IF NOT EXISTS `kennyloggings` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `kennyloggings`;

CREATE TABLE IF NOT EXISTS `logs`
(
    `pid`       int(11)                       NOT NULL,
    `lid`       int(11)                       NOT NULL,
    `tid`       int(11)                       NOT NULL,
    `message`   varchar(255) COLLATE utf8_bin NOT NULL,
    `date_time` datetime                      NOT NULL,
    UNIQUE KEY `Index 1` (`pid`, `lid`, `date_time`, `tid`) USING BTREE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

/*!40000 ALTER TABLE `logs`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `logs`
    ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `log_type`
(
    `lid`  int(11)                      NOT NULL AUTO_INCREMENT,
    `type` varchar(64) COLLATE utf8_bin NOT NULL,
    PRIMARY KEY (`lid`),
    UNIQUE KEY `Index 2` (`type`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

/*!40000 ALTER TABLE `log_type`
    DISABLE KEYS */;
INSERT INTO `log_type` (`lid`, `type`)
VALUES (4, 'danger'),
       (5, 'fail'),
       (2, 'notice'),
       (1, 'success'),
       (3, 'warning');
/*!40000 ALTER TABLE `log_type`
    ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `projects`
(
    `pid`          int(11)                       NOT NULL AUTO_INCREMENT,
    `project_name` varchar(124) COLLATE utf8_bin NOT NULL,
    `date_added`   datetime                      NOT NULL,
    PRIMARY KEY (`pid`),
    UNIQUE KEY `Index 2` (`project_name`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

/*!40000 ALTER TABLE `projects`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `projects`
    ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `tasks`
(
    `tid`        int(11)                       NOT NULL AUTO_INCREMENT,
    `task`       varchar(124) COLLATE utf8_bin NOT NULL,
    `date_added` datetime                      NOT NULL,
    PRIMARY KEY (`tid`),
    UNIQUE KEY `Index 2` (`task`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

/*!40000 ALTER TABLE `tasks`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `tasks`
    ENABLE KEYS */;

/*!40101 SET SQL_MODE = IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS = IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES = IFNULL(@OLD_SQL_NOTES, 1) */;