-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2024 at 05:56 PM
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
-- Database: `dfsms`
--

-- --------------------------------------------------------

--
-- Table structure for table `cows`
--

CREATE TABLE `cows` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ksb_no` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `farm` varchar(255) NOT NULL,
  `group` varchar(255) DEFAULT NULL,
  `lactations` int(11) NOT NULL,
  `current_weight` decimal(10,2) NOT NULL,
  `current_yield` decimal(10,2) NOT NULL,
  `sire` varchar(255) NOT NULL,
  `grand_sire` varchar(255) NOT NULL,
  `dam` varchar(255) NOT NULL,
  `grand_dam` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `birth_weight` decimal(10,2) NOT NULL,
  `source` varchar(255) NOT NULL,
  `date_purchased` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cows`
--

INSERT INTO `cows` (`id`, `code`, `name`, `ksb_no`, `grade`, `breed`, `color`, `category`, `farm`, `group`, `lactations`, `current_weight`, `current_yield`, `sire`, `grand_sire`, `dam`, `grand_dam`, `date_of_birth`, `birth_weight`, `source`, `date_purchased`, `created_at`) VALUES
(1, 'RSBASCNB', 'Lista K. Mng\'ei', 'dfc', 'B', 'Freshiaon', 'Brown', 'Milker', 'Nw', 'sdc', 3, 150.00, 20.00, 'sdcc', 'cc ', 'cxz ', 'xczx', '2024-05-09', 0.00, 'x', '2024-05-02', '2024-05-30 12:46:08'),
(2, 'RSBASCNB', 'Lista K. Mng\'ei', 'dfc', 'B', 'Freshiaon', 'Brown', 'Milker', 'Nw', 'sdc', 3, 150.00, 20.00, 'sdcc', 'cc ', 'cxz ', 'xczx', '2024-05-09', 0.00, 'x', '2024-05-02', '2024-05-30 12:47:19'),
(3, '220', 'Lista', 'dfc', 'B', 'Freshiaon', 'Brown', 'Milker', '220', 'sdc', 3, 150.00, 20.00, 'sdcc', 'cc ', 'cxz ', 'xczx', '2024-05-08', 0.00, 'x', '2024-05-16', '2024-05-30 12:52:22'),
(4, 'RSBASCNB', 'Lista K. Mng\'ei', 'dfc', 'B', 'Freshiaon', 'Brown', 'Milker', 'Nw', '', 3, 150.00, 20.00, 'sdcc', 'cc ', 'cxz ', 'xczx', '2024-05-16', 0.00, 'Self', '2024-05-02', '2024-05-30 13:05:34'),
(5, 'svxsfxgc v', 'xzxz', 'xxz', 'xszx', 'xsx', 'dvfc', 'vfdv', '', 'vdxcfv', 0, 0.00, 0.00, 'v cx', 'c cd v', 'cd ', 'c dsc', '0000-00-00', 2024.00, 'vffdfv', '2024-05-08', '2024-05-30 20:00:44');

-- --------------------------------------------------------

--
-- Table structure for table `farms`
--

CREATE TABLE `farms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farms`
--

