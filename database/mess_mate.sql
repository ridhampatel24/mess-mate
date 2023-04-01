-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2023 at 08:00 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mess_mate`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `datetime` date NOT NULL DEFAULT current_timestamp(),
  `feedback` varchar(255) DEFAULT NULL,
  `rate` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_id`, `name`, `datetime`, `feedback`, `rate`) VALUES
(1, 1, 'Mayank', '2023-04-01', 'good but not best', 4);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `name` varchar(25) NOT NULL,
  `quntity` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`name`, `quntity`, `item_id`) VALUES
('Chilli', '200', 2),
('Mung', '227', 4),
('Onion', '250', 5),
('Rice', '130', 3),
('Salt', '20', 6),
('Wheat Flour', '300', 7),
('Tomatos', '260', 1),
('Aalu', '500', 8);

-- --------------------------------------------------------

--
-- Table structure for table `meal`
--

CREATE TABLE `meal` (
  `id` int(255) NOT NULL,
  `type` int(10) DEFAULT NULL,
  `items` varchar(255) DEFAULT NULL,
  `users` varchar(255) DEFAULT NULL,
  `added_user` varchar(255) DEFAULT NULL,
  `wastage_user` int(100) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `price` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meal`
--

INSERT INTO `meal` (`id`, `type`, `items`, `users`, `added_user`, `wastage_user`, `date`, `price`) VALUES
(1, 0, 'roti||sak||dal||bhat||6as', '1,2,8', NULL, 3, '2023-03-01', 50),
(3, 1, 'roti||sak||dal||bhat||6as', '2,3,4,5', NULL, 4, '2023-03-01', 50),
(4, 0, 'roti||sak||dal||bhat||6as', '1,2,3', NULL, 5, '2023-03-02', 50),
(5, 1, 'roti||sak||dal||bhat||6as', '1,2,3,4', NULL, 4, '2023-03-02', 50),
(6, 0, 'roti||sak||dal||bhat||6as', '1,2,3,4,5', NULL, 3, '2023-03-03', 50),
(7, 1, 'roti||sak||dal||bhat||6as', '1,2,3,4,7,8,9,10,11', NULL, 3, '2023-03-03', 50),
(8, 0, 'roti||sak||dal||bhat||6as', '1,2,3,4', NULL, 2, '2023-03-04', 50),
(9, 1, 'roti||sak||dal||bhat||6as', '1,2,3,4', NULL, 6, '2023-03-04', 50),
(10, 0, 'roti||sak||dal||bhat||6as', '1,2,3,4', NULL, 3, '2023-03-05', 50),
(11, 1, 'roti||sak||dal||bhat||6as', '1,2,3,4', NULL, 7, '2023-03-05', 50),
(12, 0, 'roti||sak||dal||bhat||6as', '1,2,3,4', NULL, 4, '2023-03-06', 50),
(13, 1, 'roti||sak||dal||bhat||6as', '1,2,3,4', NULL, 3, '2023-03-06', 50),
(14, 0, 'roti||sak||dal||bhat||6as', '1,2,3,4,5,6,7,8,9,10,11', NULL, 2, '2023-03-07', 50),
(15, 1, 'roti||sak||dal||bhat||6as', '2,3,4,5,1', NULL, 2, '2023-03-07', 50),
(19, 0, 'Puri||||Rajma||||Dal||||Bhat||||Chhas', '1', NULL, 1, '2023-04-01', 50);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `user_id` int(255) NOT NULL,
  `invoice_id` varchar(12) NOT NULL,
  `t_meal` varchar(10) NOT NULL,
  `s_date` date NOT NULL,
  `e_date` date NOT NULL,
  `ex_date` date NOT NULL,
  `type_meal` varchar(20) NOT NULL,
  `total` varchar(10) NOT NULL,
  `date_payment` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`user_id`, `invoice_id`, `t_meal`, `s_date`, `e_date`, `ex_date`, `type_meal`, `total`, `date_payment`) VALUES
(3, 'TS53224189', '50', '2023-03-01', '2023-03-25', '2023-05-24', '3', '2250', '2023-03-30 16:27:03'),
(3, 'TS57339481', '15', '0000-00-00', '0000-00-00', '2023-05-15', '2', '750', '2023-03-30 16:39:07'),
(3, 'TS62121242', '15', '2023-03-12', '0000-00-00', '2023-05-25', '2', '750', '2023-03-30 16:40:38'),
(3, 'TS37559976', '22', '2023-03-01', '2023-03-22', '2023-05-21', '2', '1045', '2023-03-30 16:44:01'),
(3, 'TS30199921', '61', '0000-00-00', '2023-04-30', '2023-06-29', '2', '2745', '2023-03-30 16:45:02'),
(3, 'TS60122769', '61', '2023-03-01', '2023-04-30', '2023-06-29', '2', '2745', '2023-03-30 16:46:44'),
(3, 'TS59725390', '15', '2023-03-01', '2023-03-15', '2023-05-14', '2', '750', '2023-03-30 17:06:15'),
(1, 'TS93078543', '14', '2023-03-16', '2023-03-29', '2023-05-28', '1', '700', '2023-03-30 17:35:12'),
(1, 'TS32433960', '15', '2023-03-09', '2023-03-23', '2023-05-22', '1', '750', '2023-03-30 17:36:20'),
(1, 'TS89765431', '31', '2023-03-23', '2023-04-22', '2023-06-21', '1', '1472.5', '2023-03-30 17:36:39'),
(1, 'TS32146441', '6', '2023-04-24', '2023-04-29', '2023-06-28', '1', '300', '2023-03-31 00:40:52'),
(1, 'TS32146441', '6', '2023-04-24', '2023-04-29', '2023-06-28', '1', '300', '2023-03-31 00:41:16'),
(1, 'TS66744508', '74', '2023-11-01', '2023-12-07', '2024-02-05', '3', '3330', '2023-03-31 16:02:05'),
(10000, 'TS88540425', '6', '2023-04-02', '2023-04-07', '2023-06-06', '1', '300', '2023-04-01 09:45:53'),
(10000, 'TS52188044', '6', '2023-04-02', '2023-04-07', '2023-06-06', '1', '300', '2023-04-01 09:47:51');

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `id` int(255) NOT NULL,
  `pol` varchar(255) DEFAULT NULL,
  `options` varchar(255) DEFAULT NULL,
  `votes` varchar(255) DEFAULT NULL,
  `users` varchar(255) DEFAULT '0',
  `date` varchar(255) DEFAULT NULL,
  `last_date` varchar(255) DEFAULT NULL,
  `total_votes` int(255) DEFAULT NULL,
  `future1` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`id`, `pol`, `options`, `votes`, `users`, `date`, `last_date`, `total_votes`, `future1`) VALUES
(1, 'what will in dinner?', 'Alu Matar||||Chhole Chana||||Rajma||||Paneer', '5||||6||||2||||2', ',1', '2023-03-31', '2023-04-01', 16, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `userid` int(100) DEFAULT NULL,
  `mobno` varchar(11) DEFAULT NULL,
  `tokens` int(100) DEFAULT NULL,
  `d_tokens` int(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `estime` varchar(200) DEFAULT NULL,
  `end_time` varchar(50) DEFAULT NULL,
  `start_date` varchar(50) DEFAULT NULL,
  `dontgo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `userid`, `mobno`, `tokens`, `d_tokens`, `status`, `estime`, `end_time`, `start_date`, `dontgo`) VALUES
(1, 1, '9313268918', 96, 89, 1, '2024-02-05', '2023-12-07', '2023-11-01', '2023-03-01'),
(2, 2, '9999999999', 19, 25, 1, '2023-05-05', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `hostel` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `email`, `password`, `hostel`) VALUES
(1, 'Mayank', '9313268918', 'mrmayank6877@gmail.com', '231c413a3dd8d7739c98c1d36acd32e5', 0),
(9999, 'Mess Manager', '1234567890', 'mess@mail.com', '231c413a3dd8d7739c98c1d36acd32e5', 0),
(10000, 'User', '9876543210', 'user@gmail.com', '231c413a3dd8d7739c98c1d36acd32e5', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `meal`
--
ALTER TABLE `meal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
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
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `meal`
--
ALTER TABLE `meal`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `poll`
--
ALTER TABLE `poll`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10001;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
