-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2023 at 02:00 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Security_Code` int(55) NOT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Security_Code`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Administrator', 'admin', 7854445410, 1100, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2021-01-05 05:38:23'),
(2, NULL, 'admin', NULL, 0, NULL, 'admin', '2023-07-09 02:08:50');

-- --------------------------------------------------------

--
-- Table structure for table `rfid`
--

CREATE TABLE `rfid` (
  `STT` int(6) UNSIGNED NOT NULL,
  `ID` varchar(30) NOT NULL,
  `CAR` varchar(30) NOT NULL,
  `reading_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rfid`
--

INSERT INTO `rfid` (`STT`, `ID`, `CAR`, `reading_time`) VALUES
(1, '7B69A311', '30A-128.93', '2023-05-11 01:24:20'),
(2, 'A9C43004', '20A-128.94', '2023-05-11 01:25:06');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_info`
--

CREATE TABLE `vehicle_info` (
  `STT` int(10) NOT NULL PRIMARY KEY,
  `ID` varchar(30) NOT NULL,
  `VehicleCompanyname` varchar(120) DEFAULT NULL,
  `RegistrationNumber` varchar(120) NOT NULL,
  `OwnerName` varchar(120) DEFAULT NULL,
  `OwnerContactNumber` bigint(10) DEFAULT NULL,
  `InTime` timestamp NULL DEFAULT current_timestamp(),
  `OutTime` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `ParkingCharge` varchar(120) DEFAULT NULL,
  `Status` varchar(5) NOT NULL,
  `order_number` varchar(20) DEFAULT NULL,
  `latest_action_time` datetime DEFAULT NULL,
  `payment_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_info`
--

INSERT INTO `vehicle_info` (`STT`, `ID`, `VehicleCompanyname`, `RegistrationNumber`, `OwnerName`, `OwnerContactNumber`, `InTime`, `OutTime`, `ParkingCharge`, `Status`, `order_number`, `latest_action_time`, `payment_status`) VALUES
(1, '', 'Hyundai', 'GGZ-1155', 'Jamie Macon', 8956232528, '2021-03-09 05:58:38', '2023-07-11 09:35:59', '34', 'Out', '8818', '2023-07-11 16:35:59', 1),
(2, '', 'KTM', 'GTM-1069', 'Dan Wilson', 8989898989, '2021-03-09 08:58:38', '2023-07-11 10:26:49', '20', 'Out', '3439', NULL, NULL),
(3, '', 'Yamaha', 'JFF-7888', 'Lynn Roberts\n', 7845123697, '2021-03-09 08:58:38', '2023-07-10 03:00:52', '20', 'Out', NULL, NULL, NULL),
(4, '', 'Suzuki', 'PLO-8507', 'Charles Mathew', 2132654447, '2021-03-09 08:58:38', '2023-07-10 03:00:52', '20', 'Out', NULL, NULL, NULL),
(5, '', 'Piaggio', 'DLE-7701', 'Theresa Hay\n', 4654654654, '2021-03-09 08:58:38', '2023-07-10 03:00:52', '15', 'Out', NULL, NULL, NULL),
(6, '', 'Roll Royce', '88-8888', 'Nguyen ', 899309985, '2021-03-09 08:58:38', '2023-07-10 03:00:52', '50', 'Out', NULL, NULL, NULL),
(7, '', 'Honda', 'LDC-7019', 'Shannon Pinson\n', 1234567890, '2021-03-09 11:03:05', '2023-07-10 03:00:52', '5', 'Out', NULL, NULL, NULL),
(8, '', 'Yamaha', 'FYS-6969', 'Mark Paull', 1234567890, '2021-03-09 11:32:02', '2023-07-10 03:00:52', '5', 'Out', NULL, NULL, NULL),
(9, '', 'Ford ', 'CAS-7850', 'Bernice Willilams\n', 7411112000, '2021-03-07 10:42:52', '2023-07-11 08:41:24', '7', 'Out', '7990', NULL, NULL),
(11, '', 'Volkswagen', 'STT-7002', 'Colin Greenwood', 2574442560, '2021-03-08 13:50:15', '2023-07-11 11:50:58', NULL, '', '4062', NULL, NULL),
(12, '', 'KTM', 'ILS-2580', 'Bruno Denn', 1254447850, '2021-03-08 09:34:55', '2023-07-10 03:00:52', '30', 'Out', NULL, NULL, NULL),
(13, '', 'Hyundai', 'SSO-8800', 'Tanya Chilton\n', 2570005640, '2021-03-09 13:09:16', '2023-07-11 11:51:02', NULL, '', NULL, NULL, NULL),
(14, '', 'Hyundai', 'GEP-7805', 'Matthew  Foust\n', 6667869500, '2021-07-16 15:28:32', '2023-07-11 08:42:49', '5', 'Out', '6012', NULL, NULL),
(15, '', 'Tesla', 'QWE-9602', 'Paul Nicholls', 7412589658, '2021-07-17 16:18:01', '2023-07-10 03:00:52', '5', 'Out', NULL, NULL, NULL),
(16, '', 'Renault', 'ABE-3470', 'Alyse Conn', 7896547850, '2021-07-17 16:59:26', '2023-07-10 03:00:52', '2', 'Out', NULL, NULL, NULL),
(17, '', 'Volkswagen', 'TRS-8027', 'Bonnie Jackson', 7014741470, '2021-07-17 17:40:22', '2023-07-11 11:51:06', NULL, '', NULL, NULL, NULL),
(18, '', 'Chevrolet', 'VNT-9135', 'Larry Clark', 7890240001, '2021-07-17 17:43:16', '2023-07-11 11:50:51', NULL, '', NULL, NULL, NULL),
(19, '', 'MG', 'PIJ-8802', 'Jessica Garner', 7012560025, '2021-07-17 17:44:07', '2023-07-11 11:52:30', '3', 'OUT', '3757', NULL, NULL),
(20, '', 'Kawasaki', 'LLL-8987', 'James', 7014569980, '2021-07-17 17:46:37', '2023-07-11 11:50:27', NULL, '', '8271', NULL, NULL),
(46, '', NULL, 'saocungduoc', NULL, NULL, '2023-07-11 07:55:00', '2023-07-11 09:38:41', '10000', 'OUT', '7927', '2023-07-11 16:38:41', 1),
(47, '', NULL, 'saocungduoc', NULL, NULL, '2023-07-11 11:36:37', '2023-07-11 11:53:19', NULL, 'OUT', NULL, NULL, 0),
(48, '', NULL, 'saocungduoc', NULL, NULL, '2023-07-11 11:37:00', '2023-07-11 11:53:15', NULL, 'OUT', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `rfid`
--
ALTER TABLE `rfid`
  ADD PRIMARY KEY (`STT`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `vehicle_info`
--
ALTER TABLE `vehicle_info`
  ADD PRIMARY KEY (`STT`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rfid`
--
ALTER TABLE `rfid`
  MODIFY `STT` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicle_info`
--
ALTER TABLE `vehicle_info`
  MODIFY `STT` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
