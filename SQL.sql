-- MariaDB dump 10.19  Distrib 10.5.15-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: u447873769_barberia
-- ------------------------------------------------------
-- Server version	10.5.15-MariaDB-cll-lve

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
-- Table structure for table `acudiente`
--

DROP TABLE IF EXISTS `acudiente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acudiente` (
  `idacudiente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `apellido_uno` varchar(30) NOT NULL,
  `apellido_dos` varchar(30) NOT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `idparentesco` int(11) NOT NULL,
  `numero_documento_cliente` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idacudiente`),
  KEY `idparentesco` (`idparentesco`),
  CONSTRAINT `acudiente_ibfk_1` FOREIGN KEY (`idparentesco`) REFERENCES `parentesco` (`idparentesco`)
) ENGINE=InnoDB AUTO_INCREMENT=9223372036854775807 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acudiente`
--

/*!40000 ALTER TABLE `acudiente` DISABLE KEYS */;
/*!40000 ALTER TABLE `acudiente` ENABLE KEYS */;

--
-- Table structure for table `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asistencia` (
  `idasistencia` int(11) NOT NULL AUTO_INCREMENT,
  `asistencia` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idasistencia`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asistencia`
--

/*!40000 ALTER TABLE `asistencia` DISABLE KEYS */;
INSERT INTO `asistencia` VALUES (1,'No ha asistido'),(2,'Si'),(3,'No');
/*!40000 ALTER TABLE `asistencia` ENABLE KEYS */;

--
-- Table structure for table `cita`
--

DROP TABLE IF EXISTS `cita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cita` (
  `idcita` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idhora` int(10) NOT NULL,
  `total_servicio` int(11) NOT NULL,
  `cant_servicio` int(11) DEFAULT NULL,
  `idcliente` int(11) NOT NULL,
  `idempleado` int(11) NOT NULL,
  `id_estado_cita` int(11) NOT NULL,
  `confirmar` int(2) DEFAULT NULL,
  PRIMARY KEY (`idcita`),
  KEY `idcliente` (`idcliente`),
  KEY `idempleado` (`idempleado`),
  KEY `id_estado_cita` (`id_estado_cita`),
  KEY `idhora` (`idhora`),
  CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`),
  CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`idempleado`),
  CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`id_estado_cita`) REFERENCES `estado_cita` (`id_estado_cita`),
  CONSTRAINT `cita_ibfk_4` FOREIGN KEY (`idhora`) REFERENCES `hora` (`idhora`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cita`
--

/*!40000 ALTER TABLE `cita` DISABLE KEYS */;
INSERT INTO `cita` VALUES (6221211,'2022-12-07',1,18000,NULL,46,1,1,1),(6221261,'2022-12-08',6,18000,NULL,46,1,2,2),(6221271,'2022-12-07',7,30000,NULL,42,1,2,2);
/*!40000 ALTER TABLE `cita` ENABLE KEYS */;

--
-- Table structure for table `clasificacion`
--

DROP TABLE IF EXISTS `clasificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clasificacion` (
  `idclasificacion` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(15) NOT NULL,
  PRIMARY KEY (`idclasificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clasificacion`
--

/*!40000 ALTER TABLE `clasificacion` DISABLE KEYS */;
INSERT INTO `clasificacion` VALUES (1,'Servicio'),(2,'Producto');
/*!40000 ALTER TABLE `clasificacion` ENABLE KEYS */;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `numero_documento_cliente` varchar(15) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido_uno` varchar(30) NOT NULL,
  `apellido_dos` varchar(30) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `fechanacimiento` date NOT NULL,
  `puntaje` int(11) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `contrasena` varchar(100) NOT NULL,
  `idtipodocumento` int(11) NOT NULL,
  `idacudiente` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `token` varchar(150) DEFAULT NULL,
  `rolid` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcliente`),
  UNIQUE KEY `numero_documento_cliente` (`numero_documento_cliente`),
  UNIQUE KEY `telefono` (`telefono`),
  KEY `idtipodocumento` (`idtipodocumento`),
  KEY `rolid` (`rolid`),
  KEY `idacudiente` (`idacudiente`),
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`idtipodocumento`) REFERENCES `tipo_documento` (`idtipodocumento`),
  CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`),
  CONSTRAINT `cliente_ibfk_3` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`),
  CONSTRAINT `cliente_ibfk_4` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`),
  CONSTRAINT `cliente_ibfk_5` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (42,'1152470793','Pablo','Perez','Tapias','3056835836','1998-08-19',NULL,'Correo@gmail.com','5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5',1,0,1,NULL,4),(46,'87878','Jose Alfonso','Lopez','Msa','656563333','2022-10-05',NULL,'yeidyalzate2011@gmail.com','5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5',1,0,1,'',4);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

--
-- Table structure for table `detalle_producto`
--

DROP TABLE IF EXISTS `detalle_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_producto` (
  `id_detalle_producto` int(11) NOT NULL AUTO_INCREMENT,
  `precio` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `idproducto` int(11) NOT NULL,
  `idcita` int(100) NOT NULL,
  PRIMARY KEY (`id_detalle_producto`),
  KEY `idcita` (`idcita`),
  KEY `idproducto` (`idproducto`),
  CONSTRAINT `detalle_producto_ibfk_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_producto`
--

/*!40000 ALTER TABLE `detalle_producto` DISABLE KEYS */;
INSERT INTO `detalle_producto` VALUES (65,30000,'2022-12-07',5,6221271),(66,30000,'2022-12-07',13,6221271),(69,18000,'2022-12-07',5,6221211),(71,18000,'2022-12-08',5,6221261);
/*!40000 ALTER TABLE `detalle_producto` ENABLE KEYS */;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleado` (
  `idempleado` int(11) NOT NULL AUTO_INCREMENT,
  `numero_documento_empleado` varchar(15) NOT NULL,
  `idtipodocumento` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido_uno` varchar(30) NOT NULL,
  `apellido_dos` varchar(30) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `contrasena` varchar(100) NOT NULL,
  `ideps` int(11) NOT NULL,
  `rolid` int(11) NOT NULL,
  `url_foto` varchar(50) DEFAULT NULL,
  `urlcertificado_bioseguridad` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `token` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idempleado`),
  UNIQUE KEY `numero_documento_empleado` (`numero_documento_empleado`),
  KEY `ideps` (`ideps`),
  KEY `idtipodocumento` (`idtipodocumento`),
  KEY `rolid` (`rolid`),
  CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`ideps`) REFERENCES `eps` (`ideps`),
  CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`idtipodocumento`) REFERENCES `tipo_documento` (`idtipodocumento`),
  CONSTRAINT `empleado_ibfk_3` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (1,'12345678',1,'Karina','Mesa','Marin','454445','1997-11-06','yeidyalzate2011@gmail.com','5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5',2,1,NULL,'2',1,''),(34,'42938377',1,'Julian','Martines','Mesa','561545520','2022-09-19','sandro@gmail.com','5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5',2,2,NULL,'2',1,NULL),(36,'77676',1,'Juan','Mesa','Lopes','669898','2022-10-12','MARICastro@gmail.com','5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5',1,2,NULL,'2',1,NULL),(37,'78855',1,'Luis','Mesa','Mesa','5536426','1999-02-10','luis@gmail.com','5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5',1,2,NULL,'1',1,NULL);
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;

