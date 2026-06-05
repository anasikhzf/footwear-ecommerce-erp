-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jun 2024 pada 08.29
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `psdp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `billing_details`
--

CREATE TABLE `billing_details` (
  `billing_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tlp_number` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `billing_details`
--

INSERT INTO `billing_details` (`billing_id`, `user_id`, `name`, `tlp_number`, `address`, `created_at`) VALUES
(58, 3, 'Rizky Dwi Kurniawan', '089676244130', 'Jawa Timur, Sidoarjo, Buduran, 61252 Jl. Sapujagad Rumah Dekat Sawah', '2024-06-25 19:10:38'),
(64, 3, 'Rizky Dwi Kurniawan', '089676244130', 'Jawa Timur, Sidoarjo, Buduran, 61252 Jl. Sapujagad Rumah sebalah masjid', '2024-06-25 20:21:17'),
(65, 3, 'Rizky Dwi Kurniawan', '089676244130', 'Jawa Timur, Sidoarjo, Buduran, 61252 Jl. Sapujagad Rumah sebelah masjid', '2024-06-25 20:33:49'),
(66, 4, 'Sabil Sabilillah', '085536733611', 'Jawa Timur, Gresik, Dukun, 61155 Jl. Kecubung Rumah depan jalan', '2024-06-26 00:38:44'),
(67, 6, 'Fikri Abdullah', '082337636759', 'Jawa Timur, Sampang, Kamal, 615425 Jl. Kebangsaan Rumah depan toko', '2024-06-26 00:42:11'),
(80, 5, 'Nasikh Zainal', '085812349156', 'Jawa Timur, Lamongan, Pucuk, 61275 Jl Ciptomangunkusumo Rumah sebelah sawah', '2024-06-26 01:07:10'),
(81, 2, 'Ade Verdaus', '085600879125', 'Jawa Tengah, Kudus, Socah, 45454 Jl. Sultan Agung Rumah pinggir sungai', '2024-06-26 01:23:24'),
(82, 1, 'Faril Ainur', '085730264843', 'Jawa Timur, Lamongan, Kamal, 61434 Jl. Gajah Mada Rumah depan jalan raya', '2024-06-26 01:25:43'),
(83, 1, 'Faril Ainur', '085730264843', 'Jawa Timur, Lamongan, Kamal, 61434\r\n Jl. Gajah Mada Rumah depan jalan raya', '2024-06-26 01:26:44'),
(84, 4, 'Sabil Sabilillah', '085536733611', 'Jawa Timur, Gresik, Dukun, 61155 Jl. Kecubung Rumah depan jalan', '2024-06-26 01:29:17'),
(85, 6, 'Fikri Abdullah', '082337636759', 'Jawa Timur, Sampang, Kamal, 615242 Jl Pattimura Rumah dekat sawah', '2024-06-26 01:31:05'),
(86, 6, 'Fikri Abdullah', '089676244130', 'Jawa Timur, Sampang, Kamal, 615242 Jl Pattimura Rumah dekat jalan', '2024-06-26 01:32:35'),
(87, 4, 'Sabil Sabilillah', '085536733611', 'Jawa Timur, Gresik, Dukun, 61155 Jl. Kecubung Rumah depan jalan', '2024-06-26 01:33:35'),
(88, 3, 'Rizky Dwi Kurniawan', '089676244130', 'Jawa Timur, Sidoarjo, Buduran, 61252 Jl. Sapujagad Rumah dekat air terjun', '2024-06-26 01:35:04'),
(89, 1, 'Faril Ainur', '085730264843', 'Jawa Timur, Lamongan, Kamal, 61434 Jl. Gajah Mada Rumah depan jalan raya', '2024-06-26 01:36:39'),
(90, 1, 'Faril Ainur', '085730264843', 'Jawa Timur, Lamongan, Kamal, 61434 Jl. Gajah Mada Rumah depan jalan raya', '2024-06-26 01:37:33'),
(91, 2, 'Ade Verdaus', '085600879125', 'Jawa Tengah, Kudus, Socah, 45454 Jl. Sultan Agung Rumah pinggir sungai', '2024-06-26 01:38:19'),
(92, 5, 'Nasikh Zainal', '085812349156', 'Jawa Timur, Lamongan, Pucuk, 61275 Jl Ciptomangunkusumo Rumah sebelah sawah', '2024-06-26 01:39:18'),
(93, 5, 'Nasikh Zainal', '085812349156', 'Jawa Timur, Lamongan, Pucuk, 61275 Jl Ciptomangunkusumo Rumah sebelah sawah', '2024-06-26 01:40:06'),
(94, 3, 'Sabil Sabilillah', '085536733611', 'Jawa Timur, Gresik, Dukun, 61155 Jl. Kecubung Rumah depan jalan', '2024-06-26 01:57:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sepatu_id` int(11) DEFAULT NULL,
  `ukuran_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `sepatu_id`, `ukuran_id`, `quantity`, `unit_price`, `total_price`, `created_at`) VALUES
(12, 4, 2, 8, 3, '450000.00', '1350000.00', '2024-06-25 09:45:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(255) NOT NULL,
  `kategori_gambar` varchar(255) NOT NULL,
  `data_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_nama`, `kategori_gambar`, `data_created`) VALUES
(7, 'Sports', 'kategori1717487871.jpeg', '2024-06-04 07:57:51'),
(8, 'Casual', 'kategori1717487878.jpeg', '2024-06-04 07:57:58'),
(9, 'Formal', 'kategori1717490832.jpeg', '2024-06-04 07:58:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `billing_id` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `shipping` decimal(10,2) NOT NULL,
  `order_total` decimal(10,2) NOT NULL,
  `payment` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`order_id`, `billing_id`, `subtotal`, `shipping`, `order_total`, `payment`) VALUES
(42, 58, '1150000.00', '10000.00', '1160000.00', '1160000.00'),
(48, 64, '1600000.00', '10000.00', '1610000.00', '1610000.00'),
(49, 65, '2000000.00', '10000.00', '2010000.00', '2010000.00'),
(50, 66, '1600000.00', '10000.00', '1610000.00', '1610000.00'),
(51, 67, '3000000.00', '10000.00', '3010000.00', '3010000.00'),
(64, 80, '3460000.00', '10000.00', '3470000.00', '3470000.00'),
(65, 81, '2700000.00', '10000.00', '2710000.00', '2710000.00'),
(66, 82, '2480000.00', '10000.00', '2490000.00', '2490000.00'),
(67, 83, '800000.00', '10000.00', '810000.00', '810000.00'),
(68, 84, '2100000.00', '10000.00', '2110000.00', '2110000.00'),
(69, 85, '2700000.00', '10000.00', '2710000.00', '2710000.00'),
(70, 86, '2800000.00', '10000.00', '2810000.00', '2810000.00'),
(71, 87, '1350000.00', '10000.00', '1360000.00', '1360000.00'),
(72, 88, '500000.00', '10000.00', '510000.00', '510000.00'),
(73, 89, '900000.00', '10000.00', '910000.00', '910000.00'),
(74, 90, '1200000.00', '10000.00', '1210000.00', '1210000.00'),
(75, 91, '4000000.00', '10000.00', '4010000.00', '4010000.00'),
(76, 92, '3500000.00', '10000.00', '3510000.00', '3510000.00'),
(77, 93, '2700000.00', '10000.00', '2710000.00', '2710000.00'),
(78, 94, '2000000.00', '10000.00', '2010000.00', '2010000.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `sepatu_id` int(11) NOT NULL,
  `ukuran_id` int(11) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `sepatu_id`, `ukuran_id`, `product_price`, `quantity`, `created_at`) VALUES
(5, 42, 31, 1, '1150000.00', 1, '2024-06-25 19:10:38'),
(7, 48, 8, 1, '800000.00', 2, '2024-06-25 20:21:17'),
(8, 49, 5, 1, '500000.00', 4, '2024-06-25 20:33:49'),
(9, 50, 15, 5, '800000.00', 2, '2024-06-26 00:38:44'),
(10, 51, 10, 8, '1000000.00', 3, '2024-06-26 00:42:11'),
(12, 64, 24, 5, '865000.00', 4, '2024-06-26 01:07:10'),
(13, 65, 28, 3, '1350000.00', 2, '2024-06-26 01:23:24'),
(14, 66, 30, 4, '1240000.00', 2, '2024-06-26 01:25:43'),
(15, 67, 15, 4, '800000.00', 1, '2024-06-26 01:26:44'),
(16, 68, 26, 5, '700000.00', 3, '2024-06-26 01:29:17'),
(17, 69, 25, 1, '900000.00', 3, '2024-06-26 01:31:05'),
(18, 70, 26, 5, '700000.00', 4, '2024-06-26 01:32:35'),
(19, 71, 2, 5, '450000.00', 3, '2024-06-26 01:33:35'),
(20, 72, 3, 8, '500000.00', 1, '2024-06-26 01:35:04'),
(21, 73, 6, 2, '300000.00', 3, '2024-06-26 01:36:39'),
(22, 74, 4, 4, '600000.00', 2, '2024-06-26 01:37:33'),
(23, 75, 29, 2, '1000000.00', 4, '2024-06-26 01:38:19'),
(24, 76, 27, 2, '700000.00', 5, '2024-06-26 01:39:18'),
(25, 77, 28, 3, '1350000.00', 2, '2024-06-26 01:40:06'),
(26, 78, 10, 4, '1000000.00', 2, '2024-06-26 01:57:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `sepatu_id` int(11) DEFAULT NULL,
  `ukuran_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` enum('pending','completed') DEFAULT 'completed',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `request`
--

INSERT INTO `request` (`request_id`, `sepatu_id`, `ukuran_id`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(3, 31, 6, 1, 'completed', '2024-06-08 15:23:03', '2024-06-08 15:23:09'),
(4, 31, 4, 5, 'completed', '2024-06-08 15:26:29', '2024-06-08 15:26:36'),
(5, 31, 1, 4, 'completed', '2024-06-08 15:36:15', '2024-06-08 15:41:02'),
(6, 31, 2, 6, 'completed', '2024-06-08 15:36:15', '2024-06-08 15:41:05'),
(7, 31, 3, 3, 'completed', '2024-06-08 15:36:15', '2024-06-08 15:41:04'),
(8, 31, 5, 2, 'completed', '2024-06-08 15:36:15', '2024-06-08 15:41:06'),
(9, 31, 6, 2, 'completed', '2024-06-08 15:36:15', '2024-06-08 15:41:05'),
(10, 31, 7, 11, 'completed', '2024-06-08 15:36:15', '2024-06-08 15:41:04'),
(11, 31, 8, 2, 'completed', '2024-06-08 15:36:15', '2024-06-08 15:41:03'),
(12, 30, 1, 4, 'completed', '2024-06-08 15:37:08', '2024-06-08 15:41:06'),
(13, 30, 2, 9, 'completed', '2024-06-08 15:37:08', '2024-06-08 15:41:08'),
(14, 30, 3, 13, 'completed', '2024-06-08 15:37:08', '2024-06-08 15:41:06'),
(15, 30, 4, 15, 'completed', '2024-06-08 15:37:08', '2024-06-08 15:41:09'),
(16, 30, 5, 10, 'completed', '2024-06-08 15:37:08', '2024-06-08 15:41:07'),
(17, 30, 6, 5, 'completed', '2024-06-08 15:37:08', '2024-06-08 15:41:07'),
(18, 30, 7, 2, 'completed', '2024-06-08 15:37:08', '2024-06-08 15:41:08'),
(19, 30, 8, 1, 'completed', '2024-06-08 15:37:08', '2024-06-08 15:41:07'),
(20, 29, 1, 1, 'completed', '2024-06-08 15:37:51', '2024-06-08 15:41:09'),
(21, 29, 2, 10, 'completed', '2024-06-08 15:37:51', '2024-06-08 15:41:12'),
(22, 29, 3, 14, 'completed', '2024-06-08 15:37:51', '2024-06-08 15:41:10'),
(23, 29, 5, 8, 'completed', '2024-06-08 15:37:51', '2024-06-08 15:41:12'),
(24, 29, 6, 1, 'completed', '2024-06-08 15:37:51', '2024-06-08 15:41:12'),
(25, 29, 7, 9, 'completed', '2024-06-08 15:37:51', '2024-06-08 15:41:11'),
(26, 28, 2, 3, 'completed', '2024-06-08 15:38:29', '2024-06-08 15:41:15'),
(27, 28, 3, 15, 'completed', '2024-06-08 15:38:29', '2024-06-08 15:41:16'),
(28, 28, 4, 12, 'completed', '2024-06-08 15:38:29', '2024-06-08 15:41:13'),
(29, 28, 5, 12, 'completed', '2024-06-08 15:38:29', '2024-06-08 15:41:16'),
(30, 28, 6, 4, 'completed', '2024-06-08 15:38:29', '2024-06-08 15:41:14'),
(31, 28, 7, 9, 'completed', '2024-06-08 15:38:29', '2024-06-08 15:41:15'),
(32, 28, 8, 5, 'completed', '2024-06-08 15:38:29', '2024-06-08 15:41:13'),
(33, 27, 1, 12, 'completed', '2024-06-08 15:39:02', '2024-06-08 15:41:16'),
(34, 27, 2, 15, 'completed', '2024-06-08 15:39:02', '2024-06-08 15:41:17'),
(35, 27, 3, 4, 'completed', '2024-06-08 15:39:02', '2024-06-08 15:41:20'),
(36, 27, 4, 3, 'completed', '2024-06-08 15:39:02', '2024-06-08 15:41:21'),
(37, 27, 5, 3, 'completed', '2024-06-08 15:39:02', '2024-06-08 15:41:17'),
(38, 27, 6, 9, 'completed', '2024-06-08 15:39:02', '2024-06-08 15:41:19'),
(39, 27, 7, 10, 'completed', '2024-06-08 15:39:02', '2024-06-08 15:41:20'),
(40, 27, 8, 1, 'completed', '2024-06-08 15:39:02', '2024-06-08 15:41:18'),
(41, 26, 1, 1, 'completed', '2024-06-08 15:39:38', '2024-06-08 15:41:21'),
(42, 26, 2, 1, 'completed', '2024-06-08 15:39:38', '2024-06-08 15:41:22'),
(43, 26, 3, 9, 'completed', '2024-06-08 15:39:38', '2024-06-08 15:41:23'),
(44, 26, 4, 10, 'completed', '2024-06-08 15:39:38', '2024-06-08 15:41:24'),
(45, 26, 5, 18, 'completed', '2024-06-08 15:39:38', '2024-06-08 15:41:24'),
(46, 26, 7, 1, 'completed', '2024-06-08 15:39:38', '2024-06-08 15:41:22'),
(47, 26, 8, 5, 'completed', '2024-06-08 15:39:38', '2024-06-08 15:41:23'),
(48, 25, 1, 12, 'completed', '2024-06-08 15:40:45', '2024-06-08 15:41:25'),
(49, 25, 2, 2, 'completed', '2024-06-08 15:40:45', '2024-06-08 15:41:25'),
(50, 25, 4, 1, 'completed', '2024-06-08 15:40:45', '2024-06-08 15:41:25'),
(51, 25, 5, 5, 'completed', '2024-06-08 15:40:45', '2024-06-08 15:41:26'),
(52, 25, 6, 8, 'completed', '2024-06-08 15:40:45', '2024-06-08 15:41:26'),
(53, 25, 7, 2, 'completed', '2024-06-08 15:40:45', '2024-06-08 15:41:27'),
(54, 24, 1, 3, 'completed', '2024-06-08 15:42:18', '2024-06-08 15:54:37'),
(55, 24, 2, 3, 'completed', '2024-06-08 15:42:18', '2024-06-08 15:54:34'),
(56, 24, 3, 2, 'completed', '2024-06-08 15:42:18', '2024-06-08 15:54:37'),
(57, 24, 4, 8, 'completed', '2024-06-08 15:42:18', '2024-06-08 15:54:35'),
(58, 24, 5, 9, 'completed', '2024-06-08 15:42:18', '2024-06-08 15:54:36'),
(59, 24, 6, 1, 'completed', '2024-06-08 15:42:18', '2024-06-08 15:54:34'),
(60, 24, 7, 1, 'completed', '2024-06-08 15:42:18', '2024-06-08 15:54:34'),
(61, 24, 8, 1, 'completed', '2024-06-08 15:42:18', '2024-06-08 15:54:35'),
(62, 23, 2, 2, 'completed', '2024-06-08 15:42:47', '2024-06-08 15:54:40'),
(63, 23, 3, 2, 'completed', '2024-06-08 15:42:47', '2024-06-08 15:54:39'),
(64, 23, 4, 3, 'completed', '2024-06-08 15:42:47', '2024-06-08 15:54:38'),
(65, 23, 5, 2, 'completed', '2024-06-08 15:42:47', '2024-06-08 15:54:39'),
(66, 23, 6, 2, 'completed', '2024-06-08 15:42:47', '2024-06-08 15:54:39'),
(67, 23, 7, 2, 'completed', '2024-06-08 15:42:47', '2024-06-08 15:54:38'),
(68, 23, 8, 1, 'completed', '2024-06-08 15:42:47', '2024-06-08 15:54:38'),
(69, 22, 1, 3, 'completed', '2024-06-08 15:43:20', '2024-06-08 15:54:42'),
(70, 22, 2, 1, 'completed', '2024-06-08 15:43:20', '2024-06-08 15:54:43'),
(71, 22, 3, 1, 'completed', '2024-06-08 15:43:20', '2024-06-08 15:54:41'),
(72, 22, 4, 8, 'completed', '2024-06-08 15:43:20', '2024-06-08 15:54:42'),
(73, 22, 5, 3, 'completed', '2024-06-08 15:43:20', '2024-06-08 15:54:40'),
(74, 22, 6, 3, 'completed', '2024-06-08 15:43:20', '2024-06-08 15:54:41'),
(75, 22, 7, 1, 'completed', '2024-06-08 15:43:20', '2024-06-08 15:54:41'),
(76, 21, 1, 4, 'completed', '2024-06-08 15:43:47', '2024-06-08 15:54:45'),
(77, 21, 4, 3, 'completed', '2024-06-08 15:43:47', '2024-06-08 15:54:43'),
(78, 21, 5, 1, 'completed', '2024-06-08 15:43:47', '2024-06-08 15:54:44'),
(79, 21, 6, 1, 'completed', '2024-06-08 15:43:47', '2024-06-08 15:54:44'),
(80, 21, 8, 2, 'completed', '2024-06-08 15:43:47', '2024-06-08 15:54:43'),
(81, 20, 1, 4, 'completed', '2024-06-08 15:44:24', '2024-06-08 15:54:48'),
(82, 20, 2, 4, 'completed', '2024-06-08 15:44:24', '2024-06-08 15:54:47'),
(83, 20, 3, 2, 'completed', '2024-06-08 15:44:24', '2024-06-08 15:54:45'),
(84, 20, 4, 5, 'completed', '2024-06-08 15:44:24', '2024-06-08 15:54:46'),
(85, 20, 5, 5, 'completed', '2024-06-08 15:44:24', '2024-06-08 15:54:46'),
(86, 20, 6, 1, 'completed', '2024-06-08 15:44:24', '2024-06-08 15:54:47'),
(87, 20, 7, 2, 'completed', '2024-06-08 15:44:24', '2024-06-08 15:54:47'),
(88, 20, 8, 1, 'completed', '2024-06-08 15:44:24', '2024-06-08 15:54:45'),
(89, 19, 3, 2, 'completed', '2024-06-08 15:44:54', '2024-06-08 15:54:48'),
(90, 19, 4, 1, 'completed', '2024-06-08 15:44:54', '2024-06-08 15:54:50'),
(91, 19, 5, 6, 'completed', '2024-06-08 15:44:54', '2024-06-08 15:54:50'),
(92, 19, 6, 1, 'completed', '2024-06-08 15:44:54', '2024-06-08 15:54:49'),
(93, 19, 7, 2, 'completed', '2024-06-08 15:44:54', '2024-06-08 15:54:49'),
(94, 19, 8, 1, 'completed', '2024-06-08 15:44:54', '2024-06-08 15:54:49'),
(95, 18, 1, 2, 'completed', '2024-06-08 15:49:55', '2024-06-08 15:54:53'),
(96, 18, 2, 2, 'completed', '2024-06-08 15:49:55', '2024-06-08 15:54:51'),
(97, 18, 3, 2, 'completed', '2024-06-08 15:49:55', '2024-06-08 15:54:51'),
(98, 18, 4, 1, 'completed', '2024-06-08 15:49:55', '2024-06-08 15:54:52'),
(99, 18, 5, 1, 'completed', '2024-06-08 15:49:55', '2024-06-08 15:54:52'),
(100, 18, 6, 1, 'completed', '2024-06-08 15:49:55', '2024-06-08 15:54:51'),
(101, 17, 1, 1, 'completed', '2024-06-08 15:50:21', '2024-06-08 15:54:55'),
(102, 17, 2, 1, 'completed', '2024-06-08 15:50:21', '2024-06-08 15:54:53'),
(103, 17, 3, 2, 'completed', '2024-06-08 15:50:21', '2024-06-08 15:54:55'),
(104, 17, 5, 1, 'completed', '2024-06-08 15:50:21', '2024-06-08 15:54:53'),
(105, 17, 6, 3, 'completed', '2024-06-08 15:50:21', '2024-06-08 15:54:54'),
(106, 17, 8, 1, 'completed', '2024-06-08 15:50:21', '2024-06-08 15:54:54'),
(107, 16, 3, 2, 'completed', '2024-06-08 15:50:46', '2024-06-08 15:54:56'),
(108, 16, 4, 1, 'completed', '2024-06-08 15:50:46', '2024-06-08 15:54:55'),
(109, 16, 5, 2, 'completed', '2024-06-08 15:50:46', '2024-06-08 15:54:57'),
(110, 16, 6, 2, 'completed', '2024-06-08 15:50:46', '2024-06-08 15:54:56'),
(111, 15, 3, 1, 'completed', '2024-06-08 15:51:13', '2024-06-08 15:54:58'),
(112, 15, 4, 1, 'completed', '2024-06-08 15:51:13', '2024-06-08 15:54:57'),
(113, 15, 5, 4, 'completed', '2024-06-08 15:51:13', '2024-06-08 15:54:58'),
(114, 15, 6, 2, 'completed', '2024-06-08 15:51:13', '2024-06-08 15:54:59'),
(115, 15, 7, 1, 'completed', '2024-06-08 15:51:13', '2024-06-08 15:54:58'),
(116, 14, 1, 1, 'completed', '2024-06-08 15:52:11', '2024-06-08 15:55:02'),
(117, 14, 2, 1, 'completed', '2024-06-08 15:52:11', '2024-06-08 15:55:00'),
(118, 14, 3, 1, 'completed', '2024-06-08 15:52:11', '2024-06-08 15:55:01'),
(119, 14, 4, 2, 'completed', '2024-06-08 15:52:11', '2024-06-08 15:55:02'),
(120, 14, 5, 2, 'completed', '2024-06-08 15:52:11', '2024-06-08 15:55:00'),
(121, 14, 6, 1, 'completed', '2024-06-08 15:52:11', '2024-06-08 15:55:00'),
(122, 14, 7, 1, 'completed', '2024-06-08 15:52:11', '2024-06-08 15:55:01'),
(123, 14, 8, 2, 'completed', '2024-06-08 15:52:11', '2024-06-08 15:54:59'),
(124, 13, 1, 2, 'completed', '2024-06-08 15:53:57', '2024-06-08 15:55:05'),
(125, 13, 2, 1, 'completed', '2024-06-08 15:53:57', '2024-06-08 15:55:03'),
(126, 13, 3, 1, 'completed', '2024-06-08 15:53:57', '2024-06-08 15:55:03'),
(127, 13, 4, 1, 'completed', '2024-06-08 15:53:57', '2024-06-08 15:55:04'),
(128, 13, 5, 4, 'completed', '2024-06-08 15:53:57', '2024-06-08 15:55:04'),
(129, 13, 6, 4, 'completed', '2024-06-08 15:53:57', '2024-06-08 15:55:05'),
(130, 13, 7, 2, 'completed', '2024-06-08 15:53:57', '2024-06-08 15:55:03'),
(131, 12, 1, 1, 'completed', '2024-06-08 15:54:23', '2024-06-08 15:55:07'),
(132, 12, 3, 1, 'completed', '2024-06-08 15:54:23', '2024-06-08 15:55:05'),
(133, 12, 4, 1, 'completed', '2024-06-08 15:54:23', '2024-06-08 15:55:06'),
(134, 12, 6, 2, 'completed', '2024-06-08 15:54:23', '2024-06-08 15:55:06'),
(135, 11, 1, 1, 'completed', '2024-06-08 15:57:21', '2024-06-08 16:03:40'),
(136, 11, 2, 2, 'completed', '2024-06-08 15:57:21', '2024-06-08 16:03:41'),
(137, 11, 3, 2, 'completed', '2024-06-08 15:57:21', '2024-06-08 16:03:38'),
(138, 11, 4, 1, 'completed', '2024-06-08 15:57:21', '2024-06-08 16:03:38'),
(139, 11, 5, 2, 'completed', '2024-06-08 15:57:21', '2024-06-08 16:03:39'),
(140, 11, 6, 2, 'completed', '2024-06-08 15:57:21', '2024-06-08 16:03:40'),
(141, 11, 7, 3, 'completed', '2024-06-08 15:57:21', '2024-06-08 16:03:39'),
(142, 11, 8, 1, 'completed', '2024-06-08 15:57:21', '2024-06-08 16:03:39'),
(143, 10, 4, 2, 'completed', '2024-06-08 15:57:49', '2024-06-08 16:03:42'),
(144, 10, 5, 5, 'completed', '2024-06-08 15:57:49', '2024-06-08 16:03:42'),
(145, 10, 6, 4, 'completed', '2024-06-08 15:57:49', '2024-06-08 16:03:42'),
(146, 10, 7, 2, 'completed', '2024-06-08 15:57:49', '2024-06-08 16:03:41'),
(147, 10, 8, 4, 'completed', '2024-06-08 15:57:49', '2024-06-08 16:03:41'),
(148, 9, 1, 3, 'completed', '2024-06-08 15:58:16', '2024-06-08 16:03:45'),
(149, 9, 2, 7, 'completed', '2024-06-08 15:58:16', '2024-06-08 16:03:44'),
(150, 9, 3, 2, 'completed', '2024-06-08 15:58:16', '2024-06-08 16:03:44'),
(151, 9, 4, 1, 'completed', '2024-06-08 15:58:16', '2024-06-08 16:03:45'),
(152, 9, 5, 1, 'completed', '2024-06-08 15:58:16', '2024-06-08 16:03:43'),
(153, 9, 6, 4, 'completed', '2024-06-08 15:58:16', '2024-06-08 16:03:44'),
(154, 9, 7, 8, 'completed', '2024-06-08 15:58:16', '2024-06-08 16:03:43'),
(155, 9, 8, 5, 'completed', '2024-06-08 15:58:16', '2024-06-08 16:03:43'),
(156, 8, 1, 2, 'completed', '2024-06-08 15:58:47', '2024-06-08 16:03:48'),
(157, 8, 2, 2, 'completed', '2024-06-08 15:58:47', '2024-06-08 16:03:48'),
(158, 8, 3, 5, 'completed', '2024-06-08 15:58:47', '2024-06-08 16:03:47'),
(159, 8, 4, 5, 'completed', '2024-06-08 15:58:47', '2024-06-08 16:03:47'),
(160, 8, 5, 7, 'completed', '2024-06-08 15:58:47', '2024-06-08 16:03:46'),
(161, 8, 6, 3, 'completed', '2024-06-08 15:58:47', '2024-06-08 16:03:46'),
(162, 8, 7, 5, 'completed', '2024-06-08 15:58:47', '2024-06-08 16:03:47'),
(163, 8, 8, 3, 'completed', '2024-06-08 15:58:47', '2024-06-08 16:03:46'),
(164, 7, 1, 2, 'completed', '2024-06-08 15:59:08', '2024-06-08 16:03:50'),
(165, 7, 2, 1, 'completed', '2024-06-08 15:59:08', '2024-06-08 16:03:49'),
(166, 7, 3, 1, 'completed', '2024-06-08 15:59:08', '2024-06-08 16:03:49'),
(167, 7, 5, 5, 'completed', '2024-06-08 15:59:08', '2024-06-08 16:03:49'),
(168, 7, 7, 3, 'completed', '2024-06-08 15:59:08', '2024-06-08 16:03:50'),
(169, 6, 1, 4, 'completed', '2024-06-08 15:59:30', '2024-06-08 16:03:52'),
(170, 6, 2, 6, 'completed', '2024-06-08 15:59:30', '2024-06-08 16:03:51'),
(171, 6, 3, 2, 'completed', '2024-06-08 15:59:30', '2024-06-08 16:03:51'),
(172, 6, 4, 1, 'completed', '2024-06-08 15:59:30', '2024-06-08 16:03:52'),
(173, 6, 5, 3, 'completed', '2024-06-08 15:59:30', '2024-06-08 16:03:51'),
(174, 2, 2, 1, 'completed', '2024-06-08 15:59:53', '2024-06-08 16:03:52'),
(175, 2, 3, 6, 'completed', '2024-06-08 15:59:53', '2024-06-08 16:03:55'),
(176, 2, 4, 6, 'completed', '2024-06-08 15:59:53', '2024-06-08 16:03:53'),
(177, 2, 5, 8, 'completed', '2024-06-08 15:59:53', '2024-06-08 16:03:54'),
(178, 2, 6, 5, 'completed', '2024-06-08 15:59:53', '2024-06-08 16:03:53'),
(179, 2, 7, 6, 'completed', '2024-06-08 15:59:53', '2024-06-08 16:03:54'),
(180, 2, 8, 3, 'completed', '2024-06-08 15:59:53', '2024-06-08 16:03:55'),
(181, 3, 1, 1, 'completed', '2024-06-08 16:00:19', '2024-06-08 16:03:58'),
(182, 3, 2, 1, 'completed', '2024-06-08 16:00:19', '2024-06-08 16:03:56'),
(183, 3, 3, 4, 'completed', '2024-06-08 16:00:19', '2024-06-08 16:03:58'),
(184, 3, 4, 3, 'completed', '2024-06-08 16:00:19', '2024-06-08 16:03:55'),
(185, 3, 5, 3, 'completed', '2024-06-08 16:00:19', '2024-06-08 16:03:57'),
(186, 3, 6, 3, 'completed', '2024-06-08 16:00:19', '2024-06-08 16:03:58'),
(187, 3, 7, 3, 'completed', '2024-06-08 16:00:19', '2024-06-08 16:03:56'),
(188, 3, 8, 5, 'completed', '2024-06-08 16:00:19', '2024-06-08 16:03:57'),
(189, 4, 1, 2, 'completed', '2024-06-08 16:00:41', '2024-06-08 16:04:01'),
(190, 4, 2, 2, 'completed', '2024-06-08 16:00:41', '2024-06-08 16:03:59'),
(191, 4, 3, 1, 'completed', '2024-06-08 16:00:41', '2024-06-08 16:04:00'),
(192, 4, 4, 5, 'completed', '2024-06-08 16:00:41', '2024-06-08 16:04:00'),
(193, 4, 5, 2, 'completed', '2024-06-08 16:00:41', '2024-06-08 16:04:01'),
(194, 4, 6, 4, 'completed', '2024-06-08 16:00:41', '2024-06-08 16:03:59'),
(195, 4, 7, 2, 'completed', '2024-06-08 16:00:41', '2024-06-08 16:03:59'),
(196, 5, 1, 5, 'completed', '2024-06-08 16:03:30', '2024-06-08 16:04:04'),
(197, 5, 2, 4, 'completed', '2024-06-08 16:03:30', '2024-06-08 16:04:01'),
(198, 5, 3, 1, 'completed', '2024-06-08 16:03:30', '2024-06-08 16:04:02'),
(199, 5, 4, 1, 'completed', '2024-06-08 16:03:30', '2024-06-08 16:04:02'),
(200, 5, 5, 2, 'completed', '2024-06-08 16:03:30', '2024-06-08 16:04:02'),
(201, 5, 6, 1, 'completed', '2024-06-08 16:03:30', '2024-06-08 16:04:03'),
(202, 5, 7, 1, 'completed', '2024-06-08 16:03:30', '2024-06-08 16:04:03'),
(203, 31, 8, 1, 'completed', '2024-06-09 14:35:11', '2024-06-09 14:35:29'),
(204, 24, 8, 1, 'completed', '2024-06-21 22:47:01', '2024-06-22 05:55:32'),
(205, 31, 1, 1, 'pending', '2024-06-24 11:02:50', '2024-06-24 11:02:50'),
(206, 2, 8, 1, 'completed', '2024-06-24 11:45:20', '2024-06-24 11:45:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sepatu`
--

