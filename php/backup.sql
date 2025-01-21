-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2025 at 08:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jumpa`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidding`
--

CREATE TABLE `bidding` (
  `bidding_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bidding_amount` decimal(10,2) NOT NULL,
  `bidding_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bidding`
--

INSERT INTO `bidding` (`bidding_id`, `task_id`, `user_id`, `bidding_amount`, `bidding_time`) VALUES
(5, 1, 2, 25.00, '2025-01-07 17:27:47'),
(6, 5, 4, 160.00, '2025-01-07 23:19:13'),
(7, 6, 4, 600.00, '2025-01-07 23:22:03'),
(9, 1, 1, 23.00, '2025-01-08 17:53:53'),
(10, 5, 2, 1030.00, '2025-01-09 07:02:32'),
(11, 6, 1, 300.00, '2025-01-12 03:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `bidding_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `user_id`, `task_id`, `bidding_id`) VALUES
(4, 1, 6, 11),
(30, 2, 5, 10),
(31, 4, 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `task_title` varchar(255) NOT NULL,
  `task_description` varchar(255) NOT NULL,
  `task_date` date NOT NULL,
  `task_duration` varchar(255) NOT NULL,
  `task_location` varchar(255) NOT NULL,
  `task_toolsRequired` varchar(255) NOT NULL,
  `task_pax` int(10) NOT NULL,
  `task_price` int(10) NOT NULL,
  `task_dressCode` varchar(255) NOT NULL,
  `task_gender` varchar(255) NOT NULL,
  `task_nationality` varchar(255) NOT NULL,
  `task_ageRange` varchar(255) NOT NULL,
  `task_muslimFriendly` tinyint(1) NOT NULL,
  `task_foodProvision` tinyint(1) NOT NULL,
  `task_transportProvision` tinyint(1) NOT NULL,
  `task_status` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_title`, `task_description`, `task_date`, `task_duration`, `task_location`, `task_toolsRequired`, `task_pax`, `task_price`, `task_dressCode`, `task_gender`, `task_nationality`, `task_ageRange`, `task_muslimFriendly`, `task_foodProvision`, `task_transportProvision`, `task_status`, `user_id`) VALUES
(1, 'testing', 'testing', '2025-01-15', '1 hour', 'Kuching', 'ada', 12, 23, 'sad', 'asd', '', '', 1, 1, 1, 0, 4),
(5, 'Event Management', 'Manage an event for the Christmas Celebration', '2024-12-25', '3 hours', 'BCCK', 'No', 5, 100, 'Smart Casual', 'Male and Female', 'Warganegara', '20-25', 1, 0, 0, 0, 1),
(6, 'Wall Painting', 'Paint the wall in the dewan', '2024-11-27', '5 hours', 'Kampung Meranek', 'Tool is provided', 10, 300, 'Casual', 'Male', 'Malay', '18 to 25', 1, 1, 0, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_salt` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_fullname` varchar(255) NOT NULL,
  `user_gender` varchar(255) NOT NULL,
  `user_age` int(10) NOT NULL,
  `user_ic` varchar(255) DEFAULT NULL,
  `user_contactNumber` varchar(255) NOT NULL,
  `user_photo` varchar(255) NOT NULL,
  `user_qualification` varchar(255) NOT NULL,
  `user_certificate` varchar(255) NOT NULL,
  `user_race` varchar(255) NOT NULL,
  `user_religion` varchar(255) NOT NULL,
  `user_language` varchar(255) NOT NULL,
  `user_workingExperienceWithJumpa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_salt`, `user_email`, `user_fullname`, `user_gender`, `user_age`, `user_ic`, `user_contactNumber`, `user_photo`, `user_qualification`, `user_certificate`, `user_race`, `user_religion`, `user_language`, `user_workingExperienceWithJumpa`) VALUES
(1, 'asd', '4166d9a506bcbfdd0de8ae730181513a7dce2efd0fa7cea90667dafc54cfb995', '09e35f0554e82344042498b7e2365d95', 'abgmhafizhan1908@gmail.com', 'Abang Muhammad Hafizhan bin Abang Azman', 'Male', 24, '2aa33c0a3c52bb8e53f63a6e80e690b02ede5a91ee582abfe138de0a5d93facf', '+60128940329', '../assets/uploads/profile_picture/profilePicture_user_1.png', 'spm', 'aws', 'Malay', 'Islam', 'Iban', '1 year'),
(2, 'zxc', 'd7d0296b9442b5f1d0234b8c82db3844e7c45d9bee802d48ffa218cb0fe882bf', '4b06e2ef756e21cc3844eeee33fdc3c7', 'testing@testing.com', 'Isaac Nagai', 'Female', 32, '126113243802476ae705abf92297aa5d1d5ebb9c38de200a654425f04dc0e1d5', '0823472812', '../assets/uploads/profile_picture/profilePicture_user_2.png', '', '', 'Malay', 'Islam', 'English, Malay', ''),
(3, 'jkl', '9c1f9bd2c1640f96a25e0ddd7dcd550d5a0a72f12ca701686d91720ff8212e8f', '10144172ecc533cc4a0bdb89b522d364', 'testing@gmail.com', 'Testing', 'Male', 12, 'ee29eb4a8725678278ac439cf7abfd2a849cdc7378a6b6316017b81c51d720e7', '+60123456789', '', '', '', 'Malay', 'ISlam', 'Malay', ''),
(4, 'tyu', '182f248126afb014a9a74c3cb5e1803103b9d52e88b4e656cd104fcdd16a8b89', '784d16dae72cb03bf698598385667774', 'testing4@testing.com', 'Encik Testing', 'Male', 123, '612d92efca35108ee2c64bd9bd3a90fa71e2457f2960fad2941a88da5c23b114', '0128940329', '', '', '', 'Malay', 'Islam', 'Iban', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidding`
--
ALTER TABLE `bidding`
  ADD PRIMARY KEY (`bidding_id`),
  ADD KEY `bidding_ibfk_1` (`task_id`),
  ADD KEY `bidding_ibfk_2` (`user_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `bidding_id` (`bidding_id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidding`
--
ALTER TABLE `bidding`
  MODIFY `bidding_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bidding`
--
ALTER TABLE `bidding`
  ADD CONSTRAINT `bidding_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bidding_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `job_ibfk_1` FOREIGN KEY (`bidding_id`) REFERENCES `bidding` (`bidding_id`),
  ADD CONSTRAINT `job_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`),
  ADD CONSTRAINT `job_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
