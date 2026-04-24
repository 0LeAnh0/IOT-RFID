-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2023 at 05:46 PM
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
-- Database: `vehicle-parking-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `paymentstatus`
--

CREATE TABLE `paymentstatus` (
  `number_plate` varchar(120) DEFAULT NULL,
  `payment_status` tinyint(1) DEFAULT 0,
  `order_number` varchar(20) DEFAULT NULL,
  `latest_action_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymentstatus`
--

INSERT INTO `paymentstatus` (`number_plate`, `payment_status`, `order_number`, `latest_action_time`) VALUES
('GGZ-1155', 1, '5294', '2023-07-07 15:22:36'),
('GTM-1069', 1, '3596', '2023-07-07 15:26:59'),
('JFF-7888', 1, '2211', '2023-07-07 16:56:51'),
('PLO-8507', 1, '5231', '2023-07-07 16:58:42'),
('DLE-7701', 1, '7215', '2023-07-07 17:01:19'),
('GZG-7896', 1, '1240', '2023-07-07 17:49:37'),
('LDC-7019', 1, '3410', '2023-07-09 22:29:32'),
('FYS-6969', NULL, '2062', NULL),
('CAS-7850', NULL, NULL, NULL),
('CST-6907', NULL, NULL, NULL),
('STT-7002', NULL, NULL, NULL),
('ILS-2580', NULL, NULL, NULL),
('SSO-8800', NULL, NULL, NULL),
('GEP-7805', NULL, NULL, NULL),
('QWE-9602', NULL, NULL, NULL),
('ABE-3470', NULL, NULL, NULL),
('TRS-8027', NULL, '4696', NULL),
('VNT-9135', NULL, NULL, NULL),
('PIJ-8802', NULL, NULL, NULL),
('LLL-8987', NULL, NULL, NULL),
('123456', 1, '1234', '2023-07-07 15:21:30'),
('123455', 1, '7141', '2023-07-07 17:03:04');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
