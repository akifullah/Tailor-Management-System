-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2025 at 08:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tms2`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` varchar(191) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `description`, `deleted_at`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Imported', NULL, NULL, 'Admin', '2025-12-02 08:24:28', '2025-12-02 08:24:28'),
(2, 'Grace', NULL, NULL, 'Admin', '2025-12-02 08:36:31', '2025-12-02 08:36:31'),
(3, 'Admani', NULL, NULL, 'Admin', '2025-12-02 08:37:21', '2025-12-02 08:37:21'),
(4, 'Time Tex', NULL, NULL, 'Admin', '2025-12-03 04:50:40', '2025-12-03 04:50:40'),
(5, 'KSG', NULL, NULL, 'Admin', '2025-12-03 12:49:58', '2025-12-03 12:49:58'),
(6, 'Qiza', NULL, NULL, 'Admin', '2025-12-03 12:56:20', '2025-12-03 12:56:20'),
(7, 'JNG', NULL, NULL, 'Admin', '2025-12-04 07:48:40', '2025-12-04 07:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:28:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:12:\"manage-users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:16:\"manage-customers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:19:\"manage-measurements\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:12:\"manage-types\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:13:\"manage-fields\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:13:\"manage-brands\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:16:\"manage-suppliers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:17:\"manage-categories\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"manage-products\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:13:\"manage-orders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:16:\"manage-purchases\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:15:\"manage-payments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:24:\"manage-roles-permissions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:20:\"manage-sewing-orders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:16:\"worker-dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:22:\"view-reports-dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:18:\"view-reports-sales\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:22:\"view-reports-customers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:22:\"view-reports-suppliers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:30:\"view-reports-inventory-history\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:28:\"view-reports-customer-ledger\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:28:\"view-reports-supplier-ledger\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:25:\"view-reports-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:33:\"view-reports-pending-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:35:\"view-reports-completed-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:30:\"view-reports-user-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:34:\"view-reports-customer-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:34:\"view-reports-supplier-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:7:\"manager\";s:1:\"c\";s:3:\"web\";}}}', 1763533112),
('tms-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:30:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:12:\"manage-users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:16:\"manage-customers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:19:\"manage-measurements\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:12:\"manage-types\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:13:\"manage-fields\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:13:\"manage-brands\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:16:\"manage-suppliers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:17:\"manage-categories\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"manage-products\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:13:\"manage-orders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:16:\"manage-purchases\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:15:\"manage-payments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:24:\"manage-roles-permissions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:20:\"manage-sewing-orders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:16:\"worker-dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:22:\"view-reports-dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:18:\"view-reports-sales\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:22:\"view-reports-customers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:22:\"view-reports-suppliers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:30:\"view-reports-inventory-history\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:28:\"view-reports-customer-ledger\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:28:\"view-reports-supplier-ledger\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:25:\"view-reports-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:33:\"view-reports-pending-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:35:\"view-reports-completed-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:30:\"view-reports-user-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:34:\"view-reports-customer-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:34:\"view-reports-supplier-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:15:\"manage-expenses\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:27:\"can_edit_order_measurements\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:7:\"manager\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"Suite Maker\";s:1:\"c\";s:3:\"web\";}}}', 1764343707),
('zeb-tailors-fabrics-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:32:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:12:\"manage-users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:16:\"manage-customers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:19:\"manage-measurements\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:12:\"manage-types\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:13:\"manage-fields\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:13:\"manage-brands\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:16:\"manage-suppliers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:17:\"manage-categories\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"manage-products\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:13:\"manage-orders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:16:\"manage-purchases\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:15:\"manage-payments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:24:\"manage-roles-permissions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:20:\"manage-sewing-orders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:3;i:2;i:4;i:3;i:5;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:16:\"worker-dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:3;i:2;i:4;i:3;i:5;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:22:\"view-reports-dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:18:\"view-reports-sales\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:22:\"view-reports-customers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:22:\"view-reports-suppliers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:30:\"view-reports-inventory-history\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:28:\"view-reports-customer-ledger\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:28:\"view-reports-supplier-ledger\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:25:\"view-reports-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:33:\"view-reports-pending-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:35:\"view-reports-completed-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:30:\"view-reports-user-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:34:\"view-reports-customer-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:34:\"view-reports-supplier-transactions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:15:\"manage-expenses\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:27:\"can_edit_order_measurements\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:22:\"manage-worker-payments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:3;i:2;i:4;i:3;i:5;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:14:\"manage-workers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:5:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:7:\"manager\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:6:\"Cutter\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"Suite Maker\";s:1:\"c\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";i:5;s:1:\"b\";s:6:\"Worker\";s:1:\"c\";s:3:\"web\";}}}', 1765879709);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(191) NOT NULL,
  `owner` varchar(191) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'TR960', NULL, '2025-12-02 08:23:47', '2025-12-02 08:23:47'),
(2, 'JNG', NULL, '2025-12-02 08:37:28', '2025-12-02 08:37:28'),
(3, 'Time Tex', NULL, '2025-12-03 04:51:07', '2025-12-03 04:51:07'),
(4, '98000', NULL, '2025-12-03 12:50:10', '2025-12-03 12:50:10'),
(5, '100000', NULL, '2025-12-03 12:51:12', '2025-12-03 12:51:12'),
(6, 'Qiza Super Fine', NULL, '2025-12-03 12:56:57', '2025-12-03 12:56:57'),
(7, 'JNG Local', NULL, '2025-12-04 07:49:03', '2025-12-04 07:49:03'),
(8, 'KSG', NULL, '2025-12-04 13:53:51', '2025-12-04 13:53:51');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` varchar(191) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_id`, `name`, `phone`, `email`, `address`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '100', 'Atif', '03125446922', NULL, 'Mohallah Hasan Khel PO Prang Distt & Tehsil Charsadda.', NULL, '2025-11-28 06:38:08', '2025-11-28 06:38:08'),
(2, NULL, 'Abbas Khan', '03158652908', NULL, 'Sardheri', NULL, '2025-11-30 10:35:16', '2025-11-30 10:35:16'),
(3, '1827', 'Nasir Ali', '03128453762', NULL, 'Karachi', NULL, '2025-12-02 06:37:56', '2025-12-02 06:37:56'),
(4, '1061', 'Wali Ullah', '03339373325', NULL, 'Charsadda', NULL, '2025-12-02 06:45:55', '2025-12-02 06:45:55'),
(5, '1037', 'Sunail', '03349081021', NULL, 'Charsadda', NULL, '2025-12-02 06:50:28', '2025-12-02 06:50:28'),
(6, '920', 'M Rahat Sb', '03459129645', NULL, 'Sardaryab', NULL, '2025-12-02 07:40:20', '2025-12-02 07:40:20'),
(7, '705', 'Sajid', '03119632045', NULL, 'Nisatta', NULL, '2025-12-02 08:12:53', '2025-12-02 08:12:53'),
(8, '169', 'Shaukat', '0333555337', NULL, 'Rajjar', NULL, '2025-12-02 08:17:31', '2025-12-02 08:17:31'),
(9, NULL, 'Falak Niaz', '03149950016', NULL, 'Charsadda', NULL, '2025-12-02 08:17:59', '2025-12-02 08:17:59'),
(10, '659', 'Ali Haider', '03135633745', NULL, 'Prang', NULL, '2025-12-02 08:30:33', '2025-12-02 08:30:33'),
(11, '658', 'Atif Jan', '03018768666', 'atifjan2019@gmail.com', 'Prang Hassan Khel', NULL, '2025-12-02 08:47:46', '2025-12-02 08:47:46'),
(12, '1992', 'Aimal', '03199583242', NULL, NULL, NULL, '2025-12-02 11:05:30', '2025-12-02 11:05:30'),
(13, '359', 'Atif', '03118892233', NULL, NULL, NULL, '2025-12-02 11:09:10', '2025-12-02 11:09:10'),
(14, '1991', 'Munir Shah', '03339736833', NULL, NULL, NULL, '2025-12-02 11:13:25', '2025-12-02 11:13:25'),
(15, '1872', 'M Sohail', '03339151146', NULL, NULL, NULL, '2025-12-02 12:07:53', '2025-12-02 12:07:53'),
(16, '1799', 'Gul Nawaz', '03339408097', NULL, NULL, NULL, '2025-12-02 12:11:15', '2025-12-02 12:11:15'),
(17, '2538', 'Usman Zeb', '03336959583', NULL, NULL, NULL, '2025-12-02 12:43:29', '2025-12-02 12:43:29'),
(18, '2446', 'Umar Zeb', '03339114', NULL, NULL, NULL, '2025-12-02 12:47:06', '2025-12-02 12:47:06'),
(19, '1801', 'Arab Ul', '03100962848', NULL, NULL, NULL, '2025-12-02 12:59:54', '2025-12-11 07:39:54'),
(20, NULL, 'Bakht Zada', '03457683072', NULL, NULL, NULL, '2025-12-03 04:53:32', '2025-12-03 04:53:32'),
(21, '1989', 'Malik Sohail', '03208508108', NULL, NULL, NULL, '2025-12-03 06:01:06', '2025-12-03 06:01:06'),
(22, '419', 'Zaki Ullah', '03469130702', NULL, 'Umarzai', NULL, '2025-12-03 09:00:44', '2025-12-03 09:00:44'),
(23, '1806', 'Imdadul', '03139745076', NULL, NULL, NULL, '2025-12-03 10:59:30', '2025-12-03 10:59:30'),
(24, '626', 'Fatih', '03329500383', NULL, 'Prang', NULL, '2025-12-04 05:16:56', '2025-12-04 05:16:56'),
(25, '1269', 'Salman', '03149660815', NULL, 'Sardheri', NULL, '2025-12-04 05:30:11', '2025-12-04 05:30:11'),
(26, '1971', 'Ali Nasir', '03159238088', NULL, NULL, NULL, '2025-12-04 05:51:47', '2025-12-04 05:51:47'),
(27, '1921', 'Attaul', '03305800178', NULL, 'Nowshehra Road', NULL, '2025-12-04 05:57:22', '2025-12-04 05:57:22'),
(28, '1891', 'Abdul R', '03055638811', NULL, 'Zor Bazar', NULL, '2025-12-04 06:11:04', '2025-12-04 06:18:44'),
(29, '1398', 'Feroz', '03369000849', NULL, NULL, NULL, '2025-12-04 07:11:54', '2025-12-04 07:11:54'),
(30, '57', 'Malang Jan', '03157175575', NULL, NULL, NULL, '2025-12-04 07:21:44', '2025-12-04 07:21:44'),
(31, '494', 'Numan', '03179636794', NULL, NULL, NULL, '2025-12-04 07:24:54', '2025-12-04 07:24:54'),
(32, '986', 'Shakeel', '03105586865', NULL, 'Prang', NULL, '2025-12-04 07:28:17', '2025-12-04 07:28:17'),
(33, '1977', 'Uzair', '03025745773', NULL, NULL, NULL, '2025-12-04 07:47:58', '2025-12-04 07:50:15'),
(34, '1975', 'Waheed Jan', '03136510959', NULL, 'Babra', NULL, '2025-12-04 08:13:50', '2025-12-04 08:13:50'),
(35, '1525', 'Ghafoor Shah', '03149963146', NULL, NULL, NULL, '2025-12-04 09:07:27', '2025-12-04 09:07:27'),
(36, '1357', 'Masood', '03209117311', NULL, 'Agra', NULL, '2025-12-04 10:15:27', '2025-12-04 10:15:27'),
(37, '126', 'Usman', '03109509151', NULL, NULL, NULL, '2025-12-04 10:31:41', '2025-12-04 10:31:41'),
(38, '240', 'Waqar Khan', '03125631275', NULL, NULL, NULL, '2025-12-04 10:48:22', '2025-12-04 10:48:22'),
(39, '99', 'Shakeel', '03330602211', NULL, 'Rajjar', NULL, '2025-12-04 10:58:58', '2025-12-04 10:58:58'),
(40, '623', 'Farman', '03339202291', NULL, NULL, NULL, '2025-12-04 11:54:21', '2025-12-04 11:54:21'),
(41, '1998', 'Haris', '03101986902', NULL, NULL, NULL, '2025-12-04 12:28:40', '2025-12-04 12:32:18'),
(42, '1535', 'Imdadul', '03078075574', NULL, NULL, NULL, '2025-12-04 12:38:39', '2025-12-04 12:38:39'),
(43, '1983', 'Junaid', '03138910057', NULL, 'Tangi', NULL, '2025-12-04 12:56:40', '2025-12-04 12:56:40'),
(44, '6054', 'Masood', '03149823269', NULL, 'Kuladher', NULL, '2025-12-04 13:42:45', '2025-12-04 13:44:26'),
(45, '1984', 'Haider Ali', '03068184598', NULL, 'Tangi', NULL, '2025-12-04 13:48:24', '2025-12-04 13:48:24'),
(46, NULL, 'C/o Mehmood', 'nil', NULL, NULL, NULL, '2025-12-04 13:52:52', '2025-12-04 13:52:52'),
(47, NULL, 'Baba Jan', '03459119893', NULL, NULL, NULL, '2025-12-06 08:24:54', '2025-12-06 08:24:54'),
(48, '1533', 'Zafar', '03161934574', NULL, 'Babra', NULL, '2025-12-06 09:33:59', '2025-12-06 09:33:59'),
(49, '1963', 'Usman Khalid', '03159394244', NULL, NULL, NULL, '2025-12-06 09:38:45', '2025-12-06 09:38:45'),
(50, NULL, 'Ijaz', '03332717900', NULL, NULL, NULL, '2025-12-06 10:20:43', '2025-12-06 10:20:43'),
(51, NULL, 'Esa Khan', '03005999396', NULL, 'Babra', NULL, '2025-12-06 10:23:35', '2025-12-06 10:23:35'),
(52, NULL, 'Uzair Shah', '03130841000', NULL, 'Bagh Korona', NULL, '2025-12-06 10:32:33', '2025-12-06 10:32:33'),
(53, NULL, 'Aneer Khan', '03339293594', NULL, NULL, NULL, '2025-12-06 12:56:18', '2025-12-10 04:11:35'),
(54, '209', 'Shakeel', '03341000545', NULL, 'Peshawar', NULL, '2025-12-07 10:47:59', '2025-12-07 10:47:59'),
(55, '356', 'Abdul Khaliq', '03152328423', NULL, NULL, NULL, '2025-12-07 11:03:12', '2025-12-07 11:03:12'),
(56, '1936', 'Ali Khan', '03369142334', NULL, NULL, NULL, '2025-12-07 11:06:10', '2025-12-07 11:06:10'),
(57, NULL, 'Jan M', '03124849506', NULL, NULL, NULL, '2025-12-08 06:34:23', '2025-12-08 06:34:23'),
(58, NULL, 'Hassan', '03015083346', NULL, NULL, NULL, '2025-12-08 10:23:01', '2025-12-08 10:23:01'),
(59, NULL, 'Jabir Hayyan', '03018939400', NULL, NULL, NULL, '2025-12-10 10:33:12', '2025-12-10 10:35:18'),
(60, '290', 'Abdul Jalil', '03179720220', NULL, NULL, NULL, '2025-12-10 10:36:42', '2025-12-10 10:36:42'),
(61, '476', 'Haji Farhad', '03455095209', NULL, NULL, NULL, '2025-12-10 10:40:56', '2025-12-10 10:40:56'),
(62, '510', 'Haji Abdullah', '03145989797', NULL, NULL, NULL, '2025-12-10 11:05:58', '2025-12-10 11:05:58'),
(63, '1979', 'Abdul Rehman', '03189510760', NULL, NULL, NULL, '2025-12-10 12:25:32', '2025-12-10 12:31:05'),
(64, '1408', 'Umair', '03125909592', NULL, NULL, NULL, '2025-12-11 05:37:30', '2025-12-11 05:37:30'),
(65, '1409', 'Wajid', '03159942559', NULL, NULL, NULL, '2025-12-11 05:40:21', '2025-12-11 05:41:40'),
(66, NULL, 'Numan', '03331365339', NULL, NULL, NULL, '2025-12-11 05:45:24', '2025-12-11 05:45:24'),
(67, '123', 'Faizan', '03009893781', NULL, 'Hasan Khel', NULL, '2025-12-11 06:12:08', '2025-12-11 06:12:08'),
(68, '1980', 'Akhter Amin', '03088108041', NULL, NULL, NULL, '2025-12-11 06:16:23', '2025-12-11 06:16:23'),
(69, '2320', 'Khaif Ul', '03005871230', NULL, 'Gul Bela', NULL, '2025-12-11 07:10:29', '2025-12-11 07:10:29'),
(70, '1505', 'Ihsan Ali', '03459110099', NULL, NULL, NULL, '2025-12-11 07:18:35', '2025-12-11 07:18:35'),
(71, '972', 'Jan Alam', '03149955428', NULL, NULL, NULL, '2025-12-11 07:21:50', '2025-12-11 07:21:50'),
(72, NULL, 'Mustafa', '03369394590', NULL, 'Son Jan Alam', NULL, '2025-12-11 07:28:27', '2025-12-11 07:28:27'),
(73, '1444', 'Haleem Shah', '03025509651', NULL, NULL, NULL, '2025-12-11 07:33:02', '2025-12-11 07:33:02'),
(74, '608', 'Zarak', '03149635748', NULL, NULL, NULL, '2025-12-11 07:35:21', '2025-12-11 07:35:21'),
(75, '1985', 'Waqas Zada', '03159441355', NULL, NULL, NULL, '2025-12-11 08:43:32', '2025-12-11 08:43:32'),
(76, NULL, 'Ihsan', '03139604955', NULL, NULL, NULL, '2025-12-11 08:52:51', '2025-12-11 08:52:51'),
(77, NULL, 'Fazli Wahid', '03147132041', NULL, NULL, NULL, '2025-12-11 09:07:51', '2025-12-11 09:07:51'),
(78, '144', 'Saif r', '03018888659', NULL, NULL, NULL, '2025-12-11 11:52:33', '2025-12-11 11:52:33'),
(79, '1407', 'Zubair', '03028863051', NULL, 'Umarzai', NULL, '2025-12-13 09:32:21', '2025-12-13 09:32:21'),
(80, '1706', 'Amjid', '03025576566', NULL, NULL, NULL, '2025-12-13 09:36:21', '2025-12-13 09:36:21'),
(81, '1006', 'ABdul Haleem', '03145181919', NULL, NULL, NULL, '2025-12-13 12:21:20', '2025-12-13 12:21:20'),
(82, '519', 'Abdul Rehman', '03018931925', NULL, 'Peshawar Board', NULL, '2025-12-14 07:48:42', '2025-12-14 07:49:58'),
(83, '175', 'Jahangir', '03139430818', NULL, NULL, NULL, '2025-12-14 08:27:53', '2025-12-14 08:27:53'),
(84, '418', 'Anees', '03009364711', NULL, NULL, NULL, '2025-12-14 10:10:39', '2025-12-14 10:10:39'),
(85, '1258', 'haji qayum', '03339126150', NULL, NULL, NULL, '2025-12-14 10:48:36', '2025-12-14 10:48:36'),
(86, '1967', 'M Umair', '03109726660', NULL, NULL, NULL, '2025-12-14 11:06:11', '2025-12-14 11:06:11'),
(87, '1456', 'Rokhan Zeb', '03193099052', NULL, NULL, NULL, '2025-12-14 11:34:31', '2025-12-14 11:34:31'),
(88, NULL, 'Salman Khan', '03142993167', NULL, NULL, NULL, '2025-12-14 11:41:56', '2025-12-14 11:41:56'),
(89, '283', 'Fawad', '03129982730', NULL, NULL, NULL, '2025-12-15 05:20:09', '2025-12-15 05:20:09'),
(90, '1960', 'jawad', '03110929240', NULL, NULL, NULL, '2025-12-15 05:27:25', '2025-12-15 05:27:25'),
(91, '2239', 'Ali haider', '03012752486', NULL, NULL, NULL, '2025-12-15 11:45:03', '2025-12-15 11:45:03'),
(92, NULL, 'Numan', '03141199451', NULL, NULL, NULL, '2025-12-15 11:54:31', '2025-12-15 11:58:18');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `date` date NOT NULL,
  `category` varchar(191) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `title`, `amount`, `description`, `date`, `category`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Worker Payment', 200.00, 'Worker payment', '2025-12-16', 'worker_payment', 1, NULL, '2025-12-16 20:07:10', '2025-12-16 20:07:10'),
(2, 'Worker Payment', 100.00, 'Worker payment', '2025-12-16', 'worker_payment', 1, NULL, '2025-12-16 20:07:33', '2025-12-16 20:07:33'),
(3, 'Worker Payment', 200.00, 'Worker payment', '2025-12-16', 'worker_payment', 1, NULL, '2025-12-16 20:09:20', '2025-12-16 20:09:20');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE `fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `input_type` varchar(191) NOT NULL DEFAULT 'input',
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `inventory_trackings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` enum('purchase','sale','adjustment','return') NOT NULL,
  `quantity_meters` decimal(10,2) NOT NULL,
  `price_per_meter` decimal(10,2) DEFAULT NULL,
  `balance_meters` decimal(10,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `reference_number` varchar(191) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory_trackings`
--

INSERT INTO `inventory_trackings` (`id`, `product_id`, `supplier_id`, `order_id`, `type`, `quantity_meters`, `price_per_meter`, `balance_meters`, `notes`, `reference_number`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1, 'sale', -12.00, NULL, 88.00, 'Sale - Order #ORD-000001', 'ORD-000001', NULL, '2025-12-02 08:26:27', '2025-12-02 08:26:27'),
(2, 3, NULL, 2, 'sale', -8.00, NULL, 92.00, 'Sale - Order #ORD-000002', 'ORD-000002', NULL, '2025-12-03 04:56:43', '2025-12-03 04:56:43'),
(3, 5, NULL, 3, 'sale', -8.00, NULL, 142.00, 'Sale - Order #ORD-000003', 'ORD-000003', NULL, '2025-12-03 12:53:13', '2025-12-03 12:53:13'),
(4, 3, NULL, 4, 'sale', -12.00, NULL, 80.00, 'Sale - Order #ORD-000004', 'ORD-000004', NULL, '2025-12-03 12:53:46', '2025-12-03 12:53:46'),
(5, 4, NULL, 5, 'sale', -18.00, NULL, 132.00, 'Sale - Order #ORD-000005', 'ORD-000005', NULL, '2025-12-04 06:02:48', '2025-12-04 06:02:48'),
(6, 7, NULL, 5, 'sale', -4.00, NULL, 146.00, 'Sale - Order #ORD-000005', 'ORD-000005', NULL, '2025-12-04 06:02:48', '2025-12-04 06:02:48'),
(7, 8, NULL, 6, 'sale', -8.00, NULL, 62.00, 'Sale - Order #ORD-000006', 'ORD-000006', NULL, '2025-12-04 07:51:07', '2025-12-04 07:51:07'),
(8, 8, NULL, 7, 'sale', -8.00, NULL, 54.00, 'Sale - Order #ORD-000007', 'ORD-000007', NULL, '2025-12-04 12:01:25', '2025-12-04 12:01:25'),
(9, 9, NULL, 8, 'sale', -4.00, NULL, 96.00, 'Sale - Order #ORD-000008', 'ORD-000008', NULL, '2025-12-04 13:55:23', '2025-12-04 13:55:23'),
(10, 4, NULL, 9, 'sale', -4.00, NULL, 128.00, 'Sale - Order #ORD-000009', 'ORD-000009', NULL, '2025-12-06 10:57:44', '2025-12-06 10:57:44'),
(11, 1, NULL, 10, 'sale', -4.00, NULL, 84.00, 'Sale - Order #ORD-000010', 'ORD-000010', NULL, '2025-12-07 11:02:03', '2025-12-07 11:02:03'),
(12, 1, NULL, 11, 'sale', -4.00, NULL, 80.00, 'Sale - Order #ORD-000011', 'ORD-000011', NULL, '2025-12-07 11:10:33', '2025-12-07 11:10:33'),
(13, 7, NULL, 12, 'sale', -4.00, NULL, 142.00, 'Sale - Order #ORD-000012', 'ORD-000012', NULL, '2025-12-10 10:36:16', '2025-12-10 10:36:16'),
(14, 7, NULL, 13, 'sale', -4.50, NULL, 137.50, 'Sale - Order #ORD-000013', 'ORD-000013', NULL, '2025-12-10 10:38:54', '2025-12-10 10:38:54'),
(15, 1, NULL, 14, 'sale', -4.00, NULL, 76.00, 'Sale - Order #ORD-000014', 'ORD-000014', NULL, '2025-12-10 11:09:07', '2025-12-10 11:09:07'),
(16, 8, NULL, 15, 'sale', -4.00, NULL, 50.00, 'Sale - Order #ORD-000015', 'ORD-000015', NULL, '2025-12-11 06:13:57', '2025-12-11 06:13:57'),
(17, 5, NULL, 16, 'sale', -1.00, NULL, 141.00, 'Sale - Order #ORD-000016', 'ORD-000016', NULL, '2025-12-11 11:55:39', '2025-12-11 11:55:39'),
(18, 7, NULL, 17, 'sale', -12.00, NULL, 125.50, 'Sale - Order #ORD-000017', 'ORD-000017', NULL, '2025-12-13 09:53:25', '2025-12-13 09:53:25'),
(19, 1, NULL, 18, 'sale', -4.00, NULL, 72.00, 'Sale - Order #ORD-000018', 'ORD-000018', NULL, '2025-12-13 11:19:10', '2025-12-13 11:19:10'),
(20, 5, NULL, 19, 'sale', -1.00, NULL, 140.00, 'Sale - Order #ORD-000019', 'ORD-000019', NULL, '2025-12-14 08:10:33', '2025-12-14 08:10:33'),
(21, 5, NULL, 19, 'return', 1.00, NULL, 141.00, 'Order Return - Order #ORD-000019', 'ORD-000019', NULL, '2025-12-14 08:39:59', '2025-12-14 08:39:59');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `measurements`
--

