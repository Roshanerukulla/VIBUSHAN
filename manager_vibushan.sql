-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 24, 2024 at 01:00 PM
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
-- Table structure for table `manager_vibushan`
--

CREATE TABLE `manager_vibushan` (
  `manager_id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manager_vibushan`
--

INSERT INTO `manager_vibushan` (`manager_id`, `email`, `password`) VALUES
(16, 'a2@vibushan.com', '$2y$10$UHWSZLZmBZ/J31djL.NAS.EQckxRKXUpxzaQrPjXet8A0awxlzucq'),
(17, 'a2@vibushan.com', '$2y$10$aKCtu7zbtU7/h4kPE2.kTu7uDWW8gyD8gYfnyBAxpNYqDp.N2.ub.'),
(18, 'sri@vibushan.com', '464646'),
(19, 'a3@vibushan.com', '$2y$10$nlbpSRY6znrpb.DNg2kev.zyc.HS1RVrbSEiUD.kqTdGkg1wPB7wG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `manager_vibushan`
--
ALTER TABLE `manager_vibushan`
  ADD PRIMARY KEY (`manager_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manager_vibushan`
--
ALTER TABLE `manager_vibushan`
  MODIFY `manager_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
