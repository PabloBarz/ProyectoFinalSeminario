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
            case "AddCampos":
                $nuevoCampo = [
                    "tipoCampo" => $_POST['tipoCampo'],
                    "nombre"    => $_POST['nombre'],
                    "latitud"   => $_POST['latitud'],
                    "longitud"  => $_POST['longitud'],
                    "direccion" => $_POST['direccion'],
                    "distrito"  => $_POST['distrito'],
                    "telefono"  => $_POST['telefono']
                ];
                $resultado = $campos->AddCampos($nuevoCampo);
                echo json_encode(["guardado" => $resultado]);
                break;

            case "UpdateCampo":
                $campoActualizado = [
                    "idCampo"   => $_POST['idCampo'], // ID del campo a actualizar
                    "tipoCampo" => $_POST['tipoCampo'],
                    "nombre"    => $_POST['nombre'],
                    "latitud"   => $_POST['latitud'],
                    "longitud"  => $_POST['longitud'],
                    "direccion" => $_POST['direccion'],
                    "distrito"  => $_POST['distrito'],
                    "telefono"  => $_POST['telefono']
                ];
                $resultado = $campos->UpdateCampo($campoActualizado);
                echo json_encode(["actualizado" => $resultado]);
                break;
        }
        break;
    case "GET":
        break;
}
