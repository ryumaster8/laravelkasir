-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Feb 2025 pada 22.40
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_0000017_create_categories_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '0001_01_01_000004_create_memberships_table', 1),
(5, '0001_01_01_000005_create_outlet_groups_table', 1),
(6, '0001_01_01_000008_create_users_table', 1),
(7, '0001_01_01_000009_create_outlets_table', 1),
(8, '2024_12_27_154013_add_foreign_keys_to_users_table', 1),
(9, '2024_12_28_055722_create_banks_table', 1),
(10, '2024_12_28_055722_create_suppliers_table', 1),
(11, '2024_12_28_055723_create_wholesale_customers_table', 1),
(12, '2024_12_28_060340_create_transactions_table', 1),
(13, '2024_12_28_060608_create_transaction_items_table', 1),
(14, '2024_12_28_060759_create_product_types_table', 1),
(15, '2024_12_28_061048_create_rekening_owner_table', 1),
(16, '2024_12_28_064203_create_products_table', 1),
(17, '2024_12_28_064204_create_product_serials_table', 1),
(18, '2024_12_28_064205_create_product_adjustments_table', 1),
(19, '2024_12_28_081922_create_sessions_table', 1),
(20, '2024_12_28_103247_add_product_location_feature_to_memberships_table', 1),
(21, '2024_12_28_103619_add_product_location_and_stock_audit_feature_to_memberships_table', 1),
(22, '2024_12_29_105035_add_deleted_at_to_categories_table', 1),
(23, '2024_12_29_153630_add_foreign_keys_to_outlets_table', 1),
(24, '2024_12_29_154525_add_foreign_keys_to_suppliers_table', 1),
(25, '2024_12_29_154914_add_foreign_keys_to_transactions_table', 1),
(26, '2024_12_29_155144_add_foreign_keys_to_product_types_table', 1),
(27, '2024_12_29_155402_add_foreign_keys_to_categories_table', 1),
(28, '2024_12_29_155403_add_foreign_keys_to_wholesale_customers_table', 1),
(29, '2024_12_29_160331_add_foreign_keys_to_products_table', 1),
(30, '2024_12_29_160605_add_foreign_keys_to_product_serials_table', 1),
(31, '2024_12_29_161030_add_foreign_keys_to_product_adjustments_table', 1),
(32, '2024_12_29_511000_add_foreign_keys_to_transaction_items_table', 1),
(33, '2024_12_29_853342_add_foreign_keys_to_outlet_groups_table', 1),
(34, 'drop_all_tables', 1),
(35, '2024_12_30_010741_add_password_column_to_users_table', 2),
(36, '2024_12_30_015425_drop_group_id_from_categories_table', 3),
(37, '2024_12_30_042417_create_product_images_table', 4),
(38, '2024_12_30_042605_add_outlet_id_and_user_id_to_product_images_table', 5),
(39, '2024_12_30_042418_create_product_images_table', 6),
(40, '2024_12_30_053720_create_cash_registers_table', 7),
(41, '2024_12_30_072608_add_brand_to_products_table', 8),
(42, '2024_12_30_105021_update_outlets_table', 9),
(43, '2024_12_30_155136_create_product_transits_table', 10),
(44, '2024_12_31_011027_create_payment_confirmations_table', 11),
(45, '2024_12_31_000000_empty_users_outlets_outlet_groups_tables', 12),
(46, '2024_12_31_075840_drop_current_requested_membership_name_from_outlets_table', 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1QnuUT9QXDP5OE4yey9FAKpVCWV0xYYc46S7zrzu', 58, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 Edg/132.0.0.0', 'YToyOTp7czo2OiJfdG9rZW4iO3M6NDA6ImdxQ3hLc0ZSNjVWOGZSeTc2UDZZTVd3R25UZkliVE9ZcDM2TEJXSEMiO3M6NjoiX2ZsYXNoIjthOjI6e3M6MzoibmV3IjthOjA6e31zOjM6Im9sZCI7YTowOnt9fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM4OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvb3duZXIvbWVtYmVyc2hpcCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU4O3M6MjA6Il9fY2lfbGFzdF9yZWdlbmVyYXRlIjtpOjE3MzgwNzQyMDk7czoxNjoiX2NpX3ByZXZpb3VzX3VybCI7czoyNzoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2xvZ2luIjtzOjc6InVzZXJfaWQiO2k6NTg7czo5OiJvdXRsZXRfaWQiO2k6NDk7czo4OiJ1c2VybmFtZSI7czoxMDoibWVsdmlhbm8xMiI7czo0OiJyb2xlIjtPOjIxOiJBcHBcTW9kZWxzXE1vZGVsUm9sZXMiOjMwOntzOjEzOiIAKgBjb25uZWN0aW9uIjtzOjU6Im15c3FsIjtzOjg6IgAqAHRhYmxlIjtzOjU6InJvbGVzIjtzOjEzOiIAKgBwcmltYXJ5S2V5IjtzOjc6InJvbGVfaWQiO3M6MTA6IgAqAGtleVR5cGUiO3M6MzoiaW50IjtzOjEyOiJpbmNyZW1lbnRpbmciO2I6MTtzOjc6IgAqAHdpdGgiO2E6MDp7fXM6MTI6IgAqAHdpdGhDb3VudCI7YTowOnt9czoxOToicHJldmVudHNMYXp5TG9hZGluZyI7YjowO3M6MTA6IgAqAHBlclBhZ2UiO2k6MTU7czo2OiJleGlzdHMiO2I6MTtzOjE4OiJ3YXNSZWNlbnRseUNyZWF0ZWQiO2I6MDtzOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7czoxMzoiACoAYXR0cmlidXRlcyI7YToyOntzOjc6InJvbGVfaWQiO2k6MTtzOjk6InJvbGVfbmFtZSI7czoxMDoic3VwZXJhZG1pbiI7fXM6MTE6IgAqAG9yaWdpbmFsIjthOjI6e3M6Nzoicm9sZV9pZCI7aToxO3M6OToicm9sZV9uYW1lIjtzOjEwOiJzdXBlcmFkbWluIjt9czoxMDoiACoAY2hhbmdlcyI7YTowOnt9czo4OiIAKgBjYXN0cyI7YTowOnt9czoxNzoiACoAY2xhc3NDYXN0Q2FjaGUiO2E6MDp7fXM6MjE6IgAqAGF0dHJpYnV0ZUNhc3RDYWNoZSI7YTowOnt9czoxMzoiACoAZGF0ZUZvcm1hdCI7TjtzOjEwOiIAKgBhcHBlbmRzIjthOjA6e31zOjE5OiIAKgBkaXNwYXRjaGVzRXZlbnRzIjthOjA6e31zOjE0OiIAKgBvYnNlcnZhYmxlcyI7YTowOnt9czoxMjoiACoAcmVsYXRpb25zIjthOjA6e31zOjEwOiIAKgB0b3VjaGVzIjthOjA6e31zOjEwOiJ0aW1lc3RhbXBzIjtiOjA7czoxMzoidXNlc1VuaXF1ZUlkcyI7YjowO3M6OToiACoAaGlkZGVuIjthOjA6e31zOjEwOiIAKgB2aXNpYmxlIjthOjA6e31zOjExOiIAKgBmaWxsYWJsZSI7YToxOntpOjA7czo5OiJyb2xlX25hbWUiO31zOjEwOiIAKgBndWFyZGVkIjthOjE6e2k6MDtzOjE6IioiO319czo4OiJpc19vd25lciI7aToxO3M6MjI6Im93bmVyX2Rhc2hib2FyZF9hY2Nlc3MiO2k6MTtzOjk6ImxvZ2dlZF9pbiI7aToxO3M6MTA6ImlzTG9nZ2VkSW4iO2I6MTtzOjk6ImlzX3BhcmVudCI7aToxO3M6MTE6Im91dGxldF9uYW1lIjtzOjEzOiJNZWx2aWFubyBDZWxsIjtzOjEzOiJvdXRsZXRfc3RhdHVzIjtzOjU6ImluZHVrIjtzOjg6Imdyb3VwX2lkIjtpOjM5O3M6MTY6InBhcmVudF9vdXRsZXRfaWQiO047czoxMzoibWVtYmVyc2hpcF9pZCI7aTo0O3M6MTU6Im1lbWJlcnNoaXBfbmFtZSI7czo0OiJHb2xkIjtzOjEyOiJqZW5pc19vdXRsZXQiO3M6MTY6IktvbnRlciBIYW5kcGhvbmUiO3M6ODoiYWRtaW5faWQiO2k6NTg7czoxMjoiYnJhbmNoX2xpbWl0IjtpOjU7czoyMzoiZGFpbHlfdHJhbnNhY3Rpb25fbGltaXQiO2k6NTAwO3M6Mjg6ImRhaWx5X3Byb2R1Y3RfYWRkaXRpb25fbGltaXQiO2k6NTAwO3M6MTA6InVzZXJfbGltaXQiO2k6MjU7czoxMToicGVybWlzc2lvbnMiO2E6MDp7fXM6MTU6Im91dGxldF9ncm91cF9pZCI7aTozOTt9', 1738075060),
('yPDjgrO7j03ZECdxSXakpUN0qHuUwkGu1bxJTmM4', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 Edg/132.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR1ZuODFGNFBuOVRHSnB1OTJybGMxS3dsS1lNZ2d1VGR5RjVjeVJJSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9vd25lci9kYXRhYmFzZS9leHBvcnQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1738424424);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `role_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'superadmin'),
(2, 'admin'),
(3, 'user'),
(4, 'owner');

-- --------------------------------------------------------

--
-- Struktur dari tabel `memberships`
--

DROP TABLE IF EXISTS `memberships`;
CREATE TABLE `memberships` (
  `membership_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `membership_name` varchar(255) DEFAULT NULL,
  `features` text NOT NULL,
  `branch_limit` int(10) unsigned NOT NULL DEFAULT 0,
  `daily_transaction_limit` int(10) unsigned NOT NULL DEFAULT 0,
  `daily_product_addition_limit` int(10) unsigned NOT NULL DEFAULT 0,
  `user_limit` int(10) unsigned NOT NULL DEFAULT 0,
  `service_feature` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `wholesale_feature` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `service_receipt_printing` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_location_feature` varchar(255) DEFAULT NULL,
  `stock_audit_feature` varchar(255) DEFAULT NULL,
  `cashier_receipt_printing_feature` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `discount_feature` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `product_image_feature` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `low_stock_reminder_feature` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `stock_correction_feature` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `chat_feature` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `sales_report_feature` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `transaction_report_feature` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `shortcut_feature` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `custom_shortcut_feature` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `log_activity_feature` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `biaya_pendaftaran` decimal(10,2) NOT NULL DEFAULT 0.00,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `rank` int(10) unsigned DEFAULT NULL,
  `biaya_bulanan` decimal(10,2) NOT NULL DEFAULT 0.00,
  `biaya_upgrade` decimal(10,2) NOT NULL DEFAULT 0.00,
  `biaya_downgrade` decimal(10,2) NOT NULL DEFAULT 0.00,
  `customer_contact_feature` tinyint(3) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`membership_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `memberships`
--

