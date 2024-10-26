USE sportsfieldrentaldb;

/* Aqui van a ir los datos de pruebas*/

-- Insertar acciones
INSERT INTO acciones (nombre) VALUES 
('Crear Reservación'),
('Modificar Reservación'),
('Eliminar Reservación'),
('Consultar Reservaciones');

-- Insertar tipos de usuarios
INSERT INTO tipos_usuarios (nombreRol, nombrecorto) VALUES
('Administrador', 'ADM'),
('Supervisor', 'SPV'),
('Invitado', 'INV');

-- Insertar permisos
INSERT INTO permisos (idAccion, idTipoUsuario) VALUES 
(1, 1), -- Administrador puede crear reservaciones
(2, 1), -- Administrador puede modificar reservaciones
(3, 1), -- Administrador puede eliminar reservaciones
(4, 1), -- Administrador puede consultar reservaciones
(1, 2), -- Cliente puede crear reservaciones
(4, 2), -- Cliente puede consultar reservaciones
(4, 3); -- Empleado puede consultar reservaciones

-- Insertar personas
INSERT INTO personas (apellidos, nombres, dni) VALUES
('Barzola Claudio', 'Roberto Pablo', '77420150'),
('Ochoa Prada', 'Karina', '11112222'),
('Castilla Morales', 'Carlos', '33334444');


-- Insertar usuarios
INSERT INTO usuarios (idPersona, idTipoUsuario, nomUser, passUser) VALUES 
(1, 1, 'Pablo', '123'),
(2, 2, 'Karina', '123'),
(3, 3, 'Carlos', '123');

/*UPDATE usuarios SET passuser = '$2y$10$2bLM5P3czoCxOgUzUiczb.I9v7zCrNCTHHypgQqxI7dS7fPzy6jXm' WHERE idusuario = 1;
UPDATE usuarios SET passuser = '$2y$10$mN17BrRISm3N0Yo/DjF8YebEudo7rMKdHRdCa/yfatEbD3zPHOS9S' WHERE idusuario = 2;
UPDATE usuarios SET passuser = '$2y$10$zLZfCqnbfLatck7P7uCzBOyRFTFYK437m2m05H7k3uYz1Zzx8Va/.' WHERE idusuario = 3;*/

-- Insertar campos
INSERT INTO campos (tipoCampo, nombre, latitud, longitud, direccion, distrito, telefono) VALUES 
('Fútbol', 'Campo Central', -12.0456, -77.0352, 'Av. Principal 123', 'Alto Laran', '123456789'),
('Vóley', 'Campo Secundario', -12.0460, -77.0360, 'Av. Secundaria 456', 'Pueblo Nuevo', '987654321');

-- Insertar zonas de campos
INSERT INTO zonas_campos (idCampo, nombre, capacidad, superficie, dimensiones, precioHora, descripcion, estado) VALUES 
(1, 'Zona A', 10, 'Césped', '40x20', 50, 'Zona ideal para partidos amistosos', 'Disponible'),
(1, 'Zona B', 15, 'Césped', '60x30', 75, 'Zona con graderías', 'Disponible'),
(2, 'Zona C', 8, 'Arena', '30x20', 40, 'Zona para entrenamiento', 'Disponible');

-- Insertar reservaciones
INSERT INTO reservaciones (idZonaCampo, idUsuario, fechaReservacion, horaInicio, horaFin, estadoPago, precioHora, cantidadHora) VALUES 
(1, 2, '2024-10-30', '10:00:00', '12:00:00', 'Pagado', 50, 2),
(2, 1, '2024-10-31', '14:00:00', '16:00:00', 'Pendiente', 75, 2);

-- Insertar pagos
INSERT INTO pagos (idReservacion, monto, fechaPago, metodoPago, comprobante, estadoPago) VALUES 
(1, 100.00, '2024-10-30 09:00:00', 'Yape', 'comprobante_1.pdf', 'Completado'),
(2, 150.00, '2024-10-31 13:00:00', 'Yape', 'comprobante_2.pdf', 'Pendiente');
