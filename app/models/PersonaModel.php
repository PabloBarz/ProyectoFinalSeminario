<?php
require_once "../database/Conexion.php";

class PersonaModel extends Conexion{
    private $pdo; 

    public function __construct()
    {
        $this->pdo = parent::getConexion();
    }

    public function verifyPerson($params = []):array{
        try{
            $cmd = $this->pdo->prepare("CALL spVerifyClient(?)");
            $cmd->execute([$params["dni"]]);

            return $cmd->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $ex){
            error_log("Error BD: " . $ex->getMessage());
            return [];
        }
        catch(Exception $ex){
            error_log("Error Servidor: " . $ex->getMessage());
            return [];
        }
    }

    
    public function registerPerson($params = []): int{

        $this->pdo->beginTransaction();

        try{
            // Preparar y ejecutar el procedimiento almacenado
            $cmd = $this->pdo->prepare("CALL spRegisterPerson(?, ?, ?, ?)");
            $cmd->execute([
                $params["apellidos"],
                $params["nombres"],
                $params["dni"],
                $params["telefono"]
            ]);
    
            $result = $cmd->fetch(PDO::FETCH_ASSOC); 
            $cmd->closeCursor();
            $this->pdo->commit();

            return $result['idPersona'];
        }
        catch(PDOException $ex){
            $this->pdo->rollBack();
            die("Error BD: " . $ex->getMessage());
            return -1;
        }
        catch(Exception $ex){
            $this->pdo->rollBack();
            die("Error Servidor: " . $ex->getMessage());
            return -1;
        }
    }
    
    
}

// $person = new PersonaModel();

// $array = [
//     "apellidos" => "Barzola Claudio",
//     "nombres" => "Roberto Pablo",
//     "dni" => "32165478",
//     "telefono" => "914430735" 
// ];

// $result = $person->registerPerson($array);

// print_r($result);


