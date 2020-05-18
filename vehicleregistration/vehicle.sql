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
-- Database: `vehicle`
--

-- --------------------------------------------------------

--
-- Table structure for table `service_registrations`
--

CREATE TABLE `service_registrations` (
  `service_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `vehicle_no` varchar(15) NOT NULL,
  `licence_no` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `time_slot` varchar(20) NOT NULL,
  `issue` varchar(200) NOT NULL,
  `service_center` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_registrations`
--

INSERT INTO `service_registrations` (`service_id`, `user_id`, `title`, `vehicle_no`, `licence_no`, `date`, `time_slot`, `issue`, `service_center`, `status`, `created_at`, `update_at`) VALUES
(1, 1, 'Title', '123', '1234', '2020-12-10', '1', 'abc', 3, 0, '2020-02-21 10:45:23', '2020-02-24 06:12:49'),
(3, 1, 'Title1', '123456', 'ewe2', '2020-12-10', '1', '', 1, 0, '2020-02-21 10:59:52', '2020-02-24 06:16:37'),
(5, 1, 'Title', '1234', '12345', '2020-12-10', '2', '', 3, 0, '2020-02-21 11:01:18', '2020-02-24 06:16:13'),
(6, 1, 'Title', '1234', '12345', '2020-12-10', '2', '', 3, 1, '2020-02-21 11:01:28', '2020-02-24 06:14:30'),
(7, 1, 'Title', 'a', '', '2020-12-10', '2', '', 1, 0, '2020-02-21 11:01:30', '2020-02-24 06:07:38'),
(8, 1, 'abc', '1234', '12344', '2020-02-22', '1', 'abc', 1, 0, '2020-02-21 12:12:02', '2020-02-24 06:07:38'),
(13, 1, 'Title', '123', '21', '2020-02-22', '1', 'abc', 3, 1, '2020-02-21 12:38:00', '2020-02-24 06:07:58'),
(16, 1, 'Title', '123', '2131', '2020-02-23', '1', '', 3, 0, '2020-02-21 13:10:48', '2020-02-24 06:07:39'),
(17, 1, 'a', '123', '1234', '2020-02-29', '1', '1', 1, 1, '2020-02-21 13:22:18', '2020-02-24 06:07:58'),
(18, 1, 'Title', '123', '123', '2020-02-23', '1', '', 1, 0, '2020-02-22 07:07:58', '2020-02-24 06:07:39'),
(19, 40, 'abc', '123', '12', '2020-04-30', '1', 'abc', 2, 0, '2020-04-29 07:25:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `contact` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `email`, `password`, `contact`) VALUES
(1, 'abc1', 'abcd1', 'abc@gmail.com', 'abc', 123456),
(18, 'Abc', 'Abcd', 'abc@gmail.com', 'abc', 123456),
(38, 'Abc', 'abcd', 'abc@gmail.com', 'abc', 12334567890),
(40, 'Mihir', 'Chauhan123', 'abcd@gmail.com', 'abcd', 54);

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zipcode` bigint(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`address_id`, `user_id`, `street`, `city`, `country`, `state`, `zipcode`) VALUES
(11, 40, 'Address Line 1, Address Line 2', 'Ahmedabad', 'India', 'Guj', 123456);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `service_registrations`
--
ALTER TABLE `service_registrations`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `service_registrations`
--
ALTER TABLE `service_registrations`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `service_registrations`
--
ALTER TABLE `service_registrations`
  ADD CONSTRAINT `service_registrations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
