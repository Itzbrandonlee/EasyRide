-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2024 at 11:46 PM
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
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `confirmation_num` int(11) NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT 'pending',
  `vehicle_registration` int(11) NOT NULL,
  `pickup_date` date NOT NULL,
  `pickup_employee_email` varchar(50) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `drop_date` date NOT NULL,
  `drop_employee_email` varchar(50) DEFAULT NULL,
  `pickup_branch_id` int(11) NOT NULL,
  `drop_branch_id` int(11) NOT NULL,
  `amount` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`confirmation_num`, `status`, `vehicle_registration`, `pickup_date`, `pickup_employee_email`, `customer_id`, `drop_date`, `drop_employee_email`, `pickup_branch_id`, `drop_branch_id`, `amount`) VALUES
(4, 'completed', 1, '2024-12-17', 'tonymontana@gmail.com', 1, '2024-12-26', 'tonymontana@gmail.com', 1, 1, 23.00),
(5, 'canceled', 12346, '2024-12-24', NULL, 1, '2024-12-24', NULL, 1, 2, 45.00),
(6, 'pending', 12350, '2025-01-01', NULL, 2, '2025-01-01', NULL, 2, 3, 35.00),
(7, 'ongoing', 12350, '2024-12-10', NULL, 1, '2024-12-12', NULL, 2, 1, 35.00),
(8, 'canceled', 12352, '2024-12-10', NULL, 2, '2024-12-10', NULL, 1, 3, 64.00),
(9, 'pending', 12355, '2024-12-10', NULL, 2, '2024-12-10', NULL, 3, 3, 18.00);

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `location` varchar(50) NOT NULL,
  `branch_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `location`, `branch_name`) VALUES
(1, 'Laguna Beach', 'Easyride LB'),
(2, 'Mission Viejo', 'easyride MV'),
(3, 'Fullerton', 'easyride FUL');

-- --------------------------------------------------------

--
-- Stand-in structure for view `cancelled_bookings`
-- (See below for the actual view)
--
CREATE TABLE `cancelled_bookings` (
`customer_fname` varchar(25)
,`customer_lname` varchar(25)
,`customer_email` varchar(50)
,`customer_phonenum` varchar(15)
);

-- --------------------------------------------------------

--
-- Table structure for table `car_type`
--

CREATE TABLE `car_type` (
  `type_car_id` int(11) NOT NULL,
  `car_type_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_type`
--

INSERT INTO `car_type` (`type_car_id`, `car_type_name`) VALUES
(1, 'car'),
(2, 'truck'),
(3, 'SUV'),
(4, 'van'),
(5, 'Suburban');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_fname` varchar(25) NOT NULL,
  `customer_lname` varchar(25) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_phonenum` varchar(15) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_fname`, `customer_lname`, `customer_address`, `customer_phonenum`, `customer_email`, `customer_password`) VALUES
(1, 'Diego', 'Salas', '27715 KILLARNEY', '9491234567', 'diegosalas_2001@hotmail.com', '$2y$10$O2pic/ymgeWX21Fv.Ablneo4b7SGJKwVp3wePf8QFmQffxRI5.pUq'),
(2, 'Gustavo', 'Fring', '123 Pollos', '9493334444', 'gustavo@gmail.com', '$2y$10$v7rjd5xEtcD1xwTobSa2Q.xdS6THLxuI8/2WiJBk4xNJ/t8MSAMFm');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `employee_fname` varchar(25) NOT NULL,
  `employee_lname` varchar(25) NOT NULL,
  `employee_address` varchar(255) NOT NULL,
  `employee_phonenum` varchar(15) NOT NULL,
  `employee_email` varchar(50) NOT NULL,
  `employee_password` varchar(100) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_fname`, `employee_lname`, `employee_address`, `employee_phonenum`, `employee_email`, `employee_password`, `branch_id`) VALUES
(1, 'Tony', 'Montana', '1234 Sesame st', '9491234567', 'tonymontana@gmail.com', '$2y$10$IKZJfM6xSrGiglJk.haZeuw/lm31vURIjQ3nObfzIsENpifScWGfu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fuel_type`
--

