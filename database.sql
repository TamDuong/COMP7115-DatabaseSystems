-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 12, 2017 at 04:47 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Project1`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE `Comment` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `feed_id` int(11) DEFAULT NULL,
  `comment_text` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Comment`
--

INSERT INTO `Comment` (`comment_id`, `user_id`, `feed_id`, `comment_text`) VALUES
(19, 2, 21, 'jay;kjfda;kdf;akjfa;kdfk;lamc,.zxmv,.zxnv.m,xc m.m.,.mnvzm '),
(26, 1, 22, 'comment for feed 22 from user id 1 which is Tam'),
(30, 2, 22, 'this is a new comment\r\n'),
(31, 2, 22, 'new comment #2\r\n'),
(32, 2, 22, 'new comment #3\r\n'),
(33, 7, 25, 'great'),
(34, 9, 25, 'yay!'),
(35, 10, 25, 'I should be able to delete my own comment as well');

-- --------------------------------------------------------

--
-- Table structure for table `Feed`
--

CREATE TABLE `Feed` (
  `feed_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `feed_text` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Feed`
--

INSERT INTO `Feed` (`feed_id`, `user_id`, `create_date`, `feed_text`) VALUES
(1, 1, '2016-11-07 07:10:02', 'this is the first feed'),
(16, 2, '2016-11-08 08:03:34', 'eeeeee'),
(17, 2, '2016-11-08 08:03:36', 'ffff'),
(18, 2, '2016-11-08 08:03:41', 'gggg'),
(19, 2, '2016-11-08 08:39:28', 'Today i feel very bad. What could I do? Could anybody help me with this? May the god help guide me through my decision!'),
(21, 1, '2016-11-09 04:20:02', 'fnvzmxncvmz nxvznv.mznv nzxnv.z urqupqurqw'),
(22, 3, '2016-11-09 05:27:11', 'Feed 1 from ZG'),
(23, 2, '2016-11-11 01:37:30', ''),
(24, 1, '2016-11-15 18:08:54', 'feed from TamDuong'),
(25, 1, '2016-11-15 18:09:05', 'another one from Tam'),
(28, 10, '2016-11-30 00:25:16', 'Second feed from James!');

-- --------------------------------------------------------

--
-- Table structure for table `FOLLOW`
--

CREATE TABLE `FOLLOW` (
  `follow_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `FOLLOW`
--

INSERT INTO `FOLLOW` (`follow_id`, `user_id`) VALUES
(5, 1),
(4, 1),
(2, 1),
(2, 3),
(3, 2),
(5, 2),
(1, 2),
(2, 7),
(1, 7),
(1, 9),
(1, 10),
(2, 11),
(1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `Love`
--

CREATE TABLE `Love` (
  `love_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `feed_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Love`
--

INSERT INTO `Love` (`love_id`, `user_id`, `feed_id`) VALUES
(2, 2, 21),
(3, 2, 1),
(4, 7, 25),
(5, 9, 25),
(6, 10, 25),
(7, 11, 25);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `user_id` int(11) NOT NULL,
  `password` varchar(30) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`user_id`, `password`, `name`, `email`) VALUES
(1, 'Jesus', 'TamDuong', 'tam@gmail.com'),
(2, 'Jesus2', 'Zamar Go', 'zamarg@gmail.com'),
(3, '1234', 'Z G', 'zg@gmail.com'),
(4, '1111', 'still work', 'test@gmail.com'),
(5, '2222', 'ANOTHER USER', 'au'),
(6, '4444', 'test a', 'ta'),
(7, '1234567', 'John Doe', 'John@gmail.com'),
(8, '1111', 'John Do', 'jd@gmail.com'),
(9, 'timpf', 'Zamar Gooden', 'zamargooden@gmail.com'),
(10, '1234', 'James William', 'Jamesw@gmail.com'),
(11, '1111', 'Duc Ta', 'ducta@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Comment`
--
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `feed_id` (`feed_id`);

--
-- Indexes for table `Feed`
--
ALTER TABLE `Feed`
  ADD PRIMARY KEY (`feed_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `FOLLOW`
--
ALTER TABLE `FOLLOW`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Love`
--
ALTER TABLE `Love`
  ADD PRIMARY KEY (`love_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `feed_id` (`feed_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comment`
--
ALTER TABLE `Comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `Feed`
--
ALTER TABLE `Feed`
  MODIFY `feed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `Love`
--
ALTER TABLE `Love`
  MODIFY `love_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`feed_id`) REFERENCES `feed` (`feed_id`) ON DELETE SET NULL;

--
-- Constraints for table `Feed`
--
ALTER TABLE `Feed`
  ADD CONSTRAINT `feed_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `FOLLOW`
--
ALTER TABLE `FOLLOW`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`);

--
-- Constraints for table `Love`
--
ALTER TABLE `Love`
  ADD CONSTRAINT `love_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `love_ibfk_2` FOREIGN KEY (`feed_id`) REFERENCES `feed` (`feed_id`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
