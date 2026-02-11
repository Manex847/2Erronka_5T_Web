-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
--
-- Host: localhost    Database: bigarrenerronka
-- ------------------------------------------------------
-- Server version	9.5.0

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
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ '354112ae-f5d5-11f0-8bc6-0a0027000002:1-254';

--
-- Table structure for table `bezeroak`
--

DROP TABLE IF EXISTS `bezeroak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bezeroak` (
  `id` int NOT NULL AUTO_INCREMENT,
  `helbidea` varchar(100) NOT NULL,
  `telefonoa` varchar(100) NOT NULL,
  `izena` varchar(30) NOT NULL,
  `abizenak` varchar(100) NOT NULL,
  `nan` char(9) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pasahitza` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nan_UNIQUE` (`nan`),
  UNIQUE KEY `telefonoa_UNIQUE` (`telefonoa`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bezeroak`
--

LOCK TABLES `bezeroak` WRITE;
/*!40000 ALTER TABLE `bezeroak` DISABLE KEYS */;
INSERT INTO `bezeroak` VALUES (1,'Autonomia kalea 14, Bilbo','600111222','Jon','Etxeberria Lasa','12345678A','jon.etxeberria@gmail.com','jon1234'),(2,'Gasteiz etorbidea 102, Gasteiz','611222333','Ane','Gonzalez Perez','23456789B','ane.gonzalez@hotmail.com','ane1234'),(3,'Kale Nagusia 7, Iruñea','622333444','Unai','Martinez Ruiz','34567890C','unai.martinez@yahoo.es','unai1234'),(4,'San Martin kalea 55, Donostia','633444555','Maialen','Lopez Ibarra','45678901D','maialen.lopez@gmail.com','maialen1234'),(5,'Gran Via kalea 88, Madril','644555666','Iker','Fernandez Ochoa','56789012E','iker.fernandez@outlook.com','iker1234'),(6,'Diagonal etorbidea 250, Bartzelona','655666777','Leire','Sanchez Moreno','67890123F','leire.sanchez@gmail.com','leire1234'),(7,'Estafeta kalea 9, Iruñea','666777888','Asier','Perez Mendieta','78901234G','asier.perez@hotmail.com','asier1234'),(8,'Ledesma kalea 21, Bilbo','677888999','Nerea','Alonso Aguirre','89012345H','nerea.alonso@yahoo.es','nerea1234'),(9,'Independentzia kalea 40, Zaragoza','688999000','Aitor','Hernandez Salazar','90123456J','aitor.hdz@gmail.com','aitor1234'),(10,'Bidebarrieta kalea 3, Bilbo','699000111','Miren','Ruiz Arana','01234567K','miren.ruiz@protonmail.com','miren1234');
/*!40000 ALTER TABLE `bezeroak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eskaera_produktuak`
--

DROP TABLE IF EXISTS `eskaera_produktuak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eskaera_produktuak` (
  `id` int NOT NULL AUTO_INCREMENT,
  `eskaera_id` int NOT NULL,
  `produktu_id` int NOT NULL,
  `kantitatea` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eskaera_produktuak`
--

LOCK TABLES `eskaera_produktuak` WRITE;
/*!40000 ALTER TABLE `eskaera_produktuak` DISABLE KEYS */;
INSERT INTO `eskaera_produktuak` VALUES (17,1,1,1),(18,1,1,1);
/*!40000 ALTER TABLE `eskaera_produktuak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eskaerak`
--

DROP TABLE IF EXISTS `eskaerak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eskaerak` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bezero_id` int NOT NULL,
  `data` char(10) NOT NULL,
  `prezioa` decimal(15,0) NOT NULL,
  `bezero_izena` varchar(100) NOT NULL,
  `produktu_izena` varchar(100) NOT NULL,
  `faktura_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_eskaerak_bezero_izena_bezeroak` (`bezero_izena`),
  KEY `fk_eskaerak_id_bezero_idx` (`bezero_id`),
  KEY `fk_eskaerak_id_faktura_idx` (`faktura_id`),
  CONSTRAINT `fk_eskaerak_id_bezero` FOREIGN KEY (`bezero_id`) REFERENCES `bezeroak` (`id`),
  CONSTRAINT `fk_eskaerak_id_faktura` FOREIGN KEY (`faktura_id`) REFERENCES `faktura` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eskaerak`
--

LOCK TABLES `eskaerak` WRITE;
/*!40000 ALTER TABLE `eskaerak` DISABLE KEYS */;
/*!40000 ALTER TABLE `eskaerak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faktura`
--

DROP TABLE IF EXISTS `faktura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faktura` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gorde_tokia` varchar(100) NOT NULL,
  `eskaera_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faktura`
--

LOCK TABLES `faktura` WRITE;
/*!40000 ALTER TABLE `faktura` DISABLE KEYS */;
INSERT INTO `faktura` VALUES (1,'C:/Fakturak/2025/Urtarrila/',1),(2,'C:/Fakturak/2025/Urtarrila/',2),(3,'C:/Fakturak/2025/Otsaila/',3),(4,'D:/Backup/Fakturak/',4),(5,'C:/Erabiltzaileak/Odei/Escritorio/Fakturak/',5),(6,'C:/Fakturak/2025/Martxoa/',6),(7,'USB:/Fakturak/',7),(8,'C:/Dokumentuak/Fakturak/',8),(9,'D:/Fakturak/Artxiboa/',9),(10,'C:\\Users\\PC\\Downloads\\faktura_10.pdf',10);
/*!40000 ALTER TABLE `faktura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hornitzaileak`
--

DROP TABLE IF EXISTS `hornitzaileak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hornitzaileak` (
  `id` int NOT NULL AUTO_INCREMENT,
  `helbidea` varchar(100) NOT NULL,
  `izena` varchar(30) NOT NULL,
  `abizenak` varchar(150) NOT NULL,
  `nan` char(10) NOT NULL,
  `telefonoa` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nan_UNIQUE` (`nan`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `telefonoa_UNIQUE` (`telefonoa`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hornitzaileak`
--

LOCK TABLES `hornitzaileak` WRITE;
/*!40000 ALTER TABLE `hornitzaileak` DISABLE KEYS */;
INSERT INTO `hornitzaileak` VALUES (1,'Calle Mayor 12, Bilbao','Iker','Gomez Arrieta','12345678A','600123456','iker.gomez@techsuppliers.com'),(2,'Av. Navarra 45, Pamplona','Ane','Lopez Mendieta','23456789B','611234567','ane.lopez@electrodistrib.com'),(3,'Calle Urkijo 8, Bilbao','Mikel','Etxeberria Zubia','34567890C','622345678','mikel.etxeberria@hardwareplus.com'),(4,'Calle Gran Via 102, Madrid','Nerea','Perez Salazar','45678901D','633456789','nereaperez@digitalsupply.es'),(5,'Av. Diagonal 210, Barcelona','Unai','Martinez Ochoa','56789012E','644567890','unai.martinez@informatika.net'),(6,'Calle Independencia 33, Zaragoza','Leire','Ruiz Ibañez','67890123F','655678901','leire.ruiz@avperipherals.com'),(7,'Calle Postas 5, Vitoria','Asier','Fernandez Lasa','78901234G','666789012','asier.fernandez@gamingworld.com'),(8,'Calle Serrano 77, Madrid','Maialen','Sanchez Roldan','89012345H','677890123','maialen.sanchez@fototech.es'),(9,'Calle Ledesma 19, Bilbao','Jon','Alonso Aguirre','90123456J','688901234','jon.alonso@prosupplies.com'),(10,'Calle San Juan 14, Donostia','Aitor','Hernandez Crespo','01234567K','699712345','aitor.hernandez@tecladosplus.com'),(11,'you','you','you','73874D','748743','sdfgs@dfg.sdf'),(12,'dc','dsc','sdcs','345C','234','sf@asf.asf');
/*!40000 ALTER TABLE `hornitzaileak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `langileak`
--

DROP TABLE IF EXISTS `langileak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `langileak` (
  `id` int NOT NULL AUTO_INCREMENT,
  `postua` varchar(45) NOT NULL,
  `izena` varchar(50) NOT NULL,
  `abizenak` varchar(255) NOT NULL,
  `nan` char(9) NOT NULL,
  `telefonoa` varchar(12) NOT NULL,
  `email` varchar(45) NOT NULL,
  `pasahitza` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nan_UNIQUE` (`nan`),
  UNIQUE KEY `telefonoa_UNIQUE` (`telefonoa`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `langileak`
--

LOCK TABLES `langileak` WRITE;
/*!40000 ALTER TABLE `langileak` DISABLE KEYS */;
INSERT INTO `langileak` VALUES (1,'Teknikaria','Iker','Etxeberria Lasa','11111111A','600111111','iker.etxeberria@enpresa.eus','iker1234'),(2,'Administraria','Ane','Gonzalez Perez','22222222B','600222222','ane.gonzalez@enpresa.eus','ane1234'),(3,'Teknikaria','Unai','Martinez Ruiz','33333333C','600333333','unai.martinez@enpresa.eus','unai1234'),(4,'Administraria','Maialen','Lopez Ibarra','44444444D','600444444','maialen.lopez@enpresa.eus','maialen1234'),(5,'Administraria','Asier','Perez Mendieta','55555555E','600555555','asier.perez@enpresa.eus','asier1234'),(6,'Teknikaria','Nerea','Alonso Aguirre','66666666F','600666666','nerea.alonso@enpresa.eus','nerea1234'),(7,'Teknikaria','Aitor','Hernandez Salazar','77777777G','600777777','aitor.hernandez@enpresa.eus','aitor1234'),(8,'Zuzendaria','Miren','Ruiz Arana','88888888H','600888888','miren.ruiz@enpresa.eus','miren1234');
/*!40000 ALTER TABLE `langileak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produktuak`
--

DROP TABLE IF EXISTS `produktuak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produktuak` (
  `id` int NOT NULL,
  `izena` varchar(45) NOT NULL,
  `modeloa` varchar(45) NOT NULL,
  `prezioa` int NOT NULL,
  `marka` varchar(45) NOT NULL,
  `stock` int NOT NULL,
  `sekzioa` int NOT NULL,
  `argazkia` varchar(255) NOT NULL,
  `hornitzaile_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produktuak`
--

LOCK TABLES `produktuak` WRITE;
/*!40000 ALTER TABLE `produktuak` DISABLE KEYS */;
INSERT INTO `produktuak` VALUES (1,'Mahaigaineko ordenagailua','OptiPlex 7010',850,'Dell',12,1,'ordenagailu_1.jpg',1),(2,'Portatilea','ThinkPad E15',720,'Lenovo',8,1,'ordenagailu_2.jpg',2),(3,'Portatil Gaming','TUF F15',1200,'Asus',5,1,'ordenagailu_3.jpg',3),(4,'Mini PC','NUC 11',650,'Intel',10,1,'ordenagailu_4.jpg',4),(5,'All-in-One ordenagailua','iMac 24',1450,'Apple',6,1,'ordenagailu_5.jpg',5),(6,'Serbidorea','PowerEdge T40',980,'Dell',4,1,'ordenagailu_6.webp',6),(7,'Portatilea','Asus Vivook 15',680,'Asus',9,1,'ordenagailu_7.jpg',7),(8,'Reflex kamara','EOS 250D',620,'Canon',7,2,'kamara_1.avif',8),(9,'Mirrorless kamara','Alpha A6400',900,'Sony',5,2,'kamara_2.jpg',9),(10,'Kamara Profesionala','Alexa Arri Mini',35000,'BlackMagic',6,2,'kamara_3.webp',10),(11,'Kamara deportiboa','Hero 11',420,'GoPro',15,2,'kamara_4.webp',1),(12,'Bridge kamara','Lumix FZ82',380,'Panasonic',8,2,'kamara_5.webp',2),(13,'Kamara instantaneoa','Instax Mini 12',95,'Fujifilm',20,2,'kamara_6.webp',3),(14,'Kamara profesionala','Z6 II',1800,'Nikon',3,2,'kamara_7.webp',4),(15,'Kontsola','PlayStation 5',549,'Sony',10,3,'kontsola_1.webp',5),(16,'Kontsola','Xbox Series X',549,'Microsoft',8,3,'kontsola_2.webp',6),(17,'Kontsola','Nintendo Switch OLED',349,'Nintendo',14,3,'kontsola_3.jpg',7),(18,'Retro kontsola','Mega Drive Mini',89,'SEGA',6,3,'kontsola_4.webp',8),(19,'Kontsola portatila','Steam Deck',679,'Valve',4,3,'kontsola_5.png',9),(20,'Kontsola','PlayStation 4 Slim',299,'Sony',7,3,'kontsola_6.jpg',10),(21,'Kontsola','Xbox Series S',299,'Microsoft',11,3,'kontsola_7.webp',1),(22,'Aurikularrak','WH-1000XM5',399,'Sony',13,4,'periferiko_1.webp',2),(23,'Altabozea','Charge 5',179,'JBL',18,4,'periferiko_2.webp',3),(24,'Mikrofonoa','Blue Yeti',130,'Logitech',9,4,'periferiko_3.webp',4),(25,'Soinuko barra','HW-Q800B',520,'Samsung',5,4,'periferiko_4.webp',5),(26,'Webkam','C920 HD Pro',85,'Logitech',16,4,'periferiko_5.jpg',6),(27,'Gaming aurikularrak','Cloud II',99,'HyperX',14,4,'periferiko_6.webp',7),(28,'Monitorea','UltraSharp U2720Q',650,'Dell',6,4,'periferiko_7.webp',8),(29,'Teklatu mekanikoa','K95 RGB',199,'Corsair',10,5,'teklatu_1.webp',9),(30,'Gaming teklatua','BlackWidow V3',169,'Razer',8,5,'teklatu_2.webp',10),(31,'Teklatu inalambrikoa','MX Keys',120,'Logitech',12,5,'teklatu_3.webp',1),(32,'Teklatu konpaktoa','Anne Pro 2',110,'Obins',7,5,'teklatu_4.jpg',2),(33,'Teklatu ergonomikoa','K860',135,'Logitech',6,5,'teklatu_5.webp',3),(34,'Teklatu mekanikoa','Ducky One 3',149,'Ducky',9,5,'teklatu_6.jpg',4),(35,'Teklatu normala','K120',19,'Logitech',25,5,'teklatu_7.webp',5);
/*!40000 ALTER TABLE `produktuak` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-02-11 13:42:33
