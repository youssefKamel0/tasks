-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2022 at 11:06 AM
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
  `verification_code` int(7) UNSIGNED DEFAULT NULL,
  `creadted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(9, 'lg', 'jkn', 'lg.png', 1, '2022-10-22 00:03:10', '2022-10-22 00:20:45');

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
(13, 1, '2000.00', 1),
(13, 1, '3000.00', 1),
(13, 2, '5000.00', 2),
(14, 3, '2000.00', 1),
(15, 3, '5400.00', 1),
(14, 4, '4000.00', 1),
(14, 1, '4500.00', 1),
(16, 4, '10000.00', 1),
(13, 4, '12000.00', 1),
(13, 3, '50000.00', 3),
(13, 2, '12000.00', 1),
(16, 1, '6000.00', 1),
(16, 1, '6000.00', 1),
(16, 3, '6000.00', 1),
(16, 2, '6000.00', 1),
(22, 1, '400.00', 1),
(22, 2, '400.00', 1),
(22, 3, '400.00', 1),
(22, 4, '400.00', 1),
(19, 1, '300.00', 1),
(19, 2, '300.00', 1),
(19, 3, '300.00', 1),
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
(13, 'iphone 14', 'kjn', 'iphone14.jpg', '10000', '6.7\" Super Retina XDR display with ProMotion. 5G Superfast downloads, high?quality streaming\nCinematic mode in 1080p at 30 fps. Dolby Vision HDR video recording up to 4K at 60 fps. 6X Optical zoom range\nA15 Bionic chip. New 6-core CPU with 2 performance and 4 efficiency cores. New 5-core GPU. New 16-core Neural Engine\nUp to 28 hours video playback. Face ID. Ceramic Shield front. Surgical-grade stainless steel\nWater resistant to a depth of 6 meters for up to 30 minutes. Compatible with MagSafe accessories and wireless chargers', 'kjn', 3, 1, '2022-10-22 00:03:46', '2022-10-22 00:25:03', 6, 6),
(14, 'samsung s 22', 'kjn', 's22.jpg', '10000', '8K SUPER STEADY VIDEO: Shoot videos that rival how epic your life is with stunning 8K recording, the highest recording resolution available on a smartphone; Video captured is effortlessly smooth, thanks to Auto Focus Video Stabilization on Galaxy S22\nNIGHTOGRAPHY plus PORTAIT MODE: Capture the night with crystal clear, bright pics and videos, no matter the lighting with Night Mode; Portrait Mode auto-detects and adjusts to what you want front and center, making all your photos worthy of a frame\n50MP PHOTO RESOLUTION plus BRIGHT DISPLAY: From elaborate landscapes to intricate creations, capture vivid detail with 50MP resolution; Your favorite content will look even more epic on our brightest display ever with Vision Booster\nADAPTIVE COLOR CONTRAST: Streaming on the go, working from your patio or binge-watching late into the night. The Galaxy S22 adaptive screen automatically optimizes color and brightness, outdoors and indoors\nLONG LASTING BATTERY plus FAST CHARGING: Power every scroll, click, tap and stream all day long with an intelligent battery that works with you, not against you; Dive back into action at a moment’s notice with 25W Super-Fast Charging\nPREMIUM DESIGN & CRAFTMANSHIP: With a classy, eye-catching glass-metal-glass design, we’re setting a standard for smart phones; With our strongest aluminum frame and the latest Gorilla Glass, this phone is lightweight and durable to help endure scratches and dings\nLIVE SHARING w/ GOOGLE DUO: Watch viral YouTube videos and content together with your friends, from anywhere', 'kjn', 4, 1, '2022-10-22 00:03:59', '2022-10-22 07:41:38', 7, 6),
(15, 'lg 44inch', 'jknj', 'lg.jpg', '6000', 'Built-in DVD Player: 24 Inch High Definition TV Is Equipped With A Build In Side Loading CD/DVD Multimedia Disc Player.\nHome Entertainment: Dual Channel 3W Full Range Speakers, Good For Streaming With Roku, Netflix, Amazon Prime Video, Hulu. HDMI Connect With PS5, PS4, PS3, X-Box, PC Device Gaming\nUpdated Vision Display: LED HD Backlight TV Support 720P 480P 480i Signal With Max Resolution 1280x720\nMultiple Connection Options: Offers HDMI, USB, VGA, Digital TV Tuner Cable Connectivity, Full Functional Remote Control\nBuild-In V-Chip: Designed With A Child\'s Safety In Mind, V-Chip Allow Parents Block Contents Based On Program Ratings And Check Ratings of Unfamiliar Programs.16\" WQXGA (2560x1600) IPS 500nits Anti-glare, 165Hz, 100% sRGB, Dolby Vision, HDR 400, Free-Sync, G-Sync, DC dimmer, Windows 10 Home\nThis laptop has been professionally upgraded to 32GB DDR4 3200MHz, 1024GB PCIe SSD. Original Seal is opened for upgrade ONLY. We do provide a 1-year standard warranty on upgraded RAM/SSD.With Tikbot High Speed 6FT HDMI Cable Bundle.\n1x power connector,1x USB-C 3.2 Gen 2 (support data transfer, Power Delivery and DisplayPort 1.4),1x Ethernet (RJ-45),1x USB-C 3.2 Gen 2 (support data transfer and DisplayPort 1.4),1x headphone / microphone combo jack (3.5mm),1x HDMI 2.1,4x USB 3.2 Gen 1 (one Always On)\nHigh Definition (HD) Audio, Realtek ALC3306 codec, Stereo speakers, 2W x2, Nahimic Audio, 720p with E-camera Shutter, 11ax, 2x2 + BT5.1, 4-Zone RGB LED backlit. AC Adapter 300W', 'vvv', 1, 1, '2022-10-22 00:04:31', '2022-10-22 00:29:35', 9, 8),
(16, 'lenovo legion 5', 'jkn', 'legion5.jpg', '12500', 'AMD Ryzen 7 5800H (8C / 16T, 3.2 / 4.4GHz, 4MB L2 / 16MB L3). NVIDIA GeForce RTX 3060 6GB GDDR6, Boost Clock 1425 / 1702MHz, TGP 130W\n16\" WQXGA (2560x1600) IPS 500nits Anti-glare, 165Hz, 100% sRGB, Dolby Vision, HDR 400, Free-Sync, G-Sync, DC dimmer, Windows 10 Home\nThis laptop has been professionally upgraded to 32GB DDR4 3200MHz, 1024GB PCIe SSD. Original Seal is opened for upgrade ONLY. We do provide a 1-year standard warranty on upgraded RAM/SSD.With Tikbot High Speed 6FT HDMI Cable Bundle.\n1x power connector,1x USB-C 3.2 Gen 2 (support data transfer, Power Delivery and DisplayPort 1.4),1x Ethernet (RJ-45),1x USB-C 3.2 Gen 2 (support data transfer and DisplayPort 1.4),1x headphone / microphone combo jack (3.5mm),1x HDMI 2.1,4x USB 3.2 Gen 1 (one Always On)\nHigh Definition (HD) Audio, Realtek ALC3306 codec, Stereo speakers, 2W x2, Nahimic Audio, 720p with E-camera Shutter, 11ax, 2x2 + BT5.1, 4-Zone RGB LED backlit. AC Adapter 300W', 'jkn', 1, 1, '2022-10-22 00:04:54', '2022-10-22 00:29:29', 8, 7),
(17, 'jacket', 'jacket', 'jacket.jpg', '800', 'Fabric Type100% Polyester\r\nCare InstructionsMachine Wash\r\nOriginImported', 'Fabric Type100% Polyester\r\nCare InstructionsMachine Wash\r\nOriginImported', 1, 1, '2022-10-22 00:34:05', NULL, NULL, 12),
(18, 'meat', 'meat', 'meat.jpg', '4500', 'Strong Performance: Featuring an 1100W powerful motor, the meat grinder can reach a speed of 180r/min and grind approximately up to 661lbs of meat per hour. The steel gear-driven mechanism and air-cooled electric fan can create a vast grinding capability and provide a steady operation.\r\nDurable Material: Made of food-grade stainless steel, our electric sausage stuffer is waterproofing, solid, and durable. This excellent stainless steel material can stand a long time of use. Painting treatment of the surface creates a beautiful exterior appearance.\r\nComplete Accessories: Equipped with a large capacity meat tray, the commercial meat grinder provides an ideal place to put meat before grinding. A meat pusher and an enlarged throat are included for stuffing meat conveniently. Besides the 6 mm grinding plate mounted on the machine, we also offer you a grinding plate in 8 mm for coarse or fine grinding. You can use a sausage kit to make all kinds of delicious sausages, such as bratwurst or various sausages.\r\nMultifuction Meat Grinder: The electric meat mincer is equipped with many functions, like meat mincing and sausage filling. It can grind not only meat but also fish, chili, vegetables, etc. This machine is suitable for various situations, including domestic kitchens, hotel restaurants, and companies.\r\nConsiderate Details: Our beef grinder is easy to install with our accessories. Meanwhile, the removable head provides an easy operation, and it is effortless to clean after use. You can run the machine only with one button. A Circuit Breaker can ensure an orderly process and maintain our motor.', 'Strong Performance: Featuring an 1100W powerful motor, the meat grinder can reach a speed of 180r/min and grind approximately up to 661lbs of meat per hour. The steel gear-driven mechanism and air-cooled electric fan can create a vast grinding capability and provide a steady operation.\r\nDurable Material: Made of food-grade stainless steel, our electric sausage stuffer is waterproofing, solid, and durable. This excellent stainless steel material can stand a long time of use. Painting treatment of the surface creates a beautiful exterior appearance.\r\nComplete Accessories: Equipped with a large capacity meat tray, the commercial meat grinder provides an ideal place to put meat before grinding. A meat pusher and an enlarged throat are included for stuffing meat conveniently. Besides the 6 mm grinding plate mounted on the machine, we also offer you a grinding plate in 8 mm for coarse or fine grinding. You can use a sausage kit to make all kinds of delicious sausages, such as bratwurst or various sausages.\r\nMultifuction Meat Grinder: The electric meat mincer is equipped with many functions, like meat mincing and sausage filling. It can grind not only meat but also fish, chili, vegetables, etc. This machine is suitable for various situations, including domestic kitchens, hotel restaurants, and companies.\r\nConsiderate Details: Our beef grinder is easy to install with our accessories. Meanwhile, the removable head provides an easy operation, and it is effortless to clean after use. You can run the machine only with one button. A Circuit Breaker can ensure an orderly process and maintain our motor.', 6, 1, '2022-10-22 00:35:35', NULL, NULL, 9),
(19, 'drink', 'jnkjn', 'drinks.jpg', '600', 'Twelve 16-fluid ounce cans of Red Energy Drink\r\nZero sugar and just 10 calories per serving\r\nLightly carbonated, sugar free energy drink containing caffeine, B vitamins, ginseng, guarana and taurine\r\nContains 152 mg caffeine\r\nDo not consume more than one bottle per day\r\nDiscard any remaining portion within 72 hours (3 days) of opening\r\nNot recommended for pregnant or nursing women, children, or others sensitive to caffeine\r\nSatisfaction Guarantee: We\'re proud of our products. If you aren\'t satisfied, we\'ll refund you for any reason within a year of purchase. 1-877-485-0385', 'Twelve 16-fluid ounce cans of Red Energy Drink\r\nZero sugar and just 10 calories per serving\r\nLightly carbonated, sugar free energy drink containing caffeine, B vitamins, ginseng, guarana and taurine\r\nContains 152 mg caffeine\r\nDo not consume more than one bottle per day\r\nDiscard any remaining portion within 72 hours (3 days) of opening\r\nNot recommended for pregnant or nursing women, children, or others sensitive to caffeine\r\nSatisfaction Guarantee: We\'re proud of our products. If you aren\'t satisfied, we\'ll refund you for any reason within a year of purchase. 1-877-485-0385', 1, 1, '2022-10-22 00:36:43', NULL, NULL, 10),
(20, 'shoes', 'jkn', 'shoes.jpg', '9', 'Men\'s slip-on running-inspired sneakers\r\nRegular fit; Slip-on construction with laces\r\nTextile upper offers ultimate breathability\r\nCloudfoam midsole for step-in comfort and superior cushioning; Enjoy the comfort and performance of OrthoLite sockliner; Rubber outsole provides grip\r\nThis product is made with Primegreen, a series of high-performance recycled materials. 50% of upper is recycled content. No virgin polyester.', 'Men\'s slip-on running-inspired sneakers\r\nRegular fit; Slip-on construction with laces\r\nTextile upper offers ultimate breathability\r\nCloudfoam midsole for step-in comfort and superior cushioning; Enjoy the comfort and performance of OrthoLite sockliner; Rubber outsole provides grip\r\nThis product is made with Primegreen, a series of high-performance recycled materials. 50% of upper is recycled content. No virgin polyester.', 1, 1, '2022-10-22 00:38:26', NULL, NULL, 13),
(21, 'kitchen', 'jhb', 'kitchen.jpg', '450', 'Men\'s slip-on running-inspired sneakers\r\nRegular fit; Slip-on construction with laces\r\nTextile upper offers ultimate breathability\r\nCloudfoam midsole for step-in comfort and superior cushioning; Enjoy the comfort and performance of OrthoLite sockliner; Rubber outsole provides grip\r\nThis product is made with Primegreen, a series of high-performance recycled materials. 50% of upper is recycled content. No virgin polyester.', 'Men\'s slip-on running-inspired sneakers\r\nRegular fit; Slip-on construction with laces\r\nTextile upper offers ultimate breathability\r\nCloudfoam midsole for step-in comfort and superior cushioning; Enjoy the comfort and performance of OrthoLite sockliner; Rubber outsole provides grip\r\nThis product is made with Primegreen, a series of high-performance recycled materials. 50% of upper is recycled content. No virgin polyester.', 1, 1, '2022-10-22 00:38:52', NULL, NULL, 11),
(22, 'shirt', 'jn', 'shirt.jpg', '450', '*Alert: True to size : Please follow the size examples below*(EX: Size \"Large recommended\" - Size for 6\" 215 lbs.) (EX: Size \"Medium\" 5\'9\"165 lbs.)\r\n***CAUTION*** DO NOT TUMBLE DRY / MACHINE WASH COLD GENTLE CYCLE / IRON UP TO 230˚F / LINE DRYING IN THE SHADE\r\nCQR All Cotton Flannel Series designed for warmth and comfort.\r\n[Materials] Brushed 100% Cotton mixed with yarn has been pre-dyed for everlasting colors.\r\n**Pre-shrunk Cotton but can shrink slightly after wash\r\n[Traditional Pattern] Consisting of vertical and horizontal bands in two or more colors with variations in width.', '', 1, 1, '2022-10-22 01:01:03', NULL, NULL, 12);

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
(13, 11, 1, 'wtf it\'s pullshit', '2022-10-22 07:43:29', NULL),
(14, 11, 5, 'very good product', '2022-10-22 07:42:05', NULL);

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
(11, 'youssef', 'kamel', '1148474762', 'youssef@gmail.com', '$2y$10$/venRlgJCA4wm5tif.wQEeR56gMramUtR4vD3EGjb/IHYpJXawKZy', 'm', 1, '63539e57eca84.jpeg', 17993, '2022-10-22 07:40:08', '2022-10-22 07:34:04', '2022-10-22 07:40:08');

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
  ADD UNIQUE KEY `verification_code` (`verification_code`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`),
  ADD CONSTRAINT `addresses_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

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
