USE sportsfieldrentaldb;

/* Aqui van a ir los datos de pruebas*/

-- Insertar acciones
INSERT INTO acciones (nombre) VALUES 
('Crear Reservación'),
('Modificar Reservación'),
('Eliminar Reservación'),
('Consultar Reservaciones');

-- Insertar tipos de usuarios
INSERT INTO tipos_usuarios (nombreRol) VALUES 
('Administrador'),
('Cliente'),
('Empleado');

-- Insertar permisos
INSERT INTO permisos (idAccion, idTipoUsuario) VALUES 
(1, 1), -- Administrador puede crear reservaciones
(2, 1), -- Administrador puede modificar reservaciones
(3, 1), -- Administrador puede eliminar reservaciones
(4, 1), -- Administrador puede consultar reservaciones
(1, 2), -- Cliente puede crear reservaciones
(4, 2), -- Cliente puede consultar reservaciones
(4, 3); -- Empleado puede consultar reservaciones

-- Insertar usuarios
INSERT INTO usuarios (idTipoUsuario, nombre, apellido, correoElectronico, constraseña, telefono) VALUES 
(1, 'Juan', 'Pérez', 'juan.perez@example.com', 'password123', '123456789'),
(2, 'María', 'García', 'maria.garcia@example.com', 'password456', '987654321'),
(3, 'Luis', 'Martínez', 'luis.martinez@example.com', 'password789', '456123789');

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
