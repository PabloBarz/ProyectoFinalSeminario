USE sportsfieldrentaldb;

/*Aqui iran todos los sp relacionado con campos y zonas campos*/

/*SP para renderizar los select de campos y la direccion*/
DROP PROCEDURE IF EXISTS spListSelectCampos;
DELIMITER //
CREATE PROCEDURE spListSelectCampos()
BEGIN 
	SELECT idcampo, nombre, direccion, distrito FROM campos ORDER BY nombre ASC;
END //
DELIMITER ;

/* SP para poder renderizar  los select de zonacampos en base al id de campo*/
DROP PROCEDURE IF EXISTS spListZonaCampoByCampo;
DELIMITER //
CREATE PROCEDURE spListZonaCampoByCampo
(
    IN _idCampo INT 
)
BEGIN 
	SELECT idZonaCampo, nombre, precioHora FROM zonas_campos
	WHERE idCampo = _idCampo 
	ORDER BY nombre ASC;
END //
DELIMITER ;

-- sp para listar campos con zonas disponibles
DROP PROCEDURE IF EXISTS splistCamposDisponibles;
DELIMITER //
CREATE PROCEDURE splistCamposDisponibles(
    IN p_fecha DATE,
    IN p_hora_inicio TIME,
    IN p_hora_fin TIME
)
BEGIN
    SELECT DISTINCT c.idCampo, c.tipoCampo, c.nombre, c.latitud, c.longitud, c.direccion, c.distrito, c.telefono
    FROM campos c
    INNER JOIN zonas_campos z ON c.idCampo = z.idCampo
    LEFT JOIN reservaciones rz 
        ON z.idZonaCampo = rz.idZonaCampo 
        AND rz.fechaReservacion = p_fecha
        AND (
            (p_hora_inicio BETWEEN rz.horaInicio AND rz.horaFin) OR
            (p_hora_fin BETWEEN rz.horaInicio AND rz.horaFin) OR
            (rz.horaInicio BETWEEN p_hora_inicio AND p_hora_fin) OR
            (rz.horaFin BETWEEN p_hora_inicio AND p_hora_fin)
        )
    WHERE rz.idReservacion IS NULL;
END//
DELIMITER ;


-- sp para listar zonas disponibles por campo
DROP PROCEDURE IF EXISTS spListZonasDisponibles;
DELIMITER //
CREATE PROCEDURE spListZonasDisponibles(
    IN p_fecha DATE,
    IN p_hora_inicio TIME,
    IN p_hora_fin TIME,
    IN p_ID_campo INT
)
BEGIN
    SELECT z.idZonaCampo, z.nombre
    FROM zonas_campos z
    LEFT JOIN reservaciones rz 
        ON z.idZonaCampo = rz.idZonaCampo 
        AND rz.fechaReservacion = p_fecha
        AND (
            (p_hora_inicio BETWEEN rz.horaInicio AND rz.horaFin) OR
            (p_hora_fin BETWEEN rz.horaInicio AND rz.horaFin) OR
            (rz.horaInicio BETWEEN p_hora_inicio AND p_hora_fin) OR
            (rz.horaFin BETWEEN p_hora_inicio AND p_hora_fin)
        )
    WHERE rz.idReservacion IS NULL
    AND z.idCampo = p_ID_campo;
END//
DELIMITER ;

-- CALL spListZonasDisponibles ("2024-10-28", "11:00:00", "12:30:00", 2)
-- CALL splistCamposDisponibles ("2024-10-28", "11:00:00", "13:00:00")


