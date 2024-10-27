DROP DATABASE IF EXISTS sportsfieldrentaldb;
CREATE DATABASE sportsfieldrentaldb;
USE sportsfieldrentaldb;

-- T1 ACCIONES
DROP TABLE IF EXISTS acciones;
CREATE TABLE acciones (
  idAccion 	INT AUTO_INCREMENT PRIMARY KEY,
  nombre 	VARCHAR (20) NOT NULL
) ENGINE = INNODB;

-- T2 TIPO DE USUARIOS
DROP TABLE IF EXISTS tipos_usuarios;
CREATE TABLE tipos_usuarios (
  idTipoUsuario INT AUTO_INCREMENT PRIMARY KEY,
  nombreRol 	VARCHAR (20) NOT NULL,
  nombreCorto	CHAR(3)	NOT NULL,
  descripcion	VARCHAR(200) NULL,
  create_at 	DATETIME NOT NULL DEFAULT NOW(),
  CONSTRAINT uk_nombreRol_per UNIQUE (nombreRol),
  CONSTRAINT uk_nombrecorto_per UNIQUE (nombreCorto)
) ENGINE = INNODB;

-- T3 PERMISOS RELACIONANDO CON T1 Y T2
DROP TABLE IF EXISTS permisos;
CREATE TABLE permisos (
  idPermiso 	INT AUTO_INCREMENT PRIMARY KEY,
  idAccion 	INT NOT NULL,
  idTipoUsuario INT NOT NULL,
  CONSTRAINT 	fk_permisos_accion 		FOREIGN KEY (idAccion) REFERENCES acciones (idAccion),
  CONSTRAINT 	fk_permisos_tipo_usuario 	FOREIGN KEY (idTipoUsuario) REFERENCES tipos_usuarios (idTipoUsuario)
) ENGINE = INNODB;

-- T4 PERSONAS
DROP TABLE IF EXISTS personas;
CREATE TABLE personas (
  idPersona 		INT AUTO_INCREMENT PRIMARY KEY,
  apellidos		VARCHAR(40) 	NOT NULL,
  nombres 		VARCHAR(40)	NOT NULL,
  dni 		CHAR(8) 	NOT NULL,
  telefono 		CHAR(9) 	NULL,
  direccion		VARCHAR(70)	NULL,
  email 		VARCHAR(70) 	NULL,
  create_at 		DATETIME 	NOT NULL DEFAULT NOW(),
  CONSTRAINT uk_dni_per UNIQUE (dni)
) ENGINE = INNODB;

-- T5 USUARIOS RELACIONADO CON T2 Y T4
DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
  idUsuario 		INT AUTO_INCREMENT PRIMARY KEY,
  idPersona		INT NOT NULL,
  idTipoUsuario 	INT NOT NULL,
  nomUser 		VARCHAR(20) 	NOT NULL,
  passUser 		VARCHAR(70) 	NOT NULL,
  create_at 		DATETIME 	NOT NULL DEFAULT NOW(),
  update_at 		DATETIME 	NULL,
  inactive_at		DATETIME 	NULL,
  CONSTRAINT fk_idpersona_usu FOREIGN KEY (idPersona) REFERENCES personas (idPersona), 
  CONSTRAINT uk_idpersona_usu UNIQUE (idPersona), -- Uno a Uno
  CONSTRAINT fk_usuarios_tipo_usuario FOREIGN KEY (idTipoUsuario) REFERENCES tipos_usuarios (idTipoUsuario),
  CONSTRAINT uk_nomuser_usu UNIQUE (nomUser)
) ENGINE = INNODB;

-- T6 CAMPOS
DROP TABLE IF EXISTS campos;
CREATE TABLE campos (
  idCampo 	INT AUTO_INCREMENT PRIMARY KEY,
  tipoCampo 	VARCHAR (20) NOT NULL,
  nombre 	VARCHAR (20) NOT NULL,
  latitud 	DECIMAL (9, 6) NOT NULL,
  longitud 	DECIMAL (9, 6) NOT NULL,
  direccion 	VARCHAR (30) NOT NULL,
  distrito 	VARCHAR (30) NOT NULL,
  telefono 	VARCHAR (30) NOT NULL
) ENGINE = INNODB;

-- T7 ZONAS DE CAMPOS RELACIONADO CON T6
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
  CONSTRAINT 	fk_zonas_campos_campo FOREIGN KEY (idCampo) REFERENCES campos (idCampo)
) ENGINE = INNODB;

-- T8 RESERVACIONES DE LAS ZONAS RELACIONADO CON T7
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
  CONSTRAINT 		fk_reservaciones_zona_campo 	FOREIGN KEY (idZonaCampo) REFERENCES zonas_campos (idZonaCampo),
  CONSTRAINT 		fk_reservaciones_usuario 	FOREIGN KEY (idUsuario) REFERENCES usuarios (idUsuario)
) ENGINE = INNODB;

-- T9 PAGOS RELACIONADO CON T8
DROP TABLE IF EXISTS pagos;
CREATE TABLE pagos (
  idPago INT AUTO_INCREMENT PRIMARY KEY,
  idReservacion INT NOT NULL,
  monto DECIMAL (10, 2),
  fechaPago DATETIME NOT NULL,
  metodoPago VARCHAR (20) NOT NULL,
  comprobante VARCHAR (255) NOT NULL,
  estadoPago VARCHAR (20) NOT NULL,
  CONSTRAINT fk_pagos_reservacion FOREIGN KEY (idReservacion) REFERENCES reservaciones (idReservacion)
) ENGINE = INNODB;
