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
            case "":
                break;
        }
        break;
    case "GET":
        break;
}