USE autentico;

CREATE TABLE almacen (
    id_almacen INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_almacen)
);

CREATE TABLE categoria_insumo (
    id_categoria INT NOT NULL AUTO_INCREMENT,
    nombre_categoria VARCHAR(50) NOT NULL,autenticoautentico
    PRIMARY KEY (id_categoria)
);

CREATE TABLE forma_pago (
    id_forma_pago INT NOT NULL AUTO_INCREMENT,
    forma_pago VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_forma_pago)
);

CREATE TABLE formato (
    id_formato INT NOT NULL AUTO_INCREMENT,
    nombre_formato VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_formato)
);

CREATE TABLE promocion (
    id_promocion INT NOT NULL AUTO_INCREMENT,
    nombre_promocion VARCHAR(50) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE,
    PRIMARY KEY (id_promocion)
);

CREATE TABLE proveedor (
    id_proveedor INT NOT NULL AUTO_INCREMENT,
    nombre_proveedor VARCHAR(50) NOT NULL,
    rut_proveedor INT NOT NULL,
    fono VARCHAR(50),
    mail VARCHAR(50),
    direccion VARCHAR(50),
    PRIMARY KEY (id_proveedor)
);

CREATE TABLE rol (
    id_rol INT NOT NULL AUTO_INCREMENT,
    nombre_rol VARCHAR(30) NOT NULL,
    PRIMARY KEY (id_rol)
);

CREATE TABLE tipo_producto (
    id_tipo INT NOT NULL AUTO_INCREMENT,
    nombre_tipo VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_tipo)
);

CREATE TABLE compra (
    id_compra INT NOT NULL AUTO_INCREMENT,
    fecha_compra DATE NOT NULL,
    tipo_documento VARCHAR(50) NOT NULL,
    numero_documento INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    proveedor_id_proveedor INT NOT NULL,
    PRIMARY KEY (id_compra),
    FOREIGN KEY (proveedor_id_proveedor) REFERENCES proveedor (id_proveedor)
);

CREATE TABLE detalle_compra (
    id_detalle_compra INT NOT NULL AUTO_INCREMENT,
    nombre_articulo VARCHAR(50) NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    compra_id_compra INT NOT NULL,
    PRIMARY KEY (id_detalle_compra),
    FOREIGN KEY (compra_id_compra) REFERENCES compra (id_compra)
);

CREATE TABLE producto (
    id_producto INT NOT NULL AUTO_INCREMENT,
    codigo_producto INT,
    nombre_producto VARCHAR(50) NOT NULL,
    costo_unitario DECIMAL(10, 2) NOT NULL,
    precio_venta DECIMAL(10, 2) NOT NULL,
    descripcion VARCHAR(200),
    tipo_producto INT NOT NULL,
    tipo_producto_id_tipo INT NOT NULL,
    PRIMARY KEY (id_producto),
    FOREIGN KEY (tipo_producto_id_tipo) REFERENCES tipo_producto (id_tipo)
);

CREATE TABLE trabajador (
    id_trabajador INT NOT NULL AUTO_INCREMENT,
    rut VARCHAR(11) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    usuario VARCHAR(50) NOT NULL,
    clave VARCHAR(50) NOT NULL,
    activo CHAR(1) NOT NULL,
    rol_id_rol INT NOT NULL,
    PRIMARY KEY (id_trabajador),
    FOREIGN KEY (rol_id_rol) REFERENCES rol (id_rol)
);

CREATE TABLE salida (
    id_salida INT NOT NULL AUTO_INCREMENT,
    fecha_salida DATE NOT NULL,
    trabajador_id_trabajador INT NOT NULL,
    PRIMARY KEY (id_salida),
    FOREIGN KEY (trabajador_id_trabajador) REFERENCES trabajador (id_trabajador)
);

CREATE TABLE zona (
    id_zona INT NOT NULL AUTO_INCREMENT,
    nombre_zona VARCHAR(50) NOT NULL,
    almacen_id_almacen INT NOT NULL,
    PRIMARY KEY (id_zona),
    FOREIGN KEY (almacen_id_almacen) REFERENCES almacen (id_almacen)
);

CREATE TABLE entrada (
    id_entrada INT NOT NULL AUTO_INCREMENT,
    fecha DATE NOT NULL,
    compra_id_compra INT NOT NULL,
    trabajador_id_trabajador INT NOT NULL,
    PRIMARY KEY (id_entrada),
    FOREIGN KEY (compra_id_compra) REFERENCES compra (id_compra),
    FOREIGN KEY (trabajador_id_trabajador) REFERENCES trabajador (id_trabajador)
);