INSERT INTO `memberships` (`membership_id`, `membership_name`, `features`, `branch_limit`, `daily_transaction_limit`, `daily_product_addition_limit`, `user_limit`, `service_feature`, `wholesale_feature`, `service_receipt_printing`, `created_at`, `updated_at`, `product_location_feature`, `stock_audit_feature`, `cashier_receipt_printing_feature`, `discount_feature`, `product_image_feature`, `low_stock_reminder_feature`, `stock_correction_feature`, `chat_feature`, `sales_report_feature`, `transaction_report_feature`, `shortcut_feature`, `custom_shortcut_feature`, `log_activity_feature`, `biaya_pendaftaran`, `is_active`, `rank`, `biaya_bulanan`, `biaya_upgrade`, `biaya_downgrade`, `customer_contact_feature`) VALUES
(1, 'Free', 'asa', 0, 50, 10, 1, 0, 0, 0, '2024-10-25 21:36:19', '2025-01-13 15:12:14', '0', '0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0.00', 0, 1, '50000.00', '100000.00', '0.00', 0),
(2, 'Bronze', '', 0, 100, 25, 5, 0, 0, 0, '2024-10-25 21:36:19', '2025-01-13 14:09:01', '0', '0', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '250000.00', 1, 2, '100000.00', '200000.00', '50000.00', 0),
(3, 'Silver', '', 3, 250, 100, 15, 1, 0, 0, '2024-10-25 21:36:19', '2025-01-13 14:54:59', '0', '0', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '350000.00', 1, 3, '200000.00', '300000.00', '100000.00', 0),
(4, 'Gold', '', 5, 500, 500, 25, 1, 1, 1, '2024-10-25 21:36:19', '2025-01-13 14:55:06', '1', '0', 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 1, '500000.00', 1, 4, '500000.00', '400000.00', '250000.00', 1),
(5, 'Platinum', '', 100, 1000, 1000, 500, 1, 1, 1, '2024-10-25 21:36:19', '2025-01-13 19:48:03', '1', '1', 1, 0, 0, 1, 0, 0, 1, 1, 1, 1, 1, '2000000.00', 1, 5, '1000000.00', '500000.00', '500000.00', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `is_owner` tinyint(1) NOT NULL DEFAULT 0,
  `last_login` timestamp NULL DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'active',
  `is_parent` tinyint(1) NOT NULL DEFAULT 0,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `verification_token` varchar(100) DEFAULT NULL,
  `is_deletable` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(10) unsigned DEFAULT NULL,
  `outlet_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `fk_users_outlet_id` (`outlet_id`),
  KEY `fk_users_role_id` (`role_id`),
  CONSTRAINT `fk_users_outlet_id` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_users_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `first_name`, `last_name`, `email`, `phone_number`, `profile_photo`, `is_owner`, `last_login`, `status`, `is_parent`, `is_verified`, `verification_token`, `is_deletable`, `password`, `role_id`, `outlet_id`, `created_at`, `updated_at`) VALUES
(58, 'melviano12', NULL, NULL, 'melviano12@gmail.com', '019216891205', NULL, 1, NULL, 'active', 1, 0, NULL, 0, '$2y$12$IiJhjjzixYiwtbTFno5Ivuq2E/hPK2KWtffLF7LL2mjTAIjSsns8G', 1, 49, '2025-01-02 09:00:43', '2025-01-02 09:00:43'),
(59, 'almera12', NULL, NULL, 'almera12@gmail.com', '085789959385', NULL, 0, NULL, 'active', 0, 0, NULL, 0, '$2y$12$vjixQDlyELhG6kYFAUPBk.6SNHLoptz8YhJsghxhq52sclAK6UDgK', 3, 54, '2025-01-02 09:08:45', '2025-01-02 09:08:45'),
(60, 'indah12', NULL, NULL, 'indah12@gmail.com', 'indah12', NULL, 0, NULL, 'active', 0, 0, NULL, 0, '$2y$12$cUMoXCKKjvsxpkhL5OGDaOSxJwbxZMd2viu1ncG.EN3Nw5m.rFLpq', 2, 52, '2025-01-02 09:21:18', '2025-01-02 09:21:18'),
(62, 'almera127', NULL, NULL, 'almera126@gmail.com', '019216891208', NULL, 0, NULL, 'active', 0, 0, NULL, 0, '$2y$12$NNXNPyPTlLNzjQlB.S7TSu.HPe08eVTlyZ0tBduUqNOGBalx2I8GK', 3, 49, '2025-01-18 13:31:30', '2025-01-18 13:33:27'),
(63, 'supaijo12', NULL, NULL, 'supaijo12@gmail.com', '019216891208', NULL, 0, NULL, 'active', 1, 0, NULL, 0, '$2y$12$/PnXZGqEGIrdGdiQqsonHuIn4Hp8NYQhEwMTyLJ4sQZI42dQ0OCX2', 1, 57, '2025-01-24 09:45:50', '2025-01-27 22:56:11'),
(64, 'pairin12', NULL, NULL, 'pairin12@gmail.com', '0851455515178', NULL, 0, NULL, 'active', 0, 0, NULL, 0, '$2y$12$V3EKE7nDT1QtzhCWMYdHReF7CKGcvyUM9h6eyuIIk00kgqaybH4ca', 3, 66, '2025-01-27 13:47:39', '2025-01-27 14:37:44'),
(65, 'supinah12', NULL, NULL, 'supinah12@gmail.com', '085789959385', NULL, 0, NULL, 'active', 0, 0, NULL, 0, '$2y$12$7NsgMAMTabULxTrstpNohO4DaqmoLikFJG7bGcejOQ996B2O7ZI6.', 2, 49, '2025-01-27 13:56:08', '2025-01-27 13:56:08'),
(66, 'sarinah12', NULL, NULL, 'sarinah12@gmail.com', '019216891208', NULL, 0, NULL, 'active', 0, 0, NULL, 0, '$2y$12$AfwTToU0h9wk/jKv/Xv.8.xxJvGZlE.IAWKiNxOcSL4SXNVIlzknK', 2, 66, '2025-01-27 13:57:00', '2025-01-27 14:55:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `outlets`
--

DROP TABLE IF EXISTS `outlets`;
CREATE TABLE `outlets` (
  `outlet_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_user_id` int(10) unsigned DEFAULT NULL,
  `outlet_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact_info` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `registration_status` varchar(255) DEFAULT NULL,
  `jenis_outlet` varchar(255) DEFAULT NULL,
  `membership_id` int(10) unsigned DEFAULT NULL,
  `requested_membership_id` int(10) unsigned DEFAULT NULL,
  `default_category_id` int(10) unsigned DEFAULT NULL,
  `outlet_group_id` int(10) unsigned DEFAULT NULL,
  `status_upgrade` varchar(255) DEFAULT NULL,
  `upgrade_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `registration_date` date DEFAULT NULL,
  `activation_date` date DEFAULT NULL,
  `next_due_date` date DEFAULT NULL,
  `registration_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `monthly_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `parent_outlet_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `status` enum('induk','cabang') NOT NULL DEFAULT 'cabang',
  `membership_started_at` date DEFAULT NULL,
  `membership_expires_at` date DEFAULT NULL,
  `auto_renewal` tinyint(1) DEFAULT 0,
  `subscription_status` enum('active','expiring_soon','expired') DEFAULT 'active',
  PRIMARY KEY (`outlet_id`),
  KEY `fk_outlets_admin_user_id` (`admin_user_id`),
  KEY `fk_outlets_memberships_id` (`membership_id`),
  KEY `fk_outlets_requested_membership_id` (`requested_membership_id`),
  KEY `outlets_outlet_group_id_index` (`outlet_group_id`),
  KEY `fk_outlets_parent_outlet_id` (`parent_outlet_id`),
  KEY `idx_subscription_status` (`subscription_status`),
  KEY `idx_membership_expires_at` (`membership_expires_at`),
  CONSTRAINT `fk_outlets_admin_user_id` FOREIGN KEY (`admin_user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_outlets_group_id` FOREIGN KEY (`outlet_group_id`) REFERENCES `outlet_groups` (`outlet_group_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_outlets_memberships_id` FOREIGN KEY (`membership_id`) REFERENCES `memberships` (`membership_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_outlets_parent_outlet_id` FOREIGN KEY (`parent_outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_outlets_requested_membership_id` FOREIGN KEY (`requested_membership_id`) REFERENCES `memberships` (`membership_id`) ON DELETE SET NULL,
  CONSTRAINT `outlets_outlet_group_id_foreign` FOREIGN KEY (`outlet_group_id`) REFERENCES `outlet_groups` (`outlet_group_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `outlets`
--

INSERT INTO `outlets` (`outlet_id`, `admin_user_id`, `outlet_name`, `email`, `address`, `contact_info`, `logo`, `registration_status`, `jenis_outlet`, `membership_id`, `requested_membership_id`, `default_category_id`, `outlet_group_id`, `status_upgrade`, `upgrade_fee`, `registration_date`, `activation_date`, `next_due_date`, `registration_fee`, `monthly_fee`, `parent_outlet_id`, `created_at`, `updated_at`, `is_active`, `status`, `membership_started_at`, `membership_expires_at`, `auto_renewal`, `subscription_status`) VALUES
(49, 58, 'Melviano Cell', 'melviano12@gmail.com', 'JL.PANGERAN DIPONEGORO TASIKMALAYA JAWA BARAT', '019216891205', NULL, 'baru', 'Konter Handphone', 4, NULL, NULL, 39, NULL, '0.00', '2025-01-02', NULL, '2025-02-02', '500000.00', '200000.00', NULL, '2025-01-02 09:00:43', '2025-01-02 09:00:43', 1, 'induk', '2025-01-13', '2025-02-13', 0, 'active'),
(52, NULL, 'Almera 4 Cell', NULL, 'JL.PANGERAN DIPONEGORO TASIKMALAYA JAWA BARAT', '019216891205', NULL, NULL, 'Konter Handphone', 4, NULL, NULL, 39, NULL, '0.00', '2025-01-02', NULL, NULL, '0.00', '0.00', 49, '2025-01-02 09:05:20', '2025-01-02 09:05:20', 1, 'cabang', '2025-01-13', '2025-02-13', 0, 'active'),
(53, NULL, 'Almera 5 Cell', NULL, 'JL.PANGERAN DIPONEGORO TASIKMALAYA JAWA BARAT', '019216891205', NULL, NULL, 'Konter Handphone', 4, NULL, NULL, 39, NULL, '0.00', '2025-01-02', NULL, NULL, '0.00', '0.00', 49, '2025-01-02 09:05:29', '2025-01-02 09:05:29', 1, 'cabang', '2025-01-13', '2025-02-13', 0, 'active'),
(54, NULL, 'Almera 20 Cell', 'ryumaster8@gmail.com', 'JL.PANGERAN DIPONEGORO TASIKMALAYA JAWA BARAT', '019216891205', 'outlet-logos/TJcIDRYAwx9c4H9S50AM2cf6w3Z9Vu0EH1sQc7sg.png', NULL, 'Konter Handphone', 5, 2, NULL, 39, 'pending_downgrade', '0.00', '2025-01-02', NULL, NULL, '0.00', '0.00', 49, '2025-01-02 09:05:36', '2025-01-15 23:20:47', 1, 'cabang', '2025-01-13', '2025-02-13', 0, 'active'),
(55, NULL, 'Almera 8 Cell', NULL, 'JL.PANGERAN DIPONEGORO TASIKMALAYA JAWA BARAT', '019216891205', NULL, NULL, 'Konter Handphone', 4, NULL, NULL, 39, NULL, '0.00', '2025-01-02', NULL, NULL, '0.00', '0.00', 49, '2025-01-02 09:05:43', '2025-01-02 09:05:43', 1, 'cabang', '2025-01-13', '2025-02-13', 0, 'active'),
(56, NULL, 'Almera 3 Cell', NULL, 'JL.PANGERAN DIPONEGORO TASIKMALAYA JAWA BARAT', '019216891205', NULL, NULL, 'Konter Handphone', 4, NULL, NULL, 39, NULL, '0.00', '2025-01-02', NULL, NULL, '0.00', '0.00', 49, '2025-01-02 09:07:28', '2025-01-02 09:07:28', 1, 'cabang', '2025-01-13', '2025-02-13', 0, 'active'),
(57, 63, 'supaijo12', 'supaijo12@gmail.com', 'BREBES', '019216891208', NULL, 'baru', 'Konter Handphone', 4, NULL, NULL, 40, NULL, '0.00', '2025-01-24', NULL, '2025-02-24', '250000.00', '100000.00', NULL, '2025-01-24 09:45:50', '2025-01-27 13:31:18', 1, 'induk', NULL, NULL, 0, 'active'),
(58, NULL, 'cabang paijo 1', NULL, 'JL.PANGERAN DIPONEGORO TASIKMALAYA JAWA BARAT', '08154815141', NULL, NULL, 'Konter Handphone', 4, NULL, NULL, 40, NULL, '0.00', '2025-01-27', NULL, NULL, '0.00', '0.00', 57, '2025-01-27 13:31:43', '2025-01-27 13:31:43', 1, 'cabang', NULL, NULL, 0, 'active'),
(66, NULL, 'cabang paijo 8', NULL, 'JL.PANGERAN DIPONEGORO TASIKMALAYA JAWA BARAT', '08154815141', NULL, NULL, 'Konter Handphone', 4, NULL, NULL, 40, NULL, '0.00', '2025-01-27', NULL, NULL, '0.00', '0.00', 57, '2025-01-27 13:46:45', '2025-01-27 13:46:45', 1, 'cabang', NULL, NULL, 0, 'active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE `activity_logs` (
  `activity_log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activity_log_operator_id` int(10) unsigned NOT NULL,
  `activity_log_outlet_id` int(10) unsigned NOT NULL,
  `action` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`activity_log_id`),
  KEY `activity_log_operator_id` (`activity_log_operator_id`),
  KEY `activity_log_outlet_id` (`activity_log_outlet_id`),
  CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`activity_log_operator_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `activity_logs_ibfk_2` FOREIGN KEY (`activity_log_outlet_id`) REFERENCES `outlets` (`outlet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `activity_logs`
--

INSERT INTO `activity_logs` (`activity_log_id`, `activity_log_operator_id`, `activity_log_outlet_id`, `action`, `description`, `timestamp`) VALUES
(18, 59, 54, 'DELETE', 'Operator almera12 di outlet Almera 20 Cell menghapus penarikan kas sebesar Rp 250.000', '2025-01-17 06:28:36'),
(19, 59, 54, 'DELETE', 'Operator almera12 di outlet Almera 20 Cell menghapus log aktivitas ID #14', '2025-01-17 10:13:54'),
(20, 59, 54, 'DELETE', 'Operator almera12 di outlet Almera 20 Cell menghapus log aktivitas ID #15', '2025-01-17 10:13:58'),
(21, 59, 54, 'DELETE', 'Operator almera12 di outlet Almera 20 Cell menghapus log aktivitas ID #16', '2025-01-17 10:14:01'),
(22, 59, 54, 'DELETE', 'Operator almera12 di outlet Almera 20 Cell menghapus log aktivitas ID #17', '2025-01-17 10:14:04'),
(23, 59, 54, 'DELETE', 'Operator almera12 di outlet Almera 20 Cell menghapus penambahan kas sebesar Rp 0', '2025-01-25 14:47:41'),
(24, 59, 54, 'DELETE', 'Operator almera12 di outlet Almera 20 Cell menghapus penambahan kas sebesar Rp 0', '2025-01-25 14:47:45'),
(25, 59, 54, 'CREATE', 'Operator almera12 di outlet Almera 20 Cell menambahkan kas sebesar Rp 1.750.000', '2025-01-25 14:50:04'),
(26, 59, 54, 'CREATE', 'Operator almera12 di outlet Almera 20 Cell menambahkan kas sebesar Rp 250.000', '2025-01-25 15:09:45'),
(27, 59, 54, 'CREATE', 'Operator almera12 di outlet Almera 20 Cell melakukan penarikan kas sebesar Rp 125.000', '2025-01-25 15:28:38'),
(28, 59, 54, 'CREATE', 'Operator almera12 di outlet Almera 20 Cell melakukan penarikan kas sebesar Rp 50.000', '2025-01-25 15:37:27'),
(29, 59, 54, 'CREATE', 'Operator almera12 di outlet Almera 20 Cell melakukan penarikan kas sebesar Rp 25.000', '2025-01-25 15:40:28'),
(30, 59, 54, 'CREATE', 'Operator almera12 di outlet Almera 20 Cell menambahkan kas sebesar Rp 12.000', '2025-01-25 23:18:08'),
(31, 59, 54, 'CREATE', 'Operator almera12 di outlet Almera 20 Cell menambahkan kas sebesar Rp 250.000', '2025-01-25 23:18:51'),
(32, 59, 54, 'TAMBAH KAS', '[TAMBAH KAS] Operator: almera12 (ID: 59) | Outlet: Almera 20 Cell (ID: 54) | Melakukan tambah kas sejumlah Rp 350.000 | Keterangan: uang tambah', '2025-01-25 23:26:30'),
(33, 59, 54, 'TARIK KAS', '[TARIK KAS] Operator: almera12 (ID: 59) | Outlet: Almera 20 Cell (ID: 54) | Melakukan tarik kas sejumlah Rp 75.000 | Keterangan: tarik', '2025-01-25 23:28:39'),
(34, 59, 54, 'BUKA KAS', '[BUKA KAS] Operator: almera12 (ID: 59) | Outlet: Almera 20 Cell (ID: 54) | Melakukan buka kas sejumlah Rp 250.000 | Keterangan: awal', '2025-01-25 23:28:57'),
(35, 59, 54, 'BUKA KAS', '[BUKA KAS] Operator: almera12 (ID: 59) | Outlet: Almera 20 Cell (ID: 54) | Melakukan buka kas sejumlah Rp 250.000 | Keterangan: -', '2025-01-26 01:09:21'),
(36, 59, 54, 'TAMBAH KAS', '[TAMBAH KAS] Operator: almera12 (ID: 59) | Outlet: Almera 20 Cell (ID: 54) | Melakukan tambah kas sejumlah Rp 150.000 | Keterangan: -', '2025-01-26 01:11:09'),
(37, 59, 54, 'TARIK KAS', '[TARIK KAS] Operator: almera12 (ID: 59) | Outlet: Almera 20 Cell (ID: 54) | Melakukan tarik kas sejumlah Rp 25.000 | Keterangan: -', '2025-01-26 01:11:17'),
(38, 63, 57, 'BUKA KAS', '[BUKA KAS] Operator: supaijo12 (ID: 63) | Outlet: supaijo12 (ID: 57) | Melakukan buka kas sejumlah Rp 265.000 | Keterangan: -', '2025-01-26 03:56:16'),
(39, 63, 57, 'TAMBAH KAS', '[TAMBAH KAS] Operator: supaijo12 (ID: 63) | Outlet: supaijo12 (ID: 57) | Melakukan tambah kas sejumlah Rp 75.000 | Keterangan: -', '2025-01-26 03:56:21'),
(40, 63, 57, 'TARIK KAS', '[TARIK KAS] Operator: supaijo12 (ID: 63) | Outlet: supaijo12 (ID: 57) | Melakukan tarik kas sejumlah Rp 650.000 | Keterangan: -', '2025-01-26 03:56:28'),
(41, 63, 57, 'BUKA KAS', '[BUKA KAS] Operator: supaijo12 (ID: 63) | Outlet: supaijo12 (ID: 57) | Melakukan buka kas sejumlah Rp 250.000 | Keterangan: -', '2025-01-27 01:44:52'),
(42, 63, 57, 'TAMBAH KAS', '[TAMBAH KAS] Operator: supaijo12 (ID: 63) | Outlet: supaijo12 (ID: 57) | Melakukan tambah kas sejumlah Rp 25.000 | Keterangan: -', '2025-01-27 01:54:04'),
(43, 59, 54, 'CANCEL_TRANSFER', '[CANCEL_TRANSFER] Operator: almera12 (ID: 59) | Outlet: Almera 20 Cell (ID: 54) | Pembatalan transfer stok | Produk: Power Bank 80000 mah | Jumlah: 5 | Dari: Almera 20 Cell | Ke: Almera 4 Cell | Non-Serial', '2025-01-27 11:46:11'),
(44, 59, 54, 'TRANSFER_STOCK', '[TRANSFER_STOCK] Operator: almera12 (ID: 59) | Outlet: Almera 20 Cell (ID: 54) | Transfer stok | Produk: Power Bank 80000 mah | Jumlah: 5 pcs | Dari: Almera 20 Cell | Ke: Almera 4 Cell | Sisa Stok: 45', '2025-01-27 11:56:33'),
(45, 59, 54, 'REDUCE_STOCK', '[REDUCE_STOCK] Operator: almera12 (ID: 59) | Outlet: Almera 20 Cell (ID: 54) | Pengurangan stok | Produk: Power Bank 80000 mah | Jumlah: -5 pcs | Stok Sebelum: 45 | Stok Setelah: 40 | Operator: almera12 | Outlet: Almera 20 Cell', '2025-01-27 12:17:56'),
(46, 59, 54, 'ADD_STOCK', '[ADD_STOCK] Operator: almera12 (ID: 59) | Outlet: Almera 20 Cell (ID: 54) | Penambahan stok | Produk: Power Bank 80000 mah | Jumlah: +2 pcs | Stok Sebelum: 40 | Stok Setelah: 42 | Operator: almera12 | Outlet: Almera 20 Cell', '2025-01-27 12:25:05'),
(47, 63, 57, 'CREATE_BRANCH', 'Operator: supaijo12 (ID: 63) | Outlet: supaijo12 (ID: 57) | Menambahkan cabang baru \"cabang paijo 8\" dengan alamat \"JL.PANGERAN DIPONEGORO TASIKMALAYA JAWA BARAT\" dan kontak \"08154815141\"', '2025-01-27 13:46:45'),
(48, 63, 66, 'UPDATE_USER', 'Operator: supaijo12 (ID: 63) | Outlet: cabang paijo 8 (ID: 66) | Mengubah data pengguna: Role_id: 2 → 3', '2025-01-27 14:37:44'),
(49, 63, 66, 'UPDATE_USER', 'Operator: supaijo12 (ID: 63) | Outlet: cabang paijo 8 (ID: 66) | Mengubah data pengguna: Role: User → Admin', '2025-01-27 14:55:46'),
(50, 63, 57, 'TOGGLE_USER_STATUS', 'Operator: supaijo12 (ID: 63) | Outlet: supaijo12 (ID: 57) | Mengubah status pengguna supaijo12 dari active menjadi inactive', '2025-01-27 22:56:06'),
(51, 63, 57, 'TOGGLE_USER_STATUS', 'Operator: supaijo12 (ID: 63) | Outlet: supaijo12 (ID: 57) | Mengubah status pengguna supaijo12 dari inactive menjadi active', '2025-01-27 22:56:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `akurasi`
--

DROP TABLE IF EXISTS `akurasi`;
CREATE TABLE `akurasi` (
  `akurasi_id` int(10) NOT NULL AUTO_INCREMENT,
  `created_by` int(10) unsigned NOT NULL,
  `outlet_id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `waktu` datetime NOT NULL,
  `kas_awal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `penjualan_ecer` decimal(10,2) NOT NULL DEFAULT 0.00,
  `penarikan_kas` decimal(10,2) NOT NULL DEFAULT 0.00,
  `penambahan_kas` decimal(10,2) NOT NULL DEFAULT 0.00,
  `penjualan_grosir` decimal(10,2) NOT NULL DEFAULT 0.00,
  `kas_akhir` decimal(10,2) NOT NULL DEFAULT 0.00,
  `selisih` decimal(10,2) NOT NULL DEFAULT 0.00,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`akurasi_id`),
  KEY `fk_akurasi_created_by` (`created_by`),
  KEY `fk_akurasi_outlet_id` (`outlet_id`),
  CONSTRAINT `fk_akurasi_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_akurasi_outlet_id` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `akurasi`
--

INSERT INTO `akurasi` (`akurasi_id`, `created_by`, `outlet_id`, `date`, `waktu`, `kas_awal`, `penjualan_ecer`, `penarikan_kas`, `penambahan_kas`, `penjualan_grosir`, `kas_akhir`, `selisih`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 59, 54, '2025-01-26', '2025-01-26 02:01:22', '250000.00', '0.00', '25000.00', '150000.00', '0.00', '574000.00', '199000.00', NULL, '2025-01-26 02:01:22', '2025-01-26 02:01:22'),
(2, 59, 54, '2025-01-26', '2025-01-26 02:12:27', '250000.00', '0.00', '25000.00', '150000.00', '0.00', '574000.00', '199000.00', NULL, '2025-01-26 02:12:27', '2025-01-26 02:12:27'),
(3, 59, 54, '2025-01-26', '2025-01-26 02:13:58', '250000.00', '0.00', '25000.00', '150000.00', '0.00', '125000.00', '-250000.00', NULL, '2025-01-26 02:13:58', '2025-01-26 02:13:58'),
(4, 59, 54, '2025-01-26', '2025-01-26 02:17:21', '250000.00', '0.00', '25000.00', '150000.00', '0.00', '450000.00', '75000.00', NULL, '2025-01-26 02:17:21', '2025-01-26 02:17:21'),
(5, 59, 54, '2025-01-26', '2025-01-26 02:23:15', '250000.00', '0.00', '25000.00', '150000.00', '0.00', '165000.00', '-210000.00', NULL, '2025-01-26 02:23:15', '2025-01-26 02:23:15'),
(6, 59, 54, '2025-01-26', '2025-01-26 02:25:09', '250000.00', '0.00', '25000.00', '150000.00', '0.00', '125000.00', '-250000.00', NULL, '2025-01-26 02:25:09', '2025-01-26 02:25:09'),
(7, 59, 54, '2025-01-26', '2025-01-26 02:25:20', '250000.00', '0.00', '25000.00', '150000.00', '0.00', '200000.00', '-175000.00', NULL, '2025-01-26 02:25:20', '2025-01-26 02:25:20'),
(8, 59, 54, '2025-01-26', '2025-01-26 02:26:04', '250000.00', '0.00', '25000.00', '150000.00', '0.00', '150000.00', '-225000.00', NULL, '2025-01-26 02:26:04', '2025-01-26 02:26:04'),
(9, 59, 54, '2025-01-26', '2025-01-26 02:26:14', '250000.00', '0.00', '25000.00', '150000.00', '0.00', '150000.00', '-225000.00', NULL, '2025-01-26 02:26:14', '2025-01-26 02:26:14'),
(10, 59, 54, '2025-01-26', '2025-01-26 02:39:06', '250000.00', '0.00', '25000.00', '150000.00', '0.00', '200000.00', '-175000.00', NULL, '2025-01-26 02:39:06', '2025-01-26 02:39:06'),
(11, 59, 54, '2025-01-26', '2025-01-26 02:40:55', '250000.00', '0.00', '25000.00', '150000.00', '0.00', '165000.00', '-210000.00', NULL, '2025-01-26 02:40:55', '2025-01-26 02:40:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `banks`
--

DROP TABLE IF EXISTS `banks`;
CREATE TABLE `banks` (
  `bank_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `outlet_id` int(10) unsigned NOT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `banks`
--

INSERT INTO `banks` (`bank_id`, `outlet_id`, `bank_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 54, 'BRI', 'active', '2025-01-10 18:05:25', '2025-01-10 18:05:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cash_registers`
--

DROP TABLE IF EXISTS `cash_registers`;
CREATE TABLE `cash_registers` (
  `cash_register_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `outlet_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `opening_balance` decimal(10,2) NOT NULL,
  `closing_balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_received` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_paid_out` decimal(10,2) NOT NULL DEFAULT 0.00,
  `date` date NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` enum('open','closed') NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cash_register_id`),
  KEY `cash_registers_outlet_id_foreign` (`outlet_id`),
  KEY `cash_registers_user_id_foreign` (`user_id`),
  CONSTRAINT `cash_registers_outlet_id_foreign` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE CASCADE,
  CONSTRAINT `cash_registers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) DEFAULT NULL,
  `outlet_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  KEY `categories_outlet_id_foreign` (`outlet_id`),
  KEY `categories_user_id_foreign` (`user_id`),
  CONSTRAINT `categories_outlet_id_foreign` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE SET NULL,
  CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `outlet_id`, `user_id`, `is_default`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, 'TWS', 54, 59, 0, '2025-01-02 11:04:11', '2025-01-05 13:01:55', NULL),
(15, 'Smartphone', 54, 59, 1, '2025-01-05 17:18:14', '2025-01-05 17:18:14', NULL),
(16, 'Laptop', 54, 59, 0, '2025-01-05 17:18:14', '2025-01-05 17:18:14', NULL),
(17, 'Aksesoris Komputer', 54, 59, 0, '2025-01-05 17:18:14', '2025-01-05 17:18:14', NULL),
(18, 'Printer & Scanner', 54, 59, 0, '2025-01-05 17:18:14', '2025-01-05 17:18:14', NULL),
(19, 'Gaming', 54, 59, 0, '2025-01-05 17:18:14', '2025-01-05 17:18:14', NULL),
(20, 'Networking', 54, 59, 0, '2025-01-05 17:18:14', '2025-01-05 17:18:14', NULL),
(21, 'Smart Home', 54, 59, 0, '2025-01-05 17:18:14', '2025-01-05 17:18:14', NULL),
(22, 'Audio & Speaker', 54, 59, 0, '2025-01-05 17:18:14', '2025-01-05 17:18:14', NULL),
(23, 'Kamera & CCTV', 54, 59, 0, '2025-01-05 17:18:14', '2025-01-05 17:18:14', NULL),
(24, 'Software & Lisensi', 54, 59, 0, '2025-01-05 17:18:14', '2025-01-05 17:18:14', NULL),
(25, 'Smartphone', 54, 59, 1, '2025-01-05 17:21:01', '2025-01-05 17:21:01', NULL),
(26, 'Laptop', 54, 59, 0, '2025-01-05 17:21:01', '2025-01-05 17:21:01', NULL),
(27, 'Aksesoris Komputer', 54, 59, 0, '2025-01-05 17:21:01', '2025-01-05 17:21:01', NULL),
(28, 'Printer & Scanner', 54, 59, 0, '2025-01-05 17:21:01', '2025-01-05 17:21:01', NULL),
(29, 'Gaming', 54, 59, 0, '2025-01-05 17:21:01', '2025-01-05 17:21:01', NULL),
(30, 'Networking', 54, 59, 0, '2025-01-05 17:21:01', '2025-01-05 17:21:01', NULL),
(31, 'Smart Home', 54, 59, 0, '2025-01-05 17:21:01', '2025-01-05 17:21:01', NULL),
(32, 'Audio & Speaker', 54, 59, 0, '2025-01-05 17:21:01', '2025-01-05 17:21:01', NULL),
(33, 'Kamera & CCTV', 54, 59, 0, '2025-01-05 17:21:01', '2025-01-05 17:21:01', NULL),
(34, 'Software & Lisensi', 54, 59, 0, '2025-01-05 17:21:01', '2025-01-05 17:21:01', NULL),
(35, 'Handset', 57, 63, 0, '2025-01-26 04:00:28', '2025-01-26 04:00:28', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers` (
  `supplier_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `outlet_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `supplier_name` varchar(100) DEFAULT NULL,
  `contact_info` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`supplier_id`),
  KEY `fk_suppliers_outlet_id` (`outlet_id`),
  KEY `fk_suppliers_user_id` (`user_id`),
  CONSTRAINT `fk_suppliers_outlet_id` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_suppliers_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `outlet_id`, `user_id`, `supplier_name`, `contact_info`, `address`, `created_at`, `updated_at`, `is_default`) VALUES
(1, NULL, NULL, 'Mitra Cell', '081248759456', 'Jalan Sudirman No. 45, Kelurahan Karet, Kecamatan Setiabudi, Jakarta Selatan 12930', '2024-12-30 01:56:26', '2024-12-30 01:56:26', 0),
(2, NULL, NULL, 'Awong Cell', '085148751584', 'Jl. Tanah Abang II No. 2, Petojo Selatan, Jakarta Pusat 10160', '2024-12-30 12:04:07', '2024-12-30 12:04:07', 0),
(3, NULL, NULL, 'Ducell Supplier 1', '0851455515178', 'JL.PANGERAN DIPONEGORO TASIKMALAYA JAWA BARAT', '2024-12-31 15:24:41', '2024-12-31 15:24:41', 0),
(4, NULL, NULL, 'Ducell Supplier 2', '085148751845', 'Jl. Tanah Abang II No. 2, Petojo Selatan, Jakarta Pusat 10160', '2024-12-31 15:24:51', '2024-12-31 15:24:51', 0),
(7, 54, 59, 'Awong Cellccc', '08154481514', 'Jalan Sudirman No. 45, Kelurahan Karet, Kecamatan Setiabudi, Jakarta Selatan 12930', '2025-01-02 11:04:29', '2025-01-05 14:57:58', 0),
(9, 54, 59, 'Mitra Cell', '1815154545', 'JL.PANGERAN DIPONEGORO TASIKMALAYA JAWA BARAT', '2025-01-05 14:56:16', '2025-01-05 14:56:16', 0),
(20, 54, 59, 'PT Elektronik Maju', '081234567890', 'Jl. Elektronik No. 123, Jakarta', '2025-01-05 17:15:41', '2025-01-05 17:15:41', 1),
(21, 54, 59, 'CV Komputer Sejahtera', '081234567891', 'Jl. Komputer No. 456, Bandung', '2025-01-05 17:15:41', '2025-01-05 17:15:41', 0),
(22, 54, 59, 'UD Gadget Berkah', '081234567892', 'Jl. Gadget No. 789, Surabaya', '2025-01-05 17:15:41', '2025-01-05 17:15:41', 0),
(23, 54, 59, 'PT Network Solutions', '081234567893', 'Jl. Network No. 321, Medan', '2025-01-05 17:15:41', '2025-01-05 17:15:41', 0),
(24, 54, 59, 'CV Print & Scan', '081234567894', 'Jl. Printer No. 654, Semarang', '2025-01-05 17:15:41', '2025-01-05 17:15:41', 0),
(25, 54, 59, 'UD Gaming Pro', '081234567895', 'Jl. Gaming No. 987, Yogyakarta', '2025-01-05 17:15:41', '2025-01-05 17:15:41', 0),
(26, 54, 59, 'PT Software House', '081234567896', 'Jl. Software No. 147, Malang', '2025-01-05 17:15:41', '2025-01-05 17:15:41', 0),
(27, 54, 59, 'CV Security System', '081234567897', 'Jl. Security No. 258, Palembang', '2025-01-05 17:15:41', '2025-01-05 17:15:41', 0),
(28, 54, 59, 'UD Smart Home', '081234567898', 'Jl. Smart Home No. 369, Makassar', '2025-01-05 17:15:41', '2025-01-05 17:15:41', 0),
(29, 54, 59, 'PT Audio Visual', '081234567899', 'Jl. Audio Visual No. 741, Denpasar', '2025-01-05 17:15:41', '2025-01-05 17:15:41', 0),
(31, 54, 59, 'CV Komputer Sejahtera', '081234567891', 'Jl. Komputer No. 456, Bandung', '2025-01-05 17:24:16', '2025-01-05 17:24:16', 0),
(32, 54, 59, 'UD Gadget Berkah', '081234567892', 'Jl. Gadget No. 789, Surabaya', '2025-01-05 17:24:16', '2025-01-05 17:24:16', 0),
(33, 54, 59, 'PT Network Solutions', '081234567893', 'Jl. Network No. 321, Medan', '2025-01-05 17:24:16', '2025-01-05 17:24:16', 0),
(34, 54, 59, 'CV Print & Scan', '081234567894', 'Jl. Printer No. 654, Semarang', '2025-01-05 17:24:16', '2025-01-05 17:24:16', 0),
(35, 54, 59, 'UD Gaming Pro', '081234567895', 'Jl. Gaming No. 987, Yogyakarta', '2025-01-05 17:24:16', '2025-01-05 17:24:16', 0),
(36, 54, 59, 'PT Software House', '081234567896', 'Jl. Software No. 147, Malang', '2025-01-05 17:24:16', '2025-01-05 17:24:16', 0),
(37, 54, 59, 'CV Security System', '081234567897', 'Jl. Security No. 258, Palembang', '2025-01-05 17:24:16', '2025-01-05 17:24:16', 0),
(38, 54, 59, 'UD Smart Home', '081234567898', 'Jl. Smart Home No. 369, Makassar', '2025-01-05 17:24:16', '2025-01-05 17:24:16', 0),
(39, 54, 59, 'PT Audio Visual', '081234567899', 'Jl. Audio Visual No. 741, Denpasar', '2025-01-05 17:24:16', '2025-01-05 17:24:16', 0),
(41, 57, 63, 'Media Cell', '019216891205', 'Jl. Tanah Abang II No. 2, Petojo Selatan, Jakarta Pusat 10160', '2025-01-26 04:00:49', '2025-01-26 04:00:49', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `outlet_id` int(10) unsigned DEFAULT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `supplier_id` int(10) unsigned DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price_modal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `price_grosir` decimal(10,2) NOT NULL DEFAULT 0.00,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `unit` varchar(50) DEFAULT NULL,
  `has_serial_number` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `products_product_code_unique` (`product_code`),
  KEY `products_outlet_id_foreign` (`outlet_id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_supplier_id_foreign` (`supplier_id`),
  KEY `products_user_id_foreign` (`user_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE,
  CONSTRAINT `products_outlet_id_foreign` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE CASCADE,
  CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`) ON DELETE CASCADE,
  CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`product_id`, `outlet_id`, `category_id`, `supplier_id`, `product_name`, `brand`, `product_code`, `description`, `price_modal`, `price_grosir`, `price`, `unit`, `has_serial_number`, `user_id`, `created_at`, `updated_at`) VALUES
(14, 54, 13, 7, 'Laptop Acer V8', 'Sony', NULL, NULL, '4500000.00', '4600000.00', '5000000.00', 'pcs', 1, 60, '2025-01-02 11:07:28', '2025-01-02 15:37:11'),
(26, 54, 13, 3, 'Power Bank 80000 mah', 'XIAOM', 'BC5121556', NULL, '136000.00', '165000.00', '250000.00', 'pcs', 0, 60, '2025-01-02 15:21:05', '2025-01-02 15:48:29'),
(66, 54, 15, 20, 'iPhone 14 Pro Max', 'Apple', NULL, 'iPhone 14 Pro Max 256GB - Midnight', '15000000.00', '15500000.00', '16000000.00', 'Unit', 1, 60, '2025-01-05 17:25:58', '2025-01-05 17:25:58'),
(67, 54, 15, 20, 'Samsung Galaxy S23 Ultra', 'Samsung', NULL, 'Samsung Galaxy S23 Ultra 256GB - Phantom Black', '14000000.00', '14500000.00', '15000000.00', 'Unit', 1, 60, '2025-01-05 17:25:58', '2025-01-05 17:25:58'),
(68, 54, 16, 21, 'MacBook Pro M2', 'Apple', NULL, 'MacBook Pro M2 512GB - Space Gray', '18000000.00', '18500000.00', '19000000.00', 'Unit', 1, 60, '2025-01-05 17:25:58', '2025-01-05 17:25:58'),
(69, 54, 16, 21, 'ROG Zephyrus G14', 'ASUS', NULL, 'ASUS ROG Zephyrus G14 RTX 3060 1TB SSD', '16000000.00', '16500000.00', '17000000.00', 'Unit', 1, 60, '2025-01-05 17:25:58', '2025-01-05 17:25:58'),
(70, 54, 17, 22, 'Logitech MX Master 3S', 'Logitech', NULL, 'Logitech MX Master 3S Wireless Mouse', '1200000.00', '1300000.00', '1400000.00', 'Unit', 1, 60, '2025-01-05 17:25:58', '2025-01-05 17:25:58'),
(71, 54, 17, 22, 'Keychron K3', 'Keychron', NULL, 'Keychron K3 RGB Mechanical Keyboard', '1000000.00', '1100000.00', '1200000.00', 'Unit', 1, 60, '2025-01-05 17:25:58', '2025-01-05 17:25:58'),
(72, 54, 18, 23, 'Epson L3210', 'Epson', NULL, 'Epson EcoTank L3210 All-in-One Printer', '2000000.00', '2100000.00', '2200000.00', 'Unit', 1, 60, '2025-01-05 17:25:58', '2025-01-05 17:25:58'),
(73, 54, 19, 24, 'PS5 Digital Edition', 'Sony', NULL, 'PlayStation 5 Digital Edition', '7000000.00', '7200000.00', '7500000.00', 'Unit', 1, 60, '2025-01-05 17:25:58', '2025-01-05 17:25:58'),
(74, 54, 20, 25, 'TP-Link Archer AX73', 'TP-Link', NULL, 'TP-Link Archer AX73 AX5400 Wi-Fi 6 Router', '1500000.00', '1600000.00', '1700000.00', 'Unit', 1, 60, '2025-01-05 17:25:58', '2025-01-05 17:25:58'),
(75, 54, 21, 26, 'Google Nest Hub', 'Google', NULL, 'Google Nest Hub (2nd Generation)', '1300000.00', '1400000.00', '1500000.00', 'Unit', 1, 60, '2025-01-05 17:25:58', '2025-01-05 17:25:58'),
(76, 54, 22, 27, 'Sony WH-1000XM5', 'Sony', NULL, 'Sony WH-1000XM5 Wireless Noise Cancelling Headphones', '4000000.00', '4200000.00', '4500000.00', 'Unit', 1, 60, '2025-01-05 17:25:58', '2025-01-05 17:25:58'),
(77, 54, 23, 28, 'Sony A7 IV', 'Sony', NULL, 'Sony Alpha A7 IV Mirrorless Camera', '28000000.00', '28500000.00', '29000000.00', 'Unit', 1, 60, '2025-01-05 17:25:58', '2025-01-05 17:25:58'),
(78, 54, 24, 29, 'Microsoft 365 Family', 'Microsoft', NULL, 'Microsoft 365 Family 1-year Subscription', '1000000.00', '1100000.00', '1200000.00', 'License', 1, 60, '2025-01-05 17:25:58', '2025-01-05 17:25:58'),
(79, 54, 15, 20, 'Google Pixel 7 Pro', 'Google', NULL, 'Google Pixel 7 Pro 256GB - Obsidian', '12000000.00', '12500000.00', '13000000.00', 'Unit', 1, 60, '2025-01-05 17:25:58', '2025-01-05 17:25:58'),
(80, 54, 16, 21, 'Dell XPS 15', 'Dell', NULL, 'Dell XPS 15 with RTX 3050Ti', '20000000.00', '20500000.00', '21000000.00', 'Unit', 1, 60, '2025-01-05 17:25:58', '2025-01-05 17:25:58'),
(81, 54, 19, 24, 'Xbox Series X', 'Microsoft', NULL, 'Xbox Series X Gaming Console', '7500000.00', '7700000.00', '8000000.00', 'Unit', 1, 60, '2025-01-05 17:25:58', '2025-01-05 17:25:58'),
(82, 54, 22, 27, 'Apple AirPods Pro', 'Apple', NULL, 'Apple AirPods Pro (2nd Generation)', '3000000.00', '3200000.00', '3500000.00', 'Unit', 1, 60, '2025-01-05 17:25:58', '2025-01-05 17:25:58'),
(83, 54, 23, 28, 'Hikvision ColorVu', 'Hikvision', NULL, 'Hikvision ColorVu 4MP CCTV Camera', '800000.00', '900000.00', '1000000.00', 'Unit', 1, 60, '2025-01-05 17:25:58', '2025-01-05 17:25:58'),
(84, 54, 24, 29, 'Adobe Creative Cloud', 'Adobe', NULL, 'Adobe Creative Cloud 1-year Subscription', '8000000.00', '8200000.00', '8500000.00', 'License', 1, 60, '2025-01-05 17:25:58', '2025-01-05 17:25:58'),
(85, 54, 15, 20, 'Screen Protector iPhone 14', 'Generic', 'ACC-SCR-IP14', 'Tempered Glass Screen Protector for iPhone 14 Series', '50000.00', '75000.00', '100000.00', 'Pcs', 0, 60, '2025-01-05 17:35:58', '2025-01-05 17:35:58'),
(86, 54, 15, 20, 'Phone Case Samsung S23', 'Generic', 'ACC-CASE-S23', 'Premium Case for Samsung S23 Series', '75000.00', '100000.00', '150000.00', 'Pcs', 0, 60, '2025-01-05 17:35:58', '2025-01-05 17:35:58'),
(87, 54, 16, 21, 'Laptop Cooling Pad', 'Generic', 'ACC-COOL-PAD', 'Laptop Cooling Pad with 5 Fans', '150000.00', '200000.00', '250000.00', 'Unit', 0, 60, '2025-01-05 17:35:58', '2025-01-05 17:35:58'),
(88, 54, 17, 22, 'Mouse Pad Gaming XL', 'Generic', 'ACC-MP-XL', 'Extended Gaming Mouse Pad 90x40cm', '80000.00', '100000.00', '150000.00', 'Pcs', 0, 60, '2025-01-05 17:35:58', '2025-01-05 17:35:58'),
(89, 54, 18, 23, 'Printer Paper A4', 'Generic', 'SUP-PPR-A4', 'A4 Printer Paper 80gsm (500 sheets)', '45000.00', '55000.00', '65000.00', 'Rim', 0, 60, '2025-01-05 17:35:58', '2025-01-05 17:35:58'),
(90, 57, 35, 41, 'Power Bank 40000 mah', 'Vivan', 'BC084551', NULL, '250000.00', '260000.00', '350000.00', 'pcs', 0, 63, '2025-01-26 04:01:19', '2025-01-26 04:01:19'),
(91, 57, 35, 41, 'Speaker Bluetooth Wireless Bisa Power Bank', 'Mtech', NULL, 'tidak ada deca', '150000.00', '155000.00', '200000.00', 'pcs', 0, 63, '2025-01-28 08:04:39', '2025-01-28 08:04:39'),
(92, 57, 35, 41, 'Keyboard Mekanik NYK', 'NYK', 'BC63442914', 'deskripsi', '125000.00', '13000.00', '165000.00', 'pcs', 0, 63, '2025-01-28 16:48:29', '2025-01-28 16:48:29'),
(93, 57, 35, 41, 'Keyboard Mekanik NYK12', 'NYK', NULL, 'sdsds', '125000.00', '13000.00', '165000.00', 'pcs', 1, 63, '2025-01-28 16:53:55', '2025-01-28 16:53:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `discounts`
--

DROP TABLE IF EXISTS `discounts`;
CREATE TABLE `discounts` (
  `discount_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `discount_name` varchar(255) NOT NULL,
  `type` enum('percentage','fixed') NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `applies_to` enum('product','category','transaction') NOT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `product_id` int(10) unsigned DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `auto_apply` tinyint(1) NOT NULL DEFAULT 0,
  `level` enum('outlet','group','global') NOT NULL,
  `discount_outlet_id` int(10) unsigned DEFAULT NULL,
  `discount_operator_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Status diskon, 1 untuk aktif, 0 untuk tidak aktif',
  `tipe_kasir` enum('ecer','grosir') NOT NULL DEFAULT 'ecer',
  PRIMARY KEY (`discount_id`),
  KEY `fk_discount_operator_id` (`discount_operator_id`),
  KEY `fk_discount_outlet_id` (`discount_outlet_id`),
  KEY `fk_discount_product_id` (`product_id`),
  KEY `fk_discount_category_id` (`category_id`),
  CONSTRAINT `fk_discount_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  CONSTRAINT `fk_discount_operator_id` FOREIGN KEY (`discount_operator_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `fk_discount_outlet_id` FOREIGN KEY (`discount_outlet_id`) REFERENCES `outlets` (`outlet_id`),
  CONSTRAINT `fk_discount_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `discounts`
--

INSERT INTO `discounts` (`discount_id`, `discount_name`, `type`, `value`, `applies_to`, `category_id`, `product_id`, `start_date`, `end_date`, `auto_apply`, `level`, `discount_outlet_id`, `discount_operator_id`, `created_at`, `updated_at`, `is_active`, `tipe_kasir`) VALUES
(19, 'sdsds', 'percentage', '3.00', 'product', NULL, 14, '2025-01-03', '2025-01-23', 0, 'outlet', NULL, 58, '2025-01-03 15:18:44', '2025-01-05 05:10:35', 0, 'ecer'),
(20, 'sdsdsd', 'percentage', '25.00', 'category', 13, NULL, '2025-01-05', '2025-01-08', 0, 'outlet', 54, 59, '2025-01-05 05:00:13', '2025-01-05 05:00:13', 1, 'ecer'),
(21, 'aku', 'percentage', '12.00', 'product', NULL, 85, '2025-01-09', '2025-01-31', 0, 'outlet', 54, 59, '2025-01-10 04:02:18', '2025-01-11 08:29:11', 1, 'grosir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `held_transactions`
--

DROP TABLE IF EXISTS `held_transactions`;
CREATE TABLE `held_transactions` (
  `held_transaction_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `operator_id` int(10) unsigned DEFAULT NULL,
  `outlet_id` int(10) unsigned NOT NULL,
  `customer_id` int(10) unsigned DEFAULT NULL,
  `total_amount` decimal(12,2) NOT NULL,
  `note` text DEFAULT NULL,
  `items_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`items_json`)),
  `sale_type` enum('ecer','grosir') NOT NULL DEFAULT 'ecer',
  `created_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`held_transaction_id`),
  KEY `held_transactions_outlet_id_foreign` (`outlet_id`),
  KEY `held_transactions_customer_id_foreign` (`customer_id`),
  KEY `held_transactions_created_by_foreign` (`created_by`),
  KEY `fk_held_transactions_operator` (`operator_id`),
  CONSTRAINT `fk_held_transactions_operator` FOREIGN KEY (`operator_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `held_transactions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`) ON DELETE SET NULL,
  CONSTRAINT `held_transactions_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `wholesale_customers` (`wholesale_customer_id`) ON DELETE SET NULL,
  CONSTRAINT `held_transactions_outlet_id_foreign` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `held_transactions`
--

INSERT INTO `held_transactions` (`held_transaction_id`, `operator_id`, `outlet_id`, `customer_id`, `total_amount`, `note`, `items_json`, `sale_type`, `created_by`, `created_at`, `updated_at`) VALUES
(20, 59, 54, NULL, '100000.00', NULL, '\"[{\\\"product_id\\\":85,\\\"product_name\\\":\\\"Screen Protector iPhone 14\\\",\\\"product_code\\\":\\\"ACC-SCR-IP14\\\",\\\"price\\\":\\\"100000.00\\\",\\\"quantity\\\":1,\\\"subtotal\\\":100000,\\\"has_serial\\\":false,\\\"selected_serials\\\":[],\\\"stock\\\":42}]\"', 'ecer', NULL, '2025-01-10 03:08:16', '2025-01-10 03:08:16'),
(21, 59, 54, 2, '75000.00', NULL, '\"[{\\\"product_id\\\":85,\\\"product_name\\\":\\\"Screen Protector iPhone 14\\\",\\\"product_code\\\":\\\"ACC-SCR-IP14\\\",\\\"price\\\":\\\"75000.00\\\",\\\"quantity\\\":1,\\\"subtotal\\\":75000,\\\"has_serial\\\":false,\\\"selected_serials\\\":[],\\\"stock\\\":42}]\"', 'grosir', NULL, '2025-01-10 03:08:33', '2025-01-10 03:08:33'),
(22, 59, 54, 2, '75000.00', NULL, '\"[{\\\"product_id\\\":85,\\\"product_name\\\":\\\"Screen Protector iPhone 14\\\",\\\"product_code\\\":\\\"ACC-SCR-IP14\\\",\\\"price\\\":\\\"75000.00\\\",\\\"quantity\\\":1,\\\"subtotal\\\":75000,\\\"has_serial\\\":false,\\\"selected_serials\\\":[],\\\"stock\\\":42}]\"', 'grosir', NULL, '2025-01-10 03:21:44', '2025-01-10 03:21:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kas_adjustments`
--

DROP TABLE IF EXISTS `kas_adjustments`;
CREATE TABLE `kas_adjustments` (
  `kas_adjustment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_by` int(10) unsigned DEFAULT NULL,
  `outlet_id` int(10) unsigned DEFAULT NULL,
  `date` date NOT NULL,
  `waktu` datetime NOT NULL,
  `selisih` decimal(10,2) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`kas_adjustment_id`),
  KEY `fk_kas_adjustments_created_by` (`created_by`),
  KEY `fk_kas_adjustments_outlet_id` (`outlet_id`),
  CONSTRAINT `fk_kas_adjustments_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_kas_adjustments_outlet_id` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kas_adjustments`
--

INSERT INTO `kas_adjustments` (`kas_adjustment_id`, `created_by`, `outlet_id`, `date`, `waktu`, `selisih`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 59, 54, '2025-01-26', '2025-01-26 01:13:23', '-373000.00', 'fgfgf', '2025-01-26 01:13:23', '2025-01-26 01:13:23'),
(2, 59, 54, '2025-01-26', '2025-01-26 01:27:14', '-348000.00', 'sdsds', '2025-01-26 01:27:14', '2025-01-26 01:27:14'),
(3, 59, 54, '2025-01-26', '2025-01-26 01:27:49', '4625000.00', 'sdsds', '2025-01-26 01:27:49', '2025-01-26 01:27:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kas_akhir`
--

DROP TABLE IF EXISTS `kas_akhir`;
CREATE TABLE `kas_akhir` (
  `kas_akhir_id` int(10) NOT NULL AUTO_INCREMENT,
  `created_by` int(10) unsigned NOT NULL,
  `outlet_id` int(10) unsigned NOT NULL,
  `nominal` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `waktu` datetime NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kas_akhir_id`),
  KEY `kas_akhir_created_by_foreign` (`created_by`),
  KEY `kas_akhir_outlet_id_foreign` (`outlet_id`),
  CONSTRAINT `kas_akhir_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`),
  CONSTRAINT `kas_akhir_outlet_id_foreign` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kas_awal`
--

DROP TABLE IF EXISTS `kas_awal`;
CREATE TABLE `kas_awal` (
  `kas_awal_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_by` int(10) unsigned NOT NULL,
  `outlet_id` int(10) unsigned NOT NULL,
  `nominal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `date` date NOT NULL,
  `waktu` datetime DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kas_awal_id`),
  KEY `kas_awal_created_by_foreign` (`created_by`),
  KEY `kas_awal_outlet_id_foreign` (`outlet_id`),
  CONSTRAINT `kas_awal_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `kas_awal_outlet_id_foreign` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kas_awal`
--

INSERT INTO `kas_awal` (`kas_awal_id`, `created_by`, `outlet_id`, `nominal`, `date`, `waktu`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 59, 54, '750000.00', '2025-01-25', NULL, NULL, '2025-01-25 14:58:29', '2025-01-25 14:58:29'),
(2, 59, 54, '2000000.00', '2025-01-25', '2025-01-25 23:14:47', 'awal', '2025-01-25 23:14:47', '2025-01-25 23:14:47'),
(3, 59, 54, '250000.00', '2025-01-25', '2025-01-25 23:28:57', 'awal', '2025-01-25 23:28:57', '2025-01-25 23:28:57'),
(4, 59, 54, '250000.00', '2025-01-26', '2025-01-26 01:09:21', NULL, '2025-01-26 01:09:21', '2025-01-26 01:09:21'),
(5, 63, 57, '265000.00', '2025-01-26', '2025-01-26 03:56:16', NULL, '2025-01-26 03:56:16', '2025-01-26 03:56:16'),
(6, 63, 57, '250000.00', '2025-01-27', '2025-01-27 01:44:52', NULL, '2025-01-27 01:44:52', '2025-01-27 01:44:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `membership_change_requests`
--

DROP TABLE IF EXISTS `membership_change_requests`;
CREATE TABLE `membership_change_requests` (
  `request_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `outlet_id` int(10) unsigned NOT NULL,
  `current_membership_id` int(10) unsigned NOT NULL,
  `requested_membership_id` int(10) unsigned NOT NULL,
  `change_type` enum('upgrade','downgrade') NOT NULL,
  `change_fee` decimal(10,2) NOT NULL,
  `monthly_fee` decimal(10,2) DEFAULT 0.00,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `reason` text DEFAULT NULL,
  `requested_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `processed_at` timestamp NULL DEFAULT NULL,
  `processed_by` int(10) unsigned DEFAULT NULL,
  `payment_proof` varchar(255) DEFAULT NULL,
  `payment_status` enum('unpaid','paid','verified') NOT NULL DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`request_id`),
  KEY `outlet_id` (`outlet_id`),
  KEY `current_membership_id` (`current_membership_id`),
  KEY `requested_membership_id` (`requested_membership_id`),
  KEY `processed_by` (`processed_by`),
  CONSTRAINT `membership_change_requests_ibfk_1` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE CASCADE,
  CONSTRAINT `membership_change_requests_ibfk_2` FOREIGN KEY (`current_membership_id`) REFERENCES `memberships` (`membership_id`) ON DELETE CASCADE,
  CONSTRAINT `membership_change_requests_ibfk_3` FOREIGN KEY (`requested_membership_id`) REFERENCES `memberships` (`membership_id`) ON DELETE CASCADE,
  CONSTRAINT `membership_change_requests_ibfk_4` FOREIGN KEY (`processed_by`) REFERENCES `users` (`user_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `membership_change_requests`
--

INSERT INTO `membership_change_requests` (`request_id`, `outlet_id`, `current_membership_id`, `requested_membership_id`, `change_type`, `change_fee`, `monthly_fee`, `status`, `reason`, `requested_at`, `processed_at`, `processed_by`, `payment_proof`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 54, 5, 3, 'downgrade', '199000.00', '0.00', 'approved', 'asdsds', '2025-01-13 00:22:52', '2025-01-13 02:41:57', 58, NULL, 'unpaid', NULL, NULL),
(2, 54, 3, 4, 'upgrade', '0.00', '0.00', 'approved', NULL, '2025-01-13 04:51:46', '2025-01-13 04:55:18', 58, NULL, 'unpaid', NULL, NULL),
(3, 54, 4, 3, 'downgrade', '199000.00', '999000.00', 'approved', NULL, '2025-01-13 04:55:43', '2025-01-13 05:03:25', 58, NULL, 'unpaid', NULL, NULL),
(4, 54, 3, 4, 'upgrade', '0.00', '0.00', 'approved', NULL, '2025-01-13 05:07:48', '2025-01-13 05:08:29', 58, NULL, 'unpaid', NULL, NULL),
(6, 54, 4, 5, 'upgrade', '0.00', '0.00', 'approved', NULL, '2025-01-13 05:11:20', '2025-01-13 05:13:40', 58, NULL, 'unpaid', NULL, NULL),
(7, 54, 5, 4, 'downgrade', '0.00', '0.00', 'approved', NULL, '2025-01-13 05:24:53', '2025-01-13 05:25:36', 58, NULL, 'unpaid', NULL, NULL),
(8, 54, 4, 5, 'upgrade', '0.00', '0.00', 'approved', NULL, '2025-01-13 05:25:58', '2025-01-13 05:36:42', 58, NULL, 'unpaid', NULL, NULL),
(9, 54, 5, 3, 'downgrade', '199000.00', '999000.00', 'approved', NULL, '2025-01-13 05:37:05', '2025-01-13 05:39:18', 58, NULL, 'unpaid', NULL, NULL),
(11, 54, 3, 4, 'upgrade', '0.00', '0.00', 'approved', NULL, '2025-01-13 05:40:19', '2025-01-13 05:46:23', 58, NULL, 'unpaid', NULL, NULL),
(12, 54, 4, 5, 'upgrade', '0.00', '0.00', 'approved', NULL, '2025-01-13 05:46:37', '2025-01-13 06:33:09', 58, 'GkjZWDDshnOio4828OJKfWUYXVhjWs0LaWs2hIhq.jpg', 'paid', NULL, NULL),
(13, 54, 5, 4, 'downgrade', '0.00', '0.00', 'approved', NULL, '2025-01-13 06:33:32', '2025-01-13 06:34:42', 58, NULL, 'unpaid', NULL, NULL),
(14, 54, 4, 5, 'upgrade', '0.00', '0.00', 'approved', NULL, '2025-01-13 06:35:13', '2025-01-13 06:35:45', 58, NULL, 'unpaid', NULL, NULL),
(15, 54, 5, 3, 'downgrade', '199000.00', '999000.00', 'approved', NULL, '2025-01-13 06:45:04', '2025-01-13 06:50:24', 58, 'Caasi10iB3CKIZfomFMRAM6WHdPhRjbOtCDN21XX.png', 'verified', NULL, NULL),
(16, 54, 3, 5, 'upgrade', '0.00', '0.00', 'approved', NULL, '2025-01-13 06:50:39', '2025-01-13 06:52:32', 58, '1736751131_16.png', 'verified', NULL, NULL),
(17, 54, 5, 3, 'downgrade', '100000.00', '200000.00', 'approved', NULL, '2025-01-13 12:22:08', '2025-01-13 12:28:58', 58, NULL, 'unpaid', NULL, NULL),
(18, 54, 3, 5, 'upgrade', '0.00', '1000000.00', 'approved', NULL, '2025-01-13 12:31:03', '2025-01-13 12:31:41', 58, NULL, 'unpaid', NULL, NULL),
(19, 54, 5, 2, 'downgrade', '50000.00', '100000.00', 'approved', NULL, '2025-01-13 12:34:37', '2025-01-13 12:35:00', 58, NULL, 'unpaid', NULL, NULL),
(20, 54, 2, 4, 'upgrade', '400000.00', '500000.00', 'approved', NULL, '2025-01-13 12:35:42', '2025-01-13 12:36:05', 58, NULL, 'unpaid', NULL, NULL),
(21, 54, 4, 3, 'downgrade', '100000.00', '200000.00', 'approved', NULL, '2025-01-13 12:38:47', '2025-01-13 12:40:52', 58, NULL, 'unpaid', NULL, NULL),
(22, 54, 3, 5, 'upgrade', '0.00', '1000000.00', 'approved', NULL, '2025-01-13 12:46:40', '2025-01-13 12:47:11', 58, NULL, 'unpaid', NULL, NULL),
(23, 57, 2, 4, 'upgrade', '400000.00', '500000.00', 'approved', NULL, '2025-01-27 13:30:56', '2025-01-27 13:31:18', 58, NULL, 'unpaid', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `membership_history`
--

DROP TABLE IF EXISTS `membership_history`;
CREATE TABLE `membership_history` (
  `membership_history_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `outlet_id` int(10) unsigned NOT NULL,
  `old_membership_id` int(10) unsigned NOT NULL,
  `new_membership_id` int(10) unsigned NOT NULL,
  `upgrade_fee` decimal(10,2) DEFAULT NULL,
  `status` enum('approved','rejected') NOT NULL,
  `notes` text DEFAULT NULL,
  `processed_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`membership_history_id`),
  KEY `membership_history_outlet_id_foreign` (`outlet_id`),
  KEY `membership_history_old_membership_id_foreign` (`old_membership_id`),
  KEY `membership_history_new_membership_id_foreign` (`new_membership_id`),
  KEY `membership_history_processed_by_foreign` (`processed_by`),
  CONSTRAINT `membership_history_new_membership_id_foreign` FOREIGN KEY (`new_membership_id`) REFERENCES `memberships` (`membership_id`),
  CONSTRAINT `membership_history_old_membership_id_foreign` FOREIGN KEY (`old_membership_id`) REFERENCES `memberships` (`membership_id`),
  CONSTRAINT `membership_history_outlet_id_foreign` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE CASCADE,
  CONSTRAINT `membership_history_processed_by_foreign` FOREIGN KEY (`processed_by`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `membership_history`
--

INSERT INTO `membership_history` (`membership_history_id`, `outlet_id`, `old_membership_id`, `new_membership_id`, `upgrade_fee`, `status`, `notes`, `processed_by`, `created_at`, `updated_at`) VALUES
(1, 54, 4, 5, '2000000.00', 'approved', 'Upgrade membership disetujui', 58, '2025-01-12 23:24:43', '2025-01-12 23:24:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `outlet_groups`
--

DROP TABLE IF EXISTS `outlet_groups`;
CREATE TABLE `outlet_groups` (
  `outlet_group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `outlet_group_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`outlet_group_id`),
  KEY `outlet_groups_user_id_foreign` (`user_id`),
  CONSTRAINT `outlet_groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `outlet_groups`
--

INSERT INTO `outlet_groups` (`outlet_group_id`, `outlet_group_name`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(39, 'Melvian Cell', 'Group for Melviano Cell', 58, '2025-01-02 09:00:43', '2025-01-13 11:21:15'),
(40, 'supaijo12', 'Group for supaijo12', 63, '2025-01-24 09:45:50', '2025-01-24 09:45:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_confirmations`
--

DROP TABLE IF EXISTS `payment_confirmations`;
CREATE TABLE `payment_confirmations` (
  `payment_confirmation_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `payment_outlet_id` int(10) unsigned NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `method_transfer` varchar(50) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `bukti_transfer` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`payment_confirmation_id`),
  KEY `payment_confirmations_user_id_foreign` (`user_id`),
  KEY `fk_payment_confirmations_outlets` (`payment_outlet_id`),
  CONSTRAINT `fk_payment_confirmations_outlets` FOREIGN KEY (`payment_outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payment_confirmations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `payment_confirmations`
--

INSERT INTO `payment_confirmations` (`payment_confirmation_id`, `user_id`, `payment_outlet_id`, `bank_name`, `method_transfer`, `account_name`, `account_number`, `bukti_transfer`, `created_at`, `updated_at`) VALUES
(2, 59, 54, 'MANDIRI', 'mobile_banking', 'asasasa', 'asasa', 'oZDYnkejAgtGoSrA3OKtIy6hr2OsZakBbCodkJ3F.jpg', '2025-01-13 05:54:31', '2025-01-13 05:54:31'),
(3, 59, 54, 'MANDIRI', 'counter', 'asasasa', 'asasa', 'GkjZWDDshnOio4828OJKfWUYXVhjWs0LaWs2hIhq.jpg', '2025-01-13 05:58:30', '2025-01-13 05:58:30'),
(4, 59, 54, 'MANDIRI', 'internet_banking', 'asasasa', 'asasa', 'Caasi10iB3CKIZfomFMRAM6WHdPhRjbOtCDN21XX.png', '2025-01-13 06:45:49', '2025-01-13 06:45:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penambahan_kas`
--

DROP TABLE IF EXISTS `penambahan_kas`;
CREATE TABLE `penambahan_kas` (
  `penambahan_kas_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_by` int(10) unsigned NOT NULL,
  `outlet_id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `waktu` datetime DEFAULT NULL,
  `nominal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`penambahan_kas_id`),
  KEY `penambahan_kas_created_by_foreign` (`created_by`),
  KEY `penambahan_kas_outlet_id_foreign` (`outlet_id`),
  CONSTRAINT `penambahan_kas_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `penambahan_kas_outlet_id_foreign` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penambahan_kas`
--

INSERT INTO `penambahan_kas` (`penambahan_kas_id`, `created_by`, `outlet_id`, `date`, `waktu`, `nominal`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 59, 54, '2025-01-25', NULL, '250000.00', 'uang receh', '2025-01-25 15:09:45', '2025-01-25 15:09:45'),
(2, 59, 54, '2025-01-25', NULL, '12000.00', 'tambah', '2025-01-25 23:18:08', '2025-01-25 23:18:08'),
(3, 59, 54, '2025-01-25', NULL, '250000.00', 'uang', '2025-01-25 23:18:51', '2025-01-25 23:18:51'),
(4, 59, 54, '2025-01-25', '2025-01-25 23:26:30', '350000.00', 'uang tambah', '2025-01-25 23:26:30', '2025-01-25 23:26:30'),
(5, 59, 54, '2025-01-26', '2025-01-26 01:11:09', '150000.00', NULL, '2025-01-26 01:11:09', '2025-01-26 01:11:09'),
(6, 63, 57, '2025-01-26', '2025-01-26 03:56:21', '75000.00', NULL, '2025-01-26 03:56:21', '2025-01-26 03:56:21'),
(7, 63, 57, '2025-01-27', '2025-01-27 01:54:04', '25000.00', NULL, '2025-01-27 01:54:04', '2025-01-27 01:54:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penarikan_kas`
--

DROP TABLE IF EXISTS `penarikan_kas`;
CREATE TABLE `penarikan_kas` (
  `penarikan_kas_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_by` int(10) unsigned NOT NULL,
  `outlet_id` int(10) unsigned NOT NULL,
  `nominal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `date` date NOT NULL,
  `waktu` datetime DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`penarikan_kas_id`),
  KEY `penarikan_kas_created_by_foreign` (`created_by`),
  KEY `penarikan_kas_outlet_id_foreign` (`outlet_id`),
  CONSTRAINT `penarikan_kas_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `penarikan_kas_outlet_id_foreign` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penarikan_kas`
--

INSERT INTO `penarikan_kas` (`penarikan_kas_id`, `created_by`, `outlet_id`, `nominal`, `date`, `waktu`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 59, 54, '125000.00', '2025-01-25', NULL, 'sdsdsds', '2025-01-25 15:28:38', '2025-01-25 15:28:38'),
(2, 59, 54, '50000.00', '2025-01-25', '2025-01-25 15:37:27', 'sdsds', '2025-01-25 15:37:27', '2025-01-25 15:37:27'),
(3, 59, 54, '25000.00', '2025-01-25', '2025-01-25 15:40:28', NULL, '2025-01-25 15:40:28', '2025-01-25 15:40:28'),
(4, 59, 54, '75000.00', '2025-01-25', '2025-01-25 23:28:39', 'tarik', '2025-01-25 23:28:39', '2025-01-25 23:28:39'),
(5, 59, 54, '25000.00', '2025-01-26', '2025-01-26 01:11:17', NULL, '2025-01-26 01:11:17', '2025-01-26 01:11:17'),
(6, 63, 57, '650000.00', '2025-01-26', '2025-01-26 03:56:28', NULL, '2025-01-26 03:56:28', '2025-01-26 03:56:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perpajakan`
--

DROP TABLE IF EXISTS `perpajakan`;
CREATE TABLE `perpajakan` (
  `pajak_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `outlet_id` int(10) unsigned NOT NULL,
  `pajak` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pajak_id`),
  KEY `user_id` (`user_id`),
  KEY `outlet_id` (`outlet_id`),
  CONSTRAINT `perpajakan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `perpajakan_ibfk_2` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `perpajakan`
--

INSERT INTO `perpajakan` (`pajak_id`, `user_id`, `outlet_id`, `pajak`, `created_at`, `updated_at`) VALUES
(1, 60, 54, '0.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_adjustments`
--

DROP TABLE IF EXISTS `product_adjustments`;
CREATE TABLE `product_adjustments` (
  `adjustment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned DEFAULT NULL,
  `serial_id` int(10) unsigned DEFAULT NULL,
  `adjustment_type` enum('lost','damaged','returned') NOT NULL,
  `quantity` int(11) NOT NULL,
  `reason` text DEFAULT NULL,
  `adjusted_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`adjustment_id`),
  KEY `product_adjustments_product_id_foreign` (`product_id`),
  KEY `product_adjustments_serial_id_foreign` (`serial_id`),
  KEY `product_adjustments_user_id_foreign` (`user_id`),
  CONSTRAINT `product_adjustments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE SET NULL,
  CONSTRAINT `product_adjustments_serial_id_foreign` FOREIGN KEY (`serial_id`) REFERENCES `product_serials` (`serial_id`) ON DELETE SET NULL,
  CONSTRAINT `product_adjustments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images` (
  `image_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `outlet_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`image_id`),
  KEY `product_images_product_id_foreign` (`product_id`),
  KEY `product_images_outlet_id_foreign` (`outlet_id`),
  KEY `product_images_user_id_foreign` (`user_id`),
  CONSTRAINT `product_images_outlet_id_foreign` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE CASCADE,
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  CONSTRAINT `product_images_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_serials`
--

DROP TABLE IF EXISTS `product_serials`;
CREATE TABLE `product_serials` (
  `serial_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `outlet_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `serial_number` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`serial_id`),
  UNIQUE KEY `product_serials_serial_number_unique` (`serial_number`),
  KEY `product_serials_product_id_foreign` (`product_id`),
  KEY `product_serials_outlet_id_foreign` (`outlet_id`),
  KEY `product_serials_user_id_foreign` (`user_id`),
  CONSTRAINT `product_serials_outlet_id_foreign` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE CASCADE,
  CONSTRAINT `product_serials_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  CONSTRAINT `product_serials_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=262 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_serials`
--

INSERT INTO `product_serials` (`serial_id`, `product_id`, `outlet_id`, `user_id`, `serial_number`, `status`, `created_at`, `updated_at`) VALUES
(10, 14, 52, 60, '1515244512112', 'tersedia', '2025-01-02 11:07:28', '2025-01-02 23:49:48'),
(11, 14, 54, 60, '5621324215151', 'available', '2025-01-02 11:07:28', '2025-01-27 10:41:15'),
(12, 14, 52, 60, '5661232345231', 'tersedia', '2025-01-02 11:07:28', '2025-01-02 23:49:53'),
(13, 66, 54, 60, 'IPH-0066-0001', 'dalam_keranjang', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(14, 66, 54, 60, 'IPH-0066-0002', 'dalam_keranjang', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(15, 66, 54, 60, 'IPH-0066-0003', 'terjual', '2025-01-05 17:31:24', '2025-01-11 00:39:07'),
(16, 66, 54, 60, 'IPH-0066-0004', 'terjual', '2025-01-05 17:31:24', '2025-01-10 14:41:25'),
(17, 66, 54, 60, 'IPH-0066-0005', 'terjual', '2025-01-05 17:31:24', '2025-01-10 14:50:45'),
(18, 66, 54, 60, 'IPH-0066-0006', 'available', '2025-01-05 17:31:24', '2025-01-27 10:42:43'),
(19, 66, 54, 60, 'IPH-0066-0007', 'available', '2025-01-05 17:31:24', '2025-01-27 10:42:40'),
(20, 66, 54, 60, 'IPH-0066-0008', 'tersedia', '2025-01-05 17:31:24', '2025-01-10 10:13:06'),
(21, 66, 54, 60, 'IPH-0066-0009', 'terjual', '2025-01-05 17:31:24', '2025-01-11 13:18:32'),
(22, 66, 54, 60, 'IPH-0066-0010', 'tersedia', '2025-01-05 17:31:24', '2025-01-10 12:34:55'),
(23, 66, 54, 60, 'IPH-0066-0011', 'tersedia', '2025-01-05 17:31:24', '2025-01-10 14:30:49'),
(24, 67, 54, 60, 'SAM-0067-0001', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(25, 67, 54, 60, 'SAM-0067-0002', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(26, 67, 54, 60, 'SAM-0067-0003', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(27, 67, 54, 60, 'SAM-0067-0004', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(28, 67, 54, 60, 'SAM-0067-0005', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(29, 67, 54, 60, 'SAM-0067-0006', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(30, 67, 54, 60, 'SAM-0067-0007', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(31, 67, 54, 60, 'SAM-0067-0008', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(32, 67, 54, 60, 'SAM-0067-0009', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(33, 67, 54, 60, 'SAM-0067-0010', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(34, 67, 54, 60, 'SAM-0067-0011', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(35, 67, 54, 60, 'SAM-0067-0012', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(36, 67, 54, 60, 'SAM-0067-0013', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(37, 67, 54, 60, 'SAM-0067-0014', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(38, 67, 54, 60, 'SAM-0067-0015', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(39, 68, 54, 60, 'MAC-0068-0001', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(40, 68, 54, 60, 'MAC-0068-0002', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(41, 68, 54, 60, 'MAC-0068-0003', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(42, 68, 54, 60, 'MAC-0068-0004', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(43, 68, 54, 60, 'MAC-0068-0005', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(44, 68, 54, 60, 'MAC-0068-0006', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(45, 68, 54, 60, 'MAC-0068-0007', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(46, 68, 54, 60, 'MAC-0068-0008', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(47, 68, 54, 60, 'MAC-0068-0009', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(48, 68, 54, 60, 'MAC-0068-0010', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(49, 68, 54, 60, 'MAC-0068-0011', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(50, 68, 54, 60, 'MAC-0068-0012', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(51, 68, 54, 60, 'MAC-0068-0013', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(52, 68, 54, 60, 'MAC-0068-0014', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(53, 68, 54, 60, 'MAC-0068-0015', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(54, 68, 54, 60, 'MAC-0068-0016', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(55, 68, 54, 60, 'MAC-0068-0017', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(56, 68, 54, 60, 'MAC-0068-0018', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(57, 69, 54, 60, 'ROG-0069-0001', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(58, 69, 54, 60, 'ROG-0069-0002', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(59, 69, 54, 60, 'ROG-0069-0003', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(60, 69, 54, 60, 'ROG-0069-0004', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(61, 69, 54, 60, 'ROG-0069-0005', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(62, 70, 54, 60, 'LOG-0070-0001', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(63, 70, 54, 60, 'LOG-0070-0002', 'terjual', '2025-01-05 17:31:24', '2025-01-25 15:49:29'),
(64, 70, 54, 60, 'LOG-0070-0003', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(65, 70, 54, 60, 'LOG-0070-0004', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(66, 70, 54, 60, 'LOG-0070-0005', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(67, 70, 54, 60, 'LOG-0070-0006', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(68, 71, 54, 60, 'KEY-0071-0001', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(69, 71, 54, 60, 'KEY-0071-0002', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(70, 71, 54, 60, 'KEY-0071-0003', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(71, 71, 54, 60, 'KEY-0071-0004', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(72, 71, 54, 60, 'KEY-0071-0005', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(73, 71, 54, 60, 'KEY-0071-0006', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(74, 71, 54, 60, 'KEY-0071-0007', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(75, 71, 54, 60, 'KEY-0071-0008', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(76, 71, 54, 60, 'KEY-0071-0009', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(77, 71, 54, 60, 'KEY-0071-0010', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(78, 71, 54, 60, 'KEY-0071-0011', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(79, 71, 54, 60, 'KEY-0071-0012', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(80, 72, 54, 60, 'EPS-0072-0001', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(81, 72, 54, 60, 'EPS-0072-0002', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(82, 72, 54, 60, 'EPS-0072-0003', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(83, 72, 54, 60, 'EPS-0072-0004', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(84, 72, 54, 60, 'EPS-0072-0005', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(85, 72, 54, 60, 'EPS-0072-0006', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(86, 72, 54, 60, 'EPS-0072-0007', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(87, 72, 54, 60, 'EPS-0072-0008', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(88, 72, 54, 60, 'EPS-0072-0009', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(89, 72, 54, 60, 'EPS-0072-0010', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(90, 72, 54, 60, 'EPS-0072-0011', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(91, 72, 54, 60, 'EPS-0072-0012', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(92, 72, 54, 60, 'EPS-0072-0013', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(93, 72, 54, 60, 'EPS-0072-0014', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(94, 73, 54, 60, 'PS5-0073-0001', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(95, 73, 54, 60, 'PS5-0073-0002', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(96, 73, 54, 60, 'PS5-0073-0003', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(97, 73, 54, 60, 'PS5-0073-0004', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(98, 73, 54, 60, 'PS5-0073-0005', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(99, 73, 54, 60, 'PS5-0073-0006', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(100, 73, 54, 60, 'PS5-0073-0007', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(101, 73, 54, 60, 'PS5-0073-0008', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(102, 73, 54, 60, 'PS5-0073-0009', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(103, 73, 54, 60, 'PS5-0073-0010', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(104, 73, 54, 60, 'PS5-0073-0011', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(105, 73, 54, 60, 'PS5-0073-0012', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(106, 73, 54, 60, 'PS5-0073-0013', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(107, 73, 54, 60, 'PS5-0073-0014', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(108, 74, 54, 60, 'TP--0074-0001', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(109, 74, 54, 60, 'TP--0074-0002', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24');

INSERT INTO `product_serials` (`serial_id`, `product_id`, `outlet_id`, `user_id`, `serial_number`, `status`, `created_at`, `updated_at`) VALUES
(110, 74, 54, 60, 'TP--0074-0003', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(111, 74, 54, 60, 'TP--0074-0004', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(112, 74, 54, 60, 'TP--0074-0005', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(113, 74, 54, 60, 'TP--0074-0006', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(114, 74, 54, 60, 'TP--0074-0007', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(115, 74, 54, 60, 'TP--0074-0008', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(116, 74, 54, 60, 'TP--0074-0009', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(117, 74, 54, 60, 'TP--0074-0010', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(118, 74, 54, 60, 'TP--0074-0011', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(119, 74, 54, 60, 'TP--0074-0012', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(120, 74, 54, 60, 'TP--0074-0013', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(121, 74, 54, 60, 'TP--0074-0014', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(122, 74, 54, 60, 'TP--0074-0015', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(123, 74, 54, 60, 'TP--0074-0016', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(124, 74, 54, 60, 'TP--0074-0017', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(125, 74, 54, 60, 'TP--0074-0018', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(126, 74, 54, 60, 'TP--0074-0019', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(127, 74, 54, 60, 'TP--0074-0020', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(128, 75, 54, 60, 'GOO-0075-0001', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(129, 75, 54, 60, 'GOO-0075-0002', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(130, 75, 54, 60, 'GOO-0075-0003', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(131, 75, 54, 60, 'GOO-0075-0004', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(132, 75, 54, 60, 'GOO-0075-0005', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(133, 75, 54, 60, 'GOO-0075-0006', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(134, 75, 54, 60, 'GOO-0075-0007', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(135, 75, 54, 60, 'GOO-0075-0008', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(136, 75, 54, 60, 'GOO-0075-0009', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(137, 75, 54, 60, 'GOO-0075-0010', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(138, 75, 54, 60, 'GOO-0075-0011', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(139, 75, 54, 60, 'GOO-0075-0012', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(140, 76, 54, 60, 'SON-0076-0001', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(141, 76, 54, 60, 'SON-0076-0002', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(142, 76, 54, 60, 'SON-0076-0003', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(143, 76, 54, 60, 'SON-0076-0004', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(144, 76, 54, 60, 'SON-0076-0005', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(145, 76, 54, 60, 'SON-0076-0006', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(146, 76, 54, 60, 'SON-0076-0007', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(147, 76, 54, 60, 'SON-0076-0008', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(148, 76, 54, 60, 'SON-0076-0009', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(149, 76, 54, 60, 'SON-0076-0010', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(150, 76, 54, 60, 'SON-0076-0011', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(151, 76, 54, 60, 'SON-0076-0012', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(152, 76, 54, 60, 'SON-0076-0013', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(153, 76, 54, 60, 'SON-0076-0014', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(154, 76, 54, 60, 'SON-0076-0015', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(155, 76, 54, 60, 'SON-0076-0016', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(156, 76, 54, 60, 'SON-0076-0017', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(157, 76, 54, 60, 'SON-0076-0018', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(158, 76, 54, 60, 'SON-0076-0019', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(159, 77, 54, 60, 'SON-0077-0001', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(160, 77, 54, 60, 'SON-0077-0002', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(161, 77, 54, 60, 'SON-0077-0003', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(162, 77, 54, 60, 'SON-0077-0004', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(163, 77, 54, 60, 'SON-0077-0005', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(164, 77, 54, 60, 'SON-0077-0006', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(165, 77, 54, 60, 'SON-0077-0007', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(166, 77, 54, 60, 'SON-0077-0008', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(167, 77, 54, 60, 'SON-0077-0009', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(168, 77, 54, 60, 'SON-0077-0010', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(169, 77, 54, 60, 'SON-0077-0011', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(170, 78, 54, 60, 'MIC-0078-0001', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(171, 78, 54, 60, 'MIC-0078-0002', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(172, 78, 54, 60, 'MIC-0078-0003', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(173, 78, 54, 60, 'MIC-0078-0004', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(174, 78, 54, 60, 'MIC-0078-0005', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(175, 78, 54, 60, 'MIC-0078-0006', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(176, 78, 54, 60, 'MIC-0078-0007', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(177, 78, 54, 60, 'MIC-0078-0008', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(178, 78, 54, 60, 'MIC-0078-0009', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(179, 78, 54, 60, 'MIC-0078-0010', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(180, 78, 54, 60, 'MIC-0078-0011', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(181, 78, 54, 60, 'MIC-0078-0012', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(182, 78, 54, 60, 'MIC-0078-0013', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(183, 78, 54, 60, 'MIC-0078-0014', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(184, 78, 54, 60, 'MIC-0078-0015', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(185, 78, 54, 60, 'MIC-0078-0016', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(186, 78, 54, 60, 'MIC-0078-0017', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(187, 79, 54, 60, 'GOO-0079-0001', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(188, 79, 54, 60, 'GOO-0079-0002', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(189, 79, 54, 60, 'GOO-0079-0003', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(190, 79, 54, 60, 'GOO-0079-0004', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(191, 79, 54, 60, 'GOO-0079-0005', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(192, 80, 54, 60, 'DEL-0080-0001', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(193, 80, 54, 60, 'DEL-0080-0002', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(194, 80, 54, 60, 'DEL-0080-0003', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(195, 80, 54, 60, 'DEL-0080-0004', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(196, 80, 54, 60, 'DEL-0080-0005', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(197, 80, 54, 60, 'DEL-0080-0006', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(198, 80, 54, 60, 'DEL-0080-0007', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(199, 80, 54, 60, 'DEL-0080-0008', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(200, 80, 54, 60, 'DEL-0080-0009', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(201, 80, 54, 60, 'DEL-0080-0010', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(202, 80, 54, 60, 'DEL-0080-0011', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(203, 80, 54, 60, 'DEL-0080-0012', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(204, 80, 54, 60, 'DEL-0080-0013', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(205, 80, 54, 60, 'DEL-0080-0014', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(206, 81, 54, 60, 'XBO-0081-0001', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(207, 81, 54, 60, 'XBO-0081-0002', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(208, 81, 54, 60, 'XBO-0081-0003', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(209, 81, 54, 60, 'XBO-0081-0004', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24');

INSERT INTO `product_serials` (`serial_id`, `product_id`, `outlet_id`, `user_id`, `serial_number`, `status`, `created_at`, `updated_at`) VALUES
(210, 81, 54, 60, 'XBO-0081-0005', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(211, 81, 54, 60, 'XBO-0081-0006', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(212, 81, 54, 60, 'XBO-0081-0007', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(213, 81, 54, 60, 'XBO-0081-0008', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(214, 81, 54, 60, 'XBO-0081-0009', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(215, 81, 54, 60, 'XBO-0081-0010', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(216, 82, 54, 60, 'APP-0082-0001', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(217, 82, 54, 60, 'APP-0082-0002', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(218, 82, 54, 60, 'APP-0082-0003', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(219, 82, 54, 60, 'APP-0082-0004', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(220, 82, 54, 60, 'APP-0082-0005', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(221, 82, 54, 60, 'APP-0082-0006', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(222, 82, 54, 60, 'APP-0082-0007', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(223, 82, 54, 60, 'APP-0082-0008', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(224, 82, 54, 60, 'APP-0082-0009', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(225, 82, 54, 60, 'APP-0082-0010', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(226, 82, 54, 60, 'APP-0082-0011', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(227, 82, 54, 60, 'APP-0082-0012', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(228, 82, 54, 60, 'APP-0082-0013', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(229, 82, 54, 60, 'APP-0082-0014', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(230, 83, 54, 60, 'HIK-0083-0001', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(231, 83, 54, 60, 'HIK-0083-0002', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(232, 83, 54, 60, 'HIK-0083-0003', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(233, 83, 54, 60, 'HIK-0083-0004', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(234, 83, 54, 60, 'HIK-0083-0005', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(235, 83, 54, 60, 'HIK-0083-0006', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(236, 83, 54, 60, 'HIK-0083-0007', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(237, 83, 54, 60, 'HIK-0083-0008', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(238, 83, 54, 60, 'HIK-0083-0009', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(239, 83, 54, 60, 'HIK-0083-0010', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(240, 83, 54, 60, 'HIK-0083-0011', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(241, 83, 54, 60, 'HIK-0083-0012', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(242, 83, 54, 60, 'HIK-0083-0013', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(243, 83, 54, 60, 'HIK-0083-0014', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(244, 83, 54, 60, 'HIK-0083-0015', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(245, 83, 54, 60, 'HIK-0083-0016', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(246, 83, 54, 60, 'HIK-0083-0017', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(247, 83, 54, 60, 'HIK-0083-0018', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(248, 83, 54, 60, 'HIK-0083-0019', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(249, 84, 54, 60, 'ADO-0084-0001', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(250, 84, 54, 60, 'ADO-0084-0002', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(251, 84, 54, 60, 'ADO-0084-0003', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(252, 84, 54, 60, 'ADO-0084-0004', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(253, 84, 54, 60, 'ADO-0084-0005', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(254, 84, 54, 60, 'ADO-0084-0006', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(255, 84, 54, 60, 'ADO-0084-0007', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(256, 84, 54, 60, 'ADO-0084-0008', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(257, 84, 54, 60, 'ADO-0084-0009', 'tersedia', '2025-01-05 17:31:24', '2025-01-05 17:31:24'),
(258, 93, 57, 63, '55455515515', 'tersedia', '2025-01-28 16:53:55', '2025-01-28 16:53:55'),
(259, 93, 57, 63, '34343445455', 'tersedia', '2025-01-28 16:53:55', '2025-01-28 16:53:55'),
(260, 93, 57, 63, '45565656565', 'terjual', '2025-01-28 16:53:55', '2025-01-28 16:57:32'),
(261, 93, 57, 63, '34345656566', 'terjual', '2025-01-28 16:53:55', '2025-01-28 19:53:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_stock`
--

DROP TABLE IF EXISTS `product_stock`;
CREATE TABLE `product_stock` (
  `product_stock_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `outlet_id` int(10) unsigned NOT NULL,
  `stock` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`product_stock_id`),
  UNIQUE KEY `product_stock_product_id_outlet_id_unique` (`product_id`,`outlet_id`),
  KEY `product_stock_product_id_foreign` (`product_id`),
  KEY `product_stock_outlet_id_foreign` (`outlet_id`),
  CONSTRAINT `product_stock_outlet_id_foreign` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE CASCADE,
  CONSTRAINT `product_stock_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_stock`
--

INSERT INTO `product_stock` (`product_stock_id`, `product_id`, `outlet_id`, `stock`, `created_at`, `updated_at`) VALUES
(1, 26, 54, 42, '2025-01-02 15:21:05', '2025-01-27 12:25:05'),
(2, 26, 52, 3, '2025-01-02 16:32:54', '2025-01-02 22:55:51'),
(22, 85, 54, 12, '2025-01-05 17:35:58', '2025-01-25 15:41:37'),
(23, 86, 54, 53, '2025-01-05 17:35:58', '2025-01-05 17:35:58'),
(24, 87, 54, 61, '2025-01-05 17:35:58', '2025-01-05 17:35:58'),
(25, 88, 54, 55, '2025-01-05 17:35:58', '2025-01-05 17:35:58'),
(26, 89, 54, 64, '2025-01-05 17:35:58', '2025-01-05 17:35:58'),
(27, 90, 57, 84, '2025-01-26 04:01:19', '2025-01-28 14:45:41'),
(28, 91, 57, 541, '2025-01-28 08:04:39', '2025-01-28 14:45:41'),
(29, 92, 57, 485, '2025-01-28 16:48:29', '2025-01-28 16:48:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_transits`
--

DROP TABLE IF EXISTS `product_transits`;
CREATE TABLE `product_transits` (
  `transit_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `serial_id` int(10) unsigned DEFAULT NULL,
  `from_outlet_id` int(10) unsigned NOT NULL,
  `to_outlet_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `operator_sender` int(10) unsigned DEFAULT NULL,
  `operator_receiver` int(10) unsigned DEFAULT NULL,
  `has_serial_number` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`transit_id`),
  KEY `product_transits_product_id_foreign` (`product_id`),
  KEY `product_transits_serial_id_foreign` (`serial_id`),
  KEY `product_transits_from_outlet_id_foreign` (`from_outlet_id`),
  KEY `product_transits_to_outlet_id_foreign` (`to_outlet_id`),
  KEY `product_transits_user_id_foreign` (`user_id`),
  KEY `product_transits_operator_sender_foreign` (`operator_sender`),
  KEY `product_transits_operator_receiver_foreign` (`operator_receiver`),
  CONSTRAINT `product_transits_from_outlet_id_foreign` FOREIGN KEY (`from_outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE CASCADE,
  CONSTRAINT `product_transits_operator_receiver_foreign` FOREIGN KEY (`operator_receiver`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `product_transits_operator_sender_foreign` FOREIGN KEY (`operator_sender`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `product_transits_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  CONSTRAINT `product_transits_serial_id_foreign` FOREIGN KEY (`serial_id`) REFERENCES `product_serials` (`serial_id`) ON DELETE CASCADE,
  CONSTRAINT `product_transits_to_outlet_id_foreign` FOREIGN KEY (`to_outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE CASCADE,
  CONSTRAINT `product_transits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_transits`
--

INSERT INTO `product_transits` (`transit_id`, `product_id`, `serial_id`, `from_outlet_id`, `to_outlet_id`, `user_id`, `quantity`, `status`, `operator_sender`, `operator_receiver`, `has_serial_number`, `created_at`, `updated_at`) VALUES
(9, 26, NULL, 54, 52, 59, 5, 'transit', 59, NULL, 0, '2025-01-27 11:56:33', '2025-01-27 11:56:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_types`
--

DROP TABLE IF EXISTS `product_types`;
CREATE TABLE `product_types` (
  `product_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `outlet_id` int(10) unsigned NOT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`product_type_id`),
  KEY `fk_product_types_user_id` (`user_id`),
  KEY `fk_product_types_outlet_id` (`outlet_id`),
  CONSTRAINT `fk_product_types_outlet_id` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_product_types_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening_owner`
--

DROP TABLE IF EXISTS `rekening_owner`;
CREATE TABLE `rekening_owner` (
  `rekening_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `bank_name` varchar(100) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`rekening_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rekening_owner`
--

INSERT INTO `rekening_owner` (`rekening_id`, `email`, `bank_name`, `account_number`, `account_name`, `created_at`, `updated_at`, `is_active`, `is_default`) VALUES
(2, 'ryumaster8@gmail.com', 'BRI', '013001071873502', 'Zulfajri', '2024-12-31 06:56:20', '2024-12-31 07:28:58', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `saran`
--

DROP TABLE IF EXISTS `saran`;
CREATE TABLE `saran` (
  `saran_id` int(10) NOT NULL AUTO_INCREMENT,
  `outlet_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `saran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`saran_id`),
  KEY `saran_outlet_id_foreign` (`outlet_id`),
  KEY `saran_created_by_foreign` (`created_by`),
  CONSTRAINT `saran_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `saran_outlet_id_foreign` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `saran`
--

INSERT INTO `saran` (`saran_id`, `outlet_id`, `created_by`, `saran`, `created_at`, `updated_at`) VALUES
(1, 54, 59, 'sdsdsdsds', '2025-01-17 23:32:47', '2025-01-17 23:32:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `teknisi`
--

DROP TABLE IF EXISTS `teknisi`;
CREATE TABLE `teknisi` (
  `teknisi_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `operator_id` int(10) unsigned NOT NULL,
  `teknisi_outlet_id` int(10) unsigned NOT NULL,
  `nama_teknisi` varchar(255) NOT NULL,
  `kontak` varchar(50) DEFAULT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`teknisi_id`),
  KEY `fk_teknisi_operator_id` (`operator_id`),
  KEY `fk_teknisi_outlet_id` (`teknisi_outlet_id`),
  CONSTRAINT `fk_teknisi_operator_id` FOREIGN KEY (`operator_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `fk_teknisi_outlet_id` FOREIGN KEY (`teknisi_outlet_id`) REFERENCES `outlets` (`outlet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `teknisi`
--

INSERT INTO `teknisi` (`teknisi_id`, `operator_id`, `teknisi_outlet_id`, `nama_teknisi`, `kontak`, `status`, `created_at`, `updated_at`) VALUES
(5, 58, 49, 'Supri', '0845748512', 'aktif', '2025-01-03 08:33:54', '2025-01-03 08:33:54'),
(6, 59, 52, 'Ilham', '081548154854', 'aktif', '2025-01-05 06:00:42', '2025-01-05 06:12:18'),
(7, 59, 54, 'efendi', '0845748512', 'aktif', '2025-01-05 11:47:45', '2025-01-05 11:47:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `service_id` int(10) NOT NULL AUTO_INCREMENT,
  `service_operator_id` int(10) unsigned NOT NULL,
  `service_outlet_id` int(10) unsigned NOT NULL,
  `service_teknisi_id` int(10) unsigned DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `device_name` varchar(255) NOT NULL,
  `tipe_perangkat` enum('Handphone','Laptop','PC','Lainnya') NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `keluhan` text NOT NULL,
  `kerusakan` text DEFAULT NULL,
  `sparepart` text DEFAULT NULL,
  `progress_status` enum('Sedang Proses','Selesai','Dibatalkan') NOT NULL DEFAULT 'Sedang Proses',
  `status_servis` enum('Berhasil','Sedang Pengerjaan','Gagal','Dibatalkan') DEFAULT NULL,
  `completion_estimate` date DEFAULT NULL,
  `service_completion_date` date DEFAULT NULL,
  `equipment_included` text DEFAULT NULL,
  `biaya` decimal(10,2) DEFAULT 0.00,
  `uang_muka` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `tanggal_masuk` date DEFAULT NULL,
  `tanggal_ambil` date DEFAULT NULL,
  `faktur` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `description` text NOT NULL,
  `operator_batal` varchar(255) DEFAULT NULL,
  `tanggal_batal` timestamp NULL DEFAULT NULL,
  `operator_pengambilan` varchar(255) DEFAULT NULL,
  `metode_pembayaran` varchar(20) DEFAULT NULL,
  `status_pembayaran` enum('Lunas','Belum Lunas','Dibatalkan') DEFAULT NULL,
  `sisa_pembayaran` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`service_id`),
  KEY `fk_services_operator_id` (`service_operator_id`),
  KEY `fk_services_outlet_id` (`service_outlet_id`),
  KEY `fk_services_teknisi_id` (`service_teknisi_id`),
  CONSTRAINT `fk_services_operator_id` FOREIGN KEY (`service_operator_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `fk_services_outlet_id` FOREIGN KEY (`service_outlet_id`) REFERENCES `outlets` (`outlet_id`),
  CONSTRAINT `fk_services_teknisi_id` FOREIGN KEY (`service_teknisi_id`) REFERENCES `teknisi` (`teknisi_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`service_id`, `service_operator_id`, `service_outlet_id`, `service_teknisi_id`, `customer_name`, `device_name`, `tipe_perangkat`, `serial_number`, `keluhan`, `kerusakan`, `sparepart`, `progress_status`, `status_servis`, `completion_estimate`, `service_completion_date`, `equipment_included`, `biaya`, `uang_muka`, `created_at`, `tanggal_masuk`, `tanggal_ambil`, `faktur`, `updated_at`, `description`, `operator_batal`, `tanggal_batal`, `operator_pengambilan`, `metode_pembayaran`, `status_pembayaran`, `sisa_pembayaran`) VALUES
(5, 58, 49, 5, 'MUJIATI', 'Oppo Find 1', 'Handphone', '8452666281595', 'sdsd', 'sdsds', 'dsdsd', 'Selesai', 'Berhasil', NULL, '2025-01-03', 'sdsds', '200000.00', NULL, '2025-01-03 12:55:18', '2025-01-03', '2025-01-03', 'INV-601566111', '2025-01-03 12:58:28', '', NULL, NULL, '58', NULL, 'Belum Lunas', '200000.00'),
(7, 58, 49, 5, 'MUJIATI', 'Oppo Find 1', 'Handphone', '8452666281595', 'fgdfg', 'fdgfdg', 'dfgfdg', 'Sedang Proses', NULL, NULL, NULL, 'fdgfdgdf', '200000.00', NULL, '2025-01-03 13:47:47', '2025-01-03', NULL, 'INV-578364138', '2025-01-03 13:47:47', '', NULL, NULL, NULL, NULL, 'Belum Lunas', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `wholesale_customers`
--

DROP TABLE IF EXISTS `wholesale_customers`;
CREATE TABLE `wholesale_customers` (
  `wholesale_customer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `contact_info` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `customer_outlet_id` int(10) unsigned DEFAULT NULL,
  `operator_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`wholesale_customer_id`),
  UNIQUE KEY `wholesale_customers_email_unique` (`email`),
  KEY `fk_wholesale_customers_operator_id` (`operator_id`),
  KEY `fk_wholesale_customers_customer_outlet_id` (`customer_outlet_id`),
  CONSTRAINT `fk_wholesale_customers_customer_outlet_id` FOREIGN KEY (`customer_outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_wholesale_customers_operator_id` FOREIGN KEY (`operator_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `wholesale_customers`
--

INSERT INTO `wholesale_customers` (`wholesale_customer_id`, `customer_name`, `email`, `contact_info`, `address`, `customer_outlet_id`, `operator_id`, `created_at`, `updated_at`) VALUES
(2, 'Asep', 'asep@gmail.com', '085789959385', 'Jl. Tanah Abang II No. 2, Petojo Selatan, Jakarta Pusat 10160', 54, 59, '2025-01-05 12:26:07', '2025-01-05 12:26:07'),
(3, 'Hepi', 'hepi@gmail.com', '081545454845', 'Jl. Tanah Abang II No. 2, Petojo Selatan, Jakarta Pusat 10160', 54, 59, '2025-01-05 17:00:40', '2025-01-05 17:00:40'),
(4, 'Sugik', 'sugik@gmail.com', '085789959304', 'Jalan Sudirman No. 45, Kelurahan Karet, Kecamatan Setiabudi, Jakarta Selatan 12930', 57, 63, '2025-01-26 04:18:23', '2025-01-26 04:18:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `transaction_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `outlet_id` int(10) unsigned DEFAULT NULL,
  `wholesale_customer_id` int(10) unsigned DEFAULT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `paid_amount` int(11) DEFAULT NULL,
  `received_amount` int(11) DEFAULT NULL,
  `change_amount` int(11) DEFAULT NULL,
  `payment_method` enum('cash','debit','credit','qris','mbanking') NOT NULL,
  `payment_status` enum('lunas','bon') NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','completed','held','partial','cancelled') NOT NULL DEFAULT 'pending',
  `sale_type` enum('ecer','grosir') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bank_id` int(10) unsigned DEFAULT NULL,
  `note` text DEFAULT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `transactions_user_id_foreign` (`user_id`),
  KEY `transactions_outlet_id_foreign` (`outlet_id`),
  KEY `transactions_bank_id_foreign` (`bank_id`),
  KEY `transactions_wholesale_customer_id_foreign` (`wholesale_customer_id`),
  CONSTRAINT `fk_transactions_bank_id` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`bank_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_transactions_outlet_id` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_transactions_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_transactions_wholesale_customer_id` FOREIGN KEY (`wholesale_customer_id`) REFERENCES `wholesale_customers` (`wholesale_customer_id`) ON DELETE SET NULL,
  CONSTRAINT `transactions_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`bank_id`) ON DELETE SET NULL,
  CONSTRAINT `transactions_outlet_id_foreign` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE SET NULL,
  CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL,
  CONSTRAINT `transactions_wholesale_customer_id_foreign` FOREIGN KEY (`wholesale_customer_id`) REFERENCES `wholesale_customers` (`wholesale_customer_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `user_id`, `outlet_id`, `wholesale_customer_id`, `total_amount`, `paid_amount`, `received_amount`, `change_amount`, `payment_method`, `payment_status`, `transaction_date`, `status`, `sale_type`, `created_at`, `updated_at`, `bank_id`, `note`) VALUES
(6, 59, 54, 2, 75000, 75000, 75000, 0, 'mbanking', 'lunas', '2025-01-11 01:15:59', 'completed', 'grosir', '2025-01-11 01:15:59', '2025-01-11 01:15:59', 1, NULL),
(7, 59, 54, 2, 66000, 66000, 66000, 0, 'mbanking', 'lunas', '2025-01-11 01:31:03', 'completed', 'grosir', '2025-01-11 01:31:03', '2025-01-11 01:31:03', 1, NULL),
(8, 59, 54, 2, 100000, 100000, 100000, 0, 'mbanking', 'lunas', '2025-01-11 02:02:50', 'completed', 'ecer', '2025-01-11 02:02:50', '2025-01-11 02:02:50', 1, NULL),
(9, 59, 54, 2, 0, 16100000, 20000000, 3900000, 'cash', 'lunas', '2025-01-11 13:17:50', 'completed', 'ecer', '2025-01-11 13:17:50', '2025-01-11 14:32:51', NULL, NULL),
(10, 59, 54, 3, 15632000, 15632000, 16000000, 368000, 'cash', 'lunas', '2025-01-11 13:18:32', 'completed', 'grosir', '2025-01-11 13:18:32', '2025-01-11 13:18:32', NULL, NULL),
(11, 59, 54, NULL, 200000, 200000, 500000, 300000, 'cash', 'lunas', '2025-01-25 15:41:37', 'completed', 'ecer', '2025-01-25 15:41:37', '2025-01-25 15:41:37', NULL, NULL),
(12, 59, 54, 3, 1300000, 1300000, 1500000, 200000, 'cash', 'lunas', '2025-01-25 15:49:29', 'completed', 'grosir', '2025-01-25 15:49:29', '2025-01-25 15:49:29', NULL, NULL),
(13, 63, 57, NULL, 388500, 388500, 400000, 11500, 'cash', 'lunas', '2025-01-26 04:01:38', 'completed', 'ecer', '2025-01-26 04:01:38', '2025-01-26 04:01:38', NULL, NULL),
(14, 63, 57, 4, 288600, 288600, 600000, 311400, 'cash', 'lunas', '2025-01-26 04:20:48', 'completed', 'grosir', '2025-01-26 04:20:48', '2025-01-26 04:20:48', NULL, NULL),
(15, 63, 57, NULL, 388500, 388500, 400000, 11500, 'cash', 'lunas', '2025-01-27 01:44:03', 'completed', 'ecer', '2025-01-27 01:44:03', '2025-01-27 01:44:03', NULL, NULL),
(16, 63, 57, 4, 288600, 288600, 450000, 161400, 'cash', 'lunas', '2025-01-27 01:45:30', 'completed', 'grosir', '2025-01-27 01:45:30', '2025-01-27 01:45:30', NULL, NULL),
(17, 63, 57, NULL, 388500, 388500, 500000, 111500, 'cash', 'lunas', '2025-01-27 22:57:06', 'completed', 'ecer', '2025-01-27 22:57:06', '2025-01-27 22:57:06', NULL, NULL),
(18, 63, 57, NULL, 388500, 388500, 400000, 11500, 'cash', 'lunas', '2025-01-28 07:32:17', 'completed', 'ecer', '2025-01-28 07:32:17', '2025-01-28 07:32:17', NULL, NULL),
(19, 63, 57, 4, 577200, 577200, 600000, 22800, 'cash', 'lunas', '2025-01-28 07:54:34', 'completed', 'grosir', '2025-01-28 07:54:34', '2025-01-28 07:54:34', NULL, NULL),
(20, 63, 57, 4, 460650, 460650, 500000, 39350, 'cash', 'lunas', '2025-01-28 08:05:09', 'completed', 'grosir', '2025-01-28 08:05:09', '2025-01-28 08:05:09', NULL, NULL),
(21, 63, 57, 4, 1093350, 1093350, 1100000, 6650, 'cash', 'lunas', '2025-01-28 14:45:41', 'completed', 'grosir', '2025-01-28 14:45:41', '2025-01-28 14:45:41', NULL, NULL),
(22, 63, 57, 4, 183150, 183150, 1852000, 1668850, 'cash', 'lunas', '2025-01-28 16:57:32', 'completed', 'ecer', '2025-01-28 16:57:32', '2025-01-28 16:57:32', NULL, NULL),
(23, 63, 57, 4, 183150, 183150, 200000, 16850, 'cash', 'lunas', '2025-01-28 19:53:03', 'completed', 'ecer', '2025-01-28 19:53:03', '2025-01-28 19:53:03', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_items`
--

DROP TABLE IF EXISTS `transaction_items`;
CREATE TABLE `transaction_items` (
  `transaction_item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `product_stocks_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `outlet_id` int(10) unsigned DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_type` enum('percentage','fixed') DEFAULT NULL,
  `subtotal` int(11) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `transaction_items_status` enum('finish','cancelled') NOT NULL DEFAULT 'finish',
  `serial_id` int(10) unsigned DEFAULT NULL,
  `cancel_reason` text DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `cancelled_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`transaction_item_id`),
  KEY `transaction_items_transaction_id_foreign` (`transaction_id`),
  KEY `transaction_items_product_id_foreign` (`product_id`),
  KEY `transaction_items_outlet_id_foreign` (`outlet_id`),
  KEY `transaction_items_user_id_foreign` (`user_id`),
  KEY `fk_transaction_items_serial_id` (`serial_id`),
  KEY `idx_cancelled_by` (`cancelled_by`),
  CONSTRAINT `fk_transaction_items_serial_id` FOREIGN KEY (`serial_id`) REFERENCES `product_serials` (`serial_id`),
  CONSTRAINT `transaction_items_ibfk_1` FOREIGN KEY (`cancelled_by`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaction_items_outlet_id_foreign` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`) ON DELETE SET NULL,
  CONSTRAINT `transaction_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  CONSTRAINT `transaction_items_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`) ON DELETE CASCADE,
  CONSTRAINT `transaction_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaction_items`
--

INSERT INTO `transaction_items` (`transaction_item_id`, `transaction_id`, `product_id`, `product_stocks_id`, `user_id`, `outlet_id`, `quantity`, `price`, `discount`, `discount_type`, `subtotal`, `transaction_date`, `transaction_items_status`, `serial_id`, `cancel_reason`, `cancelled_at`, `cancelled_by`) VALUES
(1, 6, 85, 22, 59, 54, 1, 75000, '0.00', NULL, 75000, '2025-01-11 01:15:59', 'finish', NULL, NULL, NULL, NULL),
(2, 7, 85, 22, 59, 54, 1, 75000, '9000.00', 'percentage', 66000, '2025-01-11 01:31:03', 'finish', NULL, NULL, NULL, NULL),
(3, 8, 85, 22, 59, 54, 1, 100000, '0.00', NULL, 100000, '2025-01-11 02:02:50', 'finish', NULL, NULL, NULL, NULL),
(4, 9, 85, 22, 59, 54, 1, 100000, '0.00', NULL, 100000, '2025-01-11 13:17:50', 'cancelled', NULL, 'Dibatalkan oleh operator', '2025-01-11 14:31:55', 59),
(5, 9, 66, NULL, 59, 54, 1, 16000000, '0.00', NULL, 16000000, '2025-01-11 13:17:50', 'cancelled', 19, 'Dibatalkan oleh operator', '2025-01-11 14:32:51', 59),
(6, 10, 85, 22, 59, 54, 2, 75000, '9000.00', 'percentage', 141000, '2025-01-11 13:18:32', 'finish', NULL, NULL, NULL, NULL),
(7, 10, 66, NULL, 59, 54, 1, 15500000, '0.00', NULL, 15500000, '2025-01-11 13:18:32', 'finish', 21, NULL, NULL, NULL),
(8, 11, 85, 22, 59, 54, 2, 100000, '0.00', NULL, 200000, '2025-01-25 15:41:37', 'finish', NULL, NULL, NULL, NULL),
(9, 12, 70, NULL, 59, 54, 1, 1300000, '0.00', NULL, 1300000, '2025-01-25 15:49:29', 'finish', 63, NULL, NULL, NULL),
(10, 13, 90, 27, 63, 57, 1, 350000, '0.00', NULL, 350000, '2025-01-26 04:01:38', 'finish', NULL, NULL, NULL, NULL),
(11, 14, 90, 27, 63, 57, 1, 260000, '0.00', NULL, 260000, '2025-01-26 04:20:48', 'finish', NULL, NULL, NULL, NULL),
(12, 15, 90, 27, 63, 57, 1, 350000, '0.00', NULL, 350000, '2025-01-27 01:44:03', 'finish', NULL, NULL, NULL, NULL),
(13, 16, 90, 27, 63, 57, 1, 260000, '0.00', NULL, 260000, '2025-01-27 01:45:30', 'finish', NULL, NULL, NULL, NULL),
(14, 17, 90, 27, 63, 57, 1, 350000, '0.00', NULL, 350000, '2025-01-27 22:57:06', 'finish', NULL, NULL, NULL, NULL),
(15, 18, 90, 27, 63, 57, 1, 350000, '0.00', NULL, 350000, '2025-01-28 07:32:17', 'finish', NULL, NULL, NULL, NULL),
(16, 19, 90, 27, 63, 57, 2, 260000, '0.00', NULL, 520000, '2025-01-28 07:54:34', 'finish', NULL, NULL, NULL, NULL),
(17, 20, 91, 28, 63, 57, 1, 155000, '0.00', NULL, 155000, '2025-01-28 08:05:10', 'finish', NULL, NULL, NULL, NULL),
(18, 20, 90, 27, 63, 57, 1, 260000, '0.00', NULL, 260000, '2025-01-28 08:05:10', 'finish', NULL, NULL, NULL, NULL),
(19, 21, 90, 27, 63, 57, 2, 260000, '0.00', NULL, 520000, '2025-01-28 14:45:41', 'finish', NULL, NULL, NULL, NULL),
(20, 21, 91, 28, 63, 57, 3, 155000, '0.00', NULL, 465000, '2025-01-28 14:45:41', 'finish', NULL, NULL, NULL, NULL),
(21, 22, 93, NULL, 63, 57, 1, 165000, '0.00', NULL, 165000, '2025-01-28 16:57:32', 'finish', 260, NULL, NULL, NULL),
(22, 23, 93, NULL, 63, 57, 1, 165000, '0.00', NULL, 165000, '2025-01-28 19:53:03', 'finish', 261, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_permissions`
--

DROP TABLE IF EXISTS `user_permissions`;
CREATE TABLE `user_permissions` (
  `user_permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `operator_id` int(10) unsigned NOT NULL,
  `outlet_id` int(10) unsigned DEFAULT NULL,
  `role_id` int(10) unsigned DEFAULT NULL,
  `can_add_supplier` tinyint(1) DEFAULT 0,
  `can_edit_supplier` tinyint(1) DEFAULT 0,
  `can_delete_supplier` tinyint(1) DEFAULT 0,
  `can_edit_category` tinyint(1) DEFAULT 0,
  `can_delete_category` tinyint(1) DEFAULT 0,
  `can_add_category` tinyint(1) DEFAULT 0,
  `can_edit_product` tinyint(1) DEFAULT 0,
  `can_delete_product` tinyint(1) DEFAULT 0,
  `can_add_product` tinyint(1) DEFAULT 0,
  `can_add_user` tinyint(1) DEFAULT 0,
  `can_edit_user` tinyint(1) DEFAULT 0,
  `can_delete_user` tinyint(1) DEFAULT 0,
  `can_add_product_location` tinyint(1) DEFAULT 0,
  `can_edit_product_location` tinyint(1) DEFAULT 0,
  `can_delete_product_location` tinyint(1) DEFAULT 0,
  `can_see_cost_price` tinyint(1) DEFAULT 0,
  `can_see_sale_price` tinyint(1) DEFAULT 0,
  `can_see_supplier` tinyint(1) DEFAULT 1,
  `can_see_category` tinyint(1) DEFAULT 1,
  `can_see_operator` tinyint(1) DEFAULT 1,
  `can_see_outlet` tinyint(1) DEFAULT 1,
  `can_see_stock` tinyint(1) DEFAULT 1,
  `can_see_brand` tinyint(1) DEFAULT 1,
  `can_see_product_location` tinyint(1) DEFAULT 1,
  `can_see_barcode` tinyint(1) DEFAULT 1,
  `can_see_unit_barcode` tinyint(1) DEFAULT 1,
  `can_see_product_id` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_permission_id`),
  KEY `fk_user_permissions_user_id` (`operator_id`),
  KEY `fk_user_permissions_outlet_id` (`outlet_id`),
  KEY `fk_user_permissions_role_id` (`role_id`),
  CONSTRAINT `fk_user_permissions_operator_id` FOREIGN KEY (`operator_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `fk_user_permissions_outlet_id` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`),
  CONSTRAINT `fk_user_permissions_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_user_permissions_user_id` FOREIGN KEY (`operator_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_permissions`
--

INSERT INTO `user_permissions` (`user_permission_id`, `operator_id`, `outlet_id`, `role_id`, `can_add_supplier`, `can_edit_supplier`, `can_delete_supplier`, `can_edit_category`, `can_delete_category`, `can_add_category`, `can_edit_product`, `can_delete_product`, `can_add_product`, `can_add_user`, `can_edit_user`, `can_delete_user`, `can_add_product_location`, `can_edit_product_location`, `can_delete_product_location`, `can_see_cost_price`, `can_see_sale_price`, `can_see_supplier`, `can_see_category`, `can_see_operator`, `can_see_outlet`, `can_see_stock`, `can_see_brand`, `can_see_product_location`, `can_see_barcode`, `can_see_unit_barcode`, `can_see_product_id`, `created_at`, `updated_at`) VALUES
(83, 58, 54, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2025-01-02 09:09:54', '2025-01-02 09:09:54'),
(84, 58, 54, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2025-01-02 09:22:16', '2025-01-02 09:22:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `warranties`
--

DROP TABLE IF EXISTS `warranties`;
CREATE TABLE `warranties` (
  `warranty_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `outlet_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `warranty_number` varchar(50) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_phone` varchar(20) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('active','expired','claimed') DEFAULT 'active',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`warranty_id`),
  KEY `user_id` (`user_id`),
  KEY `outlet_id` (`outlet_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `warranties_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `warranties_ibfk_2` FOREIGN KEY (`outlet_id`) REFERENCES `outlets` (`outlet_id`),
  CONSTRAINT `warranties_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
