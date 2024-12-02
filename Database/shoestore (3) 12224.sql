-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 02:15 PM
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
(6, 2, 'Pinagsanhan 1b Maragondon Cavite', 'BRGY LOOBAN TAPAT KAMI NG SCHOOL', 'Maragondon', 4112, 6655664, 0),
(7, 12, 'Pinagsanhan 1b Maragondon Cavite', 'Brgy looban street / tapat po kami ng malaking gate', 'Maragondon', 4112, 2147483647, 1);

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
(31, 2, 18, 1, 9);

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
-- Table structure for table `middle_content_status`
--

CREATE TABLE `middle_content_status` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `middle_content_status`
--

INSERT INTO `middle_content_status` (`id`, `status`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `online_transaction`
--

CREATE TABLE `online_transaction` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shoe_id` int(11) NOT NULL,
  `transaction_status` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `total_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `online_transaction`
--

INSERT INTO `online_transaction` (`id`, `customer_id`, `shoe_id`, `transaction_status`, `transaction_id`, `total_amount`) VALUES
(1, 12, 0, 'COMPLETED', '17J930458T984811M', 0),
(2, 12, 0, 'COMPLETED', '97K52158TM049423H', 2500),
(3, 12, 5, 'COMPLETED', '4XX809810K966090D', 2500),
(4, 12, 18, 'COMPLETED', '4XX809810K966090D', 2700);

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `name`, `date_add`) VALUES
(1, 'Order Placed', '2024-11-22 14:33:51'),
(2, 'Seller Preparing your Parcel', '2024-11-22 14:33:51'),
(3, 'Complete Order', '2024-11-22 14:33:51');

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
  `price` double NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shoeproduct`
--

INSERT INTO `shoeproduct` (`id`, `product_name`, `product_description`, `product_img_name`, `brand`, `Category`, `product_color`, `qty`, `price`, `created_at`) VALUES
(5, 'New Balance', 'a white retro looks', 'image-removebg-preview.png', 5, 2, 6, 5, 2500, '2024-11-18'),
(17, 'Airforce 1', 'Airforce 1 for your style', 'af1.jpg', 3, 2, 5, 5, 2800, '2024-11-18'),
(18, 'NB 550', 'Nb brown 550', 'nbBrown550.png', 5, 2, 7, 5, 2700, '2024-11-18'),
(19, 'Nike ZOOM', 'Zoom White Nike', 'zoomwhite.png', 3, 2, 6, 5, 2800, '2024-11-18'),
(20, 'Air Jordan 1', 'Air Jordan Gray Limited', 'airjordangray.png', 6, 3, 8, 5, 2700, '2024-11-18');

-- --------------------------------------------------------

--
-- Table structure for table `shoes_order`
--

CREATE TABLE `shoes_order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shoes_id` int(11) NOT NULL,
  `shoe_size` int(11) NOT NULL,
  `shoe_quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `buyer_address` varchar(255) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT 1,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shoes_order`
--

INSERT INTO `shoes_order` (`order_id`, `user_id`, `shoes_id`, `shoe_size`, `shoe_quantity`, `total_price`, `payment_status`, `buyer_address`, `order_status`, `order_date`) VALUES
(7, 12, 18, 10, 1, 2700, 'COD', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-22 16:06:24'),
(8, 12, 18, 10, 1, 2700, 'COD', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-22 16:08:16'),
(9, 12, 5, 8, 1, 2500, 'COD', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-22 20:33:33'),
(10, 12, 5, 9, 1, 2500, 'COD', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-24 11:32:01'),
(11, 12, 5, 9, 6, 2500, 'COD', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-24 11:32:36'),
(12, 12, 5, 9, 1, 2500, 'COD', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-24 11:32:53'),
(13, 12, 5, 9, 1, 2500, 'COD', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-24 11:32:59'),
(14, 12, 5, 7, 1, 2500, 'COD', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-24 11:33:21'),
(15, 12, 5, 8, 1, 2500, 'Paypal', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 00:44:20'),
(16, 12, 17, 9, 1, 2800, 'Paypal', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 00:44:20'),
(17, 12, 5, 8, 1, 2500, 'Paypal', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 00:48:42'),
(18, 12, 17, 9, 1, 2800, 'Paypal', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 00:48:42'),
(19, 12, 5, 8, 1, 2500, 'Paypal', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 00:49:13'),
(20, 12, 17, 9, 1, 2800, 'Paypal', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 00:49:13'),
(21, 12, 5, 8, 1, 2500, 'Paypal', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 00:49:46'),
(22, 12, 17, 9, 1, 2800, 'Paypal', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 00:49:46'),
(23, 12, 5, 8, 1, 2500, 'Paypal', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 00:50:01'),
(24, 12, 17, 9, 1, 2800, 'Paypal', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 00:50:01'),
(25, 12, 5, 8, 1, 2500, 'Paypal', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 00:52:19'),
(26, 12, 17, 9, 1, 2800, 'Paypal', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 00:52:19'),
(27, 12, 5, 8, 1, 2500, 'Paypal', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 00:53:43'),
(28, 12, 17, 9, 1, 2800, 'Paypal', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 00:53:43'),
(29, 12, 5, 9, 1, 2500, 'Paypal', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 00:54:50'),
(30, 12, 5, 9, 1, 2500, 'Paypal', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 00:55:20'),
(31, 12, 5, 8, 1, 2500, 'Paypal', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 00:55:44'),
(32, 12, 5, 9, 1, 2500, 'Paypal', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 13:42:22'),
(33, 12, 5, 8, 1, 2500, 'Paypal', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 13:52:17'),
(34, 12, 5, 8, 1, 2500, 'Paypal', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 13:54:13'),
(35, 12, 5, 8, 1, 2500, 'Paypal', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 13:58:34'),
(36, 12, 18, 10, 1, 2700, 'Paypal', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 13:58:34'),
(37, 12, 5, 8, 1, 2500, 'COD', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-11-30 18:43:55'),
(38, 12, 5, 8, 1, 2500, 'COD', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-12-02 20:35:33'),
(39, 12, 17, 8, 1, 2800, 'COD', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-12-02 20:35:40'),
(40, 12, 18, 7, 1, 2700, 'COD', 'kevin lee , Pinagsanhan 1b Maragondon Cavite , 41122147483647  Additional Info:Brgy looban street / tapat po kami ng malaking gate', 1, '2024-12-02 20:35:46');

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
-- Table structure for table `tbl_middle_content`
--

CREATE TABLE `tbl_middle_content` (
  `id` int(11) NOT NULL,
  `shoe_name` varchar(255) NOT NULL,
  `btn_text` varchar(255) NOT NULL,
  `btn_url` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_middle_content`