CREATE TABLE insumos (
    id_insumo INT NOT NULL AUTO_INCREMENT,
    nombre_insumo VARCHAR(50) NOT NULL,
    perecible CHAR(1) NOT NULL,
    fecha_vencimiento DATE,
    stock_total INT NOT NULL,
    costo DECIMAL(10, 2) NOT NULL,
    categoria_insumo_id_categoria INT NOT NULL,
    formato_id_formato INT NOT NULL,
    PRIMARY KEY (id_insumo),
    FOREIGN KEY (categoria_insumo_id_categoria) REFERENCES categoria_insumo (id_categoria),
    FOREIGN KEY (formato_id_formato) REFERENCES formato (id_formato)
);

CREATE TABLE producto_insumo (
    id_producto_insumo INT NOT NULL AUTO_INCREMENT,
    cantidad FLOAT NOT NULL,
    insumos_id_insumo INT NOT NULL,
    producto_id_producto INT NOT NULL,
    PRIMARY KEY (id_producto_insumo),
    FOREIGN KEY (insumos_id_insumo) REFERENCES insumos (id_insumo),
    FOREIGN KEY (producto_id_producto) REFERENCES producto (id_producto)
);

CREATE TABLE detalle_zona_insumo (
    id_zona_insumo INT NOT NULL AUTO_INCREMENT,
    cantidad INT NOT NULL,
    insumos_id_insumo INT NOT NULL,
    zona_id_zona INT NOT NULL,
    PRIMARY KEY (id_zona_insumo),
    FOREIGN KEY (insumos_id_insumo) REFERENCES insumos (id_insumo),
    FOREIGN KEY (zona_id_zona) REFERENCES zona (id_zona)
);

CREATE TABLE detalle_salida_insumos (
    id_detalle_salida INT NOT NULL AUTO_INCREMENT,
    insumos_id_insumo INT NOT NULL,
    salida_id_salida INT NOT NULL,
    cantidad INT NOT NULL,
    PRIMARY KEY (id_detalle_salida),
    FOREIGN KEY (insumos_id_insumo) REFERENCES insumos (id_insumo),
    FOREIGN KEY (salida_id_salida) REFERENCES salida (id_salida)
);

CREATE TABLE ventas (
    id_venta INT NOT NULL AUTO_INCREMENT,
    fecha_venta DATE NOT NULL,
    monto DECIMAL(10, 2) NOT NULL,
    tipo_documento VARCHAR(50) NOT NULL,
    numero_documento INT NOT NULL,
    trabajador_id_trabajador INT NOT NULL,
    forma_pago_id_forma_pago INT NOT NULL,
    PRIMARY KEY (id_venta),
    FOREIGN KEY (forma_pago_id_forma_pago) REFERENCES forma_pago (id_forma_pago),
    FOREIGN KEY (trabajador_id_trabajador) REFERENCES trabajador (id_trabajador)
);

CREATE TABLE venta_promocion (
    id_venta_promocion INT NOT NULL AUTO_INCREMENT,
    ventas_id_venta INT NOT NULL,
    promocion_id_promocion INT NOT NULL,
    PRIMARY KEY (id_venta_promocion),
    FOREIGN KEY (promocion_id_promocion) REFERENCES promocion (id_promocion),
    FOREIGN KEY (ventas_id_venta) REFERENCES ventas (id_venta)
);

CREATE TABLE producto_promocion (
    id_producto_promocion INT NOT NULL AUTO_INCREMENT,
    promocion_id_promocion INT NOT NULL,
    producto_id_producto INT NOT NULL,
    PRIMARY KEY (id_producto_promocion),
    FOREIGN KEY (producto_id_producto) REFERENCES producto (id_producto),
    FOREIGN KEY (promocion_id_promocion) REFERENCES promocion (id_promocion)
);

CREATE TABLE detalle_venta (
    id_detalle INT NOT NULL AUTO_INCREMENT,
    cantidad INT NOT NULL,
    producto_id_producto INT NOT NULL,
    ventas_id_venta INT NOT NULL,
    PRIMARY KEY (id_detalle),
    FOREIGN KEY (producto_id_producto) REFERENCES producto (id_producto),
    FOREIGN KEY (ventas_id_venta) REFERENCES ventas (id_venta)
);

CREATE TABLE detalle_entrada_insumos (
    id_detalle_salida INT NOT NULL AUTO_INCREMENT,
    insumos_id_insumo INT NOT NULL,
    entrada_id_entrada INT NOT NULL,
    cantidad INT NOT NULL,
    PRIMARY KEY (id_detalle_salida),
    FOREIGN KEY (insumos_id_insumo) REFERENCES insumos (id_insumo),
    FOREIGN KEY (entrada_id_entrada) REFERENCES entrada (id_entrada)
);


