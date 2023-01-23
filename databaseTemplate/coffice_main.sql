-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 23, 2023 at 04:10 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffice_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `Consumables`
--

CREATE TABLE `Consumables` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Consumables`
--

INSERT INTO `Consumables` (`id`, `name`, `price`) VALUES
(1, 'Bier', 1),
(2, 'Wasser', 0.6),
(3, 'Kaffee', 0.25),
(4, 'LL-Suppe', 3.5),
(5, 'Liebe', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `ConsumptionHistory`
--

CREATE TABLE `ConsumptionHistory` (
  `id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `price` float NOT NULL,
  `date_time` datetime NOT NULL,
  `consumer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `consumer_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ConsumptionHistory`
--

INSERT INTO `ConsumptionHistory` (`id`, `product_name`, `price`, `date_time`, `consumer_id`, `product_id`, `consumer_name`) VALUES
(490, 'Wasser', 0.6, '2020-01-01 12:01:01', 4, 2, 'julian'),
(491, 'Wasser', 0.6, '2020-01-01 12:01:01', 4, 2, 'julian'),
(492, 'Wasser', 0.6, '2020-01-01 12:01:01', 4, 2, 'julian');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `name`) VALUES
(1, 'Peter'),
(4, 'julian'),
(5, 'CN'),
(6, 'Bene');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Consumables`
--
ALTER TABLE `Consumables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ConsumptionHistory`
--
ALTER TABLE `ConsumptionHistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Consumables`
--
ALTER TABLE `Consumables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ConsumptionHistory`
--
ALTER TABLE `ConsumptionHistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=503;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
