-- --------------------------------------------------------
-- Хост:                         localhost
-- Версия сервера:               10.1.38-MariaDB - mariadb.org binary distribution
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Дамп структуры для таблица markhar.auth_assignment
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы markhar.auth_assignment: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
REPLACE INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
	('admin', '1', 1516965816),
	('user', '82', 1623846148),
	('user', '83', 1623846763),
	('user', '84', 1623846807),
	('user', '85', 1623847302),
	('user', '86', 1623854168);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;

-- Дамп структуры для таблица markhar.auth_item
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы markhar.auth_item: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
REPLACE INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('admin', 1, NULL, NULL, NULL, 1516965816, 1516965816),
	('beUser', 2, 'Пользоваться кабинетом', NULL, NULL, 1516965816, 1516965816),
	('user', 1, NULL, NULL, NULL, 1516965816, 1516965816),
	('viewAdminPage', 2, 'Просмотр админки', NULL, NULL, 1516965816, 1516965816);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;

-- Дамп структуры для таблица markhar.auth_item_child
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы markhar.auth_item_child: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
REPLACE INTO `auth_item_child` (`parent`, `child`) VALUES
	('admin', 'user'),
	('admin', 'viewAdminPage'),
	('user', 'beUser');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;

-- Дамп структуры для таблица markhar.auth_rule
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы markhar.auth_rule: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;

