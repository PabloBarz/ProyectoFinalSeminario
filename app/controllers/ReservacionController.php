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
            case "":
                break;
        }
        break;
    case "GET":
        break;
}
