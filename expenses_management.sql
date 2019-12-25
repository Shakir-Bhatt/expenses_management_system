-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2019 at 04:25 AM
-- Server version: 8.0.17
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expenses_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `item_price` text NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `item_price`, `total_price`, `user_id`, `created_at`, `updated_at`) VALUES
(6, 'book-30,pen-10,oil-100,rice-150', '290.00', 1, '2019-12-20 07:52:24', '2019-12-21 07:53:39'),
(7, 'curd-24,fruit-40,veg-16', '80.00', 1, '2019-12-21 07:53:58', '2019-12-21 17:02:13'),
(8, 'chicken-100', '100.00', 2, '2019-12-21 15:48:18', '2019-12-21 15:48:18'),
(9, 'chicken-200,basmat-100,milk-10', '310.00', 3, '2019-12-21 15:49:04', '2019-12-21 15:49:04'),
(10, 'water-25', '25.00', 4, '2019-12-21 15:59:15', '2019-12-21 15:59:15'),
(13, 'bread-25,rice-160', '185.00', 4, '2019-12-22 07:37:09', '2019-12-22 16:06:03'),
(15, 'eggs-28', '28.00', 3, '2019-12-22 12:44:02', '2019-12-22 12:44:02'),
(16, 'parata-80,milk-10', '90.00', 2, '2019-12-22 12:44:22', '2019-12-22 12:44:22'),
(17, 'meat-300,veg-128,curd-12', '440.00', 1, '2019-12-22 14:44:33', '2019-12-22 14:44:33'),
(18, 'parata-80,milk-10', '90.00', 4, '2019-12-23 16:30:04', '2019-12-23 16:30:04'),
(19, 'ghee-230,sugar-80', '310.00', 2, '2019-12-23 16:30:27', '2019-12-23 16:30:27'),
(20, 'parata-80,curd-10,milk-10', '100.00', 3, '2019-12-23 16:31:04', '2019-12-23 16:31:04'),
(21, 'Fruit-82,Veg-196,curd-12,milk-10,milk-10', '310.00', 3, '2019-12-24 17:11:27', '2019-12-24 17:11:43');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cash` decimal(10,0) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `password`, `created_at`, `updated_at`) VALUES
(1, 'shakir@gmail.com', 'Shakir', 'Bhatt', '$2y$10$89OtwB5fIkEo2g9iYb9dEOPucHZNX3YJstr8yQRFjj9w3IrYIl2rO', '2019-12-15 12:40:48', '2019-12-15 12:40:48'),
(2, 'umar@gmail.com', 'Umar', 'Khan', '$2y$10$89OtwB5fIkEo2g9iYb9dEOPucHZNX3YJstr8yQRFjj9w3IrYIl2rO', '2019-12-15 12:40:48', '2019-12-15 12:40:48'),
(3, 'tahir@gmail.com', 'Tahir', 'Hakeem', '$2y$10$89OtwB5fIkEo2g9iYb9dEOPucHZNX3YJstr8yQRFjj9w3IrYIl2rO', '2019-12-15 12:40:48', '2019-12-15 12:40:48'),
(4, 'waseem@gmail.com', 'Waseem', 'Khan', '$2y$10$89OtwB5fIkEo2g9iYb9dEOPucHZNX3YJstr8yQRFjj9w3IrYIl2rO', '2019-12-15 12:40:48', '2019-12-15 12:40:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
