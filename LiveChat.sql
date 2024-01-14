-- MySQL dump 10.13  Distrib 8.2.0, for Linux (x86_64)
--
-- Host: localhost    Database: LiveChat
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
-- Temporary view structure for view `UnreceivedMessages`
--

DROP TABLE IF EXISTS `UnreceivedMessages`;
/*!50001 DROP VIEW IF EXISTS `UnreceivedMessages`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `UnreceivedMessages` AS SELECT 
 1 AS `id`,
 1 AS `sender`,
 1 AS `receiver`,
 1 AS `message`,
 1 AS `files`,
 1 AS `msgID`,
 1 AS `date`,
 1 AS `seen`,
 1 AS `received`,
 1 AS `deleted_sender`,
 1 AS `deleted_receiver`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `sender` bigint NOT NULL,
  `receiver` bigint NOT NULL,
  `message` text NOT NULL,
  `files` text,
  `msgID` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` datetime NOT NULL,
  `seen` datetime DEFAULT NULL,
  `received` datetime DEFAULT NULL,
  `deleted_sender` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_receiver` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sender` (`sender`),
  KEY `receiver` (`receiver`),
  KEY `date` (`date`,`deleted_sender`,`deleted_receiver`),
  KEY `seen` (`seen`),
  CONSTRAINT `receiver-user` FOREIGN KEY (`receiver`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sender-user` FOREIGN KEY (`sender`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,1786231207168972,1786231049212840,'hi amy',NULL,'IFxrPGmmnybxlPUePSdbtfqvcp','2023-12-25 16:51:51','2023-12-25 16:52:30','2023-12-25 16:52:26',0,0),(2,1786231207168972,1786230848584796,'hi penny',NULL,'4q7tQo8128yRVtVu314XWzIHCd','2023-12-25 16:51:58','2023-12-25 16:55:24','2023-12-25 16:55:21',0,0),(3,1786231207168972,1786230633044465,'hello chathura',NULL,'i3GSvXGtxzJ1kXahjBFKiOmqxx4O8','2023-12-25 16:52:08',NULL,NULL,0,0),(4,1786231207168972,1786231049212840,'Where are you?',NULL,'IFxrPGmmnybxlPUePSdbtfqvcp','2023-12-25 16:52:17','2023-12-25 16:52:30','2023-12-25 16:52:26',0,0),(5,1786231207168972,1786231049212840,'','uploads/1703523226_Screenshot from 2023-12-25 22-23-37.png','IFxrPGmmnybxlPUePSdbtfqvcp','2023-12-25 16:53:46','2023-12-25 16:54:00','2023-12-25 16:53:50',0,0),(6,1786231049212840,1786231207168972,'Noooooooooooooooooo',NULL,'IFxrPGmmnybxlPUePSdbtfqvcp','2023-12-25 16:54:04',NULL,'2023-12-25 16:54:05',0,0),(7,1786231049212840,1786230848584796,'Sheldon make me mad',NULL,'BZGEbtB1y3dFjgoDSjjSGAgOnxnhNNa4AD2dua5zZDhLtcmVAureCspR','2023-12-25 16:54:53',NULL,NULL,0,0),(8,1786230848584796,1786231207168972,'','uploads/1703523329_m (1).zip','4q7tQo8128yRVtVu314XWzIHCd','2023-12-25 16:55:29',NULL,'2023-12-25 16:55:41',0,0);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `userID` bigint NOT NULL,
  `userName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `image` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `online` int DEFAULT NULL,
  `gender` enum('male','female') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userID` (`userID`),
  KEY `userName` (`userName`),
  KEY `email` (`email`),
  KEY `createdAt` (`createdAt`),
  KEY `online` (`online`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (7,1786230633044465,'chathura226','chathura@mychat.com','$2y$10$nn03rdpld4kyoo5EdEJlKOlEiXd7urwQZWuNCDE9BYzwapL889af6','uploads/1703482406_images.jpeg','2023-12-25 05:31:17',NULL,'male'),(8,1786230848584796,'Penny256','penny@mychat.com','$2y$10$h0k7M7CW4X3uX2l4gVvh3.ok5g7h6gMOsR1lDUuPZrTyRRUzATpga','uploads/1703482601_big-bang-theory-penny-kaley-cuoco-1632400651.jpeg','2023-12-25 05:34:43',NULL,'female'),(9,1786231049212840,'amy99','amy@mychat.com','$2y$10$NuPo2PLi6x7zyloSYTdiKeGpQTmXxE7359eKhTgHZE14BFitaqAzC','uploads/1703482760_Screenshot from 2023-12-25 11-09-13.png','2023-12-25 05:37:54',NULL,'female'),(10,1786231207168972,'sheldon99','sheldon@mychat.com','$2y$10$GASBcpNdTcuXVqH1FqmIdehDeK76PfZqInuNqboiVQb5jRgTArgNK','uploads/1703521866_Screenshot from 2023-12-25 11-11-15.png','2023-12-25 05:40:25',NULL,'male');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `UnreceivedMessages`
--

/*!50001 DROP VIEW IF EXISTS `UnreceivedMessages`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`admin`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `UnreceivedMessages` AS select `messages`.`id` AS `id`,`messages`.`sender` AS `sender`,`messages`.`receiver` AS `receiver`,`messages`.`message` AS `message`,`messages`.`files` AS `files`,`messages`.`msgID` AS `msgID`,`messages`.`date` AS `date`,`messages`.`seen` AS `seen`,`messages`.`received` AS `received`,`messages`.`deleted_sender` AS `deleted_sender`,`messages`.`deleted_receiver` AS `deleted_receiver` from `messages` where (`messages`.`received` is null) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-25 16:56:37
