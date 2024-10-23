<?php 
require_once "../database/Conexion.php";

class ReservacionesModel extends Conexion {
    private $pdo;

    public function __construct()
    {
        $this->pdo = parent::getConexion();
    }

    public function getdataReservacion():array{
        try{
            $query = "CALL spGetDataReservacion()";
            $statement = $this->pdo->prepare($query);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $ex){
            die($ex->getCode());
        }
    }
}

?>