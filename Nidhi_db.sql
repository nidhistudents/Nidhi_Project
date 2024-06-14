-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2024 at 08:05 AM
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
-- Database: `nidhi_students`
--
CREATE DATABASE IF NOT EXISTS `nidhi_students` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `nidhi_students`;

-- --------------------------------------------------------

--
-- Table structure for table `iep_goals`
--

CREATE TABLE `iep_goals` (
  `goal_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `goal_name` varchar(500) NOT NULL,
  `plan_type` text NOT NULL,
  `current_level` longtext NOT NULL,
  `goal_description` longtext NOT NULL,
  `goal_status` text NOT NULL,
  `additional_notes` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `iep_goals`
--

INSERT INTO `iep_goals` (`goal_id`, `student_id`, `goal_name`, `plan_type`, `current_level`, `goal_description`, `goal_status`, `additional_notes`) VALUES
(25, 1, 'Gross Motor', 'Long term plan', 'nill', 'lt1lt\r\nlr\r\ndsjkfhas\r\nsjdsjladfh\r\nskjdfshf\r\nlcsdkfhaskhf', 'in_progress', ''),
(26, 1, 'Gross Motor', 'Long term plan', 'nil', 'gt-1\r\ngt-2\r\ngt-2', 'Introduced', ''),
(27, 1, 'Fine Motor', 'Short term plan', 'nill', 'fine mototr activities', 'In Progress', ''),
(28, 2, 'Gross Motor', 'Long term plan', 'None', 'independent jumping from the board\r\nwith minimal help test test test', 'Introduced', ''),
(29, 2, 'Sensory', 'Long term plan', 'Sensory touch aversion', 'Introducing different textures\r\ntest test test test ', 'Introduced', 'None'),
(30, 2, 'Reading', 'Long term plan', 'nill', 'test', 'Introduced', '');

-- --------------------------------------------------------

--
-- Table structure for table `iep_sub_goals`
--

CREATE TABLE `iep_sub_goals` (
  `sub_id` int(11) NOT NULL,
  `goal_id` int(11) NOT NULL,
  `sub_goal` longtext NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int(11) NOT NULL,
  `invoice_date` date NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_name` varchar(200) NOT NULL,
  `speech_therapy` int(11) NOT NULL,
  `ot` int(11) NOT NULL,
  `special_ed` int(11) NOT NULL,
  `group_session` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `payment_status` enum('Pending','Completed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`invoice_id`, `invoice_date`, `student_id`, `student_name`, `speech_therapy`, `ot`, `special_ed`, `group_session`, `total_amount`, `payment_status`) VALUES
(7, '2024-06-16', 2, 'Ravi Kumar M', 800, 800, 800, 0, 2400, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `doa` date DEFAULT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `contact_number` int(11) NOT NULL,
  `profile_picture` text NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `marital_status` varchar(100) NOT NULL,
  `education` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `other_languages` longtext NOT NULL,
  `dominant_language` longtext NOT NULL,
  `understands_language` text NOT NULL,
  `speaks_language` text NOT NULL,
  `who_speaks_language` text NOT NULL,
  `preferred_language` text NOT NULL,
  `adopted` text NOT NULL,
  `adoption_age` int(11) NOT NULL,
  `knows_child` text NOT NULL,
  `services` longtext NOT NULL,
  `service_details` longtext NOT NULL,
  `reason_for_referral` longtext NOT NULL,
  `current_difficulties` longtext NOT NULL,
  `spends_time_with` longtext NOT NULL,
  `sleep_well` text NOT NULL,
  `eat_well` text NOT NULL,
  `get_along_with_children` text NOT NULL,
  `get_along_with_adults` text NOT NULL,
  `understand_instructions` text NOT NULL,
  `communicate_with_others` text NOT NULL,
  `play_with_others` text NOT NULL,
  `play_alone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `last_name`, `gender`, `dob`, `doa`, `age`, `address`, `contact_number`, `profile_picture`, `mother_name`, `father_name`, `marital_status`, `education`, `occupation`, `other_languages`, `dominant_language`, `understands_language`, `speaks_language`, `who_speaks_language`, `preferred_language`, `adopted`, `adoption_age`, `knows_child`, `services`, `service_details`, `reason_for_referral`, `current_difficulties`, `spends_time_with`, `sleep_well`, `eat_well`, `get_along_with_children`, `get_along_with_adults`, `understand_instructions`, `communicate_with_others`, `play_with_others`, `play_alone`) VALUES
(1, 'Test_nidhi', 'test', 'male', '2015-01-01', NULL, 9, 'test', 0, '../uploads/Spoons.jpeg', 'test', 'test', 'married', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'no', 0, 'Y', 'no', '', 'Assessment', 'test', 'test', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'),
(2, 'Ravi Kumar', 'M', 'male', '2019-03-01', NULL, 5, 'test', 1234, '', 'test', 'test', 'married', 'test', 'test', 'eng', 'test', 'test', 'test', 'test', 'test', 'no', 0, 'Y', 'no', 'test', 'Assessment', 'test', 'test', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `therapies`
--

CREATE TABLE `therapies` (
  `therapy_id` int(11) NOT NULL,
  `service_description` varchar(300) NOT NULL,
  `unit_price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `therapies`
--

INSERT INTO `therapies` (`therapy_id`, `service_description`, `unit_price`) VALUES
(2, 'Group Sessions', 32000),
(3, 'Counselling', 2000),
(4, 'Assesment', 5000),
(6, 'OT', 800),
(7, 'Speech Therapy', 800),
(8, 'Special Ed', 800);

-- --------------------------------------------------------

--
-- Table structure for table `therapies_taken`
--

CREATE TABLE `therapies_taken` (
  `therapy_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `therapies_taken`
--

INSERT INTO `therapies_taken` (`therapy_id`, `student_id`) VALUES
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `contact_number` int(11) NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` enum('admin','teacher') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `contact_number`, `username`, `password`, `role`) VALUES
(5, 'Archana', 'k', 1234567, 'archan_123', 'archana', 'teacher'),
(6, 'Nidhi_test', 'test', 1234567891, 'nidhi_123', '12345678', 'teacher'),
(7, 'Nisha', 'L', 12334567, 'nisha_123', 'nisha', 'teacher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `iep_goals`
--
ALTER TABLE `iep_goals`
  ADD PRIMARY KEY (`goal_id`),
  ADD KEY `fk_stu` (`student_id`);

--
-- Indexes for table `iep_sub_goals`
--
ALTER TABLE `iep_sub_goals`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `fk_goal` (`goal_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `therapies`
--
ALTER TABLE `therapies`
  ADD PRIMARY KEY (`therapy_id`);

--
-- Indexes for table `therapies_taken`
--
ALTER TABLE `therapies_taken`
  ADD PRIMARY KEY (`therapy_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `iep_goals`
--
ALTER TABLE `iep_goals`
  MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `iep_sub_goals`
--
ALTER TABLE `iep_sub_goals`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `therapies`
--
ALTER TABLE `therapies`
  MODIFY `therapy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `therapies_taken`
--
ALTER TABLE `therapies_taken`
  MODIFY `therapy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `iep_goals`
--
ALTER TABLE `iep_goals`
  ADD CONSTRAINT `fk_stu` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `iep_sub_goals`
--
ALTER TABLE `iep_sub_goals`
  ADD CONSTRAINT `fk_goal` FOREIGN KEY (`goal_id`) REFERENCES `iep_goals` (`goal_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
