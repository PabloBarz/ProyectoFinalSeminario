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
("usuarios"), -- 5
("zonas_campos"); -- 6
 
/* Insertar acciones */
INSERT INTO rutas (idmodulo, ruta, visible, texto, icono) VALUES 
-- Home
(1, "welcome", FALSE, "", ""), -- 1
-- Campos- Zonas Campos 
(2, "lista-campos", TRUE, "Campos", "fa-solid fa-futbol"), -- 2
(2, "registro-campos", FALSE, "", ""), -- 3 
(2,"actualizar-campos",FALSE,"",""), -- 4 
-- Mapas de campos
(3, "lista-maps-campos", TRUE, "Mapas de Campos", "fa-solid fa-map-location-dot"), -- 5
-- Reservaciones
(4, "lista-reservaciones", TRUE, "Reservaciones", "fa-solid fa-calendar-days"), -- 6
(4, "registro-reservaciones", FALSE, "", ""), -- 7
-- Usuarios
(5, "lista-usuarios", TRUE, "Usuarios", "fa-solid fa-users"), -- 8
(5, "registra-usuarios", FALSE, "", ""), -- 9
(5, "actualizar-usuarios", FALSE, "", ""), -- 10
-- Zonas campos
(6, "lista-zonascampos", TRUE, "Zona Campos", "fa-brands fa-codepen"), -- 11
(6, "registro-zonascampos", FALSE, "", ""); -- 12


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
(1, 9),  
(1, 10),
(1, 11),
(1 ,12),
-- SPV
(2,1),
(2,2),
(2,6),
(2,7),
(2,11),
-- CLI
(3,1),
(3,5),
(3,6),
(3,7);

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

/* UPDATE usuarios SET idTipoUsuario = 1 WHERE idUsuario = 1 */

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
/* Insertar zonas para cada campo, máximo 3 zonas por campo */
INSERT INTO zonas_campos (idCampo, nombre, capacidad, superficie, dimensiones, precioHora, descripcion, estado) VALUES 
-- Zonas para el campo 1
(1, 'Zona A', 10, 'Césped', '40x20', 50, 'Zona ideal para partidos amistosos', 'Disponible'),
(1, 'Zona B', 15, 'Césped', '60x30', 75, 'Zona con graderías', 'Disponible'),
(1, 'Zona C', 12, 'Césped', '50x25', 60, 'Zona para torneos locales', 'Ocupado'),

-- Zonas para el campo 2
(2, 'Zona D', 8, 'Arena', '30x20', 40, 'Zona para entrenamiento', 'Disponible'),
(2, 'Zona E', 10, 'Arena', '35x25', 45, 'Zona de práctica con menor aforo', 'Disponible'),
(2, 'Zona F', 12, 'Arena', '40x30', 50, 'Zona para actividades de resistencia', 'Ocupado'),

-- Zonas para el campo 3
(3, 'Zona G', 10, 'Césped', '50x25', 55, 'Zona de juego estándar', 'Disponible'),
(3, 'Zona H', 14, 'Césped', '60x30', 70, 'Zona con iluminación nocturna', 'Disponible'),
(3, 'Zona I', 18, 'Césped', '70x40', 90, 'Zona premium con graderías', 'Ocupado'),

-- Zonas para el campo 4
(4, 'Zona J', 6, 'Césped', '25x15', 30, 'Zona de recreación infantil', 'Disponible'),
(4, 'Zona K', 12, 'Césped', '50x25', 55, 'Zona ideal para torneos', 'Ocupado'),
(4, 'Zona L', 15, 'Césped', '55x30', 65, 'Zona para entrenamientos privados', 'Disponible'),

-- Zonas para el campo 5
(5, 'Zona M', 10, 'Césped', '45x20', 50, 'Zona para partidos amistosos', 'Disponible'),
(5, 'Zona N', 14, 'Césped', '60x30', 70, 'Zona de uso general', 'Ocupado'),
(5, 'Zona O', 18, 'Césped', '70x35', 80, 'Zona con acceso VIP', 'Disponible'),

-- Zonas para el campo 6
(6, 'Zona P', 10, 'Césped', '40x20', 50, 'Zona de juegos nocturnos', 'Disponible'),
(6, 'Zona Q', 15, 'Césped', '65x30', 75, 'Zona de uso intensivo', 'Disponible'),
(6, 'Zona R', 20, 'Césped', '70x40', 90, 'Zona principal para torneos', 'Ocupado'),

-- Zonas para el campo 7
(7, 'Zona S', 8, 'Arena', '30x20', 40, 'Zona de entrenamiento básico', 'Disponible'),
(7, 'Zona T', 10, 'Césped', '40x25', 50, 'Zona con sombra natural', 'Disponible'),
(7, 'Zona U', 14, 'Césped', '55x30', 65, 'Zona para partidos oficiales', 'Ocupado'),

-- Zonas para el campo 8
(8, 'Zona V', 12, 'Césped', '50x25', 60, 'Zona para juegos amistosos', 'Disponible'),
(8, 'Zona W', 18, 'Césped', '70x35', 85, 'Zona con asientos de espectadores', 'Ocupado'),
(8, 'Zona X', 20, 'Césped', '75x40', 100, 'Zona de alto nivel', 'Disponible'),

-- Zonas para el campo 9
(9, 'Zona Y', 8, 'Césped', '35x20', 45, 'Zona de práctica para principiantes', 'Disponible'),
(9, 'Zona Z', 12, 'Césped', '50x25', 55, 'Zona para torneos locales', 'Disponible'),
(9, 'Zona AA', 16, 'Césped', '60x30', 70, 'Zona con capacidad para espectadores', 'Ocupado');

/* Insertar reservaciones */
INSERT INTO reservaciones (idZonaCampo, idUsuario, fechaReservacion, horaInicio, horaFin, estadoPago, precioHora, cantidadHora) VALUES 
(1, 2, '2024-10-30', '10:00:00', '12:00:00', 'Pagado', 50, 2),
(2, 1, '2024-10-31', '14:00:00', '16:00:00', 'Pendiente', 75, 2);

/* Insertar pagos */
INSERT INTO pagos (idReservacion, monto, fechaPago, metodoPago, comprobante, estadoPago) VALUES 
(1, 100.00, '2024-10-30 09:00:00', 'Yape', 'comprobante_1.pdf', 'Completado'),
(2, 150.00, '2024-10-31 13:00:00', 'Yape', 'comprobante_2.pdf', 'Pendiente');
