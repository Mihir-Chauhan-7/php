-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2020 at 06:25 PM
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
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cid` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `cname` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cid`, `parent_id`, `cname`, `url`, `image`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 'Category 1', 'cat1', '15250.jpg', '1', 'content of Category 1', '2020-02-17 08:25:11', '2020-02-17 08:25:11'),
(2, 1, 'Category 2', 'cat2', '15260.jpg', '1', 'content of Category 2', '2020-02-17 08:27:46', '2020-02-17 10:29:32'),
(3, 2, 'Category 3', 'cat3', '', '1', 'content of Category 3', '2020-02-17 09:39:45', '2020-02-17 09:39:45');

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE `cms_pages` (
  `cm_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(50) NOT NULL,
  `status` int(2) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_pages`
--

INSERT INTO `cms_pages` (`cm_id`, `title`, `url`, `status`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Portfolio Page', 'portfolio', 1, 'content of portfolio', '2020-02-15 08:14:12', '2020-02-15 12:23:14'),
(5, 'About Us', 'about_us', 1, 'Content of About Us', '2020-02-15 12:22:44', '2020-02-15 12:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  `description` varchar(500) NOT NULL,
  `short_description` varchar(50) NOT NULL,
  `price` int(10) NOT NULL,
  `stock` int(10) NOT NULL,
  `sku` int(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `name`, `url`, `image`, `status`, `description`, `short_description`, `price`, `stock`, `sku`, `created_at`, `updated_at`) VALUES
(7, 'Product 1', 'product1', '15260.jpg', 1, 'description of Product 1', 'Product 1', 1000, 12000, 100, '2020-02-17 08:36:50', '2020-02-17 08:36:50'),
(8, 'Product 2', 'product2', '15262.jpg', 1, 'a', 'a', 0, 0, 0, '2020-02-17 12:49:08', '2020-02-17 12:49:08'),
(9, 'Product 3', 'product3', '15276.jpg', 0, 'a', 'a', 0, 0, 0, '2020-02-17 12:49:16', '2020-02-17 12:49:16'),
(12, 'Product 4', 'product4', '15276.jpg', 1, '1', '1', 1, 1, 1, '2020-02-17 12:49:35', '2020-02-17 12:49:35'),
(13, 'Product 5', 'product5', '53712.jpg', 0, '', '', 0, 0, 0, '2020-02-17 12:49:40', '2020-02-17 12:49:40'),
(14, 'Product 6', 'product6', '52323.jpg', 0, '', '', 0, 0, 0, '2020-02-17 12:49:43', '2020-02-17 12:49:43');

-- --------------------------------------------------------

--
-- Table structure for table `products_categories`
--

CREATE TABLE `products_categories` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_categories`
--

INSERT INTO `products_categories` (`id`, `pid`, `cid`) VALUES
(16, 7, 1),
(17, 8, 2),
(18, 9, 1),
(21, 12, 1),
(22, 13, 1),
(23, 14, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`cm_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_categories_ibfk_1` (`pid`),
  ADD KEY `products_categories_ibfk_2` (`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `cm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products_categories`
--
ALTER TABLE `products_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD CONSTRAINT `products_categories_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_categories_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `categories` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
