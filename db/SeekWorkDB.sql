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
  `comments` text,
  `status` enum('underReview','reviewed') NOT NULL DEFAULT 'underReview',
  `moderatorID` int DEFAULT NULL,
  `companyID` int NOT NULL,
  `documents` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`verificationID`),
  KEY `moderator-verification` (`moderatorID`),
  KEY `verification-company` (`companyID`),
  CONSTRAINT `moderator-verification` FOREIGN KEY (`moderatorID`) REFERENCES `moderator` (`moderatorID`) ON UPDATE CASCADE,
  CONSTRAINT `verification-company` FOREIGN KEY (`companyID`) REFERENCES `company` (`companyID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Moderator_Verifies_Company`
--

LOCK TABLES `Moderator_Verifies_Company` WRITE;
/*!40000 ALTER TABLE `Moderator_Verifies_Company` DISABLE KEYS */;
INSERT INTO `Moderator_Verifies_Company` VALUES (1,'zw','underReview',1,4,'../app/uploads/verification/27/1701787986-1701764247-Screenshot from 2023-12-02 22-23-27.png'),(2,'test','reviewed',1,3,'../app/uploads/verification/27/1701787986-17017642...');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (4,'Seekwork','admin','No.5 Seekwork r','uploads/profilePics/1701055253404_cat.png',25);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER `admin_insert_audit_trigger` AFTER INSERT ON `admin` FOR EACH ROW BEGIN
    INSERT INTO admin_audit_log(
        adminID,
        actionType,
        actionTime,
        old_data,
        new_data,
        loggedUserID
    )
    VALUES(
        NEW.adminID,
        'INSERT',
        CURRENT_TIMESTAMP,
        NULL,
        JSON_OBJECT(
            "firstName", NEW.firstName,
            "lastName", NEW.lastName,
            "address", NEW.address,
            "profilePic", NEW.profilePic,
            "userID", NEW.userID
        ),
        @logged_user
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER `admin_update_audit_trigger` AFTER UPDATE ON `admin` FOR EACH ROW BEGIN
    INSERT INTO admin_audit_log(
        adminID,
        actionType,
        actionTime,
        old_data,
        new_data,
        loggedUserID
    )
    VALUES(
        NEW.adminID,
        'UPDATE',
        CURRENT_TIMESTAMP,
        JSON_OBJECT(
            "firstName", OLD.firstName,
            "lastName", OLD.lastName,
            "address", OLD.address,
            "profilePic", OLD.profilePic,
            "userID", OLD.userID
        ),
        JSON_OBJECT(
            "firstName", NEW.firstName,
            "lastName", NEW.lastName,
            "address", NEW.address,
            "profilePic", NEW.profilePic,
            "userID", NEW.userID
        ),
        @logged_user
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER `admin_delete_audit_trigger` AFTER DELETE ON `admin` FOR EACH ROW BEGIN
    INSERT INTO admin_audit_log(
        adminID,
        actionType,
        actionTime,
        old_data,
        new_data,
        loggedUserID
    )
    VALUES(
        OLD.adminID,
        'DELETE',
        CURRENT_TIMESTAMP,
        JSON_OBJECT(
            "firstName", OLD.firstName,
            "lastName", OLD.lastName,
            "address", OLD.address,
            "profilePic", OLD.profilePic,
            "userID", OLD.userID
        ),
        NULL,
        @logged_user
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `admin_audit_log`
--

DROP TABLE IF EXISTS `admin_audit_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_audit_log` (
  `adminID` int NOT NULL,
  `actionType` enum('INSERT','UPDATE','DELETE') NOT NULL,
  `actionTime` timestamp NOT NULL,
  `old_data` json DEFAULT NULL,
  `new_data` json DEFAULT NULL,
  `loggedUserID` int DEFAULT NULL,
  PRIMARY KEY (`adminID`,`actionType`,`actionTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_audit_log`
--

LOCK TABLES `admin_audit_log` WRITE;
/*!40000 ALTER TABLE `admin_audit_log` DISABLE KEYS */;
INSERT INTO `admin_audit_log` VALUES (5,'INSERT','2023-11-29 09:21:58',NULL,'{\"userID\": 18, \"address\": null, \"lastName\": \"hbj\", \"firstName\": \"bhj\", \"profilePic\": \"bjh\"}',NULL),(5,'UPDATE','2023-11-29 09:22:04','{\"userID\": 18, \"address\": null, \"lastName\": \"hbj\", \"firstName\": \"bhj\", \"profilePic\": \"bjh\"}','{\"userID\": 18, \"address\": null, \"lastName\": \"hbjdewdewdew\", \"firstName\": \"bhj\", \"profilePic\": \"bjh\"}',NULL),(5,'DELETE','2023-11-29 09:22:07','{\"userID\": 18, \"address\": null, \"lastName\": \"hbjdewdewdew\", \"firstName\": \"bhj\", \"profilePic\": \"bjh\"}',NULL,NULL);
/*!40000 ALTER TABLE `admin_audit_log` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignment`
--

LOCK TABLES `assignment` WRITE;
/*!40000 ALTER TABLE `assignment` DISABLE KEYS */;
INSERT INTO `assignment` VALUES (15,'accepted',10,6,'2023-11-01 06:47:32','2023-11-01 01:18:11'),(16,'accepted',6,7,'2024-01-11 14:56:15','2024-01-11 14:55:41'),(17,'accepted',4,8,'2024-02-20 09:21:38','2024-02-06 10:49:01'),(18,'accepted',14,9,'2024-02-20 15:50:26','2024-02-20 15:50:06'),(19,'accepted',15,10,'2024-02-20 23:01:09','2024-02-20 23:00:58');
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
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text NOT NULL,
  `tags` text NOT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Design','Create visually appealing and impactful designs for digital and physical products.','graphic design,web design,product design,UX/UI design,illustration,animation'),(2,'Web development','Build and maintain websites and web applications with coding expertise.','front-end development,back-end development,full-stack development,WordPress development'),(3,'Animation','Capture visual stories and moments through video and photography, and enhance them with editing and animation.','videography,photography,editing,animation'),(39,'Writing','Craft compelling written content for various purposes, from websites to articles to novels.','content writing,copywriting,technical writing,creative writing,editing,proofreading,grant writing'),(41,'Music & Audio','Bring sound and music to life through composition, editing, and voice acting.','composing music,sound design,audio editing,voice acting'),(43,'Marketing','Develop and execute marketing campaigns to attract and engage customers.','social media marketing,content marketing,email marketing,SEO,PPC,marketing strategy'),(44,'Sales','Help businesses reach and convert leads into paying customers.','lead generation,cold calling,sales presentations,account management'),(45,'Operations','Ensure smooth business operations through organization, support, and data management.','project management,virtual assistance,customer service,data entry'),(46,'Consulting','Provide expert advice and guidance to businesses in various areas.','business consulting,financial consulting,marketing consulting,technology consulting'),(48,'Mobile App Development','Create mobile apps for different platforms, reaching users on their devices.','iOS development,Android development,cross-platform development'),(49,'Software Development','Develop software applications for various needs and platforms.','desktop software development,enterprise software development,cloud-based software development'),(50,'Data Science & Machine Learning','Extract insights from data and build intelligent systems using advanced techniques.','data analysis,machine learning,artificial intelligence'),(51,'Translation & Localization','Bridge language barriers by translating and adapting content for specific audiences.','translation,localization'),(52,'Education & Training','Share your knowledge and expertise by creating or delivering educational content.','online tutoring,teaching online courses,educational materials'),(53,'Legal','Provide legal support and services in various areas.','paralegal work,legal research,contract drafting'),(54,'Accounting & Finance','Manage financial matters for individuals or businesses with accuracy and expertise.','bookkeeping,tax preparation,financial analysis');
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
-- Table structure for table `chat_connections`
--

DROP TABLE IF EXISTS `chat_connections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat_connections` (
  `person1` int NOT NULL,
  `person2` int NOT NULL,
  `person1_role` text NOT NULL,
  `person2_role` text NOT NULL,
  PRIMARY KEY (`person1`,`person2`),
  KEY `person1` (`person1`,`person2`),
  KEY `person2-user` (`person2`),
  CONSTRAINT `person1-user` FOREIGN KEY (`person1`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `person2-user` FOREIGN KEY (`person2`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_connections`
--

LOCK TABLES `chat_connections` WRITE;
/*!40000 ALTER TABLE `chat_connections` DISABLE KEYS */;
INSERT INTO `chat_connections` VALUES (26,27,'student','company'),(28,12,'moderator','student'),(28,26,'moderator','student'),(42,44,'company','student');
/*!40000 ALTER TABLE `chat_connections` ENABLE KEYS */;
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
  `profilePic` varchar(1024) DEFAULT NULL,
  `brn` varchar(50) NOT NULL,
  `userID` int NOT NULL,
  `final_rating` double NOT NULL DEFAULT '5',
  `nReviews` int NOT NULL DEFAULT '0',
  `nTasks` int NOT NULL DEFAULT '0' COMMENT 'no of tasks',
  PRIMARY KEY (`companyID`),
  UNIQUE KEY `brn-unique` (`brn`),
  KEY `user-company` (`userID`),
  CONSTRAINT `user-company` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1,'kk','verification pending','aa','aa','aaa','https://www.kk.com','',NULL,'aa',16,5,0,0),(2,'Pheonix','verification pending','chathura','lakshan','colombo','https://www.seekwork.com','Pheonix is a dynamic and innovative design company dedicated to turning your creative vision into reality. With a team of highly skilled and experienced designers, we offer a wide range of design services tailored to meet the unique needs of our clients.',NULL,'1111111',22,5,0,0),(3,'seekwork.com','verified','lakshan','chathura','colombo','',NULL,NULL,'11111',24,5,0,0),(4,'Seekwork Company','verification pending','Seekwork','Company','No.5 Seekwork rd.','https://www.seekwork.com','test','uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png','1111111111',27,5,5,1),(6,'lll','verification pending','lll','lll','lll','',NULL,NULL,'gb78',34,5,0,0),(7,'kk','verification pending','kk','ll','ll','',NULL,NULL,'kjn',35,5,0,0),(10,'BetaSoft Innovations Inc.','verification pending','Michael','Smith','56 Oak Avenue, Oracle Lane, Colombo.','https://www.betasoftinnovations.com','BetaTronics Innovations Inc. is at the forefront of electronics manufacturing, producing state-of-the-art components and devices for a variety of industries. Their commitment to quality and innovation has earned them a reputation as a trusted partner for companies seeking high-performance electronic solutions. From prototype development to full-scale production, BetaTronics Innovations delivers excellence in every aspect of their business.','uploads/profilePics/1708430659silver-letters-glass-building-facade_145275-162.jpg','0987654321',39,5,0,2),(11,'TechNex Solutions LLC','verification pending','Sarah','Lee',' 789 Pine Street, Metroville, NY, USA','https://www.technexsolutions.net','\r\nTechNex Solutions LLC is a dynamic and innovative technology company dedicated to providing cutting-edge solutions to businesses worldwide. Specializing in software development, IT consulting, and digital transformation services, TechNex Solutions helps organizations leverage technology to drive growth, improve efficiency, and stay ahead of the competition.','uploads/profilePics/1708431291what-is-a-company.jpg','5432109876',40,5,0,2),(12,'Quantum Dynamics Corp','verification pending','David','Chang',' 101 Quantum Street, Innovatown, Nuwara Eliya','','Quantum Dynamics Corp is a pioneering force in the field of quantum computing and advanced technology solutions. With a relentless pursuit of innovation and a team of world-class researchers and engineers, Quantum Dynamics Corp is at the forefront of revolutionizing computation and data processing.','uploads/profilePics/1708431661group-three-modern-architects_23-2147702101.jpg','1357902468',41,4,1,2),(13,'InfinitiTech Solutions Ltd.','verification pending','Jennifer','Williams','246 Elm Road, Techville, Badulla','https://www.infinititechsolutions.com','\r\nInfinitiTech Solutions Ltd. is a leading provider of comprehensive IT solutions and services tailored to meet the evolving needs of businesses worldwide. With a focus on innovation, reliability, and customer satisfaction, InfinitiTech Solutions delivers cutting-edge technology solutions that drive growth and efficiency.','uploads/profilePics/1708431951hands-holding-puzzle-business-problem-solving-concept_53876-143285.jpg','9876543210',42,5,1,2),(14,'Phoenix Innovations Group','verification pending','Daniel','Rodriguez','369 Maple Avenue, Innovia, Dambulla','https://www.phoenixinnovationsgroup.net','Phoenix Innovations Group is a dynamic and forward-thinking technology company dedicated to driving innovation and transformation across industries. With a focus on creativity, agility, and excellence, Phoenix Innovations Group offers a diverse range of solutions designed to meet the evolving needs of businesses in the digital age.\r\n\r\n','uploads/profilePics/1708432130modern-office-building-features-luxury-skyline-view-generated-by-ai_188544-26677.jpg','2468013579',43,5,0,2);
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER `company_insert_audit_trigger` AFTER INSERT ON `company` FOR EACH ROW BEGIN
    INSERT INTO company_audit_log(
        companyID,
        actionType,
        actionTime,
        old_data,
        new_data,
        loggedUserID
    )
    VALUES(
        NEW.companyID,
        'INSERT',
        CURRENT_TIMESTAMP,
        NULL,
        JSON_OBJECT(
            "companyName", NEW.companyName,
            "status", NEW.status,
            "firstName", NEW.firstName,
            "lastName", NEW.lastName,
            "address", NEW.address,
            "website", NEW.website,
            "description", NEW.description,
            "profilePic", NEW.profilePic,
            "brn", NEW.brn,
            "userID", NEW.userID
        ),
        @logged_user
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER `company_update_audit_trigger` AFTER UPDATE ON `company` FOR EACH ROW BEGIN
    INSERT INTO company_audit_log(
        companyID,
        actionType,
        actionTime,
        old_data,
        new_data,
        loggedUserID
    )
    VALUES(
        NEW.companyID,
        'UPDATE',
        CURRENT_TIMESTAMP,
        JSON_OBJECT(
            "companyName", OLD.companyName,
            "status", OLD.status,
            "firstName", OLD.firstName,
            "lastName", OLD.lastName,
            "address", OLD.address,
            "website", OLD.website,
            "description", OLD.description,
            "profilePic", OLD.profilePic,
            "brn", OLD.brn,
            "userID", OLD.userID
        ),
        JSON_OBJECT(
            "companyName", NEW.companyName,
            "status", NEW.status,
            "firstName", NEW.firstName,
            "lastName", NEW.lastName,
            "address", NEW.address,
            "website", NEW.website,
            "description", NEW.description,
            "profilePic", NEW.profilePic,
            "brn", NEW.brn,
            "userID", NEW.userID
        ),
        @logged_user
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER `company_delete_audit_trigger` AFTER DELETE ON `company` FOR EACH ROW BEGIN
    INSERT INTO company_audit_log(
        companyID,
        actionType,
        actionTime,
        old_data,
        new_data,
        loggedUserID
    )
    VALUES(
        OLD.companyID,
        'DELETE',
        CURRENT_TIMESTAMP,
        JSON_OBJECT(
            "companyName", OLD.companyName,
            "status", OLD.status,
            "firstName", OLD.firstName,
            "lastName", OLD.lastName,
            "address", OLD.address,
            "website", OLD.website,
            "description", OLD.description,
            "profilePic", OLD.profilePic,
            "brn", OLD.brn,
            "userID", OLD.userID
        ),
        NULL,
        @logged_user
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `company_audit_log`
--

DROP TABLE IF EXISTS `company_audit_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_audit_log` (
  `companyID` int NOT NULL,
  `actionType` enum('INSERT','UPDATE','DELETE') NOT NULL,
  `actionTime` timestamp NOT NULL,
  `old_data` json DEFAULT NULL,
  `new_data` json DEFAULT NULL,
  `loggedUserID` int DEFAULT NULL,
  PRIMARY KEY (`companyID`,`actionType`,`actionTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_audit_log`
--

LOCK TABLES `company_audit_log` WRITE;
/*!40000 ALTER TABLE `company_audit_log` DISABLE KEYS */;
INSERT INTO `company_audit_log` VALUES (3,'UPDATE','2023-12-06 15:34:29','{\"brn\": \"11111\", \"status\": \"verified\", \"userID\": 24, \"address\": \"colombo\", \"website\": \"\", \"lastName\": \"chathura\", \"firstName\": \"lakshan\", \"profilePic\": null, \"companyName\": \"seekwork.com\", \"description\": null}','{\"brn\": \"11111\", \"status\": \"verification pending\", \"userID\": 24, \"address\": \"colombo\", \"website\": \"\", \"lastName\": \"chathura\", \"firstName\": \"lakshan\", \"profilePic\": null, \"companyName\": \"seekwork.com\", \"description\": null}',NULL),(3,'UPDATE','2023-12-06 15:40:37','{\"brn\": \"11111\", \"status\": \"verification pending\", \"userID\": 24, \"address\": \"colombo\", \"website\": \"\", \"lastName\": \"chathura\", \"firstName\": \"lakshan\", \"profilePic\": null, \"companyName\": \"seekwork.com\", \"description\": null}','{\"brn\": \"11111\", \"status\": \"verified\", \"userID\": 24, \"address\": \"colombo\", \"website\": \"\", \"lastName\": \"chathura\", \"firstName\": \"lakshan\", \"profilePic\": null, \"companyName\": \"seekwork.com\", \"description\": null}',28),(4,'UPDATE','2023-12-05 14:51:18','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": null}','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}',27),(4,'UPDATE','2023-12-05 14:51:55','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}',27),(4,'UPDATE','2023-12-05 14:53:06','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}',27),(4,'UPDATE','2024-02-07 09:48:46','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}',26),(4,'UPDATE','2024-02-07 09:50:33','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}',NULL),(4,'UPDATE','2024-02-07 09:54:32','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}',NULL),(4,'UPDATE','2024-02-07 09:56:00','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}',NULL),(4,'UPDATE','2024-02-07 10:03:02','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}',NULL),(4,'UPDATE','2024-02-07 10:03:05','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}',NULL),(4,'UPDATE','2024-02-07 10:03:07','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}',NULL),(4,'UPDATE','2024-02-07 10:09:00','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}',26),(4,'UPDATE','2024-02-07 10:48:06','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}',NULL),(4,'UPDATE','2024-02-07 10:56:21','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}',NULL),(4,'UPDATE','2024-02-07 11:53:03','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}',27),(4,'UPDATE','2024-02-07 11:56:12','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}',NULL),(4,'UPDATE','2024-02-07 12:00:23','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}',NULL),(4,'UPDATE','2024-02-07 12:41:29','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}','{\"brn\": \"1111111111\", \"status\": \"verification pending\", \"userID\": 27, \"address\": \"No.5 Seekwork rd.\", \"website\": \"https://www.seekwork.com\", \"lastName\": \"Company\", \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1699934037Screenshot from 2023-11-14 09-21-13.png\", \"companyName\": \"Seekwork Company\", \"description\": \"test\"}',NULL),(9,'INSERT','2023-11-29 08:52:47',NULL,'{\"brn\": \"swq2\", \"status\": \"verification pending\", \"userID\": 17, \"address\": \"\", \"website\": null, \"lastName\": \"jbhj\", \"firstName\": \"bjh\", \"profilePic\": null, \"companyName\": \"hj\", \"description\": null}',NULL),(9,'UPDATE','2023-11-29 08:52:56','{\"brn\": \"swq2\", \"status\": \"verification pending\", \"userID\": 17, \"address\": \"\", \"website\": null, \"lastName\": \"jbhj\", \"firstName\": \"bjh\", \"profilePic\": null, \"companyName\": \"hj\", \"description\": null}','{\"brn\": \"swq2dewdw\", \"status\": \"verification pending\", \"userID\": 17, \"address\": \"\", \"website\": null, \"lastName\": \"jbhj\", \"firstName\": \"bjh\", \"profilePic\": null, \"companyName\": \"hj\", \"description\": null}',NULL),(9,'DELETE','2023-11-29 08:53:00','{\"brn\": \"swq2dewdw\", \"status\": \"verification pending\", \"userID\": 17, \"address\": \"\", \"website\": null, \"lastName\": \"jbhj\", \"firstName\": \"bjh\", \"profilePic\": null, \"companyName\": \"hj\", \"description\": null}',NULL,NULL),(10,'INSERT','2024-02-20 12:01:46',NULL,'{\"brn\": \"0987654321\", \"status\": \"verification pending\", \"userID\": 39, \"address\": \"56 Oak Avenue, Oracle Lane, Colombo.\", \"website\": \"https://www.betasoftinnovations.com\", \"lastName\": \"Smith\", \"firstName\": \"Michael\", \"profilePic\": null, \"companyName\": \"BetaSoft Innovations Inc.\", \"description\": null}',NULL),(10,'UPDATE','2024-02-20 12:04:19','{\"brn\": \"0987654321\", \"status\": \"verification pending\", \"userID\": 39, \"address\": \"56 Oak Avenue, Oracle Lane, Colombo.\", \"website\": \"https://www.betasoftinnovations.com\", \"lastName\": \"Smith\", \"firstName\": \"Michael\", \"profilePic\": null, \"companyName\": \"BetaSoft Innovations Inc.\", \"description\": null}','{\"brn\": \"0987654321\", \"status\": \"verification pending\", \"userID\": 39, \"address\": \"56 Oak Avenue, Oracle Lane, Colombo.\", \"website\": \"https://www.betasoftinnovations.com\", \"lastName\": \"Smith\", \"firstName\": \"Michael\", \"profilePic\": \"uploads/profilePics/1708430659silver-letters-glass-building-facade_145275-162.jpg\", \"companyName\": \"BetaSoft Innovations Inc.\", \"description\": \"BetaTronics Innovations Inc. is at the forefront of electronics manufacturing, producing state-of-the-art components and devices for a variety of industries. Their commitment to quality and innovation has earned them a reputation as a trusted partner for companies seeking high-performance electronic solutions. From prototype development to full-scale production, BetaTronics Innovations delivers excellence in every aspect of their business.\"}',39),(10,'UPDATE','2024-02-20 12:47:00','{\"brn\": \"0987654321\", \"status\": \"verification pending\", \"userID\": 39, \"address\": \"56 Oak Avenue, Oracle Lane, Colombo.\", \"website\": \"https://www.betasoftinnovations.com\", \"lastName\": \"Smith\", \"firstName\": \"Michael\", \"profilePic\": \"uploads/profilePics/1708430659silver-letters-glass-building-facade_145275-162.jpg\", \"companyName\": \"BetaSoft Innovations Inc.\", \"description\": \"BetaTronics Innovations Inc. is at the forefront of electronics manufacturing, producing state-of-the-art components and devices for a variety of industries. Their commitment to quality and innovation has earned them a reputation as a trusted partner for companies seeking high-performance electronic solutions. From prototype development to full-scale production, BetaTronics Innovations delivers excellence in every aspect of their business.\"}','{\"brn\": \"0987654321\", \"status\": \"verification pending\", \"userID\": 39, \"address\": \"56 Oak Avenue, Oracle Lane, Colombo.\", \"website\": \"https://www.betasoftinnovations.com\", \"lastName\": \"Smith\", \"firstName\": \"Michael\", \"profilePic\": \"uploads/profilePics/1708430659silver-letters-glass-building-facade_145275-162.jpg\", \"companyName\": \"BetaSoft Innovations Inc.\", \"description\": \"BetaTronics Innovations Inc. is at the forefront of electronics manufacturing, producing state-of-the-art components and devices for a variety of industries. Their commitment to quality and innovation has earned them a reputation as a trusted partner for companies seeking high-performance electronic solutions. From prototype development to full-scale production, BetaTronics Innovations delivers excellence in every aspect of their business.\"}',39),(10,'UPDATE','2024-02-20 12:50:51','{\"brn\": \"0987654321\", \"status\": \"verification pending\", \"userID\": 39, \"address\": \"56 Oak Avenue, Oracle Lane, Colombo.\", \"website\": \"https://www.betasoftinnovations.com\", \"lastName\": \"Smith\", \"firstName\": \"Michael\", \"profilePic\": \"uploads/profilePics/1708430659silver-letters-glass-building-facade_145275-162.jpg\", \"companyName\": \"BetaSoft Innovations Inc.\", \"description\": \"BetaTronics Innovations Inc. is at the forefront of electronics manufacturing, producing state-of-the-art components and devices for a variety of industries. Their commitment to quality and innovation has earned them a reputation as a trusted partner for companies seeking high-performance electronic solutions. From prototype development to full-scale production, BetaTronics Innovations delivers excellence in every aspect of their business.\"}','{\"brn\": \"0987654321\", \"status\": \"verification pending\", \"userID\": 39, \"address\": \"56 Oak Avenue, Oracle Lane, Colombo.\", \"website\": \"https://www.betasoftinnovations.com\", \"lastName\": \"Smith\", \"firstName\": \"Michael\", \"profilePic\": \"uploads/profilePics/1708430659silver-letters-glass-building-facade_145275-162.jpg\", \"companyName\": \"BetaSoft Innovations Inc.\", \"description\": \"BetaTronics Innovations Inc. is at the forefront of electronics manufacturing, producing state-of-the-art components and devices for a variety of industries. Their commitment to quality and innovation has earned them a reputation as a trusted partner for companies seeking high-performance electronic solutions. From prototype development to full-scale production, BetaTronics Innovations delivers excellence in every aspect of their business.\"}',39),(11,'INSERT','2024-02-20 12:07:39',NULL,'{\"brn\": \"5432109876\", \"status\": \"verification pending\", \"userID\": 40, \"address\": \" 789 Pine Street, Metroville, NY, USA\", \"website\": \"https://www.technexsolutions.net\", \"lastName\": \"Lee\", \"firstName\": \"Sarah\", \"profilePic\": null, \"companyName\": \"TechNex Solutions LLC\", \"description\": null}',NULL),(11,'UPDATE','2024-02-20 12:14:51','{\"brn\": \"5432109876\", \"status\": \"verification pending\", \"userID\": 40, \"address\": \" 789 Pine Street, Metroville, NY, USA\", \"website\": \"https://www.technexsolutions.net\", \"lastName\": \"Lee\", \"firstName\": \"Sarah\", \"profilePic\": null, \"companyName\": \"TechNex Solutions LLC\", \"description\": null}','{\"brn\": \"5432109876\", \"status\": \"verification pending\", \"userID\": 40, \"address\": \" 789 Pine Street, Metroville, NY, USA\", \"website\": \"https://www.technexsolutions.net\", \"lastName\": \"Lee\", \"firstName\": \"Sarah\", \"profilePic\": \"uploads/profilePics/1708431291what-is-a-company.jpg\", \"companyName\": \"TechNex Solutions LLC\", \"description\": \"\\r\\nTechNex Solutions LLC is a dynamic and innovative technology company dedicated to providing cutting-edge solutions to businesses worldwide. Specializing in software development, IT consulting, and digital transformation services, TechNex Solutions helps organizations leverage technology to drive growth, improve efficiency, and stay ahead of the competition.\"}',40),(11,'UPDATE','2024-02-20 12:48:47','{\"brn\": \"5432109876\", \"status\": \"verification pending\", \"userID\": 40, \"address\": \" 789 Pine Street, Metroville, NY, USA\", \"website\": \"https://www.technexsolutions.net\", \"lastName\": \"Lee\", \"firstName\": \"Sarah\", \"profilePic\": \"uploads/profilePics/1708431291what-is-a-company.jpg\", \"companyName\": \"TechNex Solutions LLC\", \"description\": \"\\r\\nTechNex Solutions LLC is a dynamic and innovative technology company dedicated to providing cutting-edge solutions to businesses worldwide. Specializing in software development, IT consulting, and digital transformation services, TechNex Solutions helps organizations leverage technology to drive growth, improve efficiency, and stay ahead of the competition.\"}','{\"brn\": \"5432109876\", \"status\": \"verification pending\", \"userID\": 40, \"address\": \" 789 Pine Street, Metroville, NY, USA\", \"website\": \"https://www.technexsolutions.net\", \"lastName\": \"Lee\", \"firstName\": \"Sarah\", \"profilePic\": \"uploads/profilePics/1708431291what-is-a-company.jpg\", \"companyName\": \"TechNex Solutions LLC\", \"description\": \"\\r\\nTechNex Solutions LLC is a dynamic and innovative technology company dedicated to providing cutting-edge solutions to businesses worldwide. Specializing in software development, IT consulting, and digital transformation services, TechNex Solutions helps organizations leverage technology to drive growth, improve efficiency, and stay ahead of the competition.\"}',40),(11,'UPDATE','2024-02-20 12:52:20','{\"brn\": \"5432109876\", \"status\": \"verification pending\", \"userID\": 40, \"address\": \" 789 Pine Street, Metroville, NY, USA\", \"website\": \"https://www.technexsolutions.net\", \"lastName\": \"Lee\", \"firstName\": \"Sarah\", \"profilePic\": \"uploads/profilePics/1708431291what-is-a-company.jpg\", \"companyName\": \"TechNex Solutions LLC\", \"description\": \"\\r\\nTechNex Solutions LLC is a dynamic and innovative technology company dedicated to providing cutting-edge solutions to businesses worldwide. Specializing in software development, IT consulting, and digital transformation services, TechNex Solutions helps organizations leverage technology to drive growth, improve efficiency, and stay ahead of the competition.\"}','{\"brn\": \"5432109876\", \"status\": \"verification pending\", \"userID\": 40, \"address\": \" 789 Pine Street, Metroville, NY, USA\", \"website\": \"https://www.technexsolutions.net\", \"lastName\": \"Lee\", \"firstName\": \"Sarah\", \"profilePic\": \"uploads/profilePics/1708431291what-is-a-company.jpg\", \"companyName\": \"TechNex Solutions LLC\", \"description\": \"\\r\\nTechNex Solutions LLC is a dynamic and innovative technology company dedicated to providing cutting-edge solutions to businesses worldwide. Specializing in software development, IT consulting, and digital transformation services, TechNex Solutions helps organizations leverage technology to drive growth, improve efficiency, and stay ahead of the competition.\"}',40),(12,'INSERT','2024-02-20 12:16:26',NULL,'{\"brn\": \"1357902468\", \"status\": \"verification pending\", \"userID\": 41, \"address\": \" 101 Quantum Street, Innovatown, Nuwara Eliya\", \"website\": \"\", \"lastName\": \"Chang\", \"firstName\": \"David\", \"profilePic\": null, \"companyName\": \"Quantum Dynamics Corp\", \"description\": null}',NULL),(12,'UPDATE','2024-02-20 12:21:01','{\"brn\": \"1357902468\", \"status\": \"verification pending\", \"userID\": 41, \"address\": \" 101 Quantum Street, Innovatown, Nuwara Eliya\", \"website\": \"\", \"lastName\": \"Chang\", \"firstName\": \"David\", \"profilePic\": null, \"companyName\": \"Quantum Dynamics Corp\", \"description\": null}','{\"brn\": \"1357902468\", \"status\": \"verification pending\", \"userID\": 41, \"address\": \" 101 Quantum Street, Innovatown, Nuwara Eliya\", \"website\": \"\", \"lastName\": \"Chang\", \"firstName\": \"David\", \"profilePic\": \"uploads/profilePics/1708431661group-three-modern-architects_23-2147702101.jpg\", \"companyName\": \"Quantum Dynamics Corp\", \"description\": \"Quantum Dynamics Corp is a pioneering force in the field of quantum computing and advanced technology solutions. With a relentless pursuit of innovation and a team of world-class researchers and engineers, Quantum Dynamics Corp is at the forefront of revolutionizing computation and data processing.\"}',41),(12,'UPDATE','2024-02-20 12:41:04','{\"brn\": \"1357902468\", \"status\": \"verification pending\", \"userID\": 41, \"address\": \" 101 Quantum Street, Innovatown, Nuwara Eliya\", \"website\": \"\", \"lastName\": \"Chang\", \"firstName\": \"David\", \"profilePic\": \"uploads/profilePics/1708431661group-three-modern-architects_23-2147702101.jpg\", \"companyName\": \"Quantum Dynamics Corp\", \"description\": \"Quantum Dynamics Corp is a pioneering force in the field of quantum computing and advanced technology solutions. With a relentless pursuit of innovation and a team of world-class researchers and engineers, Quantum Dynamics Corp is at the forefront of revolutionizing computation and data processing.\"}','{\"brn\": \"1357902468\", \"status\": \"verification pending\", \"userID\": 41, \"address\": \" 101 Quantum Street, Innovatown, Nuwara Eliya\", \"website\": \"\", \"lastName\": \"Chang\", \"firstName\": \"David\", \"profilePic\": \"uploads/profilePics/1708431661group-three-modern-architects_23-2147702101.jpg\", \"companyName\": \"Quantum Dynamics Corp\", \"description\": \"Quantum Dynamics Corp is a pioneering force in the field of quantum computing and advanced technology solutions. With a relentless pursuit of innovation and a team of world-class researchers and engineers, Quantum Dynamics Corp is at the forefront of revolutionizing computation and data processing.\"}',41),(12,'UPDATE','2024-02-20 12:44:50','{\"brn\": \"1357902468\", \"status\": \"verification pending\", \"userID\": 41, \"address\": \" 101 Quantum Street, Innovatown, Nuwara Eliya\", \"website\": \"\", \"lastName\": \"Chang\", \"firstName\": \"David\", \"profilePic\": \"uploads/profilePics/1708431661group-three-modern-architects_23-2147702101.jpg\", \"companyName\": \"Quantum Dynamics Corp\", \"description\": \"Quantum Dynamics Corp is a pioneering force in the field of quantum computing and advanced technology solutions. With a relentless pursuit of innovation and a team of world-class researchers and engineers, Quantum Dynamics Corp is at the forefront of revolutionizing computation and data processing.\"}','{\"brn\": \"1357902468\", \"status\": \"verification pending\", \"userID\": 41, \"address\": \" 101 Quantum Street, Innovatown, Nuwara Eliya\", \"website\": \"\", \"lastName\": \"Chang\", \"firstName\": \"David\", \"profilePic\": \"uploads/profilePics/1708431661group-three-modern-architects_23-2147702101.jpg\", \"companyName\": \"Quantum Dynamics Corp\", \"description\": \"Quantum Dynamics Corp is a pioneering force in the field of quantum computing and advanced technology solutions. With a relentless pursuit of innovation and a team of world-class researchers and engineers, Quantum Dynamics Corp is at the forefront of revolutionizing computation and data processing.\"}',41),(12,'UPDATE','2024-02-20 23:06:35','{\"brn\": \"1357902468\", \"status\": \"verification pending\", \"userID\": 41, \"address\": \" 101 Quantum Street, Innovatown, Nuwara Eliya\", \"website\": \"\", \"lastName\": \"Chang\", \"firstName\": \"David\", \"profilePic\": \"uploads/profilePics/1708431661group-three-modern-architects_23-2147702101.jpg\", \"companyName\": \"Quantum Dynamics Corp\", \"description\": \"Quantum Dynamics Corp is a pioneering force in the field of quantum computing and advanced technology solutions. With a relentless pursuit of innovation and a team of world-class researchers and engineers, Quantum Dynamics Corp is at the forefront of revolutionizing computation and data processing.\"}','{\"brn\": \"1357902468\", \"status\": \"verification pending\", \"userID\": 41, \"address\": \" 101 Quantum Street, Innovatown, Nuwara Eliya\", \"website\": \"\", \"lastName\": \"Chang\", \"firstName\": \"David\", \"profilePic\": \"uploads/profilePics/1708431661group-three-modern-architects_23-2147702101.jpg\", \"companyName\": \"Quantum Dynamics Corp\", \"description\": \"Quantum Dynamics Corp is a pioneering force in the field of quantum computing and advanced technology solutions. With a relentless pursuit of innovation and a team of world-class researchers and engineers, Quantum Dynamics Corp is at the forefront of revolutionizing computation and data processing.\"}',44),(13,'INSERT','2024-02-20 12:22:23',NULL,'{\"brn\": \"9876543210\", \"status\": \"verification pending\", \"userID\": 42, \"address\": \"246 Elm Road, Techville, Badulla\", \"website\": \"https://www.infinititechsolutions.com\", \"lastName\": \"Williams\", \"firstName\": \"Jennifer\", \"profilePic\": null, \"companyName\": \"InfinitiTech Solutions Ltd.\", \"description\": null}',NULL),(13,'UPDATE','2024-02-20 12:25:51','{\"brn\": \"9876543210\", \"status\": \"verification pending\", \"userID\": 42, \"address\": \"246 Elm Road, Techville, Badulla\", \"website\": \"https://www.infinititechsolutions.com\", \"lastName\": \"Williams\", \"firstName\": \"Jennifer\", \"profilePic\": null, \"companyName\": \"InfinitiTech Solutions Ltd.\", \"description\": null}','{\"brn\": \"9876543210\", \"status\": \"verification pending\", \"userID\": 42, \"address\": \"246 Elm Road, Techville, Badulla\", \"website\": \"https://www.infinititechsolutions.com\", \"lastName\": \"Williams\", \"firstName\": \"Jennifer\", \"profilePic\": \"uploads/profilePics/1708431951hands-holding-puzzle-business-problem-solving-concept_53876-143285.jpg\", \"companyName\": \"InfinitiTech Solutions Ltd.\", \"description\": \"\\r\\nInfinitiTech Solutions Ltd. is a leading provider of comprehensive IT solutions and services tailored to meet the evolving needs of businesses worldwide. With a focus on innovation, reliability, and customer satisfaction, InfinitiTech Solutions delivers cutting-edge technology solutions that drive growth and efficiency.\"}',42),(13,'UPDATE','2024-02-20 12:38:22','{\"brn\": \"9876543210\", \"status\": \"verification pending\", \"userID\": 42, \"address\": \"246 Elm Road, Techville, Badulla\", \"website\": \"https://www.infinititechsolutions.com\", \"lastName\": \"Williams\", \"firstName\": \"Jennifer\", \"profilePic\": \"uploads/profilePics/1708431951hands-holding-puzzle-business-problem-solving-concept_53876-143285.jpg\", \"companyName\": \"InfinitiTech Solutions Ltd.\", \"description\": \"\\r\\nInfinitiTech Solutions Ltd. is a leading provider of comprehensive IT solutions and services tailored to meet the evolving needs of businesses worldwide. With a focus on innovation, reliability, and customer satisfaction, InfinitiTech Solutions delivers cutting-edge technology solutions that drive growth and efficiency.\"}','{\"brn\": \"9876543210\", \"status\": \"verification pending\", \"userID\": 42, \"address\": \"246 Elm Road, Techville, Badulla\", \"website\": \"https://www.infinititechsolutions.com\", \"lastName\": \"Williams\", \"firstName\": \"Jennifer\", \"profilePic\": \"uploads/profilePics/1708431951hands-holding-puzzle-business-problem-solving-concept_53876-143285.jpg\", \"companyName\": \"InfinitiTech Solutions Ltd.\", \"description\": \"\\r\\nInfinitiTech Solutions Ltd. is a leading provider of comprehensive IT solutions and services tailored to meet the evolving needs of businesses worldwide. With a focus on innovation, reliability, and customer satisfaction, InfinitiTech Solutions delivers cutting-edge technology solutions that drive growth and efficiency.\"}',42),(13,'UPDATE','2024-02-20 12:43:15','{\"brn\": \"9876543210\", \"status\": \"verification pending\", \"userID\": 42, \"address\": \"246 Elm Road, Techville, Badulla\", \"website\": \"https://www.infinititechsolutions.com\", \"lastName\": \"Williams\", \"firstName\": \"Jennifer\", \"profilePic\": \"uploads/profilePics/1708431951hands-holding-puzzle-business-problem-solving-concept_53876-143285.jpg\", \"companyName\": \"InfinitiTech Solutions Ltd.\", \"description\": \"\\r\\nInfinitiTech Solutions Ltd. is a leading provider of comprehensive IT solutions and services tailored to meet the evolving needs of businesses worldwide. With a focus on innovation, reliability, and customer satisfaction, InfinitiTech Solutions delivers cutting-edge technology solutions that drive growth and efficiency.\"}','{\"brn\": \"9876543210\", \"status\": \"verification pending\", \"userID\": 42, \"address\": \"246 Elm Road, Techville, Badulla\", \"website\": \"https://www.infinititechsolutions.com\", \"lastName\": \"Williams\", \"firstName\": \"Jennifer\", \"profilePic\": \"uploads/profilePics/1708431951hands-holding-puzzle-business-problem-solving-concept_53876-143285.jpg\", \"companyName\": \"InfinitiTech Solutions Ltd.\", \"description\": \"\\r\\nInfinitiTech Solutions Ltd. is a leading provider of comprehensive IT solutions and services tailored to meet the evolving needs of businesses worldwide. With a focus on innovation, reliability, and customer satisfaction, InfinitiTech Solutions delivers cutting-edge technology solutions that drive growth and efficiency.\"}',42),(13,'UPDATE','2024-02-20 22:55:51','{\"brn\": \"9876543210\", \"status\": \"verification pending\", \"userID\": 42, \"address\": \"246 Elm Road, Techville, Badulla\", \"website\": \"https://www.infinititechsolutions.com\", \"lastName\": \"Williams\", \"firstName\": \"Jennifer\", \"profilePic\": \"uploads/profilePics/1708431951hands-holding-puzzle-business-problem-solving-concept_53876-143285.jpg\", \"companyName\": \"InfinitiTech Solutions Ltd.\", \"description\": \"\\r\\nInfinitiTech Solutions Ltd. is a leading provider of comprehensive IT solutions and services tailored to meet the evolving needs of businesses worldwide. With a focus on innovation, reliability, and customer satisfaction, InfinitiTech Solutions delivers cutting-edge technology solutions that drive growth and efficiency.\"}','{\"brn\": \"9876543210\", \"status\": \"verification pending\", \"userID\": 42, \"address\": \"246 Elm Road, Techville, Badulla\", \"website\": \"https://www.infinititechsolutions.com\", \"lastName\": \"Williams\", \"firstName\": \"Jennifer\", \"profilePic\": \"uploads/profilePics/1708431951hands-holding-puzzle-business-problem-solving-concept_53876-143285.jpg\", \"companyName\": \"InfinitiTech Solutions Ltd.\", \"description\": \"\\r\\nInfinitiTech Solutions Ltd. is a leading provider of comprehensive IT solutions and services tailored to meet the evolving needs of businesses worldwide. With a focus on innovation, reliability, and customer satisfaction, InfinitiTech Solutions delivers cutting-edge technology solutions that drive growth and efficiency.\"}',44),(13,'UPDATE','2024-02-20 23:06:43','{\"brn\": \"9876543210\", \"status\": \"verification pending\", \"userID\": 42, \"address\": \"246 Elm Road, Techville, Badulla\", \"website\": \"https://www.infinititechsolutions.com\", \"lastName\": \"Williams\", \"firstName\": \"Jennifer\", \"profilePic\": \"uploads/profilePics/1708431951hands-holding-puzzle-business-problem-solving-concept_53876-143285.jpg\", \"companyName\": \"InfinitiTech Solutions Ltd.\", \"description\": \"\\r\\nInfinitiTech Solutions Ltd. is a leading provider of comprehensive IT solutions and services tailored to meet the evolving needs of businesses worldwide. With a focus on innovation, reliability, and customer satisfaction, InfinitiTech Solutions delivers cutting-edge technology solutions that drive growth and efficiency.\"}','{\"brn\": \"9876543210\", \"status\": \"verification pending\", \"userID\": 42, \"address\": \"246 Elm Road, Techville, Badulla\", \"website\": \"https://www.infinititechsolutions.com\", \"lastName\": \"Williams\", \"firstName\": \"Jennifer\", \"profilePic\": \"uploads/profilePics/1708431951hands-holding-puzzle-business-problem-solving-concept_53876-143285.jpg\", \"companyName\": \"InfinitiTech Solutions Ltd.\", \"description\": \"\\r\\nInfinitiTech Solutions Ltd. is a leading provider of comprehensive IT solutions and services tailored to meet the evolving needs of businesses worldwide. With a focus on innovation, reliability, and customer satisfaction, InfinitiTech Solutions delivers cutting-edge technology solutions that drive growth and efficiency.\"}',44),(13,'UPDATE','2024-02-20 23:06:49','{\"brn\": \"9876543210\", \"status\": \"verification pending\", \"userID\": 42, \"address\": \"246 Elm Road, Techville, Badulla\", \"website\": \"https://www.infinititechsolutions.com\", \"lastName\": \"Williams\", \"firstName\": \"Jennifer\", \"profilePic\": \"uploads/profilePics/1708431951hands-holding-puzzle-business-problem-solving-concept_53876-143285.jpg\", \"companyName\": \"InfinitiTech Solutions Ltd.\", \"description\": \"\\r\\nInfinitiTech Solutions Ltd. is a leading provider of comprehensive IT solutions and services tailored to meet the evolving needs of businesses worldwide. With a focus on innovation, reliability, and customer satisfaction, InfinitiTech Solutions delivers cutting-edge technology solutions that drive growth and efficiency.\"}','{\"brn\": \"9876543210\", \"status\": \"verification pending\", \"userID\": 42, \"address\": \"246 Elm Road, Techville, Badulla\", \"website\": \"https://www.infinititechsolutions.com\", \"lastName\": \"Williams\", \"firstName\": \"Jennifer\", \"profilePic\": \"uploads/profilePics/1708431951hands-holding-puzzle-business-problem-solving-concept_53876-143285.jpg\", \"companyName\": \"InfinitiTech Solutions Ltd.\", \"description\": \"\\r\\nInfinitiTech Solutions Ltd. is a leading provider of comprehensive IT solutions and services tailored to meet the evolving needs of businesses worldwide. With a focus on innovation, reliability, and customer satisfaction, InfinitiTech Solutions delivers cutting-edge technology solutions that drive growth and efficiency.\"}',44),(13,'UPDATE','2024-02-20 23:07:01','{\"brn\": \"9876543210\", \"status\": \"verification pending\", \"userID\": 42, \"address\": \"246 Elm Road, Techville, Badulla\", \"website\": \"https://www.infinititechsolutions.com\", \"lastName\": \"Williams\", \"firstName\": \"Jennifer\", \"profilePic\": \"uploads/profilePics/1708431951hands-holding-puzzle-business-problem-solving-concept_53876-143285.jpg\", \"companyName\": \"InfinitiTech Solutions Ltd.\", \"description\": \"\\r\\nInfinitiTech Solutions Ltd. is a leading provider of comprehensive IT solutions and services tailored to meet the evolving needs of businesses worldwide. With a focus on innovation, reliability, and customer satisfaction, InfinitiTech Solutions delivers cutting-edge technology solutions that drive growth and efficiency.\"}','{\"brn\": \"9876543210\", \"status\": \"verification pending\", \"userID\": 42, \"address\": \"246 Elm Road, Techville, Badulla\", \"website\": \"https://www.infinititechsolutions.com\", \"lastName\": \"Williams\", \"firstName\": \"Jennifer\", \"profilePic\": \"uploads/profilePics/1708431951hands-holding-puzzle-business-problem-solving-concept_53876-143285.jpg\", \"companyName\": \"InfinitiTech Solutions Ltd.\", \"description\": \"\\r\\nInfinitiTech Solutions Ltd. is a leading provider of comprehensive IT solutions and services tailored to meet the evolving needs of businesses worldwide. With a focus on innovation, reliability, and customer satisfaction, InfinitiTech Solutions delivers cutting-edge technology solutions that drive growth and efficiency.\"}',44),(13,'UPDATE','2024-02-20 23:20:49','{\"brn\": \"9876543210\", \"status\": \"verification pending\", \"userID\": 42, \"address\": \"246 Elm Road, Techville, Badulla\", \"website\": \"https://www.infinititechsolutions.com\", \"lastName\": \"Williams\", \"firstName\": \"Jennifer\", \"profilePic\": \"uploads/profilePics/1708431951hands-holding-puzzle-business-problem-solving-concept_53876-143285.jpg\", \"companyName\": \"InfinitiTech Solutions Ltd.\", \"description\": \"\\r\\nInfinitiTech Solutions Ltd. is a leading provider of comprehensive IT solutions and services tailored to meet the evolving needs of businesses worldwide. With a focus on innovation, reliability, and customer satisfaction, InfinitiTech Solutions delivers cutting-edge technology solutions that drive growth and efficiency.\"}','{\"brn\": \"9876543210\", \"status\": \"verification pending\", \"userID\": 42, \"address\": \"246 Elm Road, Techville, Badulla\", \"website\": \"https://www.infinititechsolutions.com\", \"lastName\": \"Williams\", \"firstName\": \"Jennifer\", \"profilePic\": \"uploads/profilePics/1708431951hands-holding-puzzle-business-problem-solving-concept_53876-143285.jpg\", \"companyName\": \"InfinitiTech Solutions Ltd.\", \"description\": \"\\r\\nInfinitiTech Solutions Ltd. is a leading provider of comprehensive IT solutions and services tailored to meet the evolving needs of businesses worldwide. With a focus on innovation, reliability, and customer satisfaction, InfinitiTech Solutions delivers cutting-edge technology solutions that drive growth and efficiency.\"}',44),(14,'INSERT','2024-02-20 12:27:19',NULL,'{\"brn\": \"2468013579\", \"status\": \"verification pending\", \"userID\": 43, \"address\": \"369 Maple Avenue, Innovia, Dambulla\", \"website\": \"https://www.phoenixinnovationsgroup.net\", \"lastName\": \"Rodriguez\", \"firstName\": \"Daniel\", \"profilePic\": null, \"companyName\": \"Phoenix Innovations Group\", \"description\": null}',NULL),(14,'UPDATE','2024-02-20 12:28:50','{\"brn\": \"2468013579\", \"status\": \"verification pending\", \"userID\": 43, \"address\": \"369 Maple Avenue, Innovia, Dambulla\", \"website\": \"https://www.phoenixinnovationsgroup.net\", \"lastName\": \"Rodriguez\", \"firstName\": \"Daniel\", \"profilePic\": null, \"companyName\": \"Phoenix Innovations Group\", \"description\": null}','{\"brn\": \"2468013579\", \"status\": \"verification pending\", \"userID\": 43, \"address\": \"369 Maple Avenue, Innovia, Dambulla\", \"website\": \"https://www.phoenixinnovationsgroup.net\", \"lastName\": \"Rodriguez\", \"firstName\": \"Daniel\", \"profilePic\": \"uploads/profilePics/1708432130modern-office-building-features-luxury-skyline-view-generated-by-ai_188544-26677.jpg\", \"companyName\": \"Phoenix Innovations Group\", \"description\": \"Phoenix Innovations Group is a dynamic and forward-thinking technology company dedicated to driving innovation and transformation across industries. With a focus on creativity, agility, and excellence, Phoenix Innovations Group offers a diverse range of solutions designed to meet the evolving needs of businesses in the digital age.\\r\\n\\r\\n\"}',43),(14,'UPDATE','2024-02-20 12:34:34','{\"brn\": \"2468013579\", \"status\": \"verification pending\", \"userID\": 43, \"address\": \"369 Maple Avenue, Innovia, Dambulla\", \"website\": \"https://www.phoenixinnovationsgroup.net\", \"lastName\": \"Rodriguez\", \"firstName\": \"Daniel\", \"profilePic\": \"uploads/profilePics/1708432130modern-office-building-features-luxury-skyline-view-generated-by-ai_188544-26677.jpg\", \"companyName\": \"Phoenix Innovations Group\", \"description\": \"Phoenix Innovations Group is a dynamic and forward-thinking technology company dedicated to driving innovation and transformation across industries. With a focus on creativity, agility, and excellence, Phoenix Innovations Group offers a diverse range of solutions designed to meet the evolving needs of businesses in the digital age.\\r\\n\\r\\n\"}','{\"brn\": \"2468013579\", \"status\": \"verification pending\", \"userID\": 43, \"address\": \"369 Maple Avenue, Innovia, Dambulla\", \"website\": \"https://www.phoenixinnovationsgroup.net\", \"lastName\": \"Rodriguez\", \"firstName\": \"Daniel\", \"profilePic\": \"uploads/profilePics/1708432130modern-office-building-features-luxury-skyline-view-generated-by-ai_188544-26677.jpg\", \"companyName\": \"Phoenix Innovations Group\", \"description\": \"Phoenix Innovations Group is a dynamic and forward-thinking technology company dedicated to driving innovation and transformation across industries. With a focus on creativity, agility, and excellence, Phoenix Innovations Group offers a diverse range of solutions designed to meet the evolving needs of businesses in the digital age.\\r\\n\\r\\n\"}',43),(14,'UPDATE','2024-02-20 12:35:56','{\"brn\": \"2468013579\", \"status\": \"verification pending\", \"userID\": 43, \"address\": \"369 Maple Avenue, Innovia, Dambulla\", \"website\": \"https://www.phoenixinnovationsgroup.net\", \"lastName\": \"Rodriguez\", \"firstName\": \"Daniel\", \"profilePic\": \"uploads/profilePics/1708432130modern-office-building-features-luxury-skyline-view-generated-by-ai_188544-26677.jpg\", \"companyName\": \"Phoenix Innovations Group\", \"description\": \"Phoenix Innovations Group is a dynamic and forward-thinking technology company dedicated to driving innovation and transformation across industries. With a focus on creativity, agility, and excellence, Phoenix Innovations Group offers a diverse range of solutions designed to meet the evolving needs of businesses in the digital age.\\r\\n\\r\\n\"}','{\"brn\": \"2468013579\", \"status\": \"verification pending\", \"userID\": 43, \"address\": \"369 Maple Avenue, Innovia, Dambulla\", \"website\": \"https://www.phoenixinnovationsgroup.net\", \"lastName\": \"Rodriguez\", \"firstName\": \"Daniel\", \"profilePic\": \"uploads/profilePics/1708432130modern-office-building-features-luxury-skyline-view-generated-by-ai_188544-26677.jpg\", \"companyName\": \"Phoenix Innovations Group\", \"description\": \"Phoenix Innovations Group is a dynamic and forward-thinking technology company dedicated to driving innovation and transformation across industries. With a focus on creativity, agility, and excellence, Phoenix Innovations Group offers a diverse range of solutions designed to meet the evolving needs of businesses in the digital age.\\r\\n\\r\\n\"}',43);
/*!40000 ALTER TABLE `company_audit_log` ENABLE KEYS */;
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
  `resolvedDate` datetime DEFAULT NULL,
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
INSERT INTO `dispute` VALUES (1,'first dispute','dejdedmedmed enjed','2023-10-24 23:34:57','2024-02-06 09:05:07','resolved','payment','company',10,NULL,'cs'),(4,'Regarding payment on nov 1st','Haven\'t got my milestone payment','2023-10-30 23:38:14',NULL,'pending','payment','student',10,NULL,NULL),(7,'dede','eddeed','2023-10-31 00:21:00',NULL,'pending','payment','student',9,NULL,NULL),(8,'dede','eddeed','2023-10-31 00:21:23',NULL,'resolved','payment','student',9,NULL,NULL),(10,'fcr','refe','2023-10-31 06:37:47',NULL,'pending','other','company',9,NULL,NULL);
/*!40000 ALTER TABLE `dispute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `earning_goal`
--

DROP TABLE IF EXISTS `earning_goal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `earning_goal` (
  `goal` double NOT NULL,
  `studentID` int NOT NULL,
  PRIMARY KEY (`studentID`),
  KEY `fk_goal_student` (`studentID`),
  CONSTRAINT `fk_goal_student` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `earning_goal`
--

LOCK TABLES `earning_goal` WRITE;
/*!40000 ALTER TABLE `earning_goal` DISABLE KEYS */;
INSERT INTO `earning_goal` VALUES (6000,14),(11000,22);
/*!40000 ALTER TABLE `earning_goal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `earnings`
--

DROP TABLE IF EXISTS `earnings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `earnings` (
  `transactionID` varchar(32) NOT NULL,
  `earningDescription` text NOT NULL,
  `earningStatus` enum('available','withdrawn','requested') NOT NULL DEFAULT 'available',
  `transactionDate` datetime DEFAULT NULL,
  `taskID` int NOT NULL,
  `amount` double NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bankName` text,
  `branch` text,
  `accNo` text,
  PRIMARY KEY (`transactionID`),
  KEY `earning-task` (`taskID`),
  CONSTRAINT `earning-task` FOREIGN KEY (`taskID`) REFERENCES `task` (`taskID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `earnings`
--

LOCK TABLES `earnings` WRITE;
/*!40000 ALTER TABLE `earnings` DISABLE KEYS */;
INSERT INTO `earnings` VALUES ('65d4cce236ad5','Earning by the Task - Writing','available',NULL,14,6000,'2024-02-20 16:01:38',NULL,NULL,NULL),('65d52fedbf248','Earning by the Task - Design','available',NULL,15,31000,'2024-02-20 23:04:13',NULL,NULL,NULL),('ecwd','xss','requested','2024-02-21 09:09:14',3,100000,'2023-12-04 15:22:02','Peoples','kiribathgoda','1234567890'),('mdcwdw','ws`','withdrawn','2024-02-21 09:08:23',6,2222,'2024-01-17 15:26:04','BOC','Wattala','123456789');
/*!40000 ALTER TABLE `earnings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `sender` int NOT NULL,
  `receiver` int NOT NULL,
  `message` text NOT NULL,
  `files` text,
  `msgID` varchar(60) NOT NULL,
  `date` datetime NOT NULL,
  `seen` datetime DEFAULT NULL,
  `received` datetime DEFAULT NULL,
  `deleted_sender` tinyint NOT NULL DEFAULT '0',
  `deleted_receiver` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sender` (`sender`,`receiver`,`date`,`seen`),
  KEY `receiver-user` (`receiver`),
  CONSTRAINT `receiver-user` FOREIGN KEY (`receiver`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sender-user` FOREIGN KEY (`sender`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,28,26,'sweew',NULL,'ee11122','2024-01-14 13:32:15',NULL,'2024-01-14 14:21:29',0,0),(2,26,28,'x,mxlkwmdxwl',NULL,'ee11122','2024-01-14 13:32:15',NULL,NULL,0,0),(3,26,27,'cwdw',NULL,'dwedw22','2024-01-14 13:33:12',NULL,NULL,0,0),(4,27,26,'cwdwedw',NULL,'dwedw22','2024-01-14 13:33:12',NULL,NULL,0,0),(5,42,44,'hello nimal',NULL,'jQTHFPg5qf5gEwpeHk31uoPd3ogCKidAgTU9ZibouadmPC63LJnreAAYzz','2024-02-20 15:49:11','2024-02-20 15:49:40','2024-02-20 15:49:31',0,0),(6,42,44,'can you tell me more abt the proposal',NULL,'jQTHFPg5qf5gEwpeHk31uoPd3ogCKidAgTU9ZibouadmPC63LJnreAAYzz','2024-02-20 15:49:23','2024-02-20 15:49:40','2024-02-20 15:49:31',0,0),(7,44,42,'yeah. sure',NULL,'jQTHFPg5qf5gEwpeHk31uoPd3ogCKidAgTU9ZibouadmPC63LJnreAAYzz','2024-02-20 15:49:40',NULL,'2024-02-20 15:49:44',0,0);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moderator`
--

LOCK TABLES `moderator` WRITE;
/*!40000 ALTER TABLE `moderator` DISABLE KEYS */;
INSERT INTO `moderator` VALUES (1,'Seekwork','Moderator','No.5 Seekwork rd.','uploads/profilePics/1699932647Screenshot from 2023-11-13 09-24-28.png',28),(2,'Pasindu','Ekanayake','colombo',NULL,31);
/*!40000 ALTER TABLE `moderator` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER `moderator_insert_audit_trigger` AFTER INSERT ON `moderator` FOR EACH ROW BEGIN
    INSERT INTO moderator_audit_log(
        moderatorID,
        actionType,
        actionTime,
        old_data,
        new_data,
        loggedUserID
    )
    VALUES(
        NEW.moderatorID,
        'INSERT',
        CURRENT_TIMESTAMP,
        NULL,
        JSON_OBJECT(
            "firstName", NEW.firstName,
            "lastName", NEW.lastName,
            "address", NEW.address,
            "profilePic", NEW.profilePic,
            "userID", NEW.userID
        ),
        @logged_user
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER `moderator_update_audit_trigger` AFTER UPDATE ON `moderator` FOR EACH ROW BEGIN
    INSERT INTO moderator_audit_log(
        moderatorID,
        actionType,
        actionTime,
        old_data,
        new_data,
        loggedUserID
    )
    VALUES(
        NEW.moderatorID,
        'UPDATE',
        CURRENT_TIMESTAMP,
        JSON_OBJECT(
            "firstName", OLD.firstName,
            "lastName", OLD.lastName,
            "address", OLD.address,
            "profilePic", OLD.profilePic,
            "userID", OLD.userID
        ),
        JSON_OBJECT(
            "firstName", NEW.firstName,
            "lastName", NEW.lastName,
            "address", NEW.address,
            "profilePic", NEW.profilePic,
            "userID", NEW.userID
        ),
        @logged_user
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER `moderator_delete_audit_trigger` AFTER DELETE ON `moderator` FOR EACH ROW BEGIN
    INSERT INTO moderator_audit_log(
        moderatorID,
        actionType,
        actionTime,
        old_data,
        new_data,
        loggedUserID
    )
    VALUES(
        OLD.moderatorID,
        'DELETE',
        CURRENT_TIMESTAMP,
        JSON_OBJECT(
            "firstName", OLD.firstName,
            "lastName", OLD.lastName,
            "address", OLD.address,
            "profilePic", OLD.profilePic,
            "userID", OLD.userID
        ),
        NULL,
        @logged_user
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `moderator_audit_log`
--

DROP TABLE IF EXISTS `moderator_audit_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `moderator_audit_log` (
  `moderatorID` int NOT NULL,
  `actionType` enum('INSERT','UPDATE','DELETE') NOT NULL,
  `actionTime` timestamp NOT NULL,
  `old_data` json DEFAULT NULL,
  `new_data` json DEFAULT NULL,
  `loggedUserID` int DEFAULT NULL,
  PRIMARY KEY (`moderatorID`,`actionType`,`actionTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moderator_audit_log`
--

LOCK TABLES `moderator_audit_log` WRITE;
/*!40000 ALTER TABLE `moderator_audit_log` DISABLE KEYS */;
INSERT INTO `moderator_audit_log` VALUES (3,'INSERT','2023-11-29 09:41:51',NULL,'{\"userID\": 29, \"address\": \"bj\", \"lastName\": \"j\", \"firstName\": \"jhb\", \"profilePic\": null}',NULL),(3,'UPDATE','2023-11-29 09:41:58','{\"userID\": 29, \"address\": \"bj\", \"lastName\": \"j\", \"firstName\": \"jhb\", \"profilePic\": null}','{\"userID\": 29, \"address\": \"bj\", \"lastName\": \"j\", \"firstName\": \"jhbdscdsdcs\", \"profilePic\": null}',NULL),(3,'DELETE','2023-11-29 09:42:01','{\"userID\": 29, \"address\": \"bj\", \"lastName\": \"j\", \"firstName\": \"jhbdscdsdcs\", \"profilePic\": null}',NULL,NULL);
/*!40000 ALTER TABLE `moderator_audit_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notification` (
  `notificationID` int NOT NULL AUTO_INCREMENT,
  `msg` varchar(255) NOT NULL,
  `url` varchar(1024) NOT NULL,
  `userID` int NOT NULL COMMENT 'receiving userID',
  `seen` tinyint NOT NULL,
  PRIMARY KEY (`notificationID`),
  KEY `user-notification` (`userID`),
  CONSTRAINT `user-notification` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (2,'You have a new task invitation!','student/pendinginvites/',26,1),(3,'Invitation for a task was accepted!','company/pendingassignments',27,0),(4,'You have a new task invitation!','student/pendinginvites/',44,1),(5,'Invitation for a task was accepted!','company/pendingassignments',42,1),(6,'New submission for a task!','company/tasks/14/submissions',42,0),(7,'New submission for a task!','company/tasks/14/submissions',42,0),(8,'You have a new task invitation!','student/pendinginvites/',44,1),(9,'Invitation for a task was accepted!','company/pendingassignments',41,0),(10,'New submission for a task!','company/tasks/15/submissions',41,0),(11,'New submission for a task!','company/tasks/15/submissions',41,0),(12,'New submission for a task!','company/tasks/15/submissions',41,0);
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `otp`
--

DROP TABLE IF EXISTS `otp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `otp` (
  `otpID` int NOT NULL AUTO_INCREMENT,
  `otpCode` varchar(10) NOT NULL,
  `userID` int NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL,
  `expireAt` timestamp NOT NULL,
  PRIMARY KEY (`otpID`),
  KEY `user-otp` (`userID`),
  CONSTRAINT `user-otp` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `otp`
--

LOCK TABLES `otp` WRITE;
/*!40000 ALTER TABLE `otp` DISABLE KEYS */;
INSERT INTO `otp` VALUES (23,'1439068283',25,'2023-11-18 02:43:16','2023-11-18 02:51:58','2023-11-18 03:01:58'),(24,'1066870928',34,'2023-11-26 10:24:52','2023-11-26 10:41:16','2023-11-26 10:51:16'),(25,'3103097936',35,'2023-11-26 10:29:49','2023-11-26 10:38:02','2023-11-26 10:48:02'),(26,'8312790036',27,'2023-11-27 03:26:07','2023-11-27 03:26:07','2023-11-27 03:36:07'),(27,'1323558934',28,'2023-11-27 03:39:31','2024-01-24 08:36:53','2024-01-24 08:46:53'),(29,'1220301601',26,'2023-12-05 07:43:33','2023-12-05 07:43:33','2023-12-05 07:53:33'),(30,'1295448922',39,'2024-02-20 12:02:10','2024-02-20 12:02:10','2024-02-20 12:12:10'),(31,'1431642652',40,'2024-02-20 12:07:53','2024-02-20 12:07:53','2024-02-20 12:17:53'),(32,'2531382536',41,'2024-02-20 12:16:41','2024-02-20 12:16:41','2024-02-20 12:26:41'),(33,'9647592366',42,'2024-02-20 12:22:36','2024-02-20 12:22:36','2024-02-20 12:32:36'),(34,'6824981516',43,'2024-02-20 12:27:30','2024-02-20 12:27:30','2024-02-20 12:37:30'),(35,'6318978486',44,'2024-02-20 13:09:48','2024-02-20 13:09:48','2024-02-20 13:19:48'),(36,'9998922526',45,'2024-02-20 13:13:25','2024-02-20 13:13:25','2024-02-20 13:23:25'),(37,'1219654138',46,'2024-02-20 13:16:08','2024-02-20 13:16:08','2024-02-20 13:26:08'),(38,'1258679684',47,'2024-02-20 13:18:35','2024-02-20 13:18:35','2024-02-20 13:28:35'),(39,'5553909166',48,'2024-02-20 13:21:03','2024-02-20 13:21:03','2024-02-20 13:31:03');
/*!40000 ALTER TABLE `otp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment` (
  `paymentID` varchar(32) NOT NULL,
  `paymentDescription` text,
  `paymentStatus` enum('outstanding','completed') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `taskID` int NOT NULL,
  `commission` double NOT NULL DEFAULT '0',
  `amount` double NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paidDate` datetime DEFAULT NULL,
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
INSERT INTO `payment` VALUES ('65a001972c3b3','Payment For Task - Task3','completed',6,22,244,'2024-01-11 14:56:23',NULL),('65d46f2786430','Payment for Task - taskk','outstanding',4,100,1100,'2024-02-20 09:21:43',NULL),('65d4ca4c37a7e','Payment for Task - Write SEO Optimized Blog Articles on Travel Destinations','completed',14,600,6600,'2024-02-20 15:50:36',NULL),('65d52f3d7f5db','Payment for Task - Create a Model of a Residential Building','completed',15,2480,33480,'2024-02-20 23:01:17',NULL),('frjncrejnce','rebe','completed',10,60,400,'2024-02-05 23:21:49',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proposal`
--

LOCK TABLES `proposal` WRITE;
/*!40000 ALTER TABLE `proposal` DISABLE KEYS */;
INSERT INTO `proposal` VALUES (2,'ffwewcdcdc',NULL,NULL,'2023-09-26 07:35:47',9,14),(3,'dede',NULL,2,'2023-09-26 07:44:40',9,14),(5,'proposla',NULL,NULL,'2023-10-31 12:56:37',3,14),(6,'proposal for task 10',NULL,9000,'2023-11-01 01:17:12',10,14),(7,'vrvr',NULL,45,'2024-01-11 14:55:34',6,14),(8,'fcerfe',NULL,NULL,'2024-02-06 10:48:34',4,14),(9,'my proposal . i am nimal',NULL,6000,'2024-02-20 15:47:57',14,22),(10,'I am writing to express my keen interest in the 3D Artist position to create a detailed 3D model of a residential building as advertised. As a student with a strong passion for 3D modeling and design, I am eager to contribute my skills and creativity to bring your vision to life.\r\n\r\nBackground:\r\nI am currently pursuing a Bachelor\'s degree in Computer Graphics and Animation with a focus on 3D modeling and rendering. Throughout my academic journey, I have gained hands-on experience with industry-standard software such as Autodesk Maya, Blender, and Substance Painter. My coursework has equipped me with a solid understanding of modeling techniques, texture mapping, lighting, and rendering.\r\n\r\nSkills and Qualifications:\r\n\r\nProficiency in Autodesk Maya, Blender, and Substance Painter.\r\nStrong understanding of modeling, texturing, lighting, and rendering techniques.\r\nAbility to interpret architectural plans and references to create accurate 3D models.\r\nAttention to detail and dedication to achieving realistic and high-quality renders.\r\nExcellent communication and teamwork skills, with a proactive approach to feedback and collaboration.',NULL,31000,'2024-02-20 23:00:11',15,22);
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
  `reviewTitle` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
INSERT INTO `review` VALUES (8,'Really good','companyTOstudent',22,13,14,4,'did very good work. Highly recommended','2024-02-20 16:03:20'),(9,'Very flexible','studentTOcompany',22,13,14,5,'Easy to work with ','2024-02-20 22:55:51'),(10,'Work was great, little ','companyTOstudent',22,12,15,3,'He did some great work but a little late on submission','2024-02-20 23:05:44'),(11,'Flexible company','studentTOcompany',22,12,15,4,'He was flexible although i was little late on submission','2024-02-20 23:06:35');
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER `update_student_or_company_on_review` AFTER INSERT ON `review` FOR EACH ROW BEGIN
	DECLARE total DOUBLE;
    DECLARE num INT;
    
    IF NEW.reviewType = 'companyTOstudent' THEN
    	SELECT AVG(nStars) FROM review WHERE studentID=NEW.studentID AND reviewType='companyTOstudent' INTO total;
        SELECT COUNT(*) FROM review WHERE studentID=NEW.studentID AND reviewType='companyTOstudent' INTO num;
        
       UPDATE student SET final_rating=total, nReviews=num WHERE studentID=NEW.studentID;
       ELSE 
           	SELECT AVG(nStars) FROM review WHERE companyID=NEW.companyID AND reviewType='studentTOcompany' INTO total;
        SELECT COUNT(*) FROM review WHERE companyID=NEW.companyID AND reviewType='studentTOcompany' INTO num;
        
       UPDATE company SET final_rating=total, nReviews=num WHERE companyID=NEW.companyID;
       END IF;
            	
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER `update_student_or_company_on_review_on_update` AFTER UPDATE ON `review` FOR EACH ROW BEGIN
	DECLARE total DOUBLE;
    DECLARE num INT;
    
    IF NEW.reviewType = 'companyTOstudent' THEN
    	SELECT AVG(nStars) FROM review WHERE studentID=NEW.studentID AND reviewType='companyTOstudent' INTO total;
        SELECT COUNT(*) FROM review WHERE studentID=NEW.studentID AND reviewType='companyTOstudent' INTO num;
        
       UPDATE student SET final_rating=total, nReviews=num WHERE studentID=NEW.studentID;
       ELSE 
           	SELECT AVG(nStars) FROM review WHERE companyID=NEW.companyID AND reviewType='studentTOcompany' INTO total;
        SELECT COUNT(*) FROM review WHERE companyID=NEW.companyID AND reviewType='studentTOcompany' INTO num;
        
       UPDATE company SET final_rating=total, nReviews=num WHERE companyID=NEW.companyID;
       END IF;
            	
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER `update_student_or_company_on_review_on_delete` AFTER DELETE ON `review` FOR EACH ROW BEGIN
	DECLARE total DOUBLE;
    DECLARE num INT;
    
    IF OLD.reviewType = 'companyTOstudent' THEN
    	SELECT AVG(nStars) FROM review WHERE studentID=OLD.studentID AND reviewType='companyTOstudent' INTO total;
        SELECT COUNT(*) FROM review WHERE studentID=OLD.studentID AND reviewType='companyTOstudent' INTO num;
        IF total IS NULL THEN
        	SET total=5;
            END IF;
       UPDATE student SET final_rating=total, nReviews=num WHERE studentID=OLD.studentID;
       ELSE 
           	SELECT AVG(nStars) FROM review WHERE companyID=OLD.companyID AND reviewType='studentTOcompany' INTO total;
        SELECT COUNT(*) FROM review WHERE companyID=OLD.companyID AND reviewType='studentTOcompany' INTO num;
                IF total IS NULL THEN
        	SET total=5;
            END IF;
       UPDATE company SET final_rating=total, nReviews=num WHERE companyID=OLD.companyID;
       END IF;
            	
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `skill`
--

DROP TABLE IF EXISTS `skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `skill` (
  `skillID` int NOT NULL AUTO_INCREMENT,
  `skill` varchar(100) NOT NULL,
  PRIMARY KEY (`skillID`),
  KEY `skillID` (`skillID`),
  KEY `skill` (`skill`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill`
--

LOCK TABLES `skill` WRITE;
/*!40000 ALTER TABLE `skill` DISABLE KEYS */;
INSERT INTO `skill` VALUES (12,'3D Modeling and Rendering'),(44,'Accounting'),(27,'Adobe Illustrator'),(28,'Adobe Photoshop'),(39,'Android'),(18,'Animation'),(41,'API'),(33,'Architecture'),(34,'Autodesk'),(3,'Content Writing'),(7,'Copywriting'),(30,'CSS'),(20,'Customer Service'),(10,'Data Entry'),(14,'Digital Marketing'),(16,'E-commerce Management'),(36,'Editing'),(37,'Educational'),(42,'Finance'),(2,'Graphic Design'),(29,'HTML'),(11,'Illustration'),(40,'iOS'),(31,'JavaScript'),(38,'Knowledge'),(43,'Legal'),(4,'Mobile App Development'),(35,'Proofreading'),(32,'Research'),(5,'SEO (Search Engine Optimization)'),(6,'Social Media Management'),(15,'Transcription'),(45,'Translation'),(9,'UI/UX Design'),(8,'Video Editing'),(47,'Video Editing'),(13,'Virtual Assistance'),(19,'Voiceover'),(1,'Web Development'),(17,'WordPress Development'),(46,'YouTube');
/*!40000 ALTER TABLE `skill` ENABLE KEYS */;
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
  `final_rating` double NOT NULL DEFAULT '5',
  `nReviews` int NOT NULL DEFAULT '0',
  `nTasks` int NOT NULL DEFAULT '0' COMMENT 'no of tasks',
  PRIMARY KEY (`studentID`),
  UNIQUE KEY `nic` (`NIC`),
  KEY `user-student` (`userID`),
  KEY `student-university` (`universityID`),
  CONSTRAINT `student-university` FOREIGN KEY (`universityID`) REFERENCES `university` (`universityID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `user-student` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (4,'aaa','bbb','qqqq','ddd','200105702857','ccc','verified',NULL,NULL,NULL,12,1,5,0,0),(6,'aaa','bb',NULL,NULL,'660951105v','aaa','verification pending',NULL,NULL,NULL,14,NULL,5,0,0),(7,'aaa','bb',NULL,NULL,'660951145v','aaa','verification pending',NULL,NULL,NULL,15,NULL,5,0,0),(8,'chathura','lakshan',NULL,NULL,'200105702855','skjnwk','verification pending',NULL,NULL,NULL,17,NULL,5,0,0),(9,'sajith','rajapakse',NULL,NULL,'200012365849','99 madamulana pallebedda','verification pending',NULL,NULL,NULL,18,NULL,5,0,0),(10,'sajith','rajapakse',NULL,NULL,'960951105v','99 madamulana pallebedda','verification pending',NULL,NULL,NULL,19,NULL,5,0,0),(12,'chathura','lakshan',NULL,NULL,'123456789123','111','verification pending',NULL,NULL,NULL,21,NULL,5,0,0),(14,'Seekwork','student','student qualifications','student description','234567890123','No.5 Seekwork rd.','verified','../app/uploads/verification/26/1701848564-20231109_091522.jpg',NULL,'uploads/profilePics/1704612264Screenshot from 2024-01-02 09-25-54.png',26,1,5,0,233),(16,'chathura','lakshan',NULL,NULL,'200105702899','dkjmwd','verification pending',NULL,NULL,NULL,29,NULL,5,0,0),(17,'chathura','lakshan',NULL,NULL,'200105702868','njasw','verification pending',NULL,NULL,NULL,30,NULL,5,0,0),(20,'jk',',jn',NULL,NULL,'mmkl','','verification pending',NULL,NULL,NULL,22,NULL,5,0,0),(21,'jybh','hbj',NULL,NULL,'200105702555','jbhhjn','verification pending',NULL,NULL,NULL,38,1,5,0,0),(22,'Nimal','Perera','Currently pursuing a Bachelor\'s degree in Computer Science at the University of Colombo School of Computing (UCSC). Achieved outstanding grades in courses related to algorithms, data structures, and computer networks.','Nimal is a dedicated and hardworking individual with a passion for computer science. He is known among his peers for his excellent problem-solving skills and his willingness to help others. Nimal is actively involved in extracurricular activities related to programming and has a keen interest in software development.','961234567v','23, Galle Road, Colombo, Sri Lanka','verification pending',NULL,NULL,'uploads/profilePics/1708434737closeup-view-smiling-young-handsome-man-holding-pencil-note-pad-looking-camera-isolated-blue-background_141793-136603.jpg',44,1,3.5,2,2),(23,'Kamala','Silva','Holds a Bachelor\'s degree in Statistics from the University of Colombo (UOC). Completed coursework in probability theory, regression analysis, and experimental design with top grades.','Kamala is a detail-oriented and organized individual with a passion for mathematics and data analysis. She has a natural talent for understanding complex mathematical concepts and enjoys applying them to real-world problems. Kamala is known for her excellent communication skills and her ability to work well in a team.','875432109v','456, Kandy Road, Gampaha, Sri Lanka','verification pending',NULL,NULL,'uploads/profilePics/1708434911side-view-smiley-woman-holding-book_23-2149915886.jpg',45,2,5,0,0),(24,'Sunil','Fernando','Completed a Diploma in Multimedia Design at the Faculty of Science (FOS), University of Colombo. Received awards for his outstanding design projects during his studies.','Sunil is a creative and innovative individual with a passion for design and visual arts. He has a keen eye for aesthetics and enjoys creating visually appealing graphics and multimedia content. Sunil is known for his attention to detail and his ability to think outside the box.','753210987v','789, Negombo Road, Wattala, Sri Lanka','verification pending',NULL,NULL,'uploads/profilePics/1708435050portrait-student-boy_23-2147668972.jpg',46,4,5,0,0),(25,'Malini','Bandara','Currently pursuing a Bachelor\'s degree in Business Administration at the University of Colombo School of Computing (UCSC). Completed coursework in accounting, marketing, and strategic management with distinction.','Malini is a driven and ambitious individual with a passion for business and entrepreneurship. She is known for her leadership qualities and her ability to take initiative. Malini is actively involved in entrepreneurial activities and is always seeking opportunities to learn and grow.','841234567v','234, Nawala Road, Rajagiriya, Sri Lanka','verification pending',NULL,NULL,'uploads/profilePics/1708435207smiley-woman-holding-stack-books_23-2148418604.jpg',47,1,5,0,0),(26,'Ajith','Rajapaksha','Holds a Bachelor\'s degree in Law from the University of Colombo (UOC). Actively involved in moot court competitions and legal aid clinics during his studies.','Ajith is a confident and articulate individual with a passion for public speaking and advocacy. He is known for his persuasive communication skills and his ability to articulate complex ideas effectively. Ajith is actively involved in student politics and community service initiatives.','631098765v','567, Havelock Road, Colombo, Sri Lanka','verification pending',NULL,NULL,'uploads/profilePics/1708435347serious-pensive-young-student-looking-directly-camera_176532-8154.jpg',48,1,5,0,0);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER `student_insert_audit_trigger` AFTER INSERT ON `student` FOR EACH ROW BEGIN
    INSERT INTO student_audit_log(
        studentID,
        actionType,
        actionTime,
        old_data,
        new_data,
        loggedUserID
    )
    VALUES(
        NEW.studentID,
        'INSERT',
        CURRENT_TIMESTAMP,
        NULL,
        JSON_OBJECT(
            "firstName", NEW.firstName,
            "lastName", NEW.lastName,
            "qualifications", NEW.qualifications,
            "description", NEW.description,
            "NIC", NEW.NIC,
            "address", NEW.address,
            "status", NEW.status,
            "verificationDocuments", NEW.verificationDocuments,
            "accountNo", NEW.accountNo,
            "profilePic", NEW.profilePic,
            "userID", NEW.userID,
            "universityID", NEW.universityID
        ),
        @logged_user
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER `student_update_audit_trigger` AFTER UPDATE ON `student` FOR EACH ROW BEGIN
    INSERT INTO student_audit_log(
        studentID,
        actionType,
        actionTime,
        old_data,
        new_data,
        loggedUserID
    )
    VALUES(
        NEW.studentID,
        'UPDATE',
        CURRENT_TIMESTAMP,
        JSON_OBJECT(
            "firstName", OLD.firstName,
            "lastName", OLD.lastName,
            "qualifications", OLD.qualifications,
            "description", OLD.description,
            "NIC", OLD.NIC,
            "address", OLD.address,
            "status", OLD.status,
            "verificationDocuments", OLD.verificationDocuments,
            "accountNo", OLD.accountNo,
            "profilePic", OLD.profilePic,
            "userID", OLD.userID,
            "universityID", OLD.universityID
        ),
        JSON_OBJECT(
            "firstName", NEW.firstName,
            "lastName", NEW.lastName,
            "qualifications", NEW.qualifications,
            "description", NEW.description,
            "NIC", NEW.NIC,
            "address", NEW.address,
            "status", NEW.status,
            "verificationDocuments", NEW.verificationDocuments,
            "accountNo", NEW.accountNo,
            "profilePic", NEW.profilePic,
            "userID", NEW.userID,
            "universityID", NEW.universityID
        ),
        @logged_user
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER `student_delete_audit_trigger` AFTER DELETE ON `student` FOR EACH ROW BEGIN
    INSERT INTO student_audit_log(
        studentID,
        actionType,
        actionTime,
        old_data,
        new_data,
        loggedUserID
    )
    VALUES(
        OLD.studentID,
        'DELETE',
        CURRENT_TIMESTAMP,
        JSON_OBJECT(
            "firstName", OLD.firstName,
            "lastName", OLD.lastName,
            "qualifications", OLD.qualifications,
            "description", OLD.description,
            "NIC", OLD.NIC,
            "address", OLD.address,
            "status", OLD.status,
            "verificationDocuments", OLD.verificationDocuments,
            "accountNo", OLD.accountNo,
            "profilePic", OLD.profilePic,
            "userID", OLD.userID,
            "universityID", OLD.universityID
        ),
        NULL,
        @logged_user
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `student_audit_log`
--

DROP TABLE IF EXISTS `student_audit_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_audit_log` (
  `studentID` int NOT NULL,
  `actionType` enum('INSERT','UPDATE','DELETE') NOT NULL,
  `actionTime` timestamp NOT NULL,
  `old_data` json DEFAULT NULL,
  `new_data` json DEFAULT NULL,
  `loggedUserID` int DEFAULT NULL,
  PRIMARY KEY (`studentID`,`actionType`,`actionTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_audit_log`
--

LOCK TABLES `student_audit_log` WRITE;
/*!40000 ALTER TABLE `student_audit_log` DISABLE KEYS */;
INSERT INTO `student_audit_log` VALUES (9,'UPDATE','2024-02-07 09:57:49','{\"NIC\": \"200012365849\", \"status\": \"verification pending\", \"userID\": 18, \"address\": \"99 madamulana pallebedda\", \"lastName\": \"rajapakse\", \"accountNo\": null, \"firstName\": \"sajith\", \"profilePic\": null, \"description\": null, \"universityID\": null, \"qualifications\": null, \"verificationDocuments\": null}','{\"NIC\": \"200012365849\", \"status\": \"verification pending\", \"userID\": 18, \"address\": \"99 madamulana pallebedda\", \"lastName\": \"rajapakse\", \"accountNo\": null, \"firstName\": \"sajith\", \"profilePic\": null, \"description\": null, \"universityID\": null, \"qualifications\": null, \"verificationDocuments\": null}',NULL),(9,'UPDATE','2024-02-07 10:02:48','{\"NIC\": \"200012365849\", \"status\": \"verification pending\", \"userID\": 18, \"address\": \"99 madamulana pallebedda\", \"lastName\": \"rajapakse\", \"accountNo\": null, \"firstName\": \"sajith\", \"profilePic\": null, \"description\": null, \"universityID\": null, \"qualifications\": null, \"verificationDocuments\": null}','{\"NIC\": \"200012365849\", \"status\": \"verification pending\", \"userID\": 18, \"address\": \"99 madamulana pallebedda\", \"lastName\": \"rajapakse\", \"accountNo\": null, \"firstName\": \"sajith\", \"profilePic\": null, \"description\": null, \"universityID\": null, \"qualifications\": null, \"verificationDocuments\": null}',NULL),(14,'UPDATE','2023-12-05 07:45:28','{\"NIC\": \"234567890123\", \"status\": \"verification pending\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": null, \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": null}','{\"NIC\": \"234567890123\", \"status\": \"verification pending\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/17017623281701703835-Screenshot from 2023-11-26 19-32-20.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": null}',26),(14,'UPDATE','2023-12-05 08:17:27','{\"NIC\": \"234567890123\", \"status\": \"verification pending\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/17017623281701703835-Screenshot from 2023-11-26 19-32-20.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": null}','{\"NIC\": \"234567890123\", \"status\": \"verification pending\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/17017623281701703835-Screenshot from 2023-11-26 19-32-20.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701764247-Screenshot from 2023-12-02 22-23-27.png\"}',26),(14,'UPDATE','2023-12-06 07:41:33','{\"NIC\": \"234567890123\", \"status\": \"verification pending\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/17017623281701703835-Screenshot from 2023-11-26 19-32-20.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701764247-Screenshot from 2023-12-02 22-23-27.png\"}','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/17017623281701703835-Screenshot from 2023-11-26 19-32-20.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848493-20231109_091044.jpg\"}',26),(14,'UPDATE','2023-12-06 07:42:22','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/17017623281701703835-Screenshot from 2023-11-26 19-32-20.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848493-20231109_091044.jpg\"}','{\"NIC\": \"234567890123\", \"status\": \"verification pending\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/17017623281701703835-Screenshot from 2023-11-26 19-32-20.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848493-20231109_091044.jpg\"}',NULL),(14,'UPDATE','2023-12-06 07:42:44','{\"NIC\": \"234567890123\", \"status\": \"verification pending\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/17017623281701703835-Screenshot from 2023-11-26 19-32-20.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848493-20231109_091044.jpg\"}','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/17017623281701703835-Screenshot from 2023-11-26 19-32-20.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848564-20231109_091522.jpg\"}',26),(14,'UPDATE','2024-01-07 07:24:24','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/17017623281701703835-Screenshot from 2023-11-26 19-32-20.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848564-20231109_091522.jpg\"}','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1704612264Screenshot from 2024-01-02 09-25-54.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848564-20231109_091522.jpg\"}',26),(14,'UPDATE','2024-01-07 07:54:09','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1704612264Screenshot from 2024-01-02 09-25-54.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848564-20231109_091522.jpg\"}','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1704612264Screenshot from 2024-01-02 09-25-54.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848564-20231109_091522.jpg\"}',26),(14,'UPDATE','2024-01-07 07:54:40','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1704612264Screenshot from 2024-01-02 09-25-54.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848564-20231109_091522.jpg\"}','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1704612264Screenshot from 2024-01-02 09-25-54.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848564-20231109_091522.jpg\"}',26),(14,'UPDATE','2024-01-07 08:07:55','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1704612264Screenshot from 2024-01-02 09-25-54.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848564-20231109_091522.jpg\"}','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1704612264Screenshot from 2024-01-02 09-25-54.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848564-20231109_091522.jpg\"}',26),(14,'UPDATE','2024-01-07 11:00:08','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1704612264Screenshot from 2024-01-02 09-25-54.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848564-20231109_091522.jpg\"}','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1704612264Screenshot from 2024-01-02 09-25-54.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848564-20231109_091522.jpg\"}',26),(14,'UPDATE','2024-01-18 01:16:25','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1704612264Screenshot from 2024-01-02 09-25-54.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848564-20231109_091522.jpg\"}','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1704612264Screenshot from 2024-01-02 09-25-54.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848564-20231109_091522.jpg\"}',26),(14,'UPDATE','2024-02-07 12:15:26','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1704612264Screenshot from 2024-01-02 09-25-54.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848564-20231109_091522.jpg\"}','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1704612264Screenshot from 2024-01-02 09-25-54.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848564-20231109_091522.jpg\"}',NULL),(14,'UPDATE','2024-02-07 12:15:35','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1704612264Screenshot from 2024-01-02 09-25-54.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848564-20231109_091522.jpg\"}','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1704612264Screenshot from 2024-01-02 09-25-54.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848564-20231109_091522.jpg\"}',NULL),(14,'UPDATE','2024-02-07 12:53:38','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1704612264Screenshot from 2024-01-02 09-25-54.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848564-20231109_091522.jpg\"}','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1704612264Screenshot from 2024-01-02 09-25-54.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848564-20231109_091522.jpg\"}',NULL),(14,'UPDATE','2024-02-20 09:21:09','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1704612264Screenshot from 2024-01-02 09-25-54.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848564-20231109_091522.jpg\"}','{\"NIC\": \"234567890123\", \"status\": \"verified\", \"userID\": 26, \"address\": \"No.5 Seekwork rd.\", \"lastName\": \"student\", \"accountNo\": null, \"firstName\": \"Seekwork\", \"profilePic\": \"uploads/profilePics/1704612264Screenshot from 2024-01-02 09-25-54.png\", \"description\": \"student description\", \"universityID\": 1, \"qualifications\": \"student qualifications\", \"verificationDocuments\": \"../app/uploads/verification/26/1701848564-20231109_091522.jpg\"}',26),(19,'INSERT','2023-11-29 08:13:01',NULL,'{\"NIC\": \"200105702555\", \"status\": \"verification pending\", \"userID\": 37, \"address\": \"jbhhjn\", \"lastName\": \"hbj\", \"accountNo\": null, \"firstName\": \"jybh\", \"profilePic\": null, \"description\": null, \"universityID\": 1, \"qualifications\": null, \"verificationDocuments\": null}',NULL),(20,'INSERT','2023-11-29 08:22:13',NULL,'{\"NIC\": \"mmkl\", \"status\": \"verification pending\", \"userID\": 22, \"address\": \"\", \"lastName\": \",jn\", \"accountNo\": null, \"firstName\": \"jk\", \"profilePic\": null, \"description\": null, \"universityID\": null, \"qualifications\": null, \"verificationDocuments\": null}',NULL),(21,'INSERT','2023-11-29 08:40:12',NULL,'{\"NIC\": \"200105702555\", \"status\": \"verification pending\", \"userID\": 38, \"address\": \"jbhhjn\", \"lastName\": \"hbj\", \"accountNo\": null, \"firstName\": \"jybh\", \"profilePic\": null, \"description\": null, \"universityID\": 1, \"qualifications\": null, \"verificationDocuments\": null}',NULL),(22,'INSERT','2024-02-20 13:09:34',NULL,'{\"NIC\": \"961234567v\", \"status\": \"verification pending\", \"userID\": 44, \"address\": \"23, Galle Road, Colombo, Sri Lanka\", \"lastName\": \"Perera\", \"accountNo\": null, \"firstName\": \"Nimal\", \"profilePic\": null, \"description\": null, \"universityID\": 1, \"qualifications\": null, \"verificationDocuments\": null}',NULL),(22,'UPDATE','2024-02-20 13:12:18','{\"NIC\": \"961234567v\", \"status\": \"verification pending\", \"userID\": 44, \"address\": \"23, Galle Road, Colombo, Sri Lanka\", \"lastName\": \"Perera\", \"accountNo\": null, \"firstName\": \"Nimal\", \"profilePic\": null, \"description\": null, \"universityID\": 1, \"qualifications\": null, \"verificationDocuments\": null}','{\"NIC\": \"961234567v\", \"status\": \"verification pending\", \"userID\": 44, \"address\": \"23, Galle Road, Colombo, Sri Lanka\", \"lastName\": \"Perera\", \"accountNo\": null, \"firstName\": \"Nimal\", \"profilePic\": \"uploads/profilePics/1708434737closeup-view-smiling-young-handsome-man-holding-pencil-note-pad-looking-camera-isolated-blue-background_141793-136603.jpg\", \"description\": \"Nimal is a dedicated and hardworking individual with a passion for computer science. He is known among his peers for his excellent problem-solving skills and his willingness to help others. Nimal is actively involved in extracurricular activities related to programming and has a keen interest in software development.\", \"universityID\": 1, \"qualifications\": \"Currently pursuing a Bachelor\'s degree in Computer Science at the University of Colombo School of Computing (UCSC). Achieved outstanding grades in courses related to algorithms, data structures, and computer networks.\", \"verificationDocuments\": null}',44),(22,'UPDATE','2024-02-20 15:50:26','{\"NIC\": \"961234567v\", \"status\": \"verification pending\", \"userID\": 44, \"address\": \"23, Galle Road, Colombo, Sri Lanka\", \"lastName\": \"Perera\", \"accountNo\": null, \"firstName\": \"Nimal\", \"profilePic\": \"uploads/profilePics/1708434737closeup-view-smiling-young-handsome-man-holding-pencil-note-pad-looking-camera-isolated-blue-background_141793-136603.jpg\", \"description\": \"Nimal is a dedicated and hardworking individual with a passion for computer science. He is known among his peers for his excellent problem-solving skills and his willingness to help others. Nimal is actively involved in extracurricular activities related to programming and has a keen interest in software development.\", \"universityID\": 1, \"qualifications\": \"Currently pursuing a Bachelor\'s degree in Computer Science at the University of Colombo School of Computing (UCSC). Achieved outstanding grades in courses related to algorithms, data structures, and computer networks.\", \"verificationDocuments\": null}','{\"NIC\": \"961234567v\", \"status\": \"verification pending\", \"userID\": 44, \"address\": \"23, Galle Road, Colombo, Sri Lanka\", \"lastName\": \"Perera\", \"accountNo\": null, \"firstName\": \"Nimal\", \"profilePic\": \"uploads/profilePics/1708434737closeup-view-smiling-young-handsome-man-holding-pencil-note-pad-looking-camera-isolated-blue-background_141793-136603.jpg\", \"description\": \"Nimal is a dedicated and hardworking individual with a passion for computer science. He is known among his peers for his excellent problem-solving skills and his willingness to help others. Nimal is actively involved in extracurricular activities related to programming and has a keen interest in software development.\", \"universityID\": 1, \"qualifications\": \"Currently pursuing a Bachelor\'s degree in Computer Science at the University of Colombo School of Computing (UCSC). Achieved outstanding grades in courses related to algorithms, data structures, and computer networks.\", \"verificationDocuments\": null}',44),(22,'UPDATE','2024-02-20 16:03:20','{\"NIC\": \"961234567v\", \"status\": \"verification pending\", \"userID\": 44, \"address\": \"23, Galle Road, Colombo, Sri Lanka\", \"lastName\": \"Perera\", \"accountNo\": null, \"firstName\": \"Nimal\", \"profilePic\": \"uploads/profilePics/1708434737closeup-view-smiling-young-handsome-man-holding-pencil-note-pad-looking-camera-isolated-blue-background_141793-136603.jpg\", \"description\": \"Nimal is a dedicated and hardworking individual with a passion for computer science. He is known among his peers for his excellent problem-solving skills and his willingness to help others. Nimal is actively involved in extracurricular activities related to programming and has a keen interest in software development.\", \"universityID\": 1, \"qualifications\": \"Currently pursuing a Bachelor\'s degree in Computer Science at the University of Colombo School of Computing (UCSC). Achieved outstanding grades in courses related to algorithms, data structures, and computer networks.\", \"verificationDocuments\": null}','{\"NIC\": \"961234567v\", \"status\": \"verification pending\", \"userID\": 44, \"address\": \"23, Galle Road, Colombo, Sri Lanka\", \"lastName\": \"Perera\", \"accountNo\": null, \"firstName\": \"Nimal\", \"profilePic\": \"uploads/profilePics/1708434737closeup-view-smiling-young-handsome-man-holding-pencil-note-pad-looking-camera-isolated-blue-background_141793-136603.jpg\", \"description\": \"Nimal is a dedicated and hardworking individual with a passion for computer science. He is known among his peers for his excellent problem-solving skills and his willingness to help others. Nimal is actively involved in extracurricular activities related to programming and has a keen interest in software development.\", \"universityID\": 1, \"qualifications\": \"Currently pursuing a Bachelor\'s degree in Computer Science at the University of Colombo School of Computing (UCSC). Achieved outstanding grades in courses related to algorithms, data structures, and computer networks.\", \"verificationDocuments\": null}',42),(22,'UPDATE','2024-02-20 23:01:09','{\"NIC\": \"961234567v\", \"status\": \"verification pending\", \"userID\": 44, \"address\": \"23, Galle Road, Colombo, Sri Lanka\", \"lastName\": \"Perera\", \"accountNo\": null, \"firstName\": \"Nimal\", \"profilePic\": \"uploads/profilePics/1708434737closeup-view-smiling-young-handsome-man-holding-pencil-note-pad-looking-camera-isolated-blue-background_141793-136603.jpg\", \"description\": \"Nimal is a dedicated and hardworking individual with a passion for computer science. He is known among his peers for his excellent problem-solving skills and his willingness to help others. Nimal is actively involved in extracurricular activities related to programming and has a keen interest in software development.\", \"universityID\": 1, \"qualifications\": \"Currently pursuing a Bachelor\'s degree in Computer Science at the University of Colombo School of Computing (UCSC). Achieved outstanding grades in courses related to algorithms, data structures, and computer networks.\", \"verificationDocuments\": null}','{\"NIC\": \"961234567v\", \"status\": \"verification pending\", \"userID\": 44, \"address\": \"23, Galle Road, Colombo, Sri Lanka\", \"lastName\": \"Perera\", \"accountNo\": null, \"firstName\": \"Nimal\", \"profilePic\": \"uploads/profilePics/1708434737closeup-view-smiling-young-handsome-man-holding-pencil-note-pad-looking-camera-isolated-blue-background_141793-136603.jpg\", \"description\": \"Nimal is a dedicated and hardworking individual with a passion for computer science. He is known among his peers for his excellent problem-solving skills and his willingness to help others. Nimal is actively involved in extracurricular activities related to programming and has a keen interest in software development.\", \"universityID\": 1, \"qualifications\": \"Currently pursuing a Bachelor\'s degree in Computer Science at the University of Colombo School of Computing (UCSC). Achieved outstanding grades in courses related to algorithms, data structures, and computer networks.\", \"verificationDocuments\": null}',44),(22,'UPDATE','2024-02-20 23:05:44','{\"NIC\": \"961234567v\", \"status\": \"verification pending\", \"userID\": 44, \"address\": \"23, Galle Road, Colombo, Sri Lanka\", \"lastName\": \"Perera\", \"accountNo\": null, \"firstName\": \"Nimal\", \"profilePic\": \"uploads/profilePics/1708434737closeup-view-smiling-young-handsome-man-holding-pencil-note-pad-looking-camera-isolated-blue-background_141793-136603.jpg\", \"description\": \"Nimal is a dedicated and hardworking individual with a passion for computer science. He is known among his peers for his excellent problem-solving skills and his willingness to help others. Nimal is actively involved in extracurricular activities related to programming and has a keen interest in software development.\", \"universityID\": 1, \"qualifications\": \"Currently pursuing a Bachelor\'s degree in Computer Science at the University of Colombo School of Computing (UCSC). Achieved outstanding grades in courses related to algorithms, data structures, and computer networks.\", \"verificationDocuments\": null}','{\"NIC\": \"961234567v\", \"status\": \"verification pending\", \"userID\": 44, \"address\": \"23, Galle Road, Colombo, Sri Lanka\", \"lastName\": \"Perera\", \"accountNo\": null, \"firstName\": \"Nimal\", \"profilePic\": \"uploads/profilePics/1708434737closeup-view-smiling-young-handsome-man-holding-pencil-note-pad-looking-camera-isolated-blue-background_141793-136603.jpg\", \"description\": \"Nimal is a dedicated and hardworking individual with a passion for computer science. He is known among his peers for his excellent problem-solving skills and his willingness to help others. Nimal is actively involved in extracurricular activities related to programming and has a keen interest in software development.\", \"universityID\": 1, \"qualifications\": \"Currently pursuing a Bachelor\'s degree in Computer Science at the University of Colombo School of Computing (UCSC). Achieved outstanding grades in courses related to algorithms, data structures, and computer networks.\", \"verificationDocuments\": null}',41),(23,'INSERT','2024-02-20 13:13:13',NULL,'{\"NIC\": \"875432109v\", \"status\": \"verification pending\", \"userID\": 45, \"address\": \"456, Kandy Road, Gampaha, Sri Lanka\", \"lastName\": \"Silva\", \"accountNo\": null, \"firstName\": \"Kamala\", \"profilePic\": null, \"description\": null, \"universityID\": 2, \"qualifications\": null, \"verificationDocuments\": null}',NULL),(23,'UPDATE','2024-02-20 13:15:11','{\"NIC\": \"875432109v\", \"status\": \"verification pending\", \"userID\": 45, \"address\": \"456, Kandy Road, Gampaha, Sri Lanka\", \"lastName\": \"Silva\", \"accountNo\": null, \"firstName\": \"Kamala\", \"profilePic\": null, \"description\": null, \"universityID\": 2, \"qualifications\": null, \"verificationDocuments\": null}','{\"NIC\": \"875432109v\", \"status\": \"verification pending\", \"userID\": 45, \"address\": \"456, Kandy Road, Gampaha, Sri Lanka\", \"lastName\": \"Silva\", \"accountNo\": null, \"firstName\": \"Kamala\", \"profilePic\": \"uploads/profilePics/1708434911side-view-smiley-woman-holding-book_23-2149915886.jpg\", \"description\": \"Kamala is a detail-oriented and organized individual with a passion for mathematics and data analysis. She has a natural talent for understanding complex mathematical concepts and enjoys applying them to real-world problems. Kamala is known for her excellent communication skills and her ability to work well in a team.\", \"universityID\": 2, \"qualifications\": \"Holds a Bachelor\'s degree in Statistics from the University of Colombo (UOC). Completed coursework in probability theory, regression analysis, and experimental design with top grades.\", \"verificationDocuments\": null}',45),(24,'INSERT','2024-02-20 13:15:58',NULL,'{\"NIC\": \"753210987v\", \"status\": \"verification pending\", \"userID\": 46, \"address\": \"789, Negombo Road, Wattala, Sri Lanka\", \"lastName\": \"Fernando\", \"accountNo\": null, \"firstName\": \"Sunil\", \"profilePic\": null, \"description\": null, \"universityID\": 4, \"qualifications\": null, \"verificationDocuments\": null}',NULL),(24,'UPDATE','2024-02-20 13:17:31','{\"NIC\": \"753210987v\", \"status\": \"verification pending\", \"userID\": 46, \"address\": \"789, Negombo Road, Wattala, Sri Lanka\", \"lastName\": \"Fernando\", \"accountNo\": null, \"firstName\": \"Sunil\", \"profilePic\": null, \"description\": null, \"universityID\": 4, \"qualifications\": null, \"verificationDocuments\": null}','{\"NIC\": \"753210987v\", \"status\": \"verification pending\", \"userID\": 46, \"address\": \"789, Negombo Road, Wattala, Sri Lanka\", \"lastName\": \"Fernando\", \"accountNo\": null, \"firstName\": \"Sunil\", \"profilePic\": \"uploads/profilePics/1708435050portrait-student-boy_23-2147668972.jpg\", \"description\": \"Sunil is a creative and innovative individual with a passion for design and visual arts. He has a keen eye for aesthetics and enjoys creating visually appealing graphics and multimedia content. Sunil is known for his attention to detail and his ability to think outside the box.\", \"universityID\": 4, \"qualifications\": \"Completed a Diploma in Multimedia Design at the Faculty of Science (FOS), University of Colombo. Received awards for his outstanding design projects during his studies.\", \"verificationDocuments\": null}',46),(25,'INSERT','2024-02-20 13:18:21',NULL,'{\"NIC\": \"841234567v\", \"status\": \"verification pending\", \"userID\": 47, \"address\": \"234, Nawala Road, Rajagiriya, Sri Lanka\", \"lastName\": \"Bandara\", \"accountNo\": null, \"firstName\": \"Malini\", \"profilePic\": null, \"description\": null, \"universityID\": 1, \"qualifications\": null, \"verificationDocuments\": null}',NULL),(25,'UPDATE','2024-02-20 13:20:08','{\"NIC\": \"841234567v\", \"status\": \"verification pending\", \"userID\": 47, \"address\": \"234, Nawala Road, Rajagiriya, Sri Lanka\", \"lastName\": \"Bandara\", \"accountNo\": null, \"firstName\": \"Malini\", \"profilePic\": null, \"description\": null, \"universityID\": 1, \"qualifications\": null, \"verificationDocuments\": null}','{\"NIC\": \"841234567v\", \"status\": \"verification pending\", \"userID\": 47, \"address\": \"234, Nawala Road, Rajagiriya, Sri Lanka\", \"lastName\": \"Bandara\", \"accountNo\": null, \"firstName\": \"Malini\", \"profilePic\": \"uploads/profilePics/1708435207smiley-woman-holding-stack-books_23-2148418604.jpg\", \"description\": \"Malini is a driven and ambitious individual with a passion for business and entrepreneurship. She is known for her leadership qualities and her ability to take initiative. Malini is actively involved in entrepreneurial activities and is always seeking opportunities to learn and grow.\", \"universityID\": 1, \"qualifications\": \"Currently pursuing a Bachelor\'s degree in Business Administration at the University of Colombo School of Computing (UCSC). Completed coursework in accounting, marketing, and strategic management with distinction.\", \"verificationDocuments\": null}',47),(26,'INSERT','2024-02-20 13:20:52',NULL,'{\"NIC\": \"631098765v\", \"status\": \"verification pending\", \"userID\": 48, \"address\": \"567, Havelock Road, Colombo, Sri Lanka\", \"lastName\": \"Rajapaksha\", \"accountNo\": null, \"firstName\": \"Ajith\", \"profilePic\": null, \"description\": null, \"universityID\": 1, \"qualifications\": null, \"verificationDocuments\": null}',NULL),(26,'UPDATE','2024-02-20 13:22:27','{\"NIC\": \"631098765v\", \"status\": \"verification pending\", \"userID\": 48, \"address\": \"567, Havelock Road, Colombo, Sri Lanka\", \"lastName\": \"Rajapaksha\", \"accountNo\": null, \"firstName\": \"Ajith\", \"profilePic\": null, \"description\": null, \"universityID\": 1, \"qualifications\": null, \"verificationDocuments\": null}','{\"NIC\": \"631098765v\", \"status\": \"verification pending\", \"userID\": 48, \"address\": \"567, Havelock Road, Colombo, Sri Lanka\", \"lastName\": \"Rajapaksha\", \"accountNo\": null, \"firstName\": \"Ajith\", \"profilePic\": \"uploads/profilePics/1708435347serious-pensive-young-student-looking-directly-camera_176532-8154.jpg\", \"description\": \"Ajith is a confident and articulate individual with a passion for public speaking and advocacy. He is known for his persuasive communication skills and his ability to articulate complex ideas effectively. Ajith is actively involved in student politics and community service initiatives.\", \"universityID\": 1, \"qualifications\": \"Holds a Bachelor\'s degree in Law from the University of Colombo (UOC). Actively involved in moot court competitions and legal aid clinics during his studies.\", \"verificationDocuments\": null}',48);
/*!40000 ALTER TABLE `student_audit_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_skill`
--

DROP TABLE IF EXISTS `student_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_skill` (
  `studentSkillID` int NOT NULL AUTO_INCREMENT,
  `skillID` int NOT NULL,
  `studentID` int NOT NULL,
  PRIMARY KEY (`studentSkillID`),
  KEY `skillID` (`skillID`),
  KEY `studentID` (`studentID`),
  CONSTRAINT `skill-skillstudent` FOREIGN KEY (`skillID`) REFERENCES `skill` (`skillID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `student-skillstudent` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_skill`
--

LOCK TABLES `student_skill` WRITE;
/*!40000 ALTER TABLE `student_skill` DISABLE KEYS */;
INSERT INTO `student_skill` VALUES (3,6,14);
/*!40000 ALTER TABLE `student_skill` ENABLE KEYS */;
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
  `documents` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submission`
--

LOCK TABLES `submission` WRITE;
/*!40000 ALTER TABLE `submission` DISABLE KEYS */;
INSERT INTO `submission` VALUES (1,'2023-10-05 05:37:02','wswsw','pendingReview',NULL,NULL,NULL,14,9),(2,'2023-10-05 05:37:42','2222','pendingReview',NULL,NULL,NULL,14,9),(3,'2023-10-06 01:46:16','','pendingReview','boom',NULL,NULL,14,9),(4,'2023-10-06 01:46:56','','pendingReview','boom',NULL,NULL,14,9),(5,'2023-10-31 13:12:38','','accepted','description3','2024-01-24 09:22:17','cd',14,3),(6,'2024-02-20 15:51:10',NULL,'accepted','submission 1\r\n','2024-02-20 15:51:45','good submission',22,14),(7,'2024-02-20 15:51:31',NULL,'accepted','submission 2','2024-02-20 15:51:57','great work',22,14),(8,'2024-02-20 23:01:36','{\"1708470096-group-three-modern-architects_23-2147702101.jpg\":\"..\\/app\\/uploads\\/tasks\\/15\\/submissions\\/1708470096-group-three-modern-architects_23-2147702101.jpg\"}','accepted','my first submission','2024-02-20 23:02:38','nice work',22,15),(9,'2024-02-20 23:02:20','{\"1708470140-what-is-a-company.jpg\":\"..\\/app\\/uploads\\/tasks\\/15\\/submissions\\/1708470140-what-is-a-company.jpg\"}','rejected','second submission','2024-02-20 23:02:57','not upto standards. pls review again',22,15),(10,'2024-02-20 23:03:18','{\"1708470198-portrait-student-boy_23-2147668972.jpg\":\"..\\/app\\/uploads\\/tasks\\/15\\/submissions\\/1708470198-portrait-student-boy_23-2147668972.jpg\"}','accepted','revised submission','2024-02-20 23:03:28','great work',22,15);
/*!40000 ALTER TABLE `submission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `support`
--

DROP TABLE IF EXISTS `support`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `support` (
  `supportID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `status` enum('pending','resolved') NOT NULL DEFAULT 'pending',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `resolvedDate` datetime DEFAULT NULL,
  `moderatorComment` text,
  PRIMARY KEY (`supportID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `support`
--

LOCK TABLES `support` WRITE;
/*!40000 ALTER TABLE `support` DISABLE KEYS */;
INSERT INTO `support` VALUES (2,'chathura','chathuralakshan226@gmail.com','Account locked','my account locked.','resolved','2024-02-06 09:11:12','2024-02-06 10:06:39','done');
/*!40000 ALTER TABLE `support` ENABLE KEYS */;
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
  `status` enum('active','closed','inProgress','pendingAssignment','disabled') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `documents` varchar(1024) DEFAULT NULL,
  `isPdfRequiredProposal` tinyint NOT NULL DEFAULT '0' COMMENT 'whether proposal is required to submit with a pdf or not',
  `companyID` int NOT NULL,
  `assignedStudentID` int DEFAULT NULL,
  `assignmentID` int DEFAULT NULL,
  `categoryID` int NOT NULL,
  `finishedDate` date DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` tinyint NOT NULL DEFAULT '0',
  `enableDisableReason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`taskID`),
  KEY `task-company` (`companyID`),
  KEY `task-student` (`assignedStudentID`),
  KEY `task-category` (`categoryID`),
  KEY `assignment-task` (`assignmentID`),
  CONSTRAINT `assignment-task` FOREIGN KEY (`assignmentID`) REFERENCES `assignment` (`assignmentID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `task-category` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `task-company` FOREIGN KEY (`companyID`) REFERENCES `company` (`companyID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `task-student` FOREIGN KEY (`assignedStudentID`) REFERENCES `student` (`studentID`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (1,'Design a Logo','fixed Price','I am starting a new enterprise and I am in need of a logo design.\r\nThe compony deals in Medical Devices and the logo needs to reflect that in a subtle way not in a way where there is a stethoscope in the logo. Name of company is \"MEDYCO LIFE BIOTECH\"\r\n\r\nIdeal skills and experience:\r\n- Experience in logo design\r\n- Creativity and ability to come up with unique and visually appealing designs\r\n- Proficiency in graphic design software\r\n- Strong attention to detail\r\n- Ability to understand and incorporate the vision and branding of a new enterprise','2023-09-09',5000,'active',NULL,0,2,NULL,NULL,1,NULL,'2024-01-01 03:41:23',0,'dedee'),(2,'Create a website','fixed Price','I am looking for an experienced web developer to create a website for me. Specifically, I need a blogging website, with specific design and functionality requirements. The website should be built on WordPress, with PHP and HTML as the core programming language. I already have web content and images ready to go for the new website, so the main scope of work is on the design and development side.\r\n\r\nThe design should be modern and sleek, with clean lines and fonts, as well as including all necessary components of a blog such as comment sections, tags and a SEO-friendly structure. On the development side, I am looking for a custom coding and development job. This includes incorporating necessary plug-ins for a usable and engaging user experience, designing and integrating attractive forms, and making sure the website works across multiple browsers and devices.\r\n\r\nExperience in web design and WordPress development are a must for this job. Additionally, it would be great if the candidate had expertise in SEO and has done any e-commerce projects in the past. Timely completion of the project is also important.',NULL,10000,'active',NULL,0,3,14,NULL,2,NULL,'2024-01-01 03:41:23',0,NULL),(3,'Animation For Stream\r\n','auction','Hello, I am looking for a talented animator who can create a specific introduction animation for my stream. The type of animation I need is 3D, and I have specific elements that I would like included in the animation. My goal is to create something visually stunning and memorable that can draw viewers in and make them stick around. ( I have the full idea ready, and clips to be used inside of the animation, the animation being between 3-5 minutes long ) If you have the skills and the creativity to create something that will be noticed, please reach out to me.',NULL,15000,'closed',NULL,0,4,14,NULL,3,NULL,'2024-01-01 03:41:23',0,NULL),(4,'taskk','fixed Price','task 1 description','2023-09-16',1000,'inProgress',NULL,0,4,14,17,2,NULL,'2024-01-01 03:41:23',1,NULL),(6,'task 3','auction','Task 3 description','2023-09-30',222,'inProgress',NULL,0,4,14,16,3,NULL,'2024-01-01 03:41:23',0,NULL),(9,'test task','fixed Price','Test task Description',NULL,22,'inProgress',NULL,0,4,14,NULL,3,'2023-09-29','2024-01-01 03:41:23',0,NULL),(10,'new test task','auction','New test Task description',NULL,2222,'inProgress',NULL,0,4,14,15,2,NULL,'2024-01-01 03:41:23',0,NULL),(11,'dewdewdwcss','fixed Price','dewdw',NULL,331,'active',NULL,0,4,NULL,NULL,1,NULL,'2024-02-07 11:53:03',1,NULL),(12,'Design a Logo for a New Restaurant','fixed Price','We are launching a new restaurant and need a captivating logo that represents our brand identity. The logo should incorporate elements that reflect our cuisine and ambiance. We are open to creative suggestions but prefer a modern and minimalist design. The final deliverable should be in vector format.','2024-04-10',20000,'active',NULL,1,14,NULL,NULL,1,NULL,'2024-02-20 12:34:34',0,NULL),(13,'Develop a Responsive Website for an Online Clothing Store','auction','We need a professional website for our online clothing store that is visually appealing, user-friendly, and optimized for mobile devices. The website should include features such as product listings, shopping cart functionality, and secure payment processing. We also require integration with social media platforms for easy sharing of products.','2024-04-18',50000,'active',NULL,0,14,NULL,NULL,2,NULL,'2024-02-20 12:35:56',0,NULL),(14,'Write SEO Optimized Blog Articles on Travel Destinations','auction','We are looking for experienced writers to create engaging and informative blog articles on various travel destinations. The articles should be well-researched, SEO-optimized, and include high-quality images. Each article should cover a specific destination, highlighting its attractions, activities, and travel tips.\r\n',NULL,5000,'closed',NULL,0,13,22,18,39,NULL,'2024-02-20 12:38:22',0,NULL),(15,'Create a Model of a Residential Building','auction','We require a skilled 3D artist to create a detailed 3D model of a residential building based on architectural plans and references provided. The model should accurately depict the exterior and interior elements, including rooms, furniture, and landscaping. Attention to detail and realistic rendering are crucial.','2024-05-09',30000,'closed',NULL,0,12,22,19,1,NULL,'2024-02-20 12:41:04',0,NULL),(16,' Edit and Proofread a Research Paper','fixed Price','We need an experienced editor to meticulously edit and proofread a 10,000-word research paper. The paper focuses on the effects of climate change on marine ecosystems and requires attention to detail, grammar, and formatting consistency. The editor should also ensure clarity and coherence throughout the document.',NULL,15000,'active',NULL,0,13,NULL,NULL,39,NULL,'2024-02-20 12:43:15',0,NULL),(17,'Provide Voice Over for ELearning Modules','auction','We require a voice-over artist to provide narration for a series of e-learning modules on financial literacy. The modules cover topics such as budgeting, saving, and investing, and have a total duration of 2 hours. The voice-over should be clear, authoritative, and engaging to maintain learners\' attention.',NULL,30000,'active','../app/uploads/tasks/17/details/1708433090-group-three-modern-architects_23-2147702101.jpg',0,12,NULL,NULL,52,NULL,'2024-02-20 12:44:50',0,NULL),(18,'Build a Social Networking App for Pet Lovers','fixed Price','We\'re looking for a skilled mobile app developer to build a social networking app dedicated to pet lovers. The app should allow users to create profiles for their pets, connect with other pet owners, share photos and videos, and discover pet-friendly events and locations in their area. It should have a visually appealing interface and robust backend functionality.\r\nPreferred Skills: Mobile App Development, Social Networking, API Integration, UI/UX Design','2024-07-10',100000,'active',NULL,0,10,NULL,NULL,48,NULL,'2024-02-20 12:47:00',0,NULL),(19,'Conduct Financial Analysis ','fixed Price','We require a financial analyst to conduct a comprehensive analysis of our company\'s financial performance. The analysis should include ratio analysis, trend analysis, and benchmarking against industry peers. The goal is to identify strengths, weaknesses, opportunities, and threats to inform strategic decision-making.',NULL,50000,'active',NULL,0,11,NULL,NULL,54,NULL,'2024-02-20 12:48:47',0,NULL),(20,'Translate Product Descriptions for ECommerce Website','fixed Price','We need a skilled translator to translate product descriptions from English to Spanish for our e-commerce website. The translations should be accurate, culturally appropriate, and SEO-friendly. The product descriptions include details about features, specifications, and benefits.','2024-07-18',15000,'active',NULL,0,10,NULL,NULL,51,NULL,'2024-02-20 12:50:51',0,NULL),(21,'Design and Animate Logo Intro for YouTube Channel','fixed Price','We need an animator to design and animate a logo intro for our YouTube channel. The intro should be visually appealing, dynamic, and reflect the theme of our channel. It should include our logo animation with sound effects and music.',NULL,20000,'active',NULL,0,11,NULL,NULL,3,NULL,'2024-02-20 12:52:20',0,NULL);
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER `insert_task_increase_task_count` AFTER INSERT ON `task` FOR EACH ROW BEGIN
	UPDATE company SET nTasks=nTasks+1 WHERE companyID=NEW.companyID;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER `update_task_count_for_student` AFTER UPDATE ON `task` FOR EACH ROW BEGIN
	IF (OLD.assignedStudentID IS NULL) AND (NEW.assignedStudentID IS NOT NULL) THEN
    	UPDATE student SET nTasks=nTasks+1 WHERE studentID=NEW.assignedStudentID;
        END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `task_skill`
--

DROP TABLE IF EXISTS `task_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `task_skill` (
  `taskSkillID` int NOT NULL AUTO_INCREMENT,
  `skillID` int NOT NULL,
  `taskID` int NOT NULL,
  PRIMARY KEY (`taskSkillID`),
  KEY `taskSkillID` (`taskSkillID`),
  KEY `skillID` (`skillID`),
  KEY `taskID` (`taskID`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_skill`
--

LOCK TABLES `task_skill` WRITE;
/*!40000 ALTER TABLE `task_skill` DISABLE KEYS */;
INSERT INTO `task_skill` VALUES (1,6,4),(2,27,12),(3,28,12),(4,2,12),(5,12,12),(6,29,13),(7,30,13),(8,31,13),(9,1,13),(10,32,14),(11,5,14),(12,3,14),(13,33,15),(14,34,15),(15,12,15),(16,35,16),(17,36,16),(18,3,16),(19,37,17),(20,38,17),(21,19,17),(22,39,18),(23,40,18),(24,41,18),(25,4,18),(26,9,18),(27,42,19),(28,43,19),(29,44,19),(30,10,19),(31,45,20),(32,14,20),(33,16,20),(34,36,20),(35,46,21),(36,47,21),(37,12,21),(38,18,21),(39,2,21);
/*!40000 ALTER TABLE `task_skill` ENABLE KEYS */;
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
  `gender` enum('male','female') NOT NULL DEFAULT 'male',
  `role` varchar(20) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('active','deactivated') NOT NULL DEFAULT 'active',
  `isOTPVerified` tinyint(1) NOT NULL DEFAULT '0',
  `lastOTPVerifiedDate` datetime DEFAULT NULL,
  `isDeleted` int NOT NULL DEFAULT '0' COMMENT 'whether acount is deleted or not',
  PRIMARY KEY (`userID`),
  UNIQUE KEY `UNIQUE_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (12,'aa@k.com','$2y$10$gxa6lYdaNU6rfHY82CQGa.L4ABMpdTZUWgUlcbHTRarIJ7H1cYMwC','012-345-6789','male','student','2023-09-18 09:26:48','active',0,NULL,0),(14,'aabj@k.com','$2y$10$KnHOE3tyqErLsjggmUPas.KZ/UmwyShx.lXYzuqW5bC9MbAFClUdy','012-345-6789','male','student','2023-09-18 09:34:29','active',0,NULL,0),(15,'aaabj@k.com','$2y$10$78iEQp8L2EuONr7yVceNCebUdsYhaS1ICxIBk0fIv.FKGwyBeL4N2','012-345-6789','male','student','2023-09-18 09:36:48','active',0,NULL,0),(16,'aaa@kk.com','$2y$10$P08nvJCK7z0t7dNScXZElO.uQ3MRgx90LbD9UkaZGPWqScqqn93qO','012-234-4567','male','company','2023-09-18 10:13:50','deactivated',0,NULL,0),(17,'2021cs109@stu.ucsc.cmb.ac.lk','$2y$10$nt.D/ZdzXfdE/Qcjh/i7TOy/qZX1IsQDiKPy.44J0vMuCeiR2kh/O','012-345-6789','male','student','2023-09-18 11:47:26','active',0,NULL,0),(18,'2021cs1029@stu.ucsc.cmb.ac.lk','$2y$10$VZn32bcZ7z4hfDZI8I1me.YjPNp/trCscXwAPXuHe1FLGjEuLx9vC','0775017409','male','student','2023-09-19 07:56:38','active',0,NULL,0),(19,'2021cs018@stu.ucsc.cmb.ac.lk','$2y$10$COXY0b5joTnRQWRYJbySQe6/S1B90n3SJTUUWLi7/3GziO0xd0kEq','1111111111','male','student','2023-09-19 07:59:14','active',0,NULL,0),(21,'chathura@stu.ucsc.cmb.ac.lk','$2y$10$k2xZ8oNZAsCvUtTV1wWwPe/pmGjO/QwXHbFL3z6od1JNcXLOTy6da','0112339220','male','student','2023-09-21 23:19:29','active',0,NULL,0),(22,'chathura@seekwork.com','$2y$10$KPl6CHFI3XpZJiRhj1mbU.p3W3/jUxGLn8hHup94D7WMxI6YijZw.','0775017409','male','company','2023-09-23 10:04:25','active',0,NULL,0),(24,'verifiedcompany@seekwork.com','$2y$10$zzkLQrkDSAopuKUH/PRflOpuJ2ccdKLuW6cuHe5pYiOLEd78IzY5G','0112929330','male','company','2023-09-23 10:57:51','active',0,NULL,0),(25,'admin@seekwork.lk','$2y$10$Vods1YVO7kfZgyFDmz2niup1HSCjeQk5cTy.JJX7RzzVtRuspJXVq','0111111111','male','admin','2023-09-26 09:26:34','active',1,NULL,0),(26,'student@seekwork.lk','$2y$10$SGoys3mOBHgW/hVBL1IP4e0nYbLCDU1AwVglqjrfulBET8ot1xDqu','0111111111','male','student','2023-09-26 09:27:28','active',1,NULL,0),(27,'company@seekwork.lk','$2y$10$w3GHokkOlEVPbWeYdT3vSe2jwpE2DwQ1mmigKaZf5LeZW.RQ/N3re','0111111111','male','company','2023-09-26 09:28:43','active',1,NULL,0),(28,'moderator@seekwork.lk','$2y$10$fHyCVpJQCQOhzd00yCI8ie0LG6EXmy1KjjriLo5tzJSSl1aSfeDFq','0111111111','male','moderator','2023-09-26 09:29:49','active',1,'2024-01-24 08:37:06',0),(29,'kk.dmkde@gmail.com','$2y$10$ydF9klVGGOmPzg50FR5AHe.1fxbzKUqLjYwsFhn3KwdniTXSwQP/u','0116259662','male','student','2023-10-31 10:13:36','active',0,NULL,0),(30,'chathura@ll.com','$2y$10$ActHuYVpk5nGfTyq98pf6eWvBY3OCvEvR03UjGGAqqNH.Rto00eD6','0775017409','male','student','2023-10-31 12:53:24','active',0,NULL,0),(31,'pasindu@seekwork.lk','$2y$10$QED7NOu1nR/5DvUXbDgsN.csptwaf5N48hH6dhDx5EV66cS4JKNpW','0112939220','male','moderator','2023-10-31 14:43:38','active',0,NULL,0),(34,'chathuralakshan20010226@gmail.com','$2y$10$LACTfCQiHWKPtudTEGOfZulCo/zxfUc4muTR6N2DyAid9v41uiDtK','0112939299','male','company','2023-11-26 10:24:23','active',1,NULL,0),(35,'chathuralakshan226@gmail.com','$2y$10$f3Qk9rAh2q872zHBrDjGYeO5DvmXpzCdsPkMAHcYgb2lr3sO2NKju','0885017409','male','company','2023-11-26 10:29:40','active',0,NULL,0),(38,'1@stu.ucsc.cmb.ac.lk','$2y$10$LfOVEWi5Y2W/uC8Gc9S7u.1cKmmBq1Xu4SMWxIh.SEQf4i/5EDem6','0112939220','male','student','2023-11-29 08:40:12','active',0,NULL,0),(39,'contact@betasoftinnovations.com','$2y$10$TRsK5EogjI9hHgrh2q4I.OII3V4ii7narVlAf1jdrSiOThEtPvOg2','0115126557','male','company','2024-02-20 12:01:46','active',1,'2024-02-20 12:02:34',0),(40,'sarah.lee@technexsolutions.net','$2y$10$XpYDANPN4z68kb580kzYk.UlrCBY3WRO2Qn7SH41h/i2tLN6U/29a','0115987652','female','company','2024-02-20 12:07:39','active',1,'2024-02-20 12:08:03',0),(41,'david.chang@quantumdynamicscorp.com','$2y$10$fnv5ofA89r6wrQCrdqmfQ.LLsTyMEXzJ/SG7uDATnqkgQ8ZEZFpoW','0112939299','male','company','2024-02-20 12:16:26','active',1,'2024-02-20 12:17:11',0),(42,'jennifer.williams@infinititechsolutions.com','$2y$10$3tVzQfgFpr6m1BMdhXH/WOeAZ2yQ4qEYVFulyenhqGYnPvpMa0alC','0112939220','female','company','2024-02-20 12:22:23','active',1,'2024-02-20 12:22:46',0),(43,'daniel.rodriguez@phoenixinnovationsgroup.net','$2y$10$rudgxDs0qT48n1JNQmk1/.uGj/9ObcFNPcQSxiy87vrYOv5IRPH/m','0112939299','male','company','2024-02-20 12:27:19','active',1,'2024-02-20 12:27:41',0),(44,'nimal.perera@stu.ucsc.cmb.ac.lk','$2y$10$M7AxU.OPJR71THk5zEbloudlMptaepN3YUPZUuIziKya.uNU4.bqm','0771234567','male','student','2024-02-20 13:09:34','active',1,'2024-02-20 13:10:05',0),(45,'kamala.silva@stu.uoc.cmb.ac.lk','$2y$10$B.RNEm7yyYn2g9nb.PmlT.HAqyVJ92ulAmVBTxB6t74Hy.d.kqD9.','0763241678','female','student','2024-02-20 13:13:13','active',1,'2024-02-20 13:13:33',0),(46,'sunil.fernando@stu.fos.cmb.ac.lk','$2y$10$vXK8Emq4K3maL7pzN7eFJ.ALGDX17GxyR.BgTNAmeeRbT2mr/BPk6','0713456789','male','student','2024-02-20 13:15:58','active',1,'2024-02-20 13:16:17',0),(47,'malini.bandara@stu.ucsc.cmb.ac.lk','$2y$10$m6dfRe2t5jZmRGvqBW6XNOaW.tJAzJaAMNJd1FHms3Be1afUq9uQC','0704567890','female','student','2024-02-20 13:18:21','active',1,'2024-02-20 13:18:44',0),(48,'ajith.rajapakse@stu.ucsc.cmb.ac.lk','$2y$10$A/6UYqdHLg1B2uDvJXsQgeAYprnbpvjdyETuJZ22g1P.iFKrHM8n2','0765678901','male','student','2024-02-20 13:20:52','active',1,'2024-02-20 13:21:13',0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER `user_insert_audit_trigger` AFTER INSERT ON `user` FOR EACH ROW BEGIN
    INSERT INTO user_audit_log (
        userID,
        actionType,
        actionTime,
        old_data,
        new_data,
        loggedUserID
    )
    VALUES(
        NEW.userID,
        'INSERT',
        CURRENT_TIMESTAMP,
        NULL,
        JSON_OBJECT(
            "email", NEW.email,
            "password", NEW.password,
            "contactNo", NEW.contactNo,
            "role", NEW.role,
            "createdAt", NEW.createdAt,
            "status", NEW.status,
            "isOTPVerified", NEW.isOTPVerified
        ),
        @logged_user
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER `user_update_audit_trigger` AFTER UPDATE ON `user` FOR EACH ROW BEGIN
    INSERT INTO user_audit_log (
        userID,
        actionType,
        actionTime,
        old_data,
        new_data,
        loggedUserID
    )
    VALUES(
        NEW.userID,
        'UPDATE',
        CURRENT_TIMESTAMP,
        JSON_OBJECT(
            "email", OLD.email,
            "password", OLD.password,
            "contactNo", OLD.contactNo,
            "role", OLD.role,
            "createdAt", OLD.createdAt,
            "status", OLD.status,
            "isOTPVerified", OLD.isOTPVerified
        ),
        JSON_OBJECT(
            "email", NEW.email,
            "password", NEW.password,
            "contactNo", NEW.contactNo,
            "role", NEW.role,
            "createdAt", NEW.createdAt,
            "status", NEW.status,
            "isOTPVerified", NEW.isOTPVerified
        ),
        @logged_user
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER `user_delete_audit_trigger` AFTER DELETE ON `user` FOR EACH ROW BEGIN
    INSERT INTO user_audit_log (
        userID,
        actionType,
        actionTime,
        old_data,
        new_data,
        loggedUserID
    )
    VALUES(
        OLD.userID,
        'DELETE',
        CURRENT_TIMESTAMP,
        JSON_OBJECT(
            "email", OLD.email,
            "password", OLD.password,
            "contactNo", OLD.contactNo,
            "role", OLD.role,
            "createdAt", OLD.createdAt,
            "status", OLD.status,
            "isOTPVerified", OLD.isOTPVerified
),
    NULL,
    @logged_user
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `user_audit_log`
--

DROP TABLE IF EXISTS `user_audit_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_audit_log` (
  `userID` int NOT NULL,
  `actionType` enum('INSERT','UPDATE','DELETE') NOT NULL,
  `actionTime` timestamp NOT NULL,
  `old_data` json DEFAULT NULL,
  `new_data` json DEFAULT NULL,
  `loggedUserID` int DEFAULT NULL,
  PRIMARY KEY (`userID`,`actionType`,`actionTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_audit_log`
--

LOCK TABLES `user_audit_log` WRITE;
/*!40000 ALTER TABLE `user_audit_log` DISABLE KEYS */;
INSERT INTO `user_audit_log` VALUES (12,'UPDATE','2023-11-28 14:29:55','{\"role\": \"student\", \"email\": \"aa@k.com\", \"status\": \"active\", \"password\": \"$2y$10$gxa6lYdaNU6rfHY82CQGa.L4ABMpdTZUWgUlcbHTRarIJ7H1cYMwC\", \"contactNo\": \"012-345-6789\", \"createdAt\": \"2023-09-18 09:26:48.000000\", \"isOTPVerified\": 0}','{\"role\": \"student\", \"email\": \"aa@k.com\", \"status\": \"deactivated\", \"password\": \"$2y$10$gxa6lYdaNU6rfHY82CQGa.L4ABMpdTZUWgUlcbHTRarIJ7H1cYMwC\", \"contactNo\": \"012-345-6789\", \"createdAt\": \"2023-09-18 09:26:48.000000\", \"isOTPVerified\": 0}',25),(12,'UPDATE','2023-11-28 14:30:45','{\"role\": \"student\", \"email\": \"aa@k.com\", \"status\": \"deactivated\", \"password\": \"$2y$10$gxa6lYdaNU6rfHY82CQGa.L4ABMpdTZUWgUlcbHTRarIJ7H1cYMwC\", \"contactNo\": \"012-345-6789\", \"createdAt\": \"2023-09-18 09:26:48.000000\", \"isOTPVerified\": 0}','{\"role\": \"student\", \"email\": \"aa@k.com\", \"status\": \"active\", \"password\": \"$2y$10$gxa6lYdaNU6rfHY82CQGa.L4ABMpdTZUWgUlcbHTRarIJ7H1cYMwC\", \"contactNo\": \"012-345-6789\", \"createdAt\": \"2023-09-18 09:26:48.000000\", \"isOTPVerified\": 0}',25),(26,'UPDATE','2023-11-28 14:31:24','{\"role\": \"student\", \"email\": \"student@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$SGoys3mOBHgW/hVBL1IP4e0nYbLCDU1AwVglqjrfulBET8ot1xDqu\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:27:28.000000\", \"isOTPVerified\": 0}','{\"role\": \"student\", \"email\": \"student@seekwork.lk\", \"status\": \"deactivated\", \"password\": \"$2y$10$SGoys3mOBHgW/hVBL1IP4e0nYbLCDU1AwVglqjrfulBET8ot1xDqu\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:27:28.000000\", \"isOTPVerified\": 0}',25),(26,'UPDATE','2023-11-28 14:31:29','{\"role\": \"student\", \"email\": \"student@seekwork.lk\", \"status\": \"deactivated\", \"password\": \"$2y$10$SGoys3mOBHgW/hVBL1IP4e0nYbLCDU1AwVglqjrfulBET8ot1xDqu\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:27:28.000000\", \"isOTPVerified\": 0}','{\"role\": \"student\", \"email\": \"student@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$SGoys3mOBHgW/hVBL1IP4e0nYbLCDU1AwVglqjrfulBET8ot1xDqu\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:27:28.000000\", \"isOTPVerified\": 0}',25),(26,'UPDATE','2023-12-05 07:43:52','{\"role\": \"student\", \"email\": \"student@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$SGoys3mOBHgW/hVBL1IP4e0nYbLCDU1AwVglqjrfulBET8ot1xDqu\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:27:28.000000\", \"isOTPVerified\": 0}','{\"role\": \"student\", \"email\": \"student@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$SGoys3mOBHgW/hVBL1IP4e0nYbLCDU1AwVglqjrfulBET8ot1xDqu\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:27:28.000000\", \"isOTPVerified\": 1}',26),(28,'UPDATE','2023-12-10 14:56:05','{\"role\": \"moderator\", \"email\": \"moderator@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$fHyCVpJQCQOhzd00yCI8ie0LG6EXmy1KjjriLo5tzJSSl1aSfeDFq\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:29:49.000000\", \"isOTPVerified\": 1}','{\"role\": \"moderator\", \"email\": \"moderator@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$fHyCVpJQCQOhzd00yCI8ie0LG6EXmy1KjjriLo5tzJSSl1aSfeDFq\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:29:49.000000\", \"isOTPVerified\": 1}',NULL),(28,'UPDATE','2023-12-10 15:07:56','{\"role\": \"moderator\", \"email\": \"moderator@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$fHyCVpJQCQOhzd00yCI8ie0LG6EXmy1KjjriLo5tzJSSl1aSfeDFq\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:29:49.000000\", \"isOTPVerified\": 1}','{\"role\": \"moderator\", \"email\": \"moderator@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$fHyCVpJQCQOhzd00yCI8ie0LG6EXmy1KjjriLo5tzJSSl1aSfeDFq\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:29:49.000000\", \"isOTPVerified\": 0}',NULL),(28,'UPDATE','2023-12-10 15:08:28','{\"role\": \"moderator\", \"email\": \"moderator@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$fHyCVpJQCQOhzd00yCI8ie0LG6EXmy1KjjriLo5tzJSSl1aSfeDFq\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:29:49.000000\", \"isOTPVerified\": 0}','{\"role\": \"moderator\", \"email\": \"moderator@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$fHyCVpJQCQOhzd00yCI8ie0LG6EXmy1KjjriLo5tzJSSl1aSfeDFq\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:29:49.000000\", \"isOTPVerified\": 1}',NULL),(28,'UPDATE','2023-12-10 15:17:56','{\"role\": \"moderator\", \"email\": \"moderator@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$fHyCVpJQCQOhzd00yCI8ie0LG6EXmy1KjjriLo5tzJSSl1aSfeDFq\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:29:49.000000\", \"isOTPVerified\": 1}','{\"role\": \"moderator\", \"email\": \"moderator@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$fHyCVpJQCQOhzd00yCI8ie0LG6EXmy1KjjriLo5tzJSSl1aSfeDFq\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:29:49.000000\", \"isOTPVerified\": 0}',NULL),(28,'UPDATE','2023-12-10 15:26:58','{\"role\": \"moderator\", \"email\": \"moderator@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$fHyCVpJQCQOhzd00yCI8ie0LG6EXmy1KjjriLo5tzJSSl1aSfeDFq\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:29:49.000000\", \"isOTPVerified\": 0}','{\"role\": \"moderator\", \"email\": \"moderator@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$fHyCVpJQCQOhzd00yCI8ie0LG6EXmy1KjjriLo5tzJSSl1aSfeDFq\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:29:49.000000\", \"isOTPVerified\": 1}',NULL),(28,'UPDATE','2023-12-10 15:30:56','{\"role\": \"moderator\", \"email\": \"moderator@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$fHyCVpJQCQOhzd00yCI8ie0LG6EXmy1KjjriLo5tzJSSl1aSfeDFq\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:29:49.000000\", \"isOTPVerified\": 1}','{\"role\": \"moderator\", \"email\": \"moderator@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$fHyCVpJQCQOhzd00yCI8ie0LG6EXmy1KjjriLo5tzJSSl1aSfeDFq\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:29:49.000000\", \"isOTPVerified\": 0}',NULL),(28,'UPDATE','2024-01-24 08:37:06','{\"role\": \"moderator\", \"email\": \"moderator@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$fHyCVpJQCQOhzd00yCI8ie0LG6EXmy1KjjriLo5tzJSSl1aSfeDFq\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:29:49.000000\", \"isOTPVerified\": 0}','{\"role\": \"moderator\", \"email\": \"moderator@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$fHyCVpJQCQOhzd00yCI8ie0LG6EXmy1KjjriLo5tzJSSl1aSfeDFq\", \"contactNo\": \"0111111111\", \"createdAt\": \"2023-09-26 09:29:49.000000\", \"isOTPVerified\": 1}',28),(36,'INSERT','2023-11-28 14:12:40',NULL,'{\"role\": \"company\", \"email\": \"compan2y@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$WsXyUZFX3aX35XeKKgelEeJOBS4K2kD5/iyG95LUBk39tXHmA.MSe\", \"contactNo\": \"0999999999\", \"createdAt\": \"2023-11-28 14:12:40.000000\", \"isOTPVerified\": 0}',NULL),(36,'UPDATE','2023-11-28 14:13:45','{\"role\": \"company\", \"email\": \"compan2y@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$WsXyUZFX3aX35XeKKgelEeJOBS4K2kD5/iyG95LUBk39tXHmA.MSe\", \"contactNo\": \"0999999999\", \"createdAt\": \"2023-11-28 14:12:40.000000\", \"isOTPVerified\": 0}','{\"role\": \"company\", \"email\": \"compan2y@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$WsXyUZFX3aX35XeKKgelEeJOBS4K2kD5/iyG95LUBk39tXHmA.MSe\", \"contactNo\": \"0999999999\", \"createdAt\": \"2023-11-28 14:12:40.000000\", \"isOTPVerified\": 1}',NULL),(36,'DELETE','2023-11-28 14:14:19','{\"role\": \"company\", \"email\": \"compan2y@seekwork.lk\", \"status\": \"active\", \"password\": \"$2y$10$WsXyUZFX3aX35XeKKgelEeJOBS4K2kD5/iyG95LUBk39tXHmA.MSe\", \"contactNo\": \"0999999999\", \"createdAt\": \"2023-11-28 14:12:40.000000\", \"isOTPVerified\": 1}',NULL,NULL),(37,'INSERT','2023-11-29 08:13:01',NULL,'{\"role\": \"student\", \"email\": \"1@stu.ucsc.cmb.ac.lk\", \"status\": \"active\", \"password\": \"$2y$10$Ej1GOLkBCjFhQEw09HwZtOLn4uIxjwfC71h5BE1sD1msIQslv/EaO\", \"contactNo\": \"0112939220\", \"createdAt\": \"2023-11-29 08:13:01.000000\", \"isOTPVerified\": 0}',NULL),(37,'DELETE','2023-11-29 08:22:53','{\"role\": \"student\", \"email\": \"1@stu.ucsc.cmb.ac.lk\", \"status\": \"active\", \"password\": \"$2y$10$Ej1GOLkBCjFhQEw09HwZtOLn4uIxjwfC71h5BE1sD1msIQslv/EaO\", \"contactNo\": \"0112939220\", \"createdAt\": \"2023-11-29 08:13:01.000000\", \"isOTPVerified\": 0}',NULL,NULL),(38,'INSERT','2023-11-29 08:40:12',NULL,'{\"role\": \"student\", \"email\": \"1@stu.ucsc.cmb.ac.lk\", \"status\": \"active\", \"password\": \"$2y$10$LfOVEWi5Y2W/uC8Gc9S7u.1cKmmBq1Xu4SMWxIh.SEQf4i/5EDem6\", \"contactNo\": \"0112939220\", \"createdAt\": \"2023-11-29 08:40:12.000000\", \"isOTPVerified\": 0}',NULL),(39,'INSERT','2024-02-20 12:01:46',NULL,'{\"role\": \"company\", \"email\": \"contact@betasoftinnovations.com\", \"status\": \"active\", \"password\": \"$2y$10$TRsK5EogjI9hHgrh2q4I.OII3V4ii7narVlAf1jdrSiOThEtPvOg2\", \"contactNo\": \"0115126557\", \"createdAt\": \"2024-02-20 12:01:46.000000\", \"isOTPVerified\": 0}',NULL),(39,'UPDATE','2024-02-20 12:02:34','{\"role\": \"company\", \"email\": \"contact@betasoftinnovations.com\", \"status\": \"active\", \"password\": \"$2y$10$TRsK5EogjI9hHgrh2q4I.OII3V4ii7narVlAf1jdrSiOThEtPvOg2\", \"contactNo\": \"0115126557\", \"createdAt\": \"2024-02-20 12:01:46.000000\", \"isOTPVerified\": 0}','{\"role\": \"company\", \"email\": \"contact@betasoftinnovations.com\", \"status\": \"active\", \"password\": \"$2y$10$TRsK5EogjI9hHgrh2q4I.OII3V4ii7narVlAf1jdrSiOThEtPvOg2\", \"contactNo\": \"0115126557\", \"createdAt\": \"2024-02-20 12:01:46.000000\", \"isOTPVerified\": 1}',39),(40,'INSERT','2024-02-20 12:07:39',NULL,'{\"role\": \"company\", \"email\": \"sarah.lee@technexsolutions.net\", \"status\": \"active\", \"password\": \"$2y$10$XpYDANPN4z68kb580kzYk.UlrCBY3WRO2Qn7SH41h/i2tLN6U/29a\", \"contactNo\": \"0115987652\", \"createdAt\": \"2024-02-20 12:07:39.000000\", \"isOTPVerified\": 0}',NULL),(40,'UPDATE','2024-02-20 12:08:03','{\"role\": \"company\", \"email\": \"sarah.lee@technexsolutions.net\", \"status\": \"active\", \"password\": \"$2y$10$XpYDANPN4z68kb580kzYk.UlrCBY3WRO2Qn7SH41h/i2tLN6U/29a\", \"contactNo\": \"0115987652\", \"createdAt\": \"2024-02-20 12:07:39.000000\", \"isOTPVerified\": 0}','{\"role\": \"company\", \"email\": \"sarah.lee@technexsolutions.net\", \"status\": \"active\", \"password\": \"$2y$10$XpYDANPN4z68kb580kzYk.UlrCBY3WRO2Qn7SH41h/i2tLN6U/29a\", \"contactNo\": \"0115987652\", \"createdAt\": \"2024-02-20 12:07:39.000000\", \"isOTPVerified\": 1}',40),(41,'INSERT','2024-02-20 12:16:26',NULL,'{\"role\": \"company\", \"email\": \"david.chang@quantumdynamicscorp.com\", \"status\": \"active\", \"password\": \"$2y$10$fnv5ofA89r6wrQCrdqmfQ.LLsTyMEXzJ/SG7uDATnqkgQ8ZEZFpoW\", \"contactNo\": \"0112939299\", \"createdAt\": \"2024-02-20 12:16:26.000000\", \"isOTPVerified\": 0}',NULL),(41,'UPDATE','2024-02-20 12:17:11','{\"role\": \"company\", \"email\": \"david.chang@quantumdynamicscorp.com\", \"status\": \"active\", \"password\": \"$2y$10$fnv5ofA89r6wrQCrdqmfQ.LLsTyMEXzJ/SG7uDATnqkgQ8ZEZFpoW\", \"contactNo\": \"0112939299\", \"createdAt\": \"2024-02-20 12:16:26.000000\", \"isOTPVerified\": 0}','{\"role\": \"company\", \"email\": \"david.chang@quantumdynamicscorp.com\", \"status\": \"active\", \"password\": \"$2y$10$fnv5ofA89r6wrQCrdqmfQ.LLsTyMEXzJ/SG7uDATnqkgQ8ZEZFpoW\", \"contactNo\": \"0112939299\", \"createdAt\": \"2024-02-20 12:16:26.000000\", \"isOTPVerified\": 1}',41),(42,'INSERT','2024-02-20 12:22:23',NULL,'{\"role\": \"company\", \"email\": \"jennifer.williams@infinititechsolutions.com\", \"status\": \"active\", \"password\": \"$2y$10$3tVzQfgFpr6m1BMdhXH/WOeAZ2yQ4qEYVFulyenhqGYnPvpMa0alC\", \"contactNo\": \"0112939220\", \"createdAt\": \"2024-02-20 12:22:23.000000\", \"isOTPVerified\": 0}',NULL),(42,'UPDATE','2024-02-20 12:22:46','{\"role\": \"company\", \"email\": \"jennifer.williams@infinititechsolutions.com\", \"status\": \"active\", \"password\": \"$2y$10$3tVzQfgFpr6m1BMdhXH/WOeAZ2yQ4qEYVFulyenhqGYnPvpMa0alC\", \"contactNo\": \"0112939220\", \"createdAt\": \"2024-02-20 12:22:23.000000\", \"isOTPVerified\": 0}','{\"role\": \"company\", \"email\": \"jennifer.williams@infinititechsolutions.com\", \"status\": \"active\", \"password\": \"$2y$10$3tVzQfgFpr6m1BMdhXH/WOeAZ2yQ4qEYVFulyenhqGYnPvpMa0alC\", \"contactNo\": \"0112939220\", \"createdAt\": \"2024-02-20 12:22:23.000000\", \"isOTPVerified\": 1}',42),(43,'INSERT','2024-02-20 12:27:19',NULL,'{\"role\": \"company\", \"email\": \"daniel.rodriguez@phoenixinnovationsgroup.net\", \"status\": \"active\", \"password\": \"$2y$10$rudgxDs0qT48n1JNQmk1/.uGj/9ObcFNPcQSxiy87vrYOv5IRPH/m\", \"contactNo\": \"0112939299\", \"createdAt\": \"2024-02-20 12:27:19.000000\", \"isOTPVerified\": 0}',NULL),(43,'UPDATE','2024-02-20 12:27:41','{\"role\": \"company\", \"email\": \"daniel.rodriguez@phoenixinnovationsgroup.net\", \"status\": \"active\", \"password\": \"$2y$10$rudgxDs0qT48n1JNQmk1/.uGj/9ObcFNPcQSxiy87vrYOv5IRPH/m\", \"contactNo\": \"0112939299\", \"createdAt\": \"2024-02-20 12:27:19.000000\", \"isOTPVerified\": 0}','{\"role\": \"company\", \"email\": \"daniel.rodriguez@phoenixinnovationsgroup.net\", \"status\": \"active\", \"password\": \"$2y$10$rudgxDs0qT48n1JNQmk1/.uGj/9ObcFNPcQSxiy87vrYOv5IRPH/m\", \"contactNo\": \"0112939299\", \"createdAt\": \"2024-02-20 12:27:19.000000\", \"isOTPVerified\": 1}',43),(44,'INSERT','2024-02-20 13:09:34',NULL,'{\"role\": \"student\", \"email\": \"nimal.perera@stu.ucsc.cmb.ac.lk\", \"status\": \"active\", \"password\": \"$2y$10$M7AxU.OPJR71THk5zEbloudlMptaepN3YUPZUuIziKya.uNU4.bqm\", \"contactNo\": \"0771234567\", \"createdAt\": \"2024-02-20 13:09:34.000000\", \"isOTPVerified\": 0}',NULL),(44,'UPDATE','2024-02-20 13:10:05','{\"role\": \"student\", \"email\": \"nimal.perera@stu.ucsc.cmb.ac.lk\", \"status\": \"active\", \"password\": \"$2y$10$M7AxU.OPJR71THk5zEbloudlMptaepN3YUPZUuIziKya.uNU4.bqm\", \"contactNo\": \"0771234567\", \"createdAt\": \"2024-02-20 13:09:34.000000\", \"isOTPVerified\": 0}','{\"role\": \"student\", \"email\": \"nimal.perera@stu.ucsc.cmb.ac.lk\", \"status\": \"active\", \"password\": \"$2y$10$M7AxU.OPJR71THk5zEbloudlMptaepN3YUPZUuIziKya.uNU4.bqm\", \"contactNo\": \"0771234567\", \"createdAt\": \"2024-02-20 13:09:34.000000\", \"isOTPVerified\": 1}',44),(45,'INSERT','2024-02-20 13:13:13',NULL,'{\"role\": \"student\", \"email\": \"kamala.silva@stu.uoc.cmb.ac.lk\", \"status\": \"active\", \"password\": \"$2y$10$B.RNEm7yyYn2g9nb.PmlT.HAqyVJ92ulAmVBTxB6t74Hy.d.kqD9.\", \"contactNo\": \"0763241678\", \"createdAt\": \"2024-02-20 13:13:13.000000\", \"isOTPVerified\": 0}',NULL),(45,'UPDATE','2024-02-20 13:13:33','{\"role\": \"student\", \"email\": \"kamala.silva@stu.uoc.cmb.ac.lk\", \"status\": \"active\", \"password\": \"$2y$10$B.RNEm7yyYn2g9nb.PmlT.HAqyVJ92ulAmVBTxB6t74Hy.d.kqD9.\", \"contactNo\": \"0763241678\", \"createdAt\": \"2024-02-20 13:13:13.000000\", \"isOTPVerified\": 0}','{\"role\": \"student\", \"email\": \"kamala.silva@stu.uoc.cmb.ac.lk\", \"status\": \"active\", \"password\": \"$2y$10$B.RNEm7yyYn2g9nb.PmlT.HAqyVJ92ulAmVBTxB6t74Hy.d.kqD9.\", \"contactNo\": \"0763241678\", \"createdAt\": \"2024-02-20 13:13:13.000000\", \"isOTPVerified\": 1}',45),(46,'INSERT','2024-02-20 13:15:58',NULL,'{\"role\": \"student\", \"email\": \"sunil.fernando@stu.fos.cmb.ac.lk\", \"status\": \"active\", \"password\": \"$2y$10$vXK8Emq4K3maL7pzN7eFJ.ALGDX17GxyR.BgTNAmeeRbT2mr/BPk6\", \"contactNo\": \"0713456789\", \"createdAt\": \"2024-02-20 13:15:58.000000\", \"isOTPVerified\": 0}',NULL),(46,'UPDATE','2024-02-20 13:16:17','{\"role\": \"student\", \"email\": \"sunil.fernando@stu.fos.cmb.ac.lk\", \"status\": \"active\", \"password\": \"$2y$10$vXK8Emq4K3maL7pzN7eFJ.ALGDX17GxyR.BgTNAmeeRbT2mr/BPk6\", \"contactNo\": \"0713456789\", \"createdAt\": \"2024-02-20 13:15:58.000000\", \"isOTPVerified\": 0}','{\"role\": \"student\", \"email\": \"sunil.fernando@stu.fos.cmb.ac.lk\", \"status\": \"active\", \"password\": \"$2y$10$vXK8Emq4K3maL7pzN7eFJ.ALGDX17GxyR.BgTNAmeeRbT2mr/BPk6\", \"contactNo\": \"0713456789\", \"createdAt\": \"2024-02-20 13:15:58.000000\", \"isOTPVerified\": 1}',46),(47,'INSERT','2024-02-20 13:18:21',NULL,'{\"role\": \"student\", \"email\": \"malini.bandara@stu.ucsc.cmb.ac.lk\", \"status\": \"active\", \"password\": \"$2y$10$m6dfRe2t5jZmRGvqBW6XNOaW.tJAzJaAMNJd1FHms3Be1afUq9uQC\", \"contactNo\": \"0704567890\", \"createdAt\": \"2024-02-20 13:18:21.000000\", \"isOTPVerified\": 0}',NULL),(47,'UPDATE','2024-02-20 13:18:44','{\"role\": \"student\", \"email\": \"malini.bandara@stu.ucsc.cmb.ac.lk\", \"status\": \"active\", \"password\": \"$2y$10$m6dfRe2t5jZmRGvqBW6XNOaW.tJAzJaAMNJd1FHms3Be1afUq9uQC\", \"contactNo\": \"0704567890\", \"createdAt\": \"2024-02-20 13:18:21.000000\", \"isOTPVerified\": 0}','{\"role\": \"student\", \"email\": \"malini.bandara@stu.ucsc.cmb.ac.lk\", \"status\": \"active\", \"password\": \"$2y$10$m6dfRe2t5jZmRGvqBW6XNOaW.tJAzJaAMNJd1FHms3Be1afUq9uQC\", \"contactNo\": \"0704567890\", \"createdAt\": \"2024-02-20 13:18:21.000000\", \"isOTPVerified\": 1}',47),(48,'INSERT','2024-02-20 13:20:52',NULL,'{\"role\": \"student\", \"email\": \"ajith.rajapakse@stu.ucsc.cmb.ac.lk\", \"status\": \"active\", \"password\": \"$2y$10$A/6UYqdHLg1B2uDvJXsQgeAYprnbpvjdyETuJZ22g1P.iFKrHM8n2\", \"contactNo\": \"0765678901\", \"createdAt\": \"2024-02-20 13:20:52.000000\", \"isOTPVerified\": 0}',NULL),(48,'UPDATE','2024-02-20 13:21:13','{\"role\": \"student\", \"email\": \"ajith.rajapakse@stu.ucsc.cmb.ac.lk\", \"status\": \"active\", \"password\": \"$2y$10$A/6UYqdHLg1B2uDvJXsQgeAYprnbpvjdyETuJZ22g1P.iFKrHM8n2\", \"contactNo\": \"0765678901\", \"createdAt\": \"2024-02-20 13:20:52.000000\", \"isOTPVerified\": 0}','{\"role\": \"student\", \"email\": \"ajith.rajapakse@stu.ucsc.cmb.ac.lk\", \"status\": \"active\", \"password\": \"$2y$10$A/6UYqdHLg1B2uDvJXsQgeAYprnbpvjdyETuJZ22g1P.iFKrHM8n2\", \"contactNo\": \"0765678901\", \"createdAt\": \"2024-02-20 13:20:52.000000\", \"isOTPVerified\": 1}',48);
/*!40000 ALTER TABLE `user_audit_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_rating`
--

DROP TABLE IF EXISTS `user_rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_rating` (
  `userID` int NOT NULL,
  `finalRating` double NOT NULL,
  `nReviews` int NOT NULL,
  PRIMARY KEY (`userID`),
  CONSTRAINT `user-rating` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_rating`
--

LOCK TABLES `user_rating` WRITE;
/*!40000 ALTER TABLE `user_rating` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'SeekWorkDB'
--
/*!50106 SET @save_time_zone= @@TIME_ZONE */ ;
/*!50106 DROP EVENT IF EXISTS `OTPRevalidation` */;
DELIMITER ;;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;;
/*!50003 SET character_set_client  = utf8mb4 */ ;;
/*!50003 SET character_set_results = utf8mb4 */ ;;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;;
/*!50003 SET @saved_time_zone      = @@time_zone */ ;;
/*!50003 SET time_zone             = 'SYSTEM' */ ;;
/*!50106 CREATE*/ /*!50117 DEFINER=`admin`@`%`*/ /*!50106 EVENT `OTPRevalidation` ON SCHEDULE EVERY 1 DAY STARTS '2023-12-10 15:30:56' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE user
    SET isOTPVerified = 0,lastOTPVerifiedDate = NOW()
    WHERE lastOTPVerifiedDate < DATE_SUB(NOW(), INTERVAL 6 MONTH);
END */ ;;
/*!50003 SET time_zone             = @saved_time_zone */ ;;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;;
/*!50003 SET character_set_client  = @saved_cs_client */ ;;
/*!50003 SET character_set_results = @saved_cs_results */ ;;
/*!50003 SET collation_connection  = @saved_col_connection */ ;;
DELIMITER ;
/*!50106 SET TIME_ZONE= @save_time_zone */ ;

--
-- Dumping routines for database 'SeekWorkDB'
--
/*!50003 DROP PROCEDURE IF EXISTS `getCombinedUserDetailsForChatPerGivenUserName` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `getCombinedUserDetailsForChatPerGivenUserName`(IN p_userID INT)
BEGIN
    DECLARE role_name VARCHAR(255);
    DECLARE dynamic_query VARCHAR(1000);

    -- Get user details based on userID
    SELECT role INTO role_name FROM user WHERE userID = p_userID;

        -- Build the dynamic query based on the role_name
        SET @dynamic_query = CONCAT('SELECT * FROM user u INNER JOIN ', role_name,' r ON u.userID=r.userID WHERE u.userID=',p_userID);

        -- Prepare and execute the dynamic query
        PREPARE stmt FROM @dynamic_query;
        EXECUTE stmt;
        DEALLOCATE PREPARE stmt;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-22  6:08:26
