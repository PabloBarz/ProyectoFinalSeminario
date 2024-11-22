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

    public function getCamposForSelects(): array {
        try {
            $query = "CALL spListSelectCampos()";
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die("Error en getCamposForSelects: " . $ex->getMessage());
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

    //Metodo para obtener las zonas de 1 un campo disponible
    public function getZonaCampoDisponible($params = []): array {
        try {
            $query = $this->pdo->prepare("CALL spListZonasDisponibles(?,?,?,?)");
            $query->execute(
                array(
                    $params['fecha'],
                    $params["hInicio"],
                    $params["hFin"],
                    $params["idCampo"]
                    )
              );
            return $query->fetchAll(PDO::FETCH_ASSOC); 
        } catch (Exception $e) {
            die("Error en getCampoById: " . $e->getMessage());
        }
    }

    public function AddZonaCampos ($params = []): bool {

        try {
            $query = $this->pdo->prepare("CALL spAddZonaCampos(?,?,?,?,?,?,?,?)");
            return $query->execute([
                $params['idCampo'],
                $params['nombre'],
                $params['capacidad'],
                $params['superficie'],
                $params['dimensiones'],
                $params['precioHora'],
                $params['descripcion'],
                $params['estado']
            ]);
        } catch (Exception $e) {
            die("Error en AddZonaCampos: " . $e->getMessage());
        }
    }

    public function getZonaCamposById($params= []): array {
        try {
            $query = $this->pdo->prepare("CALL spGetZonaCampoById(?)");
            $query->execute(
                array($params['idZonaCampo'])
            );
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Error en getZonaCampoById: " . $e->getMessage());
        }
    }

    public function UpdateZonaCampo($params = []): bool {
        try {
            $query = $this->pdo->prepare("CALL spUpdateZonaCampo(?,?,?,?,?,?,?,?,?)");
            return $query->execute([
                $params['idZonaCampo'],
                $params['idCampo'],
                $params['nombre'],
                $params['capacidad'],
                $params['superficie'],
                $params['dimensiones'],
                $params['precioHora'],
                $params['descripcion'],
                $params['estado']
            ]);
        } catch (Exception $e) {
            die("Error en UpdateZonaCampos: " . $e->getMessage());
            
        }
    }

}

?>