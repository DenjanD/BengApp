-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2020 at 04:41 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vue_bengapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` char(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Alfien', '082320482627', '2020-04-12 21:17:49', '2020-04-12 21:17:49'),
(2, 'Annisa', '082324125313', '2020-04-12 21:18:02', '2020-04-12 21:18:02');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_roles_table', 1),
(2, '2020_01_26_062534_create_users_table', 1),
(3, '2020_01_26_062848_create_customers_table', 1),
(4, '2020_01_26_063027_create_technicians_table', 1),
(5, '2020_01_26_063110_create_service_jobs_table', 1),
(6, '2020_01_26_070008_create_service_categories_table', 1),
(7, '2020_01_26_070117_create_services_table', 1),
(8, '2020_01_26_070400_create_service_details_table', 1),
(9, '2020_01_26_070914_create_suppliers_table', 1),
(10, '2020_01_26_071115_create_spare_parts_categories_table', 1),
(11, '2020_01_26_071250_create_spare_parts_table', 1),
(12, '2020_01_26_071451_create_purchases_table', 1),
(13, '2020_01_26_071526_create_sales_table', 1),
(14, '2020_02_13_190636_create_service_sjobs_table', 1),
(15, '2020_02_13_190817_create_service_sparts_table', 1),
(16, '2020_04_02_095927_create_sale_details_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` bigint(20) UNSIGNED NOT NULL,
  `spart` bigint(20) UNSIGNED NOT NULL,
  `supplier` bigint(20) UNSIGNED NOT NULL,
  `purchase_date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchase_id`, `spart`, `supplier`, `purchase_date`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-04-02', 3, 400000, '2020-04-02 03:20:46', '2020-04-02 03:20:46'),
(2, 2, 1, '2020-04-02', 5, 300000, '2020-04-02 03:21:13', '2020-04-02 03:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2020-04-02 03:18:30', '2020-04-02 03:18:30'),
(2, 'Kasir', '2020-04-02 23:40:44', '2020-04-02 23:44:04'),
(4, 'Kasir Cadangan', '2020-04-11 02:27:14', '2020-04-11 02:27:24'),
(5, 'Teknisi', '2020-04-11 02:43:40', '2020-04-11 02:43:40');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `total_bill` int(11) NOT NULL,
  `sold_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sale_id`, `total_bill`, `sold_date`, `created_at`, `updated_at`) VALUES
(6, 1320000, '2020-04-02', '2020-04-02 04:34:02', '2020-04-02 04:34:02'),
(7, 500000, '2020-04-02', '2020-04-02 04:36:12', '2020-04-02 04:36:12'),
(8, 320000, '2020-04-02', '2020-04-02 04:36:41', '2020-04-02 04:36:41'),
(9, 500000, '2020-04-02', '2020-04-02 04:41:14', '2020-04-02 04:41:14'),
(10, 960000, '2020-04-02', '2020-04-02 04:44:57', '2020-04-02 04:44:57'),
(11, 320000, '2020-04-03', '2020-04-03 00:02:45', '2020-04-03 00:02:45'),
(12, 320000, '2020-04-13', '2020-04-12 21:35:48', '2020-04-12 21:35:48');

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `spart_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_details`
--

INSERT INTO `sale_details` (`id`, `sale_id`, `spart_id`, `quantity`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 2, 1000000, '2020-04-02 04:34:02', '2020-04-02 04:34:02'),
(2, 6, 2, 1, 320000, '2020-04-02 04:34:02', '2020-04-02 04:34:02'),
(3, 7, 1, 1, 500000, '2020-04-02 04:36:12', '2020-04-02 04:36:12'),
(4, 8, 2, 1, 320000, '2020-04-02 04:36:41', '2020-04-02 04:36:41'),
(5, 9, 1, 1, 500000, '2020-04-02 04:41:14', '2020-04-02 04:41:14'),
(6, 10, 2, 3, 960000, '2020-04-02 04:44:57', '2020-04-02 04:44:57'),
(7, 11, 2, 1, 320000, '2020-04-03 00:02:46', '2020-04-03 00:02:46'),
(8, 12, 2, 1, 320000, '2020-04-12 21:35:48', '2020-04-12 21:35:48');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `teller` bigint(20) UNSIGNED NOT NULL,
  `customer` bigint(20) UNSIGNED NOT NULL,
  `technician` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Done','Working') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `teller`, `customer`, `technician`, `status`, `created_at`, `updated_at`) VALUES
(13, 2, 2, 1, 'Working', '2020-04-13 08:52:21', '2020-04-13 08:52:21'),
(15, 2, 1, 2, 'Working', '2020-04-13 08:53:52', '2020-04-13 08:53:52'),
(16, 3, 1, 3, 'Working', '2020-04-14 07:28:14', '2020-04-14 07:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `scategory_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`scategory_id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Servis Ringan', 30000, '2020-04-13 04:37:10', '2020-04-13 04:37:10'),
(2, 'Servis Berat', 50000, '2020-04-13 04:37:57', '2020-04-13 04:37:57');

-- --------------------------------------------------------

--
-- Table structure for table `service_details`
--