CREATE TABLE `measurements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `style` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`style`)),
  `notes` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `measurements`
--

INSERT INTO `measurements` (`id`, `customer_id`, `type`, `data`, `style`, `notes`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"44\\\",\\\"shoulder\\\":\\\"18\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"15\\\",\\\"chest\\\":\\\"37\\\",\\\"waist\\\":\\\"34\\\",\\\"width\\\":\\\"23\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39\\\",\\\"pancha\\\":\\\"8\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u06a9\\u0631\\u0645 \\u0648\\u0627\\u0644\\u0627\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar_jeeb\":\"\\u0634\\u0644\\u0648\\u0627\\u0631 \\u062c\\u06cc\\u0628 \\u0632\\u067e \\u0648\\u0627\\u0644\\u0627\",\"style_stitching_detail\":\"\\u0686\\u0645\\u06a9 \\u062a\\u0627\\u0631 \\u06a9\\u0646\\u06a9\\u0631 \\u0633\\u0644\\u0627\\u0626\\u06cc\",\"style_cloth_type\":\"\\u0645\\u06a9\\u0645\\u0644 \\u0633\\u0627\\u062f\\u06c1 \\u0633\\u0648\\u0679\"}', NULL, NULL, '2025-11-28 08:12:27', '2025-11-28 08:12:27'),
(2, 2, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"45\\\",\\\"shoulder\\\":\\\"19\\\\\\/D3\\\",\\\"sleeve\\\":\\\"23\\\\\\/10\\\",\\\"collar\\\":\\\"16\\\",\\\"chest\\\":\\\"40\\\\\\/12.25\\\",\\\"waist\\\":\\\"38\\\\\\/12.25\'\'\\\",\\\"width\\\":\\\"26\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"41.5\\\\\\/DL\\\\\\/LN\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u062f\\u0648 \\u067e\\u06cc\\u0644\\u0679\",\"style_patty_width\":\"1\",\"style_patty_length\":\"13.5\'\'\",\"style_collar_width\":\"2.5\'\'\",\"style_front_pocket_width\":\"5.25\'\'\",\"style_front_pocket_length\":\"5.75\'\'\"}', 'Kaf 2\'\'', NULL, '2025-11-30 10:38:20', '2025-11-30 10:38:20'),
(3, 2, 'waistcoat', '\"{\\\"waistcoat\\\":{\\\"chest\\\":\\\"39.5\\\",\\\"waist\\\":\\\"40\\\",\\\"shoulder\\\":\\\"16.5\\\",\\\"length\\\":\\\"28\\\",\\\"buttons\\\":\\\"1\\\",\\\"style\\\":\\\"Simple\\\"}}\"', 'null', 'Gala band', NULL, '2025-11-30 10:43:08', '2025-11-30 10:43:08'),
(4, 3, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42.5\\\",\\\"shoulder\\\":\\\"20.5\\\",\\\"sleeve\\\":\\\"24.5\\\",\\\"collar\\\":\\\"17\\\",\\\"width\\\":\\\"26fit\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39.5\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_shalwar_jeeb\":\"\\u0634\\u0644\\u0648\\u0627\\u0631 \\u062c\\u06cc\\u0628 \\u0632\\u067e \\u0648\\u0627\\u0644\\u0627\",\"style_button_detail\":\"\\u0633\\u0679\\u06cc\\u0644 \\u0648\\u0627\\u0644\\u0627 \\u0628\\u0679\\u0646\",\"style_cloth_type\":\"\\u0646\\u0627\\u0631\\u0645\\u0644 \\u0633\\u0648\\u0679\"}', NULL, NULL, '2025-12-02 06:40:42', '2025-12-02 06:40:42'),
(5, 4, 'kameez_shalwar', '\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"41.5\\\",\\n        \\\"shoulder\\\": \\\"18.5\\\",\\n        \\\"sleeve\\\": \\\"24\\\",\\n        \\\"collar\\\": \\\"15.5\\\",\\n        \\\"width\\\": \\\"22.5fit\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"40.5...21\\\",\\n        \\\"pancha\\\": \\\"8.5\\\"\\n    }\\n}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_chak_patti\":\"\\u0686\\u0627\\u06a9 \\u067e\\u0679\\u06cc \\u06a9\\u0627\\u062c\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_cloth_type\":\"\\u0646\\u0627\\u0631\\u0645\\u0644 \\u0633\\u0648\\u0679\",\"style_collar_width\":\"2.25\'\'\"}', NULL, NULL, '2025-12-02 06:47:39', '2025-12-06 09:18:13'),
(6, 5, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"39\\\",\\\"shoulder\\\":\\\"17.5\\\",\\\"sleeve\\\":\\\"21\\\",\\\"collar\\\":\\\"15.5\\\",\\\"width\\\":\\\"26\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"38.5\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u06af\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0639\\u0627\\u0645 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0627\\u06cc\\u06a9 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0688\\u0628\\u0644 \\u0633\\u0679\\u0688\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-02 06:52:23', '2025-12-02 06:52:23'),
(7, 6, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"17.5\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"15\\\",\\\"width\\\":\\\"25\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"35.5\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u06a9\\u0631\\u0645 \\u0648\\u0627\\u0644\\u0627\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_cloth_type\":\"\\u0645\\u06a9\\u0645\\u0644 \\u0633\\u0627\\u062f\\u06c1 \\u0633\\u0648\\u0679\"}', NULL, NULL, '2025-12-02 07:41:36', '2025-12-02 07:41:36'),
(8, 7, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"44\\\",\\\"shoulder\\\":\\\"19.5\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"14.5\\\",\\\"width\\\":\\\"23.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"42\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0639\\u0627\\u0645 \\u06a9\\u0627\\u0644\\u0631\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar_jeeb\":\"\\u0634\\u0644\\u0648\\u0627\\u0631 \\u062c\\u06cc\\u0628 \\u0632\\u067e \\u0648\\u0627\\u0644\\u0627\"}', NULL, NULL, '2025-12-02 08:14:32', '2025-12-02 08:14:32'),
(9, 9, 'waistcoat', '\"{\\\"waistcoat\\\":{\\\"chest\\\":\\\"41.5\\\",\\\"waist\\\":\\\"42\\\",\\\"shoulder\\\":\\\"16Down\\\",\\\"length\\\":\\\"27.5\\\",\\\"buttons\\\":\\\"1\\\",\\\"style\\\":\\\"Simple\\\"}}\"', '{\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641\"}', '17.5', NULL, '2025-12-02 08:21:37', '2025-12-02 08:21:37'),
(10, 9, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"41\\\",\\\"shoulder\\\":\\\"18.5\\\",\\\"sleeve\\\":\\\"22\\\",\\\"collar\\\":\\\"16\\\",\\\"width\\\":\\\"25N\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37.5\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0639\\u0627\\u0645 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_stitching_detail\":\"\\u0686\\u0645\\u06a9 \\u062a\\u0627\\u0631 \\u06a9\\u0646\\u06a9\\u0631 \\u0633\\u0644\\u0627\\u0626\\u06cc\",\"style_cloth_type\":\"\\u0646\\u0627\\u0631\\u0645\\u0644 \\u0633\\u0648\\u0679\"}', NULL, NULL, '2025-12-02 08:22:12', '2025-12-02 08:22:12'),
(11, 10, 'waistcoat', '\"{\\\"waistcoat\\\":{\\\"chest\\\":\\\"40.5\\\",\\\"waist\\\":\\\"41.5\\\",\\\"shoulder\\\":\\\"16\\\",\\\"length\\\":\\\"28\\\",\\\"buttons\\\":\\\"1\\\",\\\"style\\\":\\\"Simple\\\"}}\"', '{\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641\"}', '17 Gala Bnad', NULL, '2025-12-02 08:31:44', '2025-12-02 08:31:44'),
(12, 10, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"41\\\",\\\"shoulder\\\":\\\"19\\\",\\\"sleeve\\\":\\\"22\\\",\\\"collar\\\":\\\"16.5\\\",\\\"width\\\":\\\"26\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37.5\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0639\\u0627\\u0645 \\u06a9\\u0627\\u0644\\u0631\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-02 08:33:12', '2025-12-02 08:33:12'),
(13, 8, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"20\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"18\\\",\\\"width\\\":\\\"29\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37\\\",\\\"pancha\\\":\\\"9.5\\\"}}\"', '{\"style_patty\":\"\\u0633\\u0627\\u062f\\u06c1 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0639\\u0627\\u0645 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0627\\u06cc\\u06a9 \\u062c\\u06cc\\u0628\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-02 09:43:38', '2025-12-02 09:43:38'),
(14, 12, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"43\\\",\\\"shoulder\\\":\\\"19.5\\\",\\\"collar\\\":\\\"16.5\\\",\\\"width\\\":\\\"24\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39.5\\\",\\\"pancha\\\":\\\"8.5\\\"}}\"', '{\"style_patty\":\"\\u06af\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_cloth_type\":\"\\u0646\\u0627\\u0631\\u0645\\u0644 \\u0633\\u0648\\u0679\",\"style_patty_width\":\"Dubble Bukram\"}', 'Kaf Gol 9.5\'\'', NULL, '2025-12-02 11:07:05', '2025-12-02 11:07:05'),
(15, 13, 'kameez_shalwar', '\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"43\\\",\\n        \\\"shoulder\\\": \\\"21.5\\\",\\n        \\\"sleeve\\\": \\\"23\\\",\\n        \\\"collar\\\": \\\"17\\\",\\n        \\\"chest\\\": \\\"43\\\",\\n        \\\"waist\\\": \\\"40\\\",\\n        \\\"width\\\": \\\"26fit\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"39\\\",\\n        \\\"pancha\\\": \\\"8.5\\\"\\n    }\\n}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0627\\u06cc\\u06a9 \\u067e\\u0644\\u06cc\\u0679\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"0.75\'\'\",\"style_collar_width\":\"0.75\"}', NULL, NULL, '2025-12-02 11:10:44', '2025-12-06 08:37:04'),
(16, 14, 'kameez_shalwar', '\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"36.5\\\",\\n        \\\"shoulder\\\": \\\"15.5\\\",\\n        \\\"sleeve\\\": \\\"20.5\\\",\\n        \\\"collar\\\": \\\"12.5\\\",\\n        \\\"chest\\\": \\\"28.5\\\",\\n        \\\"waist\\\": \\\"26\\\",\\n        \\\"width\\\": \\\"19.5\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"35\\\",\\n        \\\"pancha\\\": \\\"7.5\\\"\\n    }\\n}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"10\",\"style_patty_length\":\"12\",\"style_collar_width\":\"20\"}', 'Kaf 8\'\'', NULL, '2025-12-02 11:18:45', '2025-12-16 16:50:19'),
(17, 15, 'kameez_shalwar', '\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"42\\\",\\n        \\\"shoulder\\\": \\\"18.5\\\",\\n        \\\"sleeve\\\": \\\"23.5\\\",\\n        \\\"collar\\\": \\\"16\\\",\\n        \\\"width\\\": \\\"24.5\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"40\\\",\\n        \\\"pancha\\\": \\\"8\\\"\\n    }\\n}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0639\\u0627\\u0645 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u0644\\u06cc\\u0628\\u0644 \\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-02 12:09:04', '2025-12-03 05:42:38'),
(18, 16, 'kameez_shalwar', '\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"41\\\",\\n        \\\"shoulder\\\": \\\"19\\\\\\/ Down\\\",\\n        \\\"sleeve\\\": \\\"23\\\",\\n        \\\"collar\\\": \\\"15.5\\\",\\n        \\\"chest\\\": \\\"38\\\",\\n        \\\"waist\\\": \\\"36\\\",\\n        \\\"width\\\": \\\"24\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"39\\\",\\n        \\\"pancha\\\": \\\"8\\\"\\n    }\\n}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u0644\\u06cc\\u0628\\u0644 \\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_chak_patti\":\"\\u0686\\u0627\\u06a9 \\u067e\\u0679\\u06cc \\u06a9\\u0627\\u062c\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_stitching_detail\":\"\\u0686\\u0645\\u06a9 \\u062a\\u0627\\u0631 \\u06a9\\u0646\\u06a9\\u0631 \\u0633\\u0644\\u0627\\u0626\\u06cc\",\"style_patty_width\":\"1\",\"style_patty_length\":\"13\'\'\"}', NULL, NULL, '2025-12-02 12:13:11', '2025-12-03 12:44:36'),
(19, 17, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"43\\\",\\\"shoulder\\\":\\\"17.5\\\",\\\"sleeve\\\":\\\"24\\\",\\\"collar\\\":\\\"15.5\\\",\\\"width\\\":\\\"24\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"38\\\",\\\"pancha\\\":\\\"8\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-02 12:44:52', '2025-12-02 12:44:52'),
(20, 18, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"41\\\",\\\"shoulder\\\":\\\"19\\\",\\\"sleeve\\\":\\\"21.5\\\",\\\"collar\\\":\\\"16.5\\\",\\\"width\\\":\\\"25\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"35\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0639\\u0627\\u0645 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-02 12:48:35', '2025-12-02 12:48:35'),
(21, 19, 'kameez_shalwar', '\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"42\\\",\\n        \\\"shoulder\\\": \\\"20.5\\\\\\/D3\\\",\\n        \\\"sleeve\\\": \\\"23.5\\\\\\/10.5\\\",\\n        \\\"collar\\\": \\\"16.5\\\",\\n        \\\"chest\\\": \\\"42\\\\\\/13.5\\\",\\n        \\\"waist\\\": \\\"40.5\\\\\\/13\\\",\\n        \\\"width\\\": \\\"27\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"42.5LL\\\",\\n        \\\"pancha\\\": \\\"9\\\"\\n    }\\n}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628 5.25\\/5.75\",\"style_side_pocket\":\"\\u0627\\u06cc\\u06a9 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u062f\\u0648 \\u067e\\u06cc\\u0644\\u0679\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_patty_width\":\"13.5\",\"style_patty_length\":\"1\"}', NULL, NULL, '2025-12-02 13:02:12', '2025-12-08 10:28:08'),
(22, 21, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"39\\\",\\\"shoulder\\\":\\\"19.\\\\\\/D2.5\\\",\\\"sleeve\\\":\\\"22.5\\\\\\/9\\\",\\\"collar\\\":\\\"15\\\",\\\"chest\\\":\\\"36\\\\\\/10.5\\\",\\\"waist\\\":\\\"32\\\\\\/10.25\\\",\\\"width\\\":\\\"21.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"38.5L\\\",\\\"pancha\\\":\\\"10\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06a9\\u0631\\u0627\\u0633 \\u06a9\\u0679 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"1\'\'\",\"style_patty_length\":\"12\",\"style_collar_width\":\"2.5\"}', 'Chak Pate Lebal Wala\r\nKaf 9\'\'', NULL, '2025-12-03 06:03:51', '2025-12-03 06:03:51'),
(23, 22, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42.5\\\",\\\"shoulder\\\":\\\"18\\\\\\/ d 2.5\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"16.5\\\",\\\"width\\\":\\\"27\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"38\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0627\\u06cc\\u06a9 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u06a9\\u0631\\u0645 \\u0648\\u0627\\u0644\\u0627\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_cloth_type\":\"\\u0645\\u06a9\\u0645\\u0644 \\u0633\\u0627\\u062f\\u06c1 \\u0633\\u0648\\u0679\"}', NULL, NULL, '2025-12-03 09:02:12', '2025-12-03 09:02:12'),
(24, 23, 'kameez_shalwar', '\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"42.5\\\",\\n        \\\"shoulder\\\": \\\"20.5\\\",\\n        \\\"sleeve\\\": \\\"23\\\",\\n        \\\"collar\\\": \\\"18\\\",\\n        \\\"width\\\": \\\"28L\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"37\\\",\\n        \\\"pancha\\\": \\\"9.5\\\"\\n    }\\n}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-03 11:01:45', '2025-12-03 11:08:58'),
(25, 24, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"19\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"16\\\",\\\"width\\\":\\\"28\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"41\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0627\\u06cc\\u06a9 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_cloth_type\":\"\\u0646\\u0627\\u0631\\u0645\\u0644 \\u0633\\u0648\\u0679\"}', NULL, NULL, '2025-12-04 05:21:42', '2025-12-04 05:21:42'),
(26, 25, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"44\\\",\\\"shoulder\\\":\\\"22\\\",\\\"sleeve\\\":\\\"25\\\",\\\"collar\\\":\\\"16.5\\\",\\\"chest\\\":\\\"46\\\",\\\"waist\\\":\\\"40\\\",\\\"width\\\":\\\"25\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"42\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u06af\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_length\":\"13\"}', NULL, NULL, '2025-12-04 05:31:36', '2025-12-04 05:31:36'),
(27, 26, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"40\\\",\\\"shoulder\\\":\\\"18.5\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"15.5\\\",\\\"chest\\\":\\\"39\\\",\\\"waist\\\":\\\"36.5\\\",\\\"width\\\":\\\"24.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_cloth_type\":\"\\u0646\\u0627\\u0631\\u0645\\u0644 \\u0633\\u0648\\u0679\"}', NULL, NULL, '2025-12-04 05:53:07', '2025-12-04 05:53:07'),
(28, 27, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"19.25\\\",\\\"sleeve\\\":\\\"22.5\\\\\\/9.25\\\",\\\"collar\\\":\\\"16.5\\\",\\\"chest\\\":\\\"38.5\\\",\\\"waist\\\":\\\"36\\\",\\\"width\\\":\\\"22\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"40N\\\",\\\"pancha\\\":\\\"8\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0627\\u06cc\\u06a9 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"1\'\",\"style_patty_length\":\"12.5\",\"style_collar_width\":\"2.25\'\'\"}', 'Kaf 9.25\'\'', NULL, '2025-12-04 05:59:22', '2025-12-04 05:59:22'),
(29, 28, 'kameez_shalwar', '\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"43.5\\\",\\n        \\\"shoulder\\\": \\\"19\\\",\\n        \\\"sleeve\\\": \\\"23\\\",\\n        \\\"collar\\\": \\\"15.5\\\",\\n        \\\"chest\\\": \\\"39\\\\\\/11.5\\\",\\n        \\\"waist\\\": \\\"37\\\\\\/11.5\\\",\\n        \\\"width\\\": \\\"24\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"37.5\\\",\\n        \\\"pancha\\\": \\\"8\\\"\\n    }\\n}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u0644\\u06cc\\u0628\\u0644 \\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u062f\\u0648 \\u067e\\u06cc\\u0644\\u0679\",\"style_chak_patti\":\"\\u0686\\u0627\\u06a9 \\u067e\\u0679\\u06cc \\u06a9\\u0627\\u062c\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"0.75\'\'\"}', 'Pate+Jeb Right Side\r\nKaf 9.5', NULL, '2025-12-04 06:13:28', '2025-12-04 06:15:48'),
(30, 29, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"44\\\",\\\"shoulder\\\":\\\"19\\\",\\\"sleeve\\\":\\\"23.5\\\",\\\"width\\\":\\\"23\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"41\\\",\\\"pancha\\\":\\\"8\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0639\\u0627\\u0645 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', 'KAf 9.5\'\'', NULL, '2025-12-04 07:12:50', '2025-12-04 07:12:50'),
(31, 30, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"40.5\\\",\\\"shoulder\\\":\\\"19.5\\\\\\/D3\\\",\\\"sleeve\\\":\\\"22.5\\\\\\/9.5\\\",\\\"collar\\\":\\\"15.5\\\",\\\"chest\\\":\\\"37\\\",\\\"waist\\\":\\\"35\\\",\\\"width\\\":\\\"23.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"40\\\",\\\"pancha\\\":\\\"8\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u0644\\u06cc\\u0628\\u0644 \\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0627\\u06cc\\u06a9 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_length\":\"12\",\"style_collar_width\":\"2.25\'\'\"}', NULL, NULL, '2025-12-04 07:23:23', '2025-12-04 07:23:23'),
(32, 31, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"40.5\\\",\\\"shoulder\\\":\\\"20.5\\\\\\/D2.5\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"16.5\\\",\\\"width\\\":\\\"26fit\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37\\\",\\\"pancha\\\":\\\"8.5\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-04 07:25:59', '2025-12-04 07:25:59'),
(33, 32, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"21.5\\\",\\\"sleeve\\\":\\\"23.5\\\",\\\"collar\\\":\\\"17\\\",\\\"width\\\":\\\"29\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"41\\\",\\\"pancha\\\":\\\"10\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0627\\u06cc\\u06a9 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-04 07:29:38', '2025-12-04 07:29:38'),
(34, 34, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"43.5\\\",\\\"shoulder\\\":\\\"21.5\\\",\\\"sleeve\\\":\\\"24\\\",\\\"collar\\\":\\\"18.5\\\",\\\"width\\\":\\\"27\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39.5\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_patty_width\":\"1\"}', NULL, '2025-12-06 11:22:54', '2025-12-04 08:15:31', '2025-12-06 11:22:54'),
(35, 34, 'kameez_shalwar', '\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"43.5\\\",\\n        \\\"shoulder\\\": \\\"21.5\\\\\\/ D2.5\\\",\\n        \\\"sleeve\\\": \\\"24\\\",\\n        \\\"collar\\\": \\\"18.5\\\",\\n        \\\"width\\\": \\\"27\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"39.5\\\",\\n        \\\"pancha\\\": \\\"9\\\"\\n    }\\n}\"', '{\"style_patty\":\"\\u0686\\u0627\\u0631 \\u0628\\u0679\\u0646 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u0644\\u06cc\\u0628\\u0644 \\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0627\\u06cc\\u06a9 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u062f\\u0648 \\u067e\\u06cc\\u0644\\u0679\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"1\'\'\",\"style_patty_length\":\"15\'\'\",\"style_collar_width\":\"2.25\'\'\"}', 'Side Jeb Size Large\r\nColler Naram Single Piece', NULL, '2025-12-04 08:23:05', '2025-12-06 11:16:51'),
(36, 35, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"37\\\",\\\"shoulder\\\":\\\"18\\\",\\\"sleeve\\\":\\\"21.5\\\",\\\"collar\\\":\\\"14\\\",\\\"chest\\\":\\\"33\\\",\\\"width\\\":\\\"24\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"36\\\",\\\"pancha\\\":\\\"8.5\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0627\\u06cc\\u06a9 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_shalwar_jeeb\":\"\\u0634\\u0644\\u0648\\u0627\\u0631 \\u062c\\u06cc\\u0628 \\u0632\\u067e \\u0648\\u0627\\u0644\\u0627\"}', NULL, NULL, '2025-12-04 09:08:22', '2025-12-04 09:08:22'),
(37, 36, 'kameez_shalwar', '\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"43\\\",\\n        \\\"shoulder\\\": \\\"19.5\\\",\\n        \\\"sleeve\\\": \\\"24.5\\\",\\n        \\\"collar\\\": \\\"16\\\",\\n        \\\"width\\\": \\\"26\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"42.5\\\",\\n        \\\"pancha\\\": \\\"9\\\"\\n    }\\n}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0639\\u0627\\u0645 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0627\\u06cc\\u06a9 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', 'Pocket Inside Jeb', NULL, '2025-12-04 10:16:09', '2025-12-04 10:18:37'),
(38, 37, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"43\\\",\\\"shoulder\\\":\\\"21.5\\\",\\\"sleeve\\\":\\\"23.5\\\\\\/9.5\'\'\\\",\\\"collar\\\":\\\"17\\\",\\\"width\\\":\\\"27\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39.5\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-04 10:33:11', '2025-12-04 10:33:11'),
(39, 38, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"41\\\",\\\"shoulder\\\":\\\"19.5\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"17.5\\\",\\\"width\\\":\\\"25\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37.5\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0639\\u0627\\u0645 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0688\\u0628\\u0644 \\u0633\\u0679\\u0688\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0627\\u06cc\\u06a9 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_shalwar_jeeb\":\"\\u0634\\u0644\\u0648\\u0627\\u0631 \\u062c\\u06cc\\u0628 \\u0632\\u067e \\u0648\\u0627\\u0644\\u0627\"}', NULL, NULL, '2025-12-04 10:51:18', '2025-12-04 10:51:18'),
(40, 39, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"16\\\\\\/D2.5\\\",\\\"sleeve\\\":\\\"24\\\",\\\"collar\\\":\\\"15\\\",\\\"chest\\\":\\\"34\\\\\\/10\\\",\\\"waist\\\":\\\"32\\\\\\/9.5\\\",\\\"width\\\":\\\"22.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"41\\\",\\\"pancha\\\":\\\"7\\\"}}\"', '{\"style_patty\":\"\\u0686\\u0627\\u0631 \\u0628\\u0679\\u0646 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_chak_patti\":\"\\u0686\\u0627\\u06a9 \\u067e\\u0679\\u06cc \\u06a9\\u0627\\u062c\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_stitching_detail\":\"\\u0686\\u0645\\u06a9 \\u062a\\u0627\\u0631 \\u06a9\\u0646\\u06a9\\u0631 \\u0633\\u0644\\u0627\\u0626\\u06cc\",\"style_patty_width\":\"1\",\"style_patty_length\":\"13.5\",\"style_collar_width\":\"2\'\'\"}', NULL, NULL, '2025-12-04 11:01:14', '2025-12-04 11:01:14'),
(41, 40, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"20.5\\\\\\/ D3\\\",\\\"sleeve\\\":\\\"21.5\\\",\\\"collar\\\":\\\"16.25\\\",\\\"chest\\\":\\\"44\\\\\\/13\\\",\\\"waist\\\":\\\"42\\\\\\/13.5\\\",\\\"width\\\":\\\"27\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"36\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u06a9\\u0631\\u0645 \\u0648\\u0627\\u0644\\u0627\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"1\",\"style_patty_length\":\"13.5\"}', 'Jeb Kaj\r\nAsteen 6.5\'\'', NULL, '2025-12-04 11:58:49', '2025-12-04 11:58:49'),
(42, 41, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"40\\\",\\\"shoulder\\\":\\\"17.75\\\",\\\"sleeve\\\":\\\"21.5\\\",\\\"collar\\\":\\\"14.5\\\",\\\"chest\\\":\\\"35\\\\\\/10\\\",\\\"waist\\\":\\\"31\\\\\\/10\\\",\\\"width\\\":\\\"21.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37\\\",\\\"pancha\\\":\\\"7.5\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_chak_patti\":\"\\u0686\\u0627\\u06a9 \\u067e\\u0679\\u06cc \\u06a9\\u0627\\u062c\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_length\":\"12.5\"}', 'Kaf 9\'\'', NULL, '2025-12-04 12:31:26', '2025-12-04 12:31:26'),
(43, 42, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"19\\\\\\/D3\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"17\\\",\\\"chest\\\":\\\"41.5\\\\\\/13\\\",\\\"waist\\\":\\\"42\\\\\\/13\\\",\\\"width\\\":\\\"28\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"40\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u06a9\\u0631\\u0645 \\u0648\\u0627\\u0644\\u0627\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_shalwar_jeeb\":\"\\u0634\\u0644\\u0648\\u0627\\u0631 \\u062c\\u06cc\\u0628 \\u0632\\u067e \\u0648\\u0627\\u0644\\u0627\",\"style_cloth_type\":\"\\u0645\\u06a9\\u0645\\u0644 \\u0633\\u0627\\u062f\\u06c1 \\u0633\\u0648\\u0679\",\"style_patty_width\":\"1.25\'\'\",\"style_patty_length\":\"13.5\"}', NULL, NULL, '2025-12-04 12:52:32', '2025-12-04 12:52:32'),
(44, 43, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42.5\\\",\\\"shoulder\\\":\\\"19.5\\\\\\/D3\\\",\\\"sleeve\\\":\\\"24.5\\\\\\/9.5\\\",\\\"collar\\\":\\\"15.5\\\",\\\"chest\\\":\\\"39\\\",\\\"waist\\\":\\\"35\\\",\\\"width\\\":\\\"23\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"41SL\\\",\\\"pancha\\\":\\\"8.5\\\"}}\"', '{\"style_patty\":\"\\u0686\\u0627\\u0631 \\u0628\\u0679\\u0646 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_chak_patti\":\"\\u0686\\u0627\\u06a9 \\u067e\\u0679\\u06cc \\u06a9\\u0627\\u062c\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"1\",\"style_patty_length\":\"12.5\",\"style_collar_width\":\"2.\"}', 'Op Dubble Bukram\r\nKaf 9.25\'\'', NULL, '2025-12-04 12:59:02', '2025-12-04 12:59:02'),
(45, 44, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"41\\\",\\\"shoulder\\\":\\\"20\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"16\\\",\\\"width\\\":\\\"28\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39\\\",\\\"pancha\\\":\\\"9.5\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0639\\u0627\\u0645 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0627\\u06cc\\u06a9 \\u062c\\u06cc\\u0628\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-04 13:46:52', '2025-12-04 13:46:52'),
(46, 45, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"43.5\\\",\\\"shoulder\\\":\\\"19\\\\\\/2.75\'\'\\\",\\\"sleeve\\\":\\\"24.5\\\\\\/DL\\\",\\\"collar\\\":\\\"15\\\",\\\"chest\\\":\\\"38.5\\\\\\/11\\\",\\\"waist\\\":\\\"35\\\\\\/11\\\",\\\"width\\\":\\\"23\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"41Sl\\\",\\\"pancha\\\":\\\"7\\\"}}\"', '{\"style_patty\":\"\\u0686\\u0627\\u0631 \\u0628\\u0679\\u0646 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0688\\u0628\\u0644 \\u0633\\u0679\\u0688\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_chak_patti\":\"\\u0686\\u0627\\u06a9 \\u067e\\u0679\\u06cc \\u06a9\\u0627\\u062c\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_shalwar_jeeb\":\"\\u0634\\u0644\\u0648\\u0627\\u0631 \\u062c\\u06cc\\u0628 \\u0632\\u067e \\u0648\\u0627\\u0644\\u0627\",\"style_patty_width\":\"1\",\"style_patty_length\":\"13\",\"style_collar_width\":\"2.25\'\'\"}', NULL, NULL, '2025-12-04 13:51:09', '2025-12-04 13:51:09'),
(47, 47, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42.5\\\",\\\"shoulder\\\":\\\"18\\\",\\\"sleeve\\\":\\\"26.5\\\",\\\"collar\\\":\\\"15.5\\\",\\\"chest\\\":\\\"39\\\\\\/13\\\",\\\"waist\\\":\\\"40\\\\\\/13\\\",\\\"width\\\":\\\"26.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"40\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0686\\u0627\\u06a9 \\u0648\\u0627\\u0644\\u0627 \\u0645\\u062d\\u0631\\u0627\\u0628 \\u0622\\u0633\\u062a\\u06cc\\u0646\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_cloth_type\":\"\\u0645\\u06a9\\u0645\\u0644 \\u0633\\u0627\\u062f\\u06c1 \\u0633\\u0648\\u0679\",\"style_patty_width\":\"1\",\"style_patty_length\":\"14\"}', NULL, NULL, '2025-12-06 08:26:38', '2025-12-06 08:26:38'),
(48, 48, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"43.5\\\",\\\"shoulder\\\":\\\"19\\\\\\/2.5\\\",\\\"sleeve\\\":\\\"24\\\",\\\"collar\\\":\\\"16\\\",\\\"chest\\\":\\\"42\\\",\\\"waist\\\":\\\"45\\\",\\\"width\\\":\\\"29\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"40\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"1.25\'\'\"}', NULL, NULL, '2025-12-06 09:35:01', '2025-12-06 09:35:01'),
(49, 49, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"38.5\\\",\\\"shoulder\\\":\\\"16\\\",\\\"sleeve\\\":\\\"21.5\\\",\\\"collar\\\":\\\"14\\\",\\\"chest\\\":\\\"34\\\",\\\"waist\\\":\\\"30\\\",\\\"width\\\":\\\"20.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37\\\",\\\"pancha\\\":\\\"7.5\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"0.75\'\'\",\"style_collar_width\":\"2.25\'\'\"}', NULL, NULL, '2025-12-06 09:39:51', '2025-12-06 09:39:51');
INSERT INTO `measurements` (`id`, `customer_id`, `type`, `data`, `style`, `notes`, `deleted_at`, `created_at`, `updated_at`) VALUES
(50, 51, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"19\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"15\\\",\\\"width\\\":\\\"24.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"40\\\",\\\"pancha\\\":\\\"8.5\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-06 10:26:37', '2025-12-06 10:26:37'),
(51, 52, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"41.5\\\",\\\"shoulder\\\":\\\"18.5\\\\\\/D3\\\",\\\"sleeve\\\":\\\"23.\\\",\\\"collar\\\":\\\"15.5\\\",\\\"width\\\":\\\"24\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"40.5\\\",\\\"pancha\\\":\\\"8\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_chak_patti\":\"\\u0686\\u0627\\u06a9 \\u067e\\u0679\\u06cc \\u06a9\\u0627\\u062c\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"0.75;;\",\"style_patty_length\":\"12.5\",\"style_collar_width\":\"0.75\"}', NULL, NULL, '2025-12-06 10:33:45', '2025-12-06 10:33:45'),
(52, 50, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"41\\\",\\\"shoulder\\\":\\\"20\\\\\\/D3\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"17\\\",\\\"width\\\":\\\"25.\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37.5L\\\",\\\"pancha\\\":\\\"8.5\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_chak_patti\":\"\\u0686\\u0627\\u06a9 \\u067e\\u0679\\u06cc \\u06a9\\u0627\\u062c\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_shalwar_jeeb\":\"\\u0634\\u0644\\u0648\\u0627\\u0631 \\u062c\\u06cc\\u0628 \\u0632\\u067e \\u0648\\u0627\\u0644\\u0627\",\"style_patty_width\":\"0.75\'\'\",\"style_patty_length\":\"11\",\"style_collar_width\":\"0.75\"}', NULL, NULL, '2025-12-06 10:38:30', '2025-12-06 10:38:30'),
(53, 53, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"18.5\\\\\\/D2.5\\\",\\\"sleeve\\\":\\\"22.25\\\",\\\"collar\\\":\\\"16.5\\\",\\\"chest\\\":\\\"41\\\\\\/11.5\\\",\\\"waist\\\":\\\"39\\\\\\/12\\\",\\\"width\\\":\\\"25\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37.5\\\",\\\"pancha\\\":\\\"8\\\"}}\"', '{\"style_patty\":\"\\u0686\\u0627\\u0631 \\u0628\\u0679\\u0646 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u062f\\u0648 \\u067e\\u06cc\\u0644\\u0679\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"1\",\"style_patty_length\":\"13.5\",\"style_collar_width\":\"2.5\",\"style_front_pocket_width\":\"5\",\"style_front_pocket_length\":\"5.5\"}', NULL, NULL, '2025-12-06 12:58:01', '2025-12-06 12:58:01'),
(54, 54, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42.5\\\",\\\"shoulder\\\":\\\"19.5\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"16.5\\\",\\\"width\\\":\\\"26\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"40.5\\\",\\\"pancha\\\":\\\"9.5\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-07 10:49:52', '2025-12-07 10:49:52'),
(55, 55, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"44.5\\\",\\\"shoulder\\\":\\\"19\\\\\\/2.75\'\'\\\",\\\"sleeve\\\":\\\"25\\\",\\\"collar\\\":\\\"16\\\",\\\"width\\\":\\\"24.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"41\\\",\\\"pancha\\\":\\\"9F\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-07 11:04:21', '2025-12-07 11:04:21'),
(56, 56, 'kameez_shalwar', '\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"40.5\\\",\\n        \\\"shoulder\\\": \\\"20.5\\\",\\n        \\\"sleeve\\\": \\\"23\\\",\\n        \\\"collar\\\": \\\"16\\\",\\n        \\\"chest\\\": \\\"40\\\",\\n        \\\"waist\\\": \\\"37\\\",\\n        \\\"width\\\": \\\"24.5\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"37.5\\\",\\n        \\\"pancha\\\": \\\"8\\\"\\n    }\\n}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"0.75\'\'\",\"style_patty_length\":\"13\",\"style_collar_width\":\"2\'\'\",\"style_front_pocket_width\":\"5\",\"style_front_pocket_length\":\"5.5\"}', 'Kaf Gol 9.25\r\n\'', NULL, '2025-12-07 11:08:22', '2025-12-07 11:25:47'),
(57, 57, 'kameez_shalwar', '\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"37.5\\\",\\n        \\\"shoulder\\\": \\\"17.5\\\\\\/2.5\\\",\\n        \\\"sleeve\\\": \\\"22\\\\\\/8\\\",\\n        \\\"collar\\\": \\\"14\\\",\\n        \\\"chest\\\": \\\"32\\\\\\/9.25\\\",\\n        \\\"waist\\\": \\\"29\\\\\\/9.5\\\",\\n        \\\"width\\\": \\\"20\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"39\\\",\\n        \\\"pancha\\\": \\\"7.5\\\"\\n    }\\n}\"', '{\"style_patty\":\"\\u0686\\u0627\\u0631 \\u0628\\u0679\\u0646 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_chak_patti\":\"\\u0686\\u0627\\u06a9 \\u067e\\u0679\\u06cc \\u06a9\\u0627\\u062c\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"1\",\"style_patty_length\":\"11.25\",\"style_collar_width\":\"2\"}', 'کف 8.25\r\nسائڈ جیب چھوڑائی 6 انچ', NULL, '2025-12-08 06:37:42', '2025-12-08 06:41:51'),
(58, 58, 'kameez_shalwar', '\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"43.5\\\",\\n        \\\"shoulder\\\": \\\"20.5\\\",\\n        \\\"sleeve\\\": \\\"23\\\",\\n        \\\"collar\\\": \\\"17.5\\\",\\n        \\\"width\\\": \\\"26\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"39\\\",\\n        \\\"pancha\\\": \\\"7.5\\\"\\n    }\\n}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_chak_patti\":\"\\u0686\\u0627\\u06a9 \\u067e\\u0679\\u06cc \\u06a9\\u0627\\u062c\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_collar_width\":\"2.25\'\'\"}', 'Touch Button Ring Wala\r\nKaf sada 9.5', NULL, '2025-12-08 10:26:55', '2025-12-08 10:48:25'),
(59, 59, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"40\\\",\\\"shoulder\\\":\\\"15.5\\\",\\\"sleeve\\\":\\\"22\\\\\\/8\\\",\\\"collar\\\":\\\"12.5\\\",\\\"chest\\\":\\\"30\\\\\\/9.5\\\",\\\"waist\\\":\\\"26\\\\\\/9.25\'\'\\\",\\\"width\\\":\\\"20.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39N\\\",\\\"pancha\\\":\\\"7\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"12\",\"style_patty_length\":\"1\",\"style_collar_width\":\"2\'\'\"}', NULL, NULL, '2025-12-10 10:34:42', '2025-12-10 10:34:42'),
(60, 60, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"46\\\",\\\"shoulder\\\":\\\"21\\\\\\/D2.5\\\",\\\"sleeve\\\":\\\"23.5\\\",\\\"collar\\\":\\\"17\\\",\\\"width\\\":\\\"28\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"42\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0639\\u0627\\u0645 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-10 10:37:53', '2025-12-10 10:37:53'),
(61, 61, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"19.5\\\\\\/D2.5\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"17.5\\\",\\\"width\\\":\\\"29\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39LL\\\",\\\"pancha\\\":\\\"10\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-10 10:41:45', '2025-12-10 10:41:45'),
(62, 62, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"45\\\",\\\"shoulder\\\":\\\"19\\\",\\\"sleeve\\\":\\\"25\\\",\\\"collar\\\":\\\"16\\\",\\\"width\\\":\\\"28.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"42\\\",\\\"pancha\\\":\\\"9.5\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', 'Kaf 10.25\'\'', NULL, '2025-12-10 11:07:20', '2025-12-10 11:07:20'),
(63, 63, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"39.5\\\",\\\"shoulder\\\":\\\"17\\\",\\\"sleeve\\\":\\\"22.5\\\\\\/f\\\",\\\"collar\\\":\\\"14.5\\\",\\\"chest\\\":\\\"37.5\\\",\\\"waist\\\":\\\"35\\\",\\\"width\\\":\\\"22.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39\\\",\\\"pancha\\\":\\\"8\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_chak_patti\":\"\\u0686\\u0627\\u06a9 \\u067e\\u0679\\u06cc \\u06a9\\u0627\\u062c\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"1\",\"style_patty_length\":\"12\"}', NULL, NULL, '2025-12-10 12:30:17', '2025-12-10 12:30:17'),
(64, 64, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42.5\\\",\\\"shoulder\\\":\\\"17\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"13.5\\\",\\\"width\\\":\\\"21\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"42\\\",\\\"pancha\\\":\\\"8\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_chak_patti\":\"\\u0686\\u0627\\u06a9 \\u067e\\u0679\\u06cc \\u06a9\\u0627\\u062c\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"1\",\"style_patty_length\":\"12\",\"style_collar_width\":\"2.25\'\'\"}', 'Kaf 8.5', NULL, '2025-12-11 05:38:37', '2025-12-11 05:38:37'),
(65, 65, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"18.5\\\",\\\"sleeve\\\":\\\"22\\\",\\\"collar\\\":\\\"16\\\",\\\"width\\\":\\\"27.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"38\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0627\\u06cc\\u06a9 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-11 05:41:14', '2025-12-11 05:41:14'),
(66, 66, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"37.5\\\",\\\"shoulder\\\":\\\"17.5\\\\\\/D2.5\\\",\\\"sleeve\\\":\\\"21.5\\\\\\/8.5\\\",\\\"collar\\\":\\\"13\\\",\\\"chest\\\":\\\"33\\\\\\/10\\\",\\\"waist\\\":\\\"29\\\\\\/9.5\\\",\\\"width\\\":\\\"21\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37N\\\",\\\"pancha\\\":\\\"6\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"1\",\"style_patty_length\":\"11.5\"}', NULL, NULL, '2025-12-11 05:47:43', '2025-12-11 05:47:43'),
(67, 67, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"17.5\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"14\\\",\\\"chest\\\":\\\"22f\\\",\\\"width\\\":\\\"22f\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"42\\\",\\\"pancha\\\":\\\"8\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-11 06:12:59', '2025-12-11 06:12:59'),
(68, 68, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"40\\\",\\\"shoulder\\\":\\\"18\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"15\\\",\\\"width\\\":\\\"23\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39.5\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-11 06:17:07', '2025-12-11 06:17:07'),
(69, 69, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"414.5\\\",\\\"shoulder\\\":\\\"19\\\",\\\"sleeve\\\":\\\"23.5\\\",\\\"collar\\\":\\\"15.5\\\",\\\"width\\\":\\\"26f\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0639\\u0627\\u0645 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0627\\u06cc\\u06a9 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-11 07:12:10', '2025-12-11 07:12:10'),
(70, 70, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"40.5\\\",\\\"shoulder\\\":\\\"17\\\",\\\"sleeve\\\":\\\"21.5\\\",\\\"collar\\\":\\\"15\\\",\\\"width\\\":\\\"25.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"38\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0627\\u06cc\\u06a9 \\u062c\\u06cc\\u0628\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-11 07:19:31', '2025-12-11 07:19:31'),
(71, 71, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"44\\\",\\\"shoulder\\\":\\\"19\\\",\\\"sleeve\\\":\\\"25\\\",\\\"collar\\\":\\\"15.5\\\",\\\"width\\\":\\\"27\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"42\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u062f\\u0648 \\u067e\\u06cc\\u0644\\u0679\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-11 07:22:29', '2025-12-11 07:22:29'),
(72, 72, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"41\\\",\\\"shoulder\\\":\\\"16\\\\\\/D2.5\\\",\\\"sleeve\\\":\\\"23.5\\\\\\/8.5\\\",\\\"collar\\\":\\\"13\\\",\\\"chest\\\":\\\"32\\\\\\/10\\\",\\\"waist\\\":\\\"30.5\\\\\\/10\\\",\\\"width\\\":\\\"21\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"41N\\\",\\\"pancha\\\":\\\"7\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_chak_patti\":\"\\u0686\\u0627\\u06a9 \\u067e\\u0679\\u06cc \\u06a9\\u0627\\u062c\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"1\",\"style_patty_length\":\"12.5\",\"style_front_pocket_width\":\"4.5\",\"style_front_pocket_length\":\"5\"}', NULL, NULL, '2025-12-11 07:30:12', '2025-12-11 07:30:12'),
(73, 73, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"18\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"14.5\\\",\\\"width\\\":\\\"24\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"40\\\",\\\"pancha\\\":\\\"8.5\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-11 07:34:04', '2025-12-11 07:34:04'),
(74, 74, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"41\\\",\\\"shoulder\\\":\\\"19.5\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"16\\\",\\\"width\\\":\\\"23\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39\\\",\\\"pancha\\\":\\\"8\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0639\\u0627\\u0645 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_chak_patti\":\"\\u0686\\u0627\\u06a9 \\u067e\\u0679\\u06cc \\u06a9\\u0627\\u062c\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-11 07:37:58', '2025-12-11 07:37:58'),
(75, 75, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"45\\\",\\\"shoulder\\\":\\\"21.5\\\\\\/D3\\\",\\\"sleeve\\\":\\\"24.54\\\\\\/11\\\",\\\"collar\\\":\\\"18\\\",\\\"chest\\\":\\\"48\\\\\\/14\\\",\\\"waist\\\":\\\"44\\\\\\/14\\\",\\\"width\\\":\\\"29\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"41LL\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0686\\u0627\\u0631 \\u0628\\u0679\\u0646 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u062f\\u0648 \\u067e\\u06cc\\u0644\\u0679\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"1.1\'\'\",\"style_patty_length\":\"14.5\",\"style_collar_width\":\"2.5\",\"style_front_pocket_width\":\"5.25\",\"style_front_pocket_length\":\"5.75\"}', 'Kaf Gol 10\'\'', NULL, '2025-12-11 08:45:26', '2025-12-11 08:45:26'),
(76, 76, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"41.5\\\",\\\"shoulder\\\":\\\"20\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"17\\\",\\\"width\\\":\\\"28\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"38\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-11 08:54:20', '2025-12-11 08:54:20'),
(77, 77, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"18.5\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"16\\\",\\\"width\\\":\\\"27N\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"41N\\\",\\\"pancha\\\":\\\"9.5\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u06a9\\u0631\\u0645 \\u0648\\u0627\\u0644\\u0627\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_cloth_type\":\"\\u0645\\u06a9\\u0645\\u0644 \\u0633\\u0627\\u062f\\u06c1 \\u0633\\u0648\\u0679\",\"style_front_pocket_width\":\"5.25\",\"style_front_pocket_length\":\"5.75\"}', NULL, NULL, '2025-12-11 09:08:47', '2025-12-11 09:08:47'),
(78, 78, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42.5\\\",\\\"shoulder\\\":\\\"20\\\",\\\"sleeve\\\":\\\"23\\\\\\/10\\\",\\\"collar\\\":\\\"17.5\\\",\\\"chest\\\":\\\"43\\\\\\/12.5\\\",\\\"waist\\\":\\\"41.5\\\\\\/12.5\\\",\\\"width\\\":\\\"25.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"41N\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0686\\u0627\\u0631 \\u0628\\u0679\\u0646 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"1\",\"style_patty_length\":\"14\"}', 'Kaf 9.75\'\'', NULL, '2025-12-11 11:54:14', '2025-12-11 11:54:14'),
(79, 79, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"40\\\",\\\"shoulder\\\":\\\"18\\\",\\\"sleeve\\\":\\\"22\\\",\\\"collar\\\":\\\"15.5\\\",\\\"width\\\":\\\"28\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39\\\",\\\"pancha\\\":\\\"10\\\"}}\"', '{\"style_patty\":\"\\u0633\\u0627\\u062f\\u06c1 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0639\\u0627\\u0645 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0627\\u06cc\\u06a9 \\u062c\\u06cc\\u0628\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_shalwar_jeeb\":\"\\u0634\\u0644\\u0648\\u0627\\u0631 \\u062c\\u06cc\\u0628 \\u0632\\u067e \\u0648\\u0627\\u0644\\u0627\"}', NULL, NULL, '2025-12-13 09:33:21', '2025-12-13 09:33:21'),
(80, 80, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"39.5\\\",\\\"shoulder\\\":\\\"17.5\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"16\\\",\\\"width\\\":\\\"23.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37\\\",\\\"pancha\\\":\\\"8.5\\\"}}\"', '{\"style_patty\":\"\\u0686\\u0627\\u0631 \\u0628\\u0679\\u0646 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0639\\u0627\\u0645 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-13 09:37:04', '2025-12-13 09:37:04'),
(81, 81, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"20\\\",\\\"sleeve\\\":\\\"24.5\\\",\\\"collar\\\":\\\"16\\\",\\\"width\\\":\\\"25\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39\\\\\\/24\\\\\\/22\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_chak_patti\":\"\\u0686\\u0627\\u06a9 \\u067e\\u0679\\u06cc \\u06a9\\u0627\\u062c\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_shalwar_jeeb\":\"\\u0634\\u0644\\u0648\\u0627\\u0631 \\u062c\\u06cc\\u0628 \\u0632\\u067e \\u0648\\u0627\\u0644\\u0627\"}', NULL, NULL, '2025-12-13 12:23:53', '2025-12-13 12:23:53'),
(82, 82, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"42.5\\\",\\\"shoulder\\\":\\\"18\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"17\\\",\\\"width\\\":\\\"25..24\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"38.5\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0639\\u0627\\u0645 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0627\\u06cc\\u06a9 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-14 07:53:32', '2025-12-14 07:53:32'),
(83, 83, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"38.5\\\",\\\"shoulder\\\":\\\"19\\\",\\\"sleeve\\\":\\\"22\\\",\\\"collar\\\":\\\"15\\\",\\\"width\\\":\\\"23f\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"36.5\\\",\\\"pancha\\\":\\\"8.5\\\"}}\"', '{\"style_patty\":\"\\u0686\\u0627\\u0631 \\u0628\\u0679\\u0646 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0639\\u0627\\u0645 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"1\'\'\"}', 'kaf9', NULL, '2025-12-14 08:32:19', '2025-12-14 08:32:19'),
(84, 84, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"43\\\",\\\"shoulder\\\":\\\"19.5\\\",\\\"sleeve\\\":\\\"23.5\\\",\\\"collar\\\":\\\"18\\\",\\\"width\\\":\\\"27.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"38\\\",\\\"pancha\\\":\\\"9\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', 'KAf Gol 10.25\'\'', NULL, '2025-12-14 10:11:44', '2025-12-14 10:11:44'),
(85, 85, 'kameez_shalwar', '\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"41\\\",\\n        \\\"shoulder\\\": \\\"19.5\\\",\\n        \\\"sleeve\\\": \\\"22.5\\\",\\n        \\\"collar\\\": \\\"16.5\\\",\\n        \\\"width\\\": \\\"28f\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"37\\\",\\n        \\\"pancha\\\": \\\"9\\\"\\n    }\\n}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0639\\u0627\\u0645 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0627\\u06cc\\u06a9 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_shalwar\":\"\\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-14 10:53:15', '2025-12-14 10:58:59'),
(86, 86, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"40.5\\\",\\\"shoulder\\\":\\\"19\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"15.5\\\",\\\"width\\\":\\\"21.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37\\\",\\\"pancha\\\":\\\"8\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-14 11:06:57', '2025-12-14 11:06:57'),
(87, 87, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"41.5\\\",\\\"shoulder\\\":\\\"18\\\",\\\"sleeve\\\":\\\"23.5\\\",\\\"collar\\\":\\\"15\\\",\\\"width\\\":\\\"24\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"38\\\",\\\"pancha\\\":\\\"8.5\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-14 11:39:48', '2025-12-14 11:39:48'),
(88, 88, 'kameez_shalwar', '\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"42\\\",\\n        \\\"shoulder\\\": \\\"19\\\",\\n        \\\"sleeve\\\": \\\"22.5\\\",\\n        \\\"collar\\\": \\\"15\\\",\\n        \\\"chest\\\": \\\"36\\\",\\n        \\\"width\\\": \\\"25\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"38.5\\\",\\n        \\\"pancha\\\": \\\"9\\\"\\n    }\\n}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_patty_width\":\"1\'\'\",\"style_collar_width\":\"1\\\"\"}', NULL, NULL, '2025-12-14 11:44:02', '2025-12-14 11:46:57'),
(89, 89, 'kameez_shalwar', '\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"37\\\",\\n        \\\"shoulder\\\": \\\"17\\\",\\n        \\\"sleeve\\\": \\\"22.5Tayr\\\",\\n        \\\"collar\\\": \\\"15\\\",\\n        \\\"width\\\": \\\"24.5f\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"37\\\",\\n        \\\"pancha\\\": \\\"8.5\\\"\\n    }\\n}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641 \\u06af\\u0648\\u0644\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u062f\\u0648 \\u0628\\u0679\\u0646 \\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_chak_patti\":\"\\u0686\\u0627\\u06a9 \\u067e\\u0679\\u06cc \\u06a9\\u0627\\u062c\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_shalwar_jeeb\":\"\\u0634\\u0644\\u0648\\u0627\\u0631 \\u062c\\u06cc\\u0628 \\u0628\\u063a\\u06cc\\u0631 \\u0632\\u067e \\u0648\\u0627\\u0644\\u0627\"}', NULL, NULL, '2025-12-15 05:25:10', '2025-12-15 11:44:04'),
(90, 90, 'kameez_shalwar', '\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"41\\\",\\n        \\\"shoulder\\\": \\\"19\\\",\\n        \\\"sleeve\\\": \\\"22.5\\\",\\n        \\\"collar\\\": \\\"15.5\\\",\\n        \\\"width\\\": \\\"24N\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"38.5\\\",\\n        \\\"pancha\\\": \\\"7.5\\\"\\n    }\\n}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_chak_patti\":\"\\u0686\\u0627\\u06a9 \\u067e\\u0679\\u06cc \\u06a9\\u0627\\u062c\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_button_detail\":\"\\u0633\\u0679\\u06cc\\u0644 \\u0648\\u0627\\u0644\\u0627 \\u0628\\u0679\\u0646\",\"style_patty_width\":\"1\'\'\"}', 'cuf 9\"', NULL, '2025-12-15 05:31:43', '2025-12-15 11:42:52'),
(91, 91, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"41\\\",\\\"shoulder\\\":\\\"19.5\\\",\\\"sleeve\\\":\\\"24\\\",\\\"collar\\\":\\\"16\\\",\\\"width\\\":\\\"24.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39f\\\",\\\"pancha\\\":\\\"8.5\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u06af\\u0644\\u06c1 \\u0633\\u0627\\u062f\\u06c1 \\u06c1\\u0627\\u0641\",\"style_front_pocket\":\"\\u0628\\u063a\\u06cc\\u0631 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"}', NULL, NULL, '2025-12-15 11:47:56', '2025-12-15 11:47:56'),
(92, 92, 'kameez_shalwar', '\"{\\\"kameez\\\":{\\\"length\\\":\\\"41.5\\\",\\\"shoulder\\\":\\\"18.5\\\\\\/D2.5\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"13.5\\\",\\\"width\\\":\\\"21\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"40\\\",\\\"pancha\\\":\\\"7.5\\\"}}\"', '{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0646\\u0648\\u06a9\\u062f\\u0627\\u0631 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u0633\\u06cc\\u062f\\u06be\\u0627 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_chak_patti\":\"\\u0686\\u0627\\u06a9 \\u067e\\u0679\\u06cc \\u06a9\\u0627\\u062c\",\"style_daman\":\"\\u06af\\u06be\\u06cc\\u0631\\u0627 \\u0633\\u0627\\u062f\\u06c1\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\",\"style_collar_width\":\"2.25\'\'\"}', NULL, NULL, '2025-12-15 11:56:24', '2025-12-15 11:56:24'),
(93, 1, 'kameez_shalwar', '\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"12\\\",\\n        \\\"shoulder\\\": \\\"12\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"21\\\",\\n        \\\"pancha\\\": \\\"2\\\"\\n    }\\n}\"', '{\"style_patty\":\"\\u0686\\u0627\\u0631 \\u0628\\u0679\\u0646 \\u067e\\u0679\\u06cc\",\"style_patty_width\":\"10\",\"style_patty_length\":\"12\"}', NULL, NULL, '2025-12-16 04:11:55', '2025-12-16 06:55:08'),
(94, 14, 'kameez_shalwar', '\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"12\\\",\\n        \\\"shoulder\\\": \\\"12\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"21\\\",\\n        \\\"pancha\\\": \\\"2\\\"\\n    }\\n}\"', '{\"style_patty\":\"\\u067e\\u0627\\u0646\\u0686 \\u0628\\u0679\\u0646\",\"style_patty_width\":\"10\",\"style_patty_length\":\"12\"}', NULL, '2025-12-16 07:06:20', '2025-12-16 04:13:54', '2025-12-16 07:06:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(24, '2025_11_27_222603_create_worker_payments_table', 4),
(25, '2025_12_16_091650_create_worker_types_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 10),
(15, 'App\\Models\\User', 6),
(15, 'App\\Models\\User', 7),
(15, 'App\\Models\\User', 8),
(15, 'App\\Models\\User', 9),
(15, 'App\\Models\\User', 10),
(30, 'App\\Models\\User', 1),
(31, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 2),
(4, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 6),
(4, 'App\\Models\\User', 7),
(4, 'App\\Models\\User', 8),
(4, 'App\\Models\\User', 9),
(4, 'App\\Models\\User', 10),
(5, 'App\\Models\\User', 6),
(5, 'App\\Models\\User', 7),
(5, 'App\\Models\\User', 8),
(5, 'App\\Models\\User', 9),
(5, 'App\\Models\\User', 10),
(5, 'App\\Models\\User', 11);

-- --------------------------------------------------------

--
-- Table structure for table `naaps`
--

CREATE TABLE `naaps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` varchar(191) DEFAULT NULL,
  `type` varchar(191) NOT NULL,
  `fit` varchar(191) DEFAULT NULL,
  `length` decimal(8,2) DEFAULT NULL,
  `chest` decimal(8,2) DEFAULT NULL,
  `waist` decimal(8,2) DEFAULT NULL,
  `hip` decimal(8,2) DEFAULT NULL,
  `shoulder` decimal(8,2) DEFAULT NULL,
  `sleeve` decimal(8,2) DEFAULT NULL,
  `cuff` decimal(8,2) DEFAULT NULL,
  `bottom` decimal(8,2) DEFAULT NULL,
  `collar` varchar(191) DEFAULT NULL,
  `neck_depth` decimal(8,2) DEFAULT NULL,
  `buttons` int(10) UNSIGNED DEFAULT NULL,
  `pocket_style` varchar(191) DEFAULT NULL,
  `pocket_count` varchar(191) DEFAULT NULL,
  `daman` varchar(191) DEFAULT NULL,
  `patae` varchar(191) DEFAULT NULL,
  `ban` varchar(191) DEFAULT NULL,
  `stitching` varchar(191) DEFAULT NULL,
  `asteen` varchar(191) DEFAULT NULL,
  `btn_style` varchar(191) DEFAULT NULL,
  `chok` varchar(191) DEFAULT NULL,
  `style` varchar(191) DEFAULT NULL,
  `seat` decimal(8,2) DEFAULT NULL,
  `pocket_type` varchar(191) DEFAULT NULL,
  `shalwar_type` varchar(191) DEFAULT NULL,
  `shalwar_asin` decimal(8,2) DEFAULT NULL,
  `shalwar_width` decimal(8,2) DEFAULT NULL,
  `half_back` decimal(8,2) DEFAULT NULL,
  `fit_type` varchar(191) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `naap_histories`
--

CREATE TABLE `naap_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `naap_id` bigint(20) UNSIGNED NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`data`)),
  `version` int(10) UNSIGNED NOT NULL,
  `updated_by` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(191) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `order_date` date NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` enum('online','cash','bank_transfer','cheque') DEFAULT 'cash',
  `payment_status` enum('partial','full','no_payment') NOT NULL DEFAULT 'full',
  `partial_amount` decimal(10,2) DEFAULT NULL,
  `remaining_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `is_return` tinyint(1) NOT NULL DEFAULT 0,
  `return_date` date DEFAULT NULL,
  `return_reason` text DEFAULT NULL,
  `order_status` enum('pending','in_progress','completed','on_hold','cancelled','delivered') NOT NULL DEFAULT 'pending',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `customer_id`, `order_date`, `total_amount`, `payment_method`, `payment_status`, `partial_amount`, `remaining_amount`, `notes`, `is_return`, `return_date`, `return_reason`, `order_status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'ORD-000001', 9, '2025-12-02', 12000.00, NULL, 'no_payment', NULL, 12000.00, NULL, 0, NULL, NULL, 'pending', NULL, '2025-12-02 08:26:27', '2025-12-02 08:26:27'),
(2, 'ORD-000002', 20, '2025-12-03', 6500.00, 'cash', 'full', 6500.00, 0.00, NULL, 0, NULL, NULL, 'pending', NULL, '2025-12-03 04:56:43', '2025-12-03 04:56:43'),
(3, 'ORD-000003', 16, '2025-12-02', 9600.00, NULL, 'no_payment', NULL, 9600.00, NULL, 0, NULL, NULL, 'pending', NULL, '2025-12-03 12:53:13', '2025-12-03 12:53:13'),
(4, 'ORD-000004', 16, '2025-11-27', 12000.00, NULL, 'no_payment', NULL, 12000.00, NULL, 0, NULL, NULL, 'pending', NULL, '2025-12-03 12:53:46', '2025-12-03 12:53:46'),
(5, 'ORD-000005', 27, '2025-12-04', 22600.00, 'cash', 'partial', 10000.00, 12600.00, NULL, 0, NULL, NULL, 'pending', NULL, '2025-12-04 06:02:48', '2025-12-04 06:03:21'),
(6, 'ORD-000006', 33, '2025-12-04', 5000.00, 'cash', 'full', 5000.00, 0.00, NULL, 0, NULL, NULL, 'pending', NULL, '2025-12-04 07:51:07', '2025-12-04 07:51:07'),
(7, 'ORD-000007', 40, '2025-11-27', 8000.00, NULL, 'partial', 6600.00, 1400.00, NULL, 0, NULL, NULL, 'pending', NULL, '2025-12-04 12:01:25', '2025-12-10 12:52:15'),
(8, 'ORD-000008', 46, '2025-12-04', 2700.00, 'cash', 'full', 2700.00, 0.00, NULL, 0, NULL, NULL, 'pending', NULL, '2025-12-04 13:55:23', '2025-12-04 13:55:23'),
(9, 'ORD-000009', 52, '2025-12-06', 4800.00, NULL, 'no_payment', NULL, 4800.00, NULL, 0, NULL, NULL, 'pending', NULL, '2025-12-06 10:57:44', '2025-12-06 10:57:44'),
(10, 'ORD-000010', 54, '2025-12-07', 3800.00, NULL, 'no_payment', NULL, 3800.00, NULL, 0, NULL, NULL, 'pending', NULL, '2025-12-07 11:02:03', '2025-12-07 11:02:03'),
(11, 'ORD-000011', 56, '2025-12-07', 3800.00, NULL, 'no_payment', NULL, 3800.00, NULL, 0, NULL, NULL, 'pending', NULL, '2025-12-07 11:10:33', '2025-12-07 11:10:33'),
(12, 'ORD-000012', 59, '2025-12-10', 2500.00, NULL, 'no_payment', NULL, 2500.00, NULL, 0, NULL, NULL, 'pending', NULL, '2025-12-10 10:36:16', '2025-12-10 10:36:16'),
(13, 'ORD-000013', 60, '2025-12-10', 2700.00, NULL, 'full', 2700.00, 0.00, NULL, 0, NULL, NULL, 'pending', NULL, '2025-12-10 10:38:54', '2025-12-10 10:39:05'),
(14, 'ORD-000014', 62, '2025-12-10', 4000.00, NULL, 'no_payment', NULL, 4000.00, NULL, 0, NULL, NULL, 'pending', NULL, '2025-12-10 11:09:07', '2025-12-10 11:09:07'),
(15, 'ORD-000015', 67, '2025-12-10', 3600.00, NULL, 'partial', 3500.00, 100.00, NULL, 0, NULL, NULL, 'pending', NULL, '2025-12-11 06:13:57', '2025-12-11 11:50:00'),
(16, 'ORD-000016', 78, '2025-12-11', 4000.00, 'cash', 'full', 4000.00, 0.00, NULL, 0, NULL, NULL, 'pending', NULL, '2025-12-11 11:55:39', '2025-12-11 11:55:39'),
(17, 'ORD-000017', 79, '2025-12-13', 6960.00, NULL, 'full', 6960.00, 0.00, NULL, 0, NULL, NULL, 'pending', NULL, '2025-12-13 09:53:25', '2025-12-13 09:53:48'),
(18, 'ORD-000018', 40, '2025-12-13', 4000.00, NULL, 'partial', 3200.00, 800.00, NULL, 0, NULL, NULL, 'pending', NULL, '2025-12-13 11:19:10', '2025-12-14 07:46:19'),
(19, 'ORD-000019', 1, '2025-12-14', 2500.00, 'cash', 'partial', 0.00, 2500.00, NULL, 1, '2025-12-14', NULL, 'pending', NULL, '2025-12-14 08:10:33', '2025-12-14 08:39:59');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` text DEFAULT NULL,
  `is_from_inventory` tinyint(1) NOT NULL DEFAULT 1,
  `sell_price` decimal(10,2) NOT NULL,
  `quantity_meters` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `is_return` tinyint(1) NOT NULL DEFAULT 0,
  `return_date` date DEFAULT NULL,
  `return_reason` text DEFAULT NULL,
  `status` enum('pending','progress','completed') NOT NULL DEFAULT 'pending',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `is_from_inventory`, `sell_price`, `quantity_meters`, `total_price`, `is_return`, `return_date`, `return_reason`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 1, 1000.00, 12.00, 12000.00, 0, NULL, NULL, 'pending', NULL, '2025-12-02 08:26:27', '2025-12-02 08:26:27'),
