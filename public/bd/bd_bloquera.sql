CREATE DATABASE bloquera;

use bloquera;

CREATE TABLE cliente(
	id_cliente int AUTO_INCREMENT,
    cl_nombre varchar(50) not null,
    cl_apaterno varchar(20) not null,
    cl_amaterno varchar(20) not null,
    cl_calle varchar(50) not null,
    cl_numb varchar(20) not null,
    cl_codpostal varchar(10) not null,
    cl_colonia varchar(30) not null,
    cl_lugar varchar(20) not null,
    cl_municipio varchar(30) not null,
    cl_telefono varchar(30) not null,
    CONSTRAINT pk_id_cliente PRIMARY KEY(id_cliente)
);

CREATE TABLE bloque(
	id_bloque int AUTO_INCREMENT,
    blq_nombre varchar(50) not null,
    blq_precio_unitario float not null,
    blq_precio_venta float not null,
    blq_tamano varchar(30) not null,
    blq_estado boolean not null,
    blq_existencia int,
    CONSTRAINT pk_bloque PRIMARY KEY(id_bloque)
);

CREATE TABLE venta(
	id_venta int AUTO_INCREMENT,
    fk_id_cliente int not null,
    fecha date not null,
    tipo_venta varchar(50) not null,
 
    CONSTRAINT pk_venta PRIMARY KEY (id_venta),
    CONSTRAINT fk_venta_cliente FOREIGN KEY (fk_id_cliente)
    		REFERENCES cliente (id_cliente)
);

CREATE TABLE detalle_venta_bloque(
	id_det_vta_blq int AUTO_INCREMENT,
    fk_id_bloque int not null,
    fk_id_venta int not null,
    cantidad int not null,
    precio_venta float not null,
    
    CONSTRAINT pk_det_vta_blq PRIMARY KEY (id_det_vta_blq),
    CONSTRAINT fk_det_vta_blq_bloque FOREIGN KEY (fk_id_bloque)
    		REFERENCES bloque (id_bloque),
   	CONSTRAINT fk_det_vta_blq_venta FOREIGN KEY (fk_id_venta)
    		REFERENCES venta (id_venta)
);