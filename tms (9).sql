-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 15, 2025 at 09:24 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tms`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brands_name_unique` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:28:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:12:\"manage-users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:16:\"manage-customers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:19:\"manage-measurements\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:12:\"manage-types\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:13:\"manage-fields\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:13:\"manage-brands\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:16:\"manage-suppliers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:17:\"manage-categories\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"manage-products\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:13:\"manage-orders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:16:\"manage-purchases\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:15:\"manage-payments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:24:\"manage-roles-permissions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:20:\"manage-sewing-orders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:16:\"worker-dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:22:\"view-reports-dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:18:\"view-reports-sales\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:22:\"view-reports-customers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:22:\"view-reports-suppliers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:30:\"view-reports-inventory-history\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:28:\"view-reports-customer-ledger\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:28:\"view-reports-supplier-ledger\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:25:\"view-reports-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:33:\"view-reports-pending-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:35:\"view-reports-completed-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:30:\"view-reports-user-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:34:\"view-reports-customer-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:34:\"view-reports-supplier-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:7:\"manager\";s:1:\"c\";s:3:\"web\";}}}', 1763533112),
('tms-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:30:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:12:\"manage-users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:16:\"manage-customers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:19:\"manage-measurements\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:12:\"manage-types\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:13:\"manage-fields\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:13:\"manage-brands\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:16:\"manage-suppliers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:17:\"manage-categories\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"manage-products\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:13:\"manage-orders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:16:\"manage-purchases\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:15:\"manage-payments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:24:\"manage-roles-permissions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:20:\"manage-sewing-orders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:16:\"worker-dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:22:\"view-reports-dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:18:\"view-reports-sales\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:22:\"view-reports-customers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:22:\"view-reports-suppliers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:30:\"view-reports-inventory-history\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:28:\"view-reports-customer-ledger\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:28:\"view-reports-supplier-ledger\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:25:\"view-reports-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:33:\"view-reports-pending-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:35:\"view-reports-completed-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:30:\"view-reports-user-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:34:\"view-reports-customer-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:34:\"view-reports-supplier-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:15:\"manage-expenses\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:27:\"can_edit_order_measurements\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:7:\"manager\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"Suite Maker\";s:1:\"c\";s:3:\"web\";}}}', 1764343707),
('zeb-tailors-fabrics-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:32:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:12:\"manage-users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:16:\"manage-customers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:19:\"manage-measurements\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:12:\"manage-types\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:13:\"manage-fields\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:13:\"manage-brands\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:16:\"manage-suppliers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:17:\"manage-categories\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"manage-products\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:13:\"manage-orders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:16:\"manage-purchases\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:15:\"manage-payments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:24:\"manage-roles-permissions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:20:\"manage-sewing-orders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:16:\"worker-dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:22:\"view-reports-dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:18:\"view-reports-sales\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:22:\"view-reports-customers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:22:\"view-reports-suppliers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:30:\"view-reports-inventory-history\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:28:\"view-reports-customer-ledger\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:28:\"view-reports-supplier-ledger\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:25:\"view-reports-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:33:\"view-reports-pending-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:35:\"view-reports-completed-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:30:\"view-reports-user-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:34:\"view-reports-customer-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:34:\"view-reports-supplier-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:15:\"manage-expenses\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:27:\"can_edit_order_measurements\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:22:\"manage-worker-payments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:14:\"manage-workers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:7:\"manager\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"Suite Maker\";s:1:\"c\";s:3:\"web\";}}}', 1765207379);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_customer_id_unique` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_id`, `name`, `phone`, `email`, `address`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '74', 'August Velez', '+1 (948) 353-5856', 'nutis@mailinator.com', 'Non velit dignissimo', NULL, '2025-12-03 06:54:43', '2025-12-03 06:54:43');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `date` date NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expenses_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

