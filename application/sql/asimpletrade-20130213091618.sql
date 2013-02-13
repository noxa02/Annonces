-- MySQL dump 10.13  Distrib 5.5.25, for osx10.6 (i386)
--
-- Host: localhost    Database: asimpletrade
-- ------------------------------------------------------
-- Server version	5.5.25

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
-- Table structure for table `ANNOUNCEMENT`
--

DROP TABLE IF EXISTS `ANNOUNCEMENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ANNOUNCEMENT` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL,
  `subtitle` varchar(80) DEFAULT NULL,
  `content` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `conclued` tinyint(1) NOT NULL DEFAULT '0',
  `type` enum('Service','Logement','Objet') NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `ANNOUNCEMENT_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `USER` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ANNOUNCEMENT`
--

LOCK TABLES `ANNOUNCEMENT` WRITE;
/*!40000 ALTER TABLE `ANNOUNCEMENT` DISABLE KEYS */;
INSERT INTO `ANNOUNCEMENT` VALUES (121,'ODQFJK !','qdqsflqkfq !','dkjfqdjkflksqjfsq !!!','2013-02-12 22:28:21',0,'Service',1),(122,'Ma super annonce','Mon super sous titre','Ma super description','2013-02-12 23:04:56',0,'Service',1),(123,'Ma deuxième super annonce','Ma deuxième super annonce','Ma deuxième super annonce','2013-02-12 23:51:28',0,'Service',1),(124,'Ma troisième super annonce','Ma troisième super annonce','Ma troisième super annonce','2013-02-12 23:54:45',0,'Service',1),(125,'Ma nouvelle annonce','Mon nouveau sous titre','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin quis orci ac eros convallis tempor. Nam quis sodales eros. Suspendisse sapien mi, cursus venenatis lobortis nec, tristique at metus. Donec ultrices mollis lobortis. Pellentesque scelerisque rhoncus neque, in scelerisque mauris tempus sed. Aliquam eu ligula id leo egestas viverra. Nullam sodales consequat elit ut pellentesque. Sed aliquam libero vitae leo blandit laoreet. Donec tellus nunc, rutrum vitae blandit sed, euismod sed odio. Vestibulum eget sem id libero varius congue ac a nisl.','2013-02-13 00:03:28',0,'Objet',1);
/*!40000 ALTER TABLE `ANNOUNCEMENT` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER DELETE_ON_ANNOUNCEMENT
  BEFORE DELETE ON ANNOUNCEMENT
    FOR EACH ROW 
      BEGIN

      SELECT COUNT(id_announcement) INTO @countAnnouncementTA FROM TO_ASSOCIATE
      WHERE id_announcement  = old.id;

      SELECT COUNT(id) INTO @countComment FROM COMMENT
      WHERE id_announcement  = old.id;

      SELECT COUNT(id_announcement) INTO @countAnnouncementTAP FROM TO_APPLY
      WHERE id_announcement  = old.id;

      SELECT COUNT(id_announcement) INTO @countAnnouncementTE FROM TO_EVALUATE
      WHERE id_announcement  = old.id;

      IF @countAnnouncementTA > 0
        THEN 
          DELETE FROM TO_ASSOCIATE WHERE id_announcement = old.id;
      END IF;   

      IF @countComment > 0
        THEN 
          DELETE FROM COMMENT WHERE id_announcement = old.id;
      END IF;  

      IF @countAnnouncementTAP > 0
        THEN 
          DELETE FROM TO_APPLY WHERE id_announcement = old.id;
      END IF; 

      IF @countAnnouncementTE > 0
        THEN 
          DELETE FROM TO_EVALUATE WHERE id_announcement = old.id;
      END IF; 
      END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `COMMENT`
--

DROP TABLE IF EXISTS `COMMENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COMMENT` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  `id_announcement` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_announcement` (`id_announcement`),
  CONSTRAINT `COMMENT_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `USER` (`id`),
  CONSTRAINT `COMMENT_ibfk_2` FOREIGN KEY (`id_announcement`) REFERENCES `ANNOUNCEMENT` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COMMENT`
--

LOCK TABLES `COMMENT` WRITE;
/*!40000 ALTER TABLE `COMMENT` DISABLE KEYS */;
INSERT INTO `COMMENT` VALUES (60,'qsfqfsfsqfs','2013-02-12 23:47:56',1,122),(61,'Yeah !','2013-02-12 23:59:20',1,121),(62,'Super cette annonce, je postule !','2013-02-13 00:04:47',1,125),(63,'Youhou !','2013-02-13 01:07:12',25,121);
/*!40000 ALTER TABLE `COMMENT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `INCOMING`
--

DROP TABLE IF EXISTS `INCOMING`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `INCOMING` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL,
  `subtitle` varchar(80) DEFAULT NULL,
  `content` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `INCOMING_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `USER` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `INCOMING`
--

LOCK TABLES `INCOMING` WRITE;
/*!40000 ALTER TABLE `INCOMING` DISABLE KEYS */;
INSERT INTO `INCOMING` VALUES (2,'Une news','Un sous titre de news','Un contenu de news','2012-12-17 10:19:30',4);
/*!40000 ALTER TABLE `INCOMING` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MESSAGE`
--

DROP TABLE IF EXISTS `MESSAGE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MESSAGE` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(80) NOT NULL,
  `content` text NOT NULL,
  `date_post` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_sender` int(11) NOT NULL,
  `id_receiver` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sender` (`id_sender`),
  KEY `id_receiver` (`id_receiver`),
  CONSTRAINT `MESSAGE_ibfk_1` FOREIGN KEY (`id_sender`) REFERENCES `USER` (`id`),
  CONSTRAINT `MESSAGE_ibfk_2` FOREIGN KEY (`id_receiver`) REFERENCES `USER` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MESSAGE`
--

LOCK TABLES `MESSAGE` WRITE;
/*!40000 ALTER TABLE `MESSAGE` DISABLE KEYS */;
INSERT INTO `MESSAGE` VALUES (4,'Un Sujet','Un contenu ','2012-12-10 01:00:24',1,4),(5,'','Le contenu','2012-12-15 15:58:25',1,6),(6,'Un sujet','Le contenu','2012-12-15 16:01:50',1,6),(7,'Un sujet','Le contenu','2012-12-15 16:06:03',1,6),(10,'Un sujet','Un contenu','2012-12-15 16:41:29',1,7),(11,'Un sujetz','Le contenu','2012-12-16 12:13:10',1,7),(13,'Un sujet','Un contenu de message','2012-12-18 10:04:09',1,5),(14,'Un sujet','Un contenu de message','2012-12-18 10:04:24',1,5),(15,'Un sujet','Un contenu','2013-01-12 14:42:54',1,6),(16,'Un sujet','Un contenu','2013-01-12 14:43:09',1,6),(17,'Un sujet','Un contenu','2013-01-12 14:51:21',1,6),(18,'Un sujet','Un contenu','2013-01-12 14:51:30',1,6);
/*!40000 ALTER TABLE `MESSAGE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PICTURE`
--

DROP TABLE IF EXISTS `PICTURE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PICTURE` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(80) DEFAULT NULL,
  `alternative` varchar(80) DEFAULT NULL,
  `path` varchar(180) NOT NULL,
  `extension` varchar(20) NOT NULL,
  `width` int(10) NOT NULL,
  `height` int(10) NOT NULL,
  `id_announcement` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_announcement` (`id_announcement`),
  CONSTRAINT `PICTURE_ibfk_1` FOREIGN KEY (`id_announcement`) REFERENCES `ANNOUNCEMENT` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PICTURE`
--

LOCK TABLES `PICTURE` WRITE;
/*!40000 ALTER TABLE `PICTURE` DISABLE KEYS */;
INSERT INTO `PICTURE` VALUES (174,'511ac205a1413',NULL,'/announcement/original/','png',256,256,121),(175,'511ac205a1462',NULL,'/announcement/original/','png',256,256,121),(176,'511ac205a14a9',NULL,'/announcement/original/','png',256,256,121),(177,'511ac205a14f0',NULL,'/announcement/original/','png',256,256,121),(178,'511ac205a1413',NULL,'/announcement/800x600/','png',800,600,121),(179,'511ac205a1462',NULL,'/announcement/260x80/','png',260,80,121),(180,'511ac205a14a9',NULL,'/announcement/260x80/','png',260,80,121),(181,'511ac205a14f0',NULL,'/announcement/260x80/','png',260,80,121),(183,'511aca988b2f5',NULL,'/announcement/original/','jpeg',2560,1600,122),(184,'511aca988b341',NULL,'/announcement/original/','jpeg',2560,1600,122),(185,'511aca988b2f5',NULL,'/announcement/260x80/','jpeg',260,80,122),(186,'511aca988b341',NULL,'/announcement/260x80/','jpeg',260,80,122),(187,'511aca988b2f5',NULL,'/announcement/800x600/','jpeg',800,600,122),(188,'511ad5814c642',NULL,'/announcement/original/','jpeg',1024,768,123),(189,'511ad5814c6a1',NULL,'/announcement/original/','jpeg',3200,2000,123),(190,'511ad5814c6f4',NULL,'/announcement/original/','jpeg',3200,2000,123),(191,'511ad5815259d',NULL,'/announcement/original/','jpeg',3200,2000,123),(192,'511ad5815c829',NULL,'/announcement/original/','jpeg',3200,2000,123),(193,'511ad5814c642',NULL,'/announcement/800x600/','jpeg',800,600,123),(194,'511ad645d03eb',NULL,'/announcement/original/','jpeg',3200,2000,124),(195,'511ad645d04a1',NULL,'/announcement/original/','jpeg',3200,2000,124),(196,'511ad645d0506',NULL,'/announcement/original/','jpeg',1600,1024,124),(197,'511ad645d0506',NULL,'/announcement/260x80/','jpeg',260,80,124),(198,'511ad850c15cb',NULL,'/announcement/original/','jpeg',3200,2000,125),(199,'511ad850c1620',NULL,'/announcement/original/','jpeg',2560,1600,125),(200,'511ad850c1669',NULL,'/announcement/original/','jpeg',2560,1600,125),(201,'511ad850c16b8',NULL,'/announcement/original/','jpeg',3200,2000,125),(202,'511ad850c1620',NULL,'/announcement/260x80/','jpeg',260,80,125),(203,'511ad850c1669',NULL,'/announcement/260x80/','jpeg',260,80,125);
/*!40000 ALTER TABLE `PICTURE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TAG`
--

DROP TABLE IF EXISTS `TAG`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TAG` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TAG`
--

LOCK TABLES `TAG` WRITE;
/*!40000 ALTER TABLE `TAG` DISABLE KEYS */;
INSERT INTO `TAG` VALUES (1,'Voyage'),(2,'Jardinerie'),(3,'Social'),(4,'Bricolage'),(7,'ededez');
/*!40000 ALTER TABLE `TAG` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TO_APPLY`
--

DROP TABLE IF EXISTS `TO_APPLY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TO_APPLY` (
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL,
  `id_announcement` int(11) NOT NULL,
  KEY `id_user` (`id_user`),
  KEY `id_announcement` (`id_announcement`),
  CONSTRAINT `TO_APPLY_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `USER` (`id`),
  CONSTRAINT `TO_APPLY_ibfk_2` FOREIGN KEY (`id_announcement`) REFERENCES `ANNOUNCEMENT` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TO_APPLY`
--

LOCK TABLES `TO_APPLY` WRITE;
/*!40000 ALTER TABLE `TO_APPLY` DISABLE KEYS */;
/*!40000 ALTER TABLE `TO_APPLY` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TO_ASSOCIATE`
--

DROP TABLE IF EXISTS `TO_ASSOCIATE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TO_ASSOCIATE` (
  `id_announcement` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL,
  KEY `id_announcement` (`id_announcement`),
  KEY `id_tag` (`id_tag`),
  CONSTRAINT `TO_ASSOCIATE_ibfk_1` FOREIGN KEY (`id_announcement`) REFERENCES `ANNOUNCEMENT` (`id`),
  CONSTRAINT `TO_ASSOCIATE_ibfk_2` FOREIGN KEY (`id_tag`) REFERENCES `TAG` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TO_ASSOCIATE`
--

LOCK TABLES `TO_ASSOCIATE` WRITE;
/*!40000 ALTER TABLE `TO_ASSOCIATE` DISABLE KEYS */;
/*!40000 ALTER TABLE `TO_ASSOCIATE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TO_EVALUATE`
--

DROP TABLE IF EXISTS `TO_EVALUATE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TO_EVALUATE` (
  `id_user` int(11) NOT NULL,
  `id_announcement` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  KEY `id_user` (`id_user`),
  KEY `id_announcement` (`id_announcement`),
  CONSTRAINT `TO_EVALUATE_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `USER` (`id`),
  CONSTRAINT `TO_EVALUATE_ibfk_2` FOREIGN KEY (`id_announcement`) REFERENCES `ANNOUNCEMENT` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TO_EVALUATE`
--

LOCK TABLES `TO_EVALUATE` WRITE;
/*!40000 ALTER TABLE `TO_EVALUATE` DISABLE KEYS */;
/*!40000 ALTER TABLE `TO_EVALUATE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TO_FOLLOW`
--

DROP TABLE IF EXISTS `TO_FOLLOW`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TO_FOLLOW` (
  `id_user_followed` int(11) NOT NULL,
  `id_user_follower` int(11) NOT NULL,
  KEY `id_user_followed` (`id_user_followed`),
  KEY `id_user_follower` (`id_user_follower`),
  CONSTRAINT `TO_FOLLOW_ibfk_1` FOREIGN KEY (`id_user_followed`) REFERENCES `USER` (`id`),
  CONSTRAINT `TO_FOLLOW_ibfk_2` FOREIGN KEY (`id_user_follower`) REFERENCES `USER` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TO_FOLLOW`
--

LOCK TABLES `TO_FOLLOW` WRITE;
/*!40000 ALTER TABLE `TO_FOLLOW` DISABLE KEYS */;
INSERT INTO `TO_FOLLOW` VALUES (1,5),(6,4),(1,7),(1,4),(4,1),(5,1);
/*!40000 ALTER TABLE `TO_FOLLOW` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `USER`
--

DROP TABLE IF EXISTS `USER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `login` varchar(40) NOT NULL,
  `password` varchar(180) NOT NULL,
  `mail` varchar(80) NOT NULL,
  `address` varchar(120) NOT NULL,
  `city` varchar(40) NOT NULL,
  `zipcode` int(5) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `portable` varchar(30) NOT NULL,
  `subscription_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `newsletter` tinyint(1) NOT NULL DEFAULT '0',
  `role` enum('administrator','user') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `USER`
--

LOCK TABLES `USER` WRITE;
/*!40000 ALTER TABLE `USER` DISABLE KEYS */;
INSERT INTO `USER` VALUES (1,'Time','Jimmi','noxa02','efcdac01c2c702aa9f29e9b2f0d6fcf2faa82f8c','Masson.Xavier.91@gmail.com','3 rue meissonnier','',0,'0169486412','0676564534','2012-11-26 09:29:37',1,'administrator'),(3,'Time','Masson','noxa03','efcdac01c2c702aa9f29e9b2f0d6fcf2faa82f8c','xavier.masson@fidesio.com','12 rue pommier','',0,'0134563864','0612325434','2012-11-27 07:39:00',1,'administrator'),(4,'Time','Caroline','kimitsu','efcdac01c2c702aa9f29e9b2f0d6fcf2faa82f8c','Caroline.Chea90@gmail.com','12 rue pommier','',0,'0134563864','0612325434','2012-11-27 07:39:00',1,'user'),(5,'Time','Henri','Ritooon','efcdac01c2c702aa9f29e9b2f0d6fcf2faa82f8c','Vignaux.Henri@gmail.com','14 rue pommier','',0,'0134563864','0612325434','2012-11-27 07:39:00',1,'administrator'),(6,'Time','Jimmy','noxa07','efcdac01c2c702aa9f29e9b2f0d6fcf2faa82f8c','Masson.Xavier.91@gmail.com','3 rue meissonnier','',0,'0169486412','0676564534','0000-00-00 00:00:00',1,'administrator'),(7,'Time','Jimmy','noxa08','efcdac01c2c702aa9f29e9b2f0d6fcf2faa82f8c','Masson.Xavier.91@gmail.com','3 rue meissonnier','',0,'0169486412','0676564534','2012-12-02 16:22:16',1,'administrator'),(8,'Time','Jimmy','noxa09','efcdac01c2c702aa9f29e9b2f0d6fcf2faa82f8c','Masson.Xavier.91@gmail.com','3 rue meissonnier','',0,'0169486412','0676564534','2012-12-02 19:23:14',1,'administrator'),(16,'Tim','James','noxa093','efcdac01c2c702aa9f29e9b2f0d6fcf2faa82f8c','xavier.masson@fidesio.com','3 rue meissonnier','',0,'0187557986','0676534572','2012-12-17 08:24:52',1,'user'),(17,'Tim','James','noxa0989','efcdac01c2c702aa9f29e9b2f0d6fcf2faa82f8c','xavier.masson@fidesio.com','3 rue meissonnier','',0,'0187557986','0676534572','2012-12-22 17:39:48',0,'user'),(18,'jimmy','','','efcdac01c2c702aa9f29e9b2f0d6fcf2faa82f8c','','','',0,'','','2012-12-24 18:23:09',0,'administrator'),(19,'Paolo','Paul','Paolo123','efcdac01c2c702aa9f29e9b2f0d6fcf2faa82f8c','paolo@gmail.com','23 square des braises','',0,'0113434523','0613543643','2013-01-14 10:48:53',0,'user'),(21,'Masson','Bertrand','BertrandMasson','efcdac01c2c702aa9f29e9b2f0d6fcf2faa82f8c','MassonBerty@aol.com','3 rue meissonnier','',0,'0145356412','0624564321','2013-01-15 11:48:34',0,'user'),(22,'Masson','Isabelle','isa91','b279fa6a4d9353c88fcad50885fce3ded918c9fe','Isabelle.Masson@fai.com','12 rue des cerisier','Yerres',91330,'0167343287','0613832642','2013-01-28 20:37:36',0,'administrator'),(23,'','','anonym','d933277932aed08370db895ed16a5d58f3d8dfdc','','','',0,'','','2013-01-29 18:21:43',0,'user'),(24,'Masson','Xavier','johnny28','efcdac01c2c702aa9f29e9b2f0d6fcf2faa82f8c','aze@hotmail.fr','3 rue meissonnier','Montgeron',91330,'0169485423','0624736853','2013-02-02 17:57:32',0,'user'),(25,'Vignaux','Henri','Ritoon','b221d3c81b02bbcd8938f3df60616b6178e6f8c3','Vignaux.Henri@gmail.com','16 rue des sapins','Villeneuve-Saint-George',91458,'0153090898','0632984975','2013-02-13 00:09:03',0,'user');
/*!40000 ALTER TABLE `USER` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-02-13  9:16:21
