-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2025 at 07:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `icecream`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`) VALUES
(1, 'vaibhav ', 'gorevaibhav12@gamil.com', 'Hello'),
(2, 'samarth ', 'samarth@gmail.com', 'Hi'),
(3, 'vaibhav ', 'gorevaibhav12@gamil.com', 'Hello'),
(4, 'vaibhav ', 'gorevaibhav12@gamil.com', 'Hello'),
(5, 'kirti gore', 'vaibhav@gmail.com', 'Hii '),
(6, 'kirti gore', 'vaibhav@gmail.com', 'Hii '),
(7, 'vaibhav patil', 'vaibha@gmail.com', 'Hi '),
(8, 'vaibhav patil', 'vaibha@gmail.com', 'Hi '),
(9, 'ooo', 'utgrg@gmail.com', 'hello every one'),
(10, 'ooo', 'utgrg@gmail.com', 'hello every one'),
(11, 'ff', 'ff@gmail.com', 'fuetud'),
(12, 'ff', 'ff@gmail.com', 'fuetud');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `contact` int(11) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `name`, `email`, `password`, `contact`, `address`) VALUES
(2, 'kirti gore', 'kirtig@gmail.com', 'vaibhav', 2147483647, 'mulegaon'),
(3, 'vaibhav ', 'gorevaibhav12@gamil.com', '1234', 2147483647, '156,kakade galli, mulegaon'),
(4, 'vaibhav ', 'gorevaibhav12@gamil.com', '1234', 2147483647, '156,kakade galli, mulegaon'),
(5, 'vaibhav ', 'gorevaibhav12@gamil.com', '4567', 2147483647, 'mulegaon'),
(6, 'vaibhav ', 'gorevaibhav12@gamil.com', '1234', 2147483647, '156,kakade galli, mulegaon'),
(8, 'vaibhav ', 'gorevaibhav12@gamil.com', '0000', 2147483647, 'mulegaon'),
(9, 'vaibhav p', 'vaibhav@gmail.com', '12345', 2147483647, 'mulegaon'),
(10, 'samarth', 'samarth@gmail.com', '1234', 2147483647, 'mulegaon'),
(11, 'vaibhav ', 'gorevaibhav12@gamil.com', '12345', 2147483647, 'mulegaon'),
(13, 'sm', 'sa@gmail.com', 'vaibhavgore', 2147483647, '156,kakade galli, mulegaon'),
(14, 'vaibhav gore', 'gorevaibhav12@gamil.com', '123456', 2147483647, 'mulegaon'),
(15, 'vaibhav ', 'gorevaibhav12@gamil.com', '1234', 2147483647, 'mulegaon'),
(16, 'oo', 'oo@gmail.com', '1234', 2147483647, 'mulegaon'),
(17, 'vaibhav ', 'samarth@gmail.com', '1234567890', 735021545, 'mulegaon'),
(18, 'vaibhav ', 'gorevaibhav12@gamil.com', '12345', 2147483647, '156,kakade galli, mulegaon');

-- --------------------------------------------------------

--
-- Table structure for table `user_order`
--

CREATE TABLE `user_order` (
  `order_id` int(100) NOT NULL,
  `Item_name` varchar(100) NOT NULL,
  `Price` int(100) NOT NULL,
  `Quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_order`
--

INSERT INTO `user_order` (`order_id`, `Item_name`, `Price`, `Quantity`) VALUES
(1, 'Mix Ice-Cream', 80, 1),
(2, 'chocolate', 90, 1),
(3, 'Cherry Ice Cream', 85, 1),
(4, 'Vanilla Ice-Cream', 70, 1),
(5, 'Chocolate Ice Cream', 120, 2),
(6, 'Vanilla Ice-Cream', 70, 1),
(7, 'Mango Ice Cream', 100, 1),
(8, 'Custred Ice Cream', 90, 2),
(9, 'Cherry Ice Cream', 85, 1),
(10, 'Falooda', 120, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_order`
--
ALTER TABLE `user_order`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
