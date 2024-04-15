-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 15, 2024 at 12:23 AM
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
-- Table structure for table `vibushan_menu`
--

CREATE TABLE `vibushan_menu` (
  `dish_id` int(2) NOT NULL,
  `dish_name` varchar(100) NOT NULL,
  `cuisine` varchar(100) NOT NULL,
  `ingredients` varchar(255) NOT NULL,
  `veg_or_nonveg` enum('Veg','NonVeg') NOT NULL,
  `quantity` int(10) NOT NULL DEFAULT 0,
  `is_available` enum('Yes','No') NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vibushan_menu`
--

INSERT INTO `vibushan_menu` (`dish_id`, `dish_name`, `cuisine`, `ingredients`, `veg_or_nonveg`, `quantity`, `is_available`) VALUES
(1, 'Water', '', 'Water', 'Veg', 0, 'Yes'),
(2, 'Hyderabadi Dum Biryani', 'Indian', 'Basmati Rice, Chicken, Indian Spices', 'NonVeg', 1, 'No'),
(3, 'Chicken 65', 'Indian', 'Chicken, 65 Indian Spices', 'NonVeg', 2, 'Yes'),
(4, 'Sushi', 'Japanese', 'Fish, Rice', 'NonVeg', 2, 'No'),
(5, 'Falooda', 'Indian', 'Milk, Sugar, Vanilla', 'Veg', 0, 'Yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vibushan_menu`
--
ALTER TABLE `vibushan_menu`
  ADD PRIMARY KEY (`dish_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vibushan_menu`
--
ALTER TABLE `vibushan_menu`
  MODIFY `dish_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
