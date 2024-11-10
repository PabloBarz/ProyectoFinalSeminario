USE sportsfieldrentaldb;

/*Aqui iran todas las vista reutilizables*/

DROP VIEW IF EXISTS vwUserPerson;  -- Eliminar la vista si ya existe
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