INSERT INTO `farms` (`id`, `name`, `location`, `size`) VALUES
(12, 'Lista K. Mng\'ei', 'Nairobi, KEN', 10000),
(23, 'Mosorit', 'Moso', 100000),
(56, 'Nani', 'New', 20000),
(220, 'Testing', 'Chep', 100),
(221, 'Mimi', 'Eldy', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `farm_users`
--

CREATE TABLE `farm_users` (
  `user_id` int(11) NOT NULL,
  `farm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `milk_records`
--

CREATE TABLE `milk_records` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `name` varchar(255) NOT NULL,
  `morning` int(11) NOT NULL,
  `noon` int(11) NOT NULL,
  `evening` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `milk_records`
--

INSERT INTO `milk_records` (`id`, `date`, `name`, `morning`, `noon`, `evening`, `total`) VALUES
(58, '2024-06-03', '3', 100, 0, 0, 0),
(59, '2024-06-04', '3', 100, 0, 0, 0),
(60, '2024-06-03', '3', 200, 0, 0, 0),
(61, '2024-06-03', '3', 0, 100, 0, 0),
(62, '2024-06-03', '3', 0, 150, 0, 0),
(63, '2024-06-04', '3', 0, 100, 0, 0),
(64, '2024-06-04', '1', 100, 0, 0, 0),
(65, '2024-06-04', '5', 100, 0, 0, 0),
(66, '2024-06-03', '5', 80, 0, 0, 0),
(67, '2024-06-04', '5', 0, 60, 0, 0),
(68, '2024-06-03', '5', 0, 80, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `userip` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `username`, `userip`, `status`, `Date`) VALUES
(2, 'chisira', '::1', '1', '2024-06-03'),
(3, 'chisira', '::1', '1', '2024-06-03'),
(4, 'chisira', '::1', '1', '2024-06-03'),
(5, 'chisira', '::1', '1', '2024-06-03'),
(6, 'chisira', '::1', '1', '2024-06-03'),
(7, 'chisira', '::1', '1', '2024-06-03'),
(8, 'chisira', '::1', '1', '2024-06-03'),
(9, 'lista', '::1', '1', '2024-06-03'),
(10, 'lista', '::1', '1', '2024-06-03'),
(11, 'lista', '::1', '1', '2024-06-03'),
(12, 'lista', '::1', '1', '2024-06-03'),
(13, 'kerubo', '::1', '1', '2024-06-03'),
(14, 'kerubo', '::1', '1', '2024-06-03'),
(15, 'kerubo', '::1', '1', '2024-06-03'),
(16, 'kerubo', '::1', '1', '2024-06-03'),
(17, 'kerubo', '::1', '1', '2024-06-03'),
(18, 'kerubo', '::1', '1', '2024-06-03'),
(19, 'lista', '::1', '1', '2024-06-03'),
(20, 'kerubo', '::1', '1', '2024-06-03'),
(21, 'lista', '::1', '1', '2024-06-03'),
(22, 'kerubo', '::1', '1', '2024-06-04'),
(23, 'lista', '::1', '1', '2024-06-04'),
(24, 'kerubo', '::1', '1', '2024-06-04'),
(25, 'kerubo', '::1', '1', '2024-06-04'),
(26, 'kerubo', '::1', '1', '2024-06-04'),
(27, 'lista', '::1', '1', '2024-06-04'),
(28, 'kerubo', '::1', '1', '2024-06-04'),
(29, 'lista', '::1', '1', '2024-06-04'),
(30, 'lista', '::1', '1', '2024-06-05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(250) NOT NULL,
  `farm` varchar(250) NOT NULL,
  `status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `farm`, `status`) VALUES
(23, 'lista', 'ecd2ec43c588ae012e3550fcc55d6009', 'user', '220', 0),
(26, 'lista', 'ecd2ec43c588ae012e3550fcc55d6009', 'user', '220', 0),
(27, 'kerubo', 'ecd2ec43c588ae012e3550fcc55d6009', 'Superadmin', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cows`
--
ALTER TABLE `cows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farms`
--
ALTER TABLE `farms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farm_users`
--
ALTER TABLE `farm_users`
  ADD PRIMARY KEY (`user_id`,`farm_id`),
  ADD KEY `farm_id` (`farm_id`);

--
-- Indexes for table `milk_records`
--
ALTER TABLE `milk_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
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
-- AUTO_INCREMENT for table `cows`
--
ALTER TABLE `cows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `farms`
--
ALTER TABLE `farms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `milk_records`
--
ALTER TABLE `milk_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `farm_users`
--
ALTER TABLE `farm_users`
  ADD CONSTRAINT `farm_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `farm_users_ibfk_2` FOREIGN KEY (`farm_id`) REFERENCES `farms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
