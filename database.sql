-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: NeuroClinic
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Attivita`
--

DROP TABLE IF EXISTS `Attivita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Attivita` (
  `ID` varchar(10) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Descr` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Attivita`
--

LOCK TABLES `Attivita` WRITE;
/*!40000 ALTER TABLE `Attivita` DISABLE KEYS */;
/*!40000 ALTER TABLE `Attivita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Clinico`
--

DROP TABLE IF EXISTS `Clinico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Clinico` (
  `Nome` varchar(30) NOT NULL,
  `Cognome` varchar(30) NOT NULL,
  `Data_Nasc` date NOT NULL,
  `Ruolo` varchar(20) NOT NULL,
  `Specializ` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Username` varchar(20) NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Clinico`
--

LOCK TABLES `Clinico` WRITE;
/*!40000 ALTER TABLE `Clinico` DISABLE KEYS */;
/*!40000 ALTER TABLE `Clinico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Diagnosi`
--

DROP TABLE IF EXISTS `Diagnosi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Diagnosi` (
  `User_Paz` varchar(20) NOT NULL,
  `Data` date DEFAULT NULL,
  `Nome_Dist` varchar(30) NOT NULL,
  PRIMARY KEY (`User_Paz`,`Nome_Dist`),
  KEY `Diagnosi_DistMotorio_FK` (`Nome_Dist`),
  CONSTRAINT `Diagnosi_DistMotorio_FK` FOREIGN KEY (`Nome_Dist`) REFERENCES `DistMotorio` (`Nome`),
  CONSTRAINT `Diagnosi_Paziente_FK` FOREIGN KEY (`User_Paz`) REFERENCES `Paziente` (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Diagnosi`
--

