-- Table: activity_logs

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

-- Table: akurasi

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

-- Table: banks

CREATE TABLE `banks` (
  `bank_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `outlet_id` int(10) unsigned NOT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: cache

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: cache_locks

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: cash_registers

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

-- Table: categories

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

-- Table: discounts

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

-- Table: failed_jobs

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

-- Table: held_transactions

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

-- Table: job_batches

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

-- Table: jobs

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

-- Table: kas_adjustments

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

-- Table: kas_akhir

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

-- Table: kas_awal

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

-- Table: membership_change_requests

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

-- Table: membership_history

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

-- Table: memberships

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

-- Table: migrations

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: outlet_groups

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

-- Table: outlets

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

-- Table: payment_confirmations

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

-- Table: penambahan_kas

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

-- Table: penarikan_kas

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

-- Table: perpajakan

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

-- Table: product_adjustments

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

-- Table: product_images

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

-- Table: product_serials

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

-- Table: product_stock

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

-- Table: product_transits

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

-- Table: product_types

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

-- Table: products

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

-- Table: rekening_owner

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

-- Table: roles

CREATE TABLE `roles` (
  `role_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: saran

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

-- Table: services

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

-- Table: sessions

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

-- Table: suppliers

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

-- Table: teknisi

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

-- Table: transaction_items

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

-- Table: transactions

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

-- Table: user_permissions

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

-- Table: users

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

-- Table: warranties

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

-- Table: wholesale_customers

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

