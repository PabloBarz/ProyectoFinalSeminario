<?php
session_start();
require_once "../models/ZonasCamposModel.php";
header('Content-Type: application/json');

$zonaCampos = new ZonaCamposModel();

switch ($_SERVER["REQUEST_METHOD"]) {
    case "POST":
        switch ($_POST["operation"]) {
            case "GetDataZonasCampos";
                    echo json_encode($zonaCampos->GetDataZonasCampos());
                break;
            case "getZonaCamposByCampos":
                    echo json_encode($zonaCampos->getZonaCamposByCampos(["idCampo" => $zonaCampos->limpiarCadena($_POST["idCampo"])]));
                break;
        }
        break;
    case "GET":
        break;
}