DROP TABLE IF EXISTS `fields`;
CREATE TABLE IF NOT EXISTS `fields` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_id` bigint UNSIGNED NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'input',
  `options` json DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fields_type_id_foreign` (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `type_id`, `label`, `name`, `input_type`, `options`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'waist', 'pant_waist', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(2, 1, 'seat / hip', 'pant_seat_hip', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(3, 1, 'bottom', 'pant_bottom', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(4, 1, 'length', 'pant_length', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(5, 1, 'fit', 'pant_fit', 'select', '[\"Slim\", \"Regular\", \"Loose\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(6, 1, 'pocket style', 'pant_pocket_style', 'select', '[\"Cross\", \"Straight\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(7, 2, 'neck', 'shirt_neck', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(8, 2, 'chest', 'shirt_chest', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(9, 2, 'waist', 'shirt_waist', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(10, 2, 'shoulder', 'shirt_shoulder', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(11, 2, 'sleeve', 'shirt_sleeve', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(12, 2, 'cuff', 'shirt_cuff', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(13, 2, 'shirt length', 'shirt_length', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(14, 2, 'fit', 'shirt_fit', 'select', '[\"Slim\", \"Regular\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(15, 2, 'collar', 'shirt_collar', 'select', '[\"Spread\", \"Button-down\", \"Mandarin\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(16, 2, 'cuffs', 'shirt_cuffs', 'select', '[\"Single\", \"Double\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(17, 2, 'pocket', 'shirt_pocket', 'select', '[\"0\", \"1\", \"2\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(18, 2, 'daman', 'shirt_daman', 'select', '[\"Gool\", \"Sada\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(19, 3, 'length', 'kameez_length', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(20, 3, 'sleeve', 'kameez_sleeve', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(21, 3, 'collar', 'kameez_collar', 'select', '[\"Collar\", \"Short Collar\", \"Nokdar Collar\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(22, 3, 'bann', 'kameez_bann', 'select', '[\"Full Ban Cut\", \"Full Ban Gool\", \"Half Ban Cut\", \"Half Ban Gool\", \"Kabali Ban\", \"Design Ban\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(23, 3, 'cuff', 'kameez_cuff', 'select', '[\"Sada\", \"Gool\", \"Sada Cut\", \"Studd Kaag Gool\", \"Studd Kaag Sada\", \"Studd Double\", \"Cuff 2 Kaag\", \"Chk Patae Kaag\", \"Bagair Chk Patae\", \"Chk Patae 2 Kaag\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(24, 3, 'stitching', 'kameez_stitching', 'select', '[\"Simple\", \"Chamak\", \"Double Chamak\", \"Double Simple\", \"Conquer Stitch\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(25, 3, 'pocket', 'kameez_pocket', 'select', '[\"Side 1 Pocket\", \"Side 2 Pocket\", \"Front 1 Pocket\", \"Front 2 Pocket\", \"Front 2 Pocket Tash\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(26, 3, 'daman', 'kameez_daman', 'select', '[\"Sada\", \"Gool\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(27, 3, 'asteen', 'kameez_asteen', 'select', '[\"No Palet\", \"One Palet\", \"Two Palet\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(28, 3, 'buttons', 'kameez_buttons', 'select', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(29, 3, 'button style', 'kameez_button_style', 'select', '[\"Simple\", \"Design\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(30, 4, 'length', 'shalwar_length', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(31, 4, 'pancha', 'shalwar_pancha', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(32, 4, 'shalwar type', 'shalwar_type', 'select', '[\"Kundo Wala\", \"Bagair Kundo Wala\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(33, 4, 'asin width', 'shalwar_asin_width', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(34, 4, 'shalwar pockets', 'shalwar_shalwar_pockets', 'select', '[\"One\", \"Two\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(35, 4, 'paint pocket', 'shalwar_paint_pocket', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(36, 5, 'chest', 'coat_chest', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(37, 5, 'waist', 'coat_waist', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(38, 5, 'hip', 'coat_hip', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(39, 5, 'shoulder', 'coat_shoulder', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(40, 5, 'sleeve', 'coat_sleeve', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(41, 5, 'half back', 'coat_half_back', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(42, 5, 'chok', 'coat_chok', 'select', '[\"None\", \"Single\", \"Double\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(43, 5, 'fit', 'coat_fit', 'select', '[\"Slim\", \"Regular\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(44, 5, 'buttons', 'coat_buttons', 'select', '[\"1\", \"2\", \"3\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(45, 6, 'chest', 'waistcoat_chest', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(46, 6, 'waist', 'waistcoat_waist', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(47, 6, 'shoulder', 'waistcoat_shoulder', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(48, 6, 'length', 'waistcoat_length', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(49, 6, 'neck depth', 'waistcoat_neck_depth', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(50, 6, 'buttons', 'waistcoat_buttons', 'select', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(51, 6, 'style', 'waistcoat_style', 'select', '[\"Simple\", \"Design\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(52, 7, 'neck', 'shirt_neck', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(53, 7, 'chest', 'shirt_chest', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(54, 7, 'waist', 'shirt_waist', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(55, 7, 'shoulder', 'shirt_shoulder', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(56, 7, 'sleeve', 'shirt_sleeve', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(57, 7, 'cuff', 'shirt_cuff', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(58, 7, 'shirt length', 'shirt_length', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(59, 7, 'fit', 'shirt_fit', 'select', '[\"Slim\", \"Regular\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(60, 7, 'collar', 'shirt_collar', 'select', '[\"Spread\", \"Button-down\", \"Mandarin\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(61, 7, 'cuffs', 'shirt_cuffs', 'select', '[\"Single\", \"Double\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(62, 7, 'pocket', 'shirt_pocket', 'select', '[\"0\", \"1\", \"2\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(63, 7, 'daman', 'shirt_daman', 'select', '[\"Gool\", \"Sada\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(64, 7, 'waist', 'pant_waist', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(65, 7, 'seat / hip', 'pant_seat_hip', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(66, 7, 'bottom', 'pant_bottom', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(67, 7, 'length', 'pant_length', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(68, 7, 'fit', 'pant_fit', 'select', '[\"Slim\", \"Regular\", \"Loose\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(69, 7, 'pocket style', 'pant_pocket_style', 'select', '[\"Cross\", \"Straight\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(70, 8, 'length', 'kameez_length', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(71, 8, 'sleeve', 'kameez_sleeve', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(72, 8, 'collar', 'kameez_collar', 'select', '[\"Collar\", \"Short Collar\", \"Nokdar Collar\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(73, 8, 'bann', 'kameez_bann', 'select', '[\"Full Ban Cut\", \"Full Ban Gool\", \"Half Ban Cut\", \"Half Ban Gool\", \"Kabali Ban\", \"Design Ban\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(74, 8, 'cuff', 'kameez_cuff', 'select', '[\"Sada\", \"Gool\", \"Sada Cut\", \"Studd Kaag Gool\", \"Studd Kaag Sada\", \"Studd Double\", \"Cuff 2 Kaag\", \"Chk Patae Kaag\", \"Bagair Chk Patae\", \"Chk Patae 2 Kaag\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(75, 8, 'stitching', 'kameez_stitching', 'select', '[\"Simple\", \"Chamak\", \"Double Chamak\", \"Double Simple\", \"Conquer Stitch\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(76, 8, 'pocket', 'kameez_pocket', 'select', '[\"Side 1 Pocket\", \"Side 2 Pocket\", \"Front 1 Pocket\", \"Front 2 Pocket\", \"Front 2 Pocket Tash\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(77, 8, 'daman', 'kameez_daman', 'select', '[\"Sada\", \"Gool\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(78, 8, 'asteen', 'kameez_asteen', 'select', '[\"No Palet\", \"One Palet\", \"Two Palet\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(79, 8, 'buttons', 'kameez_buttons', 'select', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(80, 8, 'button style', 'kameez_button_style', 'select', '[\"Simple\", \"Design\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(81, 8, 'length', 'shalwar_length', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(82, 8, 'pancha', 'shalwar_pancha', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(83, 8, 'shalwar type', 'shalwar_type', 'select', '[\"Kundo Wala\", \"Bagair Kundo Wala\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(84, 8, 'asin width', 'shalwar_asin_width', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(85, 8, 'shalwar pockets', 'shalwar_shalwar_pockets', 'select', '[\"One\", \"Two\"]', NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(86, 8, 'paint pocket', 'shalwar_paint_pocket', 'input', NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_trackings`
--

DROP TABLE IF EXISTS `inventory_trackings`;
CREATE TABLE IF NOT EXISTS `inventory_trackings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `supplier_id` bigint UNSIGNED DEFAULT NULL,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `type` enum('purchase','sale','adjustment','return') COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity_meters` decimal(10,2) NOT NULL,
  `price_per_meter` decimal(10,2) DEFAULT NULL,
  `balance_meters` decimal(10,2) NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `reference_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inventory_trackings_product_id_foreign` (`product_id`),
  KEY `inventory_trackings_supplier_id_foreign` (`supplier_id`),
  KEY `inventory_trackings_order_id_foreign` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `measurements`
--

DROP TABLE IF EXISTS `measurements`;
CREATE TABLE IF NOT EXISTS `measurements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` json DEFAULT NULL,
  `style` json DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `measurements_customer_id_foreign` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `measurements`
--

INSERT INTO `measurements` (`id`, `customer_id`, `type`, `data`, `style`, `notes`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"12\\\",\\\"shoulder\\\":\\\"12\\\",\\\"sleeve\\\":\\\"12\\\",\\\"collar\\\":\\\"12\\\",\\\"chest\\\":\\\"12\\\",\\\"waist\\\":\\\"12\\\",\\\"width\\\":\\\"12\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"120\\\",\\\"pancha\\\":\\\"12\\\"}}\"', '{\"style_patty\": \"چار بٹن پٹی\", \"style_collar\": \"گلہ سادہ ہاف\", \"style_patty_width\": \"10\", \"style_collar_width\": \"2\", \"style_front_pocket\": \"عام جیب 5\'\' / 5.5\", \"style_patty_length\": \"12\", \"style_front_pocket_width\": \"5\", \"style_front_pocket_length\": \"6\"}', NULL, NULL, '2025-12-03 06:55:14', '2025-12-03 06:55:14');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_19_103027_create_customers_table', 1),
(5, '2025_10_19_103442_create_naaps_table', 1),
(6, '2025_10_19_123805_create_naap_histories_table', 1),
(7, '2025_10_21_152549_create_types_table', 1),
(8, '2025_10_21_152927_create_fields_table', 1),
(9, '2025_10_22_100909_create_measurements_table', 1),
(10, '2025_10_27_191002_create_brands_table', 1),
(11, '2025_10_27_220008_create_suppliers_table', 1),
(12, '2025_10_27_222551_create_categories_table', 1),
(13, '2025_11_02_000000_create_products_table', 1),
(14, '2025_11_02_000001_create_orders_table', 1),
(15, '2025_11_02_000002_create_order_items_table', 1),
(16, '2025_11_02_000003_create_inventory_tracking_table', 1),
(17, '2025_11_09_173010_create_payments_table', 1),
(18, '2025_11_13_110050_create_permission_tables', 1),
(19, '2025_11_13_204911_create_sewing_orders_table', 1),
(20, '2025_11_13_213119_create_sewing_order_items_table', 1),
(22, '2025_11_22_114504_create_expenses_table', 2),
(23, '2025_11_27_200705_create_sewing_order_item_user_table', 3),
(24, '2025_11_27_222603_create_worker_payments_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 6),
(10, 'App\\Models\\User', 6),
(14, 'App\\Models\\User', 6),
(15, 'App\\Models\\User', 6),
(30, 'App\\Models\\User', 1),
(31, 'App\\Models\\User', 1),
(32, 'App\\Models\\User', 6);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 2),
(4, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 6);

-- --------------------------------------------------------

--
-- Table structure for table `naaps`
--

DROP TABLE IF EXISTS `naaps`;
CREATE TABLE IF NOT EXISTS `naaps` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint UNSIGNED NOT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `length` decimal(8,2) DEFAULT NULL,
  `chest` decimal(8,2) DEFAULT NULL,
  `waist` decimal(8,2) DEFAULT NULL,
  `hip` decimal(8,2) DEFAULT NULL,
  `shoulder` decimal(8,2) DEFAULT NULL,
  `sleeve` decimal(8,2) DEFAULT NULL,
  `cuff` decimal(8,2) DEFAULT NULL,
  `bottom` decimal(8,2) DEFAULT NULL,
  `collar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `neck_depth` decimal(8,2) DEFAULT NULL,
  `buttons` int UNSIGNED DEFAULT NULL,
  `pocket_style` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pocket_count` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daman` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patae` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ban` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stitching` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asteen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btn_style` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chok` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `style` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seat` decimal(8,2) DEFAULT NULL,
  `pocket_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shalwar_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shalwar_asin` decimal(8,2) DEFAULT NULL,
  `shalwar_width` decimal(8,2) DEFAULT NULL,
  `half_back` decimal(8,2) DEFAULT NULL,
  `fit_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `naaps_customer_id_foreign` (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `naap_histories`
--

DROP TABLE IF EXISTS `naap_histories`;
CREATE TABLE IF NOT EXISTS `naap_histories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `naap_id` bigint UNSIGNED NOT NULL,
  `data` json NOT NULL,
  `version` int UNSIGNED NOT NULL,
  `updated_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `naap_histories_naap_id_foreign` (`naap_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `order_date` date NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` enum('online','cash','bank_transfer','cheque') COLLATE utf8mb4_unicode_ci DEFAULT 'cash',
  `payment_status` enum('partial','full','no_payment') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'full',
  `partial_amount` decimal(10,2) DEFAULT NULL,
  `remaining_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `is_return` tinyint(1) NOT NULL DEFAULT '0',
  `return_date` date DEFAULT NULL,
  `return_reason` text COLLATE utf8mb4_unicode_ci,
  `order_status` enum('pending','in_progress','completed','on_hold','cancelled','delivered') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_customer_id_foreign` (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `product_name` text COLLATE utf8mb4_unicode_ci,
  `is_from_inventory` tinyint(1) NOT NULL DEFAULT '1',
  `sell_price` decimal(10,2) NOT NULL,
  `quantity_meters` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `is_return` tinyint(1) NOT NULL DEFAULT '0',
  `return_date` date DEFAULT NULL,
  `return_reason` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','progress','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `payable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payable_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('cash','online','bank_transfer','cheque') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `person_reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_date` datetime NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `type` enum('payment','refund') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'payment',
  `refund_for_payment_id` bigint UNSIGNED DEFAULT NULL,
  `refund_reason` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_payable_type_payable_id_index` (`payable_type`,`payable_id`),
  KEY `payments_refund_for_payment_id_foreign` (`refund_for_payment_id`),
  KEY `payments_created_by_foreign` (`created_by`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payable_type`, `payable_id`, `amount`, `payment_method`, `person_reference`, `payment_date`, `notes`, `type`, `refund_for_payment_id`, `refund_reason`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\SewingOrder', 1, 1200.00, 'cash', NULL, '2025-12-03 12:59:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-03 07:59:27', '2025-12-03 07:59:27'),
(2, 'App\\Models\\SewingOrder', 1, 1200.00, 'cash', NULL, '2025-12-03 12:59:00', NULL, 'refund', 1, NULL, 1, NULL, '2025-12-03 08:00:05', '2025-12-03 08:00:05'),
(3, 'App\\Models\\SewingOrder', 1, 500.00, 'cash', NULL, '2025-12-03 13:00:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-03 08:00:17', '2025-12-03 08:00:17'),
(4, 'App\\Models\\SewingOrder', 1, 700.00, 'cash', NULL, '2025-12-03 13:08:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-03 08:09:17', '2025-12-03 08:09:17');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(161) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manage-users', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(2, 'manage-customers', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(3, 'manage-measurements', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(4, 'manage-types', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(5, 'manage-fields', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(6, 'manage-brands', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(7, 'manage-suppliers', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(8, 'manage-categories', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(9, 'manage-products', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(10, 'manage-orders', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(11, 'manage-purchases', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(12, 'manage-payments', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(13, 'manage-roles-permissions', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(14, 'manage-sewing-orders', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(15, 'worker-dashboard', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(16, 'view-reports-dashboard', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(17, 'view-reports-sales', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(18, 'view-reports-customers', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(19, 'view-reports-suppliers', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(20, 'view-reports-inventory-history', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(21, 'view-reports-customer-ledger', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(22, 'view-reports-supplier-ledger', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(23, 'view-reports-transactions', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(24, 'view-reports-pending-transactions', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(25, 'view-reports-completed-transactions', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(26, 'view-reports-user-transactions', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(27, 'view-reports-customer-transactions', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(28, 'view-reports-supplier-transactions', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(29, 'manage-expenses', 'web', '2025-11-24 04:36:20', '2025-11-24 04:36:20'),
(30, 'can_edit_order_measurements', 'web', '2025-11-24 17:29:25', '2025-11-24 17:29:25'),
(31, 'manage-worker-payments', 'web', '2025-11-27 17:46:44', '2025-11-27 17:46:44'),
(32, 'manage-workers', 'web', '2025-11-29 08:47:29', '2025-11-29 08:47:29');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` bigint UNSIGNED DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `supplier_id` bigint UNSIGNED DEFAULT NULL,
  `purchase_price` decimal(10,2) NOT NULL,
  `sell_price` decimal(10,2) NOT NULL,
  `available_meters` decimal(10,2) NOT NULL DEFAULT '0.00',
  `barcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_brand_id_foreign` (`brand_id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_supplier_id_foreign` (`supplier_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(166) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(2, 'manager', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(3, 'user', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(4, 'Suite Maker', 'web', '2025-11-24 04:31:32', '2025-11-24 04:31:32');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(3, 4),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(15, 4),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('06WVU1svXvGfpRwlEgutJ2nlamB2ONKEq3jJ2s6k', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoib3Y4b0g4UzFGcUJGT09Ham9NTHFjeW5xRkpJUjM1MUd1bVB6a1N6cSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3dvcmtlcnMvbGVkZ2VyIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zZXdpbmctb3JkZXItaXRlbXMvMS9wcmludC1tZWFzdXJlbWVudD9pZD0xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1765121471);

-- --------------------------------------------------------

--
-- Table structure for table `sewing_orders`
--

DROP TABLE IF EXISTS `sewing_orders`;
CREATE TABLE IF NOT EXISTS `sewing_orders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `sewing_order_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `order_date` date DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `paid_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `remaining_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payment_method` enum('cash','online','bank_transfer','cheque') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `partial_amount` decimal(10,2) DEFAULT NULL,
  `payment_status` enum('partial','full','no_payment') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'partial',
  `order_status` enum('pending','in_progress','completed','cancelled','delivered') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `delivered_date` date DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `cancelled_by` bigint UNSIGNED DEFAULT NULL,
  `cancellation_reason` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sewing_orders_customer_id_foreign` (`customer_id`),
  KEY `sewing_orders_cancelled_by_foreign` (`cancelled_by`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sewing_orders`
--

INSERT INTO `sewing_orders` (`id`, `sewing_order_number`, `customer_id`, `order_date`, `delivery_date`, `total_amount`, `paid_amount`, `remaining_amount`, `payment_method`, `partial_amount`, `payment_status`, `order_status`, `notes`, `delivered_date`, `cancelled_at`, `cancelled_by`, `cancellation_reason`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'SEW-000001', 1, '2025-12-03', '2025-12-30', 1200.00, 1200.00, 0.00, 'cash', 1200.00, 'full', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-03 06:55:54', '2025-12-07 15:25:54');

-- --------------------------------------------------------

--
-- Table structure for table `sewing_order_items`
--

DROP TABLE IF EXISTS `sewing_order_items`;
CREATE TABLE IF NOT EXISTS `sewing_order_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `sewing_order_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sewing_price` decimal(10,2) NOT NULL,
  `qty` int NOT NULL,
  `customer_measurement` text COLLATE utf8mb4_unicode_ci,
  `assign_note` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','on_hold','in_progress','cutter','sewing','completed','cancelled','delivered') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `delivered_date` date DEFAULT NULL,
  `cancelled_date` date DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `cancelled_by` bigint UNSIGNED DEFAULT NULL,
  `cancellation_reason` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sewing_order_items_sewing_order_id_foreign` (`sewing_order_id`),
  KEY `sewing_order_items_cancelled_by_foreign` (`cancelled_by`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sewing_order_items`
--

INSERT INTO `sewing_order_items` (`id`, `sewing_order_id`, `product_name`, `color`, `sewing_price`, `qty`, `customer_measurement`, `assign_note`, `status`, `delivered_date`, `cancelled_date`, `total_price`, `cancelled_at`, `cancelled_by`, `cancellation_reason`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'rando', NULL, 1200.00, 1, NULL, NULL, 'pending', NULL, NULL, 1200.00, NULL, NULL, NULL, NULL, '2025-12-03 06:55:54', '2025-12-03 08:21:17');

-- --------------------------------------------------------

--
-- Table structure for table `sewing_order_item_user`
--

DROP TABLE IF EXISTS `sewing_order_item_user`;
CREATE TABLE IF NOT EXISTS `sewing_order_item_user` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `sewing_order_item_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` enum('pending','on_hold','in_progress','cutter','sewing','completed','') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sewing_order_item_user_sewing_order_item_id_foreign` (`sewing_order_item_id`),
  KEY `sewing_order_item_user_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sewing_order_item_user`
--

INSERT INTO `sewing_order_item_user` (`id`, `sewing_order_item_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'in_progress', NULL, '2025-12-03 08:21:49'),
(2, 1, 6, 'pending', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_prefix` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_combined` tinyint(1) NOT NULL DEFAULT '0',
  `combine` json DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `name_prefix`, `is_combined`, `combine`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'pant', 'pant_', 0, NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(2, 'shirt', 'shirt_', 0, NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(3, 'kameez', 'kameez_', 0, NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(4, 'shalwar', 'shalwar_', 0, NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(5, 'coat', 'coat_', 0, NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(6, 'waistcoat', 'waistcoat_', 0, NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(7, 'shirt_pant', 'shirt_pant_', 0, NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59'),
(8, 'kameez_shalwar', 'kameez_shalwar_', 0, NULL, NULL, '2025-11-18 06:16:59', '2025-11-18 06:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `worker_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `worker_type`, `email_verified_at`, `password`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, 'admin', NULL, NULL, '$2y$12$6xOQ6Xpa3Fh786GdYqPbqeEW5xAqEKO5CQUxb3fK4Dsnb6qx8XPXa', NULL, NULL, '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(6, 'Hyacinth Burnett', 'susowobuq@mailinator.com', '+1 (675) 459-6794', NULL, 'suit maker', NULL, '$2y$12$h7MKSCwqBT8QmmZBxbbb/efCaOIoaRIViGl43glakRdKkBeqDnjm2', NULL, NULL, '2025-11-29 08:45:13', '2025-11-29 08:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `worker_payments`
--

DROP TABLE IF EXISTS `worker_payments`;
CREATE TABLE IF NOT EXISTS `worker_payments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `worker_id` bigint UNSIGNED NOT NULL,
  `sewing_order_item_id` bigint UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` enum('cash','online','bank_transfer','cheque') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `worker_payments_worker_id_foreign` (`worker_id`),
  KEY `worker_payments_sewing_order_item_id_foreign` (`sewing_order_item_id`),
  KEY `worker_payments_created_by_foreign` (`created_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
