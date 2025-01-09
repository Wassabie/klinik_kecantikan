-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 06, 2025 at 02:00 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

SET NAMES utf8mb4 COLLATE utf8mb4_general_ci;

-- Database: klinik_azra
-- Setting database collation
ALTER DATABASE klinik_azra CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- --------------------------------------------------------

-- Table structure for table account
CREATE TABLE account (
  id int NOT NULL,
  username varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  password varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  role enum('admin','user') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO account (id, username, password, role) VALUES
(5, 'jidan', '$2y$10$BfpMR1CHKTWQZh0.omWvyuaJ8wg63En18Qq0sef2sr8Jy9YPhmkZu', 'admin'),
(6, 'adit', '$2y$10$7Hf9QBNGuIKzWwWUoKgc5OfRfe6Bq9dN/OS/nerjwGYlV0nNLB5jC', 'user');

-- --------------------------------------------------------

-- Table structure for table home_content
CREATE TABLE home_content (
  id int NOT NULL,
  title varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  description text COLLATE utf8mb4_general_ci NOT NULL,
  image varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO home_content (id, title, description, image, created_at, updated_at) VALUES
(1, 'Perawatan Wajah Terbaru!', '(edit) Kami menghadirkan perawatan wajah terbaru dengan teknologi mutakhir untuk kulit sehat dan bercahaya.', 'bg_2.jpg', '2024-12-26 08:28:35', '2024-12-26 08:43:45'),
(2, 'Jadwal Operasi Klinik', 'Klinik kami buka setiap hari Senin-Sabtu, pukul 08.00-20.00 WIB. Minggu dan hari libur nasional tutup.', 'Screenshot 2024-04-26 085758.png', '2024-12-27 08:15:15', '2024-12-27 08:15:15');

-- --------------------------------------------------------

-- Table structure for table products
CREATE TABLE products (
  id int NOT NULL,
  name varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  price decimal(10,2) NOT NULL,
  stock int NOT NULL,
  image varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO products (id, name, price, stock, image, created_at) VALUES
(2, 'Lemon Penyegar', '5000.00', 120, 'bg-jeruk.jpg', '2024-12-23 11:12:01'),
(8, 'Bubuk Herbal', '75000.00', 15, 'bg-abstract.jpg', '2024-12-25 03:44:50'),
(9, 'Hair Dye', '200000.00', 19, 'hair-treatment.jpg', '2024-12-26 07:52:00'),
(10, 'Sun Screen', '70000.00', 65, 'sunscreen-azarine-50.jpg', '2025-01-06 13:53:40');

-- --------------------------------------------------------

-- Table structure for table promos
CREATE TABLE promos (
  id int NOT NULL,
  title varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  description text COLLATE utf8mb4_general_ci NOT NULL,
  valid_until date DEFAULT NULL,
  discount int DEFAULT NULL,
  image varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  created_at datetime DEFAULT CURRENT_TIMESTAMP,
  updated_at datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO promos (id, title, description, valid_until, discount, image, created_at, updated_at) VALUES
(6, 'tes 7', '                    88', '2025-01-08', 77, 'bg-lip.jpg', '2024-12-26 14:51:27', '2025-01-06 19:20:55'),
(8, 'Lentern\'s Rite', 'Glow Up sebelum ketemu cece', '2025-02-28', 60, 'bg-jeruk.jpg', '2025-01-06 19:01:02', NULL),
(9, 'Special New Year', 'New Year New Me!', '2025-01-31', 55, 'newyear.jpg', '2025-01-06 20:01:55', NULL);

-- --------------------------------------------------------

-- Table structure for table treatments
CREATE TABLE treatments (
  id int NOT NULL,
  name varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  description text COLLATE utf8mb4_general_ci NOT NULL,
  price decimal(10,2) NOT NULL,
  image varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO treatments (id, name, description, price, image, created_at, updated_at) VALUES
(2, 'Hair Treatment', 'Merawat & mewarnai rambut', '2000000.00', 'bg-jeruk.jpg', '2024-12-25 05:22:00', '2024-12-25 05:32:36'),
(3, 'Hair test', 'test', '111.00', 'makeup.jpg', '2024-12-25 16:15:04', '2024-12-25 16:15:04'),
(4, 'Lasik', 'aaa', '1234.00', 'pexels-pixabay-356040.jpg', '2024-12-26 07:52:31', '2024-12-26 07:52:31'),
(5, 'Makeup Wedding', 'Pernikahan hanya sekali, tampil cantik maksimal dengan makeup dari kami!', '3500000.00', 'hair-treatment.jpg', '2025-01-06 13:18:24', '2025-01-06 13:18:24');

-- --------------------------------------------------------

-- Table structure for table users
CREATE TABLE users (
  id int NOT NULL,
  username varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  password varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  role enum('admin','user') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO users (id, username, password, role, created_at, updated_at) VALUES
(3, 'adit', '$2y$10$MMqoToei5Q1U41ozkaafGesv9iSHJBS2mgZp.RZ7FAVgR/STm8u1q', 'admin', '2024-12-12 08:02:43', '2024-12-12 08:02:43'),
(5, 'jidan', '$2y$10$DajL.PtzX3bp6L09ptaGQOwo.u.yZ8XNproWntFZ62z4dGkzEWiEK', 'user', '2024-12-12 09:37:21', '2024-12-12 09:37:21');

-- --------------------------------------------------------

COMMIT;
