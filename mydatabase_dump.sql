-- MySQL dump 10.13  Distrib 8.0.45, for Linux (x86_64)
--
-- Host: localhost    Database: mywebsite
-- ------------------------------------------------------
-- Server version	8.0.45

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
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `articles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `views` int DEFAULT '0',
  `status` enum('draft','published','archived') DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'Ð”Ð¾Ð±Ñ€Ð¾ Ð¿Ð¾Ð¶Ð°Ð»Ð¾Ð²Ð°Ñ‚ÑŒ Ð² Ð¼Ð¸Ñ€ Docker!','Docker â€” ÑÑ‚Ð¾ Ð¿Ð»Ð°Ñ‚Ñ„Ð¾Ñ€Ð¼Ð° Ð´Ð»Ñ Ñ€Ð°Ð·Ñ€Ð°Ð±Ð¾Ñ‚ÐºÐ¸, Ð´Ð¾ÑÑ‚Ð°Ð²ÐºÐ¸ Ð¸ Ð·Ð°Ð¿ÑƒÑÐºÐ° Ð¿Ñ€Ð¸Ð»Ð¾Ð¶ÐµÐ½Ð¸Ð¹ Ð² ÐºÐ¾Ð½Ñ‚ÐµÐ¹Ð½ÐµÑ€Ð°Ñ…. ÐšÐ¾Ð½Ñ‚ÐµÐ¹Ð½ÐµÑ€Ñ‹ Ð¿Ð¾Ð·Ð²Ð¾Ð»ÑÑŽÑ‚ ÑƒÐ¿Ð°ÐºÐ¾Ð²Ð°Ñ‚ÑŒ Ð¿Ñ€Ð¸Ð»Ð¾Ð¶ÐµÐ½Ð¸Ðµ ÑÐ¾ Ð²ÑÐµÐ¼Ð¸ Ð·Ð°Ð²Ð¸ÑÐ¸Ð¼Ð¾ÑÑ‚ÑÐ¼Ð¸ Ð¸ Ð³Ð°Ñ€Ð°Ð½Ñ‚Ð¸Ñ€Ð¾Ð²Ð°Ñ‚ÑŒ ÐµÐ³Ð¾ Ñ€Ð°Ð±Ð¾Ñ‚Ñƒ Ð² Ð»ÑŽÐ±Ð¾Ð¹ ÑÑ€ÐµÐ´Ðµ. Ð’ ÑÑ‚Ð¾Ð¹ ÑÑ‚Ð°Ñ‚ÑŒÐµ Ð¼Ñ‹ Ñ€Ð°ÑÑÐ¼Ð¾Ñ‚Ñ€Ð¸Ð¼ Ð¾ÑÐ½Ð¾Ð²Ñ‹ Ñ€Ð°Ð±Ð¾Ñ‚Ñ‹ Ñ Docker Ð¸ ÑÐ¾Ð·Ð´Ð°Ð´Ð¸Ð¼ ÑÐ²Ð¾Ð¹ Ð¿ÐµÑ€Ð²Ñ‹Ð¹ ÐºÐ¾Ð½Ñ‚ÐµÐ¹Ð½ÐµÑ€.',NULL,'ÐÐ´Ð¼Ð¸Ð½','Ð¢ÐµÑ…Ð½Ð¾Ð»Ð¾Ð³Ð¸Ð¸',150,'published','2026-04-04 00:28:03','2026-04-04 00:28:03'),(2,'ÐŸÑ€ÐµÐ¸Ð¼ÑƒÑ‰ÐµÑÑ‚Ð²Ð° ÐºÐ¾Ð½Ñ‚ÐµÐ¹Ð½ÐµÑ€Ð¸Ð·Ð°Ñ†Ð¸Ð¸','ÐšÐ¾Ð½Ñ‚ÐµÐ¹Ð½ÐµÑ€Ð¸Ð·Ð°Ñ†Ð¸Ñ Ð¿Ñ€Ð¸Ð»Ð¾Ð¶ÐµÐ½Ð¸Ð¹ ÑÑ‚Ð°Ð½Ð¾Ð²Ð¸Ñ‚ÑÑ ÑÑ‚Ð°Ð½Ð´Ð°Ñ€Ñ‚Ð¾Ð¼ Ð² ÑÐ¾Ð²Ñ€ÐµÐ¼ÐµÐ½Ð½Ð¾Ð¹ Ñ€Ð°Ð·Ñ€Ð°Ð±Ð¾Ñ‚ÐºÐµ. ÐžÑÐ½Ð¾Ð²Ð½Ñ‹Ðµ Ð¿Ñ€ÐµÐ¸Ð¼ÑƒÑ‰ÐµÑÑ‚Ð²Ð°: Ð»Ñ‘Ð³ÐºÐ¾ÑÑ‚ÑŒ (Ð¿Ð¾ ÑÑ€Ð°Ð²Ð½ÐµÐ½Ð¸ÑŽ Ñ Ð²Ð¸Ñ€Ñ‚ÑƒÐ°Ð»ÑŒÐ½Ñ‹Ð¼Ð¸ Ð¼Ð°ÑˆÐ¸Ð½Ð°Ð¼Ð¸), Ð¿Ð¾Ñ€Ñ‚Ð°Ñ‚Ð¸Ð²Ð½Ð¾ÑÑ‚ÑŒ (Ñ€Ð°Ð±Ð¾Ñ‚Ð°ÐµÑ‚ Ð²ÐµÐ·Ð´Ðµ, Ð³Ð´Ðµ ÐµÑÑ‚ÑŒ Docker), Ð¸Ð·Ð¾Ð»ÑÑ†Ð¸Ñ (Ð±ÐµÐ·Ð¾Ð¿Ð°ÑÐ½Ð¾Ðµ Ñ€Ð°Ð·Ð´ÐµÐ»ÐµÐ½Ð¸Ðµ Ð¿Ñ€Ð¸Ð»Ð¾Ð¶ÐµÐ½Ð¸Ð¹) Ð¸ ÑÑ„Ñ„ÐµÐºÑ‚Ð¸Ð²Ð½Ð¾ÑÑ‚ÑŒ Ð¸ÑÐ¿Ð¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ð½Ð¸Ñ Ñ€ÐµÑÑƒÑ€ÑÐ¾Ð².',NULL,'ÐÐ´Ð¼Ð¸Ð½','DevOps',98,'published','2026-04-04 00:28:03','2026-04-04 00:28:03'),(3,'Ð¡Ð¾Ð·Ð´Ð°Ð½Ð¸Ðµ ÑÐ°Ð¹Ñ‚Ð° Ð½Ð° PHP Ð¸ MySQL Ð² Docker','Ð’ ÑÑ‚Ð¾Ð¼ Ñ€ÑƒÐºÐ¾Ð²Ð¾Ð´ÑÑ‚Ð²Ðµ Ð¼Ñ‹ Ð¿Ð¾ÐºÐ°Ð¶ÐµÐ¼, ÐºÐ°Ðº Ñ€Ð°Ð·Ð²ÐµÑ€Ð½ÑƒÑ‚ÑŒ Ð¿Ð¾Ð»Ð½Ð¾Ñ†ÐµÐ½Ð½Ñ‹Ð¹ Ð²ÐµÐ±-ÑÐ°Ð¹Ñ‚ Ñ Ð¸ÑÐ¿Ð¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ð½Ð¸ÐµÐ¼ PHP Ð¸ MySQL Ð² Docker. Ð˜ÑÐ¿Ð¾Ð»ÑŒÐ·ÑƒÑ Docker Compose, Ð¼Ð¾Ð¶Ð½Ð¾ Ð»ÐµÐ³ÐºÐ¾ ÑÐ²ÑÐ·Ð°Ñ‚ÑŒ Ð²ÐµÐ±-ÑÐµÑ€Ð²ÐµÑ€, Ð±Ð°Ð·Ñƒ Ð´Ð°Ð½Ð½Ñ‹Ñ… Ð¸ Ð¸Ð½ÑÑ‚Ñ€ÑƒÐ¼ÐµÐ½Ñ‚Ñ‹ Ð°Ð´Ð¼Ð¸Ð½Ð¸ÑÑ‚Ñ€Ð¸Ñ€Ð¾Ð²Ð°Ð½Ð¸Ñ Ð² ÐµÐ´Ð¸Ð½ÑƒÑŽ ÑÐ¸ÑÑ‚ÐµÐ¼Ñƒ.',NULL,'ÐÐ´Ð¼Ð¸Ð½','Ð¢ÑƒÑ‚Ð¾Ñ€Ð¸Ð°Ð»Ñ‹',210,'published','2026-04-04 00:28:03','2026-04-04 00:28:03');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `avatar_url` varchar(500) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` enum('admin','editor','user') DEFAULT 'user',
  `is_active` tinyint(1) DEFAULT '1',
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2026-04-04  0:43:00
