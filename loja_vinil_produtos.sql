-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: loja_vinil
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'Californication',29.00,0),(2,'Unlimited Love',39.00,1),(3,'Blood Sugar Sex Magik',49.00,23),(4,'One Hot Minute',29.00,3),(5,'The Gateway',39.99,29),(6,'By the Way',49.99,40),(7,'Blue Lonesome',29.99,20),(8,'The Rolling Stones',39.99,30),(9,'A Thousand Suns',49.99,40),(10,'Hybrid theory',29.99,20),(11,'Living Things',39.99,30),(12,'Meteora',49.99,40),(13,'Minutes To Midnight',29.99,20),(14,'One More Light',39.99,30),(15,'Fly To The Rainbow',49.99,40),(16,'Sting In The Tail',29.99,20),(17,'Virgin Killer',39.99,30),(18,'Achtung Baby',49.99,40),(19,'Boy',29.99,20),(20,'Song Of Experience',39.99,30),(21,'Songs Of Innocence',49.99,40),(22,'War',29.99,20),(23,'Zooropa',39.99,30),(24,'Foo Fighters',49.99,40),(25,'In Your Honor',29.99,20),(26,'Medicine at Midnight',39.99,30),(27,'One By One',49.99,40),(28,'The Color and The Shape',29.99,20),(29,'There Is Nothing Left To Lose',39.99,30),(30,'Whats the Story Morning Glory',49.99,40),(31,'Be Here Now',29.99,20),(32,'Definitely Maybe',39.99,30),(33,'Dig Out Your Soul',49.99,40),(34,'Dont Believe the Truth',29.99,20),(35,'Heathen Chemistry',39.99,30),(36,'Morrison Hotel',49.99,40),(37,'The Soft Parade',29.99,20),(38,'Father Of All Motherfuckers',39.99,30),(39,'Dookie',49.99,40),(40,'Saviors',29.99,20),(41,'American Idiot',39.99,30),(42,'21st Century Breakdown',49.99,40),(43,'Uno!',29.99,20),(44,'Highway To Hell',39.99,30),(45,'Black Ice',49.99,40),(46,'Rock or Bust',29.99,20),(47,'Stiff Upper Lip',39.99,30),(48,'The Razors Edge',49.99,40),(49,'Who Made Who',29.99,20),(50,'Everyday Life',39.99,30),(51,'A Head Full Of Dreams',49.99,40),(52,'Ghost Stories',29.99,20),(53,'Music Of The Spheres',39.99,30),(54,'Parachutes',49.99,40),(55,'Mylo Xyloto',29.99,20),(56,'Bounce',39.99,30),(57,'Keep The Faith',49.99,40),(58,'New Jersey',29.99,20),(59,'Bon Jovi',39.99,30),(60,'This House Is Not For Sale',49.99,40),(61,'What About Now',29.99,20),(62,'A Hard Days Night',39.99,30),(63,'Help',49.99,40),(64,'Rubber Soul',29.99,20),(65,'Let It Be',39.99,30),(66,'Yellow Submarine',49.99,40),(67,'Please Please Me',29.99,20),(68,'Backspacer',39.99,30),(69,'Gigaton',49.99,40),(70,'Lighting Bolt',29.99,20),(71,'Pearl Jam',39.99,30),(72,'Binaural',49.99,40),(73,'Ten',29.99,20),(74,'Death Magnetic',39.99,30),(75,'Master Of Puppets',49.99,40),(76,'Hardwired To Self Destruct',29.99,20),(77,'Ride The Lightning',39.99,30),(78,'St Anger',49.99,40),(79,'Load',29.99,20),(80,'Piece Of Mind',39.99,30),(81,'Killers',49.99,40),(82,'Somewhere In Time',29.99,20),(83,'The Number Of The Beast',39.99,30),(84,'The Book Of Souls',49.99,40),(85,'Iron Maiden',29.99,20),(86,'In Utero',39.99,30),(87,'Nevermind',49.99,40),(88,'Bleach',29.99,20),(89,'We Are Not Your Kind',39.99,30),(90,'All Hope Is Gone',49.99,40),(91,'Slipknot',29.99,20),(92,'Lowa',39.99,30),(93,'Brothers In Arms',49.99,40),(94,'Communiqué',29.99,20),(95,'Love Over Gold',39.99,30),(96,'One every Street',49.99,40),(97,'Sleeve Of Making Movies',29.99,20),(98,'Appetite For Destruction',39.99,30),(99,'G N R Lies - Guns N Roses',49.99,40),(100,'The Spaghetti Incident',29.99,20),(101,'Chinese Democracy',39.99,30),(102,'Use Your Illusion II',49.99,40),(103,'In Through the Out Door',29.99,20),(104,'Coda',39.99,30),(105,'Houses of the Holy',49.99,40),(106,'Physical Graffiti',29.99,20),(107,'Dark Side Of The Moon',39.99,30),(108,'Ummagumma',49.99,40),(109,'The Division Bell',29.99,20),(110,'The Wall',39.99,30),(111,'Wish You Were Here',49.99,40),(112,'A Day At The Races',29.99,20),(113,'A Night At The Opera',39.99,30),(114,'Made In Heaven',49.99,40),(115,'The Miracle',29.99,20),(116,'Rage Against The Machine',39.99,30),(117,'Evil Empire',49.99,40),(118,'Renegades',29.99,20),(119,'Acid Eaters',39.99,30),(120,'Animal Boy',49.99,40),(121,'Halfway to Sanity',29.99,20),(122,'Too Tough to Die',39.99,30);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-14 20:19:17
