-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 23, 2024 at 04:45 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rrs`
--

-- --------------------------------------------------------

--
-- Table structure for table `room_bookings`
--

CREATE TABLE `room_bookings` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `number` bigint DEFAULT NULL,
  `message` text COLLATE utf8mb4_general_ci,
  `room_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_bookings`
--

INSERT INTO `room_bookings` (`id`, `name`, `email`, `number`, `message`, `room_id`, `created_at`, `updated_at`) VALUES
(3, 'asda', 'test@test.com', 2147483647, 'sdasdas', 18, '2024-05-23 14:47:27', '2024-05-23 14:47:27'),
(4, 'sujan', 'sujan@mail.com', 2147483647, 'sadsads', 18, '2024-05-23 14:50:25', '2024-05-23 14:50:25'),
(5, 'Sujan Shrestha', 'sujanstha016@gmail.com', 9812345670, 'this is test message', 13, '2024-05-23 15:38:23', '2024-05-23 15:38:23'),
(7, 'Sujan', 'stha24103@gmail.com', 9812345670, 'dfsdfsdf', 13, '2024-05-23 15:41:54', '2024-05-23 15:41:54'),
(8, 'test', 'stha24103@gmail.com', 9801234567, 'sadasdasd', 13, '2024-05-23 15:43:28', '2024-05-23 15:43:28');

-- --------------------------------------------------------

--
-- Table structure for table `room_rental_registrations`
--

CREATE TABLE `room_rental_registrations` (
  `id` int UNSIGNED NOT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alternat_mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `landmark` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rent` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plot_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rooms` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accommodation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_for_sharing` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vacant` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_rental_registrations`
--

