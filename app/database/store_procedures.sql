USE sportsfieldrentaldb;

/* Aqui iran todas los store procedures*/

-- SP para listar las reservaciones()
DELIMITER //

CREATE PROCEDURE spGetDataReservacion()
BEGIN
    SELECT 
        r.idReservacion,
        r.fechaReservacion,
        r.horaInicio,
        r.horaFin,
        r.estadoPago,
        r.precioHora,
        r.cantidadHora,
        z.nombre AS nombreZona,
        u.nombre AS nombreUsuario,
        u.apellido AS apellidoUsuario,
        c.nombre AS nombreCampo,
        c.direccion AS direccionCampo
    FROM 
        reservaciones r
    JOIN 
        zonas_campos z ON r.idZonaCampo = z.idZonaCampo
    JOIN 
        usuarios u ON r.idUsuario = u.idUsuario
    JOIN 
        campos c ON z.idCampo = c.idCampo;
END //

DELIMITER ;

CALL spGetDataReservacion();







