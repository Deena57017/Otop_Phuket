-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2019 at 03:00 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `otop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'อาหาร', '2019-01-27 09:11:13', '2019-01-27 02:11:13'),
(2, 'เครื่องดื่ม', '2019-01-27 09:22:10', '2019-01-27 02:22:10'),
(3, 'เครื่องแต่งกาย', '2019-01-21 07:21:15', '2019-01-21 07:21:15');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ภูเก็ต',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`district_id`, `district_name`, `province`, `created_at`, `updated_at`) VALUES
(1, 'ถลาง', 'ภูเก็ต', '2019-01-23 07:26:57', '2019-01-23 07:26:57'),
(2, 'เมือง', 'ภูเก็ต', '2019-01-23 07:37:44', '2019-01-23 07:37:44'),
(3, 'กะทู้', 'ภูเก็ต', '2019-01-23 07:37:58', '2019-01-23 07:37:58');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `total_price` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `total_price`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2019-01-20', 500, 1, '2019-01-20 02:05:00', '2019-01-20 02:05:00'),
(2, '2019-01-20', 500, 1, '2019-01-20 02:11:49', '2019-01-20 02:11:49'),
(3, '2019-01-20', 500, 1, '2019-01-20 02:25:36', '2019-01-20 02:25:36'),
(4, '2019-01-20', 500, 1, '2019-01-20 02:31:35', '2019-01-20 02:31:35'),
(5, '2019-01-20', 500, 1, '2019-01-20 02:32:38', '2019-01-20 02:32:38'),
(6, '2019-01-20', 500, 1, '2019-01-20 02:32:46', '2019-01-20 02:32:46'),
(7, '2019-01-20', 500, 1, '2019-01-20 02:33:34', '2019-01-20 02:33:34'),
(8, '2019-01-20', 500, 1, '2019-01-20 02:34:13', '2019-01-20 02:34:13'),
(9, '2019-01-20', 500, 1, '2019-01-20 02:34:32', '2019-01-20 02:34:32');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_detail_id`, `order_id`, `product_id`, `product_quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, '2019-01-20 02:05:00', '2019-01-20 02:05:00'),
(2, 1, 2, 4, '2019-01-20 02:05:00', '2019-01-20 02:05:00'),
(3, 2, 1, 3, '2019-01-20 02:11:49', '2019-01-20 02:11:49'),
(4, 2, 2, 4, '2019-01-20 02:11:49', '2019-01-20 02:11:49'),
(5, 3, 1, 3, '2019-01-20 02:25:36', '2019-01-20 02:25:36'),
(6, 3, 2, 4, '2019-01-20 02:25:36', '2019-01-20 02:25:36'),
(7, 4, 1, 3, '2019-01-20 02:31:35', '2019-01-20 02:31:35'),
(8, 4, 2, 4, '2019-01-20 02:31:35', '2019-01-20 02:31:35'),
(9, 5, 1, 3, '2019-01-20 02:32:38', '2019-01-20 02:32:38'),
(10, 5, 2, 4, '2019-01-20 02:32:38', '2019-01-20 02:32:38'),
(11, 6, 1, 3, '2019-01-20 02:32:46', '2019-01-20 02:32:46'),
(12, 6, 2, 4, '2019-01-20 02:32:46', '2019-01-20 02:32:46'),
(13, 7, 1, 3, '2019-01-20 02:33:34', '2019-01-20 02:33:34'),
(14, 7, 2, 4, '2019-01-20 02:33:34', '2019-01-20 02:33:34'),
(15, 8, 1, 3, '2019-01-20 02:34:13', '2019-01-20 02:34:13'),
(16, 8, 2, 4, '2019-01-20 02:34:13', '2019-01-20 02:34:13'),
(17, 9, 1, 3, '2019-01-20 02:34:32', '2019-01-20 02:34:32'),
(18, 9, 2, 4, '2019-01-20 02:34:32', '2019-01-20 02:34:32');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` double NOT NULL,
  `product_cost` double NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `subdistricts_id` int(11) NOT NULL,
  `product_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`subcategory_id`, `subcategory_name`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'อาหารแปรรูป', 1, '2019-01-27 11:28:01', '2019-01-27 04:28:01'),
(2, 'ชา กาแฟ', 2, '2019-01-27 11:28:21', '2019-01-27 04:28:21'),
(3, 'น้ำสมุนไพร', 2, '2019-01-27 11:28:14', '2019-01-27 04:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `sub_districts`
--

CREATE TABLE `sub_districts` (
  `subdistrict_id` int(11) NOT NULL,
  `subdistrict_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_districts`
--

INSERT INTO `sub_districts` (`subdistrict_id`, `subdistrict_name`, `district_id`, `created_at`, `updated_at`) VALUES
(1, 'กะทู้', 3, '2019-01-23 15:21:32', '2019-01-23 08:21:32'),
(2, 'กมลา', 3, '2019-01-23 08:00:26', '2019-01-23 08:00:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `email`, `tel`, `status`) VALUES
(1, 'deena', 'Dee-na2012@hotmail.com', 1234567890, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users_detail`
--

CREATE TABLE `users_detail` (
  `user_detail_id` int(11) NOT NULL,
  `user_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_distrrict` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- Indexes for table `sub_districts`
--
ALTER TABLE `sub_districts`
  ADD PRIMARY KEY (`subdistrict_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_detail`
--
ALTER TABLE `users_detail`
  ADD PRIMARY KEY (`user_detail_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_districts`
--
ALTER TABLE `sub_districts`
  MODIFY `subdistrict_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_detail`
--
ALTER TABLE `users_detail`
  MODIFY `user_detail_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
