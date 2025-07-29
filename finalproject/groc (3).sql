-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2024 at 12:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `groc`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(5) DEFAULT NULL,
  `product_id` int(5) DEFAULT NULL,
  `quantity` int(6) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `order_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `product_id`, `quantity`, `status`, `order_id`) VALUES
(9, 17, 7, 1, 50),
(9, 18, 8, 1, 50),
(10, 6, 5, 1, 51),
(10, 7, 6, 1, 51),
(10, 25, 7, 1, 51),
(16, 22, 10, 1, 52),
(16, 24, 8, 1, 52),
(9, 8, 2, 1, 53),
(9, 11, 5, 1, 54),
(9, 12, 2, 1, 56),
(9, 8, 4, 1, 58),
(9, 6, 5, 1, 59),
(9, 7, 10, 1, 60),
(9, 25, 1, 1, 61),
(9, 24, 3, 1, 62),
(9, 15, 10, 1, 63),
(9, 8, 1, 1, 64),
(9, 7, 6, 1, 65),
(9, 15, 5, 1, 66),
(9, 16, 10, 1, 67),
(9, 15, 5, 1, 68),
(9, 18, 5, 1, 68),
(9, 19, 5, 1, 68),
(9, 22, 8, 1, 68),
(9, 15, 5, 1, 68),
(9, 6, 5, 1, 69);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(5) NOT NULL,
  `category_name` varchar(25) DEFAULT NULL,
  `image_url` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `image_url`) VALUES
(4, 'Vegetables', 'Uploads/Categories/Vegetable.jpg'),
(5, 'Fruits', 'Uploads/Categories/Fruit.jpg'),
(6, 'Dairy Products', 'Uploads/Categories/Diary.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(5) NOT NULL,
  `customer_id` int(5) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `product_id` int(5) DEFAULT NULL,
  `address_id` int(5) DEFAULT NULL,
  `delivery_person_id` int(5) DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `total_price` float NOT NULL,
  `selected_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `date_time`, `product_id`, `address_id`, `delivery_person_id`, `delivery_date`, `status`, `total_price`, `selected_status`) VALUES
(50, 9, '2024-06-25 19:11:59', NULL, 8, 14, '2024-06-27 12:09:13', 1, 4395, 1),
(51, 10, '2024-06-25 19:14:06', NULL, 9, 18, '2024-06-25 19:36:33', 1, 652, 1),
(52, 16, '2024-06-25 19:15:36', NULL, 39, 17, '2024-06-25 19:24:05', 1, 1360, 1),
(53, 9, '2024-06-25 19:17:06', NULL, 43, 17, '2024-06-27 12:09:13', 1, 140, 1),
(54, 9, '2024-06-25 19:28:26', NULL, 8, 14, '2024-06-27 12:09:13', 1, 135, 1),
(56, 9, '2024-06-25 19:46:30', NULL, 43, 17, '2024-06-27 12:29:21', 1, 90, 1),
(58, 9, '2024-06-25 20:07:36', NULL, 43, 17, '2024-06-27 12:29:34', 1, 280, 1),
(59, 9, '2024-06-25 20:10:51', NULL, 8, 18, '2024-06-27 12:09:13', 1, 150, 1),
(60, 9, '2024-06-26 21:09:13', NULL, 41, 18, '2024-06-27 12:09:13', 1, 300, 1),
(61, 9, '2024-06-26 21:17:50', NULL, 8, 14, '2024-06-27 12:09:13', 1, 46, 1),
(62, 9, '2024-06-26 21:19:25', NULL, 8, 14, '2024-06-27 12:09:13', 1, 210, 1),
(63, 9, '2024-06-26 21:23:09', NULL, 8, 14, '2024-06-27 12:23:37', 1, 1400, 1),
(64, 9, '2024-06-26 21:25:28', NULL, 8, 14, '2024-06-27 12:24:24', 1, 70, 1),
(65, 9, '2024-06-27 12:25:11', NULL, 8, 14, '2024-06-27 21:30:38', 1, 180, 1),
(66, 9, '2024-06-27 12:25:51', NULL, 43, 17, NULL, 0, 700, 1),
(67, 9, '2024-06-27 12:27:03', NULL, 45, 14, '2024-06-27 13:20:39', 1, 350, 1),
(68, 9, '2024-06-28 00:19:03', NULL, 8, 14, NULL, 0, 2890, 1),
(69, 9, '2024-06-28 00:19:24', NULL, 45, 14, '2024-06-28 00:20:57', 1, 150, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(5) NOT NULL,
  `product_name` varchar(30) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock_quantity` int(5) DEFAULT NULL,
  `image_url` varchar(80) DEFAULT NULL,
  `category_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `price`, `stock_quantity`, `image_url`, `category_id`) VALUES