(2, 2, 3, NULL, 1, 812.50, 8.00, 6500.00, 0, NULL, NULL, 'pending', NULL, '2025-12-03 04:56:43', '2025-12-03 04:56:43'),
(3, 3, 5, NULL, 1, 1200.00, 8.00, 9600.00, 0, NULL, NULL, 'pending', NULL, '2025-12-03 12:53:13', '2025-12-03 12:53:13'),
(4, 4, 3, NULL, 1, 1000.00, 12.00, 12000.00, 0, NULL, NULL, 'pending', NULL, '2025-12-03 12:53:46', '2025-12-03 12:53:46'),
(5, 5, 4, NULL, 1, 1100.00, 18.00, 19800.00, 0, NULL, NULL, 'pending', NULL, '2025-12-04 06:02:48', '2025-12-04 06:02:48'),
(6, 5, 7, NULL, 1, 700.00, 4.00, 2800.00, 0, NULL, NULL, 'pending', NULL, '2025-12-04 06:02:48', '2025-12-04 06:02:48'),
(7, 6, 8, NULL, 1, 625.00, 8.00, 5000.00, 0, NULL, NULL, 'pending', NULL, '2025-12-04 07:51:07', '2025-12-04 07:51:07'),
(8, 7, 8, NULL, 1, 1000.00, 8.00, 8000.00, 0, NULL, NULL, 'pending', NULL, '2025-12-04 12:01:25', '2025-12-04 12:01:25'),
(9, 8, 9, NULL, 1, 675.00, 4.00, 2700.00, 0, NULL, NULL, 'pending', NULL, '2025-12-04 13:55:23', '2025-12-04 13:55:23'),
(10, 9, 4, NULL, 1, 1200.00, 4.00, 4800.00, 0, NULL, NULL, 'pending', NULL, '2025-12-06 10:57:44', '2025-12-06 10:57:44'),
(11, 10, 1, NULL, 1, 950.00, 4.00, 3800.00, 0, NULL, NULL, 'pending', NULL, '2025-12-07 11:02:03', '2025-12-07 11:02:03'),
(12, 11, 1, NULL, 1, 950.00, 4.00, 3800.00, 0, NULL, NULL, 'pending', NULL, '2025-12-07 11:10:33', '2025-12-07 11:10:33'),
(13, 12, 7, NULL, 1, 625.00, 4.00, 2500.00, 0, NULL, NULL, 'pending', NULL, '2025-12-10 10:36:16', '2025-12-10 10:36:16'),
(14, 13, 7, NULL, 1, 600.00, 4.50, 2700.00, 0, NULL, NULL, 'pending', NULL, '2025-12-10 10:38:54', '2025-12-10 10:38:54'),
(15, 14, 1, NULL, 1, 1000.00, 4.00, 4000.00, 0, NULL, NULL, 'pending', NULL, '2025-12-10 11:09:07', '2025-12-10 11:09:07'),
(16, 15, 8, NULL, 1, 900.00, 4.00, 3600.00, 0, NULL, NULL, 'pending', NULL, '2025-12-11 06:13:57', '2025-12-11 06:13:57'),
(17, 16, 5, NULL, 1, 4000.00, 1.00, 4000.00, 0, NULL, NULL, 'pending', NULL, '2025-12-11 11:55:39', '2025-12-11 11:55:39'),
(18, 17, 7, NULL, 1, 580.00, 12.00, 6960.00, 0, NULL, NULL, 'pending', NULL, '2025-12-13 09:53:25', '2025-12-13 09:53:25'),
(19, 18, 1, NULL, 1, 1000.00, 4.00, 4000.00, 0, NULL, NULL, 'pending', NULL, '2025-12-13 11:19:10', '2025-12-13 11:19:10'),
(20, 19, 5, NULL, 1, 2500.00, 1.00, 2500.00, 1, '2025-12-14', NULL, 'pending', NULL, '2025-12-14 08:10:33', '2025-12-14 08:39:59');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payable_type` varchar(191) NOT NULL,
  `payable_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('cash','online','bank_transfer','cheque') NOT NULL DEFAULT 'cash',
  `person_reference` varchar(191) DEFAULT NULL,
  `payment_date` datetime NOT NULL,
  `notes` text DEFAULT NULL,
  `type` enum('payment','refund') NOT NULL DEFAULT 'payment',
  `refund_for_payment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `refund_reason` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payable_type`, `payable_id`, `amount`, `payment_method`, `person_reference`, `payment_date`, `notes`, `type`, `refund_for_payment_id`, `refund_reason`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 6, 500.00, 'cash', NULL, '2025-11-29 08:29:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-11-29 08:30:07', '2025-11-29 08:30:07'),
