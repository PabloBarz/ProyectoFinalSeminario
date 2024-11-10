USE sportsfieldrentaldb;

/* Aquí irán todos los stored procedures */

-- SP para renderizar los campos
DROP PROCEDURE IF EXISTS spGetAllCampos;
DELIMITER //
CREATE PROCEDURE spGetAllCampos()
BEGIN
    SELECT idCampo, tipoCampo, nombre, latitud, longitud, direccion, distrito, telefono FROM campos;
END //
DELIMITER ;


-- SP para listar las reservaciones
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


-- SP para validar usuario al iniciar sesión
DROP PROCEDURE IF EXISTS spUsuarioLogin;
DELIMITER //
CREATE PROCEDURE spUsuarioLogin(IN _nomuser VARCHAR(20))
BEGIN
    SELECT * FROM vwUserPerson
    WHERE nomUser = _nomuser AND inactiveAt IS NULL;
END //
DELIMITER ;


-- SP para validar clientes al registrar una reserva
DROP PROCEDURE IF EXISTS spVerifyClient;
DELIMITER //
CREATE PROCEDURE spVerifyClient
(
	IN _dni CHAR(8)
)	
BEGIN
	SELECT * FROM vwUserPerson
	WHERE dni = _dni; 
END //
DELIMITER ; 


DROP PROCEDURE IF EXISTS spGetDataUsers;
DELIMITER //
CREATE PROCEDURE spGetDataUsers()
BEGIN
    SELECT 
        u.idUsuario AS IDUsuario,
        t.nombreRol AS TipoUsuario,
        u.nomUser AS Usuario,
        u.passUser AS Contraseña    
    FROM 
        usuarios u
    INNER JOIN 
        tipos_usuarios t ON t.idTipoUsuario = u.idTipoUsuario;
END //
DELIMITER ;`zonas_campos``zonas_campos`



/*Store Procedure para obtener permiso por perfil*/
DROP PROCEDURE IF EXISTS spGetPermisosByPerfil;
DELIMITER //
CREATE PROCEDURE spGetPermisosByPerfil (
    IN _nombrecorto CHAR(3)
)
BEGIN
    SELECT 
        MD.modulo,
        RT.ruta,
        RT.visible,
        RT.texto,
        RT.icono
    FROM 
        permisos AS PE
    INNER JOIN 
        tipos_usuarios AS TU ON PE.idTipoUsuario = TU.idTipoUsuario
    INNER JOIN 
        rutas AS RT ON PE.idRuta = RT.idRuta
    INNER JOIN 
        modulos AS MD ON RT.idModulo = MD.idModulo
    WHERE 
        TU.nombrecorto = _nombrecorto;
END //
DELIMITER ;



CALL spGetPermisosByPerfil("ADM");
