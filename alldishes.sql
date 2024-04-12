-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 12, 2024 at 02:19 AM
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
-- Database: `rerukull_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `alldishes`
--

CREATE TABLE `alldishes` (
  `dish_id` int(11) NOT NULL,
  `dish_name` varchar(255) NOT NULL,
  `cuisine` varchar(50) NOT NULL,
  `ingredients` text NOT NULL,
  `veg_or_nonveg` enum('Vegetarian','Non-Vegetarian') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `available` enum('Available','Not Available') NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alldishes`
--

INSERT INTO `alldishes` (`dish_id`, `dish_name`, `cuisine`, `ingredients`, `veg_or_nonveg`, `price`, `available`, `image`) VALUES
(1, 'Paneer Tikka', 'Indian', 'Grilled chunks of paneer (Indian cottage cheese) marinated in spices.', 'Vegetarian', '8.99', 'Available', 'D:\\WEBDATBASEPROJECT\\VIBUSHAN\\foodimages\\paneer_butter_masala.jpg'),
(2, 'Chole Bhature', 'Indian', 'Spicy chickpea curry served with fried bread.', 'Vegetarian', '7.99', 'Available', 'D:\\WEBDATBASEPROJECT\\VIBUSHAN\\foodimages\\cholebhature.jpg'),
(3, 'Aloo Gobi', 'Indian', 'Potato and cauliflower curry cooked with spices.', 'Vegetarian', '6.99', 'Available', 'D:\\WEBDATBASEPROJECT\\VIBUSHAN\\foodimages\\aloogobi.jpg'),
(4, 'Palak Paneer', 'Indian', 'Spinach curry with paneer.', 'Vegetarian', '9.99', 'Not Available', NULL),
(5, 'Vegetable Biryani', 'Indian', 'Fragrant rice cooked with mixed vegetables and spices.', 'Vegetarian', '10.99', 'Not Available', NULL),
(6, 'Dal Tadka', 'Indian', 'Tempered lentils cooked with spices.', 'Vegetarian', '5.99', 'Not Available', NULL),
(7, 'Baingan Bharta', 'Indian', 'Smoky mashed eggplant cooked with spices.', 'Vegetarian', '7.99', 'Not Available', NULL),
(8, 'Samosa', 'Indian', 'Crispy pastry filled with spiced potatoes and peas.', 'Vegetarian', '2.99', 'Not Available', NULL),
(9, 'Aloo Paratha', 'Indian', 'Stuffed Indian flatbread with spiced potatoes.', 'Vegetarian', '4.99', 'Not Available', NULL),
(10, 'Pani Puri', 'Indian', 'Hollow crispy puris filled with spicy water, tamarind chutney, potatoes, and chickpeas.', 'Vegetarian', '3.99', 'Not Available', NULL),
(11, 'Chicken Tikka Masala', 'Indian', 'Grilled chicken cooked in a creamy tomato-based sauce.', 'Non-Vegetarian', '12.99', 'Available', 'D:\\WEBDATBASEPROJECT\\VIBUSHAN\\foodimages\\chickentikkamasala.jpg'),
(12, 'Butter Chicken', 'Indian', 'Tandoori chicken cooked in a rich tomato and butter sauce.', 'Non-Vegetarian', '13.99', 'Available', 'D:\\WEBDATBASEPROJECT\\VIBUSHAN\\foodimages\\butter-chicken.jpg'),
(13, 'Rogan Josh', 'Indian', 'Tender lamb cooked in a flavorful gravy with spices.', 'Non-Vegetarian', '14.99', 'Not Available', NULL),
(14, 'Fish Curry', 'Indian', 'Fish cooked in a spicy coconut or tomato-based gravy.', 'Non-Vegetarian', '11.99', 'Not Available', NULL),
(15, 'Tandoori Chicken', 'Indian', 'Marinated chicken cooked in a tandoor (clay oven).', 'Non-Vegetarian', '10.99', 'Not Available', NULL),
(16, 'Hyderabadi Biryani', 'Indian', 'Spicy rice dish cooked with marinated meat, typically chicken or mutton.', 'Non-Vegetarian', '12.99', 'Not Available', NULL),
(17, 'Kerala Fish Curry', 'Indian', 'Spicy and tangy fish curry from the Kerala region.', 'Non-Vegetarian', '13.99', 'Not Available', NULL),
(18, 'Mutton Korma', 'Indian', 'Tender mutton pieces cooked in a rich, creamy gravy.', 'Non-Vegetarian', '15.99', 'Not Available', NULL),
(19, 'Egg Curry', 'Indian', 'Hard-boiled eggs cooked in a spicy gravy.', 'Non-Vegetarian', '9.99', 'Not Available', NULL),
(20, 'Chicken Biryani', 'Indian', 'Fragrant rice cooked with marinated chicken and spices.', 'Non-Vegetarian', '11.99', 'Not Available', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alldishes`
--
ALTER TABLE `alldishes`
  ADD PRIMARY KEY (`dish_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alldishes`
--
ALTER TABLE `alldishes`
  MODIFY `dish_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
