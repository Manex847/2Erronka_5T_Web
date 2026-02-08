-- MySQL dump 10.13  Distrib 8.0.43, for Win64 (x86_64)
--
-- Host: localhost    Database: 2erronka
-- ------------------------------------------------------
-- Server version	9.4.0

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
-- Table structure for table `bezeroak`
--

DROP TABLE IF EXISTS `bezeroak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bezeroak` (
  `bezero_id` int NOT NULL,
  `helbidea` varchar(100) NOT NULL,
  `telefonoa` varchar(100) NOT NULL,
  `izena` varchar(30) NOT NULL,
  `abizenak` varchar(100) NOT NULL,
  `nan` char(9) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`bezero_id`),
  UNIQUE KEY `nan_UNIQUE` (`nan`),
  UNIQUE KEY `telefonoa_UNIQUE` (`telefonoa`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bezeroak`
--

LOCK TABLES `bezeroak` WRITE;
/*!40000 ALTER TABLE `bezeroak` DISABLE KEYS */;
INSERT INTO `bezeroak` VALUES (1,'Autonomia kalea 14, Bilbo','600111222','Jon','Etxeberria Lasa','12345678A','jon.etxeberria@gmail.com'),(2,'Gasteiz etorbidea 102, Gasteiz','611222333','Ane','Gonzalez Perez','23456789B','ane.gonzalez@hotmail.com'),(3,'Kale Nagusia 7, Iruñea','622333444','Unai','Martinez Ruiz','34567890C','unai.martinez@yahoo.es'),(4,'San Martin kalea 55, Donostia','633444555','Maialen','Lopez Ibarra','45678901D','maialen.lopez@gmail.com'),(5,'Gran Via kalea 88, Madril','644555666','Iker','Fernandez Ochoa','56789012E','iker.fernandez@outlook.com'),(6,'Diagonal etorbidea 250, Bartzelona','655666777','Leire','Sanchez Moreno','67890123F','leire.sanchez@gmail.com'),(7,'Estafeta kalea 9, Iruñea','666777888','Asier','Perez Mendieta','78901234G','asier.perez@hotmail.com'),(8,'Ledesma kalea 21, Bilbo','677888999','Nerea','Alonso Aguirre','89012345H','nerea.alonso@yahoo.es'),(9,'Independentzia kalea 40, Zaragoza','688999000','Aitor','Hernandez Salazar','90123456J','aitor.hdz@gmail.com'),(10,'Bidebarrieta kalea 3, Bilbo','699000111','Miren','Ruiz Arana','01234567K','miren.ruiz@protonmail.com');
/*!40000 ALTER TABLE `bezeroak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eskaerak`
--

DROP TABLE IF EXISTS `eskaerak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eskaerak` (
  `eskaera_id` int NOT NULL,
  `bezero_id` int NOT NULL,
  `produktu_id` int NOT NULL,
  `data` char(10) NOT NULL,
  PRIMARY KEY (`eskaera_id`),
  UNIQUE KEY `bezeri_id_UNIQUE` (`bezero_id`),
  UNIQUE KEY `produktu_id_UNIQUE` (`produktu_id`),
  CONSTRAINT `fk_eskaerak_bezero_id_bezeroak` FOREIGN KEY (`bezero_id`) REFERENCES `bezeroak` (`bezero_id`),
  CONSTRAINT `fk_eskaerak_produktu_id_produktuak` FOREIGN KEY (`produktu_id`) REFERENCES `produktuak` (`produktu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eskaerak`
--

LOCK TABLES `eskaerak` WRITE;
/*!40000 ALTER TABLE `eskaerak` DISABLE KEYS */;
INSERT INTO `eskaerak` VALUES (1,1,3,'2025-01-05'),(2,2,7,'2025-01-06'),(3,3,15,'2025-01-07'),(4,4,22,'2025-01-08'),(5,5,29,'2025-01-09'),(6,6,10,'2025-01-10'),(7,7,18,'2025-01-11'),(8,8,24,'2025-01-12'),(9,9,31,'2025-01-13'),(10,10,5,'2025-01-14');
/*!40000 ALTER TABLE `eskaerak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faktura`
--

DROP TABLE IF EXISTS `faktura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faktura` (
  `faktura_id` int NOT NULL,
  `gorde_tokia` varchar(100) NOT NULL,
  `eskaera_id` int NOT NULL,
  PRIMARY KEY (`faktura_id`),
  UNIQUE KEY `eskaera_id_UNIQUE` (`eskaera_id`),
  CONSTRAINT `fk_faktura_eskaera_id_eskaerak` FOREIGN KEY (`eskaera_id`) REFERENCES `eskaerak` (`eskaera_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faktura`
--

LOCK TABLES `faktura` WRITE;
/*!40000 ALTER TABLE `faktura` DISABLE KEYS */;
INSERT INTO `faktura` VALUES (1,'C:/Fakturak/2025/Urtarrila/',1),(2,'C:/Fakturak/2025/Urtarrila/',2),(3,'C:/Fakturak/2025/Otsaila/',3),(4,'D:/Backup/Fakturak/',4),(5,'C:/Erabiltzaileak/Odei/Escritorio/Fakturak/',5),(6,'C:/Fakturak/2025/Martxoa/',6),(7,'USB:/Fakturak/',7),(8,'C:/Dokumentuak/Fakturak/',8),(9,'D:/Fakturak/Artxiboa/',9),(10,'C:/Fakturak/2025/Apirila/',10);
/*!40000 ALTER TABLE `faktura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hornitzaileak`
--

DROP TABLE IF EXISTS `hornitzaileak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hornitzaileak` (
  `hornitzaile_id` int NOT NULL,
  `helbidea` varchar(100) NOT NULL,
  `izena` varchar(30) NOT NULL,
  `abizenak` varchar(150) NOT NULL,
  `nan` char(10) NOT NULL,
  `telefonoa` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`hornitzaile_id`),
  UNIQUE KEY `nan_UNIQUE` (`nan`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `telefonoa_UNIQUE` (`telefonoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hornitzaileak`
--

LOCK TABLES `hornitzaileak` WRITE;
/*!40000 ALTER TABLE `hornitzaileak` DISABLE KEYS */;
INSERT INTO `hornitzaileak` VALUES (1,'Calle Mayor 12, Bilbao','Iker','Gomez Arrieta','12345678A','600123456','iker.gomez@techsuppliers.com'),(2,'Av. Navarra 45, Pamplona','Ane','Lopez Mendieta','23456789B','611234567','ane.lopez@electrodistrib.com'),(3,'Calle Urkijo 8, Bilbao','Mikel','Etxeberria Zubia','34567890C','622345678','mikel.etxeberria@hardwareplus.com'),(4,'Calle Gran Via 102, Madrid','Nerea','Perez Salazar','45678901D','633456789','nereaperez@digitalsupply.es'),(5,'Av. Diagonal 210, Barcelona','Unai','Martinez Ochoa','56789012E','644567890','unai.martinez@informatika.net'),(6,'Calle Independencia 33, Zaragoza','Leire','Ruiz Ibañez','67890123F','655678901','leire.ruiz@avperipherals.com'),(7,'Calle Postas 5, Vitoria','Asier','Fernandez Lasa','78901234G','666789012','asier.fernandez@gamingworld.com'),(8,'Calle Serrano 77, Madrid','Maialen','Sanchez Roldan','89012345H','677890123','maialen.sanchez@fototech.es'),(9,'Calle Ledesma 19, Bilbao','Jon','Alonso Aguirre','90123456J','688901234','jon.alonso@prosupplies.com'),(10,'Calle San Juan 14, Donostia','Aitor','Hernandez Crespo','01234567K','699712345','aitor.hernandez@tecladosplus.com');
/*!40000 ALTER TABLE `hornitzaileak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `langileak`
--

DROP TABLE IF EXISTS `langileak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `langileak` (
  `langile_id` int NOT NULL,
  `postua` varchar(45) NOT NULL,
  `izena` varchar(50) NOT NULL,
  `abizenak` varchar(255) NOT NULL,
  `nan` char(9) NOT NULL,
  `telefonoa` varchar(12) NOT NULL,
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`langile_id`),
  UNIQUE KEY `nan_UNIQUE` (`nan`),
  UNIQUE KEY `telefonoa_UNIQUE` (`telefonoa`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  CONSTRAINT `fk_eskaerak_langile_id_langileak` FOREIGN KEY (`langile_id`) REFERENCES `eskaerak` (`eskaera_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `langileak`
--

LOCK TABLES `langileak` WRITE;
/*!40000 ALTER TABLE `langileak` DISABLE KEYS */;
INSERT INTO `langileak` VALUES (1,'Saltzailea','Iker','Etxeberria Lasa','11111111A','600111111','iker.etxeberria@enpresa.eus'),(2,'Saltzailea','Ane','Gonzalez Perez','22222222B','600222222','ane.gonzalez@enpresa.eus'),(3,'Biltegiko arduraduna','Unai','Martinez Ruiz','33333333C','600333333','unai.martinez@enpresa.eus'),(4,'Administraria','Maialen','Lopez Ibarra','44444444D','600444444','maialen.lopez@enpresa.eus'),(5,'Informatikaria','Asier','Perez Mendieta','55555555E','600555555','asier.perez@enpresa.eus'),(6,'Kontabilaria','Nerea','Alonso Aguirre','66666666F','600666666','nerea.alonso@enpresa.eus'),(7,'Saltzailea','Aitor','Hernandez Salazar','77777777G','600777777','aitor.hernandez@enpresa.eus'),(8,'Zuzendaria','Miren','Ruiz Arana','88888888H','600888888','miren.ruiz@enpresa.eus');
/*!40000 ALTER TABLE `langileak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produktuak`
--

DROP TABLE IF EXISTS `produktuak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produktuak` (
  `produktu_id` int NOT NULL,
  `izena` varchar(45) NOT NULL,
  `modeloa` varchar(45) NOT NULL,
  `prezioa` int NOT NULL,
  `marka` varchar(45) NOT NULL,
  `stock` int NOT NULL,
  `sekzioa` int NOT NULL,
  `hornitzaile_id` int NOT NULL,
  PRIMARY KEY (`produktu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produktuak`
--

LOCK TABLES `produktuak` WRITE;
/*!40000 ALTER TABLE `produktuak` DISABLE KEYS */;
INSERT INTO `produktuak` VALUES (1,'Mahaigaineko ordenagailua','OptiPlex 7010',850,'Dell',12,1,1),(2,'Portatilea','ThinkPad E15',720,'Lenovo',8,1,2),(3,'Portatil Gaming','TUF F15',1200,'Asus',5,1,3),(4,'Mini PC','NUC 11',650,'Intel',10,1,4),(5,'All-in-One ordenagailua','iMac 24',1450,'Apple',6,1,5),(6,'Serbidorea','PowerEdge T40',980,'Dell',4,1,6),(7,'Tablet','Galaxy Tab S9',890,'Samsung',9,1,7),(8,'Reflex kamara','EOS 250D',620,'Canon',7,2,8),(9,'Mirrorless kamara','Alpha A6400',900,'Sony',5,2,9),(10,'Kamara Profesionala','Alexa Arri Mini',35000,'BlackMagic',6,2,10),(11,'Kamara deportiboa','Hero 11',420,'GoPro',15,2,1),(12,'Bridge kamara','Lumix FZ82',380,'Panasonic',8,2,2),(13,'Kamara instantaneoa','Instax Mini 12',95,'Fujifilm',20,2,3),(14,'Kamara profesionala','Z6 II',1800,'Nikon',3,2,4),(15,'Kontsola','PlayStation 5',549,'Sony',10,3,5),(16,'Kontsola','Xbox Series X',549,'Microsoft',8,3,6),(17,'Kontsola','Nintendo Switch OLED',349,'Nintendo',14,3,7),(18,'Retro kontsola','Mega Drive Mini',89,'SEGA',6,3,8),(19,'Kontsola portatila','Steam Deck',679,'Valve',4,3,9),(20,'Kontsola','PlayStation 4 Slim',299,'Sony',7,3,10),(21,'Kontsola','Xbox Series S',299,'Microsoft',11,3,1),(22,'Aurikularrak','WH-1000XM5',399,'Sony',13,4,2),(23,'Altabozea','Charge 5',179,'JBL',18,4,3),(24,'Mikrofonoa','Blue Yeti',130,'Logitech',9,4,4),(25,'Soinuko barra','HW-Q800B',520,'Samsung',5,4,5),(26,'Webkam','C920 HD Pro',85,'Logitech',16,4,6),(27,'Gaming aurikularrak','Cloud II',99,'HyperX',14,4,7),(28,'Monitorea','UltraSharp U2720Q',650,'Dell',6,4,8),(29,'Teklatu mekanikoa','K95 RGB',199,'Corsair',10,5,9),(30,'Gaming teklatua','BlackWidow V3',169,'Razer',8,5,10),(31,'Teklatu inalambrikoa','MX Keys',120,'Logitech',12,5,1),(32,'Teklatu konpaktoa','Anne Pro 2',110,'Obins',7,5,2),(33,'Teklatu ergonomikoa','K860',135,'Logitech',6,5,3),(34,'Teklatu mekanikoa','Ducky One 3',149,'Ducky',9,5,4),(35,'Teklatu normala','K120',19,'Logitech',25,5,5);
/*!40000 ALTER TABLE `produktuak` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-25 18:39:22
