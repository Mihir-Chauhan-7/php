-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2020 at 11:27 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `shippingAmount` int(8) NOT NULL,
  `shippingId` int(11) NOT NULL,
  `paymentId` int(11) NOT NULL,
  `discount` int(8) NOT NULL,
  `total` int(8) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartId`, `customerId`, `email`, `shippingAmount`, `shippingId`, `paymentId`, `discount`, `total`, `createdAt`) VALUES
(4, 78, 'abcd@gmail.com', 0, 0, 0, 0, 0, '2020-04-04 10:29:44'),
(8, 79, 'cust3@gmail.com', 0, 0, 0, 0, 0, '2020-04-05 20:34:58'),
(9, 81, 'cust5@gmail.com', 0, 0, 0, 0, 0, '2020-04-05 20:35:02'),
(12, 80, 'abcd3@gmail.com', 0, 0, 0, 0, 0, '2020-04-10 12:33:51'),
(20, 1, 'chauhanmihir51@gmail.com', 10, 13, 15, 806, 1751, '2020-04-24 11:15:21'),
(22, 77, 'customer1@gmail.com', 0, 0, 0, 0, 0, '2020-04-24 15:20:40');

-- --------------------------------------------------------

--
-- Table structure for table `cart_address`
--

CREATE TABLE `cart_address` (
  `id` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `line1` varchar(255) NOT NULL,
  `line2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `code` mediumint(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_address`
--

INSERT INTO `cart_address` (`id`, `customerId`, `cartId`, `type`, `line1`, `line2`, `city`, `state`, `country`, `code`) VALUES
(35, 1, 20, 1, 'Address Line 1', 'Address Line 2', 'Ahmedabad', 'Guj', 'India', 123456),
(36, 1, 20, 0, 'abcd', 'abcd', 'ahd', 'guj', 'India', 2131);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `itemId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` tinyint(10) NOT NULL DEFAULT 1,
  `sku` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`itemId`, `cartId`, `productId`, `quantity`, `sku`) VALUES
(96, 20, 1, 1, 'QB1210708'),
(97, 20, 4, 1, 'QB1167575');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `parent_id` int(11) DEFAULT 0,
  `path` varchar(255) NOT NULL,
  `level` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `status`, `parent_id`, `path`, `level`) VALUES
(1, 'Bedroom', 'content of Category 1', 1, 0, '1', 1),
(2, 'Bed', '', 1, 1, '1_2', 2),
(3, 'Nightstand', '', 1, 1, '1_3', 2),
(4, 'Dresser', '', 1, 1, '1_4', 2),
(5, 'Dresser Mirror', '', 1, 1, '1_5', 2),
(6, 'Living Room', '', 1, 0, '6', 1),
(7, 'Sofas', '', 1, 6, '6_7', 2),
(8, 'Loveseats', '', 1, 6, '6_8', 2),
(9, 'Coffee Table', '', 1, 6, '6_9', 2),
(10, 'Chair', '', 1, 6, '6_10', 2),
(11, 'Ottoman', '', 1, 6, '6_11', 2),
(12, 'Sectional', '', 1, 6, '6_12', 2),
(61, 'Kitchen & Dinning', '', 1, 0, '61', 1),
(62, 'Dinning Set', '', 1, 61, '61_62', 2),
(63, 'Dinning Table', '', 1, 61, '61_63', 2),
(64, 'Dinning Chair', '', 1, 61, '61_64', 2);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobileNo` bigint(10) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerId`, `name`, `email`, `mobileNo`, `password`) VALUES
(1, 'Mihir Chauhan', 'chauhanmihir51@gmail.com', 8154835209, 'mihir@12'),
(77, 'Customer 1', 'customer1@gmail.com', 7574545757, 'cust@123'),
(78, 'Customer 2', 'abcd@gmail.com', 8877454765, 'abc'),
(79, 'Customer 3', 'cust3@gmail.com', 7574547658, '1111'),
(80, 'Customer 4', 'abcd3@gmail.com', 7574547444, 'qw'),
(81, 'Customer 6', 'cust5@gmail.com', 9674547658, '12aaa');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `addressId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `type` tinyint(4) DEFAULT 2,
  `line1` varchar(255) NOT NULL,
  `line2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `code` bigint(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`addressId`, `customerId`, `type`, `line1`, `line2`, `city`, `state`, `country`, `code`) VALUES
(16, 79, 0, 'add', 'add2', 'abc', 'abcd', 'India', 12345),
(19, 1, 2, 'Address Line 1', 'Address Line 2', 'Ahmedabad', 'Guj', 'India', 123456),
(20, 1, 1, 'add', 'add2', 'abc', 'abcd', 'India', 12345),
(21, 1, 0, 'abcd', 'abcd', 'ahd', 'guj', 'India', 2131);

-- --------------------------------------------------------

--
-- Table structure for table `customer_group`
--

CREATE TABLE `customer_group` (
  `groupId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sortOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_group`
--

INSERT INTO `customer_group` (`groupId`, `name`, `sortOrder`) VALUES
(4, 'Wholeseller', 3),
(5, 'Retailer', 2),
(6, 'General', 1),
(7, 'Visitor', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `orderId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobileNo` bigint(10) NOT NULL,
  `discount` int(11) NOT NULL,
  `shippingAmount` int(11) NOT NULL,
  `shippingId` int(11) NOT NULL,
  `paymentId` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`orderId`, `customerId`, `status`, `firstName`, `lastName`, `email`, `mobileNo`, `discount`, `shippingAmount`, `shippingId`, `paymentId`, `total`, `createdAt`) VALUES
(14, 1, 0, 'Mihir', 'Chauhan', 'chauhanmihir51@gmail.com', 8154835209, 20, 20, 12, 1, 944, '2020-04-24 05:43:59'),
(15, 1, 0, 'Mihir', 'Chauhan', 'chauhanmihir51@gmail.com', 8154835209, 0, 40, 10, 1, 1287, '2020-04-24 05:44:29'),
(16, 77, 0, 'Customer', '1', 'customer1@gmail.com', 0, 0, 0, 14, 1, 706, '2020-04-24 05:45:40'),
(17, 77, 0, 'Customer', '1', 'customer1@gmail.com', 7574545757, 20, 10, 13, 1, 960, '2020-04-24 09:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

CREATE TABLE `order_address` (
  `order_addressId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `line1` varchar(255) NOT NULL,
  `line2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `code` mediumint(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_address`
--

INSERT INTO `order_address` (`order_addressId`, `orderId`, `customerId`, `type`, `line1`, `line2`, `city`, `state`, `country`, `code`) VALUES
(25, 14, 1, 1, 'add', 'add2', 'abc', 'abcd', 'India', 12345),
(26, 14, 1, 0, 'abcd', 'abcd', 'ahd', 'guj', 'India', 2131),
(27, 15, 1, 1, 'add', 'add2', 'abc', 'abcd', 'India', 12345),
(28, 15, 1, 0, 'abcd', 'abcd', 'ahd', 'guj', 'India', 2131),
(29, 16, 77, 1, 'add', 'add2', 'abc', 'abcd', 'India', 12345),
(30, 16, 77, 0, 'Address Line 1', 'Address Line 2', 'Ahmedabad', 'Guj', 'India', 123456),
(31, 17, 77, 1, 'add', 'add2', 'abc', 'abcd', 'India', 12345),
(32, 17, 77, 0, 'add', 'add2', 'abc', 'abcd', 'India', 12345);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_itemId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_itemId`, `orderId`, `productId`, `name`, `price`, `sku`, `quantity`) VALUES
(18, 14, 4, 'Sommerford Brown Queen Storage Panel Bed', 944, 'QB1167575', 1),
(19, 15, 1, 'Gunmetal Full over Full Bunk Bed', 807, 'QB1210708', 1),
(20, 15, 2, 'Quinden Queen Poster Bed', 480, 'QB1187885', 1),
(21, 16, 3, 'Baxton Studio Lea Modern And Contemporary Dark Grey Fabric Queen Size Storage Platform Bed', 706, 'QB1243977', 1),
(22, 17, 2, 'Quinden Queen Poster Bed', 480, 'QB1187885', 2);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `methodId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`methodId`, `name`, `status`) VALUES
(1, 'Credit Card', 1),
(2, 'Debit Card', 1),
(4, 'Paytm', 1),
(15, 'Cash on Delivery', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `sku` varchar(255) NOT NULL,
  `base_image` int(11) NOT NULL,
  `thumbnail_image` int(11) NOT NULL,
  `small_image` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `stock`, `status`, `sku`, `base_image`, `thumbnail_image`, `small_image`) VALUES
