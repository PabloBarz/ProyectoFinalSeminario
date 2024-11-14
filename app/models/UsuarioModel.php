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

    public function getPermisosByPerfil($params = []): array{
        try{
          $cmd = $this->pdo->prepare("CALL spGetPermisosByPerfil(?)");
          $cmd->execute([$params["nombreCorto"]]);
    
          return $cmd->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $ex){
            error_log("Error BD: " . $ex->getMessage());
            return [];
        }
        catch(Exception $ex){
            error_log("Error servidor: " . $ex->getMessage());
            return [];
        }
    }

    public function registerUser($params = []): array{
        try{
          $cmd = $this->pdo->prepare("CALL spRegisterUser(?,?,?,?,?)");
          $cmd->execute([
            $params["idPersona"],
            $params["idTipoUsuario"],
            $params["email"],
            $params["nomUser"],
            $params["passUser"]
        ]);
    
          return [
                    "status" => true,
                    "message" => "Usuario registrado con éxito"
                 ];
        } 
        catch (PDOException $e) {
            error_log("Error en la base de datos: " . $e->getMessage());
            return [
                "status" => false,
                "message" => "Error al registrar el usuario en la base de datos"
            ];
        } 
        catch (Exception $e) {
            error_log("Error servidor: " . $e->getMessage());
            return [
                "status" => false,
                "message" => "Error inesperado"
            ];
        }
    }

    public function getListTipoUsuarios(): array{
        try{
          $cmd = $this->pdo->prepare("CALL spListSelectTypeUser()");
          $cmd->execute();
    
          return $cmd->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $ex){
            error_log("Error BD: " . $ex->getMessage());
            return [];
        }
        catch(Exception $ex){
            error_log("Error servidor: " . $ex->getMessage());
            return [];
        }
    }

    public function getUserById($params = []): array{
        try{
          $cmd = $this->pdo->prepare("CALL spGetUserById(?)");
          $cmd->execute([$params["idUser"]]);
    
          return $cmd->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $ex){
            error_log("Error BD: " . $ex->getMessage());
            return [];
        }
        catch(Exception $ex){
            error_log("Error servidor: " . $ex->getMessage());
            return [];
        }
    }


    public function updateUser(){}
    public function deleteUser(){}    
}

