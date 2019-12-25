-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 22, 2019 at 03:18 AM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mess`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'veg', '2019-04-09 17:57:02', '2019-04-09 17:57:02'),
(2, 'milk', '2019-04-09 17:57:02', '2019-04-09 17:57:02'),
(3, 'bread', '2019-04-09 17:57:02', '2019-04-09 17:57:14'),
(4, 'non-veg', '2019-04-09 17:57:02', '2019-04-09 17:57:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expenses`
--

CREATE TABLE `tbl_expenses` (
  `id` int(11) NOT NULL,
  `item_veg` varchar(256) DEFAULT NULL,
  `item_nonveg` varchar(256) DEFAULT NULL,
  `item_bread` varchar(256) DEFAULT NULL,
  `item_milk` varchar(256) DEFAULT NULL,
  `item_other` varchar(256) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_expenses`
--

INSERT INTO `tbl_expenses` (`id`, `item_veg`, `item_nonveg`, `item_bread`, `item_milk`, `item_other`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'onion+tomato', 'egg', 'biscuit', 'amul', NULL, '130.00', '2019-04-19 16:43:18', '2019-04-19 16:44:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expenses_bkp`
--

CREATE TABLE `tbl_expenses_bkp` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `category` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `user` varchar(256) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_expenses_bkp`
--

INSERT INTO `tbl_expenses_bkp` (`id`, `name`, `category`, `quantity`, `price`, `total_amount`, `user`, `created_at`, `updated_at`) VALUES
(1, 'beans', 1, '1.00', '80.00', '80.00', 'shakir', '2019-04-09 17:52:13', '2019-04-19 16:17:58'),
(2, 'Milk', 2, '1.00', '20.00', '20.00', 'shakir', '2019-04-09 17:52:13', '2019-04-19 16:17:58'),
(3, 'Biscuit', 3, '5.00', '5.00', '25.00', 'shakir', '2019-04-09 17:52:13', '2019-04-19 16:17:58'),
(4, 'milk', 2, '1.00', '20.00', '20.00', 'shakir', '2019-04-10 17:52:13', '2019-04-19 16:17:58'),
(5, 'biscuit', 3, '5.00', '5.00', '25.00', 'shakir', '2019-04-10 17:52:13', '2019-04-19 16:17:58'),
(6, 'biscuit', 3, '4.00', '5.00', '20.00', 'noor', '2019-04-11 17:52:13', '2019-04-24 14:44:21'),
(7, 'Milk', 2, '1.00', '20.00', '20.00', 'noor', '2019-04-11 17:52:13', '2019-04-24 14:44:26'),
(8, 'potatoes+onion+tomato', 1, '1.00', '60.00', '60.00', 'noor', '2019-04-11 17:52:13', '2019-04-24 14:44:42'),
(9, 'Chicken', 4, '1.00', '200.00', '200.00', 'shakir', '2019-04-15 17:52:13', '2019-04-19 16:17:58'),
(10, 'onion+tomato', 1, '1.00', '50.00', '50.00', 'shakir', '2019-04-15 17:52:13', '2019-04-19 16:17:58'),
(11, 'Biscuit', 3, '4.00', '5.00', '20.00', 'shakir', '2019-04-15 17:52:13', '2019-04-19 16:17:58'),
(12, 'Milk', 2, '1.00', '31.00', '31.00', 'shakir', '2019-04-15 17:52:13', '2019-04-19 16:17:58'),
(13, 'Milk', 2, '1.00', '20.00', '20.00', 'shakir', '2019-04-16 17:52:13', '2019-04-19 16:17:58'),
(14, 'Biscuit', 3, '2.00', '10.00', '20.00', 'shakir', '2019-04-16 17:52:13', '2019-04-19 16:17:58'),
(15, 'onion+tomato+cocumber', 1, '1.00', '50.00', '50.00', 'shakir', '2019-04-16 17:52:13', '2019-04-19 16:17:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_expenses`
--
ALTER TABLE `tbl_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_expenses_bkp`
--
ALTER TABLE `tbl_expenses_bkp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_expenses`
--
ALTER TABLE `tbl_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_expenses_bkp`
--
ALTER TABLE `tbl_expenses_bkp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