(1, 'Gunmetal Full over Full Bunk Bed', 806.69, 100, 1, 'QB1210708', 2, 15, 1),
(2, 'Quinden Queen Poster Bed', 480.16, 50, 1, 'QB1187885', 0, 16, 0),
(3, 'Baxton Studio Lea Modern And Contemporary Dark Grey Fabric Queen Size Storage Platform Bed', 705.62, 155, 1, 'QB1243977', 0, 17, 0),
(4, 'Sommerford Brown Queen Storage Panel Bed', 944.48, 80, 1, 'QB1167575', 0, 20, 0),
(5, 'Product 5', 1000.00, 100, 1, '2568524', 0, 0, 0),
(6, 'Product 6', 1000.00, 100, 1, '0', 0, 0, 0),
(7, 'Product 7', 1000.00, 100, 1, '0', 0, 0, 0),
(8, 'Product 8', 1000.00, 100, 1, '0', 0, 0, 0),
(9, 'Product 9', 1000.00, 100, 1, '0', 0, 0, 0),
(10, 'Product 10', 1000.00, 100, 1, '0', 0, 0, 0),
(11, 'Product 11', 1000.00, 100, 1, '0', 0, 0, 0),
(12, 'Product 12', 1000.00, 100, 1, '0', 0, 0, 0),
(13, 'Product 13', 1000.00, 100, 1, '0', 0, 0, 0),
(14, 'Product 14', 1000.00, 100, 1, '0', 0, 0, 0),
(15, 'Product 15', 1000.00, 100, 1, '0', 0, 0, 0),
(16, 'Product 16', 1000.00, 100, 1, '0', 0, 0, 0),
(17, 'Product 17', 1000.00, 100, 1, '0', 0, 0, 0),
(44, 'Product 18', 1000.00, 10, 1, '10', 0, 0, 0),
(45, 'Product 19', 500.00, 40, 1, '110cd', 0, 0, 0),
(46, 'Product 20', 4000.00, 4, 1, '44', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `productId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`productId`, `categoryId`, `id`) VALUES
(7, 8, 18),
(8, 2, 20),
(9, 7, 21),
(10, 9, 22),
(12, 12, 24),
(15, 5, 27),
(16, 4, 28),
(11, 3, 34),
(5, 2, 64),
(4, 1, 94),
(1, 1, 95),
(2, 1, 96),
(3, 1, 97),
(44, 61, 100),
(45, 62, 101),
(46, 64, 102);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `imageId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `exclude` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`imageId`, `productId`, `name`, `exclude`) VALUES
(3, 2, 'loveseats.jpeg', 0),
(15, 1, '460078_1.jpg', 0),
(16, 2, 'b246-68-66-98_1.jpg', 0),
(17, 3, 'BBT6572-Dark_Grey-Queen-Storage_Bed-8.jpg', 0),
(20, 4, 'b775-78-76s-99s.webp', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shipment_method`
--

CREATE TABLE `shipment_method` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipment_method`
--

INSERT INTO `shipment_method` (`id`, `name`, `amount`, `status`) VALUES
(10, '1 Day', 40, 1),
(12, '3-5 Day', 20, 1),
(13, '7 Days', 10, 1),
(14, '10 Days', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `cart_ibfk_3` (`customerId`);

--
-- Indexes for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_address_ibfk_2` (`cartId`),
  ADD KEY `cart_address_ibfk_1` (`customerId`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`itemId`),
  ADD KEY `cartId` (`cartId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `customer_address_ibfk_1` (`customerId`);

--
-- Indexes for table `customer_group`
--
ALTER TABLE `customer_group`
  ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `shippingId` (`shippingId`),
  ADD KEY `customer_order_ibfk_3` (`paymentId`);

--
-- Indexes for table `order_address`
--
ALTER TABLE `order_address`
  ADD PRIMARY KEY (`order_addressId`),
  ADD KEY `order_address_ibfk_1` (`customerId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_itemId`),
  ADD KEY `order_item_ibfk_1` (`orderId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`methodId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_categories_ibfk_1` (`categoryId`),
  ADD KEY `product_categories_ibfk_2` (`productId`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `shipment_method`
--
ALTER TABLE `shipment_method`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `cart_address`
--
ALTER TABLE `cart_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `customer_group`
--
ALTER TABLE `customer_group`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `order_addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `methodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `shipment_method`
--
ALTER TABLE `shipment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`customerId`) REFERENCES `customers` (`customerId`) ON DELETE CASCADE;

--
-- Constraints for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD CONSTRAINT `cart_address_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customers` (`customerId`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_address_ibfk_2` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customers` (`customerId`) ON DELETE CASCADE;

--
-- Constraints for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `customer_order_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customers` (`customerId`) ON DELETE NO ACTION,
  ADD CONSTRAINT `customer_order_ibfk_2` FOREIGN KEY (`shippingId`) REFERENCES `shipment_method` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `customer_order_ibfk_3` FOREIGN KEY (`paymentId`) REFERENCES `payment_method` (`methodId`) ON DELETE NO ACTION;

--
-- Constraints for table `order_address`
--
ALTER TABLE `order_address`
  ADD CONSTRAINT `order_address_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customers` (`customerId`) ON DELETE NO ACTION,
  ADD CONSTRAINT `order_address_ibfk_2` FOREIGN KEY (`orderId`) REFERENCES `customer_order` (`orderId`) ON DELETE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `customer_order` (`orderId`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `product_categories_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_categories_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
