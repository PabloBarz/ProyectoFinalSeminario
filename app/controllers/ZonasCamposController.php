<?php
session_start();
require_once "../models/ZonasCamposModel.php";
header('Content-Type: application/json');

$zonaCampos = new ZonaCamposModel();

try {
    switch ($_SERVER["REQUEST_METHOD"]) {
        case "POST":
            if (!isset($_POST["operation"])) {
                echo json_encode(["error" => "Operación no especificada"]);
                exit;
            }

            switch ($_POST["operation"]) {
                case "GetDataZonasCampos":
                    echo json_encode($zonaCampos->GetDataZonasCampos());
                    break;

                case "getZonaCamposByCampos":
                    if (isset($_POST["idCampo"])) {
                        echo json_encode($zonaCampos->getZonaCamposByCampos(["idCampo" => intval($_POST["idCampo"])]));
                    } else {
                        echo json_encode(["error" => "ID de campo no proporcionado"]);
                    }
                    break;

                case "GetListSelectCampos":
                    echo json_encode($zonaCampos->getCamposForSelects());
                    break;

                case "AddZonaCampos":
                    $nuevoZonaCampo = [
                        "idCampo"     => intval($_POST['idCampo']),
                        "nombre"      => htmlspecialchars($_POST['nombre']),
                        "capacidad"   => intval($_POST['capacidad']),
                        "superficie"  => htmlspecialchars($_POST['superficie']),
                        "dimensiones" => htmlspecialchars($_POST['dimensiones']),
                        "precioHora"  => floatval($_POST['precioHora']),
                        "descripcion" => htmlspecialchars($_POST['descripcion']),
                        "estado"      => htmlspecialchars($_POST['estado'])
                    ];
                    $resultado = $zonaCampos->AddZonaCampos($nuevoZonaCampo);
                    echo json_encode(["guardado" => $resultado]);
                    break;

                case "getZonaCampoById":
                    if (isset($_POST['idZonaCampo'])) {
                        $idZonaCampo = intval($_POST['idZonaCampo']);
                        $zonaCampo = $zonaCampos->getZonaCamposById(['idZonaCampo' => $idZonaCampo]);

                        if ($zonaCampo) {
                            echo json_encode($zonaCampo);
                        } else {
                            echo json_encode(["error" => "No se encontró la zona del campo"]);
                        }
                    } else {
                        echo json_encode(["error" => "ID de la zona del campo no proporcionado"]);
                    }
                    break;

                case "UpdateZonaCampos":
                    $zonaCampoActualizado = [
                        "idZonaCampo" => intval($_POST['idZonaCampo']),
                        "idCampo"     => intval($_POST['idCampo']),
                        "nombre"      => htmlspecialchars($_POST['nombre']),
                        "capacidad"   => intval($_POST['capacidad']),
                        "superficie"  => htmlspecialchars($_POST['superficie']),
                        "dimensiones" => htmlspecialchars($_POST['dimensiones']),
                        "precioHora"  => floatval($_POST['precioHora']),
                        "descripcion" => htmlspecialchars($_POST['descripcion']),
                        "estado"      => htmlspecialchars($_POST['estado'])
                    ];
                    $resultado = $zonaCampos->UpdateZonaCampo($zonaCampoActualizado);
                    echo json_encode(["actualizado" => $resultado]);
                    break;

                default:
                    echo json_encode(["error" => "Operación no válida"]);
                    break;
            }
            break;

        default:
            echo json_encode(["error" => "Método no soportado"]);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
