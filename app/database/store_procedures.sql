USE sportsfieldrentaldb;

/* Aqui iran todos los store procedures*/

-- SP para listar las reservaciones()
DROP PROCEDURE IF EXISTS spGetDataReservacion;
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
        u.nomUser AS nombreUsuario,
        p.apellidos AS apellidoUsuario,  
        p.nombres AS nombreCliente,  
        c.nombre AS nombreCampo,
        c.direccion AS direccionCampo
    FROM 
        reservaciones r
    INNER JOIN 
        zonas_campos z ON r.idZonaCampo = z.idZonaCampo
    INNER JOIN 
        usuarios u ON r.idUsuario = u.idUsuario
    INNER JOIN 
        personas p ON u.idPersona = p.idPersona 
    INNER JOIN 
        campos c ON z.idCampo = c.idCampo;
END //

DELIMITER ;

-- SP para validar usuario cuando se logea 
DROP PROCEDURE IF EXISTS spUsuarioLogin;
DELIMITER //
CREATE PROCEDURE spUsuarioLogin(IN _nomuser VARCHAR(20))
BEGIN
    SELECT
        US.idusuario,
        PE.apellidos, 
        PE.nombres,
        TU.nombreRol, 
        TU.nombreCorto,
        US.nomUser, 
        US.passUser
    FROM 
        usuarios US
    INNER JOIN 
        personas PE ON PE.idpersona = US.idpersona
    INNER JOIN 
        tipos_usuarios TU ON TU.idTipoUsuario = US.idTipoUsuario
    WHERE 
        US.nomUser = _nomuser AND US.inactive_at IS NULL;
END //

DELIMITER ;

-- Ejemplo de llamada al procedimiento
CALL spGetDataReservacion();
