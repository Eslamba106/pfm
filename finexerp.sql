-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2024 at 09:40 AM
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
-- Database: `finexerp`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`id`, `name`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Blcok A', 'BLK A', 'active', '2024-12-13 19:32:54', '2024-12-13 19:33:37'),
(2, 'Blcok B', 'BLK B', 'active', '2024-12-13 21:19:34', '2024-12-13 21:19:34');

-- --------------------------------------------------------

--
-- Table structure for table `block_management`
--

CREATE TABLE `block_management` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_management_id` bigint(20) UNSIGNED NOT NULL,
  `block_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `block_management`
--

INSERT INTO `block_management` (`id`, `property_management_id`, `block_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'active', '2024-12-22 01:29:18', '2024-12-22 01:29:18'),
(2, 1, 2, 'active', '2024-12-22 01:29:18', '2024-12-22 01:29:18'),
(3, 2, 1, 'active', '2024-12-24 19:46:34', '2024-12-24 19:46:34'),
(4, 2, 2, 'active', '2024-12-24 19:46:34', '2024-12-24 19:46:34');

-- --------------------------------------------------------

--
-- Table structure for table `business_activities`
--

CREATE TABLE `business_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `business_settings`
--

CREATE TABLE `business_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_settings`
--

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES
(1, 'language', '[{\"id\":\"1\",\"name\":\"english\",\"direction\":\"ltr\",\"code\":\"en\",\"status\":1,\"default\":true},{\"id\":\"2\",\"name\":\"arabic\",\"direction\":\"rtl\",\"code\":\"ar\",\"status\":1,\"default\":false}]', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_settings`
--

CREATE TABLE `company_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_settings`
--

INSERT INTO `company_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES
(1, 'seal_mode', 'active', NULL, NULL),
(2, 'signature_mode', 'digital', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(3) NOT NULL,
  `currency_name` varchar(255) DEFAULT NULL,
  `currency_code_en` varchar(3) DEFAULT NULL,
  `currency_code_ar` varchar(3) DEFAULT NULL,
  `currency_symbol` varchar(10) DEFAULT NULL,
  `dial_code` varchar(10) DEFAULT NULL,
  `den_val` varchar(10) DEFAULT NULL,
  `is_master` tinyint(4) NOT NULL DEFAULT 1,
  `nationality_of_owner` varchar(255) NOT NULL,
  `no_of_decimals` varchar(255) NOT NULL DEFAULT '2',
  `international_currency_code` varchar(255) DEFAULT NULL,
  `denomination_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `currency_name`, `currency_code_en`, `currency_code_ar`, `currency_symbol`, `dial_code`, `den_val`, `is_master`, `nationality_of_owner`, `no_of_decimals`, `international_currency_code`, `denomination_name`, `created_at`, `updated_at`) VALUES
(1, 'Saudi Arabia', 'SA', 'Saudi riyal', 'SAR', 'ر.س', 'ر.س', NULL, NULL, 1, 'Saudi, Saudi Arabian', '2', 'SAR', NULL, NULL, NULL),
(2, 'Bahrain', 'BH', 'Bahraini dinar', 'BHD', '.د.', '.د.ب', NULL, NULL, 1, 'Bahraini', '2', 'BHD', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `country_masters`
--

CREATE TABLE `country_masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `currency_name` varchar(255) NOT NULL,
  `currency_symbol` varchar(255) DEFAULT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL,
  `nationality_of_owner` varchar(255) NOT NULL,
  `no_of_decimals` varchar(255) NOT NULL DEFAULT '2',
  `international_currency_code` varchar(255) DEFAULT NULL,
  `denomination_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `country_masters`
--

INSERT INTO `country_masters` (`id`, `country_id`, `country_code`, `currency_name`, `currency_symbol`, `region_id`, `nationality_of_owner`, `no_of_decimals`, `international_currency_code`, `denomination_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'SA', 'Saudi riyal', 'ر.س', 1, 'Saudi, Saudi Arabian', '2', 'SAR', NULL, '2024-12-04 20:26:51', '2024-12-04 20:26:51'),
(2, 2, 'BH', 'Bahraini dinar', '.د.ب', 2, 'Bahraini', '2', 'BHD', NULL, '2024-12-04 20:32:13', '2024-12-04 20:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_request_statuses`
--

CREATE TABLE `enquiry_request_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_statuses`
--

CREATE TABLE `enquiry_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `floors`
--

CREATE TABLE `floors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `width` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `floor_no` varchar(255) DEFAULT NULL,
  `mode` varchar(255) NOT NULL DEFAULT 'single',
  `prefix` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `company_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `floors`
--

INSERT INTO `floors` (`id`, `width`, `name`, `code`, `floor_no`, `mode`, `prefix`, `status`, `company_id`, `created_at`, `updated_at`) VALUES
(1, 3, 'PRE008', 'PRE', '008', 'multiple', 'PRE', 'active', 1, '2024-12-19 04:34:42', '2024-12-19 04:53:02'),
(2, 3, 'PRE003', 'PRE', '003', 'multiple', 'PRE', 'active', 1, '2024-12-19 04:34:42', '2024-12-19 04:34:42'),
(3, 3, 'PRE004', 'PRE', '004', 'multiple', 'PRE', 'active', 1, '2024-12-19 04:34:42', '2024-12-19 04:34:42'),
(4, 3, 'PRE005', 'PRE', '005', 'multiple', 'PRE', 'active', 1, '2024-12-19 04:34:42', '2024-12-19 04:34:42'),
(6, 0, 'FLRS', 'MM55', NULL, 'single', NULL, 'active', 1, '2024-12-19 04:53:24', '2024-12-19 04:59:37');

-- --------------------------------------------------------

--
-- Table structure for table `floor_management`
--

CREATE TABLE `floor_management` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_management_id` bigint(20) UNSIGNED NOT NULL,
  `block_management_id` bigint(20) UNSIGNED NOT NULL,
  `floor_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ledgers`
--

CREATE TABLE `ledgers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `rental` tinyint(4) NOT NULL DEFAULT 0,
  `is_taxable` tinyint(4) NOT NULL DEFAULT 0,
  `vat_applicable_from` date DEFAULT NULL,
  `taxability` varchar(255) DEFAULT NULL,
  `tax_rate` double NOT NULL DEFAULT 0,
  `ledger_applicable_on` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `live_withs`
--

CREATE TABLE `live_withs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_11_28_010755_create_roles_table', 1),
(6, '2024_11_28_010809_create_sections_table', 1),
(7, '2024_11_28_010819_create_permissions_table', 1),
(8, '2024_11_30_000322_create_business_settings_table', 2),
(13, '2013_12_2_204247_create_company_settings_table', 3),
(14, '2024_11_29_200522_create_regions_table', 3),
(18, '2024_11_30_005333_create_countries_table', 4),
(19, '2024_12_02_200833_create_ledgers_table', 4),
(20, '2024_12_04_203729_create_country_masters_table', 4),
(21, '2024_12_12_202205_create_ownerships_table', 5),
(22, '2024_12_13_205751_create_property_types_table', 6),
(23, '2024_12_13_211501_create_blocks_table', 7),
(49, '2024_12_13_232820_create_floors_table', 8),
(50, '2024_12_19_043137_create_unit_descriptions_table', 8),
(51, '2024_12_19_045636_create_unit_types_table', 8),
(52, '2024_12_19_050317_create_unit_conditions_table', 8),
(53, '2024_12_19_050938_create_unit_parkings_table', 8),
(54, '2024_12_19_051528_create_views_table', 8),
(55, '2024_12_19_052400_create_business_activities_table', 8),
(56, '2024_12_19_053358_create_live_withs_table', 8),
(57, '2024_12_19_054326_create_enquiry_statuses_table', 8),
(58, '2024_12_19_054856_create_enquiry_request_statuses_table', 8),
(60, '2024_12_19_070102_create_units_table', 9),
(63, '2024_12_19_082744_create_property_management_table', 10),
(64, '2024_12_22_022038_create_block_management_table', 11),
(65, '2024_12_22_034018_create_floor_management_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `ownerships`
--

CREATE TABLE `ownerships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ownerships`
--

INSERT INTO `ownerships` (`id`, `name`, `code`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Owned', '01', 'inactive', '2024-12-13 18:49:09', '2024-12-13 18:56:21'),
(3, 'Managed', '02', 'active', '2024-12-13 19:19:41', '2024-12-13 19:19:41');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `allow` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `section_id`, `allow`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, '2024-12-22 00:43:48', '2024-12-22 00:43:48'),
(2, 2, 2, 1, '2024-12-22 00:43:48', '2024-12-22 00:43:48'),
(3, 2, 3, 1, '2024-12-22 00:43:48', '2024-12-22 00:43:48'),
(4, 2, 4, 1, '2024-12-22 00:43:48', '2024-12-22 00:43:48'),
(5, 2, 5, 1, '2024-12-22 00:43:48', '2024-12-22 00:43:48'),
(6, 2, 6, 1, '2024-12-22 00:43:48', '2024-12-22 00:43:48'),
(7, 2, 7, 1, '2024-12-22 00:43:48', '2024-12-22 00:43:48'),
(8, 2, 8, 1, '2024-12-22 00:43:48', '2024-12-22 00:43:48'),
(9, 2, 9, 1, '2024-12-22 00:43:48', '2024-12-22 00:43:48'),
(10, 2, 10, 1, '2024-12-22 00:43:48', '2024-12-22 00:43:48'),
(11, 2, 11, 1, '2024-12-22 00:43:48', '2024-12-22 00:43:48'),
(12, 2, 12, 1, '2024-12-22 00:43:48', '2024-12-22 00:43:48'),
(13, 2, 13, 1, '2024-12-22 00:43:48', '2024-12-22 00:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_management`
--

CREATE TABLE `property_management` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `ownership_id` bigint(20) UNSIGNED NOT NULL,
  `property_type_id` bigint(20) UNSIGNED NOT NULL,
  `building_no` varchar(255) DEFAULT NULL,
  `block_no` varchar(255) DEFAULT NULL,
  `road` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country_master_id` bigint(20) UNSIGNED NOT NULL,
  `established_on` date DEFAULT NULL,
  `registration_on` date DEFAULT NULL,
  `tax_no` varchar(255) DEFAULT NULL,
  `municipality_no` varchar(255) DEFAULT NULL,
  `electricity_no` varchar(255) DEFAULT NULL,
  `land_lord_name` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_no` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `dail_code_telephone` varchar(255) DEFAULT NULL,
  `dail_code_fax` varchar(255) DEFAULT NULL,
  `dail_code_mobile` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `total_area` varchar(255) DEFAULT NULL,
  `insurance_provider` varchar(255) DEFAULT NULL,
  `insurance_period_from` date DEFAULT NULL,
  `insurance_period_to` date DEFAULT NULL,
  `insurance_type` varchar(255) DEFAULT NULL,
  `insurance_policy_no` varchar(255) DEFAULT NULL,
  `insurance_holder` varchar(255) DEFAULT NULL,
  `premium_amount` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_management`
--

INSERT INTO `property_management` (`id`, `name`, `code`, `ownership_id`, `property_type_id`, `building_no`, `block_no`, `road`, `location`, `city`, `country_master_id`, `established_on`, `registration_on`, `tax_no`, `municipality_no`, `electricity_no`, `land_lord_name`, `bank_name`, `bank_no`, `contact_person`, `dail_code_telephone`, `dail_code_fax`, `dail_code_mobile`, `mobile`, `fax`, `telephone`, `email`, `total_area`, `insurance_provider`, `insurance_period_from`, `insurance_period_to`, `insurance_type`, `insurance_policy_no`, `insurance_holder`, `premium_amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ABC', 'abc', 2, 2, '1', '1', '55', 'new location', 'housten', 2, '2024-12-01', '2024-12-19', '1', '324', 'housten', 'Egypt', 'Misr Banque', '152', '+20115009801', '+20', '+20', '+20', '115009801', '115009801', '115009801', 'e@badawy.e', 'm200', 'eslam', '2024-12-01', '2025-12-31', 'eslam', '234554', '24524', '24', 'active', '2024-12-21 22:56:58', '2024-12-21 22:56:58'),
(2, 'HZ', 'HZ', 3, 2, '1', '1', '55', 'Manama', 'housten', 1, '2024-12-17', '2024-12-25', '1', '324', 'housten', 'Egypt', 'Misr Banque', '152', 'eslam badawy', '+20', '+20', '+20', '115009801', '115009801', '115009801', 'e@badawy.e', 'm200', 'eslam', '2024-12-01', '2025-12-01', 'eslam', '234554', '24524', '24', 'active', '2024-12-24 19:46:20', '2024-12-24 19:46:20');

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `name`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Resedential', '01', 'inactive', '2024-12-13 19:10:54', '2024-12-13 19:11:34'),
(2, 'Commercial', '02', 'active', '2024-12-13 19:20:46', '2024-12-13 19:20:46');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Asia Pacific', 'AP', 'active', NULL, NULL),
(2, 'Middle East', 'MEA', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `caption` varchar(64) NOT NULL,
  `users_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `caption`, `users_count`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, 'user', 'User role', 0, 0, '2024-12-22 00:58:01', '2024-12-22 00:58:01'),
(2, 'admin', 'Admin role', 0, 1, '2024-12-22 00:58:01', '2024-12-22 00:58:01');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `section_group_id` int(10) UNSIGNED DEFAULT NULL,
  `caption` varchar(128) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `section_group_id`, `caption`, `created_at`, `updated_at`) VALUES
(1, 'admin_general_dashboard', NULL, 'General_Dashboard', '2024-12-22 00:41:58', '2024-12-22 00:41:58'),
(2, 'admin_general_dashboard_show', 1, 'General_Dashboard_page', '2024-12-22 00:41:58', '2024-12-22 00:41:58'),
(3, 'admin_roles', NULL, 'admin_roles', '2024-12-22 00:41:58', '2024-12-22 00:41:58'),
(4, 'show_admin_roles', 3, 'show_admin_roles', '2024-12-22 00:41:58', '2024-12-22 00:41:58'),
(5, 'create_admin_roles', 3, 'create_admin_roles', '2024-12-22 00:41:59', '2024-12-22 00:41:59'),
(6, 'edit_admin_roles', 3, 'edit_admin_roles', '2024-12-22 00:41:59', '2024-12-22 00:41:59'),
(7, 'update_admin_roles', 3, 'update_admin_roles', '2024-12-22 00:41:59', '2024-12-22 00:41:59'),
(8, 'delete_admin_roles', 3, 'delete_admin_roles', '2024-12-22 00:41:59', '2024-12-22 00:41:59'),
(9, 'user_management', NULL, 'user_management', '2024-12-22 00:41:59', '2024-12-22 00:41:59'),
(10, 'all_users', 9, 'show_all_users', '2024-12-22 00:41:59', '2024-12-22 00:41:59'),
(11, 'change_users_role', 9, 'change_users_role', '2024-12-22 00:41:59', '2024-12-22 00:41:59'),
(12, 'change_users_status', 9, 'change_users_status', '2024-12-22 00:41:59', '2024-12-22 00:41:59'),
(13, 'delete_user', 9, 'delete_user', '2024-12-22 00:41:59', '2024-12-22 00:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `width` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `unit_no` varchar(255) DEFAULT NULL,
  `mode` varchar(255) NOT NULL DEFAULT 'single',
  `prefix` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `company_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `width`, `name`, `code`, `unit_no`, `mode`, `prefix`, `status`, `company_id`, `created_at`, `updated_at`) VALUES
(2, 3, 'UNI004', 'UNI', '004', 'multiple', 'UNI', 'active', 1, '2024-12-19 05:21:08', '2024-12-19 05:21:08'),
(3, 3, 'UNI005', 'UNI', '005', 'multiple', 'UNI', 'active', 1, '2024-12-19 05:21:08', '2024-12-19 05:21:08'),
(4, 3, 'UNI006', 'UNI', '006', 'multiple', 'UNI', 'active', 1, '2024-12-19 05:21:08', '2024-12-19 05:21:08'),
(5, 3, 'UNI007', 'UNI', '007', 'multiple', 'UNI', 'active', 1, '2024-12-19 05:21:08', '2024-12-19 05:21:08');

-- --------------------------------------------------------

--
-- Table structure for table `unit_conditions`
--

CREATE TABLE `unit_conditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_descriptions`
--

CREATE TABLE `unit_descriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_parkings`
--

CREATE TABLE `unit_parkings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_types`
--

CREATE TABLE `unit_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_name` varchar(64) NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `countryName` varchar(255) DEFAULT NULL,
  `countryCode` varchar(50) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `currency` varchar(15) DEFAULT NULL,
  `symbol` varchar(100) DEFAULT NULL,
  `currency_code` varchar(255) DEFAULT NULL,
  `denomination` varchar(255) DEFAULT NULL,
  `decimals` varchar(255) DEFAULT NULL,
  `address1` text DEFAULT NULL,
  `address2` text DEFAULT NULL,
  `address3` text DEFAULT NULL,
  `mobile_dail_code` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `opening_time` time DEFAULT NULL,
  `closing_time` time DEFAULT NULL,
  `reg_tax_status` int(11) NOT NULL DEFAULT 0,
  `tax_reg_date` date DEFAULT NULL,
  `tax_type` int(11) NOT NULL DEFAULT 0,
  `tax_rate` double(16,2) DEFAULT NULL,
  `vat_no` varchar(150) DEFAULT NULL,
  `group_vat_no` varchar(255) DEFAULT NULL,
  `vat_tin_no` varchar(255) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `pin` varchar(50) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `fax_dail_code` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `fax` varchar(15) DEFAULT NULL,
  `phone_dail_code` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `phone` varchar(15) DEFAULT NULL,
  `logo_image` varchar(255) DEFAULT NULL,
  `signature` longtext DEFAULT NULL,
  `seal` longtext DEFAULT NULL,
  `financial_year` date DEFAULT NULL,
  `book_begining` date DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `common` tinyint(4) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `my_name` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `countryid` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `domain_code` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_name`, `password`, `role_name`, `role_id`, `countryName`, `countryCode`, `region`, `currency`, `symbol`, `currency_code`, `denomination`, `decimals`, `address1`, `address2`, `address3`, `mobile_dail_code`, `mobile`, `city`, `email`, `opening_time`, `closing_time`, `reg_tax_status`, `tax_reg_date`, `tax_type`, `tax_rate`, `vat_no`, `group_vat_no`, `vat_tin_no`, `state`, `code`, `pin`, `location`, `fax_dail_code`, `fax`, `phone_dail_code`, `phone`, `logo_image`, `signature`, `seal`, `financial_year`, `book_begining`, `status`, `common`, `email_verified_at`, `my_name`, `remember_token`, `countryid`, `domain_code`, `created_at`, `updated_at`) VALUES
(1, 'FINEX INFORMATION TECHNOLOGY W.L.L', 'admin', '$2y$10$0GiCYLqcA.LCi85zMlGXdOZSAFlMRx4FB.Ko9rO4xLg2u8ABOJk0.', 'admin', 2, 'Bahrain', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'okihn@example.org', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'active', 1, '2024-11-27 23:34:02', '12345', 'ugiEOXaJNb0uFmPVrvP3QKRDOJw0xHJrEMKW6f3pNU4RcrkF4KzBMNQFUPrp', 0, 0, '2024-11-27 23:34:02', '2024-11-27 23:34:02');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `block_management`
--
ALTER TABLE `block_management`
  ADD PRIMARY KEY (`id`),
  ADD KEY `block_management_property_management_id_foreign` (`property_management_id`),
  ADD KEY `block_management_block_id_foreign` (`block_id`);

--
-- Indexes for table `business_activities`
--
ALTER TABLE `business_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_settings`
--
ALTER TABLE `business_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_settings`
--
ALTER TABLE `company_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_code_unique` (`code`);

--
-- Indexes for table `country_masters`
--
ALTER TABLE `country_masters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_masters_country_id_foreign` (`country_id`),
  ADD KEY `country_masters_region_id_foreign` (`region_id`);

--
-- Indexes for table `enquiry_request_statuses`
--
ALTER TABLE `enquiry_request_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry_statuses`
--
ALTER TABLE `enquiry_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `floor_management`
--
ALTER TABLE `floor_management`
  ADD PRIMARY KEY (`id`),
  ADD KEY `floor_management_property_management_id_foreign` (`property_management_id`),
  ADD KEY `floor_management_block_management_id_foreign` (`block_management_id`),
  ADD KEY `floor_management_floor_id_foreign` (`floor_id`);

--
-- Indexes for table `ledgers`
--
ALTER TABLE `ledgers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_withs`
--
ALTER TABLE `live_withs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ownerships`
--
ALTER TABLE `ownerships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_role_id_foreign` (`role_id`),
  ADD KEY `permissions_section_id_foreign` (`section_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `property_management`
--
ALTER TABLE `property_management`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_management_ownership_id_foreign` (`ownership_id`),
  ADD KEY `property_management_property_type_id_foreign` (`property_type_id`),
  ADD KEY `property_management_country_master_id_foreign` (`country_master_id`);

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_conditions`
--
ALTER TABLE `unit_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_descriptions`
--
ALTER TABLE `unit_descriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_parkings`
--
ALTER TABLE `unit_parkings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_types`
--
ALTER TABLE `unit_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_user_name_unique` (`user_name`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `block_management`
--
ALTER TABLE `block_management`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `business_activities`
--
ALTER TABLE `business_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `business_settings`
--
ALTER TABLE `business_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_settings`
--
ALTER TABLE `company_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `country_masters`
--
ALTER TABLE `country_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `enquiry_request_statuses`
--
ALTER TABLE `enquiry_request_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enquiry_statuses`
--
ALTER TABLE `enquiry_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `floor_management`
--
ALTER TABLE `floor_management`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ledgers`
--
ALTER TABLE `ledgers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `live_withs`
--
ALTER TABLE `live_withs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `ownerships`
--
ALTER TABLE `ownerships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_management`
--
ALTER TABLE `property_management`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `unit_conditions`
--
ALTER TABLE `unit_conditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unit_descriptions`
--
ALTER TABLE `unit_descriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unit_parkings`
--
ALTER TABLE `unit_parkings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unit_types`
--
ALTER TABLE `unit_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `block_management`
--
ALTER TABLE `block_management`
  ADD CONSTRAINT `block_management_block_id_foreign` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `block_management_property_management_id_foreign` FOREIGN KEY (`property_management_id`) REFERENCES `property_management` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `country_masters`
--
ALTER TABLE `country_masters`
  ADD CONSTRAINT `country_masters_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `country_masters_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `floor_management`
--
ALTER TABLE `floor_management`
  ADD CONSTRAINT `floor_management_block_management_id_foreign` FOREIGN KEY (`block_management_id`) REFERENCES `block_management` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `floor_management_floor_id_foreign` FOREIGN KEY (`floor_id`) REFERENCES `floors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `floor_management_property_management_id_foreign` FOREIGN KEY (`property_management_id`) REFERENCES `property_management` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permissions_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_management`
--
ALTER TABLE `property_management`
  ADD CONSTRAINT `property_management_country_master_id_foreign` FOREIGN KEY (`country_master_id`) REFERENCES `country_masters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_management_ownership_id_foreign` FOREIGN KEY (`ownership_id`) REFERENCES `ownerships` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_management_property_type_id_foreign` FOREIGN KEY (`property_type_id`) REFERENCES `property_types` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
