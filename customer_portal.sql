-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2020 at 11:26 AM
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
-- Database: `customer_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cid` int(11) NOT NULL,
  `prefix` varchar(4) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `dob` date NOT NULL,
  `phone` bigint(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cid`, `prefix`, `fname`, `lname`, `dob`, `phone`, `email`, `password`) VALUES
(17, 'Mr', 'Mihir', 'Chauhan', '2111-03-12', 9876543210, 'abc@gmail.com', 'abc'),
(22, 'Dr', 'Abc', 'Abcd', '1998-01-11', 9876543210, 'abcd@gmail.com', 'abc');

-- --------------------------------------------------------

--
-- Table structure for table `customer_additional_info`
--

CREATE TABLE `customer_additional_info` (
  `oid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `field_key` varchar(50) NOT NULL,
  `value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_additional_info`
--

INSERT INTO `customer_additional_info` (`oid`, `cid`, `field_key`, `value`) VALUES
(97, 17, 'aboutself', 'About Self                                             '),
(98, 17, 'image', ''),
(99, 17, 'certificate', ''),
(100, 17, 'businessyears', '1 to 2'),
(101, 17, 'contactType', 'Post,SMS'),
(102, 17, 'hobbies', 'Listening Music,Reading'),
(127, 22, 'aboutself', 'About Self                                                                                          '),
(128, 22, 'image', ''),
(129, 22, 'certificate', ''),
(130, 22, 'businessyears', '5 to 10'),
(131, 22, 'contactType', 'Post,Email,SMS'),
(132, 22, 'hobbies', 'Listening Music,Reading');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `aid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `addressline1` varchar(50) NOT NULL,
  `addressline2` varchar(50) NOT NULL,
  `companyname` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `postalcode` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`aid`, `cid`, `addressline1`, `addressline2`, `companyname`, `city`, `country`, `postalcode`) VALUES
(17, 17, 'Address 123', 'address 234', 'Cybercom', 'Ahmedabad', 'India', '380008'),
(22, 22, 'Address Line 1', 'address Line 2', 'Cybercom', 'Ahmedabad', 'India', '380008');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `customer_additional_info`
--
ALTER TABLE `customer_additional_info`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `customer_additional_info_ibfk_1` (`cid`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `customer_address_ibfk_1` (`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `customer_additional_info`
--
ALTER TABLE `customer_additional_info`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_additional_info`
--
ALTER TABLE `customer_additional_info`
  ADD CONSTRAINT `customer_additional_info_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `customers` (`cid`) ON DELETE CASCADE;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `customers` (`cid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
