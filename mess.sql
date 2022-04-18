-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2022 at 09:31 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
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
-- Table structure for table `alert`
--

CREATE TABLE `alert` (
  `alert_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE `balance` (
  `user_id` int(11) NOT NULL,
  `deposite` float NOT NULL DEFAULT 0,
  `cost` float NOT NULL DEFAULT 0,
  `balance` float NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`user_id`, `deposite`, `cost`, `balance`, `date`) VALUES
(9, 1000, 0, 0, '2022-03-03 21:54:40'),
(10, 1000, 0, 0, '2022-03-03 22:04:21'),
(11, 1000, 0, 0, '2022-03-03 22:04:27'),
(12, 1000, 0, 0, '2022-03-03 22:04:33');

-- --------------------------------------------------------

--
-- Table structure for table `cost`
--

CREATE TABLE `cost` (
  `others_cost` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `meal_cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cost`
--

INSERT INTO `cost` (`others_cost`, `date`, `meal_cost`) VALUES
(315, '2022-03-05 21:29:08', 1440);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL,
  `others_cost` float DEFAULT 0,
  `meal_cost` float DEFAULT 0,
  `deposite` float DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `meal_count` int(11) DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `meal`
--

CREATE TABLE `meal` (
  `user_id` int(11) NOT NULL,
  `meal_count` float NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meal`
--

INSERT INTO `meal` (`user_id`, `meal_count`, `date`) VALUES
(9, 3, '2022-03-05 21:35:27'),
(10, 5, '2022-03-03 22:05:05'),
(11, 5, '2022-03-03 22:05:09'),
(12, 5, '2022-03-03 22:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `month`
--

CREATE TABLE `month` (
  `month_name` text NOT NULL,
  `day` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `month`
--

INSERT INTO `month` (`month_name`, `day`, `date`) VALUES
('March', 1, '2022-03-03 08:17:13');

-- --------------------------------------------------------

--
-- Table structure for table `todays_meal`
--

CREATE TABLE `todays_meal` (
  `meal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `day` int(11) DEFAULT 1,
  `night` int(11) DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `password` text NOT NULL,
  `user_category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `email`, `phone`, `password`, `user_category`) VALUES
(9, 'Nipun Paul', 'nipun4338@gmail.com', '01778546619', 'cd1fbd48ab11e7ff2228c7644a1e5110', 'Admin'),
(10, 'Purnendu Talukder', 'purnendu@gmail.com', '01778546619', '81dc9bdb52d04dc20036dbd8313ed055', 'User'),
(11, 'Simanta Sarker', 'simanta@m.com', '01778546619', '81dc9bdb52d04dc20036dbd8313ed055', 'User'),
(12, 'MFReshad', 'reshad5646@gmail.com', '01784823267', '81dc9bdb52d04dc20036dbd8313ed055', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alert`
--
ALTER TABLE `alert`
  ADD PRIMARY KEY (`alert_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `todays_meal`
--
ALTER TABLE `todays_meal`
  ADD PRIMARY KEY (`meal_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alert`
--
ALTER TABLE `alert`
  MODIFY `alert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `todays_meal`
--
ALTER TABLE `todays_meal`
  MODIFY `meal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
