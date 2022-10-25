-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2022 at 01:51 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_nti`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `street` smallint(4) NOT NULL,
  `building` smallint(4) NOT NULL,
  `floor` tinyint(2) NOT NULL,
  `flat` tinyint(2) NOT NULL,
  `notes` varchar(512) NOT NULL,
  `type` enum('HOME','BUSINESS','SHIPPING') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `street`, `building`, `floor`, `flat`, `notes`, `type`, `created_at`, `updated_at`, `user_id`, `region_id`) VALUES
(1, 14, 11, 2, 6, 'home address', 'HOME', '2022-10-22 08:22:06', NULL, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `remember_token` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'youssef', 'youssef@gmail.com', '$2y$10$3I8jhTysHI97VXZhcFdqfOGJgZbIgCF7wWle6.AhrP6iOdqRK.mwi', '2022-10-25 22:35:09', NULL, '2022-10-25 22:35:03', '2022-10-25 22:35:09');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(64) NOT NULL,
  `name_ar` varchar(64) NOT NULL,
  `image` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 => active,\r\n0 => not active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name_en`, `name_ar`, `image`, `status`, `created_at`, `updated_at`) VALUES
(6, 'apple', 'jkn', 'apple.png', 1, '2022-10-22 00:02:34', '2022-10-22 00:20:35'),
(7, 'samsung', 'jkn', 'sam.png', 1, '2022-10-22 00:02:41', '2022-10-22 00:58:10'),
(8, 'lenovo', 'jkn', 'lenovo.png', 1, '2022-10-22 00:02:58', '2022-10-22 00:20:40'),
(9, 'lg', 'jkn', 'lg.png', 1, '2022-10-22 00:03:10', '2022-10-22 00:20:45'),
(10, 'no brand', 'بلا براند', 'test.jpg', 1, '2022-10-24 23:58:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` smallint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(64) NOT NULL,
  `name_ar` varchar(64) NOT NULL,
  `image` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 => ative\r\n0=>not active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name_en`, `name_ar`, `image`, `status`, `created_at`, `updated_at`) VALUES
(5, 'elecronics', 'kjnjk', 'jnkn', 1, '2022-10-21 23:57:12', NULL),
(6, 'fashion', 'kjnjk', 'jnkn', 1, '2022-10-21 23:57:22', NULL),
(7, 'subermarket', 'kjnjk', 'jnkn', 1, '2022-10-21 23:57:36', NULL),
(8, 'Crafts\r\n                                                        ', 'kjnjk', 'jnkn', 1, '2022-10-22 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(64) NOT NULL,
  `name_ar` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 => active,\r\n0 => not active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name_en`, `name_ar`, `status`, `created_at`, `updated_at`) VALUES
(1, 'giza', 'giza', 1, '2022-10-22 08:21:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `max_usage_count` smallint(4) NOT NULL,
  `max_usage_count_peruser` tinyint(2) NOT NULL COMMENT 'max usage will not exceed 100 times',
  `mini_order_price` decimal(8,0) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 => active,\r\n0 => not active',
  `discount` int(6) NOT NULL,
  `discount_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '	1 => percentage discount 0 => fixed discount',
  `start_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `max_usage_count`, `max_usage_count_peruser`, `mini_order_price`, `status`, `discount`, `discount_type`, `start_at`, `end_at`, `created_at`, `updated_at`) VALUES