(2, 'App\\Models\\Order', 2, 6500.00, 'cash', NULL, '2025-12-03 04:55:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-03 04:56:43', '2025-12-03 04:56:43'),
(3, 'App\\Models\\SewingOrder', 25, 3500.00, 'cash', NULL, '2025-12-03 09:02:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-03 09:03:06', '2025-12-03 09:03:06'),
(4, 'App\\Models\\User', 7, 900.00, 'cash', NULL, '2025-12-03 12:45:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-03 12:45:19', '2025-12-03 12:45:19'),
(5, 'App\\Models\\User', 7, 100.00, 'cash', NULL, '2025-12-03 12:45:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-03 12:45:37', '2025-12-03 12:45:37'),
(6, 'App\\Models\\User', 7, 1000.00, 'cash', NULL, '2025-12-02 12:45:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-03 12:45:46', '2025-12-03 12:45:46'),
(7, 'App\\Models\\User', 7, 1500.00, 'cash', NULL, '2025-12-01 12:45:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-03 12:45:57', '2025-12-03 12:45:57'),
(8, 'App\\Models\\User', 7, 2500.00, 'cash', NULL, '2025-12-03 12:45:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-03 12:46:19', '2025-12-03 12:46:19'),
(9, 'App\\Models\\SewingOrder', 28, 3600.00, 'online', 'Easy Paisa 0312544', '2025-12-04 05:40:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-04 05:41:30', '2025-12-04 05:41:30'),
(10, 'App\\Models\\SewingOrder', 29, 1500.00, 'cash', 'Ayub Cloths', '2025-12-04 05:54:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-04 05:54:25', '2025-12-04 05:54:25'),
(11, 'App\\Models\\Order', 5, 5000.00, 'cash', NULL, '2025-12-04 05:59:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-04 06:02:48', '2025-12-04 06:02:48'),
(12, 'App\\Models\\Order', 5, 5000.00, 'cash', NULL, '2025-12-04 06:03:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-04 06:03:21', '2025-12-04 06:03:21'),
(13, 'App\\Models\\SewingOrder', 33, 6501.00, 'cash', NULL, '2025-12-04 07:13:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-04 07:14:11', '2025-12-04 07:14:11'),
(14, 'App\\Models\\Order', 6, 5000.00, 'cash', NULL, '2025-12-04 07:50:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-04 07:51:07', '2025-12-04 07:51:07'),
(15, 'App\\Models\\SewingOrder', 40, 2000.00, 'cash', NULL, '2025-12-04 10:18:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-04 10:19:15', '2025-12-04 10:19:15'),
(16, 'App\\Models\\SewingOrder', 48, 4000.00, 'cash', NULL, '2025-12-04 13:52:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-04 13:52:18', '2025-12-04 13:52:18'),
(17, 'App\\Models\\Order', 8, 2700.00, 'cash', NULL, '2025-12-04 13:54:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-04 13:55:23', '2025-12-04 13:55:23'),
(18, 'App\\Models\\SewingOrder', 50, 2000.00, 'cash', NULL, '2025-12-06 09:37:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-06 09:37:17', '2025-12-06 09:37:17'),
(19, 'App\\Models\\SewingOrder', 51, 4000.00, 'cash', NULL, '2025-12-06 09:40:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-06 09:40:51', '2025-12-06 09:40:51'),
(20, 'App\\Models\\SewingOrder', 14, 4000.00, 'online', 'Easy Paisa By 03118892233 To 312...922', '2025-12-07 09:22:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-07 09:23:06', '2025-12-07 09:23:06'),
(21, 'App\\Models\\SewingOrder', 45, 8000.00, 'online', 'Imdadul Self To 0312544', '2025-12-06 09:24:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-07 09:25:10', '2025-12-07 09:25:10'),
(22, 'App\\Models\\SewingOrder', 15, 10000.00, 'cash', NULL, '2025-12-07 10:43:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-07 10:44:13', '2025-12-07 10:44:13'),
(23, 'App\\Models\\SewingOrder', 59, 2000.00, 'online', 'Easy Paisa /03124849506', '2025-12-08 12:02:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-08 12:03:09', '2025-12-08 12:03:09'),
(24, 'App\\Models\\SewingOrder', 5, 1800.00, 'cash', NULL, '2025-12-09 05:32:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-10 05:32:46', '2025-12-10 05:32:46'),
(25, 'App\\Models\\SewingOrder', 53, 2000.00, 'cash', NULL, '2025-12-10 09:45:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-10 09:45:09', '2025-12-10 09:45:09'),
(26, 'App\\Models\\SewingOrder', 63, 2000.00, 'cash', NULL, '2025-12-10 10:37:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-10 10:38:24', '2025-12-10 10:38:24'),
(27, 'App\\Models\\Order', 13, 2700.00, 'cash', NULL, '2025-12-10 10:39:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-10 10:39:05', '2025-12-10 10:39:05'),
(28, 'App\\Models\\SewingOrder', 36, 4000.00, 'cash', NULL, '2025-12-10 10:53:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-10 10:53:51', '2025-12-10 10:53:51'),
(29, 'App\\Models\\SewingOrder', 42, 6000.00, 'cash', NULL, '2025-12-10 11:40:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-10 11:40:17', '2025-12-10 11:40:17'),
(30, 'App\\Models\\SewingOrder', 66, 2000.00, 'cash', NULL, '2025-12-10 12:31:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-10 12:31:43', '2025-12-10 12:31:43'),
(31, 'App\\Models\\SewingOrder', 26, 3600.00, 'cash', NULL, '2025-12-10 12:34:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-10 12:34:36', '2025-12-10 12:34:36'),
(32, 'App\\Models\\SewingOrder', 67, 4000.00, 'cash', NULL, '2025-12-10 12:37:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-10 12:38:07', '2025-12-10 12:38:07'),
(33, 'App\\Models\\SewingOrder', 43, 5400.00, 'cash', NULL, '2025-12-10 12:49:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-10 12:49:51', '2025-12-10 12:49:51'),
(34, 'App\\Models\\Order', 7, 6600.00, 'cash', NULL, '2025-12-10 12:50:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-10 12:52:15', '2025-12-10 12:52:15'),
(35, 'App\\Models\\SewingOrder', 20, 4000.00, 'cash', NULL, '2025-12-08 05:31:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-11 05:31:24', '2025-12-11 05:31:24'),
(36, 'App\\Models\\SewingOrder', 7, 3000.00, 'cash', NULL, '2025-12-10 05:32:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-11 05:32:34', '2025-12-11 05:32:34'),
(37, 'App\\Models\\SewingOrder', 68, 1500.00, 'cash', NULL, '2025-12-11 05:38:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-11 05:39:11', '2025-12-11 05:39:11'),
(38, 'App\\Models\\SewingOrder', 69, 1500.00, 'cash', NULL, '2025-12-11 05:41:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-11 05:42:04', '2025-12-11 05:42:04'),
(39, 'App\\Models\\SewingOrder', 16, 4000.00, 'cash', NULL, '2025-12-11 06:14:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-11 06:15:05', '2025-12-11 06:15:05'),
(40, 'App\\Models\\SewingOrder', 72, 5799.00, 'cash', NULL, '2025-12-11 06:18:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-11 06:18:50', '2025-12-11 06:18:50'),
(41, 'App\\Models\\SewingOrder', 75, 2000.00, 'cash', NULL, '2025-12-11 07:19:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-11 07:20:03', '2025-12-11 07:20:03'),
(42, 'App\\Models\\SewingOrder', 78, 2000.00, 'cash', NULL, '2025-12-11 08:45:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-11 08:46:28', '2025-12-11 08:46:28'),
(43, 'App\\Models\\Order', 15, 3500.00, 'cash', NULL, '2025-12-11 11:49:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-11 11:50:00', '2025-12-11 11:50:00'),
(44, 'App\\Models\\SewingOrder', 71, 1500.00, 'cash', NULL, '2025-12-11 11:50:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-11 11:50:36', '2025-12-11 11:50:36'),
(45, 'App\\Models\\SewingOrder', 81, 2000.00, 'cash', NULL, '2025-12-11 11:54:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-11 11:54:52', '2025-12-11 11:54:52'),
(46, 'App\\Models\\Order', 16, 4000.00, 'cash', NULL, '2025-12-11 11:55:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-11 11:55:39', '2025-12-11 11:55:39'),
(47, 'App\\Models\\SewingOrder', 82, 3500.00, 'cash', NULL, '2025-12-13 09:34:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-13 09:34:18', '2025-12-13 09:34:18'),
(48, 'App\\Models\\SewingOrder', 83, 4000.00, 'cash', NULL, '2025-12-13 09:37:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-13 09:37:45', '2025-12-13 09:37:45'),
(49, 'App\\Models\\SewingOrder', 38, 6000.00, 'cash', NULL, '2025-12-13 09:46:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-13 09:46:42', '2025-12-13 09:46:42'),
(50, 'App\\Models\\Order', 17, 6960.00, 'cash', NULL, '2025-12-13 09:53:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-13 09:53:48', '2025-12-13 09:53:48'),
(51, 'App\\Models\\SewingOrder', 39, 2000.00, 'cash', NULL, '2025-12-13 11:36:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-13 11:36:54', '2025-12-13 11:36:54'),
(52, 'App\\Models\\Order', 18, 3200.00, 'cash', NULL, '2025-12-14 07:46:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-14 07:46:19', '2025-12-14 07:46:19'),
(53, 'App\\Models\\Order', 19, 2500.00, 'cash', NULL, '2025-12-14 08:09:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-14 08:10:33', '2025-12-14 08:10:33'),
(54, 'App\\Models\\Order', 19, 2500.00, 'cash', NULL, '2025-12-14 08:38:00', NULL, 'refund', 53, NULL, 1, NULL, '2025-12-14 08:39:02', '2025-12-14 08:39:02'),
(55, 'App\\Models\\SewingOrder', 49, 1500.00, 'cash', NULL, '2025-12-14 09:00:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-14 09:03:16', '2025-12-14 09:03:16'),
(56, 'App\\Models\\SewingOrder', 89, 1800.00, 'cash', NULL, '2025-12-14 10:54:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-14 10:55:19', '2025-12-14 10:55:19'),
(57, 'App\\Models\\SewingOrder', 90, 2000.00, 'cash', NULL, '2025-12-14 11:07:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-14 11:07:38', '2025-12-14 11:07:38'),
(58, 'App\\Models\\SewingOrder', 55, 9000.00, 'cash', NULL, '2025-12-15 10:08:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-15 10:08:52', '2025-12-15 10:08:52'),
(59, 'App\\Models\\SewingOrder', 77, 1750.00, 'cash', NULL, '2025-12-15 10:09:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-15 10:09:42', '2025-12-15 10:09:42'),
(60, 'App\\Models\\SewingOrder', 93, 1750.00, 'cash', NULL, '2025-12-15 10:10:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-15 10:11:20', '2025-12-15 10:11:20'),
(61, 'App\\Models\\User', 1, 200.00, 'cash', NULL, '2025-12-16 11:41:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-16 19:41:29', '2025-12-16 19:41:29'),
(62, 'App\\Models\\User', 1, 6000.00, 'cash', NULL, '2025-12-16 11:43:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-16 19:44:55', '2025-12-16 19:44:55'),
(63, 'App\\Models\\User', 1, 200.00, 'cash', NULL, '2025-12-16 12:06:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-16 20:07:10', '2025-12-16 20:07:10'),
(64, 'App\\Models\\User', 1, 100.00, 'cash', NULL, '2025-12-16 12:07:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-16 20:07:33', '2025-12-16 20:07:33'),
(65, 'App\\Models\\User', 1, 200.00, 'cash', NULL, '2025-12-16 12:07:00', NULL, 'payment', NULL, NULL, 1, NULL, '2025-12-16 20:09:19', '2025-12-16 20:09:19');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(161) NOT NULL,
  `guard_name` varchar(25) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(32, 'manage-workers', 'web', '2025-11-29 08:51:13', '2025-11-29 08:51:13');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `purchase_price` decimal(10,2) NOT NULL,
  `sell_price` decimal(10,2) NOT NULL,
  `available_meters` decimal(10,2) NOT NULL DEFAULT 0.00,
  `barcode` varchar(191) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `brand_id`, `category_id`, `supplier_id`, `purchase_price`, `sell_price`, `available_meters`, `barcode`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'TR', 1, 1, NULL, 800.00, 1000.00, 72.00, '1234', NULL, '2025-12-02 08:25:38', '2025-12-13 11:19:10'),
(2, 'Admani JNG', 3, 2, NULL, 800.00, 1000.00, 100.00, NULL, NULL, '2025-12-02 08:38:11', '2025-12-02 08:38:11'),
(3, 'Time Tex Karachi', 4, 3, NULL, 800.00, 1000.00, 80.00, '12345', NULL, '2025-12-03 04:51:47', '2025-12-03 12:53:46'),
(4, 'KSG 98000', 5, 4, NULL, 850.00, 1200.00, 128.00, NULL, NULL, '2025-12-03 12:51:00', '2025-12-06 10:57:44'),
(5, 'KSG 100000', 5, 5, NULL, 850.00, 1200.00, 141.00, NULL, NULL, '2025-12-03 12:51:37', '2025-12-14 08:39:59'),
(6, 'KSG 100000', 5, 5, NULL, 850.00, 1200.00, 150.00, NULL, '2025-12-03 12:51:52', '2025-12-03 12:51:38', '2025-12-03 12:51:52'),
(7, 'Qiza', 6, 6, NULL, 460.00, 650.00, 125.50, NULL, NULL, '2025-12-03 12:58:03', '2025-12-13 09:53:25'),
(8, 'JNG Local', 7, 2, NULL, 580.00, 750.00, 50.00, '456', NULL, '2025-12-04 07:49:53', '2025-12-11 06:13:57'),
(9, 'Arabi Libas', 5, 8, NULL, 850.00, 1200.00, 96.00, NULL, NULL, '2025-12-04 13:54:50', '2025-12-04 13:55:23');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(166) NOT NULL,
  `guard_name` varchar(25) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(2, 'manager', 'web', '2025-11-18 06:17:00', '2025-11-18 06:17:00'),
