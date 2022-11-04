-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         10.2.3-MariaDB-log - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para turismo
CREATE DATABASE IF NOT EXISTS `turismo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `turismo`;

-- Volcando estructura para tabla turismo.paquetes
CREATE TABLE IF NOT EXISTS `paquetes` (
  `idPaquete` int(11) NOT NULL AUTO_INCREMENT,
  `fechaSalida` datetime NOT NULL,
  `fechaRetorno` datetime NOT NULL,
  `precio` int(11) NOT NULL DEFAULT 0,
  `numeroPlazas` int(11) NOT NULL DEFAULT 0,
  `idPromocion` int(11) NOT NULL DEFAULT 0,
  `idSitio` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idPaquete`),
  KEY `FK_paquete_promocion` (`idPromocion`),
  KEY `FK_paquetes_sitios` (`idSitio`),
  CONSTRAINT `FK_paquete_promocion` FOREIGN KEY (`IdPromocion`) REFERENCES `promociones` (`IdPromocion`),
  CONSTRAINT `FK_paquetes_sitios` FOREIGN KEY (`idSitio`) REFERENCES `sitios` (`idSitio`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla turismo.paquetes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `paquetes` DISABLE KEYS */;
REPLACE INTO `paquetes` (`idPaquete`, `fechaSalida`, `fechaRetorno`, `precio`, `numeroPlazas`, `idPromocion`, `idSitio`) VALUES
	(1, '2017-11-15 00:00:00', '2017-11-24 00:00:00', 250, 30, 1, 1);
/*!40000 ALTER TABLE `paquetes` ENABLE KEYS */;

-- Volcando estructura para tabla turismo.promociones
CREATE TABLE IF NOT EXISTS `promociones` (
  `idPromocion` int(11) NOT NULL AUTO_INCREMENT,
  `temporada` varchar(50) NOT NULL DEFAULT '0',
  `porcentaje` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idPromocion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla turismo.promociones: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `promociones` DISABLE KEYS */;
REPLACE INTO `promociones` (`idPromocion`, `temporada`, `porcentaje`) VALUES
	(1, 'Baja', 60);
/*!40000 ALTER TABLE `promociones` ENABLE KEYS */;

-- Volcando estructura para tabla turismo.reservas
CREATE TABLE IF NOT EXISTS `reservas` (
  `idReserva` int(11) NOT NULL AUTO_INCREMENT,
  `idCliente` int(11) NOT NULL,
  `idPaquete` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`idReserva`),
  KEY `FK__paquete` (`idPaquete`),
  CONSTRAINT `FK__paquete` FOREIGN KEY (`IdPaquete`) REFERENCES `paquetes` (`IdPaquete`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla turismo.reservas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;

-- Volcando estructura para tabla turismo.sitios
CREATE TABLE IF NOT EXISTS `sitios` (
  `idSitio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`idSitio`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla turismo.sitios: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `sitios` DISABLE KEYS */;
REPLACE INTO `sitios` (`idSitio`, `nombre`, `descripcion`, `foto`) VALUES
	(1, 'Plaza', 'Plaza en la paz', 'img/tiahuanaco.jpg');
/*!40000 ALTER TABLE `sitios` ENABLE KEYS */;

-- Volcando estructura para tabla turismo.tipo
CREATE TABLE IF NOT EXISTS `tipo` (
  `idTipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`idTipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla turismo.tipo: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo` DISABLE KEYS */;
REPLACE INTO `tipo` (`idTipo`, `tipo`) VALUES
	(1, 'Admin'),
	(2, 'Cliente');
/*!40000 ALTER TABLE `tipo` ENABLE KEYS */;

-- Volcando estructura para tabla turismo.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `ci` varchar(15) NOT NULL DEFAULT '0',
  `nombre` varchar(50) NOT NULL DEFAULT '0',
  `apPat` varchar(50) NOT NULL DEFAULT '0',
  `apMat` varchar(50) NOT NULL DEFAULT '0',
  `cel` varchar(9) NOT NULL DEFAULT '0',
  `correo` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `tipo` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `correo` (`correo`),
  KEY `FK_usuarios_tipo` (`tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla turismo.usuarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
REPLACE INTO `usuarios` (`idUsuario`, `ci`, `nombre`, `apPat`, `apMat`, `cel`, `correo`, `password`, `tipo`) VALUES
	(1, '23434', 'juan', 'pere', 'perez', '333', 'j@ejemplo.com', '1234', 2),
	(2, '56456', 'juan', 'perez', 'pares', '4566778', 'juan@ejemplo.com', '$2y$10$REjP5Dm/v/hpy5FbuGBfhuDkfzBOxDFM3Jf3HW0268vb81w/yOzgW', 2);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
