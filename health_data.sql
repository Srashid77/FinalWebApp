-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2025 at 09:04 PM
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
-- Database: `health_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `diet`
--

CREATE TABLE `diet` (
  `id` int(11) NOT NULL,
  `meal_type` varchar(50) NOT NULL,
  `food_item` varchar(100) NOT NULL,
  `portion_size` varchar(50) NOT NULL,
  `calories` int(11) NOT NULL,
  `carbs` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diet`
--

INSERT INTO `diet` (`id`, `meal_type`, `food_item`, `portion_size`, `calories`, `carbs`, `notes`, `created_at`, `user_id`) VALUES
(1, 'lunch', 'rice', '100g', 150, 5, 'ddss', '2025-05-10 15:09:07', 0),
(6, 'dinner', 'Ruti', '150g', 180, 45, 'no', '2025-05-10 15:09:07', 0),
(7, 'snack', 'Chips', '180g', 200, 50, 'na', '2025-05-10 15:09:07', 0),
(8, 'dinner', 'Sea Fod', '150g', 120, 141, 'na', '2025-05-10 15:09:07', 0),
(9, 'breakfast', 'parata', '20', 145, 100, 'no', '2025-05-10 15:09:07', 0),
(10, 'breakfast', 'parata', '20', 145, 100, 'no', '2025-05-10 15:09:07', 0),
(11, 'lunch', 'mmm', '150g', 11, 1112, ',,n', '2025-05-10 15:09:07', 0),
(12, 'breakfast', 'mmm', '150g', 11, 1112, 'no', '2025-05-10 15:09:07', 0),
(13, 'breakfast', 'b', '150g', 11, 1112, 'bn', '2025-05-10 15:09:07', 0),
(14, 'breakfast', 'mmm', '150g', 14, 22, 'ndw', '2025-05-10 15:09:07', 0),
(15, 'breakfast', 'mmm', '150g', 14, 22, 'vb', '2025-05-10 15:09:07', 0),
(16, 'breakfast', 'roll', '150g', 14, 22, 'na', '2025-05-10 15:09:07', 0),
(17, 'snack', 'Pasta', '1 cup', 250, 120, 'no', '2025-05-10 15:48:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `healthinfo`
--

CREATE TABLE `healthinfo` (
  `blood_glucose_level` decimal(5,1) DEFAULT NULL,
  `time_of_day` time DEFAULT NULL,
  `glucose_notes` varchar(255) DEFAULT NULL,
  `activity_type` varchar(100) DEFAULT NULL,
  `intensity` enum('Low','Moderate','High') DEFAULT NULL,
  `duration_minutes` int(11) DEFAULT NULL,
  `calories_burned` int(11) DEFAULT NULL,
  `symptom_name` varchar(100) DEFAULT NULL,
  `severity` enum('Mild','Moderate','Severe') DEFAULT NULL,
  `symptom_notes` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `systolic` int(11) DEFAULT NULL,
  `diastolic` int(11) DEFAULT NULL,
  `pulse_rate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `healthinfo`
--

INSERT INTO `healthinfo` (`blood_glucose_level`, `time_of_day`, `glucose_notes`, `activity_type`, `intensity`, `duration_minutes`, `calories_burned`, `symptom_name`, `severity`, `symptom_notes`, `id`, `user_id`, `systolic`, `diastolic`, `pulse_rate`) VALUES
(NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'weakness', 'Mild', 'na', 1, 0, NULL, NULL, NULL),
(100.0, '08:00:00', 'no', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21, 0, 120, 75, 70),
(NULL, NULL, NULL, 'Walking', 'Moderate', 15, 120, NULL, NULL, NULL, 22, 0, NULL, NULL, NULL),
(NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dizziness, tiredness', 'Mild', 'Always tired.', 23, 0, NULL, NULL, NULL),
(145.0, '08:00:00', 'no', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, 0, 90, 85, 65),
(154.0, '15:00:00', 'no', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, 0, 95, 63, 65),
(120.0, '20:00:00', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, 0, 120, 68, 70),
(NULL, NULL, NULL, 'Exercise ', 'Moderate', 30, 250, NULL, NULL, NULL, 27, 0, NULL, NULL, NULL),
(NULL, NULL, NULL, 'Exercise ', 'Moderate', 30, 250, NULL, NULL, NULL, 28, 0, NULL, NULL, NULL),
(NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', 'Severe', 'mo', 31, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sign_up`
--

CREATE TABLE `sign_up` (
  `ID` int(100) NOT NULL,
  `User Name` varchar(50) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Password` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sign_up`
--

INSERT INTO `sign_up` (`ID`, `User Name`, `Email`, `Password`) VALUES
(1, 'suma7', 'abs@gmail.com', '$2y$10$pxZBw2YryX2CdmYCDWlM0uUMH6RMsxxiGTntmgaqS18kJO..ta4pe'),
(2, 'rimi', 'rm@gmail.com', '$2y$10$1Ru2DxaWEfWBHBbeMvbUAuOUJq6m8T8lzwfhAu0EdpPv1f4Cgx87O');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type` enum('User','Admin') NOT NULL DEFAULT 'User',
  `username` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `username`, `firstname`, `lastname`, `email`, `gender`, `password`, `created_at`) VALUES
(3, 'User', 'sumaiya', 'sumaiya', 'tabassum', '2221047@iub.edu.bd', 'Female', '$2y$10$eIQpniABmykDHrAjuPZ7aemtwRg19zh5epr/.vSDMdHxCLJFOBscW', '2025-04-19 22:32:50'),
(4, 'User', 'far22', 'farin', 'khan', 'fr@gmail.com', 'Male', '$2y$10$HL0UNWmHrdNastmYSZNy8.KhYFNA5aN/k7P5.4Twk0LasNiVvOkVm', '2025-05-05 18:36:36'),
(5, 'User', 'far20', 'fari', 'khan', 'fr1@gmail.com', 'Male', '$2y$10$t/2zyODPKxPf/wTF7pvL4.3hV0GwfHV/uON76OQaeOpsbVlFggjYi', '2025-05-06 06:16:25'),
(6, 'User', 'sumu11', 'sumi', 'khan', 'su@gmail.com', 'Female', '$2y$10$dOyEey6v3ggbtG7TyI8LVe6Y21lLHckN8SmIR8KxBVtb51hqUL/J2', '2025-05-06 08:11:15'),
(7, 'User', 'sumi11', 'sumi', 'rahman', 'su1@gmail.com', 'Female', '$2y$10$2uxcZYqohC./X4BU65kYi.KXqJOYq0TjbWgPzsLeHc0UCdSYRal7u', '2025-05-06 18:02:22'),
(8, 'User', 'kaz12', 'Kazi', 'rahman', 'kz12@gmail.com', 'Male', '$2y$10$63ZAGRGS9SRebJuw88R.j.ePq3M3d9Ume9CTJvNEQ295gWb1zv9hu', '2025-05-09 07:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `user_dashboard`
--

CREATE TABLE `user_dashboard` (
  `Bood Sugar Level` int(20) NOT NULL,
  `Systolic` int(150) NOT NULL,
  `Diastolic` int(150) NOT NULL,
  `Date` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diet`
--
ALTER TABLE `diet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `healthinfo`
--
ALTER TABLE `healthinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sign_up`
--
ALTER TABLE `sign_up`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diet`
--
ALTER TABLE `diet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `healthinfo`
--
ALTER TABLE `healthinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `sign_up`
--
ALTER TABLE `sign_up`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