LOCK TABLES `Diagnosi` WRITE;
/*!40000 ALTER TABLE `Diagnosi` DISABLE KEYS */;
/*!40000 ALTER TABLE `Diagnosi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DistMotorio`
--

DROP TABLE IF EXISTS `DistMotorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DistMotorio` (
  `Nome` varchar(30) NOT NULL,
  `Categ` varchar(30) DEFAULT NULL,
  `Grav` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DistMotorio`
--

LOCK TABLES `DistMotorio` WRITE;
/*!40000 ALTER TABLE `DistMotorio` DISABLE KEYS */;
/*!40000 ALTER TABLE `DistMotorio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Episodio`
--

DROP TABLE IF EXISTS `Episodio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Episodio` (
  `ID` varchar(10) NOT NULL,
  `Data` date NOT NULL,
  `Ora` time NOT NULL,
  `Durata` int(10) unsigned NOT NULL,
  `Intensita` int(10) unsigned NOT NULL,
  `User_Paz` varchar(20) NOT NULL,
  `Nome_Dist` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Episodio_Paziente_FK` (`User_Paz`),
  KEY `Episodio_DistMotorio_FK` (`Nome_Dist`),
  CONSTRAINT `Episodio_DistMotorio_FK` FOREIGN KEY (`Nome_Dist`) REFERENCES `DistMotorio` (`Nome`),
  CONSTRAINT `Episodio_Paziente_FK` FOREIGN KEY (`User_Paz`) REFERENCES `Paziente` (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Episodio`
--

LOCK TABLES `Episodio` WRITE;
/*!40000 ALTER TABLE `Episodio` DISABLE KEYS */;
/*!40000 ALTER TABLE `Episodio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Farmaco`
--

DROP TABLE IF EXISTS `Farmaco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Farmaco` (
  `ID` varchar(10) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Descr` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Farmaco`
--

LOCK TABLES `Farmaco` WRITE;
/*!40000 ALTER TABLE `Farmaco` DISABLE KEYS */;
/*!40000 ALTER TABLE `Farmaco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Messaggio`
--

DROP TABLE IF EXISTS `Messaggio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Messaggio` (
  `ID` varchar(10) NOT NULL,
  `Data` date NOT NULL,
  `Ora` time NOT NULL,
  `Conten` varchar(300) NOT NULL,
  `User_Clin` varchar(20) NOT NULL,
  `User_Paz` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Messaggio_Paziente_FK` (`User_Paz`),
  KEY `Messaggio_Clinico_FK` (`User_Clin`),
  CONSTRAINT `Messaggio_Clinico_FK` FOREIGN KEY (`User_Clin`) REFERENCES `Clinico` (`Username`),
  CONSTRAINT `Messaggio_Paziente_FK` FOREIGN KEY (`User_Paz`) REFERENCES `Paziente` (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Messaggio`
--

LOCK TABLES `Messaggio` WRITE;
/*!40000 ALTER TABLE `Messaggio` DISABLE KEYS */;
/*!40000 ALTER TABLE `Messaggio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Paziente`
--

DROP TABLE IF EXISTS `Paziente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Paziente` (
  `Username` varchar(20) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Cognome` varchar(30) NOT NULL,
  `Data_Nasc` date NOT NULL,
  `Genere` varchar(1) NOT NULL,
  `Via` varchar(30) NOT NULL,
  `Civico` int(10) unsigned NOT NULL,
  `Citta` varchar(20) NOT NULL,
  `Provincia` varchar(2) NOT NULL,
  `Tel` varchar(12) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `User_Clin` varchar(20) NOT NULL,
  PRIMARY KEY (`Username`),
  KEY `Paziente_Clinico_FK` (`User_Clin`),
  CONSTRAINT `Paziente_Clinico_FK` FOREIGN KEY (`User_Clin`) REFERENCES `Clinico` (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Paziente`
--

LOCK TABLES `Paziente` WRITE;
/*!40000 ALTER TABLE `Paziente` DISABLE KEYS */;
/*!40000 ALTER TABLE `Paziente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pianificazione`
--

DROP TABLE IF EXISTS `Pianificazione`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pianificazione` (
  `Freq` varchar(100) DEFAULT NULL,
  `ID_Ter` varchar(10) NOT NULL,
  `ID_Att` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Ter`,`ID_Att`),
  KEY `Pianificazione_Attivita_FK` (`ID_Att`),
  CONSTRAINT `Pianificazione_Attivita_FK` FOREIGN KEY (`ID_Att`) REFERENCES `Attivita` (`ID`),
  CONSTRAINT `Pianificazione_Terapia_FK` FOREIGN KEY (`ID_Ter`) REFERENCES `Terapia` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pianificazione`
--

LOCK TABLES `Pianificazione` WRITE;
/*!40000 ALTER TABLE `Pianificazione` DISABLE KEYS */;
/*!40000 ALTER TABLE `Pianificazione` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Prescrizione`
--

DROP TABLE IF EXISTS `Prescrizione`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Prescrizione` (
  `ID_Farm` varchar(10) NOT NULL,
  `ID_Ter` varchar(10) NOT NULL,
  `Freq` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_Farm`,`ID_Ter`),
  KEY `Prescrizione_Terapia_FK` (`ID_Ter`),
  CONSTRAINT `Prescrizione_Farmaco_FK` FOREIGN KEY (`ID_Farm`) REFERENCES `Farmaco` (`ID`),
  CONSTRAINT `Prescrizione_Terapia_FK` FOREIGN KEY (`ID_Ter`) REFERENCES `Terapia` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Prescrizione`
--

LOCK TABLES `Prescrizione` WRITE;
/*!40000 ALTER TABLE `Prescrizione` DISABLE KEYS */;
/*!40000 ALTER TABLE `Prescrizione` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Terapia`
--

DROP TABLE IF EXISTS `Terapia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Terapia` (
  `ID` varchar(10) NOT NULL,
  `Data` date NOT NULL,
  `User_Paz` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Terapia_Paziente_FK` (`User_Paz`),
  CONSTRAINT `Terapia_Paziente_FK` FOREIGN KEY (`User_Paz`) REFERENCES `Paziente` (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Terapia`
--

LOCK TABLES `Terapia` WRITE;
/*!40000 ALTER TABLE `Terapia` DISABLE KEYS */;
/*!40000 ALTER TABLE `Terapia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'NeuroClinic'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-30 15:36:23
