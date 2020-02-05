-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2020 at 02:46 PM
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
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_post`
--

INSERT INTO `blog_post` (`pid`, `uid`, `title`, `url`, `content`, `image`, `published_at`, `created_at`, `updated_at`) VALUES
(41, 3, 'Post 1', 'post1', 'post', '', '2020-02-05', '2020-02-05 14:06:08', NULL),
(42, 3, 'Title', 'post4', 'post', '', '1212-12-12', '2020-02-05 14:08:59', NULL),
(43, 3, 'Post 1', 'p', 'abc', '', '2121-05-11', '2020-02-05 14:14:00', NULL);

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
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `parent_id`, `title`, `meta_title`, `url`, `content`, `image`, `created_at`, `updated_at`) VALUES
(17, 18, 'Cat 1', 'Category 1', 'cat1', 'content for cat 1', 'http://localhost/Cybercom/php/Exam/uploads/15260.jpg', '2020-02-04 10:57:08', '2020-02-05 08:49:39'),
(18, 17, 'Cat 2', 'abc', 'cat2', 'content', 'http://localhost/Cybercom/php/Exam/uploads/53703.jpg', '2020-02-04 10:57:28', '2020-02-04 12:06:41'),
(19, 18, 'Cat 3', 'abc', 'cat3', 'content', 'http://localhost/Cybercom/php/Exam/uploads/15262.jpg', '2020-02-04 10:57:43', '2020-02-04 12:06:48'),
(21, 19, 'Cat 7', 'abc', 'cat7', 'a', 'http://localhost/Cybercom/php/Exam/uploads/36880.jpg', '2020-02-04 16:12:11', '2020-02-04 12:06:57'),
(22, 22, 'Cat 6', 'abc', 'cat6', 'abcd', 'http://localhost/Cybercom/php/Exam/uploads/15250.jpg', '2020-02-04 16:15:12', '2020-02-05 08:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

CREATE TABLE `post_category` (
  `pcid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_category`
--

INSERT INTO `post_category` (`pcid`, `pid`, `cid`) VALUES
(31, 43, 17),
(32, 43, 19);

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
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `prefix`, `fname`, `lname`, `mno`, `email`, `password`, `information`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'Mr', 'Mihir123', 'Chauhan', 123, 'abc@gmail.com', 'abc', '', '01:41:16PM', '2020-02-04 10:59:42', NULL),
(2, 'Mr', 'Mihir', 'Chauhan', 123, 'abc4@gmail.com', '900150983cd24fb0d6963f7d28e17f72', '', '01:50:50PM', '2020-02-04 13:34:14', NULL),
(3, 'Mr', 'Mihir', 'Chauhan', 123, 'chauhanmihir51@gmail.com', 'c56887a00f007b90856e362a9ae8e08c', 'abcd', '2020-02-05 02:34:40PM', '2020-02-04 13:45:53', '2020-02-05 09:04:40');

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
  ADD PRIMARY KEY (`pcid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `pid` (`pid`);

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
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `post_category`
--
ALTER TABLE `post_category`
  MODIFY `pcid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  ADD CONSTRAINT `post_category_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `category` (`cid`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_category_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `blog_post` (`pid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
