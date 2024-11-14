USE sportsfieldrentaldb;

/*Aqui iran todas las vista reutilizables*/

DROP VIEW IF EXISTS vwUserPerson; 
CREATE VIEW vwUserPerson AS
SELECT
    US.idusuario,
    PE.idPersona,
    PE.dni,
    PE.apellidos, 
    PE.nombres,
    TU.nombreRol, 
    TU.nombreCorto,
    US.nomUser, 
    US.passUser,
    US.inactiveAt
FROM 
    usuarios US
INNER JOIN 
    personas PE ON PE.idpersona = US.idpersona
INNER JOIN 
    tipos_usuarios TU ON TU.idTipoUsuario = US.idTipoUsuario;

DROP VIEW IF EXISTS vwUserTipoUsuario;
CREATE VIEW vwUserTipoUsuario AS
SELECT 
        u.idUsuario AS IDUsuario,
        t.nombreRol AS TipoUsuario,
        t.idTipoUsuario as idTipoUsuario,
        p.nombres AS Nombres,
        P.apellidos AS Apellidos,
        P.dni AS Dni,
        P.telefono AS Telefono,
        u.email AS Email,
        u.nomUser AS Usuario,
        u.passUser AS Contraseña    
    FROM 
        usuarios u
    INNER JOIN 
        tipos_usuarios t ON t.idTipoUsuario = u.idTipoUsuario
	INNER JOIN 
		personas AS p ON p.idPersona = u.idPersona;