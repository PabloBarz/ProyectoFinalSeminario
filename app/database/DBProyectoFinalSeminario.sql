DROP DATABASE IF EXISTS sportsfieldrentaldb;
CREATE DATABASE sportsfieldrentaldb;
USE sportsfieldrentaldb;

-- T1 ACCIONES
DROP TABLE IF EXISTS modulos;
CREATE TABLE modulos
(
    idModulo 		INT AUTO_INCREMENT PRIMARY KEY,
    modulo		VARCHAR(20) NOT NULL,
    createAt 		DATETIME NOT NULL DEFAULT NOW()
)ENGINE = INNODB;

-- T2 ACCIONES - RUTAS RELACIONADO CON T1
DROP TABLE IF EXISTS rutas;
CREATE TABLE rutas (
    idRuta	INT AUTO_INCREMENT PRIMARY KEY,
    idModulo 	INT NOT NULL,
    ruta 	VARCHAR(30),
    visible	BOOLEAN,
    texto 	VARCHAR(20),
    icono 	VARCHAR(50),
    CONSTRAINT 	fk_ruta_modulo FOREIGN KEY (idmodulo) REFERENCES modulos(idmodulo)
)ENGINE = INNODB;

-- T3 TIPO DE USUARIOS
DROP TABLE IF EXISTS tipos_usuarios;
CREATE TABLE tipos_usuarios (
  idTipoUsuario INT AUTO_INCREMENT PRIMARY KEY,
  nombreRol 	VARCHAR (20) NOT NULL,
  nombreCorto	CHAR(3)	NOT NULL,
  descripcion	VARCHAR(200) NULL,
  createAt 	DATETIME NOT NULL DEFAULT NOW(),
  CONSTRAINT uk_nombreRol_per UNIQUE (nombreRol),
  CONSTRAINT uk_nombrecorto_per UNIQUE (nombreCorto)
) ENGINE = INNODB;

-- T4 PERMISOS RELACIONANDO CON T3 Y T2
DROP TABLE IF EXISTS permisos;
CREATE TABLE permisos (
  idPermiso 	INT AUTO_INCREMENT PRIMARY KEY,
  idTipoUsuario INT NOT NULL,
  idRuta	INT NOT NULL,
  createAt 	DATETIME NOT NULL DEFAULT NOW(),
  CONSTRAINT 	fk_permisos_ruta 		FOREIGN KEY (idRuta) REFERENCES rutas (idRuta),
  CONSTRAINT 	fk_permisos_tipo_usuario 	FOREIGN KEY (idTipoUsuario) REFERENCES tipos_usuarios (idTipoUsuario)
) ENGINE = INNODB;

-- T5 PERSONAS
DROP TABLE IF EXISTS personas;
CREATE TABLE personas (
  idPersona 		INT AUTO_INCREMENT PRIMARY KEY,
  apellidos		VARCHAR(40) 	NOT NULL,
  nombres 		VARCHAR(40)	NOT NULL,
  dni 			CHAR(8) 	NOT NULL,  
  telefono 		CHAR(9) 	NULL,
  createAt 		DATETIME 	NOT NULL DEFAULT NOW(),
  CONSTRAINT uk_dni_per UNIQUE (dni)
) ENGINE = INNODB;

-- T6 USUARIOS RELACIONADO CON T5 Y T3
DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
  idUsuario 		INT AUTO_INCREMENT PRIMARY KEY,
  idPersona		INT NOT NULL,
  idTipoUsuario 	INT NOT NULL,
  email 		VARCHAR(70) 	NOT NULL,
  nomUser 		VARCHAR(20) 	NOT NULL,
  passUser 		VARCHAR(70) 	NOT NULL,
  createAt 		DATETIME 	NOT NULL DEFAULT NOW(),
  updateAt 		DATETIME 	NULL,
  inactiveAt		DATETIME 	NULL,
  CONSTRAINT fk_idpersona_usu FOREIGN KEY (idPersona) REFERENCES personas (idPersona), 
  CONSTRAINT uk_idpersona_usu UNIQUE (idPersona), -- Uno a Uno
  CONSTRAINT fk_usuarios_tipo_usuario FOREIGN KEY (idTipoUsuario) REFERENCES tipos_usuarios (idTipoUsuario),
  CONSTRAINT uk_nomuser_usu UNIQUE (nomUser)
) ENGINE = INNODB;

