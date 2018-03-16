-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2017 at 02:42 PM
-- Server version: 5.7.11
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `site`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `categ` text,
  `img_path` text,
  `price` int(11) DEFAULT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `categ`, `img_path`, `price`, `stock`) VALUES
(1, '1;21;', 'img/articles/1.png', 50, 50),
(2, '1;21;', 'img/articles/2.png', 50, 50),
(3, '1;21;', 'img/articles/3.png', 50, 50),
(4, '1;22;', 'img/articles/4.png', 100, 50),
(5, '1;22;', 'img/articles/5.png', 125, 50),
(6, '1;23;', 'img/articles/6.png', 200, 50),
(7, '1;25;', 'img/articles/7.png', 225, 50),
(8, '2;21;', 'img/articles/8.png', 50, 50),
(9, '2;21;', 'img/articles/9.png', 50, 50),
(10, '2;22;', 'img/articles/10.png', 100, 50),
(11, '2;22;', 'img/articles/11.png', 100, 50),
(12, '2;23;', 'img/articles/12.png', 200, 50),
(13, '3;21;', 'img/articles/13.png', 50, 50),
(14, '3;21;', 'img/articles/14.png', 50, 50),
(15, '3;21;', 'img/articles/15.png', 100, 50),
(16, '3;22;', 'img/articles/16.png', 150, 50),
(17, '3;22;', 'img/articles/17.png', 175, 50),
(18, '3;23', 'img/articles/18.png', 200, 50),
(19, '4;21', 'img/articles/19.png', 50, 50),
(20, '4;21', 'img/articles/20.png', 50, 50),
(21, '4;22', 'img/articles/21.png', 75, 50),
(22, '4;23', 'img/articles/22.png', 150, 50),
(23, '4;', 'img/articles/23.png', 200, 50),
(24, '4;', 'img/articles/24.png', 200, 50),
(25, '4;', 'img/articles/25.png', 300, 50),
(26, '5;', 'img/articles/26.png', 250, 50),
(27, '5;', 'img/articles/27.png', 10000, 50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