(3, 'Cutter', 'web', '2025-11-18 06:17:00', '2025-11-29 08:08:47'),
(4, 'Suite Maker', 'web', '2025-11-24 04:31:32', '2025-11-24 04:31:32'),
(5, 'Worker', 'web', '2025-11-29 08:03:41', '2025-11-29 08:03:41');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
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
(14, 3),
(14, 4),
(14, 5),
(15, 1),
(15, 3),
(15, 4),
(15, 5),
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
(30, 2),
(31, 1),
(31, 3),
(31, 4),
(31, 5),
(32, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('hcRzfY4KI78reBdwNT6FKMXIj8HMgTpPBiGLob7Y', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQjM5a25MYUt1S2ZDU2R0U3paVFFEOVFQS1pub3lHTkJFa0RLSk1oUCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Nld2luZy1vcmRlcnMiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozOToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3JlcG9ydHMvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1765868963);

-- --------------------------------------------------------

--
-- Table structure for table `sewing_orders`
--

CREATE TABLE `sewing_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sewing_order_number` varchar(191) DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `order_date` date DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paid_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `remaining_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_method` enum('cash','online','bank_transfer','cheque') NOT NULL DEFAULT 'cash',
  `partial_amount` decimal(10,2) DEFAULT NULL,
  `payment_status` enum('partial','full','no_payment') NOT NULL DEFAULT 'partial',
  `order_status` enum('pending','in_progress','completed','cancelled','delivered') NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `delivered_date` date DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `cancelled_by` bigint(20) UNSIGNED DEFAULT NULL,
  `cancellation_reason` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sewing_orders`
--

INSERT INTO `sewing_orders` (`id`, `sewing_order_number`, `customer_id`, `order_date`, `delivery_date`, `total_amount`, `paid_amount`, `remaining_amount`, `payment_method`, `partial_amount`, `payment_status`, `order_status`, `notes`, `delivered_date`, `cancelled_at`, `cancelled_by`, `cancellation_reason`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'SEW-000001', 1, '2025-11-28', '2025-12-03', 0.00, 0.00, 0.00, 'cash', 0.00, 'full', 'cancelled', NULL, NULL, '2025-12-04 10:26:22', 1, 'All items cancelled', NULL, '2025-11-28 08:21:36', '2025-12-04 10:26:22'),
(2, 'SEW-000002', 2, '2025-11-30', '2025-12-14', 4000.00, 0.00, 4000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-30 10:41:57', '2025-11-30 10:41:57'),
(3, 'SEW-000003', 2, '2025-11-30', '2025-12-15', 4500.00, 0.00, 4500.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-30 10:45:01', '2025-11-30 10:45:01'),
(4, 'SEW-000004', 3, '2025-11-30', '2025-12-24', 4000.00, 0.00, 4000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-02 06:42:53', '2025-12-02 06:42:53'),
(5, 'SEW-000005', 4, '2025-11-29', '2025-12-09', 2000.00, 1800.00, 200.00, 'cash', 1800.00, 'partial', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-02 06:49:14', '2025-12-10 05:32:55'),
(6, 'SEW-000006', 5, '2025-11-26', '2025-12-09', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-02 06:53:17', '2025-12-02 06:53:17'),
(7, 'SEW-000007', 6, '2025-11-26', '2025-12-04', 3000.00, 3000.00, 0.00, 'cash', 3000.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-02 07:43:00', '2025-12-11 05:34:23'),
(8, 'SEW-000008', 7, '2025-12-02', '2025-12-12', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-02 08:15:51', '2025-12-02 08:15:51'),
(9, 'SEW-000009', 9, '2025-12-02', '2025-12-10', 6000.00, 0.00, 6000.00, 'cash', 0.00, 'partial', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-02 08:23:22', '2025-12-13 05:29:24'),
(10, 'SEW-000010', 9, '2025-12-02', '2025-12-13', 0.00, 0.00, 0.00, 'cash', 0.00, 'full', 'cancelled', NULL, NULL, '2025-12-15 13:02:54', 1, 'All items cancelled', NULL, '2025-12-02 08:27:39', '2025-12-15 13:02:54'),
(11, 'SEW-000011', 9, '2025-12-02', '2025-12-12', 4500.00, 0.00, 4500.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-02 08:29:09', '2025-12-02 08:29:09'),
(12, 'SEW-000012', 8, '2025-11-26', '2025-12-10', 6000.00, 0.00, 6000.00, 'cash', 0.00, 'partial', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-02 09:44:56', '2025-12-13 05:30:00'),
(13, 'SEW-000013', 12, '2025-11-27', '2025-12-08', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-02 11:08:10', '2025-12-07 07:31:46'),
(14, 'SEW-000014', 13, '2025-11-30', '2025-12-10', 4000.00, 4000.00, 0.00, 'cash', 4000.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-02 11:12:16', '2025-12-07 09:23:06'),
(15, 'SEW-000015', 14, '2025-11-27', '2025-12-08', 10000.00, 10000.00, 0.00, 'cash', 10000.00, 'full', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-02 11:20:51', '2025-12-07 10:44:13'),
(16, 'SEW-000016', 15, '2025-12-02', '2025-12-12', 4000.00, 4000.00, 0.00, 'cash', 4000.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-02 12:09:46', '2025-12-11 06:15:05'),
(17, 'SEW-000017', 16, '2025-11-28', '2025-12-05', 4000.00, 0.00, 4000.00, 'cash', 0.00, 'partial', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-02 12:13:49', '2025-12-15 12:47:44'),
(18, 'SEW-000018', 17, '2025-11-27', '2025-12-10', 4000.00, 0.00, 4000.00, 'cash', 0.00, 'partial', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-02 12:46:34', '2025-12-10 04:19:54'),
(19, 'SEW-000019', 18, '2025-11-27', '2025-12-10', 6000.00, 0.00, 6000.00, 'cash', 0.00, 'partial', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-02 12:49:40', '2025-12-10 04:19:43'),
(20, 'SEW-000020', 19, '2025-11-29', '2025-12-12', 4000.00, 4000.00, 0.00, 'cash', 4000.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-02 13:03:34', '2025-12-11 05:31:24'),
(21, 'SEW-000021', 9, '2025-12-01', '2025-12-10', 4500.00, 0.00, 4500.00, 'cash', 0.00, 'partial', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-03 05:36:22', '2025-12-10 04:19:31'),
(22, 'SEW-000022', 21, '2025-11-28', '2025-12-10', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-03 06:04:27', '2025-12-10 12:43:04'),
(23, 'SEW-000023', 9, '2025-12-03', '2025-12-11', 4500.00, 0.00, 4500.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-03 08:02:13', '2025-12-03 08:02:13'),
(24, 'SEW-000024', 16, '2025-11-26', '2025-12-04', 4000.00, 0.00, 4000.00, 'cash', 0.00, 'partial', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-03 08:04:40', '2025-12-10 12:41:08'),
(25, 'SEW-000025', 22, '2025-12-03', '2025-12-13', 3500.00, 3500.00, 0.00, 'cash', 3500.00, 'full', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-03 09:03:06', '2025-12-13 05:30:37'),
(26, 'SEW-000026', 23, '2025-12-03', '2025-12-10', 4000.00, 3600.00, 400.00, 'cash', 3600.00, 'partial', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-03 11:04:15', '2025-12-10 12:37:24'),
(27, 'SEW-000027', 24, '2025-12-04', '2025-12-14', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 05:22:24', '2025-12-04 05:22:24'),
(28, 'SEW-000028', 25, '2025-11-22', '2025-12-03', 4000.00, 3600.00, 400.00, 'cash', 3600.00, 'partial', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 05:32:21', '2025-12-04 05:41:30'),
(29, 'SEW-000029', 26, '2025-11-17', '2025-12-30', 2000.00, 1500.00, 500.00, 'cash', 1500.00, 'partial', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 05:53:50', '2025-12-04 05:55:13'),
(30, 'SEW-000030', 27, '2025-11-12', '2025-12-30', 8000.00, 0.00, 8000.00, 'cash', 0.00, 'partial', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 06:07:25', '2025-12-04 06:09:45'),
(31, 'SEW-000031', 27, '2025-11-12', '2025-11-30', 9000.00, 0.00, 9000.00, 'cash', 0.00, 'partial', 'delivered', 'Wakset Orders', NULL, NULL, NULL, NULL, NULL, '2025-12-04 06:08:46', '2025-12-04 06:09:23'),
(32, 'SEW-000032', 27, '2025-12-04', '2025-12-18', 0.00, 0.00, 0.00, 'cash', 0.00, 'full', 'cancelled', NULL, NULL, '2025-12-04 07:33:06', 1, 'All items cancelled', NULL, '2025-12-04 06:17:15', '2025-12-04 07:33:06'),
(33, 'SEW-000033', 29, '2025-11-14', '2025-12-04', 6501.00, 6501.00, 0.00, 'cash', 6501.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 07:14:11', '2025-12-04 11:13:56'),
(34, 'SEW-000034', 30, '2025-11-11', '2025-12-31', 6000.00, 0.00, 6000.00, 'cash', 0.00, 'partial', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 07:24:02', '2025-12-13 05:31:19'),
(35, 'SEW-000035', 31, '2025-11-12', '2025-12-30', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 07:26:42', '2025-12-04 07:26:42'),
(36, 'SEW-000036', 32, '2025-11-15', '2025-03-11', 4000.00, 4000.00, 0.00, 'cash', 4000.00, 'full', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 07:30:26', '2025-12-10 10:53:51'),
(37, 'SEW-000037', 28, '2025-12-04', '2025-12-15', 1800.00, 0.00, 1800.00, 'cash', 0.00, 'partial', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 07:34:56', '2025-12-15 11:01:03'),
(38, 'SEW-000038', 34, '2025-12-04', '2025-12-09', 6000.00, 6000.00, 0.00, 'cash', 6000.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 08:24:04', '2025-12-13 09:46:47'),
(39, 'SEW-000039', 35, '2025-12-04', '2025-12-11', 2000.00, 2000.00, 0.00, 'cash', 2000.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 09:08:50', '2025-12-13 11:36:58'),
(40, 'SEW-000040', 36, '2025-11-14', '2025-12-03', 2000.00, 2000.00, 0.00, 'cash', 2000.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 10:19:15', '2025-12-04 10:19:56'),
(41, 'SEW-000041', 37, '2025-11-27', '2025-12-10', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 10:34:32', '2025-12-04 10:34:32'),
(42, 'SEW-000042', 38, '2025-12-04', '2025-12-07', 6000.00, 6000.00, 0.00, 'cash', 6000.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 10:52:02', '2025-12-10 11:40:17'),
(43, 'SEW-000043', 40, '2025-11-27', '2025-12-04', 6000.00, 5400.00, 600.00, 'cash', 5400.00, 'partial', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 11:59:56', '2025-12-10 12:49:51'),
(44, 'SEW-000044', 41, '2025-12-04', '2025-12-11', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 12:33:01', '2025-12-04 12:33:01'),
(45, 'SEW-000045', 42, '2025-12-04', '2025-11-23', 8000.00, 8000.00, 0.00, 'cash', 8000.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 12:54:29', '2025-12-07 09:25:10'),
(46, 'SEW-000046', 43, '2025-12-01', '2025-12-04', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 13:01:02', '2025-12-04 13:01:26'),
(47, 'SEW-000047', 44, '2025-12-04', '2025-11-08', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 13:47:25', '2025-12-04 13:47:45'),
(48, 'SEW-000048', 45, '2025-11-19', '2025-12-03', 4000.00, 4000.00, 0.00, 'cash', 4000.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 13:51:52', '2025-12-04 13:52:18'),
(49, 'SEW-000049', 47, '2025-12-06', '2025-12-08', 1500.00, 1500.00, 0.00, 'cash', 1500.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-06 08:27:16', '2025-12-14 09:03:32'),
(50, 'SEW-000050', 48, '2025-12-01', '2025-12-06', 2000.00, 2000.00, 0.00, 'cash', 2000.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-06 09:36:57', '2025-12-06 09:37:23'),
(51, 'SEW-000051', 49, '2025-11-20', '2025-12-06', 4000.00, 4000.00, 0.00, 'cash', 4000.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-06 09:40:40', '2025-12-06 09:40:57'),
(52, 'SEW-000052', 51, '2025-12-02', '2025-12-08', 3000.00, 0.00, 3000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-06 10:27:22', '2025-12-06 10:27:22'),
(53, 'SEW-000053', 50, '2025-12-06', '2025-12-07', 2000.00, 2000.00, 0.00, 'cash', 2000.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-06 10:39:06', '2025-12-10 11:03:11'),
(54, 'SEW-000054', 52, '2025-12-06', '2025-12-14', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-06 10:57:13', '2025-12-06 10:57:13'),
(55, 'SEW-000055', 53, '2025-12-06', '2025-12-12', 10000.00, 9000.00, 1000.00, 'cash', 9000.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-06 12:58:37', '2025-12-15 10:08:52'),
(56, 'SEW-000056', 54, '2025-12-07', '2025-12-12', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-07 10:50:52', '2025-12-07 10:50:52'),
(57, 'SEW-000057', 55, '2025-12-07', '2025-12-15', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-07 11:05:14', '2025-12-07 11:05:14'),
(58, 'SEW-000058', 56, '2025-12-07', '2025-12-16', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-07 11:09:20', '2025-12-15 10:59:56'),
(59, 'SEW-000059', 57, '2025-12-01', '2025-12-11', 4000.00, 2000.00, 2000.00, 'cash', 2000.00, 'partial', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-08 06:38:53', '2025-12-08 12:03:09'),
(60, 'SEW-000060', 58, '2025-12-08', '2025-12-20', 8000.00, 0.00, 8000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-08 10:46:12', '2025-12-08 10:46:12'),
(61, 'SEW-000061', 49, '2025-12-10', '2025-12-24', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-10 10:13:09', '2025-12-10 10:13:09'),
(62, 'SEW-000062', 59, '2025-12-10', '2025-12-14', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-10 10:35:53', '2025-12-13 12:26:02'),
(63, 'SEW-000063', 60, '2025-12-10', '2025-12-13', 2000.00, 2000.00, 0.00, 'cash', 2000.00, 'full', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-10 10:38:24', '2025-12-13 09:31:17'),
(64, 'SEW-000064', 61, '2025-12-04', '2025-12-13', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-10 10:42:13', '2025-12-10 10:50:37'),
(65, 'SEW-000065', 62, '2025-12-10', '2025-12-15', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-10 11:08:43', '2025-12-10 11:08:43'),
(66, 'SEW-000066', 63, '2025-12-02', '2025-12-10', 2000.00, 2000.00, 0.00, 'cash', 2000.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-10 12:31:43', '2025-12-10 12:39:35'),
(67, 'SEW-000067', 63, '2025-12-03', '2025-12-10', 4000.00, 4000.00, 0.00, 'cash', 4000.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-10 12:38:07', '2025-12-10 12:39:21'),
(68, 'SEW-000068', 64, '2025-12-02', '2025-12-10', 1500.00, 1500.00, 0.00, 'cash', 1500.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-11 05:39:11', '2025-12-11 05:43:02'),
(69, 'SEW-000069', 65, '2025-12-02', '2025-12-10', 1500.00, 1500.00, 0.00, 'cash', 1500.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-11 05:42:04', '2025-12-11 05:42:22'),
(70, 'SEW-000070', 66, '2025-12-10', '2025-12-19', 4000.00, 0.00, 4000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-11 05:48:21', '2025-12-11 05:48:21'),
(71, 'SEW-000071', 67, '2025-12-10', '2025-12-12', 1800.00, 1500.00, 300.00, 'cash', 1500.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-11 06:13:33', '2025-12-11 11:50:36'),
(72, 'SEW-000072', 68, '2025-12-04', '2025-12-11', 5799.00, 5799.00, 0.00, 'cash', 5799.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-11 06:18:32', '2025-12-11 06:18:50'),
(73, 'SEW-000073', 4, '2025-12-09', '2025-12-15', 4000.00, 0.00, 4000.00, 'cash', 0.00, 'partial', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-11 07:08:21', '2025-12-15 11:00:25'),
(74, 'SEW-000074', 69, '2025-12-08', '2025-12-18', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-11 07:14:16', '2025-12-11 07:14:16'),
(75, 'SEW-000075', 70, '2025-12-09', '2025-12-13', 2000.00, 2000.00, 0.00, 'cash', 2000.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-11 07:20:03', '2025-12-14 09:51:32'),
(76, 'SEW-000076', 71, '2025-12-08', '2025-12-17', 3600.00, 0.00, 3600.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-11 07:22:59', '2025-12-11 07:22:59'),
(77, 'SEW-000077', 74, '2025-12-09', '2025-12-13', 2000.00, 1750.00, 250.00, 'cash', 1750.00, 'partial', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-11 07:38:55', '2025-12-15 10:09:42'),
(78, 'SEW-000078', 75, '2025-11-25', '2025-12-05', 2000.00, 2000.00, 0.00, 'cash', 2000.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-11 08:46:28', '2025-12-11 08:47:10'),
(79, 'SEW-000079', 77, '2025-12-11', '2025-12-18', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-11 09:09:18', '2025-12-11 09:09:18'),
(80, 'SEW-000080', 76, '2025-12-11', '2025-12-18', 4000.00, 0.00, 4000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-11 09:16:02', '2025-12-11 09:16:02'),
(81, 'SEW-000081', 78, '2025-12-02', '2025-12-11', 2000.00, 2000.00, 0.00, 'cash', 2000.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-11 11:54:52', '2025-12-11 11:55:05'),
(82, 'SEW-000082', 79, '2025-11-26', '2025-12-13', 3500.00, 3500.00, 0.00, 'cash', 3500.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-13 09:34:05', '2025-12-13 09:34:24'),
(83, 'SEW-000083', 80, '2025-12-01', '2025-12-12', 4000.00, 4000.00, 0.00, 'cash', 4000.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-13 09:37:45', '2025-12-13 09:37:55'),
(84, 'SEW-000084', 42, '2025-12-13', '2025-12-23', 4000.00, 0.00, 4000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-13 09:44:58', '2025-12-13 09:44:58'),
(85, 'SEW-000085', 81, '2025-12-10', '2025-12-17', 4000.00, 0.00, 4000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-13 12:24:36', '2025-12-13 12:24:36'),
(86, 'SEW-000086', 82, '2025-12-14', '2025-12-28', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-14 07:55:23', '2025-12-14 07:55:23'),
(87, 'SEW-000087', 83, '2025-12-14', '2025-12-28', 4000.00, 0.00, 4000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-14 08:33:59', '2025-12-14 08:33:59'),
(88, 'SEW-000088', 84, '2025-12-14', '2025-12-28', 8000.00, 0.00, 8000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-14 10:13:05', '2025-12-14 10:13:05'),
(89, 'SEW-000089', 85, '2025-12-01', '2025-12-14', 1800.00, 1800.00, 0.00, 'cash', 1800.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-14 10:55:19', '2025-12-14 10:55:40'),
(90, 'SEW-000090', 86, '2025-12-02', '2025-12-14', 2000.00, 2000.00, 0.00, 'cash', 2000.00, 'full', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-14 11:07:38', '2025-12-14 11:07:48'),
(91, 'SEW-000091', 87, '2025-12-14', '2025-12-21', 4000.00, 0.00, 4000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-14 11:41:04', '2025-12-14 11:41:04'),
(92, 'SEW-000092', 88, '2025-12-14', '2025-12-21', 4000.00, 0.00, 4000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-14 11:45:15', '2025-12-14 11:45:15'),
(93, 'SEW-000093', 74, '2025-12-01', '2025-12-15', 2000.00, 1750.00, 250.00, 'cash', 1750.00, 'partial', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-15 10:10:52', '2025-12-15 11:00:10'),
(94, 'SEW-000094', 91, '2025-12-15', '2025-12-15', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'delivered', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-15 11:51:04', '2025-12-15 11:52:00'),
(95, 'SEW-000095', 92, '2025-12-15', '2025-12-29', 2000.00, 0.00, 2000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-15 11:57:06', '2025-12-15 11:57:06'),
(96, 'SEW-000096', 14, '2025-12-11', '2025-12-22', 4000.00, 0.00, 4000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-15 12:31:32', '2025-12-15 12:31:32'),
(97, 'SEW-000097', 10, '2025-12-03', '2025-12-24', 14000.00, 0.00, 14000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-15 12:51:23', '2025-12-15 12:51:23'),
(98, 'SEW-000098', 1, '2025-12-15', '2025-12-16', 1200.00, 0.00, 1200.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 02:38:45', '2025-12-16 02:38:45'),
(99, 'SEW-000099', 14, '2025-12-15', '2025-12-16', 1200.00, 0.00, 1200.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 02:54:03', '2025-12-16 02:54:03'),
(100, 'SEW-000100', 14, '2025-12-15', '2025-12-15', 1200.00, 0.00, 1200.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 03:07:22', '2025-12-16 03:07:22'),
(101, 'SEW-000101', 14, '2025-12-15', '2025-12-16', 1200.00, 0.00, 1200.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 03:09:24', '2025-12-16 03:09:24'),
(102, 'SEW-000102', 14, '2025-12-15', '2025-12-16', 1200.00, 0.00, 1200.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 03:09:32', '2025-12-16 03:09:32'),
(103, 'SEW-000103', 14, '2025-12-15', '2025-12-16', 1200.00, 0.00, 1200.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 03:09:38', '2025-12-16 03:09:38'),
(104, 'SEW-000104', 14, '2025-12-15', '2025-12-16', 1200.00, 0.00, 1200.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 03:12:26', '2025-12-16 03:12:26'),
(105, 'SEW-000105', 14, '2025-12-15', '2025-12-15', 1000.00, 0.00, 1000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 03:13:42', '2025-12-16 03:13:42'),
(106, 'SEW-000106', 14, '2025-12-15', '2025-12-15', 1000.00, 0.00, 1000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 03:13:51', '2025-12-16 03:13:51'),
(107, 'SEW-000107', 14, '2025-12-15', '2025-12-15', 1000.00, 0.00, 1000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 03:13:58', '2025-12-16 03:13:58'),
(108, 'SEW-000108', 14, '2025-12-15', '2025-12-15', 1000.00, 0.00, 1000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 03:14:16', '2025-12-16 03:14:16'),
(109, 'SEW-000109', 14, '2025-12-15', '2025-12-15', 1000.00, 0.00, 1000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 03:14:16', '2025-12-16 03:14:16'),
(110, 'SEW-000110', 14, '2025-12-15', '2025-12-15', 1000.00, 0.00, 1000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 03:14:24', '2025-12-16 03:14:24'),
(111, 'SEW-000111', 14, '2025-12-15', '2025-12-16', 1000.00, 0.00, 1000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 03:52:11', '2025-12-16 03:52:11'),
(112, 'SEW-000112', 14, '2025-12-15', '2025-12-16', 1000.00, 0.00, 1000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 03:52:22', '2025-12-16 03:52:22'),
(113, 'SEW-000113', 14, '2025-12-15', '2025-12-16', 1000.00, 0.00, 1000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 03:52:29', '2025-12-16 03:52:29'),
(114, 'SEW-000114', 14, '2025-12-15', '2025-12-16', 1000.00, 0.00, 1000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 03:53:26', '2025-12-16 03:53:26'),
(115, 'SEW-000115', 14, '2025-12-15', '2025-12-16', 1000.00, 0.00, 1000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 03:55:17', '2025-12-16 03:55:17'),
(116, 'SEW-000116', 14, '2025-12-15', '2025-12-16', 1000.00, 0.00, 1000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 03:57:16', '2025-12-16 03:57:16'),
(117, 'SEW-000117', 14, '2025-12-15', '2025-12-16', 1000.00, 0.00, 1000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 03:57:33', '2025-12-16 03:57:33'),
(118, 'SEW-000118', 14, '2025-12-15', '2025-12-16', 1000.00, 0.00, 1000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 03:57:54', '2025-12-16 03:57:54'),
(119, 'SEW-000119', 1, '2025-12-15', '2025-12-16', 12.00, 0.00, 12.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 04:05:26', '2025-12-16 04:05:26'),
(120, 'SEW-000120', 14, '2025-12-15', '2025-12-16', 1200.00, 0.00, 1200.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 04:07:11', '2025-12-16 04:07:11'),
(121, 'SEW-000121', 14, '2025-12-15', '2025-12-16', 1000.00, 0.00, 1000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 04:14:30', '2025-12-16 04:14:30'),
(122, 'SEW-000122', 14, '2025-12-15', '2025-12-16', 1000.00, 0.00, 1000.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 04:14:31', '2025-12-16 04:14:31'),
(123, 'SEW-000123', 14, '2025-12-15', '2025-12-17', 2431.00, 0.00, 2431.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 04:15:19', '2025-12-16 04:15:19'),
(124, 'SEW-000124', 14, '2025-12-15', '2025-12-16', 100.00, 0.00, 100.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 06:55:40', '2025-12-16 06:55:40'),
(125, 'SEW-000125', 14, '2025-12-15', '2025-12-16', 100.00, 0.00, 100.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 06:57:13', '2025-12-16 06:57:13'),
(126, 'SEW-000126', 14, '2025-12-15', '2025-12-16', 100.00, 0.00, 100.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 06:58:35', '2025-12-16 06:58:35'),
(127, 'SEW-000127', 14, '2025-12-15', '2025-12-16', 1111.00, 0.00, 1111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:06:56', '2025-12-16 07:06:56'),
(128, 'SEW-000128', 14, '2025-12-15', '2025-12-16', 1111.00, 0.00, 1111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:07:47', '2025-12-16 07:07:47'),
(129, 'SEW-000129', 14, '2025-12-15', '2025-12-16', 1111.00, 0.00, 1111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:11:39', '2025-12-16 07:11:39'),
(130, 'SEW-000130', 14, '2025-12-15', '2025-12-16', 1111.00, 0.00, 1111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:12:44', '2025-12-16 07:12:44'),
(131, 'SEW-000131', 14, '2025-12-15', '2025-12-16', 1111.00, 0.00, 1111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:12:44', '2025-12-16 07:12:44'),
(132, 'SEW-000132', 14, '2025-12-15', '2025-12-16', 1111.00, 0.00, 1111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:13:04', '2025-12-16 07:13:04'),
(133, 'SEW-000133', 14, '2025-12-15', '2025-12-16', 1111.00, 0.00, 1111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:13:10', '2025-12-16 07:13:10'),
(134, 'SEW-000134', 14, '2025-12-15', '2025-12-16', 1111.00, 0.00, 1111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:17:03', '2025-12-16 07:17:03'),
(135, 'SEW-000135', 14, '2025-12-15', '2025-12-16', 1111.00, 0.00, 1111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:19:16', '2025-12-16 07:19:16'),
(136, 'SEW-000136', 14, '2025-12-15', '2025-12-16', 11111.00, 0.00, 11111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:23:01', '2025-12-16 07:23:01'),
(137, 'SEW-000137', 14, '2025-12-15', '2025-12-16', 11111.00, 0.00, 11111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:23:31', '2025-12-16 07:23:31'),
(138, 'SEW-000138', 14, '2025-12-15', '2025-12-16', 11111.00, 0.00, 11111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:23:50', '2025-12-16 07:23:50'),
(139, 'SEW-000139', 14, '2025-12-15', '2025-12-16', 11111.00, 0.00, 11111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:24:02', '2025-12-16 07:24:02'),
(140, 'SEW-000140', 14, '2025-12-15', '2025-12-16', 11111.00, 0.00, 11111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:24:07', '2025-12-16 07:24:07'),
(141, 'SEW-000141', 14, '2025-12-15', '2025-12-16', 111.00, 0.00, 111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:26:36', '2025-12-16 07:26:36'),
(142, 'SEW-000142', 14, '2025-12-15', '2025-12-16', 111.00, 0.00, 111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:26:44', '2025-12-16 07:26:44'),
(143, 'SEW-000143', 14, '2025-12-15', '2025-12-16', 111.00, 0.00, 111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:27:01', '2025-12-16 07:27:01'),
(144, 'SEW-000144', 14, '2025-12-15', '2025-12-16', 111.00, 0.00, 111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:27:10', '2025-12-16 07:27:10'),
(145, 'SEW-000145', 14, '2025-12-15', '2025-12-16', 111.00, 0.00, 111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:27:37', '2025-12-16 07:27:37'),
(146, 'SEW-000146', 14, '2025-12-15', '2025-12-23', 133221.00, 0.00, 133221.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:31:02', '2025-12-16 07:31:02'),
(147, 'SEW-000147', 14, '2025-12-15', '2025-12-23', 133221.00, 0.00, 133221.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:31:25', '2025-12-16 07:31:25'),
(148, 'SEW-000148', 14, '2025-12-15', '2025-12-17', 111.00, 0.00, 111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:34:18', '2025-12-16 07:34:18'),
(149, 'SEW-000149', 14, '2025-12-15', '2025-12-17', 111.00, 0.00, 111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:34:43', '2025-12-16 07:34:43'),
(150, 'SEW-000150', 14, '2025-12-16', '2025-12-18', 1111.00, 0.00, 1111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 16:46:54', '2025-12-16 16:46:55'),
(151, 'SEW-000151', 14, '2025-12-16', '2025-12-17', 1111.00, 0.00, 1111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 16:48:21', '2025-12-16 16:48:21'),
(152, 'SEW-000152', 14, '2025-12-16', '2025-12-17', 1111.00, 0.00, 1111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 16:48:49', '2025-12-16 16:48:49'),
(153, 'SEW-000153', 14, '2025-12-16', '2025-12-17', 1111.00, 0.00, 1111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 16:48:55', '2025-12-16 16:48:55'),
(154, 'SEW-000154', 14, '2025-12-16', '2025-12-17', 1111.00, 0.00, 1111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 16:49:20', '2025-12-16 16:49:20'),
(155, 'SEW-000155', 14, '2025-12-16', '2025-12-17', 12121.00, 0.00, 12121.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 16:51:08', '2025-12-16 16:51:08'),
(156, 'SEW-000156', 14, '2025-12-16', '2025-12-17', 1111.00, 0.00, 1111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 19:28:38', '2025-12-16 19:28:38'),
(157, 'SEW-000157', 14, '2025-12-16', '2025-12-17', 1111.00, 0.00, 1111.00, 'cash', 0.00, 'partial', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 19:46:00', '2025-12-16 19:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `sewing_order_items`
--

CREATE TABLE `sewing_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sewing_order_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(191) NOT NULL,
  `color` varchar(191) DEFAULT NULL,
  `sewing_price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `customer_measurement` longtext DEFAULT NULL,
  `assign_note` text DEFAULT NULL,
  `status` enum('pending','on_hold','in_progress','cutter','sewing','completed','cancelled','delivered') NOT NULL DEFAULT 'pending',
  `delivered_date` date DEFAULT NULL,
  `cancelled_date` date DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `cancelled_by` bigint(20) UNSIGNED DEFAULT NULL,
  `cancellation_reason` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sewing_order_items`
--

INSERT INTO `sewing_order_items` (`id`, `sewing_order_id`, `product_name`, `color`, `sewing_price`, `qty`, `customer_measurement`, `assign_note`, `status`, `delivered_date`, `cancelled_date`, `total_price`, `cancelled_at`, `cancelled_by`, `cancellation_reason`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Grac', NULL, 2000.00, 1, '{\"id\":1,\"customer_id\":1,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"44\\\",\\\"shoulder\\\":\\\"18\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"15\\\",\\\"chest\\\":\\\"37\\\",\\\"waist\\\":\\\"34\\\",\\\"width\\\":\\\"23\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39\\\",\\\"pancha\\\":\\\"8\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u06a9\\\\u0631\\\\u0645 \\\\u0648\\\\u0627\\\\u0644\\\\u0627\\\",\\\"style_daman\\\":\\\"\\\\u06af\\\\u06be\\\\u06cc\\\\u0631\\\\u0627 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1\\\",\\\"style_shalwar_jeeb\\\":\\\"\\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628 \\\\u0632\\\\u067e \\\\u0648\\\\u0627\\\\u0644\\\\u0627\\\",\\\"style_stitching_detail\\\":\\\"\\\\u0686\\\\u0645\\\\u06a9 \\\\u062a\\\\u0627\\\\u0631 \\\\u06a9\\\\u0646\\\\u06a9\\\\u0631 \\\\u0633\\\\u0644\\\\u0627\\\\u0626\\\\u06cc\\\",\\\"style_cloth_type\\\":\\\"\\\\u0645\\\\u06a9\\\\u0645\\\\u0644 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u0633\\\\u0648\\\\u0679\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-11-28T08:12:27.000000Z\",\"updated_at\":\"2025-11-28T08:12:27.000000Z\"}', NULL, 'cancelled', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-11-28 08:21:36', '2025-12-04 10:26:22'),
(2, 2, 'Imp', NULL, 2000.00, 1, NULL, NULL, 'pending', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-11-30 10:41:57', '2025-11-30 10:41:57'),
(3, 2, 'TR960', NULL, 2000.00, 1, NULL, NULL, 'pending', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-11-30 10:41:57', '2025-12-14 07:58:48'),
(4, 3, 'TR 960', NULL, 4500.00, 1, '{\"id\":3,\"customer_id\":2,\"type\":\"waistcoat\",\"data\":\"{\\\"waistcoat\\\":{\\\"chest\\\":\\\"39.5\\\",\\\"waist\\\":\\\"40\\\",\\\"shoulder\\\":\\\"16.5\\\",\\\"length\\\":\\\"28\\\",\\\"buttons\\\":\\\"1\\\",\\\"style\\\":\\\"Simple\\\"}}\",\"style\":\"null\",\"notes\":\"Gala band\",\"deleted_at\":null,\"created_at\":\"2025-11-30T10:43:08.000000Z\",\"updated_at\":\"2025-11-30T10:43:08.000000Z\"}', NULL, 'pending', NULL, NULL, 4500.00, NULL, NULL, NULL, NULL, '2025-11-30 10:45:01', '2025-11-30 10:45:01'),
(5, 4, 'Lawrence Pur', NULL, 2000.00, 1, '{\"id\":4,\"customer_id\":3,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42.5\\\",\\\"shoulder\\\":\\\"20.5\\\",\\\"sleeve\\\":\\\"24.5\\\",\\\"collar\\\":\\\"17\\\",\\\"width\\\":\\\"26fit\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39.5\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_daman\\\":\\\"\\\\u06af\\\\u06be\\\\u06cc\\\\u0631\\\\u0627 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_shalwar_jeeb\\\":\\\"\\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628 \\\\u0632\\\\u067e \\\\u0648\\\\u0627\\\\u0644\\\\u0627\\\",\\\"style_button_detail\\\":\\\"\\\\u0633\\\\u0679\\\\u06cc\\\\u0644 \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0628\\\\u0679\\\\u0646\\\",\\\"style_cloth_type\\\":\\\"\\\\u0646\\\\u0627\\\\u0631\\\\u0645\\\\u0644 \\\\u0633\\\\u0648\\\\u0679\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-02T06:40:42.000000Z\",\"updated_at\":\"2025-12-02T06:40:42.000000Z\"}', NULL, 'completed', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-02 06:42:53', '2025-12-13 12:25:18'),
(6, 4, 'Sada Kane', NULL, 2000.00, 1, '{\"id\":4,\"customer_id\":3,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42.5\\\",\\\"shoulder\\\":\\\"20.5\\\",\\\"sleeve\\\":\\\"24.5\\\",\\\"collar\\\":\\\"17\\\",\\\"width\\\":\\\"26fit\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39.5\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_daman\\\":\\\"\\\\u06af\\\\u06be\\\\u06cc\\\\u0631\\\\u0627 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_shalwar_jeeb\\\":\\\"\\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628 \\\\u0632\\\\u067e \\\\u0648\\\\u0627\\\\u0644\\\\u0627\\\",\\\"style_button_detail\\\":\\\"\\\\u0633\\\\u0679\\\\u06cc\\\\u0644 \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0628\\\\u0679\\\\u0646\\\",\\\"style_cloth_type\\\":\\\"\\\\u0646\\\\u0627\\\\u0631\\\\u0645\\\\u0644 \\\\u0633\\\\u0648\\\\u0679\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-02T06:40:42.000000Z\",\"updated_at\":\"2025-12-02T06:40:42.000000Z\"}', NULL, 'pending', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-02 06:42:53', '2025-12-02 06:42:53'),
(7, 5, 'Kaju Wool', NULL, 2000.00, 1, NULL, NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-02 06:49:14', '2025-12-10 05:32:55'),
(8, 6, 'H.F', NULL, 2000.00, 1, '{\"id\":6,\"customer_id\":5,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"39\\\",\\\"shoulder\\\":\\\"17.5\\\",\\\"sleeve\\\":\\\"21\\\",\\\"collar\\\":\\\"15.5\\\",\\\"width\\\":\\\"26\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"38.5\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u06af\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0627\\\\u06cc\\\\u06a9 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u0633\\\\u0679\\\\u0688\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-02T06:52:23.000000Z\",\"updated_at\":\"2025-12-02T06:52:23.000000Z\"}', NULL, 'pending', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-02 06:53:17', '2025-12-02 06:53:17'),
(9, 7, 'TR 960', NULL, 1500.00, 1, '{\"id\":7,\"customer_id\":6,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"17.5\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"15\\\",\\\"width\\\":\\\"25\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"35.5\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u06a9\\\\u0631\\\\u0645 \\\\u0648\\\\u0627\\\\u0644\\\\u0627\\\",\\\"style_daman\\\":\\\"\\\\u06af\\\\u06be\\\\u06cc\\\\u0631\\\\u0627 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_cloth_type\\\":\\\"\\\\u0645\\\\u06a9\\\\u0645\\\\u0644 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u0633\\\\u0648\\\\u0679\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-02T07:41:36.000000Z\",\"updated_at\":\"2025-12-02T07:41:36.000000Z\"}', NULL, 'delivered', NULL, NULL, 1500.00, NULL, NULL, NULL, NULL, '2025-12-02 07:43:00', '2025-12-11 05:34:23'),
(10, 7, 'Local', NULL, 1500.00, 1, '{\"id\":7,\"customer_id\":6,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"17.5\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"15\\\",\\\"width\\\":\\\"25\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"35.5\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u06a9\\\\u0631\\\\u0645 \\\\u0648\\\\u0627\\\\u0644\\\\u0627\\\",\\\"style_daman\\\":\\\"\\\\u06af\\\\u06be\\\\u06cc\\\\u0631\\\\u0627 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_cloth_type\\\":\\\"\\\\u0645\\\\u06a9\\\\u0645\\\\u0644 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u0633\\\\u0648\\\\u0679\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-02T07:41:36.000000Z\",\"updated_at\":\"2025-12-02T07:41:36.000000Z\"}', NULL, 'delivered', NULL, NULL, 1500.00, NULL, NULL, NULL, NULL, '2025-12-02 07:43:00', '2025-12-11 05:34:23'),
(11, 8, 'Rajjar Khamta', NULL, 2000.00, 1, '{\"id\":8,\"customer_id\":7,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"44\\\",\\\"shoulder\\\":\\\"19.5\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"14.5\\\",\\\"width\\\":\\\"23.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"42\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_cuff\\\":\\\"\\\\u0633\\\\u06cc\\\\u062f\\\\u06be\\\\u0627 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_shalwar_jeeb\\\":\\\"\\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628 \\\\u0632\\\\u067e \\\\u0648\\\\u0627\\\\u0644\\\\u0627\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-02T08:14:32.000000Z\",\"updated_at\":\"2025-12-02T08:14:32.000000Z\"}', NULL, 'pending', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-02 08:15:51', '2025-12-02 08:15:51'),
(12, 9, 'TR960', NULL, 2000.00, 3, '{\"id\":10,\"customer_id\":9,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"41\\\",\\\"shoulder\\\":\\\"18.5\\\",\\\"sleeve\\\":\\\"22\\\",\\\"collar\\\":\\\"16\\\",\\\"width\\\":\\\"25N\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37.5\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_stitching_detail\\\":\\\"\\\\u0686\\\\u0645\\\\u06a9 \\\\u062a\\\\u0627\\\\u0631 \\\\u06a9\\\\u0646\\\\u06a9\\\\u0631 \\\\u0633\\\\u0644\\\\u0627\\\\u0626\\\\u06cc\\\",\\\"style_cloth_type\\\":\\\"\\\\u0646\\\\u0627\\\\u0631\\\\u0645\\\\u0644 \\\\u0633\\\\u0648\\\\u0679\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-02T08:22:12.000000Z\",\"updated_at\":\"2025-12-02T08:22:12.000000Z\"}', NULL, 'completed', NULL, NULL, 6000.00, NULL, NULL, NULL, NULL, '2025-12-02 08:23:22', '2025-12-10 05:32:00'),
(13, 10, 'TR960', NULL, 4500.00, 1, '{\"id\":9,\"customer_id\":9,\"type\":\"waistcoat\",\"data\":\"{\\\"waistcoat\\\":{\\\"chest\\\":\\\"41.5\\\",\\\"waist\\\":\\\"42\\\",\\\"shoulder\\\":\\\"16Down\\\",\\\"length\\\":\\\"27.5\\\",\\\"buttons\\\":\\\"1\\\",\\\"style\\\":\\\"Simple\\\"}}\",\"style\":\"{\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641\\\"}\",\"notes\":\"17.5\",\"deleted_at\":null,\"created_at\":\"2025-12-02T08:21:37.000000Z\",\"updated_at\":\"2025-12-02T08:21:37.000000Z\"}', NULL, 'cancelled', NULL, NULL, 4500.00, NULL, NULL, NULL, NULL, '2025-12-02 08:27:39', '2025-12-15 13:02:54'),
(14, 11, 'TR960', NULL, 4500.00, 1, '{\"id\":9,\"customer_id\":9,\"type\":\"waistcoat\",\"data\":\"{\\\"waistcoat\\\":{\\\"chest\\\":\\\"41.5\\\",\\\"waist\\\":\\\"42\\\",\\\"shoulder\\\":\\\"16Down\\\",\\\"length\\\":\\\"27.5\\\",\\\"buttons\\\":\\\"1\\\",\\\"style\\\":\\\"Simple\\\"}}\",\"style\":\"{\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641\\\"}\",\"notes\":\"17.5\",\"deleted_at\":null,\"created_at\":\"2025-12-02T08:21:37.000000Z\",\"updated_at\":\"2025-12-02T08:21:37.000000Z\"}', NULL, 'pending', NULL, NULL, 4500.00, NULL, NULL, NULL, NULL, '2025-12-02 08:29:09', '2025-12-02 08:29:09'),
(15, 12, 'Local', NULL, 2000.00, 1, '{\"id\":13,\"customer_id\":8,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"20\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"18\\\",\\\"width\\\":\\\"29\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37\\\",\\\"pancha\\\":\\\"9.5\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0627\\\\u06cc\\\\u06a9 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-02T09:43:38.000000Z\",\"updated_at\":\"2025-12-02T09:43:38.000000Z\"}', NULL, 'completed', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-02 09:44:56', '2025-12-10 12:43:25'),
(16, 12, 'Local', NULL, 2000.00, 1, '{\"id\":13,\"customer_id\":8,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"20\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"18\\\",\\\"width\\\":\\\"29\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37\\\",\\\"pancha\\\":\\\"9.5\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0627\\\\u06cc\\\\u06a9 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-02T09:43:38.000000Z\",\"updated_at\":\"2025-12-02T09:43:38.000000Z\"}', NULL, 'completed', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-02 09:44:56', '2025-12-10 12:43:27'),
(17, 12, 'Local', NULL, 2000.00, 1, '{\"id\":13,\"customer_id\":8,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"20\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"18\\\",\\\"width\\\":\\\"29\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37\\\",\\\"pancha\\\":\\\"9.5\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0627\\\\u06cc\\\\u06a9 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-02T09:43:38.000000Z\",\"updated_at\":\"2025-12-02T09:43:38.000000Z\"}', NULL, 'completed', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-02 09:44:56', '2025-12-10 12:43:30'),
(18, 13, 'Gold Lion Cotton', NULL, 2000.00, 1, NULL, NULL, 'completed', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-02 11:08:10', '2025-12-06 10:58:53'),
(19, 14, 'TR 160', NULL, 2000.00, 2, NULL, NULL, 'delivered', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-02 11:12:16', '2025-12-06 09:33:26'),
(20, 15, 'TR+Pashmina+Karachi', NULL, 2000.00, 5, NULL, NULL, 'completed', NULL, NULL, 10000.00, NULL, NULL, NULL, NULL, '2025-12-02 11:20:51', '2025-12-06 10:59:03'),
(21, 16, 'Khamta', NULL, 2000.00, 2, '{\"id\":17,\"customer_id\":15,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"18.5\\\",\\\"sleeve\\\":\\\"16\\\",\\\"width\\\":\\\"24.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"40\\\",\\\"pancha\\\":\\\"8\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u0644\\\\u06cc\\\\u0628\\\\u0644 \\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-02T12:09:04.000000Z\",\"updated_at\":\"2025-12-02T12:09:04.000000Z\"}', NULL, 'delivered', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-02 12:09:46', '2025-12-11 06:15:02'),
(22, 17, 'Time Tex', NULL, 2000.00, 2, NULL, NULL, 'delivered', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-02 12:13:49', '2025-12-15 12:47:44'),
(23, 18, 'TR130+TrXdress', NULL, 2000.00, 2, '{\"id\":19,\"customer_id\":17,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"43\\\",\\\"shoulder\\\":\\\"17.5\\\",\\\"sleeve\\\":\\\"24\\\",\\\"collar\\\":\\\"15.5\\\",\\\"width\\\":\\\"24\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"38\\\",\\\"pancha\\\":\\\"8\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u0633\\\\u06cc\\\\u062f\\\\u06be\\\\u0627 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_daman\\\":\\\"\\\\u06af\\\\u06be\\\\u06cc\\\\u0631\\\\u0627 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-02T12:44:52.000000Z\",\"updated_at\":\"2025-12-02T12:44:52.000000Z\"}', NULL, 'completed', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-02 12:46:34', '2025-12-10 04:19:51'),
(24, 19, 'TR130+Xdress+Local', NULL, 2000.00, 3, '{\"id\":20,\"customer_id\":18,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"41\\\",\\\"shoulder\\\":\\\"19\\\",\\\"sleeve\\\":\\\"21.5\\\",\\\"collar\\\":\\\"16.5\\\",\\\"width\\\":\\\"25\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"35\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u0633\\\\u06cc\\\\u062f\\\\u06be\\\\u0627 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-02T12:48:35.000000Z\",\"updated_at\":\"2025-12-02T12:48:35.000000Z\"}', NULL, 'completed', NULL, NULL, 6000.00, NULL, NULL, NULL, NULL, '2025-12-02 12:49:40', '2025-12-10 04:19:39'),
(25, 20, 'Khamta', NULL, 2000.00, 2, '{\"id\":21,\"customer_id\":19,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"20.5\\\\\\/d3\\\",\\\"sleeve\\\":\\\"23.5\\\\\\/10.5\\\",\\\"collar\\\":\\\"16.5\\\",\\\"chest\\\":\\\"42\\\\\\/13.5\\\",\\\"waist\\\":\\\"40.5\\\\\\/13\\\",\\\"width\\\":\\\"27\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"42.5LL\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628 5.25\\\\\\/5.75\\\",\\\"style_side_pocket\\\":\\\"\\\\u0627\\\\u06cc\\\\u06a9 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u062f\\\\u0648 \\\\u067e\\\\u06cc\\\\u0644\\\\u0679\\\",\\\"style_daman\\\":\\\"\\\\u06af\\\\u06be\\\\u06cc\\\\u0631\\\\u0627 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1\\\",\\\"style_patty_width\\\":\\\"13.5\\\",\\\"style_patty_length\\\":\\\"1\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-02T13:02:12.000000Z\",\"updated_at\":\"2025-12-02T13:02:12.000000Z\"}', NULL, 'delivered', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-02 13:03:34', '2025-12-11 05:31:11'),
(26, 21, 'TR 960', NULL, 4500.00, 1, '{\"id\":9,\"customer_id\":9,\"type\":\"waistcoat\",\"data\":\"{\\\"waistcoat\\\":{\\\"chest\\\":\\\"41.5\\\",\\\"waist\\\":\\\"42\\\",\\\"shoulder\\\":\\\"16Down\\\",\\\"length\\\":\\\"27.5\\\",\\\"buttons\\\":\\\"1\\\",\\\"style\\\":\\\"Simple\\\"}}\",\"style\":\"{\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641\\\"}\",\"notes\":\"17.5\",\"deleted_at\":null,\"created_at\":\"2025-12-02T08:21:37.000000Z\",\"updated_at\":\"2025-12-02T08:21:37.000000Z\"}', NULL, 'completed', NULL, NULL, 4500.00, NULL, NULL, NULL, NULL, '2025-12-03 05:36:22', '2025-12-10 04:19:27'),
(27, 22, 'Locak', NULL, 2000.00, 1, NULL, NULL, 'completed', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-03 06:04:27', '2025-12-10 12:43:00'),
(28, 23, 'TR', NULL, 4500.00, 1, '{\"id\":9,\"customer_id\":9,\"type\":\"waistcoat\",\"data\":\"{\\\"waistcoat\\\":{\\\"chest\\\":\\\"41.5\\\",\\\"waist\\\":\\\"42\\\",\\\"shoulder\\\":\\\"16Down\\\",\\\"length\\\":\\\"27.5\\\",\\\"buttons\\\":\\\"1\\\",\\\"style\\\":\\\"Simple\\\"}}\",\"style\":\"{\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641\\\"}\",\"notes\":\"17.5\",\"deleted_at\":null,\"created_at\":\"2025-12-02T08:21:37.000000Z\",\"updated_at\":\"2025-12-02T08:21:37.000000Z\"}', NULL, 'pending', NULL, NULL, 4500.00, NULL, NULL, NULL, NULL, '2025-12-03 08:02:13', '2025-12-03 08:02:13'),
(29, 24, 'Karachi', NULL, 2000.00, 1, NULL, NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-03 08:04:40', '2025-12-10 12:41:08'),
(30, 24, 'Imported', NULL, 2000.00, 1, NULL, NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-03 08:04:40', '2025-12-10 12:41:08'),
(31, 25, 'Time Tex', NULL, 1750.00, 2, '{\"id\":23,\"customer_id\":22,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42.5\\\",\\\"shoulder\\\":\\\"18\\\\\\/ d 2.5\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"16.5\\\",\\\"width\\\":\\\"27\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"38\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0627\\\\u06cc\\\\u06a9 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u06a9\\\\u0631\\\\u0645 \\\\u0648\\\\u0627\\\\u0644\\\\u0627\\\",\\\"style_daman\\\":\\\"\\\\u06af\\\\u06be\\\\u06cc\\\\u0631\\\\u0627 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_cloth_type\\\":\\\"\\\\u0645\\\\u06a9\\\\u0645\\\\u0644 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u0633\\\\u0648\\\\u0679\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-03T09:02:12.000000Z\",\"updated_at\":\"2025-12-03T09:02:12.000000Z\"}', NULL, 'completed', NULL, NULL, 3500.00, NULL, NULL, NULL, NULL, '2025-12-03 09:03:06', '2025-12-13 05:30:30'),
(32, 26, 'TR960', NULL, 2000.00, 1, '{\"id\":24,\"customer_id\":23,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"20.5\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"18\\\",\\\"width\\\":\\\"28\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37\\\",\\\"pancha\\\":\\\"9.5\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_daman\\\":\\\"\\\\u06af\\\\u06be\\\\u06cc\\\\u0631\\\\u0627 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-03T11:01:45.000000Z\",\"updated_at\":\"2025-12-03T11:01:45.000000Z\"}', NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-03 11:04:15', '2025-12-10 12:37:24'),
(33, 26, 'Local 2 Piece', NULL, 2000.00, 1, '{\"id\":24,\"customer_id\":23,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"20.5\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"18\\\",\\\"width\\\":\\\"28\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37\\\",\\\"pancha\\\":\\\"9.5\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_daman\\\":\\\"\\\\u06af\\\\u06be\\\\u06cc\\\\u0631\\\\u0627 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-03T11:01:45.000000Z\",\"updated_at\":\"2025-12-03T11:01:45.000000Z\"}', NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-03 11:04:15', '2025-12-10 12:37:24'),
(34, 27, 'Khamta', NULL, 2000.00, 1, '{\"id\":25,\"customer_id\":24,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"19\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"16\\\",\\\"width\\\":\\\"28\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"41\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0627\\\\u06cc\\\\u06a9 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_cloth_type\\\":\\\"\\\\u0646\\\\u0627\\\\u0631\\\\u0645\\\\u0644 \\\\u0633\\\\u0648\\\\u0679\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-04T05:21:42.000000Z\",\"updated_at\":\"2025-12-04T05:21:42.000000Z\"}', NULL, 'pending', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-04 05:22:24', '2025-12-04 05:22:24'),
(35, 28, 'TR960', NULL, 2000.00, 2, '{\"id\":26,\"customer_id\":25,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"44\\\",\\\"shoulder\\\":\\\"22\\\",\\\"sleeve\\\":\\\"25\\\",\\\"collar\\\":\\\"16.5\\\",\\\"chest\\\":\\\"46\\\",\\\"waist\\\":\\\"40\\\",\\\"width\\\":\\\"25\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"42\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u06af\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0634\\\\u0627\\\\u0631\\\\u0679 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u0633\\\\u06cc\\\\u062f\\\\u06be\\\\u0627 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_patty_length\\\":\\\"13\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-04T05:31:36.000000Z\",\"updated_at\":\"2025-12-04T05:31:36.000000Z\"}', NULL, 'delivered', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-04 05:32:21', '2025-12-04 05:33:21'),
(36, 29, 'Loacla', NULL, 2000.00, 1, '{\"id\":27,\"customer_id\":26,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"40\\\",\\\"shoulder\\\":\\\"18.5\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"15.5\\\",\\\"chest\\\":\\\"39\\\",\\\"waist\\\":\\\"36.5\\\",\\\"width\\\":\\\"24.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0634\\\\u0627\\\\u0631\\\\u0679 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_cloth_type\\\":\\\"\\\\u0646\\\\u0627\\\\u0631\\\\u0645\\\\u0644 \\\\u0633\\\\u0648\\\\u0679\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-04T05:53:07.000000Z\",\"updated_at\":\"2025-12-04T05:53:07.000000Z\"}', NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-04 05:53:50', '2025-12-04 05:55:14'),
(37, 30, 'KSG', NULL, 2000.00, 4, NULL, NULL, 'delivered', NULL, NULL, 8000.00, NULL, NULL, NULL, NULL, '2025-12-04 06:07:25', '2025-12-04 06:09:45'),
(38, 31, 'Ksg', NULL, 4500.00, 2, NULL, NULL, 'delivered', NULL, NULL, 9000.00, NULL, NULL, NULL, NULL, '2025-12-04 06:08:46', '2025-12-04 06:09:23'),
(39, 32, 'Local', NULL, 1800.00, 1, NULL, NULL, 'cancelled', NULL, NULL, 1800.00, NULL, NULL, NULL, NULL, '2025-12-04 06:17:15', '2025-12-04 07:33:06'),
(40, 33, 'Imported', NULL, 2167.00, 3, NULL, NULL, 'delivered', NULL, NULL, 6501.00, NULL, NULL, NULL, NULL, '2025-12-04 07:14:11', '2025-12-04 11:13:56'),
(41, 34, 'Local', NULL, 2000.00, 3, NULL, NULL, 'completed', NULL, NULL, 6000.00, NULL, NULL, NULL, NULL, '2025-12-04 07:24:02', '2025-12-04 07:24:14'),
(42, 35, 'Local', NULL, 2000.00, 1, '{\"id\":32,\"customer_id\":31,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"40.5\\\",\\\"shoulder\\\":\\\"20.5\\\\\\/D2.5\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"16.5\\\",\\\"width\\\":\\\"26fit\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37\\\",\\\"pancha\\\":\\\"8.5\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-04T07:25:59.000000Z\",\"updated_at\":\"2025-12-04T07:25:59.000000Z\"}', NULL, 'completed', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-04 07:26:42', '2025-12-04 07:30:44'),
(43, 36, 'Local', NULL, 2000.00, 2, '{\"id\":33,\"customer_id\":32,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"21.5\\\",\\\"sleeve\\\":\\\"23.5\\\",\\\"collar\\\":\\\"17\\\",\\\"width\\\":\\\"29\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"41\\\",\\\"pancha\\\":\\\"10\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0627\\\\u06cc\\\\u06a9 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-04T07:29:38.000000Z\",\"updated_at\":\"2025-12-04T07:29:38.000000Z\"}', NULL, 'completed', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-04 07:30:26', '2025-12-04 07:30:53'),
(44, 37, 'Local', NULL, 1800.00, 1, NULL, NULL, 'completed', NULL, NULL, 1800.00, NULL, NULL, NULL, NULL, '2025-12-04 07:34:56', '2025-12-14 05:23:42'),
(45, 38, 'Khamta', NULL, 2000.00, 1, NULL, NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-04 08:24:04', '2025-12-13 09:46:47'),
(46, 38, 'TR', NULL, 2000.00, 2, NULL, NULL, 'delivered', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-04 08:24:04', '2025-12-13 09:46:47'),
(47, 39, 'Bannu wool', NULL, 2000.00, 1, '{\"id\":36,\"customer_id\":35,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"37\\\",\\\"shoulder\\\":\\\"18\\\",\\\"sleeve\\\":\\\"21.5\\\",\\\"collar\\\":\\\"14\\\",\\\"chest\\\":\\\"33\\\",\\\"width\\\":\\\"24\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"36\\\",\\\"pancha\\\":\\\"8.5\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0627\\\\u06cc\\\\u06a9 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_shalwar_jeeb\\\":\\\"\\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628 \\\\u0632\\\\u067e \\\\u0648\\\\u0627\\\\u0644\\\\u0627\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-04T09:08:22.000000Z\",\"updated_at\":\"2025-12-04T09:08:22.000000Z\"}', NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-04 09:08:50', '2025-12-13 11:36:58'),
(48, 40, 'Khamta', NULL, 2000.00, 1, '{\"id\":37,\"customer_id\":36,\"type\":\"kameez_shalwar\",\"data\":\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"43\\\",\\n        \\\"shoulder\\\": \\\"19.5\\\",\\n        \\\"sleeve\\\": \\\"24.5\\\",\\n        \\\"collar\\\": \\\"16\\\",\\n        \\\"width\\\": \\\"26\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"42.5\\\",\\n        \\\"pancha\\\": \\\"9\\\"\\n    }\\n}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0627\\\\u06cc\\\\u06a9 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":\"Pocket Inside Jeb\",\"deleted_at\":null,\"created_at\":\"2025-12-04T10:16:09.000000Z\",\"updated_at\":\"2025-12-04T10:18:37.000000Z\"}', NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-04 10:19:15', '2025-12-04 10:19:56'),
(49, 41, 'Cotton', NULL, 2000.00, 1, NULL, NULL, 'pending', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-04 10:34:32', '2025-12-04 10:34:32'),
(50, 42, 'TR130', NULL, 2000.00, 3, '{\"id\":39,\"customer_id\":38,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"41\\\",\\\"shoulder\\\":\\\"19.5\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"17.5\\\",\\\"width\\\":\\\"25\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37.5\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u0633\\\\u0679\\\\u0688\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0627\\\\u06cc\\\\u06a9 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_shalwar_jeeb\\\":\\\"\\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628 \\\\u0632\\\\u067e \\\\u0648\\\\u0627\\\\u0644\\\\u0627\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-04T10:51:18.000000Z\",\"updated_at\":\"2025-12-04T10:51:18.000000Z\"}', NULL, 'delivered', NULL, NULL, 6000.00, NULL, NULL, NULL, NULL, '2025-12-04 10:52:03', '2025-12-10 11:40:10'),
(51, 43, 'Jng', NULL, 2000.00, 2, NULL, NULL, 'delivered', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-04 11:59:56', '2025-12-04 12:00:32'),
(52, 43, 'Khamta', NULL, 2000.00, 1, NULL, NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-04 11:59:56', '2025-12-04 12:00:32'),
(53, 44, 'Local', NULL, 2000.00, 1, NULL, NULL, 'pending', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-04 12:33:01', '2025-12-04 12:33:01'),
(54, 45, 'Local', NULL, 2000.00, 4, NULL, NULL, 'delivered', NULL, NULL, 8000.00, NULL, NULL, NULL, NULL, '2025-12-04 12:54:29', '2025-12-07 09:24:46'),
(55, 46, 'TR960', NULL, 2000.00, 1, NULL, NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-04 13:01:02', '2025-12-04 13:01:26'),
(56, 47, 'TR', NULL, 2000.00, 1, '{\"id\":45,\"customer_id\":44,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"41\\\",\\\"shoulder\\\":\\\"20\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"16\\\",\\\"width\\\":\\\"28\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39\\\",\\\"pancha\\\":\\\"9.5\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0627\\\\u06cc\\\\u06a9 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-04T13:46:52.000000Z\",\"updated_at\":\"2025-12-04T13:46:52.000000Z\"}', NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-04 13:47:25', '2025-12-04 13:47:45'),
(57, 48, 'Local', NULL, 2000.00, 2, NULL, NULL, 'delivered', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-04 13:51:52', '2025-12-04 13:52:12'),
(58, 49, 'Khamta', NULL, 1500.00, 1, '{\"id\":47,\"customer_id\":47,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42.5\\\",\\\"shoulder\\\":\\\"18\\\",\\\"sleeve\\\":\\\"26.5\\\",\\\"collar\\\":\\\"15.5\\\",\\\"chest\\\":\\\"39\\\\\\/13\\\",\\\"waist\\\":\\\"40\\\\\\/13\\\",\\\"width\\\":\\\"26.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"40\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u0686\\\\u0627\\\\u06a9 \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0645\\\\u062d\\\\u0631\\\\u0627\\\\u0628 \\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_cloth_type\\\":\\\"\\\\u0645\\\\u06a9\\\\u0645\\\\u0644 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u0633\\\\u0648\\\\u0679\\\",\\\"style_patty_width\\\":\\\"1\\\",\\\"style_patty_length\\\":\\\"14\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-06T08:26:38.000000Z\",\"updated_at\":\"2025-12-06T08:26:38.000000Z\"}', NULL, 'delivered', NULL, NULL, 1500.00, NULL, NULL, NULL, NULL, '2025-12-06 08:27:16', '2025-12-14 09:03:32'),
(59, 50, 'Khamta', NULL, 2000.00, 1, NULL, NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-06 09:36:57', '2025-12-06 09:37:23'),
(60, 51, 'Local', NULL, 2000.00, 2, NULL, NULL, 'delivered', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-06 09:40:40', '2025-12-06 09:40:57'),
(61, 52, 'Khamta', NULL, 1500.00, 2, '{\"id\":50,\"customer_id\":51,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"19\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"15\\\",\\\"width\\\":\\\"24.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"40\\\",\\\"pancha\\\":\\\"8.5\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u0633\\\\u06cc\\\\u062f\\\\u06be\\\\u0627 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_daman\\\":\\\"\\\\u06af\\\\u06be\\\\u06cc\\\\u0631\\\\u0627 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-06T10:26:37.000000Z\",\"updated_at\":\"2025-12-06T10:26:37.000000Z\"}', NULL, 'completed', NULL, NULL, 3000.00, NULL, NULL, NULL, NULL, '2025-12-06 10:27:22', '2025-12-14 11:43:40'),
(62, 53, 'Khaddar', NULL, 2000.00, 1, NULL, NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-06 10:39:06', '2025-12-10 11:03:11');
INSERT INTO `sewing_order_items` (`id`, `sewing_order_id`, `product_name`, `color`, `sewing_price`, `qty`, `customer_measurement`, `assign_note`, `status`, `delivered_date`, `cancelled_date`, `total_price`, `cancelled_at`, `cancelled_by`, `cancellation_reason`, `deleted_at`, `created_at`, `updated_at`) VALUES
(63, 54, 'KSG 98000', NULL, 2000.00, 1, '{\"id\":51,\"customer_id\":52,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"41.5\\\",\\\"shoulder\\\":\\\"18.5\\\\\\/D3\\\",\\\"sleeve\\\":\\\"23.\\\",\\\"collar\\\":\\\"15.5\\\",\\\"width\\\":\\\"24\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"40.5\\\",\\\"pancha\\\":\\\"8\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_chak_patti\\\":\\\"\\\\u0686\\\\u0627\\\\u06a9 \\\\u067e\\\\u0679\\\\u06cc \\\\u06a9\\\\u0627\\\\u062c\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_patty_width\\\":\\\"0.75;;\\\",\\\"style_patty_length\\\":\\\"12.5\\\",\\\"style_collar_width\\\":\\\"0.75\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-06T10:33:45.000000Z\",\"updated_at\":\"2025-12-06T10:33:45.000000Z\"}', NULL, 'pending', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-06 10:57:13', '2025-12-06 10:57:13'),
(64, 55, 'Local', NULL, 2000.00, 5, '{\"id\":53,\"customer_id\":53,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"18.5\\\\\\/D2.5\\\",\\\"sleeve\\\":\\\"22.25\\\",\\\"collar\\\":\\\"16.5\\\",\\\"chest\\\":\\\"41\\\\\\/11.5\\\",\\\"waist\\\":\\\"39\\\\\\/12\\\",\\\"width\\\":\\\"25\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37.5\\\",\\\"pancha\\\":\\\"8\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0686\\\\u0627\\\\u0631 \\\\u0628\\\\u0679\\\\u0646 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0634\\\\u0627\\\\u0631\\\\u0679 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u062f\\\\u0648 \\\\u067e\\\\u06cc\\\\u0644\\\\u0679\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_patty_width\\\":\\\"1\\\",\\\"style_patty_length\\\":\\\"13.5\\\",\\\"style_collar_width\\\":\\\"2.5\\\",\\\"style_front_pocket_width\\\":\\\"5\\\",\\\"style_front_pocket_length\\\":\\\"5.5\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-06T12:58:01.000000Z\",\"updated_at\":\"2025-12-06T12:58:01.000000Z\"}', NULL, 'completed', NULL, NULL, 10000.00, NULL, NULL, NULL, NULL, '2025-12-06 12:58:37', '2025-12-13 05:37:20'),
(65, 56, 'TR Simple', NULL, 2000.00, 1, '{\"id\":54,\"customer_id\":54,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42.5\\\",\\\"shoulder\\\":\\\"19.5\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"16.5\\\",\\\"width\\\":\\\"26\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"40.5\\\",\\\"pancha\\\":\\\"9.5\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_daman\\\":\\\"\\\\u06af\\\\u06be\\\\u06cc\\\\u0631\\\\u0627 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-07T10:49:52.000000Z\",\"updated_at\":\"2025-12-07T10:49:52.000000Z\"}', NULL, 'pending', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-07 10:50:52', '2025-12-07 10:50:52'),
(66, 57, 'Local Woos Pashmina', NULL, 2000.00, 1, NULL, NULL, 'pending', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-07 11:05:14', '2025-12-07 11:05:14'),
(67, 58, 'TR 960', NULL, 2000.00, 1, NULL, NULL, 'completed', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-07 11:09:20', '2025-12-15 10:59:44'),
(68, 59, 'Local', NULL, 2000.00, 2, '{\"id\":57,\"customer_id\":57,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"37.5\\\",\\\"shoulder\\\":\\\"17.5\\\\\\/2.5\\\",\\\"sleeve\\\":\\\"22\\\\\\/8\\\",\\\"collar\\\":\\\"14\\\",\\\"chest\\\":\\\"32\\\\\\/9.25\\\",\\\"waist\\\":\\\"29\\\\\\/9.5\\\",\\\"width\\\":\\\"20\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39\\\",\\\"pancha\\\":\\\"7.5\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0686\\\\u0627\\\\u0631 \\\\u0628\\\\u0679\\\\u0646 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0634\\\\u0627\\\\u0631\\\\u0679 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u0633\\\\u06cc\\\\u062f\\\\u06be\\\\u0627 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_chak_patti\\\":\\\"\\\\u0686\\\\u0627\\\\u06a9 \\\\u067e\\\\u0679\\\\u06cc \\\\u06a9\\\\u0627\\\\u062c\\\",\\\"style_daman\\\":\\\"\\\\u06af\\\\u06be\\\\u06cc\\\\u0631\\\\u0627 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_patty_width\\\":\\\"1\\\",\\\"style_patty_length\\\":\\\"11.25\\\",\\\"style_collar_width\\\":\\\"2\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-08T06:37:42.000000Z\",\"updated_at\":\"2025-12-08T06:37:42.000000Z\"}', NULL, 'completed', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-08 06:38:53', '2025-12-08 09:09:11'),
(69, 60, 'TR Type', NULL, 2000.00, 4, NULL, NULL, 'pending', NULL, NULL, 8000.00, NULL, NULL, NULL, NULL, '2025-12-08 10:46:12', '2025-12-08 10:46:12'),
(70, 61, 'Local', NULL, 2000.00, 1, NULL, NULL, 'pending', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-10 10:13:09', '2025-12-10 10:13:09'),
(71, 62, 'Qiza', NULL, 2000.00, 1, NULL, NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-10 10:35:53', '2025-12-13 12:26:02'),
(72, 63, 'Qiza', NULL, 2000.00, 1, '{\"id\":60,\"customer_id\":60,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"46\\\",\\\"shoulder\\\":\\\"21\\\\\\/D2.5\\\",\\\"sleeve\\\":\\\"23.5\\\",\\\"collar\\\":\\\"17\\\",\\\"width\\\":\\\"28\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"42\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-10T10:37:53.000000Z\",\"updated_at\":\"2025-12-10T10:37:53.000000Z\"}', NULL, 'completed', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-10 10:38:24', '2025-12-13 09:31:03'),
(73, 64, 'Lcal', NULL, 2000.00, 1, '{\"id\":61,\"customer_id\":61,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"19.5\\\\\\/D2.5\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"17.5\\\",\\\"width\\\":\\\"29\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39LL\\\",\\\"pancha\\\":\\\"10\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-10T10:41:45.000000Z\",\"updated_at\":\"2025-12-10T10:41:45.000000Z\"}', NULL, 'completed', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-10 10:42:13', '2025-12-10 10:50:30'),
(74, 65, 'TR Simple', NULL, 2000.00, 1, NULL, NULL, 'completed', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-10 11:08:43', '2025-12-14 05:23:01'),
(75, 66, 'Local', NULL, 2000.00, 1, '{\"id\":63,\"customer_id\":63,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"39.5\\\",\\\"shoulder\\\":\\\"17\\\",\\\"sleeve\\\":\\\"22.5\\\\\\/f\\\",\\\"collar\\\":\\\"14.5\\\",\\\"chest\\\":\\\"37.5\\\",\\\"waist\\\":\\\"35\\\",\\\"width\\\":\\\"22.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39\\\",\\\"pancha\\\":\\\"8\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_chak_patti\\\":\\\"\\\\u0686\\\\u0627\\\\u06a9 \\\\u067e\\\\u0679\\\\u06cc \\\\u06a9\\\\u0627\\\\u062c\\\",\\\"style_daman\\\":\\\"\\\\u06af\\\\u06be\\\\u06cc\\\\u0631\\\\u0627 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_patty_width\\\":\\\"1\\\",\\\"style_patty_length\\\":\\\"12\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-10T12:30:17.000000Z\",\"updated_at\":\"2025-12-10T12:30:17.000000Z\"}', NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-10 12:31:43', '2025-12-10 12:39:35'),
(76, 67, 'Gray', NULL, 4000.00, 1, '{\"id\":63,\"customer_id\":63,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"39.5\\\",\\\"shoulder\\\":\\\"17\\\",\\\"sleeve\\\":\\\"22.5\\\\\\/f\\\",\\\"collar\\\":\\\"14.5\\\",\\\"chest\\\":\\\"37.5\\\",\\\"waist\\\":\\\"35\\\",\\\"width\\\":\\\"22.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39\\\",\\\"pancha\\\":\\\"8\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_chak_patti\\\":\\\"\\\\u0686\\\\u0627\\\\u06a9 \\\\u067e\\\\u0679\\\\u06cc \\\\u06a9\\\\u0627\\\\u062c\\\",\\\"style_daman\\\":\\\"\\\\u06af\\\\u06be\\\\u06cc\\\\u0631\\\\u0627 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_patty_width\\\":\\\"1\\\",\\\"style_patty_length\\\":\\\"12\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-10T12:30:17.000000Z\",\"updated_at\":\"2025-12-10T12:30:17.000000Z\"}', NULL, 'delivered', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-10 12:38:07', '2025-12-10 12:39:21'),
(77, 68, 'Local', NULL, 1500.00, 1, NULL, NULL, 'delivered', NULL, NULL, 1500.00, NULL, NULL, NULL, NULL, '2025-12-11 05:39:11', '2025-12-11 05:43:02'),
(78, 69, 'local', NULL, 1500.00, 1, '{\"id\":65,\"customer_id\":65,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"18.5\\\",\\\"sleeve\\\":\\\"22\\\",\\\"collar\\\":\\\"16\\\",\\\"width\\\":\\\"27.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"38\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0627\\\\u06cc\\\\u06a9 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_daman\\\":\\\"\\\\u06af\\\\u06be\\\\u06cc\\\\u0631\\\\u0627 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-11T05:41:14.000000Z\",\"updated_at\":\"2025-12-11T05:41:14.000000Z\"}', NULL, 'delivered', NULL, NULL, 1500.00, NULL, NULL, NULL, NULL, '2025-12-11 05:42:04', '2025-12-11 05:42:22'),
(79, 70, 'Local', NULL, 2000.00, 2, '{\"id\":66,\"customer_id\":66,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"37.5\\\",\\\"shoulder\\\":\\\"17.5\\\\\\/D2.5\\\",\\\"sleeve\\\":\\\"21.5\\\\\\/8.5\\\",\\\"collar\\\":\\\"13\\\",\\\"chest\\\":\\\"33\\\\\\/10\\\",\\\"waist\\\":\\\"29\\\\\\/9.5\\\",\\\"width\\\":\\\"21\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37N\\\",\\\"pancha\\\":\\\"6\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641\\\",\\\"style_front_pocket\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u0633\\\\u06cc\\\\u062f\\\\u06be\\\\u0627 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_patty_width\\\":\\\"1\\\",\\\"style_patty_length\\\":\\\"11.5\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-11T05:47:43.000000Z\",\"updated_at\":\"2025-12-11T05:47:43.000000Z\"}', NULL, 'pending', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-11 05:48:21', '2025-12-11 05:48:21'),
(80, 71, 'JNG', NULL, 1800.00, 1, '{\"id\":67,\"customer_id\":67,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"17.5\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"14\\\",\\\"chest\\\":\\\"22f\\\",\\\"width\\\":\\\"22f\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"42\\\",\\\"pancha\\\":\\\"8\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0634\\\\u0627\\\\u0631\\\\u0679 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-11T06:12:59.000000Z\",\"updated_at\":\"2025-12-11T06:12:59.000000Z\"}', NULL, 'pending', NULL, NULL, 1800.00, NULL, NULL, NULL, NULL, '2025-12-11 06:13:33', '2025-12-11 06:13:33'),
(81, 72, 'Local', NULL, 1933.00, 3, '{\"id\":68,\"customer_id\":68,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"40\\\",\\\"shoulder\\\":\\\"18\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"15\\\",\\\"width\\\":\\\"23\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39.5\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_daman\\\":\\\"\\\\u06af\\\\u06be\\\\u06cc\\\\u0631\\\\u0627 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-11T06:17:07.000000Z\",\"updated_at\":\"2025-12-11T06:17:07.000000Z\"}', NULL, 'delivered', NULL, NULL, 5799.00, NULL, NULL, NULL, NULL, '2025-12-11 06:18:32', '2025-12-11 06:18:46'),
(82, 73, 'Imported', NULL, 2000.00, 2, NULL, NULL, 'completed', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-11 07:08:21', '2025-12-15 11:00:21'),
(83, 74, 'Bannu Wool', NULL, 2000.00, 1, '{\"id\":69,\"customer_id\":69,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"414.5\\\",\\\"shoulder\\\":\\\"19\\\",\\\"sleeve\\\":\\\"23.5\\\",\\\"collar\\\":\\\"15.5\\\",\\\"width\\\":\\\"26f\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0627\\\\u06cc\\\\u06a9 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-11T07:12:10.000000Z\",\"updated_at\":\"2025-12-11T07:12:10.000000Z\"}', NULL, 'pending', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-11 07:14:16', '2025-12-11 07:14:16'),
(84, 75, 'Khamta', NULL, 2000.00, 1, '{\"id\":70,\"customer_id\":70,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"40.5\\\",\\\"shoulder\\\":\\\"17\\\",\\\"sleeve\\\":\\\"21.5\\\",\\\"collar\\\":\\\"15\\\",\\\"width\\\":\\\"25.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"38\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0627\\\\u06cc\\\\u06a9 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-11T07:19:31.000000Z\",\"updated_at\":\"2025-12-11T07:19:31.000000Z\"}', NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-11 07:20:03', '2025-12-14 09:51:32'),
(85, 76, 'Khamta', NULL, 1800.00, 2, '{\"id\":71,\"customer_id\":71,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"44\\\",\\\"shoulder\\\":\\\"19\\\",\\\"sleeve\\\":\\\"25\\\",\\\"collar\\\":\\\"15.5\\\",\\\"width\\\":\\\"27\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"42\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u062f\\\\u0648 \\\\u067e\\\\u06cc\\\\u0644\\\\u0679\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-11T07:22:29.000000Z\",\"updated_at\":\"2025-12-11T07:22:29.000000Z\"}', NULL, 'pending', NULL, NULL, 3600.00, NULL, NULL, NULL, NULL, '2025-12-11 07:22:59', '2025-12-11 07:22:59'),
(86, 77, 'Local', NULL, 2000.00, 1, '{\"id\":74,\"customer_id\":74,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"41\\\",\\\"shoulder\\\":\\\"19.5\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"16\\\",\\\"width\\\":\\\"23\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39\\\",\\\"pancha\\\":\\\"8\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u0633\\\\u06cc\\\\u062f\\\\u06be\\\\u0627 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_chak_patti\\\":\\\"\\\\u0686\\\\u0627\\\\u06a9 \\\\u067e\\\\u0679\\\\u06cc \\\\u06a9\\\\u0627\\\\u062c\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-11T07:37:58.000000Z\",\"updated_at\":\"2025-12-11T07:37:58.000000Z\"}', NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-11 07:38:55', '2025-12-15 10:09:35'),
(87, 78, 'Local', NULL, 2000.00, 1, NULL, NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-11 08:46:28', '2025-12-11 08:47:10'),
(88, 79, 'Khamta', NULL, 2000.00, 1, '{\"id\":77,\"customer_id\":77,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"18.5\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"16\\\",\\\"width\\\":\\\"27N\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"41N\\\",\\\"pancha\\\":\\\"9.5\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u06a9\\\\u0631\\\\u0645 \\\\u0648\\\\u0627\\\\u0644\\\\u0627\\\",\\\"style_daman\\\":\\\"\\\\u06af\\\\u06be\\\\u06cc\\\\u0631\\\\u0627 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1\\\",\\\"style_cloth_type\\\":\\\"\\\\u0645\\\\u06a9\\\\u0645\\\\u0644 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u0633\\\\u0648\\\\u0679\\\",\\\"style_front_pocket_width\\\":\\\"5.25\\\",\\\"style_front_pocket_length\\\":\\\"5.75\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-11T09:08:47.000000Z\",\"updated_at\":\"2025-12-11T09:08:47.000000Z\"}', NULL, 'pending', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-11 09:09:18', '2025-12-11 09:09:18'),
(89, 80, 'Asco+Ajam', NULL, 2000.00, 2, '{\"id\":76,\"customer_id\":76,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"41.5\\\",\\\"shoulder\\\":\\\"20\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"17\\\",\\\"width\\\":\\\"28\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"38\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-11T08:54:20.000000Z\",\"updated_at\":\"2025-12-11T08:54:20.000000Z\"}', NULL, 'pending', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-11 09:16:02', '2025-12-11 09:16:02'),
(90, 81, 'KSG', NULL, 2000.00, 1, NULL, NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-11 11:54:52', '2025-12-11 11:55:05'),
(91, 82, 'Local', NULL, 1750.00, 2, '{\"id\":79,\"customer_id\":79,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"40\\\",\\\"shoulder\\\":\\\"18\\\",\\\"sleeve\\\":\\\"22\\\",\\\"collar\\\":\\\"15.5\\\",\\\"width\\\":\\\"28\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39\\\",\\\"pancha\\\":\\\"10\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0627\\\\u06cc\\\\u06a9 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_shalwar_jeeb\\\":\\\"\\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628 \\\\u0632\\\\u067e \\\\u0648\\\\u0627\\\\u0644\\\\u0627\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-13T09:33:21.000000Z\",\"updated_at\":\"2025-12-13T09:33:21.000000Z\"}', NULL, 'delivered', NULL, NULL, 3500.00, NULL, NULL, NULL, NULL, '2025-12-13 09:34:05', '2025-12-13 09:34:24'),
(92, 83, 'Local', NULL, 2000.00, 2, '{\"id\":80,\"customer_id\":80,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"39.5\\\",\\\"shoulder\\\":\\\"17.5\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"16\\\",\\\"width\\\":\\\"23.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37\\\",\\\"pancha\\\":\\\"8.5\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0686\\\\u0627\\\\u0631 \\\\u0628\\\\u0679\\\\u0646 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-13T09:37:04.000000Z\",\"updated_at\":\"2025-12-13T09:37:04.000000Z\"}', NULL, 'delivered', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-13 09:37:45', '2025-12-13 09:37:55'),
(93, 84, 'Impport+Local', NULL, 2000.00, 2, NULL, NULL, 'pending', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-13 09:44:58', '2025-12-13 09:44:58'),
(94, 85, 'Karachi', NULL, 2000.00, 2, '{\"id\":81,\"customer_id\":81,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42\\\",\\\"shoulder\\\":\\\"20\\\",\\\"sleeve\\\":\\\"24.5\\\",\\\"collar\\\":\\\"16\\\",\\\"width\\\":\\\"25\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39\\\\\\/24\\\\\\/22\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u0633\\\\u06cc\\\\u062f\\\\u06be\\\\u0627 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_chak_patti\\\":\\\"\\\\u0686\\\\u0627\\\\u06a9 \\\\u067e\\\\u0679\\\\u06cc \\\\u06a9\\\\u0627\\\\u062c\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_shalwar_jeeb\\\":\\\"\\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628 \\\\u0632\\\\u067e \\\\u0648\\\\u0627\\\\u0644\\\\u0627\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-13T12:23:53.000000Z\",\"updated_at\":\"2025-12-13T12:23:53.000000Z\"}', NULL, 'completed', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-13 12:24:36', '2025-12-13 12:24:54'),
(95, 86, 'kamalia Khadar', NULL, 2000.00, 1, '{\"id\":82,\"customer_id\":82,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"42.5\\\",\\\"shoulder\\\":\\\"18\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"17\\\",\\\"width\\\":\\\"25..24\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"38.5\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0627\\\\u06cc\\\\u06a9 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-14T07:53:32.000000Z\",\"updated_at\":\"2025-12-14T07:53:32.000000Z\"}', NULL, 'pending', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-14 07:55:23', '2025-12-14 07:55:23'),
(96, 87, 'qiza+bano', NULL, 2000.00, 2, NULL, NULL, 'pending', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-14 08:33:59', '2025-12-14 08:33:59'),
(97, 88, 'Grace', NULL, 2000.00, 4, NULL, NULL, 'pending', NULL, NULL, 8000.00, NULL, NULL, NULL, NULL, '2025-12-14 10:13:05', '2025-12-14 10:13:05'),
(98, 89, 'tubo', NULL, 1800.00, 1, '{\"id\":85,\"customer_id\":85,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"41\\\",\\\"shoulder\\\":\\\"22.5\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"16.5\\\",\\\"width\\\":\\\"28f\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0627\\\\u06cc\\\\u06a9 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-14T10:53:15.000000Z\",\"updated_at\":\"2025-12-14T10:53:15.000000Z\"}', NULL, 'delivered', NULL, NULL, 1800.00, NULL, NULL, NULL, NULL, '2025-12-14 10:55:19', '2025-12-14 10:55:40'),
(99, 90, 'Local', NULL, 2000.00, 1, '{\"id\":86,\"customer_id\":86,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"40.5\\\",\\\"shoulder\\\":\\\"19\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"15.5\\\",\\\"width\\\":\\\"21.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37\\\",\\\"pancha\\\":\\\"8\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-14T11:06:57.000000Z\",\"updated_at\":\"2025-12-14T11:06:57.000000Z\"}', NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-14 11:07:38', '2025-12-14 11:07:48'),
(100, 91, 'Khamta', NULL, 2000.00, 2, '{\"id\":87,\"customer_id\":87,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"41.5\\\",\\\"shoulder\\\":\\\"18\\\",\\\"sleeve\\\":\\\"23.5\\\",\\\"collar\\\":\\\"15\\\",\\\"width\\\":\\\"24\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"38\\\",\\\"pancha\\\":\\\"8.5\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_daman\\\":\\\"\\\\u06af\\\\u06be\\\\u06cc\\\\u0631\\\\u0627 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-14T11:39:48.000000Z\",\"updated_at\":\"2025-12-14T11:39:48.000000Z\"}', NULL, 'pending', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-14 11:41:04', '2025-12-14 11:41:04'),
(101, 92, 'khamta', NULL, 2000.00, 2, NULL, NULL, 'pending', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-14 11:45:15', '2025-12-14 11:45:15'),
(102, 93, 'local', NULL, 2000.00, 1, '{\"id\":74,\"customer_id\":74,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"41\\\",\\\"shoulder\\\":\\\"19.5\\\",\\\"sleeve\\\":\\\"22.5\\\",\\\"collar\\\":\\\"16\\\",\\\"width\\\":\\\"23\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39\\\",\\\"pancha\\\":\\\"8\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u0633\\\\u06cc\\\\u062f\\\\u06be\\\\u0627 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_chak_patti\\\":\\\"\\\\u0686\\\\u0627\\\\u06a9 \\\\u067e\\\\u0679\\\\u06cc \\\\u06a9\\\\u0627\\\\u062c\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-11T07:37:58.000000Z\",\"updated_at\":\"2025-12-11T07:37:58.000000Z\"}', NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-15 10:10:52', '2025-12-15 11:00:10'),
(103, 94, 'local', NULL, 2000.00, 1, '{\"id\":91,\"customer_id\":91,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"41\\\",\\\"shoulder\\\":\\\"19.5\\\",\\\"sleeve\\\":\\\"24\\\",\\\"collar\\\":\\\"16\\\",\\\"width\\\":\\\"24.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39f\\\",\\\"pancha\\\":\\\"8.5\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641\\\",\\\"style_front_pocket\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u0633\\\\u06cc\\\\u062f\\\\u06be\\\\u0627 \\\\u06a9\\\\u0641\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-15T11:47:56.000000Z\",\"updated_at\":\"2025-12-15T11:47:56.000000Z\"}', NULL, 'delivered', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-15 11:51:04', '2025-12-15 11:52:00'),
(104, 95, 'Local', NULL, 2000.00, 1, NULL, NULL, 'pending', NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, '2025-12-15 11:57:06', '2025-12-15 11:57:06'),
(105, 96, 'local', NULL, 2000.00, 2, NULL, NULL, 'pending', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-15 12:31:32', '2025-12-15 12:31:32'),
(106, 97, 'KSg 100000', NULL, 2000.00, 2, '{\"id\":12,\"customer_id\":10,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"41\\\",\\\"shoulder\\\":\\\"19\\\",\\\"sleeve\\\":\\\"22\\\",\\\"collar\\\":\\\"16.5\\\",\\\"width\\\":\\\"26\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"37.5\\\",\\\"pancha\\\":\\\"9\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_shalwar\\\":\\\"\\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-02T08:33:12.000000Z\",\"updated_at\":\"2025-12-02T08:33:12.000000Z\"}', NULL, 'pending', NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, '2025-12-15 12:51:23', '2025-12-15 12:51:23'),
(107, 97, 'KSg 1000', NULL, 5000.00, 2, '{\"id\":11,\"customer_id\":10,\"type\":\"waistcoat\",\"data\":\"{\\\"waistcoat\\\":{\\\"chest\\\":\\\"40.5\\\",\\\"waist\\\":\\\"41.5\\\",\\\"shoulder\\\":\\\"16\\\",\\\"length\\\":\\\"28\\\",\\\"buttons\\\":\\\"1\\\",\\\"style\\\":\\\"Simple\\\"}}\",\"style\":\"{\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641\\\"}\",\"notes\":\"17 Gala Bnad\",\"deleted_at\":null,\"created_at\":\"2025-12-02T08:31:44.000000Z\",\"updated_at\":\"2025-12-02T08:31:44.000000Z\"}', NULL, 'pending', NULL, NULL, 10000.00, NULL, NULL, NULL, NULL, '2025-12-15 12:51:23', '2025-12-15 12:51:23'),
(108, 98, 'randon', NULL, 1200.00, 1, '{\"id\":1,\"customer_id\":1,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"44\\\",\\\"shoulder\\\":\\\"18\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"15\\\",\\\"chest\\\":\\\"37\\\",\\\"waist\\\":\\\"34\\\",\\\"width\\\":\\\"23\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39\\\",\\\"pancha\\\":\\\"8\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u06a9\\\\u0631\\\\u0645 \\\\u0648\\\\u0627\\\\u0644\\\\u0627\\\",\\\"style_daman\\\":\\\"\\\\u06af\\\\u06be\\\\u06cc\\\\u0631\\\\u0627 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1\\\",\\\"style_shalwar_jeeb\\\":\\\"\\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628 \\\\u0632\\\\u067e \\\\u0648\\\\u0627\\\\u0644\\\\u0627\\\",\\\"style_stitching_detail\\\":\\\"\\\\u0686\\\\u0645\\\\u06a9 \\\\u062a\\\\u0627\\\\u0631 \\\\u06a9\\\\u0646\\\\u06a9\\\\u0631 \\\\u0633\\\\u0644\\\\u0627\\\\u0626\\\\u06cc\\\",\\\"style_cloth_type\\\":\\\"\\\\u0645\\\\u06a9\\\\u0645\\\\u0644 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u0633\\\\u0648\\\\u0679\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-11-27T19:12:27.000000Z\",\"updated_at\":\"2025-11-27T19:12:27.000000Z\"}', NULL, 'pending', NULL, NULL, 1200.00, NULL, NULL, NULL, NULL, '2025-12-16 02:38:45', '2025-12-16 02:38:45'),
(109, 99, 'test', NULL, 1200.00, 1, NULL, NULL, 'pending', NULL, NULL, 1200.00, NULL, NULL, NULL, NULL, '2025-12-16 02:54:03', '2025-12-16 02:54:03'),
(110, 100, 'dsf', NULL, 1200.00, 1, NULL, NULL, 'pending', NULL, NULL, 1200.00, NULL, NULL, NULL, NULL, '2025-12-16 03:07:22', '2025-12-16 03:07:22'),
(111, 103, 'redf', NULL, 1200.00, 1, NULL, NULL, 'pending', NULL, NULL, 1200.00, NULL, NULL, NULL, NULL, '2025-12-16 03:09:38', '2025-12-16 03:09:38'),
(112, 104, 'red', NULL, 1200.00, 1, NULL, NULL, 'pending', NULL, NULL, 1200.00, NULL, NULL, NULL, NULL, '2025-12-16 03:12:26', '2025-12-16 03:12:26'),
(113, 119, '123', NULL, 12.00, 1, '{\"id\":1,\"customer_id\":1,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"44\\\",\\\"shoulder\\\":\\\"18\\\",\\\"sleeve\\\":\\\"23\\\",\\\"collar\\\":\\\"15\\\",\\\"chest\\\":\\\"37\\\",\\\"waist\\\":\\\"34\\\",\\\"width\\\":\\\"23\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"39\\\",\\\"pancha\\\":\\\"8\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u06af\\\\u0644\\\\u06c1 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u06c1\\\\u0627\\\\u0641 \\\\u06af\\\\u0648\\\\u0644\\\",\\\"style_front_pocket\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u06a9\\\\u0631\\\\u0645 \\\\u0648\\\\u0627\\\\u0644\\\\u0627\\\",\\\"style_daman\\\":\\\"\\\\u06af\\\\u06be\\\\u06cc\\\\u0631\\\\u0627 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1\\\",\\\"style_shalwar_jeeb\\\":\\\"\\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631 \\\\u062c\\\\u06cc\\\\u0628 \\\\u0632\\\\u067e \\\\u0648\\\\u0627\\\\u0644\\\\u0627\\\",\\\"style_stitching_detail\\\":\\\"\\\\u0686\\\\u0645\\\\u06a9 \\\\u062a\\\\u0627\\\\u0631 \\\\u06a9\\\\u0646\\\\u06a9\\\\u0631 \\\\u0633\\\\u0644\\\\u0627\\\\u0626\\\\u06cc\\\",\\\"style_cloth_type\\\":\\\"\\\\u0645\\\\u06a9\\\\u0645\\\\u0644 \\\\u0633\\\\u0627\\\\u062f\\\\u06c1 \\\\u0633\\\\u0648\\\\u0679\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-11-27T19:12:27.000000Z\",\"updated_at\":\"2025-11-27T19:12:27.000000Z\"}', NULL, 'pending', NULL, NULL, 12.00, NULL, NULL, NULL, NULL, '2025-12-16 04:05:26', '2025-12-16 04:05:26'),
(114, 120, 'adfs', NULL, 1200.00, 1, NULL, NULL, 'pending', NULL, NULL, 1200.00, NULL, NULL, NULL, NULL, '2025-12-16 04:07:11', '2025-12-16 04:07:11'),
(115, 121, 'red', NULL, 1000.00, 1, NULL, NULL, 'pending', NULL, NULL, 1000.00, NULL, NULL, NULL, NULL, '2025-12-16 04:14:30', '2025-12-16 04:14:30'),
(116, 122, 'red', NULL, 1000.00, 1, NULL, NULL, 'pending', NULL, NULL, 1000.00, NULL, NULL, NULL, NULL, '2025-12-16 04:14:31', '2025-12-16 04:14:31'),
(117, 123, '321', NULL, 2431.00, 1, '{\"id\":94,\"customer_id\":14,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"12\\\",\\\"shoulder\\\":\\\"12\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"21\\\",\\\"pancha\\\":\\\"2\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u067e\\\\u0627\\\\u0646\\\\u0686 \\\\u0628\\\\u0679\\\\u0646\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-15T15:13:54.000000Z\",\"updated_at\":\"2025-12-15T15:13:54.000000Z\"}', NULL, 'pending', NULL, NULL, 2431.00, NULL, NULL, NULL, NULL, '2025-12-16 04:15:19', '2025-12-16 04:15:19'),
(118, 124, 'red', NULL, 100.00, 1, '{\"id\":94,\"customer_id\":14,\"type\":\"kameez_shalwar\",\"data\":\"{\\\"kameez\\\":{\\\"length\\\":\\\"12\\\",\\\"shoulder\\\":\\\"12\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"21\\\",\\\"pancha\\\":\\\"2\\\"}}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u067e\\\\u0627\\\\u0646\\\\u0686 \\\\u0628\\\\u0679\\\\u0646\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-15T15:13:54.000000Z\",\"updated_at\":\"2025-12-15T15:13:54.000000Z\"}', NULL, 'pending', NULL, NULL, 100.00, NULL, NULL, NULL, NULL, '2025-12-16 06:55:40', '2025-12-16 06:55:40'),
(119, 125, 'red', NULL, 100.00, 1, '{\"id\":94,\"customer_id\":14,\"type\":\"kameez_shalwar\",\"data\":\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"12\\\",\\n        \\\"shoulder\\\": \\\"12\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"21\\\",\\n        \\\"pancha\\\": \\\"2\\\"\\n    }\\n}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u067e\\\\u0627\\\\u0646\\\\u0686 \\\\u0628\\\\u0679\\\\u0646\\\",\\\"style_patty_width\\\":\\\"10\\\",\\\"style_patty_length\\\":\\\"12\\\"}\",\"notes\":null,\"deleted_at\":null,\"created_at\":\"2025-12-15T15:13:54.000000Z\",\"updated_at\":\"2025-12-15T17:56:20.000000Z\"}', NULL, 'pending', NULL, NULL, 100.00, NULL, NULL, NULL, NULL, '2025-12-16 06:57:13', '2025-12-16 06:57:13'),
(120, 126, 'red', NULL, 100.00, 1, NULL, NULL, 'pending', NULL, NULL, 100.00, NULL, NULL, NULL, NULL, '2025-12-16 06:58:35', '2025-12-16 06:58:35'),
(121, 127, 'ewqr', NULL, 1111.00, 1, NULL, NULL, 'pending', NULL, NULL, 1111.00, NULL, NULL, NULL, NULL, '2025-12-16 07:06:56', '2025-12-16 07:06:56');
INSERT INTO `sewing_order_items` (`id`, `sewing_order_id`, `product_name`, `color`, `sewing_price`, `qty`, `customer_measurement`, `assign_note`, `status`, `delivered_date`, `cancelled_date`, `total_price`, `cancelled_at`, `cancelled_by`, `cancellation_reason`, `deleted_at`, `created_at`, `updated_at`) VALUES
(122, 128, 'adsf', NULL, 1111.00, 1, '\"{\\\"id\\\":16,\\\"customer_id\\\":14,\\\"type\\\":\\\"kameez_shalwar\\\",\\\"data\\\":\\\"{\\\\n    \\\\\\\"kameez\\\\\\\": {\\\\n        \\\\\\\"length\\\\\\\": \\\\\\\"36.5\\\\\\\",\\\\n        \\\\\\\"shoulder\\\\\\\": \\\\\\\"15.5\\\\\\\",\\\\n        \\\\\\\"sleeve\\\\\\\": \\\\\\\"20.5\\\\\\\",\\\\n        \\\\\\\"collar\\\\\\\": \\\\\\\"12.5\\\\\\\",\\\\n        \\\\\\\"chest\\\\\\\": \\\\\\\"28.5\\\\\\\",\\\\n        \\\\\\\"waist\\\\\\\": \\\\\\\"26\\\\\\\",\\\\n        \\\\\\\"width\\\\\\\": \\\\\\\"19.5\\\\\\\"\\\\n    },\\\\n    \\\\\\\"shalwar\\\\\\\": {\\\\n        \\\\\\\"length\\\\\\\": \\\\\\\"35\\\\\\\",\\\\n        \\\\\\\"pancha\\\\\\\": \\\\\\\"7.5\\\\\\\"\\\\n    }\\\\n}\\\",\\\"style\\\":\\\"{\\\\\\\"style_patty\\\\\\\":\\\\\\\"\\\\\\\\u0639\\\\\\\\u0627\\\\\\\\u0645 \\\\\\\\u067e\\\\\\\\u0679\\\\\\\\u06cc\\\\\\\",\\\\\\\"style_collar\\\\\\\":\\\\\\\"\\\\\\\\u0634\\\\\\\\u0627\\\\\\\\u0631\\\\\\\\u0679 \\\\\\\\u06a9\\\\\\\\u0627\\\\\\\\u0644\\\\\\\\u0631\\\\\\\",\\\\\\\"style_front_pocket\\\\\\\":\\\\\\\"\\\\\\\\u0639\\\\\\\\u0627\\\\\\\\u0645 \\\\\\\\u062c\\\\\\\\u06cc\\\\\\\\u0628\\\\\\\",\\\\\\\"style_side_pocket\\\\\\\":\\\\\\\"\\\\\\\\u0688\\\\\\\\u0628\\\\\\\\u0644 \\\\\\\\u062c\\\\\\\\u06cc\\\\\\\\u0628\\\\\\\",\\\\\\\"style_cuff\\\\\\\":\\\\\\\"\\\\\\\\u06af\\\\\\\\u0648\\\\\\\\u0644 \\\\\\\\u06a9\\\\\\\\u0641\\\\\\\",\\\\\\\"style_sleeve\\\\\\\":\\\\\\\"\\\\\\\\u0622\\\\\\\\u0633\\\\\\\\u062a\\\\\\\\u06cc\\\\\\\\u0646 \\\\\\\\u0628\\\\\\\\u063a\\\\\\\\u06cc\\\\\\\\u0631 \\\\\\\\u067e\\\\\\\\u0644\\\\\\\\u06cc\\\\\\\\u0679\\\\\\\",\\\\\\\"style_shalwar\\\\\\\":\\\\\\\"\\\\\\\\u0628\\\\\\\\u063a\\\\\\\\u06cc\\\\\\\\u0631 \\\\\\\\u06a9\\\\\\\\u0646\\\\\\\\u062f\\\\\\\\u06be\\\\\\\\u0648\\\\\\\\u06ba \\\\\\\\u0648\\\\\\\\u0627\\\\\\\\u0644\\\\\\\\u0627 \\\\\\\\u0634\\\\\\\\u0644\\\\\\\\u0648\\\\\\\\u0627\\\\\\\\u0631\\\\\\\"}\\\",\\\"notes\\\":\\\"Kaf 8\"', NULL, 'pending', NULL, NULL, 1111.00, NULL, NULL, NULL, NULL, '2025-12-16 07:07:47', '2025-12-16 07:07:47'),
(123, 129, 'asdfa', NULL, 1111.00, 1, NULL, NULL, 'pending', NULL, NULL, 1111.00, NULL, NULL, NULL, NULL, '2025-12-16 07:11:39', '2025-12-16 07:11:39'),
(124, 140, 'sdaf', NULL, 11111.00, 1, '\"{\\\"id\\\":16,\\\"customer_id\\\":14,\\\"type\\\":\\\"kameez_shalwar\\\",\\\"data\\\":{\\\"kameez\\\":{\\\"length\\\":\\\"36.5\\\",\\\"shoulder\\\":\\\"15.5\\\",\\\"sleeve\\\":\\\"20.5\\\",\\\"collar\\\":\\\"12.5\\\",\\\"chest\\\":\\\"28.5\\\",\\\"waist\\\":\\\"26\\\",\\\"width\\\":\\\"19.5\\\"},\\\"shalwar\\\":{\\\"length\\\":\\\"35\\\",\\\"pancha\\\":\\\"7.5\\\"}},\\\"style\\\":{\\\"style_patty\\\":\\\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\\\",\\\"style_collar\\\":\\\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\\\",\\\"style_cuff\\\":\\\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\\\",\\\"style_sleeve\\\":\\\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\\\",\\\"style_shalwar\\\":\\\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\\\"},\\\"notes\\\":\\\"Kaf 8\"', NULL, 'pending', NULL, NULL, 11111.00, NULL, NULL, NULL, NULL, '2025-12-16 07:24:07', '2025-12-16 07:24:07'),
(125, 147, '1243', NULL, 12111.00, 11, '{\"id\":16,\"type\":\"kameez_shalwar\",\"name\":null,\"data\":{\"kameez\":{\"length\":\"36.5\",\"shoulder\":\"15.5\",\"sleeve\":\"20.5\",\"collar\":\"12.5\",\"chest\":\"28.5\",\"waist\":\"26\",\"width\":\"19.5\"},\"shalwar\":{\"length\":\"35\",\"pancha\":\"7.5\"}},\"style\":{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"},\"notes\":\"Kaf 8\'\'\"}', NULL, 'pending', NULL, NULL, 133221.00, NULL, NULL, NULL, NULL, '2025-12-16 07:31:25', '2025-12-16 07:32:14'),
(126, 149, 'dsafads', NULL, 111.00, 1, '{\"id\":16,\"type\":\"kameez_shalwar\",\"name\":null,\"data\":{\"kameez\":{\"length\":\"36.5\",\"shoulder\":\"15.5\",\"sleeve\":\"20.5\",\"collar\":\"12.5\",\"chest\":\"28.5\",\"waist\":\"26\",\"width\":\"19.5\"},\"shalwar\":{\"length\":\"35\",\"pancha\":\"7.5\"}},\"style\":{\"style_patty\":\"\\u0639\\u0627\\u0645 \\u067e\\u0679\\u06cc\",\"style_collar\":\"\\u0634\\u0627\\u0631\\u0679 \\u06a9\\u0627\\u0644\\u0631\",\"style_front_pocket\":\"\\u0639\\u0627\\u0645 \\u062c\\u06cc\\u0628\",\"style_side_pocket\":\"\\u0688\\u0628\\u0644 \\u062c\\u06cc\\u0628\",\"style_cuff\":\"\\u06af\\u0648\\u0644 \\u06a9\\u0641\",\"style_sleeve\":\"\\u0622\\u0633\\u062a\\u06cc\\u0646 \\u0628\\u063a\\u06cc\\u0631 \\u067e\\u0644\\u06cc\\u0679\",\"style_shalwar\":\"\\u0628\\u063a\\u06cc\\u0631 \\u06a9\\u0646\\u062f\\u06be\\u0648\\u06ba \\u0648\\u0627\\u0644\\u0627 \\u0634\\u0644\\u0648\\u0627\\u0631\"},\"notes\":\"Kaf 8\'\'\"}', NULL, 'pending', NULL, NULL, 111.00, NULL, NULL, NULL, NULL, '2025-12-16 07:34:43', '2025-12-16 07:36:57'),
(127, 150, 'sadf', NULL, 1111.00, 1, NULL, NULL, 'pending', NULL, NULL, 1111.00, NULL, NULL, NULL, NULL, '2025-12-16 16:46:55', '2025-12-16 16:46:55'),
(128, 154, 'asdf', NULL, 1111.00, 1, '{\"id\":16,\"customer_id\":14,\"type\":\"kameez_shalwar\",\"data\":\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"36.5\\\",\\n        \\\"shoulder\\\": \\\"15.5\\\",\\n        \\\"sleeve\\\": \\\"20.5\\\",\\n        \\\"collar\\\": \\\"12.5\\\",\\n        \\\"chest\\\": \\\"28.5\\\",\\n        \\\"waist\\\": \\\"26\\\",\\n        \\\"width\\\": \\\"19.5\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"35\\\",\\n        \\\"pancha\\\": \\\"7.5\\\"\\n    }\\n}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0634\\\\u0627\\\\u0631\\\\u0679 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\"}\",\"notes\":\"Kaf 8\'\'\",\"deleted_at\":null,\"created_at\":\"2025-12-01T22:18:45.000000Z\",\"updated_at\":\"2025-12-15T15:06:33.000000Z\"}', NULL, 'pending', NULL, NULL, 1111.00, NULL, NULL, NULL, NULL, '2025-12-16 16:49:20', '2025-12-16 16:49:20'),
(129, 155, 'dsa fafd', NULL, 12121.00, 1, '{\"id\":16,\"customer_id\":14,\"type\":\"kameez_shalwar\",\"data\":\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"36.5\\\",\\n        \\\"shoulder\\\": \\\"15.5\\\",\\n        \\\"sleeve\\\": \\\"20.5\\\",\\n        \\\"collar\\\": \\\"12.5\\\",\\n        \\\"chest\\\": \\\"28.5\\\",\\n        \\\"waist\\\": \\\"26\\\",\\n        \\\"width\\\": \\\"19.5\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"35\\\",\\n        \\\"pancha\\\": \\\"7.5\\\"\\n    }\\n}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0634\\\\u0627\\\\u0631\\\\u0679 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_patty_width\\\":\\\"10\\\",\\\"style_patty_length\\\":\\\"12\\\",\\\"style_collar_width\\\":\\\"20\\\"}\",\"notes\":\"Kaf 8\'\'\",\"deleted_at\":null,\"created_at\":\"2025-12-01T22:18:45.000000Z\",\"updated_at\":\"2025-12-16T03:50:19.000000Z\"}', NULL, 'pending', NULL, NULL, 12121.00, NULL, NULL, NULL, NULL, '2025-12-16 16:51:08', '2025-12-16 16:51:08'),
(130, 156, 'safdsaf', NULL, 1111.00, 1, '{\"id\":16,\"customer_id\":14,\"type\":\"kameez_shalwar\",\"data\":\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"36.5\\\",\\n        \\\"shoulder\\\": \\\"15.5\\\",\\n        \\\"sleeve\\\": \\\"20.5\\\",\\n        \\\"collar\\\": \\\"12.5\\\",\\n        \\\"chest\\\": \\\"28.5\\\",\\n        \\\"waist\\\": \\\"26\\\",\\n        \\\"width\\\": \\\"19.5\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"35\\\",\\n        \\\"pancha\\\": \\\"7.5\\\"\\n    }\\n}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0634\\\\u0627\\\\u0631\\\\u0679 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_patty_width\\\":\\\"10\\\",\\\"style_patty_length\\\":\\\"12\\\",\\\"style_collar_width\\\":\\\"20\\\"}\",\"notes\":\"Kaf 8\'\'\",\"deleted_at\":null,\"created_at\":\"2025-12-01T22:18:45.000000Z\",\"updated_at\":\"2025-12-16T03:50:19.000000Z\"}', NULL, 'pending', NULL, NULL, 1111.00, NULL, NULL, NULL, NULL, '2025-12-16 19:28:38', '2025-12-16 19:28:38'),
(131, 157, 'asdf', NULL, 1111.00, 1, '{\"id\":16,\"customer_id\":14,\"type\":\"kameez_shalwar\",\"data\":\"{\\n    \\\"kameez\\\": {\\n        \\\"length\\\": \\\"36.5\\\",\\n        \\\"shoulder\\\": \\\"15.5\\\",\\n        \\\"sleeve\\\": \\\"20.5\\\",\\n        \\\"collar\\\": \\\"12.5\\\",\\n        \\\"chest\\\": \\\"28.5\\\",\\n        \\\"waist\\\": \\\"26\\\",\\n        \\\"width\\\": \\\"19.5\\\"\\n    },\\n    \\\"shalwar\\\": {\\n        \\\"length\\\": \\\"35\\\",\\n        \\\"pancha\\\": \\\"7.5\\\"\\n    }\\n}\",\"style\":\"{\\\"style_patty\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u067e\\\\u0679\\\\u06cc\\\",\\\"style_collar\\\":\\\"\\\\u0634\\\\u0627\\\\u0631\\\\u0679 \\\\u06a9\\\\u0627\\\\u0644\\\\u0631\\\",\\\"style_front_pocket\\\":\\\"\\\\u0639\\\\u0627\\\\u0645 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_side_pocket\\\":\\\"\\\\u0688\\\\u0628\\\\u0644 \\\\u062c\\\\u06cc\\\\u0628\\\",\\\"style_cuff\\\":\\\"\\\\u06af\\\\u0648\\\\u0644 \\\\u06a9\\\\u0641\\\",\\\"style_sleeve\\\":\\\"\\\\u0622\\\\u0633\\\\u062a\\\\u06cc\\\\u0646 \\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u067e\\\\u0644\\\\u06cc\\\\u0679\\\",\\\"style_shalwar\\\":\\\"\\\\u0628\\\\u063a\\\\u06cc\\\\u0631 \\\\u06a9\\\\u0646\\\\u062f\\\\u06be\\\\u0648\\\\u06ba \\\\u0648\\\\u0627\\\\u0644\\\\u0627 \\\\u0634\\\\u0644\\\\u0648\\\\u0627\\\\u0631\\\",\\\"style_patty_width\\\":\\\"10\\\",\\\"style_patty_length\\\":\\\"12\\\",\\\"style_collar_width\\\":\\\"20\\\"}\",\"notes\":\"Kaf 8\'\'\",\"deleted_at\":null,\"created_at\":\"2025-12-01T22:18:45.000000Z\",\"updated_at\":\"2025-12-16T03:50:19.000000Z\"}', NULL, 'pending', NULL, NULL, 1111.00, NULL, NULL, NULL, NULL, '2025-12-16 19:46:00', '2025-12-16 19:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `sewing_order_item_user`
--

CREATE TABLE `sewing_order_item_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sewing_order_item_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `worker_cost` decimal(10,2) DEFAULT 0.00,
  `status` enum('pending','on_hold','in_progress','cutter','sewing','completed') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sewing_order_item_user`
--

INSERT INTO `sewing_order_item_user` (`id`, `sewing_order_item_id`, `user_id`, `worker_cost`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 0.00, 'pending', NULL, NULL),
(2, 1, 7, 0.00, 'pending', NULL, NULL),
(3, 2, 7, 0.00, 'pending', NULL, NULL),
(4, 3, 7, 0.00, 'pending', NULL, NULL),
(5, 4, 10, 0.00, 'pending', NULL, NULL),
(6, 5, 6, 0.00, 'pending', NULL, NULL),
(7, 5, 7, 0.00, 'pending', NULL, NULL),
(8, 6, 6, 0.00, 'pending', NULL, NULL),
(9, 6, 7, 0.00, 'pending', NULL, NULL),
(10, 7, 6, 0.00, 'pending', NULL, NULL),
(11, 7, 8, 0.00, 'pending', NULL, NULL),
(12, 8, 7, 0.00, 'pending', NULL, NULL),
(13, 9, 9, 0.00, 'pending', NULL, NULL),
(14, 10, 9, 0.00, 'pending', NULL, NULL),
(15, 11, 8, 0.00, 'pending', NULL, NULL),
(16, 12, 7, 0.00, 'pending', NULL, NULL),
(17, 13, 10, 0.00, 'pending', NULL, NULL),
(18, 14, 10, 0.00, 'pending', NULL, NULL),
(19, 15, 8, 0.00, 'pending', NULL, NULL),
(20, 16, 8, 0.00, 'pending', NULL, NULL),
(21, 17, 8, 0.00, 'pending', NULL, NULL),
(22, 18, 7, 0.00, 'pending', NULL, NULL),
(23, 19, 7, 0.00, 'pending', NULL, NULL),
(24, 19, 8, 0.00, 'pending', NULL, NULL),
(25, 20, 10, 0.00, 'pending', NULL, NULL),
(26, 21, 8, 0.00, 'pending', NULL, NULL),
(27, 22, 7, 0.00, 'pending', NULL, NULL),
(28, 23, 6, 0.00, 'pending', NULL, NULL),
(29, 23, 8, 0.00, 'pending', NULL, NULL),
(30, 24, 6, 0.00, 'pending', NULL, NULL),
(31, 24, 8, 0.00, 'pending', NULL, NULL),
(32, 25, 7, 0.00, 'pending', NULL, NULL),
(33, 26, 10, 0.00, 'pending', NULL, NULL),
(34, 27, 9, 0.00, 'pending', NULL, NULL),
(35, 28, 10, 0.00, 'pending', NULL, NULL),
(36, 29, 7, 0.00, 'pending', NULL, NULL),
(37, 30, 7, 0.00, 'pending', NULL, NULL),
(38, 31, 9, 0.00, 'pending', NULL, NULL),
(39, 32, 7, 0.00, 'pending', NULL, NULL),
(40, 33, 7, 0.00, 'pending', NULL, NULL),
(41, 34, 9, 0.00, 'pending', NULL, NULL),
(42, 35, 8, 0.00, 'pending', NULL, NULL),
(43, 36, 8, 0.00, 'pending', NULL, NULL),
(44, 37, 9, 0.00, 'pending', NULL, NULL),
(45, 38, 10, 0.00, 'pending', NULL, NULL),
(46, 39, 9, 0.00, 'pending', NULL, NULL),
(47, 40, 8, 0.00, 'pending', NULL, NULL),
(48, 41, 7, 0.00, 'pending', NULL, NULL),
(49, 42, 8, 0.00, 'pending', NULL, NULL),
(50, 43, 9, 0.00, 'pending', NULL, NULL),
(51, 44, 9, 0.00, 'pending', NULL, NULL),
(52, 45, 7, 0.00, 'pending', NULL, NULL),
(53, 46, 7, 0.00, 'pending', NULL, NULL),
(54, 47, 9, 0.00, 'pending', NULL, NULL),
(55, 48, 9, 0.00, 'pending', NULL, NULL),
(56, 49, 8, 0.00, 'pending', NULL, NULL),
(57, 50, 7, 0.00, 'pending', NULL, NULL),
(58, 51, 8, 0.00, 'pending', NULL, NULL),
(59, 52, 8, 0.00, 'pending', NULL, NULL),
(60, 53, 8, 0.00, 'pending', NULL, NULL),
(61, 54, 8, 0.00, 'pending', NULL, NULL),
(62, 55, 8, 0.00, 'pending', NULL, NULL),
(63, 56, 9, 0.00, 'pending', NULL, NULL),
(64, 57, 8, 0.00, 'pending', NULL, NULL),
(65, 58, 6, 0.00, 'pending', NULL, NULL),
(66, 58, 9, 0.00, 'pending', NULL, NULL),
(67, 59, 7, 0.00, 'pending', NULL, NULL),
(68, 60, 7, 0.00, 'pending', NULL, NULL),
(69, 61, 9, 0.00, 'pending', NULL, NULL),
(70, 62, 7, 0.00, 'pending', NULL, NULL),
(71, 63, 9, 0.00, 'pending', NULL, NULL),
(72, 64, 7, 0.00, 'pending', NULL, NULL),
(73, 65, 8, 0.00, 'pending', NULL, NULL),
(74, 66, 7, 0.00, 'pending', NULL, NULL),
(75, 67, 7, 0.00, 'pending', NULL, NULL),
(76, 68, 7, 0.00, 'pending', NULL, NULL),
(77, 69, 8, 0.00, 'pending', NULL, NULL),
(78, 70, 8, 0.00, 'pending', NULL, NULL),
(79, 71, 9, 0.00, 'pending', NULL, NULL),
(80, 72, 7, 0.00, 'pending', NULL, NULL),
(81, 73, 7, 0.00, 'pending', NULL, NULL),
(82, 74, 6, 0.00, 'pending', NULL, NULL),
(83, 74, 8, 0.00, 'pending', NULL, NULL),
(84, 75, 8, 0.00, 'pending', NULL, NULL),
(85, 76, 10, 0.00, 'pending', NULL, NULL),
(86, 77, 9, 0.00, 'pending', NULL, NULL),
(87, 78, 9, 0.00, 'pending', NULL, NULL),
(88, 79, 9, 0.00, 'pending', NULL, NULL),
(89, 80, 7, 0.00, 'pending', NULL, NULL),
(90, 81, 7, 0.00, 'pending', NULL, NULL),
(91, 82, 7, 0.00, 'pending', NULL, NULL),
(92, 83, 7, 0.00, 'pending', NULL, NULL),
(93, 84, 7, 0.00, 'pending', NULL, NULL),
(94, 85, 9, 0.00, 'pending', NULL, NULL),
(95, 86, 8, 0.00, 'pending', NULL, NULL),
(96, 87, 8, 0.00, 'pending', NULL, NULL),
(97, 88, 9, 0.00, 'pending', NULL, NULL),
(98, 89, 7, 0.00, 'pending', NULL, NULL),
(99, 90, 7, 0.00, 'pending', NULL, NULL),
(100, 91, 7, 0.00, 'pending', NULL, NULL),
(101, 92, 7, 0.00, 'pending', NULL, NULL),
(102, 93, 7, 0.00, 'pending', NULL, NULL),
(103, 94, 7, 0.00, 'pending', NULL, NULL),
(104, 95, 6, 0.00, 'pending', NULL, NULL),
(105, 95, 7, 0.00, 'pending', NULL, NULL),
(106, 96, 8, 0.00, 'pending', NULL, NULL),
(107, 97, 7, 0.00, 'pending', NULL, NULL),
(108, 98, 7, 0.00, 'pending', NULL, NULL),
(109, 99, 8, 0.00, 'pending', NULL, NULL),
(110, 100, 6, 0.00, 'pending', NULL, NULL),
(111, 100, 7, 0.00, 'pending', NULL, NULL),
(112, 101, 6, 0.00, 'pending', NULL, NULL),
(113, 101, 7, 0.00, 'pending', NULL, NULL),
(114, 102, 8, 0.00, 'pending', NULL, NULL),
(115, 103, 6, 0.00, 'pending', NULL, NULL),
(116, 103, 7, 0.00, 'pending', NULL, NULL),
(117, 104, 9, 0.00, 'pending', NULL, NULL),
(118, 105, 7, 0.00, 'pending', NULL, NULL),
(119, 106, 7, 0.00, 'pending', NULL, NULL),
(120, 107, 10, 0.00, 'pending', NULL, NULL),
(121, 108, 1, 0.00, 'pending', '2025-12-16 02:38:45', '2025-12-16 02:38:45'),
(122, 109, 1, 0.00, 'pending', '2025-12-16 02:54:03', '2025-12-16 02:54:03'),
(123, 110, 1, 0.00, 'pending', '2025-12-16 03:07:22', '2025-12-16 03:07:22'),
(124, 111, 1, 0.00, 'pending', '2025-12-16 03:09:38', '2025-12-16 03:09:38'),
(125, 112, 1, 0.00, 'pending', '2025-12-16 03:12:26', '2025-12-16 03:12:26'),
(126, 113, 1, 0.00, 'pending', '2025-12-16 04:05:26', '2025-12-16 04:05:26'),
(127, 114, 1, 0.00, 'pending', '2025-12-16 04:07:11', '2025-12-16 04:07:11'),
(128, 115, 1, 0.00, 'pending', '2025-12-16 04:14:30', '2025-12-16 04:14:30'),
(129, 116, 1, 0.00, 'pending', '2025-12-16 04:14:31', '2025-12-16 04:14:31'),
(130, 117, 1, 0.00, 'pending', '2025-12-16 04:15:19', '2025-12-16 04:15:19'),
(131, 118, 1, 0.00, 'pending', '2025-12-16 06:55:40', '2025-12-16 06:55:40'),
(132, 119, 1, 0.00, 'pending', '2025-12-16 06:57:13', '2025-12-16 06:57:13'),
(133, 120, 1, 0.00, 'pending', '2025-12-16 06:58:35', '2025-12-16 06:58:35'),
(134, 121, 1, 0.00, 'pending', '2025-12-16 07:06:56', '2025-12-16 07:06:56'),
(135, 122, 1, 0.00, 'pending', '2025-12-16 07:07:47', '2025-12-16 07:07:47'),
(136, 123, 1, 0.00, 'pending', '2025-12-16 07:11:39', '2025-12-16 07:11:39'),
(137, 124, 1, 0.00, 'pending', '2025-12-16 07:24:07', '2025-12-16 07:24:07'),
(138, 125, 1, 500.00, 'completed', '2025-12-16 07:31:25', '2025-12-16 19:43:12'),
(139, 126, 1, 0.00, 'pending', '2025-12-16 07:34:43', '2025-12-16 07:34:43'),
(140, 127, 1, 0.00, 'pending', '2025-12-16 16:46:55', '2025-12-16 16:46:55'),
(141, 128, 1, 0.00, 'pending', '2025-12-16 16:49:20', '2025-12-16 16:49:20'),
(142, 129, 1, 0.00, 'completed', '2025-12-16 16:51:08', '2025-12-16 19:45:15'),
(143, 130, 1, 500.00, 'completed', '2025-12-16 19:28:38', '2025-12-16 19:41:06'),
(144, 131, 1, 500.00, 'completed', '2025-12-16 19:46:00', '2025-12-16 19:58:39');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `name_prefix` varchar(191) NOT NULL,
  `is_combined` tinyint(1) NOT NULL DEFAULT 0,
  `combine` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`combine`)),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `role` varchar(191) DEFAULT NULL,
  `worker_type` varchar(191) DEFAULT NULL,
  `worker_type_id` int(11) DEFAULT NULL,
  `worker_cost` decimal(10,2) DEFAULT 0.00,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `worker_type`, `worker_type_id`, `worker_cost`, `email_verified_at`, `password`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, 'admin', 'suit maker', 3, 500.00, NULL, '$2y$12$nH/OVeOmS9s0xLypN4RmmOaPUt1cN7WjDTNVATySljFbwVbbxoO0m', NULL, NULL, '2025-11-18 06:17:00', '2025-12-16 19:26:41'),
(6, 'Shakeel', 'shakeel@gmail.com', '+92 333 0602211', NULL, 'Cutter', 1, 0.00, NULL, '$2y$12$u1xgd3GEKTUV2Ofc3NKn6.dVWpz4MgofBPp7yw9haUXDhTRdjWI3.', NULL, NULL, '2025-11-28 06:24:50', '2025-12-16 18:40:06'),
(7, 'Zubair', 'Zubair@gmail.com', '03139997356', NULL, 'wiscot maker', 2, 0.00, NULL, '$2y$12$7mlOWiClZK7dfOGvZAUjve6pU2VOeXgQYxMkpQ1db6uwsWjL0OVjK', NULL, NULL, '2025-11-28 06:25:34', '2025-12-16 18:40:23'),
(8, 'Hassan', 'hassi.khan03@gmail.com', '03139849840', NULL, 'suit maker', 3, 0.00, NULL, '$2y$12$NVDJhXnPc0BpSSpZA04k.e9DmH01CIUenxxhl058.lOiGMt8LOQ86', NULL, NULL, '2025-11-28 06:26:27', '2025-12-16 18:40:33'),
(9, 'Julaibeeb Ts', 'julaibeeb@gmail.com', '+92 318 9835368', NULL, 'suit maker', 3, 0.00, NULL, '$2y$12$ZGSX85gayfPVnY1Ha/5yTeM8eAkW3SyxbqymZ6nuA4jkoW.q3FZ66', NULL, NULL, '2025-11-28 06:27:36', '2025-12-16 18:40:42'),
(10, 'Hasnain', 'hasnain@gmail.com', '0313 6522002', NULL, 'wiscot maker', 2, 0.00, NULL, '$2y$12$3q114UPye5Oznral7mQkb.v/bXA8YXXJM4PlRry2N6C2u.s8dOOH.', NULL, NULL, '2025-11-28 06:28:34', '2025-12-16 18:40:58'),
(11, 'Akif Ullah', 'akifullah0317@gmail.com', '03176186273', NULL, 'suit maker', 3, 500.00, NULL, '$2y$12$0DGTviNF8rRK5XgnF9EQpO92wCMH.6iupTz6SZdGug.9N.89OUW0C', NULL, NULL, '2025-11-29 08:05:44', '2025-12-16 19:26:19'),
(12, 'Finn Bernard', 'fyraxelup@mailinator.com', '+1 (274) 226-9797', NULL, 'coat maker', 4, 0.00, NULL, '$2y$12$MWRau7fSs.DU6dG1qsS0COP6tOTIrjEw3xTsx2o/LZC5iqofI2Lhu', NULL, NULL, '2025-12-16 18:06:51', '2025-12-16 18:17:59');

-- --------------------------------------------------------

--
-- Table structure for table `worker_payments`
--

CREATE TABLE `worker_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `worker_id` bigint(20) UNSIGNED NOT NULL,
  `sewing_order_item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` enum('cash','online','bank_transfer','cheque') NOT NULL DEFAULT 'cash',
  `notes` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `worker_types`
--

CREATE TABLE `worker_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) NOT NULL,
  `description` varchar(191) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `worker_cost` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `worker_types`
--

INSERT INTO `worker_types` (`id`, `type`, `description`, `deleted_at`, `is_active`, `worker_cost`, `created_at`, `updated_at`) VALUES
(1, 'Cutter', NULL, NULL, 1, 300.00, '2025-12-16 17:35:09', '2025-12-16 17:54:30'),
(2, 'wiscot maker', NULL, NULL, 1, 500.00, '2025-12-16 17:55:54', '2025-12-16 17:55:54'),
(3, 'suit maker', NULL, NULL, 1, 500.00, '2025-12-16 17:56:12', '2025-12-16 17:56:12'),
(4, 'coat maker', NULL, NULL, 1, 500.00, '2025-12-16 17:56:54', '2025-12-16 17:56:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_customer_id_unique` (`customer_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fields_type_id_foreign` (`type_id`);

--
-- Indexes for table `inventory_trackings`
--
ALTER TABLE `inventory_trackings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_trackings_product_id_foreign` (`product_id`),
  ADD KEY `inventory_trackings_supplier_id_foreign` (`supplier_id`),
  ADD KEY `inventory_trackings_order_id_foreign` (`order_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `measurements_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `naaps`
--
ALTER TABLE `naaps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `naaps_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `naap_histories`
--
ALTER TABLE `naap_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `naap_histories_naap_id_foreign` (`naap_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_payable_type_payable_id_index` (`payable_type`,`payable_id`),
  ADD KEY `payments_refund_for_payment_id_foreign` (`refund_for_payment_id`),
  ADD KEY `payments_created_by_foreign` (`created_by`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sewing_orders`
--
ALTER TABLE `sewing_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sewing_orders_customer_id_foreign` (`customer_id`),
  ADD KEY `sewing_orders_cancelled_by_foreign` (`cancelled_by`);

--
-- Indexes for table `sewing_order_items`
--
ALTER TABLE `sewing_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sewing_order_items_sewing_order_id_foreign` (`sewing_order_id`),
  ADD KEY `sewing_order_items_cancelled_by_foreign` (`cancelled_by`);

--
-- Indexes for table `sewing_order_item_user`
--
ALTER TABLE `sewing_order_item_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sewing_order_item_user_sewing_order_item_id_foreign` (`sewing_order_item_id`),
  ADD KEY `sewing_order_item_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `worker_payments`
--
ALTER TABLE `worker_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `worker_payments_worker_id_foreign` (`worker_id`),
  ADD KEY `worker_payments_sewing_order_item_id_foreign` (`sewing_order_item_id`),
  ADD KEY `worker_payments_created_by_foreign` (`created_by`);

--
-- Indexes for table `worker_types`
--
ALTER TABLE `worker_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `inventory_trackings`
--
ALTER TABLE `inventory_trackings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `measurements`
--
ALTER TABLE `measurements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `naaps`
--
ALTER TABLE `naaps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `naap_histories`
--
ALTER TABLE `naap_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sewing_orders`
--
ALTER TABLE `sewing_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `sewing_order_items`
--
ALTER TABLE `sewing_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `sewing_order_item_user`
--
ALTER TABLE `sewing_order_item_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `worker_payments`
--
ALTER TABLE `worker_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `worker_types`
--
ALTER TABLE `worker_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
