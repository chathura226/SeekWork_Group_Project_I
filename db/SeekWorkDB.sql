-- MySQL dump 10.13  Distrib 8.2.0, for Linux (x86_64)
--
-- Host: localhost    Database: SeekWorkDB
-- ------------------------------------------------------
-- Server version	8.2.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Moderator_Verifies_Company`
--

DROP TABLE IF EXISTS `Moderator_Verifies_Company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Moderator_Verifies_Company` (
  `verificationID` int NOT NULL AUTO_INCREMENT,
  `verificationDate` datetime NOT NULL,
  `status` enum('verified','verification pending','banned') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `comments` text,
  `moderatorID` int NOT NULL,
  `companyID` int NOT NULL,
  `documents` text NOT NULL,
  PRIMARY KEY (`verificationID`),
  KEY `moderator-verification` (`moderatorID`),
  KEY `verification-company` (`companyID`),
  CONSTRAINT `moderator-verification` FOREIGN KEY (`moderatorID`) REFERENCES `moderator` (`moderatorID`) ON UPDATE CASCADE,
  CONSTRAINT `verification-company` FOREIGN KEY (`companyID`) REFERENCES `company` (`companyID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Moderator_Verifies_Company`
--

LOCK TABLES `Moderator_Verifies_Company` WRITE;
/*!40000 ALTER TABLE `Moderator_Verifies_Company` DISABLE KEYS */;
/*!40000 ALTER TABLE `Moderator_Verifies_Company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `adminID` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `address` text,
  `profilePic` varchar(1024) DEFAULT NULL,
  `userID` int NOT NULL,
  PRIMARY KEY (`adminID`),
  KEY `user-admin` (`userID`),
  CONSTRAINT `user-admin` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (3,'chathura','lakshan',NULL,NULL,11),(4,'Seekwork','admin','No.5 Seekwork rd.','uploads/profilePics/1699840713Screenshot from 2023-11-13 07-28-11.png',25);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assignment`
--

DROP TABLE IF EXISTS `assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assignment` (
  `assignmentID` int NOT NULL AUTO_INCREMENT,
  `status` enum('pending','accepted','declined') NOT NULL DEFAULT 'pending',
  `taskID` int NOT NULL,
  `proposalID` int NOT NULL,
  `replyDate` datetime DEFAULT NULL COMMENT 'accpted or declined date',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`assignmentID`),
  UNIQUE KEY `proposalID` (`proposalID`),
  KEY `task-assignment` (`taskID`),
  CONSTRAINT `assigned proposal` FOREIGN KEY (`proposalID`) REFERENCES `proposal` (`proposalID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `task-assignment` FOREIGN KEY (`taskID`) REFERENCES `task` (`taskID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignment`
--

LOCK TABLES `assignment` WRITE;
/*!40000 ALTER TABLE `assignment` DISABLE KEYS */;
INSERT INTO `assignment` VALUES (13,'accepted',9,2,'2023-10-04 07:13:37','2023-10-02 06:58:38'),(14,'accepted',3,5,'2023-10-31 13:11:32','2023-10-31 13:10:32'),(15,'accepted',10,6,'2023-11-01 06:47:32','2023-11-01 01:18:11');
/*!40000 ALTER TABLE `assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `categoryID` int NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `tags` text NOT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Graphic Design','Work related to graphic designing ','graphic\r\nlogo\r\ndesign'),(2,'Web development','Work associated with web development','php\r\nhtml\r\ncss\r\n'),(3,'Animation','Work associated with animations','anime,video editing,3d,gaming');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `certificate`
--

DROP TABLE IF EXISTS `certificate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `certificate` (
  `certificateID` int NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `studentID` int NOT NULL,
  `issuedDate` date NOT NULL,
  PRIMARY KEY (`certificateID`),
  KEY `student-certificate` (`studentID`),
  CONSTRAINT `student-certificate` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certificate`
--

LOCK TABLES `certificate` WRITE;
/*!40000 ALTER TABLE `certificate` DISABLE KEYS */;
/*!40000 ALTER TABLE `certificate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `certificate-category`
--

DROP TABLE IF EXISTS `certificate-category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `certificate-category` (
  `certificate_category_ID` int NOT NULL AUTO_INCREMENT,
  `certificateID` int NOT NULL,
  `categoryID` int NOT NULL,
  PRIMARY KEY (`certificate_category_ID`),
  KEY `category-certificate_category` (`categoryID`),
  KEY `certificate-certificate_category` (`certificateID`),
  CONSTRAINT `category-certificate_category` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `certificate-certificate_category` FOREIGN KEY (`certificateID`) REFERENCES `certificate` (`certificateID`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certificate-category`
--

LOCK TABLES `certificate-category` WRITE;
/*!40000 ALTER TABLE `certificate-category` DISABLE KEYS */;
/*!40000 ALTER TABLE `certificate-category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company` (
  `companyID` int NOT NULL AUTO_INCREMENT,
  `companyName` varchar(50) NOT NULL,
  `status` enum('verified','verification pending','banned','') NOT NULL DEFAULT 'verification pending',
  `firstName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'first name of contact person',
  `lastName` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `website` text,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `brn` varchar(50) NOT NULL,
  `userID` int NOT NULL,
  PRIMARY KEY (`companyID`),
  UNIQUE KEY `brn-unique` (`brn`),
  KEY `user-company` (`userID`),
  CONSTRAINT `user-company` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1,'kk','verification pending','aa','aa','aaa','https://www.kk.com','','aa',16),(2,'Pheonix','verification pending','chathura','lakshan','colombo','https://www.seekwork.com','Pheonix is a dynamic and innovative design company dedicated to turning your creative vision into reality. With a team of highly skilled and experienced designers, we offer a wide range of design services tailored to meet the unique needs of our clients.','1111111',22),(3,'seekwork.com','verified','lakshan','chathura','colombo','',NULL,'11111',24),(4,'Seekwork Company','verification pending','Seekwork','Company','No.5 Seekwork rd.','',NULL,'1111111111',27);
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_payment`
--

DROP TABLE IF EXISTS `company_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_payment` (
  `company_payment_ID` int NOT NULL AUTO_INCREMENT,
  `companyID` int NOT NULL,
  `paymentID` int NOT NULL,
  `sentDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`company_payment_ID`),
  KEY `com-pay` (`companyID`),
  KEY `pay2` (`paymentID`),
  CONSTRAINT `com-pay` FOREIGN KEY (`companyID`) REFERENCES `company` (`companyID`) ON UPDATE CASCADE,
  CONSTRAINT `pay2` FOREIGN KEY (`paymentID`) REFERENCES `payment` (`paymentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_payment`
--

LOCK TABLES `company_payment` WRITE;
/*!40000 ALTER TABLE `company_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dispute`
--

DROP TABLE IF EXISTS `dispute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dispute` (
  `disputeID` int NOT NULL AUTO_INCREMENT,
  `subject` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('resolved','pending','invalid') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'pending',
  `type` enum('payment','other') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `initiatedParty` enum('student','company') NOT NULL,
  `taskID` int NOT NULL,
  `moderatorID` int DEFAULT NULL,
  `moderatorComment` text,
  PRIMARY KEY (`disputeID`),
  KEY `task-dispute` (`taskID`),
  KEY `dispute-moderator` (`moderatorID`),
  CONSTRAINT `dispute-moderator` FOREIGN KEY (`moderatorID`) REFERENCES `moderator` (`moderatorID`),
  CONSTRAINT `task-dispute` FOREIGN KEY (`taskID`) REFERENCES `task` (`taskID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dispute`
--

LOCK TABLES `dispute` WRITE;
/*!40000 ALTER TABLE `dispute` DISABLE KEYS */;
INSERT INTO `dispute` VALUES (1,'first dispute','dejdedmedmed enjed','2023-10-24 23:34:57','pending','payment','company',10,NULL,NULL),(4,'Regarding payment on nov 1st','Haven\'t got my milestone payment','2023-10-30 23:38:14','pending','payment','student',10,NULL,NULL),(7,'dede','eddeed','2023-10-31 00:21:00','pending','payment','student',9,NULL,NULL),(8,'dede','eddeed','2023-10-31 00:21:23','pending','payment','student',9,NULL,NULL),(10,'fcr','refe','2023-10-31 06:37:47','pending','other','company',9,NULL,NULL);
/*!40000 ALTER TABLE `dispute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moderator`
--

DROP TABLE IF EXISTS `moderator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `moderator` (
  `moderatorID` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(100) NOT NULL,
  `profilePic` varchar(1024) DEFAULT NULL,
  `userID` int NOT NULL,
  PRIMARY KEY (`moderatorID`),
  KEY `user-moderator` (`userID`),
  CONSTRAINT `user-moderator` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moderator`
--

LOCK TABLES `moderator` WRITE;
/*!40000 ALTER TABLE `moderator` DISABLE KEYS */;
INSERT INTO `moderator` VALUES (1,'Seekwork','Moderator','No.5 Seekwork rd.','uploads/profilePics/1699847763Screenshot from 2023-11-13 09-24-28.png',28),(2,'Pasindu','Ekanayake','colombo',NULL,31);
/*!40000 ALTER TABLE `moderator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment` (
  `paymentID` int NOT NULL AUTO_INCREMENT,
  `paymentStatus` varchar(10) NOT NULL,
  `taskID` int NOT NULL,
  `amount` double NOT NULL,
  PRIMARY KEY (`paymentID`),
  KEY `payment-task` (`taskID`),
  CONSTRAINT `payment-task` FOREIGN KEY (`taskID`) REFERENCES `task` (`taskID`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proposal`
--

DROP TABLE IF EXISTS `proposal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proposal` (
  `proposalID` int NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `documents` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `proposeAmount` double DEFAULT NULL,
  `submissionDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `taskID` int NOT NULL,
  `studentID` int NOT NULL,
  PRIMARY KEY (`proposalID`),
  KEY `task-proposal` (`taskID`),
  KEY `student-proposal` (`studentID`),
  CONSTRAINT `student-proposal` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `task-proposal` FOREIGN KEY (`taskID`) REFERENCES `task` (`taskID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proposal`
--

LOCK TABLES `proposal` WRITE;
/*!40000 ALTER TABLE `proposal` DISABLE KEYS */;
INSERT INTO `proposal` VALUES (2,'ffwewcdcdc',NULL,NULL,'2023-09-26 07:35:47',9,14),(3,'dede',NULL,2,'2023-09-26 07:44:40',9,14),(5,'proposla',NULL,NULL,'2023-10-31 12:56:37',3,14),(6,'proposal for task 10',NULL,9000,'2023-11-01 01:17:12',10,14);
/*!40000 ALTER TABLE `proposal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `review` (
  `reviewID` int NOT NULL AUTO_INCREMENT,
  `reviewTitle` varchar(20) NOT NULL,
  `reviewType` enum('studentTOcompany','companyTOstudent') NOT NULL,
  `studentID` int NOT NULL,
  `companyID` int NOT NULL,
  `taskID` int NOT NULL,
  `nStars` int NOT NULL,
  `reviewDescription` text,
  `reviewDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`reviewID`),
  KEY `review-student` (`studentID`),
  KEY `review-company` (`companyID`),
  KEY `review-Task` (`taskID`),
  CONSTRAINT `review-company` FOREIGN KEY (`companyID`) REFERENCES `company` (`companyID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `review-student` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON UPDATE CASCADE,
  CONSTRAINT `review-Task` FOREIGN KEY (`taskID`) REFERENCES `task` (`taskID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
INSERT INTO `review` VALUES (2,'eede','companyTOstudent',9,4,9,3,'ede','2023-09-28 03:36:55');
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student` (
  `studentID` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `qualifications` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `NIC` varchar(13) NOT NULL,
  `address` text NOT NULL,
  `status` enum('verified','verification pending','banned','') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'verification pending',
  `verificationDocuments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `accountNo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `profilePic` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `userID` int NOT NULL,
  `universityID` int DEFAULT NULL,
  PRIMARY KEY (`studentID`),
  UNIQUE KEY `nic` (`NIC`),
  KEY `user-student` (`userID`),
  KEY `student-university` (`universityID`),
  CONSTRAINT `student-university` FOREIGN KEY (`universityID`) REFERENCES `university` (`universityID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `user-student` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (4,'aaa','bbb','qqqq','ddd','200105702857','ccc','verified',NULL,NULL,NULL,12,1),(6,'aaa','bb',NULL,NULL,'660951105v','aaa','verification pending',NULL,NULL,NULL,14,NULL),(7,'aaa','bb',NULL,NULL,'660951145v','aaa','verification pending',NULL,NULL,NULL,15,NULL),(8,'chathura','lakshan',NULL,NULL,'200105702855','skjnwk','verification pending',NULL,NULL,NULL,17,NULL),(9,'sajith','rajapakse',NULL,NULL,'200012365849','99 madamulana pallebedda','verification pending',NULL,NULL,NULL,18,NULL),(10,'sajith','rajapakse',NULL,NULL,'960951105v','99 madamulana pallebedda','verification pending',NULL,NULL,NULL,19,NULL),(12,'chathura','lakshan',NULL,NULL,'123456789123','111','verification pending',NULL,NULL,NULL,21,NULL),(14,'Seekwork','student','student qualifications','student description','234567890123','No.5 Seekwork rd.','verification pending',NULL,NULL,'uploads/profilePics/1699844370Screenshot from 2023-11-13 08-14-41.png',26,1),(16,'chathura','lakshan',NULL,NULL,'200105702899','dkjmwd','verification pending',NULL,NULL,NULL,29,NULL),(17,'chathura','lakshan',NULL,NULL,'200105702868','njasw','verification pending',NULL,NULL,NULL,30,NULL);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_payment`
--

DROP TABLE IF EXISTS `student_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_payment` (
  `student_payment_ID` int NOT NULL AUTO_INCREMENT,
  `paymentID` int NOT NULL,
  `studentID` int NOT NULL,
  `recievedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`student_payment_ID`),
  KEY `pay` (`paymentID`),
  KEY `stu-pay` (`studentID`),
  CONSTRAINT `pay` FOREIGN KEY (`paymentID`) REFERENCES `payment` (`paymentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `stu-pay` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_payment`
--

LOCK TABLES `student_payment` WRITE;
/*!40000 ALTER TABLE `student_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submission`
--

DROP TABLE IF EXISTS `submission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `submission` (
  `submissionID` int NOT NULL AUTO_INCREMENT,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `documents` text NOT NULL,
  `status` enum('pendingReview','accepted','rejected') NOT NULL DEFAULT 'pendingReview',
  `note` text COMMENT 'note by student abt submission',
  `reviewedDate` datetime DEFAULT NULL,
  `comments` text COMMENT 'comment by company ',
  `studentID` int NOT NULL,
  `taskID` int NOT NULL,
  PRIMARY KEY (`submissionID`),
  KEY `student-submission` (`studentID`),
  KEY `task-submission` (`taskID`),
  CONSTRAINT `student-submission` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `task-submission` FOREIGN KEY (`taskID`) REFERENCES `task` (`taskID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submission`
--

LOCK TABLES `submission` WRITE;
/*!40000 ALTER TABLE `submission` DISABLE KEYS */;
INSERT INTO `submission` VALUES (1,'2023-10-05 05:37:02','wswsw','pendingReview',NULL,NULL,NULL,14,9),(2,'2023-10-05 05:37:42','2222','pendingReview',NULL,NULL,NULL,14,9),(3,'2023-10-06 01:46:16','','pendingReview','boom',NULL,NULL,14,9),(4,'2023-10-06 01:46:56','','pendingReview','boom',NULL,NULL,14,9),(5,'2023-10-31 13:12:38','','pendingReview','description3',NULL,NULL,14,3);
/*!40000 ALTER TABLE `submission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `task` (
  `taskID` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `taskType` enum('fixed Price','auction') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text NOT NULL,
  `deadline` date DEFAULT NULL,
  `value` double NOT NULL,
  `status` enum('active','closed','inProgress','pendingAssignment') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `companyID` int NOT NULL,
  `assignedStudentID` int DEFAULT NULL,
  `assignmentID` int DEFAULT NULL,
  `categoryID` int NOT NULL,
  `finishedDate` date DEFAULT NULL,
  PRIMARY KEY (`taskID`),
  KEY `task-company` (`companyID`),
  KEY `task-student` (`assignedStudentID`),
  KEY `task-category` (`categoryID`),
  KEY `assignment-task` (`assignmentID`),
  CONSTRAINT `assignment-task` FOREIGN KEY (`assignmentID`) REFERENCES `assignment` (`assignmentID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `task-category` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `task-company` FOREIGN KEY (`companyID`) REFERENCES `company` (`companyID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `task-student` FOREIGN KEY (`assignedStudentID`) REFERENCES `student` (`studentID`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (1,'Design a Logo','fixed Price','I am starting a new enterprise and I am in need of a logo design.\r\nThe compony deals in Medical Devices and the logo needs to reflect that in a subtle way not in a way where there is a stethoscope in the logo. Name of company is \"MEDYCO LIFE BIOTECH\"\r\n\r\nIdeal skills and experience:\r\n- Experience in logo design\r\n- Creativity and ability to come up with unique and visually appealing designs\r\n- Proficiency in graphic design software\r\n- Strong attention to detail\r\n- Ability to understand and incorporate the vision and branding of a new enterprise','2023-09-09',5000,'active',2,NULL,NULL,1,NULL),(2,'Create a website','fixed Price','I am looking for an experienced web developer to create a website for me. Specifically, I need a blogging website, with specific design and functionality requirements. The website should be built on WordPress, with PHP and HTML as the core programming language. I already have web content and images ready to go for the new website, so the main scope of work is on the design and development side.\r\n\r\nThe design should be modern and sleek, with clean lines and fonts, as well as including all necessary components of a blog such as comment sections, tags and a SEO-friendly structure. On the development side, I am looking for a custom coding and development job. This includes incorporating necessary plug-ins for a usable and engaging user experience, designing and integrating attractive forms, and making sure the website works across multiple browsers and devices.\r\n\r\nExperience in web design and WordPress development are a must for this job. Additionally, it would be great if the candidate had expertise in SEO and has done any e-commerce projects in the past. Timely completion of the project is also important.',NULL,10000,'active',3,NULL,NULL,2,NULL),(3,'Animation For Stream\r\n','auction','Hello, I am looking for a talented animator who can create a specific introduction animation for my stream. The type of animation I need is 3D, and I have specific elements that I would like included in the animation. My goal is to create something visually stunning and memorable that can draw viewers in and make them stick around. ( I have the full idea ready, and clips to be used inside of the animation, the animation being between 3-5 minutes long ) If you have the skills and the creativity to create something that will be noticed, please reach out to me.',NULL,15000,'inProgress',4,14,14,3,NULL),(4,'task 1','fixed Price','task 1 description','2023-09-16',1000,'active',2,NULL,NULL,2,NULL),(6,'task 3','auction','Task 3 description','2023-09-30',222,'active',4,NULL,NULL,3,NULL),(9,'test task','fixed Price','Test task Description',NULL,22,'inProgress',4,14,13,3,'2023-09-29'),(10,'new test task','auction','New test Task description',NULL,2222,'inProgress',4,14,15,2,NULL);
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `university`
--

DROP TABLE IF EXISTS `university`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `university` (
  `universityID` int NOT NULL AUTO_INCREMENT,
  `universityName` varchar(50) NOT NULL,
  `domain` varchar(50) NOT NULL,
  PRIMARY KEY (`universityID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `university`
--

LOCK TABLES `university` WRITE;
/*!40000 ALTER TABLE `university` DISABLE KEYS */;
INSERT INTO `university` VALUES (1,'UCSC','stu.ucsc.cmb.ac.lk'),(2,'UOC','stu.uoc.cmb.ac.lk'),(4,'Science','stu.fos.cmb.ac.lk');
/*!40000 ALTER TABLE `university` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `userID` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `contactNo` varchar(12) NOT NULL,
  `role` varchar(20) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('active','deactivated') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`userID`),
  UNIQUE KEY `UNIQUE_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (11,'admin@admin.com','$2y$10$O9fihdAv7ftZ5N5mp.IQwuh1S644VmGJCNcRy0UEObVZ4y67fBv6a','123','admin','2023-09-17 16:11:13','active'),(12,'aa@k.com','$2y$10$gxa6lYdaNU6rfHY82CQGa.L4ABMpdTZUWgUlcbHTRarIJ7H1cYMwC','012-345-6789','student','2023-09-18 09:26:48','active'),(14,'aabj@k.com','$2y$10$KnHOE3tyqErLsjggmUPas.KZ/UmwyShx.lXYzuqW5bC9MbAFClUdy','012-345-6789','student','2023-09-18 09:34:29','active'),(15,'aaabj@k.com','$2y$10$78iEQp8L2EuONr7yVceNCebUdsYhaS1ICxIBk0fIv.FKGwyBeL4N2','012-345-6789','student','2023-09-18 09:36:48','active'),(16,'aaa@kk.com','$2y$10$P08nvJCK7z0t7dNScXZElO.uQ3MRgx90LbD9UkaZGPWqScqqn93qO','012-234-4567','company','2023-09-18 10:13:50','deactivated'),(17,'2021cs109@stu.ucsc.cmb.ac.lk','$2y$10$nt.D/ZdzXfdE/Qcjh/i7TOy/qZX1IsQDiKPy.44J0vMuCeiR2kh/O','012-345-6789','student','2023-09-18 11:47:26','active'),(18,'2021cs1029@stu.ucsc.cmb.ac.lk','$2y$10$VZn32bcZ7z4hfDZI8I1me.YjPNp/trCscXwAPXuHe1FLGjEuLx9vC','0775017409','student','2023-09-19 07:56:38','active'),(19,'2021cs018@stu.ucsc.cmb.ac.lk','$2y$10$COXY0b5joTnRQWRYJbySQe6/S1B90n3SJTUUWLi7/3GziO0xd0kEq','1111111111','student','2023-09-19 07:59:14','active'),(21,'chathura@stu.ucsc.cmb.ac.lk','$2y$10$k2xZ8oNZAsCvUtTV1wWwPe/pmGjO/QwXHbFL3z6od1JNcXLOTy6da','0112339220','student','2023-09-21 23:19:29','active'),(22,'chathura@seekwork.com','$2y$10$KPl6CHFI3XpZJiRhj1mbU.p3W3/jUxGLn8hHup94D7WMxI6YijZw.','0775017409','company','2023-09-23 10:04:25','active'),(24,'verifiedcompany@seekwork.com','$2y$10$zzkLQrkDSAopuKUH/PRflOpuJ2ccdKLuW6cuHe5pYiOLEd78IzY5G','0112929330','company','2023-09-23 10:57:51','active'),(25,'admin@seekwork.lk','$2y$10$QEl2uOsaYwRu5JTBnteBOu0Ar28MExvQMBrNdGsNsA0Yr092VIeru','0111111111','admin','2023-09-26 09:26:34','active'),(26,'student@seekwork.lk','$2y$10$SGoys3mOBHgW/hVBL1IP4e0nYbLCDU1AwVglqjrfulBET8ot1xDqu','0111111111','student','2023-09-26 09:27:28','active'),(27,'company@seekwork.lk','$2y$10$w3GHokkOlEVPbWeYdT3vSe2jwpE2DwQ1mmigKaZf5LeZW.RQ/N3re','0111111111','company','2023-09-26 09:28:43','active'),(28,'moderator@seekwork.lk','$2y$10$fHyCVpJQCQOhzd00yCI8ie0LG6EXmy1KjjriLo5tzJSSl1aSfeDFq','0111111111','moderator','2023-09-26 09:29:49','active'),(29,'kk.dmkde@gmail.com','$2y$10$ydF9klVGGOmPzg50FR5AHe.1fxbzKUqLjYwsFhn3KwdniTXSwQP/u','0116259662','student','2023-10-31 10:13:36','active'),(30,'chathura@ll.com','$2y$10$ActHuYVpk5nGfTyq98pf6eWvBY3OCvEvR03UjGGAqqNH.Rto00eD6','0775017409','student','2023-10-31 12:53:24','active'),(31,'pasindu@seekwork.lk','$2y$10$QED7NOu1nR/5DvUXbDgsN.csptwaf5N48hH6dhDx5EV66cS4JKNpW','0112939220','moderator','2023-10-31 14:43:38','active');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-13  3:56:38
