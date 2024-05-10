-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 10, 2024 at 02:03 AM
-- Server version: 10.11.7-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u139123658_waterstation`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE `applicant` (
  `id` int(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `validid` varchar(250) NOT NULL,
  `dti` varchar(250) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `middle` varchar(250) NOT NULL,
  `age` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `contact` varchar(250) NOT NULL,
  `unit` varchar(250) NOT NULL,
  `street` varchar(250) NOT NULL,
  `barangay` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `country` varchar(250) NOT NULL,
  `zip` varchar(250) NOT NULL,
  `company` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `plan` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`id`, `image`, `validid`, `dti`, `firstname`, `lastname`, `middle`, `age`, `gender`, `contact`, `unit`, `street`, `barangay`, `city`, `country`, `zip`, `company`, `email`, `plan`, `date`, `status`) VALUES
(56, 'upload/663b2565170383.88524711.jpg', 'upload/663b25651744f6.26565202.jpg', 'upload/663b25651773e8.10366759.jpg', 'Belinda', 'Cruz', 'I', '32', 'female', '09984214465', '143', 'Bliss', 'Bulihan', 'Malolos,Bulacan', 'Philippines', '3000', 'Chrislin Water Refilling Station', 'belindacruz@gmail.com', 'Basic Package', '2024-05-08 07:38:45', '1');

-- --------------------------------------------------------

--
-- Table structure for table `archive`
--

CREATE TABLE `archive` (
  `product_id` int(11) NOT NULL,
  `useradmin_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billing_address`
--

CREATE TABLE `billing_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `houseno` varchar(100) NOT NULL,
  `purok` varchar(100) NOT NULL,
  `street` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `billing_address`
--

INSERT INTO `billing_address` (`id`, `user_id`, `houseno`, `purok`, `street`) VALUES
(36, 192, '143', '', 'Bliss'),
(37, 194, '143', '', 'Bliss'),
(38, 193, '1343', '', '123'),
(39, 196, '0050 Purok 7', '', 'Sampaguita '),
(44, 205, '50', 'Purok 6', 'sample1'),
(45, 206, '11', '111', '1111'),
(46, 207, '78', '9', 'Daisy'),
(47, 208, '1', '2', '3'),
(48, 209, '1', '2', '3'),
(49, 211, '91', 'Purok 2', 'Daisy'),
(50, 212, '1730', '2', 'Bliss'),
(51, 231, '248', 'Panasahan', 'Azucena'),
(52, 237, '0050 Purok 6', 'Purok 2', 'gdfb dbdfbd'),
(53, 240, '50', '3', 'Sampaguita'),
(54, 241, '1730', '2', 'Bliss'),
(55, 242, '123', '2', 'Bliss');

-- --------------------------------------------------------

