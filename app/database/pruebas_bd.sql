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
DELETE FROM rutas;
DELETE FROM modulos;


/* Insertar Modulos*/
INSERT INTO modulos (modulo) VALUES
("home"), -- 1
("campos"), -- 2
("mapscampos"), -- 3
("reservaciones"), -- 4
("usuarios"); -- 5

/* Insertar acciones */
INSERT INTO rutas (idmodulo, ruta, visible, texto, icono) VALUES 
-- Home
(1, "welcome", FALSE, "", ""), -- 1
-- Campos- Zonas Campos 
(2, "lista-campos", TRUE, "Campos", "fa-solid fa-futbol"), -- 2
(2, "registro-campos", FALSE, "", ""), -- 3 
-- Mapas de campos
(3, "lista-maps-campos", TRUE, "Mapas de Campos", "fa-solid fa-map-location-dot"), -- 4
-- Reservaciones
(4, "lista-reservaciones", TRUE, "Reservaciones", "fa-solid fa-calendar-days"), -- 5
(4, "registro-horario", FALSE, "", ""), -- 6
-- Usuarios
(5, "lista-usuarios", TRUE, "Usuarios", "fa-solid fa-users"), -- 7
(5, "registra-usuarios", FALSE, "", ""); -- 8


/* Insertar tipos de usuarios */
INSERT INTO tipos_usuarios (nombreRol, nombreCorto) VALUES
('Administrador', 'ADM'), -- 1
('Supervisor', 'SPV'), -- 2
('Cliente', 'CLI'); -- 3

/* Insertar permisos */
INSERT INTO permisos (idTipoUsuario, idRuta) VALUES 
-- ADM
(1, 1),  
(1, 2),  
(1, 3),  
(1, 4),  
(1, 5),  
(1, 6),  
(1, 7),  
(1, 8),  

-- SPV
(2,1),
(2,2),
(2,5),
(2,6),

-- CLI
(3,1),
(3,4),
(3,5),
(3,6);


/* Insertar personas */
INSERT INTO personas (apellidos, nombres, dni) VALUES
('Barzola Claudio', 'Roberto Pablo', '77420150'),
('Tasayco Yataco','Valentino','76180741'),
('Ochoa Prada', 'Karina', '11112222'),
('Castilla Morales', 'Carlos', '33334444');


/* Insertar usuarios */
INSERT INTO usuarios (idPersona, idTipoUsuario, nomUser, passUser) VALUES 
(1, 1, 'Pablo', '123'),
(2, 1, 'Vaistaya', '123'),
(3, 2, 'Karina', '123'),
(4, 3, 'Carlos', '123');



UPDATE usuarios SET passUser = '$2y$10$zDaQ9eU7HpHq6NA0Es/W3O.2wq2zpZKiOSf2MnTIKTzgyqxZKLM4e' WHERE idUsuario = 1;
UPDATE usuarios SET passUser = '$2y$10$xLCsA6h7Nel8ArSyyAe.veYWIaUQty7pFUKxtv2EwWv8wvY33uDbi' WHERE idUsuario = 2;
UPDATE usuarios SET passUser = '$2y$10$2lbo6wQ73RB.aKjUZpte5utBK.BDP/ZYT1d85ZjgUR8Z1N0gApW6q' WHERE idUsuario = 3;
UPDATE usuarios SET passUser = '$2y$10$bSPoK.vw2LMFJ0XD.c6FJeH4n6UfaeUHLveq1y2Zs8l4EYYaByCtG' WHERE idUsuario = 4;


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
