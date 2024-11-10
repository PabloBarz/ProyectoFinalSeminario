<?php 

require_once "../database/Conexion.php";

class UsuarioModel extends Conexion {
    private $pdo; 

    public function __construct()
    {
        $this->pdo = parent::getConexion();
    }

    /**
     * Validará el acceso en 2 pasos (primero usuario, segundo contraseña)
     * @param array $params Arreglo que contiene el nombre de usuario
     * @return array Retornará una colección
    */
    public function loginUser($params = []):array{
        try{
            $cmd = $this->pdo->prepare("CALL spUsuarioLogin(?)");
            $cmd->execute([$params["nomUser"]]);

            return $cmd->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $ex){
            error_log("Error BD: " . $ex->getMessage());
            return [];
        }
        catch(Exception $ex){
            error_log("Error login: " . $ex->getMessage());
            return [];
        }
    }
    public function getDataUsers(){
        try{
            $query = "CALL spGetDataUsers()";
            $statement = $this->pdo->prepare($query);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $ex){
            die($ex->getCode());
        }
    }

    public function getPermisosByPerfil($params = []){
        try{
          $cmd = $this->pdo->prepare("CALL spGetPermisosByPerfil(?)");
          $cmd->execute([$params["nombreCorto"]]);
    
          return $cmd->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
          error_log("Error servidor: " . $e->getMessage());
          return [];
        }
    }

    public function addUser(){}
    public function updateUser(){}
    public function deleteUser(){}    
}

