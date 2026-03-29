-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2025 at 08:23 AM
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
-- Database: `laravel_crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`, `parent_id`) VALUES
(1, 'Vợt cầu lông Yonex', '2025-08-09 03:55:22', '2025-09-12 12:45:03', NULL),
(2, 'Vợt cầu lông Lining', '2025-08-10 20:25:46', '2025-09-12 12:44:10', NULL),
(3, 'Vợt cầu lông Victor', '2025-08-25 03:20:09', '2025-09-12 12:45:20', NULL),
(5, 'Vợt cầu lông Adidas', '2025-09-12 12:45:37', '2025-09-12 12:46:10', NULL),
(6, 'Vợt cầu lông Apacs', '2025-09-12 12:45:58', '2025-09-12 12:45:58', NULL),
(7, 'Vợt cầu lông Kawasaki', '2025-09-12 12:46:37', '2025-09-12 12:46:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

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
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_09_092229_create_categories_table', 1),
(5, '2025_08_09_092302_create_products_table', 1),
(6, '2025_08_09_095047_add_role_to_users_table', 2),
(7, '2025_08_11_033249_add_image_to_products_table', 3),
(8, '2025_08_11_041508_create_orders_table', 4),
(9, '2025_08_11_041515_create_order_items_table', 4),
(10, '2025_08_15_021929_add_payment_method_and_status_to_orders_table', 5),
(11, '2025_08_15_042625_add_stock_to_products_table', 6),
(12, '2025_08_15_044504_add_quantity_to_products_table', 7),
(13, '2025_08_18_062650_update_order_status_values', 8),
(14, '2025_08_22_014256_create_promotions_table', 8),
(15, '2025_08_25_084120_create_payments_table', 9),
(16, '2025_08_29_100310_create_reviews_table', 10),
(17, '2025_09_08_085400_add_parent_id_to_reviews_table', 11),
(18, '2025_09_12_172622_add_parent_id_to_categories_table', 12),
(19, '2025_09_12_183526_create_sizes_table', 12),
(20, '2025_09_12_183736_create_product_size_table', 12),
(21, '2025_09_12_184127_create_colors_table', 12),
(22, '2025_09_14_143103_add_discounted_price_to_order_items', 13);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL DEFAULT 'cod',
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `phone`, `address`, `total`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Trịnh Quang Minh', '232445467', 'minh', 30031000.00, 'cod', 'cancelled', '2025-08-10 21:23:23', '2025-08-17 23:21:37'),
(2, 1, 'Trịnh Quang Minh', '232445467', 'minh', 10000.00, 'cod', 'pending', '2025-08-14 18:15:56', '2025-08-14 18:15:56'),
(3, 1, 'Trịnh Quang Minh', '232445467', 'minh', 10000.00, 'cod', 'pending', '2025-08-14 18:25:28', '2025-08-14 18:25:28'),
(4, 1, 'Trịnh Quang Minh', '232445467', 'minh', 10000.00, 'cod', 'pending', '2025-08-14 18:26:35', '2025-08-14 18:26:35'),
(5, 1, 'Trịnh Quang Minh', '232445467', 'minh', 1000.00, 'cod', 'cancelled', '2025-08-14 18:28:43', '2025-08-17 23:22:33'),
(6, 1, 'Trịnh Quang Minh', '232445467', 'minh', 10000.00, 'cod', 'pending', '2025-08-14 18:33:25', '2025-08-14 18:33:25'),
(7, 1, 'Trịnh Quang Minh', '232445467', 'minh', 10012000.00, 'cod', 'pending', '2025-08-14 18:34:15', '2025-08-14 18:34:15'),
(8, 2, 'Trịnh Quang Minh', '232445467', 'minh', 10011000.00, 'cod', 'pending', '2025-08-14 18:47:56', '2025-08-14 18:47:56'),
(9, 2, 'Trịnh Quang Minh', '232445467', 'minh', 10000.00, 'cod', 'pending', '2025-08-14 18:48:09', '2025-08-14 18:48:09'),
(10, 2, 'Trịnh Quang Minh', '232445467', 'minh', 10001000.00, 'cod', 'pending', '2025-08-14 18:48:47', '2025-08-14 18:48:47'),
(11, 2, 'Trịnh Quang Minh', '232445467', 'minh', 10000.00, 'cod', 'pending', '2025-08-14 19:12:39', '2025-08-14 19:12:39'),
(12, 2, 'Trịnh Quang Minh', '0354883247', 'minh', 10000.00, 'cod', 'pending', '2025-08-14 19:13:31', '2025-08-14 19:13:31'),
(13, 2, 'Trịnh Quang Minh', '232445467', 'minh', 10000.00, 'cod', 'completed', '2025-08-14 19:13:58', '2025-08-17 20:02:41'),
(37, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 1000.00, 'cod', 'cancelled', '2025-08-17 19:48:34', '2025-08-17 19:48:58'),
(38, 1, 'Trịnh Quang Minh', '0354883247', 'gg', 10000000.00, 'cod', 'cancelled', '2025-08-17 20:04:21', '2025-08-17 20:12:04'),
(40, 1, 'Trịnh Quang Minh', '0354883247', 'mm', 10000000.00, 'cod', 'cancelled', '2025-08-17 20:12:15', '2025-08-17 20:27:07'),
(41, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10000000.00, 'cod', 'pending', '2025-08-17 21:27:43', '2025-08-17 21:27:43'),
(42, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10010000.00, 'cod', 'pending', '2025-08-17 21:28:57', '2025-08-17 21:28:57'),
(43, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10000000.00, 'cod', 'pending', '2025-08-17 21:38:25', '2025-08-17 21:38:25'),
(44, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10000000.00, 'cod', 'pending', '2025-08-17 21:40:50', '2025-08-17 21:40:50'),
(45, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10000000.00, 'cod', 'ordered', '2025-08-17 22:25:36', '2025-08-17 22:25:36'),
(46, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10000000.00, 'cod', 'ordered', '2025-08-17 22:26:19', '2025-08-17 22:26:19'),
(47, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 4000.00, 'cod', 'ordered', '2025-08-17 22:26:42', '2025-08-17 22:26:42'),
(48, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 4000.00, 'cod', 'ordered', '2025-08-17 22:27:07', '2025-08-17 22:27:07'),
(49, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10000000.00, 'cod', 'ordered', '2025-08-17 22:29:35', '2025-08-17 22:29:35'),
(50, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10000000.00, 'cod', 'pending', '2025-08-17 22:30:20', '2025-08-17 22:30:20'),
(51, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10000000.00, 'cod', 'completed', '2025-08-17 22:32:19', '2025-08-17 22:53:50'),
(54, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 1000.00, 'cod', 'pending', '2025-08-17 22:39:02', '2025-08-17 22:39:02'),
(55, 1, 'Trịnh Quang Minh', '232445467', 'minh', 10000000.00, 'cod', 'cancelled', '2025-08-17 22:40:49', '2025-08-17 22:58:00'),
(56, 1, 'Trịnh Quang Minh', '232445467', 'minh', 10000.00, 'cod', 'pending', '2025-08-17 23:22:24', '2025-08-17 23:22:24'),
(57, 1, 'Nguyễn Văn A', '0901234567', 'Hà Nội', 500000.00, 'cod', 'pending', '2025-08-17 23:27:30', '2025-08-17 23:27:30'),
(58, 1, 'Trần Thị B', '0912345678', 'Hồ Chí Minh', 300000.00, 'cod', 'completed', '2025-08-17 23:27:30', '2025-08-17 23:27:30'),
(59, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10000000.00, 'cod', 'pending', '2025-08-17 23:28:32', '2025-08-17 23:28:32'),
(60, 1, 'Trịnh Quang Minh', '232445467', 'minh', 10000000.00, 'cod', 'pending', '2025-08-17 23:40:46', '2025-08-17 23:40:46'),
(61, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 1000.00, 'cod', 'cancelled', '2025-08-17 23:41:08', '2025-08-18 00:57:33'),
(62, 2, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 1000.00, 'cod', 'pending', '2025-08-18 00:59:19', '2025-08-18 00:59:19'),
(63, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 1000.00, 'cod', 'pending', '2025-08-18 03:16:18', '2025-08-18 03:16:18'),
(64, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10000000.00, 'cod', 'pending', '2025-08-18 03:19:36', '2025-08-18 03:19:36'),
(65, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10000.00, 'cod', 'pending', '2025-08-18 03:20:17', '2025-08-18 03:20:17'),
(66, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 20000.00, 'cod', 'completed', '2025-08-18 03:20:29', '2025-08-18 03:22:49'),
(67, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10011000.00, 'cod', 'pending', '2025-08-21 19:24:53', '2025-08-21 19:24:53'),
(68, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10010000.00, 'cod', 'pending', '2025-08-22 03:50:23', '2025-08-22 03:50:23'),
(69, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10011000.00, 'cod', 'pending', '2025-08-22 03:57:06', '2025-08-22 03:57:06'),
(70, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10011000.00, 'cod', 'pending', '2025-08-22 04:01:31', '2025-08-22 04:01:31'),
(71, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10011000.00, 'cod', 'pending', '2025-08-22 04:01:38', '2025-08-22 04:01:38'),
(72, 1, 'Trịnh Quang Minh', '0354883247', 'hn', 100000.00, 'cod', 'pending', '2025-08-25 02:08:41', '2025-08-25 02:08:41'),
(73, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 100000.00, 'cod', 'pending', '2025-08-25 02:10:16', '2025-08-25 02:10:16'),
(74, 1, 'Trịnh Quang Minh', '232445467', 'minh', 10000.00, 'cod', 'pending', '2025-08-25 02:13:25', '2025-08-25 02:13:25'),
(75, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10000000.00, 'cod', 'cancelled', '2025-08-25 02:22:42', '2025-08-25 03:10:37'),
(76, 1, 'Trịnh Quang Minh', '232445467', 'minh', 10000000.00, 'cod', 'cancelled', '2025-08-25 02:32:31', '2025-08-25 03:03:57'),
(77, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10000000.00, 'cod', 'completed', '2025-08-25 02:36:30', '2025-08-25 02:40:55'),
(78, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10000000.00, 'vnpay', 'paid', '2025-08-25 02:51:27', '2025-08-25 02:52:38'),
(79, 1, 'Trịnh Quang Minh', '232445467', 'minh', 200000.00, 'cod', 'processing', '2025-08-25 03:23:32', '2025-08-25 03:24:48'),
(80, 1, 'Trịnh Quang Minh', '0354883247', 'minh', 200000.00, 'cod', 'pending', '2025-08-25 03:58:10', '2025-08-25 03:58:10'),
(81, 1, 'Trịnh Quang Minh', '232445467', 'minh', 10000000.00, 'cod', 'completed', '2025-08-29 03:46:13', '2025-08-29 03:58:21'),
(82, 1, 'Trịnh Quang Minh', '232445467', 'minh', 100000.00, 'cod', 'pending', '2025-09-08 05:06:50', '2025-09-08 05:06:50'),
(83, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10000000.00, 'cod', 'pending', '2025-09-12 12:18:47', '2025-09-12 12:18:47'),
(85, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10000000.00, 'cod', 'pending', '2025-09-12 12:21:23', '2025-09-12 12:21:23'),
(86, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10000000.00, 'cod', 'pending', '2025-09-12 12:22:43', '2025-09-12 12:22:43'),
(87, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10000000.00, 'cod', 'pending', '2025-09-12 12:24:29', '2025-09-12 12:24:29'),
(88, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10000000.00, 'cod', 'pending', '2025-09-12 12:28:41', '2025-09-12 12:28:41'),
(89, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 10000000.00, 'cod', 'pending', '2025-09-12 12:29:16', '2025-09-12 12:29:16'),
(90, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 4758000.00, 'vnpay', 'paid', '2025-09-12 12:55:58', '2025-09-12 12:56:44'),
(91, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 1290000.00, 'cod', 'pending', '2025-09-12 13:06:26', '2025-09-12 13:06:26'),
(92, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 1339000.00, 'vnpay', 'pending', '2025-09-12 15:47:06', '2025-09-12 15:47:06'),
(93, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 1339000.00, 'cod', 'pending', '2025-09-12 15:47:22', '2025-09-12 15:47:22'),
(94, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 3398000.00, 'cod', 'pending', '2025-09-12 16:19:35', '2025-09-12 16:19:35'),
(95, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 5408000.00, 'cod', 'pending', '2025-09-13 06:45:13', '2025-09-13 06:45:13'),
(96, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 5398000.00, 'vnpay', 'completed', '2025-09-14 07:03:23', '2025-09-15 08:37:29'),
(97, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 2699000.00, 'cod', 'pending', '2025-09-14 07:06:17', '2025-09-14 07:06:17'),
(98, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 2699000.00, 'cod', 'completed', '2025-09-14 07:06:52', '2025-09-14 07:35:27'),
(104, 2, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 1349500.00, 'cod', 'pending', '2025-09-14 07:36:37', '2025-09-14 07:36:37'),
(105, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 2059000.00, 'cod', 'pending', '2025-09-15 01:52:30', '2025-09-15 01:52:30'),
(106, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 1349500.00, 'cod', 'cancelled', '2025-09-15 02:09:40', '2025-09-15 02:09:58'),
(107, 1, 'Trịnh Quang Minh', '0354883247', 'Ha Noi\r\nNam Dinh', 1290000.00, 'cod', 'pending', '2025-09-15 08:18:40', '2025-09-15 08:18:40');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discounted_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `discounted_price`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 3, 10000.00, NULL, '2025-08-10 21:23:23', '2025-08-10 21:23:23'),
(2, 1, 3, 1, 1000.00, NULL, '2025-08-10 21:23:23', '2025-08-10 21:23:23'),
(3, 1, 1, 3, 10000000.00, NULL, '2025-08-10 21:23:23', '2025-08-10 21:23:23'),
(4, 2, 5, 1, 10000.00, NULL, '2025-08-14 18:15:56', '2025-08-14 18:15:56'),
(5, 3, 5, 1, 10000.00, NULL, '2025-08-14 18:25:28', '2025-08-14 18:25:28'),
(6, 4, 5, 1, 10000.00, NULL, '2025-08-14 18:26:35', '2025-08-14 18:26:35'),
(7, 5, 3, 1, 1000.00, NULL, '2025-08-14 18:28:43', '2025-08-14 18:28:43'),
(8, 6, 5, 1, 10000.00, NULL, '2025-08-14 18:33:25', '2025-08-14 18:33:25'),
(9, 7, 3, 2, 1000.00, NULL, '2025-08-14 18:34:15', '2025-08-14 18:34:15'),
(10, 7, 1, 1, 10000000.00, NULL, '2025-08-14 18:34:15', '2025-08-14 18:34:15'),
(11, 7, 5, 1, 10000.00, NULL, '2025-08-14 18:34:15', '2025-08-14 18:34:15'),
(12, 8, 5, 1, 10000.00, NULL, '2025-08-14 18:47:56', '2025-08-14 18:47:56'),
(13, 8, 3, 1, 1000.00, NULL, '2025-08-14 18:47:56', '2025-08-14 18:47:56'),
(14, 8, 1, 1, 10000000.00, NULL, '2025-08-14 18:47:56', '2025-08-14 18:47:56'),
(15, 9, 5, 1, 10000.00, NULL, '2025-08-14 18:48:09', '2025-08-14 18:48:09'),
(16, 10, 3, 1, 1000.00, NULL, '2025-08-14 18:48:47', '2025-08-14 18:48:47'),
(17, 10, 1, 1, 10000000.00, NULL, '2025-08-14 18:48:47', '2025-08-14 18:48:47'),
(18, 11, 5, 1, 10000.00, NULL, '2025-08-14 19:12:39', '2025-08-14 19:12:39'),
(19, 12, 5, 1, 10000.00, NULL, '2025-08-14 19:13:31', '2025-08-14 19:13:31'),
(20, 13, 5, 1, 10000.00, NULL, '2025-08-14 19:13:58', '2025-08-14 19:13:58'),
(44, 37, 3, 1, 1000.00, NULL, '2025-08-17 19:48:34', '2025-08-17 19:48:34'),
(45, 38, 1, 1, 10000000.00, NULL, '2025-08-17 20:04:21', '2025-08-17 20:04:21'),
(47, 40, 1, 1, 10000000.00, NULL, '2025-08-17 20:12:15', '2025-08-17 20:12:15'),
(48, 41, 1, 1, 10000000.00, NULL, '2025-08-17 21:27:43', '2025-08-17 21:27:43'),
(49, 42, 1, 1, 10000000.00, NULL, '2025-08-17 21:28:57', '2025-08-17 21:28:57'),
(50, 42, 5, 1, 10000.00, NULL, '2025-08-17 21:28:57', '2025-08-17 21:28:57'),
(51, 43, 1, 1, 10000000.00, NULL, '2025-08-17 21:38:25', '2025-08-17 21:38:25'),
(52, 44, 1, 1, 10000000.00, NULL, '2025-08-17 21:40:50', '2025-08-17 21:40:50'),
(53, 45, 1, 1, 10000000.00, NULL, '2025-08-17 22:25:36', '2025-08-17 22:25:36'),
(54, 46, 1, 1, 10000000.00, NULL, '2025-08-17 22:26:19', '2025-08-17 22:26:19'),
(55, 47, 3, 4, 1000.00, NULL, '2025-08-17 22:26:42', '2025-08-17 22:26:42'),
(56, 48, 3, 4, 1000.00, NULL, '2025-08-17 22:27:07', '2025-08-17 22:27:07'),
(57, 49, 1, 1, 10000000.00, NULL, '2025-08-17 22:29:35', '2025-08-17 22:29:35'),
(58, 50, 1, 1, 10000000.00, NULL, '2025-08-17 22:30:20', '2025-08-17 22:30:20'),
(59, 51, 1, 1, 10000000.00, NULL, '2025-08-17 22:32:19', '2025-08-17 22:32:19'),
(62, 54, 3, 1, 1000.00, NULL, '2025-08-17 22:39:02', '2025-08-17 22:39:02'),
(63, 55, 1, 1, 10000000.00, NULL, '2025-08-17 22:40:49', '2025-08-17 22:40:49'),
(64, 56, 5, 1, 10000.00, NULL, '2025-08-17 23:22:24', '2025-08-17 23:22:24'),
(65, 59, 1, 1, 10000000.00, NULL, '2025-08-17 23:28:32', '2025-08-17 23:28:32'),
(66, 60, 1, 1, 10000000.00, NULL, '2025-08-17 23:40:46', '2025-08-17 23:40:46'),
(67, 61, 3, 1, 1000.00, NULL, '2025-08-17 23:41:08', '2025-08-17 23:41:08'),
(68, 62, 3, 1, 1000.00, NULL, '2025-08-18 00:59:19', '2025-08-18 00:59:19'),
(69, 63, 3, 1, 1000.00, NULL, '2025-08-18 03:16:18', '2025-08-18 03:16:18'),
(70, 64, 1, 1, 10000000.00, NULL, '2025-08-18 03:19:36', '2025-08-18 03:19:36'),
(71, 65, 5, 1, 10000.00, NULL, '2025-08-18 03:20:17', '2025-08-18 03:20:17'),
(72, 66, 5, 2, 10000.00, NULL, '2025-08-18 03:20:29', '2025-08-18 03:20:29'),
(73, 67, 1, 1, 10000000.00, NULL, '2025-08-21 19:24:53', '2025-08-21 19:24:53'),
(74, 67, 3, 1, 1000.00, NULL, '2025-08-21 19:24:53', '2025-08-21 19:24:53'),
(75, 67, 5, 1, 10000.00, NULL, '2025-08-21 19:24:53', '2025-08-21 19:24:53'),
(76, 68, 1, 1, 10000000.00, NULL, '2025-08-22 03:50:23', '2025-08-22 03:50:23'),
(77, 68, 5, 1, 10000.00, NULL, '2025-08-22 03:50:23', '2025-08-22 03:50:23'),
(78, 69, 1, 1, 10000000.00, NULL, '2025-08-22 03:57:06', '2025-08-22 03:57:06'),
(79, 69, 3, 1, 1000.00, NULL, '2025-08-22 03:57:06', '2025-08-22 03:57:06'),
(80, 69, 5, 1, 10000.00, NULL, '2025-08-22 03:57:06', '2025-08-22 03:57:06'),
(81, 70, 1, 1, 10000000.00, NULL, '2025-08-22 04:01:31', '2025-08-22 04:01:31'),
(82, 70, 5, 1, 10000.00, NULL, '2025-08-22 04:01:31', '2025-08-22 04:01:31'),
(83, 70, 3, 1, 1000.00, NULL, '2025-08-22 04:01:31', '2025-08-22 04:01:31'),
(84, 71, 1, 1, 10000000.00, NULL, '2025-08-22 04:01:38', '2025-08-22 04:01:38'),
(85, 71, 5, 1, 10000.00, NULL, '2025-08-22 04:01:38', '2025-08-22 04:01:38'),
(86, 71, 3, 1, 1000.00, NULL, '2025-08-22 04:01:38', '2025-08-22 04:01:38'),
(87, 72, 3, 1, 100000.00, NULL, '2025-08-25 02:08:41', '2025-08-25 02:08:41'),
(88, 73, 3, 1, 100000.00, NULL, '2025-08-25 02:10:16', '2025-08-25 02:10:16'),
(89, 74, 5, 1, 10000.00, NULL, '2025-08-25 02:13:25', '2025-08-25 02:13:25'),
(90, 75, 1, 1, 10000000.00, NULL, '2025-08-25 02:22:42', '2025-08-25 02:22:42'),
(91, 76, 1, 1, 10000000.00, NULL, '2025-08-25 02:32:31', '2025-08-25 02:32:31'),
(92, 77, 1, 1, 10000000.00, NULL, '2025-08-25 02:36:30', '2025-08-25 02:36:30'),
(93, 78, 1, 1, 10000000.00, NULL, '2025-08-25 02:51:27', '2025-08-25 02:51:27'),
(94, 79, 7, 1, 200000.00, NULL, '2025-08-25 03:23:32', '2025-08-25 03:23:32'),
(95, 80, 7, 1, 200000.00, NULL, '2025-08-25 03:58:10', '2025-08-25 03:58:10'),
(96, 81, 1, 1, 10000000.00, NULL, '2025-08-29 03:46:13', '2025-08-29 03:46:13'),
(97, 82, 3, 1, 100000.00, NULL, '2025-09-08 05:06:50', '2025-09-08 05:06:50'),
(98, 89, 1, 1, 10000000.00, NULL, '2025-09-12 12:29:16', '2025-09-12 12:29:16'),
(99, 90, 1, 1, 2059000.00, NULL, '2025-09-12 12:55:58', '2025-09-12 12:55:58'),
(100, 90, 7, 1, 2699000.00, NULL, '2025-09-12 12:55:58', '2025-09-12 12:55:58'),
(101, 91, 3, 1, 1290000.00, NULL, '2025-09-12 13:06:26', '2025-09-12 13:06:26'),
(102, 92, 5, 1, 1339000.00, NULL, '2025-09-12 15:47:06', '2025-09-12 15:47:06'),
(103, 93, 5, 1, 1339000.00, NULL, '2025-09-12 15:47:22', '2025-09-12 15:47:22'),
(104, 94, 5, 1, 1339000.00, NULL, '2025-09-12 16:19:35', '2025-09-12 16:19:35'),
(105, 94, 1, 1, 2059000.00, NULL, '2025-09-12 16:19:35', '2025-09-12 16:19:35'),
(106, 95, 1, 2, 2059000.00, NULL, '2025-09-13 06:45:13', '2025-09-13 06:45:13'),
(107, 95, 3, 1, 1290000.00, NULL, '2025-09-13 06:45:13', '2025-09-13 06:45:13'),
(108, 96, 7, 2, 2699000.00, NULL, '2025-09-14 07:03:23', '2025-09-14 07:03:23'),
(109, 97, 7, 1, 2699000.00, NULL, '2025-09-14 07:06:17', '2025-09-14 07:06:17'),
(110, 98, 7, 1, 2699000.00, NULL, '2025-09-14 07:06:52', '2025-09-14 07:06:52'),
(116, 104, 7, 1, 2699000.00, NULL, '2025-09-14 07:36:37', '2025-09-14 07:36:37'),
(117, 105, 1, 1, 2059000.00, NULL, '2025-09-15 01:52:30', '2025-09-15 01:52:30'),
(118, 106, 7, 1, 2699000.00, NULL, '2025-09-15 02:09:40', '2025-09-15 02:09:40'),
(119, 107, 3, 1, 1290000.00, NULL, '2025-09-15 08:18:40', '2025-09-15 08:18:40');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('tqmminh2004tqm@gmail.com', '$2y$12$/GS82PSw7hGjpYcPO0JP0uoEFePfmVL9THSDgxlLkUBHra1jlB27q', '2025-09-13 14:18:57');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` enum('COD','online') NOT NULL DEFAULT 'online',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `category_id`, `created_at`, `updated_at`, `stock`) VALUES
(1, 'Vợt cầu lông Yonex Astrox 99 Game chính hãng', 'Vợt cầu lông Yonex Astrox 99 Game có điểm cân bằng nặng đầu, thân vợt ở mức trung bình cứng, được thiết kế hướng đến các đối tượng người chơi trình độ trung bình trở lên, phải có cổ tay ổn mới có thể kiểm soát vợt.', 2059000.00, 'products/buoPjCXubFd2arzvZ8hMCNyTs3Yu3Hf05JJTNMkO.jpg', 1, '2025-08-09 03:55:47', '2025-09-15 01:52:30', 5),
(3, 'Vợt cầu lông Yonex Voltric 1 DG chính hãng', 'Vợt cầu lông Yonex Voltric 1 DG là dòng vợt tầm trung được thiết kế với màu vợt sáng bắt mắt, tăng tính thẩm mĩ và tự tin hơn cho người chơi.\r\nYonex Voltric 1 DG có phần đầu nặng, thích hợp cho những người có lực cổ tay tốt, thích đập cầu gây áp lực và nhanh chóng kết liễu đối phương một cách mạnh mẽ.', 1290000.00, 'products/sd5BfQXu6lN3zhm8NJAZtdfXYOJQ52E3I9hjWs8e.jpg', 1, '2025-08-10 20:34:30', '2025-09-15 08:18:40', 10),
(5, 'Vợt cầu lông Yonex Nanoflare 700 Play 2024 – Hàng chính hãng', 'Vợt cầu lông Yonex Nanoflare 700 Play chính hãng là một trong những dòng vợt nổi bật thuộc series Nanoflare của Yonex. Sản phẩm được thiết kế đặc biệt để mang lại tốc độ và khả năng điều khiển tối ưu, phù hợp với người chơi yêu thích lối đánh nhanh, linh hoạt. Hãy cùng tìm hiểu chi tiết về dòng vợt này cùng Vợt Cầu Lông Shop qua bài viết dưới đây nhé!', 1339000.00, 'products/FhOZWKY60DK9cbkoqWH8B5uZfYwFgZ47Bc8A6lUk.jpg', 1, '2025-08-10 20:46:01', '2025-09-14 07:35:19', 10),
(7, 'Vợt cầu lông Yonex Nanoflare 700 Tour – Hàng chính hãng', 'Vợt cầu lông Yonex Nanoflare 700 Tour chính hãng là một trong những dòng vợt nổi bật thuộc series Nanoflare của Yonex. Sản phẩm được thiết kế đặc biệt để mang lại tốc độ và khả năng điều khiển tối ưu, phù hợp với người chơi yêu thích lối đánh nhanh, linh hoạt.', 2699000.00, 'products/ZmvMoce5rluB8KcpQdIOrT8Zq8YdpJJPqJEAJA9w.jpg', 1, '2025-08-25 03:22:47', '2025-09-15 02:09:58', 12),
(8, 'Set vợt cầu lông Yonex Astrox SV new 2024 – Nội địa', 'Set vợt cầu lông Yonex Astrox SV new 2024 – Nội địa là dòng sản phẩm mới nhất từ thương hiệu Yonex, được thiết kế đặc biệt để mang lại trải nghiệm chơi cầu lông tối ưu cho người dùng.', 3555000.00, 'products/Pnnhjyh8Iw7AbLh3AEJVVTVFC19dkEbAFcQ6xjI4.jpg', 1, '2025-09-08 04:19:32', '2025-09-12 15:39:26', 9),
(10, 'Vợt Cầu Lông Yonex Astrox 11 Power – Nội địa Trung', 'Yonex, một trong những đại diện hàng đầu trong thế giới cầu lông, đã gặt hái được danh tiếng toàn cầu với thiết kế độc đáo và chất lượng sản phẩm không tưởng. Với sự đa dạng trong mẫu mã và phân khúc sản phẩm từ tầm trung đến cao cấp, hãng đã mang đến cho người chơi nhiều lựa chọn hấp dẫn.\r\n\r\nMới đây, Yonex đã chính thức giới thiệu trên khắp thế giới một cây vợt mới mang tên đầy đủ là Vợt Cầu Lông Yonex Astrox 11 Power – Nội địa Trung. Đây là một bước tiến đột phá trong việc sáng tạo và nâng cao trải nghiệm chơi cầu lông, đặc biệt được chế tạo và phát triển bởi thương hiệu hàng đầu từ đất nước mặt trời mọc, Nhật Bản. Astrox 11 Power không chỉ đẹp mắt với thiết kế tinh tế, mà còn hứa hẹn mang đến cho người chơi sức mạnh và hiệu suất chưa từng có.', 2600000.00, 'products/mFlru3KkvP2ZqQqTwby6QdGHglGdPH7Z67BUu6Qz.jpg', 1, '2025-09-18 05:45:21', '2025-09-18 05:45:21', 15),
(11, 'Vợt Cầu Lông Yonex Nanoray 72 Light Cam Chính Hãng', 'Cây Vợt cầu lông Yonex Nanoray 72 Light Cam Chính Hãng dành cho người mới và người tập luyện. Vợt nhẹ, dễ kiểm soát, phù hợp cho người chơi tốc độ và lối đánh điều cầu. Thuộc phân khúc sơ cấp của Yonex, giá cả hợp lý, chắc chắn sẽ trở thành cây vợt phổ biến dưới 1 triệu đồng.', 2555000.00, 'products/ZVryJk6pgLUBqCX28E6Z2HbvSOCtrhadX9kGParj.jpg', 1, '2025-09-18 05:49:58', '2025-09-18 06:22:15', 10),
(12, 'Vợt Cầu Lông Yonex Arcsaber 73 Light Vàng Chính Hãng', 'Vợt cầu lông Yonex Arcsaber 73 Light Vàng Chính Hãng là sự lựa chọn tốt cho những người mới bắt đầu và đang tập luyện cầu lông. Được thiết kế nhẹ nhàng và cân bằng, cây vợt này dễ dàng kiểm soát, phù hợp cho những người chơi có lối chơi công thủ toàn diện và linh hoạt trong cách đối phó với đối thủ. Đây là một sản phẩm thuộc phân khúc sơ cấp của thương hiệu Yonex, một tên tuổi hàng đầu trong ngành công nghiệp cầu lông.\r\n\r\nVới mức giá hợp lý, Arcsaber 73 Light mang đến những tính năng xuất sắc của thương hiệu Nhật Bản, và dự kiến sẽ trở thành một cây vợt phổ biến trong phân khúc dưới 1 triệu đồng. Sản phẩm này hứa hẹn giúp người chơi nâng cao kỹ năng và cảm giác trên sân cầu lông, và là sự lựa chọn lý tưởng cho những ai muốn khám phá thế giới thú vị của môn thể thao này.', 712500.00, 'products/gTyI78WpD1Gn1TmyOwDrxMGdbdSC5VJHBAsUBuek.jpg', 1, '2025-09-18 05:51:37', '2025-09-18 05:51:37', 13),
(13, 'Vợt Cầu Lông Yonex Astrox 88D Game JP – Nội địa Nhật', 'Duyệt qua sự thành công mạnh mẽ trên bảng xếp hạng cầu lông thế giới từ khi xuất hiện, siêu phẩm Vợt Cầu Lông Yonex Astrox 88D Game JP – Nội địa Nhật không chỉ là một cây vợt, mà là một “bảo kiếm” đầy uy lực, vô cùng mạnh mẽ và hoàn hảo cho những người yêu thích đánh đôi. Điều đặc biệt là, nếu bạn mong muốn trải nghiệm sự hòa mình vào thiết kế đỉnh cao với các thông số điều khiển dễ dàng hơn, và đặc biệt, với giá bán chỉ bằng một nửa, thì Vợt cầu lông Yonex Astrox 88D Game chính hãng là sự lựa chọn không thể tuyệt vời hơn. Đừng bỏ lỡ cơ hội đặc biệt này, nó sẽ chinh phục bạn ngay từ cái nhìn đầu tiên!', 2545000.00, 'products/n1Czst6wbqyQr91bevWMDhN1bRG529psn3zTZMZa.jpg', 1, '2025-09-18 05:53:12', '2025-09-18 05:53:12', 12),
(14, 'Vợt cầu lông Lining Axforce 90 – Loh Kean Yew hàng nội địa', 'Vợt cầu lông Lining Axforce 90 – Loh Kean Yew là cây vợt cầu lông cao cấp thuộc dòng Axforce của thương hiệu Lining. Được thiết kế để tri ân những thành tựu và cống hiến của VĐV Loh Kean Yew. Đây là một lựa chọn tuyệt vời cho những người chơi cầu lông có trình độ từ trung bình đến đến chuyên nghiệp ưa thích lối chơi tấn công mạnh mẽ. Vợt có thiết kế màu sắc nổi bật, cho cái nhìn ấn tượng với những đường nét sắc sảo được chạm khắc trên khung vợt.', 4500000.00, 'products/pxwwiIGjy8PABKlwJTHdEqLstOfFszLjMBv0w0C3.jpg', 2, '2025-09-18 06:14:53', '2025-09-18 06:14:53', 8),
(15, 'Vợt cầu lông Lining Axforce Cannon Pro', 'Vợt Cầu Lông Lining Axforce Cannon Pro được thiết kế với nước sơn bóng đỏ tạo nên một tổng thể nổi bật và hiện đại. Cannon Pro có điểm cân bằng 296mm và thân đũa cứng ở mức trung bình nên vợt được dành cho lối chơi công thủ toàn diện, linh hoạt, hơi thiên công với những pha tấn công có thêm uy lực.', 2100000.00, 'products/VWcLACosUV7NJcO3A2OqL08iizSQCN3DFD6UTAFD.jpg', 2, '2025-09-18 06:15:42', '2025-09-18 06:15:42', 7),
(16, 'Set vợt cầu lông Lining Halbertec 9000 Limited Olympic Paris 2024 chính hãng', 'Set vợt cầu lông Lining Halbertec 9000 Limited Olympic Paris 2024 chính hãng là phiên bản giới hạn được thiết kế đặc biệt dành riêng cho chủ đề thế vận hội Olympic Paris 2024, set vợt bao gồm 1 cây vợt cầu lông Halbertec 9000 Limited, 1 ống cầu Lining và 1 bộ quấn cán đầy đủ cho các lông thủ.', 12300000.00, 'products/8Zq0WA5vcu6Iz167XZQNJuUMFVwVkTUAhDqSsmC7.jpg', 2, '2025-09-18 06:17:00', '2025-09-18 06:17:00', 5),
(17, 'Vợt Lining Bladex 900 Pink New 2024 – Nội địa Trung', 'Lining Bladex 900 Pink New 2024 là một trong những siêu phẩm mới nhất của thương hiệu Lining, được thiết kế đặc biệt dành cho những tay vợt có lối đánh tấn công mạnh mẽ, thích những pha đập cầu uy lực. Với thiết kế hiện đại và tích hợp nhiều công nghệ tiên tiến, cây vợt này hứa hẹn sẽ mang đến những trải nghiệm chơi cầu lông đỉnh cao.', 4450000.00, 'products/qRwtGseFPYbuJAppuD1W2tTUajJZJdzVXtt8vHso.jpg', 2, '2025-09-18 06:18:03', '2025-09-18 06:18:03', 11),
(18, 'Vợt cầu lông Lining Axforce 40 – Nội địa Trung', 'Vợt cầu lông Lining Axforce 40 – Nội địa Trung là một trong những sản phẩm mới nhất của thương hiệu Lining, nổi tiếng với sự chất lượng và thiết kế hiện đại. Vợt được chế tạo với các công nghệ tiên tiến nhằm mang lại hiệu suất tốt nhất cho người chơi. Dưới đây là những thông số kỹ thuật chi tiết và những điểm nổi bật của vợt cầu lông Lining Axforce 40.', 1850000.00, 'products/UIlgbaPotWxGhy9UBwCPnDZySu8Pc6wRlxzE8C3V.jpg', 2, '2025-09-18 06:19:31', '2025-09-18 06:19:31', 9);

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `discount_percentage` decimal(5,2) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `product_id`, `discount_percentage`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(5, 7, 50.00, '2025-09-08 09:39:00', '2025-09-30 09:39:00', '2025-09-08 02:39:44', '2025-09-08 02:39:44');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `parent_id`, `user_id`, `product_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 1, 5, 'đẹp ok', '2025-08-29 03:15:11', '2025-08-29 03:43:08'),
(2, NULL, 1, 1, 5, 'hay', '2025-08-29 03:23:34', '2025-08-29 03:23:34'),
(5, NULL, 1, 8, 5, 'Set quá là đẹp luôn shop ơi', '2025-09-15 08:27:50', '2025-09-15 08:27:50');

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1EnbFDbG1veouyxzh6Wh9PiLAesLPNyKobyH8ho2', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS2c4cThDSXVSU1N3b2dHYnpaZXVoZWlORmVvUjlBd2kwTEI0V2lUNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC8/cGFnZT0yIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1758176544);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
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
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Admin', 'admin@example.com', NULL, '$2y$12$NQk2pferwryr12NW2ZCwROuwW.GKKmJd3TrRT2X58dyEvvz3dA5O2', 'yPIrS2Ledob7WvnFsPdzOPOBSgCTc8UCNI0RRGwupelpzR85UPOp2NvUxWhs', '2025-08-09 03:00:31', '2025-08-09 03:00:31', 'admin'),
(2, 'Minh', 'tqmminh2004tqm@gmail.com', NULL, '$2y$12$G1CJ9wJn2uFFcbEznDZXRe684yTbOFFAEvxZEe7VVytmLbAN5oIwS', NULL, '2025-08-10 18:51:48', '2025-08-10 18:51:48', 'user'),
(3, 'Minh', 'mm@gmail.com', NULL, '$2y$12$jbjJJbY1rrL5DhbOOyD3jOhhpAzp8FSBiA4Tsc.ZrpJHQkdTR3Zmy', NULL, '2025-08-22 04:16:28', '2025-08-22 04:16:28', 'user'),
(4, 'Minh', 'mmm@gmail.com', NULL, '$2y$12$aIw7538JttC026hi0NSk1.yH3nh3/pd.qEvasa1HlqVRPGK1TIRGS', NULL, '2025-08-22 04:32:43', '2025-08-22 04:32:43', 'user'),
(5, 'minh', 'gg@gmail.com', NULL, '$2y$12$rtsoOusqB9/BjjguQvyU2OegDA9wIFVZ6UW3Wrko.wVvqydCQI/.G', NULL, '2025-08-22 04:33:32', '2025-08-22 04:33:32', 'user'),
(6, 'gg', 'tqm@gmail.com', NULL, '$2y$12$nyhjcW9lbCzj1jb5g5Hycu/jB6Xth/B1oq9bZTqFwpxNsAXvU4D0e', NULL, '2025-08-22 04:38:16', '2025-08-22 04:38:16', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_size_product_id_foreign` (`product_id`),
  ADD KEY `product_size_size_id_foreign` (`size_id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promotions_product_id_foreign` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `product_size_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_size_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `promotions`
--
ALTER TABLE `promotions`
  ADD CONSTRAINT `promotions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
