<?php
session_start();
require_once "../models/CamposMapsModel.php";
header('Content-Type: application/json');

$camposMaps = new CamposMapsModel();

switch ($_SERVER["REQUEST_METHOD"]) {
    case "POST":
        switch ($_POST["operation"]) {
            case "getAllCampos";
                    echo json_encode($camposMaps->getAllCampos());
                break;
            case "getCamposDisponibles":
                    $datos = [
                        "fecha" => $_POST["fecha"],
                        "horaInicio" => $_POST["horaInicio"],
                        "horaFin" => $_POST["horaFin"]
                    ];

                    echo json_encode($camposMaps->getCamposDisponibles($datos));
                break;
        }
        break;
    case "GET":
        break;
}