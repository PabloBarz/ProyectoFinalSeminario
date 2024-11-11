<?php 
require_once "../database/Conexion.php";

class ZonaCamposModel extends Conexion {
    private $pdo;

    public function __construct()
    {
        $this->pdo = parent::getConexion();
    }

    public function GetDataZonasCampos():array{
        try{
            $query = "CALL spGetDataZonasCampos()";
            $statement = $this->pdo->prepare($query);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $ex){
            die($ex->getCode());
        }
    }
    
    public function getZonaCamposByCampos($params = []):array{
        try{
            $query = "CALL spListZonaCampoByCampo(?)";
            $statement = $this->pdo->prepare($query);
            $statement->execute([$params["idCampo"]]);

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $ex){
            die($ex->getCode());
        }
    }
}

?>