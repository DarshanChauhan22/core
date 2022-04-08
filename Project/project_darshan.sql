-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2022 at 06:16 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_darshan`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addressId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postalCode` int(8) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `billing` tinyint(1) NOT NULL DEFAULT 0,
  `shipping` tinyint(1) NOT NULL DEFAULT 0,
  `same` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addressId`, `customerId`, `address`, `postalCode`, `city`, `state`, `country`, `billing`, `shipping`, `same`) VALUES
(585, 463, 'm', 0, 'm', 'm', 'm', 1, 0, 1),
(586, 463, 'm', 0, 'm', 'm', 'm', 0, 1, 1),
(601, 521, 'a', 0, 'a', 'a', 'a', 1, 0, 1),
(602, 521, 'a', 0, 'a', 'a', 'a', 0, 1, 1),
(603, 522, 't', 0, 't', 't', 't', 1, 0, 1),
(604, 522, 'y', 0, 'y', 'y', 'u', 0, 1, 1),
(605, 523, 'a', 0, 'a', 'a', 'a', 1, 0, 1),
(606, 523, 'a', 0, 'a', 'a', 'a', 0, 1, 1),
(607, 524, 'y', 0, 'y', 'y', 'y', 1, 0, 1),
(608, 524, 'u', 0, 'u', 'u', '', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `firstName`, `lastName`, `email`, `password`, `status`, `createdAt`, `updatedAt`) VALUES
(132, 'dc', 'dom', 'dc@gmail.com', '3212f5f463edb370ff55d3c3a7a15c8f', 1, '2022-03-15 10:29:37', '2022-04-05 00:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `total` float DEFAULT NULL,
  `shippingMethodId` int(11) DEFAULT NULL,
  `paymentMethodId` int(11) DEFAULT NULL,
  `shippingAmount` float DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartId`, `customerId`, `total`, `shippingMethodId`, `paymentMethodId`, `shippingAmount`, `createdAt`, `updatedAt`) VALUES