--

INSERT INTO `tbl_middle_content` (`id`, `shoe_name`, `btn_text`, `btn_url`, `photo`) VALUES
(1, 'New Balance', 'Shop Now!', 'product_single.php?prodid=5', 'image-removebg-preview.png'),
(2, 'New Balance 550', 'Shop Now!', 'product_single.php?prodid=18', 'nbBrown550.png'),
(3, 'Nike Zoom', 'Shop Now!', 'product_single.php?prodid=19', 'zoomwhite.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_middle_header`
--

CREATE TABLE `tbl_middle_header` (
  `id` int(11) NOT NULL,
  `header` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_middle_header`
--

INSERT INTO `tbl_middle_header` (`id`, `header`, `content`) VALUES
(1, 'Best Selling of The Month', 'Presenting the best seller shoes of the month');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider2`
--

CREATE TABLE `tbl_slider2` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `btn_text` varchar(255) NOT NULL,
  `button_url` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_slider2`
--

INSERT INTO `tbl_slider2` (`id`, `photo`, `heading`, `content`, `btn_text`, `button_url`, `position`) VALUES
(1, 'slider1.jpg', 'Welcome to DLJPS FOOTWEAR SHOP', 'Shop Online for Latest Branded Shoes', 'Shop Branded Footwear', 'shop.php', 'Center'),
(2, 'slider2.jpg', 'Browse our Products ', 'Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has.', 'Shop now', 'shop.php', 'Center'),
(3, 'customercare.png', '24 Hours Customer Support', 'Contact us right now ', 'Read More', 'contactUs.php', 'Right');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider3`
--

CREATE TABLE `tbl_slider3` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `btn_text` varchar(255) NOT NULL,
  `button_url` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_slider3`
--

INSERT INTO `tbl_slider3` (`id`, `photo`, `heading`, `content`, `btn_text`, `button_url`, `position`) VALUES
(1, 'slider-1.jpg', 'Welcome to Fashionys.com', 'Shop Online for Latest Women Accessories', 'Shop Women Accessories', 'http://fashionys.com/product-category.php?id=4&type=mid-category', 'Center'),
(2, 'slider-2.jpg', '50% Discount on All Products', 'Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has.', 'Read More', '#', 'Center'),
(3, 'slider-3.jpg', '24 Hours Customer Support', 'Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has.', 'Read More', '#', 'Right');

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
(55, 5, 12, 8),
(56, 19, 12, 9),
(57, 18, 12, 10);

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
-- Indexes for table `middle_content_status`
--
ALTER TABLE `middle_content_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_transaction`
--
ALTER TABLE `online_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shoeproduct`
--
ALTER TABLE `shoeproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shoes_order`
--
ALTER TABLE `shoes_order`
  ADD PRIMARY KEY (`order_id`);

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
-- Indexes for table `tbl_middle_content`
--
ALTER TABLE `tbl_middle_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_middle_header`
--
ALTER TABLE `tbl_middle_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slider2`
--
ALTER TABLE `tbl_slider2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slider3`
--
ALTER TABLE `tbl_slider3`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

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
-- AUTO_INCREMENT for table `middle_content_status`
--
ALTER TABLE `middle_content_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `online_transaction`
--
ALTER TABLE `online_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shoeproduct`
--
ALTER TABLE `shoeproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `shoes_order`
--
ALTER TABLE `shoes_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
-- AUTO_INCREMENT for table `tbl_middle_content`
--
ALTER TABLE `tbl_middle_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_middle_header`
--
ALTER TABLE `tbl_middle_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_slider2`
--
ALTER TABLE `tbl_slider2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_slider3`
--
ALTER TABLE `tbl_slider3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
