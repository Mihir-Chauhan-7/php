-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2020 at 07:27 PM
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
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
--

CREATE TABLE `blog_post` (
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(50) NOT NULL,
  `content` varchar(200) NOT NULL,
  `image` varchar(100) NOT NULL,
  `published_at` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL DEFAULT current_timestamp(),
  `updated_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_post`
--

INSERT INTO `blog_post` (`pid`, `uid`, `title`, `url`, `content`, `image`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Title', 'a', 'a', '', '1111-11-11', '2020-02-03 17:13:30', NULL),
(3, 1, 'Title', 'a', 'a', '', '1111-11-11', '2020-02-03 18:27:01', NULL),
(4, 1, 'Title', 'a', 'a', '', '1111-11-11', '2020-02-03 18:27:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `meta_title` varchar(100) NOT NULL,
  `url` varchar(50) NOT NULL,
  `content` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` varchar(50) NOT NULL DEFAULT current_timestamp(),
  `updated_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `parent_id`, `title`, `meta_title`, `url`, `content`, `image`, `created_at`, `updated_at`) VALUES
(3, 1, 'Cat 2', 'cfdfvsd', 'sadsa', 'abdsd', '', '2020-02-03 19:12:25', NULL),
(4, 1, 'Cat 2', 'cfdfvsd', 'sadsa', 'abdsd', '', '2020-02-03 19:12:25', NULL),
(5, 3, 'Title', 'a', 'a', 'a', '', '2020-02-03 19:15:57', NULL),
(6, 3, 'Title', 'a', 'a', 'a', '', '2020-02-03 19:15:57', NULL),
(7, 3, 'Title', 'a', 'a', 'a', '', '2020-02-03 19:16:28', NULL),
(8, 3, 'Title', 'a', 'a', 'a', '', '2020-02-03 19:16:28', NULL),
(9, 3, 'Title', 'a', 'a', 'a', '', '2020-02-03 19:23:37', NULL),
(10, 3, 'Title', 'a', 'a', 'a', '', '2020-02-03 19:23:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

CREATE TABLE `post_category` (
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `prefix` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `mno` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `information` varchar(100) NOT NULL,
  `last_login` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) NOT NULL DEFAULT current_timestamp(),
  `updated_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `prefix`, `fname`, `lname`, `mno`, `email`, `password`, `information`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'Mr', 'Mihir123', 'Chauhan', 123, 'abc@gmail.com', 'abc', 'ac', '07:13:05PM', '2020-02-03 14:55:27', NULL),
(3, 'Mr', 'Mihir', 'abcd', 0, 'abc1@gmail.com', 'a', 'a', '03:06:26PM', '2020-02-03 15:06:05', NULL),
(4, 'Mr', 'Mihir', 'abcd', 0, 'abc1@gmail.com', 'a', 'a', NULL, '2020-02-03 15:06:06', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`pid`,`cid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD CONSTRAINT `blog_post_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE;

--
-- Constraints for table `post_category`
--
ALTER TABLE `post_category`
  ADD CONSTRAINT `post_category_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `blog_post` (`pid`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_category_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `category` (`cid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
