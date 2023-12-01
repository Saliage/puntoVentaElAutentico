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

-- Volcando datos para la tabla autentico.almacen: ~0 rows (aproximadamente)
DELETE FROM `almacen`;

-- Volcando estructura para tabla autentico.categoria_insumo
DROP TABLE IF EXISTS `categoria_insumo`;
CREATE TABLE IF NOT EXISTS `categoria_insumo` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Volcando datos para la tabla autentico.categoria_insumo: ~11 rows (aproximadamente)
DELETE FROM `categoria_insumo`;
INSERT INTO `categoria_insumo` (`id_categoria`, `nombre_categoria`) VALUES
	(16, 'verduras'),
	(18, 'panes'),
	(19, 'bebidas'),
	(20, 'cafeteria'),
	(21, 'carne'),
	(22, 'snacks'),
	(23, 'lacteos'),
	(24, 'condimento'),
	(25, 'salsa'),
	(26, 'aceite'),
	(27, 'endulzante');

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

-- Volcando datos para la tabla autentico.compra: ~0 rows (aproximadamente)
DELETE FROM `compra`;

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

-- Volcando datos para la tabla autentico.detalle_compra: ~0 rows (aproximadamente)
DELETE FROM `detalle_compra`;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Volcando datos para la tabla autentico.detalle_venta: ~3 rows (aproximadamente)
DELETE FROM `detalle_venta`;
INSERT INTO `detalle_venta` (`id_detalle`, `cantidad`, `producto_id_producto`, `ventas_id_venta`) VALUES
	(1, 1, 3, 1),
	(2, 1, 9, 1),
	(3, 1, 2, 1);

