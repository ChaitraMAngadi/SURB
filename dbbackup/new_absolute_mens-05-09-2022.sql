-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 05, 2022 at 04:59 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.29-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_absolute_mens`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_variant`
--

CREATE TABLE `add_variant` (
  `id` bigint(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `attribute_type` int(11) NOT NULL,
  `attribute_values` text NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `updated_at` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_variant`
--

INSERT INTO `add_variant` (`id`, `product_id`, `attribute_type`, `attribute_values`, `created_at`, `updated_at`) VALUES
(70, 83, 18, '69,70,71', '1662383410', '');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `forgot_password` varchar(100) NOT NULL,
  `name` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `share_title` text NOT NULL,
  `playstore_vendorlink` text NOT NULL,
  `playstore_userlink` text NOT NULL,
  `playstore_dblink` text NOT NULL,
  `distance` varchar(20) NOT NULL,
  `order_amount` varchar(20) NOT NULL,
  `coins` varchar(20) NOT NULL,
  `coinperamount` varchar(20) NOT NULL,
  `registration_coins` varchar(20) NOT NULL,
  `first_order_coins` varchar(20) NOT NULL,
  `version_control` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `forgot_password`, `name`, `email`, `mobile`, `address`, `share_title`, `playstore_vendorlink`, `playstore_userlink`, `playstore_dblink`, `distance`, `order_amount`, `coins`, `coinperamount`, `registration_coins`, `first_order_coins`, `version_control`) VALUES
(1, 'admin', '25a41cec631264f04815eda23dc6edd9', 'vizag@123', 'admin', 'admin@absolutemens.com', '1234567890', 'Dwarakanagar ,complex', 'Please download SECTOR6 from the following link and use code \'PROMO 50\' to avail discount on your first purchase. Thank you.', 'https://play.google.com/store', 'https://play.google.com/store', 'https://play.google.com/store', '10', '100', '4', '5', '20', '40', '1');

-- --------------------------------------------------------

--
-- Table structure for table `admin_comissions`
--

CREATE TABLE `admin_comissions` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `cat_id` varchar(255) NOT NULL,
  `subcategory_ids` text NOT NULL,
  `admin_comission` varchar(100) NOT NULL,
  `gst` float NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` varchar(55) NOT NULL,
  `updated_at` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_comissions`
--

INSERT INTO `admin_comissions` (`id`, `shop_id`, `cat_id`, `subcategory_ids`, `admin_comission`, `gst`, `status`, `created_at`, `updated_at`) VALUES
(70, 324, '36', '179', '5', 12, 1, '1662382133', ''),
(69, 324, '35', '178', '5', 12, 1, '1662382118', ''),
(68, 324, '35', '177', '5', 12, 1, '1662382099', '');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint(20) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `area` varchar(150) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `state_id`, `city_id`, `area`, `pincode`, `vendor_id`, `status`) VALUES
(11, 5, 4, 'dwaraka nagar', '530016', 0, 1),
(12, 5, 4, 'rtc complex', '530016', 0, 1),
(13, 7, 3, 'punja gutta', '500006', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) NOT NULL,
  `category` int(11) NOT NULL,
  `subcategory` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `value` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attributes_title`
--

CREATE TABLE `attributes_title` (
  `id` bigint(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `updated_date` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attributes_title`
--

INSERT INTO `attributes_title` (`id`, `title`, `status`, `created_date`, `updated_date`) VALUES
(1, 'Size', 0, '1623747949', ''),
(2, 'Quantity', 0, '1623747970', ''),
(8, 'Cups', 0, '1633352767', ''),
(7, 'Colour', 0, '1633352739', ''),
(9, 'Packets', 0, '1633352804', ''),
(10, 'Plates', 0, '1633352824', ''),
(12, 'QUA', 0, '1634018788', ''),
(13, 'Volume', 0, '1656827162', ''),
(14, 'MG', 0, '1659024721', ''),
(15, 'kilo grams', 0, '1659526569', ''),
(16, 'Storage', 0, '1659874102', ''),
(18, 'quntity', 0, '1662383203', '');

-- --------------------------------------------------------

--
-- Table structure for table `attributes_values`
--

CREATE TABLE `attributes_values` (
  `id` bigint(20) NOT NULL,
  `attribute_titleid` int(11) NOT NULL COMMENT 'from attributes_title  table',
  `value` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attributes_values`
--

INSERT INTO `attributes_values` (`id`, `attribute_titleid`, `value`, `code`) VALUES
(72, 18, '2000ml', ''),
(71, 18, '250ml', ''),
(70, 18, '500ml', ''),
(69, 18, '1000ml', '');

-- --------------------------------------------------------

--
-- Table structure for table `attr_brands`
--

CREATE TABLE `attr_brands` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(155) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attr_brands`
--

INSERT INTO `attr_brands` (`id`, `brand_name`, `description`, `status`, `created_at`) VALUES
(31, 'local', '', 1, 1662380490);

-- --------------------------------------------------------

--
-- Table structure for table `attr_colors`
--

CREATE TABLE `attr_colors` (
  `id` int(11) NOT NULL,
  `color_name` varchar(55) NOT NULL,
  `color_code` varchar(22) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attr_sizes`
--

CREATE TABLE `attr_sizes` (
  `id` int(11) NOT NULL,
  `size` varchar(55) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bannerads`
--

CREATE TABLE `bannerads` (
  `id` bigint(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `web_image` text NOT NULL,
  `app_image` text NOT NULL,
  `shop_id` int(11) NOT NULL,
  `blocks` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) NOT NULL,
  `random_number` varchar(100) NOT NULL,
  `tag_id` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `web_image` text NOT NULL,
  `app_image` text,
  `location_id` int(11) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `flat_discount` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `random_number`, `tag_id`, `title`, `web_image`, `app_image`, `location_id`, `type`, `shop_id`, `product_id`, `position`, `priority`, `flat_discount`, `status`) VALUES
(26, '2022090515610', 'Select tags', '', '202209051805133349614_750x375.png', '', 0, '', NULL, 0, 1, 1, '10', '1'),
(27, '2022090567027', '44', '', '202209051824508319227_k.jpg', '', 0, '', NULL, 0, 1, 2, '20', '1');

-- --------------------------------------------------------

--
-- Table structure for table `become_a_vendor`
--

CREATE TABLE `become_a_vendor` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shopname` varchar(200) NOT NULL,
  `ownername` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `created_at` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bid_quotations`
--

CREATE TABLE `bid_quotations` (
  `id` bigint(20) NOT NULL,
  `bid_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `accept` varchar(10) NOT NULL,
  `created_at` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) NOT NULL,
  `session_id` varchar(20) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` varchar(11) NOT NULL,
  `quantity` varchar(11) NOT NULL,
  `unit_price` varchar(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1.Exchange,2.Refund',
  `cart_status` int(11) NOT NULL,
  `check_out` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `session_id`, `variant_id`, `vendor_id`, `user_id`, `price`, `quantity`, `unit_price`, `status`, `cart_status`, `check_out`) VALUES
(596, '35515308301918', 13422, 324, 404, '900', '2', '1800', 0, 0, 1),
(595, '76714082948546', 13424, 324, 405, '250', '2', '500', 0, 0, 1),
(594, '56954165299419', 13424, 324, 405, '250', '1', '250', 0, 0, 1),
(597, '15455822321420', 13422, 324, 405, '900', '1', '900', 0, 0, 1),
(592, '93679340316287', 13423, 324, 404, '400', '1', '400', 0, 0, 1),
(591, '78745608836060', 13423, 324, 404, '400', '3', '1200', 0, 0, 1),
(590, '61147205394842', 13424, 324, 404, '250', '10', '2500', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cash_coupons`
--

CREATE TABLE `cash_coupons` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `start_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `seo_url` text NOT NULL,
  `category_name` varchar(250) NOT NULL,
  `description` varchar(500) NOT NULL,
  `image` varchar(255) NOT NULL,
  `app_image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `created_at` varchar(11) NOT NULL,
  `updated_at` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `seo_url`, `category_name`, `description`, `image`, `app_image`, `status`, `priority`, `created_at`, `updated_at`) VALUES
(34, '34-food', 'food', 'its related  to restaurant food ', '', 'Category__20220905173525.jpg', 1, 1, '1662379525', ''),
(35, '35-face-wash', 'face wash', 'its used for daily no Ammonia   no pepper', '', 'Category__20220905175439.jpg', 1, 2, '1662380679', ''),
(36, '36-hair-oil', 'hair oil', 'it is used for hair growth', '', 'Category__20220905181650.jpg', 1, 2, '1662382011', '');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_name` varchar(100) NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `pincode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `city_name`, `created_at`, `pincode`) VALUES
(3, 7, 'hyderabad', '1662379015', 0),
(4, 5, 'vizag', '1662379035', 0),
(5, 5, 'guntur', '1662379050', 0),
(6, 5, 'ongole', '1662379065', 0),
(7, 5, 'kakinada', '1662379081', 0),
(8, 5, 'nellore', '1662379097', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(250) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` bigint(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `title`, `description`, `status`, `created_date`) VALUES
(1, 'Terms and Conditions', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 1, '1606373549'),
(2, 'Privacy and Policy', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 1, '1606373664'),
(4, 'About', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 1, '1606373664'),
(5, 'Help / Support', '<p>Email : contactus@sector6.in Phone : 987654321</p>', 1, '1606373664'),
(6, 'Refund Policy', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 1, '1606373664'),
(7, 'Delivery Partner', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 1, '1606373664'),
(8, 'Shipping Policy', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 1, '1606373664'),
(9, 'What We Do', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 1, '1606373664'),
(10, 'Talk To An Expert', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 1, '1606373664');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_codes`
--

CREATE TABLE `coupon_codes` (
  `id` bigint(20) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `coupon_code` varchar(200) NOT NULL,
  `percentage` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `maximum_amount` varchar(20) NOT NULL,
  `utilization` varchar(50) NOT NULL,
  `minimum_order_amount` float NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courier_orders`
--

CREATE TABLE `courier_orders` (
  `id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `order_resp_id` varchar(255) NOT NULL,
  `order_response` varchar(255) NOT NULL,
  `shipment_response` varchar(255) NOT NULL,
  `manifest_response` varchar(255) NOT NULL,
  `track` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `currency_name` varchar(55) NOT NULL,
  `currency_code` varchar(55) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(55) NOT NULL,
  `updated_at` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `id` bigint(20) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `deal_start` date NOT NULL,
  `deal_end` date NOT NULL,
  `status` int(11) NOT NULL,
  `web_image` text NOT NULL,
  `app_image` text NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `updated_at` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deliveryboy`
--

CREATE TABLE `deliveryboy` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `alternative_mobiles` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo` text NOT NULL,
  `vehicle_number` varchar(100) NOT NULL,
  `vehicle_type` varchar(100) NOT NULL,
  `driving_license_image` text NOT NULL,
  `driving_license_number` varchar(100) NOT NULL,
  `document` text NOT NULL,
  `aadhar_card` text NOT NULL,
  `aadhar_card_number` varchar(100) NOT NULL,
  `mobile_verified` varchar(10) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lang` varchar(100) NOT NULL,
  `token` text NOT NULL,
  `delivery_type` varchar(50) NOT NULL,
  `otp_status` int(11) NOT NULL,
  `otp` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deliveryboy_amount`
--

CREATE TABLE `deliveryboy_amount` (
  `id` bigint(20) NOT NULL,
  `amount` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `filtergroups`
--

CREATE TABLE `filtergroups` (
  `id` int(11) NOT NULL,
  `filter_group_name` varchar(155) NOT NULL,
  `group_values` varchar(500) NOT NULL,
  `cat_ids` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `filters`
--

CREATE TABLE `filters` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filters`
--

INSERT INTO `filters` (`id`, `title`) VALUES
(1, 'Formulation'),
(2, 'preferences');

-- --------------------------------------------------------

--
-- Table structure for table `filter_options`
--

CREATE TABLE `filter_options` (
  `id` int(11) NOT NULL,
  `filter_id` int(11) NOT NULL,
  `seo_url` varchar(255) NOT NULL,
  `options` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `guest_users`
--

CREATE TABLE `guest_users` (
  `id` bigint(20) NOT NULL,
  `location` text NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ipcheck`
--

CREATE TABLE `ipcheck` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `date1` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `language_name` varchar(255) NOT NULL,
  `languge_code` varchar(55) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(55) NOT NULL,
  `updated_at` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `link_variant`
--

CREATE TABLE `link_variant` (
  `id` bigint(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` varchar(20) NOT NULL,
  `saleprice` float NOT NULL,
  `stock` varchar(20) NOT NULL,
  `jsondata` text NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `updated_at` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `filter_jsondata` text NOT NULL,
  `attribute_ids` text NOT NULL,
  `attribute_values` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `link_variant`
--

INSERT INTO `link_variant` (`id`, `product_id`, `price`, `saleprice`, `stock`, `jsondata`, `created_at`, `updated_at`, `status`, `filter_jsondata`, `attribute_ids`, `attribute_values`) VALUES
(13424, 83, '300', 250, '97', '[{\"attribute_type\":\"18\",\"attribute_value\":\"71\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"18\\\",\\\"attribute_value\\\":\\\"71\\\"}]\"', '', ''),
(13422, 83, '1000', 900, '4', '[{\"attribute_type\":\"18\",\"attribute_value\":\"69\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"18\\\",\\\"attribute_value\\\":\\\"69\\\"}]\"', '', ''),
(13423, 83, '500', 400, '0', '[{\"attribute_type\":\"18\",\"attribute_value\":\"70\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"18\\\",\\\"attribute_value\\\":\\\"70\\\"}]\"', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `location_name` varchar(500) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(22) NOT NULL,
  `updated_at` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_attributes`
--

CREATE TABLE `manage_attributes` (
  `id` bigint(20) NOT NULL,
  `attribute_titleid` int(11) NOT NULL,
  `categories` text NOT NULL COMMENT 'from categories table',
  `status` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `updated_date` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manage_attributes`
--

INSERT INTO `manage_attributes` (`id`, `attribute_titleid`, `categories`, `status`, `created_date`, `updated_date`) VALUES
(202, 18, '36', 0, '1662383374', ''),
(201, 18, '35', 0, '1662383374', '');

-- --------------------------------------------------------

--
-- Table structure for table `most_viewed_products`
--

CREATE TABLE `most_viewed_products` (
  `id` bigint(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `link_variant_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `most_viewed_products`
--

INSERT INTO `most_viewed_products` (`id`, `product_id`, `user_id`, `link_variant_id`) VALUES
(2025, 83, 0, 0),
(2024, 83, 0, 0),
(2023, 83, 0, 0),
(2022, 83, 0, 0),
(2021, 83, 0, 0),
(2020, 83, 0, 0),
(2019, 83, 0, 0),
(2018, 83, 0, 0),
(2017, 83, 0, 0),
(2016, 83, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `online_orders`
--

CREATE TABLE `online_orders` (
  `id` bigint(20) NOT NULL,
  `session_id` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `delivery_timeslots` varchar(200) NOT NULL,
  `deliveryaddress_id` int(11) NOT NULL,
  `payment_option` varchar(100) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `order_status` varchar(100) NOT NULL,
  `delivery_boy` int(11) NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin_commission` varchar(20) NOT NULL,
  `vendor_commission` varchar(20) NOT NULL,
  `deliveryboy_commission` varchar(20) NOT NULL,
  `total_price` varchar(20) NOT NULL,
  `gst` varchar(20) NOT NULL,
  `sub_total` varchar(20) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `coupon_code` varchar(100) NOT NULL,
  `coupon_disount` varchar(11) NOT NULL,
  `razerpay_orderId` text NOT NULL,
  `wallet_amount` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `ques_id` int(11) NOT NULL,
  `option` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `ques_id`, `option`) VALUES
(96, 23, 'face glow'),
(97, 24, 'hair growth'),
(98, 24, 'hair strength');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL,
  `session_id` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `delivery_timeslots` varchar(200) NOT NULL,
  `deliveryaddress_id` int(11) NOT NULL,
  `payment_option` varchar(100) DEFAULT NULL,
  `payment_status` int(11) DEFAULT NULL,
  `transaction_time` varchar(255) DEFAULT NULL,
  `order_status` varchar(100) NOT NULL COMMENT '1.Pending,2.Proccessing,3.Assigned to delivery to pick up,4.Delivery Boy On the way,5.Delivered,6.Cancelled,7.Refund Completed',
  `delivery_boy` int(11) NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin_commission` varchar(20) NOT NULL,
  `vendor_commission` varchar(20) NOT NULL,
  `deliveryboy_commission` varchar(20) NOT NULL,
  `total_price` varchar(20) NOT NULL,
  `gst` varchar(20) NOT NULL,
  `sub_total` varchar(20) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `coupon_code` varchar(100) NOT NULL,
  `coupon_disount` varchar(11) NOT NULL,
  `pay_orderid` text,
  `pay_razerpay_id` text NOT NULL,
  `pay_transaction_id` text,
  `bonus_points` varchar(100) NOT NULL,
  `wallet_amount` float NOT NULL,
  `bid_id` int(11) NOT NULL,
  `accept_status` int(11) NOT NULL,
  `user_address` text NOT NULL,
  `tracking_id` varchar(100) NOT NULL,
  `tracking_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `session_id`, `user_id`, `vendor_id`, `delivery_timeslots`, `deliveryaddress_id`, `payment_option`, `payment_status`, `transaction_time`, `order_status`, `delivery_boy`, `created_at`, `created_date`, `admin_commission`, `vendor_commission`, `deliveryboy_commission`, `total_price`, `gst`, `sub_total`, `coupon_id`, `coupon_code`, `coupon_disount`, `pay_orderid`, `pay_razerpay_id`, `pay_transaction_id`, `bonus_points`, `wallet_amount`, `bid_id`, `accept_status`, `user_address`, `tracking_id`, `tracking_name`) VALUES
(229, '78745608836060', 404, 324, '', 47, 'COD', NULL, NULL, '2', 0, '1662384626', '2022-09-05 13:30:26', '0', '1200', '20', '1364', '144', '1200', 0, '0', '0', NULL, '', NULL, '', 0, 0, 0, 'Home: hema, andhra pradesh, vizag, 530016, dwaraka nagar, near library', '', ''),
(230, '93679340316287', 404, 324, '', 47, '', 0, NULL, '1', 0, '1662384711', '2022-09-05 13:31:52', '20', '380', '20', '468', '48', '400', 0, '0', '0', NULL, '', 'AM721323769', '', 0, 0, 0, 'Home: hema, andhra pradesh, vizag, 530016, dwaraka nagar, near library', '', ''),
(231, '93679340316287', 404, 324, '', 47, 'COD', NULL, NULL, '2', 0, '1662384760', '2022-09-05 13:32:41', '0', '400', '20', '468', '48', '400', 0, '0', '0', NULL, '', NULL, '', 0, 0, 0, 'Home: hema, andhra pradesh, vizag, 530016, dwaraka nagar, near library', '', ''),
(232, '35515308301918', 404, 324, '', 47, '', 0, NULL, '1', 0, '1662385066', '2022-09-05 13:37:47', '20', '380', '20', '468', '48', '400', 0, '0', '0', NULL, '', 'AM880576609', '', 0, 0, 0, 'Home: hema, andhra pradesh, vizag, 530016, dwaraka nagar, near library', '', ''),
(233, '35515308301918', 404, 324, '', 47, '', 0, NULL, '1', 0, '1662385241', '2022-09-05 13:40:41', '20', '380', '20', '468', '48', '400', 0, '0', '0', NULL, '', 'AM483960072', '', 0, 0, 0, 'Home: hema, andhra pradesh, vizag, 530016, dwaraka nagar, near library', '', ''),
(234, '56954165299419', 405, 324, '', 48, 'NET_BANKING', 1, '2022-09-05 19:11:54', '2', 0, '1662385290', '2022-09-05 13:42:13', '12.5', '237.5', '20', '300', '30', '250', 0, '0', '0', 'AM738628141', '', '885542403', '', 0, 0, 0, ': Chandan Kumar Nayak, andhra pradesh, vizag, 530016, Colourmoon Technology, Cmoon', '', ''),
(235, '76714082948546', 405, 324, '', 48, 'COD', NULL, NULL, '2', 0, '1662385391', '2022-09-05 13:43:12', '0', '500', '20', '580', '60', '500', 0, '0', '0', NULL, '', NULL, '', 0, 0, 0, ': Chandan Kumar Nayak, andhra pradesh, vizag, 530016, Colourmoon Technology, Cmoon', '', ''),
(236, '35515308301918', 404, 324, '', 47, '', 0, NULL, '1', 0, '1662385539', '2022-09-05 13:45:39', '45', '1755', '20', '2036', '216', '1800', 0, '0', '0', NULL, '', 'AM913070116', '', 0, 0, 0, 'Home: hema, andhra pradesh, vizag, 530016, dwaraka nagar, near library', '', ''),
(237, '15455822321420', 405, 324, '', 48, 'NET_BANKING', 1, '2022-09-05 19:19:09', '2', 0, '1662385731', '2022-09-05 13:49:44', '45', '855', '20', '1028', '108', '900', 0, '0', '0', 'AM846060352', '', '885542422', '', 0, 0, 0, ': Chandan Kumar Nayak, andhra pradesh, vizag, 530016, Colourmoon Technology, Cmoon', '', ''),
(228, '78745608836060', 404, 324, '', 47, 'COD', NULL, NULL, '2', 0, '1662384623', '2022-09-05 13:30:24', '0', '1200', '20', '1364', '144', '1200', 0, '0', '0', NULL, '', NULL, '', 0, 0, 0, 'Home: hema, andhra pradesh, vizag, 530016, dwaraka nagar, near library', '', ''),
(227, '61147205394842', 404, 324, '', 47, 'COD', NULL, NULL, '2', 0, '1662383719', '2022-09-05 13:15:21', '0', '2500', '20', '2820', '300', '2500', 0, '0', '0', NULL, '', NULL, '', 0, 0, 0, 'Home: hema, andhra pradesh, vizag, 530016, dwaraka nagar, near library', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_cancelled_invoice`
--

CREATE TABLE `order_cancelled_invoice` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `footer` text NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_cancelled_invoice`
--

INSERT INTO `order_cancelled_invoice` (`id`, `subject`, `title`, `message`, `footer`, `created_at`, `updated_at`) VALUES
(1, 'nm', 'n,m', 'nk', 'jj', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_delivered_invoice`
--

CREATE TABLE `order_delivered_invoice` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `footer` text NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_delivered_invoice`
--

INSERT INTO `order_delivered_invoice` (`id`, `subject`, `title`, `message`, `footer`, `created_at`, `updated_at`) VALUES
(1, 'Order Delivered', 'Order Delivered', '<p><strong><code><tt><big>Dear Customer,</big></tt></code></strong></p>\r\n\r\n<p><strong><span style=\"font-family:monospace\"><span style=\"font-size:15.6px\">Greetings,</span></span></strong></p>\r\n\r\n<p><strong>Your order delivered successfully.</strong></p>\r\n', '<p><strong>Thanks,</strong></p>\r\n\r\n<p><strong>Absolutemens team.</strong></p>\r\n\r\n<p><strong>----------------------------------------------------</strong></p>\r\n\r\n<p><strong>Note: It&#39;s a computer generated invoice.</strong></p>\r\n', '', '2022-08-04');

-- --------------------------------------------------------

--
-- Table structure for table `order_placed_invoice`
--

CREATE TABLE `order_placed_invoice` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `footer` text NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_placed_invoice`
--

INSERT INTO `order_placed_invoice` (`id`, `subject`, `title`, `message`, `footer`, `created_at`, `updated_at`) VALUES
(1, 'Order Placed', 'Order Invoice', '<p>Dear Customer,</p>\r\n\r\n<p>Greetings of the day.</p>\r\n', '<p>Thank You.</p>\r\n\r\n<p>Absolutemens Team,</p>\r\n\r\n<p>----------------------------------------------------</p>\r\n\r\n<p>[It&#39;s a computer generated invoice.]</p>\r\n', '', '2022-07-30');

-- --------------------------------------------------------

--
-- Table structure for table `order_refund_invoice`
--

CREATE TABLE `order_refund_invoice` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `footer` text NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_refund_invoice`
--

INSERT INTO `order_refund_invoice` (`id`, `subject`, `title`, `message`, `footer`, `created_at`, `updated_at`) VALUES
(1, 'Request For Return', 'Return Order', '<p><code><tt><big><strong>Dear Customer,</strong></big></tt></code></p>\r\n\r\n<p><strong>Find out the status for your return product request.</strong></p>\r\n', '<p><strong>Thanks,</strong></p>\r\n\r\n<p><strong>Absolutemens team.</strong></p>\r\n\r\n<p><strong>----------------------------------------------------</strong></p>\r\n\r\n<p><strong>Note: It&#39;s a computer generated invoice.</strong></p>\r\n', '', '2022-08-25');

-- --------------------------------------------------------

--
-- Table structure for table `order_shipped_invoice`
--

CREATE TABLE `order_shipped_invoice` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `footer` text NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_shipped_invoice`
--

INSERT INTO `order_shipped_invoice` (`id`, `subject`, `title`, `message`, `footer`, `created_at`, `updated_at`) VALUES
(1, 'Order Shipped', 'Order Shipped', '<p><code><tt><big><span style=\"font-family:Courier New,Courier,monospace\"><strong>Dear Customer,</strong></span></big></tt></code></p>\r\n\r\n<p><code><tt><big><span style=\"font-family:Courier New,Courier,monospace\"><strong>Your order <span style=\"color:#000000\"><span style=\"background-color:#f1c40f\">shipped</span> </span>for delivery.</strong></span></big></tt></code></p>\r\n\r\n<p><code><tt><big><span style=\"font-family:Courier New,Courier,monospace\"><strong>Please collect your order from our delivery boy.</strong></span></big></tt></code></p>\r\n', '<p><strong>Thanks,</strong></p>\r\n\r\n<p><strong>Absolutemens team.</strong></p>\r\n\r\n<p><strong>----------------------------------------------------</strong></p>\r\n\r\n<p><strong>Note: It&#39;s a computer generated invoice.</strong></p>\r\n', '', '2022-08-04');

-- --------------------------------------------------------

--
-- Table structure for table `pincodes`
--

CREATE TABLE `pincodes` (
  `id` int(11) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pincodes`
--

INSERT INTO `pincodes` (`id`, `pincode`, `city_id`, `state_id`, `status`) VALUES
(8, '523292', 5, 5, 1),
(7, '500006', 3, 5, 1),
(6, '530016', 4, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `seo_url` text NOT NULL,
  `name` varchar(500) NOT NULL,
  `descp` varchar(2500) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `ques_id` int(11) NOT NULL,
  `option_id` text NOT NULL,
  `brand` varchar(255) NOT NULL,
  `mrp` varchar(10) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `gst` float(10,2) NOT NULL,
  `tax_class` varchar(100) NOT NULL,
  `tax` varchar(100) NOT NULL,
  `taxname` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `manage_stock` varchar(11) NOT NULL,
  `variant_product` varchar(10) NOT NULL,
  `filters` text NOT NULL,
  `shop_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `updated_at` varchar(20) NOT NULL,
  `meta_tag_title` text NOT NULL,
  `meta_tag_description` text NOT NULL,
  `meta_tag_keywords` text NOT NULL,
  `product_tags` text NOT NULL,
  `admin_commission` varchar(30) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `key_features` text NOT NULL,
  `about` text NOT NULL,
  `how_to_use` text NOT NULL,
  `selling_date` varchar(100) NOT NULL,
  `cancel_status` varchar(10) NOT NULL,
  `return_status` varchar(10) NOT NULL,
  `return_noof_days` varchar(20) NOT NULL,
  `availabile_stock_status` varchar(10) NOT NULL,
  `top_deal` varchar(10) NOT NULL,
  `priority` int(11) NOT NULL,
  `package_weight` varchar(50) DEFAULT NULL,
  `package_length` varchar(50) DEFAULT NULL,
  `package_breadth` varchar(50) DEFAULT NULL,
  `package_height` varchar(50) DEFAULT NULL,
  `delete_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `seo_url`, `name`, `descp`, `cat_id`, `sub_cat_id`, `ques_id`, `option_id`, `brand`, `mrp`, `sku`, `gst`, `tax_class`, `tax`, `taxname`, `stock`, `manage_stock`, `variant_product`, `filters`, `shop_id`, `status`, `created_at`, `updated_at`, `meta_tag_title`, `meta_tag_description`, `meta_tag_keywords`, `product_tags`, `admin_commission`, `parent_id`, `key_features`, `about`, `how_to_use`, `selling_date`, `cancel_status`, `return_status`, `return_noof_days`, `availabile_stock_status`, `top_deal`, `priority`, `package_weight`, `package_length`, `package_breadth`, `package_height`, `delete_status`) VALUES
(83, '83_-amla-hair-oil', ' Amla hair oil', '<p>it is used for hair growth and dandrof control</p>\r\n', 36, 179, 24, '97,98', '31', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 324, 1, '', '', 'no', '<p>no</p>\r\n', 'no', '44', '', 0, '<p>1. good quality&nbsp;</p>\r\n\r\n<p>2. hair improvement</p>\r\n\r\n<p>3. hair groth</p>\r\n', '<p>it is pure naturals no ammonias</p>\r\n', '<p>daily morning and night use&nbsp; external use only</p>\r\n', '', 'yes', '', '2', 'available', 'yes', 1, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_filter`
--

CREATE TABLE `product_filter` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `filter_id` varchar(256) NOT NULL,
  `filter_options` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `image` varchar(350) NOT NULL,
  `created_at` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_prices`
--

CREATE TABLE `product_prices` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `mrp` int(11) NOT NULL,
  `sku` varchar(155) NOT NULL,
  `sale_price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `manage_stock` enum('Yes','No') NOT NULL,
  `admin_commission` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `promotion_notifications`
--

CREATE TABLE `promotion_notifications` (
  `id` bigint(11) NOT NULL,
  `select_user_type` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questionaries`
--

CREATE TABLE `questionaries` (
  `id` bigint(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `question` varchar(250) NOT NULL,
  `status` varchar(10) NOT NULL,
  `priority` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questionaries`
--

INSERT INTO `questionaries` (`id`, `cat_id`, `sub_cat_id`, `question`, `status`, `priority`) VALUES
(23, 35, 177, 'what do u expected', '1', '1'),
(24, 36, 179, 'what do u want', '1', '2');

-- --------------------------------------------------------

--
-- Table structure for table `refund_exchange`
--

CREATE TABLE `refund_exchange` (
  `id` bigint(20) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cartid` int(11) NOT NULL,
  `delivery_type` varchar(100) NOT NULL COMMENT '1.Exchange, 2.Refund',
  `status` int(11) NOT NULL COMMENT '1: Accept, 2: Reject',
  `message` text NOT NULL,
  `exchange_completed_date` varchar(255) NOT NULL,
  `refund_completed_date` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `request_payment`
--

CREATE TABLE `request_payment` (
  `id` bigint(20) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `request_amount` varchar(20) NOT NULL,
  `vendor_amount` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `admin_description` text NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `mode_payment` varchar(50) NOT NULL,
  `sender_name` varchar(150) NOT NULL,
  `receiver_name` varchar(150) NOT NULL,
  `image` text NOT NULL,
  `transaction_id` text NOT NULL,
  `updated_at` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shop_favorites`
--

CREATE TABLE `shop_favorites` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `createdat` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shop_visit`
--

CREATE TABLE `shop_visit` (
  `id` bigint(20) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shop_work_hours`
--

CREATE TABLE `shop_work_hours` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `week_name` varchar(55) NOT NULL,
  `is_working_day` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `open_time` varchar(55) NOT NULL,
  `close_time` varchar(55) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `favicon` varchar(100) NOT NULL,
  `seo_title` varchar(100) NOT NULL,
  `seo_keywords` text NOT NULL,
  `seo_description` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `alt_email` varchar(100) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `home_video` varchar(255) NOT NULL,
  `update_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `logo`, `favicon`, `seo_title`, `seo_keywords`, `seo_description`, `email`, `alt_email`, `facebook`, `instagram`, `twitter`, `youtube`, `home_video`, `update_at`) VALUES
(1, '202208041717377574218_logo.png', '202208041717379911923_favicon.png', 'Absolute mens', 'Absolute mens', 'Absolute mens', 'absolutemens@gmail.com', 'absolutemens@gmail.com', 'https://www.facebook.com/login/', 'https://www.instagram.com/accounts/login/', 'https://twitter.com/i/flow/login', 'https://www.youtube.com/', '6oXoU-T25k8', '');

-- --------------------------------------------------------

--
-- Table structure for table `sms_notifications`
--

CREATE TABLE `sms_notifications` (
  `id` bigint(20) NOT NULL,
  `order_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `view_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_notifications`
--

INSERT INTO `sms_notifications` (`id`, `order_id`, `sender_id`, `receiver_id`, `message`, `created_at`, `view_status`) VALUES
(2458, 237, 324, 405, 'Dear Chandan Kumar Nayak your order no.237 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1662385731', 0),
(2457, 237, 405, 324, 'Dear vendor new order no.237 is in your dashboard. Please accept it for confirmation.', '1662385731', 0),
(2456, 236, 324, 404, 'Dear   your order no.236 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1662385539', 0),
(2455, 236, 404, 324, 'Dear vendor new order no.236 is in your dashboard. Please accept it for confirmation.', '1662385539', 0),
(2454, 235, 324, 405, 'Dear Chandan Kumar Nayak your order no.235 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1662385392', 0),
(2453, 235, 405, 324, 'Dear vendor new order no.235 is in your dashboard. Please accept it for confirmation.', '1662385392', 0),
(2452, 234, 324, 405, 'Dear Chandan Kumar Nayak your order no.234 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1662385290', 0),
(2451, 234, 405, 324, 'Dear vendor new order no.234 is in your dashboard. Please accept it for confirmation.', '1662385290', 0),
(2450, 233, 324, 404, 'Dear   your order no.233 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1662385241', 0),
(2449, 233, 404, 324, 'Dear vendor new order no.233 is in your dashboard. Please accept it for confirmation.', '1662385241', 0),
(2448, 232, 324, 404, 'Dear   your order no.232 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1662385067', 0),
(2447, 232, 404, 324, 'Dear vendor new order no.232 is in your dashboard. Please accept it for confirmation.', '1662385067', 0),
(2446, 231, 324, 404, 'Dear   your order no.231 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1662384761', 0),
(2445, 231, 404, 324, 'Dear vendor new order no.231 is in your dashboard. Please accept it for confirmation.', '1662384761', 0),
(2444, 230, 324, 404, 'Dear   your order no.230 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1662384712', 0),
(2443, 230, 404, 324, 'Dear vendor new order no.230 is in your dashboard. Please accept it for confirmation.', '1662384712', 0),
(2442, 229, 324, 404, 'Dear   your order no.229 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1662384626', 0),
(2441, 229, 404, 324, 'Dear vendor new order no.229 is in your dashboard. Please accept it for confirmation.', '1662384626', 0),
(2440, 228, 324, 404, 'Dear   your order no.228 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1662384624', 0),
(2439, 228, 404, 324, 'Dear vendor new order no.228 is in your dashboard. Please accept it for confirmation.', '1662384624', 0),
(2438, 227, 324, 404, 'Dear   your order no.227 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1662383721', 0),
(2437, 227, 404, 324, 'Dear vendor new order no.227 is in your dashboard. Please accept it for confirmation.', '1662383721', 0);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `pincode` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `state_name`, `status`, `created_at`, `updated_at`, `pincode`) VALUES
(5, 1, 'andhra pradesh', 0, '1662378911', '', 0),
(7, 1, 'telangana', 0, '1662378942', '', 0),
(8, 1, 'orisa', 0, '1662378954', '', 0),
(9, 1, 'tamilanadu', 0, '1662378966', '', 0),
(10, 1, 'kolkata', 0, '1662378994', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock_management`
--

CREATE TABLE `stock_management` (
  `id` bigint(20) NOT NULL,
  `varient_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `paid_status` varchar(10) NOT NULL,
  `quantity` varchar(11) NOT NULL,
  `total_stock` varchar(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_management`
--

INSERT INTO `stock_management` (`id`, `varient_id`, `product_id`, `paid_status`, `quantity`, `total_stock`, `message`, `created_at`) VALUES
(2144, 13422, 83, 'Debit', '1', '4', 'New Order', '1662385731'),
(2143, 13422, 83, 'Debit', '2', '5', 'New Order', '1662385539'),
(2142, 13422, 83, 'Debit', '1', '7', 'New Order', '1662385460'),
(2141, 13422, 83, 'Debit', '1', '8', 'New Order', '1662385456'),
(2140, 13422, 83, 'Debit', '1', '9', 'New Order', '1662385427'),
(2139, 13424, 83, 'Debit', '2', '97', 'New Order', '1662385391'),
(2138, 13424, 83, 'Debit', '1', '99', 'New Order', '1662385290'),
(2137, 13423, 83, 'Debit', '1', '0', 'New Order', '1662385241'),
(2136, 13423, 83, 'Debit', '1', '1', 'New Order', '1662385066'),
(2135, 13424, 83, 'Credit', '100', '100', 'Stock Added', '1662385051'),
(2134, 13423, 83, 'Debit', '1', '2', 'New Order', '1662384760'),
(2133, 13423, 83, 'Debit', '1', '3', 'New Order', '1662384711'),
(2132, 13423, 83, 'Debit', '3', '4', 'New Order', '1662384626'),
(2131, 13423, 83, 'Debit', '3', '7', 'New Order', '1662384623'),
(2130, 13424, 83, 'Debit', '10', '0', 'New Order', '1662383719'),
(2129, 13423, 83, 'Credit', '10', '10', 'Stock Added', '1662383480'),
(2128, 13422, 83, 'Credit', '10', '10', 'Stock Added', '1662383465'),
(2127, 13424, 83, 'Credit', '10', '10', 'Stock Added', '1662383446');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `seo_url` text NOT NULL,
  `sub_category_name` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `app_image` varchar(255) DEFAULT NULL,
  `cat_id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(25) NOT NULL,
  `updated_at` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `seo_url`, `sub_category_name`, `description`, `image`, `app_image`, `cat_id`, `brand`, `status`, `created_at`, `updated_at`) VALUES
(177, 'liquid-235', 'liquid', NULL, NULL, 'no', 35, '31', 1, '1662381885', '1662381923'),
(178, 'powder-440', 'powder', NULL, NULL, 'no', 35, '31', 1, '1662381945', '1662381954'),
(179, 'hail-gel-535', 'hail gel', NULL, NULL, 'no', 36, '31', 1, '1662382029', '1662382037'),
(180, 'hair-cleaner-695', 'Hair Cleaner', NULL, NULL, 'no', 36, '31', 1, '1662382064', '1662384286');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `title`) VALUES
(44, 'Delivery Products'),
(43, 'Online Product');

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id` bigint(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `designation` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `created_at` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) NOT NULL,
  `sender_name` varchar(150) NOT NULL,
  `receiver_name` varchar(150) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `created_at` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `otp` varchar(11) NOT NULL,
  `otp_status` int(11) NOT NULL,
  `loginstatus` varchar(100) NOT NULL,
  `login_time` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wallet_amount` float NOT NULL,
  `bonus_points` varchar(20) NOT NULL,
  `referral_code` varchar(30) NOT NULL,
  `reffered_by` varchar(30) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lng` varchar(100) NOT NULL,
  `address_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `pincode_id` int(11) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `token` text NOT NULL,
  `home_location` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `image`, `phone`, `password`, `otp`, `otp_status`, `loginstatus`, `login_time`, `created_date`, `wallet_amount`, `bonus_points`, `referral_code`, `reffered_by`, `lat`, `lng`, `address_id`, `state_id`, `pincode_id`, `pincode`, `token`, `home_location`) VALUES
(405, 'Chandan Kumar', 'Nayak', '1998chandannayak@gmail.com', '', '7978554807', 'e10adc3949ba59abbe56e057f20f883e', '8103', 1, '', '1662385682', '2022-09-05 13:48:02', 0, '', '', '', '', '', 0, 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `locality` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `landmark` varchar(255) NOT NULL,
  `area` int(11) NOT NULL,
  `address_type` int(11) NOT NULL COMMENT '1.Home,2.Office,3.defaultaddress',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isdefault` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `name`, `mobile`, `address`, `locality`, `city`, `state`, `pincode`, `landmark`, `area`, `address_type`, `created_date`, `isdefault`) VALUES
(47, 404, 'hema', '8143601989', 'dwaraka nagar', '', '4', '5', '6', 'near library', 0, 1, '2022-09-05 13:15:01', 'no'),
(48, 405, 'Chandan Kumar Nayak', '7978554807', 'Colourmoon Technology', '', '4', '5', '6', 'Cmoon', 0, 2, '2022-09-05 13:39:38', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `user_bids`
--

CREATE TABLE `user_bids` (
  `id` bigint(20) NOT NULL,
  `session_id` text NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_total` float NOT NULL,
  `delivery_amount` float NOT NULL,
  `grand_total` float NOT NULL,
  `gst` float NOT NULL,
  `bid_status` int(11) NOT NULL COMMENT '0.Bid created,1.Bid accepted,2.Bid Completed,3.Bid Cancelled',
  `created_at` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_reviews`
--

CREATE TABLE `user_reviews` (
  `id` bigint(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `review` text NOT NULL,
  `comments` text NOT NULL,
  `createdat` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_transactions`
--

CREATE TABLE `user_transactions` (
  `id` bigint(20) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_name` varchar(20) NOT NULL,
  `amount` float NOT NULL,
  `message` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_id` text NOT NULL,
  `transaction_id` text NOT NULL,
  `razerpay` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_orders_values`
--

CREATE TABLE `vendor_orders_values` (
  `id` bigint(20) NOT NULL,
  `session_id` text NOT NULL,
  `gst` float NOT NULL,
  `sub_total` float NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `coupon_code` varchar(150) NOT NULL,
  `coupon_disount` float NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1.Accept,2.Cancel'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_payements`
--

CREATE TABLE `vendor_payements` (
  `id` bigint(20) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `total_payment` varchar(20) NOT NULL,
  `requested_amount` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_shop`
--

CREATE TABLE `vendor_shop` (
  `id` int(11) NOT NULL,
  `seo_url` text NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `shop_logo` varchar(255) NOT NULL,
  `logo` text NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `mobile_verified` enum('Yes','No') NOT NULL DEFAULT 'No',
  `password` varchar(55) NOT NULL,
  `forgot_password` varchar(100) NOT NULL,
  `email` varchar(55) NOT NULL,
  `description` text NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `alternative_mobile` varchar(20) DEFAULT NULL,
  `otp` varchar(11) DEFAULT NULL,
  `otp_status` int(11) DEFAULT NULL,
  `email_verified` enum('Yes','No') NOT NULL DEFAULT 'No',
  `address` varchar(255) NOT NULL,
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL DEFAULT 'Visakhapatnam',
  `location_id` int(11) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `lat` varchar(50) NOT NULL,
  `lng` varchar(50) NOT NULL,
  `vm_id` int(11) DEFAULT NULL,
  `min_order_amount` int(11) DEFAULT NULL,
  `delivery_time` varchar(100) DEFAULT NULL,
  `verification_status` enum('Pending','Approved') DEFAULT NULL,
  `status` int(11) NOT NULL,
  `pan` varchar(50) DEFAULT NULL,
  `aadhar` varchar(100) DEFAULT NULL,
  `gst_number` varchar(150) DEFAULT NULL,
  `bankname` varchar(100) DEFAULT NULL,
  `account_no` varchar(30) DEFAULT NULL,
  `accountholder_name` varchar(100) DEFAULT NULL,
  `token` text,
  `bank_ifsccode` varchar(100) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `refferalcode` varchar(255) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `delete_status` int(11) DEFAULT NULL,
  `vendor_pincodes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor_shop`
--

INSERT INTO `vendor_shop` (`id`, `seo_url`, `shop_name`, `shop_logo`, `logo`, `owner_name`, `mobile_verified`, `password`, `forgot_password`, `email`, `description`, `mobile`, `alternative_mobile`, `otp`, `otp_status`, `email_verified`, `address`, `city_id`, `state_id`, `city`, `location_id`, `pincode`, `lat`, `lng`, `vm_id`, `min_order_amount`, `delivery_time`, `verification_status`, `status`, `pan`, `aadhar`, `gst_number`, `bankname`, `account_no`, `accountholder_name`, `token`, `bank_ifsccode`, `created_date`, `refferalcode`, `update_status`, `delete_status`, `vendor_pincodes`) VALUES
(324, '', 'family store', '202209051808595673660_0cfd5ce4902430774529.avif', '202209051808599311857_fe8558826118_s1_8901030704680.avif', 'venkatesh', 'No', '66e21ca70ee2fc794d95d8366ef21cc6', '208221', 'hemavenkatesh208@gmail.com', 'order again', '8143601989', NULL, NULL, NULL, 'No', 'dwaraka nagar', 4, 5, 'Visakhapatnam', NULL, NULL, '17.728399', '83.308128', NULL, 20, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-05 12:38:59', '', 0, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_shop_banners`
--

CREATE TABLE `vendor_shop_banners` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `web_banner` varchar(255) NOT NULL,
  `app_banner` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(55) NOT NULL,
  `udpated_at` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `version_control`
--

CREATE TABLE `version_control` (
  `id` bigint(20) NOT NULL,
  `version` varchar(11) NOT NULL,
  `vendor_version` int(11) NOT NULL,
  `deliveryvoy_version` int(11) NOT NULL,
  `created_at` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `visual_merchant`
--

CREATE TABLE `visual_merchant` (
  `id` int(11) NOT NULL,
  `name` varchar(125) NOT NULL,
  `email` varchar(55) NOT NULL,
  `mobile` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `address` varchar(500) NOT NULL,
  `city` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL,
  `otp` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_orderid`
--

CREATE TABLE `wallet_orderid` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `order_id` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `message` text NOT NULL,
  `status` varchar(50) NOT NULL COMMENT 'plus or minus',
  `created_at` varchar(20) NOT NULL,
  `razerpay_orderid` text NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `whish_list`
--

CREATE TABLE `whish_list` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `working_hours`
--

CREATE TABLE `working_hours` (
  `id` bigint(20) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `weekname` varchar(80) NOT NULL,
  `working` varchar(5) NOT NULL,
  `open_time` time NOT NULL,
  `closed_time` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_variant`
--
ALTER TABLE `add_variant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_comissions`
--
ALTER TABLE `admin_comissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes_title`
--
ALTER TABLE `attributes_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes_values`
--
ALTER TABLE `attributes_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attr_brands`
--
ALTER TABLE `attr_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attr_colors`
--
ALTER TABLE `attr_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attr_sizes`
--
ALTER TABLE `attr_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bannerads`
--
ALTER TABLE `bannerads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `become_a_vendor`
--
ALTER TABLE `become_a_vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bid_quotations`
--
ALTER TABLE `bid_quotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_coupons`
--
ALTER TABLE `cash_coupons`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_codes`
--
ALTER TABLE `coupon_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courier_orders`
--
ALTER TABLE `courier_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveryboy`
--
ALTER TABLE `deliveryboy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveryboy_amount`
--
ALTER TABLE `deliveryboy_amount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filtergroups`
--
ALTER TABLE `filtergroups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filters`
--
ALTER TABLE `filters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filter_options`
--
ALTER TABLE `filter_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest_users`
--
ALTER TABLE `guest_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ipcheck`
--
ALTER TABLE `ipcheck`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `link_variant`
--
ALTER TABLE `link_variant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_attributes`
--
ALTER TABLE `manage_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `most_viewed_products`
--
ALTER TABLE `most_viewed_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_orders`
--
ALTER TABLE `online_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_cancelled_invoice`
--
ALTER TABLE `order_cancelled_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_delivered_invoice`
--
ALTER TABLE `order_delivered_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_placed_invoice`
--
ALTER TABLE `order_placed_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_refund_invoice`
--
ALTER TABLE `order_refund_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_shipped_invoice`
--
ALTER TABLE `order_shipped_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pincodes`
--
ALTER TABLE `pincodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_filter`
--
ALTER TABLE `product_filter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotion_notifications`
--
ALTER TABLE `promotion_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionaries`
--
ALTER TABLE `questionaries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cat_id` (`cat_id`);

--
-- Indexes for table `refund_exchange`
--
ALTER TABLE `refund_exchange`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_payment`
--
ALTER TABLE `request_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_favorites`
--
ALTER TABLE `shop_favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_visit`
--
ALTER TABLE `shop_visit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_work_hours`
--
ALTER TABLE `shop_work_hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_notifications`
--
ALTER TABLE `sms_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_management`
--
ALTER TABLE `stock_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_bids`
--
ALTER TABLE `user_bids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_reviews`
--
ALTER TABLE `user_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_transactions`
--
ALTER TABLE `user_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_orders_values`
--
ALTER TABLE `vendor_orders_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_payements`
--
ALTER TABLE `vendor_payements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_shop`
--
ALTER TABLE `vendor_shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_shop_banners`
--
ALTER TABLE `vendor_shop_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `version_control`
--
ALTER TABLE `version_control`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visual_merchant`
--
ALTER TABLE `visual_merchant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_orderid`
--
ALTER TABLE `wallet_orderid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whish_list`
--
ALTER TABLE `whish_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `working_hours`
--
ALTER TABLE `working_hours`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_variant`
--
ALTER TABLE `add_variant`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_comissions`
--
ALTER TABLE `admin_comissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attributes_title`
--
ALTER TABLE `attributes_title`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `attributes_values`
--
ALTER TABLE `attributes_values`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `attr_brands`
--
ALTER TABLE `attr_brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `attr_colors`
--
ALTER TABLE `attr_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attr_sizes`
--
ALTER TABLE `attr_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bannerads`
--
ALTER TABLE `bannerads`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `become_a_vendor`
--
ALTER TABLE `become_a_vendor`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bid_quotations`
--
ALTER TABLE `bid_quotations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=598;

--
-- AUTO_INCREMENT for table `cash_coupons`
--
ALTER TABLE `cash_coupons`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon_codes`
--
ALTER TABLE `coupon_codes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `courier_orders`
--
ALTER TABLE `courier_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deals`
--
ALTER TABLE `deals`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deliveryboy`
--
ALTER TABLE `deliveryboy`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `deliveryboy_amount`
--
ALTER TABLE `deliveryboy_amount`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `filtergroups`
--
ALTER TABLE `filtergroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filters`
--
ALTER TABLE `filters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `filter_options`
--
ALTER TABLE `filter_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guest_users`
--
ALTER TABLE `guest_users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ipcheck`
--
ALTER TABLE `ipcheck`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `link_variant`
--
ALTER TABLE `link_variant`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13425;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_attributes`
--
ALTER TABLE `manage_attributes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `most_viewed_products`
--
ALTER TABLE `most_viewed_products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2026;

--
-- AUTO_INCREMENT for table `online_orders`
--
ALTER TABLE `online_orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT for table `order_cancelled_invoice`
--
ALTER TABLE `order_cancelled_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_delivered_invoice`
--
ALTER TABLE `order_delivered_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_placed_invoice`
--
ALTER TABLE `order_placed_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_refund_invoice`
--
ALTER TABLE `order_refund_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_shipped_invoice`
--
ALTER TABLE `order_shipped_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pincodes`
--
ALTER TABLE `pincodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_filter`
--
ALTER TABLE `product_filter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6253;

--
-- AUTO_INCREMENT for table `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotion_notifications`
--
ALTER TABLE `promotion_notifications`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionaries`
--
ALTER TABLE `questionaries`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `refund_exchange`
--
ALTER TABLE `refund_exchange`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `request_payment`
--
ALTER TABLE `request_payment`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `shop_favorites`
--
ALTER TABLE `shop_favorites`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_visit`
--
ALTER TABLE `shop_visit`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_work_hours`
--
ALTER TABLE `shop_work_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7204;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_notifications`
--
ALTER TABLE `sms_notifications`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2459;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stock_management`
--
ALTER TABLE `stock_management`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2145;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=406;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user_bids`
--
ALTER TABLE `user_bids`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_reviews`
--
ALTER TABLE `user_reviews`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `user_transactions`
--
ALTER TABLE `user_transactions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_orders_values`
--
ALTER TABLE `vendor_orders_values`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_payements`
--
ALTER TABLE `vendor_payements`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `vendor_shop`
--
ALTER TABLE `vendor_shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;

--
-- AUTO_INCREMENT for table `vendor_shop_banners`
--
ALTER TABLE `vendor_shop_banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `version_control`
--
ALTER TABLE `version_control`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visual_merchant`
--
ALTER TABLE `visual_merchant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet_orderid`
--
ALTER TABLE `wallet_orderid`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `whish_list`
--
ALTER TABLE `whish_list`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=290;

--
-- AUTO_INCREMENT for table `working_hours`
--
ALTER TABLE `working_hours`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
