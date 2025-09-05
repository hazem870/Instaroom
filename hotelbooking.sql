-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2025 at 05:29 PM
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
-- Database: `hotelbooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_cred`
--

CREATE TABLE `admin_cred` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL,
  `address` varchar(150) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `pincode` int(11) NOT NULL,
  `dob` date NOT NULL DEFAULT current_timestamp(),
  `profile` varchar(100) NOT NULL DEFAULT 'Default.png',
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_cred`
--

INSERT INTO `admin_cred` (`sr_no`, `admin_name`, `email`, `admin_pass`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `datentime`) VALUES
(1, 'HAZEM', 'hazemmohummedbusiness@gmail.com', '$2y$10$2pZuLFrZUWXhqMjSDcl.9OyZ7ov3d/G/LHUTwQNQWK.9LO.j0n5fG', 'Taiz', '0771612635', 13113, '2025-02-01', '1743638360_3135716.png', '2025-04-02 03:07:24');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `total_pay` int(11) NOT NULL,
  `room_no` varchar(100) DEFAULT NULL,
  `user_name` varchar(100) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`sr_no`, `booking_id`, `room_name`, `price`, `total_pay`, `room_no`, `user_name`, `phonenum`, `address`) VALUES
(1, 1, 'Simple Room', 300, 300, NULL, 'amey', '123', 'ad'),
(2, 2, 'Simple Room', 300, 600, 'a2', 'amey', '123', 'ad'),
(3, 3, 'Simple Room', 300, 1800, NULL, 'amey', '123', 'ad'),
(4, 4, 'Supreme deluxe room', 900, 4500, NULL, 'amey', '123', 'ad'),
(5, 5, 'Supreme deluxe room', 900, 900, NULL, 'amey', '123', 'ad'),
(6, 6, 'Supreme deluxe room', 900, 7200, '52', 'amey', '12323432', 'ad2342343'),
(7, 7, 'Supreme deluxe room', 900, 900, NULL, 'amey', '123', 'ad'),
(8, 8, 'Simple Room', 300, 600, NULL, 'amey', '123', 'ad'),
(9, 9, 'Luxury Room', 600, 3000, '159A', 'amey', '123', 'ad'),
(10, 10, 'Luxury Room', 600, 1800, '15S', 'neal', '123', 'ad'),
(11, 11, 'Supreme deluxe room', 900, 2700, '1', 'neal', '123', 'ad'),
(12, 12, 'Simple Room', 300, 1200, '2', 'neal', '123', 'ad'),
(13, 13, 'Deluxe Room', 500, 3000, '23', 'neal', '123', 'ad'),
(14, 14, 'Luxury Room', 600, 2400, '44', 'neal', '123', 'ad'),
(15, 15, 'Luxury Room', 600, 1200, NULL, 'neal', '123', 'ad'),
(16, 16, 'Luxury Room', 600, 1200, '1', 'neal', '123', 'ad'),
(17, 17, 'Simple Room', 300, 900, '20A', 'neal', '123', 'ad'),
(18, 18, 'Luxury Room', 600, 1200, NULL, 'amey', '1234', 'asd'),
(19, 19, 'Simple Room', 300, 300, NULL, 'neal', '123', 'ad'),
(20, 20, 'Simple Room', 300, 600, NULL, 'neal', '123', 'ad'),
(21, 21, 'Mariot', 5000, 5000, NULL, 'Hazem', '0771612635', 'Taiz'),
(22, 22, 'Simple Room', 300, 4800, NULL, 'Hazem', '0771612635', 'Taiz'),
(23, 23, 'Supreme deluxe room', 900, 900, NULL, 'Hazem', '0771612635', 'Taiz'),
(24, 24, 'Supreme deluxe room', 900, 900, NULL, 'Hazem', '0771612635', 'Taiz'),
(25, 25, 'Mariot', 5000, 5000, NULL, 'Hazem', '0771612635', 'Taiz'),
(26, 26, 'Mariot', 5000, 5000, NULL, 'Hazem', '0771612635', 'Taiz'),
(27, 27, 'Mariot', 5000, 5000, NULL, 'Hazem', '0771612635', 'Taiz'),
(28, 29, 'Mariot', 5000, 10000, NULL, 'Hazem', '0771612635', 'Taiz'),
(29, 30, 'Mariot', 5000, 5000, NULL, 'Hazem', '0771612635', 'Taiz'),
(30, 31, 'Mariot', 5000, 5000, NULL, 'Hazem', '0771612635', 'Taiz'),
(31, 32, 'Mariot', 5000, 5000, NULL, 'Hazem', '0771612635', 'Taiz'),
(32, 33, 'Mariot', 5000, 5000, NULL, 'Hazem', '0771612635', 'Taiz'),
(33, 34, 'Mariot', 5000, 5000, NULL, 'Hazem', '0771612635', 'Taiz'),
(34, 35, 'Mariot', 5000, 5000, NULL, 'Hazem', '0771612635', 'Taiz'),
(35, 36, 'Supreme deluxe room', 900, 900, NULL, 'Hazem', '0771612635', 'Taiz'),
(36, 37, 'Supreme deluxe room', 900, 900, NULL, 'Hazem', '0771612635', 'Taiz'),
(37, 38, 'Supreme deluxe room', 900, 900, NULL, 'Hazem', '0771612635', 'Taiz'),
(38, 39, 'Supreme deluxe room', 900, 900, NULL, 'Hazem', '0771612635', 'Taiz'),
(39, 40, 'Supreme deluxe room', 900, 900, NULL, 'Hazem', '0771612635', 'Taiz'),
(40, 41, 'Supreme deluxe room', 900, 900, NULL, 'Hazem', '0771612635', 'Taiz'),
(41, 42, 'Supreme deluxe room', 900, 900, NULL, 'Hazem', '0771612635', 'Taiz'),
(42, 43, 'Mariot', 5000, 5000, NULL, 'Hazem', '0771612635', 'Taiz'),
(43, 44, 'Supreme deluxe room', 900, 900, '11', 'Hazem', '0771612635', 'Taiz'),
(44, 45, 'Mariot', 5000, 5000, '11', 'Hazem', '0771612635', 'Taiz'),
(45, 46, 'Mariot', 5000, 5000, NULL, 'Hazem', '0771612635', 'Taiz'),
(46, 47, 'Suhail Host', 1000, 1000, NULL, 'Hazem', '0771612635', 'Taiz'),
(47, 48, 'Luxury Room', 600, 2400, NULL, 'Hazem', '0771612635', 'Taiz'),
(48, 51, 'Deluxe Room', 500, 2000, NULL, 'Hazem', '0771612635', 'Taiz'),
(49, 52, 'Mariot', 5000, 55000, NULL, 'Hazem', '0771612635', 'Taiz'),
(50, 53, 'Mariot', 5000, 30000, '91', 'Hazem', '0771612635', 'Taiz'),
(51, 54, 'Hazem Host', 1000, 4000, NULL, 'Hazem', '0771612635', 'Taiz'),
(52, 55, 'Mariot', 5000, 35000, NULL, 'Hazem', '0771612635', 'Taiz'),
(53, 56, 'Mariot', 5000, 5000, '11', 'Galal', '774266565', 'Taiz');

-- --------------------------------------------------------

--
-- Table structure for table `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `arrival` int(11) NOT NULL DEFAULT 0,
  `refund` int(11) DEFAULT NULL,
  `booking_status` varchar(100) NOT NULL DEFAULT 'pending',
  `order_id` varchar(150) NOT NULL,
  `trans_id` varchar(200) DEFAULT NULL,
  `trans_amt` int(11) NOT NULL,
  `trans_status` varchar(100) NOT NULL DEFAULT 'pending',
  `trans_resp_msg` varchar(200) DEFAULT NULL,
  `rate_review` int(11) DEFAULT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_order`
--

INSERT INTO `booking_order` (`booking_id`, `user_id`, `room_id`, `check_in`, `check_out`, `arrival`, `refund`, `booking_status`, `order_id`, `trans_id`, `trans_amt`, `trans_status`, `trans_resp_msg`, `rate_review`, `datentime`) VALUES
(1, 2, 3, '2022-12-15', '2022-12-17', 0, NULL, 'pending', 'ORD_21055700', NULL, 0, 'pending', NULL, NULL, '2022-12-10 01:50:12'),
(2, 2, 3, '2022-07-20', '2022-07-22', 1, NULL, 'booked', 'ORD_24215693', '20220720111212800110168128204225279', 600, 'TXN_SUCCESS', 'Txn Success', NULL, '2022-07-20 02:14:44'),
(3, 2, 3, '2022-07-20', '2022-07-26', 0, 1, 'cancelled', 'ORD_26312547', '20220720111212800110168165603901976', 1800, 'TXN_SUCCESS', 'Txn Success', NULL, '2022-07-20 02:19:00'),
(4, 2, 6, '2022-07-20', '2022-07-25', 0, NULL, 'payment failed', 'ORD_28394638', '20220720111212800110168372503893816', 4500, 'TXN_FAILURE', 'Your payment has been declined by your bank. Please try again or use a different method to complete the payment.', NULL, '2022-07-20 02:30:52'),
(5, 2, 6, '2022-07-20', '2022-07-21', 0, 1, 'cancelled', 'ORD_22877860', '20220720111212800110168627705312020', 900, 'TXN_SUCCESS', 'Txn Success', NULL, '2022-07-20 02:32:09'),
(6, 2, 6, '2022-07-20', '2022-07-28', 1, NULL, 'booked', 'ORD_28689687', '20220720111212800110168303704048087', 7200, 'TXN_SUCCESS', 'Txn Success', 1, '2022-07-20 02:34:46'),
(7, 2, 6, '2022-07-29', '2022-07-30', 0, NULL, 'pending', 'ORD_24272313', NULL, 0, 'pending', NULL, NULL, '2022-07-29 01:13:42'),
(8, 2, 3, '2022-08-14', '2022-08-16', 0, 1, 'cancelled', 'ORD_22541670', '20220814111212800110168092803967754', 600, 'TXN_SUCCESS', 'Txn Success', NULL, '2022-08-14 01:16:05'),
(9, 2, 5, '2022-08-15', '2022-08-20', 1, NULL, 'booked', 'ORD_25267746', '20220815111212800110168656003990120', 3000, 'TXN_SUCCESS', 'Txn Success', 1, '2022-08-15 19:32:05'),
(10, 2, 5, '2022-08-18', '2022-08-21', 1, NULL, 'booked', 'ORD_27668816', '20220815111212800110168905703947446', 1800, 'TXN_SUCCESS', 'Txn Success', 1, '2022-08-15 19:32:58'),
(11, 2, 6, '2022-08-20', '2022-08-23', 1, NULL, 'booked', 'ORD_25750549', '20220820111212800110168431303975409', 2700, 'TXN_SUCCESS', 'Txn Success', 1, '2022-08-20 00:19:57'),
(12, 2, 3, '2022-08-20', '2022-08-24', 1, NULL, 'booked', 'ORD_2445093', '20220820111212800110168173403969278', 1200, 'TXN_SUCCESS', 'Txn Success', 1, '2022-08-20 00:20:23'),
(13, 2, 4, '2022-08-20', '2022-08-26', 1, NULL, 'booked', 'ORD_29233995', '20220820111212800110168584503978338', 3000, 'TXN_SUCCESS', 'Txn Success', 1, '2022-08-20 00:20:45'),
(14, 2, 5, '2022-08-20', '2022-08-24', 1, NULL, 'booked', 'ORD_28902800', '20220820111212800110168816503988359', 2400, 'TXN_SUCCESS', 'Txn Success', 1, '2022-08-20 00:21:06'),
(15, 2, 5, '2022-08-25', '2022-08-27', 0, 1, 'cancelled', 'ORD_2240367', '20220825111212800110168807304010818', 1200, 'TXN_SUCCESS', 'Txn Success', NULL, '2019-08-21 01:51:28'),
(16, 2, 5, '2022-08-26', '2022-08-28', 1, NULL, 'booked', 'ORD_28784829', '20220825111212800110168627505415606', 1200, 'TXN_SUCCESS', 'Txn Success', 1, '2022-08-25 01:52:04'),
(17, 2, 3, '2022-09-08', '2022-09-11', 1, NULL, 'booked', 'ORD_21289330', '20220908111212800110168809204050263', 900, 'TXN_SUCCESS', 'Txn Success', 0, '2022-09-08 01:15:30'),
(18, 5, 5, '2022-12-14', '2022-12-16', 0, NULL, 'pending', 'ORD_52387163', NULL, 0, 'pending', NULL, NULL, '2022-12-13 03:05:43'),
(19, 2, 3, '2022-12-14', '2022-12-15', 0, NULL, 'pending', 'ORD_28406333', NULL, 0, 'pending', NULL, NULL, '2022-12-13 10:01:15'),
(20, 2, 3, '2022-12-14', '2022-12-16', 0, NULL, 'pending', 'ORD_26701861', NULL, 0, 'pending', NULL, NULL, '2022-12-13 10:03:51'),
(21, 10, 7, '2025-02-02', '2025-02-03', 0, NULL, 'pending', 'ORD_109685556', NULL, 0, 'pending', NULL, NULL, '2025-02-02 00:04:51'),
(22, 10, 3, '2025-02-02', '2025-02-18', 0, NULL, 'pending', 'ORD_104146837', NULL, 0, 'pending', NULL, NULL, '2025-02-02 00:22:56'),
(23, 10, 6, '2025-02-03', '2025-02-04', 0, NULL, 'pending', 'ORD_109868380', NULL, 0, 'Paid', NULL, NULL, '2025-02-02 23:50:29'),
(24, 10, 6, '2025-02-03', '2025-02-04', 0, NULL, 'pending', 'ORD_106573665', NULL, 0, 'Paid', NULL, NULL, '2025-02-02 23:53:33'),
(25, 10, 7, '2025-02-03', '2025-02-04', 0, NULL, 'pending', 'ORD_103773921', NULL, 0, 'Paid', NULL, NULL, '2025-02-02 23:54:07'),
(26, 10, 7, '2025-02-03', '2025-02-04', 0, NULL, 'pending', 'ORD_106111038', NULL, 0, 'Paid', NULL, NULL, '2025-02-02 23:54:27'),
(27, 10, 7, '2025-02-03', '2025-02-04', 0, NULL, 'pending', 'ORD_10112000', NULL, 0, 'Paid', NULL, NULL, '2025-02-02 23:54:47'),
(28, 10, 7, '2025-02-04', '2025-02-05', 0, NULL, 'pending', 'ORD_108286308', NULL, 0, 'Paid', NULL, NULL, '2025-02-03 22:42:57'),
(29, 10, 7, '2025-02-04', '2025-02-06', 0, NULL, 'pending', 'ORD_1067591', NULL, 0, 'Paid', NULL, NULL, '2025-02-03 22:48:23'),
(30, 10, 7, '2025-02-05', '2025-02-06', 0, NULL, 'pending', 'ORD_103310182', NULL, 0, 'Paid', NULL, NULL, '2025-02-05 20:02:28'),
(31, 10, 7, '2025-02-05', '2025-02-06', 0, NULL, 'pending', 'ORD_101738777567', NULL, 0, 'Paid', NULL, NULL, '2025-02-05 20:46:07'),
(32, 10, 7, '2025-02-05', '2025-02-06', 0, NULL, 'pending', 'ORD_101738778227', NULL, 0, 'Paid', NULL, NULL, '2025-02-05 20:57:07'),
(33, 10, 7, '2025-02-05', '2025-02-06', 0, NULL, 'pending', 'ORD_101738778324', NULL, 0, 'Paid', NULL, NULL, '2025-02-05 20:58:44'),
(34, 10, 7, '2025-02-05', '2025-02-06', 0, NULL, 'pending', 'ORD_101738778614', NULL, 0, 'Paid', NULL, NULL, '2025-02-05 21:03:34'),
(35, 10, 7, '2025-02-05', '2025-02-06', 0, NULL, 'pending', 'ORD_108886831', NULL, 0, 'pending', NULL, NULL, '2025-02-05 21:15:05'),
(36, 10, 6, '2025-02-05', '2025-02-06', 0, NULL, 'pending', 'ORD_105715361', NULL, 0, 'pending', NULL, NULL, '2025-02-05 21:17:00'),
(37, 10, 6, '2025-02-05', '2025-02-06', 0, NULL, 'TXN_SUCCESS', 'ORD_107968084', 'FAKE_TXN_939641', 900, 'TXN_SUCCESS', 'Payment successful', NULL, '2025-02-05 21:39:28'),
(38, 10, 6, '2025-02-05', '2025-02-06', 0, NULL, 'TXN_SUCCESS', 'ORD_108451695', 'FAKE_TXN_232583', 900, 'TXN_SUCCESS', 'Payment successful', NULL, '2025-02-05 21:46:08'),
(39, 10, 6, '2025-02-06', '2025-02-07', 0, NULL, 'TXN_SUCCESS', 'ORD_107991389', 'FAKE_TXN_246096', 900, 'TXN_SUCCESS', 'Payment successful', NULL, '2025-02-06 22:46:51'),
(40, 10, 6, '2025-02-06', '2025-02-07', 0, NULL, 'TXN_SUCCESS', 'ORD_101779739', 'FAKE_TXN_378932', 900, 'TXN_SUCCESS', 'Payment successful', NULL, '2025-02-06 22:58:11'),
(41, 10, 6, '2025-02-06', '2025-02-07', 0, NULL, 'TXN_SUCCESS', 'ORD_109336863', 'FAKE_TXN_387880', 900, 'TXN_SUCCESS', 'Payment successful', NULL, '2025-02-06 23:05:31'),
(42, 10, 6, '2025-02-06', '2025-02-07', 0, NULL, 'TXN_SUCCESS', 'ORD_106631581', 'TXN806569', 900, 'TXN_SUCCESS', '0', NULL, '2025-02-06 23:21:37'),
(43, 10, 7, '2025-02-06', '2025-02-07', 0, NULL, 'TXN_SUCCESS', 'ORD_10641354', 'FAKE_TXN_218832', 5000, 'TXN_SUCCESS', 'Payment successful', NULL, '2025-02-06 23:24:53'),
(44, 10, 6, '2025-02-06', '2025-02-07', 1, NULL, 'booked', 'ORD_105576603', 'TEST123456', 900, 'TXN_SUCCESS', 'Payment successful', 0, '2025-02-06 23:36:37'),
(45, 10, 7, '2025-02-06', '2025-02-07', 1, NULL, 'booked', 'ORD_101726225', 'TEST123456', 5000, 'TXN_SUCCESS', 'Payment successful', 0, '2025-02-06 23:42:37'),
(46, 10, 7, '2025-02-06', '2025-02-07', 1, NULL, 'booked', 'ORD_102502888', 'TEST123456', 5000, 'TXN_SUCCESS', 'Payment successful', 1, '2025-02-06 23:43:15'),
(47, 10, 9, '2025-02-22', '2025-02-23', 0, NULL, 'booked', 'ORD_103970468', 'TEST123456', 1000, 'TXN_SUCCESS', 'Payment successful', NULL, '2025-02-22 01:03:29'),
(48, 10, 5, '2025-03-13', '2025-03-17', 0, 1, 'cancelled', 'ORD_106688636', 'TEST123456', 2400, 'TXN_SUCCESS', 'Payment successful', NULL, '2025-03-13 01:22:11'),
(49, 10, 5, '2025-03-15', '2025-03-19', 0, NULL, 'booked', 'ORD_103649361', 'TEST123456', 2400, 'TXN_SUCCESS', 'Payment successful', NULL, '2025-03-15 03:10:24'),
(50, 10, 4, '2025-03-15', '2025-03-26', 0, NULL, 'booked', 'ORD_104587334', 'TEST123456', 5500, 'TXN_SUCCESS', 'Payment successful', NULL, '2025-03-15 03:12:26'),
(51, 10, 4, '2025-03-15', '2025-03-19', 0, 0, 'cancelled', 'ORD_10593062', 'TEST123456', 2000, 'TXN_SUCCESS', 'Payment successful', NULL, '2025-03-15 03:13:14'),
(52, 10, 7, '2025-03-16', '2025-03-27', 0, 0, 'cancelled', 'ORD_103144417', 'TEST123456', 55000, 'TXN_SUCCESS', 'Payment successful', NULL, '2025-03-16 02:35:51'),
(53, 10, 7, '2025-03-20', '2025-03-26', 1, NULL, 'booked', 'ORD_101674237', 'TEST123456', 30000, 'TXN_SUCCESS', 'Payment successful', 0, '2025-03-20 01:12:10'),
(54, 10, 8, '2025-03-20', '2025-03-24', 0, NULL, 'booked', 'ORD_10438993', 'TEST123456', 4000, 'TXN_SUCCESS', 'Payment successful', NULL, '2025-03-20 01:27:26'),
(55, 10, 7, '2025-04-02', '2025-04-09', 0, NULL, 'booked', 'ORD_106783743', 'TEST123456', 35000, 'TXN_SUCCESS', 'Payment successful', NULL, '2025-04-02 01:05:23'),
(56, 13, 7, '2025-04-06', '2025-04-07', 1, NULL, 'booked', 'ORD_136198596', 'TEST123456', 5000, 'TXN_SUCCESS', 'Payment successful', 0, '2025-04-06 01:13:44');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `sr_no` int(11) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`sr_no`, `image`) VALUES
(4, 'IMG_62045.png'),
(5, 'IMG_93127.png'),
(6, 'IMG_99736.png'),
(8, 'IMG_40905.png'),
(9, 'IMG_55677.png');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `pn1` bigint(20) NOT NULL,
  `pn2` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `insta` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `pn2`, `email`, `fb`, `insta`, `tw`, `iframe`) VALUES
(1, 'Taiz', 'https://goo.gl/maps/', 771612635, 783951019, 'hazemmohummed@gmail.com', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.google.com/');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `description`) VALUES
(13, 'IMG_43553.svg', 'Wifi', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus incidunt odio quos dolore commodi repudiandae tenetur.'),
(14, 'IMG_49949.svg', 'Air conditioner', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus incidunt odio quos dolore commodi repudiandae tenetur.'),
(15, 'IMG_41622.svg', 'Television', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus incidunt odio quos dolore commodi repudiandae tenetur.'),
(17, 'IMG_47816.svg', 'Spa', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus incidunt odio quos dolore commodi repudiandae tenetur.'),
(18, 'IMG_96423.svg', 'Room Heater', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus incidunt odio quos dolore commodi repudiandae tenetur.'),
(19, 'IMG_27079.svg', 'Geyser', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus incidunt odio quos dolore commodi repudiandae tenetur.');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(13, 'bedroom'),
(14, 'balcony'),
(15, 'kitchen'),
(17, 'sofa');

-- --------------------------------------------------------

--
-- Table structure for table `host_cred`
--

CREATE TABLE `host_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` varchar(120) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `pincode` int(11) NOT NULL,
  `dob` date NOT NULL DEFAULT '2000-01-01',
  `profile` varchar(100) NOT NULL DEFAULT 'Default.png',
  `password` varchar(255) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 1,
  `token` varchar(200) DEFAULT NULL,
  `t_expire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `host_cred`