-- Volcando estructura para tabla autentico.formato
DROP TABLE IF EXISTS `formato`;
CREATE TABLE IF NOT EXISTS `formato` (
  `id_formato` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_formato` varchar(50) NOT NULL,
  PRIMARY KEY (`id_formato`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Volcando datos para la tabla autentico.formato: ~13 rows (aproximadamente)
DELETE FROM `formato`;
INSERT INTO `formato` (`id_formato`, `nombre_formato`) VALUES
	(3, '100cc'),
	(4, '200cc'),
	(5, '250cc'),
	(6, '300cc'),
	(7, '591cc'),
	(8, '600cc'),
	(9, '900cc'),
	(10, 'litro'),
	(11, 'kilo'),
	(12, 'paquete'),
	(13, 'unidad'),
	(14, '500cc'),
	(15, '500g');

-- Volcando estructura para tabla autentico.forma_pago
DROP TABLE IF EXISTS `forma_pago`;
CREATE TABLE IF NOT EXISTS `forma_pago` (
  `id_forma_pago` int(11) NOT NULL AUTO_INCREMENT,
  `forma_pago` varchar(50) NOT NULL,
  PRIMARY KEY (`id_forma_pago`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Volcando datos para la tabla autentico.forma_pago: ~2 rows (aproximadamente)
DELETE FROM `forma_pago`;
INSERT INTO `forma_pago` (`id_forma_pago`, `forma_pago`) VALUES
	(1, 'efectivo'),
	(2, 'tarjeta');

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Volcando datos para la tabla autentico.insumos: ~23 rows (aproximadamente)
DELETE FROM `insumos`;
INSERT INTO `insumos` (`id_insumo`, `nombre_insumo`, `perecible`, `imagen`, `categoria_insumo_id_categoria`, `formato_id_formato`) VALUES
	(8, 'tomate', 1, '../../public/imagenes/tomates.png', 16, 11),
	(9, 'papas', 1, '../../public/imagenes/papa.jpeg', 16, 11),
	(10, 'palta', 1, '../../public/imagenes/palta.jpeg', 16, 11),
	(11, 'ajo', 1, '../../public/imagenes/ajo.jpeg', 16, 13),
	(12, 'coca cola', 1, '../../public/imagenes/coca-cola-normal.jpg', 19, 7),
	(13, 'vital', 1, '../../public/imagenes/vital%20sin%20gas.jpeg', 19, 8),
	(14, 'vital con gas', 1, '../../public/imagenes/vital con gas.jpeg', 19, 8),
	(15, 'fanta', 1, '../../public/imagenes/fanata.jpeg', 19, 7),
	(16, 'pan de completo', 1, '../../public/imagenes/pan completo.jpeg', 18, 13),
	(17, 'pan frica', 1, '../../public/imagenes/pan%20frica.jpeg', 18, 13),
	(18, 'masa pizza', 1, '../../public/imagenes/pizza.jpeg', 18, 13),
	(19, 'tortilla', 1, '../../public/imagenes/tortilla.jpeg', 18, 12),
	(20, 'posta', 1, '../../public/imagenes/carne.jpeg', 21, 11),
	(21, 'queso', 1, '../../public/imagenes/queso.jpeg', 24, 11),
	(22, 'cocacola', 1, '../../public/imagenes/coca litro.jpeg', 19, 10),
	(23, 'oregano', 0, '../../public/imagenes/oregano.jpeg', 24, 15),
	(24, 'cafe', 0, '../../public/imagenes/cafe.jpeg', 20, 15),
	(25, 'azucar', 0, '../../public/imagenes/azucar.jpeg', 27, 11),
	(26, 'vienesas', 1, '../../public/imagenes/vienesas.jpeg', 21, 12),
	(27, 'mayonesa', 1, '../../public/imagenes/mayo.jpeg', 25, 11),
	(28, 'mostaza', 1, '../../public/imagenes/mostaza.jpeg', 25, 11),
	(29, 'ketchup', 1, '../../public/imagenes/kectpcup.jpeg', 25, 11),
	(30, 'te', 0, '../../public/imagenes/te.jpeg', 20, 12);

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

-- Volcando datos para la tabla autentico.inventario: ~0 rows (aproximadamente)
DELETE FROM `inventario`;

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

-- Volcando datos para la tabla autentico.movimiento_insumo: ~0 rows (aproximadamente)
DELETE FROM `movimiento_insumo`;

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
  `disponible` tinyint(4) DEFAULT 0,
  `tipo_producto_id_tipo` int(11) NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `tipo_producto_id_tipo` (`tipo_producto_id_tipo`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`tipo_producto_id_tipo`) REFERENCES `tipo_producto` (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Volcando datos para la tabla autentico.producto: ~12 rows (aproximadamente)
DELETE FROM `producto`;
INSERT INTO `producto` (`id_producto`, `codigo_producto`, `nombre_producto`, `imagen`, `costo_unitario`, `precio_venta`, `descripcion`, `disponible`, `tipo_producto_id_tipo`) VALUES
	(1, NULL, 'barros luco', '../../public/imagenes/barros-luco.jpeg', 1700.00, 3500.00, 'tomate, pata, mayo', 1, 1),
	(2, NULL, 'te', '../../public/imagenes/te.jpg', 300.00, 1000.00, 'té', 1, 2),
	(3, NULL, 'monster', '../../public/imagenes/monster.webp', 1200.00, 2000.00, 'Bebida energética', 1, 2),
	(4, NULL, 'pizza individual', '../../public/imagenes/pizza.webp', 800.00, 1500.00, 'tomate, queso, jamon, aceitunas', 0, 3),
	(5, NULL, 'completo italiano', '../../public/imagenes/completo-italiano.jpg', 700.00, 1500.00, 'tomate, pata, mayo', 0, 5),
	(6, NULL, 'café', '../../public/imagenes/cafe.jpeg', 600.00, 1200.00, 'Café de maquina', 0, 2),
	(7, NULL, 'te', '../../public/imagenes/te.jpg', 300.00, 1000.00, 'té', 0, 2),
	(8, NULL, 'Coca-cola zero', '../../public/imagenes/coca-cola-zero.jpg', 1000.00, 1500.00, 'coca zero 59 0ml', 1, 2),
	(9, NULL, 'papas fritas', '../../public/imagenes/papas-fritas.webp', 1300.00, 2000.00, 'porcion de papas', 1, 7),
	(10, NULL, 'Salchi', '../../public/imagenes/salchipapa.jpg', 1800.00, 2500.00, 'porcion salchi', 1, 7),
	(11, NULL, 'as', '../../public/imagenes/as.webp', 1800.00, 3500.00, 'as solo', 0, 4),
	(12, NULL, 'as queso', '../../public/imagenes/as-queso.webp', 2000.00, 3700.00, 'as queso', 1, 4);

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

-- Volcando datos para la tabla autentico.producto_insumo: ~0 rows (aproximadamente)
DELETE FROM `producto_insumo`;

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

-- Volcando datos para la tabla autentico.producto_promocion: ~0 rows (aproximadamente)
DELETE FROM `producto_promocion`;

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

-- Volcando datos para la tabla autentico.promocion: ~0 rows (aproximadamente)
DELETE FROM `promocion`;

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

-- Volcando datos para la tabla autentico.proveedor: ~0 rows (aproximadamente)
DELETE FROM `proveedor`;

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

-- Volcando datos para la tabla autentico.reg_entrada_compra: ~0 rows (aproximadamente)
DELETE FROM `reg_entrada_compra`;

-- Volcando estructura para tabla autentico.rol
DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(30) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Volcando datos para la tabla autentico.rol: ~2 rows (aproximadamente)
DELETE FROM `rol`;
INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
	(1, 'administrador'),
	(2, 'vendedor');

-- Volcando estructura para tabla autentico.tipo_documento
DROP TABLE IF EXISTS `tipo_documento`;
CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `id_tipo_documento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_doc` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tipo_documento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Volcando datos para la tabla autentico.tipo_documento: ~0 rows (aproximadamente)
DELETE FROM `tipo_documento`;

-- Volcando estructura para tabla autentico.tipo_movimiento
DROP TABLE IF EXISTS `tipo_movimiento`;
CREATE TABLE IF NOT EXISTS `tipo_movimiento` (
  `id_tipo_mov` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_mov` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_tipo_mov`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Volcando datos para la tabla autentico.tipo_movimiento: ~2 rows (aproximadamente)
DELETE FROM `tipo_movimiento`;
INSERT INTO `tipo_movimiento` (`id_tipo_mov`, `nombre_tipo_mov`) VALUES
	(1, 'Entrada'),
	(2, 'Salida');

-- Volcando estructura para tabla autentico.tipo_producto
DROP TABLE IF EXISTS `tipo_producto`;
CREATE TABLE IF NOT EXISTS `tipo_producto` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Volcando datos para la tabla autentico.tipo_producto: ~8 rows (aproximadamente)
DELETE FROM `tipo_producto`;
INSERT INTO `tipo_producto` (`id_tipo`, `nombre_tipo`) VALUES
	(1, 'Promociones'),
	(2, 'Bebidas'),
	(3, 'Pizza'),
	(4, 'As'),
	(5, 'Completos'),
	(6, 'Cafeteria'),
	(7, 'Fritura'),
	(8, 'Sandwich');

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

-- Volcando datos para la tabla autentico.trabajador: ~1 rows (aproximadamente)
DELETE FROM `trabajador`;
INSERT INTO `trabajador` (`id_trabajador`, `rut`, `nombre`, `apellido`, `usuario`, `clave`, `activo`, `rol_id_rol`) VALUES
	(1, '12345678-9', 'Usuario', 'Administrador', 'admin', 'admin', '1', 1);

-- Volcando estructura para tabla autentico.ventas
DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_venta` date NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `tipo_documento` varchar(50) DEFAULT NULL,
  `numero_documento` int(11) DEFAULT NULL,
  `trabajador_id_trabajador` int(11) NOT NULL,
  `forma_pago_id_forma_pago` int(11) NOT NULL,
  PRIMARY KEY (`id_venta`),
  KEY `forma_pago_id_forma_pago` (`forma_pago_id_forma_pago`),
  KEY `trabajador_id_trabajador` (`trabajador_id_trabajador`),
  CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`forma_pago_id_forma_pago`) REFERENCES `forma_pago` (`id_forma_pago`),
  CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`trabajador_id_trabajador`) REFERENCES `trabajador` (`id_trabajador`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Volcando datos para la tabla autentico.ventas: ~1 rows (aproximadamente)
DELETE FROM `ventas`;
INSERT INTO `ventas` (`id_venta`, `fecha_venta`, `monto`, `tipo_documento`, `numero_documento`, `trabajador_id_trabajador`, `forma_pago_id_forma_pago`) VALUES
	(1, '2023-12-01', 5000.00, NULL, NULL, 1, 1);

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

-- Volcando datos para la tabla autentico.venta_promocion: ~0 rows (aproximadamente)
DELETE FROM `venta_promocion`;

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

-- Volcando datos para la tabla autentico.zona: ~0 rows (aproximadamente)
DELETE FROM `zona`;

-- Volcando estructura para disparador autentico.before_delete_forma_pago
DROP TRIGGER IF EXISTS `before_delete_forma_pago`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER before_delete_forma_pago
BEFORE DELETE ON forma_pago FOR EACH ROW
BEGIN
   
    IF OLD.id_forma_pago IN (1, 2) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se puede eliminar la forma de pago efectivo o trajeta';
    END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador autentico.before_delete_rol
DROP TRIGGER IF EXISTS `before_delete_rol`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER before_delete_rol
BEFORE DELETE ON rol FOR EACH ROW
BEGIN
   
    IF OLD.id_rol IN (1, 2) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se puede eliminar el rol de administrador o vendedor';
    END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador autentico.before_delete_tipo_movimiento
DROP TRIGGER IF EXISTS `before_delete_tipo_movimiento`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER before_delete_tipo_movimiento
BEFORE DELETE ON tipo_movimiento FOR EACH ROW
BEGIN
    -- Evitar la eliminación de registros con id_tipo_mov 1 o 2
    IF OLD.id_tipo_mov IN (1, 2) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se puede eliminar el tipo de movimiento 1 o 2';
    END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
