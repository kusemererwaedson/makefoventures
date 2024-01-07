-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2023 at 11:03 PM
-- Server version: 10.5.20-MariaDB-cll-lve
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hakacdmf_makefo`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_info`
--

CREATE TABLE `about_info` (
  `id` int(11) NOT NULL,
  `about` text NOT NULL,
  `slogan` text NOT NULL,
  `phone` text NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_info`
--

INSERT INTO `about_info` (`id`, `about`, `slogan`, `phone`, `email`) VALUES
(1, 'Tempore ipsa non consequatur, voluptatem labore doloremque voluptates nam nisi maiores accusamus vitae minus dolore impedit aliquam nostrum reiciendis saepe! Deserunt quisquam et quibusdam, neque voluptas fugiat officiis temporibus assumenda architecto adipisci officia consectetur, amet repudiandae eaque nihil consequuntur cum illo eum veniam soluta voluptate porro rem sapiente enim. Incidunt impedit velit laudantium? Odio eius eligendi quisquam quam possimus similique explicabo, fugiat veritatis sit accusamus veniam necessitatibus aperiam corporis tempore velit fuga autem! Quasi magni, quo nihil error at eveniet debitis sunt nisi esse sint? Debitis voluptatem unde blanditiis nostrum? By shaka the programmer\r\n', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Illo, numquam ya man', '+256705137672', 'makefo@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `phone`, `email`, `password`) VALUES
(1, 'makefo', '0778237748', 'isihaka@gmail.com', '$2y$10$/H2aAD/cWKa9GXxWTonY9uvoGgKJieTPxJSkBxxb9EtghTL015qhG');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `category_description` varchar(255) NOT NULL,
  `business_type` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_image`, `category_description`, `business_type`, `created_at`) VALUES
(9, 'Lotion', 'oil.jpeg', 'Oil Lotion', 'beauty', '2023-11-19'),
(10, 'Apartments', 'tour.jpeg', 'Best Houses for tourists', 'tour', '2023-11-19'),
(11, 'Bajaj', 'bajaj.jpeg', 'bajaj', 'engineering', '2023-11-20'),
(12, 'Toyota', 'toyota.jpg', 'toyota', 'engineering', '2023-11-21'),
(13, 'Solar', 'greenlife.jpeg', 'Best solar energy', 'greenlife', '2023-11-21'),
(14, 'Nissan', 'NISSAN.png', 'nissan', 'engineering', '2023-11-21');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `commentor_phone` text NOT NULL,
  `comment_context` varchar(255) NOT NULL,
  `product_id` text NOT NULL,
  `status` text NOT NULL,
  `like_comment` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `commentor_phone`, `comment_context`, `product_id`, `status`, `like_comment`, `created_at`) VALUES
(1, '+256761488516', 'i Like this', '18', 'new', '0', '2023-11-15'),
(3, '0778237748', 'love this', '22', 'new', '0', '2023-11-21'),
(4, '+256761488516', 'terer', '18', 'new', '0', '2023-11-21');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `sender_name` text NOT NULL,
  `sender_phone` text NOT NULL,
  `msg_content` varchar(255) NOT NULL,
  `status` text NOT NULL,
  `importance` text NOT NULL,
  `date_sent` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `sender_name`, `sender_phone`, `msg_content`, `status`, `importance`, `date_sent`) VALUES
(7, 'makefo', '0778237748', 'good morning makefo', 'read', '0', '2023-11-15'),
(15, 'Mac', '0999854', 'Vhjjn', 'unread', '0', '2023-11-26');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `part_num` text NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `category_id` text NOT NULL,
  `subcategory_id` text NOT NULL,
  `bussiness_type` text NOT NULL,
  `product_status` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `part_num`, `product_name`, `product_image`, `product_description`, `category_id`, `subcategory_id`, `bussiness_type`, `product_status`, `created_at`) VALUES
(18, 'None', 'Luxury ', 'tour.jpeg', 'hey', '10', '4', 'tour', '0', '2023-11-20'),
(20, '84783478', 'product name', 'bajaj.jpeg', 'irtiojrgifgblgfkm,.', '11', '8', 'engineering', '0', '2023-11-20'),
(21, '2424', 'tubless', 'tubeless.jpeg', 'tubless', '11', '9', 'engineering', '0', '2023-11-21'),
(22, 'None', 'oil', 'oil.jpeg', 'reth', '9', '6', 'beauty', '0', '2023-11-21'),
(23, 'None', 'Solar', 'greenlife.jpeg', 'solar', '13', '10', 'greenlife', '0', '2023-11-21');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `service_name` text NOT NULL,
  `description` text NOT NULL,
  `service_link` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `service_name`, `description`, `service_link`, `created_at`) VALUES
(1, 'Engneering solutions', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cumque  asperiores hic exercitationem deleniti ad, rerum dolores in dolorem ab quam!', 'engineering', '2023-10-31'),
(2, 'Beauty & well being', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cumque asperiores hic exercitationem deleniti ad, rerum dolores in dolorem ab quam!', 'beauty', '2023-10-31'),
(3, 'Green Life', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cumque asperiores hic exercitationem deleniti ad, rerum dolores in dolorem ab quam!', 'greenlife', '2023-10-31'),
(4, 'Tour & Accommodation', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cumque asperiores hic exercitationem deleniti ad, rerum dolores in dolorem ab quam!', 'tour', '2023-10-31');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `subcategory_name` varchar(255) NOT NULL,
  `subcategory_image` varchar(255) NOT NULL,
  `subcategory_description` varchar(255) NOT NULL,
  `category_id` text NOT NULL,
  `business_type` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `subcategory_name`, `subcategory_image`, `subcategory_description`, `category_id`, `business_type`, `created_at`) VALUES
(4, 'Guest House', 'accomm.jpeg', 'hey', '10', 'tour', '2023-11-20'),
(6, 'sub category 1', 'lotion.jpeg', 'testing', '9', 'beauty', '2023-11-20'),
(8, 'Lubricant', 'bajaj.jpeg', 'jdfkjdfkdkdf', '11', 'engineering', '2023-11-20'),
(9, 'Tires', 'tubeless.jpeg', 'sper', '11', 'engineering', '2023-11-21'),
(10, 'solars', 'greenlife.jpeg', 'best of the best solars', '13', 'greenlife', '2023-11-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_info`
--
ALTER TABLE `about_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_info`
--
ALTER TABLE `about_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