--
-- Stand-in structure for view `billing_information`
-- (See below for the actual view)
--
CREATE TABLE `billing_information` (
`billingId` int(11)
,`user_id` int(11)
,`houseno` varchar(100)
,`purok` varchar(100)
,`street` varchar(11)
,`userId` int(11)
,`fullname` varchar(250)
,`address` varchar(255)
,`contact` varchar(250)
,`username` varchar(255)
,`email` varchar(255)
,`email_verified` int(1)
,`useradmin_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `useradmin_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cartadmin`
--

CREATE TABLE `cartadmin` (
  `cart_id` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `useradmin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `houseno` varchar(255) NOT NULL,
  `purok` varchar(11) NOT NULL,
  `street` varchar(255) NOT NULL,
  `total_products` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `category` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `useradmin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `current_price` mediumint(9) NOT NULL,
  `old_price` mediumint(9) NOT NULL,
  `subscription_type` varchar(250) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `title`, `description`, `current_price`, `old_price`, `subscription_type`, `date_created`, `status`) VALUES
(5, 'Basic Package', 'Monthly Subscription', 45, 45, 'Monthly', '2024-04-23 01:29:37', '1'),
(11, 'Free 1 Month Subscription', 'One Month Free Subscription Only', 0, 0, 'One Month', '2024-03-22 07:20:33', '1'),
(12, 'Standard Package', 'Yearly Subscription', 505, 550, 'Yearly', '2024-04-23 04:44:56', '1'),
(14, 'Promo Package', 'Free 2 months subscription', 8600, 13000, 'yearly', '2024-04-23 06:10:25', '0');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(255) NOT NULL,
  `useradmin_id` int(11) DEFAULT NULL,
  `image` varchar(250) NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `stock` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

CREATE TABLE `review_table` (
  `review_id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int(1) NOT NULL,
  `user_review` text NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `useradmin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(250) NOT NULL,
  `systemname` varchar(500) NOT NULL,
  `codename` varchar(500) NOT NULL,
  `image` varchar(500) NOT NULL,
  `about` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `systemname`, `codename`, `image`, `about`) VALUES
(1, 'Water Refilling Stations for Hassle-Free Ordering and Delivery', 'WRS', '../upload/66389abd4366b9.56523602.png', 'Join Us Now');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `ref_number` varchar(50) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `products_sold` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `category` varchar(10) NOT NULL,
  `billing_address` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `ref_number`, `payment_type`, `products_sold`, `quantity`, `amount`, `status`, `category`, `billing_address`, `date`, `reason`) VALUES
(65, 'TOW4W85DWC', 'cod', 'Classic Container 2.5gal (1),Classic Container 5gal (2)', 3, 65, 'Delivered', 'Online', 36, '2024-03-30 14:27:33', ''),
(66, 'TCQVSTD54N', 'gcash', 'Bottle Water 10pcs (1)', 1, 80, 'Delivered', 'Online', 36, '2024-03-30 14:27:37', ''),
(67, 'OSDPAHEP4F', 'cod', 'Classic Container 5gal (1)', 1, 25, 'Pending', 'Online', 37, '2024-03-13 04:22:13', ''),
(68, 'OCA1CKVSXN', 'cod', 'Classic Container 5gal (2)', 2, 50, 'Out for Delivery', 'Online', 37, '2024-03-13 04:29:19', ''),
(69, '3G5H7FSXVC', 'gcash', 'Classic Container 5gal (1)', 1, 25, 'Pending', 'Online', 37, '2024-03-13 04:30:46', ''),
(70, 'VIQDSC36G0', 'cod', 'Classic Container 5gal (1)', 1, 25, 'Pending', 'Online', 38, '2024-03-13 04:48:14', ''),
(71, 'G4R2BUIIE5', 'cod', 'Dispenser Container (2)', 2, 60, 'Delivered', 'Online', 39, '2024-03-21 00:35:40', ''),
(72, 'VJWJATRCWH', 'gcash', 'Dispenser Container (1)', 1, 30, 'Out for Delivery', 'Online', 39, '2024-03-21 00:59:05', ''),
(73, '0HBVVT2EN5', 'cod', 'Classic Container 5gal (1),Dispenser Container (1)', 2, 55, 'Pending', 'Online', 39, '2024-03-21 01:01:10', ''),
(74, 'M32JSWI7IW', 'cod', 'Classic Container 5gal (1)', 1, 25, 'Pending', 'Online', NULL, '2024-04-12 02:14:52', ''),
(75, '6FYBZIBBDI', 'cod', 'Classic Container 5gal (3)', 3, 75, 'Pending', 'Online', NULL, '2024-04-12 02:39:28', ''),
(76, 'OCQO4CMKFY', 'cod', 'Classic Container 5gal (1)', 1, 25, 'Out for Delivery', 'Online', NULL, '2024-04-12 04:18:04', ''),
(77, '09U8QX820F', 'cod', 'Dispenser Container (1),Classic Container 5gal (1)', 2, 55, 'Delivered', 'Online', NULL, '2024-04-12 04:17:12', ''),
(78, '1WBVAIC4BT', 'cod', 'Classic Container 5gal (1)', 1, 25, 'Pending', 'Online', NULL, '2024-04-12 04:47:53', ''),
(79, '16M880GLB1', 'gcash', 'Classic Container 5gal (2)', 2, 50, 'Pending', 'Online', NULL, '2024-04-12 04:48:37', ''),
(80, 'ZIQG636BGA', 'cod', 'Classic Container 5gal (1)', 1, 25, 'Cancelled', 'Online', 44, '2024-04-13 07:41:53', 'hehe'),
(81, 'PXJZ1WV190', 'gcash', 'Dispenser Container (2)', 2, 60, 'Delivered', 'Online', 44, '2024-04-12 05:39:48', ''),
(82, 'TOV3YO61E7', 'cod', 'Dispenser Container (1)', 1, 30, 'Pending', 'Online', 45, '2024-04-12 06:00:58', ''),
(83, '75DQCWBVAT', 'cod', 'Classic Container 5gal (2)', 2, 50, 'Pending', 'Online', 46, '2024-04-12 06:47:26', ''),
(84, 'WLIDK1YL1A', 'cod', 'Bottle Water 10pcs (1),Dispenser Container (1)', 2, 110, 'Pending', 'Online', 47, '2024-04-12 06:57:39', ''),
(85, '81LBZ2WISD', 'cod', 'Classic Container 2.5gal (1)', 1, 15, 'Pending', 'Online', 48, '2024-04-12 07:00:09', ''),
(86, '2MXV1FG8OO', 'cod', 'Dispenser Container (1)', 1, 30, 'Cancelled', 'Online', 49, '2024-04-13 07:57:27', 'baho mo'),
(87, '67ZP1HYHMX', 'gcash', 'Dispenser Container (3)', 3, 90, 'Delivered', 'Online', 44, '2024-04-22 09:14:03', ''),
(88, '6ES1NSVR08', 'cod', 'Classic Container 5gal (1)', 1, 25, 'Cancelled', 'Online', 49, '2024-04-13 07:58:42', 'bantot'),
(89, 'WSFSNJBP0L', 'gcash', 'Dispenser Container (1)', 1, 30, 'Delivered', 'Online', 44, '2024-04-22 09:15:14', ''),
(90, 'BXSHRLQ8BQ', 'cod', 'Dispenser Container (1)', 1, 30, 'Cancelled', 'Online', 44, '2024-04-13 08:33:20', 'pangit mo'),
(91, '3GS1L01OEF', 'cod', 'Classic Container 5gal (1)', 1, 25, 'Delivered', 'Online', 50, '2024-04-15 14:20:56', ''),
(92, 'V5LG2D7AFV', 'gcash', 'Dispenser Container (1),Classic Container 2.5gal (1)', 2, 45, 'Delivered', 'Online', 51, '2024-04-16 14:31:16', ''),
(93, 'NTSCHMPPTY', 'gcash', 'Bottle Water 10pcs (1),Classic Container 5gal (1)', 2, 105, 'Delivered', 'Online', 51, '2024-04-16 14:31:21', ''),
(94, 'WH1XG2VFRA', 'gcash', 'dsdsadasdas (1)', 1, 20, 'Delivered', 'Online', 51, '2024-04-16 14:34:30', ''),
(95, 'GANWI01EYA', 'gcash', 'Dispenser Container (1)', 1, 30, 'Pending', 'Online', 51, '2024-04-16 15:36:11', ''),
(96, '8YWO21KGP2', 'cod', 'Classic Container 5gal (1),Dispenser Container (1)', 2, 55, 'Pending', 'Online', 44, '2024-04-21 05:12:34', ''),
(97, '41KKJIRHOB', 'cod', 'Dispenser Container (1),Classic Container 5gal (3)', 4, 105, 'Delivered', 'Online', 49, '2024-04-22 09:20:27', ''),
(98, '5VM3UHXDTO', 'gcash', 'Classic Container 5gal (50),Dispenser Container (4)', 54, 1370, 'Delivered', 'Online', 49, '2024-04-22 09:20:32', ''),
(99, 'EJ588FUCWW', 'cod', 'Dispenser Container (50)', 50, 1500, 'Cancelled', 'Online', 44, '2024-04-21 09:40:26', 'ewanq\r\n'),
(100, '5ZX8LCSLC0', 'cod', 'Dispenser Container (1)', 1, 30, 'Delivered', 'Online', 51, '2024-04-21 14:39:37', ''),
(101, '0Y8JFKSRLQ', 'cod', 'Dispenser Container (2),Classic Container 2.5gal (1)', 3, 75, 'Pending', 'Online', 52, '2024-04-22 10:17:29', ''),
(102, 'I86ISU5VL4', 'cod', 'Dispenser Container (2)', 2, 60, 'Cancelled', 'Online', 53, '2024-04-23 04:08:49', 'secret no clue'),
(103, '0N7F09RIOV', 'gcash', 'Dispenser Container (1)', 1, 30, 'Out for Delivery', 'Online', 53, '2024-04-23 04:08:27', ''),
(104, 'K5FY7LJBBA', 'gcash', 'Dispenser Container (6)', 6, 180, 'Delivered', 'Online', 54, '2024-04-24 03:59:14', ''),
(105, 'WBYJVW0DGZ', 'cod', 'Classic Galon 5gal (2)', 2, 50, 'Pending', 'Online', 55, '2024-04-29 03:33:24', ''),
(106, 'LE7VJHEAL5', 'gcash', 'Classic Galon 5gal (1)', 1, 25, 'Pending', 'Online', 55, '2024-04-29 03:34:02', '');

-- --------------------------------------------------------

--
-- Table structure for table `useradmin`
--

CREATE TABLE `useradmin` (
  `useradmin_id` int(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `codename` varchar(250) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `company` varchar(250) NOT NULL,
  `description` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `cover` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useradmin`
--

INSERT INTO `useradmin` (`useradmin_id`, `date`, `codename`, `firstname`, `lastname`, `username`, `password`, `company`, `description`, `barangay`, `logo`, `cover`, `status`) VALUES
(58, '2024-05-08 08:00:36', 'OACH', 'Belinda Cruz', '', 'belinda', 'belinda@01', 'Chrislin Water Refilling Station', '', 'Bulihan', '', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(250) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified` int(1) DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `code` mediumint(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `useradmin_id` int(11) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usersuperadmin`
--

CREATE TABLE `usersuperadmin` (
  `id` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usersuperadmin`
--

INSERT INTO `usersuperadmin` (`id`, `username`, `password`) VALUES
(1, 'super', 'super123');

-- --------------------------------------------------------

--
-- Table structure for table `verify`
--

CREATE TABLE `verify` (
  `id` int(11) NOT NULL,
  `code` int(5) NOT NULL,
  `expires` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verify`
--

INSERT INTO `verify` (`id`, `code`, `expires`, `email`) VALUES
(181, 67701, 1709534536, 'dev.me28@gmail.com'),
(182, 91026, 1709534698, 'dev.me28@gmail.com'),
(183, 80413, 1709534704, 'dev.me28@gmail.com'),
(184, 49030, 1709536113, 'dev.me28@gmail.com'),
(185, 96146, 1709537749, 'angelcudal03@gmail.com'),
(186, 13345, 1709539538, 'ma20010651@bpc.edu.ph'),
(187, 21058, 1709547423, 'ma20010651@bpc.edu.ph'),
(188, 13457, 1709547430, 'ma20010651@bpc.edu.ph'),
(189, 66980, 1709547465, '$email'),
(190, 12038, 1709547553, 'ma20010651@bpc.edu.ph'),
(191, 90557, 1709547585, 'ma20010651@bpc.edu.ph'),
(192, 22216, 1709547601, 'ma20010651@bpc.edu.ph'),
(193, 35606, 1709547996, 'ma20010651@bpc.edu.ph'),
(194, 711684, 1713787635, 'hollycudal2@gmail.com'),
(195, 10795, 1709548731, 'angelcudal03@gmail.com'),
(196, 43551, 1709549301, 'angelcudal03@gmail.com'),
(197, 69351, 1709549513, 'ma20010651@bpc.edu.ph'),
(198, 92241, 1709550726, 'angelcudal03@gmail.com'),
(199, 25245, 1709649105, 'ma20010613@bpc.edu.ph'),
(200, 74718, 1709649110, 'kW06319965@EcD.vhN.wB'),
(201, 24980, 1709708720, 'esor19@yahoo.com'),
(202, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(203, 33872, 1709711400, 'kWQcHVznypEcDvhNwBKFO1@MyMwO.HsF'),
(204, 59755, 1709776363, 'ma20010651@bpc.edu.ph'),
(205, 222215, 1713848597, 'acdegala16@gmail.com'),
(206, 43324, 1709804948, 'wrsteamtalongist@gmail.com'),
(207, 41225, 1709804951, 'wrsteamtalongist@gmail.com'),
(208, 22565, 1709805341, 'wrsteamtalongist@gmail.com'),
(209, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(210, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(211, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(212, 85317, 1709948176, 'angelcudal03@gmail.com'),
(213, 75778, 1709961881, 'angelcudal03@gmail.com'),
(214, 222215, 1713848597, 'acdegala16@gmail.com'),
(215, 42540, 1709978857, 'ma20010651@bpc.edu.ph'),
(216, 56806, 1710062649, 'angelcudal03@gmail.com'),
(217, 222215, 1713848597, 'acdegala16@gmail.com'),
(218, 85686, 1710083732, 'merellesannjoy03@gmail.com'),
(219, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(220, 711684, 1713787635, 'hollycudal2@gmail.com'),
(221, 98153, 1710145084, 'ma20010651@bpc.edu.ph'),
(222, 57878, 1710145221, 'jovelcudal07@gmail.com'),
(223, 711684, 1713787635, 'hollycudal2@gmail.com'),
(224, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(225, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(226, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(227, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(228, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(229, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(230, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(231, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(232, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(233, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(234, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(235, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(236, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(237, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(238, 68948, 1710233964, 'darrenfaustino2414@gmail.com'),
(239, 76449, 1710233975, 'darrenfaustino2414@gmail.com'),
(240, 71158, 1710233986, 'darrenfaustino2414@gmail.com'),
(241, 11568, 1710234009, 'darrenfaustino2414@gmail.com'),
(242, 53285, 1710234048, 'darrenfaustino2414@gmail.com'),
(243, 88487, 1710234214, 'darrenfaustino2414@gmail.com'),
(244, 54929, 1710235375, 'bitoyhernandez123@gmail.com'),
(245, 48432, 1710236163, 'bitoyhernandez123@gmail.com'),
(246, 89144, 1710236583, 'bitoyhernandez123@gmail.com'),
(247, 319726, 1710237546, 'bitoyhernandez123@gmail.com'),
(248, 166294, 1710237737, 'bitoyhernandez123@gmail.com'),
(249, 431513, 1710238799, 'bitoyhernandez123@gmail.com'),
(250, 707022, 1710239615, 'bitoyhernandez123@gmail.com'),
(251, 337823, 1710239661, 'bitoyhernandez123@gmail.com'),
(252, 211239, 1710240029, 'bitoyhernandez123@gmail.com'),
(253, 799311, 1710240162, 'bitoyhernandez123@gmail.com'),
(254, 729505, 1710240178, 'bitoyhernandez123@gmail.com'),
(255, 862527, 1710241018, 'bitoyhernandez123@gmail.com'),
(256, 208186, 1710242300, 'jstarsilvano8@gmail.com'),
(257, 728983, 1710242303, 'jstarsilvano8@gmail.com'),
(258, 138205, 1710242441, 'deroxasharold5@gmail.com'),
(259, 726850, 1710242562, 'bitoyhernandez123@gmail.com'),
(260, 778707, 1710252051, 'bitoyhernandez123@gmail.com'),
(261, 668250, 1710252144, 'bitoyhernandez123@gmail.com'),
(262, 761344, 1710252202, 'bitoyhernandez123@gmail.com'),
(263, 407284, 1710252271, 'bitoyhernandez123@gmail.com'),
(264, 96411, 1710252466, 'bitoyhernandez123@gmail.com'),
(265, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(266, 17579, 1710254474, 'deroxasharold5@gmail.com'),
(267, 61082, 1710266959, 'bitoyhernandez123@gmail.com'),
(268, 88101, 1710267027, 'bitoyhernandez123@gmail.com'),
(269, 22123, 1710267056, 'bitoyhernandez123@gmail.com'),
(270, 89857, 1710267120, 'bitoyhernandez123@gmail.com'),
(271, 17700, 1710267271, 'darrenfaustino2414@gmail.com'),
(272, 60611, 1710294393, 'deroxasharold5@gmail.com'),
(273, 93515, 1710303219, 'vpaulo1312@gmail.com'),
(274, 68209, 1710303520, 'ma20010613@bpc.edu.ph'),
(275, 77005, 1710938797, 'drmaryedralyn@gmail.com'),
(276, 56253, 1710981463, 'ma20010651@bpc.edu.ph'),
(277, 15178, 1711214212, 'bitoyhernandez123@gmail.com'),
(278, 22708, 1711214590, 'bitoyhernandez123@gmail.com'),
(279, 80663, 1711214598, 'bitoyhernandez123@gmail.com'),
(280, 49913, 1711214778, 'bitoyhernandez123@gmail.com'),
(281, 59413, 1711214834, 'bitoyhernandez123@gmail.com'),
(282, 81091, 1711215113, 'bitoyhernandez123@gmail.com'),
(283, 63975, 1711215308, 'bitoyhernandez123@gmail.com'),
(284, 92611, 1711215315, 'bitoyhernandez123@gmail.com'),
(285, 14352, 1711215399, 'bitoyhernandez123@gmail.com'),
(286, 60251, 1711215760, 'bitoyhernandez123@gmail.com'),
(287, 37428, 1711215861, 'bitoyhernandez123@gmail.com'),
(288, 93307, 1711217540, 'bitoyhernandez123@gmail.com'),
(289, 50264, 1711217730, 'kansergamer2414@gmail.com'),
(290, 55057, 1711217902, 'darrenfaustino0224@gmail.com'),
(291, 65698, 1711217942, 'kansergamer2414@gmail.com'),
(292, 29854, 1711218394, 'ma20010617@bpc.edu.ph'),
(293, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(294, 14269, 1711240137, 'jstarsilvano8@gmail.com'),
(295, 31852, 1711510569, 'ma20010443@bpc.edu.ph'),
(296, 62666, 1711594221, 'ma20010651@bpc.edu.ph'),
(297, 60132, 1712901215, 'angelcudal03@gmail.com'),
(298, 22886, 1712902084, 'angelcudal03@gmail.com'),
(299, 18150, 1712905306, 'angelcudal03@gmail.com'),
(300, 22599, 1712905466, 'angelcudal03@gmail.com'),
(301, 56541, 1712976001, 'angelcudal03@gmail.com'),
(302, 21043, 1712977390, 'angelcudal03@gmail.com'),
(303, 53139, 1713187255, 'ma20010613@bpc.edu.ph'),
(304, 68226, 1713187259, 'kW06319965@EcD.vhN.wB'),
(305, 25915, 1713188161, 'ma20010613@bpc.edu.ph'),
(306, 96512, 1713188193, 'ma20010613@bpc.edu.ph'),
(307, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(308, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(309, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(310, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(311, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(312, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(313, 41001, 1713268426, 'bitoyhernandez123@gmail.com'),
(314, 21427, 1713268669, 'bitoyhernandez123@gmail.com'),
(315, 94392, 1713269260, 'bitoyhernandez123@gmail.com'),
(316, 52303, 1713271436, 'bitoyhernandez123@gmail.com'),
(317, 33560, 1713271948, 'lorenafaustino528@gmail.com'),
(318, 89005, 1713272121, 'lorenafaustino528@gmail.com'),
(319, 38113, 1713272345, 'lorenafaustino528@gmail.com'),
(320, 33134, 1713272500, 'lorenafaustino528@gmail.com'),
(321, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(322, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(323, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(324, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(325, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(326, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(327, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(328, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(329, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(330, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(331, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(332, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(333, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(334, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(335, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(336, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(337, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(338, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(339, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(340, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(341, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(342, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(343, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(344, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(345, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(346, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(347, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(348, 755024, 1713717837, 'waterrefillingstation0@gmail.com'),
(349, 44370, 1713714541, 'waterrefillingstation0@gmail.com'),
(350, 222215, 1713848597, 'acdegala16@gmail.com'),
(351, 222215, 1713848597, 'acdegala16@gmail.com'),
(352, 711684, 1713787635, 'hollycudal2@gmail.com'),
(353, 711684, 1713787635, 'hollycudal2@gmail.com'),
(354, 95576, 1713784338, 'hollycudal2@gmail.com'),
(355, 222215, 1713848597, 'acdegala16@gmail.com'),
(356, 222215, 1713848597, 'acdegala16@gmail.com'),
(357, 71770, 1713845298, 'acdegala16@gmail.com'),
(358, 34609, 1713845499, 'acdegala16@gmail.com'),
(359, 42973, 1713931268, 'ma20010613@bpc.edu.ph'),
(360, 74463, 1714361861, 'ma20010613@bpc.edu.ph'),
(361, 84623, 1714915432, 'merellesannjoy03@gmail.com');

-- --------------------------------------------------------

--
-- Structure for view `billing_information`
--
DROP TABLE IF EXISTS `billing_information`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u139123658_waterstation`@`127.0.0.1` SQL SECURITY INVOKER VIEW `billing_information`  AS SELECT `bl`.`id` AS `billingId`, `bl`.`user_id` AS `user_id`, `bl`.`houseno` AS `houseno`, `bl`.`purok` AS `purok`, `bl`.`street` AS `street`, `s`.`user_id` AS `userId`, `s`.`fullname` AS `fullname`, `s`.`address` AS `address`, `s`.`contact` AS `contact`, `s`.`username` AS `username`, `s`.`email` AS `email`, `s`.`email_verified` AS `email_verified`, `s`.`useradmin_id` AS `useradmin_id` FROM (`billing_address` `bl` join `users` `s` on(`s`.`user_id` = `bl`.`user_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `useradmin_id_fk` (`useradmin_id`);

--
-- Indexes for table `billing_address`
--
ALTER TABLE `billing_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `useradmin_id_fk` (`useradmin_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `cartadmin`
--
ALTER TABLE `cartadmin`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `useradmin_id` (`useradmin_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `useradmin_id_fk` (`useradmin_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `useradmin_id_fk` (`useradmin_id`);

--
-- Indexes for table `review_table`
--
ALTER TABLE `review_table`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id_fk` (`user_id`),
  ADD KEY `useradmin_id_fk` (`useradmin_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `billing_address` (`billing_address`);

--
-- Indexes for table `useradmin`
--
ALTER TABLE `useradmin`
  ADD PRIMARY KEY (`useradmin_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `useradmin_id_fk` (`useradmin_id`);

--
-- Indexes for table `usersuperadmin`
--
ALTER TABLE `usersuperadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verify`
--
ALTER TABLE `verify`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`),
  ADD KEY `email` (`email`),
  ADD KEY `expires` (`expires`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicant`
--
ALTER TABLE `applicant`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `archive`
--
ALTER TABLE `archive`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `billing_address`
--
ALTER TABLE `billing_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;

--
-- AUTO_INCREMENT for table `cartadmin`
--
ALTER TABLE `cartadmin`
  MODIFY `cart_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `useradmin`
--
ALTER TABLE `useradmin`
  MODIFY `useradmin_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `usersuperadmin`
--
ALTER TABLE `usersuperadmin`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `verify`
--
ALTER TABLE `verify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=362;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `archive`
--
ALTER TABLE `archive`
  ADD CONSTRAINT `archive_ibfk_1` FOREIGN KEY (`useradmin_id`) REFERENCES `useradmin` (`useradmin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`useradmin_id`) REFERENCES `useradmin` (`useradmin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cartadmin`
--
ALTER TABLE `cartadmin`
  ADD CONSTRAINT `cartadmin_ibfk_1` FOREIGN KEY (`useradmin_id`) REFERENCES `useradmin` (`useradmin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`useradmin_id`) REFERENCES `useradmin` (`useradmin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`useradmin_id`) REFERENCES `useradmin` (`useradmin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review_table`
--
ALTER TABLE `review_table`
  ADD CONSTRAINT `review_table_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_table_ibfk_2` FOREIGN KEY (`useradmin_id`) REFERENCES `users` (`useradmin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`billing_address`) REFERENCES `billing_address` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`useradmin_id`) REFERENCES `useradmin` (`useradmin_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
