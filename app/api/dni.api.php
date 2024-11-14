<?php
session_start();
header('Content-Type: application/json');

// Asegúrate de incluir e instanciar el modelo si es necesario
require_once "../models/PersonaModel.php";
$person = new PersonaModel();

switch ($_SERVER["REQUEST_METHOD"]) {
    case "POST":
        // Verificamos si la operación está definida
        if (isset($_POST["operation"])) {
            switch ($_POST["operation"]) {
                case "verifyPerson":
                    // Obtenemos el DNI desde el POST y limpiamos la cadena
                    $dni = $person->limpiarCadena($_POST["dni"]);
    
                    // URL de la API de SUNAT con el DNI
                    $url = "https://api-cpe.sunat.gob.pe/v1/contribuyente/parametros/personas/$dni";
    
                    // Obtenemos el token para la autorización
                    $token = file_get_contents('https://api.vamas.online/v1/getTokenSunat');
                    
                    // Configuramos la solicitud CURL
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $token"]);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    
                    // Ejecutamos la solicitud
                    $response = curl_exec($ch);
                    curl_close($ch);
    
                    // Decodificamos la respuesta JSON
                    $response = json_decode($response, true);
    
                    // Verificamos si el DNI es válido en función de la respuesta
                    if (isset($response["status"])) {
                        echo json_encode(["success" => false, "message" => "DNI no válido o no encontrado"]);
                    } else {
                        echo json_encode(["success" => true, "data" => $response]);
                    }
                    break;
            }
        } else {
            echo json_encode(["success" => false, "message" => "No se recibió la operación"]);
        }
        break;
}
