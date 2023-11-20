-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.9.8-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para autentico
DROP DATABASE IF EXISTS `autentico`;
CREATE DATABASE IF NOT EXISTS `autentico` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `autentico`;

-- Volcando estructura para tabla autentico.almacen
DROP TABLE IF EXISTS `almacen`;
CREATE TABLE IF NOT EXISTS `almacen` (
  `id_almacen` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `sala_venta` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_almacen`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla autentico.categoria_insumo
DROP TABLE IF EXISTS `categoria_insumo`;
CREATE TABLE IF NOT EXISTS `categoria_insumo` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla autentico.compra
DROP TABLE IF EXISTS `compra`;
CREATE TABLE IF NOT EXISTS `compra` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_compra` date NOT NULL,
  `numero_documento` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `proveedor_id_proveedor` int(11) NOT NULL,
  `documento_id_tipo` int(11) NOT NULL,
  PRIMARY KEY (`id_compra`),
  KEY `proveedor_id_proveedor` (`proveedor_id_proveedor`),
  KEY `documento_compra_fk` (`documento_id_tipo`),
  CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`proveedor_id_proveedor`) REFERENCES `proveedor` (`id_proveedor`),
  CONSTRAINT `documento_compra_fk` FOREIGN KEY (`documento_id_tipo`) REFERENCES `tipo_documento` (`id_tipo_documento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla autentico.detalle_compra
DROP TABLE IF EXISTS `detalle_compra`;
CREATE TABLE IF NOT EXISTS `detalle_compra` (
  `id_detalle_compra` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_articulo` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `compra_id_compra` int(11) NOT NULL,
  PRIMARY KEY (`id_detalle_compra`),
  KEY `compra_id_compra` (`compra_id_compra`),
  CONSTRAINT `detalle_compra_ibfk_1` FOREIGN KEY (`compra_id_compra`) REFERENCES `compra` (`id_compra`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla autentico.detalle_venta
DROP TABLE IF EXISTS `detalle_venta`;
CREATE TABLE IF NOT EXISTS `detalle_venta` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL,
  `producto_id_producto` int(11) NOT NULL,
  `ventas_id_venta` int(11) NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `producto_id_producto` (`producto_id_producto`),
  KEY `ventas_id_venta` (`ventas_id_venta`),
  CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`producto_id_producto`) REFERENCES `producto` (`id_producto`),
  CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`ventas_id_venta`) REFERENCES `ventas` (`id_venta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla autentico.formato
DROP TABLE IF EXISTS `formato`;
CREATE TABLE IF NOT EXISTS `formato` (
  `id_formato` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_formato` varchar(50) NOT NULL,
  PRIMARY KEY (`id_formato`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla autentico.forma_pago
DROP TABLE IF EXISTS `forma_pago`;
CREATE TABLE IF NOT EXISTS `forma_pago` (
  `id_forma_pago` int(11) NOT NULL AUTO_INCREMENT,
  `forma_pago` varchar(50) NOT NULL,
  PRIMARY KEY (`id_forma_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla autentico.insumos
DROP TABLE IF EXISTS `insumos`;
CREATE TABLE IF NOT EXISTS `insumos` (
  `id_insumo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_insumo` varchar(50) NOT NULL,
  `perecible` tinyint(4) NOT NULL DEFAULT 0,
  `imagen` varchar(50) DEFAULT NULL,
  `categoria_insumo_id_categoria` int(11) NOT NULL,
  `formato_id_formato` int(11) NOT NULL,
  PRIMARY KEY (`id_insumo`),
  KEY `categoria_insumo_id_categoria` (`categoria_insumo_id_categoria`),
  KEY `formato_id_formato` (`formato_id_formato`),
  CONSTRAINT `insumos_ibfk_1` FOREIGN KEY (`categoria_insumo_id_categoria`) REFERENCES `categoria_insumo` (`id_categoria`),
  CONSTRAINT `insumos_ibfk_2` FOREIGN KEY (`formato_id_formato`) REFERENCES `formato` (`id_formato`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla autentico.inventario
DROP TABLE IF EXISTS `inventario`;
CREATE TABLE IF NOT EXISTS `inventario` (
  `numero_registro` int(11) NOT NULL AUTO_INCREMENT,
  `id_insumo` int(11) NOT NULL DEFAULT 0,
  `id_movimiento` int(11) NOT NULL DEFAULT 0,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `costo_unitario` int(11) NOT NULL DEFAULT 0,
  `fecha_vencimiento` int(11) NOT NULL DEFAULT 0,
  `id_zona` int(11) NOT NULL,
  PRIMARY KEY (`numero_registro`),
  KEY `insumo_inventario_FK` (`id_insumo`),
  KEY `movmiento_inventario_FK` (`id_movimiento`),
  KEY `FK_inventario_zona` (`id_zona`),
  CONSTRAINT `FK_inventario_zona` FOREIGN KEY (`id_zona`) REFERENCES `zona` (`id_zona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `insumo_inventario_FK` FOREIGN KEY (`id_insumo`) REFERENCES `insumos` (`id_insumo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `movmiento_inventario_FK` FOREIGN KEY (`id_movimiento`) REFERENCES `movimiento_insumo` (`id_movimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla autentico.movimiento_insumo
DROP TABLE IF EXISTS `movimiento_insumo`;
CREATE TABLE IF NOT EXISTS `movimiento_insumo` (
  `id_movimiento` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `id_trabajador` int(11) NOT NULL DEFAULT 0,
  `id_tipo_mov` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_movimiento`),
  KEY `movimiento_trabajador_FK` (`id_trabajador`),
  KEY `movimiento_tipo_mov_fk` (`id_tipo_mov`),
  CONSTRAINT `movimiento_tipo_mov_fk` FOREIGN KEY (`id_tipo_mov`) REFERENCES `tipo_movimiento` (`id_tipo_mov`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `movimiento_trabajador_FK` FOREIGN KEY (`id_trabajador`) REFERENCES `trabajador` (`id_trabajador`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla autentico.producto
DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` int(11) DEFAULT NULL,
  `nombre_producto` varchar(50) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `costo_unitario` decimal(10,2) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `tipo_producto_id_tipo` int(11) NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `tipo_producto_id_tipo` (`tipo_producto_id_tipo`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`tipo_producto_id_tipo`) REFERENCES `tipo_producto` (`id_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla autentico.producto_insumo
DROP TABLE IF EXISTS `producto_insumo`;
CREATE TABLE IF NOT EXISTS `producto_insumo` (
  `id_producto_insumo` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` float NOT NULL,
  `insumos_id_insumo` int(11) NOT NULL,
  `producto_id_producto` int(11) NOT NULL,
  PRIMARY KEY (`id_producto_insumo`),
  KEY `insumos_id_insumo` (`insumos_id_insumo`),
  KEY `producto_id_producto` (`producto_id_producto`),
  CONSTRAINT `producto_insumo_ibfk_1` FOREIGN KEY (`insumos_id_insumo`) REFERENCES `insumos` (`id_insumo`),
  CONSTRAINT `producto_insumo_ibfk_2` FOREIGN KEY (`producto_id_producto`) REFERENCES `producto` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla autentico.producto_promocion
DROP TABLE IF EXISTS `producto_promocion`;
CREATE TABLE IF NOT EXISTS `producto_promocion` (
  `id_producto_promocion` int(11) NOT NULL AUTO_INCREMENT,
  `promocion_id_promocion` int(11) NOT NULL,
  `producto_id_producto` int(11) NOT NULL,
  PRIMARY KEY (`id_producto_promocion`),
  KEY `producto_id_producto` (`producto_id_producto`),
  KEY `promocion_id_promocion` (`promocion_id_promocion`),
  CONSTRAINT `producto_promocion_ibfk_1` FOREIGN KEY (`producto_id_producto`) REFERENCES `producto` (`id_producto`),
  CONSTRAINT `producto_promocion_ibfk_2` FOREIGN KEY (`promocion_id_promocion`) REFERENCES `promocion` (`id_promocion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla autentico.promocion
DROP TABLE IF EXISTS `promocion`;
CREATE TABLE IF NOT EXISTS `promocion` (
  `id_promocion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_promocion` varchar(50) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  PRIMARY KEY (`id_promocion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla autentico.proveedor
DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE IF NOT EXISTS `proveedor` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_proveedor` varchar(50) NOT NULL,
  `rut_proveedor` varchar(12) NOT NULL DEFAULT '',
  `fono` varchar(50) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_proveedor`),
  UNIQUE KEY `rut_proveedor` (`rut_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla autentico.reg_entrada_compra
DROP TABLE IF EXISTS `reg_entrada_compra`;
CREATE TABLE IF NOT EXISTS `reg_entrada_compra` (
  `id_registro_entrada` int(11) NOT NULL AUTO_INCREMENT,
  `id_compra` int(11) NOT NULL DEFAULT 0,
  `id_movimiento` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_registro_entrada`),
  KEY `FK__compra` (`id_compra`),
  KEY `FK__movimiento_insumo` (`id_movimiento`),
  CONSTRAINT `FK__compra` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK__movimiento_insumo` FOREIGN KEY (`id_movimiento`) REFERENCES `movimiento_insumo` (`id_movimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla autentico.rol
DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(30) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.
REPLACE INTO `rol` (`id_rol`, `nombre_rol`) VALUES
	(1, 'administrador'),
	(2, 'vendedor');

-- TRIGGER PARA EVITAR ELIMINAR LOS ROLES ADMINISTRADOR Y VENDEDOR
DELIMITER //
CREATE TRIGGER before_delete_rol
BEFORE DELETE ON rol FOR EACH ROW
BEGIN
   
    IF OLD.id_rol IN (1, 2) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se puede eliminar el rol de administrador o vendedor';
    END IF;
END;
//
DELIMITER ;

-- Volcando estructura para tabla autentico.tipo_documento
DROP TABLE IF EXISTS `tipo_documento`;
CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `id_tipo_documento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_doc` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tipo_documento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla autentico.tipo_movimiento
DROP TABLE IF EXISTS `tipo_movimiento`;
CREATE TABLE IF NOT EXISTS `tipo_movimiento` (
  `id_tipo_mov` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_mov` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_tipo_mov`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- poblar tabla con movimeintos necesarios
REPLACE INTO `tipo_movimiento` (`id_tipo_mov`, `nombre_tipo_mov`)VALUES
  (1, 'Entrada')
  (2, 'Salida';

-- EVITAR BORRA LOS TIPOS DE MOVIMIENTOS ENTRADA Y SALIDA
DELIMITER //
CREATE TRIGGER before_delete_tipo_movimiento
BEFORE DELETE ON tipo_movimiento FOR EACH ROW
BEGIN
    -- Evitar la eliminación de registros con id_tipo_mov 1 o 2
    IF OLD.id_tipo_mov IN (1, 2) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se puede eliminar el tipo de movimiento 1 o 2';
    END IF;
END;
//
DELIMITER ;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla autentico.tipo_producto
DROP TABLE IF EXISTS `tipo_producto`;
CREATE TABLE IF NOT EXISTS `tipo_producto` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla autentico.trabajador
DROP TABLE IF EXISTS `trabajador`;
CREATE TABLE IF NOT EXISTS `trabajador` (
  `id_trabajador` int(11) NOT NULL AUTO_INCREMENT,
  `rut` varchar(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `activo` char(1) NOT NULL,
  `rol_id_rol` int(11) NOT NULL,
  PRIMARY KEY (`id_trabajador`),
  UNIQUE KEY `rut` (`rut`),
  KEY `rol_id_rol` (`rol_id_rol`),
  CONSTRAINT `trabajador_ibfk_1` FOREIGN KEY (`rol_id_rol`) REFERENCES `rol` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.
REPLACE INTO `trabajador` (`id_trabajador`, `rut`, `nombre`, `apellido`, `usuario`, `clave`, `activo`, `rol_id_rol`) VALUES
(1, '12345678-9', 'Usuario', 'Administrador', 'admin', 'admin', '1', 1);


-- Volcando estructura para tabla autentico.ventas
DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_venta` date NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `tipo_documento` varchar(50) NOT NULL,
  `numero_documento` int(11) NOT NULL,
  `trabajador_id_trabajador` int(11) NOT NULL,
  `forma_pago_id_forma_pago` int(11) NOT NULL,
  PRIMARY KEY (`id_venta`),
  KEY `forma_pago_id_forma_pago` (`forma_pago_id_forma_pago`),
  KEY `trabajador_id_trabajador` (`trabajador_id_trabajador`),
  CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`forma_pago_id_forma_pago`) REFERENCES `forma_pago` (`id_forma_pago`),
  CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`trabajador_id_trabajador`) REFERENCES `trabajador` (`id_trabajador`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla autentico.venta_promocion
DROP TABLE IF EXISTS `venta_promocion`;
CREATE TABLE IF NOT EXISTS `venta_promocion` (
  `id_venta_promocion` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) DEFAULT NULL,
  `ventas_id_venta` int(11) NOT NULL,
  `promocion_id_promocion` int(11) NOT NULL,
  PRIMARY KEY (`id_venta_promocion`),
  KEY `promocion_id_promocion` (`promocion_id_promocion`),
  KEY `ventas_id_venta` (`ventas_id_venta`),
  CONSTRAINT `venta_promocion_ibfk_1` FOREIGN KEY (`promocion_id_promocion`) REFERENCES `promocion` (`id_promocion`),
  CONSTRAINT `venta_promocion_ibfk_2` FOREIGN KEY (`ventas_id_venta`) REFERENCES `ventas` (`id_venta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla autentico.zona
DROP TABLE IF EXISTS `zona`;
CREATE TABLE IF NOT EXISTS `zona` (
  `id_zona` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_zona` varchar(50) NOT NULL,
  `almacen_id_almacen` int(11) NOT NULL,
  PRIMARY KEY (`id_zona`),
  KEY `almacen_id_almacen` (`almacen_id_almacen`),
  CONSTRAINT `zona_ibfk_1` FOREIGN KEY (`almacen_id_almacen`) REFERENCES `almacen` (`id_almacen`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
