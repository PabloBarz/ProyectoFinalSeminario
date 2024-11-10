<?php
session_start();
require_once "../models/ZonasCamposModel.php";
header('Content-Type: application/json');

$campos = new CamposModel();

switch ($_SERVER["REQUEST_METHOD"]) {
    case "POST":
        switch ($_POST["operation"]) {
            case "GetDataZonasCampos";
                    echo json_encode($campos->GetDataZonasCampos());
                break;
            case "":
                break;
        }
        break;
    case "GET":
        break;
}
