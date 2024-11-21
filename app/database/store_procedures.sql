USE sportsfieldrentaldb;

/* Aquí irán todos los stored procedures */

/* SP para mostrar usuario por ID */
DROP PROCEDURE IF EXISTS spGetUserById;
DELIMITER //
CREATE PROCEDURE spGetUserById(IN _idUsuario INT)
BEGIN
    SELECT * FROM vwUserTipoUsuario 
    WHERE IDUsuario = _idUsuario;
END //
DELIMITER ;

/* SP para listar los campos */
DROP PROCEDURE IF EXISTS spGetAllCampos;
DELIMITER //
CREATE PROCEDURE spGetAllCampos()
BEGIN
    SELECT idCampo, tipoCampo, nombre, latitud, longitud, direccion, distrito, telefono FROM campos;
END //
DELIMITER ;

/* SP para listar las reservaciones */
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

/* SP para validar usuario al iniciar sesión */
DROP PROCEDURE IF EXISTS spUsuarioLogin;
DELIMITER //
CREATE PROCEDURE spUsuarioLogin(IN _nomuser VARCHAR(20))
BEGIN
    SELECT * FROM vwUserPerson
    WHERE nomUser = _nomuser AND inactiveAt IS NULL;
END //
DELIMITER ;

/* SP para registrar usuarios */
DROP PROCEDURE IF EXISTS spRegisterUser;
DELIMITER //
CREATE PROCEDURE spRegisterUser
(
  IN _idPersona      INT,
  IN _idTipoUsuario  INT,
  IN _email          VARCHAR(70),
  IN _nomUser        VARCHAR(20),
  IN _passUser       VARCHAR(70)
)
BEGIN 
	INSERT INTO usuarios (idPersona, idTipoUsuario, email, nomUser, passUser) 
	VALUES (_idPersona, _idTipoUsuario, _email, _nomUser, _passUser);
END //
DELIMITER ; 

/* SP para registrar personas */
DROP PROCEDURE IF EXISTS spRegisterPerson;
DELIMITER //
CREATE PROCEDURE spRegisterPerson
(
  IN _apellidos      VARCHAR(40),
  IN _nombres        VARCHAR(40),
  IN _dni            CHAR(8),
  IN _telefono       CHAR(9)
)
BEGIN 
	INSERT INTO personas (apellidos, nombres, dni, telefono)  
	VALUES (_apellidos, _nombres, _dni, NULLIF(_telefono, ''));
		
	SELECT LAST_INSERT_ID() AS idPersona;
END //
DELIMITER ;

/* SP para validar clientes al registrar una reserva */
DROP PROCEDURE IF EXISTS spVerifyClient;
DELIMITER //
CREATE PROCEDURE spVerifyClient(IN _dni CHAR(8))	
BEGIN
	SELECT * FROM vwUserPerson
	WHERE dni = _dni; 
END //
DELIMITER ; 

/* SP para listar select de tipos de usuarios */
DROP PROCEDURE IF EXISTS spListSelectTypeUser;
DELIMITER //
CREATE PROCEDURE spListSelectTypeUser()	
BEGIN
	SELECT idTipoUsuario, nombreRol, nombreCorto FROM tipos_usuarios; 
END //
DELIMITER ; 

/* SP para listar todos los campos usuarios con su tipo de usuario */
DROP PROCEDURE IF EXISTS spGetDataUsers;
DELIMITER //
CREATE PROCEDURE spGetDataUsers()
BEGIN
    SELECT * FROM vwUserTipoUsuario;
END //
DELIMITER ;

/* Store Procedure para obtener permiso por perfil */
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

/* SP para obtener los datos de zonas de los campos */
DROP PROCEDURE IF EXISTS spGetDataZonasCampos;
DELIMITER //
CREATE PROCEDURE spGetDataZonasCampos()
BEGIN
    SELECT 
	z.idZonaCampo,
        c.nombre AS NombreCampo,
        z.nombre AS NombreZonaCampo,
        z.capacidad AS CapacidadZonaCampo,
        z.superficie AS SuperficieZonaCampo,
        z.dimensiones AS DimensionesZonaCampo,
        z.precioHora AS PrecioPorHora,
        z.descripcion AS DescripcionZonaCampo,
        z.estado AS EstadoZonaCampo
    FROM 
        campos c
    INNER JOIN 
        zonas_campos z ON c.idCampo = z.idCampo;
END //
DELIMITER ;

/* SP para obtener los datos de los campos */
DROP PROCEDURE IF EXISTS spGetDataCampos;
DELIMITER //
CREATE PROCEDURE spGetDataCampos()
BEGIN
    SELECT 
		idCampo,
        tipoCampo,
        nombre,
        latitud,
        longitud,
        direccion,
        distrito,
        telefono
    FROM 
        campos;
