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

    public function registerResera($params = []):array{
        try{
            $query = "CALL spRegisterReservacion(?,?,?,?,?,?,?,?,?)";
            $statement = $this->pdo->prepare($query);
            $statement->execute([
                $params["idZonaCampo"],
                $params["idUsuario"],
                $params["fecha"],
                $params["hInicio"],
                $params["hFin"],
                $params["estadoPago"],
                $params["precioHora"],
                $params["cantidadHora"],
                $params["totalMonto"]
            ]);

            return [
                "status" => true,
                "message" => "Reservación registrada con éxito"
            ];

        }
        catch(PDOException $ex){
            die($ex->getCode());
            return [
                "status" => false,
                "message" => "No se puedo registrar la reservación" 
            ];
        }
    }
}

?>