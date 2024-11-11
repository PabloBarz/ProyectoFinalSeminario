<?php
session_start();
require_once "../models/CamposModel.php";
header('Content-Type: application/json');

$campos = new CamposModel();

switch ($_SERVER["REQUEST_METHOD"]) {
    case "POST":
        switch ($_POST["operation"]) {
            case "GetListSelectCampos";
                    echo json_encode($campos->getCamposForSelects());
                    break;
            case "GetDataCampos";
                    echo json_encode($campos->GetDataCampos());
                break;
            case "":
                break;
        }
        break;
    case "GET":
        break;
}
