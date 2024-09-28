-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2024 at 06:15 PM
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
-- Database: `car_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `car_type` varchar(255) NOT NULL,
  `daily_rent_price` decimal(8,2) NOT NULL,
  `availability` tinyint(1) NOT NULL DEFAULT 1,
  `image` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `brand`, `model`, `year`, `car_type`, `daily_rent_price`, `availability`, `image`, `updated_at`, `created_at`) VALUES
(1, 'Tesla Model S', 'Tesla', 'Model S', 2023, 'Electric', 120.00, 1, 'https://www.motortrend.com/uploads/2022/11/2023-Tesla-Model-S-Plaid-Offsite-38.jpg?w=768&width=768&q=75&format=webp', '2024-09-28 16:02:03', '2024-09-28 16:02:03'),
(2, 'BMW X5', 'BMW', 'X5', 2022, 'SUV', 95.00, 1, 'https://www.loubachrodtbmw.com/blogs/2288/wp-content/uploads/2022/04/2022-bmw-x5.jpg', '2024-09-28 16:02:03', '2024-09-28 16:02:03'),
(3, 'Mercedes-Benz C-Class', 'Mercedes', 'C-Class', 2021, 'Sedan', 85.00, 1, 'https://media.ed.edmunds-media.com/mercedes-benz/c-class/2020/oem/2020_mercedes-benz_c-class_sedan_amg-c-43_fq_oem_1_1600.jpg', '2024-09-28 16:02:15', '2024-09-28 16:02:03'),
(4, 'Audi A4', 'Audi', 'A4', 2022, 'Sedan', 80.00, 1, 'https://i.gaw.to/vehicles/photos/40/28/402804-2022-audi-a4.jpg?1024x640', '2024-09-28 16:02:03', '2024-09-28 16:02:03'),
(5, 'Ford Mustang', 'Ford', 'Mustang', 2023, 'Sports', 150.00, 1, 'https://americancarsandracing.com/wp-content/uploads/2023/09/mustang-dark-horse-1120x630.jpg', '2024-09-28 16:02:03', '2024-09-28 16:02:03'),
(6, 'Toyota Corolla', 'Toyota', 'Corolla', 2021, 'Sedan', 50.00, 1, 'https://img.sm360.ca/images/article/pye-auto/83225//featured_2021-toyota-corolla-hybrid-review-specs-engine-reliability-pricing-and-mpg-explained_15918821001611859911587.jpg', '2024-09-28 16:02:03', '2024-09-28 16:02:03'),
(7, 'Honda CR-V', 'Honda', 'CR-V', 2022, 'SUV', 70.00, 1, 'https://di-uploads-pod36.dealerinspire.com/patriothonda/uploads/2021/12/2022-Honda-CR-V.jpg', '2024-09-28 16:02:23', '2024-09-28 16:02:03'),
(8, 'Chevrolet Silverado', 'Chevrolet', 'Silverado', 2023, 'Truck', 110.00, 1, 'https://di-uploads-pod9.dealerinspire.com/blossomchevy/uploads/2023/01/Chevy-Silverado-1500-Near-Me-2023-Chevy-Silverado-1500-Z71-Trail-Boss-Lake.jpg', '2024-09-28 16:02:03', '2024-09-28 16:02:03'),
(9, 'Porsche 911', 'Porsche', '911', 2023, 'Sports', 200.00, 1, 'https://www.motortrend.com/uploads/2023/11/024-2023-Porsche-911-Sport-Classic-side-view.jpg?w=768&width=768&q=75&format=webp', '2024-09-28 16:02:03', '2024-09-28 16:02:03'),
(10, 'Lexus RX', 'Lexus', 'RX', 2022, 'SUV', 100.00, 1, 'https://www.motortrend.com/uploads/2022/05/2021-Lexus-RX350-F-SPORT-front-three-quarter-1.jpg', '2024-09-28 16:02:31', '2024-09-28 16:02:03');

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
(30, '0001_01_01_000000_create_users_table', 1),
(31, '2024_09_24_132209_create_cars_table', 1),
(32, '2024_09_24_132255_create_rentals_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_cost` decimal(8,2) NOT NULL,
  `car_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`id`, `start_date`, `end_date`, `total_cost`, `car_id`, `user_id`, `updated_at`, `created_at`) VALUES
(1, '2024-09-10', '2024-09-12', 120.00, 1, 1, '2024-09-28 16:08:13', '2024-09-28 16:07:11'),
(2, '2024-09-13', '2024-09-15', 95.00, 2, 1, '2024-09-28 16:08:32', '2024-09-28 16:07:11'),
(3, '2024-09-26', '2024-09-28', 85.00, 3, 1, '2024-09-28 16:08:39', '2024-09-28 16:07:11'),
(4, '2024-09-27', '2024-09-29', 80.00, 4, 1, '2024-09-28 16:08:53', '2024-09-28 16:07:11'),
(5, '2024-10-01', '2024-10-03', 150.00, 5, 1, '2024-09-28 16:09:13', '2024-09-28 16:07:11'),
(6, '2024-10-04', '2024-10-06', 50.00, 6, 1, '2024-09-28 16:09:21', '2024-09-28 16:07:11'),
(7, '2024-09-10', '2024-09-13', 70.00, 7, 2, '2024-09-28 16:09:31', '2024-09-28 16:07:11'),
(8, '2024-10-01', '2024-10-03', 120.00, 1, 2, '2024-09-28 16:09:40', '2024-09-28 16:07:11'),
(9, '2024-10-04', '2024-10-06', 95.00, 2, 2, '2024-09-28 16:10:00', '2024-09-28 16:07:11'),
(10, '2024-09-10', '2024-09-12', 85.00, 3, 3, '2024-09-28 16:10:05', '2024-09-28 16:07:11'),
(11, '2024-09-13', '2024-09-15', 80.00, 4, 3, '2024-09-28 16:10:10', '2024-09-28 16:07:11'),
(12, '2024-09-26', '2024-09-28', 150.00, 5, 3, '2024-09-28 16:10:17', '2024-09-28 16:07:11'),
(13, '2024-09-27', '2024-09-29', 50.00, 6, 3, '2024-09-28 16:10:24', '2024-09-28 16:07:11'),
(14, '2024-10-01', '2024-10-03', 70.00, 7, 3, '2024-09-28 16:10:30', '2024-09-28 16:07:11'),
(15, '2024-09-26', '2024-09-28', 120.00, 1, 4, '2024-09-28 16:10:39', '2024-09-28 16:07:11'),
(16, '2024-09-27', '2024-09-29', 95.00, 2, 4, '2024-09-28 16:10:46', '2024-09-28 16:07:11'),
(17, '2024-10-01', '2024-10-03', 85.00, 3, 4, '2024-09-28 16:10:53', '2024-09-28 16:07:11'),
(18, '2024-10-04', '2024-10-06', 80.00, 4, 4, '2024-09-28 16:11:00', '2024-09-28 16:07:11'),
(19, '2024-09-10', '2024-09-12', 150.00, 5, 5, '2024-09-28 16:07:11', '2024-09-28 16:07:11'),
(20, '2024-09-13', '2024-09-15', 50.00, 6, 5, '2024-09-28 16:11:21', '2024-09-28 16:07:11'),
(21, '2024-09-26', '2024-09-28', 70.00, 7, 5, '2024-09-28 16:11:27', '2024-09-28 16:07:11'),
(22, '2024-09-10', '2024-09-12', 120.00, 1, 6, '2024-09-28 16:11:44', '2024-09-28 16:07:11'),
(23, '2024-09-13', '2024-09-15', 95.00, 2, 6, '2024-09-28 16:11:52', '2024-09-28 16:07:11'),
(24, '2024-09-26', '2024-09-28', 85.00, 3, 6, '2024-09-28 16:11:57', '2024-09-28 16:07:11'),
(25, '2024-09-27', '2024-09-29', 80.00, 4, 6, '2024-09-28 16:12:04', '2024-09-28 16:07:11'),
(26, '2024-10-01', '2024-10-03', 150.00, 5, 6, '2024-09-28 16:14:58', '2024-09-28 16:07:11'),
(27, '2024-10-04', '2024-10-06', 50.00, 6, 6, '2024-09-28 16:13:44', '2024-09-28 16:07:11'),
(28, '2024-09-10', '2024-09-12', 70.00, 7, 7, '2024-09-28 16:13:49', '2024-09-28 16:07:11'),
(29, '2024-10-01', '2024-10-03', 120.00, 1, 7, '2024-09-28 16:14:14', '2024-09-28 16:07:11'),
(30, '2024-10-04', '2024-10-06', 95.00, 2, 7, '2024-09-28 16:14:21', '2024-09-28 16:07:11');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'customer',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `role`, `updated_at`, `created_at`) VALUES
(1, 'John Doe', 'john@example.com', '1234', '1234567890', '123 Main St', 'admin', '2024-09-28 16:01:25', '2024-09-28 16:01:25'),
(2, 'Jane Smith', 'jane@example.com', '1234', '2345678901', '456 Oak St', 'customer', '2024-09-28 16:01:25', '2024-09-28 16:01:25'),
(3, 'Bob Johnson', 'bob@example.com', '1234', '3456789012', '789 Pine St', 'customer', '2024-09-28 16:01:25', '2024-09-28 16:01:25'),
(4, 'Alice Williams', 'alice@example.com', '1234', '4567890123', '321 Elm St', 'customer', '2024-09-28 16:01:25', '2024-09-28 16:01:25'),
(5, 'Michael Brown', 'michael@example.com', '1234', '5678901234', '654 Maple St', 'customer', '2024-09-28 16:01:25', '2024-09-28 16:01:25'),
(6, 'Emily Davis', 'emily@example.com', '1234', '6789012345', '987 Cedar St', 'customer', '2024-09-28 16:01:25', '2024-09-28 16:01:25'),
(7, 'Chris Wilson', 'chris@example.com', '1234', '7890123456', '159 Birch St', 'customer', '2024-09-28 16:01:25', '2024-09-28 16:01:25'),
(8, 'Karen Miller', 'karen@example.com', '1234', '8901234567', '753 Spruce St', 'customer', '2024-09-28 16:01:25', '2024-09-28 16:01:25'),
(9, 'David Lee', 'david@example.com', '1234', '9012345678', '852 Redwood St', 'customer', '2024-09-28 16:01:25', '2024-09-28 16:01:25'),
(10, 'Sara White', 'sara@example.com', '1234', '0123456789', '963 Cherry St', 'customer', '2024-09-28 16:01:25', '2024-09-28 16:01:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rentals_car_id_foreign` (`car_id`),
  ADD KEY `rentals_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rentals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