-- Дамп структуры для таблица markhar.contacts
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(12) NOT NULL COMMENT 'Номер телефона',
  `fullname` varchar(255) NOT NULL COMMENT 'ФИО',
  `type` int(2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL COMMENT 'Время добавления',
  PRIMARY KEY (`id`),
  KEY `fk_contacts_user_id` (`user_id`),
  CONSTRAINT `fk_contacts_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы markhar.contacts: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;

-- Дамп структуры для таблица markhar.earnings
CREATE TABLE IF NOT EXISTS `earnings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_earnings_user_id` (`user_id`),
  CONSTRAINT `fk_earnings_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы markhar.earnings: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `earnings` DISABLE KEYS */;
REPLACE INTO `earnings` (`id`, `user_id`, `type`, `amount`, `description`, `created_at`, `updated_at`, `status`) VALUES
	(16, 82, 1, 3.00, 'Бонус лояльности – зарплата (бинарный бонус) - Tazhin Amirzhan Х.(85)', 1623847330, 0, 1);
/*!40000 ALTER TABLE `earnings` ENABLE KEYS */;

-- Дамп структуры для таблица markhar.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы markhar.migration: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
REPLACE INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1516782637),
	('m130524_201442_init', 1516782650),
	('m140506_102106_rbac_init', 1516964994),
	('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1516964994);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;

-- Дамп структуры для таблица markhar.payments
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '0',
  `description` varchar(1024) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `user_id` int(6) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_payments_user_id` (`user_id`),
  CONSTRAINT `fk_payments_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы markhar.payments: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
REPLACE INTO `payments` (`id`, `type`, `description`, `amount`, `user_id`, `created_at`, `updated_at`, `status`) VALUES
	(70, 1, 'Оплата при регистрации', 25620.00, 82, 1623846149, 0, 1),
	(71, 1, 'Оплата при регистрации', 25620.00, 83, 1623846764, 0, 1),
	(72, 1, 'Оплата при регистрации', 25620.00, 84, 1623846807, 0, 1),
	(73, 1, 'Оплата при регистрации', 25620.00, 85, 1623847303, 0, 1),
	(74, 1, 'Оплата при регистрации', 60.00, 86, 1623854168, 0, 0);
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;

-- Дамп структуры для таблица markhar.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patr_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `iin` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `date_birth` date NOT NULL,
  `id_num` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `id_givenby` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_validdate` date NOT NULL,
  `card_num` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `card_validdate_month` int(2) NOT NULL,
  `card_validdate_year` int(4) NOT NULL,
  `card_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `house` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apartment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ref_id` int(11) DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `parent_user_id` int(11) NOT NULL,
  `left_cell` int(11) NOT NULL DEFAULT '0',
  `can_left` int(1) NOT NULL DEFAULT '0',
  `left_points` int(11) NOT NULL DEFAULT '0',
  `left_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `right_cell` int(11) NOT NULL DEFAULT '0',
  `can_right` int(1) NOT NULL DEFAULT '0',
  `right_points` int(11) NOT NULL DEFAULT '0',
  `right_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `level` int(11) NOT NULL DEFAULT '99999999',
  `company_margin` int(2) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  KEY `ref_id` (`ref_id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы markhar.user: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`id`, `first_name`, `last_name`, `patr_name`, `phone`, `iin`, `date_birth`, `id_num`, `id_givenby`, `id_validdate`, `card_num`, `card_validdate_month`, `card_validdate_year`, `card_name`, `country`, `city`, `street`, `house`, `apartment`, `username`, `ref_id`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `parent_user_id`, `left_cell`, `can_left`, `left_points`, `left_money`, `right_cell`, `can_right`, `right_points`, `right_money`, `level`, `company_margin`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'Система', '2', '+77772414999', '', '0000-00-00', '', '', '0000-00-00', '', 0, 0, '', '', '', '', '', '', 'admin', 0, 'RhzyuQ0jDZzEzG1gza-R3Q0HsAipNwsE', '$2y$13$mVeT5DL35bBaW.TpurQfLu4pwQgvQgTMbpK46/i/QHNp0JKKk1K8K', NULL, 'mail@tck.kz', 10, 0, 82, 1, 0, 0.00, 0, 0, 0, 0.00, 1, 0, 1516799867, 1623846151),
	(82, 'Amirzhan', 'Tazhin', 'Х.', '', '', '0000-00-00', '', '', '0000-00-00', '', 0, 0, '', '', '', '', '', '', 'M_I_N_E@mail.ru', 1, 'nhaxcJjEIT1APE_yIByZwfzNhtbCSK_H', '$2y$13$mWDPHv8Dt3Fp.tK6LsZlTutieBhURUeRnwN3DD/U/T.l0HG46pw6i', NULL, 'M_I_N_E@mail.ru', 10, 1, 83, 1, 2, 100.00, 85, 1, 1, 50.00, 2, 0, 1623846148, 1623847330),
	(83, 'Amirzhan', 'Tazhin', 'Х.', '', '', '0000-00-00', '', '', '0000-00-00', '', 0, 0, '', '', '', '', '', '', 'M_I_N_E@mail.ru1', 1, '4fDHML68xcVKlUIG7z1ivVEyK-IGuPlQ', '$2y$13$KOdFvc7uKU1PI5cytb5Dr.niJtDK6ZA/wF7sOTe7PnjX.dY.omlIy', NULL, 'M_I_N_E@mail.ru1', 10, 82, 84, 1, 1, 50.00, 0, 0, 0, 0.00, 3, 0, 1623846763, 1623846816),
	(84, 'Amirzhan', 'Tazhin', 'Х.', '', '', '0000-00-00', '', '', '0000-00-00', '', 0, 0, '', '', '', '', '', '', 'M_I_N_E@mail.ru3', 1, 'PCD6-7XnxY3IscWj1yoceD1kV_Av8_S-', '$2y$13$eySJq7aA3o0FIev78wxx7en5Gu4DFsPwFXFbABVlOWHOPKKjPBGt2', NULL, 'M_I_N_E@mail.ru3', 10, 83, 0, 1, 0, 0.00, 0, 0, 0, 0.00, 4, 0, 1623846807, 1623846816),
	(85, 'Amirzhan', 'Tazhin', 'Х.', '', '', '0000-00-00', '', '', '0000-00-00', '', 0, 0, '', '', '', '', '', '', '1M_I_N_E@mail.ru', 1, 'a7C5WqggIBf-dDRXX5BG5ZlVqzzuIkPW', '$2y$13$tERsq0833OzfeZz4TnIiaO0tYcaCNW7P4OqHbtuscV9q9sbV2pUo.', NULL, '1M_I_N_E@mail.ru', 10, 82, 0, 1, 0, 0.00, 0, 0, 0, 0.00, 3, 0, 1623847302, 1623847330),
	(86, 'Amirzhan', 'Tazhin', 'Х.', '', '', '0000-00-00', '', '', '0000-00-00', '', 0, 0, '', '', '', '', '', '', 'M_I1_N_E@mail.ru1', 1, 'Bih4i1svjBaXK6X5Gu9TB754CHWfJ3Fl', '$2y$13$RKB7/pbg21mvlxaLoHYZduZHY9.5kPnChSCKTxisvkmO.cXOTIulu', NULL, 'M_I1_N_E@mail.ru1', 10, 0, 0, 0, 0, 0.00, 0, 0, 0, 0.00, 99999999, 0, 1623854168, 1623854168);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Дамп структуры для таблица markhar.withdrawals
CREATE TABLE IF NOT EXISTS `withdrawals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `status` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_withdrawals_user_id` (`user_id`),
  CONSTRAINT `fk_withdrawals_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы markhar.withdrawals: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `withdrawals` DISABLE KEYS */;
/*!40000 ALTER TABLE `withdrawals` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
