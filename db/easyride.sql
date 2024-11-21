-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 10:43 PM
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
-- Database: `easyride`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_fname` varchar(25) NOT NULL,
  `customer_lname` varchar(25) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_phonenum` varchar(11) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_password` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_fname`, `customer_lname`, `customer_address`, `customer_phonenum`, `customer_email`, `customer_password`, `customer_id`) VALUES
('Diego', 'Salas', '27715 KILLARNEY', '9493562350', 'diegosalas_2001@hotmail.com', '$2y$10$/.TP.NDW3XkEFW5XkVF/M.Us5ERvcEF322XOLg5jaBiNhCzphpOK.', 1),
('Tony', 'Montana', '1245 Miami', '8883332222', 'tonymontana@gmail.com', '$2y$10$WZr4TRhpZ0WbXCh4lVbwWOD1Ofdzu26Bp5xc/qCaSADgZ8Ys0eeCy', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_phonenum` (`customer_phonenum`),
  ADD KEY `customer_id` (`customer_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
