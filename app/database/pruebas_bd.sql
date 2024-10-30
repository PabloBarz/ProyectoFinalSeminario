USE sportsfieldrentaldb;

/* Aqui van a ir los datos de pruebas*/

/* Eliminar datos existentes */
DELETE FROM pagos;
DELETE FROM reservaciones;
DELETE FROM zonas_campos;
DELETE FROM campos;
DELETE FROM usuarios;
DELETE FROM personas;
DELETE FROM permisos;
DELETE FROM tipos_usuarios;
DELETE FROM acciones;


/* Insertar acciones */
INSERT INTO acciones (nombre) VALUES 
('Crear Reservación'),
('Modificar Reservación'),
('Eliminar Reservación'),
('Consultar Reservaciones');

/* Insertar tipos de usuarios */
INSERT INTO tipos_usuarios (nombreRol, nombreCorto) VALUES
('Administrador', 'ADM'),
('Supervisor', 'SPV'),
('Invitado', 'INV');

/* Insertar permisos */
INSERT INTO permisos (idAccion, idTipoUsuario) VALUES 
(1, 1), -- Administrador puede crear reservaciones
(2, 1), -- Administrador puede modificar reservaciones
(3, 1), -- Administrador puede eliminar reservaciones
(4, 1), -- Administrador puede consultar reservaciones
(1, 2), -- Cliente puede crear reservaciones
(4, 2), -- Cliente puede consultar reservaciones
(4, 3); -- Empleado puede consultar reservaciones

/* Insertar personas */
INSERT INTO personas (apellidos, nombres, dni) VALUES
('Barzola Claudio', 'Roberto Pablo', '77420150'),
('Ochoa Prada', 'Karina', '11112222'),
('Castilla Morales', 'Carlos', '33334444'),
('Tasayco Yataco','Valentino','76180741');

/* Insertar usuarios */
INSERT INTO usuarios (idPersona, idTipoUsuario, nomUser, passUser) VALUES 
(1, 1, 'Pablo', '123'),
(2, 2, 'Karina', '123'),
(3, 3, 'Carlos', '123'),
(4,1,'Vaistaya','123');


UPDATE usuarios SET passUser = '$2y$10$zDaQ9eU7HpHq6NA0Es/W3O.2wq2zpZKiOSf2MnTIKTzgyqxZKLM4e' WHERE idUsuario = 1;
UPDATE usuarios SET passUser = '$2y$10$2lbo6wQ73RB.aKjUZpte5utBK.BDP/ZYT1d85ZjgUR8Z1N0gApW6q' WHERE idUsuario = 2;
UPDATE usuarios SET passUser = '$2y$10$bSPoK.vw2LMFJ0XD.c6FJeH4n6UfaeUHLveq1y2Zs8l4EYYaByCtG' WHERE idUsuario = 3;
UPDATE usuarios SET passUser = '$2y$10$xLCsA6h7Nel8ArSyyAe.veYWIaUQty7pFUKxtv2EwWv8wvY33uDbi' WHERE idUsuario = 4;

/* Insertar campos */
-- Inserción de datos en la tabla campos con NULL en el campo telefono cuando no hay número
INSERT INTO campos (tipoCampo, nombre, latitud, longitud, direccion, distrito, telefono) VALUES
('Futbol', 'El golazo', -13.412920, -76.152480, 'Av Centenario Calle 3', 'Sunampe', '956848951'),
('Futbol', 'Deporcentro Tarazona', -13.445049, -76.137218, 'Las gardenias', 'Chincha Baja', '981047228'),
('Futbol', 'El volante', -13.424924, -76.136024, 'Prol. Lima 699', 'Sunampe', '955660928'),
('Futbol', 'Los peloteros', -13.404182, -76.149584, 'C. Satelite', 'Grocio Prado', NULL),
('Futbol', 'Los galacticos', -13.416167, -76.149789, 'Psj. La Paz', 'Sunampe', '981127319'),
('Futbol', 'El mundialito', -13.396716, -76.125345, 'Calle A x Calle Los Martirez', 'Sunampe', '942101700'),
('Futbol', 'LA FAVELA', -13.416690, -76.117680, 'Pasaje San Pablito', 'Chincha Alta', '945292380'),
('Futbol', 'Apolo', -13.412172, -76.133803, 'C. Rosario 159', 'Chincha Alta', '951050584'),
('Futbol', 'El profe', -13.411961, -76.142735, 'Av. Pedro Moreno 778', 'Chincha Alta', '956530662');


/* Insertar zonas de campos */
INSERT INTO zonas_campos (idCampo, nombre, capacidad, superficie, dimensiones, precioHora, descripcion, estado) VALUES 
(1, 'Zona A', 10, 'Césped', '40x20', 50, 'Zona ideal para partidos amistosos', 'Disponible'),
(1, 'Zona B', 15, 'Césped', '60x30', 75, 'Zona con graderías', 'Disponible'),
(2, 'Zona C', 8, 'Arena', '30x20', 40, 'Zona para entrenamiento', 'Disponible');

/* Insertar reservaciones */
INSERT INTO reservaciones (idZonaCampo, idUsuario, fechaReservacion, horaInicio, horaFin, estadoPago, precioHora, cantidadHora) VALUES 
(1, 2, '2024-10-30', '10:00:00', '12:00:00', 'Pagado', 50, 2),
(2, 1, '2024-10-31', '14:00:00', '16:00:00', 'Pendiente', 75, 2);

/* Insertar pagos */
INSERT INTO pagos (idReservacion, monto, fechaPago, metodoPago, comprobante, estadoPago) VALUES 
(1, 100.00, '2024-10-30 09:00:00', 'Yape', 'comprobante_1.pdf', 'Completado'),
(2, 150.00, '2024-10-31 13:00:00', 'Yape', 'comprobante_2.pdf', 'Pendiente');
