-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 18, 2024 at 05:42 PM
-- Server version: 10.6.16-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bshelke_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_info`
--

CREATE TABLE `customer_info` (
  `customer_id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `quantity_selected` int(11) NOT NULL DEFAULT 0,
  `date` datetime DEFAULT NULL,
  `status` enum('Done','In progress') NOT NULL DEFAULT 'Done'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_info`
--

INSERT INTO `customer_info` (`customer_id`, `dish_id`, `quantity_selected`, `date`, `status`) VALUES
(0, 12, 1, '2024-04-18 00:00:00', 'Done'),
(0, 3, 1, '2024-04-18 00:00:00', 'Done'),
(0, 2, 1, '2024-04-18 00:00:00', 'Done'),
(0, 11, 1, '2024-04-18 00:00:00', 'Done'),
(0, 2, 1, '2024-04-18 00:00:00', 'Done'),
(0, 3, 1, '2024-04-18 00:00:00', 'Done'),
(3, 3, 5, '2024-04-18 00:00:00', 'Done'),
(3, 12, 1, '2024-04-18 00:00:00', 'Done'),
(3, 1, 1, '2024-04-18 00:00:00', 'Done');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
