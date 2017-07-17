-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.6.21 - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.1.0.4903
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para usersandroles
CREATE DATABASE IF NOT EXISTS `usersandroles` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `usersandroles`;


-- Volcando estructura para tabla usersandroles.alumnos
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `username` varchar(15) NOT NULL DEFAULT '0',
  `password` varchar(15) NOT NULL DEFAULT '0',
  `email` varchar(256) NOT NULL,
  `register_date` timestamp DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla usersandroles.user_role
CREATE TABLE IF NOT EXISTS `users_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla usersandroles.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla usersandroles.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla usersandroles.roles_permissions
CREATE TABLE IF NOT EXISTS `roles_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
-- La exportación de datos fue deseleccionada.

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
