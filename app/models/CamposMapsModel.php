<?php
require_once "../database/Conexion.php";

class CamposMapsModel extends Conexion{
    private $pdo;

    public function __construct()
    {
        $this->pdo = parent::getConexion();
    }

    public function getAllCampos():array{
        try{
            $query = "CALL spGetAllCampos()";
            $statement = $this->pdo->prepare($query);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $ex){
            die($ex->getCode());
        }
    }

    // Obtener campos disponibles según filtros
    public function getCamposDisponibles($params = []): array {
        try {
            $query = "CALL splistCamposDisponibles(?, ?, ?)";
            $statement = $this->pdo->prepare($query);
            $statement->execute([
                $params["fecha"],
                $params["horaInicio"],
                $params["horaFin"]
            ]);

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
}

