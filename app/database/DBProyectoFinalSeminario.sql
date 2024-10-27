CREATE DATABASE sportsfieldrentaldb;
USE sportsfieldrentaldb;

-- T1 ACCIONES
 CREATE TABLE acciones (
  idAccion 	INT AUTO_INCREMENT PRIMARY KEY,
  nombre 	VARCHAR (20) NOT NULL
) ENGINE = INNODB;

-- T2 TIPO DE USUARIOS
 CREATE TABLE tipos_usuarios (
  idTipoUsuario INT AUTO_INCREMENT PRIMARY KEY,
  nombreRol 	VARCHAR (20) NOT NULL
) ENGINE = INNODB;

-- T3 PERMISOS RELACIONANDO CON T1 Y T2
 CREATE TABLE permisos (
  idPermiso 	INT AUTO_INCREMENT PRIMARY KEY,
  idAccion 	INT NOT NULL,
  idTipoUsuario INT NOT NULL,
  CONSTRAINT 	fk_permisos_accion 		FOREIGN KEY (idAccion) REFERENCES acciones (idAccion),
  CONSTRAINT 	fk_permisos_tipo_usuario 	FOREIGN KEY (idTipoUsuario) REFERENCES tipos_usuarios (idTipoUsuario)
) ENGINE = INNODB;

-- T4 USUARIOS RELACIONADO CON T2
 CREATE TABLE usuarios (
  idUsuario 		INT AUTO_INCREMENT PRIMARY KEY,v
  idTipoUsuario 	INT NOT NULL,
  nombre 		VARCHAR (20) NOT NULL,
  apellido 		VARCHAR (20) NOT NULL,
  correoElectronico 	VARCHAR (50) NOT NULL,
  constraseña 		VARCHAR (255) NOT NULL,
   telefono 		VARCHAR (20) NOT NULL,
  CONSTRAINT 		fk_usuarios_tipo_usuario FOREIGN KEY (idTipoUsuario) REFERENCES tipos_usuarios (idTipoUsuario)
) ENGINE = INNODB;

-- T5 CAMPOS
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

-- T6 ZONAS DE CAMPOS RELACIONADO CON T5
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

-- T7 RESERVACIONES DE LAS ZONAS RELACIONADO CON T6
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

-- T8 PAGOS RELACIONADO CON T7
 CREATE TABLE pagos (
  idPago INT AUTO_INCREMENT PRIMARY KEY,
  idReservacion INT NOT NULL,
  monto DECIMAL (6, 2),
  fechaPago DATETIME NOT NULL,
  metodoPago VARCHAR (20) NOT NULL,
  comprobante VARCHAR (255) NOT NULL,
  estadoPago VARCHAR (20) NOT NULL,
  CONSTRAINT fk_pagos_reservacion FOREIGN KEY (idReservacion) REFERENCES reservaciones (idReservacion)
) ENGINE = INNODB;