(6, 'Tomato', 30.00, 200, 'Uploads/Products/Tomato.jpg', 4),
(7, 'Potato', 30.00, 200, 'Uploads/Products/Potato.jpg', 4),
(8, 'Amul Paneer', 70.00, 50, 'Uploads/Products/Paneer.jpg', 6),
(10, 'Amul Buttermilk', 27.00, 50, 'Uploads/Products/Buttermilk.jpg', 6),
(11, 'Amul Taaza Milky Milk', 27.00, 50, 'Uploads/Products/Milk.jpg', 6),
(12, 'Gokul Dahi', 45.00, 50, 'Uploads/Products/Dahi.jpg', 6),
(13, 'Amul Cow Ghee', 308.00, 50, 'Uploads/Products/Ghee.jpg', 6),
(14, 'BK bread', 45.00, 30, 'Uploads/Products/Bread.jpg', 6),
(15, 'Apple', 140.00, 50, 'Uploads/Products/Apple.jpg', 5),
(16, 'Banana', 35.00, 50, 'Uploads/Products/Banana.jpg', 5),
(17, 'Cherry', 395.00, 25, 'Uploads/Products/Cherry.jpg', 5),
(18, 'Dragon Fruit', 90.00, 70, 'Uploads/Products/Dragonfruit.jpg', 5),
(19, 'Guava', 80.00, 60, 'Uploads/Products/Guava.jpg', 5),
(20, 'Kiwi', 200.00, 20, 'Uploads/Products/Kiwi.jpg', 5),
(21, 'Kesar Mango', 160.00, 20, 'Uploads/Products/Mango.jpg', 5),
(22, 'Pineapple', 80.00, 20, 'Uploads/Products/Pineapple.jpg', 5),
(23, 'Strawberry', 99.00, 25, 'Uploads/Products/Strawberry.jpg', 5),
(24, 'Watermelon', 70.00, 38, 'Uploads/Products/Watermelon.jpg', 5),
(25, 'BottleGourd', 46.00, 40, 'Uploads/Products/Bottlegourd.jpg', 4),
(26, 'Brinjal', 56.00, 50, 'Uploads/Products/Brinjay.jpg', 4),
(27, 'Cabbage', 21.00, 45, 'Uploads/Products/Cabbage.jpg', 4),
(28, 'Capsicum', 28.00, 35, 'Uploads/Products/Capsicum.jpg', 4),
(29, 'Carrot', 79.00, 40, 'Uploads/Products/Carrot.jpg', 4),
(30, 'Raddish', 69.00, 35, 'Uploads/Products/Radish.jpg', 4),
(32, 'Ginger', 110.00, 65, 'Uploads/Products/ginger.jpeg', 4),
(33, 'Garlic', 240.00, 80, 'Uploads/Products/garlic.jpeg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_address`
--

CREATE TABLE `shipping_address` (
  `address_id` int(5) NOT NULL,
  `user_id` int(5) DEFAULT NULL,
  `address` varchar(70) DEFAULT NULL,
  `state` varchar(25) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `address_name` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping_address`
--

INSERT INTO `shipping_address` (`address_id`, `user_id`, `address`, `state`, `city`, `address_name`) VALUES
(8, 9, 'a-302,saffron,binori residency , anandnagar', 'Gujarat', 'ahmedabad', NULL),
(9, 10, 'vastral', 'Gujarat', 'ahmedabad', 'home'),
(38, 14, 'a-302,sachin tower', 'gujarat', 'ahmedabad', 'home'),
(39, 16, '405,shivam app. , malad', 'maharashtra', 'mumbai', 'home'),
(40, 17, '504,binori society , malad', 'maharashtra', 'mumbai', 'home'),
(41, 9, '302, sachin tower, anandnagar', 'gujarat', 'ahmedabad', 'home'),
(42, 18, 'samrudhi app ', 'gujarat', 'ahmedabad', 'home'),
(43, 9, 'new lane , malad', 'maharashtra', 'mumbai', NULL),
(44, 19, 'a-2,Jalkon flat,vastrapur', 'gujarat', 'ahmedabad', 'home'),
(45, 9, '19,pushpakunj society,vastral', 'gujarat', 'ahmedabad', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(5) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` longtext DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone_number` varchar(10) DEFAULT NULL,
  `role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `phone_number`, `role`) VALUES
(8, 'Aman', '$2y$10$Cfv7voUeg7TeT/C0QAUu0ufQPt3Lj039dy9k5syq7RJrd1Cszgxpm', 'amanmistri@gmail.com', '8766458745', 'Admin'),
(9, 'Gautam', '$2y$10$GF.W800P1YhsrIEduyMc8uch.7hwF.raH9PdmBDJKke0eBukjmeUW', 'gautam@gmail.com', '8153935673', 'customer'),
(10, 'Darshan', '$2y$10$Cfv7voUeg7TeT/C0QAUu0ufQPt3Lj039dy9k5syq7RJrd1Cszgxpm', 'darshan@gmail.com', '8767985699', 'customer'),
(14, 'hiren', '$2y$10$GF.W800P1YhsrIEduyMc8uch.7hwF.raH9PdmBDJKke0eBukjmeUW', 'hiren@gmail.com', '815393589', 'delivery'),
(16, 'ruchita', '$2y$10$Cfv7voUeg7TeT/C0QAUu0ufQPt3Lj039dy9k5syq7RJrd1Cszgxpm', 'ruchita@gmail.com', '8159035673', 'customer'),
(17, 'krish', '$2y$10$GF.W800P1YhsrIEduyMc8uch.7hwF.raH9PdmBDJKke0eBukjmeUW', 'krish@gmail.com', '8965335673', 'delivery'),
(18, 'Raj', '$2y$10$Cfv7voUeg7TeT/C0QAUu0ufQPt3Lj039dy9k5syq7RJrd1Cszgxpm', 'raj@gmail.com', '9867454312', 'delivery'),
(19, 'Shankar', '$2y$10$hC5prAsuUkwFokG6OnV9XeKn0J5.BAPhsAZMyYzdoe2Ha0rGntUhi', 'shankar@gmail.com', '7856341276', 'delivery');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `fk` (`order_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `delivery_person_id` (`delivery_person_id`),
  ADD KEY `orders_ibfk_2` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `shipping_address`
--
ALTER TABLE `shipping_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `shipping_address`
--
ALTER TABLE `shipping_address`
  MODIFY `address_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`address_id`) REFERENCES `shipping_address` (`address_id`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`delivery_person_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `shipping_address`
--
ALTER TABLE `shipping_address`
  ADD CONSTRAINT `shipping_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