(47, 463, 401, 5, 13, 100, '2022-04-01 00:39:38', NULL),
(48, 521, 1000, 5, 4, 100, '2022-04-04 10:36:09', NULL),
(49, 522, 700, 5, 4, 100, '2022-04-04 10:52:59', NULL),
(50, 524, 1000, 5, 4, 100, '2022-04-04 23:51:01', NULL),
(51, 523, 400, 6, 10, 10, '2022-04-05 00:04:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_address`
--

CREATE TABLE `cart_address` (
  `cartAddressId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `postalCode` int(10) NOT NULL,
  `billing` tinyint(2) NOT NULL,
  `shipping` tinyint(2) NOT NULL,
  `same` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_address`
--

INSERT INTO `cart_address` (`cartAddressId`, `cartId`, `firstName`, `lastName`, `mobile`, `email`, `address`, `city`, `state`, `country`, `postalCode`, `billing`, `shipping`, `same`) VALUES
(67, 47, 'm', 'm', '', 'm', 'm', 'm', 'm', 'm', 0, 1, 0, 0),
(68, 47, 'm', 'm', '', 'm', 'm', 'm', 'm', 'm', 0, 0, 1, 0),
(69, 48, 'a', 'a', '', 'a', 'a', 'a', 'a', 'a', 0, 1, 0, 1),
(70, 48, 'a', 'a', '', 'a', 'a', 'a', 'a', 'a', 0, 0, 1, 1),
(71, 50, 'y', 'y', '', 'y', 'y', 'y', 'y', 'y', 0, 1, 0, 0),
(72, 50, 'u', 'u', '', 'u', 'u', 'u', 'u', '', 0, 0, 1, 0),
(73, 51, 'a', 'a', '', 'a', 'a', 'a', 'a', 'a', 0, 1, 0, 1),
(74, 51, 'a', 'a', '', 'a', 'a', 'a', 'a', 'a', 0, 0, 1, 1),
(75, 49, 't', 't', '', 't', 't', 't', 't', 't', 0, 1, 0, 0),
(76, 49, 'y', 'y', '', 'y', 'y', 'y', 'y', 'u', 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `itemId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `cost` float NOT NULL,
  `tax` decimal(10,0) DEFAULT NULL,
  `taxAmount` float DEFAULT NULL,
  `discount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`itemId`, `cartId`, `productId`, `quantity`, `price`, `cost`, `tax`, `taxAmount`, `discount`) VALUES
(143, 48, 711, 10, 100, 200, '10', 60, 120),
(145, 50, 711, 10, 100, 200, '10', 40, 80),
(146, 51, 711, 4, 100, 200, '10', 30, 60),
(148, 49, 711, 7, 100, 200, '10', 10, 20),
(149, 47, 650, 1, 1, 1, '1', 0.01, 0),
(150, 47, 711, 4, 100, 200, '10', 30, 60);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `parentId` int(11) NOT NULL,
  `categoryPath` varchar(127) NOT NULL,
  `name` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `parentId`, `categoryPath`, `name`, `status`, `createdAt`, `updatedAt`) VALUES
(365, 0, 'Array/365', '1258', 1, '2022-04-05 09:14:58', '2022-04-05 09:47:30'),
(367, 365, 'Array/365/367', 'mkn', 1, '2022-04-05 22:18:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_media`
--

CREATE TABLE `category_media` (
  `imageId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `base` tinyint(4) NOT NULL,
  `thumb` tinyint(4) NOT NULL,
  `small` tinyint(4) NOT NULL,
  `gallery` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_media`
--

INSERT INTO `category_media` (`imageId`, `categoryId`, `image`, `base`, `thumb`, `small`, `gallery`, `status`) VALUES
(162, 365, '0452022093803-ecom_database.png', 0, 0, 1, 0, 0),
(167, 365, '0452022095442-Screenshot_2021-12-15-21-46-50-53_010925bd39fdc4bfa0e99fa1d4c2b790-01.jpeg', 0, 1, 0, 0, 0),
(168, 365, '0452022095810-9.PNG', 1, 0, 0, 0, 0),
(169, 367, '0452022101825-ecom_database.png', 0, 1, 1, 0, 0),
(170, 367, '0452022101841-9.PNG', 1, 0, 0, 0, 0),
(174, 365, '0462022121148-ecom_database.png', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `entityId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`entityId`, `categoryId`, `productId`) VALUES
(394, 365, 711),
(395, 367, 711),
(398, 365, 788),
(399, 367, 788);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `configId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `code` varchar(30) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`configId`, `name`, `value`, `code`, `status`, `createdAt`) VALUES
(40, 'j', 'j', 'j', 2, '2022-02-27 16:29:58'),
(64, 'n', 'n', 'n', 2, '2022-03-13 01:13:13'),
(67, 'qq', 'q', 'qq', 1, '2022-03-13 19:03:44'),
(93, 'm', 'm', 'm', 2, '2022-04-01 23:34:23');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `salesmanId` int(11) DEFAULT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `salesmanId`, `firstName`, `lastName`, `email`, `mobile`, `status`, `createdAt`, `updatedAt`) VALUES
(463, 54, 'l', 'l', 'l', 'l', 1, '2022-03-31 20:45:16', '2022-04-02 11:10:03'),
(521, 37, 'l', 'l', 'l', 'l', 1, '0000-00-00 00:00:00', '2022-04-01 17:29:07'),
(522, 54, '', '', '', '', 1, '0000-00-00 00:00:00', '2022-04-01 17:29:15'),
(523, 53, '', '', '', '', 1, '0000-00-00 00:00:00', '2022-04-01 17:51:49'),
(524, 54, 'j', 'j', 'j', 'j', 1, '0000-00-00 00:00:00', '2022-04-05 01:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `customer_price`
--

CREATE TABLE `customer_price` (
  `entityId` int(11) NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `customerId` int(11) DEFAULT NULL,
  `customerPrice` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_price`
--

INSERT INTO `customer_price` (`entityId`, `productId`, `customerId`, `customerPrice`) VALUES
(133, 650, 521, 1),
(134, 711, 521, 90),
(137, 650, 522, 1),
(139, 711, 522, 95),
(143, 650, 463, 1),
(145, 711, 463, 90),
(149, 650, 523, 11),
(151, 711, 523, 95),
(155, 650, 524, 1),
(157, 711, 524, 90);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `taxAmount` float NOT NULL,
  `grandTotal` float NOT NULL,
  `shippingMethodId` int(11) NOT NULL,
  `shippingAmount` float NOT NULL,
  `paymentMethodId` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `state` tinyint(2) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `customerId`, `firstName`, `lastName`, `email`, `mobile`, `taxAmount`, `grandTotal`, `shippingMethodId`, `shippingAmount`, `paymentMethodId`, `status`, `state`, `createdAt`, `updatedAt`) VALUES
(26, 463, 'm', 'm', 'm', '', 30.01, 291.01, 5, 100, 13, 1, 1, '2022-04-05 11:16:52', NULL),
(27, 524, 'u', 'u', 'u', '', 40, 340, 5, 100, 4, 1, 1, '2022-04-05 11:20:32', NULL),
(28, 523, 'a', 'a', 'a', '', 30, 200, 6, 10, 10, 1, 1, '2022-04-05 00:05:22', NULL),
(29, 522, 'y', 'y', 'y', '', 10, 670, 5, 100, 4, 1, 1, '2022-04-05 00:08:31', NULL),
(30, 521, 'a', 'a', 'a', '', 60, -40, 5, 100, 4, 1, 1, '2022-04-05 00:32:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

CREATE TABLE `order_address` (
  `addressId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `firstName` varchar(32) NOT NULL,
  `lastName` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `city` varchar(32) NOT NULL,
  `state` varchar(32) NOT NULL,
  `country` varchar(32) NOT NULL,
  `postalCode` int(11) NOT NULL,
  `address` varchar(64) NOT NULL,
  `type` tinyint(2) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_address`
--

INSERT INTO `order_address` (`addressId`, `orderId`, `firstName`, `lastName`, `email`, `mobile`, `city`, `state`, `country`, `postalCode`, `address`, `type`, `createdAt`, `updatedAt`) VALUES
(45, 26, 'm', 'm', 'm', '', 'm', 'm', 'm', 0, 'm', 1, '2022-04-05 11:16:52', '0000-00-00 00:00:00'),
(46, 26, 'm', 'm', 'm', '', 'm', 'm', 'm', 0, 'm', 2, '2022-04-05 11:16:52', '0000-00-00 00:00:00'),
(47, 27, 'y', 'y', 'y', '', 'y', 'y', 'y', 0, 'y', 1, '2022-04-05 11:20:32', '0000-00-00 00:00:00'),
(48, 27, 'u', 'u', 'u', '', 'u', 'u', '', 0, 'u', 2, '2022-04-05 11:20:32', '0000-00-00 00:00:00'),
(49, 28, 'a', 'a', 'a', '', 'a', 'a', 'a', 0, 'a', 1, '2022-04-05 00:05:22', '0000-00-00 00:00:00'),
(50, 28, 'a', 'a', 'a', '', 'a', 'a', 'a', 0, 'a', 2, '2022-04-05 00:05:22', '0000-00-00 00:00:00'),
(51, 29, 't', 't', 't', '', 't', 't', 't', 0, 't', 1, '2022-04-05 00:08:31', '0000-00-00 00:00:00'),
(52, 29, 'y', 'y', 'y', '', 'y', 'y', 'u', 0, 'y', 2, '2022-04-05 00:08:31', '0000-00-00 00:00:00'),
(53, 30, 'a', 'a', 'a', '', 'a', 'a', 'a', 0, 'a', 1, '2022-04-05 00:32:06', '0000-00-00 00:00:00'),
(54, 30, 'a', 'a', 'a', '', 'a', 'a', 'a', 0, 'a', 2, '2022-04-05 00:32:06', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_comment`
--

CREATE TABLE `order_comment` (
  `commentId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `note` text NOT NULL,
  `customerNotified` tinyint(4) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_comment`
--

INSERT INTO `order_comment` (`commentId`, `orderId`, `status`, `note`, `customerNotified`, `createdAt`) VALUES
(1, 28, 1, 'ddd', 0, '2022-04-05 10:40:19'),
(2, 28, 6, 'tytyt', 1, '2022-04-05 11:03:12'),
(3, 28, 2, 'tytyt', 1, '2022-04-05 11:04:21'),
(4, 28, 3, 'tytyt', 1, '2022-04-05 11:05:38'),
(5, 26, 0, '', 0, '2022-04-05 11:07:27'),
(6, 26, 2, 'gghghghgh', 1, '2022-04-05 11:07:54'),
(7, 26, 0, '', 0, '2022-04-05 11:16:52'),
(8, 26, 0, '', 0, '2022-04-05 11:16:52'),
(9, 27, 0, '', 0, '2022-04-05 11:20:32');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `itemId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `sku` varchar(16) NOT NULL,
  `cost` float DEFAULT NULL,
  `price` float NOT NULL,
  `tax` float NOT NULL,
  `taxAmount` float NOT NULL,
  `discount` float DEFAULT NULL,
  `quantity` int(8) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`itemId`, `orderId`, `productId`, `name`, `sku`, `cost`, `price`, `tax`, `taxAmount`, `discount`, `quantity`, `createdAt`, `updatedAt`) VALUES
(198, 28, 711, 'dom', 'domt', 200, 100, 10, 40, 80, 4, '2022-04-05 00:05:22', '0000-00-00 00:00:00'),
(200, 29, 711, 'dom', 'domt', 200, 100, 10, 70, 140, 7, '2022-04-05 00:08:31', '0000-00-00 00:00:00'),
(201, 30, 711, 'dom', 'domt', 200, 100, 10, 100, 200, 10, '2022-04-05 00:32:06', '0000-00-00 00:00:00'),
(206, 26, 650, 'l', 'jhjhj', 1, 1, 1, 0.01, 0, 1, '2022-04-05 11:16:52', '0000-00-00 00:00:00'),
(207, 26, 711, 'dom', 'domt', 200, 100, 10, 40, 80, 4, '2022-04-05 11:16:52', '0000-00-00 00:00:00'),
(208, 27, 711, 'dom', 'domt', 200, 100, 10, 100, 200, 10, '2022-04-05 11:20:32', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `pageId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(2) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`pageId`, `name`, `code`, `content`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'name1', 'code1', 'content1', 1, '2022-03-11 08:11:17', '2022-03-11 19:38:50'),
(2, 'name2', ' code2', 'content2', 1, '0000-00-00 00:00:00', '2022-03-11 19:38:21'),
(3, 'name3', ' code3', 'content3', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'name4', ' code4', 'content4', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'name5', ' code5', 'content5', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'name6', ' code6', 'content6', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'name7', ' code7', 'content7', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'name8', ' code8', 'content8', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'name9', ' code9', 'content9', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'name11', ' code11', 'content11', 1, '0000-00-00 00:00:00', '2022-03-12 17:12:41'),
(12, 'name12', ' code12', 'content12', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'name13', ' code13', 'content13', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'name14', ' code14', 'content14', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'name15', ' code15', 'content15', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'name16', ' code16', 'content16', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'name17', ' code17', 'content17', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'name18', ' code18', 'content18', 1, '0000-00-00 00:00:00', '2022-03-12 20:03:37'),
(19, 'name19', ' code19', 'content19', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'name22', ' code22', 'content22', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'name23', ' code23', 'content23', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'name24', ' code24', 'content24', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'name25', ' code25', 'content25', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'name26', ' code26', 'content26', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'name27', ' code27', 'content27', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'name28', ' code28', 'content28', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'name29', ' code29', 'content29', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'name30', ' code30', 'content30', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'name31', ' code31', 'content31', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'name32', ' code32', 'content32', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'name33', ' code33', 'content33', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'name34', ' code34', 'content34', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'name35', ' code35', 'content35', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'name36', ' code36', 'content36', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'name37', ' code37', 'content37', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'name38', ' code38', 'content38', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'name39', ' code39', 'content39', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'name40', ' code40', 'content40', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'name41', ' code41', 'content41', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'name42', ' code42', 'content42', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'name43', ' code43', 'content43', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'name44', ' code44', 'content44', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'name45', ' code45', 'content45', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'name46', ' code46', 'content46', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'name47', ' code47', 'content47', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'name48', ' code48', 'content48', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'name49', ' code49', 'content49', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'name50', ' code50', 'content50', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'name51', ' code51', 'content51', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'name53', ' code53', 'content53', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'name54', ' code54', 'content54', 1, '0000-00-00 00:00:00', '2022-03-12 17:13:43'),
(55, 'name55', ' code55', 'content55', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'name56', ' code56', 'content56', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'name57', ' code57', 'content57', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'name58', ' code58', 'content58', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'name59', ' code59', 'content59', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'name61', ' code61', 'content61', 1, '0000-00-00 00:00:00', '2022-03-11 19:35:51'),
(62, 'name62', ' code62', 'content62', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'name63', ' code63', 'content63', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'name64', ' code64', 'content64', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'name65', ' code65', 'content65', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'name66', ' code66', 'content66', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'name67', ' code67', 'content67', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'name68', ' code68', 'content68', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'name69', ' code69', 'content69', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'name70', ' code70', 'content70', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'name71', ' code71', 'content71', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'name72', ' code72', 'content72', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'name73', ' code73', 'content73', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'name74', ' code74', 'content74', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'name75', ' code75', 'content75', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'name76', ' code76', 'content76', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'name77', ' code77', 'content77', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'name78', ' code78', 'content78', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'name79', ' code79', 'content79', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'name80', ' code80', 'content80', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'name81', ' code81', 'content81', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'name82', ' code82', 'content82', 1, '0000-00-00 00:00:00', '2022-03-12 17:13:23'),
(83, 'name83', ' code83', 'content83', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'name84', ' code84', 'content84', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'name85', ' code85', 'content85', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'name86', ' code86', 'content86', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'name87', ' code87', 'content87', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'name88', ' code88', 'content88', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'name89', ' code89', 'content89', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'name90', ' code90', 'content90', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'name91', ' code91', 'content91', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'name92', ' code92', 'content92', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'name93', ' code93', 'content93', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'name94', ' code94', 'content94', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'name95', ' code95', 'content95', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'name96', ' code96', 'content96', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'name97', ' code97', 'content97', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'name98', ' code98', 'content98', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'name99', ' code99', 'content99', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'name100', ' code100', 'content100', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'name101', ' code101', 'content101', 1, '0000-00-00 00:00:00', '2022-03-11 19:37:19'),
(102, 'name102', ' code102', 'content102', 1, '0000-00-00 00:00:00', '2022-03-11 19:37:58'),
(103, 'name103', ' code103', 'content103', 1, '0000-00-00 00:00:00', '2022-03-11 19:38:04'),
(104, 'name104', ' code104', 'content104', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'name105', ' code105', 'content105', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'name106', ' code106', 'content106', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'name107', ' code107', 'content107', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'name108', ' code108', 'content108', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'name109', ' code109', 'content109', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 'name110', ' code110', 'content110', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'name111', ' code111', 'content111', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'name112', ' code112', 'content112', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'name113', ' code113', 'content113', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 'name114', ' code114', 'content114', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'name115', ' code115', 'content115', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'name116', ' code116', 'content116', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'name117', ' code117', 'content117', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'name118', ' code118', 'content118', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 'name119', ' code119', 'content119', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'name120', ' code120', 'content120', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'name121', ' code121', 'content121', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'name122', ' code122', 'content122', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'name123', ' code123', 'content123', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 'name124', ' code124', 'content124', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'name125', ' code125', 'content125', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'name126', ' code126', 'content126', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 'name127', ' code127', 'content127', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 'name128', ' code128', 'content128', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 'name129', ' code129', 'content129', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 'name130', ' code130', 'content130', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 'name131', ' code131', 'content131', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 'name132', ' code132', 'content132', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 'name133', ' code133', 'content133', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 'name134', ' code134', 'content134', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 'name135', ' code135', 'content135', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 'name136', ' code136', 'content136', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 'name137', ' code137', 'content137', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 'name138', ' code138', 'content138', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 'name139', ' code139', 'content139', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 'name140', ' code140', 'content140', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 'name141', ' code141', 'content141', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, 'name142', ' code142', 'content142', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 'name143', ' code143', 'content143', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 'name144', ' code144', 'content144', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 'name145', ' code145', 'content145', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 'name146', ' code146', 'content146', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 'name147', ' code147', 'content147', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 'name148', ' code148', 'content148', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 'name149', ' code149', 'content149', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, 'name150', ' code150', 'content150', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, 'name151', ' code151', 'content151', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 'name152', ' code152', 'content152', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, 'name153', ' code153', 'content153', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, 'name154', ' code154', 'content154', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 'name155', ' code155', 'content155', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(156, 'name156', ' code156', 'content156', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(157, 'name157', ' code157', 'content157', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, 'name158', ' code158', 'content158', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, 'name159', ' code159', 'content159', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 'name160', ' code160', 'content160', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 'name161', ' code161', 'content161', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 'name162', ' code162', 'content162', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 'name163', ' code163', 'content163', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 'name164', ' code164', 'content164', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(165, 'name165', ' code165', 'content165', 1, '0000-00-00 00:00:00', '2022-03-12 22:25:10'),
(166, 'name166', ' code166', 'content166', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(167, 'name167', ' code167', 'content167', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(168, 'name168', ' code168', 'content168', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(169, 'name169', ' code169', 'content169', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(170, 'name170', ' code170', 'content170', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(171, 'name171', ' code171', 'content171', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(172, 'name172', ' code172', 'content172', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(173, 'name173', ' code173', 'content173', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(174, 'name174', ' code174', 'content174', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(175, 'name175', ' code175', 'content175', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(176, 'name176', ' code176', 'content176', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(177, 'name177', ' code177', 'content177', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(178, 'name178', ' code178', 'content178', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(179, 'name179', ' code179', 'content179', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(180, 'name180', ' code180', 'content180', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(181, 'name181', ' code181', 'content181', 1, '0000-00-00 00:00:00', '2022-03-11 13:06:29'),
(182, 'name182', ' code182', 'content182', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(183, 'name183', ' code183', 'content183', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(184, 'name184', ' code184', 'content184', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(185, 'name185', ' code185', 'content185', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(186, 'name186', ' code186', 'content186', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(187, 'name187', ' code187', 'content187', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(188, 'name188', ' code188', 'content188', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(189, 'name189', ' code189', 'content189', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(190, 'name190', ' code190', 'content190', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(191, 'name191', ' code191', 'content191', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(192, 'name192', ' code192', 'content192', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(193, 'name193', ' code193', 'content193', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(219, '', '', '', 1, '2022-03-12 20:03:11', '0000-00-00 00:00:00'),
(220, '', '', '', 1, '2022-03-12 20:03:18', '0000-00-00 00:00:00'),
(221, 'u', 'u', 'u', 1, '2022-03-12 22:24:50', '2022-03-12 22:25:01'),
(222, '', '', '', 1, '2022-03-13 00:18:13', '0000-00-00 00:00:00'),
(224, '', '', '', 1, '2022-03-13 01:02:52', '0000-00-00 00:00:00'),
(225, '', '', '', 2, '2022-03-13 01:03:01', '0000-00-00 00:00:00'),
(226, '', '', '', 1, '2022-03-13 01:03:25', '0000-00-00 00:00:00'),
(227, '', '', '', 1, '2022-03-13 01:04:27', '0000-00-00 00:00:00'),
(229, 'm', 'm', 'm', 2, '2022-03-13 01:06:03', '2022-03-13 01:06:11'),
(230, '', '', '', 1, '2022-03-13 01:42:34', '0000-00-00 00:00:00'),
(232, 'lplp', 'llpl', 'plllp', 2, '2022-03-13 17:43:14', '2022-03-13 17:43:23'),
(233, 'h', 'h', 'h', 1, '2022-03-13 19:13:02', '2022-03-13 19:13:12'),
(234, '', '', '', 1, '2022-03-14 10:00:43', '0000-00-00 00:00:00'),
(235, '', '', '', 1, '2022-03-14 10:00:46', '0000-00-00 00:00:00'),
(236, 'hj', 'jhghg', 'hghgg', 2, '2022-03-14 10:04:21', '0000-00-00 00:00:00'),
(237, '', '', '', 1, '2022-03-14 10:05:33', '2022-03-14 10:05:43'),
(238, '', '', '', 1, '2022-03-14 10:06:11', '2022-03-14 10:06:14'),
(241, 'm', 'm', 'm', 2, '2022-04-01 23:40:31', '0000-00-00 00:00:00'),
(242, 'm', 'm', 'm', 2, '2022-04-01 23:40:32', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod`
--

CREATE TABLE `paymentmethod` (
  `methodId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `note` text NOT NULL,
  `status` tinyint(2) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymentmethod`
--

INSERT INTO `paymentmethod` (`methodId`, `name`, `note`, `status`, `createdAt`, `updatedAt`) VALUES
(4, 'm', 'm', 1, '2022-03-18 14:14:44', '2022-03-18 14:14:44'),
(10, 'u', 'u', 1, '2022-03-18 18:50:07', '0000-00-00 00:00:00'),
(13, 'p', 'p', 2, '2022-03-18 18:58:37', '2022-04-01 22:51:43');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `tax` decimal(10,0) DEFAULT NULL,
  `quantity` int(10) NOT NULL,
  `cost` float NOT NULL,
  `discount` float NOT NULL,
  `discountMode` tinyint(4) NOT NULL,
  `sku` varchar(32) NOT NULL,
  `base` varchar(100) DEFAULT 'No Image',
  `thumb` varchar(100) DEFAULT NULL,
  `small` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `name`, `price`, `tax`, `quantity`, `cost`, `discount`, `discountMode`, `sku`, `base`, `thumb`, `small`, `status`, `createdAt`, `updatedAt`) VALUES
(650, 'l', 1, '1', 1, 1, 0, 2, 'jhjhj', 'No Image', NULL, NULL, 1, '2022-03-12 17:20:32', '2022-04-03 17:23:23'),
(711, 'dom', 100, '10', 100, 200, 20, 2, 'domt', 'No Image', NULL, NULL, 1, '2022-03-15 04:38:07', '2022-04-05 18:27:32'),
(788, 'j', 0, '1', 1, 1, 1, 2, '20mk', 'No Image', NULL, NULL, 1, '2022-04-05 18:51:34', '2022-04-05 18:52:08');

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `imageId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `base` tinyint(2) NOT NULL,
  `thumb` tinyint(2) NOT NULL,
  `small` tinyint(2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `gallery` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_media`
--

INSERT INTO `product_media` (`imageId`, `productId`, `base`, `thumb`, `small`, `image`, `status`, `gallery`) VALUES
(230, 711, 1, 0, 1, '0452022115756-9.PNG', 0, '0'),
(232, 788, 1, 0, 1, '0462022122222-ecom_database.png', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `sales_man`
--

CREATE TABLE `sales_man` (
  `salesmanId` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `percentage` float NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_man`
--

INSERT INTO `sales_man` (`salesmanId`, `firstName`, `lastName`, `email`, `mobile`, `percentage`, `status`, `createdAt`, `updatedAt`) VALUES
(37, 'k', 'k', 'k', '2121', 10, 1, '2022-04-01 15:17:49', '2022-04-05 12:43:02'),
(38, 'k', 'k', 'k', '2121', 10, 1, '2022-04-01 15:17:49', '2022-04-03 16:55:22'),
(39, 'k', 'k', 'k', '2121', 10, 1, '2022-04-01 15:17:49', '2022-04-01 15:17:49'),
(40, 'k', 'k', 'k', '2121', 10, 1, '2022-04-01 15:17:49', '2022-04-01 15:17:49'),
(41, 'k', 'k', 'k', '2121', 10, 1, '2022-04-01 15:17:49', '2022-04-01 15:17:49'),
(50, 'm', 'm', 'm', 'm', 5, 1, '2022-04-03 22:00:27', '2022-04-03 23:14:38'),
(53, 'd', 'c', 'dc', '21212121', 10, 1, '2022-04-03 23:15:24', NULL),
(54, 'p', 'p', 'p', 'p', 10, 1, '2022-04-05 12:43:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shippingmethod`
--

CREATE TABLE `shippingmethod` (
  `methodId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `note` text NOT NULL,
  `status` tinyint(2) NOT NULL,
  `price` float NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shippingmethod`
--

INSERT INTO `shippingmethod` (`methodId`, `name`, `note`, `status`, `price`, `createdAt`, `updatedAt`) VALUES
(5, 'l', 'l', 1, 100, '2022-03-18 18:59:24', '2022-03-19 10:54:37'),
(6, 'njnj', '', 1, 10, '2022-03-19 10:48:36', '2022-03-20 00:00:33'),
(7, 'Express', 'no', 1, 1000, '2022-03-20 11:16:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendorId` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendorId`, `firstName`, `lastName`, `email`, `mobile`, `status`, `createdAt`, `updatedAt`) VALUES
(207, 't', 't', 't', 't', 2, '2022-04-01 21:19:08', '2022-04-02 01:17:03');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_address`
--

CREATE TABLE `vendor_address` (
  `vendorAddressId` int(11) NOT NULL,
  `vendorId` int(11) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `postalCode` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor_address`
--

INSERT INTO `vendor_address` (`vendorAddressId`, `vendorId`, `address`, `postalCode`, `city`, `state`, `country`) VALUES
(105, 207, 't', 'tt', 't', 't', 't');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `paymentMethodId` (`paymentMethodId`),
  ADD KEY `shippingMethodId` (`shippingMethodId`);

--
-- Indexes for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD PRIMARY KEY (`cartAddressId`),
  ADD KEY `cartId` (`cartId`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`itemId`),
  ADD KEY `cartId` (`cartId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `category_media`
--
ALTER TABLE `category_media`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `category_product_ibfk_1` (`categoryId`),
  ADD KEY `category_product_ibfk_2` (`productId`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`configId`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD KEY `customer_ibfk_1` (`salesmanId`);

--
-- Indexes for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `customer_price_ibfk_1` (`customerId`),
  ADD KEY `customer_price_ibfk_2` (`productId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `paymentMethodId` (`paymentMethodId`),
  ADD KEY `shippingMethodId` (`shippingMethodId`);

--
-- Indexes for table `order_address`
--
ALTER TABLE `order_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `order_comment`
--
ALTER TABLE `order_comment`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`itemId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`pageId`);

--
-- Indexes for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  ADD PRIMARY KEY (`methodId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`),
  ADD UNIQUE KEY `sku` (`sku`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `sales_man`
--
ALTER TABLE `sales_man`
  ADD PRIMARY KEY (`salesmanId`);

--
-- Indexes for table `shippingmethod`
--
ALTER TABLE `shippingmethod`
  ADD PRIMARY KEY (`methodId`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendorId`);

--
-- Indexes for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD PRIMARY KEY (`vendorAddressId`),
  ADD KEY `vendor_address_ibfk_1` (`vendorId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=609;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `cart_address`
--
ALTER TABLE `cart_address`
  MODIFY `cartAddressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=369;

--
-- AUTO_INCREMENT for table `category_media`
--
ALTER TABLE `category_media`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=400;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `configId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=525;

--
-- AUTO_INCREMENT for table `customer_price`
--
ALTER TABLE `customer_price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `order_comment`
--
ALTER TABLE `order_comment`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `pageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  MODIFY `methodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=789;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `sales_man`
--
ALTER TABLE `sales_man`
  MODIFY `salesmanId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `shippingmethod`
--
ALTER TABLE `shippingmethod`
  MODIFY `methodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT for table `vendor_address`
--
ALTER TABLE `vendor_address`
  MODIFY `vendorAddressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`paymentMethodId`) REFERENCES `paymentmethod` (`methodId`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`shippingMethodId`) REFERENCES `shippingmethod` (`methodId`);

--
-- Constraints for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD CONSTRAINT `cart_address_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`);

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`),
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`);

--
-- Constraints for table `category_media`
--
ALTER TABLE `category_media`
  ADD CONSTRAINT `category_media_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_product_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`salesmanId`) REFERENCES `sales_man` (`salesmanId`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD CONSTRAINT `customer_price_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_price_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`);

--
-- Constraints for table `order_address`
--
ALTER TABLE `order_address`
  ADD CONSTRAINT `order_address_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`);

--
-- Constraints for table `order_comment`
--
ALTER TABLE `order_comment`
  ADD CONSTRAINT `order_comment_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`);

--
-- Constraints for table `product_media`
--
ALTER TABLE `product_media`
  ADD CONSTRAINT `product_media_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD CONSTRAINT `vendor_address_ibfk_1` FOREIGN KEY (`vendorId`) REFERENCES `vendor` (`vendorId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
