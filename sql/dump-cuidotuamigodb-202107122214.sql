-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: cuidotuamigodb
-- ------------------------------------------------------
-- Server version	5.7.31

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
-- Table structure for table `atencion`
--

DROP TABLE IF EXISTS `atencion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atencion` (
  `id_atencion` int(11) NOT NULL AUTO_INCREMENT,
  `id_horario` int(11) NOT NULL,
  `id_trabajador` int(11) NOT NULL,
  `id_mascota` int(11) NOT NULL,
  `estado_atencion` varchar(20) NOT NULL,
  PRIMARY KEY (`id_atencion`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atencion`
--

LOCK TABLES `atencion` WRITE;
/*!40000 ALTER TABLE `atencion` DISABLE KEYS */;
INSERT INTO `atencion` VALUES (15,7,2,1,'REALIZADO'),(16,8,2,1,'PENDIENTE'),(17,5,3,1,'PENDIENTE');
/*!40000 ALTER TABLE `atencion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `estado_cliente` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,3,43,'ACTIVO'),(2,NULL,45,'PENDIENTE'),(3,NULL,46,'PENDIENTE');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comuna`
--

DROP TABLE IF EXISTS `comuna`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comuna` (
  `id_comuna` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_comuna` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_comuna`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comuna`
--

LOCK TABLES `comuna` WRITE;
/*!40000 ALTER TABLE `comuna` DISABLE KEYS */;
INSERT INTO `comuna` VALUES (1,'Nunoa'),(2,'Macul');
/*!40000 ALTER TABLE `comuna` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especie`
--

DROP TABLE IF EXISTS `especie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `especie` (
  `id_especie` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_especie` varchar(20) NOT NULL,
  PRIMARY KEY (`id_especie`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especie`
--

LOCK TABLES `especie` WRITE;
/*!40000 ALTER TABLE `especie` DISABLE KEYS */;
INSERT INTO `especie` VALUES (1,'Gato'),(2,'Perro');
/*!40000 ALTER TABLE `especie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Evento Azul','#0071c5','2017-08-01 00:00:00','2017-08-02 00:00:00'),(2,'Eventos 2','#40E0D0','2017-08-02 00:00:00','2017-08-03 00:00:00'),(3,'Doble click para editar evento','#008000','2017-08-03 00:00:00','2017-08-07 00:00:00'),(5,'sad','#40E0D0','2021-06-04 00:00:00','2021-06-05 00:00:00'),(6,'sad','#40E0D0','2021-06-04 00:00:00','2021-06-05 00:00:00'),(7,'','','2021-06-04 00:00:00','2021-06-05 00:00:00'),(8,'','','2021-06-04 00:00:00','2021-06-05 00:00:00'),(9,'','','2021-06-03 00:00:00','2021-06-04 00:00:00'),(10,'','','2021-06-04 00:00:00','2021-06-05 00:00:00');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horario`
--

DROP TABLE IF EXISTS `horario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horario` (
  `id_horario` int(11) NOT NULL AUTO_INCREMENT,
  `id_trabajador` int(11) NOT NULL,
  `nombre_mes` varchar(20) NOT NULL,
  `nombre_dia` varchar(20) NOT NULL,
  `numero_dia` int(11) NOT NULL,
  `hora_dia` time NOT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id_horario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horario`
--

LOCK TABLES `horario` WRITE;
/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
INSERT INTO `horario` VALUES (1,2,'junio','domingo',21,'10:00:00','2021-06-21'),(2,2,'junio','domingo',21,'11:00:00','2021-06-21'),(3,2,'junio','domingo',21,'12:00:00','2021-06-22'),(4,2,'junio','domingo',21,'11:00:00','2021-06-23'),(5,2,'junio','domingo',21,'12:00:00','2021-07-15'),(6,2,'junio','domingo',21,'13:00:00','2021-07-15'),(7,2,'junio','domingo',21,'14:00:00','2021-07-15'),(8,2,'junio','domingo',21,'15:00:00','2021-07-15');
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `usuario` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES ('usuario1','usuario123');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mascota`
--

DROP TABLE IF EXISTS `mascota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mascota` (
  `id_mascota` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `chip_mascota` varchar(50) NOT NULL,
  `id_especie` int(11) DEFAULT NULL,
  `raza` varchar(20) NOT NULL,
  `edad` int(11) NOT NULL,
  `fecha_nacto` date NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `tamanio` varchar(20) NOT NULL,
  `color` varchar(20) NOT NULL,
  `esterilizada` varchar(2) NOT NULL,
  `vacunas` varchar(50) NOT NULL,
  `enfermedad` varchar(50) NOT NULL,
  PRIMARY KEY (`id_mascota`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mascota`
--

LOCK TABLES `mascota` WRITE;
/*!40000 ALTER TABLE `mascota` DISABLE KEYS */;
INSERT INTO `mascota` VALUES (1,1,'blanquito','12345',2,'Mestizo',8,'2012-08-01','Macho','80','Blanco','Si','Al dia','No'),(4,1,'aaa','333',2,'rrr',55,'2021-07-14','Macho','asd','asd','Si','sd','sd'),(5,1,'asd','23',1,'asd',33,'2021-06-30','Hembra','asd','asd','Si','sd','sd');
/*!40000 ALTER TABLE `mascota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil_usuario`
--

DROP TABLE IF EXISTS `perfil_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil_usuario` (
  `id_perfil_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_usuario` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_perfil_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil_usuario`
--

LOCK TABLES `perfil_usuario` WRITE;
/*!40000 ALTER TABLE `perfil_usuario` DISABLE KEYS */;
INSERT INTO `perfil_usuario` VALUES (1,'Paseador'),(2,'Administrador'),(3,'Cliente');
/*!40000 ALTER TABLE `perfil_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL AUTO_INCREMENT,
  `rut` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido_paterno` varchar(50) DEFAULT NULL,
  `apellido_materno` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `id_comuna` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES (5,'1272','Admin','De','Prueba','3343434','nath@gmail.com',NULL,NULL),(6,'11','Pedro','Gonzalez',NULL,'sd','f@f.com',NULL,NULL),(42,'1111','Trab','De','Prueba',NULL,'aaa@dfff.com',NULL,NULL),(43,'22222222-2','Cliente','De','Prueba','Calle 123','cliente@cta.cl','123456789',1),(45,'1','a','d','d','wd','wd','23',2),(46,'2','asd','asd','asd','asd','asd','23',1);
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plan`
--

DROP TABLE IF EXISTS `plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plan` (
  `id_plan` int(11) NOT NULL AUTO_INCREMENT,
  `id_servicio` int(11) DEFAULT NULL,
  `nombre_plan` varchar(50) NOT NULL,
  `caracteristicas` varchar(100) DEFAULT NULL,
  `num_sesiones` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_plan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plan`
--

LOCK TABLES `plan` WRITE;
/*!40000 ALTER TABLE `plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicio`
--

DROP TABLE IF EXISTS `servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicio` (
  `id_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `nombre_servicio` varchar(10) NOT NULL,
  PRIMARY KEY (`id_servicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicio`
--

LOCK TABLES `servicio` WRITE;
/*!40000 ALTER TABLE `servicio` DISABLE KEYS */;
/*!40000 ALTER TABLE `servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_trabajador`
--

DROP TABLE IF EXISTS `tipo_trabajador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_trabajador` (
  `id_tipo_trabajador` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_trab` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tipo_trabajador`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_trabajador`
--

LOCK TABLES `tipo_trabajador` WRITE;
/*!40000 ALTER TABLE `tipo_trabajador` DISABLE KEYS */;
INSERT INTO `tipo_trabajador` VALUES (1,'Paseador'),(2,'Administrador');
/*!40000 ALTER TABLE `tipo_trabajador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trabajador`
--

DROP TABLE IF EXISTS `trabajador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trabajador` (
  `id_trabajador` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_trabajador` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `cargo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_trabajador`)
) ENGINE=InnoDB AUTO_INCREMENT=473 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trabajador`
--

LOCK TABLES `trabajador` WRITE;
/*!40000 ALTER TABLE `trabajador` DISABLE KEYS */;
INSERT INTO `trabajador` VALUES (1,1,1,5,'Paseador'),(2,1,2,42,'Paseador'),(3,1,NULL,6,NULL),(472,1,1,44,'');
/*!40000 ALTER TABLE `trabajador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_perfil_usuario` int(11) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `contrasenia` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,2,'admin@cta.cl','1'),(2,1,'trab@cta.cl','2'),(3,3,'cliente@cta.cl','3');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'cuidotuamigodb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-12 22:14:38
