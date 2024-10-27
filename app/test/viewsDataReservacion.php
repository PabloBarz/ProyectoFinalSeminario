<?php 
    require_once "../models/ReservacionesModel.php";

    $reservacion = new ReservacionesModel();

    print_r($reservacion->getdataReservacion());

?>