(1, 20, 3, '1000', 1, 15, 1, '2022-10-22 08:23:10', NULL, '2022-10-22 08:23:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `favs`
--

CREATE TABLE `favs` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_en` varchar(64) NOT NULL,
  `title_ar` varchar(64) NOT NULL,
  `image` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 => ative,\r\n0 => not active',
  `discount` int(6) NOT NULL,
  `discount_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 => percentage discount\r\n0 => fixed discount',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `title_en`, `title_ar`, `image`, `status`, `discount`, `discount_type`, `created_at`, `updated_at`) VALUES
(1, 'big sale', 'hhiuh', 'nkj.jpg', 1, 20, 1, '2022-10-22 08:22:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number` int(10) UNSIGNED NOT NULL,
  `notes` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 => deliverd,\r\n0 => not delivered',
  `total_price` decimal(8,0) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `delivered_at` varchar(512) NOT NULL,
  `address_id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `number`, `notes`, `status`, `total_price`, `created_at`, `updated_at`, `delivered_at`, `address_id`, `offer_id`, `coupon_id`) VALUES
(1, 20211090, 'order 1', 1, '2000', '2022-10-22 10:23:37', '2022-10-22 08:25:42', 'yguyguyguygug', 1, 1, 1),
(2, 202211091, 'order 2', 1, '2500', '2022-10-22 10:24:19', '2022-10-22 08:25:48', 'yuguguy', 1, 1, 1),
(3, 202211092, 'order 3', 1, '2700', '2022-10-22 10:24:38', '2022-10-22 08:25:52', 'yuguguy', 1, 1, 1),
(4, 202211093, 'order 4', 1, '2900', '2022-10-22 10:24:56', '2022-10-22 08:25:55', 'yuguguy', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ordes_products`
--

CREATE TABLE `ordes_products` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `quantity` smallint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordes_products`
--

INSERT INTO `ordes_products` (`product_id`, `order_id`, `price`, `quantity`) VALUES
(14, 3, '2000.00', 1),
(14, 4, '4000.00', 1),
(14, 1, '4500.00', 1),
(14, 1, '12000.00', 1),
(14, 4, '12000.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(512) NOT NULL,
  `name_ar` varchar(512) NOT NULL,
  `image` varchar(64) NOT NULL,
  `price` decimal(8,0) NOT NULL,
  `details_en` text NOT NULL,
  `details_ar` text NOT NULL,
  `quantity` smallint(4) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 => active,\r\n0 => not active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name_en`, `name_ar`, `image`, `price`, `details_en`, `details_ar`, `quantity`, `status`, `created_at`, `updated_at`, `brand_id`, `subcategory_id`) VALUES
(14, 'samsung s 22', 'سامسونج اس 22', 's22.jpg', '10000', '8K SUPER STEADY VIDEO: Shoot videos that rival how epic your life is with stunning 8K recording, the highest recording resolution available on a smartphone; Video captured is effortlessly smooth, thanks to Auto Focus Video Stabilization on Galaxy S22\r\nNIGHTOGRAPHY plus PORTAIT MODE: Capture the night with crystal clear, bright pics and videos, no matter the lighting with Night Mode; Portrait Mode auto-detects and adjusts to what you want front and center, making all your photos worthy of a frame\r\n50MP PHOTO RESOLUTION plus BRIGHT DISPLAY: From elaborate landscapes to intricate creations, capture vivid detail with 50MP resolution; Your favorite content will look even more epic on our brightest display ever with Vision Booster\r\nADAPTIVE COLOR CONTRAST: Streaming on the go, working from your patio or binge-watching late into the night. The Galaxy S22 adaptive screen automatically optimizes color and brightness, outdoors and indoors\r\nLONG LASTING BATTERY plus FAST CHARGING: Power every scroll, click, tap and stream all day long with an intelligent battery that works with you, not against you; Dive back into action at a moment’s notice with 25W Super-Fast Charging\r\nPREMIUM DESIGN & CRAFTMANSHIP: With a classy, eye-catching glass-metal-glass design, we’re setting a standard for smart phones; With our strongest aluminum frame and the latest Gorilla Glass, this phone is lightweight and durable to help endure scratches and dings\r\nLIVE SHARING w/ GOOGLE DUO: Watch viral YouTube videos and content together with your friends, from anywhere', 'kjn', 4, 1, '2022-10-22 00:03:59', '2022-10-25 17:34:39', 7, 6),
(39, 'iphone 14', 'ايفون 14', 'bjraDbI8JgjPVSoRCL0oxrlm99u331u7PphRdAiE.jpg', '20000', 'Fully unlocked and compatible with any carrier of choice (e.g. AT&T, T-Mobile, Sprint, Verizon, US-Cellular, Cricket, Metro, etc.).\r\nThe device does not come with headphones or a SIM card. It does include a charger and charging cable that may be generic.\r\nInspected and guaranteed to have minimal cosmetic damage, which is not noticeable when the device is held at arm\'s length.\r\nSuccessfully passed a full diagnostic test which ensures like-new functionality and removal of any prior-user personal information.\r\nTested for battery health and guaranteed to have a minimum battery capacity of 80%.', 'العلامة التجارية	Apple\r\nاسم الطراز	iPhone 12 Pro Max\r\nالناقل اللاسلكي	مفتوحة\r\nأنظمة التشغيل	IOS\r\nالتكنولوجيا الخلوية	2G\r\nسعة تخزين الذاكرة	128 غيغابايت\r\nتقنية الاتصال	Bluetooth\r\nاللون	ذهبي\r\nحجم الشاشة	6.7 بوصة\r\nتكنولوجيا الشبكة اللاسلكية	GSM, CDMA', 3, 1, '2022-10-25 18:16:47', '2022-10-25 18:16:47', 6, 6);

-- --------------------------------------------------------

--
-- Stand-in structure for view `product_details`
-- (See below for the actual view)
--
CREATE TABLE `product_details` (
`id` bigint(20) unsigned
,`name_en` varchar(512)
,`name_ar` varchar(512)
,`image` varchar(64)
,`price` decimal(8,0)
,`details_en` text
,`details_ar` text
,`quantity` smallint(4)
,`status` tinyint(1)
,`created_at` timestamp
,`updated_at` timestamp
,`brand_id` bigint(20) unsigned
,`subcategory_id` bigint(20) unsigned
,`subcategory_name_en` varchar(64)
,`brand_name_en` varchar(64)
,`category_id` bigint(20) unsigned
,`category_name_en` varchar(64)
);

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(64) NOT NULL,
  `name_ar` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 => active,\r\n0 => not active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `city_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name_en`, `name_ar`, `status`, `created_at`, `updated_at`, `city_id`) VALUES
