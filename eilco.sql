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
  CONSTRAINT `formation_cour` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`idformation`),
  CONSTRAINT `prof_cour` FOREIGN KEY (`prof_id`) REFERENCES `users` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cours`
--

LOCK TABLES `cours` WRITE;
/*!40000 ALTER TABLE `cours` DISABLE KEYS */;
INSERT INTO `cours` VALUES (1,'Electronique','E201',6,3,3),(2,'Analyse','AN21',7,3,4),(3,'Programmation','PG001',13,3,3),(4,'informatique industriel','II201',13,2,3),(5,'droit','D202',7,1,3);
/*!40000 ALTER TABLE `cours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `document` (
  `iddocument` int NOT NULL,
  `nom` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lien` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cour_id` int NOT NULL,
  PRIMARY KEY (`iddocument`),
  KEY `cour_document_idx` (`cour_id`),
  CONSTRAINT `cour_document` FOREIGN KEY (`cour_id`) REFERENCES `cours` (`idcours`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document`
--

LOCK TABLES `document` WRITE;
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
/*!40000 ALTER TABLE `document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emploi_du_temps`
--

DROP TABLE IF EXISTS `emploi_du_temps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emploi_du_temps` (
  `cour_id` int NOT NULL,
  `date` date NOT NULL,
  `heurs` time NOT NULL,
  KEY `cour_emploi_idx` (`cour_id`),
  CONSTRAINT `cour_emploi` FOREIGN KEY (`cour_id`) REFERENCES `cours` (`idcours`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emploi_du_temps`
--

LOCK TABLES `emploi_du_temps` WRITE;
/*!40000 ALTER TABLE `emploi_du_temps` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formation`
--

LOCK TABLES `formation` WRITE;
/*!40000 ALTER TABLE `formation` DISABLE KEYS */;
INSERT INTO `formation` VALUES (1,'cp1'),(2,'cp2'),(3,'ing1'),(6,'ing1 info'),(4,'ing2'),(5,'ing3');
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
  CONSTRAINT `cour_note` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`idcours`),
  CONSTRAINT `etudiant_note` FOREIGN KEY (`etudiant_id`) REFERENCES `users` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
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
  `status` tinyint NOT NULL,
  KEY `etudiant_idx` (`etudiant_id`),
  KEY `cours_idx` (`cours_id`),
  CONSTRAINT `cour_presence` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`idcours`),
  CONSTRAINT `etudiant_presence` FOREIGN KEY (`etudiant_id`) REFERENCES `users` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presence`
--

LOCK TABLES `presence` WRITE;
/*!40000 ALTER TABLE `presence` DISABLE KEYS */;
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
  CONSTRAINT `formation` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`idformation`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Hassan','Khalife',1,'2000-11-15','Hassankh','Hassankhalife1','hassankhalife','hassankhalife','Male',NULL,'','',''),(2,'hassan','khalife',2,'2000-11-15','hassanstudent','hassankhalife1','hassankhalife','hassankhalife','Male',NULL,'','',''),(4,'sdfds','dasfds',2,'2021-12-01','sdasfds','SDDA2021-12-01','dsfsd@gmail.com','sdfds.dasfds.elv@eilco-ulco.fr','Femme',3,'123123123','123sdfsd',''),(5,'mostafa','yousef',2,'2000-08-26','myousef','V2qLKmCf','mostafa@gmail.com','mostafa.yousef.elv@eilco-ulco.fr','Homme',3,'123456789098','123dsfdsf',''),(6,'hassan','yassin',3,'1996-04-08','hyassin','vF7C4ZEi','hassan@usj.com','hassan.yassin.elv@eilco-ulco.fr','Homme',NULL,'123456789','12 sdsad',''),(7,'asdds','sdasd',3,'1987-12-23','asdasd','sxbnOu3Z','sadas@husadh.com','asdds.sdasd.elv@eilco-ulco.fr','Femme',NULL,'321424324','123dsfdsf',''),(10,'mostafa','yousef',2,'2000-02-06','myousef','TjTnxIYY','mostafa@gmail.com','mostafa.yousef.elv@eilco-ulco.fr','Homme',5,'1234567890','123dsfg',''),(11,'mohamed','atwi',2,'2000-12-20','matwi','PC2SQU7c','atwimohamed1020@gmail.com','mohamed.atwi.elv@eilco-ulco.fr','Homme',6,'0666566787','19 rue massenaappt 5','lebanese'),(12,'fdgfdg','dfgfdg',2,'2021-12-01','fdfgfdg','lg1iMeG7','bnfgnhgf@dgfhfg.com','fdgfdg.dfgfdg.elv@eilco-ulco.fr','Homme',2,'214234535','34vbcvnbbn','bangladeshi'),(13,'xcvbcxb','asdffds',3,'2021-12-13','xasdffds','qAasU5tO','sdfwdef@dsf.com','xcvbcxb.asdffds.elv@eilco-ulco.fr','Femme',NULL,'324324324','erew23cvd','bangladeshi');
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

-- Dump completed on 2021-12-31 14:42:40
