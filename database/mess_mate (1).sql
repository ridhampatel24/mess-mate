-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2023 at 03:00 PM
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
-- Table structure for table `meal`
--

CREATE TABLE `meal` (
  `id` int(255) NOT NULL,
  `type` int(10) DEFAULT NULL,
  `items` varchar(255) DEFAULT NULL,
  `users` varchar(255) DEFAULT NULL,
  `added_user` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `price` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meal`
--

INSERT INTO `meal` (`id`, `type`, `items`, `users`, `added_user`, `date`, `price`) VALUES
(1, 0, 'roti||sak||dal||bhat||6as', '1,2,8', NULL, '2023-03-01', 50),
(3, 1, 'roti||sak||dal||bhat||6as', '2,3,4,5', NULL, '2023-03-01', 50),
(4, 0, 'roti||sak||dal||bhat||6as', '1,2,3', NULL, '2023-03-02', 50),
(5, 1, 'roti||sak||dal||bhat||6as', '1,2,3,4', NULL, '2023-03-02', 50),
(6, 0, 'roti||sak||dal||bhat||6as', '1,2,3,4,5', NULL, '2023-03-03', 50),
(7, 1, 'roti||sak||dal||bhat||6as', '1,2,3,4,7,8,9,10,11', NULL, '2023-03-03', 50),
(8, 0, 'roti||sak||dal||bhat||6as', '1,2,3,4', NULL, '2023-03-04', 50),
(9, 1, 'roti||sak||dal||bhat||6as', '1,2,3,4', NULL, '2023-03-04', 50),
(10, 0, 'roti||sak||dal||bhat||6as', '1,2,3,4', NULL, '2023-03-05', 50),
(11, 1, 'roti||sak||dal||bhat||6as', '1,2,3,4', NULL, '2023-03-05', 50),
(12, 0, 'roti||sak||dal||bhat||6as', '1,2,3,4', NULL, '2023-03-06', 50),
(13, 1, 'roti||sak||dal||bhat||6as', '1,2,3,4', NULL, '2023-03-06', 50),
(14, 0, 'roti||sak||dal||bhat||6as', '1,2,3,4,5,6,7,8,9,10,11', NULL, '2023-03-07', 50),
(15, 1, 'roti||sak||dal||bhat||6as', '1,2,3,4,5', NULL, '2023-03-07', 50),
(16, 1, 'roti||sak||dal||bhat||6as', NULL, NULL, '2023-03-30', 50);

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
(1, 'TS89765431', '31', '2023-03-23', '2023-04-22', '2023-06-21', '1', '1472.5', '2023-03-30 17:36:39');

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `id` int(255) NOT NULL,
  `pol` varchar(255) DEFAULT NULL,
  `options` varchar(255) DEFAULT NULL,
  `votes` varchar(255) DEFAULT NULL,
  `users` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `last_date` varchar(255) DEFAULT NULL,
  `total_votes` int(255) DEFAULT NULL,
  `future1` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`id`, `pol`, `options`, `votes`, `users`, `date`, `last_date`, `total_votes`, `future1`) VALUES
(1, 'what will in dinner?', 'cholle||||alu||||mag||||punjabi', '4||||6||||1||||2', '11,1', NULL, NULL, 14, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `userid` int(100) DEFAULT NULL,
  `mobno` varchar(11) DEFAULT NULL,
  `tokens` int(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `estime` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `userid`, `mobno`, `tokens`, `status`, `estime`) VALUES
(1, 1, '9313268918', 20, 1, '2023-07-05');

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
(1, 'Mayank', '9313268918', 'mrmayank6877@gmail.com', '231c413a3dd8d7739c98c1d36acd32e5', 0);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `meal`
--
ALTER TABLE `meal`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `poll`
--
ALTER TABLE `poll`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