-- T7 CAMPOS
DROP TABLE IF EXISTS campos;
CREATE TABLE campos (
  idCampo 	INT AUTO_INCREMENT PRIMARY KEY,
  tipoCampo 	VARCHAR (20) NOT NULL,
  nombre 	VARCHAR (20) NOT NULL,
  latitud 	DECIMAL (9, 6) NOT NULL,
  longitud 	DECIMAL (9, 6) NOT NULL,
  direccion 	VARCHAR (30) NOT NULL,
  distrito 	VARCHAR (30) NOT NULL,
  telefono 	VARCHAR (9) NULL,
  createAt 		DATETIME 	NOT NULL DEFAULT NOW()
) ENGINE = INNODB;

-- T8 ZONAS DE CAMPOS RELACIONADO CON T7
DROP TABLE IF EXISTS zonas_campos;
CREATE TABLE zonas_campos (
  idZonaCampo 	INT AUTO_INCREMENT PRIMARY KEY,
  idCampo 	INT NOT NULL,
  nombre 	VARCHAR (20) NOT NULL,
  capacidad 	SMALLINT NOT NULL,
  superficie 	VARCHAR (20) NOT NULL,
  dimensiones 	VARCHAR (10) NOT NULL,
  precioHora 	SMALLINT NOT NULL,
  descripcion 	TEXT NULL,
  estado 	VARCHAR (10),
  createAt 	DATETIME NOT NULL DEFAULT NOW(),
  CONSTRAINT 	fk_zonas_campos_campo FOREIGN KEY (idCampo) REFERENCES campos (idCampo)
) ENGINE = INNODB;

-- T9 RESERVACIONES DE LAS ZONAS RELACIONADO CON T8
DROP TABLE IF EXISTS reservaciones;
CREATE TABLE reservaciones (
  idReservacion 	INT AUTO_INCREMENT PRIMARY KEY,
  idZonaCampo 		INT NOT NULL,
  idUsuario 		INT NOT NULL,
  fechaReservacion 	DATE NOT NULL,
  horaInicio 		TIME NOT NULL,
  horaFin 		TIME NOT NULL,
  estadoPago 		VARCHAR (10) NOT NULL,
  precioHora 		SMALLINT NOT NULL,
  cantidadHora 		SMALLINT NOT NULL,
  totalMonto		DECIMAL(10,2),
  createAt 		DATETIME NOT NULL DEFAULT NOW(),
  CONSTRAINT 		fk_reservaciones_zona_campo 	FOREIGN KEY (idZonaCampo) REFERENCES zonas_campos (idZonaCampo),
  CONSTRAINT 		fk_reservaciones_usuario 	FOREIGN KEY (idUsuario) REFERENCES usuarios (idUsuario)
) ENGINE = INNODB;

-- T10 PAGOS RELACIONADO CON T9
DROP TABLE IF EXISTS pagos;
CREATE TABLE pagos (
  idPago 	INT AUTO_INCREMENT PRIMARY KEY,
  idReservacion INT NOT NULL,
  monto 	DECIMAL (10, 2),
  fechaPago 	DATETIME NOT NULL,
  metodoPago 	VARCHAR (20) NOT NULL,
  comprobante 	VARCHAR (255) NOT NULL,
  estadoPago 	VARCHAR (20) NOT NULL,
  createAt 	DATETIME NOT NULL DEFAULT NOW(),
  CONSTRAINT fk_pagos_reservacion FOREIGN KEY (idReservacion) REFERENCES reservaciones (idReservacion)
) ENGINE = INNODB;
