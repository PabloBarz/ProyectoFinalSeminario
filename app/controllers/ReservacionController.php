<?php
session_start();
require_once "../models/ReservacionesModel.php";
header('Content-Type: application/json');

$reservaciones = new ReservacionesModel();

switch ($_SERVER["REQUEST_METHOD"]) {
    case "POST":
        switch ($_POST["operation"]) {
            case "getListReservaciones";
                    echo json_encode($reservaciones->getdataReservacion());
                break;
            case "registerReservacion":

                $result = $reservaciones->registerResera([
                    "idZonaCampo"   => $_POST["idZonaCampo"],
                    "idUsuario"     => $_POST["idUsuario"],
                    "fecha"         => $_POST["fecha"],
                    "hInicio"       => $_POST["hInicio"],
                    "hFin"          => $_POST["hFin"],
                    "estadoPago"    => $_POST["estadoPago"],
                    "precioHora"    => $_POST["precioHora"],
                    "cantidadHora"  => $_POST["cantidadHora"],
                    "totalMonto"    => $_POST["totalMonto"]
                ]);

                echo json_encode($result);
                break;
        }
        break;
    case "GET":
        break;
}
