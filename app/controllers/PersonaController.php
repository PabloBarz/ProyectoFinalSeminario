<?php
session_start();
require_once "../models/PersonaModel.php";
header('Content-Type: application/json');

$person = new PersonaModel();

switch ($_SERVER["REQUEST_METHOD"]) {
    case "POST":
        switch ($_POST["operation"]) {
            case "verifyPerson";
                    echo json_encode($person->verifyPerson(["dni" => $person->limpiarCadena($_POST["dni"])]));
                break;
            case "registerPerson":
                    $result = $person->registerPerson([
                        "apellidos" => $person->limpiarCadena($_POST["apellidos"]),
                        "nombres" => $person->limpiarCadena($_POST["nombres"]),
                        "dni" => $person->limpiarCadena($_POST["dni"]),
                        "telefono" => $person->limpiarCadena($_POST["telefono"])
                    ]);

                    if ($result > 0) {
                        echo json_encode(["status" => true, "idPersona" => $result]);
                    } else {
                        echo json_encode(["status" => false, "message" => "Error al registrar la persona."]);
                    }
                break;
        }
        break;
    case "GET":
        break;
}