CREATE TABLE `fuel_type` (
  `fuel_type_id` int(11) NOT NULL,
  `fuel_type_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fuel_type`
--

INSERT INTO `fuel_type` (`fuel_type_id`, `fuel_type_name`) VALUES
(1, 'gasoline'),
(2, 'hybrid'),
(3, 'plug in hybrid'),
(4, 'electric');

-- --------------------------------------------------------

--
-- Stand-in structure for view `popular_cars`
-- (See below for the actual view)
--
CREATE TABLE `popular_cars` (
`c_name` varchar(25)
,`description` varchar(200)
,`model_year` int(11)
,`manufacturer` varchar(20)
,`color` varchar(10)
,`registration_num` int(11)
,`seat_capacity` int(11)
,`mileage` int(11)
,`rate` float(10,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `repeat_customers`
-- (See below for the actual view)
--
CREATE TABLE `repeat_customers` (
`customer_fname` varchar(25)
,`customer_lname` varchar(25)
,`customer_email` varchar(50)
,`customer_phonenum` varchar(15)
);

-- --------------------------------------------------------

--
-- Table structure for table `status_type`
--

CREATE TABLE `status_type` (
  `status_id` int(11) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_type`
--

INSERT INTO `status_type` (`status_id`, `status`) VALUES
(1, 'pending'),
(2, 'ongoing'),
(3, 'canceled'),
(4, 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `car_id` int(11) NOT NULL,
  `c_name` varchar(25) NOT NULL,
  `description` varchar(200) NOT NULL,
  `model_year` int(11) NOT NULL,
  `manufacturer` varchar(20) NOT NULL,
  `color` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`car_id`, `c_name`, `description`, `model_year`, `manufacturer`, `color`) VALUES
(1, 'Tacoma', '4x4', 2019, 'Toyota', 'Black'),
(2, 'Suburban', 'XL', 2021, 'Chevrolet', 'White'),
(3, 'Corolla', 'Standard', 2024, 'Toyota', 'Grey'),
(4, 'Wrangler', '4x4', 2021, 'Jeep', 'Red'),
(5, 'Civic', 'Luxury', 2023, 'Honda', 'White'),
(6, 'Durango', 'Standard', 2018, 'Dodge', 'Black'),
(7, 'Transit', 'Standard', 2018, 'Ford', 'Black'),
(8, 'Pregio', 'XL', 2022, 'Kia', 'White'),
(9, 'Model X', 'Standard', 2019, 'Tesla', 'Red'),
(10, 'Odyssey', 'Standard', 2017, 'Honda', 'Blue');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_details`
--

CREATE TABLE `vehicle_details` (
  `registration_num` int(11) NOT NULL,
  `seat_capacity` int(11) NOT NULL,
  `mileage` int(11) NOT NULL,
  `rate` float(10,2) NOT NULL,
  `type_car_id` int(11) NOT NULL,
  `fuel_type_id` int(11) NOT NULL,
  `vehicle_branch_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_details`
--

INSERT INTO `vehicle_details` (`registration_num`, `seat_capacity`, `mileage`, `rate`, `type_car_id`, `fuel_type_id`, `vehicle_branch_id`, `car_id`) VALUES
(1, 5, 40000, 23.00, 2, 1, 1, 1),
(12346, 7, 20000, 45.00, 3, 2, 1, 2),
(12347, 4, 30000, 31.00, 2, 1, 3, 4),
(12348, 4, 25000, 15.00, 1, 1, 3, 3),
(12349, 4, 15000, 20.00, 1, 2, 2, 5),
(12350, 7, 50000, 35.00, 3, 1, 2, 6),
(12351, 7, 20000, 34.00, 3, 4, 1, 10),
(12352, 7, 25000, 64.00, 4, 1, 1, 8),
(12353, 4, 12000, 45.00, 1, 4, 2, 9),
(12354, 7, 50000, 35.00, 4, 1, 2, 7),
(12355, 4, 25000, 18.00, 1, 1, 3, 3),
(12356, 5, 40000, 25.00, 2, 2, 3, 1);

-- --------------------------------------------------------

--
-- Structure for view `cancelled_bookings`
--
DROP TABLE IF EXISTS `cancelled_bookings`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cancelled_bookings`  AS SELECT `c`.`customer_fname` AS `customer_fname`, `c`.`customer_lname` AS `customer_lname`, `c`.`customer_email` AS `customer_email`, `c`.`customer_phonenum` AS `customer_phonenum` FROM (`customers` `c` join `booking` `b` on(`b`.`customer_id` = `c`.`customer_id`)) WHERE `b`.`status` = 'canceled' ;

-- --------------------------------------------------------

--
-- Structure for view `popular_cars`
--
DROP TABLE IF EXISTS `popular_cars`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `popular_cars`  AS SELECT DISTINCT `v`.`c_name` AS `c_name`, `v`.`description` AS `description`, `v`.`model_year` AS `model_year`, `v`.`manufacturer` AS `manufacturer`, `v`.`color` AS `color`, `vd`.`registration_num` AS `registration_num`, `vd`.`seat_capacity` AS `seat_capacity`, `vd`.`mileage` AS `mileage`, `vd`.`rate` AS `rate` FROM ((((`vehicle` `v` join `vehicle_details` `vd` on(`vd`.`car_id` = `v`.`car_id`)) join `car_type` `ct` on(`ct`.`type_car_id` = `vd`.`type_car_id`)) join `fuel_type` `ft` on(`ft`.`fuel_type_id` = `vd`.`fuel_type_id`)) join `booking` `b` on(`b`.`vehicle_registration` = `vd`.`registration_num`)) ;

-- --------------------------------------------------------

--
-- Structure for view `repeat_customers`
--
DROP TABLE IF EXISTS `repeat_customers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `repeat_customers`  AS SELECT `c`.`customer_fname` AS `customer_fname`, `c`.`customer_lname` AS `customer_lname`, `c`.`customer_email` AS `customer_email`, `c`.`customer_phonenum` AS `customer_phonenum` FROM (`customers` `c` join `booking` `b` on(`b`.`customer_id` = `c`.`customer_id`)) GROUP BY `c`.`customer_id`, `c`.`customer_fname`, `c`.`customer_lname`, `c`.`customer_email`, `c`.`customer_phonenum` HAVING count(0) >= 3 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`confirmation_num`),
  ADD KEY `pickup_employee_email` (`pickup_employee_email`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `pickup_branch_id` (`pickup_branch_id`),
  ADD KEY `drop_branch_id` (`drop_branch_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `car_type`
--
ALTER TABLE `car_type`
  ADD PRIMARY KEY (`type_car_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_phonenum` (`customer_phonenum`),
  ADD UNIQUE KEY `customer_email` (`customer_email`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `employee_phonenum` (`employee_phonenum`),
  ADD UNIQUE KEY `employee_email` (`employee_email`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `fuel_type`
--
ALTER TABLE `fuel_type`
  ADD PRIMARY KEY (`fuel_type_id`);

--
-- Indexes for table `status_type`
--
ALTER TABLE `status_type`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `vehicle_details`
--
ALTER TABLE `vehicle_details`
  ADD PRIMARY KEY (`registration_num`),
  ADD KEY `type_car_id` (`type_car_id`),
  ADD KEY `fuel_type_id` (`fuel_type_id`),
  ADD KEY `branch_id` (`vehicle_branch_id`),
  ADD KEY `car_id` (`car_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `confirmation_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `car_type`
--
ALTER TABLE `car_type`
  MODIFY `type_car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fuel_type`
--
ALTER TABLE `fuel_type`
  MODIFY `fuel_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status_type`
--
ALTER TABLE `status_type`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vehicle_details`
--
ALTER TABLE `vehicle_details`
  MODIFY `registration_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12357;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`pickup_employee_email`) REFERENCES `employee` (`employee_email`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`pickup_branch_id`) REFERENCES `branch` (`branch_id`),
  ADD CONSTRAINT `booking_ibfk_4` FOREIGN KEY (`drop_branch_id`) REFERENCES `branch` (`branch_id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`);

--
-- Constraints for table `vehicle_details`
--
ALTER TABLE `vehicle_details`
  ADD CONSTRAINT `vehicle_details_ibfk_1` FOREIGN KEY (`type_car_id`) REFERENCES `car_type` (`type_car_id`),
  ADD CONSTRAINT `vehicle_details_ibfk_2` FOREIGN KEY (`fuel_type_id`) REFERENCES `fuel_type` (`fuel_type_id`),
  ADD CONSTRAINT `vehicle_details_ibfk_3` FOREIGN KEY (`vehicle_branch_id`) REFERENCES `branch` (`branch_id`),
  ADD CONSTRAINT `vehicle_details_ibfk_4` FOREIGN KEY (`car_id`) REFERENCES `vehicle` (`car_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
