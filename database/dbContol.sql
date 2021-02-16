DROP DATABASE IF EXISTS dbSistema;

CREATE DATABASE dbSistema;

USE dbSistema;

CREATE TABLE Producto(
	id_prod INT PRIMARY KEY AUTO_INCREMENT,
    nombre_prod VARCHAR(140),
    precio_compra DECIMAL(8,2),
    precio_venta DECIMAL(8,2),
    precio_oferta DECIMAL(8,2) null,
    cantidad INT,
    fecha_vencimiento DATE
);

CREATE TABLE Factura(
	nro_factura INT PRIMARY KEY AUTO_INCREMENT,
    cliente varchar(120),
    fecha_venta datetime,
	total decimal(8,2),
    vendedor varchar(120)
);

CREATE TABLE Detalle_Factura(
	nro_detalle INT PRIMARY KEY AUTO_INCREMENT,
    nro_factura INT,
    nombre_prod VARCHAR(140),
    cantidad_adquirida int,
	precio_compra DECIMAL(8,2),
    precio_venta DECIMAL(8,2),
    ganancia DECIMAL(8,2),
    id_prod int,
    FOREIGN KEY(nro_factura) REFERENCES Factura(nro_factura)
);

CREATE TABLE Usuario(
	id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(80),
    pass VARCHAR(80),
    rol VARCHAR(50),
    nombre VARCHAR(80),
    estado boolean
);

INSERT INTO Usuario VALUES(1 , 'admin' , 'admin' , 'ADMINISTRADOR' , 'Admin Default' , 1);
INSERT INTO Usuario VALUES(2 , 'user001' , '123456' , 'VENDEDOR', 'Marcos Salazar' , 1);
INSERT INTO Usuario VALUES(3 , 'user003' , '123456' , 'VENDEDOR', 'Luis Quispe' , 0);

INSERT INTO Producto VALUES(1 , 'Pepsi 1.5L' , 2.5 , 3.5 , 2.6 , 50 ,'2021-01-21');
INSERT INTO Producto VALUES(2 , 'Guarana 3.0L' , 3.2 , 4.7 , 3.5 , 10 ,'2021-02-01');
INSERT INTO Producto VALUES(3 , 'Cristal 1L' , 5.5 , 6.5 , 5.8 , 50 ,'2021-03-12');
INSERT INTO Producto VALUES(4 , 'Coca Cola 1.5L' , 2.8 , 3.7 , 3.0 , 50 ,'2021-02-19');
INSERT INTO Producto VALUES(5 , 'Coca Cola Mediana' , 1.0 , 1.5 , 1.2 , 100 ,'2021-02-17');
INSERT INTO Producto VALUES(6 , 'Inca Kola Mediana' , 1.0 , 1.8 , 1.2 , 87 ,'2021-02-15');
INSERT INTO Producto VALUES(7 , 'Pepsi 2.5L' , 3.5 , 4.5 , 3.7 , 50 ,'2021-01-12');
INSERT INTO Producto VALUES(8 , 'Frugos 1L' , 3.1 , 4.1 , 3.5 , 0 ,'2021-02-26');
INSERT INTO Producto VALUES(9 , 'Agua Cielo 3.0 L' , 2.5 , 3.5 , null , 60 ,'2021-01-28');



DELIMITER @@
DROP PROCEDURE IF EXISTS SPdetalle @@
CREATE PROCEDURE SPdetalle(
_nro_factura int, 
_codigo_producto int,
_nombre_producto VARCHAR(120),  
_cant_adquirida int,
_precio_compra decimal(8,2),
_precio_venta decimal(8,2)
)
BEGIN
    declare _ganancia decimal(8,2);
    
    set _ganancia = _precio_venta - _precio_compra;
    
	insert into Detalle_Factura values (NULL , _nro_factura ,_nombre_producto, _cant_adquirida , _precio_compra , _precio_venta , _ganancia , _codigo_producto);
	update producto set cantidad = cantidad - _cant_adquirida 
    where id_prod = _codigo_producto;
END @@



