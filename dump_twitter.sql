-- MySQL dump 10.13  Distrib 5.7.30, for Linux (x86_64)
--
-- Host: localhost    Database: twitter
-- ------------------------------------------------------
-- Server version	5.7.30-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20200701173257','2020-07-01 19:33:27',3893),('DoctrineMigrations\\Version20200701200024','2020-07-01 22:00:35',4232);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hash_tag`
--

DROP TABLE IF EXISTS `hash_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hash_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hash_tag`
--

LOCK TABLES `hash_tag` WRITE;
/*!40000 ALTER TABLE `hash_tag` DISABLE KEYS */;
INSERT INTO `hash_tag` VALUES (1,'#hashtag'),(2,'#multiHash'),(3,'#test'),(4,'#42'),(5,'#notag'),(6,'#milliers');
/*!40000 ALTER TABLE `hash_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tweet`
--

DROP TABLE IF EXISTS `tweet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tweet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tweet`
--

LOCK TABLES `tweet` WRITE;
/*!40000 ALTER TABLE `tweet` DISABLE KEYS */;
INSERT INTO `tweet` VALUES (1,'loic','test ajout texte et #hashtag ou #multiHash','2020-07-01 22:01:12'),(2,'loic','ajout texte et #hashtag ou #multiHash','2020-07-01 23:47:59'),(3,'loic',' #hashtag ou #multiHash','2020-07-01 23:48:06'),(4,'loic','test 45','2020-07-01 23:48:13'),(5,'loic','test 45  #test','2020-07-01 23:48:19'),(6,'loic','test 45  #test #42','2020-07-01 23:48:56'),(7,'test','#test ajout','2020-07-01 23:49:02'),(8,'test','pas de tag','2020-07-01 23:49:45'),(9,'milliers','pas de tag','2020-07-01 23:50:01'),(10,'milliers','#notag','2020-07-01 23:50:32'),(11,'milliers','#notag #milliers','2020-07-01 23:50:48'),(12,'milliers','first millier','2020-07-02 00:04:56'),(13,'milliers','first millier #milliers','2020-07-02 00:05:05'),(14,'milliers','second millier #milliers','2020-07-02 00:05:12'),(15,'milliers','third millier #milliers','2020-07-02 00:05:17'),(16,'milliers','quatrieme millier #milliers','2020-07-02 00:05:23'),(17,'milliers','5 millier #milliers','2020-07-02 00:05:28'),(18,'milliers','56 millier #milliers','2020-07-02 00:05:31'),(19,'milliers','567 millier #milliers','2020-07-02 00:05:35'),(20,'milliers','5678 millier #milliers','2020-07-02 00:05:38'),(21,'milliers','9 millier #milliers','2020-07-02 00:05:42'),(22,'milliers','910 millier #milliers','2020-07-02 00:05:46'),(23,'milliers','910 millier #milliers 11','2020-07-02 00:05:51');
/*!40000 ALTER TABLE `tweet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tweet_hash_tag`
--

DROP TABLE IF EXISTS `tweet_hash_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tweet_hash_tag` (
  `tweet_id` int(11) NOT NULL,
  `hash_tag_id` int(11) NOT NULL,
  PRIMARY KEY (`tweet_id`,`hash_tag_id`),
  KEY `IDX_43597BBB1041E39B` (`tweet_id`),
  KEY `IDX_43597BBBAB18B62D` (`hash_tag_id`),
  CONSTRAINT `FK_43597BBB1041E39B` FOREIGN KEY (`tweet_id`) REFERENCES `tweet` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_43597BBBAB18B62D` FOREIGN KEY (`hash_tag_id`) REFERENCES `hash_tag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tweet_hash_tag`
--

LOCK TABLES `tweet_hash_tag` WRITE;
/*!40000 ALTER TABLE `tweet_hash_tag` DISABLE KEYS */;
INSERT INTO `tweet_hash_tag` VALUES (1,1),(1,2),(2,1),(2,2),(3,1),(3,2),(5,3),(6,3),(6,4),(7,3),(10,5),(11,5),(11,6),(13,6),(14,6),(15,6),(16,6),(17,6),(18,6),(19,6),(20,6),(21,6),(22,6),(23,6);
/*!40000 ALTER TABLE `tweet_hash_tag` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-02  0:08:50
