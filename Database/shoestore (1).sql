-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2024 at 03:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoestore`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `brgy_street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `mobile_no` int(11) NOT NULL,
  `default` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `user_id`, `address`, `brgy_street`, `city`, `zipcode`, `mobile_no`, `default`) VALUES
(2, 2, 'Maragondonedit', 'brgy looban street', 'edietdiet', 4112, 2147483647, 0),
(3, 2, 'Pinagsanhanedit', 'brgy looban street sad 2edit', 'Cavite', 4112, 11122, 1),
(6, 2, 'Pinagsanhan 1b Maragondon Cavite', 'BRGY LOOBAN TAPAT KAMI NG SCHOOL', 'Maragondon', 4112, 6655664, 0);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brandName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brandName`) VALUES
(3, 'Nike'),
(4, 'Addidas'),
(5, 'New Balance'),
(6, 'Jordan');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity_cart` int(11) NOT NULL DEFAULT 1,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity_cart`, `size`) VALUES
(25, 2, 17, 1, 10),
(30, 2, 5, 1, 9),
(31, 2, 18, 1, 9),
(55, 12, 5, 4, 8);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(2, 'Mid top'),
(3, 'High top'),
(4, 'Low top');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`id`, `color`) VALUES
(3, 'Green'),
(4, 'Black'),
(5, 'Blue'),
(6, 'White'),
(7, 'Brown'),
(8, 'Gray');

-- --------------------------------------------------------

--
-- Table structure for table `shoeproduct`
--

CREATE TABLE `shoeproduct` (
  `id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_description` text NOT NULL,
  `product_img_name` varchar(255) NOT NULL,
  `brand` mediumint(50) NOT NULL,
  `Category` mediumint(50) NOT NULL,
  `product_color` mediumint(50) NOT NULL,
  `qty` mediumint(100) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shoeproduct`
--

INSERT INTO `shoeproduct` (`id`, `product_name`, `product_description`, `product_img_name`, `brand`, `Category`, `product_color`, `qty`, `price`) VALUES
(5, 'New Balance', 'a white retro looks', 'image-removebg-preview.png', 5, 2, 6, 5, 2500),
(17, 'Airforce 1', 'Airforce 1 for your style', 'af1.jpg', 3, 2, 5, 5, 2800),
(18, 'NB 550', 'Nb brown 550', 'nbBrown550.png', 5, 2, 7, 5, 2700),
(19, 'Nike ZOOM', 'Zoom White Nike', 'zoomwhite.png', 3, 2, 6, 5, 2800),
(20, 'Air Jordan 1', 'Air Jordan Gray Limited', 'airjordangray.png', 6, 3, 8, 5, 2700);

-- --------------------------------------------------------

--
-- Table structure for table `shoe_stocks`
--

CREATE TABLE `shoe_stocks` (
  `id` int(11) NOT NULL,
  `shoe_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `shoes_stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shoe_stocks`
--

INSERT INTO `shoe_stocks` (`id`, `shoe_id`, `size_id`, `shoes_stock`) VALUES
(1, 5, 1, 5),
(2, 5, 2, 4),
(3, 5, 3, 6),
(4, 5, 4, 8);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`) VALUES
(1, 7),
(2, 8),
(3, 9),
(4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `created_at` datetime NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact_num` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `pwd`, `email`, `contact_num`, `created_at`) VALUES
(12, 'kevin', 'lee', '$2y$10$nq0j7RPvNbMJ3EilM5EHlO2AYcr3udj98xg8IGtdOEbsscP.zuIue', 'kevin@gmail.com', '09954846057', '2024-11-15 17:45:56'),
(13, 'keirck', 'leysico', '$2y$10$7JOCUHoL25QbsLF/Iu3qO.G5phJGiCPGbZtoJcvTtEVU1jQz8qmBa', 'keirck@gmail.com', '09954846057', '2024-11-15 17:46:59');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `product_id`, `userid`, `size`) VALUES
(47, 5, 2, 8),
(48, 17, 2, 8),
(53, 17, 12, 8),
(54, 18, 12, 8),
(55, 5, 12, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shoeproduct`
--
ALTER TABLE `shoeproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shoe_stocks`
--
ALTER TABLE `shoe_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shoeproduct`
--
ALTER TABLE `shoeproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `shoe_stocks`
--
ALTER TABLE `shoe_stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