--

INSERT INTO `host_cred` (`id`, `name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `password`, `is_verified`, `token`, `t_expire`, `status`, `datentime`) VALUES
(1, 'HAZEM Host', 'hazemmohammed@gmail.com', 'Taiz', '783951019', 41055, '2001-01-01', '1740268674_photo_2025-02-14_23-50-38.jpg', '$2y$10$2pZuLFrZUWXhqMjSDcl.9OyZ7ov3d/G/LHUTwQNQWK.9LO.j0n5fG', 1, NULL, NULL, 1, '2025-02-23 00:30:37'),
(2, 'Suhail Host', 'Suhail@gmail.com', 'Taiz', '773951019', 41033, '2000-01-01', '', '$2y$10$wO1Zz9Z/7ZoU8HGAiF.UheqUtiXIiV6v1QCoMFaTKemNim2nYdzrq', 1, NULL, NULL, 1, '2025-02-23 00:30:37'),
(3, 'Hazem', 'hazemmohummedbusiness@gmail.com', 'Taiz', '0771612635', 3215, '2025-02-23', '1743638468_3135716.png', '$2y$10$2pZuLFrZUWXhqMjSDcl.9OyZ7ov3d/G/LHUTwQNQWK.9LO.j0n5fG', 1, NULL, NULL, 1, '2025-02-23 02:57:54'),
(4, 'Hazem2', 'hazemmohummed@gmail.com', 'Taiz', '07716126352', 1212, '2025-02-01', '1738357873_MyLogopng (2).png', '$2y$10$2pZuLFrZUWXhqMjSDcl.9OyZ7ov3d/G/LHUTwQNQWK.9LO.j0n5fG', 1, NULL, NULL, 1, '2025-04-01 06:13:40');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  `sender` varchar(10) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`sr_no`, `room_id`, `user_id`, `message`, `sender`, `seen`, `datentime`) VALUES
(1, 5, 10, 'I will be visiting.', 'user', 0, '2025-03-10 03:04:13'),
(2, 7, 10, 'I will be visiting soon', 'user', 0, '2025-03-10 03:09:09'),
(3, 7, 10, 'I forget my wallt', 'user', 0, '2025-03-10 03:12:43'),
(4, 7, 10, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. \n    Temporibus incidunt odio quos <br> dolore commodi repudiandae \n    tenetur consequuntur et similique asperiores.', 'user', 0, '2025-03-10 03:14:20'),
(5, 5, 10, 'sender test', 'user', 0, '2025-03-11 02:05:47'),
(8, 5, 10, 'welcome', 'host', 0, '2025-03-12 02:29:35'),
(9, 7, 13, 'كيف حاله امك', 'user', 0, '2025-04-06 01:28:32'),
(10, 7, 13, 'welcom', 'host', 0, '2025-04-06 01:29:07'),
(11, 7, 10, 'hazem', 'user', 0, '2025-04-27 17:13:20'),
(12, 5, 10, 'hazem', 'user', 0, '2025-04-27 17:14:56'),
(13, 7, 10, 'hazem', 'host', 0, '2025-04-27 17:27:00'),
(14, 7, 10, 'hello', 'host', 0, '2025-04-27 18:03:04'),
(15, 7, 10, 'hi hazem', 'user', 0, '2025-04-27 18:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `rating_review`
--

CREATE TABLE `rating_review` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(200) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating_review`
--

INSERT INTO `rating_review` (`sr_no`, `booking_id`, `room_id`, `user_id`, `rating`, `review`, `seen`, `datentime`) VALUES
(4, 14, 5, 2, 5, '1asdlkfj Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dicta quia nisi voluptates impedit perspiciatis, nobis libero ', 1, '2022-08-20 00:22:25'),
(5, 13, 4, 5, 3, '2asdlkfj Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dicta quia nisi voluptates impedit perspiciatis, nobis libero ', 1, '2022-08-20 00:22:30'),
(6, 12, 3, 6, 1, '3asdlkfj Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dicta quia nisi voluptates impedit perspiciatis, nobis libero ', 1, '2022-08-20 00:22:34'),
(8, 14, 5, 7, 5, '1asdlkfj Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dicta quia nisi voluptates impedit perspiciatis, nobis libero ', 1, '2022-08-20 00:22:25'),
(9, 12, 3, 8, 1, '3asdlkfj Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dicta quia nisi voluptates impedit perspiciatis, nobis libero ', 1, '2022-08-20 00:22:34'),
(10, 12, 3, 2, 1, '3asdlkfj Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dicta quia nisi voluptates impedit perspiciatis, nobis libero ', 1, '2022-08-20 00:22:34'),
(12, 46, 7, 10, 4, 'hazem', 1, '2025-02-07 00:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `description` varchar(350) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0,
  `host_id` int(11) NOT NULL DEFAULT 1,
  `location` varchar(200) NOT NULL DEFAULT 'Taiz Suber'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `description`, `status`, `removed`, `host_id`, `location`) VALUES
(1, 'simple room', 159, 58, 56, 12, 2, 'asdf asd', 1, 1, 1, 'Taiz Suber'),
(2, 'simple room 2', 785, 159, 85, 452, 10, 'adfasdfa sd', 1, 1, 1, 'Taiz Suber'),
(3, 'Simple Room', 250, 300, 10, 5, 3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dicta quia nisi voluptates impedit perspiciatis, nobis libero culpa error officiis totam?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dic', 1, 0, 1, 'Taiz Suber'),
(4, 'Deluxe Room', 300, 500, 10, 3, 2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dicta quia nisi voluptates impedit perspiciatis, nobis libero culpa error officiis totam?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dic', 1, 0, 1, 'Taiz Suber'),
(5, 'Luxury Room', 600, 600, 2, 8, 6, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dicta quia nisi voluptates impedit perspiciatis, nobis libero culpa error officiis totam?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dic', 1, 0, 1, 'Taiz Suber'),
(6, 'Supreme deluxe room', 500, 900, 12, 9, 10, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dicta quia nisi voluptates impedit perspiciatis, nobis libero culpa error officiis totam?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dic', 1, 0, 1, 'Taiz Suber'),
(7, 'Mariot', 1121, 5000, 2, 4, 2, 'Fantastic view.', 1, 0, 1, 'Taiz Suber'),
(8, 'Hazem Host', 331, 1000, 2, 3, 2, 'new', 1, 0, 1, 'Taiz Suber'),
(9, 'Suhail Host', 441, 1000, 2, 3, 2, 'Good', 1, 0, 2, 'Taiz Suber');

-- --------------------------------------------------------

--
-- Table structure for table `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_facilities`
--

INSERT INTO `room_facilities` (`sr_no`, `room_id`, `facilities_id`) VALUES
(29, 4, 14),
(30, 4, 18),
(31, 4, 19),
(35, 6, 13),
(36, 6, 14),
(37, 6, 18),
(38, 6, 19),
(39, 5, 13),
(40, 5, 14),
(41, 5, 18),
(42, 3, 14),
(43, 3, 15),
(44, 3, 18),
(45, 3, 19),
(46, 7, 13),
(47, 7, 15),
(48, 8, 13),
(49, 8, 15),
(50, 9, 13),
(51, 9, 15);

-- --------------------------------------------------------

--
-- Table structure for table `room_features`
--

CREATE TABLE `room_features` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_features`
--

INSERT INTO `room_features` (`sr_no`, `room_id`, `features_id`) VALUES
(16, 4, 13),
(17, 4, 14),
(18, 4, 15),
(22, 6, 13),
(23, 6, 14),
(24, 6, 15),
(25, 5, 13),
(26, 5, 14),
(27, 5, 15),
(28, 3, 13),
(29, 3, 14),
(30, 3, 17),
(31, 7, 14),
(32, 7, 17),
(33, 8, 17),
(34, 9, 13),
(35, 9, 14),
(36, 9, 17);

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`sr_no`, `room_id`, `image`, `thumb`) VALUES
(15, 3, 'IMG_39782.png', 0),
(16, 3, 'IMG_65019.png', 1),
(17, 4, 'IMG_44867.png', 0),
(18, 4, 'IMG_78809.png', 1),
(19, 4, 'IMG_11892.png', 0),
(21, 5, 'IMG_17474.png', 0),
(22, 5, 'IMG_42663.png', 1),
(23, 5, 'IMG_70583.png', 0),
(24, 6, 'IMG_67761.png', 0),
(25, 6, 'IMG_69824.png', 1),
(26, 7, 'IMG_53003.jpg', 0),
(27, 7, 'IMG_77522.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(250) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'INSTAROOM', 'BEST HOTELS\nFANTASTIC VIEWS\nSECURITY', 0);

-- --------------------------------------------------------

--
-- Table structure for table `team_details`
--

CREATE TABLE `team_details` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_details`
--

INSERT INTO `team_details` (`sr_no`, `name`, `picture`) VALUES
(16, 'HAZEM', 'IMG_38410.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(120) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `pincode` int(11) NOT NULL,
  `dob` date NOT NULL,
  `profile` varchar(100) NOT NULL DEFAULT 'Default.png',
  `password` varchar(200) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 1,
  `token` varchar(200) DEFAULT NULL,
  `t_expire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `password`, `is_verified`, `token`, `t_expire`, `status`, `datentime`) VALUES
(2, 'neal', 'neal@gmail.com', 'ad', '123', 123324, '2022-06-12', '3135715.png', '$2y$10$2IsUjaIwxb/UuaR7abvUNOs/VKmwy848VPsNnswF4bIFRIMDE36zm', 1, NULL, NULL, 1, '2022-06-12 16:05:59'),
(5, 'amey', 'helubeti@finews.biz', 'asd', '1234', 123, '2022-12-13', 'IMG_84786.jpeg', '$2y$10$NtKNL5Ogn.m3NViVu/DKIevNhms7thrZP.qTnPpqooncOSygLw9hS', 1, '24ffd287a4c2eda5f2b424be2824f997', NULL, 1, '2022-12-13 02:37:19'),
(6, 'amey', 'xelih35531@lubde.com', 'asd', '1123', 123, '2022-12-13', '3135716.png', '$2y$10$aoCaCM6Ji3VuZlO0YFl.Y.O4vv2cqJr0HiT2oVH5sy3AWQJqyyQJ6', 1, 'ef6dc7ba39cf4bf844244d3ef927a3e7', NULL, 1, '2022-12-13 02:40:42'),
(7, 'harry', 'harryd123@gmail.com', 'asd', '12345', 123, '2022-12-13', 'IMG_33353.jpeg', '$2y$10$kiw8LOLFK9e/I4u5i3vO0.GkMpBKAbeZguOqtp1HD0mBoPyAwXFhq', 0, '5c9f04397ff3e693f7cbfccea1044483', NULL, 1, '2022-12-13 02:42:37'),
(8, 'a', 'cejika9124@paxven.com', 'a', '12', 1, '2022-12-13', 'IMG_62937.jpeg', '$2y$10$0kAvtcnPie9S0W2DGjxaBuI8rvrC5Zq7BVUyNmST14J25tm2Vzdyu', 0, NULL, NULL, 1, '2022-12-13 02:55:39'),
(10, 'Hazem', 'hazemmohummedbusiness@gmail.com', 'Taiz', '0771612635', 147147, '2025-01-31', '1743637244_Default.png', '$2y$10$2pZuLFrZUWXhqMjSDcl.9OyZ7ov3d/G/LHUTwQNQWK.9LO.j0n5fG', 1, '250dd45640f7d810313b27e758a267af', NULL, 1, '2025-01-31 23:26:57'),
(11, 'Hazem2', 'hazemmohummed@gmail.com', 'Taiz', '07716126352', 1212, '2025-02-01', '1738357873_MyLogopng (2).png', '$2y$10$mWBjgYaWdLJ0CHJE61YbzO9CpF5hiqKxrSGvHNfAYUVQjd8OX0eli', 1, NULL, NULL, 1, '2025-02-01 00:11:13'),
(12, 'hazem', 'hazemmohumed@gmail.com', 'Taiz', '0771612699', 3215, '2001-04-05', '1743802605_IMG_20250401_210053.jpg', '$2y$10$2pZuLFrZUWXhqMjSDcl.9OyZ7ov3d/G/LHUTwQNQWK.9LO.j0n5fG', 1, NULL, NULL, 1, '2025-04-05 00:36:45'),
(13, 'Galal', 'galal@gmail.fom', 'Taiz', '774266565', 1, '2025-04-05', '1743804531_1000001885.jpg', '$2y$10$2pZuLFrZUWXhqMjSDcl.9OyZ7ov3d/G/LHUTwQNQWK.9LO.j0n5fG', 1, '92176b4e62971f29fcff92923a74564d', '2025-04-05', 1, '2025-04-05 01:08:51');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_queries`
--

INSERT INTO `user_queries` (`sr_no`, `name`, `email`, `subject`, `message`, `datentime`, `seen`) VALUES
(15, 'Hazem2', 'hazemmohummed@gmail.com', 'Want to be Host on Instaroom', 'I want to be Host on Instaroom.', '2025-04-01 02:12:23', 0),
(16, 'Galal', 'galal@gmail.com', 'Hhhh', 'Gslalal', '2025-04-06 01:39:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wish_list`
--

CREATE TABLE `wish_list` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wish_list`
--

INSERT INTO `wish_list` (`sr_no`, `room_id`, `user_id`) VALUES
(5, 8, 10),
(10, 5, 10),
(12, 7, 10),
(13, 9, 12),
(17, 9, 10),
(18, 3, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `host_cred`
--
ALTER TABLE `host_cred`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rating_review`
--
ALTER TABLE `rating_review`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rooms_host` (`host_id`);

--
-- Indexes for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `facilities id` (`facilities_id`),
  ADD KEY `room id` (`room_id`);

--
-- Indexes for table `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `features id` (`features_id`),
  ADD KEY `rm id` (`room_id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `team_details`
--
ALTER TABLE `team_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `name` (`name`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `wish_list`
--
ALTER TABLE `wish_list`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `host_cred`
--
ALTER TABLE `host_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rating_review`
--
ALTER TABLE `rating_review`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `room_features`
--
ALTER TABLE `room_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `team_details`
--
ALTER TABLE `team_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `wish_list`
--
ALTER TABLE `wish_list`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`);

--
-- Constraints for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD CONSTRAINT `booking_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`),
  ADD CONSTRAINT `booking_order_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`);

--
-- Constraints for table `rating_review`
--
ALTER TABLE `rating_review`
  ADD CONSTRAINT `rating_review_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`),
  ADD CONSTRAINT `rating_review_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `rating_review_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `fk_rooms_host` FOREIGN KEY (`host_id`) REFERENCES `host_cred` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_features`
--
ALTER TABLE `room_features`
  ADD CONSTRAINT `features id` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `rm id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `wish_list`
--
ALTER TABLE `wish_list`
  ADD CONSTRAINT `wish_list_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `wish_list_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
