-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 22, 2022 at 04:57 PM
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
(1, 16, 1, '1', '1632739983', ''),
(2, 17, 1, '1', '1633425246', ''),
(3, 18, 1, '1', '1632740600', ''),
(4, 19, 1, '1', '1632831872', ''),
(5, 20, 1, '1', '1632834583', ''),
(6, 21, 1, '1', '1632899173', ''),
(7, 22, 1, '1', '1632899458', ''),
(8, 23, 1, '1', '1632904985', ''),
(27, 40, 10, '41,42', '1633670984', ''),
(10, 25, 1, '1', '1632915558', ''),
(11, 26, 1, '1', '1632918187', ''),
(12, 27, 1, '1', '1632918477', ''),
(13, 28, 1, '1', '1633007096', ''),
(14, 30, 1, '1', '1632995402', ''),
(15, 33, 1, '1', '1633006807', ''),
(16, 31, 1, '1', '1633006727', ''),
(17, 34, 1, '1', '1633007387', ''),
(18, 35, 1, '1', '1633007674', ''),
(41, 54, 9, '36,37,38,39,40', '1634022146', ''),
(25, 38, 2, '2,25', '1633434080', ''),
(26, 39, 9, '36,37,38', '1633670311', ''),
(22, 24, 9, '36,37,38,39,40', '1634021768', ''),
(40, 53, 9, '36,37,38,39,40', '1634021978', ''),
(24, 37, 2, '2', '1633433885', ''),
(28, 41, 10, '41', '1633672772', ''),
(29, 42, 8, '31', '1633672817', ''),
(30, 43, 8, '31', '1633673080', ''),
(31, 44, 8, '31', '1633673117', ''),
(32, 45, 8, '31', '1633673157', ''),
(33, 46, 8, '31', '1633673587', ''),
(34, 47, 2, '2', '1633673625', ''),
(35, 48, 2, '25', '1633674074', ''),
(36, 49, 9, '36', '1633686108', ''),
(37, 50, 9, '36', '1633674143', ''),
(38, 52, 9, '36', '1633677428', ''),
(42, 55, 1, '1,20,21', '1650628327', ''),
(43, 57, 1, '1', '1650634305', ''),
(44, 58, 2, '2', '1650635791', ''),
(45, 59, 2, '25', '1650636826', ''),
(46, 60, 1, '1,20,21', '1656753953', ''),
(47, 61, 1, '20', '1658490208', ''),
(48, 62, 1, '20,21', '1658494355', '');

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

INSERT INTO `admin` (`id`, `username`, `password`, `forgot_password`, `name`, `email`, `mobile`, `share_title`, `playstore_vendorlink`, `playstore_userlink`, `playstore_dblink`, `distance`, `order_amount`, `coins`, `coinperamount`, `registration_coins`, `first_order_coins`, `version_control`) VALUES
(1, 'admin', '25a41cec631264f04815eda23dc6edd9', 'vizag@123', 'admin', 'admin@absolutemens.com', '1234567890', 'Please download SECTOR6 from the following link and use code \'PROMO 50\' to avail discount on your first purchase. Thank you.', 'https://play.google.com/store', 'https://play.google.com/store', 'https://play.google.com/store', '10', '100', '4', '5', '20', '40', '1');

-- --------------------------------------------------------

--
-- Table structure for table `admin_comissions`
--

CREATE TABLE `admin_comissions` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `cat_id` varchar(255) NOT NULL,
  `subcategory_ids` text NOT NULL,
  `admin_comission` int(11) NOT NULL,
  `gst` float NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` varchar(55) NOT NULL,
  `updated_at` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_comissions`
--

INSERT INTO `admin_comissions` (`id`, `shop_id`, `cat_id`, `subcategory_ids`, `admin_comission`, `gst`, `status`, `created_at`, `updated_at`) VALUES
(42, 239, '13', '144', 5, 0, 1, '1650619715', ''),
(2, 240, '2', '122', 5, 4, 1, '1623825964', ''),
(3, 241, '1', '121', 10, 0, 1, '1623905602', ''),
(4, 248, '3', '123', 30, 1, 1, '1632738181', '1632831618'),
(8, 240, '4', '125', 5, 22, 1, '1632995057', ''),
(7, 249, '3', '123', 5, 18, 1, '1632739576', '1632831616'),
(9, 240, '6', '127', 8, 12, 1, '1632995068', '1632995080'),
(11, 249, '9', '134', 6, 8, 1, '1633344978', ''),
(12, 249, '8', '131', 5, 8, 1, '1633344998', '1633345006'),
(13, 249, '8', '133', 4, 7, 1, '1633345019', ''),
(14, 249, '8', '132', 1, 1, 1, '1633345027', ''),
(27, 249, '11', '138', 1, 15, 1, '1633349472', ''),
(26, 249, '11', '137', 1, 2, 1, '1633349434', ''),
(17, 249, '6', '127', 4, 5, 1, '1633345302', ''),
(22, 249, '4', '125', 0, 0, 1, '1633345758', ''),
(21, 249, '5', '126', 0, 0, 1, '1633345738', ''),
(29, 249, '10', '135,136', 1, 1, 1, '1633432369', ''),
(28, 249, '11', '139', 1, 2, 1, '1633349496', '1633349521'),
(30, 249, '7', '129,130', 4, 2, 1, '1633432395', ''),
(31, 265, '10', '135,136', 5, 8, 1, '1633669206', ''),
(32, 265, '3', '123', 5, 3, 1, '1633669398', ''),
(33, 265, '7', '129,130', 4, 3, 1, '1633669419', ''),
(34, 265, '11', '137,138,139', 2, 1, 1, '1633669434', ''),
(35, 265, '9', '134', 5, 1, 1, '1633669443', ''),
(36, 265, '8', '131,132,133', 2, 1, 1, '1633669456', ''),
(37, 265, '4', '125', 4, 3, 1, '1633669493', ''),
(38, 265, '6', '127', 1, 3, 1, '1633669506', ''),
(39, 265, '5', '126', 5, 3, 1, '1633669540', ''),
(40, 265, '11', '137', 0, 0, 1, '1634019730', ''),
(41, 239, '12', '143', 5, 0, 1, '1650618329', ''),
(43, 239, '14', '145', 5, 0, 1, '1650619746', ''),
(44, 239, '15', '146', 5, 0, 1, '1650619775', ''),
(45, 239, '16', '147', 5, 0, 1, '1650619804', ''),
(46, 239, '17', '148', 5, 0, 1, '1650619816', ''),
(47, 239, '18', '149', 5, 0, 1, '1650619831', ''),
(48, 240, '14', '145', 0, 0, 1, '1658494247', ''),
(49, 240, '15', '146', 0, 0, 1, '1658494258', '');

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

--
-- Dumping data for table `admin_notifications`
--

INSERT INTO `admin_notifications` (`id`, `vendor_id`, `order_id`, `message`, `user_id`, `status`, `created_date`) VALUES
(1, 0, 12, 'Order Cancelled by ', 353, 0, '2021-06-22 04:54:04'),
(2, 239, 10, 'Order Accepted by ', 0, 0, '2021-06-22 05:01:17'),
(3, 239, 10, 'Order Delivered By ', 0, 0, '2021-06-22 05:04:03'),
(4, 239, 1, 'Order Cancelled by Vendor', 0, 1, '2021-09-30 06:54:10'),
(5, 239, 3, 'Order Cancelled by Vendor', 0, 1, '2021-10-07 09:10:42'),
(6, 239, 3, 'Order Cancelled by Vendor', 0, 1, '2021-10-07 09:10:42'),
(7, 239, 4, 'Order Cancelled by Vendor', 0, 0, '2021-06-22 12:47:58'),
(8, 239, 5, 'Order Cancelled by Vendor', 0, 0, '2021-06-22 12:49:50'),
(9, 239, 1, 'Order Accepted by ', 0, 1, '2021-09-30 06:54:10'),
(10, 0, 2, 'Order Cancelled by ', 353, 1, '2021-10-07 09:11:09'),
(11, 239, 1, 'Order Accepted by ', 0, 1, '2021-09-30 06:54:10'),
(12, 239, 2, 'Order Accepted by ', 0, 1, '2021-10-07 09:11:09'),
(13, 239, 3, 'Order Accepted by ', 0, 1, '2021-10-07 09:10:42'),
(14, 239, 9, 'Order Accepted by ', 0, 0, '2021-09-06 11:30:27'),
(15, 0, 9, 'Order Cancelled by ', 353, 0, '2021-09-06 11:30:47'),
(16, 0, 12, 'Order Cancelled by ', 357, 0, '2021-09-27 09:47:02'),
(17, 248, 13, 'Dear Prashanth your order is 13 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.', 0, 0, '2021-09-27 11:16:43'),
(18, 0, 14, 'Order Cancelled by ', 355, 0, '2021-09-28 11:04:04'),
(19, 249, 15, 'Dear Manikanta Reddy your order is 15 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.', 0, 0, '2021-09-28 13:04:15'),
(20, 249, 16, 'Dear Manikanta Reddy your order is 16 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.', 0, 0, '2021-09-28 13:05:45'),
(21, 249, 17, 'Order Cancelled by', 0, 0, '2021-09-28 13:07:21'),
(22, 248, 23, 'Dear Prashanth Bandi your order is 23 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.', 0, 1, '2021-09-29 06:56:40'),
(23, 248, 20, 'Dear Manikanta Reddy your order is 20 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.', 0, 0, '2021-09-29 07:26:35'),
(24, 248, 19, 'Dear Prashanth Bandi your order is 19 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.', 0, 0, '2021-09-29 07:26:47'),
(25, 248, 18, 'Dear Prashanth Bandi your order is 18 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.', 0, 0, '2021-09-29 07:26:59'),
(26, 248, 19, 'Dear Prashanth Bandi your order is 19 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.', 0, 0, '2021-09-29 09:40:52'),
(27, 248, 20, 'Dear Manikanta Reddy your order is 20 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.', 0, 0, '2021-09-29 09:41:05'),
(28, 0, 25, 'Order Cancelled by ', 355, 0, '2021-09-29 11:05:20'),
(29, 0, 25, 'Order Cancelled by ', 355, 0, '2021-09-29 11:05:21'),
(30, 249, 24, 'Dear  your order is 24 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.', 0, 0, '2021-09-29 11:41:31'),
(31, 249, 26, 'Dear Manikanta Reddy your order is 26 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.', 0, 0, '2021-09-29 11:41:39'),
(32, 0, 27, 'Order Cancelled by ', 355, 0, '2021-09-29 11:47:22'),
(33, 248, 29, 'Order Cancelled by', 0, 0, '2021-09-30 12:17:04'),
(34, 248, 28, 'Dear Prashanth your order is 28 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.', 0, 0, '2021-09-30 12:17:14'),
(35, 248, 28, 'Dear Prashanth your order is 28 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.', 0, 0, '2021-09-30 12:17:22'),
(36, 265, 36, 'Order Accepted by ', 0, 0, '2021-10-08 12:00:02'),
(37, 265, 47, 'Dear Manikanta Reddy your order is 47 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.', 0, 0, '2021-10-11 09:55:06'),
(38, 265, 46, 'Dear Manikanta Reddy your order is 46 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.', 0, 0, '2021-10-11 09:55:10'),
(39, 265, 45, 'Order Cancelled by', 0, 0, '2021-10-11 09:55:15'),
(40, 265, 44, 'Dear Manikanta Reddy your order is 44 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.', 0, 0, '2021-10-11 09:55:22'),
(41, 0, 10, 'Order Cancelled by ', 353, 0, '2021-10-11 12:24:27'),
(42, 265, 51, 'Dear Manikanta Reddy your order is 51 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.', 0, 0, '2021-10-11 13:06:22'),
(43, 265, 49, 'Dear Manikanta Reddy your order is 49 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.', 0, 0, '2021-10-11 13:06:26'),
(44, 265, 52, 'Dear Manikanta Reddy your order is 52 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.', 0, 0, '2021-10-11 13:08:20'),
(45, 265, 53, 'Dear Manikanta Reddy your order is 53 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.', 0, 0, '2021-10-11 13:08:23'),
(46, 0, 56, 'Order Cancelled by ', 353, 0, '2021-12-29 09:50:57'),
(47, 0, 62, 'Order Cancelled by ', 353, 0, '2022-02-16 06:25:01'),
(48, 239, 65, 'Dear anu your order is 65 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.', 0, 0, '2022-05-21 05:49:10');

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
(1, 15, 1, 'Dwraka Nagar ', '500035', 0, 1),
(2, 15, 1, 'MVP Colony', '500035', 0, 1),
(3, 15, 1, 'DABA GARDENS', '530016', 0, 1),
(4, 16, 4, 'PUNJAGUTTA', '500034', 0, 1),
(5, 16, 5, 'REDDY JUNCTION', '545654', 0, 1),
(6, 17, 6, 'PANDI BAZAR', '154632', 0, 1),
(7, 18, 7, 'ASSEMBLY ROAD', '789654', 0, 1),
(8, 19, 8, 'PORT AREA', '254631', 0, 1),
(9, 21, 11, 'THIRUVANTHAPURAM', '985632', 0, 1);

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
(13, 'Volume', 0, '1656827162', '');

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
(1, 1, 'S', ''),
(2, 2, '250', ''),
(25, 2, '500', ''),
(24, 1, 'XXXL', ''),
(23, 1, 'XXL', ''),
(22, 1, 'XL', ''),
(21, 1, 'L', ''),
(20, 1, 'M', ''),
(26, 2, '750', ''),
(27, 2, '1000', ''),
(28, 7, 'Blue', ''),
(29, 7, 'Green', ''),
(30, 7, 'White', ''),
(31, 8, '1', ''),
(32, 8, '2', ''),
(33, 8, '3', ''),
(34, 8, '4', ''),
(35, 8, '5', ''),
(36, 9, '1', ''),
(37, 9, '2', ''),
(38, 9, '3', ''),
(39, 9, '4', ''),
(40, 9, '5', ''),
(41, 10, '1', ''),
(42, 10, '2', ''),
(43, 10, '3', ''),
(52, 12, '', ''),
(51, 12, '1', ''),
(54, 13, '200 ml', ''),
(55, 13, '500ml', '');

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
(1, 'NIKE', '', 1, 1614927255),
(2, 'IPHONE', '', 1, 1615210269),
(3, 'pumas', '', 1, 1615267465),
(4, 'BIBA', '', 1, 1615357158),
(5, 'AURELIA', '', 1, 1615357178),
(6, 'HERE AND NOW', '', 1, 1615357214),
(7, 'AVASA', '', 1, 1615357221),
(8, 'NON Branded', '', 1, 1615366896),
(9, 'Branded item', '', 1, 1615366962),
(10, 'TITAN', '', 1, 1615975024),
(11, 'Redmi', '', 1, 1632736135),
(12, 'BIRIYANI', '', 1, 1632739984),
(13, 'FRY PIECES', '', 1, 1632915412),
(14, 'THUMPS UP', '', 1, 1632918259),
(15, 'VANILLA', '', 1, 1632918270),
(16, 'MASALA SOUP', '', 1, 1632918305),
(17, 'LIPTON GREEN TEA', '', 1, 1632982403),
(18, 'PULLA REDDY', '', 1, 1632982623),
(19, 'PANNER', '', 1, 1633343762),
(20, 'HALEEM', '', 1, 1633343771),
(21, 'FISH', '', 1, 1633343790),
(22, 'TIFFINS', '', 1, 1633347825),
(23, 'TIFFINS', '', 1, 1633347825),
(24, 'STATERS', '', 1, 1633348360),
(25, 'TEA', '', 1, 1633496004),
(26, ' ', '', 1, 1634018827),
(27, '       ', '', 1, 1634018835);

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

--
-- Dumping data for table `bannerads`
--

INSERT INTO `bannerads` (`id`, `title`, `web_image`, `app_image`, `shop_id`, `blocks`) VALUES
(1, 'Paradise', '202109291244507388999_paradise2.png', '202109291244508079993_paradise_hotel.jpg', 248, '1'),
(2, 'REDDY\'S RESTUARANT', '20210929125026177185_mr1.jfif', '202109291252237666827_rp1.jfif', 249, '1'),
(3, 'Bawarchi Dwarakanagar', '202109301832229647611_bawarchi.jpg', '202109301832223284473_bawarchi.jpg', 248, '1');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `web_image` text NOT NULL,
  `app_image` text NOT NULL,
  `location_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `web_image`, `app_image`, `location_id`, `type`, `shop_id`, `product_id`, `position`) VALUES
(1, 'Food', '20220422123921356886_banner_1.jpg', '202204221239213754600_banner_1.jpg', 1, 'shops', 239, 1, 1),
(5, 'Perfumes', '202204221525543991849_add_3.png', '202204221525542622156_add_3.png', 1, 'shops', 239, 1, 2),
(3, 'Shoes', '202204221525158521225_add_2.png', '202204221525154239182_add_2.png', 1, 'shops', 306, 1, 2),
(7, 'Sun Glasses', '202204221526558384518_banner_1.jpg', '202204221526551736402_banner_1.jpg', 1, 'shops', 239, 1, 1);

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

--
-- Dumping data for table `become_a_vendor`
--

INSERT INTO `become_a_vendor` (`id`, `user_id`, `shopname`, `ownername`, `email`, `mobile`, `state`, `city`, `location`, `created_at`) VALUES
(2, 0, '&#-#:£_ __((', 'reddy', 'reddy@gmail.com', '1234567890', 'abn', 'nan', 'nan', '1632819303'),
(3, 0, '-£ #;;2882!#!', 'reddy', 'reddy@gmail.com', '1234567890', 'nsn', 'nana', 'nana', '1632819338'),
(4, 0, 'reddy', '-# # 288!@!__', 'a@gmail.com', '1234997979', 'aks', 'nsnsn', 'jwisn', '1632819436'),
(5, 0, 'mani', 'reddy', 'absvbdjxmsbsnkskznamal@gmail.com', '1234569640', 'bsjs', 'namk', 'jsn', '1632819478'),
(6, 0, 'nani', 'reddy', 'mani@gmail.com', '6134099640', 'snn', 'nam', 'kskk', '1632819537'),
(7, 0, 'mani', 'mani', 'mani@gmail.com', '9794961396', ' #; 28(', 'vsk', 'vsk', '1632819585'),
(8, 0, 'mani', 'mani', 'mani@gmail.com', '9469691364', 'ap', ' @ 819)', 'vsk', '1632819625'),
(9, 0, 'mani', 'mani', 'mani@gmail.com', '9464969199', 'ap', 'vsk', '199(#))#)299', '1632819664'),
(10, 0, 'manm', 'nsns', 'mani@gaj.bajaj.bsj.gmail.gmail.com', '1234659499', 'akk', 'snn', 'jan', '1632819713'),
(11, 0, '  an', 'nanq', 'nanaan@gmail.com', '1234965789', 'aj', 'sn', 'na', '1632819825'),
(12, 0, '      space before name', 'nani', 'nani@gmail.com', '1239654789', 'ab', 'snn', 'nan', '1632819875'),
(13, 0, 'mani', '               reddy', 'mani@gmail.com', '1926345789', 'an', 'sn', 'an', '1632819987'),
(14, 0, 'mani', 'mani', 'reddysector@gmail.com', '1926345780', 'ann', 'nsnan', 'nans', '1632820030'),
(15, 0, 'mani', 'reddy', 'manigmail@gmqil.com', '1997649769', '              aps', 'nan', 'an', '1632820172'),
(16, 0, 'mani', 'reddy', 'mahi@gmail.com', '1946532789', 'an', '                 #lwos', 'na', '1632820256'),
(17, 0, 'mani', 'reddy', 'mahi@gmail.com', '1956342789', 'ap', 'ak', '                           (#(29kkakajs', '1632820295'),
(18, 0, ' ', ' ', 'agma@gmail.com', '1923465879', ' ', ' ', ' ', '1632820361'),
(19, 0, ' ', ' ', 'a@gmail.com', '1923465780', ' ', ' ', ' ', '1632820387'),
(20, 0, 'g', 'h', 'pp@g.com', '6303569071', 'h', 'l', 'g', '1632824494'),
(21, 0, 'fufyf', 'yfyf', 'praf@g.com', '6303569065', 'hh', 'hj', 'hh', '1632825381'),
(22, 0, 'g', 'h', 'p@g.com', '6303569071', '24556777??\'', 'h', 'l', '1632825502'),
(23, 0, 'f', 'h', 'p@g.com', '0852369147', 'gh', '6784667', '567466', '1632825815');

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
  `cart_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `session_id`, `variant_id`, `vendor_id`, `user_id`, `price`, `quantity`, `unit_price`, `status`, `cart_status`) VALUES
(212, '67570669438101', 13333, 249, 352, '200', '1', '200', 0, 0),
(213, '67570669438101', 13328, 249, 352, '200', '1', '200', 0, 0),
(214, '67570669438101', 13315, 265, 352, '550', '2', '1100', 0, 0),
(215, '31404899679825', 13345, 239, 387, '359', '1', '359', 0, 0),
(216, '91952644589221', 13344, 239, 387, '500', '3', '1500', 0, 0),
(217, '91952644589221', 13343, 239, 387, '429', '2', '858', 0, 0),
(218, '91952644589221', 13345, 239, 387, '359', '1', '359', 0, 0),
(219, '15134630405105', 13344, 239, 385, '500', '1', '500', 0, 0),
(220, '15134630405105', 13343, 239, 385, '429', '2', '858', 0, 0),
(221, '10136556752273', 13344, 239, 385, '500', '1', '500', 0, 0),
(222, '66108339063366', 13344, 239, 385, '500', '3', '1500', 0, 0),
(223, '19588061185993', 13339, 239, 385, '800', '1', '800', 0, 0),
(224, '74760045241129', 13344, 239, 385, '500', '9', '4500', 0, 0),
(225, '49747517158229', 13344, 239, 385, '500', '2', '1000', 0, 0),
(226, '93617483509930', 13343, 239, 385, '429', '2', '858', 0, 0),
(227, '92265439884548', 13343, 239, 388, '429', '1', '429', 0, 0),
(228, '92265439884548', 13344, 239, 388, '500', '1', '500', 0, 0),
(233, '60290575564691', 13344, 239, 388, '500', '1', '500', 0, 0),
(230, '54379569252558', 13345, 239, 389, '359', '1', '359', 0, 0),
(232, '83827063238657', 13344, 239, 388, '500', '3', '1500', 0, 0),
(234, '92929076157038', 13343, 239, 384, '429', '2', '858', 0, 0),
(235, '13867840928786', 13344, 239, 385, '500', '2', '1000', 0, 0),
(236, '13867840928786', 13343, 239, 385, '429', '2', '858', 0, 0),
(237, '50425251589994', 13343, 239, 384, '429', '2', '858', 0, 0),
(238, '50425251589994', 13344, 239, 384, '500', '1', '500', 0, 0),
(239, '46695673493008', 13343, 239, 388, '429', '1', '429', 0, 0),
(240, '46695673493008', 13344, 239, 388, '500', '2', '1000', 0, 0),
(241, '62410376101177', 13343, 239, 388, '429', '1', '429', 0, 0),
(242, '62410376101177', 13344, 239, 388, '500', '1', '500', 0, 0),
(243, '62279673941958', 13344, 239, 388, '500', '2', '1000', 0, 0),
(244, '14929725737981', 13344, 239, 385, '500', '2', '1000', 0, 0),
(245, '90386729030966', 13344, 239, 352, '500', '1', '500', 0, 0),
(246, '42541949385205', 13344, 239, 388, '500', '1', '500', 0, 0),
(247, '42541949385205', 13345, 239, 388, '359', '1', '359', 0, 0),
(248, '78261812849135', 13344, 239, 388, '500', '1', '500', 0, 0),
(250, '21123424178477', 13343, 239, 389, '429', '2', '858', 0, 0),
(251, '11333440951529', 13343, 239, 384, '429', '3', '1287', 0, 0),
(252, '52088862478762', 13343, 239, 389, '429', '2', '858', 0, 0),
(253, '89026761944745', 13344, 239, 388, '500', '1', '500', 0, 0),
(254, '75083917847110', 13343, 239, 389, '429', '1', '429', 0, 0),
(255, '75083917847110', 13345, 239, 389, '359', '1', '359', 0, 0),
(256, '29652561782606', 13344, 239, 385, '500', '5', '2500', 0, 0),
(257, '89859963953818', 13343, 239, 385, '429', '3', '1287', 0, 0),
(258, '12178892193898', 13343, 239, 385, '429', '1', '429', 0, 0),
(259, '42283726163643', 13344, 239, 385, '500', '1', '500', 0, 0),
(260, '42283726163643', 13343, 239, 385, '429', '1', '429', 0, 0),
(261, '35201320755147', 13344, 239, 385, '500', '3', '1500', 0, 0),
(262, '50961580123706', 13343, 239, 390, '429', '1', '429', 0, 0),
(266, '97728323406354', 13344, 239, 385, '500', '5', '2500', 0, 0),
(268, '82783941632080', 13343, 239, 385, '429', '3', '1287', 0, 0),
(269, '82783941632080', 13344, 239, 385, '500', '1', '500', 0, 0),
(270, '55882082802646', 13343, 239, 389, '429', '1', '429', 0, 0),
(271, '71755586676543', 13345, 239, 388, '359', '1', '359', 0, 0),
(272, '96039620822977', 13343, 239, 389, '429', '2', '858', 0, 0),
(273, '88012260142987', 13343, 239, 384, '429', '2', '858', 0, 0),
(274, '66513173472710', 13343, 239, 385, '429', '1', '429', 0, 0),
(275, '88893680454638', 13345, 239, 385, '359', '3', '1077', 0, 0),
(276, '79374384006264', 13344, 239, 385, '500', '1', '500', 0, 0),
(277, '79374384006264', 13343, 239, 385, '429', '1', '429', 0, 0),
(278, '66799292822215', 13344, 239, 384, '500', '1', '500', 0, 0),
(279, '65819965693469', 13344, 239, 385, '500', '1', '500', 0, 0),
(280, '82330106333253', 13344, 239, 384, '500', '2', '1000', 0, 0),
(281, '82330106333253', 13339, 239, 384, '800', '1', '800', 0, 0),
(282, '46194616272297', 13345, 239, 389, '359', '1', '359', 0, 0),
(285, '70597005114872', 13350, 240, 352, '23', '1', '23', 0, 0);

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

--
-- Dumping data for table `cash_coupons`
--

INSERT INTO `cash_coupons` (`id`, `user_id`, `coupon_code`, `amount`, `start_date`, `expiry_date`, `description`) VALUES
(1, 34, 'TEST500', 500, '2021-06-07', '2021-06-07', 'TEST CASH COUPON CODE'),
(2, 47, 'REFUND-138', 646, '2021-06-07', '2021-06-30', 'Order no. 138 refund'),
(3, 47, 'COUPON-646', 0, '2021-06-07', '2021-06-07', 'For the order cancelled from the vendor'),
(4, 154, 'satish50', 100, '2021-06-08', '2021-06-30', 'test50'),
(5, 158, 'Free coupon', 51, '2021-06-14', '2021-06-14', ' Congratulations!!! u have received a cash coupon of Rs 51/-\r\n Use before 21/06/2021. Enjoy u r shopping with RETOS.'),
(6, 12, 'Ranganadh 51', 51, '2021-06-16', '2021-07-16', 'Congrats You can Redeem Rs51/- on your next online purchase on RETOS. Valid for 1 month only.'),
(7, 252, 'UME 30', 30, '2021-06-20', '2021-06-27', 'Flat Rs30/- off on your next purchase. Valid for only one week. '),
(8, 536, 'SRIK100', 100, '2021-07-12', '2021-07-31', '100/- off  on your next purchase more than 199/-'),
(9, 349, 'DEL FREE', 31, '2021-08-03', '2021-08-31', 'Congratulations!! You have received free delivery coupon on your next purchase.'),
(10, 914, 'FOODFESTIVAL CASHBACK', 42, '2021-08-16', '2021-09-16', 'Dear User Congrats ...for the food festival cash back amount.'),
(11, 379, 'FOODFESTIVAL CASHBACK', 39, '2021-08-16', '2021-09-16', 'Dear User Congrats ...for the food festival cash back amount.'),
(12, 12, 'FOODFESTIVAL CASHBACK', 87, '2021-08-16', '2021-09-16', 'Dear User Congrats ...for the food festival cash back amount.'),
(13, 604, 'FOODFESTIVAL CASHBACK', 32, '2021-08-16', '2021-09-16', 'Dear User Congrats ...for the food festival cash back amount.'),
(14, 379, 'SRVM31', 31, '2021-08-16', '2021-08-16', 'Free delivery coupon.'),
(15, 179, 'CASH BACK 35', 35, '2021-08-17', '2021-08-24', 'Congratulations !!  you have received Rs 35/- as cash back for your purchase from Sai Food court. Use this coupon before 24 Aug 2021.'),
(16, 296, 'SRM160', 160, '2021-08-18', '2021-08-31', 'Use code SRM160  and get RS160 off on your next purchase. Use before 31/08/2021.'),
(17, 1854, 'RETOS50', 50, '2021-08-24', '2021-09-30', '50/- Cash Coupon '),
(18, 815, 'PRAVEEN31', 31, '2021-09-03', '2021-09-30', 'Congrats!  you got a cash coupon on online shopping from Retos. '),
(19, 2156, 'ANAN143', 143, '2021-09-11', '2021-09-30', 'Cash refund for the order 835.'),
(20, 110, 'test50', 50, '2021-09-16', '2021-09-16', 'for testing'),
(21, 418, 'satish50', 50, '2021-09-16', '2021-09-30', 'test50'),
(22, 184, 'Cash171', 171, '2021-10-01', '2021-10-31', 'Your cash back for the cancelled order no 1175 is credite as cash coupon of Rs 171/-. You have earned 42/- extra for the same order. Please redeem before 31/10/2021.'),
(23, 631, 'KMRD211', 211, '2021-10-10', '2021-11-09', 'Refund of Rs 211/- for your unsuccessful transaction is given as cash coupon \"KMRD211\" use before 09/Nov/2021'),
(24, 547, 'UDAY80', 80, '2021-10-14', '2021-11-14', 'Dear User ! Continue to shop with UDAY80 coupon. T/C apply.'),
(25, 631, 'KMRD60', 60, '2021-10-09', '2021-10-31', 'Congratulations you have earned Rs60/- as cash coupon. Use before 31/Oct/2021');

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
(1, '1_restuarants', 'restuarants', 'Good Food', '', 'Category__20210615131535.jpg', 0, 2, '1623743135', '1650619930'),
(3, '3_food', 'FOOD', 'Biriryani\'s, Meals', '', 'Category__20210927151110.jpg', 0, 1, '1632735670', '1650612442'),
(4, '4_soft-drinks', 'SOFT DRINKS', 'SOFT DRINKS', '', 'Category__20210929123412.jpg', 0, 5, '1632899052', '1650620024'),
(5, '5_soups', 'SOUPS', 'TOMATO SOUP, GINGER SOUP.', '', 'Category__20210929123539.jpg', 0, 4, '1632899139', '1650620001'),
(6, '6_ice-creams', 'ICE CREAMS', 'CHOCO CHIPS, FRIUT OVERLOADED, VANILLA FLAVOURES ETC...', '', 'Category__20210929124109.jpg', 0, 3, '1632899469', '1650619982'),
(7, '7_masala', 'MASALA', 'MASALA FOODS', '', 'Category__20211004155835.jpg', 0, 2, '1633343315', '1650619960'),
(8, '8_haleem', 'HALEEM', 'MUTTON HALEEM', '', 'Category__20211004161738.jpg', 0, 3, '1633344458', '1650619992'),
(9, '9_sweets', 'SWEETS', 'LADDU, KAJA, KAJU BHARUFI, MAISOOR PAK', '', 'Category__20211004162220.jpg', 0, 2, '1633344740', '1650619967'),
(10, '10_tiiffins', 'TIIFFINS', 'IDLI, VADA, DOSA, PURI, UPMA', '', 'Category__20211004171316.jpg', 0, 4, '1633347796', '1650620011'),
(11, '11_staters', 'STATERS', 'CHCIKEN FRY WINGS, CHICKEN LOLIPOPS, CHCIKEN DRUM STICKS, MUTTON FRY WINGS, MUTTON LOLIPOPS, MUTTON DRUM STICKS', '', 'Category__20211004172036.jpg', 0, 2, '1633348236', '1650619975'),
(12, '12_shaving', 'Shaving', 'Shaving', '', 'Category__20220422125705.jpg', 1, 1, '1650612425', '1650620377'),
(13, '13_beard-care', 'Beard Care', 'Beard Care', '', 'Category__20220422144406.jpg', 1, 2, '1650618846', ''),
(14, '14_hair-care', 'Hair Care', 'Hair Care', '', 'Category__20220422144429.jpg', 1, 3, '1650618869', ''),
(15, '15_skin-care', 'Skin Care', 'Skin Care', '', 'Category__20220422144455.jpg', 1, 4, '1650618895', ''),
(16, '16_perfumes--deos', 'Perfumes & Deos', 'Perfumes & Deos', '', 'Category__20220422144522.jpg', 1, 5, '1650618922', ''),
(17, '17_health--nutrition', 'Health & Nutrition', 'Health & Nutrition', '', 'Category__20220422144547.jpg', 1, 6, '1650618947', ''),
(18, '18_luxe', 'Luxe', 'Luxe', '', 'Category__20220422144621.jpg', 1, 7, '1650618981', ''),
(19, '19_health', 'Health', 'Health Care', '', 'Category__20220703110634.jpg', 1, 2, '1656826594', '');

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
(1, 1, 'Vizag', '1650454942', 0);

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
(8, 'Shipping Policy', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 1, '1606373664');

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

--
-- Dumping data for table `coupon_codes`
--

INSERT INTO `coupon_codes` (`id`, `shop_id`, `coupon_code`, `percentage`, `start_date`, `expiry_date`, `maximum_amount`, `utilization`, `minimum_order_amount`, `description`) VALUES
(1, 248, '16AGCD', '10', '2021-09-28', '2021-09-30', '100', '10', 30, 'Food'),
(8, 0, '19191', '10', '2021-09-30', '2021-09-30', '500', '15', 1000, 'E'),
(3, 0, 'FIRSTBIRIYANI', '50', '2021-09-29', '2021-12-29', '150', '5', 150, 'For First Time Users only'),
(4, 0, 'ZA312345', '10', '2021-09-29', '2021-10-29', '100', '30', 100, 'For Food Only'),
(5, 248, 'A12334', '10', '2021-09-29', '2021-09-30', '100', '15', 200, 'Hurry Up'),
(6, 248, 'ABCD', '10', '2021-09-29', '2021-11-29', '100', '50', 31, 'Use It'),
(9, 0, '123', '95', '2021-09-30', '2021-09-30', '2', '3', 1000, 'code\r\n'),
(12, 0, ' WDWDWD', '20', '2021-10-12', '2021-10-12', '-25', '1', 100, ' '),
(13, 0, 'EFQEF', '10', '2021-10-12', '2021-10-12', '-100', '2', 150, 'VEEF'),
(14, 0, 'FSG', '10', '2021-10-12', '2021-10-12', '-55', '3', 120, 'WEBF');

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

--
-- Dumping data for table `courier_orders`
--

INSERT INTO `courier_orders` (`id`, `session_id`, `vendor_id`, `order_resp_id`, `order_response`, `shipment_response`, `manifest_response`, `track`) VALUES
(1, '1', '1', 'musqd2lkp9983hp96ney1630911702', 'dasdsa', 'dasdas', 'dasdsad', NULL);

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

--
-- Dumping data for table `deliveryboy`
--

INSERT INTO `deliveryboy` (`id`, `name`, `email`, `phone`, `alternative_mobiles`, `password`, `photo`, `vehicle_number`, `vehicle_type`, `driving_license_image`, `driving_license_number`, `document`, `aadhar_card`, `aadhar_card_number`, `mobile_verified`, `country`, `state`, `city`, `location`, `address`, `pincode`, `lat`, `lang`, `token`, `delivery_type`, `otp_status`, `otp`) VALUES
(2, 'DRG', 'SNJWSD@GMAIL.COM', '1234569873', '9876543212', '304854e2e79de0f96dc5477fef38a18f', '202109291152033192800_d1.jpg', '!@@$@^%!&', '78855452', '202109291152057903561_d2.jfif', '@!&@&@*@*', '202109291152058206293_mr2.jfif', '202109291152056601256_mr2.jfif', 'hihuhjjhjhhjh', 'yes', 'India', '15', '1', '', 'Dwraka nagar', 'mkdwsjdwqkl', '17.7413', '83.3345', '', '', 0, ''),
(3, 'Prashanth', 'prashanth@gmail.com', '7093800000', '7093873262', '591805a1b811940f113234aa70e03cca', '202109291203596816981_delivery_boy_service_500x500.jpg', '123AP', 'Two Wheeler', '202109291203599995915_driver_license_male_photo.jpg', '1233456', '202109291203591007522_driver_license_male_photo.jpg', '202109291203599191114_driver_license_male_photo.jpg', '1234567890', 'yes', 'India', '16', '4', '', 'Ameerpet', '500035', '17.686815', '17.686815', '', '', 0, ''),
(4, ' ', 'deliveryboy@gmail.com', '5644415454', '6245464955', '7215ee9c7d9dc229d2921a40e899ec5f', '202110071451356869996_d1.jpg', ' ', '  ', '20211007145136162499_dl1.jfif', ' ', '202110071451363357144_ad1.jfif', '20211007145136345255_ad1.jfif', ' ', 'no', 'India', '15', '1', '', ' ', ' ', ' ', ' ', '', '', 0, ''),
(5, '^@^(!&*@^', 'A@GMAIL.COM', '8792256326', '1548945451', '83a4063476c02d915ad0c574150d0890', '202110121207549592279_whatsapp_image_2021_10_08_at_11.18.20__16_.jpeg', '(&~^!^#(#^!', '*(!^#!*#      &*', '202110121207545373843_whatsapp_image_2021_10_08_at_11.31.58.jpeg', '!^#(   !&#(', '202110121207547028685_whatsapp_image_2021_10_08_at_11.18.20__15_.jpeg', '202110121207547624802_whatsapp_image_2021_10_08_at_11.18.20__15_.jpeg', 'y*^(#^', 'yes', 'India', '19', '8', '', 'QRQy#(', 'SNVFIRSFH', '17.359961', '83.3093', '', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `deliveryboy_amount`
--

CREATE TABLE `deliveryboy_amount` (
  `id` bigint(20) NOT NULL,
  `amount` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deliveryboy_amount`
--

INSERT INTO `deliveryboy_amount` (`id`, `amount`) VALUES
(1, '100');

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
  `options` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filter_options`
--

INSERT INTO `filter_options` (`id`, `filter_id`, `options`) VALUES
(1, 1, 'Shampoos '),
(2, 1, 'Conditioners'),
(3, 1, 'Oils '),
(4, 1, 'Cream '),
(5, 1, 'Serum Shampoos '),
(6, 1, 'Conditioners'),
(7, 1, 'Dermitaligically tested '),
(8, 1, 'Serum'),
(9, 2, 'All Natual '),
(10, 2, 'Herbal'),
(11, 2, 'Checmical free'),
(12, 2, 'Cilinically proven');

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

--
-- Dumping data for table `guest_users`
--

INSERT INTO `guest_users` (`id`, `location`, `lat`, `lng`, `created_date`) VALUES
(1, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285302', '83.3055082', '2021-10-18 06:27:20'),
(2, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285302', '83.3055082', '2021-10-18 06:27:20'),
(3, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285302', '83.3055082', '2021-10-18 06:27:35'),
(4, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285302', '83.3055082', '2021-10-18 06:27:35'),
(5, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285302', '83.3055082', '2021-10-18 06:27:43'),
(6, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285302', '83.3055082', '2021-10-18 06:27:43'),
(7, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285288', '83.3054962', '2021-10-18 06:30:12'),
(8, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285341', '83.3055073', '2021-10-18 06:32:41'),
(9, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285341', '83.3055073', '2021-10-18 06:32:58'),
(10, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285325', '83.305507', '2021-10-18 06:53:48'),
(11, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285325', '83.305507', '2021-10-18 06:53:48'),
(12, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.728539', '83.3055097', '2021-10-18 07:16:49'),
(13, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.728539', '83.3055097', '2021-10-18 07:16:49'),
(14, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.72853', '83.3055029', '2021-10-18 07:19:08'),
(15, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285397', '83.3054943', '2021-10-19 04:33:24'),
(16, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285397', '83.3054943', '2021-10-19 04:33:24'),
(17, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285397', '83.3055205', '2021-12-17 04:39:33'),
(18, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285397', '83.3055205', '2021-12-17 04:39:33'),
(19, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285444', '83.3055198', '2021-12-17 07:08:32'),
(20, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285159', '83.3055227', '2021-12-17 07:10:12'),
(21, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285159', '83.3055227', '2021-12-17 07:10:12'),
(22, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285184', '83.3055149', '2021-12-17 07:28:28'),
(23, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285184', '83.3055149', '2021-12-17 07:28:28'),
(24, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285444', '83.3055275', '2021-12-17 10:23:54'),
(25, '49-19-10, Sankara Matam Rd, Lalitha Nagar, Akkayyapalem, Visakhapatnam, Andhra Pradesh 530016, India', '17.7324687', '83.3040957', '2021-12-18 04:59:08'),
(26, '49-19-10, Sankara Matam Rd, Lalitha Nagar, Akkayyapalem, Visakhapatnam, Andhra Pradesh 530016, India', '17.7324687', '83.3040957', '2021-12-18 04:59:08'),
(27, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285181', '83.3055062', '2021-12-18 06:34:54'),
(28, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285181', '83.3055062', '2021-12-18 06:34:54'),
(29, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285476', '83.3055296', '2021-12-20 04:50:31'),
(30, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285355', '83.3055285', '2021-12-20 04:53:40'),
(31, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '17.7285349', '83.3055218', '2021-12-20 05:35:52'),
(32, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2021-12-20 05:45:42'),
(33, 'Hyderabad, Telangana, India', '', '', '2021-12-20 05:45:53'),
(34, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2021-12-20 05:50:05'),
(35, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2021-12-20 05:50:06'),
(36, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2021-12-20 05:50:10'),
(37, '1979/83, near Sharadha Theater, Ayodhya Nagar, Laxmi Garden, Sainikpuri, Hyderabad, Telangana 500062, India', '', '', '2021-12-21 12:25:48'),
(38, '1979/83, near Sharadha Theater, Ayodhya Nagar, Laxmi Garden, Sainikpuri, Hyderabad, Telangana 500062, India', '', '', '2021-12-21 12:25:49'),
(39, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2021-12-22 04:50:14'),
(40, 'CX6X+82 Kanuparthipadu, Andhra Pradesh, India', '', '', '2021-12-22 04:53:59'),
(41, 'CX6X+82 Kanuparthipadu, Andhra Pradesh, India', '', '', '2021-12-22 04:53:59'),
(42, 'CX6X+82 Kanuparthipadu, Andhra Pradesh, India', '', '', '2021-12-22 08:03:35'),
(43, 'CX6X+82 Kanuparthipadu, Andhra Pradesh, India', '', '', '2021-12-22 08:03:35'),
(44, 'Vijayawada', '', '', '2021-12-22 08:04:36'),
(45, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-01-05 12:59:41'),
(46, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-01-05 12:59:42'),
(47, 'Dwaraka Nagar, Visakhapatnam, Andhra Pradesh, India', '', '', '2022-01-19 10:09:40'),
(48, 'Dwaraka Nagar, Visakhapatnam, Andhra Pradesh, India', '', '', '2022-01-19 10:13:13'),
(49, 'Dwarakanagar', '', '', '2022-01-19 10:18:13'),
(50, 'Dwaraka Nagar, Visakhapatnam, Andhra Pradesh, India', '', '', '2022-01-19 19:13:08'),
(51, 'Dwarakanagar', '', '', '2022-01-21 08:23:12'),
(52, 'Dwarakanagar ', '', '', '2022-01-21 15:14:31'),
(53, 'P7VM+G7 Visakhapatnam, Andhra Pradesh, India', '', '', '2022-01-22 05:05:59'),
(54, 'P7VM+G7 Visakhapatnam, Andhra Pradesh, India', '', '', '2022-01-22 05:05:59'),
(55, '401, Main Rd, near Gokul Chat, Hashmath Gunj, Subhash Nagar, Badi Chowdi, Punjagutta, Hyderabad, Telangana 500082, India', '', '', '2022-01-22 05:30:01'),
(56, 'Dwaraka Nagar, Visakhapatnam, Andhra Pradesh, India', '', '', '2022-01-22 05:32:56'),
(57, 'Dwarakanagar', '', '', '2022-01-22 05:35:12'),
(58, 'chaitnynanagar door no:53-21-9/1, Seethamadhara, KRM Colony, Maddilapalem, Visakhapatnam, Andhra Pradesh 530013, India', '', '', '2022-01-22 07:34:04'),
(59, 'chaitnynanagar door no:53-21-9/1, Seethamadhara, KRM Colony, Maddilapalem, Visakhapatnam, Andhra Pradesh 530013, India', '', '', '2022-01-22 07:34:04'),
(60, '44-1-16-1(3), Thatichetlapalem Rd, Santhi Nagar, Kailasapuram, Visakhapatnam, Andhra Pradesh 530024, India', '', '', '2022-01-22 07:51:15'),
(61, 'Kakinada, Andhra Pradesh, India', '', '', '2022-01-22 07:51:30'),
(62, '405, 4th Floor, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-01-24 05:26:16'),
(63, 'Dwarakanagar ', '', '', '2022-01-25 11:55:34'),
(64, 'Dwarakanagar ', '', '', '2022-01-27 08:42:47'),
(65, 'De', '', '', '2022-01-27 09:06:57'),
(66, '# 44-1-18, ROAD, Santhi Nagar, Kailasapuram, Visakhapatnam, Andhra Pradesh 530024, India', '', '', '2022-01-27 09:07:08'),
(67, 'Dwaraka Nagar, Visakhapatnam, Andhra Pradesh, India', '', '', '2022-01-27 09:07:52'),
(68, 'Dwarakanagar ', '', '', '2022-01-29 06:22:16'),
(69, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-02-08 04:45:28'),
(70, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-02-09 12:57:11'),
(71, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-02-09 12:57:11'),
(72, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-02-15 08:49:06'),
(73, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-02-15 09:11:41'),
(74, 'Dwarakanagar ', '', '', '2022-02-15 21:38:11'),
(75, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-03-22 13:10:24'),
(76, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-04 05:20:34'),
(77, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-04 05:48:07'),
(78, 'dwarkanagar', '', '', '2022-04-05 04:42:43'),
(79, 'Dwaraka Nagar, Visakhapatnam, Andhra Pradesh, India', '', '', '2022-04-05 08:56:27'),
(80, 'Dwaraka Nagar, Visakhapatnam, Andhra Pradesh, India', '', '', '2022-04-05 09:41:15'),
(81, 'dwarkanagar', '', '', '2022-04-05 10:04:14'),
(82, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-05 11:43:11'),
(83, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-05 11:43:11'),
(84, 'Sri Surya Apartments, Sankara Matam Rd, Madhuranagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-06 11:37:53'),
(85, 'Sri Surya Apartments, Sankara Matam Rd, Madhuranagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-06 11:37:53'),
(86, 'Dwaraka Nagar, Visakhapatnam, Andhra Pradesh, India', '', '', '2022-04-07 05:56:24'),
(87, 'Sri Surya Apartments, Sankara Matam Rd, Madhuranagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-07 13:05:45'),
(88, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-13 09:55:30'),
(89, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-13 09:55:30'),
(90, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-20 07:03:04'),
(91, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-20 07:03:04'),
(92, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-20 09:56:40'),
(93, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-20 09:56:40'),
(94, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-20 12:02:58'),
(95, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-20 12:02:58'),
(96, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-20 12:20:30'),
(97, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-20 12:20:30'),
(98, 'Dwarka Nagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-20 15:29:43'),
(99, 'Dwarka Nagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-20 15:29:43'),
(100, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 08:36:58'),
(101, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 08:36:58'),
(102, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 08:40:52'),
(103, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 08:40:52'),
(104, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 08:42:25'),
(105, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 08:42:25'),
(106, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 08:43:28'),
(107, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 08:43:28'),
(108, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 08:44:51'),
(109, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 08:44:51'),
(110, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 08:49:00'),
(111, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 08:49:00'),
(112, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 08:50:16'),
(113, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 08:50:16'),
(114, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 08:52:02'),
(115, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 08:52:02'),
(116, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:02:03'),
(117, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:02:03'),
(118, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:03:23'),
(119, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:03:23'),
(120, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:07:36'),
(121, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:07:36'),
(122, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:08:45'),
(123, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:08:45'),
(124, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:10:17'),
(125, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:10:39'),
(126, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:14:38'),
(127, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:14:38'),
(128, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:18:35'),
(129, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:18:35'),
(130, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:20:38'),
(131, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:20:39'),
(132, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:22:22'),
(133, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:22:22'),
(134, 'Dwarka Nagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:25:22'),
(135, 'Dwarka Nagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:25:22'),
(136, 'Dwarka, Gujarat, India', '', '', '2022-04-21 09:25:51'),
(137, 'Dwarka Nagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:29:54'),
(138, 'Dwarka Nagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:29:54'),
(139, 'Dwarka Nagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:34:01'),
(140, 'Dwarka Nagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:34:02'),
(141, 'Dwarka Nagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:34:59'),
(142, 'Dwarka Nagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:34:59'),
(143, 'Dwarka Nagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:35:20'),
(144, 'Dwarka Nagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:35:20'),
(145, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:36:03'),
(146, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:36:03'),
(147, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:37:03'),
(148, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:37:03'),
(149, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:38:49'),
(150, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:38:49'),
(151, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:39:04'),
(152, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:39:04'),
(153, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:53:34'),
(154, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 09:53:34'),
(155, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:51:11'),
(156, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:51:11'),
(157, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:51:51'),
(158, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:51:51'),
(159, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:51:52'),
(160, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:51:52'),
(161, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:51:53'),
(162, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:51:54'),
(163, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:51:54'),
(164, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:51:55'),
(165, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:51:55'),
(166, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:51:56'),
(167, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:51:56'),
(168, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:51:58'),
(169, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:51:58'),
(170, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:51:59'),
(171, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:51:59'),
(172, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:52:00'),
(173, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:52:01'),
(174, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:52:01'),
(175, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:52:03'),
(176, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:52:03'),
(177, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:52:04'),
(178, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:52:05'),
(179, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:52:06'),
(180, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:52:07'),
(181, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:52:07'),
(182, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:52:08'),
(183, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:52:08'),
(184, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:52:09'),
(185, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:52:09'),
(186, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:12'),
(187, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:12'),
(188, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:13'),
(189, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:14'),
(190, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:15'),
(191, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:15'),
(192, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:16'),
(193, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:16'),
(194, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:17'),
(195, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:17'),
(196, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:18'),
(197, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:19'),
(198, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:19'),
(199, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:20'),
(200, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:20'),
(201, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:21'),
(202, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:21'),
(203, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:21'),
(204, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:22'),
(205, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:23'),
(206, '10, 5th Ln, Pincode:, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:23'),
(207, 'SVS Towers, Sankara Matam Rd, Lalitha Nagar, Akkayyapalem, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:52'),
(208, 'SVS Towers, Sankara Matam Rd, Lalitha Nagar, Akkayyapalem, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:53:52'),
(209, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:36'),
(210, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:36'),
(211, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:37'),
(212, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:37'),
(213, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:38'),
(214, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:39'),
(215, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:39'),
(216, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:40'),
(217, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:40'),
(218, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:41'),
(219, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:41'),
(220, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:42'),
(221, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:42'),
(222, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:43'),
(223, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:43'),
(224, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:44'),
(225, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:44'),
(226, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:44'),
(227, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:45'),
(228, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:45'),
(229, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:46'),
(230, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:47'),
(231, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:47'),
(232, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:48'),
(233, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:48'),
(234, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:49'),
(235, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:50'),
(236, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:50'),
(237, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:50'),
(238, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:51'),
(239, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:51'),
(240, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:51'),
(241, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:53'),
(242, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:53'),
(243, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:54'),
(244, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:54'),
(245, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:54'),
(246, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:55'),
(247, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:56'),
(248, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:56'),
(249, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:57'),
(250, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 10:54:57'),
(251, 'Dhatu Nagar, Hashmath Gunj, Subhash Nagar, Badi Chowdi, Kachiguda, Hyderabad, Telangana 500095, India', '', '', '2022-04-21 10:58:43'),
(252, 'Dhatu Nagar, Hashmath Gunj, Subhash Nagar, Badi Chowdi, Kachiguda, Hyderabad, Telangana 500095, India', '', '', '2022-04-21 10:58:43'),
(253, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 11:05:26'),
(254, '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-21 11:05:26'),
(255, 'Death Valley, CA, USA', '', '', '2022-04-21 11:05:35'),
(256, 'Dwaraka Nagar, Visakhapatnam, Andhra Pradesh, India', '', '', '2022-04-22 07:06:54'),
(257, 'P8H4+C55, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-22 07:32:20'),
(258, 'P8H4+C55, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-22 07:32:20'),
(259, 'Dwaraka Nagar, Visakhapatnam, Andhra Pradesh, India', '', '', '2022-04-22 12:11:29'),
(260, 'Dwaraka Nagar, Visakhapatnam, Andhra Pradesh, India', '', '', '2022-04-22 12:33:23'),
(261, 'Qtr. No. 409, Sector-4, Sector 1, Steel Plant Twp, Visakhapatnam, Andhra Pradesh 530032, India', '', '', '2022-04-22 16:17:11'),
(262, 'Qtr. No. 409, Sector-4, Sector 1, Steel Plant Twp, Visakhapatnam, Andhra Pradesh 530032, India', '', '', '2022-04-22 16:17:11'),
(263, 'Dwaraka Nagar, Visakhapatnam, Andhra Pradesh, India', '', '', '2022-04-23 04:52:58'),
(264, 'P8H4+C55, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-23 05:38:25'),
(265, 'P8H4+C55, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-23 05:38:25'),
(266, 'Dwaraka Nagar, Visakhapatnam, Andhra Pradesh, India', '', '', '2022-04-23 05:57:55'),
(267, '8C7M+6V8, Koritepadu, Guntur, Andhra Pradesh 522007, India', '', '', '2022-04-23 07:05:41'),
(268, '501, Bharath Towers, beside tilak showroom, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-23 07:05:46'),
(269, '501, Bharath Towers, beside tilak showroom, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-23 07:05:46'),
(270, 'telecom nagar 6th line, Amaravathi Rd, Bharath Peta, Panduranga Nagar, Guntur, Andhra Pradesh 522034, India', '', '', '2022-04-24 05:16:45'),
(271, 'telecom nagar 6th line, Amaravathi Rd, Bharath Peta, Panduranga Nagar, Guntur, Andhra Pradesh 522034, India', '', '', '2022-04-24 05:16:45'),
(272, 'Capsicon Enclave, 2nd Cross Dasarahalli, behind BBMP Office, Fortune Valley, Dasarahalli, Bengaluru, Karnataka 560045, India', '', '', '2022-04-24 05:42:56'),
(273, 'Capsicon Enclave, 2nd Cross Dasarahalli, behind BBMP Office, Fortune Valley, Dasarahalli, Bengaluru, Karnataka 560045, India', '', '', '2022-04-24 05:42:56'),
(274, 'telecom nagar 6th line, Amaravathi Rd, Bharath Peta, Panduranga Nagar, Guntur, Andhra Pradesh 522007, India', '', '', '2022-04-25 12:27:41'),
(275, 'telecom nagar 6th line, Amaravathi Rd, Bharath Peta, Panduranga Nagar, Guntur, Andhra Pradesh 522007, India', '', '', '2022-04-25 12:27:41'),
(276, 'Dwaraka Nagar, Visakhapatnam, Andhra Pradesh, India', '', '', '2022-04-26 12:27:51'),
(277, 'Capsicon Enclave, 2nd Cross Dasarahalli, behind BBMP Office, Fortune Valley, Dasarahalli, Bengaluru, Karnataka 560045, India', '', '', '2022-04-26 15:02:15'),
(278, 'Capsicon Enclave, 2nd Cross Dasarahalli, behind BBMP Office, Fortune Valley, Dasarahalli, Bengaluru, Karnataka 560045, India', '', '', '2022-04-26 15:02:15'),
(279, 'Paridhi Alpha, No. 39 & 40, Mariyannapalya, Rachenahalli, 1st Cross Rd, Defense Layout, Stage 1, Thanisandra, Bengaluru, Karnataka 560024, India', '', '', '2022-04-26 15:03:31'),
(280, 'Paridhi Alpha, No. 39 & 40, Mariyannapalya, Rachenahalli, 1st Cross Rd, Defense Layout, Stage 1, Thanisandra, Bengaluru, Karnataka 560024, India', '', '', '2022-04-26 15:03:31'),
(281, 'Dwaraka Nagar, Visakhapatnam, Andhra Pradesh, India', '', '', '2022-04-27 04:25:55'),
(282, 'Dwaraka Nagar, Visakhapatnam, Andhra Pradesh, India', '', '', '2022-04-28 13:25:14'),
(283, 'Capsicon Enclave, 2nd Cross Dasarahalli, behind BBMP Office, Fortune Valley, Dasarahalli, Bengaluru, Karnataka 560045, India', '', '', '2022-04-28 16:23:08'),
(284, 'Capsicon Enclave, 2nd Cross Dasarahalli, behind BBMP Office, Fortune Valley, Dasarahalli, Bengaluru, Karnataka 560045, India', '', '', '2022-04-28 16:23:08'),
(285, 'Dwarka Nagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-29 05:35:02'),
(286, 'Dwarka Nagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-29 05:35:02'),
(287, 'Dwaraka Nagar, Visakhapatnam, Andhra Pradesh, India', '', '', '2022-04-29 05:35:14'),
(288, 'P8H4+C55, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-29 08:37:43'),
(289, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-04-30 04:39:01'),
(290, 'Dwarka Nagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-05-02 06:47:07'),
(291, 'Dwarka Nagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-05-02 06:47:07'),
(292, '2JX9+Q6R, Defence Enclave, Mariyannapalya, Hebbal Kempapura, Bengaluru, Karnataka 560024, India', '', '', '2022-05-02 13:34:09'),
(293, '2JX9+Q6R, Defence Enclave, Mariyannapalya, Hebbal Kempapura, Bengaluru, Karnataka 560024, India', '', '', '2022-05-02 13:34:09'),
(294, 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-05-04 05:42:25'),
(295, 'P8H4+C55, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-05-04 08:54:24'),
(296, 'P8H4+C55, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-05-04 08:54:24'),
(297, 'Dwarka Nagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-05-04 09:10:27'),
(298, 'Dwarka Nagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-05-04 09:10:27'),
(299, 'P8H4+C55, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-05-04 09:11:10'),
(300, 'P8H4+C55, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-05-04 09:11:11'),
(301, 'P8H4+C55, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-05-04 09:12:17'),
(302, 'P8H4+C55, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-05-04 09:12:17'),
(303, 'P8H4+C55, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-05-04 10:14:18'),
(304, 'P8H4+C55, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-05-04 10:14:18'),
(305, 'Dwarka Nagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-05-04 10:18:57'),
(306, 'Dwarka Nagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-05-04 10:18:57'),
(307, 'Dwarka Nagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-05-04 10:19:24'),
(308, 'Dwarka Nagar, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India', '', '', '2022-05-04 10:19:24');

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
(1, 1, '300', 200, '47', '', '1623744975', '', 1, '', '', ''),
(2, 2, '300', 150, '49', '', '1623745197', '', 1, '', '', ''),
(3, 3, '400', 123, '70', '', '1623745303', '', 1, '', '', ''),
(4, 5, '300', 200, '0', '', '1623905699', '', 1, '', '', ''),
(5, 6, '89', 59, '183', '', '1623905882', '', 1, '', '', ''),
(6, 7, '120', 100, '99', '', '1623906001', '', 1, '', '', ''),
(7, 8, '200', 150, '199', '', '1623906128', '', 1, '', '', ''),
(8, 9, '99', 59, '250', '', '1623906224', '', 1, '', '', ''),
(9, 10, '1000', 900, '100', '', '1629198286', '', 1, '', '', ''),
(10, 11, '1000', 900, '100', '', '1629198584', '', 1, '', '', ''),
(11, 13, '1000', 900, '100', '', '1629200121', '', 1, '', '', ''),
(12, 16, '', 0, '', '[{\"attribute_type\":\"1\",\"attribute_value\":\"1\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"1\\\",\\\"attribute_value\\\":\\\"1\\\"}]\"', '', ''),
(38, 17, '', 0, '', '[{\"attribute_type\":\"1\",\"attribute_value\":\"1\"}]', '', '', 1, '', '', ''),
(20, 21, '', 0, '', '[{\"attribute_type\":\"1\",\"attribute_value\":\"1\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"1\\\",\\\"attribute_value\\\":\\\"1\\\"}]\"', '', ''),
(14, 18, '', 0, '', '[{\"attribute_type\":\"1\",\"attribute_value\":\"1\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"1\\\",\\\"attribute_value\\\":\\\"1\\\"}]\"', '', ''),
(17, 19, '', 0, '', '[{\"attribute_type\":\"1\",\"attribute_value\":\"1\"}]', '', '', 1, '', '', ''),
(19, 20, '350', 300, '25', '[{\"attribute_type\":\"1\",\"attribute_value\":\"1\"}]', '', '', 1, '', '', ''),
(22, 22, '', 0, '', '[{\"attribute_type\":\"1\",\"attribute_value\":\"1\"}]', '', '', 1, '', '', ''),
(23, 23, '', 0, '', '[{\"attribute_type\":\"1\",\"attribute_value\":\"1\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"1\\\",\\\"attribute_value\\\":\\\"1\\\"}]\"', '', ''),
(25, 25, '', 0, '', '[{\"attribute_type\":\"1\",\"attribute_value\":\"1\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"1\\\",\\\"attribute_value\\\":\\\"1\\\"}]\"', '', ''),
(26, 26, '', 0, '', '[{\"attribute_type\":\"1\",\"attribute_value\":\"1\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"1\\\",\\\"attribute_value\\\":\\\"1\\\"}]\"', '', ''),
(27, 27, '', 0, '', '[{\"attribute_type\":\"1\",\"attribute_value\":\"1\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"1\\\",\\\"attribute_value\\\":\\\"1\\\"}]\"', '', ''),
(34, 28, '', 0, '', '[{\"attribute_type\":\"1\",\"attribute_value\":\"1\"}]', '', '', 1, '', '', ''),
(35, 34, '', 0, '', '[{\"attribute_type\":\"1\",\"attribute_value\":\"1\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"1\\\",\\\"attribute_value\\\":\\\"1\\\"}]\"', '', ''),
(29, 29, '450', 400, '100', '', '1632921836', '', 1, '', '', ''),
(30, 30, '', 0, '', '[{\"attribute_type\":\"1\",\"attribute_value\":\"1\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"1\\\",\\\"attribute_value\\\":\\\"1\\\"}]\"', '', ''),
(32, 31, '', 0, '', '[{\"attribute_type\":\"1\",\"attribute_value\":\"1\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"1\\\",\\\"attribute_value\\\":\\\"1\\\"}]\"', '', ''),
(33, 33, '', 0, '', '[{\"attribute_type\":\"1\",\"attribute_value\":\"1\"}]', '', '', 1, '', '', ''),
(36, 35, '', 0, '', '[{\"attribute_type\":\"1\",\"attribute_value\":\"1\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"1\\\",\\\"attribute_value\\\":\\\"1\\\"}]\"', '', ''),
(13293, 37, '', 0, '', '[{\"attribute_type\":\"2\",\"attribute_value\":\"2\"}]', '', '', 0, '', '', ''),
(13299, 38, '', 0, '', '[{\"attribute_type\":\"2\",\"attribute_value\":\"2\"}]', '', '', 1, '', '', ''),
(13300, 38, '', 0, '', '[{\"attribute_type\":\"2\",\"attribute_value\":\"25\"}]', '', '', 1, '', '', ''),
(13301, 39, '', 0, '', '[{\"attribute_type\":\"9\",\"attribute_value\":\"36\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"9\\\",\\\"attribute_value\\\":\\\"36\\\"}]\"', '', ''),
(13302, 39, '', 0, '', '[{\"attribute_type\":\"9\",\"attribute_value\":\"37\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"9\\\",\\\"attribute_value\\\":\\\"37\\\"}]\"', '', ''),
(13303, 39, '', 0, '', '[{\"attribute_type\":\"9\",\"attribute_value\":\"38\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"9\\\",\\\"attribute_value\\\":\\\"38\\\"}]\"', '', ''),
(13306, 40, '', 0, '', '[{\"attribute_type\":\"10\",\"attribute_value\":\"41\"}]', '', '', 1, '', '', ''),
(13307, 40, '', 0, '', '[{\"attribute_type\":\"10\",\"attribute_value\":\"42\"}]', '', '', 0, '', '', ''),
(13308, 41, '', 0, '', '[{\"attribute_type\":\"10\",\"attribute_value\":\"41\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"10\\\",\\\"attribute_value\\\":\\\"41\\\"}]\"', '', ''),
(13309, 42, '', 0, '', '[{\"attribute_type\":\"8\",\"attribute_value\":\"31\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"8\\\",\\\"attribute_value\\\":\\\"31\\\"}]\"', '', ''),
(13310, 43, '', 0, '', '[{\"attribute_type\":\"8\",\"attribute_value\":\"31\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"8\\\",\\\"attribute_value\\\":\\\"31\\\"}]\"', '', ''),
(13311, 44, '', 0, '', '[{\"attribute_type\":\"8\",\"attribute_value\":\"31\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"8\\\",\\\"attribute_value\\\":\\\"31\\\"}]\"', '', ''),
(13312, 45, '', 0, '', '[{\"attribute_type\":\"8\",\"attribute_value\":\"31\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"8\\\",\\\"attribute_value\\\":\\\"31\\\"}]\"', '', ''),
(13314, 47, '', 0, '', '[{\"attribute_type\":\"2\",\"attribute_value\":\"2\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"2\\\",\\\"attribute_value\\\":\\\"2\\\"}]\"', '', ''),
(13315, 48, '', 0, '', '[{\"attribute_type\":\"2\",\"attribute_value\":\"25\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"2\\\",\\\"attribute_value\\\":\\\"25\\\"}]\"', '', ''),
(13322, 49, '', 0, '', '[{\"attribute_type\":\"9\",\"attribute_value\":\"36\"}]', '', '', 1, '', '', ''),
(13317, 50, '', 0, '', '[{\"attribute_type\":\"9\",\"attribute_value\":\"36\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"9\\\",\\\"attribute_value\\\":\\\"36\\\"}]\"', '', ''),
(13318, 52, '', 0, '', '[{\"attribute_type\":\"9\",\"attribute_value\":\"36\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"9\\\",\\\"attribute_value\\\":\\\"36\\\"}]\"', '', ''),
(13337, 54, '', 0, '', '[{\"attribute_type\":\"9\",\"attribute_value\":\"40\"}]', '', '', 0, '\"[{\\\"attribute_type\\\":\\\"9\\\",\\\"attribute_value\\\":\\\"40\\\"}]\"', '', ''),
(13336, 54, '', 0, '', '[{\"attribute_type\":\"9\",\"attribute_value\":\"39\"}]', '', '', 0, '\"[{\\\"attribute_type\\\":\\\"9\\\",\\\"attribute_value\\\":\\\"39\\\"}]\"', '', ''),
(13334, 54, '', 0, '', '[{\"attribute_type\":\"9\",\"attribute_value\":\"37\"}]', '', '', 0, '\"[{\\\"attribute_type\\\":\\\"9\\\",\\\"attribute_value\\\":\\\"37\\\"}]\"', '', ''),
(13335, 54, '', 0, '', '[{\"attribute_type\":\"9\",\"attribute_value\":\"38\"}]', '', '', 0, '\"[{\\\"attribute_type\\\":\\\"9\\\",\\\"attribute_value\\\":\\\"38\\\"}]\"', '', ''),
(13332, 53, '', 0, '', '[{\"attribute_type\":\"9\",\"attribute_value\":\"40\"}]', '', '', 0, '\"[{\\\"attribute_type\\\":\\\"9\\\",\\\"attribute_value\\\":\\\"40\\\"}]\"', '', ''),
(13333, 54, '250', 200, '8', '[{\"attribute_type\":\"9\",\"attribute_value\":\"36\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"9\\\",\\\"attribute_value\\\":\\\"36\\\"}]\"', '', ''),
(13323, 24, '', 0, '', '[{\"attribute_type\":\"9\",\"attribute_value\":\"36\"}]', '', '', 1, '', '', ''),
(13324, 24, '', 0, '', '[{\"attribute_type\":\"9\",\"attribute_value\":\"37\"}]', '', '', 0, '', '', ''),
(13325, 24, '', 0, '', '[{\"attribute_type\":\"9\",\"attribute_value\":\"38\"}]', '', '', 0, '', '', ''),
(13326, 24, '', 0, '', '[{\"attribute_type\":\"9\",\"attribute_value\":\"39\"}]', '', '', 0, '', '', ''),
(13327, 24, '', 0, '', '[{\"attribute_type\":\"9\",\"attribute_value\":\"40\"}]', '', '', 0, '', '', ''),
(13328, 53, '', 0, '', '[{\"attribute_type\":\"9\",\"attribute_value\":\"36\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"9\\\",\\\"attribute_value\\\":\\\"36\\\"}]\"', '', ''),
(13329, 53, '', 0, '', '[{\"attribute_type\":\"9\",\"attribute_value\":\"37\"}]', '', '', 0, '\"[{\\\"attribute_type\\\":\\\"9\\\",\\\"attribute_value\\\":\\\"37\\\"}]\"', '', ''),
(13330, 53, '', 0, '', '[{\"attribute_type\":\"9\",\"attribute_value\":\"38\"}]', '', '', 0, '\"[{\\\"attribute_type\\\":\\\"9\\\",\\\"attribute_value\\\":\\\"38\\\"}]\"', '', ''),
(13331, 53, '', 0, '', '[{\"attribute_type\":\"9\",\"attribute_value\":\"39\"}]', '', '', 0, '\"[{\\\"attribute_type\\\":\\\"9\\\",\\\"attribute_value\\\":\\\"39\\\"}]\"', '', ''),
(13338, 56, '1000', 800, '80', '', '1650628256', '', 1, '', '', ''),
(13339, 55, '1000', 800, '100', '[{\"attribute_type\":\"1\",\"attribute_value\":\"1\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"1\\\",\\\"attribute_value\\\":\\\"1\\\"}]\"', '', ''),
(13340, 55, '', 0, '', '[{\"attribute_type\":\"1\",\"attribute_value\":\"20\"}]', '', '', 0, '\"[{\\\"attribute_type\\\":\\\"1\\\",\\\"attribute_value\\\":\\\"20\\\"}]\"', '', ''),
(13341, 55, '', 0, '', '[{\"attribute_type\":\"1\",\"attribute_value\":\"21\"}]', '', '', 0, '\"[{\\\"attribute_type\\\":\\\"1\\\",\\\"attribute_value\\\":\\\"21\\\"}]\"', '', ''),
(13343, 57, '450', 429, '6', '[{\"attribute_type\":\"1\",\"attribute_value\":\"1\"}]', '', '', 1, '', '', ''),
(13344, 58, '518', 500, '19', '[{\"attribute_type\":\"2\",\"attribute_value\":\"2\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"2\\\",\\\"attribute_value\\\":\\\"2\\\"}]\"', '', ''),
(13345, 59, '399', 359, '10', '[{\"attribute_type\":\"2\",\"attribute_value\":\"25\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"2\\\",\\\"attribute_value\\\":\\\"25\\\"}]\"', '', ''),
(13346, 60, '1000', 900, '108', '[{\"attribute_type\":\"1\",\"attribute_value\":\"1\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"1\\\",\\\"attribute_value\\\":\\\"1\\\"}]\"', '', ''),
(13347, 60, '', 0, '', '[{\"attribute_type\":\"1\",\"attribute_value\":\"20\"}]', '', '', 0, '\"[{\\\"attribute_type\\\":\\\"1\\\",\\\"attribute_value\\\":\\\"20\\\"}]\"', '', ''),
(13348, 60, '', 0, '', '[{\"attribute_type\":\"1\",\"attribute_value\":\"21\"}]', '', '', 0, '\"[{\\\"attribute_type\\\":\\\"1\\\",\\\"attribute_value\\\":\\\"21\\\"}]\"', '', ''),
(13349, 61, '565', 560, '30', '[{\"attribute_type\":\"1\",\"attribute_value\":\"20\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"1\\\",\\\"attribute_value\\\":\\\"20\\\"}]\"', '', ''),
(13350, 62, '43', 23, '22', '[{\"attribute_type\":\"1\",\"attribute_value\":\"20\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"1\\\",\\\"attribute_value\\\":\\\"20\\\"}]\"', '', ''),
(13351, 62, '313', 233, '123', '[{\"attribute_type\":\"1\",\"attribute_value\":\"21\"}]', '', '', 1, '\"[{\\\"attribute_type\\\":\\\"1\\\",\\\"attribute_value\\\":\\\"21\\\"}]\"', '', '');

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
(130, 1, '6', 0, '1634019964', ''),
(129, 1, '5', 0, '1634019964', ''),
(128, 1, '4', 0, '1634019964', ''),
(127, 1, '3', 0, '1634019964', ''),
(126, 1, '1', 0, '1634019964', ''),
(23, 2, '1', 0, '1633425767', ''),
(24, 2, '3', 0, '1633425767', ''),
(25, 2, '4', 0, '1633425767', ''),
(26, 2, '5', 0, '1633425767', ''),
(27, 2, '6', 0, '1633425767', ''),
(28, 2, '7', 0, '1633425767', ''),
(29, 2, '8', 0, '1633425767', ''),
(30, 2, '9', 0, '1633425767', ''),
(31, 2, '10', 0, '1633425767', ''),
(32, 2, '11', 0, '1633425767', ''),
(33, 8, '1', 0, '1633425800', ''),
(34, 8, '3', 0, '1633425800', ''),
(35, 8, '4', 0, '1633425800', ''),
(36, 8, '5', 0, '1633425800', ''),
(37, 8, '6', 0, '1633425800', ''),
(38, 8, '7', 0, '1633425800', ''),
(39, 8, '8', 0, '1633425800', ''),
(40, 8, '9', 0, '1633425800', ''),
(41, 8, '10', 0, '1633425800', ''),
(42, 8, '11', 0, '1633425800', ''),
(43, 7, '1', 0, '1633425833', ''),
(44, 7, '3', 0, '1633425833', ''),
(45, 7, '4', 0, '1633425833', ''),
(46, 7, '5', 0, '1633425833', ''),
(47, 7, '6', 0, '1633425833', ''),
(48, 7, '7', 0, '1633425833', ''),
(49, 7, '8', 0, '1633425833', ''),
(50, 7, '9', 0, '1633425833', ''),
(51, 7, '10', 0, '1633425833', ''),
(52, 7, '11', 0, '1633425833', ''),
(53, 9, '1', 0, '1633425856', ''),
(54, 9, '3', 0, '1633425856', ''),
(55, 9, '4', 0, '1633425856', ''),
(56, 9, '5', 0, '1633425856', ''),
(57, 9, '6', 0, '1633425856', ''),
(58, 9, '7', 0, '1633425856', ''),
(59, 9, '8', 0, '1633425856', ''),
(60, 9, '9', 0, '1633425856', ''),
(61, 9, '10', 0, '1633425856', ''),
(62, 9, '11', 0, '1633425856', ''),
(63, 10, '1', 0, '1633425884', ''),
(64, 10, '3', 0, '1633425884', ''),
(65, 10, '4', 0, '1633425884', ''),
(66, 10, '5', 0, '1633425884', ''),
(67, 10, '6', 0, '1633425884', ''),
(68, 10, '7', 0, '1633425884', ''),
(69, 10, '8', 0, '1633425884', ''),
(70, 10, '9', 0, '1633425884', ''),
(71, 10, '10', 0, '1633425884', ''),
(72, 10, '11', 0, '1633425884', ''),
(125, 1, '11', 0, '', '1633426649'),
(124, 1, '10', 0, '', '1633426649'),
(123, 1, '9', 0, '', '1633426649'),
(122, 1, '8', 0, '', '1633426649'),
(121, 1, '7', 0, '', '1633426649'),
(120, 1, '6', 0, '', '1633426649'),
(119, 1, '5', 0, '', '1633426649'),
(118, 1, '4', 0, '', '1633426649'),
(117, 1, '3', 0, '', '1633426649'),
(116, 1, '1', 0, '', '1633426649'),
(131, 1, '12', 0, '1650628315', ''),
(132, 1, '14', 0, '1650634287', ''),
(133, 2, '13', 0, '1650635001', ''),
(134, 2, '15', 0, '1650636816', '');

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
(1, 1, 0, 0),
(2, 2, 0, 0),
(3, 1, 0, 0),
(4, 1, 0, 0),
(5, 2, 0, 0),
(6, 2, 0, 0),
(7, 5, 0, 0),
(8, 5, 0, 0),
(9, 5, 0, 0),
(10, 9, 0, 0),
(11, 9, 0, 0),
(12, 5, 0, 0),
(13, 9, 0, 0),
(14, 9, 0, 0),
(15, 5, 0, 0),
(16, 5, 0, 0),
(17, 2, 0, 0),
(18, 5, 0, 0),
(19, 9, 0, 0),
(20, 5, 0, 0),
(21, 5, 0, 0),
(22, 5, 0, 0),
(23, 5, 0, 0),
(24, 5, 0, 0),
(25, 5, 0, 0),
(26, 9, 0, 0),
(27, 5, 0, 0),
(28, 1, 0, 0),
(29, 5, 0, 0),
(30, 5, 0, 0),
(31, 1, 0, 0),
(32, 1, 0, 0),
(33, 9, 0, 0),
(34, 9, 0, 0),
(35, 9, 0, 0),
(36, 5, 0, 0),
(37, 5, 0, 0),
(38, 5, 0, 0),
(39, 1, 0, 0),
(40, 5, 0, 0),
(41, 1, 0, 0),
(42, 5, 0, 0),
(43, 9, 0, 0),
(44, 9, 0, 0),
(45, 1, 0, 0),
(46, 6, 0, 0),
(47, 9, 0, 0),
(48, 6, 0, 0),
(49, 6, 0, 0),
(50, 1, 0, 0),
(51, 2, 0, 0),
(52, 6, 0, 0),
(53, 1, 0, 0),
(54, 3, 0, 0),
(55, 1, 0, 0),
(56, 2, 0, 0),
(57, 9, 0, 0),
(58, 2, 0, 0),
(59, 2, 0, 0),
(60, 2, 0, 0),
(61, 1, 0, 0),
(62, 3, 0, 0),
(63, 3, 0, 0),
(64, 6, 0, 0),
(65, 3, 0, 0),
(66, 7, 0, 0),
(67, 9, 0, 0),
(68, 6, 0, 0),
(69, 5, 0, 0),
(70, 2, 0, 0),
(71, 1, 0, 0),
(72, 3, 0, 0),
(73, 3, 0, 0),
(74, 6, 0, 0),
(75, 3, 0, 0),
(76, 9, 0, 0),
(77, 1, 0, 0),
(78, 2, 0, 0),
(79, 1, 0, 0),
(80, 8, 0, 0),
(81, 5, 0, 0),
(82, 5, 0, 0),
(83, 5, 0, 0),
(84, 9, 0, 0),
(85, 5, 0, 0),
(86, 5, 0, 0),
(87, 5, 0, 0),
(88, 6, 0, 0),
(89, 5, 0, 0),
(90, 3, 0, 0),
(91, 1, 0, 0),
(92, 6, 0, 0),
(93, 1, 0, 0),
(94, 5, 0, 0),
(95, 5, 0, 0),
(96, 5, 0, 0),
(97, 2, 0, 0),
(98, 1, 0, 0),
(99, 2, 0, 0),
(100, 6, 0, 0),
(101, 5, 0, 0),
(102, 1, 0, 0),
(103, 6, 0, 0),
(104, 2, 0, 0),
(105, 5, 0, 0),
(106, 5, 0, 0),
(107, 0, 0, 0),
(108, 0, 0, 0),
(109, 0, 0, 0),
(110, 0, 0, 0),
(111, 9, 0, 0),
(112, 0, 0, 0),
(113, 0, 0, 0),
(114, 0, 0, 0),
(115, 0, 0, 0),
(116, 2, 0, 0),
(117, 5, 0, 0),
(118, 1, 0, 0),
(119, 0, 0, 0),
(120, 2, 0, 0),
(121, 9, 0, 0),
(122, 2, 0, 0),
(123, 5, 0, 0),
(124, 0, 0, 0),
(125, 0, 0, 0),
(126, 0, 0, 0),
(127, 0, 0, 0),
(128, 5, 0, 0),
(129, 5, 0, 0),
(130, 5, 0, 0),
(131, 9, 0, 0),
(132, 9, 0, 0),
(133, 16, 0, 0),
(134, 16, 0, 0),
(135, 16, 0, 0),
(136, 16, 0, 0),
(137, 19, 0, 0),
(138, 16, 0, 0),
(139, 0, 0, 0),
(140, 18, 0, 0),
(141, 19, 0, 0),
(142, 0, 0, 0),
(143, 5, 0, 0),
(144, 16, 0, 0),
(145, 16, 0, 0),
(146, 16, 0, 0),
(147, 16, 0, 0),
(148, 16, 0, 0),
(149, 16, 0, 0),
(150, 16, 0, 0),
(151, 5, 0, 0),
(152, 9, 0, 0),
(153, 9, 0, 0),
(154, 16, 0, 0),
(155, 16, 0, 0),
(156, 19, 0, 0),
(157, 16, 0, 0),
(158, 16, 0, 0),
(159, 16, 0, 0),
(160, 16, 0, 0),
(161, 5, 0, 0),
(162, 18, 0, 0),
(163, 16, 0, 0),
(164, 16, 0, 0),
(165, 16, 0, 0),
(166, 16, 0, 0),
(167, 3, 0, 0),
(168, 19, 0, 0),
(169, 16, 0, 0),
(170, 16, 0, 0),
(171, 16, 0, 0),
(172, 19, 0, 0),
(173, 16, 0, 0),
(174, 16, 0, 0),
(175, 16, 0, 0),
(176, 18, 0, 0),
(177, 18, 0, 0),
(178, 18, 0, 0),
(179, 18, 0, 0),
(180, 18, 0, 0),
(181, 18, 0, 0),
(182, 18, 0, 0),
(183, 0, 0, 0),
(184, 19, 0, 0),
(185, 5, 0, 0),
(186, 5, 0, 0),
(187, 5, 0, 0),
(188, 9, 0, 0),
(189, 5, 0, 0),
(190, 16, 0, 0),
(191, 9, 0, 0),
(192, 18, 0, 0),
(193, 18, 0, 0),
(194, 18, 0, 0),
(195, 18, 0, 0),
(196, 19, 0, 0),
(197, 19, 0, 0),
(198, 0, 0, 0),
(199, 19, 0, 0),
(200, 18, 0, 0),
(201, 18, 0, 0),
(202, 5, 0, 0),
(203, 9, 0, 0),
(204, 5, 0, 0),
(205, 5, 0, 0),
(206, 5, 0, 0),
(207, 5, 0, 0),
(208, 18, 0, 0),
(209, 5, 0, 0),
(210, 5, 0, 0),
(211, 5, 0, 0),
(212, 5, 0, 0),
(213, 5, 0, 0),
(214, 5, 0, 0),
(215, 18, 0, 0),
(216, 18, 0, 0),
(217, 18, 0, 0),
(218, 18, 0, 0),
(219, 18, 0, 0),
(220, 18, 0, 0),
(221, 18, 0, 0),
(222, 18, 0, 0),
(223, 18, 0, 0),
(224, 18, 0, 0),
(225, 18, 0, 0),
(226, 19, 0, 0),
(227, 3, 0, 0),
(228, 16, 0, 0),
(229, 19, 0, 0),
(230, 19, 0, 0),
(231, 19, 0, 0),
(232, 16, 0, 0),
(233, 1, 0, 0),
(234, 16, 0, 0),
(235, 16, 0, 0),
(236, 16, 0, 0),
(237, 16, 0, 0),
(238, 16, 0, 0),
(239, 16, 0, 0),
(240, 18, 0, 0),
(241, 19, 0, 0),
(242, 16, 0, 0),
(243, 19, 0, 0),
(244, 1, 0, 0),
(245, 18, 0, 0),
(246, 18, 0, 0),
(247, 18, 0, 0),
(248, 18, 0, 0),
(249, 18, 0, 0),
(250, 2, 0, 0),
(251, 2, 0, 0),
(252, 19, 0, 0),
(253, 16, 0, 0),
(254, 5, 0, 0),
(255, 18, 0, 0),
(256, 18, 0, 0),
(257, 18, 0, 0),
(258, 18, 0, 0),
(259, 18, 0, 0),
(260, 18, 0, 0),
(261, 18, 0, 0),
(262, 18, 0, 0),
(263, 18, 0, 0),
(264, 18, 0, 0),
(265, 18, 0, 0),
(266, 18, 0, 0),
(267, 18, 0, 0),
(268, 18, 0, 0),
(269, 18, 0, 0),
(270, 18, 0, 0),
(271, 18, 0, 0),
(272, 18, 0, 0),
(273, 18, 0, 0),
(274, 18, 0, 0),
(275, 18, 0, 0),
(276, 18, 0, 0),
(277, 18, 0, 0),
(278, 16, 0, 0),
(279, 16, 0, 0),
(280, 16, 0, 0),
(281, 16, 0, 0),
(282, 16, 0, 0),
(283, 16, 0, 0),
(284, 3, 0, 0),
(285, 16, 0, 0),
(286, 16, 0, 0),
(287, 16, 0, 0),
(288, 16, 0, 0),
(289, 16, 0, 0),
(290, 16, 0, 0),
(291, 16, 0, 0),
(292, 16, 0, 0),
(293, 16, 0, 0),
(294, 6, 0, 0),
(295, 17, 0, 0),
(296, 16, 0, 0),
(297, 17, 0, 0),
(298, 17, 0, 0),
(299, 17, 0, 0),
(300, 17, 0, 0),
(301, 16, 0, 0),
(302, 17, 0, 0),
(303, 5, 0, 0),
(304, 17, 0, 0),
(305, 17, 0, 0),
(306, 17, 0, 0),
(307, 17, 0, 0),
(308, 17, 0, 0),
(309, 17, 0, 0),
(310, 17, 0, 0),
(311, 18, 0, 0),
(312, 17, 0, 0),
(313, 18, 0, 0),
(314, 17, 0, 0),
(315, 17, 0, 0),
(316, 17, 0, 0),
(317, 16, 0, 0),
(318, 16, 0, 0),
(319, 17, 0, 0),
(320, 16, 0, 0),
(321, 16, 0, 0),
(322, 19, 0, 0),
(323, 5, 0, 0),
(324, 20, 0, 0),
(325, 20, 0, 0),
(326, 20, 0, 0),
(327, 20, 0, 0),
(328, 6, 0, 0),
(329, 19, 0, 0),
(330, 18, 0, 0),
(331, 18, 0, 0),
(332, 16, 0, 0),
(333, 17, 0, 0),
(334, 17, 0, 0),
(335, 18, 0, 0),
(336, 0, 0, 0),
(337, 0, 0, 0),
(338, 5, 0, 0),
(339, 16, 0, 0),
(340, 20, 0, 0),
(341, 5, 0, 0),
(342, 9, 0, 0),
(343, 5, 0, 0),
(344, 9, 0, 0),
(345, 19, 0, 0),
(346, 9, 0, 0),
(347, 9, 0, 0),
(348, 18, 0, 0),
(349, 16, 0, 0),
(350, 20, 0, 0),
(351, 17, 0, 0),
(352, 17, 0, 0),
(353, 21, 0, 0),
(354, 16, 0, 0),
(355, 17, 0, 0),
(356, 17, 0, 0),
(357, 17, 0, 0),
(358, 17, 0, 0),
(359, 17, 0, 0),
(360, 20, 0, 0),
(361, 20, 0, 0),
(362, 20, 0, 0),
(363, 20, 0, 0),
(364, 17, 0, 0),
(365, 17, 0, 0),
(366, 20, 0, 0),
(367, 20, 0, 0),
(368, 20, 0, 0),
(369, 17, 0, 0),
(370, 17, 0, 0),
(371, 24, 0, 0),
(372, 25, 0, 0),
(373, 26, 0, 0),
(374, 6, 0, 0),
(375, 9, 0, 0),
(376, 16, 0, 0),
(377, 16, 0, 0),
(378, 16, 0, 0),
(379, 18, 0, 0),
(380, 25, 0, 0),
(381, 22, 0, 0),
(382, 19, 0, 0),
(383, 30, 0, 0),
(384, 17, 0, 0),
(385, 30, 0, 0),
(386, 30, 0, 0),
(387, 17, 0, 0),
(388, 17, 0, 0),
(389, 17, 0, 0),
(390, 17, 0, 0),
(391, 17, 0, 0),
(392, 24, 0, 0),
(393, 17, 0, 0),
(394, 17, 0, 0),
(395, 5, 0, 0),
(396, 25, 0, 0),
(397, 30, 0, 0),
(398, 22, 0, 0),
(399, 17, 0, 0),
(400, 17, 0, 0),
(401, 30, 0, 0),
(402, 16, 0, 0),
(403, 18, 0, 0),
(404, 19, 0, 0),
(405, 21, 0, 0),
(406, 22, 0, 0),
(407, 21, 0, 0),
(408, 25, 0, 0),
(409, 26, 0, 0),
(410, 30, 0, 0),
(411, 5, 0, 0),
(412, 9, 0, 0),
(413, 18, 0, 0),
(414, 19, 0, 0),
(415, 18, 0, 0),
(416, 19, 0, 0),
(417, 21, 0, 0),
(418, 22, 0, 0),
(419, 16, 0, 0),
(420, 17, 0, 0),
(421, 9, 0, 0),
(422, 5, 0, 0),
(423, 22, 0, 0),
(424, 21, 0, 0),
(425, 16, 0, 0),
(426, 17, 0, 0),
(427, 5, 0, 0),
(428, 9, 0, 0),
(429, 19, 0, 0),
(430, 18, 0, 0),
(431, 27, 0, 0),
(432, 22, 0, 0),
(433, 30, 0, 0),
(434, 33, 0, 0),
(435, 31, 0, 0),
(436, 21, 0, 0),
(437, 28, 0, 0),
(438, 28, 0, 0),
(439, 28, 0, 0),
(440, 9, 0, 0),
(441, 17, 0, 0),
(442, 17, 0, 0),
(443, 9, 0, 0),
(444, 17, 0, 0),
(445, 31, 0, 0),
(446, 17, 0, 0),
(447, 31, 0, 0),
(448, 31, 0, 0),
(449, 31, 0, 0),
(450, 16, 0, 0),
(451, 16, 0, 0),
(452, 1, 0, 0),
(453, 31, 0, 0),
(454, 17, 0, 0),
(455, 31, 0, 0),
(456, 21, 0, 0),
(457, 18, 0, 0),
(458, 35, 0, 0),
(459, 22, 0, 0),
(460, 30, 0, 0),
(461, 17, 0, 0),
(462, 25, 0, 0),
(463, 25, 0, 0),
(464, 25, 0, 0),
(465, 17, 0, 0),
(466, 24, 0, 0),
(467, 24, 0, 0),
(468, 24, 0, 0),
(469, 24, 0, 0),
(470, 17, 0, 0),
(471, 1, 0, 0),
(472, 25, 0, 0),
(473, 25, 0, 0),
(474, 17, 0, 0),
(475, 17, 0, 0),
(476, 17, 0, 0),
(477, 24, 0, 0),
(478, 17, 0, 0),
(479, 17, 0, 0),
(480, 24, 0, 0),
(481, 24, 0, 0),
(482, 24, 0, 0),
(483, 24, 0, 0),
(484, 24, 0, 0),
(485, 24, 0, 0),
(486, 24, 0, 0),
(487, 24, 0, 0),
(488, 24, 0, 0),
(489, 24, 0, 0),
(490, 24, 0, 0),
(491, 24, 0, 0),
(492, 24, 0, 0),
(493, 24, 0, 0),
(494, 24, 0, 0),
(495, 24, 0, 0),
(496, 24, 0, 0),
(497, 24, 0, 0),
(498, 24, 0, 0),
(499, 24, 0, 0),
(500, 24, 0, 0),
(501, 24, 0, 0),
(502, 24, 0, 0),
(503, 24, 0, 0),
(504, 24, 0, 0),
(505, 24, 0, 0),
(506, 24, 0, 0),
(507, 24, 0, 0),
(508, 24, 0, 0),
(509, 24, 0, 0),
(510, 24, 0, 0),
(511, 24, 0, 0),
(512, 24, 0, 0),
(513, 24, 0, 0),
(514, 24, 0, 0),
(515, 24, 0, 0),
(516, 24, 0, 0),
(517, 24, 0, 0),
(518, 24, 0, 0),
(519, 24, 0, 0),
(520, 24, 0, 0),
(521, 24, 0, 0),
(522, 24, 0, 0),
(523, 24, 0, 0),
(524, 24, 0, 0),
(525, 24, 0, 0),
(526, 24, 0, 0),
(527, 24, 0, 0),
(528, 24, 0, 0),
(529, 24, 0, 0),
(530, 24, 0, 0),
(531, 24, 0, 0),
(532, 24, 0, 0),
(533, 24, 0, 0),
(534, 24, 0, 0),
(535, 24, 0, 0),
(536, 17, 0, 0),
(537, 24, 0, 0),
(538, 24, 0, 0),
(539, 24, 0, 0),
(540, 24, 0, 0),
(541, 24, 0, 0),
(542, 24, 0, 0),
(543, 25, 0, 0),
(544, 17, 0, 0),
(545, 19, 0, 0),
(546, 18, 0, 0),
(547, 24, 0, 0),
(548, 24, 0, 0),
(549, 37, 0, 0),
(550, 37, 0, 0),
(551, 37, 0, 0),
(552, 38, 0, 0),
(553, 38, 0, 0),
(554, 38, 0, 0),
(555, 38, 0, 0),
(556, 38, 0, 0),
(557, 38, 0, 0),
(558, 38, 0, 0),
(559, 38, 0, 0),
(560, 38, 0, 0),
(561, 38, 0, 0),
(562, 38, 0, 0),
(563, 38, 0, 0),
(564, 38, 0, 0),
(565, 38, 0, 0),
(566, 16, 0, 0),
(567, 16, 0, 0),
(568, 38, 0, 0),
(569, 38, 0, 0),
(570, 38, 0, 0),
(571, 38, 0, 0),
(572, 28, 0, 0),
(573, 49, 0, 0),
(574, 52, 0, 0),
(575, 49, 0, 0),
(576, 52, 0, 0),
(577, 52, 0, 0),
(578, 52, 0, 0),
(579, 33, 0, 0),
(580, 39, 0, 0),
(581, 39, 0, 0),
(582, 39, 0, 0),
(583, 39, 0, 0),
(584, 39, 0, 0),
(585, 39, 0, 0),
(586, 39, 0, 0),
(587, 39, 0, 0),
(588, 47, 0, 0),
(589, 45, 0, 0),
(590, 50, 0, 0),
(591, 43, 0, 0),
(592, 42, 0, 0),
(593, 48, 0, 0),
(594, 40, 0, 0),
(595, 39, 0, 0),
(596, 39, 0, 0),
(597, 39, 0, 0),
(598, 39, 0, 0),
(599, 18, 0, 0),
(600, 39, 0, 0),
(601, 39, 0, 0),
(602, 39, 0, 0),
(603, 39, 0, 0),
(604, 39, 0, 0),
(605, 48, 0, 0),
(606, 38, 0, 0),
(607, 43, 0, 0),
(608, 5, 0, 0),
(609, 25, 0, 0),
(610, 25, 0, 0),
(611, 47, 0, 0),
(612, 40, 0, 0),
(613, 40, 0, 0),
(614, 40, 0, 0),
(615, 40, 0, 0),
(616, 42, 0, 0),
(617, 9, 0, 0),
(618, 2, 0, 0),
(619, 2, 0, 0),
(620, 5, 0, 0),
(621, 5, 0, 0),
(622, 42, 0, 0),
(623, 42, 0, 0),
(624, 5, 0, 0),
(625, 9, 0, 0),
(626, 39, 0, 0),
(627, 45, 0, 0),
(628, 45, 0, 0),
(629, 45, 0, 0),
(630, 45, 0, 0),
(631, 45, 0, 0),
(632, 45, 0, 0),
(633, 45, 0, 0),
(634, 42, 0, 0),
(635, 5, 0, 0),
(636, 9, 0, 0),
(637, 5, 0, 0),
(638, 5, 0, 0),
(639, 9, 0, 0),
(640, 5, 0, 0),
(641, 40, 0, 0),
(642, 18, 0, 0),
(643, 19, 0, 0),
(644, 9, 0, 0),
(645, 45, 0, 0),
(646, 45, 0, 0),
(647, 45, 0, 0),
(648, 45, 0, 0),
(649, 45, 0, 0),
(650, 45, 0, 0),
(651, 45, 0, 0),
(652, 45, 0, 0),
(653, 45, 0, 0),
(654, 30, 0, 0),
(655, 30, 0, 0),
(656, 42, 0, 0),
(657, 26, 0, 0),
(658, 45, 0, 0),
(659, 43, 0, 0),
(660, 17, 0, 0),
(661, 25, 0, 0),
(662, 25, 0, 0),
(663, 26, 0, 0),
(664, 30, 0, 0),
(665, 16, 0, 0),
(666, 16, 0, 0),
(667, 48, 0, 0),
(668, 48, 0, 0),
(669, 5, 0, 0),
(670, 5, 0, 0),
(671, 5, 0, 0),
(672, 43, 0, 0),
(673, 5, 0, 0),
(674, 9, 0, 0),
(675, 40, 0, 0),
(676, 5, 0, 0),
(677, 9, 0, 0),
(678, 5, 0, 0),
(679, 9, 0, 0),
(680, 9, 0, 0),
(681, 21, 0, 0),
(682, 21, 0, 0),
(683, 16, 0, 0),
(684, 9, 0, 0),
(685, 42, 0, 0),
(686, 42, 0, 0),
(687, 39, 0, 0),
(688, 42, 0, 0),
(689, 47, 0, 0),
(690, 54, 0, 0),
(691, 54, 0, 0),
(692, 54, 0, 0),
(693, 54, 0, 0),
(694, 54, 0, 0),
(695, 18, 0, 0),
(696, 18, 0, 0),
(697, 16, 0, 0),
(698, 48, 0, 0),
(699, 22, 0, 0),
(700, 22, 0, 0),
(701, 9, 0, 0),
(702, 26, 0, 0),
(703, 5, 0, 0),
(704, 18, 0, 0),
(705, 5, 0, 0),
(706, 9, 0, 0),
(707, 9, 0, 0),
(708, 5, 0, 0),
(709, 9, 0, 0),
(710, 43, 0, 0),
(711, 43, 0, 0),
(712, 43, 0, 0),
(713, 9, 0, 0),
(714, 18, 0, 0),
(715, 42, 0, 0),
(716, 5, 0, 0),
(717, 9, 0, 0),
(718, 5, 0, 0),
(719, 21, 0, 0),
(720, 21, 0, 0),
(721, 5, 0, 0),
(722, 16, 0, 0),
(723, 9, 0, 0),
(724, 16, 0, 0),
(725, 19, 0, 0),
(726, 19, 0, 0),
(727, 16, 0, 0),
(728, 16, 0, 0),
(729, 16, 0, 0),
(730, 16, 0, 0),
(731, 40, 0, 0),
(732, 18, 0, 0),
(733, 18, 0, 0),
(734, 42, 0, 0),
(735, 16, 0, 0),
(736, 7, 0, 0),
(737, 48, 0, 0),
(738, 16, 0, 0),
(739, 48, 0, 0),
(740, 16, 0, 0),
(741, 9, 0, 0),
(742, 5, 0, 0),
(743, 16, 0, 0),
(744, 16, 0, 0),
(745, 9, 0, 0),
(746, 42, 0, 0),
(747, 42, 0, 0),
(748, 52, 0, 0),
(749, 19, 0, 0),
(750, 54, 0, 0),
(751, 47, 0, 0),
(752, 47, 0, 0),
(753, 54, 0, 0),
(754, 5, 0, 0),
(755, 9, 0, 0),
(756, 5, 0, 0),
(757, 5, 0, 0),
(758, 9, 0, 0),
(759, 5, 0, 0),
(760, 9, 0, 0),
(761, 9, 0, 0),
(762, 54, 0, 0),
(763, 17, 0, 0),
(764, 17, 0, 0),
(765, 49, 0, 0),
(766, 39, 0, 0),
(767, 18, 0, 0),
(768, 47, 0, 0),
(769, 5, 0, 0),
(770, 16, 0, 0),
(771, 44, 0, 0),
(772, 5, 0, 0),
(773, 16, 0, 0),
(774, 5, 0, 0),
(775, 1, 0, 0),
(776, 47, 0, 0),
(777, 16, 0, 0),
(778, 16, 0, 0),
(779, 47, 0, 0),
(780, 30, 0, 0),
(781, 23, 0, 0),
(782, 0, 0, 0),
(783, 54, 0, 0),
(784, 25, 0, 0),
(785, 25, 0, 0),
(786, 9, 0, 0),
(787, 9, 0, 0),
(788, 5, 0, 0),
(789, 7, 0, 0),
(790, 7, 0, 0),
(791, 5, 0, 0),
(792, 50, 0, 0),
(793, 1, 0, 0),
(794, 5, 0, 0),
(795, 9, 0, 0),
(796, 9, 0, 0),
(797, 16, 0, 0),
(798, 16, 0, 0),
(799, 9, 0, 0),
(800, 9, 0, 0),
(801, 5, 0, 0),
(802, 17, 0, 0),
(803, 17, 0, 0),
(804, 48, 0, 0),
(805, 5, 0, 0),
(806, 17, 0, 0),
(807, 16, 0, 0),
(808, 17, 0, 0),
(809, 18, 0, 0),
(810, 19, 0, 0),
(811, 5, 0, 0),
(812, 5, 0, 0),
(813, 54, 0, 0),
(814, 9, 0, 0),
(815, 5, 0, 0),
(816, 5, 0, 0),
(817, 24, 0, 0),
(818, 24, 0, 0),
(819, 24, 0, 0),
(820, 24, 0, 0),
(821, 53, 0, 0),
(822, 54, 0, 0),
(823, 24, 0, 0),
(824, 24, 0, 0),
(825, 24, 0, 0),
(826, 24, 0, 0),
(827, 25, 0, 0),
(828, 54, 0, 0),
(829, 40, 0, 0),
(830, 42, 0, 0),
(831, 39, 0, 0),
(832, 40, 0, 0),
(833, 9, 0, 0),
(834, 1, 0, 0),
(835, 9, 0, 0),
(836, 5, 0, 0),
(837, 6, 0, 0),
(838, 3, 0, 0),
(839, 5, 0, 0),
(840, 1, 0, 0),
(841, 5, 0, 0),
(842, 54, 0, 0),
(843, 54, 0, 0),
(844, 9, 0, 0),
(845, 6, 0, 0),
(846, 9, 0, 0),
(847, 21, 0, 0),
(848, 22, 0, 0),
(849, 19, 0, 0),
(850, 16, 0, 0),
(851, 16, 0, 0),
(852, 52, 0, 0),
(853, 45, 0, 0),
(854, 45, 0, 0),
(855, 45, 0, 0),
(856, 45, 0, 0),
(857, 48, 0, 0),
(858, 54, 0, 0),
(859, 16, 0, 0),
(860, 47, 0, 0),
(861, 5, 0, 0),
(862, 9, 0, 0),
(863, 9, 0, 0),
(864, 54, 0, 0),
(865, 54, 0, 0),
(866, 23, 0, 0),
(867, 21, 0, 0),
(868, 16, 0, 0),
(869, 16, 0, 0),
(870, 34, 0, 0),
(871, 54, 0, 0),
(872, 25, 0, 0),
(873, 23, 0, 0),
(874, 50, 0, 0),
(875, 5, 0, 0),
(876, 8, 0, 0),
(877, 54, 0, 0),
(878, 9, 0, 0),
(879, 45, 0, 0),
(880, 16, 0, 0),
(881, 23, 0, 0),
(882, 5, 0, 0),
(883, 16, 0, 0),
(884, 16, 0, 0),
(885, 21, 0, 0),
(886, 1, 0, 0),
(887, 1, 0, 0),
(888, 1, 0, 0),
(889, 5, 0, 0),
(890, 5, 0, 0),
(891, 9, 0, 0),
(892, 42, 0, 0),
(893, 16, 0, 0),
(894, 54, 0, 0),
(895, 54, 0, 0),
(896, 48, 0, 0),
(897, 16, 0, 0),
(898, 5, 0, 0),
(899, 9, 0, 0),
(900, 16, 0, 0),
(901, 18, 0, 0),
(902, 16, 0, 0),
(903, 9, 0, 0),
(904, 42, 0, 0),
(905, 16, 0, 0),
(906, 9, 0, 0),
(907, 9, 0, 0),
(908, 23, 0, 0),
(909, 5, 0, 0),
(910, 16, 0, 0),
(911, 5, 0, 0),
(912, 21, 0, 0),
(913, 5, 0, 0),
(914, 5, 0, 0),
(915, 54, 0, 0),
(916, 9, 0, 0),
(917, 16, 0, 0),
(918, 5, 0, 0),
(919, 9, 0, 0),
(920, 5, 0, 0),
(921, 23, 0, 0),
(922, 5, 0, 0),
(923, 9, 0, 0),
(924, 5, 0, 0),
(925, 5, 0, 0),
(926, 5, 0, 0),
(927, 16, 0, 0),
(928, 23, 0, 0),
(929, 16, 0, 0),
(930, 22, 0, 0),
(931, 16, 0, 0),
(932, 9, 0, 0),
(933, 9, 0, 0),
(934, 16, 0, 0),
(935, 16, 0, 0),
(936, 16, 0, 0),
(937, 16, 0, 0),
(938, 17, 0, 0),
(939, 9, 0, 0),
(940, 6, 0, 0),
(941, 9, 0, 0),
(942, 5, 0, 0),
(943, 3, 0, 0),
(944, 42, 0, 0),
(945, 5, 0, 0),
(946, 3, 0, 0),
(947, 7, 0, 0),
(948, 16, 0, 0),
(949, 16, 0, 0),
(950, 2, 0, 0),
(951, 1, 0, 0),
(952, 5, 0, 0),
(953, 16, 0, 0),
(954, 16, 0, 0),
(955, 16, 0, 0),
(956, 16, 0, 0),
(957, 5, 0, 0),
(958, 39, 0, 0),
(959, 16, 0, 0),
(960, 50, 0, 0),
(961, 1, 0, 0),
(962, 59, 0, 0),
(963, 58, 0, 0),
(964, 57, 0, 0),
(965, 55, 0, 0),
(966, 58, 0, 0),
(967, 58, 0, 0),
(968, 58, 0, 0),
(969, 58, 0, 0),
(970, 57, 0, 0),
(971, 58, 0, 0),
(972, 58, 0, 0),
(973, 57, 0, 0),
(974, 55, 0, 0),
(975, 57, 0, 0),
(976, 57, 0, 0),
(977, 59, 0, 0),
(978, 58, 0, 0),
(979, 57, 0, 0),
(980, 57, 0, 0),
(981, 57, 0, 0),
(982, 58, 0, 0),
(983, 58, 0, 0),
(984, 58, 0, 0),
(985, 58, 0, 0),
(986, 58, 0, 0),
(987, 58, 0, 0),
(988, 58, 0, 0),
(989, 58, 0, 0),
(990, 58, 0, 0),
(991, 58, 0, 0),
(992, 58, 0, 0),
(993, 58, 0, 0),
(994, 58, 0, 0),
(995, 58, 0, 0),
(996, 58, 0, 0),
(997, 58, 0, 0),
(998, 58, 0, 0),
(999, 58, 0, 0),
(1000, 58, 0, 0),
(1001, 58, 0, 0),
(1002, 58, 0, 0),
(1003, 58, 0, 0),
(1004, 58, 0, 0),
(1005, 58, 0, 0),
(1006, 58, 0, 0),
(1007, 58, 0, 0),
(1008, 58, 0, 0),
(1009, 58, 0, 0),
(1010, 58, 0, 0),
(1011, 58, 0, 0),
(1012, 58, 0, 0),
(1013, 58, 0, 0),
(1014, 58, 0, 0),
(1015, 58, 0, 0),
(1016, 58, 0, 0),
(1017, 58, 0, 0),
(1018, 58, 0, 0),
(1019, 58, 0, 0),
(1020, 58, 0, 0),
(1021, 58, 0, 0),
(1022, 58, 0, 0),
(1023, 58, 0, 0),
(1024, 58, 0, 0),
(1025, 58, 0, 0),
(1026, 58, 0, 0),
(1027, 58, 0, 0),
(1028, 58, 0, 0),
(1029, 58, 0, 0),
(1030, 58, 0, 0),
(1031, 58, 0, 0),
(1032, 58, 0, 0),
(1033, 58, 0, 0),
(1034, 58, 0, 0),
(1035, 58, 0, 0),
(1036, 58, 0, 0),
(1037, 58, 0, 0),
(1038, 58, 0, 0),
(1039, 58, 0, 0),
(1040, 58, 0, 0),
(1041, 58, 0, 0),
(1042, 58, 0, 0),
(1043, 58, 0, 0),
(1044, 58, 0, 0),
(1045, 58, 0, 0),
(1046, 58, 0, 0),
(1047, 58, 0, 0),
(1048, 58, 0, 0),
(1049, 58, 0, 0),
(1050, 58, 0, 0),
(1051, 58, 0, 0),
(1052, 58, 0, 0),
(1053, 58, 0, 0),
(1054, 58, 0, 0),
(1055, 58, 0, 0),
(1056, 58, 0, 0),
(1057, 58, 0, 0),
(1058, 58, 0, 0),
(1059, 58, 0, 0),
(1060, 58, 0, 0),
(1061, 58, 0, 0),
(1062, 58, 0, 0),
(1063, 58, 0, 0),
(1064, 58, 0, 0),
(1065, 58, 0, 0),
(1066, 58, 0, 0),
(1067, 58, 0, 0),
(1068, 58, 0, 0),
(1069, 58, 0, 0),
(1070, 58, 0, 0),
(1071, 58, 0, 0),
(1072, 58, 0, 0),
(1073, 58, 0, 0),
(1074, 58, 0, 0),
(1075, 58, 0, 0),
(1076, 58, 0, 0),
(1077, 58, 0, 0),
(1078, 58, 0, 0),
(1079, 58, 0, 0),
(1080, 58, 0, 0),
(1081, 58, 0, 0),
(1082, 58, 0, 0),
(1083, 58, 0, 0),
(1084, 58, 0, 0),
(1085, 58, 0, 0),
(1086, 58, 0, 0),
(1087, 58, 0, 0),
(1088, 58, 0, 0),
(1089, 58, 0, 0),
(1090, 58, 0, 0),
(1091, 58, 0, 0),
(1092, 58, 0, 0),
(1093, 58, 0, 0),
(1094, 58, 0, 0),
(1095, 58, 0, 0),
(1096, 58, 0, 0),
(1097, 58, 0, 0),
(1098, 58, 0, 0),
(1099, 58, 0, 0),
(1100, 58, 0, 0),
(1101, 58, 0, 0),
(1102, 58, 0, 0),
(1103, 58, 0, 0),
(1104, 58, 0, 0),
(1105, 58, 0, 0),
(1106, 58, 0, 0),
(1107, 58, 0, 0),
(1108, 58, 0, 0),
(1109, 58, 0, 0),
(1110, 58, 0, 0),
(1111, 58, 0, 0),
(1112, 58, 0, 0),
(1113, 58, 0, 0),
(1114, 58, 0, 0),
(1115, 58, 0, 0),
(1116, 58, 0, 0),
(1117, 58, 0, 0),
(1118, 58, 0, 0),
(1119, 58, 0, 0),
(1120, 58, 0, 0),
(1121, 58, 0, 0),
(1122, 58, 0, 0),
(1123, 58, 0, 0),
(1124, 58, 0, 0),
(1125, 58, 0, 0),
(1126, 58, 0, 0),
(1127, 58, 0, 0),
(1128, 58, 0, 0),
(1129, 58, 0, 0),
(1130, 58, 0, 0),
(1131, 58, 0, 0),
(1132, 58, 0, 0),
(1133, 58, 0, 0),
(1134, 58, 0, 0),
(1135, 58, 0, 0),
(1136, 58, 0, 0),
(1137, 58, 0, 0),
(1138, 58, 0, 0),
(1139, 58, 0, 0),
(1140, 58, 0, 0),
(1141, 58, 0, 0),
(1142, 58, 0, 0),
(1143, 58, 0, 0),
(1144, 58, 0, 0),
(1145, 58, 0, 0),
(1146, 58, 0, 0),
(1147, 58, 0, 0),
(1148, 58, 0, 0),
(1149, 58, 0, 0),
(1150, 58, 0, 0),
(1151, 58, 0, 0),
(1152, 58, 0, 0),
(1153, 58, 0, 0),
(1154, 58, 0, 0),
(1155, 58, 0, 0),
(1156, 58, 0, 0),
(1157, 59, 0, 0),
(1158, 59, 0, 0),
(1159, 59, 0, 0),
(1160, 57, 0, 0),
(1161, 58, 0, 0),
(1162, 58, 0, 0),
(1163, 55, 0, 0),
(1164, 55, 0, 0),
(1165, 58, 0, 0),
(1166, 58, 0, 0),
(1167, 58, 0, 0),
(1168, 58, 0, 0),
(1169, 57, 0, 0),
(1170, 57, 0, 0),
(1171, 57, 0, 0),
(1172, 57, 0, 0),
(1173, 57, 0, 0),
(1174, 57, 0, 0),
(1175, 57, 0, 0),
(1176, 57, 0, 0),
(1177, 58, 0, 0),
(1178, 59, 0, 0),
(1179, 57, 0, 0),
(1180, 58, 0, 0),
(1181, 57, 0, 0),
(1182, 58, 0, 0),
(1183, 57, 0, 0),
(1184, 57, 0, 0),
(1185, 58, 0, 0),
(1186, 57, 0, 0),
(1187, 57, 0, 0),
(1188, 57, 0, 0),
(1189, 57, 0, 0),
(1190, 57, 0, 0),
(1191, 57, 0, 0),
(1192, 57, 0, 0),
(1193, 57, 0, 0),
(1194, 57, 0, 0),
(1195, 58, 0, 0),
(1196, 57, 0, 0),
(1197, 57, 0, 0),
(1198, 57, 0, 0),
(1199, 57, 0, 0),
(1200, 57, 0, 0),
(1201, 57, 0, 0),
(1202, 57, 0, 0),
(1203, 57, 0, 0),
(1204, 57, 0, 0),
(1205, 58, 0, 0),
(1206, 58, 0, 0),
(1207, 58, 0, 0),
(1208, 58, 0, 0),
(1209, 58, 0, 0),
(1210, 57, 0, 0),
(1211, 59, 0, 0),
(1212, 57, 0, 0),
(1213, 58, 0, 0),
(1214, 58, 0, 0),
(1215, 57, 0, 0),
(1216, 57, 0, 0),
(1217, 57, 0, 0),
(1218, 57, 0, 0),
(1219, 57, 0, 0),
(1220, 57, 0, 0),
(1221, 57, 0, 0),
(1222, 57, 0, 0),
(1223, 57, 0, 0),
(1224, 57, 0, 0),
(1225, 57, 0, 0),
(1226, 58, 0, 0),
(1227, 57, 0, 0),
(1228, 58, 0, 0),
(1229, 57, 0, 0),
(1230, 57, 0, 0),
(1231, 57, 0, 0),
(1232, 57, 0, 0),
(1233, 57, 0, 0),
(1234, 57, 0, 0),
(1235, 58, 0, 0),
(1236, 58, 0, 0),
(1237, 59, 0, 0),
(1238, 59, 0, 0),
(1239, 59, 0, 0),
(1240, 57, 0, 0),
(1241, 57, 0, 0),
(1242, 57, 0, 0),
(1243, 57, 0, 0),
(1244, 57, 0, 0),
(1245, 57, 0, 0),
(1246, 59, 0, 0),
(1247, 57, 0, 0),
(1248, 58, 0, 0),
(1249, 58, 0, 0),
(1250, 57, 0, 0),
(1251, 57, 0, 0),
(1252, 55, 0, 0),
(1253, 55, 0, 0),
(1254, 55, 0, 0),
(1255, 55, 0, 0),
(1256, 58, 0, 0),
(1257, 58, 0, 0),
(1258, 58, 0, 0),
(1259, 58, 0, 0),
(1260, 58, 0, 0),
(1261, 59, 0, 0),
(1262, 55, 0, 0),
(1263, 55, 0, 0),
(1264, 57, 0, 0),
(1265, 59, 0, 0),
(1266, 59, 0, 0),
(1267, 59, 0, 0),
(1268, 59, 0, 0),
(1269, 59, 0, 0),
(1270, 57, 0, 0),
(1271, 57, 0, 0),
(1272, 58, 0, 0);

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

--
-- Dumping data for table `online_orders`
--

INSERT INTO `online_orders` (`id`, `session_id`, `user_id`, `vendor_id`, `delivery_timeslots`, `deliveryaddress_id`, `payment_option`, `payment_status`, `order_status`, `delivery_boy`, `created_at`, `created_date`, `admin_commission`, `vendor_commission`, `deliveryboy_commission`, `total_price`, `gst`, `sub_total`, `coupon_id`, `coupon_code`, `coupon_disount`, `razerpay_orderId`, `wallet_amount`) VALUES
(1, 'jrxbtzqql7kt1rjvt4k1', 352, 241, '', 132, 'ONLINE', 1, '1', 0, '1624520434', '2021-06-24 07:40:34', '33.2', '298.8', '100', '432', '0', '332', 0, 'undefined', 'undefined', 'order_HQokTSGemf8faa', 0),
(2, 't5t3msmbg7p47d2laj5q', 353, 241, '', 133, 'ONLINE', 1, '1', 0, '1624528979', '2021-06-24 10:02:59', '35', '315', '100', '450', '0', '350', 0, 'undefined', 'undefined', 'order_HQrAv0sTSOV2QD', 0),
(3, 'musqd2lkp9983hp96ney', 353, 239, '', 133, 'ONLINE', 1, '1', 0, '1624602109', '2021-06-25 06:21:49', '40', '160', '100', '300', '0', '200', 0, 'undefined', 'undefined', 'order_HRBwPCuYZVy5R9', 0),
(8, '4aeomxtac7m6o947dcpq', 354, 239, '', 134, 'ONLINE', 1, '1', 0, '1630734484', '2021-09-04 05:48:04', '30', '120', '100', '250', '0', '150', 0, 'undefined', 'undefined', 'order_HtHIJLep0vTTG9', 0),
(9, 'oymg4ahp8lattwp4ihto', 353, 239, '', 133, 'ONLINE', 1, '1', 0, '1630924852', '2021-09-06 10:40:52', '40', '160', '100', '300', '0', '200', 0, 'undefined', 'undefined', 'order_Hu9LpxNf47x9o7', 0),
(10, 'mb1ekr2aq6ucp3w8m9xx', 353, 241, '', 133, 'ONLINE', 1, '1', 0, '1632486240', '2021-09-24 12:24:00', '5.9', '53.1', '100', '159', '0', '59', 0, 'undefined', 'undefined', 'order_I1IiwYUacBLshU', 0),
(14, '3nogui3ogmipp5oayq5p', 355, 241, '', 135, 'ONLINE', 1, '1', 0, '1632805558', '2021-09-28 05:05:58', '20', '180', '100', '300', '0', '200', 0, 'undefined', 'undefined', 'order_I2lOj873yrDWxw', 0),
(15, '89lyf1g76eawdsphskn5', 355, 248, '', 147, 'ONLINE', 1, '1', 0, '1632828399', '2021-09-28 11:26:39', '0', '0', '100', '145.45', '0.45', '0', 0, 'undefined', 'undefined', 'order_I2rsqcACVeHJO0', 0),
(16, '89lyf1g76eawdsphskn5', 355, 248, '', 148, 'ONLINE', 1, '1', 0, '1632828557', '2021-09-28 11:29:17', '0', '0', '100', '145.45', '0.45', '0', 0, 'undefined', 'undefined', 'order_I2rvdqxRMGObDQ', 0),
(17, '89lyf1g76eawdsphskn5', 355, 248, '', 135, 'ONLINE', 1, '1', 0, '1632833309', '2021-09-28 12:48:29', '13.5', '31.5', '100', '145.45', '0.45', '45', 0, 'undefined', 'undefined', 'order_I2tHI7EpdAmjRF', 0),
(19, '89lyf1g76eawdsphskn5', 355, 248, '', 135, 'ONLINE', 1, '1', 0, '1632833511', '2021-09-28 12:51:51', '13.5', '166.5', '100', '281.8', '1.8', '180', 0, 'undefined', 'undefined', 'order_I2tKrXIYjMHEWs', 0),
(22, '89lyf1g76eawdsphskn5', 355, 248, '', 135, 'ONLINE', 1, '1', 0, '1632890856', '2021-09-29 04:47:36', '0', '-14.55', '50', '95.45', '0.45', '0', 1, '16AGCD', '14.55', 'order_I39cS1GNuw0UdW', 0),
(23, '89lyf1g76eawdsphskn5', 355, 248, '', 135, 'ONLINE', 1, '1', 0, '1632890892', '2021-09-29 04:48:12', '0', '-14.55', '50', '95.45', '0.45', '0', 1, '16AGCD', '14.55', 'order_I39d4iCWZ0bNxY', 0),
(24, '89lyf1g76eawdsphskn5', 355, 248, '', 135, 'ONLINE', 1, '1', 0, '1632890967', '2021-09-29 04:49:27', '13.5', '31.5', '100', '145.45', '0.45', '45', 0, 'undefined', 'undefined', 'order_I39eOQ5nxDMpqi', 0),
(25, '89lyf1g76eawdsphskn5', 355, 248, '', 135, 'ONLINE', 1, '1', 0, '1632890992', '2021-09-29 04:49:52', '13.5', '31.5', '100', '145.45', '0.45', '45', 0, 'undefined', 'undefined', 'order_I39epdp1Xzj5qH', 0),
(26, 'hfg7s4ysph7pyl0hjpcy', 355, 248, '', 135, 'ONLINE', 1, '1', 0, '1632891032', '2021-09-29 04:50:32', '4.5', '10.5', '100', '115.15', '0.15', '15', 0, 'undefined', 'undefined', 'order_I39fXpUomVLGyv', 0),
(27, 'gdja8deiaqm0by7yjkdd', 357, 248, '', 138, 'ONLINE', 1, '1', 0, '1632893717', '2021-09-29 05:35:17', '4.5', '10.5', '100', '115.15', '0.15', '15', 0, 'undefined', 'undefined', 'order_I3AQnzicJwMuYB', 0),
(35, 'aqtqgz3cg231j3sj4ip9', 360, 248, '', 149, 'ONLINE', 1, '1', 0, '1632986471', '2021-09-30 07:21:11', '7.5', '49.92', '100', '158.175', '0.75', '75', 1, '16AGCD', '17.58', 'order_I3alnnbB4hJzSa', 0),
(39, '85l1rmt93qy0usv4eqvk', 357, 249, '', 153, 'ONLINE', 1, '1', 0, '1633332232', '2021-10-04 07:23:52', '12.5', '487.5', '100', '700', '100', '500', 0, 'undefined', 'undefined', 'order_I5Ax72PJL9CHJe', 0),
(44, 'ideq2qsnu7m9ut86dd2b', 357, 265, '', 154, 'ONLINE', 1, '1', 0, '1633677920', '2021-10-08 07:25:20', '-142', '1992', '100', '2010', '60', '2000', 3, 'FIRSTBIRIYANI', '150.00', 'order_I6l78noDU673Dr', 0),
(45, 'ideq2qsnu7m9ut86dd2b', 357, 265, '', 154, 'ONLINE', 1, '1', 0, '1633692975', '2021-10-08 11:36:15', '-94.1', '1404.1', '100', '1434.8', '24.8', '1460', 3, 'firstbiriyani', '150.00', 'order_I6pOBybhub9wzV', 0),
(46, 'ideq2qsnu7m9ut86dd2b', 357, 265, '', 154, 'ONLINE', 1, '1', 0, '1633693006', '2021-10-08 11:36:46', '-94.1', '1404.1', '100', '1434.8', '24.8', '1460', 3, 'firstbiriyani', '150.00', 'order_I6pOjo2abkoXCI', 0),
(47, 'ideq2qsnu7m9ut86dd2b', 357, 265, '', 154, 'ONLINE', 1, '1', 0, '1633693023', '2021-10-08 11:37:03', '-94.1', '1404.1', '100', '1434.8', '24.8', '1460', 3, 'firstbiriyani', '150.00', 'order_I6pP2xtRx5lX2z', 0),
(48, 'ideq2qsnu7m9ut86dd2b', 357, 265, '', 154, 'ONLINE', 1, '1', 0, '1633693056', '2021-10-08 11:37:36', '-94.1', '1404.1', '100', '1434.8', '24.8', '1460', 3, 'firstbiriyani', '150.00', 'order_I6pPcu7byh6SGp', 0),
(49, 'ideq2qsnu7m9ut86dd2b', 357, 265, '', 154, 'ONLINE', 1, '1', 0, '1633693071', '2021-10-08 11:37:51', '-94.1', '1404.1', '100', '1434.8', '24.8', '1460', 3, 'firstbiriyani', '150.00', 'order_I6pPtRE429FGwB', 0),
(54, 'ux9ey85hkocej4sfma1u', 357, 265, '', 154, 'ONLINE', 1, '1', 0, '1633697107', '2021-10-08 12:45:07', '10', '190', '100', '306', '6', '200', 0, 'undefined', 'undefined', 'order_I6qYwRRH66bEHi', 0),
(58, 'z7fwva8sd78deham1t4a', 357, 265, '', 154, 'ONLINE', 1, '1', 0, '1633697521', '2021-10-08 12:52:01', '10', '190', '100', '306', '6', '200', 0, 'undefined', 'undefined', 'order_I6qgEcGQU4xN65', 0),
(62, 'qfbffo60v7689omrx514', 357, 265, '', 154, 'ONLINE', 1, '1', 0, '1633945409', '2021-10-11 09:43:29', '1', '19', '100', '121.6', '1.6', '20', 0, 'undefined', 'undefined', 'order_I7z4RA15Gx8dql', 0),
(64, 'a9s75grzbjday1t6ppwq', 357, 241, '', 154, 'ONLINE', 1, '1', 0, '1633945588', '2021-10-11 09:46:28', '5.9', '53.1', '100', '159', '0', '59', 0, 'undefined', 'undefined', 'order_I7z7agd9d976vZ', 0),
(66, 'xjw1ojqtiibhqi434gd4', 357, 265, '', 154, 'ONLINE', 1, '1', 0, '1633952540', '2021-10-11 11:42:20', '1', '19', '100', '121.6', '1.6', '20', 0, 'undefined', 'undefined', 'order_I815zRR7l5CHhD', 0),
(67, 'xjw1ojqtiibhqi434gd4', 357, 265, '', 154, 'ONLINE', 1, '1', 0, '1633953577', '2021-10-11 11:59:37', '1', '19', '100', '121.6', '1.6', '20', 0, 'undefined', 'undefined', 'order_I81OFX8hXzI1Us', 0),
(70, '97pi9yagal7h04cv1dmz', 357, 248, '', 154, 'ONLINE', 1, '1', 0, '1633954813', '2021-10-11 12:20:13', '13.5', '31.5', '100', '145.45', '0.45', '45', 0, 'undefined', 'undefined', 'order_I81jzzRz4tBxX2', 0),
(72, 'b82y8nggb55pf7w1wm61', 357, 265, '', 154, 'ONLINE', 1, '1', 0, '1633957512', '2021-10-11 13:05:12', '0.4', '39.6', '100', '141.2', '1.2', '40', 0, 'undefined', 'undefined', 'order_I82VWB7AJ5gbh4', 0),
(75, 'fr0scjr8cjar40n0paz9', 357, 265, '', 154, 'ONLINE', 1, '1', 0, '1633958273', '2021-10-11 13:17:53', '6', '294', '100', '403', '3', '300', 0, 'undefined', 'undefined', 'order_I82ivMPIG0gXdr', 0),
(76, 'fr0scjr8cjar40n0paz9', 357, 265, '', 154, 'ONLINE', 1, '1', 0, '1633958328', '2021-10-11 13:18:48', '6', '294', '100', '403', '3', '300', 0, 'undefined', 'undefined', 'order_I82jsh4rvkH3Lq', 0),
(78, '69pqdfjbho411ihfb7lh', 353, 241, '', 161, 'ONLINE', 1, '1', 0, '1637745538', '2021-11-24 09:18:58', '5.9', '53.1', '100', '159', '0', '59', 0, 'undefined', 'undefined', 'order_IPO9pqqXvUm85u', 0),
(79, 'zppsncqd85timxd7wybu', 5, 265, '', 164, 'ONLINE', 1, '1', 0, '1639977013', '2021-12-20 05:10:13', '3', '147', '100', '251.5', '1.5', '150', 0, 'undefined', 'undefined', 'order_IZboCz0TaP1J6M', 0),
(80, 'w7gpyln6mvgsa472m22m', 353, 265, '', 162, 'ONLINE', 1, '1', 0, '1639977207', '2021-12-20 05:13:27', '100', '2400', '100', '2675', '75', '2500', 0, 'undefined', 'undefined', 'order_IZbrdOBdaMfMsV', 0),
(81, 'pxfp67dib6c6af4235hk', 379, 265, '', 165, 'ONLINE', 1, '1', 0, '1640940693', '2021-12-31 08:51:33', '6', '894', '100', '1009', '9', '900', 0, 'undefined', 'undefined', 'order_Ie1SL0rHfFmvYj', 0),
(82, 'pxfp67dib6c6af4235hk', 379, 265, '', 165, 'ONLINE', 1, '1', 0, '1640940753', '2021-12-31 08:52:33', '6', '1194', '100', '1312', '12', '1200', 0, 'undefined', 'undefined', 'order_Ie1TOWgPCkQxiH', 0),
(83, 'j2cea4u5pqij1sjse70x', 353, 241, '', 1, 'ONLINE', 1, '1', 0, '1641280754', '2022-01-04 07:19:14', '5.9', '53.1', '100', '159', '0', '59', 0, 'undefined', 'undefined', 'order_Ifa1JCwLocIQHE', 0),
(84, 'uctqwdp03deeq1yup6vt', 353, 241, '', 4, 'ONLINE', 1, '1', 0, '1641302248', '2022-01-04 13:17:28', '5.9', '53.1', '100', '159', '0', '59', 0, 'undefined', 'undefined', 'order_Ifg7innj7CkGlf', 0),
(85, 'ybznelqra5h3c742xce6', 378, 241, '', 6, 'ONLINE', 1, '1', 0, '1641385337', '2022-01-05 12:22:17', '5.9', '112.1', '100', '218', '0', '118', 0, 'undefined', 'undefined', 'order_Ig3iYNQsZBB1W3', 0),
(86, 'ybznelqra5h3c742xce6', 378, 241, '', 6, 'ONLINE', 1, '1', 0, '1641385348', '2022-01-05 12:22:28', '5.9', '112.1', '100', '218', '0', '118', 0, 'undefined', 'undefined', 'order_Ig3ijSPOhjACL2', 0),
(87, 'sw42p69r9flxrc48vonr', 353, 249, '', 4, 'ONLINE', 1, '1', 0, '1641819060', '2022-01-10 12:51:00', '10', '190', '100', '336', '36', '200', 0, 'undefined', 'undefined', 'order_Ii2sTzpLezPPgd', 0),
(88, '1vywvj2pgdg3w1ihvj79', 353, 249, '', 11, 'ONLINE', 1, '1', 0, '1643116363', '2022-01-25 13:12:43', '12.5', '487.5', '100', '690', '90', '500', 0, 'undefined', 'undefined', 'order_InzGDxEZXEuku6', 0),
(89, '1vywvj2pgdg3w1ihvj79', 353, 249, '', 11, 'ONLINE', 1, '1', 0, '1643116430', '2022-01-25 13:13:50', '12.5', '487.5', '100', '690', '90', '500', 0, 'undefined', 'undefined', 'order_InzHPi3VLQQXZq', 0),
(90, 'w36egiw23mmlo1cvnw9d', 379, 248, '', 5, 'ONLINE', 1, '1', 0, '1643273965', '2022-01-27 08:59:25', '7.5', '17.5', '100', '125.25', '0.25', '25', 0, 'undefined', 'undefined', 'order_Ioi0uDGGldG1WX', 0),
(91, 'w36egiw23mmlo1cvnw9d', 379, 241, '', 5, 'ONLINE', 1, '1', 0, '1643561998', '2022-01-30 16:59:58', '5.9', '53.1', '100', '159', '0', '59', 0, 'undefined', 'undefined', 'order_Iq1nt0nnwAudJa', 0),
(92, 'xcc4oxdcm8hsjtkob25x', 353, 0, '', 11, 'ONLINE', 1, '1', 0, '1644325982', '2022-02-08 13:13:02', '0', '200', '100', '300', '0', '200', 0, 'undefined', 'undefined', 'order_ItWkFzPIXSWLv8', 0),
(93, 'l6erz7hmmxu9awrhy2uj', 353, 249, '', 11, 'ONLINE', 1, '1', 0, '1644499191', '2022-02-10 13:19:51', '10', '190', '100', '336', '36', '200', 0, 'undefined', 'undefined', 'order_IuJvhLhcYeYOno', 0),
(95, 'fbg7di16ht7e7pc4tkfm', 353, 0, '', 11, 'ONLINE', 1, '1', 0, '1644992669', '2022-02-16 06:24:29', '0', '150', '100', '250', '0', '150', 0, 'undefined', 'undefined', 'order_Iwa3dmn9PxeQwn', 0),
(96, '299ywxbldr4wv6nvjm4m', 353, 249, '', 11, 'ONLINE', 1, '1', 0, '1644993319', '2022-02-16 06:35:19', '10', '190', '100', '336', '36', '200', 0, 'undefined', 'undefined', 'order_IwaF641qr2OOuZ', 0),
(97, '299ywxbldr4wv6nvjm4m', 353, 249, '', 11, 'ONLINE', 1, '1', 0, '1644993330', '2022-02-16 06:35:30', '10', '190', '100', '336', '36', '200', 0, 'undefined', 'undefined', 'order_IwaFHsnrKhUdzz', 0),
(98, '96msaemmwt6jc37pwr4j', 353, 248, '', 11, 'ONLINE', 1, '1', 0, '1645591962', '2022-02-23 04:52:42', '7.5', '17.5', '100', '125.25', '0.25', '25', 0, 'undefined', 'undefined', 'order_IzKEXJwlUcvxAc', 0),
(99, 'e4fesk6a6w88cp8aafhk', 353, 248, '', 11, 'ONLINE', 1, '1', 0, '1645592259', '2022-02-23 04:57:39', '7.5', '17.5', '100', '125.25', '0.25', '25', 0, 'undefined', 'undefined', 'order_IzKJlFugYi4mOH', 0),
(100, '96msaemmwt6jc37pwr4j', 353, 248, '', 11, 'ONLINE', 1, '1', 0, '1645592316', '2022-02-23 04:58:36', '7.5', '17.5', '100', '125.25', '0.25', '25', 0, 'undefined', 'undefined', 'order_IzKKlhqy58AsB0', 0),
(101, 'r59qle85abm7bk18ow2x', 353, 248, '', 11, 'ONLINE', 1, '1', 0, '1645596665', '2022-02-23 06:11:05', '7.5', '17.5', '100', '125.25', '0.25', '25', 0, 'undefined', 'undefined', 'order_IzLZKSWL1t2FnF', 0);

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
(1, 1, 'All naturals'),
(2, 1, 'herbals'),
(3, 1, 'Chemical Free'),
(4, 2, 'Dandruff'),
(5, 2, 'Hair fall'),
(6, 2, 'Others'),
(7, 3, 'Shampoos'),
(8, 3, 'Conditioners'),
(9, 3, 'Oils'),
(10, 4, 'Dandruff'),
(11, 4, 'Hair fall'),
(12, 4, 'Others'),
(13, 5, 'Dandruff'),
(14, 5, 'Hair fall'),
(15, 5, 'Others'),
(16, 6, 'Anti aging'),
(17, 6, 'Wrinkles'),
(18, 6, 'Oil Control '),
(19, 7, 'Allergy free'),
(20, 7, 'Dermitaligically tested '),
(21, 7, 'Chemical free'),
(25, 3, 'Creams'),
(26, 3, 'Serum Shampoos'),
(27, 3, 'Dermitaligically tested'),
(28, 3, 'Serum'),
(29, 1, 'Clinically Proven'),
(30, 6, 'Pollution Control '),
(31, 6, 'Tan removal '),
(32, 6, 'Black heads'),
(33, 6, 'White heads'),
(34, 6, 'Pores'),
(35, 7, 'Organic'),
(36, 7, 'All natual'),
(37, 8, 'Cream'),
(38, 8, 'Liquid'),
(39, 8, 'Mask'),
(40, 8, 'Gel'),
(41, 8, 'Lotion'),
(42, 8, 'Scrub '),
(43, 8, 'Foam'),
(44, 9, 'Oilly'),
(45, 9, 'Sensitive'),
(46, 9, 'Normal'),
(47, 9, 'Dry'),
(48, 10, 'normal'),
(49, 10, 'dry'),
(50, 11, 'Dry skin'),
(51, 11, 'Oilly skin'),
(52, 12, 'Soaps'),
(53, 12, 'Gel '),
(54, 12, 'Body wash '),
(55, 12, 'Cream '),
(56, 12, 'Scrub'),
(57, 13, 'Soaps'),
(58, 13, 'Gel '),
(59, 13, 'Body wash'),
(60, 13, 'Cream '),
(61, 14, 'Body wash'),
(62, 14, 'Cream '),
(63, 14, 'Scrub'),
(64, 14, 'Soaps'),
(65, 15, 'Soaps'),
(66, 15, 'Gel'),
(67, 15, 'Body wash '),
(68, 15, 'Cream '),
(69, 15, 'Scrub');

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
  `payment_option` varchar(100) NOT NULL,
  `payment_status` int(11) NOT NULL,
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
  `pay_orderid` int(11) NOT NULL,
  `pay_razerpay_id` text NOT NULL,
  `pay_transaction_id` text NOT NULL,
  `bonus_points` varchar(100) NOT NULL,
  `wallet_amount` float NOT NULL,
  `bid_id` int(11) NOT NULL,
  `accept_status` int(11) NOT NULL,
  `user_address` text NOT NULL,
  `tracking_id` varchar(100) NOT NULL,
  `tracking_name` varchar(100) NOT NULL,
  `review` int(10) NOT NULL,
  `comments` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `session_id`, `user_id`, `vendor_id`, `delivery_timeslots`, `deliveryaddress_id`, `payment_option`, `payment_status`, `order_status`, `delivery_boy`, `created_at`, `created_date`, `admin_commission`, `vendor_commission`, `deliveryboy_commission`, `total_price`, `gst`, `sub_total`, `coupon_id`, `coupon_code`, `coupon_disount`, `pay_orderid`, `pay_razerpay_id`, `pay_transaction_id`, `bonus_points`, `wallet_amount`, `bid_id`, `accept_status`, `user_address`, `tracking_id`, `tracking_name`, `review`, `comments`) VALUES
(63, '67570669438101', 352, 249, '', 12, 'ONLINE', 1, '1', 0, '1650456136', '2022-04-20 12:02:16', '47.5', '1452.5', '25', '1608', '', '1500', 0, '0', '0', 0, '', 'pay_JLbSz3zUqWdiFk', '', 0, 0, 0, 'Home: satish, Andhra Pradesh, Vizag, 530024, 44-1-19/a,jocheph church, jocheph church', '', '', 0, ''),
(64, '15134630405105', 385, 239, '', 13, 'ONLINE', 1, '1', 0, '1651672481', '2022-05-04 13:54:41', '46.45', '1311.55', '1', '1359', '', '1358', 0, '0', '0', 0, '', 'pay_JRArQpozGhxpYw', '', 0, 0, 0, 'Home: test, Andhra Pradesh, Vizag, 530016, test, test', '', '', 0, ''),
(65, '92929076157038', 384, 239, '', 16, 'COD', 0, '2', 0, '1652179504', '2022-05-21 05:49:10', '0', '858', '1', '859', '', '858', 0, '0', '0', 0, '', '', '', 0, 0, 1, 'Home: annapurna, Andhra Pradesh, Vizag, 530016, bharat towers, visakhapatnam', '', '', 0, ''),
(66, '70597005114872', 352, 240, '', 12, 'COD', 0, '1', 0, '1658494547', '2022-07-22 12:55:47', '0', '23', '300', '323', '', '23', 0, '0', '0', 0, '', '', '', 0, 0, 0, 'Home: satish, Andhra Pradesh, Vizag, 530024, 44-1-19/a,jocheph church, jocheph church', '', '', 0, '');

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
(1, '530024', 1, 1, 1),
(2, '530016', 1, 1, 1);

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
  `selling_date` varchar(100) NOT NULL,
  `cancel_status` varchar(10) NOT NULL,
  `return_status` varchar(10) NOT NULL,
  `return_noof_days` varchar(20) NOT NULL,
  `availabile_stock_status` varchar(10) NOT NULL,
  `top_deal` varchar(10) NOT NULL,
  `priority` int(11) NOT NULL,
  `package_weight` varchar(50) NOT NULL,
  `package_length` varchar(50) NOT NULL,
  `package_breadth` varchar(50) NOT NULL,
  `package_height` varchar(50) NOT NULL,
  `delete_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `seo_url`, `name`, `descp`, `cat_id`, `sub_cat_id`, `ques_id`, `option_id`, `brand`, `mrp`, `sku`, `gst`, `tax_class`, `tax`, `taxname`, `stock`, `manage_stock`, `variant_product`, `filters`, `shop_id`, `status`, `created_at`, `updated_at`, `meta_tag_title`, `meta_tag_description`, `meta_tag_keywords`, `product_tags`, `admin_commission`, `parent_id`, `key_features`, `selling_date`, `cancel_status`, `return_status`, `return_noof_days`, `availabile_stock_status`, `top_deal`, `priority`, `package_weight`, `package_length`, `package_breadth`, `package_height`, `delete_status`) VALUES
(5, '5_veg-birayani', 'veg birayani', 'Veg birayani', 1, 121, 0, '', 'test', '', '', 0.00, '', '', '', 0, 'yes', 'no', '', 241, 0, '', '', 'veg birayni', 'test', 'test', '', '', 0, 'veg birayani', '', 'no', '', '', 'available', 'yes', 0, '2', '2', '2', '2', 0),
(6, '6_veg-soup', 'veg soup', 'test', 1, 121, 0, '', 'test', '', '', 0.00, '', '', '', 0, 'yes', 'no', '', 241, 0, '', '', 'test', 'test', 'test', '', '', 0, 'test', '', 'no', '', '', 'available', 'no', 0, '2', '2', '2', '2', 0),
(7, '7_french-fries', 'french fries', 'test', 1, 121, 0, '', 'test', '', '', 0.00, '', '', '', 0, 'yes', 'no', '', 241, 0, '', '', 'test', 'test', 'test', '', '', 0, 'test', '', 'no', '', '', 'available', 'no', 0, '2', '2', '2', '2', 0),
(8, '8_veg-nuggets', 'veg nuggets', 'veg nuggets ', 1, 121, 0, '', 'test', '', '', 0.00, '', '', '', 0, 'no', 'no', '', 241, 0, '', '', 'test', 'test', 'test', '', '', 0, 'veg nuggets', '', 'no', '', '', 'available', 'no', 0, '2', '2', '2', '2', 0),
(9, '9_samosa', 'SAMOSA', 'SAMOSA', 1, 121, 0, '', 'test', '', '', 0.00, '', '', '', 0, 'yes', 'no', '', 241, 0, '', '', 'TEST', 'test', 'test', '', '', 0, 'SAMOSA', '', 'yes', '', '', 'available', 'yes', 0, '2', '2', '2', '2', 0),
(16, '16_idli-sambar', 'Idli Sambar', 'Available', 3, 123, 0, '', 'Food ', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 248, 0, '', '', 'Idli', 'Idli', 'Idli', '10,15', '', 0, 'Idli', '', 'yes', '', '1', 'available', 'yes', 0, '', '', '', '', 0),
(17, '17_chicken-biryani', 'Chicken Biryani', 'chicken fry biryani\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.', 3, 123, 0, '', 'FOOD', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 249, 0, '', '', 'BIRIYANI', 'BIRIYANI', 'BIRIYANI', '10', '', 0, 'chicken\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.', '', 'yes', '', '1', 'available', 'yes', 0, '', '', '', '', 0),
(18, '18_pakodi', 'Pakodi', 'Available', 3, 123, 0, '', 'Food ', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 248, 0, '', '', 'Pakodi', 'Pakodi', 'Pakodi', '10', '', 0, 'Available', '', 'yes', '', '7', 'available', 'yes', 0, '300 gm', '35mm', '20mm', '1m', 0),
(19, '19_mysore-bajji', 'Mysore Bajji', 'Available', 3, 123, 0, '', 'Food ', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 248, 0, '', '', 'Bajji', 'Bajji', 'Bajji', '10,15', '', 0, 'Available', '', 'yes', '', '1', 'available', 'yes', 0, '200gm', '1m', '100mm', '500mm', 0),
(21, '21_vada', 'VADA', 'Available', 3, 123, 0, '', 'Food', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 248, 0, '', '', 'Food', 'Food', 'Food', '10,15', '', 0, 'Food', '', 'yes', '', '1', 'available', 'yes', 0, '200gm', '1m', '50mm', '500mm', 0),
(22, '22_dosa', 'DOSA', 'Food', 3, 123, 0, '', 'Food', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 248, 0, '', '', 'Food', 'Food', 'Food', '10,15', '', 0, 'Food', '', 'yes', '', '1', 'available', 'yes', 0, '200gm', '1m', '100mm', '1m', 0),
(23, '23_upma', 'Upma', 'Food', 3, 123, 0, '', 'Food', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 248, 0, '', '', 'Food', 'Food', 'Food', '10,15', '', 0, 'FOOd', '', 'yes', '', '1', 'available', 'yes', 0, '200gm', '1m', '50mm', '500mm', 0),
(24, '24_chicken-fry-pieces', 'Chicken FRY PIECES', 'Chicken FRY PIECES & CHICKEN WINGS', 3, 123, 0, '', 'FRY PIECES', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 249, 0, '', '', 'Chicken FRY PIECES & CHICKEN WINGS', 'Chicken FRY PIECES & CHICKEN WINGS', 'Chicken FRY PIECES & CHICKEN WINGS', '15', '', 0, 'Chicken FRY PIECES & CHICKEN WINGS', '', 'yes', '', '1', 'available', 'yes', 0, '', '', '', '', 0),
(25, '25_dum-biryani', 'Dum Biryani', 'Food', 3, 123, 0, '', 'Food', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 248, 0, '', '', 'Food', 'Food', 'Food', '10,15', '', 0, 'Food', '', 'yes', '', '1', 'available', 'yes', 0, '200gm', '1m', '50mm', '500mm', 0),
(26, '26_chapathi', 'Chapathi', 'Food', 3, 123, 0, '', 'Food', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 248, 0, '', '', 'Food', 'Food', 'Food', '10,15', '', 0, 'Food', '', 'yes', '', '1', 'available', 'yes', 0, '200gm', '1m', '100mm', '500mm', 0),
(27, '27_chicken-noodles', 'Chicken Noodles', 'Food', 3, 123, 0, '', 'Food', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 248, 0, '', '', 'Food', 'Food', 'Food', '10,15', '', 0, 'Food', '', 'yes', '', '1', 'available', 'yes', 0, '200gm', '1m', '100mm', '500mm', 0),
(28, '28_mutton-tikka', 'Mutton Tikka', 'Food', 3, 123, 0, '', 'Food', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 248, 0, '', '', 'Food', 'Food', 'Food', '10,15', '', 0, 'Food', '', 'yes', '', '1', 'available', 'yes', 0, '200gm', '1m', '100mm', '500mm', 0),
(30, '30_soda', 'soda', 'coffee', 4, 125, 0, '', 'whsdi', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 240, 0, '', '', 'rgr', 'rg', 'drg', '', '', 0, 'coffee', '', 'yes', '', '1', 'available', 'yes', 0, '', '', '', '', 0),
(31, '31_cones', 'cones', 'cone\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal tha', 6, 127, 0, '', 'cne', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 240, 0, '', '', 'cone', 'cone', 'cone', '', '', 0, 'cone\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.Food Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.', '', 'yes', '', '3', 'available', 'yes', 5, '', '', '', '', 0),
(33, '33_thumps-up-tin', 'thumps up tin', 'w4twt4w4t', 4, 125, 0, '', 'hqwdh2qo3871adqjwp', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 240, 0, '', '', 'wtgswts', 'wsfwe43', 'fgGSE', '15', '', 0, 'rga4', '', 'yes', '', '5', 'available', 'yes', 0, '', '', '', '', 0),
(34, '34_mirchi', 'Mirchi', 'Food', 3, 123, 0, '', 'Food', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 248, 0, '', '', 'Food', 'Food', 'Food', '10,15', '', 0, 'Food', '', 'yes', '', '1', 'available', 'yes', 0, '200gm', '1m', '100mm', '500mm', 0),
(35, '35_fish-fry', 'Fish Fry', 'Sea Foods Available\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\nSea Foods Available\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firs', 3, 123, 0, '', 'Food', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 248, 0, '', '', 'Foods', 'Foods', 'Foods', '10,15', '', 0, 'Sea Foods Available\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.', '', 'yes', '', '1', 'available', 'yes', 0, '200gm', '1m', '100mm', '500mm', 0),
(37, '37_sds', 'sds', 'sasEHFUHQWEHqdgb3hqwrfw', 11, 137, 0, '', 'STATERS', '', '', 0.00, '', '', '', 0, 'no', 'yes', '', 249, 0, '', '', 'ss', 'ss', 'ss', '10', '', 0, '', '', 'yes', '', 'ssaawsss', 'available', 'no', 0, '', '', '', '', 0),
(38, '38_laddu', 'LADDU', 'BOONDI LADDU', 9, 134, 0, '', 'SWEETS', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 249, 0, '', '', 'BOONDI LADDU', 'BOONDI LADDU', 'BOONDI LADDU', '15', '', 0, 'BOONDI LADDU', '', 'yes', '', '1', 'available', 'yes', 0, '', '', '', '', 0),
(39, '39_chicken-biryani', 'Chicken Biryani', 'chicken fry biryani\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.', 3, 123, 0, '', '           ', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 265, 0, '', '', 'BIRIYANI', 'BIRIYANI', 'BIRIYANI', '', '', 0, 'chicken\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.\r\nFood Essay: Food is the basic materisal that the body needs for its survival and well-being. The human diet is not restricted to any special category of Food. The human body needs a variety of the following five nutrients – protein, carbohydrate, fat, vitamins, and minerals – which comes from the Food we eat to stay healthy, active, and productive. Firstly, protein is required to build, maintain, and restore blood, muscle, bones, and skin, and organs in the body.\r\n\r\nThere are such a wide range of cooking styles and food inclinations worked by social and ethnic foundations, topographical areas, and social classes. India is a place that is known for flavours, Africa is a mainland of sauces, Europe unveils esthetical excellence of Food and opens up new chances and innovations for the individuals who esteem.', '', 'yes', 'yes', '', 'available', 'yes', 0, '', '', '', '', 0),
(40, '40_dosa', 'DOSA', 'DOSA, PURI, IDLI', 10, 135, 0, '', 'Food', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 265, 0, '', '', 'DOSA, PURI, IDLI', 'FoodDOSA, PURI, IDLI', 'FoodDOSA, PURI, IDLI', '', '', 0, 'DOSA, PURI, IDLI', '', 'yes', '', '', 'available', 'yes', 0, '', '', '', '', 0),
(41, '41_puri', 'PURI', 'PURI', 10, 136, 0, '', 'Food', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 265, 0, '', '', 'PURI', 'PURI', 'PURI', '', '', 0, 'PURI', '', 'yes', '', '0', 'available', 'yes', 0, '', '', '', '', 0),
(42, '42_chicken-haleem', 'CHICKEN HALEEM', 'CHICKEN HALEEM', 8, 132, 0, '', 'HALEEM', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 265, 0, '', '', 'CHICKEN HALEEM', 'CHICKEN HALEEM', 'CHICKEN HALEEM', '', '', 0, 'CHICKEN HALEEM', '', 'yes', '', '1', 'available', 'yes', 0, '', '', '', '', 0),
(43, '43_mutton-haleem', 'MUTTON HALEEM', 'MUTTON HALEEM', 8, 131, 0, '', 'HALEEM', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 265, 0, '', '', 'MUTTON HALEEM', 'MUTTON HALEEM', 'MUTTON HALEEM', '', '', 0, 'MUTTON HALEEM', '', 'yes', '', '1', 'available', 'yes', 0, '', '', '', '', 0),
(44, '44_tikka-haleem', 'TIKKA HALEEM', 'TIKKA HALEEM', 8, 133, 0, '', 'HALEEM', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 265, 0, '', '', 'TIKKA HALEEM', 'TIKKA HALEEM', 'TIKKA HALEEM', '', '', 0, 'TIKKA HALEEM', '', 'yes', '', '1', 'available', 'yes', 0, '', '', '', '', 0),
(45, '45_cones', 'CONES', 'CONES', 6, 127, 0, '', 'ICE CREAMS', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 265, 0, '', '', 'CONES', 'CONES', 'CONES', '', '', 0, 'CONES', '', 'yes', 'yes', '0', 'available', 'yes', 0, '', '', '', '', 0),
(46, '46_diet-soup', 'DIET SOUP', 'DIET SOUP', 5, 126, 0, '', 'SOUPS', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 265, 0, '', '', 'DIET SOUP', 'DIET SOUP', 'DIET SOUP', '', '', 0, 'DIET SOUP', '', 'yes', '', '1', 'available', 'yes', 0, '', '', '', '', 0),
(47, '47_cool-drinks', 'COOL DRINKS', 'COOL DRINKS', 4, 125, 0, '', 'DRINKS', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 265, 0, '', '', 'COOL DRINKS', 'COOL DRINKS', 'COOL DRINKS', '', '', 0, 'COOL DRINKS', '', 'yes', '', '1', 'available', 'yes', 0, '', '', '', '', 0),
(48, '48_laddu', 'LADDU', 'LADDU', 9, 134, 0, '', 'SWEETS', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 265, 0, '', '', 'LADDU', 'LADDU', 'LADDU', '', '', 0, 'LADDU', '', 'yes', '', '1', 'available', 'yes', 0, '', '', '', '', 0),
(49, '49_paneer-masala-curry', 'PANEER MASALA CURRY ', 'PANEER MASALA CURRY ', 7, 129, 0, '', 'PANEER', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 265, 0, '', '', 'PANEER MASALA CURRY ', 'PANEER MASALA CURRY ', 'PANEER MASALA CURRY ', '', '', 0, 'PANEER MASALA CURRY ', '', 'yes', 'no', '1', 'available', 'yes', 0, '', '', '', '', 0),
(50, '50_paneer-masala-curry-2', 'PANEER MASALA CURRY 2', 'PANEER MASALA CURRY 2', 7, 130, 0, '', 'PANEER', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 265, 0, '', '', 'PANEER MASALA CURRY 2', 'PANEER MASALA CURRY 2', 'PANEER MASALA CURRY 2', '', '', 0, 'PANEER MASALA CURRY 2', '', 'yes', '', '1', 'available', 'yes', 0, '', '', '', '', 0),
(52, '52_paneer-masala-curry', 'PANEER MASALA CURRY ', 'PANEER MASALA CURRY CURRY', 7, 129, 0, '', 'PANEER', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 265, 0, '', '', 'PANEER MASALA CURRY ', 'PANEER MASALA CURRY ', 'PANEER MASALA CURRY ', '', '', 0, 'PANEER MASALA CURRY ', '', 'yes', 'no', '1', 'available', 'yes', 0, '', '', '', '', 0),
(53, '53_onion-hair-oil-for-hair-growth-and-hair-fall-control', 'Onion hair oil for hair growth and hair fall control', 'Hair Care', 14, 145, 0, '', 'Brand', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 249, 0, '', '', 'Hair Care', 'Hair Care', 'Hair Care', '            ', '', 0, 'Hair Care', '', 'no', '', '', 'available', 'yes', 0, '', '', '', '', 0),
(54, '54_chicken-fry-pieces', 'Chicken FRY PIECES', 'Chicken FRY PIECES & CHICKEN WINGS', 3, 123, 0, '', 'FRY PIECES', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 249, 0, '', '', 'Chicken FRY PIECES & CHICKEN WINGS', 'Chicken FRY PIECES & CHICKEN WINGS', 'Chicken FRY PIECES & CHICKEN WINGS', '15', '', 0, 'Chicken FRY PIECES & CHICKEN WINGS', '', 'yes', '', '1', 'available', 'yes', 0, '', '', '', '', 0),
(55, '55_fitkari-after-shave-gel-for-men', 'Fitkari After Shave Gel For Men', 'Shaving', 12, 143, 0, '', 'Shaving', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 239, 1, '', '', 'Shaving', 'Shaving', 'Shaving', '10', '', 0, 'Shaving', '', 'yes', '', '3', 'available', 'yes', 1, '', '', '', '', 0),
(56, '56_testing-product', 'testing product', 'testing product', 12, 143, 0, '', 'testing product', '', '', 0.00, '', '', '', 0, 'yes', 'no', '', 239, 0, '', '', 'testing product', 'testing product', 'testing product', '10,15', '', 0, 'testing product', '', 'no', '', '', '', 'yes', 1, '12', '12', '12', '12', 0),
(57, '57_onion-hair-oil-for-hair-growth-and-hair-fall-control', 'Onion hair oil for hair growth and hair fall control', 'Onion hair oil for hair growth and hair fall control', 14, 145, 2, '4,5', 'Brand', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 239, 1, '', '', 'Onion hair oil for hair growth and hair fall control', 'Onion hair oil for hair growth and hair fall control', 'Onion hair oil for hair growth and hair fall control', '10', '', 0, 'Onion hair oil for hair growth and hair fall control', '', 'no', '', '', 'available', 'yes', 2, '', '', '', '', 0),
(58, '58_ustra-tan-den-cream', 'Ustra Tan Den Cream', 'Ustra Tan Den Cream', 13, 144, 0, '', 'Brand', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 239, 1, '', '', 'Ustra Tan Den Cream', 'Ustra Tan Den Cream', 'Ustra Tan Den Cream', '10', '', 0, 'Ustra Tan Den Cream', '', 'no', '', '', 'available', 'yes', 3, '1', '1', '1', '1', 0),
(59, '59_nivea-men-body-wash-pure-impact', 'NIVEA Men Body Wash, Pure Impact ', 'NIVEA Men Body Wash, Pure Impact ', 15, 146, 7, '20,21,35', 'Brand2', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 239, 1, '', '', 'NIVEA Men Body Wash, Pure Impact ', 'NIVEA Men Body Wash, Pure Impact ', 'NIVEA Men Body Wash, Pure Impact ', '10', '', 0, 'NIVEA Men Body Wash, Pure Impact ', '', 'no', '', '', 'available', 'yes', 3, '', '', '', '', 0),
(60, '60_test', 'test', 'test', 12, 143, 0, '', 'test', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 239, 1, '', '', 'test', 'test', 'test', '', '', 0, 'test', '', 'no', '', '', 'available', 'yes', 1, '12', '12', '12', '12', 0),
(61, '', 'Hair Fall Cream', 'xfhmvhmv', 14, 145, 1, '1,2,3,29', 'hkfrbehmte', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 239, 1, '', '', 'dhuvyk,ubiyd', 'trhkri7t', 'hkgtr65z3z4', '10', '', 0, 'mjvhmjvbhjb', '', 'yes', '', '20', 'available', 'yes', 25, '', '', '', '', 0),
(62, '', 'Chandan', 'fgbbdfgb', 14, 145, 3, '7,9,26', 'Chandan', '', '', 0.00, '', '', '', 0, 'yes', 'yes', '', 240, 1, '', '', 'evwfv', 'svv', 'dbdsfv', '10,15', '', 0, 'bevs', '', 'yes', '', '', 'available', 'yes', 1, '', '', '', '', 0);

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

--
-- Dumping data for table `product_filter`
--

INSERT INTO `product_filter` (`id`, `product_id`, `filter_id`, `filter_options`) VALUES
(1, 77, '1', '2,4'),
(2, 77, '2', '10,11'),
(3, 75, '1', '2,4'),
(4, 75, '2', '10,11'),
(5, 60, '1', '2,3'),
(6, 60, '2', '10,11'),
(7, 57, '1', '2,3,4'),
(8, 61, '1', '2,5'),
(9, 61, '2', '10,11,12'),
(10, 59, '1', '4,5'),
(11, 59, '2', '9,11'),
(12, 62, '1', '2,4'),
(13, 62, '2', '10,12');

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

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `variant_id`, `image`, `created_at`) VALUES
(6118, 1, 1, '20210615134615710754.png', ''),
(6119, 2, 2, '202106151349567615581.png', ''),
(6120, 3, 3, '202106151351435719186.png', ''),
(6121, 5, 4, '202106171024597067868.png', ''),
(6122, 6, 5, '202106171028022204203.png', ''),
(6123, 7, 6, '202106171030011370836.png', ''),
(6124, 8, 7, '202106171032074144156.png', ''),
(6125, 9, 8, '202106171033445874957.png', ''),
(6126, 10, 9, '202108171634441099929.png', ''),
(6127, 11, 10, '202108171639433701334.png', ''),
(6128, 13, 11, '202108171705214813295.png', ''),
(6129, 16, 12, '202109271624017682194_idli.jpg', ''),
(6133, 19, 15, '20210927164302829748_mysore_bajji.jpg', ''),
(6132, 18, 14, '202109271636298108257_pakodi.jpg', ''),
(6134, 17, 13, '202109271643194147601_gg.jpg', ''),
(6135, 17, 13, '202109271645377063018_b2.jpg', ''),
(6138, 17, 16, '202109281810442886994_whatsapp_image_2021_09_28_at_18.09.02.jpeg', ''),
(6137, 17, 16, '20210928181025138783_whatsapp_image_2021_09_28_at_18.08.12.jpeg', ''),
(6139, 17, 16, '202109281810507162171_whatsapp_image_2021_09_28_at_18.09.25.jpeg', ''),
(6140, 20, 19, '202109281843069122142_whatsapp_image_2021_09_28_at_18.40.54.jpeg', ''),
(6141, 20, 19, '20210928184311920650_whatsapp_image_2021_09_28_at_18.41.14.jpeg', ''),
(6142, 20, 19, '202109281843186098721_whatsapp_image_2021_09_28_at_18.41.32.jpeg', ''),
(6143, 20, 19, '202109281843233197310_whatsapp_image_2021_09_28_at_18.41.59.jpeg', ''),
(6144, 20, 19, '202109281843271672497_whatsapp_image_2021_09_28_at_18.42.21.jpeg', ''),
(6145, 21, 20, '202109291238106087942_vada.jpg', ''),
(6146, 22, 22, '202109291242505791399_dosa.jpg', ''),
(6147, 23, 23, '202109291414221543806_upma.jpg', ''),
(6148, 19, 17, '202109291420417152598_mysore_bajji.jpg', ''),
(6149, 24, 24, '202109291707595881280_whatsapp_image_2021_09_28_at_18.41.14.jpeg', ''),
(6150, 24, 24, '202109291708079937561_whatsapp_image_2021_09_28_at_18.41.32.jpeg', ''),
(6151, 24, 24, '202109291708166475891_whatsapp_image_2021_09_28_at_18.42.21.jpeg', ''),
(6153, 25, 25, '202109291728465509424_download.jpg', ''),
(6154, 26, 26, '202109291754279911891_download__1_.jpg', ''),
(6155, 27, 27, '202109291759453363399_chicken_noodles.jpg', ''),
(6156, 28, 28, '202109291804198843814_images.jpg', ''),
(6157, 29, 29, '20210929185354716156.png', ''),
(6159, 30, 30, '202109301823469651720_sd1.jpg', ''),
(6160, 33, 33, '20210930183051127839_whatsapp_image_2021_09_30_at_18.27.53.jpeg', ''),
(6161, 31, 32, '202109301831354081767_whatsapp_image_2021_09_30_at_18.27.53__2_.jpeg', ''),
(6162, 31, 32, '202109301831405660281_whatsapp_image_2021_09_30_at_18.27.53__1_.jpeg', ''),
(6163, 34, 35, '202109301841228667487_images__1_.jpg', ''),
(6164, 35, 36, '202109301846061974257_download__2_.jpg', ''),
(6165, 28, 34, '202109301854074784181_images.jpg', ''),
(6167, 17, 38, '202110051445339929732_whatsapp_image_2021_09_28_at_18.09.02.jpeg', ''),
(6168, 17, 38, '202110051445435935539_whatsapp_image_2021_09_28_at_18.08.12.jpeg', ''),
(6169, 17, 38, '202110051445504080742_whatsapp_image_2021_09_28_at_18.09.25.jpeg', ''),
(6170, 24, 13292, '202110051539469165424_whatsapp_image_2021_09_28_at_18.41.59.jpeg', ''),
(6171, 24, 13288, '202110051540076543661_whatsapp_image_2021_09_28_at_18.41.32.jpeg', ''),
(6172, 39, 13301, '202110081055318424923_whatsapp_image_2021_09_28_at_18.09.02.jpeg', ''),
(6173, 39, 13302, '202110081055401570284_whatsapp_image_2021_09_28_at_18.08.12.jpeg', ''),
(6174, 39, 13303, '202110081055509409044_whatsapp_image_2021_09_28_at_18.09.25.jpeg', ''),
(6175, 40, 13306, '202110081120046516484_whatsapp_image_2021_10_08_at_11.18.20__1_.jpeg', ''),
(6176, 41, 13308, '202110081129568155031_whatsapp_image_2021_10_08_at_11.18.20__16_.jpeg', ''),
(6177, 42, 13309, '202110081132513343842_whatsapp_image_2021_10_08_at_11.31.58.jpeg', ''),
(6178, 43, 13310, '202110081135009660615_whatsapp_image_2021_10_08_at_11.33.40__1_.jpeg', ''),
(6179, 44, 13311, '20211008113543468291_whatsapp_image_2021_10_08_at_11.33.40.jpeg', ''),
(6185, 45, 13312, '202110081137036543581_whatsapp_image_2021_10_08_at_11.18.20__15_.jpeg', ''),
(6194, 48, 13315, '202110081151355993380_whatsapp_image_2021_10_08_at_11.18.20__2_.jpeg', ''),
(6191, 46, 13313, '202110081143274677099_whatsapp_image_2021_10_08_at_11.18.20__7_.jpeg', ''),
(6192, 47, 13314, '202110081144472729042_whatsapp_image_2021_10_08_at_11.18.20.jpeg', ''),
(6189, 45, 13312, '202110081137144388507_whatsapp_image_2021_10_08_at_11.18.20__6_.jpeg', ''),
(6193, 47, 13314, '202110081144544415545_whatsapp_image_2021_10_08_at_11.18.20__3_.jpeg', ''),
(6195, 49, 13316, '202110081152147775199_whatsapp_image_2021_10_08_at_11.18.20__5_.jpeg', ''),
(6196, 50, 13317, '202110081152382734593_whatsapp_image_2021_10_08_at_11.18.20__4_.jpeg', ''),
(6197, 52, 13318, '20211008124729999640_whatsapp_image_2021_10_08_at_11.18.20__5_.jpeg', ''),
(6198, 24, 13292, '202110121221126146040_whatsapp_image_2021_10_08_at_11.18.20__4_.jpeg', ''),
(6199, 24, 13292, '202110121221122490696_whatsapp_image_2021_10_08_at_11.18.20__4_.jpeg', ''),
(6200, 24, 13292, '202110121221126313748_whatsapp_image_2021_10_08_at_11.18.20__4_.jpeg', ''),
(6201, 24, 13292, '202110121221133179592_whatsapp_image_2021_10_08_at_11.18.20__4_.jpeg', ''),
(6202, 24, 13292, '202110121221134404461_whatsapp_image_2021_10_08_at_11.18.20__4_.jpeg', ''),
(6203, 17, 38, '202110121224488820434_whatsapp_image_2021_10_08_at_11.18.20__3_.jpeg', ''),
(6204, 17, 38, '202110121224481602738_whatsapp_image_2021_10_08_at_11.18.20__3_.jpeg', ''),
(6205, 17, 38, '202110121224484291307_whatsapp_image_2021_10_08_at_11.18.20__3_.jpeg', ''),
(6206, 17, 38, '202110121224497779474_whatsapp_image_2021_10_08_at_11.18.20__3_.jpeg', ''),
(6207, 24, 13323, '20211012122639359616_whatsapp_image_2021_09_28_at_18.41.32.jpeg', ''),
(6208, 53, 13328, '202110121230417210652_whatsapp_image_2021_09_28_at_18.41.32.jpeg', ''),
(6209, 54, 13333, '202110121232553686182_whatsapp_image_2021_09_28_at_18.41.32.jpeg', ''),
(6210, 56, 13338, '202204221720567135957.png', ''),
(6213, 55, 13339, '202204221830475292875_product_1.jpg', ''),
(6214, 57, 13343, '202204221903009758215_product_2.jpg', ''),
(6215, 58, 13344, '20220422192708299628_product_3.jpg', ''),
(6216, 59, 13345, '202204221944152791097_product_4.jpg', ''),
(6218, 61, 13349, '202207221714399821562_refresh.png', ''),
(6219, 60, 13346, '202207221740383909943_refresh.png', ''),
(6220, 62, 13350, '202207221822504223143_refresh.png', ''),
(6221, 62, 13351, '202207221823286199721_refresh.png', '');

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

--
-- Dumping data for table `promotion_notifications`
--

INSERT INTO `promotion_notifications` (`id`, `select_user_type`, `title`, `description`, `user_id`, `created_date`) VALUES
(1, 'individual', 'test', 'test', 353, '2021-06-25 12:37:23'),
(2, 'individual', 'test', 'test', 354, '2021-06-25 13:12:52'),
(3, 'individual', 'test', 'test', 354, '2021-06-25 13:13:36'),
(4, 'all', 'Get notified', 'abcd', 0, '2021-09-29 06:47:29'),
(5, 'individual', 'test', 'test', 360, '2021-09-29 10:32:59'),
(6, 'individual', 'Hi', 'Hi', 357, '2021-09-29 10:33:13'),
(7, 'individual', 'Flat 80% off', 'Only for Premium customers', 357, '2021-09-30 07:02:44'),
(8, 'individual', 'today deals', 'flat 50%', 357, '2021-09-30 07:03:56'),
(9, 'individual', 'happy', 'happy', 357, '2021-09-30 07:04:22'),
(10, 'individual', ' ', ' ', 350, '2021-10-07 09:32:44'),
(11, 'all', 'HELLO USER\'S', 'HELLO USER\'S', 0, '2021-10-07 09:33:46'),
(12, 'all', 'NOTIFICATIONS NO', 'NOTIFICATIONS NO\r\n', 0, '2021-10-07 09:35:46'),
(13, 'individual', '20% off', 'hii', 379, '2022-02-16 06:11:23'),
(14, 'individual', 'hiii', '20% off', 377, '2022-02-16 06:12:50'),
(15, 'individual', 'hi ', '20% off', 379, '2022-02-16 06:15:32');

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
(1, 14, 0, 'Dandruff', '1', '1'),
(2, 14, 0, 'Dry & dull hair ', '1', '2'),
(3, 14, 0, 'Hair Fall', '1', '3'),
(4, 14, 0, 'Dull', '1', '4'),
(5, 14, 0, 'Skip', '1', '5'),
(6, 15, 0, 'Tan ', '1', '6'),
(7, 15, 0, 'Dry skin ', '1', '7'),
(8, 15, 0, 'Oily skin', '1', '8'),
(9, 15, 0, 'Pimples ', '1', '9'),
(10, 15, 0, 'Acne ', '1', '10'),
(11, 15, 0, 'Dark spots', '1', '11'),
(12, 20, 0, 'Dry skin ', '1', '12'),
(13, 20, 0, 'Oily skin ', '1', '13'),
(14, 20, 0, 'Senstive skin ', '1', '14'),
(15, 20, 0, 'Normal skin ', '1', '15');

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
  `status` int(11) NOT NULL,
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

--
-- Dumping data for table `shop_visit`
--

INSERT INTO `shop_visit` (`id`, `shop_id`, `user_id`, `created_date`) VALUES
(3457, 239, 26, '2021-06-15 08:28:26'),
(3458, 239, 26, '2021-06-15 08:32:28'),
(3459, 239, 26, '2021-06-15 08:36:29'),
(3460, 239, 26, '2021-06-15 08:54:18'),
(3461, 239, 26, '2021-06-15 09:03:32'),
(3462, 239, 26, '2021-06-15 09:04:59'),
(3463, 239, 26, '2021-06-15 09:08:04'),
(3464, 239, 26, '2021-06-15 09:10:28'),
(3465, 239, 26, '2021-06-15 09:11:30'),
(3466, 239, 26, '2021-06-15 09:17:46'),
(3467, 239, 26, '2021-06-15 10:37:31'),
(3468, 239, 26, '2021-06-16 06:31:11'),
(3469, 239, 26, '2021-06-16 06:32:03'),
(3470, 239, 26, '2021-06-16 06:32:13'),
(3471, 239, 26, '2021-06-16 06:45:14'),
(3472, 239, 26, '2021-06-16 07:07:03'),
(3473, 241, 349, '2021-06-17 09:07:41'),
(3474, 239, 349, '2021-06-18 10:50:01'),
(3475, 239, 26, '2021-06-21 07:02:16'),
(3476, 239, 349, '2021-06-21 11:04:09'),
(3477, 239, 349, '2021-06-21 11:15:40'),
(3478, 239, 349, '2021-06-21 11:29:59'),
(3479, 239, 349, '2021-06-21 11:34:41'),
(3480, 239, 349, '2021-06-21 11:34:51'),
(3481, 239, 349, '2021-06-21 11:35:05'),
(3482, 239, 349, '2021-06-21 11:39:36'),
(3483, 241, 349, '2021-06-21 11:40:27'),
(3484, 239, 349, '2021-06-21 11:42:33'),
(3485, 241, 349, '2021-06-21 11:42:43'),
(3486, 239, 349, '2021-06-21 13:05:29'),
(3487, 239, 353, '2021-06-21 13:20:33'),
(3488, 239, 353, '2021-06-21 13:21:53'),
(3489, 239, 26, '2021-06-22 04:40:49'),
(3490, 241, 26, '2021-06-22 04:40:56'),
(3491, 239, 353, '2021-06-22 04:47:00'),
(3492, 241, 353, '2021-06-22 04:47:06'),
(3493, 239, 352, '2021-06-22 10:59:11'),
(3494, 241, 352, '2021-06-22 10:59:33'),
(3495, 239, 353, '2021-06-22 11:39:46'),
(3496, 239, 353, '2021-06-22 11:41:48'),
(3497, 239, 353, '2021-06-22 11:47:26'),
(3498, 239, 353, '2021-06-22 12:23:22'),
(3499, 239, 353, '2021-06-22 12:24:04'),
(3500, 239, 353, '2021-06-22 12:45:34'),
(3501, 239, 353, '2021-06-22 12:46:15'),
(3502, 239, 353, '2021-06-23 10:34:24'),
(3503, 241, 353, '2021-06-23 10:35:48'),
(3504, 239, 353, '2021-06-23 10:51:55'),
(3505, 239, 37, '2021-06-23 13:03:24'),
(3506, 241, 37, '2021-06-23 13:03:37'),
(3507, 239, 353, '2021-06-23 13:04:35'),
(3508, 241, 353, '2021-06-23 13:04:44'),
(3509, 239, 353, '2021-06-23 13:06:30'),
(3510, 239, 352, '2021-06-24 07:36:24'),
(3511, 239, 352, '2021-06-24 07:36:51'),
(3512, 239, 353, '2021-06-24 10:00:29'),
(3513, 239, 353, '2021-06-24 10:02:36'),
(3514, 241, 353, '2021-06-24 10:02:46'),
(3515, 239, 353, '2021-06-25 06:21:39'),
(3516, 239, 354, '2021-06-25 13:14:01'),
(3517, 239, 354, '2021-09-04 06:21:35'),
(3518, 239, 353, '2021-09-06 10:40:36'),
(3519, 239, 355, '2021-09-27 08:52:38'),
(3520, 241, 355, '2021-09-27 08:53:01'),
(3521, 241, 355, '2021-09-27 08:53:52'),
(3522, 239, 355, '2021-09-27 08:54:01'),
(3523, 241, 355, '2021-09-27 08:54:17'),
(3524, 239, 355, '2021-09-27 08:57:31'),
(3525, 241, 355, '2021-09-27 08:57:37'),
(3526, 239, 355, '2021-09-27 09:42:02'),
(3527, 241, 355, '2021-09-27 09:42:07'),
(3528, 239, 357, '2021-09-27 10:00:41'),
(3529, 241, 357, '2021-09-27 10:00:52'),
(3530, 241, 355, '2021-09-27 10:21:44'),
(3531, 241, 355, '2021-09-27 10:21:58'),
(3532, 248, 355, '2021-09-27 10:44:27'),
(3533, 248, 355, '2021-09-27 10:55:32'),
(3534, 248, 355, '2021-09-27 11:17:45'),
(3535, 248, 355, '2021-09-27 11:18:07'),
(3536, 248, 355, '2021-09-27 11:20:40'),
(3537, 248, 355, '2021-09-27 11:21:07'),
(3538, 248, 355, '2021-09-27 11:22:47'),
(3539, 248, 355, '2021-09-27 11:26:15'),
(3540, 248, 357, '2021-09-27 12:57:22'),
(3541, 248, 355, '2021-09-27 13:45:20'),
(3542, 248, 355, '2021-09-27 13:48:38'),
(3543, 248, 355, '2021-09-27 13:51:09'),
(3544, 248, 357, '2021-09-27 13:56:07'),
(3545, 248, 355, '2021-09-28 04:55:25'),
(3546, 239, 357, '2021-09-28 05:03:38'),
(3547, 248, 357, '2021-09-28 05:13:27'),
(3548, 239, 355, '2021-09-28 05:15:35'),
(3549, 248, 355, '2021-09-28 05:52:00'),
(3550, 248, 355, '2021-09-28 06:08:12'),
(3551, 248, 355, '2021-09-28 07:09:04'),
(3552, 239, 357, '2021-09-28 07:13:31'),
(3553, 248, 357, '2021-09-28 07:14:30'),
(3554, 248, 355, '2021-09-28 07:15:05'),
(3555, 248, 355, '2021-09-28 07:16:30'),
(3556, 248, 355, '2021-09-28 07:17:11'),
(3557, 248, 355, '2021-09-28 07:17:15'),
(3558, 248, 355, '2021-09-28 07:17:35'),
(3559, 248, 355, '2021-09-28 07:21:16'),
(3560, 239, 357, '2021-09-28 09:35:53'),
(3561, 239, 357, '2021-09-28 09:35:59'),
(3562, 239, 355, '2021-09-28 09:48:20'),
(3563, 249, 357, '2021-09-28 12:35:32'),
(3564, 249, 357, '2021-09-28 12:42:00'),
(3565, 249, 357, '2021-09-28 12:57:06'),
(3566, 248, 355, '2021-09-28 12:57:57'),
(3567, 249, 357, '2021-09-28 12:58:44'),
(3568, 249, 357, '2021-09-28 13:01:33'),
(3569, 241, 355, '2021-09-28 13:16:33'),
(3570, 248, 355, '2021-09-29 06:51:54'),
(3571, 249, 357, '2021-09-29 06:57:20'),
(3572, 249, 357, '2021-09-29 06:57:49'),
(3573, 249, 357, '2021-09-29 07:00:56'),
(3574, 248, 357, '2021-09-29 07:01:01'),
(3575, 239, 357, '2021-09-29 07:01:10'),
(3576, 249, 357, '2021-09-29 07:11:59'),
(3577, 249, 357, '2021-09-29 07:13:27'),
(3578, 249, 357, '2021-09-29 07:13:31'),
(3579, 248, 355, '2021-09-29 07:16:36'),
(3580, 248, 357, '2021-09-29 07:16:44'),
(3581, 249, 357, '2021-09-29 07:16:56'),
(3582, 248, 357, '2021-09-29 07:17:10'),
(3583, 249, 357, '2021-09-29 07:17:17'),
(3584, 248, 355, '2021-09-29 07:17:28'),
(3585, 249, 357, '2021-09-29 07:20:49'),
(3586, 249, 357, '2021-09-29 07:21:14'),
(3587, 249, 357, '2021-09-29 07:21:25'),
(3588, 249, 357, '2021-09-29 07:22:05'),
(3589, 249, 357, '2021-09-29 07:22:37'),
(3590, 249, 357, '2021-09-29 07:24:40'),
(3591, 249, 357, '2021-09-29 07:24:50'),
(3592, 248, 355, '2021-09-29 08:35:20'),
(3593, 248, 355, '2021-09-29 08:39:59'),
(3594, 248, 355, '2021-09-29 08:46:55'),
(3595, 248, 355, '2021-09-29 08:49:12'),
(3596, 248, 355, '2021-09-29 08:51:24'),
(3597, 249, 357, '2021-09-29 08:53:12'),
(3598, 249, 357, '2021-09-29 08:53:24'),
(3599, 249, 355, '2021-09-29 09:02:00'),
(3600, 249, 357, '2021-09-29 09:31:43'),
(3601, 241, 355, '2021-09-29 09:33:17'),
(3602, 239, 355, '2021-09-29 09:33:23'),
(3603, 249, 357, '2021-09-29 09:36:43'),
(3604, 249, 357, '2021-09-29 09:37:26'),
(3605, 249, 357, '2021-09-29 09:37:30'),
(3606, 249, 355, '2021-09-29 11:00:42'),
(3607, 249, 357, '2021-09-29 11:29:49'),
(3608, 249, 355, '2021-09-29 11:29:51'),
(3609, 249, 357, '2021-09-29 11:34:54'),
(3610, 249, 357, '2021-09-29 11:38:57'),
(3611, 248, 355, '2021-09-29 11:40:36'),
(3612, 249, 357, '2021-09-29 12:33:27'),
(3613, 248, 355, '2021-09-29 12:40:38'),
(3614, 248, 355, '2021-09-29 12:53:19'),
(3615, 241, 355, '2021-09-29 12:53:44'),
(3616, 248, 355, '2021-09-29 12:55:09'),
(3617, 248, 355, '2021-09-30 06:02:58'),
(3618, 248, 353, '2021-09-30 06:06:20'),
(3619, 249, 353, '2021-09-30 06:06:35'),
(3620, 249, 353, '2021-09-30 06:07:32'),
(3621, 248, 360, '2021-09-30 07:06:58'),
(3622, 249, 360, '2021-09-30 07:07:19'),
(3623, 248, 360, '2021-09-30 07:07:52'),
(3624, 248, 360, '2021-09-30 07:23:39'),
(3625, 239, 357, '2021-09-30 09:40:17'),
(3626, 240, 357, '2021-09-30 09:51:08'),
(3627, 249, 357, '2021-09-30 09:51:32'),
(3628, 240, 357, '2021-09-30 09:51:41'),
(3629, 240, 360, '2021-09-30 09:53:58'),
(3630, 240, 360, '2021-09-30 09:54:03'),
(3631, 249, 357, '2021-09-30 11:37:59'),
(3632, 249, 357, '2021-09-30 11:39:55'),
(3633, 249, 357, '2021-09-30 12:01:31'),
(3634, 249, 357, '2021-09-30 12:02:00'),
(3635, 249, 357, '2021-09-30 12:05:33'),
(3636, 249, 357, '2021-09-30 12:05:53'),
(3637, 249, 360, '2021-09-30 12:06:30'),
(3638, 248, 357, '2021-09-30 12:06:40'),
(3639, 240, 357, '2021-09-30 12:09:41'),
(3640, 248, 360, '2021-09-30 12:10:33'),
(3641, 248, 360, '2021-09-30 12:13:56'),
(3642, 249, 357, '2021-09-30 12:17:22'),
(3643, 249, 357, '2021-09-30 12:24:46'),
(3644, 249, 357, '2021-09-30 12:26:23'),
(3645, 240, 360, '2021-09-30 12:54:04'),
(3646, 248, 360, '2021-09-30 12:54:36'),
(3647, 240, 357, '2021-09-30 13:02:07'),
(3648, 240, 357, '2021-09-30 13:02:12'),
(3649, 248, 360, '2021-09-30 13:20:23'),
(3650, 248, 360, '2021-09-30 13:22:05'),
(3651, 248, 360, '2021-09-30 13:24:49'),
(3652, 248, 360, '2021-09-30 13:32:05'),
(3653, 249, 357, '2021-10-01 05:55:55'),
(3654, 248, 357, '2021-10-01 06:09:59'),
(3655, 248, 357, '2021-10-01 06:12:29'),
(3656, 249, 357, '2021-10-01 09:40:59'),
(3657, 249, 357, '2021-10-01 11:04:18'),
(3658, 240, 357, '2021-10-01 13:25:52'),
(3659, 240, 357, '2021-10-01 13:25:59'),
(3660, 249, 357, '2021-10-01 13:26:18'),
(3661, 249, 357, '2021-10-01 13:27:02'),
(3662, 249, 357, '2021-10-02 07:44:13'),
(3663, 240, 357, '2021-10-02 07:46:18'),
(3664, 240, 365, '2021-10-02 07:50:54'),
(3665, 241, 365, '2021-10-02 07:52:16'),
(3666, 248, 365, '2021-10-02 07:53:09'),
(3667, 240, 357, '2021-10-02 07:58:57'),
(3668, 240, 357, '2021-10-02 08:02:04'),
(3669, 240, 365, '2021-10-02 08:06:30'),
(3670, 239, 357, '2021-10-02 08:14:04'),
(3671, 240, 357, '2021-10-02 08:14:21'),
(3672, 239, 357, '2021-10-02 08:17:36'),
(3673, 239, 365, '2021-10-02 08:19:08'),
(3674, 249, 357, '2021-10-02 08:25:50'),
(3675, 249, 357, '2021-10-04 05:46:22'),
(3676, 248, 365, '2021-10-04 06:13:56'),
(3677, 248, 365, '2021-10-04 06:20:51'),
(3678, 239, 365, '2021-10-04 06:38:24'),
(3679, 249, 357, '2021-10-04 06:58:15'),
(3680, 249, 357, '2021-10-04 07:03:33'),
(3681, 249, 357, '2021-10-04 07:03:47'),
(3682, 249, 357, '2021-10-04 08:28:17'),
(3683, 249, 357, '2021-10-04 08:31:20'),
(3684, 249, 357, '2021-10-04 08:31:36'),
(3685, 249, 357, '2021-10-04 08:32:13'),
(3686, 249, 357, '2021-10-04 08:32:42'),
(3687, 249, 357, '2021-10-04 08:35:46'),
(3688, 241, 357, '2021-10-04 08:43:40'),
(3689, 249, 357, '2021-10-04 08:47:27'),
(3690, 249, 357, '2021-10-04 08:50:08'),
(3691, 249, 357, '2021-10-04 09:15:25'),
(3692, 240, 357, '2021-10-04 09:15:33'),
(3693, 249, 357, '2021-10-04 09:15:42'),
(3694, 249, 357, '2021-10-04 09:18:09'),
(3695, 249, 357, '2021-10-04 12:16:40'),
(3696, 240, 357, '2021-10-04 12:23:53'),
(3697, 249, 357, '2021-10-04 12:24:29'),
(3698, 240, 357, '2021-10-04 12:24:42'),
(3699, 240, 357, '2021-10-04 12:25:24'),
(3700, 239, 357, '2021-10-04 12:25:27'),
(3701, 249, 357, '2021-10-05 08:59:16'),
(3702, 248, 357, '2021-10-05 08:59:20'),
(3703, 249, 357, '2021-10-05 08:59:22'),
(3704, 249, 357, '2021-10-05 09:00:30'),
(3705, 249, 357, '2021-10-05 09:07:29'),
(3706, 249, 357, '2021-10-05 09:07:33'),
(3707, 249, 357, '2021-10-05 09:07:37'),
(3708, 249, 357, '2021-10-05 09:07:49'),
(3709, 249, 357, '2021-10-05 09:08:30'),
(3710, 249, 357, '2021-10-05 09:08:55'),
(3711, 249, 357, '2021-10-05 09:09:14'),
(3712, 249, 357, '2021-10-05 09:09:59'),
(3713, 249, 357, '2021-10-05 09:10:34'),
(3714, 249, 357, '2021-10-05 09:11:08'),
(3715, 249, 357, '2021-10-05 10:10:26'),
(3716, 249, 357, '2021-10-05 10:15:40'),
(3717, 249, 357, '2021-10-05 10:15:58'),
(3718, 249, 357, '2021-10-05 10:17:01'),
(3719, 249, 357, '2021-10-05 10:19:53'),
(3720, 249, 357, '2021-10-05 10:21:36'),
(3721, 249, 357, '2021-10-05 10:22:55'),
(3722, 249, 357, '2021-10-05 10:23:15'),
(3723, 249, 357, '2021-10-05 10:24:23'),
(3724, 249, 357, '2021-10-05 11:04:02'),
(3725, 249, 357, '2021-10-05 11:04:27'),
(3726, 248, 357, '2021-10-05 11:04:59'),
(3727, 249, 357, '2021-10-05 11:05:11'),
(3728, 249, 357, '2021-10-05 11:05:30'),
(3729, 248, 357, '2021-10-05 11:06:36'),
(3730, 248, 357, '2021-10-05 11:09:06'),
(3731, 249, 357, '2021-10-05 11:33:13'),
(3732, 249, 357, '2021-10-05 11:40:02'),
(3733, 249, 357, '2021-10-05 11:40:44'),
(3734, 249, 357, '2021-10-05 11:42:21'),
(3735, 249, 357, '2021-10-05 12:13:05'),
(3736, 248, 357, '2021-10-05 12:13:09'),
(3737, 249, 357, '2021-10-05 12:22:44'),
(3738, 248, 357, '2021-10-05 12:22:55'),
(3739, 240, 357, '2021-10-05 12:30:45'),
(3740, 240, 357, '2021-10-05 12:31:03'),
(3741, 239, 357, '2021-10-05 12:31:13'),
(3742, 239, 357, '2021-10-05 12:33:07'),
(3743, 240, 357, '2021-10-05 12:33:09'),
(3744, 240, 357, '2021-10-05 12:33:11'),
(3745, 240, 357, '2021-10-05 12:33:13'),
(3746, 248, 357, '2021-10-05 12:33:16'),
(3747, 248, 357, '2021-10-05 12:33:18'),
(3748, 248, 357, '2021-10-05 12:33:21'),
(3749, 248, 357, '2021-10-05 12:33:35'),
(3750, 248, 357, '2021-10-05 12:46:21'),
(3751, 241, 357, '2021-10-05 12:46:45'),
(3752, 249, 357, '2021-10-08 07:13:48'),
(3753, 249, 357, '2021-10-08 07:18:23'),
(3754, 265, 357, '2021-10-08 07:18:29'),
(3755, 265, 357, '2021-10-08 10:32:51'),
(3756, 265, 357, '2021-10-08 10:33:36'),
(3757, 265, 357, '2021-10-08 10:33:52'),
(3758, 265, 357, '2021-10-08 11:08:34'),
(3759, 265, 357, '2021-10-08 11:09:22'),
(3760, 265, 357, '2021-10-08 11:09:49'),
(3761, 265, 357, '2021-10-08 11:22:21'),
(3762, 265, 357, '2021-10-08 11:22:45'),
(3763, 265, 357, '2021-10-08 11:24:13'),
(3764, 265, 357, '2021-10-08 11:50:40'),
(3765, 265, 357, '2021-10-08 12:14:13'),
(3766, 265, 6, '2021-10-09 07:50:09'),
(3767, 249, 353, '2021-10-11 07:02:19'),
(3768, 241, 353, '2021-10-11 07:23:50'),
(3769, 241, 353, '2021-10-11 07:23:52'),
(3770, 248, 353, '2021-10-11 07:28:03'),
(3771, 241, 353, '2021-10-11 07:28:16'),
(3772, 241, 353, '2021-10-11 07:28:20'),
(3773, 241, 353, '2021-10-11 08:41:01'),
(3774, 241, 353, '2021-10-11 09:08:28'),
(3775, 265, 353, '2021-10-11 09:18:49'),
(3776, 249, 353, '2021-10-11 09:24:56'),
(3777, 241, 353, '2021-10-11 09:25:26'),
(3778, 241, 353, '2021-10-11 09:31:53'),
(3779, 248, 353, '2021-10-11 09:34:50'),
(3780, 265, 357, '2021-10-11 09:40:03'),
(3781, 241, 353, '2021-10-11 09:40:57'),
(3782, 265, 357, '2021-10-11 09:41:15'),
(3783, 265, 357, '2021-10-11 09:42:43'),
(3784, 265, 357, '2021-10-11 09:44:22'),
(3785, 241, 353, '2021-10-11 09:48:14'),
(3786, 241, 353, '2021-10-11 09:49:29'),
(3787, 248, 353, '2021-10-11 09:53:34'),
(3788, 248, 353, '2021-10-11 10:31:29'),
(3789, 265, 353, '2021-10-11 10:33:03'),
(3790, 265, 353, '2021-10-11 10:33:46'),
(3791, 265, 353, '2021-10-11 10:34:34'),
(3792, 265, 353, '2021-10-11 10:46:59'),
(3793, 265, 357, '2021-10-11 13:06:59'),
(3794, 240, 353, '2021-10-11 13:11:01'),
(3795, 265, 357, '2021-10-11 13:15:44'),
(3796, 248, 357, '2021-10-11 13:16:46'),
(3797, 265, 357, '2021-10-11 13:17:03'),
(3798, 248, 357, '2021-10-11 13:31:39'),
(3799, 265, 357, '2021-10-11 13:31:46'),
(3800, 249, 353, '2021-10-12 10:04:47'),
(3801, 249, 353, '2021-10-12 10:05:44'),
(3802, 240, 353, '2021-10-12 10:27:27'),
(3803, 241, 353, '2021-10-12 13:20:47'),
(3804, 265, 357, '2021-10-16 08:32:06'),
(3805, 249, 357, '2021-10-16 08:32:16'),
(3806, 248, 353, '2021-10-17 05:22:49'),
(3807, 248, 353, '2021-10-17 05:22:58'),
(3808, 248, 353, '2021-10-17 05:34:25'),
(3809, 265, 353, '2021-10-17 06:32:08'),
(3810, 241, 353, '2021-10-17 06:33:11'),
(3811, 241, 353, '2021-10-17 06:33:25'),
(3812, 248, 353, '2021-10-18 05:17:17'),
(3813, 265, 353, '2021-10-18 05:30:33'),
(3814, 265, 353, '2021-10-18 05:33:16'),
(3815, 241, 352, '2021-10-18 07:13:04'),
(3816, 241, 352, '2021-10-18 07:13:09'),
(3817, 241, 352, '2021-10-18 07:13:09'),
(3818, 241, 352, '2021-10-18 07:13:09'),
(3819, 241, 352, '2021-10-18 07:13:10'),
(3820, 241, 352, '2021-10-18 07:13:13'),
(3821, 241, 352, '2021-10-18 07:13:14'),
(3822, 241, 352, '2021-10-18 07:13:14'),
(3823, 248, 352, '2021-10-18 07:17:32'),
(3824, 248, 352, '2021-10-18 07:17:34'),
(3825, 248, 352, '2021-10-18 07:17:34'),
(3826, 248, 352, '2021-10-18 07:17:35'),
(3827, 248, 352, '2021-10-18 07:17:46'),
(3828, 248, 352, '2021-10-18 07:17:49'),
(3829, 248, 352, '2021-10-18 07:17:49'),
(3830, 248, 352, '2021-10-18 07:17:50'),
(3831, 248, 352, '2021-10-18 07:20:02'),
(3832, 248, 352, '2021-10-18 07:20:04'),
(3833, 248, 352, '2021-10-18 07:20:04'),
(3834, 248, 352, '2021-10-18 07:20:05'),
(3835, 248, 352, '2021-10-18 07:21:25'),
(3836, 248, 352, '2021-10-18 07:21:27'),
(3837, 249, 352, '2021-10-18 07:21:27'),
(3838, 248, 352, '2021-10-18 07:21:28'),
(3839, 248, 352, '2021-10-18 07:21:28'),
(3840, 249, 352, '2021-10-18 07:21:29'),
(3841, 249, 352, '2021-10-18 07:21:30'),
(3842, 249, 352, '2021-10-18 07:21:30'),
(3843, 265, 353, '2021-10-18 12:08:49'),
(3844, 248, 360, '2021-10-21 06:19:02'),
(3845, 248, 353, '2021-11-24 09:07:35'),
(3846, 265, 353, '2021-12-20 05:12:38'),
(3847, 248, 353, '2021-12-20 06:22:30'),
(3848, 265, 353, '2021-12-24 07:35:56'),
(3849, 248, 353, '2021-12-24 07:36:34'),
(3850, 241, 353, '2021-12-29 09:50:05'),
(3851, 248, 0, '2022-01-04 11:25:25'),
(3852, 248, 0, '2022-01-04 12:49:02'),
(3853, 248, 0, '2022-01-04 12:57:08'),
(3854, 265, 378, '2022-01-05 12:13:44'),
(3855, 248, 353, '2022-01-10 12:43:21'),
(3856, 248, 353, '2022-01-10 12:44:42'),
(3857, 241, 353, '2022-01-10 12:45:59'),
(3858, 265, 0, '2022-01-11 05:34:40'),
(3859, 248, 353, '2022-01-11 06:11:04'),
(3860, 240, 353, '2022-01-11 06:12:06'),
(3861, 241, 353, '2022-01-21 08:39:11'),
(3862, 241, 353, '2022-01-21 08:56:50'),
(3863, 248, 353, '2022-01-25 06:04:41'),
(3864, 249, 353, '2022-01-25 06:04:44'),
(3865, 241, 353, '2022-01-25 06:04:51'),
(3866, 241, 353, '2022-01-25 06:08:52'),
(3867, 241, 353, '2022-01-25 11:53:45'),
(3868, 248, 353, '2022-01-25 12:01:29'),
(3869, 241, 353, '2022-01-25 12:38:17'),
(3870, 241, 353, '2022-01-25 12:41:33'),
(3871, 249, 353, '2022-01-25 12:43:56'),
(3872, 265, 353, '2022-01-25 12:48:00'),
(3873, 241, 353, '2022-01-25 12:48:20'),
(3874, 241, 353, '2022-01-25 12:48:37'),
(3875, 241, 353, '2022-01-25 12:51:04'),
(3876, 241, 353, '2022-01-25 12:51:36'),
(3877, 249, 353, '2022-01-27 06:30:13'),
(3878, 241, 353, '2022-01-27 06:30:35'),
(3879, 248, 6, '2022-01-27 09:40:13'),
(3880, 265, 6, '2022-01-27 09:40:21'),
(3881, 241, 379, '2022-01-30 17:00:22'),
(3882, 265, 379, '2022-01-30 17:00:34'),
(3883, 249, 379, '2022-01-30 17:00:40'),
(3884, 248, 380, '2022-01-31 05:55:21'),
(3885, 248, 380, '2022-01-31 06:04:06'),
(3886, 248, 353, '2022-02-08 11:33:50'),
(3887, 248, 353, '2022-02-08 11:35:37'),
(3888, 241, 353, '2022-02-08 11:35:55'),
(3889, 248, 353, '2022-02-08 11:39:50'),
(3890, 248, 353, '2022-02-08 11:48:15'),
(3891, 241, 353, '2022-02-08 11:56:37'),
(3892, 241, 353, '2022-02-08 11:57:00'),
(3893, 241, 353, '2022-02-08 11:57:05'),
(3894, 0, 353, '2022-02-08 12:05:18'),
(3895, 249, 352, '2022-04-20 10:58:27'),
(3896, 249, 352, '2022-04-20 10:58:28'),
(3897, 249, 352, '2022-04-20 10:58:28'),
(3898, 249, 352, '2022-04-20 10:58:28'),
(3899, 239, 352, '2022-04-20 11:20:25'),
(3900, 239, 352, '2022-04-20 11:20:25'),
(3901, 239, 352, '2022-04-20 11:20:25'),
(3902, 239, 352, '2022-04-20 11:20:25'),
(3903, 241, 352, '2022-04-20 12:23:26'),
(3904, 241, 352, '2022-04-20 12:23:26'),
(3905, 241, 352, '2022-04-20 12:23:26'),
(3906, 241, 352, '2022-04-20 12:23:26'),
(3907, 239, 352, '2022-04-21 08:57:58'),
(3908, 239, 352, '2022-04-21 08:57:59'),
(3909, 239, 352, '2022-04-21 08:57:59'),
(3910, 239, 352, '2022-04-21 08:57:59'),
(3911, 239, 352, '2022-04-21 09:01:31'),
(3912, 239, 352, '2022-04-21 09:01:31'),
(3913, 239, 352, '2022-04-21 09:01:31'),
(3914, 239, 352, '2022-04-21 09:01:31'),
(3915, 239, 387, '2022-05-04 11:32:18'),
(3916, 239, 387, '2022-05-04 11:32:18'),
(3917, 239, 387, '2022-05-04 11:32:18'),
(3918, 239, 387, '2022-05-04 11:32:18'),
(3919, 239, 387, '2022-05-04 11:33:02'),
(3920, 239, 387, '2022-05-04 11:33:02'),
(3921, 239, 387, '2022-05-04 11:33:02'),
(3922, 239, 387, '2022-05-04 11:33:02'),
(3923, 239, 387, '2022-05-04 11:35:39'),
(3924, 239, 387, '2022-05-04 11:35:39'),
(3925, 239, 387, '2022-05-04 11:35:39'),
(3926, 239, 387, '2022-05-04 11:35:39'),
(3927, 239, 387, '2022-05-04 11:36:14'),
(3928, 239, 387, '2022-05-04 11:36:14'),
(3929, 239, 387, '2022-05-04 11:36:14'),
(3930, 239, 387, '2022-05-04 11:36:14'),
(3931, 239, 387, '2022-05-04 11:40:04'),
(3932, 239, 387, '2022-05-04 11:40:04'),
(3933, 239, 387, '2022-05-04 11:40:04'),
(3934, 239, 387, '2022-05-04 11:40:04'),
(3935, 239, 387, '2022-05-04 13:39:44'),
(3936, 239, 387, '2022-05-04 13:41:00'),
(3937, 239, 387, '2022-05-04 13:41:01'),
(3938, 239, 387, '2022-05-04 13:41:01'),
(3939, 239, 387, '2022-05-04 13:41:01'),
(3940, 239, 387, '2022-05-04 13:45:49'),
(3941, 239, 387, '2022-05-04 13:45:49'),
(3942, 239, 387, '2022-05-04 13:45:49'),
(3943, 239, 387, '2022-05-04 13:45:49'),
(3944, 239, 387, '2022-05-04 13:45:51'),
(3945, 239, 387, '2022-05-04 13:45:51'),
(3946, 239, 387, '2022-05-04 13:45:51'),
(3947, 239, 387, '2022-05-04 13:45:51'),
(3948, 239, 387, '2022-05-04 13:45:57'),
(3949, 239, 387, '2022-05-04 13:45:58'),
(3950, 239, 387, '2022-05-04 13:45:58'),
(3951, 239, 387, '2022-05-04 13:45:58'),
(3952, 239, 387, '2022-05-04 13:46:29'),
(3953, 239, 387, '2022-05-04 13:46:31'),
(3954, 239, 387, '2022-05-04 13:46:31'),
(3955, 239, 387, '2022-05-04 13:46:31'),
(3956, 239, 387, '2022-05-04 13:47:04'),
(3957, 239, 387, '2022-05-04 13:47:04'),
(3958, 239, 387, '2022-05-04 13:47:04'),
(3959, 239, 387, '2022-05-04 13:47:04'),
(3960, 239, 387, '2022-05-04 13:47:31'),
(3961, 239, 387, '2022-05-04 13:47:31'),
(3962, 239, 387, '2022-05-04 13:47:31'),
(3963, 239, 387, '2022-05-04 13:47:31'),
(3964, 239, 387, '2022-05-04 13:48:00'),
(3965, 239, 387, '2022-05-04 13:48:00'),
(3966, 239, 387, '2022-05-04 13:48:00'),
(3967, 239, 387, '2022-05-04 13:48:00'),
(3968, 239, 387, '2022-05-04 13:48:06'),
(3969, 239, 387, '2022-05-04 13:48:06'),
(3970, 239, 387, '2022-05-04 13:48:06'),
(3971, 239, 387, '2022-05-04 13:48:06'),
(3972, 239, 387, '2022-05-04 13:48:48'),
(3973, 239, 387, '2022-05-04 13:48:57'),
(3974, 239, 387, '2022-05-04 13:48:58'),
(3975, 239, 387, '2022-05-04 13:48:58'),
(3976, 239, 387, '2022-05-04 13:48:58'),
(3977, 239, 387, '2022-05-04 13:48:59'),
(3978, 239, 387, '2022-05-04 13:48:59'),
(3979, 239, 387, '2022-05-04 13:48:59'),
(3980, 239, 387, '2022-05-04 13:48:59'),
(3981, 239, 387, '2022-05-04 13:51:48'),
(3982, 239, 387, '2022-05-04 13:52:04'),
(3983, 239, 387, '2022-05-04 13:52:05'),
(3984, 239, 387, '2022-05-04 13:52:05'),
(3985, 239, 387, '2022-05-04 13:52:05'),
(3986, 239, 387, '2022-05-04 13:52:10'),
(3987, 239, 387, '2022-05-04 13:52:11'),
(3988, 239, 387, '2022-05-04 13:52:11'),
(3989, 239, 387, '2022-05-04 13:52:11'),
(3990, 239, 387, '2022-05-04 13:52:26'),
(3991, 239, 387, '2022-05-04 13:52:26'),
(3992, 239, 387, '2022-05-04 13:52:26'),
(3993, 239, 387, '2022-05-04 13:52:27'),
(3994, 239, 385, '2022-05-05 05:06:39'),
(3995, 239, 385, '2022-05-05 05:06:39'),
(3996, 239, 385, '2022-05-05 05:06:39'),
(3997, 239, 385, '2022-05-05 05:06:39'),
(3998, 239, 385, '2022-05-05 05:07:28'),
(3999, 239, 385, '2022-05-05 05:07:29'),
(4000, 239, 385, '2022-05-05 05:07:29'),
(4001, 239, 385, '2022-05-05 05:07:29'),
(4002, 239, 385, '2022-05-05 05:09:50'),
(4003, 239, 385, '2022-05-05 05:09:50'),
(4004, 239, 385, '2022-05-05 05:09:50'),
(4005, 239, 385, '2022-05-05 05:09:50'),
(4006, 239, 385, '2022-05-05 05:10:28'),
(4007, 239, 385, '2022-05-05 05:10:28'),
(4008, 239, 385, '2022-05-05 05:10:28'),
(4009, 239, 385, '2022-05-05 05:10:28'),
(4010, 239, 385, '2022-05-05 05:11:42'),
(4011, 239, 385, '2022-05-05 05:11:42'),
(4012, 239, 385, '2022-05-05 05:11:42'),
(4013, 239, 385, '2022-05-05 05:11:43'),
(4014, 239, 385, '2022-05-05 05:14:48'),
(4015, 239, 385, '2022-05-05 05:14:48'),
(4016, 239, 385, '2022-05-05 05:14:48'),
(4017, 239, 385, '2022-05-05 05:14:48'),
(4018, 239, 385, '2022-05-05 05:17:10'),
(4019, 239, 385, '2022-05-05 05:17:11'),
(4020, 239, 385, '2022-05-05 05:17:11'),
(4021, 239, 385, '2022-05-05 05:17:11'),
(4022, 239, 385, '2022-05-05 05:19:35'),
(4023, 239, 385, '2022-05-05 05:19:35'),
(4024, 239, 385, '2022-05-05 05:19:35'),
(4025, 239, 385, '2022-05-05 05:19:35'),
(4026, 239, 385, '2022-05-05 05:19:36'),
(4027, 239, 385, '2022-05-05 05:19:37'),
(4028, 239, 385, '2022-05-05 05:19:37'),
(4029, 239, 385, '2022-05-05 05:19:37'),
(4030, 239, 385, '2022-05-05 05:22:18'),
(4031, 239, 385, '2022-05-05 05:22:19'),
(4032, 239, 385, '2022-05-05 05:22:19'),
(4033, 239, 385, '2022-05-05 05:22:19'),
(4034, 239, 385, '2022-05-05 05:22:19'),
(4035, 239, 385, '2022-05-05 05:23:10'),
(4036, 239, 385, '2022-05-05 05:23:10'),
(4037, 239, 385, '2022-05-05 05:23:10'),
(4038, 239, 385, '2022-05-05 05:23:10'),
(4039, 239, 385, '2022-05-05 05:24:41'),
(4040, 239, 385, '2022-05-05 05:24:41'),
(4041, 239, 385, '2022-05-05 05:24:41'),
(4042, 239, 385, '2022-05-05 05:24:41'),
(4043, 239, 385, '2022-05-05 05:25:23'),
(4044, 239, 385, '2022-05-05 05:25:23'),
(4045, 239, 385, '2022-05-05 05:25:24'),
(4046, 239, 385, '2022-05-05 05:25:24'),
(4047, 239, 385, '2022-05-05 05:25:24'),
(4048, 239, 385, '2022-05-05 05:25:24'),
(4049, 239, 385, '2022-05-05 05:27:06'),
(4050, 239, 385, '2022-05-05 05:27:06'),
(4051, 239, 385, '2022-05-05 05:27:06'),
(4052, 239, 385, '2022-05-05 05:27:06'),
(4053, 239, 385, '2022-05-05 05:27:55'),
(4054, 239, 385, '2022-05-05 05:27:55'),
(4055, 239, 385, '2022-05-05 05:27:55'),
(4056, 239, 385, '2022-05-05 05:27:55'),
(4057, 239, 385, '2022-05-05 05:28:01'),
(4058, 239, 385, '2022-05-05 05:28:01'),
(4059, 239, 385, '2022-05-05 05:28:01'),
(4060, 239, 385, '2022-05-05 05:28:01'),
(4061, 239, 385, '2022-05-05 05:28:37'),
(4062, 239, 385, '2022-05-05 05:28:37'),
(4063, 239, 385, '2022-05-05 05:28:37'),
(4064, 239, 385, '2022-05-05 05:28:37'),
(4065, 239, 385, '2022-05-05 05:30:09'),
(4066, 239, 385, '2022-05-05 05:30:09'),
(4067, 239, 385, '2022-05-05 05:30:09'),
(4068, 239, 385, '2022-05-05 05:30:09'),
(4069, 239, 385, '2022-05-05 05:30:56'),
(4070, 239, 385, '2022-05-05 05:30:57'),
(4071, 239, 385, '2022-05-05 05:30:57'),
(4072, 239, 385, '2022-05-05 05:30:57'),
(4073, 239, 385, '2022-05-05 05:31:21'),
(4074, 239, 385, '2022-05-05 05:31:21'),
(4075, 239, 385, '2022-05-05 05:31:21'),
(4076, 239, 385, '2022-05-05 05:31:21'),
(4077, 239, 385, '2022-05-05 05:31:22'),
(4078, 239, 385, '2022-05-05 05:31:22'),
(4079, 239, 385, '2022-05-05 05:31:22'),
(4080, 239, 385, '2022-05-05 05:31:22'),
(4081, 239, 385, '2022-05-05 05:32:28'),
(4082, 239, 385, '2022-05-05 05:32:28'),
(4083, 239, 385, '2022-05-05 05:32:28'),
(4084, 239, 385, '2022-05-05 05:32:28'),
(4085, 239, 385, '2022-05-05 05:33:03'),
(4086, 239, 385, '2022-05-05 05:33:03'),
(4087, 239, 385, '2022-05-05 05:33:03'),
(4088, 239, 385, '2022-05-05 05:33:04'),
(4089, 239, 385, '2022-05-05 05:33:32'),
(4090, 239, 385, '2022-05-05 05:33:32'),
(4091, 239, 385, '2022-05-05 05:33:32'),
(4092, 239, 385, '2022-05-05 05:33:32'),
(4093, 239, 385, '2022-05-05 05:33:43'),
(4094, 239, 385, '2022-05-05 05:33:43'),
(4095, 239, 385, '2022-05-05 05:33:43'),
(4096, 239, 385, '2022-05-05 05:33:43'),
(4097, 239, 385, '2022-05-05 05:34:31'),
(4098, 239, 385, '2022-05-05 05:34:31'),
(4099, 239, 385, '2022-05-05 05:34:31'),
(4100, 239, 385, '2022-05-05 05:34:31'),
(4101, 239, 385, '2022-05-05 05:34:57'),
(4102, 239, 385, '2022-05-05 05:34:58'),
(4103, 239, 385, '2022-05-05 05:34:58'),
(4104, 239, 385, '2022-05-05 05:34:58'),
(4105, 239, 385, '2022-05-05 05:35:06'),
(4106, 239, 385, '2022-05-05 05:35:06'),
(4107, 239, 385, '2022-05-05 05:35:06'),
(4108, 239, 385, '2022-05-05 05:35:06'),
(4109, 239, 385, '2022-05-05 05:35:59'),
(4110, 239, 385, '2022-05-05 05:35:59'),
(4111, 239, 385, '2022-05-05 05:35:59'),
(4112, 239, 385, '2022-05-05 05:35:59'),
(4113, 239, 385, '2022-05-05 05:40:49'),
(4114, 239, 385, '2022-05-05 05:40:49'),
(4115, 239, 385, '2022-05-05 05:40:49'),
(4116, 239, 385, '2022-05-05 05:40:49'),
(4117, 239, 385, '2022-05-05 05:41:21'),
(4118, 239, 385, '2022-05-05 05:41:22'),
(4119, 239, 385, '2022-05-05 05:41:22'),
(4120, 239, 385, '2022-05-05 05:41:22'),
(4121, 239, 385, '2022-05-05 05:41:25'),
(4122, 239, 385, '2022-05-05 05:41:25'),
(4123, 239, 385, '2022-05-05 05:41:25'),
(4124, 239, 385, '2022-05-05 05:41:25'),
(4125, 239, 385, '2022-05-05 05:41:47'),
(4126, 239, 385, '2022-05-05 05:41:48'),
(4127, 239, 385, '2022-05-05 05:41:48'),
(4128, 239, 385, '2022-05-05 05:41:48'),
(4129, 239, 385, '2022-05-05 05:41:51'),
(4130, 239, 385, '2022-05-05 05:41:51'),
(4131, 239, 385, '2022-05-05 05:41:51'),
(4132, 239, 385, '2022-05-05 05:41:51'),
(4133, 239, 385, '2022-05-05 05:41:54'),
(4134, 239, 385, '2022-05-05 05:41:55'),
(4135, 239, 385, '2022-05-05 05:41:55'),
(4136, 239, 385, '2022-05-05 05:41:55'),
(4137, 239, 385, '2022-05-05 05:42:11'),
(4138, 239, 385, '2022-05-05 05:42:11'),
(4139, 239, 385, '2022-05-05 05:42:11'),
(4140, 239, 385, '2022-05-05 05:42:11'),
(4141, 239, 385, '2022-05-05 05:42:15'),
(4142, 239, 385, '2022-05-05 05:42:15'),
(4143, 239, 385, '2022-05-05 05:42:15'),
(4144, 239, 385, '2022-05-05 05:42:15'),
(4145, 239, 385, '2022-05-05 05:42:18'),
(4146, 239, 385, '2022-05-05 05:42:18'),
(4147, 239, 385, '2022-05-05 05:42:19'),
(4148, 239, 385, '2022-05-05 05:42:19'),
(4149, 239, 385, '2022-05-05 05:42:19'),
(4150, 239, 385, '2022-05-05 05:42:37'),
(4151, 239, 385, '2022-05-05 05:42:37'),
(4152, 239, 385, '2022-05-05 05:42:37'),
(4153, 239, 385, '2022-05-05 05:42:37'),
(4154, 239, 385, '2022-05-05 05:42:38'),
(4155, 239, 385, '2022-05-05 05:42:39'),
(4156, 239, 385, '2022-05-05 05:42:39'),
(4157, 239, 385, '2022-05-05 05:42:39'),
(4158, 239, 385, '2022-05-05 05:42:39'),
(4159, 239, 385, '2022-05-05 05:43:06'),
(4160, 239, 385, '2022-05-05 05:43:06'),
(4161, 239, 385, '2022-05-05 05:43:06'),
(4162, 239, 385, '2022-05-05 05:43:06'),
(4163, 239, 385, '2022-05-05 05:43:21'),
(4164, 239, 385, '2022-05-05 05:43:21'),
(4165, 239, 385, '2022-05-05 05:43:21'),
(4166, 239, 385, '2022-05-05 05:43:21'),
(4167, 239, 385, '2022-05-05 05:44:04'),
(4168, 239, 385, '2022-05-05 05:44:04'),
(4169, 239, 385, '2022-05-05 05:44:04'),
(4170, 239, 385, '2022-05-05 05:44:05'),
(4171, 239, 385, '2022-05-05 05:44:08'),
(4172, 239, 385, '2022-05-05 05:44:09'),
(4173, 239, 385, '2022-05-05 05:44:09'),
(4174, 239, 385, '2022-05-05 05:44:09'),
(4175, 239, 385, '2022-05-05 05:44:32'),
(4176, 239, 385, '2022-05-05 05:44:33'),
(4177, 239, 385, '2022-05-05 05:44:33'),
(4178, 239, 385, '2022-05-05 05:44:33'),
(4179, 239, 385, '2022-05-05 05:44:36'),
(4180, 239, 385, '2022-05-05 05:44:36'),
(4181, 239, 385, '2022-05-05 05:44:36'),
(4182, 239, 385, '2022-05-05 05:44:36'),
(4183, 239, 385, '2022-05-05 05:45:24'),
(4184, 239, 385, '2022-05-05 05:45:25'),
(4185, 239, 385, '2022-05-05 05:45:25'),
(4186, 239, 385, '2022-05-05 05:45:25'),
(4187, 239, 385, '2022-05-05 05:45:30'),
(4188, 239, 385, '2022-05-05 05:45:30'),
(4189, 239, 385, '2022-05-05 05:45:30'),
(4190, 239, 385, '2022-05-05 05:45:30'),
(4191, 239, 385, '2022-05-05 05:45:31'),
(4192, 239, 385, '2022-05-05 05:45:31'),
(4193, 239, 385, '2022-05-05 05:45:31'),
(4194, 239, 385, '2022-05-05 05:45:55'),
(4195, 239, 385, '2022-05-05 05:45:55'),
(4196, 239, 385, '2022-05-05 05:45:55'),
(4197, 239, 385, '2022-05-05 05:45:55'),
(4198, 239, 385, '2022-05-05 05:45:58'),
(4199, 239, 385, '2022-05-05 05:45:59'),
(4200, 239, 385, '2022-05-05 05:45:59'),
(4201, 239, 385, '2022-05-05 05:45:59'),
(4202, 239, 385, '2022-05-05 05:46:30'),
(4203, 239, 385, '2022-05-05 05:46:30'),
(4204, 239, 385, '2022-05-05 05:46:30'),
(4205, 239, 385, '2022-05-05 05:46:30'),
(4206, 239, 385, '2022-05-05 05:46:33'),
(4207, 239, 385, '2022-05-05 05:46:34'),
(4208, 239, 385, '2022-05-05 05:46:34'),
(4209, 239, 385, '2022-05-05 05:46:34'),
(4210, 239, 385, '2022-05-05 05:47:34'),
(4211, 239, 385, '2022-05-05 05:47:35'),
(4212, 239, 385, '2022-05-05 05:47:35'),
(4213, 239, 385, '2022-05-05 05:47:35'),
(4214, 239, 385, '2022-05-05 05:47:42'),
(4215, 239, 385, '2022-05-05 05:47:43'),
(4216, 239, 385, '2022-05-05 05:47:43'),
(4217, 239, 385, '2022-05-05 05:47:43'),
(4218, 239, 385, '2022-05-05 05:47:49'),
(4219, 239, 385, '2022-05-05 05:47:50'),
(4220, 239, 385, '2022-05-05 05:47:50'),
(4221, 239, 385, '2022-05-05 05:47:50'),
(4222, 239, 385, '2022-05-05 05:48:02'),
(4223, 239, 385, '2022-05-05 05:48:02'),
(4224, 239, 385, '2022-05-05 05:48:02'),
(4225, 239, 385, '2022-05-05 05:48:02'),
(4226, 239, 385, '2022-05-05 05:48:12'),
(4227, 239, 385, '2022-05-05 05:48:12'),
(4228, 239, 385, '2022-05-05 05:48:12'),
(4229, 239, 385, '2022-05-05 05:48:12'),
(4230, 239, 385, '2022-05-05 05:48:42'),
(4231, 239, 385, '2022-05-05 05:48:43'),
(4232, 239, 385, '2022-05-05 05:48:43'),
(4233, 239, 385, '2022-05-05 05:48:43'),
(4234, 239, 385, '2022-05-05 05:48:45'),
(4235, 239, 385, '2022-05-05 05:48:46'),
(4236, 239, 385, '2022-05-05 05:48:46'),
(4237, 239, 385, '2022-05-05 05:48:46'),
(4238, 239, 385, '2022-05-05 05:50:17'),
(4239, 239, 385, '2022-05-05 05:50:17'),
(4240, 239, 385, '2022-05-05 05:50:17'),
(4241, 239, 385, '2022-05-05 05:50:17'),
(4242, 239, 385, '2022-05-05 06:01:27'),
(4243, 239, 385, '2022-05-05 06:01:27'),
(4244, 239, 385, '2022-05-05 06:01:27'),
(4245, 239, 385, '2022-05-05 06:01:27'),
(4246, 239, 385, '2022-05-05 06:06:16'),
(4247, 239, 385, '2022-05-05 06:06:16'),
(4248, 239, 385, '2022-05-05 06:06:16'),
(4249, 239, 385, '2022-05-05 06:06:16'),
(4250, 239, 385, '2022-05-05 09:12:35'),
(4251, 239, 385, '2022-05-05 09:12:35'),
(4252, 239, 385, '2022-05-05 09:12:35'),
(4253, 239, 385, '2022-05-05 09:12:35'),
(4254, 239, 385, '2022-05-05 09:17:46'),
(4255, 239, 385, '2022-05-05 09:17:46'),
(4256, 239, 385, '2022-05-05 09:17:46'),
(4257, 239, 385, '2022-05-05 09:17:46'),
(4258, 239, 385, '2022-05-05 11:09:29'),
(4259, 239, 385, '2022-05-05 11:09:29'),
(4260, 239, 385, '2022-05-05 11:09:29'),
(4261, 239, 385, '2022-05-05 11:09:29'),
(4262, 239, 385, '2022-05-06 13:58:06'),
(4263, 239, 385, '2022-05-06 13:58:07'),
(4264, 239, 385, '2022-05-06 13:58:07'),
(4265, 239, 385, '2022-05-06 13:58:07'),
(4266, 239, 385, '2022-05-06 14:00:50'),
(4267, 239, 385, '2022-05-06 14:00:50'),
(4268, 239, 385, '2022-05-06 14:00:50'),
(4269, 239, 385, '2022-05-06 14:00:50'),
(4270, 239, 385, '2022-05-06 14:04:30'),
(4271, 239, 385, '2022-05-06 14:04:30'),
(4272, 239, 385, '2022-05-06 14:04:30'),
(4273, 239, 385, '2022-05-06 14:04:30'),
(4274, 239, 385, '2022-05-06 14:05:40'),
(4275, 239, 385, '2022-05-06 14:05:40'),
(4276, 239, 385, '2022-05-06 14:05:40'),
(4277, 239, 385, '2022-05-06 14:05:40'),
(4278, 239, 385, '2022-05-06 14:18:00'),
(4279, 239, 385, '2022-05-06 14:18:00'),
(4280, 239, 385, '2022-05-06 14:18:00'),
(4281, 239, 385, '2022-05-06 14:18:00'),
(4282, 239, 384, '2022-05-08 06:09:36'),
(4283, 239, 384, '2022-05-08 06:09:37'),
(4284, 239, 384, '2022-05-08 06:09:37'),
(4285, 239, 384, '2022-05-08 06:09:37'),
(4286, 239, 388, '2022-05-08 06:10:02'),
(4287, 239, 388, '2022-05-08 06:10:03'),
(4288, 239, 388, '2022-05-08 06:10:03'),
(4289, 239, 388, '2022-05-08 06:10:03'),
(4290, 239, 388, '2022-05-08 06:11:02'),
(4291, 239, 388, '2022-05-08 06:11:02'),
(4292, 239, 388, '2022-05-08 06:11:02'),
(4293, 239, 388, '2022-05-08 06:11:03'),
(4294, 239, 389, '2022-05-08 06:15:39'),
(4295, 239, 389, '2022-05-08 06:15:39'),
(4296, 239, 389, '2022-05-08 06:15:39'),
(4297, 239, 389, '2022-05-08 06:15:39'),
(4298, 239, 389, '2022-05-08 06:15:39'),
(4299, 239, 389, '2022-05-08 06:15:39'),
(4300, 239, 389, '2022-05-08 06:15:39'),
(4301, 239, 389, '2022-05-08 06:15:55'),
(4302, 239, 389, '2022-05-08 06:15:55'),
(4303, 239, 389, '2022-05-08 06:15:55'),
(4304, 239, 389, '2022-05-08 06:15:56'),
(4305, 239, 388, '2022-05-08 06:25:46'),
(4306, 239, 388, '2022-05-08 06:25:47'),
(4307, 239, 388, '2022-05-08 06:25:47'),
(4308, 239, 388, '2022-05-08 06:25:47'),
(4309, 239, 388, '2022-05-08 06:25:57'),
(4310, 239, 388, '2022-05-08 06:25:57'),
(4311, 239, 388, '2022-05-08 06:25:57'),
(4312, 239, 388, '2022-05-08 06:25:57'),
(4313, 239, 388, '2022-05-08 06:26:13'),
(4314, 239, 388, '2022-05-08 06:26:14'),
(4315, 239, 388, '2022-05-08 06:26:14'),
(4316, 239, 388, '2022-05-08 06:26:14'),
(4317, 239, 384, '2022-05-08 06:34:00'),
(4318, 239, 384, '2022-05-08 06:34:02'),
(4319, 239, 384, '2022-05-08 06:34:02'),
(4320, 239, 384, '2022-05-08 06:34:02'),
(4321, 239, 389, '2022-05-08 06:34:07'),
(4322, 239, 389, '2022-05-08 06:34:07'),
(4323, 239, 389, '2022-05-08 06:34:07'),
(4324, 239, 389, '2022-05-08 06:34:07'),
(4325, 239, 384, '2022-05-08 06:34:11'),
(4326, 239, 384, '2022-05-08 06:34:11'),
(4327, 239, 384, '2022-05-08 06:34:11'),
(4328, 239, 384, '2022-05-08 06:34:11'),
(4329, 239, 389, '2022-05-08 06:36:49'),
(4330, 239, 389, '2022-05-08 06:36:50'),
(4331, 239, 389, '2022-05-08 06:36:50'),
(4332, 239, 389, '2022-05-08 06:36:50'),
(4333, 239, 389, '2022-05-08 06:44:41'),
(4334, 239, 389, '2022-05-08 06:44:41'),
(4335, 239, 389, '2022-05-08 06:44:41'),
(4336, 239, 389, '2022-05-08 06:44:41'),
(4337, 239, 384, '2022-05-08 06:54:21'),
(4338, 239, 384, '2022-05-08 06:54:23'),
(4339, 239, 384, '2022-05-08 06:54:23'),
(4340, 239, 384, '2022-05-08 06:54:23'),
(4341, 239, 385, '2022-05-09 05:45:55'),
(4342, 239, 385, '2022-05-09 05:45:55'),
(4343, 239, 385, '2022-05-09 05:45:55'),
(4344, 239, 385, '2022-05-09 05:45:55'),
(4345, 239, 385, '2022-05-09 05:48:24'),
(4346, 239, 385, '2022-05-09 05:48:25'),
(4347, 239, 385, '2022-05-09 05:48:25'),
(4348, 239, 385, '2022-05-09 05:48:25'),
(4349, 239, 385, '2022-05-09 05:54:49'),
(4350, 239, 385, '2022-05-09 05:54:49'),
(4351, 239, 385, '2022-05-09 05:54:49'),
(4352, 239, 385, '2022-05-09 05:54:49'),
(4353, 239, 385, '2022-05-09 06:02:15'),
(4354, 239, 385, '2022-05-09 06:02:15'),
(4355, 239, 385, '2022-05-09 06:02:15'),
(4356, 239, 385, '2022-05-09 06:02:15'),
(4357, 239, 385, '2022-05-09 06:02:19'),
(4358, 239, 385, '2022-05-09 06:02:19'),
(4359, 239, 385, '2022-05-09 06:02:19'),
(4360, 239, 385, '2022-05-09 06:02:19'),
(4361, 239, 385, '2022-05-09 07:40:00'),
(4362, 239, 385, '2022-05-09 07:40:00'),
(4363, 239, 385, '2022-05-09 07:40:00'),
(4364, 239, 385, '2022-05-09 07:40:00'),
(4365, 239, 385, '2022-05-09 07:40:37'),
(4366, 239, 385, '2022-05-09 07:40:38'),
(4367, 239, 385, '2022-05-09 07:40:38'),
(4368, 239, 385, '2022-05-09 07:40:38'),
(4369, 239, 385, '2022-05-09 07:40:38'),
(4370, 239, 385, '2022-05-09 07:41:12'),
(4371, 239, 385, '2022-05-09 07:41:13'),
(4372, 239, 385, '2022-05-09 07:41:13'),
(4373, 239, 385, '2022-05-09 07:41:13'),
(4374, 239, 385, '2022-05-09 07:42:33'),
(4375, 239, 385, '2022-05-09 07:42:34'),
(4376, 239, 385, '2022-05-09 07:42:34'),
(4377, 239, 385, '2022-05-09 07:42:34'),
(4378, 239, 385, '2022-05-09 07:42:41'),
(4379, 239, 385, '2022-05-09 07:42:42'),
(4380, 239, 385, '2022-05-09 07:42:42'),
(4381, 239, 385, '2022-05-09 07:42:42'),
(4382, 239, 385, '2022-05-09 07:43:02'),
(4383, 239, 385, '2022-05-09 07:43:03'),
(4384, 239, 385, '2022-05-09 07:43:03'),
(4385, 239, 385, '2022-05-09 07:43:03'),
(4386, 239, 385, '2022-05-09 09:04:55'),
(4387, 239, 385, '2022-05-09 09:04:55'),
(4388, 239, 385, '2022-05-09 09:04:55'),
(4389, 239, 385, '2022-05-09 09:04:55'),
(4390, 239, 385, '2022-05-09 09:07:21'),
(4391, 239, 385, '2022-05-09 09:07:21'),
(4392, 239, 385, '2022-05-09 09:07:21'),
(4393, 239, 385, '2022-05-09 09:07:22'),
(4394, 239, 385, '2022-05-09 09:08:47'),
(4395, 239, 385, '2022-05-09 09:08:48'),
(4396, 239, 385, '2022-05-09 09:08:48'),
(4397, 239, 385, '2022-05-09 09:08:48'),
(4398, 239, 385, '2022-05-09 09:09:22'),
(4399, 239, 385, '2022-05-09 09:09:22'),
(4400, 239, 385, '2022-05-09 09:09:22'),
(4401, 239, 385, '2022-05-09 09:09:22'),
(4402, 239, 385, '2022-05-09 09:09:39'),
(4403, 239, 385, '2022-05-09 09:09:40'),
(4404, 239, 385, '2022-05-09 09:09:40'),
(4405, 239, 385, '2022-05-09 09:09:40'),
(4406, 239, 385, '2022-05-09 09:10:49'),
(4407, 239, 385, '2022-05-09 09:10:50'),
(4408, 239, 385, '2022-05-09 09:10:50'),
(4409, 239, 385, '2022-05-09 09:10:50'),
(4410, 239, 385, '2022-05-09 09:11:35'),
(4411, 239, 385, '2022-05-09 09:11:35'),
(4412, 239, 385, '2022-05-09 09:11:35'),
(4413, 239, 385, '2022-05-09 09:11:35'),
(4414, 239, 385, '2022-05-09 09:12:08'),
(4415, 239, 385, '2022-05-09 09:12:08'),
(4416, 239, 385, '2022-05-09 09:12:08'),
(4417, 239, 385, '2022-05-09 09:12:08'),
(4418, 239, 385, '2022-05-09 09:13:36'),
(4419, 239, 385, '2022-05-09 09:13:36'),
(4420, 239, 385, '2022-05-09 09:13:36'),
(4421, 239, 385, '2022-05-09 09:13:36'),
(4422, 239, 385, '2022-05-09 09:15:46'),
(4423, 239, 385, '2022-05-09 09:15:46'),
(4424, 239, 385, '2022-05-09 09:15:46'),
(4425, 239, 385, '2022-05-09 09:15:46'),
(4426, 239, 385, '2022-05-09 09:17:32'),
(4427, 239, 385, '2022-05-09 09:17:33'),
(4428, 239, 385, '2022-05-09 09:17:33'),
(4429, 239, 385, '2022-05-09 09:17:33'),
(4430, 239, 385, '2022-05-09 09:26:37'),
(4431, 239, 385, '2022-05-09 09:26:37'),
(4432, 239, 385, '2022-05-09 09:26:37'),
(4433, 239, 385, '2022-05-09 09:26:37'),
(4434, 239, 385, '2022-05-09 09:26:37'),
(4435, 239, 385, '2022-05-09 09:27:10'),
(4436, 239, 385, '2022-05-09 09:27:10'),
(4437, 239, 385, '2022-05-09 09:27:10'),
(4438, 239, 385, '2022-05-09 09:27:10'),
(4439, 239, 385, '2022-05-09 09:27:11'),
(4440, 239, 385, '2022-05-09 09:27:12'),
(4441, 239, 385, '2022-05-09 09:27:12'),
(4442, 239, 385, '2022-05-09 09:27:12'),
(4443, 239, 385, '2022-05-09 09:27:49'),
(4444, 239, 385, '2022-05-09 09:27:50'),
(4445, 239, 385, '2022-05-09 09:27:50'),
(4446, 239, 385, '2022-05-09 09:27:50'),
(4447, 239, 385, '2022-05-09 09:30:16'),
(4448, 239, 385, '2022-05-09 09:30:16'),
(4449, 239, 385, '2022-05-09 09:30:16'),
(4450, 239, 385, '2022-05-09 09:30:16'),
(4451, 239, 385, '2022-05-09 09:30:55'),
(4452, 239, 385, '2022-05-09 09:30:55'),
(4453, 239, 385, '2022-05-09 09:30:55'),
(4454, 239, 385, '2022-05-09 09:30:55'),
(4455, 239, 385, '2022-05-09 09:31:05'),
(4456, 239, 385, '2022-05-09 09:31:06'),
(4457, 239, 385, '2022-05-09 09:31:06'),
(4458, 239, 385, '2022-05-09 09:31:06'),
(4459, 239, 385, '2022-05-09 09:31:15'),
(4460, 239, 385, '2022-05-09 09:31:16'),
(4461, 239, 385, '2022-05-09 09:31:16'),
(4462, 239, 385, '2022-05-09 09:31:16'),
(4463, 239, 385, '2022-05-09 09:31:57'),
(4464, 239, 385, '2022-05-09 09:31:58'),
(4465, 239, 385, '2022-05-09 09:31:58'),
(4466, 239, 385, '2022-05-09 09:31:58'),
(4467, 239, 385, '2022-05-09 09:32:22'),
(4468, 239, 385, '2022-05-09 09:32:22'),
(4469, 239, 385, '2022-05-09 09:32:23'),
(4470, 239, 385, '2022-05-09 09:32:23'),
(4471, 239, 385, '2022-05-09 09:32:56'),
(4472, 239, 385, '2022-05-09 09:32:56'),
(4473, 239, 385, '2022-05-09 09:32:56'),
(4474, 239, 385, '2022-05-09 09:32:56'),
(4475, 239, 385, '2022-05-09 10:24:57'),
(4476, 239, 385, '2022-05-09 10:24:58'),
(4477, 239, 385, '2022-05-09 10:24:58'),
(4478, 239, 385, '2022-05-09 10:24:58'),
(4479, 239, 388, '2022-05-09 12:24:03'),
(4480, 239, 388, '2022-05-09 12:24:04'),
(4481, 239, 388, '2022-05-09 12:24:04'),
(4482, 239, 388, '2022-05-09 12:24:04'),
(4483, 239, 388, '2022-05-09 12:24:12'),
(4484, 239, 388, '2022-05-09 12:24:12'),
(4485, 239, 388, '2022-05-09 12:24:12'),
(4486, 239, 388, '2022-05-09 12:24:12'),
(4487, 239, 388, '2022-05-09 12:41:26'),
(4488, 239, 388, '2022-05-09 12:41:27'),
(4489, 239, 388, '2022-05-09 12:41:27'),
(4490, 239, 388, '2022-05-09 12:41:27'),
(4491, 239, 384, '2022-05-10 10:43:39'),
(4492, 239, 384, '2022-05-10 10:43:39'),
(4493, 239, 384, '2022-05-10 10:43:39'),
(4494, 239, 384, '2022-05-10 10:43:39'),
(4495, 239, 385, '2022-05-12 06:42:56'),
(4496, 239, 385, '2022-05-12 06:42:56'),
(4497, 239, 385, '2022-05-12 06:42:56'),
(4498, 239, 385, '2022-05-12 06:42:56'),
(4499, 239, 385, '2022-05-12 06:54:53'),
(4500, 239, 385, '2022-05-12 06:54:53'),
(4501, 239, 385, '2022-05-12 06:54:53'),
(4502, 239, 385, '2022-05-12 06:54:53'),
(4503, 239, 385, '2022-05-12 07:04:20'),
(4504, 239, 385, '2022-05-12 07:04:21'),
(4505, 239, 385, '2022-05-12 07:04:21'),
(4506, 239, 385, '2022-05-12 07:04:21'),
(4507, 239, 384, '2022-05-12 13:50:50'),
(4508, 239, 384, '2022-05-12 13:50:50'),
(4509, 239, 384, '2022-05-12 13:50:50'),
(4510, 239, 384, '2022-05-12 13:50:50'),
(4511, 239, 384, '2022-05-12 13:51:00'),
(4512, 239, 384, '2022-05-12 13:51:00'),
(4513, 239, 384, '2022-05-12 13:51:00'),
(4514, 239, 384, '2022-05-12 13:51:00'),
(4515, 239, 384, '2022-05-12 13:53:18'),
(4516, 239, 384, '2022-05-12 13:53:18'),
(4517, 239, 384, '2022-05-12 13:53:18'),
(4518, 239, 384, '2022-05-12 13:53:18'),
(4519, 239, 384, '2022-05-12 13:54:01'),
(4520, 239, 384, '2022-05-12 13:54:02'),
(4521, 239, 384, '2022-05-12 13:54:02'),
(4522, 239, 384, '2022-05-12 13:54:02'),
(4523, 239, 384, '2022-05-12 13:54:10'),
(4524, 239, 384, '2022-05-12 13:54:10'),
(4525, 239, 384, '2022-05-12 13:54:10'),
(4526, 239, 384, '2022-05-12 13:54:10'),
(4527, 239, 388, '2022-05-13 11:46:01'),
(4528, 239, 388, '2022-05-13 11:46:01'),
(4529, 239, 388, '2022-05-13 11:46:01'),
(4530, 239, 388, '2022-05-13 11:46:01'),
(4531, 239, 388, '2022-05-13 11:49:01'),
(4532, 239, 388, '2022-05-13 11:49:02'),
(4533, 239, 388, '2022-05-13 11:49:02'),
(4534, 239, 388, '2022-05-13 11:49:02'),
(4535, 239, 385, '2022-05-16 07:09:26'),
(4536, 239, 385, '2022-05-16 07:09:26'),
(4537, 239, 385, '2022-05-16 07:09:26'),
(4538, 239, 385, '2022-05-16 07:09:26'),
(4539, 239, 385, '2022-05-16 09:42:31'),
(4540, 239, 385, '2022-05-16 09:42:31'),
(4541, 239, 385, '2022-05-16 09:42:31'),
(4542, 239, 385, '2022-05-16 09:42:31'),
(4543, 239, 385, '2022-05-16 09:43:48'),
(4544, 239, 385, '2022-05-16 09:43:48'),
(4545, 239, 385, '2022-05-16 09:43:48'),
(4546, 239, 385, '2022-05-16 09:43:48'),
(4547, 239, 385, '2022-05-16 09:43:50'),
(4548, 239, 385, '2022-05-16 09:43:50'),
(4549, 239, 385, '2022-05-16 09:43:50'),
(4550, 239, 385, '2022-05-16 09:43:51'),
(4551, 239, 385, '2022-05-16 09:43:57'),
(4552, 239, 385, '2022-05-16 09:43:57'),
(4553, 239, 385, '2022-05-16 09:43:57'),
(4554, 239, 385, '2022-05-16 09:43:57'),
(4555, 239, 385, '2022-05-16 09:44:34'),
(4556, 239, 385, '2022-05-16 09:44:34'),
(4557, 239, 385, '2022-05-16 09:44:34'),
(4558, 239, 385, '2022-05-16 09:44:34'),
(4559, 239, 385, '2022-05-16 09:46:27'),
(4560, 239, 385, '2022-05-16 09:46:27'),
(4561, 239, 385, '2022-05-16 09:46:27'),
(4562, 239, 385, '2022-05-16 09:46:27'),
(4563, 239, 385, '2022-05-16 09:47:07'),
(4564, 239, 385, '2022-05-16 09:47:08'),
(4565, 239, 385, '2022-05-16 09:47:08'),
(4566, 239, 385, '2022-05-16 09:47:08'),
(4567, 239, 385, '2022-05-16 09:47:34'),
(4568, 239, 385, '2022-05-16 09:47:35'),
(4569, 239, 385, '2022-05-16 09:47:35'),
(4570, 239, 385, '2022-05-16 09:47:35'),
(4571, 239, 385, '2022-05-16 09:47:36'),
(4572, 239, 385, '2022-05-16 09:47:37'),
(4573, 239, 385, '2022-05-16 09:47:37'),
(4574, 239, 385, '2022-05-16 09:47:37'),
(4575, 239, 385, '2022-05-16 09:47:53'),
(4576, 239, 385, '2022-05-16 09:47:54'),
(4577, 239, 385, '2022-05-16 09:47:54'),
(4578, 239, 385, '2022-05-16 09:47:54'),
(4579, 239, 385, '2022-05-16 09:48:54'),
(4580, 239, 385, '2022-05-16 09:48:54'),
(4581, 239, 385, '2022-05-16 09:48:54'),
(4582, 239, 385, '2022-05-16 09:48:54'),
(4583, 239, 385, '2022-05-16 09:48:57'),
(4584, 239, 385, '2022-05-16 09:48:57'),
(4585, 239, 385, '2022-05-16 09:48:57'),
(4586, 239, 385, '2022-05-16 09:48:58'),
(4587, 239, 385, '2022-05-16 09:49:21'),
(4588, 239, 385, '2022-05-16 09:49:22'),
(4589, 239, 385, '2022-05-16 09:49:22'),
(4590, 239, 385, '2022-05-16 09:49:22'),
(4591, 239, 385, '2022-05-16 09:49:24'),
(4592, 239, 385, '2022-05-16 09:49:25'),
(4593, 239, 385, '2022-05-16 09:49:25'),
(4594, 239, 385, '2022-05-16 09:49:25'),
(4595, 239, 385, '2022-05-16 09:50:19'),
(4596, 239, 385, '2022-05-16 09:50:20'),
(4597, 239, 385, '2022-05-16 09:50:20'),
(4598, 239, 385, '2022-05-16 09:50:20'),
(4599, 239, 385, '2022-05-16 09:50:35'),
(4600, 239, 385, '2022-05-16 09:50:36'),
(4601, 239, 385, '2022-05-16 09:50:36'),
(4602, 239, 385, '2022-05-16 09:50:36'),
(4603, 239, 385, '2022-05-16 09:50:40'),
(4604, 239, 385, '2022-05-16 09:50:40'),
(4605, 239, 385, '2022-05-16 09:50:40'),
(4606, 239, 385, '2022-05-16 09:50:40'),
(4607, 239, 385, '2022-05-16 09:50:46'),
(4608, 239, 385, '2022-05-16 09:50:46'),
(4609, 239, 385, '2022-05-16 09:50:46'),
(4610, 239, 385, '2022-05-16 09:50:46'),
(4611, 239, 385, '2022-05-16 09:51:09'),
(4612, 239, 385, '2022-05-16 09:51:10'),
(4613, 239, 385, '2022-05-16 09:51:10'),
(4614, 239, 385, '2022-05-16 09:51:10'),
(4615, 239, 385, '2022-05-16 09:51:20'),
(4616, 239, 385, '2022-05-16 09:51:20'),
(4617, 239, 385, '2022-05-16 09:51:20'),
(4618, 239, 385, '2022-05-16 09:51:21'),
(4619, 239, 385, '2022-05-16 09:51:37'),
(4620, 239, 385, '2022-05-16 09:51:37'),
(4621, 239, 385, '2022-05-16 09:51:37'),
(4622, 239, 385, '2022-05-16 09:51:37'),
(4623, 239, 385, '2022-05-16 09:51:40'),
(4624, 239, 385, '2022-05-16 09:51:40'),
(4625, 239, 385, '2022-05-16 09:51:40'),
(4626, 239, 385, '2022-05-16 09:51:40'),
(4627, 239, 352, '2022-05-16 13:56:54'),
(4628, 239, 352, '2022-05-16 13:56:55'),
(4629, 239, 352, '2022-05-16 13:56:55'),
(4630, 239, 352, '2022-05-16 13:56:55'),
(4631, 239, 388, '2022-05-17 07:07:04'),
(4632, 239, 388, '2022-05-17 07:07:05'),
(4633, 239, 388, '2022-05-17 07:07:05'),
(4634, 239, 388, '2022-05-17 07:07:05'),
(4635, 239, 388, '2022-05-17 07:16:16'),
(4636, 239, 388, '2022-05-17 07:16:16'),
(4637, 239, 388, '2022-05-17 07:16:16'),
(4638, 239, 388, '2022-05-17 07:16:16'),
(4639, 239, 388, '2022-05-17 07:18:30'),
(4640, 239, 388, '2022-05-17 07:18:30'),
(4641, 239, 388, '2022-05-17 07:18:30'),
(4642, 239, 388, '2022-05-17 07:18:31'),
(4643, 239, 388, '2022-05-17 07:45:09'),
(4644, 239, 388, '2022-05-17 07:45:09'),
(4645, 239, 388, '2022-05-17 07:45:09'),
(4646, 239, 388, '2022-05-17 07:45:09'),
(4647, 239, 389, '2022-05-18 06:34:50'),
(4648, 239, 389, '2022-05-18 06:34:50'),
(4649, 239, 389, '2022-05-18 06:34:50'),
(4650, 239, 389, '2022-05-18 06:34:50'),
(4651, 239, 389, '2022-05-18 06:35:01'),
(4652, 239, 389, '2022-05-18 06:35:01'),
(4653, 239, 389, '2022-05-18 06:35:01'),
(4654, 239, 389, '2022-05-18 06:35:01'),
(4655, 239, 389, '2022-05-18 06:35:12'),
(4656, 239, 389, '2022-05-18 06:35:13'),
(4657, 239, 389, '2022-05-18 06:35:13'),
(4658, 239, 389, '2022-05-18 06:35:13'),
(4659, 239, 389, '2022-05-18 06:35:50'),
(4660, 239, 389, '2022-05-18 06:35:50'),
(4661, 239, 389, '2022-05-18 06:35:50'),
(4662, 239, 389, '2022-05-18 06:35:50'),
(4663, 239, 389, '2022-05-18 06:39:27'),
(4664, 239, 389, '2022-05-18 06:39:28'),
(4665, 239, 389, '2022-05-18 06:39:28'),
(4666, 239, 389, '2022-05-18 06:39:28'),
(4667, 239, 389, '2022-05-18 06:39:36'),
(4668, 239, 389, '2022-05-18 06:39:37'),
(4669, 239, 389, '2022-05-18 06:39:37'),
(4670, 239, 389, '2022-05-18 06:39:37'),
(4671, 239, 389, '2022-05-18 06:39:41'),
(4672, 239, 389, '2022-05-18 06:39:42'),
(4673, 239, 389, '2022-05-18 06:39:42'),
(4674, 239, 389, '2022-05-18 06:39:42'),
(4675, 239, 389, '2022-05-18 06:42:57'),
(4676, 239, 389, '2022-05-18 06:42:57'),
(4677, 239, 389, '2022-05-18 06:42:57'),
(4678, 239, 389, '2022-05-18 06:42:57'),
(4679, 239, 389, '2022-05-18 06:44:59'),
(4680, 239, 389, '2022-05-18 06:45:00'),
(4681, 239, 389, '2022-05-18 06:45:00'),
(4682, 239, 389, '2022-05-18 06:45:00'),
(4683, 239, 389, '2022-05-18 06:46:33'),
(4684, 239, 389, '2022-05-18 06:46:33'),
(4685, 239, 389, '2022-05-18 06:46:33'),
(4686, 239, 389, '2022-05-18 06:46:34'),
(4687, 239, 389, '2022-05-18 06:47:29'),
(4688, 239, 389, '2022-05-18 06:47:29'),
(4689, 239, 389, '2022-05-18 06:47:29'),
(4690, 239, 389, '2022-05-18 06:47:29'),
(4691, 239, 389, '2022-05-18 06:50:53'),
(4692, 239, 389, '2022-05-18 06:50:54'),
(4693, 239, 389, '2022-05-18 06:50:54'),
(4694, 239, 389, '2022-05-18 06:50:54'),
(4695, 239, 384, '2022-05-18 10:26:11'),
(4696, 239, 384, '2022-05-18 10:26:11'),
(4697, 239, 384, '2022-05-18 10:26:11'),
(4698, 239, 384, '2022-05-18 10:26:11'),
(4699, 239, 384, '2022-05-18 10:39:58'),
(4700, 239, 384, '2022-05-18 10:39:58'),
(4701, 239, 384, '2022-05-18 10:39:58'),
(4702, 239, 384, '2022-05-18 10:39:58'),
(4703, 239, 384, '2022-05-18 10:40:20'),
(4704, 239, 384, '2022-05-18 10:40:20'),
(4705, 239, 384, '2022-05-18 10:40:20'),
(4706, 239, 384, '2022-05-18 10:40:20'),
(4707, 239, 384, '2022-05-18 10:41:10'),
(4708, 239, 384, '2022-05-18 10:41:11'),
(4709, 239, 384, '2022-05-18 10:41:11'),
(4710, 239, 384, '2022-05-18 10:41:11'),
(4711, 239, 384, '2022-05-18 10:42:02'),
(4712, 239, 384, '2022-05-18 10:42:03'),
(4713, 239, 384, '2022-05-18 10:42:03'),
(4714, 239, 384, '2022-05-18 10:42:03'),
(4715, 239, 384, '2022-05-18 10:43:25'),
(4716, 239, 384, '2022-05-18 10:43:25'),
(4717, 239, 384, '2022-05-18 10:43:25'),
(4718, 239, 384, '2022-05-18 10:43:25'),
(4719, 239, 384, '2022-05-18 10:55:06'),
(4720, 239, 384, '2022-05-18 10:55:07'),
(4721, 239, 384, '2022-05-18 10:55:07'),
(4722, 239, 384, '2022-05-18 10:55:07'),
(4723, 239, 389, '2022-05-18 14:22:08'),
(4724, 239, 389, '2022-05-18 14:22:08'),
(4725, 239, 389, '2022-05-18 14:22:09'),
(4726, 239, 389, '2022-05-18 14:22:09'),
(4727, 239, 389, '2022-05-18 14:22:52'),
(4728, 239, 389, '2022-05-18 14:22:53'),
(4729, 239, 389, '2022-05-18 14:22:53'),
(4730, 239, 389, '2022-05-18 14:22:53'),
(4731, 239, 389, '2022-05-18 14:26:35'),
(4732, 239, 389, '2022-05-18 14:26:35'),
(4733, 239, 389, '2022-05-18 14:26:35'),
(4734, 239, 389, '2022-05-18 14:26:35'),
(4735, 239, 389, '2022-05-18 14:26:36'),
(4736, 239, 389, '2022-05-26 13:29:24'),
(4737, 239, 389, '2022-05-26 13:29:24');
INSERT INTO `shop_visit` (`id`, `shop_id`, `user_id`, `created_date`) VALUES
(4738, 239, 389, '2022-05-26 13:29:24'),
(4739, 239, 389, '2022-05-26 13:29:24'),
(4740, 239, 389, '2022-05-26 13:31:22'),
(4741, 239, 389, '2022-05-26 13:31:22'),
(4742, 239, 389, '2022-05-26 13:31:22'),
(4743, 239, 389, '2022-05-26 13:31:22'),
(4744, 239, 389, '2022-05-26 13:53:23'),
(4745, 239, 389, '2022-05-26 13:53:24'),
(4746, 239, 389, '2022-05-26 13:53:24'),
(4747, 239, 389, '2022-05-26 13:53:24'),
(4748, 239, 385, '2022-05-30 09:25:40'),
(4749, 239, 385, '2022-05-30 09:25:40'),
(4750, 239, 385, '2022-05-30 09:25:40'),
(4751, 239, 385, '2022-05-30 09:25:40'),
(4752, 239, 385, '2022-05-30 10:33:11'),
(4753, 239, 385, '2022-05-30 10:33:12'),
(4754, 239, 385, '2022-05-30 10:33:12'),
(4755, 239, 385, '2022-05-30 10:33:12'),
(4756, 239, 385, '2022-05-30 10:39:52'),
(4757, 239, 385, '2022-05-30 10:39:52'),
(4758, 239, 385, '2022-05-30 10:39:52'),
(4759, 239, 385, '2022-05-30 10:39:52'),
(4760, 239, 385, '2022-05-30 10:42:06'),
(4761, 239, 385, '2022-05-30 10:42:06'),
(4762, 239, 385, '2022-05-30 10:42:06'),
(4763, 239, 385, '2022-05-30 10:42:06'),
(4764, 239, 385, '2022-05-30 10:44:26'),
(4765, 239, 385, '2022-05-30 10:44:26'),
(4766, 239, 385, '2022-05-30 10:44:26'),
(4767, 239, 385, '2022-05-30 10:44:26'),
(4768, 239, 385, '2022-05-30 10:44:30'),
(4769, 239, 385, '2022-05-30 10:44:31'),
(4770, 239, 385, '2022-05-30 10:44:31'),
(4771, 239, 385, '2022-05-30 10:44:31'),
(4772, 239, 385, '2022-05-30 10:45:39'),
(4773, 239, 385, '2022-05-30 10:45:40'),
(4774, 239, 385, '2022-05-30 10:45:40'),
(4775, 239, 385, '2022-05-30 10:45:40'),
(4776, 239, 385, '2022-05-30 10:46:01'),
(4777, 239, 385, '2022-05-30 10:46:02'),
(4778, 239, 385, '2022-05-30 10:46:02'),
(4779, 239, 385, '2022-05-30 10:46:02'),
(4780, 239, 385, '2022-05-30 10:46:20'),
(4781, 239, 385, '2022-05-30 10:46:20'),
(4782, 239, 385, '2022-05-30 10:46:20'),
(4783, 239, 385, '2022-05-30 10:46:20'),
(4784, 239, 385, '2022-05-30 10:46:21'),
(4785, 239, 385, '2022-05-30 10:46:22'),
(4786, 239, 385, '2022-05-30 10:46:22'),
(4787, 239, 385, '2022-05-30 10:46:22'),
(4788, 239, 385, '2022-05-30 10:46:27'),
(4789, 239, 385, '2022-05-30 10:46:27'),
(4790, 239, 385, '2022-05-30 10:46:28'),
(4791, 239, 385, '2022-05-30 10:46:28'),
(4792, 239, 385, '2022-05-30 10:47:11'),
(4793, 239, 385, '2022-05-30 10:47:11'),
(4794, 239, 385, '2022-05-30 10:47:11'),
(4795, 239, 385, '2022-05-30 10:47:11'),
(4796, 239, 385, '2022-05-30 10:47:15'),
(4797, 239, 385, '2022-05-30 10:47:15'),
(4798, 239, 385, '2022-05-30 10:47:15'),
(4799, 239, 385, '2022-05-30 10:47:15'),
(4800, 239, 385, '2022-05-30 10:47:15'),
(4801, 239, 385, '2022-05-30 10:48:37'),
(4802, 239, 385, '2022-05-30 10:48:38'),
(4803, 239, 385, '2022-05-30 10:48:38'),
(4804, 239, 385, '2022-05-30 10:48:38'),
(4805, 239, 385, '2022-05-30 10:48:43'),
(4806, 239, 385, '2022-05-30 10:48:43'),
(4807, 239, 385, '2022-05-30 10:48:43'),
(4808, 239, 385, '2022-05-30 10:48:43'),
(4809, 239, 385, '2022-05-30 10:48:54'),
(4810, 239, 385, '2022-05-30 10:48:55'),
(4811, 239, 385, '2022-05-30 10:48:55'),
(4812, 239, 385, '2022-05-30 10:48:55'),
(4813, 239, 385, '2022-05-30 10:48:55'),
(4814, 239, 385, '2022-05-30 10:49:02'),
(4815, 239, 385, '2022-05-30 10:49:02'),
(4816, 239, 385, '2022-05-30 10:49:02'),
(4817, 239, 385, '2022-05-30 10:49:02'),
(4818, 239, 385, '2022-05-30 10:49:02'),
(4819, 239, 385, '2022-05-30 10:49:18'),
(4820, 239, 385, '2022-05-30 10:49:19'),
(4821, 239, 385, '2022-05-30 10:49:19'),
(4822, 239, 385, '2022-05-30 10:49:19'),
(4823, 239, 385, '2022-05-30 10:49:51'),
(4824, 239, 385, '2022-05-30 10:49:51'),
(4825, 239, 385, '2022-05-30 10:49:51'),
(4826, 239, 385, '2022-05-30 10:49:51'),
(4827, 239, 385, '2022-05-30 10:49:55'),
(4828, 239, 385, '2022-05-30 10:49:55'),
(4829, 239, 385, '2022-05-30 10:49:56'),
(4830, 239, 385, '2022-05-30 10:49:56'),
(4831, 239, 385, '2022-05-30 10:49:56'),
(4832, 239, 385, '2022-05-30 10:49:56'),
(4833, 239, 385, '2022-05-30 10:49:56'),
(4834, 239, 385, '2022-05-30 10:49:56'),
(4835, 239, 385, '2022-05-30 10:49:57'),
(4836, 239, 385, '2022-05-30 10:49:57'),
(4837, 239, 385, '2022-05-30 10:49:57'),
(4838, 239, 385, '2022-05-30 10:49:57'),
(4839, 239, 385, '2022-05-30 10:54:07'),
(4840, 239, 385, '2022-05-30 10:54:08'),
(4841, 239, 385, '2022-05-30 10:54:08'),
(4842, 239, 385, '2022-05-30 10:54:08'),
(4843, 239, 385, '2022-05-30 10:54:23'),
(4844, 239, 385, '2022-05-30 10:54:23'),
(4845, 239, 385, '2022-05-30 10:54:23'),
(4846, 239, 385, '2022-05-30 10:54:23'),
(4847, 239, 385, '2022-05-30 10:54:26'),
(4848, 239, 385, '2022-05-30 10:54:26'),
(4849, 239, 385, '2022-05-30 10:54:27'),
(4850, 239, 385, '2022-05-30 10:54:27'),
(4851, 239, 385, '2022-05-30 10:54:27'),
(4852, 239, 385, '2022-05-30 10:54:31'),
(4853, 239, 385, '2022-05-30 10:54:31'),
(4854, 239, 385, '2022-05-30 10:54:32'),
(4855, 239, 385, '2022-05-30 10:54:32'),
(4856, 239, 385, '2022-05-30 10:54:32'),
(4857, 239, 385, '2022-05-30 10:55:00'),
(4858, 239, 385, '2022-05-30 10:55:00'),
(4859, 239, 385, '2022-05-30 10:55:00'),
(4860, 239, 385, '2022-05-30 10:55:01'),
(4861, 239, 385, '2022-05-30 10:55:03'),
(4862, 239, 385, '2022-05-30 10:55:04'),
(4863, 239, 385, '2022-05-30 10:55:04'),
(4864, 239, 385, '2022-05-30 10:55:04'),
(4865, 239, 385, '2022-05-30 10:55:04'),
(4866, 239, 385, '2022-05-30 10:55:47'),
(4867, 239, 385, '2022-05-30 10:55:47'),
(4868, 239, 385, '2022-05-30 10:55:47'),
(4869, 239, 385, '2022-05-30 10:55:47'),
(4870, 239, 385, '2022-05-30 10:55:50'),
(4871, 239, 385, '2022-05-30 10:55:51'),
(4872, 239, 385, '2022-05-30 10:55:51'),
(4873, 239, 385, '2022-05-30 10:55:51'),
(4874, 239, 385, '2022-05-30 10:55:51'),
(4875, 239, 385, '2022-05-30 10:56:34'),
(4876, 239, 385, '2022-05-30 10:56:35'),
(4877, 239, 385, '2022-05-30 10:56:35'),
(4878, 239, 385, '2022-05-30 10:56:35'),
(4879, 239, 385, '2022-05-30 10:57:18'),
(4880, 239, 385, '2022-05-30 10:57:19'),
(4881, 239, 385, '2022-05-30 10:57:19'),
(4882, 239, 385, '2022-05-30 10:57:19'),
(4883, 239, 385, '2022-05-30 10:57:33'),
(4884, 239, 385, '2022-05-30 10:57:33'),
(4885, 239, 385, '2022-05-30 10:57:33'),
(4886, 239, 385, '2022-05-30 10:57:33'),
(4887, 239, 385, '2022-05-30 10:57:48'),
(4888, 239, 385, '2022-05-30 10:57:49'),
(4889, 239, 385, '2022-05-30 10:57:49'),
(4890, 239, 385, '2022-05-30 10:57:49'),
(4891, 239, 385, '2022-05-30 10:57:52'),
(4892, 239, 385, '2022-05-30 10:57:52'),
(4893, 239, 385, '2022-05-30 10:57:53'),
(4894, 239, 385, '2022-05-30 10:57:53'),
(4895, 239, 385, '2022-05-30 10:57:53'),
(4896, 239, 385, '2022-05-30 10:59:00'),
(4897, 239, 385, '2022-05-30 10:59:00'),
(4898, 239, 385, '2022-05-30 10:59:00'),
(4899, 239, 385, '2022-05-30 10:59:00'),
(4900, 239, 385, '2022-05-30 10:59:34'),
(4901, 239, 385, '2022-05-30 10:59:34'),
(4902, 239, 385, '2022-05-30 10:59:34'),
(4903, 239, 385, '2022-05-30 10:59:34'),
(4904, 239, 385, '2022-05-30 11:00:00'),
(4905, 239, 385, '2022-05-30 11:00:00'),
(4906, 239, 385, '2022-05-30 11:00:01'),
(4907, 239, 385, '2022-05-30 11:00:01'),
(4908, 239, 385, '2022-05-30 11:00:01'),
(4909, 239, 385, '2022-05-30 11:01:02'),
(4910, 239, 385, '2022-05-30 11:01:02'),
(4911, 239, 385, '2022-05-30 11:01:03'),
(4912, 239, 385, '2022-05-30 11:01:03'),
(4913, 239, 385, '2022-05-30 11:01:20'),
(4914, 239, 385, '2022-05-30 11:01:21'),
(4915, 239, 385, '2022-05-30 11:01:21'),
(4916, 239, 385, '2022-05-30 11:01:21'),
(4917, 239, 385, '2022-05-30 11:01:55'),
(4918, 239, 385, '2022-05-30 11:01:55'),
(4919, 239, 385, '2022-05-30 11:01:55'),
(4920, 239, 385, '2022-05-30 11:01:55'),
(4921, 239, 385, '2022-05-30 11:02:00'),
(4922, 239, 385, '2022-05-30 11:02:01'),
(4923, 239, 385, '2022-05-30 11:02:01'),
(4924, 239, 385, '2022-05-30 11:02:01'),
(4925, 239, 385, '2022-05-30 11:02:01'),
(4926, 239, 385, '2022-05-30 11:02:01'),
(4927, 239, 385, '2022-05-30 11:02:01'),
(4928, 239, 385, '2022-05-30 11:02:01'),
(4929, 239, 385, '2022-05-30 11:02:52'),
(4930, 239, 385, '2022-05-30 11:02:53'),
(4931, 239, 385, '2022-05-30 11:02:53'),
(4932, 239, 385, '2022-05-30 11:02:53'),
(4933, 239, 385, '2022-05-30 11:03:14'),
(4934, 239, 385, '2022-05-30 11:03:15'),
(4935, 239, 385, '2022-05-30 11:03:15'),
(4936, 239, 385, '2022-05-30 11:03:15'),
(4937, 239, 385, '2022-05-30 11:03:30'),
(4938, 239, 385, '2022-05-30 11:03:30'),
(4939, 239, 385, '2022-05-30 11:03:30'),
(4940, 239, 385, '2022-05-30 11:03:30'),
(4941, 239, 385, '2022-05-30 11:03:35'),
(4942, 239, 385, '2022-05-30 11:03:35'),
(4943, 239, 385, '2022-05-30 11:03:35'),
(4944, 239, 385, '2022-05-30 11:03:35'),
(4945, 239, 385, '2022-05-30 11:03:49'),
(4946, 239, 385, '2022-05-30 11:03:50'),
(4947, 239, 385, '2022-05-30 11:03:50'),
(4948, 239, 385, '2022-05-30 11:03:50'),
(4949, 239, 385, '2022-05-30 11:16:45'),
(4950, 239, 385, '2022-05-30 11:16:46'),
(4951, 239, 385, '2022-05-30 11:16:46'),
(4952, 239, 385, '2022-05-30 11:16:46'),
(4953, 239, 385, '2022-05-30 11:19:57'),
(4954, 239, 385, '2022-05-30 11:19:58'),
(4955, 239, 385, '2022-05-30 11:19:58'),
(4956, 239, 385, '2022-05-30 11:19:58'),
(4957, 239, 385, '2022-05-30 11:20:13'),
(4958, 239, 385, '2022-05-30 11:20:13'),
(4959, 239, 385, '2022-05-30 11:20:13'),
(4960, 239, 385, '2022-05-30 11:20:13'),
(4961, 239, 385, '2022-05-30 11:20:18'),
(4962, 239, 385, '2022-05-30 11:20:19'),
(4963, 239, 385, '2022-05-30 11:20:19'),
(4964, 239, 385, '2022-05-30 11:20:19'),
(4965, 239, 385, '2022-05-30 11:20:31'),
(4966, 239, 385, '2022-05-30 11:20:31'),
(4967, 239, 385, '2022-05-30 11:20:31'),
(4968, 239, 385, '2022-05-30 11:20:32'),
(4969, 239, 385, '2022-05-30 11:20:32'),
(4970, 239, 385, '2022-05-30 11:20:32'),
(4971, 239, 385, '2022-05-30 11:23:42'),
(4972, 239, 385, '2022-05-30 11:23:42'),
(4973, 239, 385, '2022-05-30 11:23:42'),
(4974, 239, 385, '2022-05-30 11:23:42'),
(4975, 239, 385, '2022-05-30 11:23:47'),
(4976, 239, 385, '2022-05-30 11:23:48'),
(4977, 239, 385, '2022-05-30 11:23:48'),
(4978, 239, 385, '2022-05-30 11:23:48'),
(4979, 239, 385, '2022-05-30 11:26:38'),
(4980, 239, 385, '2022-05-30 11:26:39'),
(4981, 239, 385, '2022-05-30 11:26:39'),
(4982, 239, 385, '2022-05-30 11:26:39'),
(4983, 239, 385, '2022-05-30 11:30:04'),
(4984, 239, 385, '2022-05-30 11:30:05'),
(4985, 239, 385, '2022-05-30 11:30:05'),
(4986, 239, 385, '2022-05-30 11:30:05'),
(4987, 239, 385, '2022-05-30 11:30:22'),
(4988, 239, 385, '2022-05-30 11:30:23'),
(4989, 239, 385, '2022-05-30 11:30:23'),
(4990, 239, 385, '2022-05-30 11:30:23'),
(4991, 239, 385, '2022-05-30 11:30:26'),
(4992, 239, 385, '2022-05-30 11:30:26'),
(4993, 239, 385, '2022-05-30 11:30:26'),
(4994, 239, 385, '2022-05-30 11:30:26'),
(4995, 239, 385, '2022-05-30 11:30:55'),
(4996, 239, 385, '2022-05-30 11:30:56'),
(4997, 239, 385, '2022-05-30 11:30:56'),
(4998, 239, 385, '2022-05-30 11:30:56'),
(4999, 239, 385, '2022-05-30 11:31:28'),
(5000, 239, 385, '2022-05-30 11:31:28'),
(5001, 239, 385, '2022-05-30 11:31:28'),
(5002, 239, 385, '2022-05-30 11:31:28'),
(5003, 239, 385, '2022-05-30 12:59:35'),
(5004, 239, 385, '2022-05-30 12:59:35'),
(5005, 239, 385, '2022-05-30 12:59:35'),
(5006, 239, 385, '2022-05-30 12:59:35'),
(5007, 239, 385, '2022-05-30 13:00:28'),
(5008, 239, 385, '2022-05-30 13:00:28'),
(5009, 239, 385, '2022-05-30 13:00:28'),
(5010, 239, 385, '2022-05-30 13:00:28'),
(5011, 239, 385, '2022-05-31 04:47:53'),
(5012, 239, 385, '2022-05-31 04:47:53'),
(5013, 239, 385, '2022-05-31 04:47:53'),
(5014, 239, 385, '2022-05-31 04:47:53'),
(5015, 239, 385, '2022-05-31 04:53:55'),
(5016, 239, 385, '2022-05-31 04:53:56'),
(5017, 239, 385, '2022-05-31 04:53:56'),
(5018, 239, 385, '2022-05-31 04:53:56'),
(5019, 239, 385, '2022-05-31 12:13:47'),
(5020, 239, 385, '2022-05-31 12:13:47'),
(5021, 239, 385, '2022-05-31 12:13:47'),
(5022, 239, 385, '2022-05-31 12:13:47'),
(5023, 239, 390, '2022-06-06 10:59:00'),
(5024, 239, 390, '2022-06-06 10:59:00'),
(5025, 239, 390, '2022-06-06 10:59:00'),
(5026, 239, 390, '2022-06-06 10:59:00'),
(5027, 239, 385, '2022-06-10 10:18:14'),
(5028, 239, 385, '2022-06-10 10:18:14'),
(5029, 239, 385, '2022-06-10 10:18:14'),
(5030, 239, 385, '2022-06-10 10:18:14'),
(5031, 239, 385, '2022-06-10 11:47:44'),
(5032, 239, 385, '2022-06-10 11:47:44'),
(5033, 239, 385, '2022-06-10 11:47:44'),
(5034, 239, 385, '2022-06-10 11:47:44'),
(5035, 239, 385, '2022-06-10 12:02:13'),
(5036, 239, 385, '2022-06-10 12:02:13'),
(5037, 239, 385, '2022-06-10 12:02:13'),
(5038, 239, 385, '2022-06-10 12:02:13'),
(5039, 239, 385, '2022-06-10 12:22:51'),
(5040, 239, 385, '2022-06-10 12:22:52'),
(5041, 239, 385, '2022-06-10 12:22:52'),
(5042, 239, 385, '2022-06-10 12:22:52'),
(5043, 239, 385, '2022-06-10 12:24:43'),
(5044, 239, 385, '2022-06-10 13:36:09'),
(5045, 239, 385, '2022-06-10 13:36:10'),
(5046, 239, 385, '2022-06-10 13:36:10'),
(5047, 239, 385, '2022-06-10 13:36:10'),
(5048, 239, 385, '2022-06-10 13:56:06'),
(5049, 239, 385, '2022-06-10 13:56:06'),
(5050, 239, 385, '2022-06-10 13:56:06'),
(5051, 239, 385, '2022-06-10 13:56:06'),
(5052, 239, 385, '2022-06-10 14:47:56'),
(5053, 239, 385, '2022-06-10 14:47:57'),
(5054, 239, 385, '2022-06-10 14:47:57'),
(5055, 239, 385, '2022-06-10 14:47:57'),
(5056, 239, 389, '2022-06-13 07:31:27'),
(5057, 239, 389, '2022-06-13 07:31:27'),
(5058, 239, 389, '2022-06-13 07:31:27'),
(5059, 239, 389, '2022-06-13 07:31:27'),
(5060, 239, 389, '2022-06-13 07:33:33'),
(5061, 239, 389, '2022-06-13 07:33:34'),
(5062, 239, 389, '2022-06-13 07:33:34'),
(5063, 239, 389, '2022-06-13 07:33:34'),
(5064, 240, 389, '2022-06-13 07:35:49'),
(5065, 240, 389, '2022-06-13 07:35:49'),
(5066, 240, 389, '2022-06-13 07:35:49'),
(5067, 240, 389, '2022-06-13 07:35:49'),
(5068, 240, 389, '2022-06-13 07:35:49'),
(5069, 239, 388, '2022-06-22 10:41:34'),
(5070, 239, 388, '2022-06-22 10:41:34'),
(5071, 239, 388, '2022-06-22 10:41:34'),
(5072, 239, 388, '2022-06-22 10:41:34'),
(5073, 239, 388, '2022-06-22 10:46:24'),
(5074, 239, 388, '2022-06-22 10:46:24'),
(5075, 239, 388, '2022-06-22 10:46:24'),
(5076, 239, 388, '2022-06-22 10:46:24'),
(5077, 239, 389, '2022-06-22 14:50:15'),
(5078, 239, 389, '2022-06-22 14:50:15'),
(5079, 239, 389, '2022-06-22 14:50:15'),
(5080, 239, 389, '2022-06-22 14:50:15'),
(5081, 239, 389, '2022-06-22 14:51:34'),
(5082, 239, 389, '2022-06-22 14:51:35'),
(5083, 239, 389, '2022-06-22 14:51:35'),
(5084, 239, 389, '2022-06-22 14:51:35'),
(5085, 239, 389, '2022-06-22 14:51:36'),
(5086, 239, 389, '2022-06-22 14:51:36'),
(5087, 239, 389, '2022-06-22 14:51:36'),
(5088, 239, 389, '2022-06-22 14:57:31'),
(5089, 239, 389, '2022-06-22 14:57:31'),
(5090, 239, 389, '2022-06-22 14:57:32'),
(5091, 239, 389, '2022-06-22 14:57:32'),
(5092, 239, 389, '2022-06-22 15:03:23'),
(5093, 239, 389, '2022-06-22 15:03:24'),
(5094, 239, 389, '2022-06-22 15:03:24'),
(5095, 239, 389, '2022-06-22 15:03:24'),
(5096, 239, 389, '2022-06-22 15:11:33'),
(5097, 239, 389, '2022-06-22 15:11:34'),
(5098, 239, 389, '2022-06-22 15:11:34'),
(5099, 239, 389, '2022-06-22 15:11:34'),
(5100, 239, 389, '2022-06-22 15:13:13'),
(5101, 239, 389, '2022-06-22 15:13:14'),
(5102, 239, 389, '2022-06-22 15:13:14'),
(5103, 239, 389, '2022-06-22 15:13:14'),
(5104, 239, 389, '2022-06-22 15:13:15'),
(5105, 239, 389, '2022-06-22 15:13:15'),
(5106, 239, 389, '2022-06-22 15:13:15'),
(5107, 239, 389, '2022-06-22 15:26:32'),
(5108, 239, 389, '2022-06-22 15:26:33'),
(5109, 239, 389, '2022-06-22 15:26:33'),
(5110, 239, 389, '2022-06-22 15:26:33'),
(5111, 239, 389, '2022-06-22 15:27:48'),
(5112, 239, 389, '2022-06-22 15:27:48'),
(5113, 239, 389, '2022-06-22 15:27:48'),
(5114, 239, 389, '2022-06-22 15:27:48'),
(5115, 239, 389, '2022-06-22 15:30:07'),
(5116, 239, 389, '2022-06-22 15:30:08'),
(5117, 239, 389, '2022-06-22 15:30:08'),
(5118, 239, 389, '2022-06-22 15:30:08'),
(5119, 239, 389, '2022-06-22 15:36:33'),
(5120, 239, 389, '2022-06-22 15:36:34'),
(5121, 239, 389, '2022-06-22 15:36:34'),
(5122, 239, 389, '2022-06-22 15:36:34'),
(5123, 239, 384, '2022-06-24 04:42:13'),
(5124, 239, 384, '2022-06-24 04:42:14'),
(5125, 239, 384, '2022-06-24 04:42:14'),
(5126, 239, 384, '2022-06-24 04:42:14'),
(5127, 239, 384, '2022-06-24 04:42:39'),
(5128, 239, 384, '2022-06-24 04:42:40'),
(5129, 239, 384, '2022-06-24 04:42:40'),
(5130, 239, 384, '2022-06-24 04:42:40'),
(5131, 239, 384, '2022-06-24 04:43:15'),
(5132, 239, 384, '2022-06-24 04:43:15'),
(5133, 239, 384, '2022-06-24 04:43:15'),
(5134, 239, 384, '2022-06-24 04:43:15'),
(5135, 239, 384, '2022-06-24 06:45:21'),
(5136, 239, 384, '2022-06-24 06:45:21'),
(5137, 239, 384, '2022-06-24 06:45:21'),
(5138, 239, 384, '2022-06-24 06:45:22'),
(5139, 239, 384, '2022-06-24 06:53:21'),
(5140, 239, 384, '2022-06-24 06:53:21'),
(5141, 239, 384, '2022-06-24 06:53:21'),
(5142, 239, 384, '2022-06-24 06:53:21'),
(5143, 239, 384, '2022-06-24 07:07:45'),
(5144, 239, 384, '2022-06-24 07:07:46'),
(5145, 239, 384, '2022-06-24 07:07:46'),
(5146, 239, 384, '2022-06-24 07:07:46'),
(5147, 239, 384, '2022-06-24 07:08:22'),
(5148, 239, 384, '2022-06-24 07:08:24'),
(5149, 239, 384, '2022-06-24 07:08:24'),
(5150, 239, 384, '2022-06-24 07:08:24'),
(5151, 239, 384, '2022-06-24 07:09:09'),
(5152, 239, 384, '2022-06-24 07:09:10'),
(5153, 239, 384, '2022-06-24 07:09:10'),
(5154, 239, 384, '2022-06-24 07:09:10'),
(5155, 239, 384, '2022-06-24 07:10:32'),
(5156, 239, 384, '2022-06-24 07:10:32'),
(5157, 239, 384, '2022-06-24 07:10:32'),
(5158, 239, 384, '2022-06-24 07:10:32'),
(5159, 239, 384, '2022-06-24 07:31:15'),
(5160, 239, 384, '2022-06-24 07:31:16'),
(5161, 239, 384, '2022-06-24 07:31:16'),
(5162, 239, 384, '2022-06-24 07:31:16'),
(5163, 239, 385, '2022-06-24 08:56:28'),
(5164, 239, 385, '2022-06-24 08:56:29'),
(5165, 239, 385, '2022-06-24 08:56:29'),
(5166, 239, 385, '2022-06-24 08:56:29'),
(5167, 239, 385, '2022-06-24 11:40:10'),
(5168, 239, 385, '2022-06-24 11:40:10'),
(5169, 239, 385, '2022-06-24 11:40:10'),
(5170, 239, 385, '2022-06-24 11:40:10'),
(5171, 239, 385, '2022-06-28 06:23:56'),
(5172, 239, 385, '2022-06-28 06:23:56'),
(5173, 239, 385, '2022-06-28 06:23:56'),
(5174, 239, 385, '2022-06-28 06:23:56'),
(5175, 239, 385, '2022-06-28 06:27:48'),
(5176, 239, 385, '2022-06-28 06:27:48'),
(5177, 239, 385, '2022-06-28 06:27:48'),
(5178, 239, 385, '2022-06-28 06:27:48'),
(5179, 239, 385, '2022-06-28 06:31:10'),
(5180, 239, 385, '2022-06-28 06:31:11'),
(5181, 239, 385, '2022-06-28 06:31:11'),
(5182, 239, 385, '2022-06-28 06:31:11'),
(5183, 239, 385, '2022-06-28 06:32:06'),
(5184, 239, 385, '2022-06-28 06:32:06'),
(5185, 239, 385, '2022-06-28 06:32:06'),
(5186, 239, 385, '2022-06-28 06:32:06'),
(5187, 239, 385, '2022-06-28 06:32:49'),
(5188, 239, 385, '2022-06-28 06:32:52'),
(5189, 239, 385, '2022-06-28 06:32:52'),
(5190, 239, 385, '2022-06-28 06:32:52'),
(5191, 239, 385, '2022-06-28 06:35:11'),
(5192, 239, 385, '2022-06-28 06:35:11'),
(5193, 239, 385, '2022-06-28 06:35:11'),
(5194, 239, 385, '2022-06-28 06:35:11'),
(5195, 239, 385, '2022-06-28 06:36:57'),
(5196, 239, 385, '2022-06-28 06:36:57'),
(5197, 239, 385, '2022-06-28 06:36:57'),
(5198, 239, 385, '2022-06-28 06:36:57'),
(5199, 239, 385, '2022-06-28 06:38:25'),
(5200, 239, 385, '2022-06-28 06:38:26'),
(5201, 239, 385, '2022-06-28 06:38:26'),
(5202, 239, 385, '2022-06-28 06:38:26'),
(5203, 239, 385, '2022-06-28 06:44:32'),
(5204, 239, 385, '2022-06-28 06:44:32'),
(5205, 239, 385, '2022-06-28 06:44:32'),
(5206, 239, 385, '2022-06-28 06:44:32'),
(5207, 239, 385, '2022-06-28 06:46:44'),
(5208, 239, 385, '2022-06-28 06:46:44'),
(5209, 239, 385, '2022-06-28 06:46:44'),
(5210, 239, 385, '2022-06-28 06:46:44'),
(5211, 239, 385, '2022-06-28 06:47:41'),
(5212, 239, 385, '2022-06-28 06:47:42'),
(5213, 239, 385, '2022-06-28 06:47:42'),
(5214, 239, 385, '2022-06-28 06:47:42'),
(5215, 239, 385, '2022-06-28 06:56:16'),
(5216, 239, 385, '2022-06-28 06:56:16'),
(5217, 239, 385, '2022-06-28 06:56:16'),
(5218, 239, 385, '2022-06-28 06:56:16'),
(5219, 239, 385, '2022-06-28 07:30:28'),
(5220, 239, 385, '2022-06-28 07:30:28'),
(5221, 239, 385, '2022-06-28 07:30:28'),
(5222, 239, 385, '2022-06-28 07:30:29'),
(5223, 239, 385, '2022-06-28 07:31:00'),
(5224, 239, 385, '2022-06-28 07:31:00'),
(5225, 239, 385, '2022-06-28 07:31:00'),
(5226, 239, 385, '2022-06-28 07:31:00'),
(5227, 239, 385, '2022-06-28 07:31:23'),
(5228, 239, 385, '2022-06-28 07:31:23'),
(5229, 239, 385, '2022-06-28 07:31:23'),
(5230, 239, 385, '2022-06-28 07:31:23'),
(5231, 239, 385, '2022-06-28 07:34:29'),
(5232, 239, 385, '2022-06-28 07:34:29'),
(5233, 239, 385, '2022-06-28 07:34:29'),
(5234, 239, 385, '2022-06-28 07:34:29'),
(5235, 239, 385, '2022-06-28 07:34:32'),
(5236, 239, 385, '2022-06-28 07:34:32'),
(5237, 239, 385, '2022-06-28 07:34:32'),
(5238, 239, 385, '2022-06-28 07:34:32'),
(5239, 239, 385, '2022-06-28 07:34:35'),
(5240, 239, 385, '2022-06-28 07:34:35'),
(5241, 239, 385, '2022-06-28 07:34:35'),
(5242, 239, 385, '2022-06-28 07:34:35'),
(5243, 239, 385, '2022-06-28 07:47:44'),
(5244, 239, 385, '2022-06-28 07:47:45'),
(5245, 239, 385, '2022-06-28 07:47:45'),
(5246, 239, 385, '2022-06-28 07:47:45'),
(5247, 239, 385, '2022-06-28 07:48:03'),
(5248, 239, 385, '2022-06-28 07:48:04'),
(5249, 239, 385, '2022-06-28 07:48:04'),
(5250, 239, 385, '2022-06-28 07:48:04'),
(5251, 239, 385, '2022-06-28 07:48:17'),
(5252, 239, 385, '2022-06-28 07:48:17'),
(5253, 239, 385, '2022-06-28 07:48:18'),
(5254, 239, 385, '2022-06-28 07:48:18'),
(5255, 239, 385, '2022-06-28 07:54:52'),
(5256, 239, 385, '2022-06-28 07:54:53'),
(5257, 239, 385, '2022-06-28 07:54:53'),
(5258, 239, 385, '2022-06-28 07:54:53'),
(5259, 239, 384, '2022-06-28 10:52:59'),
(5260, 239, 389, '2022-07-16 13:20:42'),
(5261, 239, 389, '2022-07-16 13:20:43'),
(5262, 239, 389, '2022-07-16 13:20:43'),
(5263, 239, 389, '2022-07-16 13:20:44'),
(5264, 239, 352, '2022-07-19 10:30:45'),
(5265, 239, 352, '2022-07-19 10:30:45'),
(5266, 239, 352, '2022-07-19 10:30:46'),
(5267, 239, 352, '2022-07-19 10:30:46'),
(5268, 239, 352, '2022-07-22 11:29:53'),
(5269, 239, 352, '2022-07-22 11:29:54'),
(5270, 239, 352, '2022-07-22 11:29:54'),
(5271, 239, 352, '2022-07-22 11:29:54'),
(5272, 239, 352, '2022-07-22 11:30:05'),
(5273, 239, 352, '2022-07-22 11:30:06'),
(5274, 239, 352, '2022-07-22 11:30:06'),
(5275, 239, 352, '2022-07-22 11:30:06'),
(5276, 239, 352, '2022-07-22 11:47:17'),
(5277, 239, 352, '2022-07-22 11:47:18'),
(5278, 239, 352, '2022-07-22 11:47:18'),
(5279, 239, 352, '2022-07-22 11:47:19'),
(5280, 239, 352, '2022-07-22 12:19:34'),
(5281, 239, 352, '2022-07-22 12:19:35'),
(5282, 239, 352, '2022-07-22 12:19:35'),
(5283, 239, 352, '2022-07-22 12:19:35'),
(5284, 239, 352, '2022-07-22 12:39:18'),
(5285, 239, 352, '2022-07-22 12:39:19'),
(5286, 239, 352, '2022-07-22 12:39:19'),
(5287, 239, 352, '2022-07-22 12:39:19'),
(5288, 239, 352, '2022-07-22 12:41:01'),
(5289, 239, 352, '2022-07-22 12:41:02'),
(5290, 239, 352, '2022-07-22 12:41:02'),
(5291, 239, 352, '2022-07-22 12:41:02'),
(5292, 239, 352, '2022-07-22 12:41:20'),
(5293, 239, 352, '2022-07-22 12:41:20'),
(5294, 239, 352, '2022-07-22 12:41:20'),
(5295, 239, 352, '2022-07-22 12:41:20'),
(5296, 239, 352, '2022-07-22 12:44:52'),
(5297, 239, 352, '2022-07-22 12:44:53'),
(5298, 239, 352, '2022-07-22 12:44:53'),
(5299, 239, 352, '2022-07-22 12:44:53'),
(5300, 239, 352, '2022-07-22 12:48:32'),
(5301, 239, 352, '2022-07-22 12:48:32'),
(5302, 239, 352, '2022-07-22 12:48:32'),
(5303, 239, 352, '2022-07-22 12:48:32'),
(5304, 239, 352, '2022-07-22 12:53:55'),
(5305, 239, 352, '2022-07-22 12:53:56'),
(5306, 239, 352, '2022-07-22 12:53:56'),
(5307, 239, 352, '2022-07-22 12:53:56'),
(5308, 239, 352, '2022-07-22 12:54:38'),
(5309, 239, 352, '2022-07-22 12:54:39'),
(5310, 239, 352, '2022-07-22 12:54:39'),
(5311, 239, 352, '2022-07-22 12:54:39'),
(5312, 239, 352, '2022-07-22 12:54:44'),
(5313, 239, 352, '2022-07-22 12:54:45'),
(5314, 239, 352, '2022-07-22 12:54:45'),
(5315, 239, 352, '2022-07-22 12:54:45'),
(5316, 239, 352, '2022-07-22 12:54:50'),
(5317, 239, 352, '2022-07-22 12:54:51'),
(5318, 239, 352, '2022-07-22 12:54:51'),
(5319, 239, 352, '2022-07-22 12:54:51'),
(5320, 239, 352, '2022-07-22 12:54:54'),
(5321, 239, 352, '2022-07-22 12:54:55'),
(5322, 239, 352, '2022-07-22 12:54:55'),
(5323, 239, 352, '2022-07-22 12:54:55'),
(5324, 239, 352, '2022-07-22 12:54:56'),
(5325, 239, 352, '2022-07-22 12:54:56'),
(5326, 239, 352, '2022-07-22 12:54:56'),
(5327, 239, 352, '2022-07-22 12:54:56'),
(5328, 239, 352, '2022-07-22 12:54:57'),
(5329, 239, 352, '2022-07-22 12:54:58'),
(5330, 239, 352, '2022-07-22 12:54:58'),
(5331, 239, 352, '2022-07-22 12:54:58'),
(5332, 239, 352, '2022-07-22 12:58:00'),
(5333, 239, 352, '2022-07-22 12:58:00'),
(5334, 239, 352, '2022-07-22 12:58:00'),
(5335, 239, 352, '2022-07-22 12:58:00'),
(5336, 239, 352, '2022-07-22 12:58:05'),
(5337, 239, 352, '2022-07-22 12:58:05'),
(5338, 239, 352, '2022-07-22 12:58:05'),
(5339, 239, 352, '2022-07-22 12:58:06');

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

--
-- Dumping data for table `shop_work_hours`
--

INSERT INTO `shop_work_hours` (`id`, `shop_id`, `week_name`, `is_working_day`, `open_time`, `close_time`, `status`) VALUES
(6917, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(6918, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(6919, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(6920, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(6921, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(6922, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(6923, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(6924, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(6925, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(6926, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(6927, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(6928, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(6929, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(6930, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(6931, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(6932, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(6933, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(6934, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(6935, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(6936, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(6937, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(6938, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(6939, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(6940, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(6941, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(6942, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(6943, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(6944, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(6945, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(6946, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(6947, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(6948, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(6949, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(6950, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(6951, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(6952, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(6953, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(6954, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(6955, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(6956, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(6957, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(6958, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(6959, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(6960, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(6961, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(6962, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(6963, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(6964, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(6965, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(6966, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(6967, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(6968, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(6969, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(6970, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(6971, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(6972, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(6973, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(6974, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(6975, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(6976, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(6977, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(6978, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(6979, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(6980, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(6981, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(6982, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(6983, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(6984, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(6985, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(6986, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(6987, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(6988, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(6989, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(6990, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(6991, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(6992, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(6993, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(6994, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(6995, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(6996, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(6997, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(6998, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(6999, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(7000, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(7001, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(7002, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(7003, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(7004, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(7005, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(7006, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(7007, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(7008, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(7009, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(7010, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(7011, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(7012, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(7013, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(7014, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(7015, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(7016, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(7017, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(7018, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(7019, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(7020, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(7021, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(7022, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(7023, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(7024, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(7025, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(7026, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(7027, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(7028, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(7029, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(7030, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(7031, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(7032, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(7033, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(7034, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(7035, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(7036, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(7037, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(7038, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(7039, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(7040, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(7041, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(7042, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(7043, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(7044, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(7045, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(7046, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(7047, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(7048, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(7049, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(7050, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(7051, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(7052, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(7053, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(7054, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(7055, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(7056, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(7057, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(7058, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(7059, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(7060, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(7061, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(7062, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(7063, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(7064, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(7065, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(7066, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(7067, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(7068, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(7069, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(7070, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(7071, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(7072, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(7073, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(7074, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(7075, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(7076, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(7077, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(7078, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(7079, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(7080, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(7081, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(7082, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(7083, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(7084, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(7085, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(7086, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(7087, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(7088, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(7089, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(7090, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(7091, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(7092, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(7093, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(7094, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(7095, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(7096, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(7097, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(7098, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(7099, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(7100, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(7101, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(7102, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(7103, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(7104, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(7105, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(7106, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(7107, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(7108, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(7109, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(7110, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(7111, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(7112, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(7113, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(7114, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(7115, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(7116, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(7117, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(7118, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(7119, 0, 'Sunday', 'Yes', '10:00', '20:00', 1),
(7120, 0, 'Monday', 'Yes', '10:00:00', '20:00:00', 1),
(7121, 0, 'Tuesday', 'Yes', '10:00:00', '20:00:00', 1),
(7122, 0, 'Wednesday', 'Yes', '10:00', '20:00', 1),
(7123, 0, 'Thursday', 'Yes', '10:00', '20:00', 1),
(7124, 0, 'Friday', 'Yes', '10:00', '20:00', 1),
(7125, 0, 'Saturday', 'Yes', '10:00', '20:00', 1),
(7126, 0, 'Sunday', 'Yes', '10:00', '20:00', 1);

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
(1977, 1, 349, 241, 'Dear vendor new order no.1 is in your dashboard. Please accept it for confirmation.', '1624082808', 0),
(1978, 1, 241, 349, 'Dear chaitu k your order no.1 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1624082808', 1),
(1979, 2, 349, 241, 'Dear vendor new order no.2 is in your dashboard. Please accept it for confirmation.', '1624272962', 0),
(1980, 2, 241, 349, 'Dear chaitu k your order no.2 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1624272962', 1),
(1981, 3, 352, 241, 'Dear vendor new order no.3 is in your dashboard. Please accept it for confirmation.', '1624273058', 0),
(1982, 3, 241, 352, 'Dear satish your order no.3 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1624273058', 0),
(1983, 4, 349, 241, 'Dear vendor new order no.4 is in your dashboard. Please accept it for confirmation.', '1624273200', 0),
(1984, 4, 241, 349, 'Dear chaitu your order no.4 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1624273200', 1),
(1985, 5, 353, 241, 'Dear vendor new order no.5 is in your dashboard. Please accept it for confirmation.', '1624274640', 0),
(1986, 5, 241, 353, 'Dear chaitu your order no.5 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1624274640', 1),
(1987, 6, 353, 239, 'Dear vendor new order no.6 is in your dashboard. Please accept it for confirmation.', '1624281674', 0),
(1988, 6, 239, 353, 'Dear chaitu s your order no.6 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1624281674', 1),
(1989, 7, 353, 241, 'Dear vendor new order no.7 is in your dashboard. Please accept it for confirmation.', '1624281986', 0),
(1990, 7, 241, 353, 'Dear chaitu s your order no.7 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1624281987', 1),
(1991, 8, 353, 241, 'Dear vendor new order no.8 is in your dashboard. Please accept it for confirmation.', '1624282121', 0),
(1992, 8, 241, 353, 'Dear chaitu s your order no.8 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1624282121', 1),
(1993, 9, 353, 241, 'Dear vendor new order no.9 is in your dashboard. Please accept it for confirmation.', '1624282133', 0),
(1994, 9, 241, 353, 'Dear chaitu s your order no.9 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1624282133', 1),
(1995, 10, 353, 239, 'Dear vendor new order no.10 is in your dashboard. Please accept it for confirmation.', '1624337241', 0),
(1996, 10, 239, 353, 'Dear chaitu s your order no.10 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1624337241', 1),
(1997, 11, 353, 241, 'Dear vendor new order no.11 is in your dashboard. Please accept it for confirmation.', '1624337553', 0),
(1998, 11, 241, 353, 'Dear chaitu s your order no.11 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1624337553', 1),
(1999, 12, 353, 241, 'Dear vendor new order no.12 is in your dashboard. Please accept it for confirmation.', '1624337573', 0),
(2000, 12, 241, 353, 'Dear chaitu s your order no.12 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1624337574', 1),
(2001, 10, 239, 353, 'Dear chaitu your order is 10 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.', '1624338077', 1),
(2002, 1, 352, 239, 'Dear vendor new order no.1 is in your dashboard. Please accept it for confirmation.', '1624361016', 0),
(2003, 1, 239, 352, 'Dear satish your order no.1 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1624361016', 0),
(2004, 4, 353, 239, 'Dear vendor new order no.4 is in your dashboard. Please accept it for confirmation.', '1624364635', 0),
(2005, 4, 239, 353, 'Dear chaitu your order no.4 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1624364635', 1),
(2006, 5, 353, 241, 'Dear vendor new order no.5 is in your dashboard. Please accept it for confirmation.', '1624364675', 0),
(2007, 5, 241, 353, 'Dear chaitu your order no.5 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1624364675', 1),
(2008, 2, 353, 239, 'Dear vendor new order no.2 is in your dashboard. Please accept it for confirmation.', '1624365962', 0),
(2009, 2, 239, 353, 'Dear chaitu your order no.2 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1624365962', 1),
(2010, 3, 353, 239, 'Dear vendor new order no.3 is in your dashboard. Please accept it for confirmation.', '1624366004', 0),
(2011, 3, 239, 353, 'Dear chaitu your order no.3 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1624366004', 1),
(2012, 1, 353, 239, 'Dear vendor new order no.1 is in your dashboard. Please accept it for confirmation.', '1624366936', 0),
(2013, 1, 239, 353, 'Dear chaitu your order no.1 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1624366936', 1),
(2014, 1, 239, 353, 'Dear chaitu your order is 1 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with sector6.', '1624444229', 1),
(2015, 1, 239, 352, 'Dear satish your order is 1 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with sector6.', '1624530393', 0),
(2016, 2, 239, 353, 'Dear chaitu your order is 2 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with sector6.', '1624531731', 1),
(2017, 3, 239, 353, 'Dear chaitu your order is 3 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with sector6.', '1624602139', 1),
(2018, 4, 354, 239, 'Dear vendor new order no.4 is in your dashboard. Please accept it for confirmation.', '1624626916', 0),
(2019, 4, 239, 354, 'Dear chaitu your order no.4 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1624626916', 1),
(2020, 5, 354, 241, 'Dear vendor new order no.5 is in your dashboard. Please accept it for confirmation.', '1625296481', 0),
(2021, 5, 241, 354, 'Dear chaitu your order no.5 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1625296481', 1),
(2022, 6, 354, 241, 'Dear vendor new order no.6 is in your dashboard. Please accept it for confirmation.', '1625645401', 0),
(2023, 6, 241, 354, 'Dear chaitu your order no.6 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1625645402', 1),
(2024, 7, 354, 241, 'Dear vendor new order no.7 is in your dashboard. Please accept it for confirmation.', '1625645425', 0),
(2025, 7, 241, 354, 'Dear chaitu your order no.7 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1625645425', 1),
(2026, 9, 239, 353, 'Dear chaitu your order is 9 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with sector6.', '1630927827', 1),
(2027, 0, 355, 241, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation.', '1632734450', 0),
(2028, 0, 241, 355, 'Dear Prashanth your order no.0 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1632734450', 1),
(2029, 0, 357, 241, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation.', '1632735878', 0),
(2030, 0, 241, 357, 'Dear Manikanta your order no.0 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1632735879', 1),
(2031, 0, 355, 248, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation.', '1632741362', 0),
(2032, 0, 248, 355, 'Dear Prashanth your order no.0 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1632741363', 1),
(2033, 0, 357, 249, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation.', '1632833447', 0),
(2034, 0, 249, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1632833447', 1),
(2035, 0, 357, 249, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation.', '1632833899', 0),
(2036, 0, 249, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1632833899', 1),
(2037, 0, 357, 249, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation.', '1632833981', 0),
(2038, 0, 249, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1632833981', 1),
(2039, 0, 355, 241, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation.', '1632896385', 0),
(2040, 0, 241, 355, 'Dear Prashanth Bandi your order no.0 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1632896386', 1),
(2041, 0, 355, 241, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation.', '1632898297', 0),
(2042, 0, 241, 355, 'Dear Prashanth Bandi your order no.0 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1632898297', 1),
(2043, 0, 355, 248, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation.', '1632898372', 0),
(2044, 0, 248, 355, 'Dear Prashanth Bandi your order no.0 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1632898372', 1),
(2045, 0, 355, 249, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation.', '1632906262', 0),
(2046, 0, 249, 355, 'Dear Prashanth Bandi your order no.0 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1632906262', 1),
(2047, 0, 355, 249, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation.', '1632913504', 0),
(2048, 0, 249, 355, 'Dear  your order no.0 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1632913504', 0),
(2049, 0, 357, 249, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation.', '1632915603', 0),
(2050, 0, 249, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1632915604', 1),
(2051, 0, 355, 248, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation.', '1632915820', 0),
(2052, 0, 248, 355, 'Dear  your order no.0 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1632915820', 0),
(2053, 22, 0, 355, 'Admin Cancel the order', '1632984758', 0),
(2054, 8, 0, 354, 'Admin Cancel the order', '1632984783', 0),
(2055, 4, 0, 354, 'Admin Cancel the order', '1632984799', 0),
(2056, 0, 360, 248, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation.', '1632986930', 0),
(2057, 0, 248, 360, 'Dear Prashanth your order no.0 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1632986930', 1),
(2058, 0, 360, 249, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation.', '1633003908', 0),
(2059, 0, 249, 360, 'Dear Prashanth your order no.0 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1633003909', 1),
(2060, 0, 360, 248, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation.', '1633008714', 0),
(2061, 0, 248, 360, 'Dear Prashanth your order no.0 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1633008715', 0),
(2062, 0, 357, 249, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1633429167', 0),
(2063, 0, 249, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1633429167', 1),
(2064, 0, 357, 249, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1633429282', 0),
(2065, 0, 249, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1633429282', 1),
(2066, 0, 357, 249, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1633429359', 0),
(2067, 0, 249, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1633429359', 1),
(2068, 0, 357, 249, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1633429445', 0),
(2069, 0, 249, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1633429445', 1),
(2070, 0, 357, 265, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1633693941', 0),
(2071, 0, 265, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1633693941', 1),
(2072, 36, 265, 357, 'Dear Manikanta Reddy your order is 36 is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with sector6.', '1633694402', 1),
(2073, 0, 357, 265, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1633695994', 0),
(2074, 0, 265, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1633695994', 1),
(2075, 0, 357, 248, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1633696601', 0),
(2076, 0, 248, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1633696601', 1),
(2077, 0, 357, 265, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1633697041', 0),
(2078, 0, 265, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1633697041', 1),
(2079, 0, 357, 265, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1633697186', 0),
(2080, 0, 265, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1633697186', 1),
(2081, 0, 357, 265, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1633697403', 0),
(2082, 0, 265, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1633697403', 1),
(2083, 0, 357, 265, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1633697494', 0),
(2084, 0, 265, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1633697494', 1),
(2085, 0, 357, 265, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1633945258', 0),
(2086, 0, 265, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1633945259', 1),
(2087, 0, 357, 265, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1633945325', 0),
(2088, 0, 265, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1633945325', 1),
(2089, 0, 357, 265, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1633945402', 0),
(2090, 0, 265, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1633945402', 1),
(2091, 0, 357, 265, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1633945487', 0),
(2092, 0, 265, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1633945487', 1),
(2093, 0, 357, 241, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1633951573', 0),
(2094, 0, 241, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1633951574', 1),
(2095, 0, 357, 265, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1633954363', 0),
(2096, 0, 265, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1633954363', 1),
(2097, 0, 357, 248, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1633954804', 0),
(2098, 0, 248, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1633954806', 1),
(2099, 0, 357, 265, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1633957505', 0),
(2100, 0, 265, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1633957505', 1),
(2101, 0, 357, 265, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1633957650', 0),
(2102, 0, 265, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1633957651', 1),
(2103, 0, 357, 265, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1633957683', 0),
(2104, 0, 265, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1633957683', 1),
(2105, 0, 357, 265, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1633958379', 0),
(2106, 0, 265, 357, 'Dear Manikanta Reddy your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1633958379', 0),
(2107, 0, 353, 239, 'Dear vendor new order no.0 is in your dashboard. Please accept it for confirmation. Regards Sector 6', '1644992611', 0),
(2108, 0, 239, 353, 'Dear chaitu your order no.0 is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6', '1644992612', 1),
(2109, 63, 352, 249, 'Dear vendor new order no.63 is in your dashboard. Please accept it for confirmation.', '1650456139', 0),
(2110, 63, 249, 352, 'Dear satish a your order no.63 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1650456139', 0),
(2111, 64, 385, 239, 'Dear vendor new order no.64 is in your dashboard. Please accept it for confirmation.', '1651672482', 0),
(2112, 64, 239, 385, 'Dear kumar k your order no.64 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1651672482', 0),
(2113, 65, 384, 239, 'Dear vendor new order no.65 is in your dashboard. Please accept it for confirmation.', '1652179504', 0),
(2114, 65, 239, 384, 'Dear anu devarakonda your order no.65 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1652179504', 0),
(2115, 66, 352, 240, 'Dear vendor new order no.66 is in your dashboard. Please accept it for confirmation.', '1658494547', 0),
(2116, 66, 240, 352, 'Dear satish a your order no.66 is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.', '1658494547', 0);

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
(1, 1, 'Andhra Pradesh', 0, '1650454935', '', 0),
(2, 1, 'Telengana', 0, '1656826385', '', 0),
(3, 1, 'Karnataka', 0, '1656826407', '', 0);

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
(1621, 8, 9, 'Debit', '1', '299', 'New Order', '1624082807'),
(1622, 4, 5, 'Debit', '1', '4', 'New Order', '1624272961'),
(1623, 1, 1, 'Debit', '1', '19', 'New Order', '1624281673'),
(1624, 8, 9, 'Debit', '1', '298', 'New Order', '1624281986'),
(1625, 4, 5, 'Debit', '1', '3', 'New Order', '1624282120'),
(1626, 4, 5, 'Debit', '1', '2', 'New Order', '1624282132'),
(1627, 1, 1, 'Debit', '1', '18', 'New Order', '1624337239'),
(1628, 4, 5, 'Debit', '1', '1', 'New Order', '1624337239'),
(1629, 8, 9, 'Debit', '1', '297', 'New Order', '1624337552'),
(1630, 8, 9, 'Debit', '1', '296', 'New Order', '1624337573'),
(1631, 1, 1, 'Debit', '1', '17', 'New Order', '1624360932'),
(1632, 5, 6, 'Debit', '1', '199', 'New Order', '1624360932'),
(1633, 1, 1, 'Debit', '1', '16', 'New Order', '1624360979'),
(1634, 5, 6, 'Debit', '1', '198', 'New Order', '1624360979'),
(1635, 8, 9, 'Debit', '1', '295', 'New Order', '1624360979'),
(1636, 1, 1, 'Debit', '1', '15', 'New Order', '1624360983'),
(1637, 5, 6, 'Debit', '1', '197', 'New Order', '1624360983'),
(1638, 8, 9, 'Debit', '1', '294', 'New Order', '1624360983'),
(1639, 1, 1, 'Debit', '1', '14', 'New Order', '1624361536'),
(1640, 5, 6, 'Debit', '1', '196', 'New Order', '1624361536'),
(1641, 8, 9, 'Debit', '1', '293', 'New Order', '1624361536'),
(1642, 1, 1, 'Debit', '1', '13', 'New Order', '1624361644'),
(1643, 5, 6, 'Debit', '1', '195', 'New Order', '1624361644'),
(1644, 8, 9, 'Debit', '1', '292', 'New Order', '1624361644'),
(1645, 1, 1, 'Debit', '1', '12', 'New Order', '1624361673'),
(1646, 5, 6, 'Debit', '1', '194', 'New Order', '1624361673'),
(1647, 8, 9, 'Debit', '1', '291', 'New Order', '1624361673'),
(1648, 1, 1, 'Debit', '1', '11', 'New Order', '1624361727'),
(1649, 5, 6, 'Debit', '1', '193', 'New Order', '1624361727'),
(1650, 8, 9, 'Debit', '1', '290', 'New Order', '1624361727'),
(1651, 1, 1, 'Debit', '1', '10', 'New Order', '1624361770'),
(1652, 5, 6, 'Debit', '1', '192', 'New Order', '1624361770'),
(1653, 5, 6, 'Debit', '1', '191', 'New Order', '1624361999'),
(1654, 5, 6, 'Debit', '1', '190', 'New Order', '1624362038'),
(1655, 5, 6, 'Debit', '1', '189', 'New Order', '1624362120'),
(1656, 1, 1, 'Debit', '1', '9', 'New Order', '1624362263'),
(1657, 5, 6, 'Debit', '1', '188', 'New Order', '1624362263'),
(1658, 1, 1, 'Debit', '1', '8', 'New Order', '1624362467'),
(1659, 1, 1, 'Debit', '1', '7', 'New Order', '1624363291'),
(1660, 1, 1, 'Debit', '1', '6', 'New Order', '1624363374'),
(1661, 5, 6, 'Debit', '1', '187', 'New Order', '1624363374'),
(1662, 8, 9, 'Debit', '1', '289', 'New Order', '1624363374'),
(1663, 1, 1, 'Debit', '1', '5', 'New Order', '1624363805'),
(1664, 1, 1, 'Debit', '1', '4', 'New Order', '1624365165'),
(1665, 5, 6, 'Debit', '1', '186', 'New Order', '1624365165'),
(1666, 8, 9, 'Debit', '1', '288', 'New Order', '1624365165'),
(1667, 1, 1, 'Debit', '1', '3', 'New Order', '1624365275'),
(1668, 1, 1, 'Debit', '1', '2', 'New Order', '1624365342'),
(1669, 5, 6, 'Debit', '1', '185', 'New Order', '1624365342'),
(1670, 8, 9, 'Debit', '1', '287', 'New Order', '1624365342'),
(1671, 1, 1, 'Debit', '1', '1', 'New Order', '1624365575'),
(1672, 5, 6, 'Debit', '1', '184', 'New Order', '1624365575'),
(1673, 8, 9, 'Debit', '1', '286', 'New Order', '1624365575'),
(1674, 1, 1, 'Debit', '1', '0', 'New Order', '1624366066'),
(1675, 2, 2, 'Debit', '1', '3', 'New Order', '1624366138'),
(1676, 2, 2, 'Debit', '1', '2', 'New Order', '1624444476'),
(1677, 8, 9, 'Debit', '32', '254', 'New Order', '1624444476'),
(1678, 2, 2, 'Debit', '1', '1', 'New Order', '1624445539'),
(1679, 3, 3, 'Debit', '1', '9', 'New Order', '1624445539'),
(1680, 3, 3, 'Debit', '1', '8', 'New Order', '1624453498'),
(1681, 6, 7, 'Debit', '1', '99', 'New Order', '1624453498'),
(1682, 2, 2, 'Debit', '1', '0', 'New Order', '1624520437'),
(1683, 3, 3, 'Debit', '1', '7', 'New Order', '1624520437'),
(1684, 8, 9, 'Debit', '1', '253', 'New Order', '1624520437'),
(1685, 1, 1, 'Debit', '1', '49', 'New Order', '1624528981'),
(1686, 7, 8, 'Debit', '1', '199', 'New Order', '1624528981'),
(1687, 1, 1, 'Debit', '1', '48', 'New Order', '1624602111'),
(1688, 2, 2, 'Debit', '1', '49', 'New Order', '1630734625'),
(1689, 1, 1, 'Debit', '1', '47', 'New Order', '1630924853'),
(1690, 5, 6, 'Debit', '1', '183', 'New Order', '1632486242'),
(1691, 12, 16, 'Credit', ' 12', ' 12', 'Stock Added', '1632740078'),
(1692, 13, 17, 'Credit', '10', '10', 'Stock Added', '1632740504'),
(1693, 14, 18, 'Credit', '20', '20', 'Stock Added', '1632740834'),
(1694, 15, 19, 'Credit', '25', '25', 'Stock Added', '1632741209'),
(1695, 4, 5, 'Debit', '1', '0', 'New Order', '1632805573'),
(1696, 16, 17, 'Credit', ' 10', ' 10', 'Stock Added', '1632832231'),
(1697, 16, 17, 'Credit', '25', '25', 'Stock Added', '1632833023'),
(1698, 16, 17, 'Credit', '11', '11', 'Stock Added', '1632833069'),
(1699, 16, 17, 'Credit', '10', '10', 'Stock Added', '1632833080'),
(1700, 16, 17, 'Credit', '25', '25', 'Stock Added', '1632833096'),
(1701, 16, 17, 'Credit', '25', '25', 'Stock Added', '1632833815'),
(1702, 19, 20, 'Credit', '25', '25', 'Stock Added', '1632834602'),
(1703, 14, 18, 'Debit', '1', '19', 'New Order', '1632890998'),
(1704, 12, 16, 'Debit', '1', '11', 'New Order', '1632891036'),
(1705, 12, 16, 'Debit', '1', '10', 'New Order', '1632893719'),
(1706, 20, 21, 'Credit', '15', '15', 'Stock Added', '1632899197'),
(1707, 22, 22, 'Credit', '20', '20', 'Stock Added', '1632899484'),
(1708, 23, 23, 'Credit', '20', '20', 'Stock Added', '1632905004'),
(1709, 17, 19, 'Credit', '20', '20', 'Stock Added', '1632905415'),
(1710, 23, 23, 'Credit', '20', '20', 'Stock Added', '1632908323'),
(1711, 12, 16, 'Credit', '20', '20', 'Stock Added', '1632908396'),
(1712, 19, 20, 'Credit', '', '', 'Stock Added', '1632914898'),
(1713, 19, 20, 'Credit', '25', '25', 'Stock Added', '1632914912'),
(1714, 24, 24, 'Credit', '25', '25', 'Stock Added', '1632915469'),
(1715, 25, 25, 'Credit', '100', '100', 'Stock Added', '1632915581'),
(1716, 26, 26, 'Credit', '500', '500', 'Stock Added', '1632918206'),
(1717, 27, 27, 'Credit', '50', '50', 'Stock Added', '1632918502'),
(1718, 28, 28, 'Credit', '100', '100', 'Stock Added', '1632918845'),
(1719, 12, 16, 'Debit', '3', '17', 'New Order', '1632986604'),
(1720, 30, 30, 'Credit', ' 10', ' 10', 'Stock Added', '1632995415'),
(1721, 31, 33, 'Credit', '10', '10', 'Stock Added', '1633006781'),
(1722, 33, 33, 'Credit', ' 10', ' 10', 'Stock Added', '1633006830'),
(1723, 32, 31, 'Credit', '15', '15', 'Stock Added', '1633006885'),
(1724, 35, 34, 'Credit', '500', '500', 'Stock Added', '1633007412'),
(1725, 36, 35, 'Credit', '500', '500', 'Stock Added', '1633007694'),
(1726, 34, 28, 'Credit', '500', '500', 'Stock Added', '1633008214'),
(1727, 38, 17, 'Credit', ' 10', ' 10', 'Stock Added', '1633425311'),
(1728, 13292, 24, 'Credit', '10', '10', 'Stock Added', '1633428571'),
(1729, 13288, 24, 'Credit', '25', '25', 'Stock Added', '1633428600'),
(1730, 13294, 38, 'Credit', '10', '10', 'Stock Added', '1633433932'),
(1731, 13299, 38, 'Credit', '10', '10', 'Stock Added', '1633434094'),
(1732, 13300, 38, 'Credit', '10', '10', 'Stock Added', '1633434113'),
(1733, 13301, 39, 'Credit', '10', '10', 'Stock Added', '1633670685'),
(1734, 13302, 39, 'Credit', '10', '10', 'Stock Added', '1633670694'),
(1735, 13303, 39, 'Credit', '10', '10', 'Stock Added', '1633670712'),
(1736, 13306, 40, 'Credit', '10', '10', 'Stock Added', '1633671004'),
(1737, 13307, 40, 'Credit', '10', '10', 'Stock Added', '1633671016'),
(1738, 13308, 41, 'Credit', '10', '10', 'Stock Added', '1633672787'),
(1739, 13309, 42, 'Credit', '10', '10', 'Stock Added', '1633672832'),
(1740, 13310, 43, 'Credit', '10', '10', 'Stock Added', '1633673093'),
(1741, 13311, 44, 'Credit', '10', '10', 'Stock Added', '1633673136'),
(1742, 13312, 45, 'Credit', '10', '10', 'Stock Added', '1633673172'),
(1743, 13313, 46, 'Credit', '10', '10', 'Stock Added', '1633673597'),
(1744, 13314, 47, 'Credit', '25', '25', 'Stock Added', '1633673658'),
(1745, 13314, 47, 'Credit', '250', '250', 'Stock Added', '1633673679'),
(1746, 13315, 48, 'Credit', '10', '10', 'Stock Added', '1633674087'),
(1747, 13316, 49, 'Credit', '10', '10', 'Stock Added', '1633674126'),
(1748, 13317, 50, 'Credit', '10', '10', 'Stock Added', '1633674152'),
(1749, 13318, 52, 'Credit', '10', '10', 'Stock Added', '1633677440'),
(1750, 13312, 45, 'Debit', '1', '9', 'New Order', '1633693075'),
(1751, 13301, 39, 'Debit', '1', '9', 'New Order', '1633693075'),
(1752, 13317, 50, 'Debit', '1', '9', 'New Order', '1633693075'),
(1753, 13310, 43, 'Debit', '1', '9', 'New Order', '1633693075'),
(1754, 13309, 42, 'Debit', '1', '9', 'New Order', '1633693075'),
(1755, 13315, 48, 'Debit', '1', '9', 'New Order', '1633693075'),
(1756, 13306, 40, 'Debit', '1', '9', 'New Order', '1633693075'),
(1757, 13312, 45, 'Credit', '1', '1', 'Stock Added', '1633957465'),
(1758, 13323, 24, 'Credit', '10', '10', 'Stock Added', '1634021785'),
(1759, 13328, 53, 'Credit', '10', '10', 'Stock Added', '1634022031'),
(1760, 13333, 54, 'Credit', '10', '10', 'Stock Added', '1634022165'),
(1761, 13312, 45, 'Credit', '10', '10', 'Stock Added', '1634023548'),
(1762, 13306, 40, 'Credit', '20', '9', 'Stock Added', '1634043375'),
(1763, 8, 9, 'Debit', '1', '252', 'New Order', '1637745539'),
(1764, 13314, 47, 'Debit', '1', '249', 'New Order', '1639977209'),
(1765, 8, 9, 'Debit', '1', '251', 'New Order', '1641280756'),
(1766, 8, 9, 'Debit', '1', '250', 'New Order', '1641302250'),
(1767, 13317, 50, 'Debit', '1', '8', 'New Order', '1644325985'),
(1768, 13333, 54, 'Debit', '1', '9', 'New Order', '1644499194'),
(1769, 13309, 42, 'Debit', '1', '8', 'New Order', '1644992671'),
(1770, 13333, 54, 'Debit', '1', '8', 'New Order', '1650456136'),
(1771, 13328, 53, 'Debit', '1', '9', 'New Order', '1650456136'),
(1772, 13315, 48, 'Debit', '2', '7', 'New Order', '1650456136'),
(1773, 13339, 55, 'Credit', '100', '100', 'Stock Added', '1650628336'),
(1774, 13339, 55, 'Credit', '100', '100', 'Stock Added', '1650631587'),
(1775, 13343, 57, 'Credit', '10', '10', 'Stock Added', '1650634339'),
(1776, 13344, 58, 'Credit', '20', '20', 'Stock Added', '1650635813'),
(1777, 13345, 59, 'Credit', '10', '10', 'Stock Added', '1650636846'),
(1778, 13344, 58, 'Debit', '1', '19', 'New Order', '1651672481'),
(1779, 13343, 57, 'Debit', '2', '8', 'New Order', '1651672481'),
(1780, 13343, 57, 'Debit', '2', '6', 'New Order', '1652179504'),
(1781, 13346, 60, 'Credit', '100', '100', 'Stock Added', '1656753979'),
(1782, 13346, 60, 'Debit', '2', '98', 'Stock Removed', '1656753994'),
(1783, 13346, 60, 'Credit', '10', '108', 'Stock Added', '1656754003'),
(1784, 13349, 61, 'Credit', '30', '30', 'Stock Added', '1658490307'),
(1785, 13350, 62, 'Credit', '23', '23', 'Stock Added', '1658494386'),
(1786, 13351, 62, 'Credit', '123', '123', 'Stock Added', '1658494395'),
(1787, 13350, 62, 'Debit', '1', '22', 'New Order', '1658494547');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `seo_url` text NOT NULL,
  `sub_category_name` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `image` varchar(255) NOT NULL,
  `app_image` varchar(255) NOT NULL,
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
(121, '121_food', 'food', 'test food', '', 'cat-2.jpg', 1, 'type', 1, '1623743432', '1623743441'),
(123, '123_meals', 'Meals', 'Rice, Biriyani\'s, Fried Rice', '', 'Idli.jpg', 3, 'Food Items', 1, '1632736009', '1633669760'),
(124, '124_food', 'Food', 'Available', '', 'Paradise_hotel.jpg', 1, 'Food Items', 1, '1632738614', '1632738623'),
(125, '125_cool-drinks', 'COOL DRINKS', 'Cool drinks like thumps up, Fanta, Maja etc...', '', 'SD1.jpg', 4, 'THUMPS UP', 1, '1632918419', '1632918695'),
(126, '126_diet-soup', 'DIET SOUP', 'DIET SOUP', '', '', 5, 'MASALA SOUP', 1, '1632918559', '1633674707'),
(127, '127_cones', 'CONES', 'VANILLA, CHOCOLATE, BUTTER SCTOCH, FRUIT OVERLOADED ', '', 'no', 6, 'VANILLA', 1, '1632918670', '1632918683'),
(129, '129_paneer-masala', 'PANEER MASALA', 'PANEER MASALA', '', 'no', 7, 'PANEER', 1, '1633344107', '1633344114'),
(130, '130_paneer-masala2', 'PANEER MASALA2', 'PANEER MASALA2', '', 'no', 7, 'PANEER', 1, '1633344186', '1633344196'),
(131, '131_mutton-haleem', 'MUTTON HALEEM', 'MUTTON HALEEM', '', 'no', 8, 'HALEEM', 1, '1633344485', '1633344494'),
(132, '132_chicken-haleem', 'CHICKEN HALEEM', 'CHICKEN HALEEM', '', 'no', 8, 'HALEEM', 1, '1633344581', '1633344587'),
(133, '133_tikka-haleem', 'TIKKA HALEEM', 'TIKKA HALEEM', '', 'no', 8, 'HALEEM', 1, '1633344612', '1633344617'),
(134, '134_laddu', 'LADDU', 'LADDU, BONDI LADDU', '', 'no', 9, 'SWEETS', 1, '1633344774', '1633344786'),
(135, '135_dosa', 'DOSA', 'DOSA, MASALA DOSA, RAVA DOSA, UPMA DOSA', '', 'no', 10, 'TIFFINS', 1, '1633347890', '1633347897'),
(136, '136_puri', 'PURI', 'TIFFINS', '', 'no', 10, 'TIFFINS', 1, '1633347951', '1633347956'),
(137, '137_chicken-stater', 'CHICKEN STATER', 'CHICKEN STATERS', '', 'no', 11, 'STATERS', 1, '1633348401', '1633348412'),
(138, '138_mutton-stater', 'MUTTON STATER', 'MUTTON STATERS', '', 'no', 11, 'STATERS', 1, '1633348475', '1633348488'),
(139, '139_prwans-stater', 'PRWANS STATER', 'PRAWNS STATERS', '', '', 11, 'STATERS', 1, '1633348531', '1633433543'),
(142, '142_salads', 'SALADS', 'EFWEF', '', 'no', 3, 'SALADS', 0, '1634019820', ''),
(143, '', 'Shaving Appliances', 'Shaving Appliances', '', '003-shaving.png', 12, 'Shaving Appliances', 1, '1650618276', '1650618805'),
(144, '', 'Beard Care', 'Beard Care', '', '004-man.png', 13, 'Beard Care', 0, '1650619036', ''),
(145, '', 'Hair Care', 'Hair Care', '', '005-hair-comb.png', 14, 'Hair Care', 1, '1650619161', '1650633949'),
(146, '', 'Face', 'Skin Care', '', '002-moisturizer.png', 15, 'Skin Care', 0, '1650619232', ''),
(147, '', 'Perfumes', 'Perfumes', '', '006-perfume.png', 16, 'Perfumes', 0, '1650619476', ''),
(148, '', 'Health Supplements', 'Health Supplements', '', '001-health1.png', 17, 'Health Supplements', 0, '1650619545', ''),
(149, '', 'Bath & Body', 'Luxe', '', '007-perfume-1.png', 18, 'Bath body', 0, '1650619608', ''),
(150, '', 'Medicine', 'Health care', '', 'I2C_Pin_Connections.png', 19, 'Himalaya', 0, '1656826891', '');

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
(35, '10'),
(36, '15'),
(39, '            ');

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
(350, 'raja', 'k', 'raja@gmail.com', '', '9898989898', 'e10adc3949ba59abbe56e057f20f883e', '9993', 0, 'normal', '', '2021-06-24 08:22:33', 0, '20', 'PVTQNSZ2', '', '', '', 0, 0, 0, '', 'undefined', ''),
(351, 'sai', 'l', 'sai@gmail.com', '', '9098909890', 'cccec1f285c4c6587fcf86f7b8d7483d', '4941', 0, 'normal', '', '2021-06-24 08:22:52', 0, '20', 'CZHYM63A', '', '', '', 0, 0, 0, '', 'undefined', ''),
(352, 'satish', 'a', 'ankadisatish1919@gmail.com', '', '9542921119', 'e10adc3949ba59abbe56e057f20f883e', '3278', 1, 'facebook', '1658485933', '2022-07-22 10:32:13', 0, '20', 'LX1CMJPT', '', '17.7365865', '83.2902324', 0, 0, 0, '', 'c1d074a9-6bd5-4d18-8c9e-b4aa7aad968c', 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India'),
(383, 'Annapurna', 'Devarakonda', 'dsavitha20@gmail.com', '', '7989902424', '8a2cda0d7df6915a05ad283a8b2f3e78', '1234', 1, '', '', '2022-04-21 09:02:24', 0, '', '', '', '', '', 0, 0, 0, '', '', 'Shop # 8, Bharath Towers, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India'),
(353, 'chaitu', 's', 'team9@thecolourmoon.com', '', '9966002347', '63c4fd91cf4121bc58456784e41de4d1', '9042', 1, 'normal', '', '2022-04-14 10:33:34', 0, '20', '4ZECO3X6', '', '29.352027933640155', '47.978298', 0, 0, 0, '', 'f1b09fcf-0562-4c01-92d8-a8bc5093895a', '[object Object]'),
(375, '  ', '  ', 'gdf@gmail.com', '', '5465', '202cb962ac59075b964b07152d234b70', '1426', 0, 'normal', '', '2021-10-22 09:31:28', 0, '20', 'HZIM3A2Q', '', '', '', 0, 0, 0, '', 'null', ''),
(362, 'rubi', 'd', 'rubi@gmail.com', '', '9632580147', 'e10adc3949ba59abbe56e057f20f883e', '6193', 0, 'normal', '', '2021-09-30 05:26:15', 0, '20', '5R9FGQCN', '', '', '', 0, 0, 0, '', '328816e9-f4c1-489b-9eac-9a9319b3c58d', ''),
(356, 'Mahi', 'Dhoni', 'd@gmail.com', '', '8790361953', '31c9a1246379f62d89e59df40cbb8594', '5700', 1, 'normal', '', '2021-10-06 08:44:15', 0, '20', '468IXMEP', '', 'undefined', 'undefined', 0, 0, 0, '', '90b4f6c8-eb7e-48a9-8a9b-306984b896bb', 'undefined'),
(357, 'Manikanta Reddy', 'N', 'manikantareddy166328@gmail.com', '', '8639480661', '40b1a050e610d342c8fa8ee4325dbbf7', '8958', 1, 'normal', '', '2021-10-08 11:35:50', 0, '20', '6M1VQI8F', '', 'undefined', 'undefined', 0, 0, 0, '', '9edfc8b4-9ccb-46f1-ba2f-352845dc3d4f', 'undefined'),
(358, '8281919', '8291992829', 't@gail.com', '', '1234567891', 'c131f7478886b9763fa8c16745619453', '3011', 0, 'normal', '', '2021-09-27 12:03:29', 0, '20', 'TGPIKMF4', '', '', '', 0, 0, 0, '', '9edfc8b4-9ccb-46f1-ba2f-352845dc3d4f', ''),
(359, 'j', 'b', 'nanamma@gmail.com', '', '1326494619', '32077e33a08c1e9ba02bbdabfe645c24', '9022', 0, 'normal', '', '2021-09-27 12:29:13', 0, '20', 'DX79RI63', '', '', '', 0, 0, 0, '', '9edfc8b4-9ccb-46f1-ba2f-352845dc3d4f', ''),
(360, 'Prashanth', 'Bandi', 'prashanthbandi42@gmail.com', '', '6303569071', 'a50a570188087be5663b1a0b04803573', '4108', 1, 'normal', '', '2021-09-30 12:06:17', 0, '20', '9NUXF1P5', '', '17.7285345', '83.305494', 0, 0, 0, '', 'd07054cc-4b10-4784-a9d8-8aec98ba3001', '106, 106, 5th Lane, Dwaraka Nagar, Visakhapatnam, Vishakhapatnam, Andhra Pradesh, 530016, India, IN'),
(361, 'm', 'mki', 'mahi@gmail.com', '', '1234567890', '6e7cf3963b0f32776b32b3c177c125ce', '4866', 0, 'normal', '', '2021-10-06 09:25:16', 0, '20', 'GCKT2FVH', '', '', '', 0, 0, 0, '', '9edfc8b4-9ccb-46f1-ba2f-352845dc3d4f', ''),
(363, 'rubi', 's', 'rubi@colourmoon.com', '', '2580147396', 'e10adc3949ba59abbe56e057f20f883e', '6505', 0, 'normal', '', '2021-09-30 05:28:51', 0, '20', '49MPTH3F', '', '', '', 0, 0, 0, '', '328816e9-f4c1-489b-9eac-9a9319b3c58d', ''),
(364, 'mani', 'mani', 'bahsjsnwjsjs@gmail.jwjsis.combwja.comwbsj.com', '', '9764612858', '055203cb4c4a8fe5549d751811e1971e', '8806', 0, 'normal', '', '2021-10-01 08:38:59', 0, '20', 'EQ7VS495', '', '', '', 0, 0, 0, '', '9edfc8b4-9ccb-46f1-ba2f-352845dc3d4f', ''),
(365, 'sai kiran', 'venkata', 'kiransai@colourmoon.com', '', '9966264359', 'e10adc3949ba59abbe56e057f20f883e', '2819', 1, 'normal', '', '2021-10-04 06:29:09', 0, '20', '4HDI21XA', '', '17.696885339794765', '83.29659809102023', 0, 0, 0, '', '38c04943-755b-4d5a-bc48-afbba8ae7ded', '106, 106, 5th Lane, Dwaraka Nagar, Visakhapatnam, Vishakhapatnam, Andhra Pradesh, 530016, India, IN'),
(366, 'mani.reddy', 'redddy', 'manisd@gmail.com', '', '1234659768', 'c36ccdd9eaad336e90d0e36a0870b8ba', '1388', 0, 'normal', '', '2021-10-02 07:20:45', 0, '20', 'Y4E6QPD8', '', '', '', 0, 0, 0, '', '9edfc8b4-9ccb-46f1-ba2f-352845dc3d4f', ''),
(367, 'satish', 'A', 'satishprasanna1916@gmail.com', '', '9347315511', 'e10adc3949ba59abbe56e057f20f883e', '9379', 0, 'normal', '', '2021-10-04 08:52:03', 0, '20', '64PGBVJY', '', '', '', 0, 0, 0, '', 'dsdfsdfsd', ''),
(368, 'Mahi', 'Dhoni Reddy', 'mahi@gmail.com', '', '8132649780', '4635c4ddd8b3d8c59d8f813e4a8273e5', '7923', 0, 'normal', '', '2021-10-05 05:29:16', 0, '20', '5WBGPUH6', '', '', '', 0, 0, 0, '', '9edfc8b4-9ccb-46f1-ba2f-352845dc3d4f', ''),
(369, 'Narendra', 'Modi', 'modipm@gmail.com', '', '4563127689', '8182730e9de710b969b0d95d1b8afe65', '6322', 0, 'normal', '', '2021-10-05 08:51:26', 0, '20', 'T46MYF0U', '', '', '', 0, 0, 0, '', '9edfc8b4-9ccb-46f1-ba2f-352845dc3d4f', ''),
(370, 'mahi', 'dhoni', 'mahi.dhoni@gmail.indiancaptian.cricket.india.com', '', '1364978523', '4635c4ddd8b3d8c59d8f813e4a8273e5', '7492', 0, 'normal', '', '2021-10-06 06:26:47', 0, '20', '9QJY0RUW', '', '', '', 0, 0, 0, '', '9edfc8b4-9ccb-46f1-ba2f-352845dc3d4f', ''),
(371, ' ', ' ', 'a@gmail.com', '', '1623459786', 'ab334feeb31c05124cb73fa12571c2f6', '1004', 0, 'normal', '', '2021-10-06 06:32:28', 0, '20', 'NTEKI5FD', '', '', '', 0, 0, 0, '', '9edfc8b4-9ccb-46f1-ba2f-352845dc3d4f', ''),
(372, 'Uf', 'H', 'g@gmail.com', '', '8639480661', '40b1a050e610d342c8fa8ee4325dbbf7', '8958', 0, 'normal', '', '2021-10-06 09:52:36', 0, '20', 'U5CYOG19', '', '', '', 0, 0, 0, '', '90b4f6c8-eb7e-48a9-8a9b-306984b896bb', ''),
(373, 'm', 'mnk', 'm@gmail.com', '', '8790361953', '90cfc65dd6d1f259dd7cdf993b2aeee0', '7944', 0, 'normal', '', '2021-10-06 09:03:01', 0, '20', '4SBIXK0R', '', '', '', 0, 0, 0, '', '9edfc8b4-9ccb-46f1-ba2f-352845dc3d4f', ''),
(374, 'mani', 'reddy', 'mahi@gmail.indian.captain.india.com', '', '8796431258', 'e2f1a8f5a092e7576ee8c7a37815f218', '3692', 0, 'normal', '', '2021-10-06 09:28:52', 0, '20', 'DO526H70', '', '', '', 0, 0, 0, '', '9edfc8b4-9ccb-46f1-ba2f-352845dc3d4f', ''),
(376, 'fgdf', 'sdfd', 'gf@gmail.com', '', '4342321233', '4297f44b13955235245b2497399d7a93', '8669', 0, 'normal', '', '2021-10-22 09:37:36', 0, '20', 'HPVRILZS', '', '', '', 0, 0, 0, '', 'null', ''),
(377, 'bhanu', 'prakash', 'bhanuprakashbunny97@gmail.com', '', '9493531506', '25d55ad283aa400af464c76d713c07ad', '1312', 1, 'normal', '', '2021-11-24 13:00:21', 0, '20', 'NMB34U9J', '', '', '', 0, 0, 0, '', 'd585a12f-e203-428c-b471-b72b8bb3f92d', ''),
(378, 'megha', 'shyam', 'meghashyamsingara97@gmail.com', '', '8008015091', '919f16a410ae8b466c464b3e30b93d0e', '9383', 1, 'normal', '', '2022-01-05 12:13:19', 0, '20', '3LU9GV0I', '', 'undefined', 'undefined', 0, 0, 0, '', 'e12f1044-4dfc-42c6-9f10-6fe8ce2593f3', '8-3-678/42/5, 8-3-678/42/5, Navodaya Colony Road, Yousufguda, Hyderabad, Hyderabad, Telangana, 500045, India, IN'),
(379, 'Bhanu', 'prakash', 'ilovebhanuprakash@gmail.com', '', '7732068611', '886501a505a7ae71684e80413f7715aa', '8432', 1, 'normal', '', '2022-02-25 04:59:46', 0, '20', '0OFDNQZU', '', '17.4336944', '78.4333433', 0, 0, 0, '', '7e5f01e5-1c20-43bf-9862-06e4240f9572', 'Ganapathi Complex, Navodaya Colony Road, Yousufguda, Hyderabad, Hyderabad, Telangana, 500045, India, IN'),
(381, 'gdfg', 'fdg', 'fg@gmail.com', '', '9966002347', '63c4fd91cf4121bc58456784e41de4d1', '2569', 0, 'normal', '', '2022-02-12 07:41:32', 0, '20', '2RAQISOK', '', 'undefined', 'undefined', 0, 0, 0, '', '328816e9-f4c1-489b-9eac-9a9319b3c58d', '[object Object]'),
(380, 'sankar', 'rao', 'manager@thecolourmoon.com', '', '8125505055', '25a41cec631264f04815eda23dc6edd9', '8929', 1, 'normal', '', '2022-01-22 07:39:18', 0, '20', '81LNR3Q2', '', '17.7284505', '83.3056504', 0, 0, 0, '', 'f6942654-6eb1-11ec-8718-1a8e11157d72', '106, 106, 5th Lane, Dwaraka Nagar, Visakhapatnam, Vishakhapatnam, Andhra Pradesh, 530016, India, IN'),
(382, 'fdff', 'ddfds', 'fgf@gmail.com', '', '9876598765', 'e10adc3949ba59abbe56e057f20f883e', '2551', 0, 'normal', '', '2022-02-12 06:26:06', 0, '20', '3OIADNYF', '', '', '', 0, 0, 0, '', 'null', ''),
(384, 'anu', 'devarakonda', 'annapurnavdevaarakonda@gmail.com', '', '7995785836', 'e10adc3949ba59abbe56e057f20f883e', '1234', 1, '', '', '2022-04-21 09:17:13', 0, '', '', '', '', '', 0, 0, 0, '', '', '106, 5th Ln, Dwaraka Nagar, Visakhapatnam, Andhra Pradesh 530016, India'),
(385, 'kumar', 'k', 'webteam2@colourmoon.com', '', '9848820041', 'e10adc3949ba59abbe56e057f20f883e', '1234', 1, '', '', '2022-05-04 13:53:34', 0, '', '', '', '', '', 0, 0, 0, '', '', ''),
(386, 'revati', 'maheswar', 'webteam4@colourmoon.com', '', '9398780995', 'e10adc3949ba59abbe56e057f20f883e', '1234', 1, '', '', '2022-05-04 09:10:10', 0, '', '', '', '', '', 0, 0, 0, '', '', ''),
(387, 'sreetam', 'a', 'sreetam@gmail.com', '', '9876543210', 'e10adc3949ba59abbe56e057f20f883e', '1234', 1, '', '', '2022-05-04 09:11:06', 0, '', '', '', '', '', 0, 0, 0, '', '', ''),
(388, 'ShivaTeja', 'Siripuram', 'shivateja2207@gmail.com', '', '9390791945', '0fef8b9efaccf71f399f00260a5e269e', '1234', 1, '', '', '2022-05-08 06:07:37', 0, '', '', '', '', '', 0, 0, 0, '', '', ''),
(389, 'Arks', 'Prasanth', 'arksprasanth96@gmail.com', '', '7207679363', 'ea5d6876fa74634ba727769be1143ade', '1234', 1, '', '', '2022-05-08 06:07:48', 0, '', '', '', '', '', 0, 0, 0, '', '', ''),
(390, 'savitha', 'devarakonda', 'annapurnavdevarakonda@gmail.com', '', '9441247588', '25d55ad283aa400af464c76d713c07ad', '1234', 1, '', '', '2022-06-06 10:58:37', 0, '', '', '', '', '', 0, 0, 0, '', '', '');

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
(11, 353, 'chaitu', '1231231231', 'fdg', '', 'fdg', 'dg', 'e324', 'fgfd', 0, 1, '2022-01-25 12:07:40', 'no'),
(5, 379, 'bhanu prakash', '7732068611', '11-210', '', 'visakhapatnam', 'Andhra Pradesh', '5200046', '7 temples', 0, 1, '2022-01-05 04:27:46', 'no'),
(6, 378, 'MEGHA SHYAM SINGARA', '7732060611', 'seven temples', '', 'visakhapatnam', 'andhra pradesh', '530046', '7 temples', 0, 1, '2022-01-05 12:21:45', 'no'),
(12, 352, 'satish', '9542921119', '44-1-19/a,jocheph church', '', '1', '1', '1', 'jocheph church', 0, 1, '2022-04-20 11:53:38', 'no'),
(13, 385, 'test', '9876543210', 'test', '', '1', '1', '2', 'test', 0, 1, '2022-05-04 13:54:24', 'no'),
(15, 388, 'ShivaTeja Siripuram', '9390791945', 'H.no 8-2-289/A/1,Old Venkateswara Nagar', '', '1', '1', '2', 'Hdidj', 0, 1, '2022-05-08 06:55:44', 'no'),
(16, 384, 'annapurna', '7995785836', 'bharat towers', '', '1', '1', '2', 'visakhapatnam', 0, 1, '2022-05-10 10:44:39', 'no'),
(17, 389, 'Arks Prasanth', '7207679363', 'G2, Viveck Paradise', '', '1', '1', '2', 'near ', 0, 1, '2022-05-18 06:52:57', 'no'),
(18, 390, 'annapurna', '9441247588', 'bharat towers', '', '1', '1', '2', 'visakhapatnam', 0, 1, '2022-06-06 10:59:33', 'no'),
(19, 389, 'Arks', '5635024782', 'htsroshjos', '', '1', '1', '2', 'erieg', 0, 1, '2022-06-22 15:10:23', 'no');

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
  `user_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `review` text NOT NULL,
  `rating` int(11) NOT NULL,
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

--
-- Dumping data for table `vendor_orders_values`
--

INSERT INTO `vendor_orders_values` (`id`, `session_id`, `gst`, `sub_total`, `coupon_id`, `coupon_code`, `coupon_disount`, `vendor_id`, `status`) VALUES
(1, 'jrxbtzqql7kt1rjvt4k1', 0, 273, 0, 'undefined', 0, 239, 1),
(2, 'jrxbtzqql7kt1rjvt4k1', 0, 59, 0, 'undefined', 0, 241, 1),
(3, 't5t3msmbg7p47d2laj5q', 0, 200, 0, 'undefined', 0, 239, 1),
(4, 't5t3msmbg7p47d2laj5q', 0, 150, 0, 'undefined', 0, 241, 1),
(5, 'musqd2lkp9983hp96ney', 0, 200, 0, 'undefined', 0, 239, 1),
(6, '4aeomxtac7m6o947dcpq', 0, 150, 0, 'undefined', 0, 239, 0),
(7, 'oymg4ahp8lattwp4ihto', 0, 200, 0, 'undefined', 0, 239, 1),
(8, 'mb1ekr2aq6ucp3w8m9xx', 0, 59, 0, 'undefined', 0, 241, 0),
(9, '3nogui3ogmipp5oayq5p', 0, 200, 0, 'undefined', 0, 241, 0),
(10, '89lyf1g76eawdsphskn5', 0.45, 45, 0, 'undefined', 0, 248, 0),
(11, 'hfg7s4ysph7pyl0hjpcy', 0.15, 15, 0, 'undefined', 0, 248, 0),
(12, 'gdja8deiaqm0by7yjkdd', 0.15, 15, 0, 'undefined', 0, 248, 0),
(13, 'aqtqgz3cg231j3sj4ip9', 0.75, 75, 1, '16AGCD', 17.58, 248, 0),
(14, 'ideq2qsnu7m9ut86dd2b', 24.8, 1460, 3, 'firstbiriyani', 150, 265, 1),
(15, '69pqdfjbho411ihfb7lh', 0, 59, 0, 'undefined', 0, 241, 0),
(16, 'w7gpyln6mvgsa472m22m', 75, 2500, 0, 'undefined', 0, 265, 0),
(17, 'j2cea4u5pqij1sjse70x', 0, 59, 0, 'undefined', 0, 241, 0),
(18, 'uctqwdp03deeq1yup6vt', 0, 59, 0, 'undefined', 0, 241, 0),
(19, 'xcc4oxdcm8hsjtkob25x', 0, 200, 0, 'undefined', 0, 0, 0),
(20, 'l6erz7hmmxu9awrhy2uj', 36, 200, 0, 'undefined', 0, 249, 0),
(21, 'fbg7di16ht7e7pc4tkfm', 0, 150, 0, 'undefined', 0, 0, 0);

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

--
-- Dumping data for table `vendor_payements`
--

INSERT INTO `vendor_payements` (`id`, `vendor_id`, `total_payment`, `requested_amount`, `status`) VALUES
(97, 240, '0', '', 0),
(98, 239, '0', '', 0),
(99, 249, '0', '', 0),
(100, 248, '0', '', 0),
(101, 265, '0', '', 0),
(102, 0, '0', '', 0);

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
(239, '239_chaitu-stores', 'Absolute', '202204221441537249370_banner_1.jpg', '202204221441539164391_banner_1.jpg', 'Kumar', 'No', 'e10adc3949ba59abbe56e057f20f883e', '', 'webteam2@colourmoon.com', 'tes', '9848820041', '9988776655', NULL, NULL, 'No', 'dwarakanagar,visakapatnam', 1, 0, 'Visakhapatnam', NULL, '530016', '17.7294', '83.3093', NULL, 1, '', NULL, 1, 'null', 'null', 'null', 'null', 'null', 'null', '922bdb2a-8efb-11ec-8072-a65a21b5e4ef', 'null', '2021-06-15 05:18:38', '', 0, NULL, ''),
(240, '240_sai-kiran-stores', 'sai kiran stores', '202106161214359265939_food2.jpg', '202106161214355063598_logo4.jpg', 'kiran kumar', 'No', 'b1a5b64256e27fa5ae76d62b95209ab3', '', 'kiran@gmail.com', 'kiran stores all groceries available', '9090909090', NULL, NULL, NULL, 'No', 'mvp ,visakapatnam', 1, 15, 'Visakhapatnam', NULL, '530016', '17.723290', '83.307610', NULL, 300, '15', NULL, 1, '', '', '', '', '', '', NULL, '', '2021-06-16 04:14:35', '', 0, NULL, ''),
(241, '241_eswar-shopping-store', 'Panorama - Ambica Sea Green', '2021121812142835967_img1.jpg', '202112181214282800310_img1.jpg', 'Lavanya', 'No', 'e10adc3949ba59abbe56e057f20f883e', '', 'lavanya123@gmail.com', 'Test', '1234567890', NULL, NULL, NULL, 'No', 'dwaraka nagar', 1, 15, 'Visakhapatnam', NULL, '530016', '17.7294', '83.3093', NULL, 100, NULL, NULL, 0, '', '', '', '', '', '', NULL, '', '2021-06-17 02:22:36', '', 0, NULL, ''),
(242, '242_', ' ', '', '', 'teja s', 'No', 'dbafeb68736c030957a40b61d27fc420', '', 'teja@gmail.com', ' ', '9898989898', NULL, '9584', NULL, 'No', ' ', 1, 15, 'Visakhapatnam', NULL, ' ', '17.7413', '83.3345', NULL, 0, NULL, NULL, 0, '', '', '', '', '', '', 'undefined', '', '2021-06-17 11:05:42', ' ', 0, NULL, ''),
(243, '243_', '', '', '', 'visi k', 'No', '63c4fd91cf4121bc58456784e41de4d1', '', 'chaituvishi@gmail.com', '', '9666697790', NULL, '5335', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '4cf7f470-1e65-4965-96aa-4f641682eafa', NULL, '2021-06-22 09:31:16', '', NULL, NULL, ''),
(244, '244_', '', '', '', 'vishi k', 'No', '63c4fd91cf4121bc58456784e41de4d1', '', 'chaituvishi@gmail.com', '', '9666697790', NULL, '5335', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '4cf7f470-1e65-4965-96aa-4f641682eafa', NULL, '2021-06-22 09:37:48', '', NULL, NULL, ''),
(245, '245_', ' ', '', '', 'vishi k', 'No', '1c40a3834865a9f609686a62ed51e518', '', 'chaituvishi@gmail.com', ' ', '9666697790', NULL, '5335', 1, 'No', 'allipuram', 2, 15, 'Visakhapatnam', NULL, ' ', '17.7294', '78.546341', NULL, 0, NULL, NULL, 0, ' ', ' ', ' ', ' ', ' ', ' ', 'undefined', ' ', '2021-06-22 09:43:36', ' ', 0, NULL, ''),
(246, '246_', ' ', '', '', 'teja s', 'No', 'dbafeb68736c030957a40b61d27fc420', '', 'mani@gmail.com', ' ', '8774554545', NULL, '5335', NULL, 'No', 'allipuram', 3, 15, 'Visakhapatnam', NULL, '123456', '17.7294', '83.3345', NULL, 0, NULL, NULL, 0, ' ', ' ', ' ', ' ', ' ', ' ', '4cf7f470-1e65-4965-96aa-4f641682eafa', ' ', '2021-06-25 10:46:36', ' ', 0, NULL, ''),
(247, '247_', '', '', '', 'rubi h', 'No', '598eb312852d5b10f34eb96984c0c6ca', '', 'rubi@gmai.com', '', '9306880945', NULL, '4155', 1, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'null', NULL, '2021-09-04 07:48:08', NULL, NULL, NULL, ''),
(248, '248_paradise-hotel', 'Paradise hotel', '202109271531271689684_paradise_hotel.jpg', '202109271531288257558_paradise2.png', 'Prashanth', 'No', 'e9da2c1d00769995e5ff4bfcb2826754', '', 'prashanth@gmail.com', 'Food ', '6303569071', NULL, NULL, NULL, 'No', 'Dwaraka Nagar', 1, 15, 'Visakhapatnam', NULL, '506244', '17.7294', '83.3093', NULL, 50, '1hr', NULL, 0, 'GH1235V5', '123456788900', '10%', 'SBI', '123456789212', 'Prashanth', NULL, '1234', '2021-09-27 10:01:28', '', 0, NULL, ''),
(249, '249_manikanta-reddy-restuarants', 'Manikanta Reddy Restuarant\'s', '20210927155505232224_rp1.jfif', '202109271551248522185_mrlogo.jpg', 'Reddy', 'No', '2e236eaf2a91fe239ea9c87862a337d6', '', 'manikantahotels@gmail.com', 'One of the Largest Hotel & Restaurants in Vizag', '1234567891', 'null', NULL, NULL, 'No', 'Dwarka Nagar main road', 1, 15, 'Visakhapatnam', NULL, '530004', '17.7294', '83.3093', NULL, 25, '15', NULL, 0, 'REMANI123', '71636271891982888282818              ', 'R6271718727171', 'WORLD BANK', 'RE6271818882', 'Bullet Reddy', '94da7416-a92f-4a9a-9c22-565e5ea8c888', 'WOR6372818', '2021-09-27 10:21:24', 'REDDYFIRST123', 0, NULL, ''),
(250, '250_', '', '', '', 'Manikanta Reddy N', 'No', '40b1a050e610d342c8fa8ee4325dbbf7', '', 'manikantareddy166328@gmail.com', '', '8639480661', NULL, '8652', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'null', NULL, '2021-09-28 11:59:59', NULL, NULL, NULL, ''),
(251, '251_', '', '', '', '', 'No', 'a50a570188087be5663b1a0b04803573', '', 'prashanthbandi42@gmail.com', '', '', NULL, '3571', NULL, 'No', 'Hyderabad', 0, 0, '', NULL, '', '', '', NULL, 0, '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'fa1c973a-6b33-4f08-94df-82af8d18aaa7', NULL, '2021-09-28 12:01:23', NULL, NULL, NULL, ''),
(252, '252_', ' ', '202109301625001701639_bug1_2.jpeg', '202109301625003730883_bug3.jpeg', ' ', 'No', '7215ee9c7d9dc229d2921a40e899ec5f', '', 'mani@gmail.com', ' ', '8796321532', NULL, NULL, NULL, 'No', 'allipuram', 1, 15, 'Visakhapatnam', NULL, NULL, ' ', ' ', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-30 10:55:00', ' ', 0, NULL, ''),
(253, '253_', '&!@*(@^!(^~#', '202109301626413581163_bug1_2.jpeg', '202109301626413308470_bug3.jpeg', ' ', 'No', '7215ee9c7d9dc229d2921a40e899ec5f', '', 'mani@gmail.com', ' ', '4997875478', NULL, NULL, NULL, 'No', 'allipuram', 1, 15, 'Visakhapatnam', NULL, NULL, '17.7400', '83.3142', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-30 10:56:41', ' ', 0, NULL, ''),
(254, '254_', '@&*(', '202109301646408696772_bug1_2.jpeg', '202109301646403366998_bug3.jpeg', '@*&*(&@        @&*@&', 'No', '7215ee9c7d9dc229d2921a40e899ec5f', '', 'q@gmail.com', ' ', '2234567890', NULL, NULL, NULL, 'No', ' ', 1, 15, 'Visakhapatnam', NULL, NULL, ' ', ' ', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-30 11:16:40', ' ', 0, NULL, ''),
(255, '255_', '', '', '', 'Manikanta Reddy', 'No', '40b1a050e610d342c8fa8ee4325dbbf7', '', 'neelapumanikanta3@gmail.com', '', '8790361953', NULL, '4567', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-01 04:51:44', NULL, NULL, NULL, ''),
(256, '256_', '', '', '', 'Manikanta Reddy', 'No', '40b1a050e610d342c8fa8ee4325dbbf7', '', 'neelapumanikanta3@gmail.com', '', '8639480661', NULL, '5185', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-01 04:53:22', NULL, NULL, NULL, ''),
(257, '257_', '', '', '', 'Manikanta Reddy', 'No', '40b1a050e610d342c8fa8ee4325dbbf7', '', 'mani@gmail.com', '', '8790361953', NULL, '4567', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-01 13:22:37', NULL, NULL, NULL, ''),
(258, '258_', '', '', '', 'Manikanta Reddy', 'No', '40b1a050e610d342c8fa8ee4325dbbf7', '', 'mani@gmail.com', '', '9966264359', NULL, '6892', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-01 13:24:04', NULL, NULL, NULL, ''),
(259, '259_', '', '', '', 'Manikanta Reddy', 'No', '40b1a050e610d342c8fa8ee4325dbbf7', '', 'mani@gmail.com', '', '8309516865', NULL, '5190', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-01 13:24:47', NULL, NULL, NULL, ''),
(260, '260_', '', '', '', 'mani reddy', 'No', '40b1a050e610d342c8fa8ee4325dbbf7', '', 'manireddy@gmail.com', '', '9966264359', NULL, '2537', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-02 05:12:13', NULL, NULL, NULL, ''),
(261, '261_', '', '', '', 'mani reddy', 'No', '40b1a050e610d342c8fa8ee4325dbbf7', '', 'neelapumanikanta3@gmail.com', '', '9966264359', NULL, '5827', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-02 05:17:19', NULL, NULL, NULL, ''),
(262, '262_', '', '', '', 'mani reddy', 'No', '40b1a050e610d342c8fa8ee4325dbbf7', '', 'manikantareddy166328@gmail.com', '', '9966264359', NULL, '4800', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'null', NULL, '2021-10-02 05:17:53', NULL, NULL, NULL, ''),
(263, '263_', '', '', '', 'mani reddy', 'No', '40b1a050e610d342c8fa8ee4325dbbf7', '', 'manikantareddy166328@gmail.com', '', '8790361953', NULL, '4567', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'null', NULL, '2021-10-02 05:18:02', NULL, NULL, NULL, ''),
(264, '264_', '', '', '', 'mani reddy', 'No', 'da569732582a689c2c41080bb22d521c', '', 'mani@gmail.com', '', '8790361953', NULL, '4567', 1, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-04 09:23:15', NULL, NULL, NULL, ''),
(265, '265_reddys-restuarant', 'REDDY\'S RESTUARANT', '202110061717135917413_reddy_kingdom.jfif', '202110061717139044103_mrlogo.jpg', 'Manikanta Reddy N', 'No', '2e236eaf2a91fe239ea9c87862a337d6', '', 'manikantareddy166328@gmail.com', 'The world\'s no 1 Reddy\'s Restaurant', '8639480661', '', '6183', 1, 'No', 'MVP COLONY, VIZAG', 1, 15, 'VISAKHAPATANAM', NULL, '530017', '17.7413', '83.3345', NULL, 25, '15', NULL, 0, 'REDDY123', '172882718271', 'REDDY345', 'REDDY\'S BANK', '62718917291', 'MAHENDRA REDDY', 'c12cbc5d-a52d-42b7-9dac-c8134cd51cbe', 'R728192918', '2021-10-06 10:59:44', 'REDDYEMPIRE', 0, NULL, ''),
(266, '266_', '', '', '', '   ', 'No', 'a127fd1f86e4ab650f2216f09992afa4', '', 'a@gmail.com', '', '8188812354', NULL, '2005', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-06 12:29:02', NULL, NULL, NULL, ''),
(267, '267_', '', '', '', '62818 738282', 'No', '106d46cdc6fd81df97d6e159aace6aa2', '', 'c@gmail.com', '', '1772727188', NULL, '3674', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-06 12:29:48', NULL, NULL, NULL, ''),
(268, '268_', '', '', '', '&#-@ @  -£ #(@(', 'No', '106d46cdc6fd81df97d6e159aace6aa2', '', 'c@gmail.com', '', '1772727188', NULL, '1731', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-06 12:30:00', NULL, NULL, NULL, ''),
(269, '269_', '', '', '', '&#-@ @  -£ #(@(8y', 'No', '106d46cdc6fd81df97d6e159aace6aa2', '', 'c@gmail.com', '', '9490301926', NULL, '2521', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-06 12:30:51', NULL, NULL, NULL, ''),
(270, '270_', '', '', '', 'banan shsjw', 'No', 'd0f37827aefecf6e8e04c527d67a5662', '', 'cg@gnail.com', '', '1628181812', NULL, '6574', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-06 12:33:03', NULL, NULL, NULL, ''),
(271, '271_', '', '', '', '??? ????? ?????????? ??????????  hsjsj', 'No', 'd0f37827aefecf6e8e04c527d67a5662', '', 'ba@gmail.com', '', '7281818373', NULL, '4758', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-06 12:57:19', NULL, NULL, NULL, ''),
(272, '272_', '', '', '', 'ja na', 'No', 'b94b2d5ae84deec0514779cefa3103cb', '', 'bsja@gmail.com', '', '7272818178', NULL, '3713', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-06 12:58:42', NULL, NULL, NULL, ''),
(273, '273_', '', '', '', 'ja na', 'No', 'b94b2d5ae84deec0514779cefa3103cb', '', 'bsja@gmail.com', '', '7272818178', NULL, '8541', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-06 13:04:25', NULL, NULL, NULL, ''),
(274, '274_', '', '', '', '???? ????', 'No', '831fcf0065479e649734233e8570bef0', '', 'f@1gmail.com', '', '1234567898', NULL, '9686', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-07 04:59:48', NULL, NULL, NULL, ''),
(275, '275_', ' ', '202110071111371334085_ch1.jfif', '202110071111372999866_mrlogo.jpg', '   ', 'No', '30de812fff57e7c6638869cd17175d01', '', 'd@gmail.com', ' ', '9191929293', NULL, '6581', NULL, 'No', '  ', 2, 15, 'Visakhapatnam', NULL, ' ', '16.5062', '80.6480', NULL, 0, NULL, NULL, 0, ' ', ' ', ' ', ' ', ' ', ' ', '94da7416-a92f-4a9a-9c22-565e5ea8c888', ' ', '2021-10-07 05:17:30', ' ', 0, NULL, ''),
(276, '276_', ' ', '202110071113554106849_ch1.jfif', '202110071113551323802_mrlogo.jpg', '    ', 'No', '30de812fff57e7c6638869cd17175d01', '', 'd@gmail.com', ' ', '9191929295', NULL, '5644', NULL, 'No', ' ', 2, 15, 'Visakhapatnam', NULL, ' ', '16.5062', '80.6480', NULL, 0, NULL, NULL, 0, ' ', ' ', ' ', ' ', ' ', ' ', '94da7416-a92f-4a9a-9c22-565e5ea8c888', ' ', '2021-10-07 05:42:52', ' ', 0, NULL, ''),
(277, '277_', ' ', '202110071153267215490_ch1.jfif', '202110071153266414667_mrlogo.jpg', '    ', 'No', '30de812fff57e7c6638869cd17175d01', '', 'aga@gmail.com', ' ', '9191929297', NULL, '9557', NULL, 'No', ' ', 3, 15, 'Visakhapatnam', NULL, ' ', '17.7163', '83.2955', NULL, 0, NULL, NULL, 0, ' ', ' ', ' ', ' ', ' ', '', '94da7416-a92f-4a9a-9c22-565e5ea8c888', '', '2021-10-07 06:21:33', ' ', 0, NULL, ''),
(278, '278_', '', '', '', 'vahajaj ???? ??', 'No', '3f0e5120eb924475ab25c260812c3227', '', 'a@gmail.com', '', '9390962818', NULL, '9523', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-07 06:31:23', NULL, NULL, NULL, ''),
(279, '279_', '', '', '', '\'# @ @(@ -# #(@', 'No', '86860d65964f3e449c3eb538a78fe3cf', '', 'maniii@gmail.com', '', '1234567890', NULL, '8765', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-11 04:53:57', NULL, NULL, NULL, ''),
(280, '280_', '', '', '', '               ', 'No', '86860d65964f3e449c3eb538a78fe3cf', '', 'maniha@gmail.com', '', '6372818289', NULL, '7147', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-11 04:54:31', NULL, NULL, NULL, ''),
(281, '281_', '', '', '', '       hshshsjsj17738292         # #728@jjshwwu', 'No', '3f82b0eeb855d486507a364a2ce17184', '', 'hsja@gmail.com', '', '7382829828', NULL, '6825', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-11 04:55:24', NULL, NULL, NULL, ''),
(282, '282_', '', '', '', 'mani mahi', 'No', '9f7da612ad2796159a6e89ec9993cfb6', '', 'as@gmail.com', '', '1239874521', NULL, '6153', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-11 04:57:45', NULL, NULL, NULL, ''),
(283, '283_', '', '', '', '   ', 'No', '831fcf0065479e649734233e8570bef0', '', 'a@gmail.com', '', '1737818117', NULL, '5143', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-11 05:01:22', NULL, NULL, NULL, ''),
(284, '284_', '', '', '', '   ', 'No', '831fcf0065479e649734233e8570bef0', '', 'gshdbsjsjzbsvsh@gdjsn.com', '', '1737818117', NULL, '9220', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-11 05:01:39', NULL, NULL, NULL, ''),
(285, '285_', '', '', '', '   ', 'No', '831fcf0065479e649734233e8570bef0', '', 'gdhsbebsjsjzkdbhwjsjkk367228@gnail.com', '', '1737818117', NULL, '4096', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-11 05:01:55', NULL, NULL, NULL, ''),
(286, '286_', '', '', '', '   ', 'No', '831fcf0065479e649734233e8570bef0', '', 'shsjanan@gmail.com', '', '1737818117', NULL, '5806', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-11 05:02:37', NULL, NULL, NULL, ''),
(287, '287_', '', '', '', 'mani mahi', 'No', 'a127fd1f86e4ab650f2216f09992afa4', '', 'ga@gmail.com', '', '6382819218', NULL, '3661', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-11 05:05:58', NULL, NULL, NULL, ''),
(288, '288_', '', '', '', 'mani mahi', 'No', '673eb027e9c056f57140322807351dd5', '', 'unique@gmail.com', '', '6372819181', NULL, '3634', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-11 05:22:00', NULL, NULL, NULL, ''),
(289, '289_', '', '', '', 'mani mahi', 'No', '673eb027e9c056f57140322807351dd5', '', 'unique@gmail.com', '', '6372818814', NULL, '2090', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-11 05:22:32', NULL, NULL, NULL, ''),
(290, '290_', '', '', '', 'mani mahi', 'No', '673eb027e9c056f57140322807351dd5', '', 'unique@gmail.com', '', '9288173718', NULL, '5021', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-11 05:22:45', NULL, NULL, NULL, ''),
(291, '291_', '', '', '', 'mani mahi', 'No', 'b4f7a3064411dbb17915044d0f43419e', '', 'unique@gmail.com', '', '9291981821', NULL, '6907', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-11 05:23:36', NULL, NULL, NULL, ''),
(292, '292_', '', '', '', 'mani mahi', 'No', 'b4f7a3064411dbb17915044d0f43419e', '', 'unique@gmail.com', '', '6262771811', NULL, '9172', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-11 05:23:49', NULL, NULL, NULL, ''),
(293, '293_', '', '', '', 'mani mahi', 'No', 'b4f7a3064411dbb17915044d0f43419e', '', 'unique@gmail.com', '', '2551617861', NULL, '2123', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-11 05:24:04', NULL, NULL, NULL, ''),
(294, '294_', ' ', '20211011110242360436_whatsapp_image_2021_10_08_at_11.18.20__3_.jpeg', '202110111102429596219_whatsapp_image_2021_10_08_at_11.18.20__14_.jpeg', 'mani reddy', 'No', 'a6c5293bfc34fe0643b360bb007d948d', '', 'mahi@gmail.com', ' ', '7681232179', NULL, '2694', NULL, 'No', '   ', 1, 15, 'Visakhapatnam', NULL, ' ', '17.7413', '83.3345', NULL, 0, NULL, NULL, 0, ' ', ' ', ' ', ' ', ' ', ' ', '94da7416-a92f-4a9a-9c22-565e5ea8c888', ' ', '2021-10-11 05:31:24', ' ', 0, NULL, ''),
(295, '295_', '', '', '', '???????????????????????????????????????????????????????????????? ????????????????????????????????????????????', 'No', '2d9d2b9defd0aa4ab4e7df17cd25e541', '', 'emoji@gmail.com', '', '7177188188', NULL, '1137', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-11 05:35:15', NULL, NULL, NULL, ''),
(296, '296_', '', '', '', '???????????????????????????????????????????????????????????????? ????????????????????????????????????????????', 'No', '2d9d2b9defd0aa4ab4e7df17cd25e541', '', 'emoji@gmail.com', '', '7177188188', NULL, '3245', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-11 05:35:24', NULL, NULL, NULL, ''),
(297, '297_', '', '', '', '?????? ?????????', 'No', '5234c76ef8affee271257705e8e3fecf', '', 'telugu@gmail.com', '', '7178828191', NULL, '7937', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-11 05:37:31', NULL, NULL, NULL, ''),
(298, '298_', '', '', '', '?????? ?????????', 'No', '5234c76ef8affee271257705e8e3fecf', '', 'telugu@gmail.com', '', '7178828191', NULL, '7522', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '94da7416-a92f-4a9a-9c22-565e5ea8c888', NULL, '2021-10-11 05:37:36', NULL, NULL, NULL, ''),
(299, '', 'Royal Foodies', '202112181218547235712_img2.jpg', '202112181218548366147_img2.jpg', 'Lavanya', 'No', 'e807f1fcf82d132f9bb018ca6738a19f', '', 'lavanyakola878@gmail.com', 'test', '1234567890', NULL, NULL, NULL, 'No', '202, Bharath towers, Dwaraka nagar, 5th lane, beside tilak show room', 1, 15, 'Visakhapatnam', NULL, NULL, '21163', '265', NULL, 100, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-18 06:48:54', '', 0, NULL, ''),
(300, '', '', '', '', 'dd v', 'No', '948febd2871c815e5e73a878f4235c95', '', 'dfd@gmail.com', '', '1231231231', NULL, '7487', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'null', NULL, '2022-01-27 04:56:08', NULL, NULL, NULL, ''),
(301, '', '', '', '', 'fd d', 'No', '4297f44b13955235245b2497399d7a93', '', 'fdf@gmail.com', '', '1231231231', NULL, '6748', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'null', NULL, '2022-01-27 05:34:39', NULL, NULL, NULL, ''),
(302, '', '', '', '', 'test s', 'No', 'e10adc3949ba59abbe56e057f20f883e', '', 'team9@thecolourmoon.com', '', '9988667755', NULL, '1461', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'null', NULL, '2022-01-27 05:51:29', NULL, NULL, NULL, ''),
(303, '', '', '', '', 'test s', 'No', 'e10adc3949ba59abbe56e057f20f883e', '', 'team9@thecolourmoon.com', '', '9988667755', NULL, '6439', NULL, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'null', NULL, '2022-01-27 06:18:03', NULL, NULL, NULL, ''),
(304, '', '', '', '', 'test s', 'No', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'chandan.dev@colourmoon.com', '', '9347315511', NULL, '7366', 1, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'null', NULL, '2022-01-27 06:18:43', NULL, NULL, NULL, ''),
(305, '', '', '', '', 'anu raaga', 'No', '4654aa22a4f2b1a73a08f4feb23bdbee', '', 'anuraagasree000@gmail.com', '', '8125725767', NULL, '5666', 1, 'No', '', 0, 0, 'Visakhapatnam', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '50a16070-af36-11ec-91ff-72385f67307b', NULL, '2022-03-29 08:02:20', NULL, NULL, NULL, ''),
(306, '', 'Absolute', '202204221439399273582_banner_1.jpg', '202204221439391367049_banner_1.jpg', 'Absolutemens', 'No', '07db0b0c5a4678e58b60348f35a26d8a', '', 'webteam2@colourmoon.com', 'lorem ipsum', '9848820041', NULL, NULL, NULL, 'No', 'Dwarkanagar', 1, 1, 'Visakhapatnam', NULL, NULL, '17.730670', '83.306770', NULL, 5000, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-22 09:09:39', 'abs100', 0, NULL, '');

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

--
-- Dumping data for table `vendor_shop_banners`
--

INSERT INTO `vendor_shop_banners` (`id`, `shop_id`, `title`, `web_banner`, `app_banner`, `status`, `created_at`, `udpated_at`) VALUES
(22, 249, 'RESTUARANTS', '20211004174618154678_r1.jfif', '202110041746181241149_r2.jfif', 1, '', ''),
(23, 249, '!@(#^!#^(*!', '202110121214362837655_whatsapp_image_2021_10_08_at_11.18.20__16_.jpeg', '202110121214369193791_whatsapp_image_2021_10_08_at_11.33.40.jpeg', 0, '', ''),
(24, 249, '                                                                                      ', '202110121214539067672_whatsapp_image_2021_10_08_at_11.18.20__14_.jpeg', '202110121214537711712_whatsapp_image_2021_10_08_at_11.18.20__12_.jpeg', 0, '', '');

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

--
-- Dumping data for table `wallet_transactions`
--

INSERT INTO `wallet_transactions` (`id`, `user_id`, `price`, `message`, `status`, `created_at`, `razerpay_orderid`, `order_id`) VALUES
(121, 352, 0, 'New Order Created ', 'minus', '1624273058', '', 3),
(122, 349, 0, 'New Order Created ', 'minus', '1624273200', '', 4),
(123, 353, 0, 'New Order Created ', 'minus', '1624274640', '', 5),
(124, 352, 0, 'New Order Created ', 'minus', '1624361015', '', 1),
(125, 353, 0, 'New Order Created ', 'minus', '1624364635', '', 4),
(126, 353, 0, 'New Order Created ', 'minus', '1624364675', '', 5),
(127, 353, 0, 'New Order Created ', 'minus', '1624365962', '', 2),
(128, 353, 0, 'New Order Created ', 'minus', '1624366004', '', 3),
(129, 353, 0, 'New Order Created ', 'minus', '1624366936', '', 1),
(130, 354, 0, 'New Order Created ', 'minus', '1624626916', '', 4),
(131, 354, 0, 'New Order Created ', 'minus', '1625296481', '', 5),
(132, 354, 0, 'New Order Created ', 'minus', '1625645401', '', 6),
(133, 354, 0, 'New Order Created ', 'minus', '1625645425', '', 7),
(134, 355, 0, 'New Order Created ', 'minus', '1632734450', '', 0),
(135, 357, 0, 'New Order Created ', 'minus', '1632735878', '', 0),
(136, 355, 0, 'New Order Created ', 'minus', '1632741362', '', 0),
(137, 357, 0, 'New Order Created ', 'minus', '1632833446', '', 0),
(138, 357, 0, 'New Order Created ', 'minus', '1632833899', '', 0),
(139, 357, 0, 'New Order Created ', 'minus', '1632833981', '', 0),
(140, 355, 0, 'New Order Created ', 'minus', '1632896384', '', 0),
(141, 355, 0, 'New Order Created ', 'minus', '1632898297', '', 0),
(142, 355, 0, 'New Order Created ', 'minus', '1632898371', '', 0),
(143, 355, 0, 'New Order Created ', 'minus', '1632906262', '', 0),
(144, 355, 0, 'New Order Created ', 'minus', '1632913503', '', 0),
(145, 357, 0, 'New Order Created ', 'minus', '1632915603', '', 0),
(146, 355, 0, 'New Order Created ', 'minus', '1632915820', '', 0),
(147, 360, 0, 'New Order Created ', 'minus', '1632986930', '', 0),
(148, 360, 0, 'New Order Created ', 'minus', '1633003908', '', 0),
(149, 360, 0, 'New Order Created ', 'minus', '1633008714', '', 0),
(150, 357, 0, 'New Order Created ', 'minus', '1633429167', '', 0),
(151, 357, 0, 'New Order Created ', 'minus', '1633429282', '', 0),
(152, 357, 0, 'New Order Created ', 'minus', '1633429359', '', 0),
(153, 357, 0, 'New Order Created ', 'minus', '1633429445', '', 0),
(154, 357, 0, 'New Order Created ', 'minus', '1633693940', '', 0),
(155, 357, 0, 'New Order Created ', 'minus', '1633695993', '', 0),
(156, 357, 0, 'New Order Created ', 'minus', '1633696601', '', 0),
(157, 357, 0, 'New Order Created ', 'minus', '1633697041', '', 0),
(158, 357, 0, 'New Order Created ', 'minus', '1633697186', '', 0),
(159, 357, 0, 'New Order Created ', 'minus', '1633697403', '', 0),
(160, 357, 0, 'New Order Created ', 'minus', '1633697494', '', 0),
(161, 357, 0, 'New Order Created ', 'minus', '1633945257', '', 0),
(162, 357, 0, 'New Order Created ', 'minus', '1633945324', '', 0),
(163, 357, 0, 'New Order Created ', 'minus', '1633945401', '', 0),
(164, 357, 0, 'New Order Created ', 'minus', '1633945487', '', 0),
(165, 357, 0, 'New Order Created ', 'minus', '1633951572', '', 0),
(166, 357, 0, 'New Order Created ', 'minus', '1633954363', '', 0),
(167, 357, 0, 'New Order Created ', 'minus', '1633954804', '', 0),
(168, 357, 0, 'New Order Created ', 'minus', '1633957505', '', 0),
(169, 357, 0, 'New Order Created ', 'minus', '1633957650', '', 0),
(170, 357, 0, 'New Order Created ', 'minus', '1633957683', '', 0),
(171, 357, 0, 'New Order Created ', 'minus', '1633958378', '', 0),
(172, 353, 0, 'New Order Created ', 'minus', '1644992611', '', 0);

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

--
-- Dumping data for table `whish_list`
--

INSERT INTO `whish_list` (`id`, `user_id`, `product_id`, `created_date`) VALUES
(62, 355, 9, ''),
(95, 0, 9, ''),
(97, 355, 16, ''),
(79, 355, 18, ''),
(98, 355, 19, ''),
(73, 357, 18, ''),
(77, 357, 19, ''),
(102, 357, 17, ''),
(84, 0, 0, ''),
(85, 0, 19, ''),
(94, 0, 18, ''),
(99, 355, 21, ''),
(100, 355, 22, ''),
(101, 355, 23, ''),
(138, 353, 23, ''),
(135, 353, 8, ''),
(137, 353, 9, ''),
(133, 353, 5, ''),
(134, 0, 16, ''),
(131, 379, 9, ''),
(152, 385, 58, '1656070738'),
(150, 384, 58, ''),
(149, 384, 57, ''),
(147, 389, 55, ''),
(159, 352, 57, '1658229029'),
(154, 352, 58, '1657110969'),
(155, 352, 59, '1657110973'),
(156, 352, 60, '1657110974'),
(157, 352, 55, '1657110979');

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_comissions`
--
ALTER TABLE `admin_comissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attributes_title`
--
ALTER TABLE `attributes_title`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `attributes_values`
--
ALTER TABLE `attributes_values`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `attr_brands`
--
ALTER TABLE `attr_brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `become_a_vendor`
--
ALTER TABLE `become_a_vendor`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `bid_quotations`
--
ALTER TABLE `bid_quotations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT for table `cash_coupons`
--
ALTER TABLE `cash_coupons`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon_codes`
--
ALTER TABLE `coupon_codes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `guest_users`
--
ALTER TABLE `guest_users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13352;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_attributes`
--
ALTER TABLE `manage_attributes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `most_viewed_products`
--
ALTER TABLE `most_viewed_products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1273;

--
-- AUTO_INCREMENT for table `online_orders`
--
ALTER TABLE `online_orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `pincodes`
--
ALTER TABLE `pincodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_filter`
--
ALTER TABLE `product_filter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6222;

--
-- AUTO_INCREMENT for table `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotion_notifications`
--
ALTER TABLE `promotion_notifications`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `questionaries`
--
ALTER TABLE `questionaries`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `refund_exchange`
--
ALTER TABLE `refund_exchange`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `request_payment`
--
ALTER TABLE `request_payment`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shop_favorites`
--
ALTER TABLE `shop_favorites`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_visit`
--
ALTER TABLE `shop_visit`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5340;

--
-- AUTO_INCREMENT for table `shop_work_hours`
--
ALTER TABLE `shop_work_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7127;

--
-- AUTO_INCREMENT for table `sms_notifications`
--
ALTER TABLE `sms_notifications`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2117;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock_management`
--
ALTER TABLE `stock_management`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1788;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=391;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_bids`
--
ALTER TABLE `user_bids`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_reviews`
--
ALTER TABLE `user_reviews`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_transactions`
--
ALTER TABLE `user_transactions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_orders_values`
--
ALTER TABLE `vendor_orders_values`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `vendor_payements`
--
ALTER TABLE `vendor_payements`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `vendor_shop`
--
ALTER TABLE `vendor_shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;

--
-- AUTO_INCREMENT for table `vendor_shop_banners`
--
ALTER TABLE `vendor_shop_banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `working_hours`
--
ALTER TABLE `working_hours`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
