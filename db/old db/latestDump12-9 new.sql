-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Sep 12, 2023 at 08:46 AM
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
  `userID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `address` text NOT NULL,
  `contactPerson` varchar(20) NOT NULL,
  `website` text,
  `brn` varchar(50) NOT NULL,
  `userID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `fName` varchar(20) NOT NULL,
  `lName` varchar(20) NOT NULL,
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
  `taskID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `porposalID` int NOT NULL,
  `description` text NOT NULL,
  `proposeAmount` int DEFAULT NULL,
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
  `nStars` int NOT NULL,
  `reviewDescription` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` int NOT NULL,
  `fName` varchar(20) NOT NULL,
  `lName` varchar(20) NOT NULL,
  `NIC` varchar(13) NOT NULL,
  `address` text NOT NULL,
  `status` enum('verified','verification pending','banned','') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `verificationDocuments` text NOT NULL,
  `accountNo` varchar(20) NOT NULL,
  `userID` int NOT NULL,
  `universityID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `taskType` enum('fixedPrice','auction') NOT NULL,
  `description` text NOT NULL,
  `deadline` datetime DEFAULT NULL,
  `value` int NOT NULL,
  `status` varchar(10) NOT NULL,
  `companyID` int NOT NULL,
  `assignedStudentID` int DEFAULT NULL,
  `categoryID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE `university` (
  `universityID` int NOT NULL,
  `universityName` varchar(50) NOT NULL,
  `domain` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `contactNo` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  ADD KEY `review-company` (`companyID`);

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
  MODIFY `adminID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int NOT NULL AUTO_INCREMENT;

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
  MODIFY `companyID` int NOT NULL AUTO_INCREMENT;

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
  MODIFY `studentID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_payment`
--
ALTER TABLE `student_payment`
  MODIFY `student_payment_ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `taskID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `universityID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `review-student` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON UPDATE CASCADE;

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