(1, 'faisal', 'faisal', 1, '2022-10-22 08:21:32', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rate` tinyint(1) NOT NULL DEFAULT 0 CHECK (`rate` >= 0 and `rate` <= 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`product_id`, `user_id`, `rate`, `comment`, `created_at`, `updated_at`) VALUES
(14, 11, 5, 'very good product', '2022-10-22 07:42:05', NULL),
(14, 12, 4, 'vgv', '2022-10-25 12:11:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `specs`
--

CREATE TABLE `specs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(512) NOT NULL,
  `value` varchar(1024) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(64) NOT NULL,
  `name_ar` varchar(64) NOT NULL,
  `image` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 => active,\r\n0 => not active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name_en`, `name_ar`, `image`, `status`, `created_at`, `updated_at`, `category_id`) VALUES
(6, 'mobiles', 'klm', 'lkmlkm', 1, '2022-10-22 00:00:32', NULL, 5),
(7, 'laptops', 'klm', 'lkmlkm', 1, '2022-10-22 00:00:50', NULL, 5),
(8, 'computers', 'klm', 'lkmlkm', 1, '2022-10-22 00:01:01', NULL, 5),
(9, 'food', 'kjn', 'kjn', 1, '2022-10-22 00:01:16', NULL, 7),
(10, 'drinks', 'jkn', 'jkn', 1, '2022-10-22 00:01:28', NULL, 7),
(11, 'kithen', 'jkn', 'kjn', 1, '2022-10-22 00:01:39', NULL, 7),
(12, 'jackets', 'kjn', 'jkn', 1, '2022-10-22 00:01:53', NULL, 6),
(13, 'shoes', 'jkn', 'kjn', 1, '2022-10-22 00:02:08', NULL, 6),
(14, 'test', 'hb', 'hjb', 1, '2022-10-22 00:02:17', NULL, 8);

-- --------------------------------------------------------

--
-- Stand-in structure for view `top_sales`
-- (See below for the actual view)
--
CREATE TABLE `top_sales` (
`id` bigint(20) unsigned
,`name_en` varchar(512)
,`image` varchar(64)
,`price` decimal(8,0)
,`details_en` text
,`avilable in stock` smallint(4)
,`num_of_orders` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(128) NOT NULL,
  `gender` enum('m','f','','') NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 => active,\r\n0 => blocked',
  `image` varchar(32) NOT NULL DEFAULT 'default.jpg',
  `verifiction_code` int(10) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone`, `email`, `password`, `gender`, `status`, `image`, `verifiction_code`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(11, 'youssef', 'kamel', '1148474762', 'youssef@gmail.com', '$2y$10$/venRlgJCA4wm5tif.wQEeR56gMramUtR4vD3EGjb/IHYpJXawKZy', 'm', 1, '63539e57eca84.jpeg', 17993, '2022-10-22 07:40:08', '2022-10-22 07:34:04', '2022-10-22 07:40:08'),
(12, 'seif', 'kamel', '1112898930', 'seif@gmail.com', '$2y$10$4NZs4ua7yfkyDWrvYbio1uqM9EPuiWG3ZHne8lvUopJKOQMTMSZxK', 'm', 1, 'default.jpg', 57272, '2022-10-23 06:54:55', '2022-10-23 06:54:35', '2022-10-23 06:54:55'),
(18, 'test', 'tet', '1123456789', 'youssefk.business@gmail.com', '$2y$10$rUGwGIwBaCgpymGP/Jp3ceyysPBSUQ2JJ9tSW3/iAkqHTq6nAiyfi', 'm', 1, 'default.jpg', 60313, NULL, '2022-10-23 07:20:03', NULL);

-- --------------------------------------------------------

--
-- Structure for view `product_details`
--
DROP TABLE IF EXISTS `product_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_details`  AS   (select `products`.`id` AS `id`,`products`.`name_en` AS `name_en`,`products`.`name_ar` AS `name_ar`,`products`.`image` AS `image`,`products`.`price` AS `price`,`products`.`details_en` AS `details_en`,`products`.`details_ar` AS `details_ar`,`products`.`quantity` AS `quantity`,`products`.`status` AS `status`,`products`.`created_at` AS `created_at`,`products`.`updated_at` AS `updated_at`,`products`.`brand_id` AS `brand_id`,`products`.`subcategory_id` AS `subcategory_id`,`subcategories`.`name_en` AS `subcategory_name_en`,`brands`.`name_en` AS `brand_name_en`,`categories`.`id` AS `category_id`,`categories`.`name_en` AS `category_name_en` from (((`products` left join `brands` on(`brands`.`id` = `products`.`brand_id`)) left join `subcategories` on(`subcategories`.`id` = `products`.`subcategory_id`)) left join `categories` on(`categories`.`id` = `subcategories`.`category_id`)) where 1)  ;

-- --------------------------------------------------------

--
-- Structure for view `top_sales`
--
DROP TABLE IF EXISTS `top_sales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `top_sales`  AS SELECT `products`.`id` AS `id`, `products`.`name_en` AS `name_en`, `products`.`image` AS `image`, `products`.`price` AS `price`, `products`.`details_en` AS `details_en`, `products`.`quantity` AS `avilable in stock`, count(`ordes_products`.`product_id`) AS `num_of_orders` FROM (`ordes_products` join `products` on(`products`.`id` = `ordes_products`.`product_id`)) GROUP BY `ordes_products`.`product_id` ORDER BY count(`ordes_products`.`product_id`) DESC LIMIT 0, 44  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `verification_code` (`remember_token`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`product_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favs`
--
ALTER TABLE `favs`
  ADD PRIMARY KEY (`product_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `coupon_id` (`coupon_id`),
  ADD KEY `offer_id` (`offer_id`);

--
-- Indexes for table `ordes_products`
--
ALTER TABLE `ordes_products`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`product_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `specs`
--
ALTER TABLE `specs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `specs`
--
ALTER TABLE `specs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `addresses_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favs`
--
ALTER TABLE `favs`
  ADD CONSTRAINT `favs_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ordes_products`
--
ALTER TABLE `ordes_products`
  ADD CONSTRAINT `ordes_products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordes_products_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `regions_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `specs`
--
ALTER TABLE `specs`
  ADD CONSTRAINT `specs_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
