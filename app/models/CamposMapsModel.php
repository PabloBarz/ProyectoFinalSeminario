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
}

