-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2022 at 01:38 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clothexchange`
--

-- --------------------------------------------------------

--
-- Table structure for table `exchangeform`
--

CREATE TABLE `exchangeform` (
  `exchange_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(12) NOT NULL,
  `city` varchar(200) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `pick_date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(200) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exchangeform`
--

INSERT INTO `exchangeform` (`exchange_id`, `user_id`, `prod_id`, `address`, `phone`, `city`, `zip_code`, `pick_date`, `status`) VALUES
(21, 10, 10, '106/D Suman Shruti society', '06355121278', 'Surat city', 394210, '2022-09-22', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `ord`
--

CREATE TABLE `ord` (
  `oid` int(10) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `exchange` float DEFAULT NULL,
  `des` text NOT NULL,
  `pic` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `name`, `exchange`, `des`, `pic`) VALUES
(4, 'shrit 2', 6, 'nice shirt', 'media/product_img/IMG-632c1db75e18e5.39071652.img1.jpg'),
(5, 'pent 1', 3, 'very good', 'media/product_img/IMG-632c1deaea5198.83386019.img3.jpg'),
(6, 'girl dress', 3, 'nice dress', 'media/product_img/IMG-632c1e19c969c7.94816785.img2.jpg'),
(8, 'pent 2', 6, 'very good', 'media/product_img/IMG-632c23ef781af0.89125319.images (8).jpg'),
(9, 'pent 3', 3, 'nice pent', 'media/product_img/IMG-632c2407961775.26022634.images (6).jpg'),
(10, 'girl dress 2', 6, 'very beautiful ', 'media/product_img/IMG-632c24491951b1.63915151.images.jpg'),
(11, 'new shirt', 3, 'very good', 'media/product_img/IMG-632c248e9bab68.98371776.download.jpg'),
(12, 'girl dress 3', 3, 'very good', 'media/product_img/IMG-632c24a372b211.90388336.images (1).jpg'),
(13, 't -shirt ', 3, 'very beautiful ', 'media/product_img/IMG-632c24bceb97e0.65941677.images (3).jpg'),
(14, 'new t-shirt', 3, 'nice dress', 'media/product_img/IMG-632c251e9e7c51.74008776.images (5).jpg'),
(15, 'branded pent', 6, 'nice pent', 'media/product_img/IMG-632c257f09b811.14467577.images (9).jpg'),
(16, 'girl dress 4', 3, 'very beautiful ', 'media/product_img/IMG-632c25bddb6925.70434695.images (10).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `gender`, `password`, `is_admin`) VALUES
(6, 'admin', 'admin', 'admin@gmail.com', 'male', 'admin', 1),
(10, 'anuj', 'rathore', 'ajrathore@gmail.com', 'male', '123', 0),
(9, 'pratham', 'r', 'pratham@gmail.com', 'male', '123', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exchangeform`
--
ALTER TABLE `exchangeform`
  ADD PRIMARY KEY (`exchange_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `ord`
--
ALTER TABLE `ord`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `ord_ibfk_1` (`uid`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exchangeform`
--
ALTER TABLE `exchangeform`
  MODIFY `exchange_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exchangeform`
--
ALTER TABLE `exchangeform`
  ADD CONSTRAINT `exchangeform_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exchangeform_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `product` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ord`
--
ALTER TABLE `ord`
  ADD CONSTRAINT `ord_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `product` (`pid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
