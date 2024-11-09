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
}


