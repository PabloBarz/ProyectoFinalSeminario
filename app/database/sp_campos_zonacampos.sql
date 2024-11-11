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