INSERT INTO `room_rental_registrations` (`id`, `fullname`, `mobile`, `alternat_mobile`, `email`, `country`, `state`, `city`, `landmark`, `rent`, `sale`, `deposit`, `plot_number`, `rooms`, `address`, `accommodation`, `description`, `image`, `open_for_sharing`, `other`, `vacant`, `created_at`, `updated_at`, `user_id`) VALUES
(13, 'test dfsdf', '9801234567', '6666666656', 'admin@admin.com', 'US', 'AZ', 'Phoenix', 'testweqwe', '565', '19500', '8000', '78 nh', '2 BHK', '110 Dt St', '4', 'dssdsdad', 'uploads/O3W99js4cddP5QnSE03Tj7nNPN5NrvZXAyXEnagm.jpg', NULL, 'zx', 1, '2018-02-16 12:21:43', '2018-02-16 12:21:43', 1),
(15, 'Zeiggerasda', '2222222222', '4444022222', 'admin@admmmin.com', 'US', 'IL', 'Dupo', 'test', '600', '18500', '10000', '69 nh', '1 BHK', '76 Ross Street', 'WiFi, Fridge', 'good to see', 'uploads/sample_image.jpg', NULL, NULL, 0, '2018-04-04 11:19:09', '2018-04-04 11:19:09', 1),
(24, 'Pratima Tamang', '9859463993', '9883648578', 'pratima@gmail.com', 'nepal', '3', 'suryabinayak', 'shufhjdhs', '10000', '00000', '1500', '73', '1bhk', 'bhaktapur', 'water, wifi', 'sjhfkjsbkh', '', NULL, NULL, 1, '2024-05-22 03:01:54', '2024-05-22 03:01:54', 13),
(17, 'Demo Name adsads', '7770000000', '7774440001', 'demo@demo.com', 'DemoCountry', 'DemoState', 'DemoCity', 'Demo Landmark', '555', '36000', '15200', 'D 8', '3 BHK', '770 DemoAddress', 'demo facilities', 'This is a demo description for testing!', 'uploads/sample_image.jpg', NULL, NULL, 1, '2021-11-29 16:03:03', '2021-11-29 16:03:03', 1),
(18, 'Anup Shrestha', '9860038759', '9860038759', 'anupshrestha141@gmail.com', 'Nepal', '3', 'Bhaktapur', 'sdjfh', '12345', '1', '1234', '123`', '2BHK', 'Bhaktapur', 'wifi, water', 'dhfoiashkjfhsuiohg', 'uploads/r2.jpg', NULL, NULL, 1, '2024-05-15 15:43:39', '2024-05-15 15:43:39', 8),
(21, 'Ram Prasaad', '9849477589', '9842648493', 'ram@gmail.com', 'nepal', '3', 'kathmandu', 'skhifo', '5000', '000000', '2500', '34', '1bhk', 'Kathmandu, Ason', 'dfhkslghf', 'lakhdgofhbl', 'uploads/r1.jpg', NULL, NULL, 1, '2024-05-18 09:19:51', '2024-05-18 09:19:51', 8),
(22, 'Gurung', '9873879407', '9873937494', 'abc@gmail.com', 'nepal', '3', 'banepa', 'fksh', '5000', '00000', '1500', '73', '1bhk', 'banepa chowk', 'dasfkkbj', 'skjhef', 'uploads/r2.jpg', NULL, NULL, 1, '2024-05-18 09:33:14', '2024-05-18 09:33:14', 1),
(23, 'sujan shrestha', '9876543210', '9865432354', 'sujan@gmail.com', 'nepal', '3', 'thimi', 'skeflih', '10000', '000000', '2500', '45', '3bhk', 'thimi', 'dskhfjh', 'skjfk', 'uploads/r1.jpg', NULL, NULL, 1, '2024-05-18 11:45:10', '2024-05-18 11:45:10', 12),
(25, 'Anup Shrestha', '9893948930', '9830484635', 'anup123@gmail.com', 'nepal', '3', 'balkumari', 'add', '11111', '00000', '2344', '34', '3bhk', 'Madhyapur thimi', 'rfdd', 'Ready to booked', '', NULL, NULL, 1, '2024-05-22 17:31:15', '2024-05-22 17:31:15', 8),
(26, 'Anup Shrestha', '9813258707', '9813258707', 'shrestha@gmail.com', 'nepal', '3', 'Thimi', 'temple', '15000', '0000', '7500', '36', '3bhk', 'Bhaktapur', 'all', 'best room', 'uploads/r2.jpg', NULL, NULL, 1, '2024-05-23 08:03:42', '2024-05-23 08:03:42', 8),
(27, 'Rahim Vincent', '9810234567', '9843125645', 'luwedef@mailinator.com', 'In voluptatem sapien', 'Rerum distinctio Il', 'Dolore omnis mollit', 'Non laborum Libero', 'Nostrum qui vel prov', 'Nulla aute sequi et', 'Iure numquam volupta', '703', 'Consectetur expedita', 'Impedit quo exercit', 'Eveniet ullamco del', 'Reprehenderit rerum', 'uploads/8QY0Y2YGyLbNjpRS2wQRlu6mBidUlVleBlcbgMJ8.jpg', NULL, NULL, 1, '2024-05-23 16:40:49', '2024-05-23 16:40:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `status` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `mobile`, `username`, `email`, `password`, `created_at`, `updated_at`, `role`, `status`) VALUES
(1, 'Admin', '8888885555', 'admin', 'admin@admin.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, NULL, 'admin', 1),
(2, 'User1', '1111110111', 'user1', 'user1@gmail.com', '9aee390f19345028f03bb16c588550e1', '2018-02-08 06:53:53', '2018-02-08 06:53:53', 'user', 1),
(7, 'Demo Account', '7778555555', 'demo', 'demo@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2021-11-16 04:44:20', '2021-11-16 04:44:20', 'user', 1),
(8, 'Anup Shrestha', '9860038759', 'anupsht', 'anupshrestha141@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2024-05-15 15:12:56', '2024-05-15 15:12:56', 'user', 1),
(9, 'User2', '9879473649', 'user2', 'user2@gmail.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '2024-05-18 03:58:08', '2024-05-18 03:58:08', 'user', 1),
(11, 'Nitesh Tachamo', '9874937989', 'nitesh', 'nitesh@mail.com', 'c8bdfd41d406005533290dff3b026c61', '2024-05-18 11:30:03', '2024-05-18 11:30:03', 'user', 1),
(13, 'Pratima Tamang', '9836474628', 'pratima', 'pratima@gmail.com', 'b2c9ff62af7f0e94ff6451365f664e69', '2024-05-22 02:58:54', '2024-05-22 02:58:54', 'user', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `room_bookings`
--
ALTER TABLE `room_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_rental_registrations`
--
ALTER TABLE `room_rental_registrations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_rental_registrations_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `room_rental_registrations_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `room_bookings`
--
ALTER TABLE `room_bookings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `room_rental_registrations`
--
ALTER TABLE `room_rental_registrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
