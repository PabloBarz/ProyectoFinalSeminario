<?php
session_start();
require_once "../models/UsuarioModel.php";

$user = new UsuarioModel();

//Variable/arreglo de sesión que guarde información de acceso
if (!isset($_SESSION['login']) || $_SESSION['login']['status'] == false) {
    $_SESSION['login'] = [
        "status"      => false,
        "idusuario"   => -1,
        "apellidos"   => "",
        "nombres"     => "",
        "nombreRol"      => "",
        "nombreCorto" => "",
        "nomUser"     => "",
        "permisos"    => []
    ];
}

header('Content-Type: application/json');

switch ($_SERVER["REQUEST_METHOD"]) {
    case "POST":

        switch ($_POST["operation"]) {
            case "login":
                $nomUser = $user->limpiarCadena($_POST["nomUser"]);
                $passUser = $user->limpiarCadena($_POST["passUser"]);
                $passEncrypted  = "";
                $statusLogin = [
                    "esCorrecto" => false,
                    "mensaje" => ""
                ];

                $registro = $user->loginUser(["nomUser" => $nomUser]);

                if (!$registro) {
                    $statusLogin["mensaje"] = "El usuario no existe";
                } else {
                    $passEncrypted = $registro[0]["passUser"];

                    if (password_verify($passUser, $passEncrypted)) {
                        $statusLogin["esCorrecto"] = true;
                        $statusLogin["mensaje"] = "Bienvendido " . $nomUser;

                        //Actualizar los datos de la variable de sesión
                        $_SESSION["login"]["status"] = true;
                        $_SESSION["login"]["idusuario"] =  $registro[0]['idusuario'];
                        $_SESSION["login"]["apellidos"] =  $registro[0]['apellidos'];
                        $_SESSION["login"]["nombres"] =  $registro[0]['nombres'];
                        $_SESSION["login"]["nombreRol"] =  $registro[0]['nombreRol'];
                        $_SESSION["login"]["nombreCorto"] = $registro[0]['nombreCorto'];
                        $_SESSION["login"]["nomUser"] =  $registro[0]['nomUser'];
                        $_SESSION["login"]["permisos"] = $user->getPermisosByPerfil(["nombreCorto" => $registro[0]["nombreCorto"]]);

                    } else {
                        $statusLogin["mensaje"] = "Contraseña incorrecta";
                    }
                }
                echo json_encode($statusLogin);
                break;
            case "spGetDataUsers";
                echo json_encode($user->GetDataUsers());
                break;
            case "registerUser": 

                    $passEncrypted = password_hash($user->limpiarCadena($_POST["passUser"]), PASSWORD_BCRYPT);

                    $result = $user->registerUser([
                        "idPersona" => $user->limpiarCadena($_POST["idPersona"]),
                        "idTipoUsuario" => $user->limpiarCadena($_POST["idTipoUsuario"]),
                        "email" => $user->limpiarCadena($_POST["email"]),
                        "nomUser" => $user->limpiarCadena($_POST["nomUser"]),
                        "passUser" => $passEncrypted
                    ]);

                    echo json_encode($result);    
                break; 
            case "getListSelectTipoUsuario":
                echo json_encode($user->getListTipoUsuarios());
                break;
        }
        break;
    case "GET":
        if ($_GET["operation"] == "destroy") {
            session_destroy();
            session_unset();
            header("Location: ../../");
        }
        break;
    case "PUT":
        break;
    case "DELETE":
        break;
}
