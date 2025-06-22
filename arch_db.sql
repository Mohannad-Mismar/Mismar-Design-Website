-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: arch_db
-- ------------------------------------------------------
-- Server version	8.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `consultations`
--

DROP TABLE IF EXISTS `consultations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consultations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `project_type` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `meeting_date` date NOT NULL,
  `meeting_time` time NOT NULL,
  `meeting_format` varchar(20) NOT NULL,
  `budget` varchar(50) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultations`
--

LOCK TABLES `consultations` WRITE;
/*!40000 ALTER TABLE `consultations` DISABLE KEYS */;
INSERT INTO `consultations` VALUES (1,'mohanad','mismarmohanad@gmail.com','0799828106','new_house','I want a big house','2025-05-31','15:52:00','in_person','50k-100k','','2025-05-18 09:49:17',NULL,'2025-06-01 19:36:23'),(2,'hasan','nexogod535@inkight.com','0799828106','interior_design','sdjasojdosa','2025-05-15','16:02:00','in_person','50k-100k','','2025-05-18 09:58:50',NULL,'2025-06-01 19:36:23'),(3,'omar','dfghjhgf@omar.com','0799828100','interior_design','I want very beautiful room','2025-05-30','21:25:00','virtual','over_100k','','2025-05-18 12:20:02',NULL,'2025-06-01 19:36:23'),(4,'abdali','mosabsalman477@gmail.com','0795361959','room_renovation','iot','2025-05-27','04:31:00','in_person','over_100k','','2025-05-26 08:27:07',NULL,'2025-06-01 19:36:23'),(5,'mohanad','mismarmohanad99@gmail.com','0799828100','new_house','modern','2025-06-03','18:11:00','in_person','under_10k','','2025-06-02 11:06:20',NULL,'2025-06-02 11:06:20'),(6,'mohanad2','mismarmohanad99@gmail.com','0799828100','room_renovation','new room','2025-06-20','14:41:00','in_person','under_10k','','2025-06-03 07:37:23',NULL,'2025-06-03 07:37:23'),(7,'abdali','abdali@inkight.com','0795361959','other','abdali','2025-06-12','16:39:00','in_person','10k-50k','','2025-06-03 11:37:32',NULL,'2025-06-03 11:37:32'),(8,'abdali','mismarmohanad111@gmail.com','0799828106','interior_design','111','2025-06-15','16:40:00','in_person','50k-100k','','2025-06-03 11:38:38',NULL,'2025-06-03 11:38:38'),(9,'kareem','kareem@gmail.com','0799828100','new_house','big nice house','2025-06-11','15:08:00','in_person','under_10k','','2025-06-03 12:09:39',NULL,'2025-06-03 12:09:39'),(10,'tt','123@gmail.com','99999','room_renovation','tttt','2025-06-05','18:13:00','in_person','under_10k','','2025-06-03 12:11:17',NULL,'2025-06-03 12:11:17');
/*!40000 ALTER TABLE `consultations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES (1,'mismarmohanad@gmail.com','9d216b703d720979000da536e5ca1cb25dd13f7dc05a913bbc777dff952fbc70','2025-05-30 17:01:01','2025-05-30 14:01:01');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `image_path` varchar(255) DEFAULT NULL,
  `pdf_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (8,'Café Inspired by Petra','A modern café design that channels the essence of Petra through pink-toned interiors, Bedouin-style seating, and carved rock textures. The space blends heritage and contemporary design to offer a warm, immersive cultural experience.','images/1.jpeg','build/1.pdf','2025-06-02 11:47:19');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (9,'Architecture ','We offer innovative architectural design services that blend functional aesthetics with local identity. Our designs respond to user needs and environmental context, with meticulous attention to every project detail.','../images/Architecture.jpg','2025-06-01 21:04:02'),(11,'Interior Design  ','We craft interior spaces that reflect the client’s taste while ensuring comfort and elegance. From material selection to lighting and furniture layout, every element is considered to create a seamless and harmonious experience.\r\n','../images/interior.jpg','2025-06-02 11:44:13'),(16,'Landscape','We deliver landscape and garden design solutions tailored to your lifestyle, adding a unique natural touch. Our approach integrates greenery and materials thoughtfully to create serene and sustainable outdoor spaces.','../images/landscape.JPG','2025-06-07 15:00:35');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'mismarmohanad@gmail.com','$2y$10$640Q4.Ip3qcRDWpRIxfcaetYXa7ISQ0fSRjWE2iCkdIsY047cbtAS','user','2025-06-01 14:35:59'),(2,'mismarmohanad11@hotmail.com','$2y$10$94kcraKy0fpRb88bxpJKGOOSMdJKGirRBTN4DM9QwqMH7vSDtm0pa','user','2025-06-01 14:35:59'),(3,'mismarmohanad1@gmail.com','$2y$10$VSbGs5vMNG7fuXzle6r67.yNG2UB.dbyKHkLQUHNvNuesie3jQG8a','admin','2025-06-01 14:35:59'),(4,'mismarmohanad99@gmail.com','$2y$10$JbGOISG6jwsm7SlUTtbNTe3RoLUs/UhjML.yZr407a.c71vqQKL9u','user','2025-06-02 11:04:04'),(5,'mismarmohanad999@gmail.com','$2y$10$Bzas0kEGHS/Qi1B679KSTuZjXFen15MH0UiGjyMY5oCU.HPTIJ5gq','user','2025-06-02 11:05:18'),(6,'test@gmail.com','$2y$10$lmMsJm9JtqGuxQIt709Bz.osU2LvLIW0ltVv8tfjFBeH0bQLCaGd.','user','2025-06-03 07:55:17'),(7,'mismarmohanad111@gmail.com','$2y$10$HjCMND6brDI2TiwresOwV.MqIdVO.WkA8feq47Bdmc7UPrTc41D/6','user','2025-06-03 11:21:39'),(8,'abood@gmail.com','$2y$10$W57gPi6GqJ6xgMJY8gvoQerTx1MIP1akHTP1NI/eUZhD.oFkL/kQi','user','2025-06-03 11:39:34'),(9,'123@gmail.com','$2y$10$QRWUyMiriUtKYfbRY/ML5.tE3Le72zu3cgR6ksZ8BRGU3rH8rfcTW','user','2025-06-03 12:03:12');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-22 22:46:58
