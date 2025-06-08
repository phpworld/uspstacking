-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2025 at 03:10 PM
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
-- Database: `usps`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `role` enum('super_admin','admin','moderator') NOT NULL DEFAULT 'admin',
  `status` enum('active','inactive','suspended') NOT NULL DEFAULT 'active',
  `last_login` datetime DEFAULT NULL,
  `login_attempts` int(3) NOT NULL DEFAULT 0,
  `locked_until` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `role`, `status`, `last_login`, `login_attempts`, `locked_until`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$vzgmMrqNZDj7ZlJWfWBtEOnlcON8yhpb8AjclBZetS5x2RNghGG2a', 'System', 'Administrator', 'super_admin', 'active', '2025-06-08 12:27:12', 0, NULL, '2025-05-31 13:03:12', '2025-06-08 12:27:12');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-01-01-000001', 'App\\Database\\Migrations\\CreateAdminUsersTable', 'default', 'App', 1748696380, 1),
(2, '2025-01-16-120000', 'App\\Database\\Migrations\\CreateTrackingParcelsTable', 'default', 'App', 1748776216, 2),
(3, '2025-01-16-120001', 'App\\Database\\Migrations\\CreateTrackingTimelineTable', 'default', 'App', 1748776217, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tracking_parcels`
--

CREATE TABLE `tracking_parcels` (
  `id` int(11) UNSIGNED NOT NULL,
  `tracking_number` varchar(20) NOT NULL,
  `status` enum('pending','collected','in_transit','out_for_delivery','delivered','failed_delivery','returned') NOT NULL DEFAULT 'pending',
  `service_type` varchar(100) NOT NULL,
  `estimated_delivery` datetime DEFAULT NULL,
  `actual_delivery` datetime DEFAULT NULL,
  `sender_company` varchar(200) NOT NULL,
  `sender_contact` varchar(100) NOT NULL,
  `sender_address` text NOT NULL,
  `sender_phone` varchar(20) DEFAULT NULL,
  `sender_email` varchar(100) DEFAULT NULL,
  `sender_reference` varchar(100) DEFAULT NULL,
  `receiver_name` varchar(100) NOT NULL,
  `receiver_title` varchar(10) DEFAULT NULL,
  `receiver_address` text NOT NULL,
  `receiver_phone` varchar(20) DEFAULT NULL,
  `receiver_email` varchar(100) DEFAULT NULL,
  `receiver_instructions` text DEFAULT NULL,
  `parcel_type` varchar(50) NOT NULL,
  `parcel_weight` varchar(20) DEFAULT NULL,
  `parcel_dimensions` varchar(50) DEFAULT NULL,
  `parcel_contents` varchar(500) NOT NULL,
  `parcel_value` decimal(10,2) DEFAULT NULL,
  `parcel_insurance` decimal(10,2) DEFAULT NULL,
  `parcel_postage` decimal(10,2) DEFAULT NULL,
  `signature_required` tinyint(1) NOT NULL DEFAULT 0,
  `current_location` varchar(200) DEFAULT NULL,
  `current_facility` varchar(200) DEFAULT NULL,
  `facility_address` text DEFAULT NULL,
  `distance_from_destination` varchar(50) DEFAULT NULL,
  `postcode_area` varchar(10) DEFAULT NULL,
  `delivery_round` varchar(50) DEFAULT NULL,
  `last_location_update` datetime DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tracking_parcels`
--

INSERT INTO `tracking_parcels` (`id`, `tracking_number`, `status`, `service_type`, `estimated_delivery`, `actual_delivery`, `sender_company`, `sender_contact`, `sender_address`, `sender_phone`, `sender_email`, `sender_reference`, `receiver_name`, `receiver_title`, `receiver_address`, `receiver_phone`, `receiver_email`, `receiver_instructions`, `parcel_type`, `parcel_weight`, `parcel_dimensions`, `parcel_contents`, `parcel_value`, `parcel_insurance`, `parcel_postage`, `signature_required`, `current_location`, `current_facility`, `facility_address`, `distance_from_destination`, `postcode_area`, `delivery_round`, `last_location_update`, `notes`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'RM314974905GB', 'out_for_delivery', 'First Class', '2025-06-01 16:46:00', NULL, 'Rainbow ', 'Emily', '238 Willow Creek Rd\r\nGreensboro, NC 27410\r\nUnited States', '9876598765', 'vinaysingh43@gmail.com', '', 'Vinay Kumar Singh', 'Mr', '4127 Maplewood Lane\r\nBrookhaven, IL 60563\r\nUnited States', '2323232332', 'RainbosasMail@gmail.com', 'Handle With Care', 'Small Parcel', '2kg', '30x20', 'wait for Sort Facility ', 21.99, 0.00, 0.00, 0, '', '', NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-06-01 11:13:27', '2025-06-01 11:27:25'),
(2, 'RM412953945GB', 'pending', 'Second Class', '2025-06-12 18:34:00', NULL, 'Digital Creative', 'Vinay Kumar Singh', 'LGF 77 Office No 23 Papnamow Road Anorana kalan Chinhut Lucknow  226028', '9876598765', 'vinaysingh43@gmail.com', '', 'Rohit Singh', 'Mr', ' Papnamow Road Anorana kalan Noth karoliena New York   USA', '2323232332', 'Rainbos@gmail.com', '', 'Small Parcel', '500 gm', '30x20', 'Doccument Parcel', 25.00, 0.00, 0.00, 1, '', '', NULL, NULL, NULL, NULL, NULL, '', 1, NULL, '2025-06-08 13:04:31', '2025-06-08 13:04:31');

-- --------------------------------------------------------

--
-- Table structure for table `tracking_timeline`
--

CREATE TABLE `tracking_timeline` (
  `id` int(11) UNSIGNED NOT NULL,
  `tracking_id` int(11) UNSIGNED NOT NULL,
  `status` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `location` varchar(200) NOT NULL,
  `facility` varchar(200) DEFAULT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tracking_timeline`
--

INSERT INTO `tracking_timeline` (`id`, `tracking_id`, `status`, `description`, `location`, `facility`, `event_date`, `event_time`, `icon`, `color`, `notes`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Collected', 'Item collected from sender', 'Collection Point', 'Local Post Office', '2025-06-01', '11:13:27', 'fas fa-box', 'info', NULL, NULL, '2025-06-01 11:13:27', '2025-06-01 11:13:27'),
(2, 1, 'Out For Delivery', 'Will Call You When he Arrived', 'Noth Carolina', '', '2025-06-01', '11:28:41', 'fas fa-info-circle', 'secondary', '', 1, '2025-06-01 11:28:41', '2025-06-01 11:28:41'),
(3, 2, 'Pending', 'Item ready for collection', 'Sender Location', 'Awaiting Collection', '2025-06-08', '13:04:31', 'fas fa-clock', 'warning', NULL, NULL, '2025-06-08 13:04:31', '2025-06-08 13:04:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracking_parcels`
--
ALTER TABLE `tracking_parcels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tracking_number` (`tracking_number`),
  ADD KEY `status` (`status`),
  ADD KEY `service_type` (`service_type`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `sender_company` (`sender_company`),
  ADD KEY `receiver_name` (`receiver_name`);

--
-- Indexes for table `tracking_timeline`
--
ALTER TABLE `tracking_timeline`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tracking_id` (`tracking_id`),
  ADD KEY `event_date_event_time` (`event_date`,`event_time`),
  ADD KEY `status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tracking_parcels`
--
ALTER TABLE `tracking_parcels`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tracking_timeline`
--
ALTER TABLE `tracking_timeline`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tracking_timeline`
--
ALTER TABLE `tracking_timeline`
  ADD CONSTRAINT `tracking_timeline_tracking_id_foreign` FOREIGN KEY (`tracking_id`) REFERENCES `tracking_parcels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
