-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 12, 2025 at 04:48 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik_azra`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `role`) VALUES
(5, 'jidan', '$2y$10$BfpMR1CHKTWQZh0.omWvyuaJ8wg63En18Qq0sef2sr8Jy9YPhmkZu', 'admin'),
(6, 'adit', '$2y$10$7Hf9QBNGuIKzWwWUoKgc5OfRfe6Bq9dN/OS/nerjwGYlV0nNLB5jC', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `home_content`
--

CREATE TABLE `home_content` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `home_content`
--

INSERT INTO `home_content` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Perawatan Wajah Terbaru!', '(edit) Kami menghadirkan perawatan wajah terbaru dengan teknologi mutakhir untuk kulit sehat dan bercahaya.', 'bg_2.jpg', '2024-12-26 08:28:35', '2024-12-26 08:43:45'),
(2, 'Jadwal Operasi Klinik', 'Klinik kami buka setiap hari Senin-Sabtu, pukul 08.00-20.00 WIB. Minggu dan hari libur nasional tutup.', 'Screenshot 2024-04-26 085758.png', '2024-12-27 08:15:15', '2024-12-27 08:15:15');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `promo_id` int DEFAULT NULL,
  `category` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `stock`, `image`, `created_at`, `promo_id`, `category`) VALUES
(10, 'Sun Screen', '70000.00', 65, 'sunscreen-azarine-50.jpg', '2025-01-06 13:53:40', NULL, 'skincare'),
(12, 'Bedak Bercula 1', '20000.00', 3, 'hair-treatment.jpg', '2025-01-11 12:26:20', NULL, 'Kosmetiq'),
(13, 'Lemon Penyegar', '8000.00', 25, 'bg-jeruk.jpg', '2025-01-11 14:05:38', NULL, 'Herbal');

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

CREATE TABLE `promos` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `valid_until` date DEFAULT NULL,
  `discount` int DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `category` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promos`
--

INSERT INTO `promos` (`id`, `title`, `description`, `valid_until`, `discount`, `image`, `created_at`, `updated_at`, `category`) VALUES
(6, 'tes 7', '                    88', '2025-01-08', 77, 'bg-lip.jpg', '2024-12-26 14:51:27', '2025-01-06 19:20:55', NULL),
(8, 'Lentern\'s Rite', 'Glow Up sebelum ketemu cece', '2025-02-28', 60, 'bg-jeruk.jpg', '2025-01-06 19:01:02', NULL, NULL),
(9, 'Special New Year', 'New Year New Me!', '2025-01-31', 55, 'newyear.jpg', '2025-01-06 20:01:55', '2025-01-11 21:20:33', 'skincare'),
(10, 'Spesial Lebaran', 'Dapatkan penawaran yang menarik!', '2025-01-31', 60, 'bg-jeruk.jpg', '2025-01-09 16:10:46', '2025-01-11 21:20:22', 'herbal'),
(11, 'Tes1', '                        Tes1', '2025-02-01', 20, 'bg-abstract.jpg', '2025-01-11 19:19:38', '2025-01-11 20:01:47', 'Kosmetiq');

-- --------------------------------------------------------

--
-- Table structure for table `treatments`
--

CREATE TABLE `treatments` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `treatments`
--

INSERT INTO `treatments` (`id`, `name`, `description`, `price`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Hair Treatment', 'Merawat & mewarnai rambut', '2000000.00', 'bg-jeruk.jpg', '2024-12-25 05:22:00', '2024-12-25 05:32:36'),
(3, 'Hair test', 'test', '111.00', 'makeup.jpg', '2024-12-25 16:15:04', '2024-12-25 16:15:04'),
(4, 'Lasik', 'iii', '1234.00', 'pexels-pixabay-356040.jpg', '2024-12-26 07:52:31', '2025-01-11 14:44:41'),
(5, 'Makeup Wedding', 'Pernikahan hanya sekali, tampil cantik maksimal dengan makeup dari kami!', '3500000.00', 'hair-treatment.jpg', '2025-01-06 13:18:24', '2025-01-06 13:18:24'),
(7, 'xxx', 'xxx', '1111.00', 'bg-abstract.jpg', '2025-01-08 09:00:06', '2025-01-08 09:00:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(3, 'adit', '$2y$10$MMqoToei5Q1U41ozkaafGesv9iSHJBS2mgZp.RZ7FAVgR/STm8u1q', 'admin', '2024-12-12 08:02:43', '2024-12-12 08:02:43'),
(5, 'jidan', '$2y$10$DajL.PtzX3bp6L09ptaGQOwo.u.yZ8XNproWntFZ62z4dGkzEWiEK', 'user', '2024-12-12 09:37:21', '2024-12-12 09:37:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_content`
--
ALTER TABLE `home_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promo_id` (`promo_id`);

--
-- Indexes for table `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treatments`
--
ALTER TABLE `treatments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `home_content`
--
ALTER TABLE `home_content`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `treatments`
--
ALTER TABLE `treatments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`promo_id`) REFERENCES `promos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
