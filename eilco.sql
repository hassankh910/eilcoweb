-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: localhost    Database: eilco
-- ------------------------------------------------------
-- Server version	8.0.22

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
-- Table structure for table `cours`
--

DROP TABLE IF EXISTS `cours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cours` (
  `idcours` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abreviation` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prof_id` int NOT NULL,
  `credits` int NOT NULL,
  `formation_id` int NOT NULL,
  PRIMARY KEY (`idcours`),
  KEY `prof_idx` (`prof_id`),
  KEY `classe_cour_idx` (`formation_id`),
  CONSTRAINT `formation_cour` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`idformation`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `prof_cour` FOREIGN KEY (`prof_id`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cours`
--

LOCK TABLES `cours` WRITE;
/*!40000 ALTER TABLE `cours` DISABLE KEYS */;
INSERT INTO `cours` VALUES (8,'Electronique','EC022',6,2,6),(9,'Base de donnee','BDD',6,3,6);
/*!40000 ALTER TABLE `cours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `document` (
  `iddocument` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lien` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cour_id` int NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`iddocument`),
  KEY `cour_document_idx` (`cour_id`),
  CONSTRAINT `cour_document` FOREIGN KEY (`cour_id`) REFERENCES `cours` (`idcours`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document`
--

LOCK TABLES `document` WRITE;
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
INSERT INTO `document` VALUES (38,'01.JPG','01.JPG',8,'2022-01-04 22:34:55'),(39,'Capture.JPG','Capture.JPG',8,'2022-01-05 16:54:52'),(40,'git github.txt','git github.txt',9,'2022-01-05 23:36:06');
/*!40000 ALTER TABLE `document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emploi_du_temps`
--

DROP TABLE IF EXISTS `emploi_du_temps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emploi_du_temps` (
  `idedt` int NOT NULL AUTO_INCREMENT,
  `cour_id` int NOT NULL,
  `startTime` datetime NOT NULL,
  `endTime` datetime NOT NULL,
  PRIMARY KEY (`idedt`),
  KEY `cour_emploi_idx` (`cour_id`),
  CONSTRAINT `cour_emploi` FOREIGN KEY (`cour_id`) REFERENCES `cours` (`idcours`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emploi_du_temps`
--

LOCK TABLES `emploi_du_temps` WRITE;
/*!40000 ALTER TABLE `emploi_du_temps` DISABLE KEYS */;
INSERT INTO `emploi_du_temps` VALUES (1,8,'2022-01-07 08:30:00','2022-01-07 10:15:00'),(2,9,'2022-01-07 10:30:00','2022-01-07 12:15:00');
/*!40000 ALTER TABLE `emploi_du_temps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formation`
--

DROP TABLE IF EXISTS `formation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `formation` (
  `idformation` int NOT NULL AUTO_INCREMENT,
  `nomformation` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idformation`),
  UNIQUE KEY `nomformation_UNIQUE` (`nomformation`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formation`
--

LOCK TABLES `formation` WRITE;
/*!40000 ALTER TABLE `formation` DISABLE KEYS */;
INSERT INTO `formation` VALUES (10,'ing1 gee'),(6,'ing1 info'),(11,'ing2 gee'),(8,'ing2 info'),(12,'ing3 gee'),(9,'ing3 info');
/*!40000 ALTER TABLE `formation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notes` (
  `etudiant_id` int NOT NULL,
  `cours_id` int NOT NULL,
  `note` int NOT NULL,
  KEY `etudiant_idx` (`etudiant_id`),
  KEY `cour_idx` (`cours_id`),
  CONSTRAINT `cour_note` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`idcours`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `etudiant_note` FOREIGN KEY (`etudiant_id`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
INSERT INTO `notes` VALUES (15,8,18),(15,9,15),(15,9,20);
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `presence`
--

DROP TABLE IF EXISTS `presence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `presence` (
  `etudiant_id` int NOT NULL,
  `cours_id` int NOT NULL,
  `status` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `etudiant_idx` (`etudiant_id`),
  KEY `cours_idx` (`cours_id`),
  CONSTRAINT `cour_presence` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`idcours`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `etudiant_presence` FOREIGN KEY (`etudiant_id`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presence`
--

LOCK TABLES `presence` WRITE;
/*!40000 ALTER TABLE `presence` DISABLE KEYS */;
INSERT INTO `presence` VALUES (15,8,'P','2022-01-03 16:48:16');
/*!40000 ALTER TABLE `presence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `iduser` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role` int NOT NULL,
  `date_de_naissance` date NOT NULL,
  `username` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` char(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email_personel` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email_universitaire` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sexe` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `formation_id` int DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `Adresse` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `nationalite` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`iduser`),
  KEY `formation_idx` (`formation_id`),
  CONSTRAINT `formation` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`idformation`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Hassan','Khalife',1,'2000-11-15','Hassankh','Hassankhalife1','hassankhalife','hassankhalife','Male',NULL,'','',''),(6,'hassan','yassin',3,'1996-04-08','hyassin','vF7C4ZEi','hassan@usj.com','hassan.yassin.prof@eilco-ulco.fr','Homme',NULL,'123456789','12 sdsad',''),(15,'hassan','khalife',2,'2000-12-11','hkhalife','Bt7xXMkY','hassankhalife910@gmail.com','hassan.khalife.elv@eilco-ulco.fr','Homme',6,'0613172014','19 rue Massenaappt 4','lebanese'),(16,'notHassan','khalife',2,'2000-11-15','nkhalife','CGT4jb29','hassankhalife2001@icloud.com','notHassan.khalife.elv@eilco-ulco.fr','Homme',6,'0613172014','19 rue massena','lebanese'),(17,'ibrahim','cherri',2,'2000-12-31','icherri','YFyKznwv','hassankhalife910@gmail.com','ibrahim.cherri.elv@eilco-ulco.fr','Homme',8,'0660626328','23 rue de la vendee','ivorian'),(18,'ibrahim','cherri',2,'2000-12-31','icherri','nluk4Glg','hassankhalife910@gmail.com','ibrahim.cherri.elv@eilco-ulco.fr','Homme',8,'0660626328','23 rue de la vendee','ivorian');
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

-- Dump completed on 2022-01-06 16:27:07
