<?php
require_once "../database/Conexion.php";

class CamposModel extends Conexion{
    private $pdo;

    public function __construct() {
        $this->pdo = parent::getConexion();
    }

    // Método para obtener una lista de campos para selects
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

    // Método para obtener todos los campos
    public function GetDataCampos(): array {
        try {
            $query = "CALL spGetDataCampos()";
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die("Error en GetDataCampos: " . $ex->getMessage());
        }
    }

    // Método para agregar un nuevo campo
    public function AddCampos($params = []): bool {
        try {
            $query = $this->pdo->prepare("CALL spAddCampos(?,?,?,?,?,?,?)");
            return $query->execute([
                $params['tipoCampo'],
                $params['nombre'],
                $params['latitud'],
                $params['longitud'],
                $params['direccion'],
                $params['distrito'],
                $params['telefono']
            ]);
        } catch (Exception $e) {
            die("Error en AddCampos: " . $e->getMessage());
        }
    }

    // Método para actualizar un campo existente
    public function UpdateCampo($params = []): bool {
        try {
            $query = $this->pdo->prepare("CALL spUpdateCampo(?,?,?,?,?,?,?,?)");
            return $query->execute([
                $params['idCampo'],
                $params['tipoCampo'],
                $params['nombre'],
                $params['latitud'],
                $params['longitud'],
                $params['direccion'],
                $params['distrito'],
                $params['telefono']
            ]);
        } catch (Exception $e) {
            die("Error en UpdateCampo: " . $e->getMessage());
        }
    }

    // Método para obtener un campo por ID para la vista de actualización
    public function getCampoById($params = []): array {
        try {
            $query = $this->pdo->prepare("CALL spGetCampoById(?)");
            $query->execute(
                array($params['idCampo'])
              );
            return $query->fetchAll(PDO::FETCH_ASSOC); 
            return $query->fetchAll(PDO::FETCH_ASSOC); // Devuelve un solo registro como un array asociativo
        } catch (Exception $e) {
            die("Error en getCampoById: " . $e->getMessage());
        }
    }

}

