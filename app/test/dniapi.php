<?php
$token = file_get_contents('https://api.vamas.online/v1/getTokenSunat');
$document = '76180741';
$url = "https://api-cpe.sunat.gob.pe/v1/contribuyente/parametros/personas/$document";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $token"]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$response = json_decode($response, true);
if (!isset($response->status)) {
if (!isset($response->cod)) {
    print_r($response);
} else {
//DNI no válido
}
}