<?php
require_once "../database/Conexion.php";

class CamposModel extends Conexion{
    private $pdo;

    public function __construct()
    {
        $this->pdo = parent::getConexion();
    }

    public function getCamposForSelects():array{
        try{
            $query = "CALL spListSelectCampos()";
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $ex){
            die($ex->getCode());
        }
    }
        
            
    public function GetDataCampos():array{
        try{
            $query = "CALL spGetDataCampos()";
            $statement = $this->pdo->prepare($query);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $ex){
            die($ex->getCode());
        }
    }
}
