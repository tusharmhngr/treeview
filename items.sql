-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 05, 2019 at 09:10 PM
-- Server version: 5.7.25-0ubuntu0.16.04.2
-- PHP Version: 7.1.25-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thoughti`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `parent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `title`, `parent`) VALUES
(1, 'ITEM 1', 'ITEM 1', NULL),
(2, 'ITEM 1.1', 'ITEM 1.1', 1),
(3, 'ITEM 1.2', 'ITEM 1.2', 1),
(4, 'ITEM 2', 'ITEM 2', NULL),
(5, 'ITEM 3', 'ITEM 3', NULL),
(6, 'ITEM 3.1', 'ITEM 3.1', 5),
(7, 'ITEM 3.2', 'ITEM 3.2', 5),
(8, 'ITEM 3.2.1', 'ITEM 3.2.1', 7),
(9, 'ITEM 3.2.2', 'ITEM 3.2.2', 7),
(10, 'node', 'node', 9),
(11, 'node', 'node', 10),
(12, 'node', 'node', 11),
(13, 'node', 'node', 12),
(14, 'node', 'node', 13),
(15, 'node', 'node', 14),
(16, 'node', 'node', 15),
(17, 'node', 'node', 14),
(18, 'node', 'node', 10),
(19, 'node', 'node', 14),
(20, 'node', 'node', 14),
(21, 'node', 'node', 16),
(22, 'node', 'node', 18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
