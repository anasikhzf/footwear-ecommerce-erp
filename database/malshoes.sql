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
  `phone_number` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `billing_details`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cart`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_image`, `created_at`) VALUES
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



-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `order_items`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_requests`
--

CREATE TABLE `stock_requests` (
  `request_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` enum('pending','completed') DEFAULT 'completed',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stock_requests`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `product_status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `product_name`, `product_price`, `product_image`, `product_description`, `product_status`, `created_at`) VALUES
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
-- Struktur dari tabel `supplier_transactions`
--

CREATE TABLE `supplier_transactions` (
  `transaction_id` int(11) NOT NULL,
  `request_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `total_cost` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_status` enum('paid','unpaid') DEFAULT 'unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier_transactions`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `sizes`
--

CREATE TABLE `sizes` (
  `size_id` int(11) NOT NULL,
  `size_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sizes`
--

INSERT INTO `sizes` (`size_id`, `size_value`) VALUES
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
-- Struktur dari tabel `product_sizes`
--

CREATE TABLE `product_sizes` (
  `product_size_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product_sizes`
--

INSERT INTO `product_sizes` (`product_size_id`, `product_id`, `size_id`, `stock`) VALUES
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
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `email`, `password`, `role`) VALUES
(7, 'Default User', 'user', 'user@example.com', 'password', 'user'),
(8, 'Default Admin', 'admin', 'admin@example.com', 'password', 'admin'),
(9, 'Default Supplier', 'supplier', 'supplier@example.com', 'password', 'supplier');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `billing_details`
--
ALTER TABLE `billing_details`
  ADD PRIMARY KEY (`billing_id`),
  ADD KEY `users` (`user_id`);

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

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
  ADD KEY `products` (`product_id`),
  ADD KEY `sizes` (`size_id`);

--
-- Indeks untuk tabel `stock_requests`
--
ALTER TABLE `stock_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `categories` (`category_id`);

--
-- Indeks untuk tabel `supplier_transactions`
--
ALTER TABLE `supplier_transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `request_id` (`request_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Indeks untuk tabel `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`size_id`);

--
-- Indeks untuk tabel `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`product_size_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
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
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- AUTO_INCREMENT untuk tabel `stock_requests`
--
ALTER TABLE `stock_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `supplier_transactions`
--
ALTER TABLE `supplier_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT untuk tabel `sizes`
--
ALTER TABLE `sizes`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `product_size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `billing_details`
--
ALTER TABLE `billing_details`
  ADD CONSTRAINT `users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`size_id`);

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
  ADD CONSTRAINT `products` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `sizes` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`size_id`);

--
-- Ketidakleluasaan untuk tabel `stock_requests`
--
ALTER TABLE `stock_requests`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`size_id`);

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Ketidakleluasaan untuk tabel `supplier_transactions`
--
ALTER TABLE `supplier_transactions`
  ADD CONSTRAINT `transaction_cost_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `stock_requests` (`request_id`),
  ADD CONSTRAINT `transaction_cost_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `transaction_cost_ibfk_3` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`size_id`);

--
-- Ketidakleluasaan untuk tabel `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `size_id` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`size_id`);

--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