CREATE TABLE `sepatu` (
  `sepatu_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `sepatu_nama` varchar(255) NOT NULL,
  `sepatu_harga` int(11) NOT NULL,
  `sepatu_gambar` varchar(255) NOT NULL,
  `sepatu_deskripsi` text NOT NULL,
  `sepatu_status` tinyint(1) NOT NULL,
  `data_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sepatu`
--

INSERT INTO `sepatu` (`sepatu_id`, `kategori_id`, `sepatu_nama`, `sepatu_harga`, `sepatu_gambar`, `sepatu_deskripsi`, `sepatu_status`, `data_created`) VALUES
(2, 9, 'Elegance Leather Oxfords', 450000, 'produk1717593438.jpeg', '<p>Sepatu formal ini dirancang untuk memberikan kenyamanan dan gaya pada setiap kesempatan formal Anda. Dibuat dari bahan kulit berkualitas tinggi, sepatu ini menampilkan desain klasik yang elegan dengan detail jahitan rapi dan sol yang kokoh. Cocok untuk dipakai saat menghadiri pertemuan bisnis, acara resmi, atau pesta. Dengan konstruksi yang tahan lama dan bantalan dalam yang nyaman, sepatu formal ini memastikan kaki Anda tetap nyaman sepanjang hari.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan kulit premium</li>\r\n	<li>Desain klasik dan elegan</li>\r\n	<li>Sol anti slip</li>\r\n	<li>Bantalan dalam yang nyaman</li>\r\n</ul>\r\n', 1, '2024-06-05 13:17:18'),
(3, 9, 'Classic Derby Shoes', 500000, 'produk1717593503.jpeg', '<p>Sepatu formal ini dirancang untuk memberikan kenyamanan dan gaya pada setiap kesempatan formal Anda. Dibuat dari bahan kulit berkualitas tinggi, sepatu ini menampilkan desain klasik yang elegan dengan detail jahitan rapi dan sol yang kokoh. Cocok untuk dipakai saat menghadiri pertemuan bisnis, acara resmi, atau pesta. Dengan konstruksi yang tahan lama dan bantalan dalam yang nyaman, sepatu formal ini memastikan kaki Anda tetap nyaman sepanjang hari.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan kulit premium</li>\r\n	<li>Desain klasik dan elegan</li>\r\n	<li>Sol anti slip</li>\r\n	<li>Bantalan dalam yang nyaman</li>\r\n</ul>\r\n', 1, '2024-06-05 13:18:23'),
(4, 8, 'Urban Slip-Ons', 600000, 'produk1717593580.jpeg', '<p>Sepatu casual ini adalah pilihan sempurna untuk gaya santai dan nyaman sehari-hari. Terbuat dari bahan yang lembut dan fleksibel, sepatu ini menawarkan kenyamanan luar biasa dan desain yang trendi. Cocok untuk berbagai aktivitas, mulai dari jalan-jalan santai, belanja, hingga berkumpul dengan teman. Dengan sol yang empuk dan desain yang stylish, sepatu casual ini menjadi pelengkap sempurna untuk penampilan kasual Anda.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan lembut dan fleksibel</li>\r\n	<li>Sol empuk untuk kenyamanan</li>\r\n	<li>Desain trendi dan stylish</li>\r\n	<li>Ringan dan mudah dipakai</li>\r\n</ul>\r\n', 1, '2024-06-05 13:19:40'),
(5, 8, 'Street Style Sneakers', 500000, 'produk1717593617.jpeg', '<p>Sepatu casual ini adalah pilihan sempurna untuk gaya santai dan nyaman sehari-hari. Terbuat dari bahan yang lembut dan fleksibel, sepatu ini menawarkan kenyamanan luar biasa dan desain yang trendi. Cocok untuk berbagai aktivitas, mulai dari jalan-jalan santai, belanja, hingga berkumpul dengan teman. Dengan sol yang empuk dan desain yang stylish, sepatu casual ini menjadi pelengkap sempurna untuk penampilan kasual Anda.</p>\r\n\r\n<p><strong>Keunggalan :</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan lembut dan fleksibel</li>\r\n	<li>Sol empuk untuk kenyamanan</li>\r\n	<li>Desain trendi dan stylish</li>\r\n	<li>Ringan dan mudah dipakai</li>\r\n</ul>\r\n', 1, '2024-06-05 13:20:17'),
(6, 8, 'Easygoing Espadrilles', 300000, 'produk1717593663.jpeg', '<p>Sepatu casual ini adalah pilihan sempurna untuk gaya santai dan nyaman sehari-hari. Terbuat dari bahan yang lembut dan fleksibel, sepatu ini menawarkan kenyamanan luar biasa dan desain yang trendi. Cocok untuk berbagai aktivitas, mulai dari jalan-jalan santai, belanja, hingga berkumpul dengan teman. Dengan sol yang empuk dan desain yang stylish, sepatu casual ini menjadi pelengkap sempurna untuk penampilan kasual Anda.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan lembut dan fleksibel</li>\r\n	<li>Sol empuk untuk kenyamanan</li>\r\n	<li>Desain trendi dan stylish</li>\r\n	<li>Ringan dan mudah dipakai</li>\r\n</ul>\r\n', 1, '2024-06-05 13:21:03'),
(7, 8, 'Chill Canvas Plimsolls', 625000, 'produk1717593715.jpeg', '<p>Sepatu casual ini adalah pilihan sempurna untuk gaya santai dan nyaman sehari-hari. Terbuat dari bahan yang lembut dan fleksibel, sepatu ini menawarkan kenyamanan luar biasa dan desain yang trendi. Cocok untuk berbagai aktivitas, mulai dari jalan-jalan santai, belanja, hingga berkumpul dengan teman. Dengan sol yang empuk dan desain yang stylish, sepatu casual ini menjadi pelengkap sempurna untuk penampilan kasual Anda.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan lembut dan fleksibel</li>\r\n	<li>Sol empuk untuk kenyamanan</li>\r\n	<li>Desain trendi dan stylish</li>\r\n	<li>Ringan dan mudah dipakai</li>\r\n</ul>\r\n', 1, '2024-06-05 13:21:55'),
(8, 7, 'Speed Runner Trainers', 800000, 'produk1717593782.jpeg', '<p>Sepatu sport ini dirancang untuk mendukung aktivitas olahraga Anda dengan kenyamanan dan performa terbaik. Dibuat dengan bahan yang ringan dan bernapas, sepatu ini memiliki teknologi penyerapan benturan yang inovatif untuk melindungi kaki Anda dari cedera. Sol karet yang fleksibel memberikan cengkeraman yang kuat di berbagai permukaan, ideal untuk lari, bersepeda, atau latihan di gym. Dengan desain yang dinamis dan ergonomis, sepatu ini membantu meningkatkan performa olahraga Anda.</p>\r\n\r\n<p><strong>Fitur Utama:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan ringan dan bernapas</li>\r\n	<li>Teknologi penyerapan benturan</li>\r\n	<li>Sol karet fleksibel dan anti slip</li>\r\n	<li>Desain ergonomis untuk kenyamanan optimal</li>\r\n</ul>\r\n', 1, '2024-06-05 13:23:02'),
(9, 7, 'Power Flex Sneakers', 825000, 'produk1717593816.jpeg', '<p>Sepatu sport ini dirancang untuk mendukung aktivitas olahraga Anda dengan kenyamanan dan performa terbaik. Dibuat dengan bahan yang ringan dan bernapas, sepatu ini memiliki teknologi penyerapan benturan yang inovatif untuk melindungi kaki Anda dari cedera. Sol karet yang fleksibel memberikan cengkeraman yang kuat di berbagai permukaan, ideal untuk lari, bersepeda, atau latihan di gym. Dengan desain yang dinamis dan ergonomis, sepatu ini membantu meningkatkan performa olahraga Anda.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan ringan dan bernapas</li>\r\n	<li>Teknologi penyerapan benturan</li>\r\n	<li>Sol karet fleksibel dan anti slip</li>\r\n	<li>Desain ergonomis untuk kenyamanan optimal</li>\r\n</ul>\r\n', 1, '2024-06-05 13:23:36'),
(10, 7, 'ActiveFit Running Shoes', 1000000, 'produk1717593860.jpeg', '<p>Sepatu sport ini dirancang untuk mendukung aktivitas olahraga Anda dengan kenyamanan dan performa terbaik. Dibuat dengan bahan yang ringan dan bernapas, sepatu ini memiliki teknologi penyerapan benturan yang inovatif untuk melindungi kaki Anda dari cedera. Sol karet yang fleksibel memberikan cengkeraman yang kuat di berbagai permukaan, ideal untuk lari, bersepeda, atau latihan di gym. Dengan desain yang dinamis dan ergonomis, sepatu ini membantu meningkatkan performa olahraga Anda.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan ringan dan bernapas</li>\r\n	<li>Teknologi penyerapan benturan</li>\r\n	<li>Sol karet fleksibel dan anti slip</li>\r\n	<li>Desain ergonomis untuk kenyamanan optimal</li>\r\n</ul>\r\n', 1, '2024-06-05 13:24:20'),
(11, 9, 'Prestige Wingtip Brogues', 925000, 'produk1717593927.jpeg', '<p>Sepatu formal ini dirancang untuk memberikan kenyamanan dan gaya pada setiap kesempatan formal Anda. Dibuat dari bahan kulit berkualitas tinggi, sepatu ini menampilkan desain klasik yang elegan dengan detail jahitan rapi dan sol yang kokoh. Cocok untuk dipakai saat menghadiri pertemuan bisnis, acara resmi, atau pesta. Dengan konstruksi yang tahan lama dan bantalan dalam yang nyaman, sepatu formal ini memastikan kaki Anda tetap nyaman sepanjang hari.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan kulit premium</li>\r\n	<li>Desain klasik dan elegan</li>\r\n	<li>Sol anti slip</li>\r\n	<li>Bantalan dalam yang nyaman</li>\r\n</ul>\r\n', 1, '2024-06-05 13:25:27'),
(12, 9, 'Noble Cap-Toe Oxfords', 550000, 'produk1717593954.jpeg', '<p>Sepatu formal ini dirancang untuk memberikan kenyamanan dan gaya pada setiap kesempatan formal Anda. Dibuat dari bahan kulit berkualitas tinggi, sepatu ini menampilkan desain klasik yang elegan dengan detail jahitan rapi dan sol yang kokoh. Cocok untuk dipakai saat menghadiri pertemuan bisnis, acara resmi, atau pesta. Dengan konstruksi yang tahan lama dan bantalan dalam yang nyaman, sepatu formal ini memastikan kaki Anda tetap nyaman sepanjang hari.</p>\r\n\r\n<p><strong>Fitur Utama:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan kulit premium</li>\r\n	<li>Desain klasik dan elegan</li>\r\n	<li>Sol anti slip</li>\r\n	<li>Bantalan dalam yang nyaman</li>\r\n</ul>\r\n', 1, '2024-06-05 13:25:54'),
(13, 9, 'Executive Monk Straps', 650000, 'produk1717593982.jpeg', '<p>Sepatu formal ini dirancang untuk memberikan kenyamanan dan gaya pada setiap kesempatan formal Anda. Dibuat dari bahan kulit berkualitas tinggi, sepatu ini menampilkan desain klasik yang elegan dengan detail jahitan rapi dan sol yang kokoh. Cocok untuk dipakai saat menghadiri pertemuan bisnis, acara resmi, atau pesta. Dengan konstruksi yang tahan lama dan bantalan dalam yang nyaman, sepatu formal ini memastikan kaki Anda tetap nyaman sepanjang hari.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan kulit premium</li>\r\n	<li>Desain klasik dan elegan</li>\r\n	<li>Sol anti slip</li>\r\n	<li>Bantalan dalam yang nyaman</li>\r\n</ul>\r\n', 1, '2024-06-05 13:26:22'),
(14, 9, 'Regal Patent Loafers', 625000, 'produk1717594045.jpeg', '<p>Sepatu formal ini dirancang untuk memberikan kenyamanan dan gaya pada setiap kesempatan formal Anda. Dibuat dari bahan kulit berkualitas tinggi, sepatu ini menampilkan desain klasik yang elegan dengan detail jahitan rapi dan sol yang kokoh. Cocok untuk dipakai saat menghadiri pertemuan bisnis, acara resmi, atau pesta. Dengan konstruksi yang tahan lama dan bantalan dalam yang nyaman, sepatu formal ini memastikan kaki Anda tetap nyaman sepanjang hari.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan kulit premium</li>\r\n	<li>Desain klasik dan elegan</li>\r\n	<li>Sol anti slip</li>\r\n	<li>Bantalan dalam yang nyaman</li>\r\n</ul>\r\n', 1, '2024-06-05 13:27:25'),
(15, 9, 'Aristocrat Lace-Up Shoes', 800000, 'produk1717594084.jpeg', '<p>Sepatu formal ini dirancang untuk memberikan kenyamanan dan gaya pada setiap kesempatan formal Anda. Dibuat dari bahan kulit berkualitas tinggi, sepatu ini menampilkan desain klasik yang elegan dengan detail jahitan rapi dan sol yang kokoh. Cocok untuk dipakai saat menghadiri pertemuan bisnis, acara resmi, atau pesta. Dengan konstruksi yang tahan lama dan bantalan dalam yang nyaman, sepatu formal ini memastikan kaki Anda tetap nyaman sepanjang hari.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan kulit premium</li>\r\n	<li>Desain klasik dan elegan</li>\r\n	<li>Sol anti slip</li>\r\n	<li>Bantalan dalam yang nyaman</li>\r\n</ul>\r\n', 1, '2024-06-05 13:28:04'),
(16, 8, 'Weekend Boat Shoes', 1200000, 'produk1717594163.jpeg', '<p>Sepatu casual ini adalah pilihan sempurna untuk gaya santai dan nyaman sehari-hari. Terbuat dari bahan yang lembut dan fleksibel, sepatu ini menawarkan kenyamanan luar biasa dan desain yang trendi. Cocok untuk berbagai aktivitas, mulai dari jalan-jalan santai, belanja, hingga berkumpul dengan teman. Dengan sol yang empuk dan desain yang stylish, sepatu casual ini menjadi pelengkap sempurna untuk penampilan kasual Anda.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan lembut dan fleksibel</li>\r\n	<li>Sol empuk untuk kenyamanan</li>\r\n	<li>Desain trendi dan stylish</li>\r\n	<li>Ringan dan mudah dipakai</li>\r\n</ul>\r\n', 1, '2024-06-05 13:29:23'),
(17, 8, 'Relaxed Moccasins', 1000000, 'produk1717594218.jpeg', '<p>Sepatu casual ini adalah pilihan sempurna untuk gaya santai dan nyaman sehari-hari. Terbuat dari bahan yang lembut dan fleksibel, sepatu ini menawarkan kenyamanan luar biasa dan desain yang trendi. Cocok untuk berbagai aktivitas, mulai dari jalan-jalan santai, belanja, hingga berkumpul dengan teman. Dengan sol yang empuk dan desain yang stylish, sepatu casual ini menjadi pelengkap sempurna untuk penampilan kasual Anda.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan lembut dan fleksibel</li>\r\n	<li>Sol empuk untuk kenyamanan</li>\r\n	<li>Desain trendi dan stylish</li>\r\n	<li>Ringan dan mudah dipakai</li>\r\n</ul>\r\n', 1, '2024-06-05 13:30:18'),
(18, 8, 'Leisure Slip-Ons', 975000, 'produk1717594251.jpeg', '<p>Sepatu casual ini adalah pilihan sempurna untuk gaya santai dan nyaman sehari-hari. Terbuat dari bahan yang lembut dan fleksibel, sepatu ini menawarkan kenyamanan luar biasa dan desain yang trendi. Cocok untuk berbagai aktivitas, mulai dari jalan-jalan santai, belanja, hingga berkumpul dengan teman. Dengan sol yang empuk dan desain yang stylish, sepatu casual ini menjadi pelengkap sempurna untuk penampilan kasual Anda.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan lembut dan fleksibel</li>\r\n	<li>Sol empuk untuk kenyamanan</li>\r\n	<li>Desain trendi dan stylish</li>\r\n	<li>Ringan dan mudah dipakai</li>\r\n</ul>\r\n', 1, '2024-06-05 13:30:51'),
(19, 7, 'Endurance Trail Runners', 600000, 'produk1717594306.jpeg', '<p>Sepatu sport ini dirancang untuk mendukung aktivitas olahraga Anda dengan kenyamanan dan performa terbaik. Dibuat dengan bahan yang ringan dan bernapas, sepatu ini memiliki teknologi penyerapan benturan yang inovatif untuk melindungi kaki Anda dari cedera. Sol karet yang fleksibel memberikan cengkeraman yang kuat di berbagai permukaan, ideal untuk lari, bersepeda, atau latihan di gym. Dengan desain yang dinamis dan ergonomis, sepatu ini membantu meningkatkan performa olahraga Anda.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan ringan dan bernapas</li>\r\n	<li>Teknologi penyerapan benturan</li>\r\n	<li>Sol karet fleksibel dan anti slip</li>\r\n	<li>Desain ergonomis untuk kenyamanan optimal</li>\r\n</ul>\r\n', 1, '2024-06-05 13:31:46'),
(20, 7, 'AeroLift Cross Trainers', 760000, 'produk1717594384.jpeg', '<p>Sepatu sport ini dirancang untuk mendukung aktivitas olahraga Anda dengan kenyamanan dan performa terbaik. Dibuat dengan bahan yang ringan dan bernapas, sepatu ini memiliki teknologi penyerapan benturan yang inovatif untuk melindungi kaki Anda dari cedera. Sol karet yang fleksibel memberikan cengkeraman yang kuat di berbagai permukaan, ideal untuk lari, bersepeda, atau latihan di gym. Dengan desain yang dinamis dan ergonomis, sepatu ini membantu meningkatkan performa olahraga Anda.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan ringan dan bernapas</li>\r\n	<li>Teknologi penyerapan benturan</li>\r\n	<li>Sol karet fleksibel dan anti slip</li>\r\n	<li>Desain ergonomis untuk kenyamanan optimal</li>\r\n</ul>\r\n', 1, '2024-06-05 13:33:04'),
(21, 7, 'ProGym Fitness Shoes', 475000, 'produk1717594432.jpeg', '<p>Sepatu sport ini dirancang untuk mendukung aktivitas olahraga Anda dengan kenyamanan dan performa terbaik. Dibuat dengan bahan yang ringan dan bernapas, sepatu ini memiliki teknologi penyerapan benturan yang inovatif untuk melindungi kaki Anda dari cedera. Sol karet yang fleksibel memberikan cengkeraman yang kuat di berbagai permukaan, ideal untuk lari, bersepeda, atau latihan di gym. Dengan desain yang dinamis dan ergonomis, sepatu ini membantu meningkatkan performa olahraga Anda.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan ringan dan bernapas</li>\r\n	<li>Teknologi penyerapan benturan</li>\r\n	<li>Sol karet fleksibel dan anti slip</li>\r\n	<li>Desain ergonomis untuk kenyamanan optimal</li>\r\n</ul>\r\n', 1, '2024-06-05 13:33:52'),
(22, 7, 'Velocity Sports Sneakers', 1350000, 'produk1717594475.jpeg', '<p>Sepatu sport ini dirancang untuk mendukung aktivitas olahraga Anda dengan kenyamanan dan performa terbaik. Dibuat dengan bahan yang ringan dan bernapas, sepatu ini memiliki teknologi penyerapan benturan yang inovatif untuk melindungi kaki Anda dari cedera. Sol karet yang fleksibel memberikan cengkeraman yang kuat di berbagai permukaan, ideal untuk lari, bersepeda, atau latihan di gym. Dengan desain yang dinamis dan ergonomis, sepatu ini membantu meningkatkan performa olahraga Anda.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan ringan dan bernapas</li>\r\n	<li>Teknologi penyerapan benturan</li>\r\n	<li>Sol karet fleksibel dan anti slip</li>\r\n	<li>Desain ergonomis untuk kenyamanan optimal</li>\r\n</ul>\r\n', 1, '2024-06-05 13:34:35'),
(23, 9, 'Ambassador Dress Shoes', 965000, 'produk1717594551.jpeg', '<p>&nbsp;</p>\r\n\r\n<p>Sepatu formal ini dirancang untuk memberikan kenyamanan dan gaya pada setiap kesempatan formal Anda. Dibuat dari bahan kulit berkualitas tinggi, sepatu ini menampilkan desain klasik yang elegan dengan detail jahitan rapi dan sol yang kokoh. Cocok untuk dipakai saat menghadiri pertemuan bisnis, acara resmi, atau pesta. Dengan konstruksi yang tahan lama dan bantalan dalam yang nyaman, sepatu formal ini memastikan kaki Anda tetap nyaman sepanjang hari.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan kulit premium</li>\r\n	<li>Desain klasik dan elegan</li>\r\n	<li>Sol anti slip</li>\r\n	<li>Bantalan dalam yang nyaman</li>\r\n</ul>\r\n', 1, '2024-06-05 13:35:51'),
(24, 8, 'Trendy High-Tops', 865000, 'produk1717594658.jpeg', '<p>Sepatu casual ini adalah pilihan sempurna untuk gaya santai dan nyaman sehari-hari. Terbuat dari bahan yang lembut dan fleksibel, sepatu ini menawarkan kenyamanan luar biasa dan desain yang trendi. Cocok untuk berbagai aktivitas, mulai dari jalan-jalan santai, belanja, hingga berkumpul dengan teman. Dengan sol yang empuk dan desain yang stylish, sepatu casual ini menjadi pelengkap sempurna untuk penampilan kasual Anda.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan lembut dan fleksibel</li>\r\n	<li>Sol empuk untuk kenyamanan</li>\r\n	<li>Desain trendi dan stylish</li>\r\n	<li>Ringan dan mudah dipakai</li>\r\n</ul>\r\n', 1, '2024-06-05 13:37:38'),
(25, 8, 'Laid-Back Slip-On Sneakers', 900000, 'produk1717594711.jpeg', '<p>Sepatu casual ini adalah pilihan sempurna untuk gaya santai dan nyaman sehari-hari. Terbuat dari bahan yang lembut dan fleksibel, sepatu ini menawarkan kenyamanan luar biasa dan desain yang trendi. Cocok untuk berbagai aktivitas, mulai dari jalan-jalan santai, belanja, hingga berkumpul dengan teman. Dengan sol yang empuk dan desain yang stylish, sepatu casual ini menjadi pelengkap sempurna untuk penampilan kasual Anda.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan lembut dan fleksibel</li>\r\n	<li>Sol empuk untuk kenyamanan</li>\r\n	<li>Desain trendi dan stylish</li>\r\n	<li>Ringan dan mudah dipakai</li>\r\n</ul>\r\n', 1, '2024-06-05 13:38:31'),
(26, 7, 'Dynamic Workout Shoes', 700000, 'produk1717594755.jpeg', '<p>Sepatu sport ini dirancang untuk mendukung aktivitas olahraga Anda dengan kenyamanan dan performa terbaik. Dibuat dengan bahan yang ringan dan bernapas, sepatu ini memiliki teknologi penyerapan benturan yang inovatif untuk melindungi kaki Anda dari cedera. Sol karet yang fleksibel memberikan cengkeraman yang kuat di berbagai permukaan, ideal untuk lari, bersepeda, atau latihan di gym. Dengan desain yang dinamis dan ergonomis, sepatu ini membantu meningkatkan performa olahraga Anda.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan ringan dan bernapas</li>\r\n	<li>Teknologi penyerapan benturan</li>\r\n	<li>Sol karet fleksibel dan anti slip</li>\r\n	<li>Desain ergonomis untuk kenyamanan optimal</li>\r\n</ul>\r\n', 1, '2024-06-05 13:39:15'),
(27, 7, 'AgileFit Athletic Shoes', 700000, 'produk1717594783.jpeg', '<p>Sepatu sport ini dirancang untuk mendukung aktivitas olahraga Anda dengan kenyamanan dan performa terbaik. Dibuat dengan bahan yang ringan dan bernapas, sepatu ini memiliki teknologi penyerapan benturan yang inovatif untuk melindungi kaki Anda dari cedera. Sol karet yang fleksibel memberikan cengkeraman yang kuat di berbagai permukaan, ideal untuk lari, bersepeda, atau latihan di gym. Dengan desain yang dinamis dan ergonomis, sepatu ini membantu meningkatkan performa olahraga Anda.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan ringan dan bernapas</li>\r\n	<li>Teknologi penyerapan benturan</li>\r\n	<li>Sol karet fleksibel dan anti slip</li>\r\n	<li>Desain ergonomis untuk kenyamanan optimal</li>\r\n</ul>\r\n', 1, '2024-06-05 13:39:43'),
(28, 7, 'MaxGrip Training Sneakers', 1350000, 'produk1717602004.jpeg', '<p>Sepatu sport ini dirancang untuk mendukung aktivitas olahraga Anda dengan kenyamanan dan performa terbaik. Dibuat dengan bahan yang ringan dan bernapas, sepatu ini memiliki teknologi penyerapan benturan yang inovatif untuk melindungi kaki Anda dari cedera. Sol karet yang fleksibel memberikan cengkeraman yang kuat di berbagai permukaan, ideal untuk lari, bersepeda, atau latihan di gym. Dengan desain yang dinamis dan ergonomis, sepatu ini membantu meningkatkan performa olahraga Anda.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan ringan dan bernapas</li>\r\n	<li>Teknologi penyerapan benturan</li>\r\n	<li>Sol karet fleksibel dan anti slip</li>\r\n	<li>Desain ergonomis untuk kenyamanan optimal</li>\r\n</ul>\r\n', 1, '2024-06-05 13:40:25'),
(29, 9, 'Elite Tassel Loafers', 1000000, 'produk1717594908.jpeg', '<p>Sepatu formal ini dirancang untuk memberikan kenyamanan dan gaya pada setiap kesempatan formal Anda. Dibuat dari bahan kulit berkualitas tinggi, sepatu ini menampilkan desain klasik yang elegan dengan detail jahitan rapi dan sol yang kokoh. Cocok untuk dipakai saat menghadiri pertemuan bisnis, acara resmi, atau pesta. Dengan konstruksi yang tahan lama dan bantalan dalam yang nyaman, sepatu formal ini memastikan kaki Anda tetap nyaman sepanjang hari.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan kulit premium</li>\r\n	<li>Desain klasik dan elegan</li>\r\n	<li>Sol anti slip</li>\r\n	<li>Bantalan dalam yang nyaman</li>\r\n</ul>\r\n', 1, '2024-06-05 13:41:48'),
(30, 8, 'Comfy Suede Chukkas', 1240000, 'produk1717599731.jpeg', '<p>Sepatu casual ini adalah pilihan sempurna untuk gaya santai dan nyaman sehari-hari. Terbuat dari bahan yang lembut dan fleksibel, sepatu ini menawarkan kenyamanan luar biasa dan desain yang trendi. Cocok untuk berbagai aktivitas, mulai dari jalan-jalan santai, belanja, hingga berkumpul dengan teman. Dengan sol yang empuk dan desain yang stylish, sepatu casual ini menjadi pelengkap sempurna untuk penampilan kasual Anda.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan lembut dan fleksibel</li>\r\n	<li>Sol empuk untuk kenyamanan</li>\r\n	<li>Desain trendi dan stylish</li>\r\n	<li>Ringan dan mudah dipakai</li>\r\n</ul>\r\n', 1, '2024-06-05 13:42:46'),
(31, 9, 'Dapper Double Monks', 1150000, 'produk1717599608.jpeg', '<p>Sepatu formal ini dirancang untuk memberikan kenyamanan dan gaya pada setiap kesempatan formal Anda. Dibuat dari bahan kulit berkualitas tinggi, sepatu ini menampilkan desain klasik yang elegan dengan detail jahitan rapi dan sol yang kokoh. Cocok untuk dipakai saat menghadiri pertemuan bisnis, acara resmi, atau pesta. Dengan konstruksi yang tahan lama dan bantalan dalam yang nyaman, sepatu formal ini memastikan kaki Anda tetap nyaman sepanjang hari.</p>\r\n\r\n<p><strong>Keunggalan:</strong></p>\r\n\r\n<ul>\r\n	<li>Bahan kulit premium</li>\r\n	<li>Desain klasik dan elegan</li>\r\n	<li>Sol anti slip</li>\r\n	<li>Bantalan dalam yang nyaman</li>\r\n</ul>\r\n', 1, '2024-06-05 13:43:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_cost`
--

CREATE TABLE `transaction_cost` (
  `transaction_id` int(11) NOT NULL,
  `request_id` int(11) DEFAULT NULL,
  `sepatu_id` int(11) DEFAULT NULL,
  `ukuran_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `total_cost` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_pembayaran` enum('sudah dibayar','belum dibayar') DEFAULT 'belum dibayar'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaction_cost`
--

INSERT INTO `transaction_cost` (`transaction_id`, `request_id`, `sepatu_id`, `ukuran_id`, `quantity`, `unit_price`, `total_cost`, `created_at`, `status_pembayaran`) VALUES
(1, 3, 31, 6, 1, '920000.00', '920000.00', '2024-06-08 15:23:09', 'sudah dibayar'),
(2, 4, 31, 4, 5, '920000.00', '4600000.00', '2024-06-08 15:26:36', 'sudah dibayar'),
(3, 5, 31, 1, 4, '920000.00', '3680000.00', '2024-06-08 15:41:02', 'sudah dibayar'),
(4, 11, 31, 8, 2, '920000.00', '1840000.00', '2024-06-08 15:41:03', 'belum dibayar'),
(5, 7, 31, 3, 3, '920000.00', '2760000.00', '2024-06-08 15:41:04', 'sudah dibayar'),
(6, 10, 31, 7, 11, '920000.00', '10120000.00', '2024-06-08 15:41:04', 'sudah dibayar'),
(7, 6, 31, 2, 6, '920000.00', '5520000.00', '2024-06-08 15:41:05', 'sudah dibayar'),
(8, 9, 31, 6, 2, '920000.00', '1840000.00', '2024-06-08 15:41:05', 'belum dibayar'),
(9, 8, 31, 5, 2, '920000.00', '1840000.00', '2024-06-08 15:41:06', 'belum dibayar'),
(10, 12, 30, 1, 4, '992000.00', '3968000.00', '2024-06-08 15:41:06', 'belum dibayar'),
(11, 14, 30, 3, 13, '992000.00', '12896000.00', '2024-06-08 15:41:06', 'sudah dibayar'),
(12, 17, 30, 6, 5, '992000.00', '4960000.00', '2024-06-08 15:41:07', 'belum dibayar'),
(13, 16, 30, 5, 10, '992000.00', '9920000.00', '2024-06-08 15:41:07', 'sudah dibayar'),
(14, 19, 30, 8, 1, '992000.00', '992000.00', '2024-06-08 15:41:07', 'belum dibayar'),
(15, 13, 30, 2, 9, '992000.00', '8928000.00', '2024-06-08 15:41:08', 'belum dibayar'),
(16, 18, 30, 7, 2, '992000.00', '1984000.00', '2024-06-08 15:41:08', 'belum dibayar'),
(17, 15, 30, 4, 15, '992000.00', '14880000.00', '2024-06-08 15:41:09', 'sudah dibayar'),
(18, 20, 29, 1, 1, '800000.00', '800000.00', '2024-06-08 15:41:09', 'belum dibayar'),
(19, 22, 29, 3, 14, '800000.00', '11200000.00', '2024-06-08 15:41:10', 'belum dibayar'),
(20, 25, 29, 7, 9, '800000.00', '7200000.00', '2024-06-08 15:41:11', 'belum dibayar'),
(21, 21, 29, 2, 10, '800000.00', '8000000.00', '2024-06-08 15:41:12', 'belum dibayar'),
(22, 24, 29, 6, 1, '800000.00', '800000.00', '2024-06-08 15:41:12', 'belum dibayar'),
(23, 23, 29, 5, 8, '800000.00', '6400000.00', '2024-06-08 15:41:12', 'belum dibayar'),
(24, 32, 28, 8, 5, '1080000.00', '5400000.00', '2024-06-08 15:41:13', 'belum dibayar'),
(25, 28, 28, 4, 12, '1080000.00', '12960000.00', '2024-06-08 15:41:13', 'belum dibayar'),
(26, 30, 28, 6, 4, '1080000.00', '4320000.00', '2024-06-08 15:41:14', 'belum dibayar'),
(27, 26, 28, 2, 3, '1080000.00', '3240000.00', '2024-06-08 15:41:15', 'belum dibayar'),
(28, 31, 28, 7, 9, '1080000.00', '9720000.00', '2024-06-08 15:41:15', 'belum dibayar'),
(29, 29, 28, 5, 12, '1080000.00', '12960000.00', '2024-06-08 15:41:16', 'belum dibayar'),
(30, 27, 28, 3, 15, '1080000.00', '16200000.00', '2024-06-08 15:41:16', 'sudah dibayar'),
(31, 33, 27, 1, 12, '560000.00', '6720000.00', '2024-06-08 15:41:16', 'belum dibayar'),
(32, 34, 27, 2, 15, '560000.00', '8400000.00', '2024-06-08 15:41:17', 'belum dibayar'),
(33, 37, 27, 5, 3, '560000.00', '1680000.00', '2024-06-08 15:41:17', 'belum dibayar'),
(34, 40, 27, 8, 1, '560000.00', '560000.00', '2024-06-08 15:41:18', 'belum dibayar'),
(35, 38, 27, 6, 9, '560000.00', '5040000.00', '2024-06-08 15:41:19', 'belum dibayar'),
(36, 35, 27, 3, 4, '560000.00', '2240000.00', '2024-06-08 15:41:20', 'belum dibayar'),
(37, 39, 27, 7, 10, '560000.00', '5600000.00', '2024-06-08 15:41:20', 'belum dibayar'),
(38, 36, 27, 4, 3, '560000.00', '1680000.00', '2024-06-08 15:41:21', 'belum dibayar'),
(39, 41, 26, 1, 1, '560000.00', '560000.00', '2024-06-08 15:41:21', 'belum dibayar'),
(40, 42, 26, 2, 1, '560000.00', '560000.00', '2024-06-08 15:41:22', 'belum dibayar'),
(41, 46, 26, 7, 1, '560000.00', '560000.00', '2024-06-08 15:41:22', 'belum dibayar'),
(42, 47, 26, 8, 5, '560000.00', '2800000.00', '2024-06-08 15:41:23', 'belum dibayar'),
(43, 43, 26, 3, 9, '560000.00', '5040000.00', '2024-06-08 15:41:23', 'belum dibayar'),
(44, 44, 26, 4, 10, '560000.00', '5600000.00', '2024-06-08 15:41:24', 'belum dibayar'),
(45, 45, 26, 5, 18, '560000.00', '10080000.00', '2024-06-08 15:41:24', 'sudah dibayar'),
(46, 48, 25, 1, 12, '720000.00', '8640000.00', '2024-06-08 15:41:25', 'belum dibayar'),
(47, 49, 25, 2, 2, '720000.00', '1440000.00', '2024-06-08 15:41:25', 'belum dibayar'),
(48, 50, 25, 4, 1, '720000.00', '720000.00', '2024-06-08 15:41:25', 'belum dibayar'),
(49, 51, 25, 5, 5, '720000.00', '3600000.00', '2024-06-08 15:41:26', 'belum dibayar'),
(50, 52, 25, 6, 8, '720000.00', '5760000.00', '2024-06-08 15:41:26', 'belum dibayar'),
(51, 53, 25, 7, 2, '720000.00', '1440000.00', '2024-06-08 15:41:27', 'belum dibayar'),
(52, 55, 24, 2, 3, '692000.00', '2076000.00', '2024-06-08 15:54:34', 'belum dibayar'),
(53, 60, 24, 7, 1, '692000.00', '692000.00', '2024-06-08 15:54:34', 'belum dibayar'),
(54, 59, 24, 6, 1, '692000.00', '692000.00', '2024-06-08 15:54:34', 'belum dibayar'),
(55, 57, 24, 4, 8, '692000.00', '5536000.00', '2024-06-08 15:54:35', 'belum dibayar'),
(56, 61, 24, 8, 1, '692000.00', '692000.00', '2024-06-08 15:54:35', 'belum dibayar'),
(57, 58, 24, 5, 9, '692000.00', '6228000.00', '2024-06-08 15:54:36', 'belum dibayar'),
(58, 54, 24, 1, 3, '692000.00', '2076000.00', '2024-06-08 15:54:37', 'belum dibayar'),
(59, 56, 24, 3, 2, '692000.00', '1384000.00', '2024-06-08 15:54:37', 'belum dibayar'),
(60, 64, 23, 4, 3, '772000.00', '2316000.00', '2024-06-08 15:54:38', 'belum dibayar'),
(61, 68, 23, 8, 1, '772000.00', '772000.00', '2024-06-08 15:54:38', 'belum dibayar'),
(62, 67, 23, 7, 2, '772000.00', '1544000.00', '2024-06-08 15:54:38', 'belum dibayar'),
(63, 65, 23, 5, 2, '772000.00', '1544000.00', '2024-06-08 15:54:39', 'belum dibayar'),
(64, 66, 23, 6, 2, '772000.00', '1544000.00', '2024-06-08 15:54:39', 'belum dibayar'),
(65, 63, 23, 3, 2, '772000.00', '1544000.00', '2024-06-08 15:54:39', 'belum dibayar'),
(66, 62, 23, 2, 2, '772000.00', '1544000.00', '2024-06-08 15:54:40', 'belum dibayar'),
(67, 73, 22, 5, 3, '1080000.00', '3240000.00', '2024-06-08 15:54:40', 'belum dibayar'),
(68, 74, 22, 6, 3, '1080000.00', '3240000.00', '2024-06-08 15:54:41', 'belum dibayar'),
(69, 75, 22, 7, 1, '1080000.00', '1080000.00', '2024-06-08 15:54:41', 'belum dibayar'),
(70, 71, 22, 3, 1, '1080000.00', '1080000.00', '2024-06-08 15:54:41', 'belum dibayar'),
(71, 72, 22, 4, 8, '1080000.00', '8640000.00', '2024-06-08 15:54:42', 'belum dibayar'),
(72, 69, 22, 1, 3, '1080000.00', '3240000.00', '2024-06-08 15:54:42', 'belum dibayar'),
(73, 70, 22, 2, 1, '1080000.00', '1080000.00', '2024-06-08 15:54:43', 'belum dibayar'),
(74, 77, 21, 4, 3, '380000.00', '1140000.00', '2024-06-08 15:54:43', 'belum dibayar'),
(75, 80, 21, 8, 2, '380000.00', '760000.00', '2024-06-08 15:54:43', 'belum dibayar'),
(76, 78, 21, 5, 1, '380000.00', '380000.00', '2024-06-08 15:54:44', 'belum dibayar'),
(77, 79, 21, 6, 1, '380000.00', '380000.00', '2024-06-08 15:54:44', 'belum dibayar'),
(78, 76, 21, 1, 4, '380000.00', '1520000.00', '2024-06-08 15:54:45', 'belum dibayar'),
(79, 88, 20, 8, 1, '608000.00', '608000.00', '2024-06-08 15:54:45', 'belum dibayar'),
(80, 83, 20, 3, 2, '608000.00', '1216000.00', '2024-06-08 15:54:46', 'belum dibayar'),
(81, 84, 20, 4, 5, '608000.00', '3040000.00', '2024-06-08 15:54:46', 'belum dibayar'),
(82, 85, 20, 5, 5, '608000.00', '3040000.00', '2024-06-08 15:54:46', 'belum dibayar'),
(83, 86, 20, 6, 1, '608000.00', '608000.00', '2024-06-08 15:54:47', 'belum dibayar'),
(84, 87, 20, 7, 2, '608000.00', '1216000.00', '2024-06-08 15:54:47', 'belum dibayar'),
(85, 82, 20, 2, 4, '608000.00', '2432000.00', '2024-06-08 15:54:47', 'belum dibayar'),
(86, 81, 20, 1, 4, '608000.00', '2432000.00', '2024-06-08 15:54:48', 'belum dibayar'),
(87, 89, 19, 3, 2, '480000.00', '960000.00', '2024-06-08 15:54:48', 'belum dibayar'),
(88, 94, 19, 8, 1, '480000.00', '480000.00', '2024-06-08 15:54:49', 'belum dibayar'),
(89, 92, 19, 6, 1, '480000.00', '480000.00', '2024-06-08 15:54:49', 'belum dibayar'),
(90, 93, 19, 7, 2, '480000.00', '960000.00', '2024-06-08 15:54:49', 'belum dibayar'),
(91, 91, 19, 5, 6, '480000.00', '2880000.00', '2024-06-08 15:54:50', 'belum dibayar'),
(92, 90, 19, 4, 1, '480000.00', '480000.00', '2024-06-08 15:54:50', 'belum dibayar'),
(93, 97, 18, 3, 2, '780000.00', '1560000.00', '2024-06-08 15:54:51', 'belum dibayar'),
(94, 100, 18, 6, 1, '780000.00', '780000.00', '2024-06-08 15:54:51', 'belum dibayar'),
(95, 96, 18, 2, 2, '780000.00', '1560000.00', '2024-06-08 15:54:51', 'belum dibayar'),
(96, 99, 18, 5, 1, '780000.00', '780000.00', '2024-06-08 15:54:52', 'belum dibayar'),
(97, 98, 18, 4, 1, '780000.00', '780000.00', '2024-06-08 15:54:52', 'belum dibayar'),
(98, 95, 18, 1, 2, '780000.00', '1560000.00', '2024-06-08 15:54:53', 'belum dibayar'),
(99, 104, 17, 5, 1, '800000.00', '800000.00', '2024-06-08 15:54:53', 'belum dibayar'),
(100, 102, 17, 2, 1, '800000.00', '800000.00', '2024-06-08 15:54:53', 'belum dibayar'),
(101, 105, 17, 6, 3, '800000.00', '2400000.00', '2024-06-08 15:54:54', 'belum dibayar'),
(102, 106, 17, 8, 1, '800000.00', '800000.00', '2024-06-08 15:54:54', 'belum dibayar'),
(103, 103, 17, 3, 2, '800000.00', '1600000.00', '2024-06-08 15:54:55', 'belum dibayar'),
(104, 101, 17, 1, 1, '800000.00', '800000.00', '2024-06-08 15:54:55', 'belum dibayar'),
(105, 108, 16, 4, 1, '960000.00', '960000.00', '2024-06-08 15:54:55', 'belum dibayar'),
(106, 110, 16, 6, 2, '960000.00', '1920000.00', '2024-06-08 15:54:56', 'belum dibayar'),
(107, 107, 16, 3, 2, '960000.00', '1920000.00', '2024-06-08 15:54:56', 'belum dibayar'),
(108, 109, 16, 5, 2, '960000.00', '1920000.00', '2024-06-08 15:54:57', 'belum dibayar'),
(109, 112, 15, 4, 1, '640000.00', '640000.00', '2024-06-08 15:54:57', 'belum dibayar'),
(110, 115, 15, 7, 1, '640000.00', '640000.00', '2024-06-08 15:54:58', 'belum dibayar'),
(111, 113, 15, 5, 4, '640000.00', '2560000.00', '2024-06-08 15:54:58', 'belum dibayar'),
(112, 111, 15, 3, 1, '640000.00', '640000.00', '2024-06-08 15:54:58', 'belum dibayar'),
(113, 114, 15, 6, 2, '640000.00', '1280000.00', '2024-06-08 15:54:59', 'belum dibayar'),
(114, 123, 14, 8, 2, '500000.00', '1000000.00', '2024-06-08 15:54:59', 'belum dibayar'),
(115, 117, 14, 2, 1, '500000.00', '500000.00', '2024-06-08 15:55:00', 'belum dibayar'),
(116, 120, 14, 5, 2, '500000.00', '1000000.00', '2024-06-08 15:55:00', 'belum dibayar'),
(117, 121, 14, 6, 1, '500000.00', '500000.00', '2024-06-08 15:55:01', 'belum dibayar'),
(118, 118, 14, 3, 1, '500000.00', '500000.00', '2024-06-08 15:55:01', 'belum dibayar'),
(119, 122, 14, 7, 1, '500000.00', '500000.00', '2024-06-08 15:55:01', 'belum dibayar'),
(120, 119, 14, 4, 2, '500000.00', '1000000.00', '2024-06-08 15:55:02', 'belum dibayar'),
(121, 116, 14, 1, 1, '500000.00', '500000.00', '2024-06-08 15:55:02', 'belum dibayar'),
(122, 125, 13, 2, 1, '520000.00', '520000.00', '2024-06-08 15:55:03', 'belum dibayar'),
(123, 130, 13, 7, 2, '520000.00', '1040000.00', '2024-06-08 15:55:03', 'belum dibayar'),
(124, 126, 13, 3, 1, '520000.00', '520000.00', '2024-06-08 15:55:03', 'belum dibayar'),
(125, 127, 13, 4, 1, '520000.00', '520000.00', '2024-06-08 15:55:04', 'belum dibayar'),
(126, 128, 13, 5, 4, '520000.00', '2080000.00', '2024-06-08 15:55:04', 'belum dibayar'),
(127, 129, 13, 6, 4, '520000.00', '2080000.00', '2024-06-08 15:55:05', 'belum dibayar'),
(128, 124, 13, 1, 2, '520000.00', '1040000.00', '2024-06-08 15:55:05', 'belum dibayar'),
(129, 132, 12, 3, 1, '440000.00', '440000.00', '2024-06-08 15:55:05', 'belum dibayar'),
(130, 133, 12, 4, 1, '440000.00', '440000.00', '2024-06-08 15:55:06', 'belum dibayar'),
(131, 134, 12, 6, 2, '440000.00', '880000.00', '2024-06-08 15:55:06', 'belum dibayar'),
(132, 131, 12, 1, 1, '440000.00', '440000.00', '2024-06-08 15:55:07', 'belum dibayar'),
(133, 137, 11, 3, 2, '740000.00', '1480000.00', '2024-06-08 16:03:38', 'belum dibayar'),
(134, 138, 11, 4, 1, '740000.00', '740000.00', '2024-06-08 16:03:38', 'belum dibayar'),
(135, 139, 11, 5, 2, '740000.00', '1480000.00', '2024-06-08 16:03:39', 'belum dibayar'),
(136, 141, 11, 7, 3, '740000.00', '2220000.00', '2024-06-08 16:03:39', 'belum dibayar'),
(137, 142, 11, 8, 1, '740000.00', '740000.00', '2024-06-08 16:03:39', 'belum dibayar'),
(138, 140, 11, 6, 2, '740000.00', '1480000.00', '2024-06-08 16:03:40', 'belum dibayar'),
(139, 135, 11, 1, 1, '740000.00', '740000.00', '2024-06-08 16:03:40', 'belum dibayar'),
(140, 136, 11, 2, 2, '740000.00', '1480000.00', '2024-06-08 16:03:41', 'belum dibayar'),
(141, 146, 10, 7, 2, '800000.00', '1600000.00', '2024-06-08 16:03:41', 'belum dibayar'),
(142, 147, 10, 8, 4, '800000.00', '3200000.00', '2024-06-08 16:03:41', 'belum dibayar'),
(143, 143, 10, 4, 2, '800000.00', '1600000.00', '2024-06-08 16:03:42', 'belum dibayar'),
(144, 144, 10, 5, 5, '800000.00', '4000000.00', '2024-06-08 16:03:42', 'belum dibayar'),
(145, 145, 10, 6, 4, '800000.00', '3200000.00', '2024-06-08 16:03:42', 'belum dibayar'),
(146, 155, 9, 8, 5, '660000.00', '3300000.00', '2024-06-08 16:03:43', 'belum dibayar'),
(147, 154, 9, 7, 8, '660000.00', '5280000.00', '2024-06-08 16:03:43', 'belum dibayar'),
(148, 152, 9, 5, 1, '660000.00', '660000.00', '2024-06-08 16:03:43', 'belum dibayar'),
(149, 153, 9, 6, 4, '660000.00', '2640000.00', '2024-06-08 16:03:44', 'belum dibayar'),
(150, 149, 9, 2, 7, '660000.00', '4620000.00', '2024-06-08 16:03:44', 'belum dibayar'),
(151, 150, 9, 3, 2, '660000.00', '1320000.00', '2024-06-08 16:03:44', 'belum dibayar'),
(152, 151, 9, 4, 1, '660000.00', '660000.00', '2024-06-08 16:03:45', 'belum dibayar'),
(153, 148, 9, 1, 3, '660000.00', '1980000.00', '2024-06-08 16:03:45', 'belum dibayar'),
(154, 161, 8, 6, 3, '640000.00', '1920000.00', '2024-06-08 16:03:46', 'belum dibayar'),
(155, 160, 8, 5, 7, '640000.00', '4480000.00', '2024-06-08 16:03:46', 'belum dibayar'),
(156, 163, 8, 8, 3, '640000.00', '1920000.00', '2024-06-08 16:03:46', 'belum dibayar'),
(157, 159, 8, 4, 5, '640000.00', '3200000.00', '2024-06-08 16:03:47', 'belum dibayar'),
(158, 162, 8, 7, 5, '640000.00', '3200000.00', '2024-06-08 16:03:47', 'belum dibayar'),
(159, 158, 8, 3, 5, '640000.00', '3200000.00', '2024-06-08 16:03:47', 'belum dibayar'),
(160, 157, 8, 2, 2, '640000.00', '1280000.00', '2024-06-08 16:03:48', 'belum dibayar'),
(161, 156, 8, 1, 2, '640000.00', '1280000.00', '2024-06-08 16:03:48', 'belum dibayar'),
(162, 166, 7, 3, 1, '500000.00', '500000.00', '2024-06-08 16:03:49', 'belum dibayar'),
(163, 165, 7, 2, 1, '500000.00', '500000.00', '2024-06-08 16:03:49', 'belum dibayar'),
(164, 167, 7, 5, 5, '500000.00', '2500000.00', '2024-06-08 16:03:49', 'belum dibayar'),
(165, 168, 7, 7, 3, '500000.00', '1500000.00', '2024-06-08 16:03:50', 'belum dibayar'),
(166, 164, 7, 1, 2, '500000.00', '1000000.00', '2024-06-08 16:03:50', 'belum dibayar'),
(167, 171, 6, 3, 2, '240000.00', '480000.00', '2024-06-08 16:03:51', 'belum dibayar'),
(168, 173, 6, 5, 3, '240000.00', '720000.00', '2024-06-08 16:03:51', 'belum dibayar'),
(169, 170, 6, 2, 6, '240000.00', '1440000.00', '2024-06-08 16:03:51', 'belum dibayar'),
(170, 172, 6, 4, 1, '240000.00', '240000.00', '2024-06-08 16:03:52', 'belum dibayar'),
(171, 169, 6, 1, 4, '240000.00', '960000.00', '2024-06-08 16:03:52', 'belum dibayar'),
(172, 174, 2, 2, 1, '360000.00', '360000.00', '2024-06-08 16:03:52', 'belum dibayar'),
(173, 176, 2, 4, 6, '360000.00', '2160000.00', '2024-06-08 16:03:53', 'belum dibayar'),
(174, 178, 2, 6, 5, '360000.00', '1800000.00', '2024-06-08 16:03:53', 'belum dibayar'),
(175, 179, 2, 7, 6, '360000.00', '2160000.00', '2024-06-08 16:03:54', 'belum dibayar'),
(176, 177, 2, 5, 8, '360000.00', '2880000.00', '2024-06-08 16:03:54', 'belum dibayar'),
(177, 175, 2, 3, 6, '360000.00', '2160000.00', '2024-06-08 16:03:55', 'belum dibayar'),
(178, 180, 2, 8, 3, '360000.00', '1080000.00', '2024-06-08 16:03:55', 'belum dibayar'),
(179, 184, 3, 4, 3, '400000.00', '1200000.00', '2024-06-08 16:03:55', 'sudah dibayar'),
(180, 187, 3, 7, 3, '400000.00', '1200000.00', '2024-06-08 16:03:56', 'sudah dibayar'),
(181, 182, 3, 2, 1, '400000.00', '400000.00', '2024-06-08 16:03:56', 'sudah dibayar'),
(182, 185, 3, 5, 3, '400000.00', '1200000.00', '2024-06-08 16:03:57', 'sudah dibayar'),
(183, 188, 3, 8, 5, '400000.00', '2000000.00', '2024-06-08 16:03:57', 'sudah dibayar'),
(184, 186, 3, 6, 3, '400000.00', '1200000.00', '2024-06-08 16:03:58', 'sudah dibayar'),
(185, 183, 3, 3, 4, '400000.00', '1600000.00', '2024-06-08 16:03:58', 'sudah dibayar'),
(186, 181, 3, 1, 1, '400000.00', '400000.00', '2024-06-08 16:03:58', 'sudah dibayar'),
(187, 190, 4, 2, 2, '480000.00', '960000.00', '2024-06-08 16:03:59', 'sudah dibayar'),
(188, 194, 4, 6, 4, '480000.00', '1920000.00', '2024-06-08 16:03:59', 'sudah dibayar'),
(189, 195, 4, 7, 2, '480000.00', '960000.00', '2024-06-08 16:03:59', 'sudah dibayar'),
(190, 191, 4, 3, 1, '480000.00', '480000.00', '2024-06-08 16:04:00', 'sudah dibayar'),
(191, 192, 4, 4, 5, '480000.00', '2400000.00', '2024-06-08 16:04:00', 'sudah dibayar'),
(192, 193, 4, 5, 2, '480000.00', '960000.00', '2024-06-08 16:04:01', 'sudah dibayar'),
(193, 189, 4, 1, 2, '480000.00', '960000.00', '2024-06-08 16:04:01', 'belum dibayar'),
(194, 197, 5, 2, 4, '400000.00', '1600000.00', '2024-06-08 16:04:01', 'belum dibayar'),
(195, 198, 5, 3, 1, '400000.00', '400000.00', '2024-06-08 16:04:02', 'belum dibayar'),
(196, 199, 5, 4, 1, '400000.00', '400000.00', '2024-06-08 16:04:02', 'belum dibayar'),
(197, 200, 5, 5, 2, '400000.00', '800000.00', '2024-06-08 16:04:02', 'belum dibayar'),
(198, 201, 5, 6, 1, '400000.00', '400000.00', '2024-06-08 16:04:03', 'belum dibayar'),
(199, 202, 5, 7, 1, '400000.00', '400000.00', '2024-06-08 16:04:03', 'belum dibayar'),
(200, 196, 5, 1, 5, '400000.00', '2000000.00', '2024-06-08 16:04:04', 'sudah dibayar'),
(201, 203, 31, 8, 1, '920000.00', '920000.00', '2024-06-09 14:35:29', 'sudah dibayar'),
(202, 204, 24, 8, 1, '692000.00', '692000.00', '2024-06-22 05:55:32', 'belum dibayar'),
(203, 206, 2, 8, 1, '360000.00', '360000.00', '2024-06-24 11:45:35', 'belum dibayar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ukuran`
--

CREATE TABLE `ukuran` (
  `ukuran_id` int(11) NOT NULL,
  `ukuran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ukuran`
--

INSERT INTO `ukuran` (`ukuran_id`, `ukuran`) VALUES
(1, 38),
(2, 39),
(3, 40),
(4, 41),
(5, 42),
(6, 43),
(7, 44),
(8, 45);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ukuran_sepatu`
--

CREATE TABLE `ukuran_sepatu` (
  `ukuran_sepatu_id` int(11) NOT NULL,
  `sepatu_id` int(11) NOT NULL,
  `ukuran_id` int(11) NOT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ukuran_sepatu`
--

INSERT INTO `ukuran_sepatu` (`ukuran_sepatu_id`, `sepatu_id`, `ukuran_id`, `stok`) VALUES
(9, 2, 1, 0),
(10, 2, 2, 1),
(11, 2, 3, 6),
(12, 2, 4, 6),
(13, 2, 5, 5),
(14, 2, 6, 5),
(15, 2, 7, 6),
(16, 2, 8, 4),
(17, 3, 1, 1),
(18, 3, 2, 1),
(19, 3, 3, 4),
(20, 3, 4, 3),
(21, 3, 5, 3),
(22, 3, 6, 3),
(23, 3, 7, 3),
(24, 3, 8, 4),
(25, 4, 1, 2),
(26, 4, 2, 2),
(27, 4, 3, 1),
(28, 4, 4, 3),
(29, 4, 5, 2),
(30, 4, 6, 4),
(31, 4, 7, 2),
(32, 4, 8, 0),
(33, 5, 1, 1),
(34, 5, 2, 4),
(35, 5, 3, 1),
(36, 5, 4, 1),
(37, 5, 5, 2),
(38, 5, 6, 1),
(39, 5, 7, 1),
(40, 5, 8, 0),
(41, 6, 1, 4),
(42, 6, 2, 3),
(43, 6, 3, 2),
(44, 6, 4, 1),
(45, 6, 5, 3),
(46, 6, 6, 0),
(47, 6, 7, 0),
(48, 6, 8, 0),
(49, 7, 1, 2),
(50, 7, 2, 1),
(51, 7, 3, 1),
(52, 7, 4, 0),
(53, 7, 5, 5),
(54, 7, 6, 0),
(55, 7, 7, 3),
(56, 7, 8, 0),
(57, 8, 1, 0),
(58, 8, 2, 2),
(59, 8, 3, 5),
(60, 8, 4, 5),
(61, 8, 5, 7),
(62, 8, 6, 3),
(63, 8, 7, 5),
(64, 8, 8, 3),
(65, 9, 1, 3),
(66, 9, 2, 7),
(67, 9, 3, 2),
(68, 9, 4, 1),
(69, 9, 5, 1),
(70, 9, 6, 4),
(71, 9, 7, 8),
(72, 9, 8, 5),
(73, 10, 1, 0),
(74, 10, 2, 0),
(75, 10, 3, 0),
(76, 10, 4, 0),
(77, 10, 5, 5),
(78, 10, 6, 4),
(79, 10, 7, 2),
(80, 10, 8, 1),
(81, 11, 1, 1),
(82, 11, 2, 2),
(83, 11, 3, 2),
(84, 11, 4, 1),
(85, 11, 5, 2),
(86, 11, 6, 2),
(87, 11, 7, 3),
(88, 11, 8, 1),
(89, 12, 1, 1),
(90, 12, 2, 0),
(91, 12, 3, 1),
(92, 12, 4, 1),
(93, 12, 5, 0),
(94, 12, 6, 2),
(95, 12, 7, 0),
(96, 12, 8, 0),
(97, 13, 1, 2),
(98, 13, 2, 1),
(99, 13, 3, 1),
(100, 13, 4, 1),
(101, 13, 5, 4),
(102, 13, 6, 4),
(103, 13, 7, 2),
(104, 13, 8, 0),
(105, 14, 1, 1),
(106, 14, 2, 1),
(107, 14, 3, 1),
(108, 14, 4, 2),
(109, 14, 5, 2),
(110, 14, 6, 1),
(111, 14, 7, 1),
(112, 14, 8, 2),
(113, 15, 1, 0),
(114, 15, 2, 0),
(115, 15, 3, 1),
(116, 15, 4, 0),
(117, 15, 5, 2),
(118, 15, 6, 2),
(119, 15, 7, 1),
(120, 15, 8, 0),
(121, 16, 1, 0),
(122, 16, 2, 0),
(123, 16, 3, 2),
(124, 16, 4, 1),
(125, 16, 5, 2),
(126, 16, 6, 2),
(127, 16, 7, 0),
(128, 16, 8, 0),
(129, 17, 1, 1),
(130, 17, 2, 1),
(131, 17, 3, 2),
(132, 17, 4, 0),
(133, 17, 5, 1),
(134, 17, 6, 3),
(135, 17, 7, 0),
(136, 17, 8, 1),
(137, 18, 1, 2),
(138, 18, 2, 2),
(139, 18, 3, 2),
(140, 18, 4, 1),
(141, 18, 5, 1),
(142, 18, 6, 1),
(143, 18, 7, 0),
(144, 18, 8, 0),
(145, 19, 1, 0),
(146, 19, 2, 0),
(147, 19, 3, 2),
(148, 19, 4, 1),
(149, 19, 5, 6),
(150, 19, 6, 1),
(151, 19, 7, 2),
(152, 19, 8, 1),
(153, 20, 1, 4),
(154, 20, 2, 4),
(155, 20, 3, 2),
(156, 20, 4, 5),
(157, 20, 5, 5),
(158, 20, 6, 1),
(159, 20, 7, 2),
(160, 20, 8, 1),
(161, 21, 1, 4),
(162, 21, 2, 0),
(163, 21, 3, 0),
(164, 21, 4, 3),
(165, 21, 5, 1),
(166, 21, 6, 1),
(167, 21, 7, 0),
(168, 21, 8, 2),
(169, 22, 1, 3),
(170, 22, 2, 1),
(171, 22, 3, 1),
(172, 22, 4, 8),
(173, 22, 5, 3),
(174, 22, 6, 3),
(175, 22, 7, 1),
(176, 22, 8, 0),
(177, 23, 1, 0),
(178, 23, 2, 2),
(179, 23, 3, 2),
(180, 23, 4, 3),
(181, 23, 5, 2),
(182, 23, 6, 2),
(183, 23, 7, 2),
(184, 23, 8, 1),
(185, 24, 1, 3),
(186, 24, 2, 3),
(187, 24, 3, 2),
(188, 24, 4, 8),
(189, 24, 5, 5),
(190, 24, 6, 1),
(191, 24, 7, 1),
(192, 24, 8, 2),
(193, 25, 1, 9),
(194, 25, 2, 2),
(195, 25, 3, 0),
(196, 25, 4, 1),
(197, 25, 5, 5),
(198, 25, 6, 8),
(199, 25, 7, 2),
(200, 25, 8, 0),
(201, 26, 1, 1),
(202, 26, 2, 1),
(203, 26, 3, 9),
(204, 26, 4, 10),
(205, 26, 5, 11),
(206, 26, 6, 0),
(207, 26, 7, 1),
(208, 26, 8, 5),
(209, 27, 1, 12),
(210, 27, 2, 10),
(211, 27, 3, 4),
(212, 27, 4, 3),
(213, 27, 5, 3),
(214, 27, 6, 9),
(215, 27, 7, 10),
(216, 27, 8, 1),
(217, 28, 1, 0),
(218, 28, 2, 3),
(219, 28, 3, 11),
(220, 28, 4, 12),
(221, 28, 5, 12),
(222, 28, 6, 4),
(223, 28, 7, 9),
(224, 28, 8, 5),
(225, 29, 1, 1),
(226, 29, 2, 6),
(227, 29, 3, 14),
(228, 29, 4, 0),
(229, 29, 5, 8),
(230, 29, 6, 1),
(231, 29, 7, 9),
(232, 29, 8, 0),
(233, 30, 1, 4),
(234, 30, 2, 9),
(235, 30, 3, 13),
(236, 30, 4, 13),
(237, 30, 5, 10),
(238, 30, 6, 5),
(239, 30, 7, 2),
(240, 30, 8, 1),
(241, 31, 1, 3),
(242, 31, 2, 6),
(243, 31, 3, 3),
(244, 31, 4, 5),
(245, 31, 5, 2),
(246, 31, 6, 3),
(247, 31, 7, 11),
(248, 31, 8, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `username`, `user_email`, `user_password`, `role`) VALUES
(1, 'A. Faril Ainur Khafi', 'faril123', 'faril@gmail.com', 'f123', 'admin'),
(2, 'Ade Verdaus Saputra', 'ade123', 'ade@gmail.com', 'a123', 'admin'),
(3, 'Rizky Dwi Kurniawan', 'rizky123', 'rizky@gmail.com', 'r123', 'user'),
(4, 'Muhammad Ikhwan Sabilillah', 'sabil123', 'sabil@gmail.com', 's123', 'user'),
(5, 'A. Nasikh Zainal Fanani', 'nasikh123', 'nasikh@gmail.com', 'N123', 'supplier'),
(6, 'Fikri Abdullah', 'fikri123', 'fikri@gmail.com', 'f123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `billing_details`
--
ALTER TABLE `billing_details`
  ADD PRIMARY KEY (`billing_id`),
  ADD KEY `user` (`user_id`);

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sepatu_id` (`sepatu_id`),
  ADD KEY `ukuran_id` (`ukuran_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `billing` (`billing_id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `order` (`order_id`),
  ADD KEY `sepatu` (`sepatu_id`),
  ADD KEY `ukuran` (`ukuran_id`);

--
-- Indeks untuk tabel `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `sepatu_id` (`sepatu_id`),
  ADD KEY `ukuran_id` (`ukuran_id`);

--
-- Indeks untuk tabel `sepatu`
--
ALTER TABLE `sepatu`
  ADD PRIMARY KEY (`sepatu_id`),
  ADD KEY `kategori` (`kategori_id`);

--
-- Indeks untuk tabel `transaction_cost`
--
ALTER TABLE `transaction_cost`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `request_id` (`request_id`),
  ADD KEY `sepatu_id` (`sepatu_id`),
  ADD KEY `ukuran_id` (`ukuran_id`);

--
-- Indeks untuk tabel `ukuran`
--
ALTER TABLE `ukuran`
  ADD PRIMARY KEY (`ukuran_id`);

--
-- Indeks untuk tabel `ukuran_sepatu`
--
ALTER TABLE `ukuran_sepatu`
  ADD PRIMARY KEY (`ukuran_sepatu_id`),
  ADD KEY `sepatu_id` (`sepatu_id`),
  ADD KEY `ukuran_id` (`ukuran_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `billing_details`
--
ALTER TABLE `billing_details`
  MODIFY `billing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT untuk tabel `sepatu`
--
ALTER TABLE `sepatu`
  MODIFY `sepatu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `transaction_cost`
--
ALTER TABLE `transaction_cost`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT untuk tabel `ukuran`
--
ALTER TABLE `ukuran`
  MODIFY `ukuran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `ukuran_sepatu`
--
ALTER TABLE `ukuran_sepatu`
  MODIFY `ukuran_sepatu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `billing_details`
--
ALTER TABLE `billing_details`
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`sepatu_id`) REFERENCES `sepatu` (`sepatu_id`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`ukuran_id`) REFERENCES `ukuran` (`ukuran_id`);

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `billing` FOREIGN KEY (`billing_id`) REFERENCES `billing_details` (`billing_id`);

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `sepatu` FOREIGN KEY (`sepatu_id`) REFERENCES `sepatu` (`sepatu_id`),
  ADD CONSTRAINT `ukuran` FOREIGN KEY (`ukuran_id`) REFERENCES `ukuran` (`ukuran_id`);

--
-- Ketidakleluasaan untuk tabel `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`sepatu_id`) REFERENCES `sepatu` (`sepatu_id`),
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`ukuran_id`) REFERENCES `ukuran` (`ukuran_id`);

--
-- Ketidakleluasaan untuk tabel `sepatu`
--
ALTER TABLE `sepatu`
  ADD CONSTRAINT `kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`);

--
-- Ketidakleluasaan untuk tabel `transaction_cost`
--
ALTER TABLE `transaction_cost`
  ADD CONSTRAINT `transaction_cost_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `request` (`request_id`),
  ADD CONSTRAINT `transaction_cost_ibfk_2` FOREIGN KEY (`sepatu_id`) REFERENCES `sepatu` (`sepatu_id`),
  ADD CONSTRAINT `transaction_cost_ibfk_3` FOREIGN KEY (`ukuran_id`) REFERENCES `ukuran` (`ukuran_id`);

--
-- Ketidakleluasaan untuk tabel `ukuran_sepatu`
--
ALTER TABLE `ukuran_sepatu`
  ADD CONSTRAINT `sepatu_id` FOREIGN KEY (`sepatu_id`) REFERENCES `sepatu` (`sepatu_id`),
  ADD CONSTRAINT `ukuran_id` FOREIGN KEY (`ukuran_id`) REFERENCES `ukuran` (`ukuran_id`);

--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
