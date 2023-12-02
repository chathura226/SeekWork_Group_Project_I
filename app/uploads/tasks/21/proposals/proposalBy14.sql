-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Nov 29, 2023 at 07:36 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SeekWorkDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_audit_log`
--

CREATE TABLE `user_audit_log` (
  `userID` int NOT NULL,
  `actionType` enum('INSERT','UPDATE','DELETE') NOT NULL,
  `actionTime` timestamp NOT NULL,
  `old_data` json DEFAULT NULL,
  `new_data` json DEFAULT NULL,
  `loggedUserID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_audit_log`
--

INSERT INTO `user_audit_log` (`userID`, `actionType`, `actionTime`, `old_data`, `new_data`, `loggedUserID`) VALUES
(12, 'UPDATE', '2023-11-28 14:29:55', '{\"role\": \"student\", \"email\": \"aa@k.com\", \"status\": \"active\", \"password\": \"$2y$10$gxa6lYdaNU6rfHY82CQGa.L4ABMpdTZUWgUlcbHTRarIJ7H1cYMwC\", \"contactNo\": \"012-345-6789\", \"createdAt\": \"2023-09-18 09:26:48.000000\", \"isOTPVerified\": 0}', '{\"role\": \"student\", \"email\": \"aa@k.com\", \"status\": \"deactivated\", \"password\": \"$2y$10$gxa6lYdaNU6rfHY82CQGa.L4ABMpdTZUWgUlcbHTRarIJ7H1cYMwC\", \"contactNo\": \"012-345-6789\", \"createdAt\": \"2023-09-18 09:26:48.000000\", \"isOTPVerified\": 0}', 25),
(12, 'UPDATE', '2023-11-28 14:30:45', '{\"role\": \"student\", \"email\": \"aa@k.com\", \"status\": \"deactivated\", \"password\": \"$2y$10$gxa6lYdaNU6rfHY82CQGa.L4ABMpdTZUWgUlcbHTRarIJ7H1cYMwC\", \"contactNo\": \"012-345-6789\", \"createdAt\": \"2023-09-18 09:26:48.000000\", \"isOTPVerified\": 0}', '{\"role\": \"student\", \"email\": \"aa@k.com\", \"status\": \"active\", \"password\": \"$2y$10$gxa6lYdaNU6rfHY82CQGa.L4ABMpdTZUWgUlcbHTRarIJ7H1cYMwC\", \"contactNo\": \"012-345-6789\", \"createdAt\": \"2023-09-18 09:26:48.000000\", \"isOTPVerified\": 0}', 25),
(26, 'UPDATE', '2023-11-28 14:31:24', '{\"role\": \"student\", \"email\": \"student@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$SGoys3mOBHgW/hVBL1IP4e0nYbLCDU1AwVglqjrfulBET8ot1xDqu\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:27:28.000000\", \"isOTPVerified\": 0}', '{\"role\": \"student\", \"email\": \"student@seekwork.lk\", \"status\": \"deactivated\", \"password\": \"$2y$10$SGoys3mOBHgW/hVBL1IP4e0nYbLCDU1AwVglqjrfulBET8ot1xDqu\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:27:28.000000\", \"isOTPVerified\": 0}', 25),
(26, 'UPDATE', '2023-11-28 14:31:29', '{\"role\": \"student\", \"email\": \"student@seekwork.lk\", \"status\": \"deactivated\", \"password\": \"$2y$10$SGoys3mOBHgW/hVBL1IP4e0nYbLCDU1AwVglqjrfulBET8ot1xDqu\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:27:28.000000\", \"isOTPVerified\": 0}', '{\"role\": \"student\", \"email\": \"student@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$SGoys3mOBHgW/hVBL1IP4e0nYbLCDU1AwVglqjrfulBET8ot1xDqu\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:27:28.000000\", \"isOTPVerified\": 0}', 25),
(36, 'INSERT', '2023-11-28 14:12:40', NULL, '{\"role\": \"company\", \"email\": \"compan2y@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$WsXyUZFX3aX35XeKKgelEeJOBS4K2kD5/iyG95LUBk39tXHmA.MSe\", \"contactNo\": \"0999999999\", \"createdAt\": \"2023-11-28 14:12:40.000000\", \"isOTPVerified\": 0}', NULL),
(36, 'UPDATE', '2023-11-28 14:13:45', '{\"role\": \"company\", \"email\": \"compan2y@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$WsXyUZFX3aX35XeKKgelEeJOBS4K2kD5/iyG95LUBk39tXHmA.MSe\", \"contactNo\": \"0999999999\", \"createdAt\": \"2023-11-28 14:12:40.000000\", \"isOTPVerified\": 0}', '{\"role\": \"company\", \"email\": \"compan2y@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$WsXyUZFX3aX35XeKKgelEeJOBS4K2kD5/iyG95LUBk39tXHmA.MSe\", \"contactNo\": \"0999999999\", \"createdAt\": \"2023-11-28 14:12:40.000000\", \"isOTPVerified\": 1}', NULL),
(36, 'DELETE', '2023-11-28 14:14:19', '{\"role\": \"company\", \"email\": \"compan2y@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$WsXyUZFX3aX35XeKKgelEeJOBS4K2kD5/iyG95LUBk39tXHmA.MSe\", \"contactNo\": \"0999999999\", \"createdAt\": \"2023-11-28 14:12:40.000000\", \"isOTPVerified\": 1}', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_audit_log`
--
ALTER TABLE `user_audit_log`
  ADD PRIMARY KEY (`userID`,`actionType`,`actionTime`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