END //
DELIMITER ;

/* SP para agregar campos */
DROP PROCEDURE IF EXISTS spAddCampos;
DELIMITER //
CREATE PROCEDURE spAddCampos(
 IN _tipoCampo 	VARCHAR(20),
 IN _nombre 	VARCHAR(20),
 IN _latitud 	DECIMAL(9,6),
 IN _longitud 	DECIMAL(9,6),
 IN _direccion 	VARCHAR(30),
 IN _distrito VARCHAR(30),
 IN _telefono VARCHAR(9)
)
BEGIN
INSERT INTO  campos (tipoCampo,nombre,latitud,longitud,direccion,distrito,telefono) VALUES
(_tipoCampo,_nombre,_latitud,_longitud,_direccion,_distrito,_telefono);
END //
DELIMITER ;

/* SP para agregar zonas de campos */
DROP PROCEDURE IF EXISTS spAddZonaCampos;
DELIMITER //
CREATE PROCEDURE spAddZonaCampos(
	IN _idCampo INT,
	IN _nombre VARCHAR(20),
	IN _capacidad SMALLINT,
	IN _superficie VARCHAR(20),
	IN _dimensiones VARCHAR(20),
	IN _precioHora SMALLINT,
	IN _descripcion TEXT,
	IN _estado VARCHAR(10)
)
BEGIN
	INSERT INTO zonas_campos (idCampo,nombre,capacidad,superficie,dimensiones,precioHora,descripcion,estado) 
	VALUES (_idCampo,_nombre,_capacidad,_superficie,_dimensiones,_precioHora,_descripcion,_estado);
END //
DELIMITER ;

/* SP para actualizar campos */
DROP PROCEDURE IF EXISTS spUpdateCampo;
DELIMITER //
CREATE PROCEDURE spUpdateCampo(
    IN _idCampo INT,
    IN _tipoCampo VARCHAR(20),
    IN _nombre VARCHAR(20),
    IN _latitud DECIMAL(9,6),
    IN _longitud DECIMAL(9,6),
    IN _direccion VARCHAR(30),
    IN _distrito VARCHAR(30),
    IN _telefono VARCHAR(9)
)
BEGIN
    UPDATE campos 
    SET tipoCampo = _tipoCampo,
        nombre = _nombre,
        latitud = _latitud,
        longitud = _longitud,
        direccion = _direccion,
        distrito = _distrito,
        telefono = _telefono
    WHERE idCampo = _idCampo;
END //
DELIMITER ;

/* SP para actualizar zonas de campos */
DROP PROCEDURE IF EXISTS spUpdateZonaCampo;
DELIMITER //
CREATE PROCEDURE spUpdateZonaCampo(
	IN _idZonaCampo INT,
	IN _idCampo INT, 
	IN _nombre VARCHAR(20),
	IN _capacidad SMALLINT,
	IN _superficie VARCHAR(20),
	IN _dimensiones VARCHAR(10),
	IN _precioHora SMALLINT,
	IN _descripcion TEXT,
	IN _estado VARCHAR(10)
)
BEGIN
	UPDATE zonas_campos
	SET idCampo = _idCampo,
	 nombre = _nombre,
	 capacidad = _capacidad,
	 superficie = _superficie,
	 dimensiones = _dimensiones,
	 precioHora = _precioHora,
	 descripcion = _descripcion,
	 estado = _estado
	 WHERE idZonaCampo = _idZonaCampo;
END //
DELIMITER ;

/* SP para obtener un campo por ID */
DROP PROCEDURE IF EXISTS spGetCampoById;
DELIMITER //
CREATE PROCEDURE spGetCampoById(
    IN _idCampo INT
)
BEGIN
    SELECT 
        idCampo,
        tipoCampo,
        nombre,
        latitud,
        longitud,
        direccion,
        distrito,
        telefono,
        createAt
    FROM 
        campos
    WHERE 
        idCampo = _idCampo;
END //
DELIMITER ;

/* SP para obtener una zona de campo por ID */
DROP PROCEDURE IF EXISTS spGetZonaCampoById;
DELIMITER //
CREATE PROCEDURE spGetZonaCampoById(
	IN _idZonaCampo INT
)
BEGIN
    SELECT 
        idZonaCampo,
        idCampo,
        nombre,
        capacidad,
        superficie,
        dimensiones,
        precioHora,
        descripcion,
        estado
    FROM 
        zonas_campos
    WHERE
        idZonaCampo = _idZonaCampo;
END //
DELIMITER ;