--
-- Table structure for table `eps`
--

DROP TABLE IF EXISTS `eps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eps` (
  `ideps` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(15) NOT NULL,
  PRIMARY KEY (`ideps`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eps`
--

/*!40000 ALTER TABLE `eps` DISABLE KEYS */;
INSERT INTO `eps` VALUES (1,'sura'),(2,'savia');
/*!40000 ALTER TABLE `eps` ENABLE KEYS */;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado` (
  `idestado` int(11) NOT NULL AUTO_INCREMENT,
  `des` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idestado`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'Si'),(2,'No');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;

--
-- Table structure for table `estado_cita`
--

DROP TABLE IF EXISTS `estado_cita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_cita` (
  `id_estado_cita` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(12) NOT NULL,
  PRIMARY KEY (`id_estado_cita`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_cita`
--

/*!40000 ALTER TABLE `estado_cita` DISABLE KEYS */;
INSERT INTO `estado_cita` VALUES (1,'Agendada'),(2,'Cumplido'),(3,'Cancelado'),(4,'No asistió'),(5,'Asistio');
/*!40000 ALTER TABLE `estado_cita` ENABLE KEYS */;

--
-- Table structure for table `estudio`
--

DROP TABLE IF EXISTS `estudio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estudio` (
  `idestudio` int(11) NOT NULL AUTO_INCREMENT,
  `titulacion` varchar(50) NOT NULL,
  `institucion` varchar(50) NOT NULL,
  `tiempo_estudio` varchar(15) NOT NULL,
  `url_certificado` varchar(50) DEFAULT NULL,
  `idempleado` int(11) NOT NULL,
  `idtipoestudio` int(11) NOT NULL,
  PRIMARY KEY (`idestudio`),
  UNIQUE KEY `idempleado` (`idempleado`),
  KEY `estudio_ibfk_1` (`idtipoestudio`),
  CONSTRAINT `estudio_ibfk_1` FOREIGN KEY (`idtipoestudio`) REFERENCES `tipo_estudio` (`idtipoestudio`),
  CONSTRAINT `estudio_ibfk_2` FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`idempleado`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estudio`
--

/*!40000 ALTER TABLE `estudio` DISABLE KEYS */;
INSERT INTO `estudio` VALUES (24,'Yy','Yyy','Yy','1',1,1),(26,'Gg','Ggg','Ggg','1',34,1),(27,'Kjhkj','Ljkh','Ljhjkh','2',36,1);
/*!40000 ALTER TABLE `estudio` ENABLE KEYS */;

--
-- Table structure for table `experiencia_laboral`
--

DROP TABLE IF EXISTS `experiencia_laboral`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `experiencia_laboral` (
  `idexp_laboral` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(30) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `idempleado` int(11) NOT NULL,
  PRIMARY KEY (`idexp_laboral`),
  KEY `idempleado` (`idempleado`),
  CONSTRAINT `experiencia_laboral_ibfk_1` FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`idempleado`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experiencia_laboral`
--

/*!40000 ALTER TABLE `experiencia_laboral` DISABLE KEYS */;
INSERT INTO `experiencia_laboral` VALUES (15,'Yy','2022-08-18','2022-08-10','Jg',1),(17,'Ggg','2022-08-31','2022-09-06','Ggg',34),(18,'Mbmb','2022-10-04','2022-10-20','Jj',36);
/*!40000 ALTER TABLE `experiencia_laboral` ENABLE KEYS */;

--
-- Table structure for table `hora`
--

DROP TABLE IF EXISTS `hora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hora` (
  `idhora` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idhora`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hora`
--

/*!40000 ALTER TABLE `hora` DISABLE KEYS */;
INSERT INTO `hora` VALUES (1,'9:00 AM'),(2,'10:00 AM'),(3,'11:00 AM'),(4,'12:00 PM'),(5,'1:00 PM'),(6,'2:00 PM'),(7,'3:00 PM'),(8,'4:00 PM'),(9,'5:00 PM'),(10,'6:00 PM');
/*!40000 ALTER TABLE `hora` ENABLE KEYS */;

--
-- Table structure for table `imagen`
--

DROP TABLE IF EXISTS `imagen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idproducto` int(11) NOT NULL,
  `img` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idproducto` (`idproducto`),
  CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagen`
--

/*!40000 ALTER TABLE `imagen` DISABLE KEYS */;
INSERT INTO `imagen` VALUES (2,5,'pro_2c162b033883cbb6581901eac64829a2.jpg'),(18,15,'pro_febce6380e422ec54e07bd6e6b995a10.jpg');
/*!40000 ALTER TABLE `imagen` ENABLE KEYS */;

--
-- Table structure for table `marca`
--

DROP TABLE IF EXISTS `marca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marca` (
  `idmarca` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`idmarca`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marca`
--

/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
INSERT INTO `marca` VALUES (1,'N17'),(3,'Cortapelos Philips HC7650/15'),(4,'Remington'),(7,'profesional de KYG'),(8,'Alizz'),(9,'KALLEY'),(10,'Bohemian');
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;

--
-- Table structure for table `modulo`
--

DROP TABLE IF EXISTS `modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulo` (
  `idmodulo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(20) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`idmodulo`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulo`
--

/*!40000 ALTER TABLE `modulo` DISABLE KEYS */;
INSERT INTO `modulo` VALUES (1,'Dashboard','l',1),(2,'Gestion de usuario','l',1),(3,'cliente',NULL,1),(4,'productos y servicio',NULL,1),(5,'citas',NULL,1),(6,'categorias',NULL,1),(7,'Citas cliente',NULL,1),(8,'Citas empleado',NULL,1),(9,'roles',NULL,1),(10,'Productos',NULL,1),(11,'Acudiente','Datos del Acudiente',1),(12,'Empleados','nada',1),(13,'Servicios','servicios',1);
/*!40000 ALTER TABLE `modulo` ENABLE KEYS */;

--
-- Table structure for table `parentesco`
--

DROP TABLE IF EXISTS `parentesco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parentesco` (
  `idparentesco` int(11) NOT NULL AUTO_INCREMENT,
  `descrip` varchar(15) NOT NULL,
  PRIMARY KEY (`idparentesco`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parentesco`
--

/*!40000 ALTER TABLE `parentesco` DISABLE KEYS */;
INSERT INTO `parentesco` VALUES (1,'Ninguno'),(2,'Madre'),(3,'Padre'),(4,'Abuelo(a)');
/*!40000 ALTER TABLE `parentesco` ENABLE KEYS */;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisos` (
  `idpermiso` int(11) NOT NULL AUTO_INCREMENT,
  `rolid` int(11) DEFAULT NULL,
  `moduloid` int(11) DEFAULT NULL,
  `r` int(11) DEFAULT NULL,
  `w` int(11) DEFAULT NULL,
  `u` int(11) DEFAULT NULL,
  `d` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpermiso`),
  KEY `rolid` (`rolid`),
  KEY `moduloid` (`moduloid`),
  CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`),
  CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`moduloid`) REFERENCES `modulo` (`idmodulo`)
) ENGINE=InnoDB AUTO_INCREMENT=908 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` VALUES (739,4,1,1,1,1,1),(740,4,2,0,0,0,0),(741,4,3,0,0,0,0),(742,4,4,0,0,0,0),(743,4,5,0,0,0,0),(744,4,6,0,0,0,0),(745,4,7,1,1,1,1),(746,4,8,0,0,0,0),(747,4,9,0,0,0,1),(748,4,10,0,0,0,0),(749,4,11,0,0,0,0),(750,4,12,0,0,0,0),(751,4,13,0,0,0,0),(791,2,1,1,1,1,1),(792,2,2,0,0,0,0),(793,2,3,0,0,0,0),(794,2,4,0,0,0,0),(795,2,5,0,0,0,0),(796,2,6,0,0,0,0),(797,2,7,0,0,0,0),(798,2,8,1,1,1,1),(799,2,9,0,0,0,0),(800,2,10,0,0,0,0),(801,2,11,0,0,0,0),(802,2,12,0,0,0,0),(803,2,13,0,0,0,0),(895,1,1,1,1,1,1),(896,1,2,1,1,1,1),(897,1,3,1,1,1,1),(898,1,4,1,1,1,1),(899,1,5,1,1,1,1),(900,1,6,1,1,1,1),(901,1,7,0,0,0,0),(902,1,8,1,1,1,1),(903,1,9,1,1,1,1),(904,1,10,1,1,1,1),(905,1,11,1,1,1,1),(906,1,12,1,1,1,1),(907,1,13,1,1,1,1);
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;

--
-- Table structure for table `pma__bookmark`
--

DROP TABLE IF EXISTS `pma__bookmark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pma__bookmark` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pma__bookmark`
--

/*!40000 ALTER TABLE `pma__bookmark` DISABLE KEYS */;
/*!40000 ALTER TABLE `pma__bookmark` ENABLE KEYS */;

--
-- Table structure for table `pma__central_columns`
--

DROP TABLE IF EXISTS `pma__central_columns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin DEFAULT NULL,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`db_name`,`col_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pma__central_columns`
--

/*!40000 ALTER TABLE `pma__central_columns` DISABLE KEYS */;
/*!40000 ALTER TABLE `pma__central_columns` ENABLE KEYS */;

--
-- Table structure for table `pma__column_info`
--

DROP TABLE IF EXISTS `pma__column_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pma__column_info` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pma__column_info`
--

/*!40000 ALTER TABLE `pma__column_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `pma__column_info` ENABLE KEYS */;

--
-- Table structure for table `pma__designer_settings`
--

DROP TABLE IF EXISTS `pma__designer_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pma__designer_settings`
--

/*!40000 ALTER TABLE `pma__designer_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `pma__designer_settings` ENABLE KEYS */;

--
-- Table structure for table `pma__export_templates`
--

DROP TABLE IF EXISTS `pma__export_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pma__export_templates` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pma__export_templates`
--

/*!40000 ALTER TABLE `pma__export_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `pma__export_templates` ENABLE KEYS */;

--
-- Table structure for table `pma__favorite`
--

DROP TABLE IF EXISTS `pma__favorite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pma__favorite`
--

/*!40000 ALTER TABLE `pma__favorite` DISABLE KEYS */;
/*!40000 ALTER TABLE `pma__favorite` ENABLE KEYS */;

--
-- Table structure for table `pma__history`
--

DROP TABLE IF EXISTS `pma__history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pma__history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`,`db`,`table`,`timevalue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pma__history`
--

/*!40000 ALTER TABLE `pma__history` DISABLE KEYS */;
/*!40000 ALTER TABLE `pma__history` ENABLE KEYS */;

--
-- Table structure for table `pma__navigationhiding`
--

DROP TABLE IF EXISTS `pma__navigationhiding`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pma__navigationhiding`
--

/*!40000 ALTER TABLE `pma__navigationhiding` DISABLE KEYS */;
/*!40000 ALTER TABLE `pma__navigationhiding` ENABLE KEYS */;

--
-- Table structure for table `pma__pdf_pages`
--

DROP TABLE IF EXISTS `pma__pdf_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`page_nr`),
  KEY `db_name` (`db_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pma__pdf_pages`
--

/*!40000 ALTER TABLE `pma__pdf_pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pma__pdf_pages` ENABLE KEYS */;

--
-- Table structure for table `pma__recent`
--

DROP TABLE IF EXISTS `pma__recent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pma__recent`
--

/*!40000 ALTER TABLE `pma__recent` DISABLE KEYS */;
INSERT INTO `pma__recent` VALUES ('u447873769_root','[{\"db\":\"u447873769_barberia\",\"table\":\"producto\"},{\"db\":\"u447873769_barberia\",\"table\":\"proveedor\"},{\"db\":\"u447873769_barberia\",\"table\":\"marca\"},{\"db\":\"u447873769_barberia\",\"table\":\"unidad_medida\"}]');
/*!40000 ALTER TABLE `pma__recent` ENABLE KEYS */;

--
-- Table structure for table `pma__relation`
--

DROP TABLE IF EXISTS `pma__relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  KEY `foreign_field` (`foreign_db`,`foreign_table`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pma__relation`
--

/*!40000 ALTER TABLE `pma__relation` DISABLE KEYS */;
/*!40000 ALTER TABLE `pma__relation` ENABLE KEYS */;

--
-- Table structure for table `pma__savedsearches`
--

DROP TABLE IF EXISTS `pma__savedsearches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pma__savedsearches` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pma__savedsearches`
--

/*!40000 ALTER TABLE `pma__savedsearches` DISABLE KEYS */;
/*!40000 ALTER TABLE `pma__savedsearches` ENABLE KEYS */;

--
-- Table structure for table `pma__table_coords`
--

DROP TABLE IF EXISTS `pma__table_coords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float unsigned NOT NULL DEFAULT 0,
  `y` float unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pma__table_coords`
--

/*!40000 ALTER TABLE `pma__table_coords` DISABLE KEYS */;
/*!40000 ALTER TABLE `pma__table_coords` ENABLE KEYS */;

--
-- Table structure for table `pma__table_info`
--

DROP TABLE IF EXISTS `pma__table_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`db_name`,`table_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pma__table_info`
--

/*!40000 ALTER TABLE `pma__table_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `pma__table_info` ENABLE KEYS */;

--
-- Table structure for table `pma__table_uiprefs`
--

DROP TABLE IF EXISTS `pma__table_uiprefs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`username`,`db_name`,`table_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pma__table_uiprefs`
--

/*!40000 ALTER TABLE `pma__table_uiprefs` DISABLE KEYS */;
/*!40000 ALTER TABLE `pma__table_uiprefs` ENABLE KEYS */;

--
-- Table structure for table `pma__tracking`
--

DROP TABLE IF EXISTS `pma__tracking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) unsigned NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin DEFAULT NULL,
  `data_sql` longtext COLLATE utf8_bin DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`db_name`,`table_name`,`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pma__tracking`
--

/*!40000 ALTER TABLE `pma__tracking` DISABLE KEYS */;
/*!40000 ALTER TABLE `pma__tracking` ENABLE KEYS */;

--
-- Table structure for table `pma__userconfig`
--

DROP TABLE IF EXISTS `pma__userconfig`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pma__userconfig`
--

/*!40000 ALTER TABLE `pma__userconfig` DISABLE KEYS */;
INSERT INTO `pma__userconfig` VALUES ('u447873769_root','2022-12-06 23:20:17','{\"lang\":\"es\",\"Console\\/Mode\":\"collapse\"}');
/*!40000 ALTER TABLE `pma__userconfig` ENABLE KEYS */;

--
-- Table structure for table `pma__usergroups`
--

DROP TABLE IF EXISTS `pma__usergroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N',
  PRIMARY KEY (`usergroup`,`tab`,`allowed`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pma__usergroups`
--

/*!40000 ALTER TABLE `pma__usergroups` DISABLE KEYS */;
/*!40000 ALTER TABLE `pma__usergroups` ENABLE KEYS */;

--
-- Table structure for table `pma__users`
--

DROP TABLE IF EXISTS `pma__users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`,`usergroup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pma__users`
--

/*!40000 ALTER TABLE `pma__users` DISABLE KEYS */;
/*!40000 ALTER TABLE `pma__users` ENABLE KEYS */;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `medida` varchar(10) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `puntos_producto` int(11) DEFAULT NULL,
  `idimagen` int(50) DEFAULT NULL,
  `duracion_servicio` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `idmarca` int(11) NOT NULL,
  `idproveedor` int(11) DEFAULT NULL,
  `idtipoproducto` int(11) DEFAULT NULL,
  `idunidadmedida` int(11) DEFAULT NULL,
  `idtiposervicio` int(11) NOT NULL,
  `idclasificacion` int(11) NOT NULL,
  PRIMARY KEY (`idproducto`),
  KEY `idclasificacion` (`idclasificacion`),
  KEY `idtipoproducto` (`idtipoproducto`),
  KEY `idmarca` (`idmarca`),
  KEY `idunidadmedida` (`idunidadmedida`),
  KEY `idtiposervicio` (`idtiposervicio`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idclasificacion`) REFERENCES `clasificacion` (`idclasificacion`),
  CONSTRAINT `producto_ibfk_10` FOREIGN KEY (`idunidadmedida`) REFERENCES `unidad_medida` (`idunidadmedida`),
  CONSTRAINT `producto_ibfk_11` FOREIGN KEY (`idunidadmedida`) REFERENCES `unidad_medida` (`idunidadmedida`),
  CONSTRAINT `producto_ibfk_12` FOREIGN KEY (`idunidadmedida`) REFERENCES `unidad_medida` (`idunidadmedida`),
  CONSTRAINT `producto_ibfk_13` FOREIGN KEY (`idunidadmedida`) REFERENCES `unidad_medida` (`idunidadmedida`),
  CONSTRAINT `producto_ibfk_14` FOREIGN KEY (`idtiposervicio`) REFERENCES `tipo_servicio` (`idtiposervicio`),
  CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`idmarca`) REFERENCES `marca` (`idmarca`),
  CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`idunidadmedida`) REFERENCES `unidad_medida` (`idunidadmedida`),
  CONSTRAINT `producto_ibfk_4` FOREIGN KEY (`idunidadmedida`) REFERENCES `unidad_medida` (`idunidadmedida`),
  CONSTRAINT `producto_ibfk_5` FOREIGN KEY (`idtipoproducto`) REFERENCES `tipo_producto` (`idtipoproducto`),
  CONSTRAINT `producto_ibfk_6` FOREIGN KEY (`idmarca`) REFERENCES `marca` (`idmarca`),
  CONSTRAINT `producto_ibfk_7` FOREIGN KEY (`idmarca`) REFERENCES `marca` (`idmarca`),
  CONSTRAINT `producto_ibfk_8` FOREIGN KEY (`idunidadmedida`) REFERENCES `unidad_medida` (`idunidadmedida`),
  CONSTRAINT `producto_ibfk_9` FOREIGN KEY (`idtiposervicio`) REFERENCES `tipo_servicio` (`idtiposervicio`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (5,'Corte general','0',1,18000,0,NULL,30,'<p>ddfghxfgd</p>',1,1,0,1,NULL,1,1),(13,'Limpieza facial',NULL,0,12000,NULL,NULL,0,'<ul> <li>fsdfsd</li> <li>f</li> <li>f</li> </ul>',0,1,NULL,NULL,NULL,1,1),(15,'Mascarilla de café',NULL,0,15000,NULL,NULL,0,'<p>ff</p>',1,1,NULL,NULL,NULL,1,1),(16,'maquina','1',0,0,NULL,NULL,0,'<p>fff</p>',1,1,1,NULL,NULL,1,2),(22,'espejo','150',2,0,NULL,NULL,0,'<p>kgjk</p>',1,4,3,NULL,5,11,2);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;

--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedor` (
  `idproveedor` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idproveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedor`
--

/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` VALUES (1,'BabyList'),(2,'Alizz'),(3,'Fabrica royal'),(4,'Feliz tienda'),(5,'Fabrica royal');
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL AUTO_INCREMENT,
  `nombrerol` varchar(50) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=556 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'Administrador','admin',1),(2,'Barbero','Empleado',1),(3,'manicurista','arregla manos',0),(4,'cliente','cliente',1),(5,'Estilista','Corta cabelllo para damas',0),(555,'manicurista de manos','eww',1);
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;

--
-- Table structure for table `tipo_documento`
--

DROP TABLE IF EXISTS `tipo_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_documento` (
  `idtipodocumento` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(20) NOT NULL,
  PRIMARY KEY (`idtipodocumento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_documento`
--

/*!40000 ALTER TABLE `tipo_documento` DISABLE KEYS */;
INSERT INTO `tipo_documento` VALUES (1,'Cedula'),(2,'Tarjeta de identidad');
/*!40000 ALTER TABLE `tipo_documento` ENABLE KEYS */;

--
-- Table structure for table `tipo_estudio`
--

DROP TABLE IF EXISTS `tipo_estudio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_estudio` (
  `idtipoestudio` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(30) NOT NULL,
  PRIMARY KEY (`idtipoestudio`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_estudio`
--

/*!40000 ALTER TABLE `tipo_estudio` DISABLE KEYS */;
INSERT INTO `tipo_estudio` VALUES (1,'certificado'),(2,'carrera'),(3,'Tecnica'),(4,'Ninguno');
/*!40000 ALTER TABLE `tipo_estudio` ENABLE KEYS */;

--
-- Table structure for table `tipo_producto`
--

DROP TABLE IF EXISTS `tipo_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_producto` (
  `idtipoproducto` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(15) NOT NULL,
  PRIMARY KEY (`idtipoproducto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_producto`
--

/*!40000 ALTER TABLE `tipo_producto` DISABLE KEYS */;
INSERT INTO `tipo_producto` VALUES (1,'peinilla'),(2,'peinilla');
/*!40000 ALTER TABLE `tipo_producto` ENABLE KEYS */;

--
-- Table structure for table `tipo_servicio`
--

DROP TABLE IF EXISTS `tipo_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_servicio` (
  `idtiposervicio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) DEFAULT NULL,
  `descripcion` varchar(50) NOT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`idtiposervicio`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_servicio`
--

/*!40000 ALTER TABLE `tipo_servicio` DISABLE KEYS */;
INSERT INTO `tipo_servicio` VALUES (1,'Categoria de cortes','fotos de los co',1),(9,'Categoria de barbas','varbas',1),(10,'ddada','dsds',0),(11,'Producto de la barberia','dklkd',1),(12,'Categoría de maquinas','maquinass',1),(13,'Categoría facial','Categoría facial',1);
/*!40000 ALTER TABLE `tipo_servicio` ENABLE KEYS */;

--
-- Table structure for table `unidad_medida`
--

DROP TABLE IF EXISTS `unidad_medida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidad_medida` (
  `idunidadmedida` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(15) NOT NULL,
  PRIMARY KEY (`idunidadmedida`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidad_medida`
--

/*!40000 ALTER TABLE `unidad_medida` DISABLE KEYS */;
INSERT INTO `unidad_medida` VALUES (1,'Litros'),(2,'Militros'),(3,'Hectómetro'),(4,'Decímetro'),(5,'Centímetro'),(6,'Milímetro'),(7,'Metro');
/*!40000 ALTER TABLE `unidad_medida` ENABLE KEYS */;

--
-- Dumping routines for database 'u447873769_barberia'
--
/*!50003 DROP PROCEDURE IF EXISTS `ps_buscar_empleado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`u447873769_root`@`127.0.0.1` PROCEDURE `ps_buscar_empleado`(`v_idempleado` INT)
BEGIN

SELECT * FROM  estudio where idempleado = v_idempleado;

SELECT * FROM experiencia_laboral where idempleado = v_idempleado;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ps_historial_empleado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`u447873769_root`@`127.0.0.1` PROCEDURE `ps_historial_empleado`(`v_EMPLEADO` INT, `v_titulacion` VARCHAR(50), `v_institucion` VARCHAR(50), `v_tiempo` VARCHAR(50), `v_certificado` VARCHAR(10), `v_tipo_estudio` INT, `v_nombre_empresa` VARCHAR(5), `v_fecha_inicio` DATE, `v_fecha_final` DATE, `v_descripcion` VARCHAR(100))
BEGIN


INSERT INTO `estudio` (`titulacion`, `institucion`, `tiempo_estudio`, `url_certificado`, `idempleado`, `idtipoestudio`) VALUES 
( v_titulacion , v_institucion, v_tiempo, v_certificado, v_EMPLEADO,  v_tipo_estudio);

INSERT INTO `experiencia_laboral` ( `nombre_empresa`, `fecha_inicio`, `fecha_final`, `descripcion`, `idempleado`) VALUES
 ( v_nombre_empresa, v_fecha_inicio, v_fecha_final, v_descripcion, v_EMPLEADO);


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sps_eliminar_empleado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`u447873769_root`@`127.0.0.1` PROCEDURE `sps_eliminar_empleado`(`v_idEmpleado` INT)
BEGIN
DELETE FROM `estudio` WHERE `idempleado` = v_idEmpleado;

DELETE FROM `experiencia_laboral` WHERE `idempleado` = v_idEmpleado;

DELETE FROM `empleado` WHERE `empleado`.`idempleado` = v_idEmpleado;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_actualizarAcudiente` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`u447873769_root`@`127.0.0.1` PROCEDURE `sp_actualizarAcudiente`(`v_idacudiente` INT, `v_numeroDo` INT, `v_nombre` VARCHAR(30), `v_apellido_uno` VARCHAR(30), `v_apellido_dos` VARCHAR(30), `v_telefono` INT, `v_correo` VARCHAR(50), `v_parentesco` INT)
BEGIN

UPDATE `acudiente` SET `idacudiente` = v_numeroDo, `nombre` = v_nombre, `apellido_uno` = v_apellido_uno, `apellido_dos` = v_apellido_dos, 
`telefono` = v_telefono, `correo` = v_correo, `idparentesco` = v_parentesco WHERE (`idacudiente` = v_idacudiente);

UPDATE `barberia`.`cliente` SET `idacudiente` = v_numeroDo WHERE (`idacudiente` = v_idacudiente);


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_actualizarEm` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`u447873769_root`@`127.0.0.1` PROCEDURE `SP_actualizarEm`(IN `v_EMPLEADO` INT, IN `v_numeroDo` VARCHAR(15), IN `v_idTipoDocumento` INT, IN `v_nombre` VARCHAR(30), IN `v_apellido_uno` VARCHAR(30), IN `v_apellido_dos` VARCHAR(30), IN `v_telefono` INT, IN `v_fecha_nacimiento` DATE, IN `v_correo` VARCHAR(50), IN `v_contrasena` VARCHAR(100), IN `v_ideps` INT, IN `v_rolid` INT, IN `v_cerBio` VARCHAR(50), IN `v_titulacion` VARCHAR(50), IN `v_institucion` VARCHAR(50), IN `v_tiempo` VARCHAR(50), IN `v_cerEstu` VARCHAR(50), IN `v_tipo_estudio` INT, IN `v_nombre_empresa` VARCHAR(5), IN `v_fecha_inicio` DATE, IN `v_fecha_final` DATE, IN `v_descripcion` VARCHAR(100))
BEGIN


UPDATE `empleado` SET `numero_documento_empleado` = v_numeroDo, `idtipodocumento` = v_idTipoDocumento, `nombre` = v_nombre, `apellido_uno` = v_apellido_uno,
 `apellido_dos` = v_apellido_dos, `telefono` = v_telefono, `fecha_nacimiento` = v_fecha_nacimiento, 
 `correo` = v_correo, `contrasena` = v_contrasena ,`ideps` =  v_ideps, `rolid` = v_rolid, `urlcertificado_bioseguridad` =v_cerBio WHERE (`idempleado` = v_EMPLEADO);

UPDATE `estudio` SET `titulacion` = v_titulacion, `institucion` = v_institucion, `tiempo_estudio` = v_tiempo, `idtipoestudio` = v_tipo_estudio, `url_certificado`  =v_cerEstu WHERE (`idempleado` = v_EMPLEADO);

UPDATE `experiencia_laboral` SET `nombre_empresa` = v_nombre_empresa, `fecha_inicio` = v_fecha_inicio, `fecha_final` = v_fecha_final, `descripcion` = v_descripcion WHERE (`idempleado` = v_EMPLEADO);


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_actualizarMSC` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`u447873769_root`@`127.0.0.1` PROCEDURE `SP_actualizarMSC`(IN `v_EMPLEADO` INT, IN `v_numeroDo` VARCHAR(15), IN `v_idTipoDocumento` INT, IN `v_nombre` VARCHAR(30), IN `v_apellido_uno` VARCHAR(30), IN `v_apellido_dos` VARCHAR(30), IN `v_telefono` INT, IN `v_fecha_nacimiento` DATE, IN `v_correo` VARCHAR(50), IN `v_ideps` INT, IN `v_rolid` INT, IN `v_cerBio` VARCHAR(50), IN `v_titulacion` VARCHAR(50), IN `v_institucion` VARCHAR(50), IN `v_tiempo` VARCHAR(50), IN `v_cerEstu` VARCHAR(50), IN `v_tipo_estudio` INT, IN `v_nombre_empresa` VARCHAR(5), IN `v_fecha_inicio` DATE, IN `v_fecha_final` DATE, IN `v_descripcion` VARCHAR(100))
BEGIN

UPDATE `empleado` SET `numero_documento_empleado` = v_numeroDo, `idtipodocumento` = v_idTipoDocumento, `nombre` = v_nombre, `apellido_uno` = v_apellido_uno,
 `apellido_dos` = v_apellido_dos, `telefono` = v_telefono, `fecha_nacimiento` = v_fecha_nacimiento, 
 `correo` = v_correo,`ideps` =  v_ideps, `rolid` = v_rolid, `urlcertificado_bioseguridad` =v_cerBio  WHERE (`idempleado` = v_EMPLEADO);


UPDATE `estudio` SET `titulacion` = v_titulacion, `institucion` = v_institucion, `tiempo_estudio` = v_tiempo, `idtipoestudio` = v_tipo_estudio, `url_certificado`  = v_cerEstu WHERE (`idempleado` = v_EMPLEADO);


UPDATE `experiencia_laboral` SET `nombre_empresa` = v_nombre_empresa, `fecha_inicio` = v_fecha_inicio, `fecha_final` = v_fecha_final, `descripcion` = v_descripcion WHERE (`idempleado` = v_EMPLEADO);


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_actualizar_empleado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`u447873769_root`@`127.0.0.1` PROCEDURE `SP_actualizar_empleado`(`v_EMPLEADO` INT, `v_numeroDo` VARCHAR(15), `v_idTipoDocumento` INT, `v_nombre` VARCHAR(30), `v_apellido_uno` VARCHAR(30), `v_apellido_dos` VARCHAR(30), `v_telefono` INT, `v_fecha_nacimiento` DATE, `v_correo` VARCHAR(50), `contrasena` VARCHAR(10), `v_ideps` INT, `v_rolid` INT, `v_titulacion` VARCHAR(50), `v_institucion` VARCHAR(50), `v_tiempo` VARCHAR(50), `v_tipo_estudio` INT, `v_nombre_empresa` VARCHAR(5), `v_fecha_inicio` DATE, `v_fecha_final` DATE, `v_descripcion` VARCHAR(100))
BEGIN


UPDATE `empleado` SET `numero_documento_empleado` = v_numeroDo, `idtipodocumento` = v_idTipoDocumento, `nombre` = v_nombre, `apellido_uno` = v_apellido_uno,
 `apellido_dos` = v_apellido_dos, `telefono` = v_telefono, `fecha_nacimiento` = v_fecha_nacimiento, 
 `correo` = v_correo,  `contrasena`=contrasena ,`ideps` =  v_ideps, `rolid` = v_rolid WHERE (`idempleado` = v_EMPLEADO);
UPDATE `estudio` SET `titulacion` = v_titulacion, `institucion` = v_institucion, `tiempo_estudio` = v_tiempo, `idtipoestudio` = v_tipo_estudio WHERE (`idempleado` = v_EMPLEADO);
UPDATE `experiencia_laboral` SET `nombre_empresa` = v_nombre_empresa, `fecha_inicio` = v_fecha_inicio, `fecha_final` = v_fecha_final, `descripcion` = v_descripcion WHERE (`idempleado` = v_EMPLEADO);


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_agendarCita` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`u447873769_root`@`127.0.0.1` PROCEDURE `sp_agendarCita`(`idCita` INT, `v_documentoCliente` INT, `v_fechaCita` DATE, `v_hora` INT, `v_idEmpleado` INT, `v_arrayPeoductos` VARCHAR(30), `v_idEstado` INT, `v_total` INT)
BEGIN

declare V_CodigoCita varchar(30);    


INSERT INTO `cita` (`idcita`, `fecha`, `idhora`, `total_servicio`, `cant_servicio`, 
`idcliente`, `idempleado`, `id_estado_cita`) 
VALUES (NULL, v_fechaCita, v_hora, v_total, NULL, v_documentoCliente, v_idEmpleado, v_idEstado);

SELECT V_CodigoCita = idcita FROM cita where 
fecha=v_fechaCita 
and idhora=v_hora 
and total_servicio= v_total 
and idcliente = v_documentoCliente
and idempleado= v_idEmpleado 
and id_estado_cita = v_idEstado;


INSERT INTO `detalle_producto` (`id_detalle_producto`, `precio`, `fecha`, `idproducto`, `idcita`)
 VALUES (NULL, v_total, v_fechaCita, v_arrayPeoductos, idCita);/*?*/

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_agregarToken` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`u447873769_root`@`127.0.0.1` PROCEDURE `sp_agregarToken`(`v_id` INT, `v_token` VARCHAR(150))
BEGIN
UPDATE cliente SET token = v_token WHERE idcliente = v_id;
UPDATE empleado SET token = v_token WHERE idempleado = v_id;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_BuscarCorreo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`u447873769_root`@`127.0.0.1` PROCEDURE `sp_BuscarCorreo`(`v_correo` VARCHAR(50))
BEGIN


SELECT idempleado,nombre,apellido_uno,apellido_dos,status FROM empleado where correo =v_correo and status = 1;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_eliminarCita` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`u447873769_root`@`127.0.0.1` PROCEDURE `sp_eliminarCita`(`v_idcita` INT)
BEGIN
DELETE FROM `cita` WHERE `idcita` = v_idcita;

DELETE FROM `detalle_producto` WHERE idcita = v_idcita;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_eliminarCliente` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`u447873769_root`@`127.0.0.1` PROCEDURE `sp_eliminarCliente`(IN `v_idcliente` INT)
BEGIN
DELETE FROM acudiente WHERE numero_documento_cliente = (select numero_documento_cliente from cliente where idcliente = v_idcliente);
DELETE FROM cliente WHERE idcliente = v_idcliente;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_eliminar_empleado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`u447873769_root`@`127.0.0.1` PROCEDURE `sp_eliminar_empleado`(`v_idEmpleado` INT)
BEGIN
DELETE FROM `estudio` WHERE `idempleado` = v_idEmpleado;

DELETE FROM `experiencia_laboral` WHERE `idempleado` = v_idEmpleado;

DELETE FROM `empleado` WHERE `empleado`.`idempleado` = v_idEmpleado;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_guardarCliente` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`u447873769_root`@`127.0.0.1` PROCEDURE `sp_guardarCliente`(IN `v_numerocliente` INT, IN `v_idTipoDocumento` INT, IN `v_nombre` VARCHAR(15), IN `v_apellido_uno` VARCHAR(15), IN `v_apellido_dos` VARCHAR(15), IN `v_telefono` INT, IN `v_fecha_nacimiento` DATE, IN `v_correo` VARCHAR(50), IN `v_contrasena` VARCHAR(100), IN `v_status` INT, IN `v_rol` INT, IN `v_idacudiente` INT, IN `v_nombreP` VARCHAR(15), IN `v_apellido_unoP` VARCHAR(15), IN `v_apellido_dosP` VARCHAR(15), IN `v_telefonoP` INT, IN `v_correoP` VARCHAR(50), IN `v_parentescoP` INT)
BEGIN

	IF v_nombreP = '' THEN
	 
		INSERT INTO `cliente` (`numero_documento_cliente`, `nombre`, `apellido_uno`, `apellido_dos`, `telefono`, `fechanacimiento`,  `correo`, `contrasena`, `idtipodocumento` ,
		`idacudiente`, `status`, `rolid`) VALUES
		 (v_numerocliente, v_nombre, v_apellido_uno, v_apellido_dos, v_telefono, v_fecha_nacimiento, v_correo, v_contrasena, v_idTipoDocumento, v_idacudiente,v_status, v_rol);

	ELSE 
		INSERT INTO `cliente` (`numero_documento_cliente`, `nombre`, `apellido_uno`, `apellido_dos`, `telefono`, `fechanacimiento`,  `correo`, `contrasena`, `idtipodocumento` ,
		`idacudiente`, `status`, `rolid`) VALUES
		 (v_numerocliente, v_nombre, v_apellido_uno, v_apellido_dos, v_telefono, v_fecha_nacimiento, v_correo, v_contrasena, v_idTipoDocumento, v_idacudiente,v_status, v_rol);

		INSERT INTO `barberia`.`acudiente` (`idacudiente`, `nombre`, `apellido_uno`, `apellido_dos`, `telefono`, `correo`, `idparentesco`,`numero_documento_cliente` ) VALUES (v_idacudiente, v_nombreP, v_apellido_unoP, v_apellido_dosP, v_telefonoP, v_correoP, v_parentescoP, v_numerocliente);
	END IF;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_inicioSesion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`u447873769_root`@`127.0.0.1` PROCEDURE `sp_inicioSesion`(`v_NumDocumento` VARCHAR(30), `v_contrasena` VARCHAR(100))
BEGIN


SELECT idcliente, status FROM cliente where numero_documento_cliente=
         v_NumDocumento  and  contrasena =v_contrasena and status != 0;

SELECT idempleado, status FROM empleado where numero_documento_empleado=
         v_NumDocumento  and  contrasena =v_contrasena and status != 0;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_mostrarRol` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`u447873769_root`@`127.0.0.1` PROCEDURE `sp_mostrarRol`(`v_idrol` INT)
BEGIN

SELECT * FROM empleado WHERE rolid =v_idrol;

SELECT * FROM cliente WHERE rolid =v_idrol;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-11  1:38:12
