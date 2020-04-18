CREATE DATABASE  IF NOT EXISTS `conecte_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `conecte_db`;
-- MySQL dump 10.13  Distrib 8.0.15, for macos10.14 (x86_64)
--
-- Host: localhost    Database: conecte_db
-- ------------------------------------------------------
-- Server version	8.0.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_billeteras`
--

DROP TABLE IF EXISTS `tbl_billeteras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_billeteras` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_USER` int(11) unsigned NOT NULL,
  `SALDO` varchar(250) NOT NULL DEFAULT '0',
  `SALDO_TOTAL` varchar(250) NOT NULL DEFAULT '0',
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `tblbilletera_fk1` (`ID_USER`),
  CONSTRAINT `tblbilletera_fk1` FOREIGN KEY (`ID_USER`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_billeteras`
--

LOCK TABLES `tbl_billeteras` WRITE;
/*!40000 ALTER TABLE `tbl_billeteras` DISABLE KEYS */;
INSERT INTO `tbl_billeteras` VALUES (11,1,'770000','0',NULL,'2019-04-16 12:27:31'),(12,2,'3029100','0',NULL,'2019-04-16 12:21:59'),(13,28,'0','0',NULL,NULL);
/*!40000 ALTER TABLE `tbl_billeteras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_configuraciones_artistas`
--

DROP TABLE IF EXISTS `tbl_configuraciones_artistas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_configuraciones_artistas` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ARTISTA` int(10) unsigned NOT NULL,
  `PRECIO_DEDICATORIA` varchar(250) NOT NULL,
  `ACEPTO_SOLICITUDES_DE_DEDICATORIAS` int(10) unsigned DEFAULT NULL,
  `ACEPTO_CONTRATOS` int(10) unsigned NOT NULL,
  `COMICION_DECICATORIAS` varchar(10) DEFAULT '0',
  `COMICION_CONTRATOS` varchar(10) DEFAULT '0',
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `tblconfiguracionesartistas_fk1` (`ID_ARTISTA`),
  KEY `fk_acepto_solicitudes_de_dedicatorias` (`ACEPTO_SOLICITUDES_DE_DEDICATORIAS`),
  KEY `tblconfiguracionesartistas_fk3` (`ACEPTO_CONTRATOS`),
  CONSTRAINT `fk_acepto_solicitudes_de_dedicatorias` FOREIGN KEY (`ACEPTO_SOLICITUDES_DE_DEDICATORIAS`) REFERENCES `tbl_parametros` (`ID`),
  CONSTRAINT `tblconfiguracionesartistas_fk1` FOREIGN KEY (`ID_ARTISTA`) REFERENCES `users` (`id`),
  CONSTRAINT `tblconfiguracionesartistas_fk3` FOREIGN KEY (`ACEPTO_CONTRATOS`) REFERENCES `tbl_parametros` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_configuraciones_artistas`
--

LOCK TABLES `tbl_configuraciones_artistas` WRITE;
/*!40000 ALTER TABLE `tbl_configuraciones_artistas` DISABLE KEYS */;
INSERT INTO `tbl_configuraciones_artistas` VALUES (1,1,'25000',27,26,'0','0','2019-03-29 17:24:51','2019-03-29 17:24:51'),(2,2,'35000',26,26,'4','1','2019-03-29 17:24:51','2019-04-17 02:05:05');
/*!40000 ALTER TABLE `tbl_configuraciones_artistas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_formulario_de_pago_contratacion`
--

DROP TABLE IF EXISTS `tbl_formulario_de_pago_contratacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_formulario_de_pago_contratacion` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ID_SOLICITUD_DE_CONTRATACION` int(10) unsigned NOT NULL,
  `PRECIO` varchar(250) DEFAULT NULL,
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `ID_SOLICITUD_DE_CONTRATACION` (`ID_SOLICITUD_DE_CONTRATACION`),
  CONSTRAINT `tbl_formulario_de_pago_contratacion_ibfk_1` FOREIGN KEY (`ID_SOLICITUD_DE_CONTRATACION`) REFERENCES `tbl_solicitudes_de_contratacion` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_formulario_de_pago_contratacion`
--

LOCK TABLES `tbl_formulario_de_pago_contratacion` WRITE;
/*!40000 ALTER TABLE `tbl_formulario_de_pago_contratacion` DISABLE KEYS */;
INSERT INTO `tbl_formulario_de_pago_contratacion` VALUES (15,10,'1000000','2019-04-16 12:27:21','2019-04-16 12:27:21');
/*!40000 ALTER TABLE `tbl_formulario_de_pago_contratacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_movimientos`
--

DROP TABLE IF EXISTS `tbl_movimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_movimientos` (
  `ID` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `ID_ARTISTA` int(10) unsigned DEFAULT NULL,
  `ID_CLIENTE` int(10) unsigned DEFAULT NULL,
  `ID_TIPO` int(10) unsigned DEFAULT NULL,
  `ID_ESTADO` int(10) unsigned DEFAULT NULL,
  `COSTO_TOTAL` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PORCENTAJE_PLATAFORMA` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `COMICION_PLATAFORMA` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `PORCENTAJE_ARTISTA` varchar(250) NOT NULL,
  `COMICION_ARTISTA` varchar(250) NOT NULL,
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `tblmovimientos_fk1` (`ID_TIPO`),
  KEY `ID_ARTISTA` (`ID_ARTISTA`),
  KEY `ID_CLIENTE` (`ID_CLIENTE`),
  KEY `ID_ESTADO` (`ID_ESTADO`),
  CONSTRAINT `tbl_movimientos_ibfk_1` FOREIGN KEY (`ID_ARTISTA`) REFERENCES `users` (`id`),
  CONSTRAINT `tbl_movimientos_ibfk_2` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `users` (`id`),
  CONSTRAINT `tbl_movimientos_ibfk_3` FOREIGN KEY (`ID_ESTADO`) REFERENCES `tbl_parametros` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_movimientos`
--

LOCK TABLES `tbl_movimientos` WRITE;
/*!40000 ALTER TABLE `tbl_movimientos` DISABLE KEYS */;
INSERT INTO `tbl_movimientos` VALUES (0000000035,2,1,31,40,'30000','3','900','97','29100','2019-04-16 12:21:59','2019-04-16 12:21:59'),(0000000036,2,1,32,40,'1000000','1','10000','99','990000','2019-04-16 12:27:31','2019-04-16 12:27:31'),(0000000037,2,2,39,42,'1000000','0','0','0','0','2019-04-16 12:36:24','2019-04-16 12:36:24'),(0000000038,2,2,39,42,'50000','0','0','0','0','2019-04-16 12:39:16','2019-04-16 12:39:16');
/*!40000 ALTER TABLE `tbl_movimientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_negociacion_contratacion`
--

DROP TABLE IF EXISTS `tbl_negociacion_contratacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_negociacion_contratacion` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ID_SOLICITUD_DE_CONTRATACION` int(10) unsigned NOT NULL,
  `ID_USER` int(10) unsigned NOT NULL,
  `ID_ARTISTA` int(10) unsigned NOT NULL,
  `ID_CLIENTE` int(10) unsigned NOT NULL,
  `ID_ESTADO` int(10) unsigned NOT NULL DEFAULT '44',
  `MENSAJE` text NOT NULL,
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `tblnegociacioncontratacion_fk1` (`ID_USER`),
  KEY `ID_SOLICITUD_DE_CONTRATACION` (`ID_SOLICITUD_DE_CONTRATACION`),
  KEY `ID_CLIENTE` (`ID_CLIENTE`),
  KEY `ID_ARTISTA` (`ID_ARTISTA`),
  KEY `ID_ESTADO` (`ID_ESTADO`),
  CONSTRAINT `tbl_negociacion_contratacion_ibfk_1` FOREIGN KEY (`ID_SOLICITUD_DE_CONTRATACION`) REFERENCES `tbl_solicitudes_de_contratacion` (`ID`),
  CONSTRAINT `tbl_negociacion_contratacion_ibfk_2` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `users` (`id`),
  CONSTRAINT `tbl_negociacion_contratacion_ibfk_3` FOREIGN KEY (`ID_ARTISTA`) REFERENCES `users` (`id`),
  CONSTRAINT `tbl_negociacion_contratacion_ibfk_4` FOREIGN KEY (`ID_ESTADO`) REFERENCES `tbl_parametros` (`ID`),
  CONSTRAINT `tblnegociacioncontratacion_fk1` FOREIGN KEY (`ID_USER`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_negociacion_contratacion`
--

LOCK TABLES `tbl_negociacion_contratacion` WRITE;
/*!40000 ALTER TABLE `tbl_negociacion_contratacion` DISABLE KEYS */;
INSERT INTO `tbl_negociacion_contratacion` VALUES (25,10,2,2,1,44,'Un saludo, caballero','2019-04-16 12:25:59','2019-04-16 12:25:59'),(26,10,2,2,1,44,'En total serian $1000000.','2019-04-16 12:26:28','2019-04-16 12:26:28'),(27,10,1,2,1,44,'Listo, como seria el pago.','2019-04-16 12:26:53','2019-04-16 12:26:53'),(28,10,2,2,1,44,'Ya mismo te habilito el formulario de pago.','2019-04-16 12:27:13','2019-04-16 12:27:13');
/*!40000 ALTER TABLE `tbl_negociacion_contratacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_parametros`
--

DROP TABLE IF EXISTS `tbl_parametros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_parametros` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ID_VALOR` int(10) unsigned NOT NULL,
  `NOMBRE` varchar(250) NOT NULL,
  `DESCRIPCION` text NOT NULL,
  `ID_ESTADO` int(11) NOT NULL DEFAULT '0',
  `CREATED_AT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATE_AT` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_idx` (`ID_VALOR`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_parametros`
--

LOCK TABLES `tbl_parametros` WRITE;
/*!40000 ALTER TABLE `tbl_parametros` DISABLE KEYS */;
INSERT INTO `tbl_parametros` VALUES (0,0,'Clientes','Sin definir.',0,'2019-03-29 17:24:51',NULL),(1,0,'Artistas o celebridad','Sin definri.',0,'2019-03-29 17:24:51',NULL),(2,0,'Administrador','Sin definir.',0,'2019-03-29 17:24:51',NULL),(3,1,'Champeta','Sin definir.',0,'2019-03-29 17:24:51',NULL),(4,1,'Vallenato','Sin definir.',0,'2019-03-29 17:24:51',NULL),(5,1,'Salsa','Sin definir.',0,'2019-03-29 17:24:51',NULL),(6,1,'Reggaeton','Sin definir.',0,'2019-03-29 17:24:51',NULL),(7,1,'Trap','Sin definir.',0,'2019-03-29 17:24:51',NULL),(9,2,'Activo','Sin definir.',0,'2019-03-29 17:24:51',NULL),(10,2,'Pendiente','Sin definir.',0,'2019-03-29 17:24:51',NULL),(11,2,'Rechazado','Sin definir.',0,'2019-03-29 17:24:51',NULL),(12,3,'Pendiente por pago','El ciente solicito una dedicatoria pero a un la pagado',0,'2019-03-29 17:24:51',NULL),(13,3,'Esperando respuesta','El cliente ya pago, y esta esperando respuesta por parte del artista o celebridad',0,'2019-03-29 17:24:51',NULL),(14,3,'Respondido','El artista o celebridad respondo la solicitud del cliente.',0,'2019-03-29 17:24:51',NULL),(15,3,'Finalizao','Sin definir.',0,'2019-03-29 17:24:51',NULL),(16,3,'Cancelado','Sin definir.',0,'2019-03-29 17:24:51',NULL),(17,2,'Pendiente por revisión','Sin definir.',0,'2019-03-29 17:24:51',NULL),(18,4,'Msg de confirmación','Gracias por registrarte en nuestra plataforma, hemos enviado un correo electronico para que confirmes la cuenta.',0,'2019-03-29 17:24:51',NULL),(19,2,'Suspendido','Sin definir.',0,'2019-03-29 17:24:51',NULL),(20,1,'Corrido','Sin definir.',0,'2019-03-29 17:24:51',NULL),(21,1,'Country','Sin definir.',0,'2019-03-29 17:24:51',NULL),(24,1,'Blues','Sin definir.',0,'2019-03-29 17:24:51',NULL),(25,1,'Cumbia','Sin definir.',0,'2019-03-29 17:24:51',NULL),(26,5,'Si','Sin definir.',0,'2019-03-29 17:24:51',NULL),(27,5,'No','Sin definir.',0,'2019-03-29 17:24:51',NULL),(28,6,'Publicado','Sin definri.',0,'2019-03-29 17:24:51',NULL),(29,6,'Borrador','Sin definri.',0,'2019-03-29 17:24:51',NULL),(30,6,'Eliminar','Sin definri.',0,'2019-03-29 17:24:51',NULL),(31,7,'Dedicatoria','Sin definir.',0,'2019-03-29 17:24:51',NULL),(32,7,'Contratacion','Sin definir.',0,'2019-03-29 17:24:51',NULL),(33,8,'Esperando respuesta','Esperando respuesta',0,'2019-03-29 17:24:51',NULL),(34,8,'Reportado al administrador','Reportado al administrador',0,'2019-03-29 17:24:51',NULL),(35,8,'En negociacion','En negociacion',0,'2019-03-29 17:24:51',NULL),(38,4,'Msg de dedicatoria.','Has resivido una nueva solictud de dedicatoria.',0,'2019-03-29 17:24:51',NULL),(39,7,'Retiro','Sin definir.',0,'2019-03-29 17:24:51',NULL),(40,9,'Aprobado','Sin definir.',0,'2019-04-11 14:27:14',NULL),(41,9,'Rechazado','Sin definir.',0,'2019-04-11 14:27:37',NULL),(42,9,'Esperando aprobación','Sin definir.',0,'2019-04-11 14:29:45',NULL),(43,4,'Msg de contratación','Nos complace informate que te allegado una solicitud de crontratación de un cliente,  responde lo mas pronto posile, gracias.',0,'2019-03-29 17:24:51',NULL),(44,10,'Enviado','Mensaje enviado',0,'2019-03-29 17:24:51',NULL),(45,10,'Eliminado','Este mensaje eliminado',0,'2019-03-29 17:24:51',NULL),(46,8,'Pendiente por pago','Pendiente por pago',0,'2019-03-29 17:24:51',NULL),(47,8,'Pagado','Pagado',0,'2019-03-29 17:24:51',NULL),(48,8,'Cancelado','Cancelado',0,'2019-03-29 17:24:51',NULL),(49,8,'Finalizado','Finalizado',0,'2019-03-29 17:24:51',NULL),(50,7,'Deposito','Deposito',0,'2019-03-29 17:24:51',NULL);
/*!40000 ALTER TABLE `tbl_parametros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_post_artistas`
--

DROP TABLE IF EXISTS `tbl_post_artistas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_post_artistas` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ARTISTA` int(10) unsigned NOT NULL,
  `NOMBRE` text NOT NULL,
  `IMAGEN` text,
  `EMBED` text NOT NULL,
  `DESCRIPCION` text NOT NULL,
  `ID_ESTADO` int(10) unsigned NOT NULL,
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `tblpostartistas_fk1` (`ID_ARTISTA`),
  KEY `tblpostartistas_fk2` (`ID_ESTADO`),
  CONSTRAINT `tblpostartistas_fk1` FOREIGN KEY (`ID_ARTISTA`) REFERENCES `users` (`id`),
  CONSTRAINT `tblpostartistas_fk2` FOREIGN KEY (`ID_ESTADO`) REFERENCES `tbl_parametros` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_post_artistas`
--

LOCK TABLES `tbl_post_artistas` WRITE;
/*!40000 ALTER TABLE `tbl_post_artistas` DISABLE KEYS */;
INSERT INTO `tbl_post_artistas` VALUES (1,2,'La PupiCole','LaPupiCole.jpg','https://www.youtube.com/embed/74yo_jkHvgk','Sin definir',28,'2019-03-29 17:24:51',NULL),(2,2,'Pa\' la calle me voy','Pa\' la calle me voy.jpg','https://www.youtube.com/embed/tacQJz76s7U','Sin definir',28,'2019-03-29 17:24:51',NULL);
/*!40000 ALTER TABLE `tbl_post_artistas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_solicitudes_de_contratacion`
--

DROP TABLE IF EXISTS `tbl_solicitudes_de_contratacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_solicitudes_de_contratacion` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ID_ARTISTA` int(10) unsigned NOT NULL,
  `ID_CLIENTE` int(10) unsigned NOT NULL,
  `ID_ESTADO` int(10) unsigned NOT NULL,
  `COSTO` varchar(250) DEFAULT NULL,
  `CIUDAD` text NOT NULL,
  `PAIS` text NOT NULL,
  `DIRECCION` text NOT NULL,
  `NOMBRES` text NOT NULL,
  `TELEFONO` text NOT NULL,
  `DESDE` text NOT NULL,
  `HASTA` text NOT NULL,
  `HORA` text NOT NULL,
  `MENSAJE` text NOT NULL,
  `ID_MOVIMIENTO` int(10) unsigned DEFAULT NULL,
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `tblsolicitudesdecontratacion_fk1` (`ID_ARTISTA`),
  KEY `tblsolicitudesdecontratacion_fk2` (`ID_CLIENTE`),
  KEY `tblsolicitudesdecontratacion_fk3` (`ID_ESTADO`),
  CONSTRAINT `tblsolicitudesdecontratacion_fk1` FOREIGN KEY (`ID_ARTISTA`) REFERENCES `users` (`id`),
  CONSTRAINT `tblsolicitudesdecontratacion_fk2` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `users` (`id`),
  CONSTRAINT `tblsolicitudesdecontratacion_fk3` FOREIGN KEY (`ID_ESTADO`) REFERENCES `tbl_parametros` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_solicitudes_de_contratacion`
--

LOCK TABLES `tbl_solicitudes_de_contratacion` WRITE;
/*!40000 ALTER TABLE `tbl_solicitudes_de_contratacion` DISABLE KEYS */;
INSERT INTO `tbl_solicitudes_de_contratacion` VALUES (10,2,1,49,'1000000','Barranquilla','Colombia','K5','Daniel Jose Ruiz Gutierrez','3222222','2019-04-16','2019-04-16','16:00','Hola Twister, esoty orgnizando y quiero que cantes en ella cuanto me cobrarias por 10 canciones, gracias.',36,'2019-04-16 12:25:25','2019-04-16 12:27:40');
/*!40000 ALTER TABLE `tbl_solicitudes_de_contratacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_solicitudes_de_dedicatorias`
--

DROP TABLE IF EXISTS `tbl_solicitudes_de_dedicatorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_solicitudes_de_dedicatorias` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_ARTISTA` int(11) unsigned NOT NULL,
  `ID_CLIENTE` int(11) unsigned NOT NULL,
  `ID_ESTADO` int(11) unsigned NOT NULL,
  `DE_PARTE_DE` text NOT NULL,
  `DIRIGIDO_A` text NOT NULL,
  `MENSAJE` text NOT NULL,
  `COSTO_DEDICATORIA` varchar(250) NOT NULL,
  `URL_DE_RESPUESTA` text,
  `ID_MOVIMIENTO` int(10) unsigned NOT NULL,
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `tblsolicitudesdedicatoria_fk1` (`ID_ARTISTA`),
  KEY `tblsolicitudesdedicatoria_fk2` (`ID_CLIENTE`),
  KEY `tblsolicitudesdedicatoria_fk3` (`ID_ESTADO`),
  KEY `tblsolicitudesdededicatorias_fk3` (`ID_MOVIMIENTO`),
  CONSTRAINT `tblsolicitudesdededicatorias_fk2` FOREIGN KEY (`ID_ARTISTA`) REFERENCES `users` (`id`),
  CONSTRAINT `tblsolicitudesdededicatorias_fk3` FOREIGN KEY (`ID_MOVIMIENTO`) REFERENCES `tbl_movimientos` (`ID`),
  CONSTRAINT `tblsolicitudesdededicatorias_fk4` FOREIGN KEY (`ID_ESTADO`) REFERENCES `tbl_parametros` (`ID`),
  CONSTRAINT `tblsolicitudesdededicatorias_fk5` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_solicitudes_de_dedicatorias`
--

LOCK TABLES `tbl_solicitudes_de_dedicatorias` WRITE;
/*!40000 ALTER TABLE `tbl_solicitudes_de_dedicatorias` DISABLE KEYS */;
INSERT INTO `tbl_solicitudes_de_dedicatorias` VALUES (24,2,1,13,'Daniel Ruiz','Luisa Fernanda','Un saludo para voz','30000',NULL,35,'2019-04-16 12:21:59','2019-04-16 12:21:59');
/*!40000 ALTER TABLE `tbl_solicitudes_de_dedicatorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_solicitudes_de_liquidacion`
--

DROP TABLE IF EXISTS `tbl_solicitudes_de_liquidacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_solicitudes_de_liquidacion` (
  `ID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `ID_ARTISTA` int(11) unsigned NOT NULL,
  `CANTIDAD` varchar(250) NOT NULL,
  `ID_MOVIMIENTO` int(11) unsigned NOT NULL,
  `ID_ESTADO` int(11) unsigned DEFAULT NULL,
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `ID_ARTISTA` (`ID_ARTISTA`),
  KEY `ID_ESTADO` (`ID_ESTADO`),
  KEY `ID_MOVIMIENTO` (`ID_MOVIMIENTO`),
  CONSTRAINT `tbl_solicitudes_de_liquidacion_ibfk_1` FOREIGN KEY (`ID_ARTISTA`) REFERENCES `users` (`id`),
  CONSTRAINT `tbl_solicitudes_de_liquidacion_ibfk_2` FOREIGN KEY (`ID_ESTADO`) REFERENCES `tbl_parametros` (`ID`),
  CONSTRAINT `tbl_solicitudes_de_liquidacion_ibfk_3` FOREIGN KEY (`ID_MOVIMIENTO`) REFERENCES `tbl_movimientos` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_solicitudes_de_liquidacion`
--

LOCK TABLES `tbl_solicitudes_de_liquidacion` WRITE;
/*!40000 ALTER TABLE `tbl_solicitudes_de_liquidacion` DISABLE KEYS */;
INSERT INTO `tbl_solicitudes_de_liquidacion` VALUES (00000000006,2,'1000000',37,42,'2019-04-16 12:36:24','2019-04-16 12:36:24'),(00000000007,2,'50000',38,42,'2019-04-16 12:39:16','2019-04-16 12:39:16');
/*!40000 ALTER TABLE `tbl_solicitudes_de_liquidacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_valores`
--

DROP TABLE IF EXISTS `tbl_valores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_valores` (
  `ID` int(11) unsigned NOT NULL,
  `NOMBRE` varchar(100) NOT NULL,
  `DESCRIPCION` varchar(250) NOT NULL,
  `ID_ESTADO` varchar(45) NOT NULL DEFAULT '0',
  `CREATED_AT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATED_AT` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_valores`
--

LOCK TABLES `tbl_valores` WRITE;
/*!40000 ALTER TABLE `tbl_valores` DISABLE KEYS */;
INSERT INTO `tbl_valores` VALUES (0,'Tipo de perfil','Sin definir.','0','2019-03-29 17:24:51','2019-04-09 08:50:06'),(1,'Generos','Sin definir.','0','2019-03-29 17:50:09',NULL),(2,'Estado de cuenta','Sin definir.','0','2019-03-29 17:24:51',NULL),(3,'Estado dedicatorias','Sin definir.','0','2019-03-29 17:24:51',NULL),(4,'Mensajes de correo','Con tiene el msj del correo de confirmacion','0','2019-03-29 17:24:51',NULL),(5,'Si y No','Sin definir.','0','2019-03-29 17:24:51',NULL),(6,'Estado de post','Sin definir.','0','2019-03-29 17:24:51',NULL),(7,'Tipo de movimientos','Sin definir.','0','2019-03-29 17:24:51',NULL),(8,'Estado de contratacion','Sin definir.','0','2019-03-29 17:24:51',NULL),(9,'Estados movimientos','Sin definir.','0','2019-04-11 14:26:09',NULL),(10,'Estado de los mensaje de contratacion','Sin definir.','0','2019-04-11 14:26:09',NULL);
/*!40000 ALTER TABLE `tbl_valores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_perfil` int(11) unsigned NOT NULL DEFAULT '0',
  `id_genero` int(11) unsigned DEFAULT '3',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `foto_perfil` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirm_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_estado` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `foto_portada` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_fk1` (`id_perfil`),
  KEY `users_fk2` (`id_genero`),
  KEY `users_fk3` (`id_estado`),
  CONSTRAINT `users_fk1` FOREIGN KEY (`id_perfil`) REFERENCES `tbl_parametros` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,0,3,'Daniel Jose Ruiz Gutierrez','daniel.ruiz@developapp.co','28.jpg','$2y$10$Bx41OtubyGlBjoWg6j.r5eOsuklx/KMRUF8rk71JBzY/hL0zgdTEW','5ooqQgAgyvF5ugdgPFWTXx0XBDheTFtOvcahUxOYVjNUua3b5MyTcFBy0oY3',NULL,9,'2019-03-29 21:45:17','2019-04-16 23:37:07','fondoPerfilArtisata.png'),(2,1,3,'Twister el Rey ','djruizgutierrez@gmail.com','2.jpg','$2y$10$XvploPhtQxfJT6jKZOpAaeRxqkb8Nk3.6S4Omb7izhjdHnzBd/uGC','RQ6Vda3DPfgQNtXKwv3ZHk9ZLHAIXCvRAW3h68moZGpARQ7ocvnwpeMIn9Ad',NULL,9,'2019-03-29 21:45:17','2019-04-17 02:06:13','2.jpg'),(3,1,3,'Piso 21','piso.21@developapp.co','sebastian-yatra-artista-colombiano.jpg','$2y$10$Bx41OtubyGlBjoWg6j.r5eOsuklx/KMRUF8rk71JBzY/hL0zgdTEW',NULL,NULL,9,'2019-03-29 21:45:17',NULL,'fondoPerfilArtisata.png'),(4,1,3,'Sebastián Yatra','sebastian.yatra@developapp.co','sebastian-yatra-artista-colombiano.jpg','$2y$10$Bx41OtubyGlBjoWg6j.r5eOsuklx/KMRUF8rk71JBzY/hL0zgdTEW',NULL,NULL,9,'2019-03-29 21:45:17',NULL,'fondoPerfilArtisata.png'),(5,1,3,'Young F ','young.f@developapp.co','sebastian-yatra-artista-colombiano.jpg','$2y$10$Bx41OtubyGlBjoWg6j.r5eOsuklx/KMRUF8rk71JBzY/hL0zgdTEW',NULL,NULL,9,'2019-03-29 21:45:17',NULL,'fondoPerfilArtisata.png'),(28,2,3,'Daniel Ruiz','jaime.barrios@developapp.co','28.png','$2y$10$K2btI9nvkUWT646tjHxWS.geazRcJx4RfGf2qaMgf2ZtXkE2XWvda','4IKQb511zzxWv0BIHME2aa5LDJTBrYVbI4bSufUxFNM5m5j3PfRdoKJmwmCp',NULL,9,'2019-03-29 21:45:17','2019-04-16 23:35:18','fondoPerfilArtisata.png');
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

-- Dump completed on 2019-04-16 16:10:10
