-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2023 at 12:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21319126_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `pid` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 11, 'ritik', 'rk123@gmail.com', '123', 'hello, how are you ?? '),
(3, 11, 'ritik', 'rk123@gmail.com', '123456', 'hii You are a great developer '),
(4, 11, 'ritik', 'rk123@gmail.com', '123456', 'how are you ???'),
(5, 11, 'ritik', 'rk123@gmail.com', '123456', 'hiiii');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `flat` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `total_products` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `placed_on` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `name`, `email`, `number`, `method`, `flat`, `street`, `city`, `country`, `pincode`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(2, 11, 'ritik', 'rk123@gmail.com', '123456', 'cash on delivery', '109', '109, sai kripa', 'raigarh', 'India', '496001', ',item 1(5),item 2(1),item 3(1),item 4(1)', '2042', 'Wed-Sep-2023', 'pending'),
(3, 11, 'ritik', 'rk123@gmail.com', '123456', 'cash on delivery', '123456', '109, sai kripa', 'raigarh', 'India', '496001', ',item 1(5),item 2(1)', '852', 'Wed-Sep-2023', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `product_details` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `product_details`, `image`) VALUES
(7, 'item 1', '120', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, optio odio? Vel veniam omnis perspiciatis unde nam dignissimos laborum quibusdam qui consectetur ipsam ut magnam consequuntur sed harum suscipit doloremque, consequatur blanditiis deleniti', 'shoeNew.jpg'),
(8, 'item 2', '252', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, optio odio? Vel veniam omnis perspiciatis unde nam dignissimos laborum quibusdam qui consectetur ipsam ut magnam consequuntur sed harum suscipit doloremque, consequatur blanditiis deleniti', 'shoeNew.jpg'),
(9, 'item 3', '650', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, optio odio? Vel veniam omnis perspiciatis unde nam dignissimos laborum quibusdam qui consectetur ipsam ut magnam consequuntur sed harum suscipit doloremque, consequatur blanditiis deleniti', 'shoeNew.jpg'),
(10, 'item 4', '540', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, optio odio? Vel veniam omnis perspiciatis unde nam dignissimos laborum quibusdam qui consectetur ipsam ut magnam consequuntur sed harum suscipit doloremque, consequatur blanditiis deleniti', 'shoeNew.jpg'),
(11, 'item 5', '625', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, optio odio? Vel veniam omnis perspiciatis unde nam dignissimos laborum quibusdam qui consectetur ipsam ut magnam consequuntur sed harum suscipit doloremque, consequatur blanditiis deleniti', 'shoeNew.jpg'),
(12, 'item 6', '750', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, optio odio? Vel veniam omnis perspiciatis unde nam dignissimos laborum quibusdam qui consectetur ipsam ut magnam consequuntur sed harum suscipit doloremque, consequatur blanditiis deleniti', 'shoeNew.jpg'),
(13, 'item 7', '800', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, optio odio? Vel veniam omnis perspiciatis unde nam dignissimos laborum quibusdam qui consectetur ipsam ut magnam consequuntur sed harum suscipit doloremque, consequatur blanditiis deleniti', 'shoeNew.jpg'),
(14, 'item 8', '900', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, optio odio? Vel veniam omnis perspiciatis unde nam dignissimos laborum quibusdam qui consectetur ipsam ut magnam consequuntur sed harum suscipit doloremque, consequatur blanditiis deleniti', 'shoeNew.jpg'),
(15, 'item 9', '1000', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, optio odio? Vel veniam omnis perspiciatis unde nam dignissimos laborum quibusdam qui consectetur ipsam ut magnam consequuntur sed harum suscipit doloremque, consequatur blanditiis deleniti', 'shoeNew.jpg'),
(16, 'item 10', '300', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, optio odio? Vel veniam omnis perspiciatis unde nam dignissimos laborum quibusdam qui consectetur ipsam ut magnam consequuntur sed harum suscipit doloremque, consequatur blanditiis deleniti', 'shoeNew.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `number`, `email`, `password`, `user_type`) VALUES
(11, 'ritik yadav', '123', 'rk123@gmail.com', '$2y$10$ONIa69/9zHs5twzG5jCjQOcaywSVGU1L5Aaa6c8FyO8zYYMWluKr.', 'user'),
(12, 'ritik yadav', '123', 'rk@gmail.com', '$2y$10$ZkYmoKkwI1x5oHr7VEOBt.z1CHaidI/wdvITSUVz7HPWGLq6BDOrO', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `pid` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`) VALUES
(7, 11, 7, 'item 1', '120', 'shoeNew.jpg'),
(8, 11, 8, 'item 2', '252', 'shoeNew.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
