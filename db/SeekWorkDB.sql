-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Sep 25, 2023 at 09:04 AM
-- Server version: 8.1.0
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `address` text,
  `userID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `firstName`, `lastName`, `address`, `userID`) VALUES
(3, 'chathura', 'lakshan', NULL, 11);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` int NOT NULL,
  `title` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `tags` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `title`, `description`, `tags`) VALUES
(1, 'Graphic Design', 'Work related to graphic designing ', 'graphic\r\nlogo\r\ndesign'),
(2, 'Web development', 'Work associated with web development', 'php\r\nhtml\r\ncss\r\n'),
(3, 'Animation', 'Work associated with animations', 'anime\r\nvideo editing\r\n3d');

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE `certificate` (
  `certificateID` int NOT NULL,
  `description` text NOT NULL,
  `studentID` int NOT NULL,
  `issuedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificate-category`
--

CREATE TABLE `certificate-category` (
  `certificate_category_ID` int NOT NULL,
  `certificateID` int NOT NULL,
  `categoryID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `companyID` int NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `status` enum('verified','verification pending','banned','') NOT NULL DEFAULT 'verification pending',
  `firstName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'first name of contact person',
  `lastName` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `website` text,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `brn` varchar(50) NOT NULL,
  `userID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`companyID`, `companyName`, `status`, `firstName`, `lastName`, `address`, `website`, `description`, `brn`, `userID`) VALUES
(1, 'kk', 'verification pending', 'aa', 'aa', 'aaa', 'https://www.kk.com', '', 'aa', 16),
(2, 'seekwork', 'verification pending', 'chathura', 'lakshan', 'colombo', 'https://www.seekwork.com', 'wwwwwwwwww', '1111111', 22),
(3, 'seekwork.com', 'verified', 'lakshan', 'chathura', 'colombo', '', NULL, '11111', 24);

-- --------------------------------------------------------

--
-- Table structure for table `company_payment`
--

CREATE TABLE `company_payment` (
  `company_payment_ID` int NOT NULL,
  `companyID` int NOT NULL,
  `paymentID` int NOT NULL,
  `sentDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dispute`
--

CREATE TABLE `dispute` (
  `disputeID` int NOT NULL,
  `description` text NOT NULL,
  `status` enum('resolved','pending','invalid') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` enum('payment','task') NOT NULL,
  `taskID` int NOT NULL,
  `moderatorID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `moderator`
--

CREATE TABLE `moderator` (
  `moderatorID` int NOT NULL,
  `firstName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(100) NOT NULL,
  `userID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Moderator_Verifies_Company`
--

CREATE TABLE `Moderator_Verifies_Company` (
  `verificationID` int NOT NULL,
  `verificationDate` datetime NOT NULL,
  `status` enum('verified','verification pending','banned') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `comments` text,
  `moderatorID` int NOT NULL,
  `companyID` int NOT NULL,
  `documents` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int NOT NULL,
  `paymentStatus` varchar(10) NOT NULL,
  `taskID` int NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `porposalID` int NOT NULL,
  `description` text NOT NULL,
  `documents` text NOT NULL,
  `proposeAmount` double DEFAULT NULL,
  `submissionDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `taskID` int NOT NULL,
  `studentID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `reviewID` int NOT NULL,
  `reviewType` enum('studentTOcompany','companyTOstudent') NOT NULL,
  `studentID` int NOT NULL,
  `companyID` int NOT NULL,
  `taskID` int NOT NULL,
  `nStars` int NOT NULL,
  `reviewDescription` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` int NOT NULL,
  `firstName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `qualifications` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `NIC` varchar(13) NOT NULL,
  `address` text NOT NULL,
  `status` enum('verified','verification pending','banned','') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'verification pending',
  `verificationDocuments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `accountNo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `userID` int NOT NULL,
  `universityID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `firstName`, `lastName`, `qualifications`, `description`, `NIC`, `address`, `status`, `verificationDocuments`, `accountNo`, `userID`, `universityID`) VALUES
(3, 'chathura', 'lakshan', 'a', 'a', 'aa', 'ws', 'verification pending', 'aa', 'aa', 11, 1),
(4, 'aaa', 'bbb', 'qqqq', 'ddd', '200105702857', 'ccc', 'verified', NULL, NULL, 12, 1),
(6, 'aaa', 'bb', NULL, NULL, '660951105v', 'aaa', 'verification pending', NULL, NULL, 14, NULL),
(7, 'aaa', 'bb', NULL, NULL, '660951145v', 'aaa', 'verification pending', NULL, NULL, 15, NULL),
(8, 'chathura', 'lakshan', NULL, NULL, '200105702855', 'skjnwk', 'verification pending', NULL, NULL, 17, NULL),
(9, 'sajith', 'rajapakse', NULL, NULL, '200012365849', '99 madamulana pallebedda', 'verification pending', NULL, NULL, 18, NULL),
(10, 'sajith', 'rajapakse', NULL, NULL, '960951105v', '99 madamulana pallebedda', 'verification pending', NULL, NULL, 19, NULL),
(12, 'chathura', 'lakshan', NULL, NULL, '123456789123', '111', 'verification pending', NULL, NULL, 21, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_payment`
--

CREATE TABLE `student_payment` (
  `student_payment_ID` int NOT NULL,
  `paymentID` int NOT NULL,
  `studentID` int NOT NULL,
  `recievedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `taskID` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `taskType` enum('fixed Price','auction') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text NOT NULL,
  `deadline` datetime DEFAULT NULL,
  `value` double NOT NULL,
  `status` enum('active','closed','inProgress') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `companyID` int NOT NULL,
  `assignedStudentID` int DEFAULT NULL,
  `categoryID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`taskID`, `title`, `taskType`, `description`, `deadline`, `value`, `status`, `companyID`, `assignedStudentID`, `categoryID`) VALUES
(1, 'Design a Logo', 'fixed Price', 'I am starting a new enterprise and I am in need of a logo design.\r\nThe compony deals in Medical Devices and the logo needs to reflect that in a subtle way not in a way where there is a stethoscope in the logo. Name of company is \"MEDYCO LIFE BIOTECH\"\r\n\r\nIdeal skills and experience:\r\n- Experience in logo design\r\n- Creativity and ability to come up with unique and visually appealing designs\r\n- Proficiency in graphic design software\r\n- Strong attention to detail\r\n- Ability to understand and incorporate the vision and branding of a new enterprise', NULL, 5000, 'active', 2, NULL, 1),
(2, 'Create a website', 'fixed Price', 'I am looking for an experienced web developer to create a website for me. Specifically, I need a blogging website, with specific design and functionality requirements. The website should be built on WordPress, with PHP and HTML as the core programming language. I already have web content and images ready to go for the new website, so the main scope of work is on the design and development side.\r\n\r\nThe design should be modern and sleek, with clean lines and fonts, as well as including all necessary components of a blog such as comment sections, tags and a SEO-friendly structure. On the development side, I am looking for a custom coding and development job. This includes incorporating necessary plug-ins for a usable and engaging user experience, designing and integrating attractive forms, and making sure the website works across multiple browsers and devices.\r\n\r\nExperience in web design and WordPress development are a must for this job. Additionally, it would be great if the candidate had expertise in SEO and has done any e-commerce projects in the past. Timely completion of the project is also important.', NULL, 10000, 'active', 3, NULL, 2),
(3, 'Animation For Stream\r\n', 'fixed Price', 'Hello, I am looking for a talented animator who can create a specific introduction animation for my stream. The type of animation I need is 3D, and I have specific elements that I would like included in the animation. My goal is to create something visually stunning and memorable that can draw viewers in and make them stick around. ( I have the full idea ready, and clips to be used inside of the animation, the animation being between 3-5 minutes long ) If you have the skills and the creativity to create something that will be noticed, please reach out to me.', NULL, 15000, 'active', 2, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE `university` (
  `universityID` int NOT NULL,
  `universityName` varchar(50) NOT NULL,
  `domain` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`universityID`, `universityName`, `domain`) VALUES
(1, 'UCSC', 'stu.ucsc.cmb.ac.lk');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `contactNo` varchar(12) NOT NULL,
  `role` varchar(20) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `email`, `password`, `contactNo`, `role`, `createdAt`) VALUES
(11, 'admin@admin.com', '$2y$10$O9fihdAv7ftZ5N5mp.IQwuh1S644VmGJCNcRy0UEObVZ4y67fBv6a', '123', 'admin', '2023-09-17 16:11:13'),
(12, 'aa@k.com', '$2y$10$gxa6lYdaNU6rfHY82CQGa.L4ABMpdTZUWgUlcbHTRarIJ7H1cYMwC', '012-345-6789', 'student', '2023-09-18 09:26:48'),
(13, 'aab@k.com', '$2y$10$Gf0Xxhcwr1SUBXyq.NgMnOdkKcvPAaR5g6yLd0mlsHensoKRcBF0e', '012-345-6789', 'student', '2023-09-18 09:30:21'),
(14, 'aabj@k.com', '$2y$10$KnHOE3tyqErLsjggmUPas.KZ/UmwyShx.lXYzuqW5bC9MbAFClUdy', '012-345-6789', 'student', '2023-09-18 09:34:29'),
(15, 'aaabj@k.com', '$2y$10$78iEQp8L2EuONr7yVceNCebUdsYhaS1ICxIBk0fIv.FKGwyBeL4N2', '012-345-6789', 'student', '2023-09-18 09:36:48'),
(16, 'aaa@kk.com', '$2y$10$P08nvJCK7z0t7dNScXZElO.uQ3MRgx90LbD9UkaZGPWqScqqn93qO', '012-234-4567', 'company', '2023-09-18 10:13:50'),
(17, '2021cs109@stu.ucsc.cmb.ac.lk', '$2y$10$nt.D/ZdzXfdE/Qcjh/i7TOy/qZX1IsQDiKPy.44J0vMuCeiR2kh/O', '012-345-6789', 'student', '2023-09-18 11:47:26'),
(18, '2021cs1029@stu.ucsc.cmb.ac.lk', '$2y$10$VZn32bcZ7z4hfDZI8I1me.YjPNp/trCscXwAPXuHe1FLGjEuLx9vC', '0775017409', 'student', '2023-09-19 07:56:38'),
(19, '2021cs018@stu.ucsc.cmb.ac.lk', '$2y$10$COXY0b5joTnRQWRYJbySQe6/S1B90n3SJTUUWLi7/3GziO0xd0kEq', '1111111111', 'student', '2023-09-19 07:59:14'),
(20, 'chathur@stu.cmb.ac.lk', '$2y$10$3x.hbxkm3aSouDqcnqsA0uwANVzwx13Eh5vv/ZGRcvzEQh/Q9Pyf.', '0112659897', 'student', '2023-09-19 22:38:37'),
(21, 'chathura@stu.ucsc.cmb.ac.lk', '$2y$10$k2xZ8oNZAsCvUtTV1wWwPe/pmGjO/QwXHbFL3z6od1JNcXLOTy6da', '0112339220', 'student', '2023-09-21 23:19:29'),
(22, 'chathura@seekwork.com', '$2y$10$KPl6CHFI3XpZJiRhj1mbU.p3W3/jUxGLn8hHup94D7WMxI6YijZw.', '0775017409', 'company', '2023-09-23 10:04:25'),
(23, 'verified@seekwork.com', '$2y$10$KzigzoHAaEXBHKBZGgAnS.K0RgVKNMayfiXeOKIeQ9owegp3lALYi', '0112929330', 'company', '2023-09-23 10:56:59'),
(24, 'verifiedcompany@seekwork.com', '$2y$10$zzkLQrkDSAopuKUH/PRflOpuJ2ccdKLuW6cuHe5pYiOLEd78IzY5G', '0112929330', 'company', '2023-09-23 10:57:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`),
  ADD KEY `user-admin` (`userID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`certificateID`),
  ADD KEY `student-certificate` (`studentID`);

--
-- Indexes for table `certificate-category`
--
ALTER TABLE `certificate-category`
  ADD PRIMARY KEY (`certificate_category_ID`),
  ADD KEY `category-certificate_category` (`categoryID`),
  ADD KEY `certificate-certificate_category` (`certificateID`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`companyID`),
  ADD UNIQUE KEY `brn-unique` (`brn`),
  ADD KEY `user-company` (`userID`);

--
-- Indexes for table `company_payment`
--
ALTER TABLE `company_payment`
  ADD PRIMARY KEY (`company_payment_ID`),
  ADD KEY `com-pay` (`companyID`),
  ADD KEY `pay2` (`paymentID`);

--
-- Indexes for table `dispute`
--
ALTER TABLE `dispute`
  ADD PRIMARY KEY (`disputeID`),
  ADD KEY `task-dispute` (`taskID`),
  ADD KEY `dispute-moderator` (`moderatorID`);

--
-- Indexes for table `moderator`
--
ALTER TABLE `moderator`
  ADD PRIMARY KEY (`moderatorID`),
  ADD KEY `user-moderator` (`userID`);

--
-- Indexes for table `Moderator_Verifies_Company`
--
ALTER TABLE `Moderator_Verifies_Company`
  ADD PRIMARY KEY (`verificationID`),
  ADD KEY `moderator-verification` (`moderatorID`),
  ADD KEY `verification-company` (`companyID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `payment-task` (`taskID`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`porposalID`),
  ADD KEY `task-proposal` (`taskID`),
  ADD KEY `student-proposal` (`studentID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`reviewID`),
  ADD KEY `review-student` (`studentID`),
  ADD KEY `review-company` (`companyID`),
  ADD KEY `review-Task` (`taskID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`),
  ADD UNIQUE KEY `nic` (`NIC`),
  ADD KEY `user-student` (`userID`),
  ADD KEY `student-university` (`universityID`);

--
-- Indexes for table `student_payment`
--
ALTER TABLE `student_payment`
  ADD PRIMARY KEY (`student_payment_ID`),
  ADD KEY `pay` (`paymentID`),
  ADD KEY `stu-pay` (`studentID`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`taskID`),
  ADD KEY `task-company` (`companyID`),
  ADD KEY `task-student` (`assignedStudentID`),
  ADD KEY `task-category` (`categoryID`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`universityID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `UNIQUE_EMAIL` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
  MODIFY `certificateID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificate-category`
--
ALTER TABLE `certificate-category`
  MODIFY `certificate_category_ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `companyID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company_payment`
--
ALTER TABLE `company_payment`
  MODIFY `company_payment_ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dispute`
--
ALTER TABLE `dispute`
  MODIFY `disputeID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `moderator`
--
ALTER TABLE `moderator`
  MODIFY `moderatorID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Moderator_Verifies_Company`
--
ALTER TABLE `Moderator_Verifies_Company`
  MODIFY `verificationID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `porposalID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `reviewID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student_payment`
--
ALTER TABLE `student_payment`
  MODIFY `student_payment_ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `taskID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `universityID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `user-admin` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `certificate`
--
ALTER TABLE `certificate`
  ADD CONSTRAINT `student-certificate` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `certificate-category`
--
ALTER TABLE `certificate-category`
  ADD CONSTRAINT `category-certificate_category` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `certificate-certificate_category` FOREIGN KEY (`certificateID`) REFERENCES `certificate` (`certificateID`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `user-company` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `company_payment`
--
ALTER TABLE `company_payment`
  ADD CONSTRAINT `com-pay` FOREIGN KEY (`companyID`) REFERENCES `company` (`companyID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pay2` FOREIGN KEY (`paymentID`) REFERENCES `payment` (`paymentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dispute`
--
ALTER TABLE `dispute`
  ADD CONSTRAINT `dispute-moderator` FOREIGN KEY (`moderatorID`) REFERENCES `moderator` (`moderatorID`),
  ADD CONSTRAINT `task-dispute` FOREIGN KEY (`taskID`) REFERENCES `task` (`taskID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `moderator`
--
ALTER TABLE `moderator`
  ADD CONSTRAINT `user-moderator` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Moderator_Verifies_Company`
--
ALTER TABLE `Moderator_Verifies_Company`
  ADD CONSTRAINT `moderator-verification` FOREIGN KEY (`moderatorID`) REFERENCES `moderator` (`moderatorID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `verification-company` FOREIGN KEY (`companyID`) REFERENCES `company` (`companyID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment-task` FOREIGN KEY (`taskID`) REFERENCES `task` (`taskID`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `proposal`
--
ALTER TABLE `proposal`
  ADD CONSTRAINT `student-proposal` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task-proposal` FOREIGN KEY (`taskID`) REFERENCES `task` (`taskID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review-company` FOREIGN KEY (`companyID`) REFERENCES `company` (`companyID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `review-student` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `review-Task` FOREIGN KEY (`taskID`) REFERENCES `task` (`taskID`) ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student-university` FOREIGN KEY (`universityID`) REFERENCES `university` (`universityID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `user-student` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_payment`
--
ALTER TABLE `student_payment`
  ADD CONSTRAINT `pay` FOREIGN KEY (`paymentID`) REFERENCES `payment` (`paymentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stu-pay` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON UPDATE CASCADE;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task-category` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `task-company` FOREIGN KEY (`companyID`) REFERENCES `company` (`companyID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `task-student` FOREIGN KEY (`assignedStudentID`) REFERENCES `student` (`studentID`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