CREATE TABLE `service_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kilometer` int(11) NOT NULL,
  `service_start_time` time NOT NULL,
  `service_date` date NOT NULL,
  `vehicle_license` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_cost` int(11) NOT NULL,
  `spart_cost` int(11) NOT NULL,
  `total_cost` int(11) NOT NULL,
  `vehicle_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complaint_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `scategory` bigint(20) UNSIGNED NOT NULL,
  `service_end_time` time DEFAULT NULL,
  `service_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_details`
--

INSERT INTO `service_details` (`id`, `kilometer`, `service_start_time`, `service_date`, `vehicle_license`, `service_cost`, `spart_cost`, `total_cost`, `vehicle_name`, `complaint_desc`, `scategory`, `service_end_time`, `service_desc`, `created_at`, `updated_at`) VALUES
(13, 15000, '03:52:22', '2020-04-13', 'D 4631 TLG', 830000, 500000, 1330000, 'Honda Genio', 'Bobok Knalpot', 1, NULL, 'Plus beli knalpot', '2020-04-13 08:52:22', '2020-04-13 08:52:22'),
(15, 2555, '03:53:52', '2020-04-13', 'D 5132 TL', 65000, 320000, 385000, 'Honda CBR150', 'Ganti Rante', 1, NULL, '-', '2020-04-13 08:53:52', '2020-04-13 08:53:52'),
(16, 130, '02:28:14', '2020-04-14', 'D 1 TY', 65000, 500000, 565000, 'Honda Rebel 600', 'Oli Kotor', 1, NULL, 'Sekalian ganti knalpot', '2020-04-14 07:28:15', '2020-04-14 07:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `service_jobs`
--

CREATE TABLE `service_jobs` (
  `sjob_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_jobs`
--

INSERT INTO `service_jobs` (`sjob_id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Turun Mesin', 800000, '2020-04-13 04:36:58', '2020-04-13 04:36:58'),
(2, 'Ganti Oli', 35000, '2020-04-13 04:48:28', '2020-04-13 04:48:28');

-- --------------------------------------------------------

--
-- Table structure for table `service_sjobs`
--

CREATE TABLE `service_sjobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `sjob` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_sjobs`
--

INSERT INTO `service_sjobs` (`id`, `service_id`, `sjob`, `created_at`, `updated_at`) VALUES
(23, 13, 1, '2020-04-13 08:52:22', '2020-04-13 08:52:22'),
(24, 15, 2, '2020-04-13 08:53:52', '2020-04-13 08:53:52'),
(25, 16, 2, '2020-04-14 07:28:15', '2020-04-14 07:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `service_sparts`
--

CREATE TABLE `service_sparts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `spart` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_sparts`
--

INSERT INTO `service_sparts` (`id`, `service_id`, `spart`, `created_at`, `updated_at`) VALUES
(19, 13, 1, '2020-04-13 08:52:22', '2020-04-13 08:52:22'),
(20, 15, 2, '2020-04-13 08:53:52', '2020-04-13 08:53:52'),
(21, 16, 1, '2020-04-14 07:28:14', '2020-04-14 07:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `spare_parts`
--

CREATE TABLE `spare_parts` (
  `spart_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spare_parts`
--

INSERT INTO `spare_parts` (`spart_id`, `name`, `brand`, `price`, `quantity`, `category`, `created_at`, `updated_at`) VALUES
(1, 'Power 2500', 'Nobi', 500000, 2, 1, '2020-04-02 03:20:46', '2020-04-14 07:28:15'),
(2, 'Super100', 'Honda', 320000, 1, 3, '2020-04-02 03:21:13', '2020-04-13 08:53:52');

-- --------------------------------------------------------

--
-- Table structure for table `spare_parts_categories`
--

CREATE TABLE `spare_parts_categories` (
  `sp_category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spare_parts_categories`
--

INSERT INTO `spare_parts_categories` (`sp_category_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Knalpot Motor', '2020-04-02 03:19:46', '2020-04-02 03:19:46'),
(2, 'Spion Motor', '2020-04-02 03:20:05', '2020-04-02 03:20:05'),
(3, 'Rantai Motor', '2020-04-02 03:20:12', '2020-04-02 03:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` char(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `name`, `address`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'PT. AHM Indomotor', 'Jakarta Barat', '62284341', '2020-04-02 03:19:05', '2020-04-02 03:19:05'),
(2, 'Yamaha Motor Indonesia', 'Depok', '9841153', '2020-04-02 03:19:22', '2020-04-02 03:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `technicians`
--

CREATE TABLE `technicians` (
  `technician_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('On','Off') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `technicians`
--

INSERT INTO `technicians` (`technician_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Iyus', 'On', '2020-04-02 03:19:27', '2020-04-13 08:52:22'),
(2, 'Yayan', 'On', '2020-04-02 03:19:34', '2020-04-13 04:59:11'),
(3, 'Mamat', 'On', '2020-04-14 07:20:30', '2020-04-14 07:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', '$2y$10$1m6xHa7Uq7PydX6KSy8VTOSELQ185LuH34ymM6YTXoeCu2qf1kYJi', 1, NULL, '2020-04-02 03:18:33', '2020-04-02 03:18:33'),
(2, 'Annisa', '$2y$10$wjOYCyIUcJU7YQqpciSBj.FFbeMeOw/JbdnXdwVEg1VTgWOZ1bSPi', 2, NULL, '2020-04-02 23:51:21', '2020-04-02 23:51:21'),
(3, 'Agus', '$2y$10$GnqsIhTS0i8DK22lZwu.geCVF0QY6UHuF5DrmudqnAxx8J6x3wwuK', 2, NULL, '2020-04-02 23:51:57', '2020-04-02 23:51:57'),
(4, 'Usep', '$2y$10$.p23IU39C.IO/xfiBjp0KOxWYKShGC8PxOdRge7UuJ..Qrwj6R7kK', 2, NULL, '2020-04-11 02:43:09', '2020-04-11 02:43:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `purchases_spart_foreign` (`spart`),
  ADD KEY `purchases_supplier_foreign` (`supplier`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_details_sale_id_foreign` (`sale_id`),
  ADD KEY `sale_details_spart_id_foreign` (`spart_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `services_teller_foreign` (`teller`),
  ADD KEY `services_customer_foreign` (`customer`),
  ADD KEY `services_technician_foreign` (`technician`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`scategory_id`);

--
-- Indexes for table `service_details`
--
ALTER TABLE `service_details`
  ADD KEY `service_details_id_foreign` (`id`),
  ADD KEY `service_details_scategory_foreign` (`scategory`);

--
-- Indexes for table `service_jobs`
--
ALTER TABLE `service_jobs`
  ADD PRIMARY KEY (`sjob_id`);

--
-- Indexes for table `service_sjobs`
--
ALTER TABLE `service_sjobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_sjobs_service_id_foreign` (`service_id`),
  ADD KEY `service_sjobs_sjob_foreign` (`sjob`);

--
-- Indexes for table `service_sparts`
--
ALTER TABLE `service_sparts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_sparts_service_id_foreign` (`service_id`),
  ADD KEY `service_sparts_spart_foreign` (`spart`);

--
-- Indexes for table `spare_parts`
--
ALTER TABLE `spare_parts`
  ADD PRIMARY KEY (`spart_id`),
  ADD KEY `spare_parts_category_foreign` (`category`);

--
-- Indexes for table `spare_parts_categories`
--
ALTER TABLE `spare_parts_categories`
  ADD PRIMARY KEY (`sp_category_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `technicians`
--
ALTER TABLE `technicians`
  ADD PRIMARY KEY (`technician_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `users_role_foreign` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `scategory_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service_jobs`
--
ALTER TABLE `service_jobs`
  MODIFY `sjob_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service_sjobs`
--
ALTER TABLE `service_sjobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `service_sparts`
--
ALTER TABLE `service_sparts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `spare_parts`
--
ALTER TABLE `spare_parts`
  MODIFY `spart_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `spare_parts_categories`
--
ALTER TABLE `spare_parts_categories`
  MODIFY `sp_category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `technicians`
--
ALTER TABLE `technicians`
  MODIFY `technician_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_spart_foreign` FOREIGN KEY (`spart`) REFERENCES `spare_parts` (`spart_id`),
  ADD CONSTRAINT `purchases_supplier_foreign` FOREIGN KEY (`supplier`) REFERENCES `suppliers` (`supplier_id`);

--
-- Constraints for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD CONSTRAINT `sale_details_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`sale_id`),
  ADD CONSTRAINT `sale_details_spart_id_foreign` FOREIGN KEY (`spart_id`) REFERENCES `spare_parts` (`spart_id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_customer_foreign` FOREIGN KEY (`customer`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `services_technician_foreign` FOREIGN KEY (`technician`) REFERENCES `technicians` (`technician_id`),
  ADD CONSTRAINT `services_teller_foreign` FOREIGN KEY (`teller`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `service_details`
--
ALTER TABLE `service_details`
  ADD CONSTRAINT `service_details_id_foreign` FOREIGN KEY (`id`) REFERENCES `services` (`service_id`),
  ADD CONSTRAINT `service_details_scategory_foreign` FOREIGN KEY (`scategory`) REFERENCES `service_categories` (`scategory_id`);

--
-- Constraints for table `service_sjobs`
--
ALTER TABLE `service_sjobs`
  ADD CONSTRAINT `service_sjobs_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`),
  ADD CONSTRAINT `service_sjobs_sjob_foreign` FOREIGN KEY (`sjob`) REFERENCES `service_jobs` (`sjob_id`);

--
-- Constraints for table `service_sparts`
--
ALTER TABLE `service_sparts`
  ADD CONSTRAINT `service_sparts_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`),
  ADD CONSTRAINT `service_sparts_spart_foreign` FOREIGN KEY (`spart`) REFERENCES `spare_parts` (`spart_id`);

--
-- Constraints for table `spare_parts`
--
ALTER TABLE `spare_parts`
  ADD CONSTRAINT `spare_parts_category_foreign` FOREIGN KEY (`category`) REFERENCES `spare_parts_categories` (`sp_category_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_foreign` FOREIGN KEY (`role`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
