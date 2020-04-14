-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2020 at 06:35 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `noc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expire_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `req_id` int(11) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `letter_no` varchar(30) NOT NULL,
  `letter_date` varchar(100) NOT NULL,
  `due_date` varchar(100) NOT NULL,
  `emp_no` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `rep_name` varchar(255) NOT NULL,
  `rep_designation` varchar(255) NOT NULL,
  `rep_email` varchar(255) NOT NULL,
  `rep_phone` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`req_id`, `purpose`, `letter_no`, `letter_date`, `due_date`, `emp_no`, `name`, `designation`, `department`, `email`, `phone`, `rep_name`, `rep_designation`, `rep_email`, `rep_phone`, `user_id`, `type`, `updated_at`) VALUES
(1, 'Transfer', '458', '23/42/3432', '23/43/2423', '4564', 'Ednum Admin', 'Developer', 'Information Technology', 'narayan.shaw121@gmail.com', '07980010668', 'Narayan Shaw', 'DGM', 'narayan.shaw254@gmail.com', '+447478224583', 1, 'Approved', '2020-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `tracker`
--

CREATE TABLE `tracker` (
  `tr_id` int(11) NOT NULL,
  `hod_id` int(11) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `recheck` int(11) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `emp_comts` varchar(255) NOT NULL,
  `req_id` int(11) NOT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tracker`
--

INSERT INTO `tracker` (`tr_id`, `hod_id`, `status`, `recheck`, `comments`, `document`, `emp_comts`, `req_id`, `deleted_at`) VALUES
(1, 4, 'Approved', 1, 'fasdfsda', '', '', 1, '2020-04-10 13:51:24'),
(2, 5, 'Pending', 0, '', '', '', 1, '2020-04-10 13:51:24');

-- --------------------------------------------------------

--
-- Table structure for table `trash`
--

CREATE TABLE `trash` (
  `id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('0','1','2') NOT NULL DEFAULT '0',
  `activated` enum('0','1') NOT NULL DEFAULT '0',
  `avatar` varchar(255) NOT NULL DEFAULT '../uploads/default.png',
  `join_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `department`, `password`, `email`, `role`, `activated`, `avatar`, `join_date`) VALUES
(1, 'Narayan Shaw', '', '$2y$10$29skGGoHOE7Zn.tGelzLVeeJPH7We7TxCtEx5IgzOm.npl22dFglC', 'narayan.shaw121@gmail.com', '0', '1', '../uploads/Narayan Shaw5907b9249d78627e74dbea1af19d0504.png', '2020-04-12 06:48:25'),
(2, 'Admin', '', '$2y$10$1HYg/QxG.J.Y47UsSl6Qt./yxi8pPFBjWW6I57O4FcAfoBKlj5eQW', 'admin@gmail.com', '2', '1', '../uploads/default.png', '2020-04-10 16:04:48'),
(4, 'IT HOD Department', 'Information Technology', '$2y$10$41s51rJOBpI4fN7vEZCKhOiaS4hf1W.xRb6.0kCp456rYmt5r5mzq', 'info.mixblack@gmail.com', '1', '1', '../uploads/IT HOD Departmentd86044f777be9b9b735ada90e7c5a3ae.png', '2020-04-10 16:06:09'),
(5, 'Amit', 'IT Department', '$2y$10$okYrhXStBKVMljG6SlpG.Oq4VqB8aglNSm7M47oWrHWKK2gGl3E5G', 'sahooamit400@gmail.com', '1', '1', '../uploads/default.png', '2020-04-10 16:04:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `tracker`
--
ALTER TABLE `tracker`
  ADD PRIMARY KEY (`tr_id`);

--
-- Indexes for table `trash`
--
ALTER TABLE `trash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `password` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tracker`
--
ALTER TABLE `tracker`
  MODIFY `tr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trash`
--
ALTER TABLE `trash`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
